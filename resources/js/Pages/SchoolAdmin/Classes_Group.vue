<style>
.my-toolbar{
  margin-bottom: 20px;
}
</style>
<template>
 <v-container fluid>
  <v-row>
    <schooladmin-navigation></schooladmin-navigation>
        <v-col>
            <v-toolbar>
              <v-toolbar-title>Classes</v-toolbar-title>
            </v-toolbar>
              <v-data-table
          :headers="headers"
          :items="classes"
          :search="search"
          sort-by="class_name"
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
                <!--  Class name field -->
                    <v-card-text class="px-5">
                      <v-text-field
                        label="class name"
                        v-model="classes_items.class_name"
                        prepend-inner-icon="mdi-pencil"
                      ></v-text-field>
      
                    </v-card-text>
                    <v-card-text class="px-5">
                    <v-select
                        label="Subject"
                        v-model="classes_items.subject_id"
                        :items="subjects"
                        item-value="subject_id"
                        item-text="subject_name"
                        prepend-inner-icon="mdi-pencil"
                        ></v-select>
                    </v-card-text>
                    <!-- Room ID field -->
                    <v-card-text class="px-5">
                    <v-select
                        label="Room"
                        v-model="classes_items.room_id"
                        :items="rooms"
                        item-value="room_id"
                        item-text="room_name"
                        prepend-inner-icon="mdi-pencil"
                    ></v-select>
                    </v-card-text>

                    <!-- Teacher ID field -->
                    <v-card-text class="px-5">
                        <v-select
                        label="Teacher"
                        v-model="classes_items.teacher_id"
                        :items="teachers"
                        item-value="account_id"
                        item-text="teacher_name"
                        prepend-inner-icon="mdi-pencil"
                        ></v-select>
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
import SchooladminNavigation from '../Pages/Navigation/SchooladminNavigation.vue'
    export default {
      components:{
        SchooladminNavigation: SchooladminNavigation,
      },
};
</script>
    <script>
    export default {
     
      data: () => ({
          dialog: false,
          dialogDelete: false,
          headers: [
            { text: "Class Name", value: "class_name" },
            { text: "Subject ID", value: "subject_id" },
            { text: "Room ID", value: "room_id" },
            { text: "Teacher ID", value: "teacher_id" },
          
          { text: "Actions", value: "actions", sortable: false, align: "right" },
  
           
          ],
          search:"",
          subjects: [],
          classes: [],
          rooms: [],
          teachers: [],
          classes_items:{
            class_name: '',
            subject_id: '',
            room_id: '',
            teacher_id: '',
                
          },
          editedIndex: -1,
          defaultItem: {  
            class_name:"",
            subject_id:"",
            room_id:"",
            teacher_id:"",
               
          },
          id:null,
          valid: false,
       
       
       
        }),
        computed: {
          formTitle() {
            return this.editedIndex === -1 ? "New Class" : "Edit Class";
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
          this.fetchSubjects();
          this.fetchRooms();
          this.fetchTeachers();
        },
        methods: {
            async fetchSubjects() {
            try {
            const response = await axios.get('/subjects');
            this.subjects = response.data;
            } catch (error) {
            console.error(error);
            }
        },
        async fetchRooms() {
            try {
            const response = await axios.get('/rooms');
            this.rooms = response.data;
            } catch (error) {
            console.error(error);
            }
        },
        async fetchTeachers() {
        try {
            const response = await axios.get('/teachers');
            this.teachers = response.data.map(teacher => ({
            ...teacher,
            teacher_name: `${teacher.first_name} ${teacher.middle_name} ${teacher.last_name}`
            }));
        } catch (error) {
            console.error(error);
        }
        },
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
            this.ClassList();
          },
          async ClassList() {
            var res = await axios.get("/classes");
            if (res.status === 200) this.classes = res.data;
            else {
              this.$Notice.error({
                title: "Error",
                desc: "Error occurred while loading data",
              });
            }
          },
          editItem(item) {
            this.id = item.id;
            this.editedIndex = this.classes.indexOf(item);
            this.classes_items = Object.assign({}, item);
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
            var res = await axios.delete("/classes/delete/" + this.id);
            if (res.status === 200) {
              this.ClassList();
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
              this.classes_items = Object.assign({}, this.defaultItem);
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
                  .put("/classes/update/" + this.id, this.classes_items)
                  .then((response) => {
                    this.ClassList();
                    this.close();
                  })
                  .catch((error) => {
                    console.error("There was an error!", error);
                  });
              } else {
                axios
                  .post("/classes/create", this.classes_items)
                  .then((response) => {
                    this.ClassList();
                    this.close();
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