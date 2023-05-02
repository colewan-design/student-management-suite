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
          <v-toolbar-title>Teacher's Information</v-toolbar-title>
        </v-toolbar>
    <v-data-table
      :headers="headers"
      :items="teachers"
      :search="search"
      sort-by="teacher"
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
  
            <v-form ref="form" v-model="valid">
              <v-card class="py-5">
                <v-card-title class="px-5">
                  <span class="text-h6">{{ formTitle }}</span>
                </v-card-title>
  
                
                <v-card-text>
                      <v-text-field
                      :rules="[v => !!v || 'Field is required']"
                        label="First Name"
                        v-model="teachers_items.first_name"
                        prepend-icon="mdi-pencil"
                      ></v-text-field>
                      <v-text-field
                      :rules="[v => !!v || 'Field is required']"
                        label="Middle Name"
                        v-model="teachers_items.middle_name"
                        prepend-icon="mdi-pencil"
                      ></v-text-field>
                      <v-text-field
                      :rules="[v => !!v || 'Field is required']"
                        label="Last Name"
                        v-model="teachers_items.last_name"
                        prepend-icon="mdi-pencil"
                      ></v-text-field>
                      <v-autocomplete
                      :rules="[v => !!v || 'Field is required']"
                      :items="[
                        'Teacher I',
                        'Teacher II',
                        'Teacher III',
                        'Special Education Teacher I',
                        'Special Education Teacher II',
                        'Special Education Teacher III',
                        'Special Education Teacher IV',
                        'Special Science Teacher I',
                        'Special Science Teacher II',
                        'Special Science Teacher III',
                        'Special Science Teacher IV',
                        'Special Science Teacher V',
                        'Head Teacher I',
                        'Head Teacher II',
                        'Head Teacher III',
                        'Head Teacher IV',
                        'Head Teacher V',
                        'Head Teacher VI',
                        'Master Teacher I',
                        'Master Teacher II',
                        ]"
                      label="Position"
                      v-model="teachers_items.position"
                      prepend-icon="mdi-pencil"
                      ></v-autocomplete>
                      <v-autocomplete
                      :rules="[v => !!v || 'Field is required']"
                      label="Subjects"
                      :items="subjects"
                      :item-text="subjects => subjects.subject_name"
                      :item-value="subjects => subjects.subject_name"
                      v-model="teachers_items.major_subject"
                      prepend-icon="mdi-pencil"
                    ></v-autocomplete>
                    <v-autocomplete
                      :rules="[v => !!v || 'Field is required']"
                      label="Rooms"
                      :items="rooms"
                      :item-text="rooms => rooms.room_name"
                      :item-value="rooms => rooms.room_name"
                      v-model="teachers_items.room_name"
                      prepend-icon="mdi-pencil"
                    ></v-autocomplete>
                      <v-text-field
                      :rules="[v => !!v || 'Field is required']"
                        label="Phone Number"
                        type="number"
                        maxlength = "11"
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                        onkeydown="javascript: 
                        return event.keyCode == 69 ? false : true"
                        v-model="teachers_items.contact_number"
                        prepend-icon="mdi-pencil"
                      ></v-text-field>
                      <v-text-field
                      :rules="[v => !!v || 'Field is required']"
                        label="Email"
                        v-model="teachers_items.email"
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
         { text: "First name", value: "first_name" },
         { text: "Middle name", value: "middle_name" },
         { text: "Last name", value: "last_name" },   
         { text: "Position", value: "position" },
         { text: "Room", value: "room_name"},
        { text: "Major Subject", value: "major_subject" },
         { text: "Contact Number", value: "contact_number" },
         { text: "Email", value: "email" },
        { text: "Actions", value: "actions", sortable: false, align: "right" },
      ],
      search:"",
      subjects: [],
      teachers: [],
      rooms: [],
      teachers_items:{
            first_name:"",
            middle_name:"",
            last_name:"",
            position:"",
            major_subject:"",
            room_name:"",
            contact_number:"",
            email:"",
      },
      editedIndex: -1,
      defaultItem: {  
            first_name:"",
            middle_name:"",
            last_name:"",
            position:"",
            major_subject:"",
            room_name:"",
            contact_number:"",
            email:"",
      },
      id:null,
      valid: false,
   
   
   
    }),
    computed: {
      formTitle() {
        return this.editedIndex === -1 ? "New teacher" : "Edit teacher";
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
        this.TeacherList();
        this.subjectList();
        this.roomList();
      },
      async roomList() {
        var res = await axios.get("/rooms");
        if (res.status === 200 && res.data) this.rooms = res.data;
        console.log(res.data);
      },
      async subjectList() {
            var res = await axios.get("/subjects");
            if (res.status === 200 && res.data) this.subjects = res.data;
            console.log(res.data);
          },
      async TeacherList() {
        var res = await axios.get("/teachers");
        if (res.status === 200) {
          this.teachers = res.data;
        console.log(res.data);
        }else {
          this.$Notice.error({
            title: "Error",
            desc: "Error occurred while loading data",
          });
        }
      },
      editItem(item) {
        this.id = item.id;
        this.editedIndex = this.teachers.indexOf(item);
        this.teachers_items = Object.assign({}, item);
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
        var res = await axios.delete("/teachers/delete/" + this.id);
        if (res.status === 200) {
          this.TeacherList();
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
          this.teachers_items = Object.assign({}, this.defaultItem);
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
              .put("/teachers/update/" + this.id, this.teachers_items)
              .then((response) => {
                this.TeacherList();
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
              .post("/teachers/create", this.teachers_items)
              .then((response) => {
                this.TeacherList();
                this.close();
                window.location.reload();
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