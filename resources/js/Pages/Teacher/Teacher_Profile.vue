<style>
  .my-toolbar{
    margin-bottom: 20px;
  }
  .profile-card {
    background-color: #FFFFFF;
    border: 1px solid #E0E0E0;
    border-radius: 4px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.05);
    margin-bottom: 20px;
    padding: 24px;
  }
  .profile-card__title {
    color: #2E2E2E;
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 8px;
  }
  .profile-card__subtitle {
    color: #8E8E8E;
    font-size: 14px;
    margin-bottom: 16px;
  }
  .profile-card__text {
    color: #2E2E2E;
    font-size: 16px;
    margin-bottom: 8px;
  }
</style>
<template>
  <v-container fluid>
    <v-row>
      <teacher-navigation></teacher-navigation>
      <v-col>
        <v-toolbar color="primary" dark>
          <v-toolbar-title>Teacher's Profile</v-toolbar-title>
        </v-toolbar>
        <v-container>
      <v-row>
        <v-col cols="12" sm="6">
          <v-card class="profile-card">
            <v-card-title class="profile-card__title">Complete Name</v-card-title>
            <v-card-text class="profile-card__subtitle">{{ userName }}</v-card-text>
            <v-divider></v-divider>
            <v-card-title class="profile-card__title">Email</v-card-title>
            <v-card-text class="profile-card__subtitle">{{ email }}</v-card-text>
            <v-divider></v-divider>
            <v-card-title class="profile-card__title">Contact Number</v-card-title>
            <v-card-text class="profile-card__subtitle">{{ contact_number }}</v-card-text>
          </v-card>
        </v-col>

        <v-col cols="12" sm="6">
          <v-card class="profile-card">
            <v-card-title class="profile-card__title">Account ID</v-card-title>
            <v-card-text class="profile-card__subtitle">{{ account_id }}</v-card-text>
            <v-divider></v-divider>
            <v-card-title class="profile-card__title">Position</v-card-title>
            <v-card-text class="profile-card__subtitle">{{ position }}</v-card-text>
          </v-card>
        </v-col>

      </v-row>
    </v-container>

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
      userName: '',
      email: '',
      contact_number: '',
      dialog: false,
      account_id: null, // Declare the account_id variable and initialize it with a default value
      position: null
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
        this.contact_number = response.data.contact_number;

        // Call the function to fetch the position after you've retrieved the account_id from the API
        this.fetchPosition();
    })
    .catch(error => {
        console.error(error);
        if (error.response.status === 401) {
            window.location.href = '/'; // Redirect to login page
        }
    });
  },
  methods: {
    fetchPosition() {
      const authToken = localStorage.getItem('auth_token');
      axios.get(`/teachers/${this.account_id}`, {
        headers: {
          'Authorization': `Bearer ${authToken}`
        }
      })
      .then(response => {
        this.position = response.data.position;
      })
      .catch(error => {
        console.error(error);
      });
    }
    
  }

};
</script>
