<style>
  .my-toolbar {
    margin-bottom: 20px;
  }
  
  .dashboard-card {
  height: 150px; /* Update the height as per your requirement */
  width: 100%;
  font-size: 18px;
  padding: 10px;
  border-radius: 50%; /* Make the border-radius 50% to make the card circular */
  box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
  text-align: left;
  display: flex;
  justify-content: center;
  align-items: center;
}

  
  .dashboard-card:hover {
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
    transform: translateY(-5px);
  }
  
  .dashboard-card span {
    font-weight: 500;
  }
</style>
<template>
  <v-container fluid>
    <v-row>
      <student-navigation></student-navigation>
      <v-col>
        <v-toolbar class="my-toolbar">
          <v-toolbar-title>Student Dashboard</v-toolbar-title>
        </v-toolbar>
        <v-row>
          <v-col cols="12" sm="6" md="4">
            <v-list-item to="/student_attendance_grade">
              <v-btn class="dashboard-card" color="primary">
                <v-icon class="mr-2">mdi-school</v-icon>
                <span>Academic Status</span>
              </v-btn>
            </v-list-item>
          </v-col>
          <v-col cols="12" sm="6" md="4">
            <v-list-item to="/student_schedule">
              <v-btn class="dashboard-card" color="primary">
                <v-icon class="mr-2">mdi-calendar-clock</v-icon>
                <span>Schedule</span>
              </v-btn>
            </v-list-item>
          </v-col>
          <v-col cols="12" sm="6" md="4">
            <v-list-item to="/student_payment">
              <v-btn class="dashboard-card" color="primary">
                <v-icon class="mr-2">mdi-currency-usd</v-icon>
                <span>Payments</span>
              </v-btn>
            </v-list-item>
          </v-col>
          <v-col cols="12" sm="6" md="4">
            <v-list-item to="/student_activities">
              <v-btn class="dashboard-card" color="primary">
                <v-icon class="mr-2">mdi-play-circle</v-icon>
                <span>New Activities</span>
              </v-btn>
            </v-list-item>
          </v-col>
          <v-col cols="12" sm="6" md="4">
            <v-list-item to="/student_attendance">
              <v-btn class="dashboard-card" color="primary">
                <v-icon class="mr-2">mdi-account-check</v-icon>
                <span>Attendance</span>
              </v-btn>
            </v-list-item>
          </v-col>
          <v-col cols="12" sm="6" md="4">
            <v-list-item to="/student_files">
              <v-btn class="dashboard-card" color="primary">
                <v-icon class="mr-2">mdi-file-multiple</v-icon>
                <span>My Files</span>
              </v-btn>
            </v-list-item>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
  </v-container>
</template>
  
  <script>
  export default {
    components:{
      StudentNavigation: StudentNavigation,
    },
  };
  </script>
  <script>
  export default {
    methods: {
          logout() {
          // Your logout implementation here
    
          // Redirect to the login page
          this.$router.push('/login');
        },
      },
  }
  </script>
  <style>
.dashboard-card {
  padding: 20px;
  width: 100%;
  text-align: left;
}

.dashboard-card:hover {
  background-color: #eeeeee;
  cursor: pointer;
}
</style>