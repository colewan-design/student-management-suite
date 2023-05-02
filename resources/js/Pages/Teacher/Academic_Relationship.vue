<style>
.my-toolbar{
  margin-bottom: 20px;
}
</style>
<template>
 <v-container fluid>
  <v-row>
        <teacher-navigation></teacher-navigation>
        <v-col>
            <v-toolbar>
              <v-toolbar-title>Assign Students</v-toolbar-title>
            </v-toolbar>
              <v-data-table
          :headers="headers"
          :items="relationship"
          :search="search"
          sort-by="student_name"
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
                <!--  Student ID field -->
                    <v-card-text class="px-5">
                      <v-autocomplete
                      label="Student ID"
                      hide-details
                      :items="students"
                      :item-text="students => `${students.account_id}`"
                      :item-value="students => students.account_id"
                      v-model="relationship_items.student_id"
                      prepend-inner-icon="mdi-pencil"
                    ></v-autocomplete>
                    </v-card-text>
                <!--  Student name field -->
                     <v-card-text class="px-5">
                      <v-autocomplete
                      label="Student Name"
                      hide-details
                      :items="students"
                      :item-text="students => students.first_name + ' ' + students.last_name"
                      :item-value="students => students.first_name + ' ' + students.last_name"
                      v-model="relationship_items.student_name"
                      prepend-inner-icon="mdi-pencil"
                    ></v-autocomplete>
                    </v-card-text>
                     <!--  Teacher ID field -->
                     
                    <v-card-text class="px-5">
                      <v-autocomplete
                      label="Teacher ID"
                      hide-details
                      :items="teachers"
                      :item-text="teachers => teachers.account_id"
                      :item-value="teachers => teachers.account_id"
                      v-model="relationship_items.teacher_id"
                      prepend-inner-icon="mdi-pencil"
                    ></v-autocomplete>
                    </v-card-text>

                <!--  Teacher name field -->
                     <v-card-text class="px-5">
                      <v-autocomplete
                      label="Teacher Name"
                      hide-details
                      :items="teachers"
                      :item-text="teachers => teachers.first_name + ' ' + teachers.last_name"
                      :item-value="teachers => teachers.first_name + ' ' + teachers.last_name"
                      v-model="relationship_items.teacher_name"
                      prepend-inner-icon="mdi-pencil"
                    ></v-autocomplete>
                    </v-card-text>

                     <!--  Course name field -->
                     <v-card-text class="px-5">
                      <v-autocomplete
                      label="Subjects"
                      hide-details
                      :items="subject"
                      :item-text="subject => subject.subject_name"
                      :item-value="subject => subject.subject_name"
                      v-model="relationship_items.subject"
                      prepend-inner-icon="mdi-pencil"
                    ></v-autocomplete>
                    </v-card-text>

                    <v-card-text class="px-5">
                      <v-autocomplete
                      label="Grade/Level"
                      hide-details
                      :items="subject"
                      :item-text="subject => subject.grade"
                      :item-value="subject => subject.grade"
                      v-model="relationship_items.level"
                      prepend-inner-icon="mdi-pencil"
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
    import TeacherNavigation from "../Navigation/TeacherNavigation.vue";
    export default {
      components:{
        TeacherNavigation: TeacherNavigation,
      },
    };
    </script>
    <script>
    export default {
     
      data: () => ({
          dialog: false,
          dialogDelete: false,
          headers: [
            { text: "Student ID", value: "student_id" },
            { text: "Student Name", value: "student_name" },
            { text: "Teacher ID", value: "teacher_id" },
            { text: "Teacher Name", value: "teacher_name" },
            { text: "Subject", value: "subject" },
            { text: "Grade", value: "level" },
          { text: "Actions", value: "actions", sortable: false, align: "right" },
          ],
          search:"",
          subject: [],
          teachers: [],
          students: [],
          relationship: [],
          relationship_items:{
            student_id:"",
            student_name:"",
            teacher_id:"",
            teacher_name:"",
            subject:"",
            level:"",
         
                
          },
          editedIndex: -1,
          defaultItem: {  
            student_id:"",
            student_name:"",
            teacher_id:"",
            teacher_name:"",
            subject:"",
            level:"",
               
          },
          id:null,
          valid: false,
       
       
       
        }),
        computed: {
          formTitle() {
            return this.editedIndex === -1 ? "New Student-Teacher Connection" : "Edit Student-Teacher Connection";
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
          initialize() {
            this.RelationshipList();
            this.subjectList();
            this.studentList();
            this.teacherList();
          },
          async teacherList() {
            var res = await axios.get("/teachers");
            if (res.status === 200 && res.data) this.teachers = res.data;
            console.log(res.data);
          },
          async subjectList() {
            var res = await axios.get("/subjects");
            if (res.status === 200 && res.data) this.subject = res.data;
            console.log(res.data);
          },

          async studentList() {
            var res = await axios.get("/students");
            if (res.status === 200 && res.data) this.students = res.data;
            console.log(res.data);
          },

          async RelationshipList() {
            var res = await axios.get("/relationship");
            if (res.status === 200) this.relationship = res.data;
            else {
              this.$Notice.error({
                title: "Error",
                desc: "Error occurred while loading data",
              });
            }
          },
          editItem(item) {
            this.id = item.id;
            this.editedIndex = this.relationship.indexOf(item);
            this.relationship_items = Object.assign({}, item);
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
            var res = await axios.delete("/relationship/delete/" + this.id);
            if (res.status === 200) {
              this.RelationshipList();
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
              this.relationship_items = Object.assign({}, this.defaultItem);
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
                  .put("/relationship/update/" + this.id, this.relationship_items)
                  .then((response) => {
                    this.RelationshipList();
                    this.close();
                  })
                  .catch((error) => {
                    console.error("There was an error!", error);
                  });
              } else {
                axios
                  .post("/relationship/create", this.relationship_items)
                  .then((response) => {
                    this.RelationshipList();
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