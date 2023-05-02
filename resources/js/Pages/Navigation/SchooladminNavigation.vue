<template>
    <main>
      <v-card height="100vh">
        <v-layout>
          <v-navigation-drawer  clipped permanent>
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
            <img src="./img/teacher.png">
              </v-list-item-avatar>
            </v-list-item>
            <v-list-item to="/teacher_profile">
              <v-list-item-content>
                <v-list-item-title class="text-h6">
                  {{ userName }}
                </v-list-item-title>
                <v-list-item-subtitle>{{ email }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
            <v-divider></v-divider>
            <v-list nav dense>
  <v-list-item to="/school_admin_dashboard">
    <v-list-item-icon>
      <v-icon color="primary">mdi-view-dashboard</v-icon>
    </v-list-item-icon>
    <v-list-item-title class="text-uppercase">Dashboard</v-list-item-title>
  </v-list-item>
  <v-divider></v-divider>
  <v-list-item-group>
    <v-list-item to="/subject_group">
      <v-list-item-icon>
        <v-icon color="indigo">mdi-book-open-page-variant</v-icon>
      </v-list-item-icon>
      <v-list-item-title class="text-uppercase">Subjects</v-list-item-title>
    </v-list-item>
    <v-list-item to="/room_group">
      <v-list-item-icon>
        <v-icon color="blue">mdi-door-open</v-icon>
      </v-list-item-icon>
      <v-list-item-title class="text-uppercase">Rooms</v-list-item-title>
    </v-list-item>
  </v-list-item-group>
  <v-divider></v-divider>
  <v-divider></v-divider>
  <v-list-item-group>
  <v-list-item to="/classes">
    <v-list-item-icon>
      <v-icon color="orange">mdi-school-outline</v-icon>
    </v-list-item-icon>
    <v-list-item-title class="text-uppercase">Classes</v-list-item-title>
  </v-list-item>
  <v-list-item to="/buildings">
    <v-list-item-icon>
      <v-icon color="deep-orange">mdi-home-city-outline</v-icon>
    </v-list-item-icon>
    <v-list-item-title class="text-uppercase">Buildings</v-list-item-title>
  </v-list-item>
  <v-list-item to="/student_information_teacher">
    <v-list-item-icon>
      <v-icon color="indigo darken-2">mdi-account-multiple-outline</v-icon>
    </v-list-item-icon>
    <v-list-item-title class="text-uppercase">Student Information</v-list-item-title>
  </v-list-item>
        <!-- Announcement Information -->
        <v-list-item to="/announcement_information">
        <v-list-item-icon>
          <v-icon color="purple">mdi-bullhorn</v-icon>
        </v-list-item-icon>
        <v-list-item-title class="text-uppercase">Announcement Information</v-list-item-title>
      </v-list-item>
  </v-list-item-group>
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
    })
    .catch(error => {
        console.error(error);
        if (error.response.status === 401) {
            window.location.href = '/'; // Redirect to login page
        }
    });
},
  name: 'SchooladminNavigation',
  components: {},
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

