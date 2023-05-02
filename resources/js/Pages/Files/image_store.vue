<template>
    <v-container>
      <v-card class="mx-auto">
        <v-card-title class="d-flex justify-space-between">
          <h3>Sample File Uploading</h3>
          <v-btn color="primary" href="/image_list">
            <v-icon left>mdi-format-list-bulleted</v-icon>
            File List
          </v-btn>
        </v-card-title>
        <v-divider></v-divider>
        <v-form @submit.prevent="onSubmit">
          <v-row>
            <v-col cols="6">
              <v-text-field label="File Title" v-model="title" required></v-text-field>
            </v-col>
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
  </template>
  
  <script>
  export default {
    data() {
      return {
        title: '',
        file: null
      }
    },
    methods: {
      onSubmit() {
        const formData = new FormData()
        formData.append('title', this.title)
        formData.append('image', this.file)
        // TODO: send the form data to the server using Axios or other HTTP client library
      }
    }
  }
  </script>
  