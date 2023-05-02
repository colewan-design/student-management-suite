<template>
    <v-card height="100%">
    <v-layout>
      <student-navigation></student-navigation>
         <v-main>
      <v-toolbar>
        <v-toolbar-title>Academic Status</v-toolbar-title>
      </v-toolbar>

      <template>
        Content Here!
    </template>
    </v-main>
  </v-layout>
   </v-card>
  </template>
  
  <script>

  export default {
    components:{
      StudentNavigation: StudentNavigation,
    },
  };
  </script>
  <script>
  export default {
    methods: {
          logout() {
          // Your logout implementation here
    
          // Redirect to the login page
          this.$router.push('/login');
        },
      },
  }
  </script>