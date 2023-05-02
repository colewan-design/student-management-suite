<style>
.my-toolbar{
  margin-bottom: 20px;
}
</style>
<template>
 <v-container fluid>
  <v-row>
    <superadmin-navigation></superadmin-navigation>
        <v-col>
            <v-toolbar>
              <v-toolbar-title>Parent</v-toolbar-title>
            </v-toolbar>
              <v-data-table
          :headers="headers"
          :items="parents"
          :search="search"
          sort-by="first_name"
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
      
              <v-dialog v-model="dialog" max-width="500px">
                <template v-slot:activator="{ on, attrs }">
                  <v-btn x-small fab color="primary" dark v-bind="attrs" v-on="on">
                    <v-icon dark> mdi-plus </v-icon>
                  </v-btn>
                </template>
      <!-- modal for edit -->
                <v-form ref="form" v-model="valid">
                  <v-card class="py-5">
                    <v-card-title class="px-5">
                      <span class="text-h6">{{ formTitle }}</span>
                    </v-card-title>

                  <v-card-text>
                       <!-- parent first name field -->
                      <v-text-field
                      :rules="[v => !!v || 'Field is required']"
                        label="first name"
                        v-model="parents_items.first_name"
                        prepend-icon="mdi-pencil"
                      ></v-text-field>
      
  
                    <!-- parent middle name field -->
                      <v-text-field
                      :rules="[v => !!v || 'Field is required']"
                        label="middle name"
                        v-model="parents_items.middle_name"
                        prepend-icon="mdi-pencil"
                      ></v-text-field>
  
                      <!-- parent last name field -->
                      <v-text-field
                      :rules="[v => !!v || 'Field is required']"
                        label="last name"
                        v-model="parents_items.last_name"
                        prepend-icon="mdi-pencil"
                      ></v-text-field>
      
                     <!-- parent email field -->
                      <v-text-field
                      :rules="[v => !!v || 'Field is required']"
                        label="email"
                        v-model="parents_items.email"
                        prepend-icon="mdi-pencil"
                      ></v-text-field>

                      <v-autocomplete
                      :rules="[v => !!v || 'Field is required']"
                        label="Child's Name"
                        :items="students"
                        :item-text="students => students.first_name + ' ' + students.middle_name + ' ' +  students.last_name"
                        v-model="parents_items.child_name"
                        prepend-icon="mdi-pencil"
                      ></v-autocomplete>
      
                    </v-card-text>
      
                    <v-card-actions class="px-5">
                      <v-spacer></v-spacer>
                      <v-tooltip top>
                        <template v-slot:activator="{ on, attrs }">
                          <v-btn
                            x-small
                            fab
                            dark
                            color="primary"
                            v-bind="attrs"
                            v-on="on"
                            @click="Submit"
                            :disabled="!valid"
                          >
                            <v-icon style="color: #fff !important">
                              mdi-check
                            </v-icon>
                          </v-btn>
                        </template>
                        <span>Save</span>
                      </v-tooltip>
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
                            @click="close"
                          >
                            <v-icon style="color: #fff !important">
                              mdi-close
                            </v-icon>
                          </v-btn>
                        </template>
                        <span>Cancel</span>
                      </v-tooltip>
                    </v-card-actions>
                  </v-card>
                </v-form>
              </v-dialog>
      
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
      </v-col>
      </v-row>
      </v-container>
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
            { text: "First Name", value: "first_name" },
            { text: "Middle Name", value: "middle_name" },
           { text: "Last Name", value: "last_name" },
           { text: "Email", value: "email" },
           { text: "Child Name", value: "child_name"},
          { text: "Actions", value: "actions", sortable: false, align: "right" },
  
           
          ],
          search:"",
          parents: [],
          students:[],
          parents_items:{
                first_name:"",
                middle_name:"",
                last_name:"",
                email:"",
                child_name:"",
          },
          editedIndex: -1,
          defaultItem: {  
                first_name:"",
                middle_name:"",
                last_name:"",
                email:"",
                child_name:"",
          },
          id:null,
          valid: false,
       
       
       
        }),
        computed: {
          formTitle() {
            return this.editedIndex === -1 ? "New Parent" : "Edit Parent";
          },
        },
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
            this.ParentList();
            this.studentList();
          },
          async studentList() {
            var res = await axios.get("/students");
            if (res.status === 200) this.students = res.data;
          },
          async ParentList() {
            var res = await axios.get("/parents");
            if (res.status === 200) this.parents = res.data;
            else {
              this.$Notice.error({
                title: "Error",
                desc: "Error occurred while loading data",
              });
            }
          },
          editItem(item) {
            this.id = item.id;
            this.editedIndex = this.parents.indexOf(item);
            this.parents_items = Object.assign({}, item);
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
            var res = await axios.delete("/parents/delete/" + this.id);
            if (res.status === 200) {
              this.ParentList();
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
              this.parents_items = Object.assign({}, this.defaultItem);
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
                  .put("/parents/update/" + this.id, this.parents_items)
                  .then((response) => {
                    this.ParentList();
                    this.close();
                  })
                  .catch((error) => {
                    this.$swal({
                    icon: "error",
                    title: "Email Already Taken!",
                })
                  });
              } else {
                axios
                  .post("/parents/create", this.parents_items)
                  .then((response) => {
                    this.ParentList();
                    this.close();
                    window.location.reload()
                  })
                  .catch((error) => {
                    this.$swal({
                    icon: "error",
                    title: "Email Already Taken!",
                })
                  });
                // this.close();
              }
            }
          },
        },
    };
    </script>