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
            <v-toolbar-title>Students Information List</v-toolbar-title>
          </v-toolbar>
            <template>
              <v-data-table
                :headers="headers"
                :items="students"
                :search="search"
                sort-by="last_name"
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

                    <v-dialog v-model="dialog" max-width="600px">
                      <template v-slot:activator="{ on, attrs }">
                        <v-btn x-small fab color="primary" dark v-bind="attrs" v-on="on">
                          <v-icon dark> mdi-plus </v-icon>
                        </v-btn>
                      </template>

                      <v-form ref="form" v-model="valid">
                        <v-card class="py-10">
                          <v-card-title class="px-5">
                            <span class="text-h6">{{ formTitle }}</span>
                          </v-card-title>
                          <v-card-text class="px-5">
                            <v-row>
                          <v-col
                            cols="12"
                            sm="6"
                          >
                            <v-text-field
                              :rules="[v => !!v || 'Field is required']"
                              label="First Name"
                              v-model="student_items.first_name"
                              prepend-icon="mdi-pencil"
                            ></v-text-field>
                            </v-col>
                            <v-col
                            cols="12"
                            sm="6"
                          >
                            <v-text-field
                            :rules="[v => !!v || 'Field is required']"
                              label="Middle Name"
                              v-model="student_items.middle_name"
                              prepend-icon="mdi-pencil"
                            ></v-text-field>
                            </v-col>
                            <v-col
                            cols="12"
                            sm="6"
                          >
                            <v-text-field
                            :rules="[v => !!v || 'Field is required']"
                              label="Last Name"
                              v-model="student_items.last_name"
                              prepend-icon="mdi-pencil"
                            ></v-text-field>
                            </v-col>
                            <v-col
                            cols="12"
                            sm="6"
                          >
                            <v-text-field
                            type="number"
                            :rules="[v => !!v || 'Field is required']"
                              label="Phone Number"
                              maxlength = "11"
                              oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                              onkeydown="javascript: 
                              return event.keyCode == 69 ? false : true"
                              v-model="student_items.contact_number"
                              prepend-icon="mdi-phone"
                            ></v-text-field>
                            </v-col>

                            
                            <v-col
                            cols="12"
                            sm="6"
                          >
                          <v-select
                          :rules="[v => !!v || 'Field is required']"
                          v-model="student_items.gender"
                            label="Gender"
                            prepend-icon="mdi-account"
                            :items="['Male', 'Female']"
                          ></v-select>
                            </v-col>
                            <v-col
                            cols="12"
                            sm="6"
                          >
                            <v-menu
                              ref="menu"
                              v-model="menu"
                              :close-on-content-click="false"
                              transition="scale-transition"
                              offset-y
                              min-width="auto"
                            >
                              <template v-slot:activator="{ on, attrs }">
                                <v-text-field
                                :rules="[v => !!v || 'Field is required']"
                                  v-model="student_items.student_birthdate"
                                  label="Birthdate"
                                  prepend-icon="mdi-calendar"
                                  readonly
                                  v-bind="attrs"
                                  v-on="on"
                                ></v-text-field>
                              </template>
                              <v-date-picker
                                v-model="student_items.student_birthdate"
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
                            </v-col>
                            
                            <v-col
                            cols="12"
                            sm="6"
                          >
                            <v-text-field
                            :rules="[v => !!v || 'Field is required']"
                              label="Email"
                              v-model="student_items.email"
                              prepend-icon="mdi-email"
                            ></v-text-field>
                            </v-col>

                            

                            <v-col
                            cols="12"
                            sm="6"
                          >
                            <v-text-field
                            :rules="[v => !!v || 'Field is required']"
                              label="Level"
                              v-model="student_items.level"
                              prepend-icon="mdi-pencil"
                            ></v-text-field>
                            </v-col>
                            <v-col
                            cols="12"
                            sm="6"
                          >
                            <v-text-field
                            :rules="[v => !!v || 'Field is required']"
                              label="Section"
                              v-model="student_items.section"
                              prepend-icon="mdi-pencil"
                            ></v-text-field>
                            </v-col>
                            <v-col
                            cols="12"
                            sm="6"
                          >
                            </v-col>
                            <v-col
                          >
                           
                          <v-autocomplete
                          :rules="[v => !!v || 'Field is required']"
                            label="BRGY - CITY"
                            hide-details
                            :items="brgys"
                            :item-text="brgys => brgys.brgy + ', ' + brgys.muncity"
                            :item-value="brgys => brgys.brgy + ', ' + brgys.muncity + ', ' + brgys.province"
                            v-model="student_items.address"
                            prepend-icon="mdi-map-marker"
                          ></v-autocomplete>
                            </v-col>
                            
                            </v-row>
                            
                            <v-col></v-col>
                            <v-text-field
                              readonly
                              label="Complete Address"
                              v-model="student_items.address"
                              prepend-icon="mdi-pencil"
                            ></v-text-field>
                           
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
                 
                </template>
              </v-data-table>
            </template>
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
    menu: false,
    dialog: false,
    dialogDelete: false,
    headers: [
      { text: "Last Name", value: "last_name" },
      { text: "First Name", value: "first_name" },
      { text: "Middle Name", value: "middle_name" },
      { text: "Phone Number", value: "contact_number" },
      { text: "Gender", value: "gender" },
      { text: "Birthdate", value: "student_birthdate" },
      { text: "Email", value: "email" },
      { text: "Level", value: "level" },
      { text: "Section", value: "section" },
      { text: "Address", value: "address" },
      { text: "Actions", value: "actions", sortable: false, align: "right" },
    ],
    search:"",
    students: [],
    brgys: [],
    editedIndex: -1,
    student_items:{
      last_name:'',
      first_name:'',
      middle_name:'',
      contact_number:'',
      gender:'',
      student_birthdate:'',
      email:'',
      level:'',
      section:'', 
      address:'',
    },
    defaultItem: {  
      last_name:'', 
      first_name:'',
      middle_name:'',
      contact_number:'',
      gender:'',
      student_birthdate:'',
      email:'',
      level:'',
      section:'',
      address:'',
    },
    id:null,
    valid: false,
 
 
 
  }),
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Student" : "Edit Student";
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
    this.getBrgys();
  },
  methods: {
    

    logout() {
      // Your logout implementation here

      // Redirect to the login page
      this.$router.push('/login');
    },
    initialize() {
      this.SampleList();
      this.getBrgys();
      //this.getRegions();
      //this.getProvinces();
      //this.getMuncities();
      //this.getCompleteAdd();
    },
    async SampleList() {
      var res = await axios.get("/students");
      if (res.status === 200) this.students = res.data;
      else {
        this.$Notice.error({
          title: "Error",
          desc: "Error occurred while loading data",
        });
      }
    },
    async getBrgys() {
      var res = await axios.get("/filters/get_brgys");
      if (res.status === 200 && res.data) this.brgys = res.data;
      console.log(res.data);
    },

    /*
    async getRegions() {
      var res = await axios.get("/filters/get_regions");
      if (res.status === 200 && res.data) this.regions = res.data;
      console.log(res.data);
    },
    async getProvinces() {
      var res = await axios.get("/filters/get_provinces");
      if (res.status === 200 && res.data) this.provinces = res.data;
      console.log(res.data);
    },
    async getMuncities() {
      var res = await axios.get("/filters/get_muncities");
      if (res.status === 200 && res.data) this.muncities = res.data;
      console.log(res.data);
    },
    
    async getCompleteAdd(){
      var scope = this;
      console.log(scope.student_items.address);
      var res = await axios.get("/filters/get_brgys/" + scope.student_items.brgys);
      if (res.status === 200 && res.data) this.brgys = res.data;
      console.log(res.data);
    },
    */
  
    editItem(item) {
      this.id = item.id;
      this.editedIndex = this.students.indexOf(item);
      this.student_items = Object.assign({}, item);
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
      var res = await axios.delete("/students/delete/" + this.id);
      if (res.status === 200) {
        this.SampleList();
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
        this.student_items = Object.assign({}, this.defaultItem);
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
            .put("/students/update/" + this.id, this.student_items)
            .then((response) => {
              this.SampleList();
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
            .post("/students/create", this.student_items)
            .then((response) => {
              this.SampleList();
              this.close();
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