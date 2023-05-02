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
          <v-toolbar>
            <v-toolbar-title>Announcements</v-toolbar-title>
          </v-toolbar>
  
            <!-- page content-->
            <v-container class="card-container">
              <v-card
                v-for="(announcement, index) in announcements"
                :key="index"
                class="mx-auto announcement-card"
                max-width="600"
              >
                <v-card-title class="text-h5">{{ announcement.title }}</v-card-title>
                <v-card-text>
                  <v-list-item-content>
                    <v-list-item-subtitle class="text-caption"
                      >{{ new Date(announcement.created_at).toLocaleString() }}</v-list-item-subtitle>
                      <v-card-text>{{ announcement.body }}</v-card-text>
                  </v-list-item-content>
                </v-card-text>
              </v-card>
            </v-container>
          </v-col>
      </v-row>
      </v-container>
    </template>

<script>
import TeacherNavigation from "./components/TeacherNavigation.vue";
export default {
components:{
  TeacherNavigation: TeacherNavigation,
},
};
</script>
  <script>
  export default {
    data() {
      return {
        quizzes: [],
        announcements: [],
        selectedItem: null,
        totalStudents: 0,
      }
    },
    created() {
      fetch("/api/students")
        .then(response => response.json())
        .then(data => {
          this.totalStudents = data.length;
        });
      fetch("/api/announcements")
        .then(response => response.json())
        .then(data => {
          this.announcements = data.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
        });
    },
    methods: {
      
    }
  }
  </script>
  
  <style scoped>
  .announcement-card {
    border: 1px solid #ccc;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
  }
  .announcement-card:hover {
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
  }
  .announcement-card .text-h5 {
    font-weight: bold;
    font-size: 24px;
    margin-bottom: 10px;
  }
  .announcement-card .text-caption {
    color: #999;
    font-size: 14px;
    margin-bottom: 10px;
  }
  .announcement-card .v-list-item-subtitle {
    font-size: 16px;
  }
</style>