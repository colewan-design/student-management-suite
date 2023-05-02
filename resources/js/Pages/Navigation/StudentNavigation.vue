<style>
/* Navigation Drawer */
.nav-drawer {
  background-color: #fff;
  color: #000;
}

.nav-drawer .v-toolbar__title {
  font-size: 18px;
  font-weight: bold;
}

.nav-drawer .v-list-item__title {
  font-size: 16px;
}

.nav-drawer .v-list-item__subtitle {
  font-size: 14px;
}

.nav-drawer .v-list-item__icon {
  color: #000;
}

.nav-drawer .v-list-item--active {
  background-color: #f0f0f0;
}

/* Main content */
.main-content {
  padding: 20px;
}

/* Card */
.card {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

/* Form */
.form {
  display: grid;
  grid-template-columns: 1fr 1fr;
  grid-gap: 20px;
  margin-top: 20px;
}

.form label {
  font-weight: bold;
}

.form input {
  border: none;
  border-bottom: 1px solid #ccc;
  padding: 5px;
  font-size: 16px;
}

.form input:focus {
  outline: none;
  border-color: #00bcd4;
}

.form button {
  background-color: #00bcd4;
  color: #fff;
  border: none;
  padding: 10px;
  font-size: 16px;
  cursor: pointer;
}

.form button:hover {
  background-color: #008ba3;
}
</style>
<template>
    <main>
    <v-card height="100vh">
      <v-layout>
    <!-- Navigation Drawer -->
    <v-navigation-drawer class="nav-drawer"  clipped permanent>
      <v-toolbar color="primary" dark>
        <v-toolbar-title class="text-h6">Student Management Suite</v-toolbar-title>
       
        <v-spacer></v-spacer>
              <div>
                <v-dialog v-model="dialog" max-width="400">
                  <v-card>
                    <v-card-title class="headline">Confirm Logout</v-card-title>
                    <v-card-text>
                      Are you sure you want to logout?
                    </v-card-text>
                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn color="error" text @click="dialog = false">Cancel</v-btn>
                      <v-btn color="success" text @click="logout">Logout</v-btn>
                    </v-card-actions>
                  </v-card>
                </v-dialog>

                <v-btn icon @click="dialog = true">
                  <v-icon>mdi-logout</v-icon>
                </v-btn>
              </div>
      </v-toolbar>
      <v-list-item class="px-2">
        <v-list-item-avatar style="height: 100px; margin: 20px auto; width: 100px; display: block;">
              <img :src="profilePicture">
            </v-list-item-avatar>
        </v-list-item>
        <v-list-item to="/student_profile">
              <v-list-item-content>
                <v-list-item-title class="text-h6">
                  {{ userName }}
                </v-list-item-title>
                <v-list-item-subtitle>{{ email }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
      
  
        <v-divider></v-divider>
  
        <v-list dense>
    
    <v-divider></v-divider>
    <v-list-item to="/student_dashboard">
      <v-list-item-action>
        <v-icon>mdi-view-dashboard</v-icon>
      </v-list-item-action>
      <v-list-item-content>
        <v-list-item-title>Dashboard</v-list-item-title>
      </v-list-item-content>
    </v-list-item>
    <v-list-item to="/student_attendance_grade">
      <v-list-item-action>
        <v-icon>mdi-chart-line-variant</v-icon>
      </v-list-item-action>
      <v-list-item-content>
        <v-list-item-title>Academic Status</v-list-item-title>
      </v-list-item-content>
    </v-list-item>
    <v-list-item to="/student_schedule">
      <v-list-item-action>
        <v-icon>mdi-calendar-month</v-icon>
      </v-list-item-action>
      <v-list-item-content>
        <v-list-item-title>Schedule</v-list-item-title>
      </v-list-item-content>
    </v-list-item>
    <v-list-item to="/student_payment">
      <v-list-item-action>
        <v-icon>mdi-cash-multiple</v-icon>
      </v-list-item-action>
      <v-list-item-content>
        <v-list-item-title>Payments</v-list-item-title>
      </v-list-item-content>
    </v-list-item>
    <v-list-item to="/student_activities">
      <v-list-item-action>
        <v-icon>mdi-bullhorn</v-icon>
      </v-list-item-action>
      <v-list-item-content>
        <v-list-item-title>New Activities</v-list-item-title>
      </v-list-item-content>
    </v-list-item>
    <v-list-item to="/student_attendance">
      <v-list-item-action>
        <v-icon>mdi-account-group-outline</v-icon>
      </v-list-item-action>
      <v-list-item-content>
        <v-list-item-title>Attendance</v-list-item-title>
      </v-list-item-content>
    </v-list-item>
    <v-list-item to="/student_document_page">
      <v-list-item-action>
        <v-icon>mdi-folder-open</v-icon>
      </v-list-item-action>
      <v-list-item-content>
        <v-list-item-title>My Files</v-list-item-title>
      </v-list-item-content>
    </v-list-item>
  </v-list>
  </v-navigation-drawer>
      </v-layout>
    </v-card>
</main>
  </template>


<script>
import axios from 'axios';
export default {
  data() {
    return {
      userName: '',
      email: '',
      account_id: '',
      dialog: false,
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
        this.userName = response.data.name;
        this.email = response.data.email;
        this.account_id = response.data.account_id;
    })
    .catch(error => {
        console.error(error);
        if (error.response.status === 401) {
            window.location.href = '/'; // Redirect to login page
        }
    });
},

  name: 'StaffNavigation',
  components: {},
  computed: {
    profilePicture() {
      return `http://localhost/student-management-suite/public/images/${this.account_id}_student.png`;
    },
    // other computed properties
  },
  methods: {
    logout() {
        const authToken = localStorage.getItem('auth_token');
        axios.post('/logout', null, {
            headers: {
                'Authorization': `Bearer ${authToken}`
            },
            withCredentials: true
        })
        .then(response => {
            // handle successful logout
            window.location.href = '/';
        })
        .catch(error => {
            // handle logout error
        });
    },
},
};
</script>