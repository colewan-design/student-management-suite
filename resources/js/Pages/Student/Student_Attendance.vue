<template>
  <v-container fluid>
    <v-row>
      <student-navigation></student-navigation>
      <v-col>
        <v-toolbar>
          <v-toolbar-title>Attendance</v-toolbar-title>
        </v-toolbar>
          <v-row>
            <v-col cols="12">
              <v-card>
                <v-card-title>Attendance</v-card-title>

                <v-data-table
                  :headers="attendancesHeaders"
                  :items="attendancesData"
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
      account_id: null,
      attendancesData: [],
      attendancesHeaders: [
        { text: 'Student ID', value: 'student_id' },
        { text: 'Status', value: 'status' },
        { text: 'Date', value: 'date' },
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
        this.fetchAttendances();
      })
      .catch(error => {
        console.error(error);
        if (error.response.status === 401) {
          window.location.href = '/';
        }
      });
  },
  methods: {
fetchAttendances() {
  const authToken = localStorage.getItem('auth_token');
  axios.get(`/attendance/getAttendance?account_id=${this.account_id}`, {
    headers: {
      'Authorization': `Bearer ${authToken}`
    }
  })
  .then(response => {
    this.attendancesData = response.data.attendances; // set attendancesData to response.data.attendances
  })
  .catch(error => {
    console.error(error);
  });
}


  }
};
</script>
