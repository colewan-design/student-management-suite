<template>
    <v-container fluid>
      <v-card class="p-2">
        <v-row class="d-flex justify-space-between">
          <v-col cols="8">
            <h3>Image List</h3>
          </v-col>
          <v-col cols="4">
            <v-btn color="primary" @click="storeImage">
              <v-icon left>mdi-plus</v-icon>
              New Image
            </v-btn>
          </v-col>
        </v-row>
        <v-divider class="my-1"></v-divider>
        <v-row>
          <v-col v-for="(image, index) in images" :key="index" cols="3" class="mt-2">
            <v-card>
              <v-img :src="require(`@/${image.images}`)" height="100" alt="image"></v-img>
            </v-card>
            <h6>{{ index + 1 }}.<u>{{ image.title }}</u></h6>
          </v-col>
        </v-row>
      </v-card>
    </v-container>
  </template>
  
  <script>
  export default {
    data() {
      return {
        images: []
      };
    },
    created() {
      // Fetch images from the server using an API call
      // Assign the response to the images data property
    },
    methods: {
      storeImage() {
        // Navigate to the create image page using Vue Router
      }
    }
  };
  </script>
  