<style>
  .my-toolbar {
    margin-bottom: 20px;
  }
  .card-height {
    height: 100%;
  }
  .quiz-card {
    max-width: 500px;
    margin: 0 auto;
  }
</style>

<template>
  <v-container fluid>
    <v-row>
      <student-navigation></student-navigation>
      <v-col>
        <v-toolbar color="indigo" dark>
          <v-toolbar-title>Exams and Quizzes</v-toolbar-title>
        </v-toolbar>
        <v-card v-for="quiz in quizzes" :key="quiz.id" class="my-4 quiz-card">
          <v-card-title class="indigo white--text">
            {{ quiz.title }}
          </v-card-title>
          <v-card-text>
            <p class="caption">
              {{ quiz.description }}
            </p>
            <p class="subheading">
              Link: <a :href="quiz.link">{{ quiz.link }}</a>
            </p>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
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
 <script>
 export default {
   data() {
     return {
       quizzes: []
     };
   },
   created() {
     fetch("/api/quizzes")
       .then(response => response.json())
       .then(data => (this.quizzes = data))
       .catch(error => console.error(error));
   }
 };
 </script>
  <style>
    .my-4 {
      margin-top: 2rem;
      margin-bottom: 2rem;
    }
  </style>