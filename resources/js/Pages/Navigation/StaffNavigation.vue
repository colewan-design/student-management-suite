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
          <v-list-item-avatar>
            <v-img src="https://randomuser.me/api/portraits/women/85.jpg"></v-img>
          </v-list-item-avatar>
        </v-list-item>
        <v-list-item link>
          <v-list-item-content>
            <v-list-item-title class="text-h6">
              {{ userName }}
            </v-list-item-title>
            <v-list-item-subtitle>{{ email }}</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
      
  
        <v-divider></v-divider>
  
        <v-list
      nav
      dense
    >
     <!--Staff's Dasboard-->
     
     <v-list-item to="/staff_dashboard">
        <v-list-item-icon>
          <v-icon>mdi-domain</v-icon>
        </v-list-item-icon>
        <v-list-item-title>Staff Dashboard</v-list-item-title>
      </v-list-item>

     <v-list-item to="/school_admin_dashboard">
        <v-list-item-icon>
          <v-icon>mdi-shield-crown-outline</v-icon>
        </v-list-item-icon>
        <v-list-item-title>School Admin Dashboard</v-list-item-title>
      </v-list-item> 

     <v-list-item to="/finance_officer_dashboard">
        <v-list-item-icon>
          <v-icon>mdi-finance</v-icon>
        </v-list-item-icon>
        <v-list-item-title>Finance Officer Dashboard</v-list-item-title>
      </v-list-item>

      <v-list-item to="/guard_dashboard">
        <v-list-item-icon>
          <v-icon>mdi-shield-account</v-icon>
        </v-list-item-icon>
        <v-list-item-title>Guard Dashboard</v-list-item-title>
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


  name: 'StaffNavigation',
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