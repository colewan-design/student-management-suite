<template>
  <v-card height="100%">
    <v-layout>
      <parent-navigation></parent-navigation>
  <v-main>
    <v-toolbar color="primary" dark>
      <v-toolbar-title>D O C U M E N T S</v-toolbar-title>
    </v-toolbar>

    <v-container>
  <v-card class="mx-auto">
    <v-card-title class="d-flex justify-space-between">
      <h3>Sample File Uploading</h3>
      <v-btn color="primary">
        <v-icon left>mdi-format-list-bulleted</v-icon>
        File List
      </v-btn>
    </v-card-title>
    <v-divider></v-divider>
    <v-form @submit.prevent="submitFile">
      <v-row>
        <v-col cols="6">
         
          <v-file-input label="Upload File Here" v-model="file" accept="image/*" required></v-file-input>
        </v-col>
      </v-row>
      <v-btn type="submit" color="success" class="mt-2" block>
        Submit
      </v-btn>
    </v-form>
  </v-card>
</v-container>


  </v-main>
  </v-layout>
  
  <!-- Success modal -->
  <v-dialog v-model="dialog" max-width="500">
    <v-card>
      <v-card-title class="text-center">File uploaded successfully!</v-card-title>
      <v-card-text>
        <p>File name: {{ uploadedFileName }}</p>
        <p>File size: {{ uploadedFileSize }}</p>
      </v-card-text>
      <v-card-actions>
        <v-btn color="success" text @click="dialog = false">OK</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
   <!-- Success snackbar -->
   <v-snackbar v-model="snackbar" :timeout="timeout" :color="color" top>{{ message }}</v-snackbar>

  </v-card>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      snackbar: false,
      file: null,
      files: [],
      uploadedFileName: null,
      uploadedFileSize: null,
      message: '',
      color: '',
      timeout: 3000,
      account_id: null, // Declare the account_id variable and initialize it with a default value 
    };
  },
  mounted() {
    this.getFiles();
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
    createFile() {
      this.dialog = true;
    },
    submitFile() {
  const formData = new FormData();
  const fileExtension = this.file.name.split('.').pop();
  this.uploadedFileName = `${this.account_id}_parent.${fileExtension}`;
  this.account_id = `${this.account_id}`;
  formData.append('file', this.file, this.uploadedFileName);
  formData.append('file_name', this.uploadedFileName);
  formData.append('file_size', this.file.size);
  formData.append('account_id', this.account_id);
  axios.post('/files/create', formData)
    .then(response => {
      console.log(response.data);
      this.message = 'File uploaded successfully!';
      this.snackbar = true;
      this.getFiles();
    })
    .catch(error => {
      console.error(error);
    });
},

    deleteFile(id) {
      // Handle file deletion logic here
    },
    getFiles() {
      axios.get('/files')
        .then(response => {
          this.files = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>