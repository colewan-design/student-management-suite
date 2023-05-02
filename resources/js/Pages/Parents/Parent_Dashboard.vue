<template>
  <main>
  <v-card height="100vh">
    <v-layout>
      <parent-navigation></parent-navigation>
  <template>
<v-container>
  <v-toolbar color="primary" dark>
    <v-toolbar-title>Parent Dashboard</v-toolbar-title>
  </v-toolbar>
  <div style="margin-bottom: 20px;"></div>
  <v-layout justify-center>
    <v-flex xs24 sm16 md12>
      <v-card>
        <v-card-text>
          <v-layout justify-space-between>
            <v-flex xs6 class="mr-3">
              <v-btn style="padding: 14%; width: 100%; background-color: darkcyan; color: white;" @click="showDialog = true">STUDENT'S PROFILE</v-btn>
            </v-flex>
            <v-flex xs6 class="ml-3">
              <v-btn style="padding: 14%; width: 100%; background-color: darkolivegreen; color: white;" @click="showDialog2 = true">STUDENT'S ACADEMIC STATUS</v-btn>
            </v-flex>
          </v-layout>
        </v-card-text>

        <v-card-text>
          <v-layout justify-space-between>
            <v-flex xs6 class="mr-3">
              <v-btn style="padding: 14%; width: 100%; background-color: darkkhaki; color: white;" @click="showDialog3 = true">STUDENT'S CLUBS AND <br> COMPETITIONS</v-btn>
            </v-flex>
            <v-flex xs6 class="ml-3">
              <v-btn style="padding: 14%; width: 100%; background-color: darksalmon; color: white;" @click="showDialog4 = true">PAYMENTS <br>(SCHOOL FEES AND <br> MISCELLANEOUS)</v-btn>
            </v-flex>
          </v-layout>
        </v-card-text>
      </v-card>
    </v-flex>
  </v-layout>

  <v-dialog v-model="showDialog" width="500">
    <child-profile
      :child-name="childName"
      :child-age="childAge"
      :child-l-r-n="childLRN"
      :child-grade="childGrade"
      :child-add="childAdd"
      :child-b-day="childBDay"
      :interests="interests"
    ></child-profile>
  </v-dialog>

  <v-dialog v-model="showDialog2" width="500">
    <child-grade
      :child-name="childName"
      :child-age="childAge"
      :child-grade="childGrade"
      :message="message"
    ></child-grade>
  </v-dialog>

  <v-dialog v-model="showDialog3" width="500">
    <child-interests
      :child-name="childName"
      :child-age="childAge"
      :child-grade="childGrade"
      :message="message"
    ></child-interests>
  </v-dialog>

  <v-dialog v-model="showDialog4" width="500">
    <child-payments
      :child-name="childName"
      :child-age="childAge"
      :child-grade="childGrade"
      :message="message"
    ></child-payments>
  </v-dialog>

</v-container>
</template>



        
      </v-layout>
      
    </v-card>
    </main>
  </template>
  <script>
  import ParentNavigation from "./components/ParentNavigation.vue";
  export default {
    components:{
      ParentNavigation: ParentNavigation,
    },
  };
  </script>
  <script>
  import ChildProfile from "../../components/ChildProfile.vue";
  import ChildGrade from "../../components/ChildGrade.vue";
  import ChildInterests from "../../components/ChildInterests.vue";
  import ChildPayments from "../../components/ChildPayments.vue";
  
  export default {
    components: {
      ChildProfile,
      ChildGrade,
      ChildInterests,
      ChildPayments,
    },
    data() {
      return {
        childName: "Jane Seymour",
        childAge: "14",
        childGrade: "8th",
        childLRN: "122216010508",
        childAdd: "No. 15 Happy Homes, Outlook Drive, Baguio City, Philippines 2600",
        childBDay: "October 10th, 2008",
        interests: "Volleyball",
        message: "//This will be connected to the academic status of the Student//",
        showDialog: false,
        showDialog2: false,
        showDialog3: false,
        showDialog4: false,
      };
    },
  };
  </script>