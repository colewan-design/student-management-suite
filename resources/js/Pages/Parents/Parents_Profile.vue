<template>
    <main>
      <v-card height="100vh">
        <v-layout>
          <parent-navigation></parent-navigation>
  
          <v-main>
            <v-toolbar color="primary" dark>
              <v-toolbar-title>Parent's Profile</v-toolbar-title>
            </v-toolbar>
  
            <v-container>
              <v-row>
                <v-col cols="12" sm="6">
                  <v-card>
                    <v-card-title>Complete Name</v-card-title>
                    <v-card-text>{{ userName }}</v-card-text>
                  </v-card>
                </v-col>
  
                <v-col cols="12" sm="6">
                  <v-card>
                    <v-card-title>Email</v-card-title>
                    <v-card-text>{{ email }}</v-card-text>
                  </v-card>
                </v-col>
  
                <v-col cols="12" sm="6">
                  <v-card>
                    <v-card-title>Contact Number</v-card-title>
                    <v-card-text>{{ contact_number }}</v-card-text>
                  </v-card>
                </v-col>
              </v-row>
            </v-container>
  
          </v-main>
        </v-layout>
      </v-card>
    </main>
  </template>
    
    <script>
import ParentNavigation from "./components/ParentNavigation.vue";
export default {
  components:{
    ParentNavigation: ParentNavigation,
  },
};
</script>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      userName: '',
      email: '',
      contact_number: '',
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
        this.contact_number = response.data.contact_number;
    })
    .catch(error => {
        console.error(error);
        if (error.response.status === 401) {
            window.location.href = '/'; // Redirect to login page
        }
    });
},
};
</script>