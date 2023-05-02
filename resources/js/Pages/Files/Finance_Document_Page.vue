<template>
  <v-card height="100%">
    <v-layout>
      <finance-navigation></finance-navigation>
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
  
  </v-card>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      dialog: false,
      file: null,
      files: [],
      uploadedFileName: null,
      uploadedFileSize: null,
    };
  },
  mounted() {
    this.getFiles();
  },
  methods: {
    createFile() {
      this.dialog = true;
    },
    submitFile() {
      const formData = new FormData();
      formData.append('file', this.file, this.fileName);

      // Set the uploaded file name
      this.uploadedFileName = this.file.name;

      const reader = new FileReader(); // Create a new FileReader object
      reader.readAsDataURL(this.file); // Read the selected file as a Data URL

      // When the file is loaded, set the uploaded file size
      reader.onload = () => {
        this.uploadedFileSize = this.file.size;
      };

      axios.post('/files/create', formData)
        .then(response => {
          console.log(response.data);
          this.dialog = true;
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