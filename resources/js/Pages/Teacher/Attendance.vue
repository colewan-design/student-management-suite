<style>
.my-toolbar{
  margin-bottom: 20px;
}
</style>
<template>
    
    <v-container fluid>
      <v-row>
          <teacher-navigation />
       
        <v-col>
          <v-toolbar color="primary" class="my-toolbar" dark>
            <v-snackbar v-model="successSnackbar" color="success">{{ successMessage }}</v-snackbar>
            <v-toolbar-title>Student Attendance</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-menu offset-y>
              <template v-slot:activator="{ on }">
                <v-btn text v-on="on">{{ selectedDate }}</v-btn>
              </template>
              <v-date-picker v-model="selectedDate" no-title scrollable>
                <v-spacer></v-spacer>
                <v-btn text color="primary" @click="menu = false">Cancel</v-btn>
                <v-btn text color="primary" @click="menu = false">OK</v-btn>
              </v-date-picker>
            </v-menu>
          </v-toolbar>
          <v-data-table :headers="headers" :items="students" :search="search" hide-default-footer>
            <template v-slot:top>
              <v-row>
                <v-col cols="12" md="4">
                  <v-text-field v-model="search" label="Search" clearable></v-text-field>
                </v-col>
                <v-col cols="12" md="8" class="d-flex justify-end">
                    <v-btn color="primary" @click="submitAttendance">Save Attendance</v-btn>
                  <v-btn color="primary" @click="markAllPresent">Mark All Present</v-btn>
                  <v-btn color="primary" @click="markAllAbsent">Mark All Absent</v-btn>
                </v-col>
              </v-row>
            </template>
            <template v-slot:item.present="{ item }">
                <v-switch v-model="item.present" :disabled="item.locked"></v-switch>
                </template>
          </v-data-table>
        </v-col>
      </v-row>
    </v-container>
  </template>
  
  
  
<script>
export default {
  components:{
    TeacherNavigation: TeacherNavigation,
  },
};
</script>
<script>
import axios from 'axios';

export default {
  data() {
    return {
      successSnackbar: false,
      selectedDate: new Date().toISOString().substr(0, 10),
      search: '',
      headers: [
        { text: 'First Name', value: 'first_name' },
        { text: 'Middle Name', value: 'middle_name' },
        { text: 'Last Name', value: 'last_name' },
        { text: 'Present', value: 'present', sortable: false },
        ],

      students: [],
    };
  },
  computed: {
    selectedDateString() {
      return new Date(this.selectedDate).toLocaleDateString();
    },
  },
  methods: {
    submitAttendance() {
    const authToken = localStorage.getItem('auth_token');
    const date = this.selectedDate;
    const students = this.students.map((student) => {
        return {
        id: student.account_id,
        present: student.present,
        };
    });

    axios.post('/attendance/saveAttendance', { date, students }, {
        headers: {
        'Authorization': `Bearer ${authToken}`
        }
    })
    .then(response => {
      
        console.log(response.data);
        this.successMessage = 'Saved successfully!';
      this.successSnackbar = true; // Display success snackbar
    })
    .catch(error => {
        console.error(error);
    });
    },

    loadStudents() {
  const authToken = localStorage.getItem('auth_token');
  axios.get('/students/students', {
    headers: {
      'Authorization': `Bearer ${authToken}`
    }
  })
  .then(response => {
    this.students = response.data.map(student => ({
      ...student,
        present: true, // Add the present key and set its default value to true
        }));
    })
    .catch(error => {
        console.error(error);
        if (error.response.status === 401) {
        window.location.href = '/'; // Redirect to login page if user is unauthorized
        }
    });
    },

    markAllPresent() {
      this.students.forEach((student) => {
        if (!student.locked) {
          student.present = true;
        }
      });
    },
    markAllAbsent() {
      this.students.forEach((student) => {
        if (!student.locked) {
          student.present = false;
        }
      });
    },
  },
  mounted() {
    this.loadStudents();
  },
};
</script>

  