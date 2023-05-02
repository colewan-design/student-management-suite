<template>
  <v-card height="100%">
    <v-layout>
    <guard-navigation></guard-navigation>

    <v-main>
      <v-toolbar color="primary" dark>
        <v-toolbar-title>Guard Dashboard</v-toolbar-title>
      </v-toolbar>

      <v-container>
        <v-row>
          <v-col>
            <v-card>
              <v-card-title>Profile</v-card-title>
              <v-card-text>
                <ul>
                  <li>Name: {{ userName }}</li>
                  <li>Email: {{ email }}</li>
                  <li>Role: {{ role }}</li>
                  <li>Shift: {{ shift }}</li>
                </ul>
              </v-card-text>
            </v-card>
          </v-col>

          <v-col>
            <v-card>
              <v-card-title>Documents</v-card-title>
              <v-card-text>
                <ul>
                  <li>Guard ID: {{ account_id }}</li>
                  <li>Document Type: {{ documentType }}</li>
                  <li>Status: {{ status }}</li>
                  <li>Expiration Date: {{ expirationDate }}</li>
                </ul>
              </v-card-text>
            </v-card>
          </v-col>

         

        </v-row>
        
        <div style="margin-top: 20px;"></div>
        <v-expansion-panels>

          <v-expansion-panel style="margin-bottom: 20px; background-color: cornflowerblue; color: white;">

            <v-expansion-panel-header>
              Uploaded Documents
            </v-expansion-panel-header>

            <v-expansion-panel-content>
              <ul>
                <li>Document 1</li>
                <li>Document 2</li>
                <li>Document 3</li>
              </ul>
            </v-expansion-panel-content>

          </v-expansion-panel>

        </v-expansion-panels>

      </v-container>
    </v-main>
    </v-layout>
  </v-card>
</template>


<script>
import GuardNavigation from "./components/GuardNavigation.vue";
export default {
  components:{
    GuardNavigation: GuardNavigation,
  },
};
</script>

<script>
import axios from 'axios';
export default {
  name: 'ProfileDetails',
  data() {
    return {
      account_id: '',
      documentType: 'Background Check',
      status: 'Approved',
      expirationDate: '01/01/2024',
      shift: '',
      role: '',
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
        this.role = response.data.role;
        this.account_id = response.data.account_id;
        this.shift = response.data.shift;
    })
    .catch(error => {
        console.error(error);
        if (error.response.status === 401) {
            window.location.href = '/'; // Redirect to login page
        }
    });

  }
}
</script>