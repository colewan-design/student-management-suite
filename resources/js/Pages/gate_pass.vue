<template>
    <v-app>
      <v-img src="/images/gate_pass_bg.jpg" :aspect-ratio="16/9">
        <v-container fluid class="fill-height">
          <v-row align="center" justify="center" class="fill-height">
            <v-col cols="12" sm="8" md="6">
              <v-card class="elevation-12">
                <v-card-title class="text-uppercase font-weight-bold white--text">
                  Gate Pass System
                </v-card-title>
                <v-card-text>
                  <v-form @submit.prevent="login">
                    <v-text-field
                      v-model="id"
                      label="ID Number"
                      type="number"
                      outlined
                      dense
                      required
                    ></v-text-field>
                    <v-btn
                      type="submit"
                      color="primary"
                      class="mt-4"
                      block
                      large
                    >
                      Submit Pass
                    </v-btn>
                  </v-form>
                </v-card-text>
              </v-card>
            </v-col>
          </v-row>
        </v-container>
      </v-img>
    </v-app>
  </template>
  
  <script>
  export default {
    data() {
      return {
        id: null,
      };
    },
    methods: {
      login() {
        // Implement your login logic here
        console.log('Logged in with ID number:', this.id);
      },
    },
  };
  </script>
  
  <style>
  .text-uppercase {
    text-transform: uppercase;
  }
  .font-weight-bold {
    font-weight: bold;
  }
  
  /* Background image styles */
  .v-image__image {
    filter: brightness(0.7);
  }
  
  /* Card styles */
  .elevation-12 {
    background-color: white;
    padding: 32px;
    border-radius: 8px;
  }
  
  /* Button styles */
  .v-btn {
    text-transform: none;
    font-weight: bold;
    border-radius: 9999px;
  }
  
  /* Form field styles */
  .v-text-field {
    background-color: white;
    border-radius: 8px;
  }
  </style>
  