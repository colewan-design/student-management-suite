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
              <v-toolbar-title>Assign Quizzes</v-toolbar-title>
            </v-toolbar>
              <v-data-table
          :headers="headers"
          :items="assign_quizzes"
          :search="search"
          sort-by="student_id"
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
                
                     <!--  Quiz ID field -->
                     <v-card-text class="px-5">
                      <v-select
                        label="Quiz ID"
                        v-model="assign_quizzes_items.quiz_id"
                        :items="quizzes"
                        item-value="quiz_id"
                        item-text="quiz_id"
                        prepend-inner-icon="mdi-pencil"
                        ></v-select>
                    </v-card-text>
  
                     <!--  Student ID field -->
                     <v-card-text class="px-5">
                      <v-select
                        label="Student ID"
                        v-model="assign_quizzes_items.student_id"
                        :items="students"
                        item-value="account_id"
                        item-text="account_id"
                        prepend-inner-icon="mdi-pencil"
                        ></v-select>
                    </v-card-text>
  
                     <!--  Quiz Score field -->
                     <v-card-text class="px-5">
                      <v-text-field
                        label="Score"
                        v-model="assign_quizzes_items.score"
                        prepend-inner-icon="mdi-pencil"
                      ></v-text-field>
                    </v-card-text>
  
                    <!--  Quiz Status field -->
                    <v-card-text class="px-5">
                    <v-select
                      label="Quiz Status"
                      v-model="assign_quizzes_items.status"
                      :items="['Not Taken', 'Passed', 'Failed']"
                      prepend-icon="mdi-checkbox-multiple-marked-outline"
                    ></v-select>
                  </v-card-text>
  
                    <!--  Quiz Notes field -->
                    <v-card-text class="px-5">
                      <v-text-field
                        label="Notes"
                        v-model="assign_quizzes_items.notes"
                        prepend-inner-icon="mdi-pencil"
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
  import TeacherNavigation from "./components/TeacherNavigation.vue";
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
            { text: "Quiz ID", value: "quiz_id" },
            { text: "Student ID", value: "student_id" },
            { text: "Score", value: "score" },
            { text: "Status", value: "status" },
            { text: "Notes", value: "notes" },
          { text: "Actions", value: "actions", sortable: false, align: "right" },
  
           
          ],
          search:"",
          students: [],
          assign_quizzes_items:{
            student_id:"",
            quiz_id:"",
            score:"",
            status:"",
            notes:"",
                
          },
          assign_quizzes: [],
          quizzes: [],
          editedIndex: -1,
          defaultItem: {  
            student_id:"",
            quiz_id:"",
            score:"",
            status:"",
            notes:"",
               
          },
          id:null,
          valid: false,
       
       
       
        }),
        computed: {
          formTitle() {
            return this.editedIndex === -1 ? "Assign Quiz to Student" : "Edit Assigned Quiz";
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
          this.fetchStudents();
          this.fetchQuizzes();
        },
        methods: {
          async fetchStudents() {
            try {
            const response = await axios.get('/students');
            this.students = response.data;
            } catch (error) {
            console.error(error);
            }
        },
        async fetchQuizzes() {
            try {
            const response = await axios.get('/quizzes');
            this.quizzes = response.data;
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
            this.AssignQuizList();
          },
          async AssignQuizList() {
            var res = await axios.get("/assign_quizzes");
            if (res.status === 200) this.assign_quizzes = res.data;
            else {
              this.$Notice.error({
                title: "Error",
                desc: "Error occurred while loading data",
              });
            }
          },
          editItem(item) {
            this.id = item.id;
            this.editedIndex = this.assign_quizzes.indexOf(item);
            this.assign_quizzes_items = Object.assign({}, item);
            this.dialog = true;
          },
          deleteItem(item) {
            this.id = item.id;
            this.dialogDelete = true;
          },
          async deleteItemConfirm() {
            var res = await axios.delete("/assign_quizzes/delete/" + this.id);
            if (res.status === 200) {
              this.AssignQuizList();
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
              this.assign_quizzes_items = Object.assign({}, this.defaultItem);
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
                  .put("/assign_quizzes/update/" + this.id, this.assign_quizzes_items)
                  .then((response) => {
                    this.AssignQuizList();
                    this.close();
                  })
                  .catch((error) => {
                    console.error("There was an error!", error);
                  });
              } else {
                axios
                  .post("/assign_quizzes/create", this.assign_quizzes_items)
                  .then((response) => {
                    this.AssignQuizList();
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