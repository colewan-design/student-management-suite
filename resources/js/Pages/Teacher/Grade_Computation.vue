<template>
  <v-container fluid>
    <v-row>
      <teacher-navigation />
      <v-col> 
        <v-toolbar color="primary" dark>
          <v-toolbar-title>Student Grade Computation</v-toolbar-title>
        </v-toolbar>
        <v-container>
          <v-snackbar v-model="successSnackbar" color="success">{{ successMessage }}</v-snackbar>
   
          <v-row>
            <v-col>
              <v-card-title>Student Lists</v-card-title>
              <v-card-text>
                <v-row>
                  <v-col cols="12" md="4">
                    <v-select
                      label="Select a student"
                      v-model="selectedStudent"
                      :items="students"
                      :item-text="item => `${item.first_name} ${item.middle_name} ${item.last_name}`"
                      item-value="account_id"
                      @change="onStudentSelect"
                    ></v-select>
                  </v-col>
                </v-row>
              </v-card-text>
            </v-col>
            <v-col>
              <v-card-title>Subject Lists</v-card-title>
              <v-card-text>
                <v-row>
                  <v-col cols="12" md="4">
                    <v-select
                      label="Select subject"
                      v-model="selectedSubject"
                      :items="subjects"
                      :item-text="item => `${item.subject_name} ${item.grade}`"
                      item-value="subject_id"
                      @change="checkStudentGrades(selectedStudent, selectedSubject)"
                    ></v-select>
                  </v-col>
                </v-row>
              </v-card-text>
            </v-col>
          </v-row>
          <v-divider></v-divider>
          <v-row>
            <v-col>
              <v-text-field
                v-model="first_grading"
                label="First Grading"
              ></v-text-field>
            </v-col>
            <v-col>
              <v-text-field
                v-model="second_grading"
                label="Second Grading"
              ></v-text-field>
            </v-col>
            <v-col>
              <v-text-field
                v-model="third_grading"
                label="Third Grading"
              ></v-text-field>
            </v-col>
            <v-col>
              <v-text-field
                v-model="fourth_grading"
                label="Fourth Grading"
              ></v-text-field>
            </v-col>
           
          </v-row>
          <v-row>
            <v-col>
              <v-btn @click="saveRecord" :disabled="gradesExist">Save Record</v-btn>
              <v-btn @click="editRecord" :disabled="!gradesExist">Edit Record</v-btn>
            </v-col>
          </v-row>
         
        </v-container>
      </v-col>
    </v-row>
  </v-container>
</template>


<script>
import TeacherNavigation from "../Navigation/TeacherNavigation.vue";
export default {
  data() {
    return {
      selectedStudent: { account_id: null }, // add default value for selectedStudent
      selectedSubject: null,
      successSnackbar: false,
      successMessage: 'Record saved successfully!',
      gradesExist: false,
      headers: [
        { text: 'Grading', value: 'grading' },
        { text: 'Grade', value: 'grade' },
      ],
      students: [],
      subjects: [],
      first_grading: '',
      second_grading: '',
      third_grading: '',
      fourth_grading: '',
    };
  },
  mounted() {
    this.loadStudents();
    this.loadSubjects();
    this.checkStudentGrades(this.selectedStudent.account_id);
  },
  components:{
    TeacherNavigation: TeacherNavigation,
  },
  methods: {
    onStudentSelect() {
        this.checkStudentGrades(this.selectedStudent, this.selectedSubject);
      },
      checkStudentGrades(accountId, subjectId) {
        if (accountId !== null && subjectId !== null) {
          axios.post(`/student_grades/checkStudentGrades/${accountId}/${subjectId}`)
            .then(response => {
              const exists = response.data.exists;
              this.gradesExist = exists; // set the flag based on the response
            })
            .catch(error => {
              console.error(error);
            });
        }
      },

    editRecord() {
    const authToken = localStorage.getItem('auth_token');
    axios.post('/student_grades/update', {
      student_id: this.selectedStudent,
      subject_id: this.selectedSubject,
      first_grading: this.first_grading,
      second_grading: this.second_grading,
      third_grading: this.third_grading,
      fourth_grading: this.fourth_grading,
    }, {
      headers: {
        'Authorization': `Bearer ${authToken}`
      }
    })
    .then(response => {
      // Handle success
      console.log(response);
      this.successMessage = 'Updated successfully!';
      this.successSnackbar = true;
    })
    .catch(error => {
      // Handle error
      console.error(error);
      if (error.response.status === 401) {
        window.location.href = '/'; // Redirect to login page if user is unauthorized
      }
    });
  },

    checkStudentGrades(accountId, subjectId) {
  if (accountId !== null && subjectId !== null) {
    axios.post(`/student_grades/checkStudentGrades/${accountId}/${subjectId}`)
      .then(response => {
        const exists = response.data.exists;
        this.gradesExist = exists; // set the flag based on the response
      })
      .catch(error => {
        console.error(error);
      });
  }
},



    saveRecord() {
      
      const authToken = localStorage.getItem('auth_token');
      axios.post('/student_grades/store', {
        student_id: this.selectedStudent,
        subject_id: this.selectedSubject,
        first_grading: this.first_grading,
        second_grading: this.second_grading,
        third_grading: this.third_grading,
        fourth_grading: this.fourth_grading,
      }, {
        headers: {
          'Authorization': `Bearer ${authToken}`
        }
      })
      .then(response => {
        // Handle success
        console.log(response);
        this.successSnackbar = true; // Display success snackbar
      })
      .catch(error => {
        // Handle error
        console.error(error);
        if (error.response.status === 401) {
          window.location.href = '/'; // Redirect to login page if user is unauthorized
        }
      });
    },
    loadStudents() {
      const authToken = localStorage.getItem('auth_token');
      axios.get('/students/students?_limit=1000', {
        headers: {
          'Authorization': `Bearer ${authToken}`
        }
      })
      .then(response => {
        this.students = response.data;
      })
      .catch(error => {
        console.error(error);
        if (error.response.status === 401) {
          window.location.href = '/'; // Redirect to login page if user is unauthorized
        }
      });
    },
    loadSubjects() {
      const authToken = localStorage.getItem('auth_token');
      axios.get('/subjects/subjects', {
        headers: {
          'Authorization': `Bearer ${authToken}`
        }
      })
      .then(response => {
        this.subjects = response.data;
      })
      .catch(error => {
        console.error(error);
        if (error.response.status === 401) {
          window.location.href = '/'; // Redirect to login page if user is unauthorized
        }
      });
    },
  }
};
</script>
