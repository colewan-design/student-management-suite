<template>
  <v-card height="100%">
    <v-layout>
      <schooladmin-navigation></schooladmin-navigation>


  <v-main>
    <v-toolbar color="primary" dark>
      <v-toolbar-title>School Admin Dashboard</v-toolbar-title>
    </v-toolbar>

    <div style="margin-top: 20px;"></div>

    <div style="margin-left: 20px; margin-right: 20px;">
      <v-layout row wrap>
        <v-flex xs12 md4>
          <v-container>
            <v-card style="background-color: coral; color: white;">
              <v-card-title>Total Number of Students</v-card-title>
              <div style="margin-top: 5px;"></div>
              <v-card-text style="font-size: 70px; font-weight: bolder; color: white; text-align: center;">
                {{ totalStudents }}
              </v-card-text>
              <v-card-text style="color: white; text-align: center;">
              </v-card-text>
            </v-card>
          </v-container>
        </v-flex>
        
        <v-flex xs12 md4>
          <v-container>
            <v-card style="background-color: darkolivegreen; color: white;">
              <v-card-title>Total Number of New Students</v-card-title>
              <div style="margin-top: 5px;"></div>
              <v-card-text style="font-size: 70px; font-weight: bolder; color: white; text-align: center;">
                {{ totalStudents }}
              </v-card-text>
              <v-card-text style="color: white; text-align: center;">
              </v-card-text>
            </v-card>
          </v-container>
        </v-flex>
        
        <v-flex xs12 md4>
          <v-container>
            <img src="./img/barchartsample.png" alt="Short Survey" style="height: 230px; width: 100%;">
            <v-card-text style="color: black; text-align: center;">  
            </v-card-text>
          </v-container>
        </v-flex>
      </v-layout>
    </div>

    <div style="margin-left: 20px; margin-right: 20px;">
      <v-layout row wrap>
        <v-flex xs12 md4>
          <div style="margin-top: 15px; width: fit-content;"></div>
          <v-expansion-panels style="padding: 15px;">
            <v-expansion-panel style="margin-bottom: 20px; background-color: blueviolet; color: white;">

              <v-expansion-panel-header style="color: white;">
                Total number of Teachers
              </v-expansion-panel-header>

              <div style="margin-top: 18px; width: fit-content;"></div>
              <v-card-text style="font-size: 70px; font-weight: bolder; color: white; text-align: center;">
                {{ totalTeachers }}
              </v-card-text>

              <v-card-text style="color: white; text-align: center;">
              </v-card-text>

              <v-expansion-panel-content>
                <ul>
                  <li>Plantilia: 40</li>
                  <li>Contractual: 12</li>
                </ul>
              </v-expansion-panel-content>

            </v-expansion-panel>
          </v-expansion-panels>
        </v-flex>
        
        
        <v-flex xs12 md4>
          <div style="margin-top: 15px;"></div>
          <v-expansion-panels style="padding: 15px;">
            <v-expansion-panel style="margin-bottom: 20px; background-color: cadetblue; color: white;">

              <v-expansion-panel-header style="color: white;">
                Total number of School Staffs
              </v-expansion-panel-header>

              <div style="margin-top: 18px; width: fit-content;"></div>
              <v-card-text style="font-size: 70px; font-weight: bolder; color: white; text-align: center;">
                {{ totalStaffs }}
              </v-card-text>

              <v-card-text style="color: white; text-align: center;">
              </v-card-text>

              <v-expansion-panel-content>
                <ul>
                  <li>Plantilia: 7</li>
                    <ul>
                      <li>Guard: 2</li>
                      <li>Librarian: 2</li>
                      <li>Utility Worker: 3</li>
                    </ul>
                  <li>Contractual: 2</li>
                    <ul>
                        <li>Guard: 1</li>
                        <li>Utility Worker: 1</li>
                    </ul>
                </ul>
              </v-expansion-panel-content>

            </v-expansion-panel>
          </v-expansion-panels>
        </v-flex>
        
        <v-flex xs12 md4>
          <div style="margin-top: 18px; width: fit-content;"></div>
          <v-container>
            <img src="./img/piechartsample.png" alt="Short Survey" style="height: 230px; width: 100%;">
            <v-card-text style="color: black; text-align: center;">
            </v-card-text>
          </v-container>
        </v-flex>
      </v-layout>
    </div>
  </v-main>
    </v-layout>
  </v-card>
</template>

<script>
import SchooladminNavigation from "./components/SchooladminNavigation.vue";
export default {
  components:{
    SchooladminNavigation: SchooladminNavigation,
  },
};
</script>

<script>
export default {
    data() {
        return {
          quizzes: [],
          selectedItem: null,
          totalStudents: 0, // Add this line to initialize the totalStudents variable to 0
          totalTeachers: 0,
          totalStaffs: 0,
        }
    },
    created() {
      fetch("/api/students")
        .then(response => response.json())
        .then(data => {
          this.totalStudents = data.length;
        });
      fetch("/api/teachers")
        .then(response => response.json())
        .then(data => {
          this.totalTeachers = data.length;
        });
      fetch("/api/staffs")
        .then(response => response.json())
        .then(data => {
          this.totalStaffs = data.length;
        });
    },
}
</script>