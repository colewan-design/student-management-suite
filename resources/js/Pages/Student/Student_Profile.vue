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
      <student-navigation></student-navigation>
      <v-col>
        <v-toolbar color="primary" dark>
          <v-toolbar-title>Student's Profile</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-btn color="success" @click="downloadExcel">Download Excel</v-btn>
          <v-btn color="warning" @click="downloadPDF">Download PDF</v-btn>
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
      
            
          </v-card>
        </v-col>

        <v-col cols="12" sm="6">
          <v-card class="profile-card">
            <v-card-title class="profile-card__title">Account ID</v-card-title>
            <v-card-text class="profile-card__subtitle">{{ account_id }}</v-card-text>
            <v-divider></v-divider>
            <v-card-title class="profile-card__title">Contact Number</v-card-title>
            <v-card-text class="profile-card__subtitle">{{ contact_number }}</v-card-text>
          </v-card>
        </v-col>

      </v-row>
    </v-container>

  </v-col>
</v-row>
</v-container>
</template>
    
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

    })
    .catch(error => {
        console.error(error);
        if (error.response.status === 401) {
            window.location.href = '/'; // Redirect to login page
        }
    });
  },
  methods: {
    downloadPDF() {
    const authToken = localStorage.getItem('auth_token');
    const account_id = this.account_id ?? '';
    const queryParams = `?account_id=${account_id}`; // Add this to the URL
    axios.get(`/students/profilepdf${queryParams}`, {
    headers: {
      'Authorization': `Bearer ${authToken}`
    },
    responseType: 'blob'
    })

    .then(response => {
      const url = window.URL.createObjectURL(new Blob([response.data]));
      const link = document.createElement('a');
      link.href = url;
      link.setAttribute('download', 'students.pdf');
      document.body.appendChild(link);
      link.click();
    })
    .catch(error => {
      console.error(error);
      if (error.response.status === 401) {
        window.location.href = '/'; // Redirect to login page if user is unauthorized
      }
    });
  },
  downloadExcel() {
    const authToken = localStorage.getItem('auth_token');
    const accountId = this.account_id ?? '';
    const url = `/student-profile-export/${accountId}`;
    console.log('authToken:', authToken);
    console.log('url:', url);
    axios.get(url, {
        headers: {
            'Authorization': `Bearer ${authToken}`
        },
        responseType: 'blob'
    })
    .then(response => {
        console.log('response:', response);
        const url = window.URL.createObjectURL(new Blob([response.data]));
        const link = document.createElement('a');
        link.setAttribute('download', `student_profile_${accountId}.xlsx`);
        link.href = url;
        document.body.appendChild(link);
        link.click();
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
