<style>
.my-toolbar{
  margin-bottom: 20px;
}
</style>
<template>
  <v-container fluid>
    <v-row>
      <teacher-navigation></teacher-navigation>
      <v-col>
        <v-toolbar color="primary" dark>
          <v-toolbar-title>Upload Teacher Profile Picture</v-toolbar-title>
        </v-toolbar>

        <v-card class="mx-auto">
          <v-card-title>
            <h3 class="mb-0">Upload Profile Picture</h3><br>
            <span class="grey--text">Make sure your profile picture meets our guidelines</span>
          </v-card-title>

          <v-divider></v-divider>

          <v-form @submit.prevent="submitFile">
            <v-row>
              <v-col cols="12" sm="6">
                <v-file-input label="Choose a file" v-model="file" accept="image/*" required></v-file-input>
              </v-col>
            </v-row>

            <v-btn type="submit" color="primary" class="mt-4" block>Submit</v-btn>
          </v-form>
        </v-card>

        <!-- Success snackbar -->
        <v-snackbar v-model="snackbar" :timeout="timeout" :color="color" top>{{ message }}</v-snackbar>
      </v-col>
    </v-row>
  </v-container>
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
  this.uploadedFileName = `${this.account_id}_student.${fileExtension}`;
  this.account_id = `${this.account_id}`;
  formData.append('file', this.file, this.uploadedFileName);
  formData.append('file_name', this.uploadedFileName);
  formData.append('file_size', this.file.size);
  formData.append('account_id', this.account_id);
  axios.post('/files/upload_student_image', formData)
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