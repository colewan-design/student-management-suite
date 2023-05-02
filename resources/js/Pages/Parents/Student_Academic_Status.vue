<template>
    <v-container fluid>
      <v-row>
        <parent-navigation></parent-navigation>
        <v-col>
          <v-toolbar>
            <v-toolbar-title>Attendance and Grades</v-toolbar-title>
          </v-toolbar>
            <v-row>
              <v-col cols="12">
                <v-card>
                  <v-card-title>Grades</v-card-title>
  
                  <v-data-table
                    :headers="gradesHeaders"
                    :items="gradesData"
                    hide-default-footer
                  ></v-data-table>
                </v-card>
              </v-col>
            </v-row>
          </v-col>
      </v-row>
    </v-container>
  </template>
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        account_id: null, // Declare the account_id variable and initialize it with a default value
        gradesData: [],
        gradesHeaders: [
        { text: 'Subject', value: 'subject' },
        { text: '1st Grading', value: 'first_grading' },
        { text: '2nd Grading', value: 'second_grading' },
        { text: '3rd Grading', value: 'third_grading' },
        { text: '4th Grading', value: 'fourth_grading' },
        { text: 'Calculated Grade', value: 'average' },
      ],
  
      };
    },
    mounted() {
      const authToken = localStorage.getItem('auth_token');
      axios.get('/user', {
          headers: {
              'Authorization': `Bearer ${authToken}`
          }
      })
      .then(response => {
          this.account_id = response.data.account_id;
  
          // Call the function to fetch the first_grading after you've retrieved the account_id from the API
          this.fetchGrades();
      })
      .catch(error => {
          console.error(error);
          if (error.response.status === 401) {
              window.location.href = '/'; // Redirect to login page
          }
      });
    },
    methods: {
      fetchGrades() {
    const authToken = localStorage.getItem('auth_token');
    axios.get(`/student_grades?account_id=${this.account_id}`, {
      headers: {
        'Authorization': `Bearer ${authToken}`
      }
    })
    .then(response => {
      response.data.forEach(studentGrade => {
        const grades = [
          Number(studentGrade.first_grading),
          Number(studentGrade.second_grading),
          Number(studentGrade.third_grading),
          Number(studentGrade.fourth_grading),
        ];
        const average = grades.reduce((total, grade) => total + grade, 0) / grades.length;
  
        // Add the fetched data and the average to the gradesData array
        this.gradesData.push({
          subject: studentGrade.subject_id,
          first_grading: studentGrade.first_grading,
          second_grading: studentGrade.second_grading,
          third_grading: studentGrade.third_grading,
          fourth_grading: studentGrade.fourth_grading,
          average: average.toFixed(2), // Round the average to two decimal places
        });
      });
    })
    .catch(error => {
      console.error(error);
    });
  }
  
  
  
    }
  };
  </script>
  