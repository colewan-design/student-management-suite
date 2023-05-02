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
            <v-toolbar-title>Staff's Information</v-toolbar-title>
          </v-toolbar>
  
          <v-data-table
        :headers="headers"
        :items="staffs"
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
    <!-- staffs first name field -->
                  <v-card-text class="px-5">
                    <v-text-field
                    :rules="[v => !!v || 'Field is required']"
                      label="first name"
                      v-model="staffs_items.first_name"
                      prepend-icon="mdi-pencil"
                    ></v-text-field>
    
                  <!-- staffs last name field -->
                    <v-text-field
                    :rules="[v => !!v || 'Field is required']"
                      label="last name"
                      v-model="staffs_items.last_name"
                      prepend-icon="mdi-pencil"
                    ></v-text-field>
    
                   <!-- staffs email field -->
                    <v-text-field
                    :rules="[v => !!v || 'Field is required']"
                      label="email"
                      v-model="staffs_items.email"
                      prepend-icon="mdi-pencil"
                    ></v-text-field>
    
                  <!-- staffs role field -->
                  <v-select
                  :rules="[v => !!v || 'Field is required']"
                      :items="['School Admin', 'Guard', 'Staff', 'Finance Officer']"
                      label="role"
                      v-model="staffs_items.role"
                      prepend-icon="mdi-pencil"
                      ></v-select>
    
                   <!-- staffs contract type field -->
                    <v-text-field
                    :rules="[v => !!v || 'Field is required']"
                      label="contract type"
                      v-model="staffs_items.contract_type"
                      prepend-icon="mdi-pencil"
                    ></v-text-field>
                     <!-- staffs shift field -->
                    <v-text-field
                    :rules="[v => !!v || 'Field is required']"
                      label="shift"
                      v-model="staffs_items.shift"
                      prepend-icon="mdi-pencil"
                    ></v-text-field>
    
                   <!-- staffs location field -->
                    <v-text-field
                    :rules="[v => !!v || 'Field is required']"
                      label="location"
                      v-model="staffs_items.location"
                      prepend-icon="mdi-pencil"
                    ></v-text-field>
    
    
                
                  <!-- staffs joining date field -->
                  <v-menu
                                ref="menu"
                                :close-on-content-click="false"
                                transition="scale-transition"
                                offset-y
                                min-width="auto"
                              >
                                <template v-slot:activator="{ on, attrs }">
                                  <v-text-field
                                  :rules="[v => !!v || 'Field is required']"
                                    v-model="staffs_items.joining_date"
                                    label="Joining Date"
                                    prepend-icon="mdi-calendar"
                                    readonly
                                    v-bind="attrs"
                                    v-on="on"
                                  ></v-text-field>
                                </template>
                                <v-date-picker
                                  v-model="staffs_items.joining_date"
                                  no-title
                                  scrollable
                                >
                                  <v-spacer></v-spacer>
                                  <v-btn
                                    text
                                    color="primary"
                                    @click="menu = false"
                                  >
                                    Cancel
                                  </v-btn>
                                  <v-btn
                                    text
                                    color="primary"
                                    @click="$refs.menu.save()"
                                  >
                                    OK
                                  </v-btn>
                                </v-date-picker>
                              </v-menu>
    
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
         { text: "Last Name", value: "last_name" },
         { text: "Email", value: "email" },
         { text: "Role", value: "role" },
         { text: "Contract Type", value: "contract_type" },
         { text: "Shift", value: "shift" },
         { text: "Location", value: "location" },
         { text: "Joining Date", value: "joining_date" },
         { text: "Actions", value: "actions", sortable: false, align: "right" },
        ],
        search:"",
        staffs: [],
        staffs_items:{
              first_name:"",
              last_name:"",
              email:"",
              role:"",
              contract_type:"",
              shift:"",
              location:"",
              joining_date:"",
        },
        editedIndex: -1,
        defaultItem: {  
              staff:"",
        },
        id:null,
        valid: false,
     
     
     
      }),
      computed: {
        formTitle() {
          return this.editedIndex === -1 ? "New Staff" : "Edit Staff";
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
        // Your logout implementation here
  
        // Redirect to the login page
        this.$router.push('/login');
      },
        initialize() {
          this.StaffList();
        },
        async StaffList() {
          var res = await axios.get("/staffs");
          if (res.status === 200) this.staffs = res.data;
          else {
            this.$Notice.error({
              title: "Error",
              desc: "Error occurred while loading data",
            });
          }
        },
        editItem(item) {
          this.id = item.id;
          this.editedIndex = this.staffs.indexOf(item);
          this.staffs_items = Object.assign({}, item);
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
          var res = await axios.delete("/staffs/delete/" + this.id);
          if (res.status === 200) {
            this.StaffList();
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
            this.staffs_items = Object.assign({}, this.defaultItem);
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
                .put("/staffs/update/" + this.id, this.staffs_items)
                .then((response) => {
                  this.StaffList();
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
                .post("/staffs/create", this.staffs_items)
                .then((response) => {
                  this.StaffList();
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