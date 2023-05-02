<template>
    <main>
    <v-card height="100vh">
      <v-layout>
        <superadmin-navigation></superadmin-navigation>
    
          <v-main>
            <v-toolbar>
              <v-toolbar-title>Account</v-toolbar-title>
            </v-toolbar>
    
            <v-card>
              <v-data-table
          :headers="headers"
          :items="accounts"
          :search="search"
          sort-by="name"
          class="elevation-1"
        >
        
          <template v-slot:top>
            <v-text-field
                v-model="search"
                label="Search"
                class="mx-4 code"
              ></v-text-field>
            <v-toolbar flat class="px-0">
              <v-divider class="mx-4" inset vertical></v-divider>
              <v-spacer></v-spacer>
      
              <v-dialog v-model="dialogDelete" max-width="500px">
                <v-card>
                  <v-card-title class="text-h6 justify-center">
                    Are you sure you want to delete?
                  </v-card-title>
                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-tooltip top>
                      <template v-slot:activator="{ on, attrs }">
                        <v-btn
                          x-small
                          fab
                          dark
                          color="secondary"
                          v-bind="attrs"
                          v-on="on"
                          class="ml-2"
                          @click="closeDelete"
                        >
                          <v-icon style="color: #fff !important">
                            mdi-close
                          </v-icon></v-btn
                        >
                      </template>
                      <span>Cancel</span>
                    </v-tooltip>
                    <v-tooltip top>
                      <template v-slot:activator="{ on, attrs }">
                        <v-btn
                          x-small
                          fab
                          dark
                          color="error"
                          v-bind="attrs"
                          v-on="on"
                          class="ml-2"
                          @click="deleteItemConfirm"
                        >
                          <v-icon style="color: #fff !important">
                            mdi-check
                          </v-icon></v-btn
                        >
                      </template>
                      <span>Continue</span>
                      
                    </v-tooltip>
                    
                    <v-spacer></v-spacer>
                  </v-card-actions>
                  
                </v-card>
                
              </v-dialog>
            </v-toolbar>
            
        </template>
        
        <template v-slot:item.actions="{ item }">
          <v-icon small class="mr-2" @click="editItem(item)"> mdi-pencil </v-icon>
          <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
          <!-- <v-btn depressed @click="TimeOut(item.id)"> 
            Time Out
          </v-btn>-->
        </template>
        </v-data-table>
            </v-card>
            
          </v-main>
          
        </v-layout>
        
      </v-card>
      </main>
    </template>
    
    <script>
import SuperadminNavigation from "./components/SuperadminNavigation.vue";
export default {
  components:{
    SuperadminNavigation: SuperadminNavigation,
  },
};
</script>
    <script>
    export default {
     
      data: () => ({
          dialog: false,
          dialogDelete: false,
          headers: [
            { text: "Name", value: "name" },
            { text: "Role", value: "role" },
         
           { text: "Email", value: "email" },
         
  
           
          ],
          search:"",
          accounts: [],
          accounts_items:{
                name:"",
                role:"",
                email:"",
          },
          editedIndex: -1,
          defaultItem: {  
            name:"",
                role:"",
                email:"",
          },
          id:null,
          valid: false,
       
       
       
        }),
        watch: {
          dialog(val) {
            val || this.close();
          },
          dialogDelete(val) {
            val || this.closeDelete();
          },
        },
        created() {
          this.initialize();
        },
        methods: {
          logout() {
          axios.post('/logout')
            .then(response => {
              // Success message
              console.log(response.data.message);
              // Redirect to the login page
              this.$router.push('/login');
            })
            .catch(error => {
              console.log(error.response.data.message);
            });
        },
          initialize() {
            this.AccountList();
          },
          async AccountList() {
            var res = await axios.get("/accounts");
            if (res.status === 200) this.accounts = res.data;
            else {
              this.$Notice.error({
                title: "Error",
                desc: "Error occurred while loading data",
              });
            }
          },
          editItem(item) {
            this.id = item.id;
            this.editedIndex = this.accounts.indexOf(item);
            this.accounts_items = Object.assign({}, item);
            this.dialog = true;
            // console.log(item);
          },
          deleteItem(item) {
            // this.editedIndex = this.tmcDepartments.indexOf(item);
            // this.editedItem = Object.assign({}, item);
            this.id = item.id;
            this.dialogDelete = true;
          },
          async deleteItemConfirm() {
            var res = await axios.delete("/accounts/delete/" + this.id);
            if (res.status === 200) {
              this.AccountList();
              // this.tmcDepartments.splice(this.editedIndex, 1);
              this.closeDelete();
            } else {
              this.$Notice.error({
                title: "Error",
                desc: "Error occurred while loading data",
              });
            }
          },
          close() {
            this.dialog = false;
            this.$nextTick(() => {
              this.accounts_items = Object.assign({}, this.defaultItem);
              this.editedIndex = -1;
            });
          },
          closeDelete() {
            this.dialogDelete = false;
            this.$nextTick(() => {
              this.editedItem = Object.assign({}, this.defaultItem);
              this.editedIndex = -1;
            });
          },
          Submit() {
            if (this.$refs.form.validate()) {
              if (this.id) {
                axios
                  .put("/accounts/update/" + this.id, this.accounts_items)
                  .then((response) => {
                    this.AccountList();
                    this.close();
                  })
                  .catch((error) => {
                    console.error("There was an error!", error);
                  });
              } else {
                axios
                  .post("/accounts/create", this.accounts_items)
                  .then((response) => {
                    this.AccountList();
                    this.close();
                    window.location.reload()
                  })
                  .catch((error) => {
                    console.error("There was an error!", error);
                  });
                // this.close();
              }
            }
          },
        },
    };
    </script>