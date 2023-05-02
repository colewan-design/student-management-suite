<template>
    <v-card height="100%">
    <v-layout>
      <student-navigation></student-navigation>
         <v-main>
      <v-toolbar>
        <v-toolbar-title>Student Schedule</v-toolbar-title>
      </v-toolbar>
  
      <template>
    <v-sheet height="700">
    <div
      class="ma-4"
      style="height: 100%"
    >
      <v-calendar
        :events="events"
        type="week"
        event-color="indigo"
        value="2022-04-16"
        now="2022-04-16"
      >
      </v-calendar>
    </div>
    </v-sheet>
</template>
    </v-main>
  </v-layout>
   </v-card>
  </template>

<style scoped>
.my-event {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  border-radius: 2px;
  background-color: #1867c0;
  color: #ffffff;
  border: 1px solid #1867c0;
  font-size: 12px;
  padding: 3px;
  cursor: pointer;
  margin-bottom: 1px;
  left: 4px;
  margin-right: 8px;
  position: relative;
}
</style>
  
  <script>
  import StudentNavigation from "./components/StudentNavigation.vue";
  export default {
    components:{
      StudentNavigation: StudentNavigation,
    },
  };
  </script>
<script>
export default {
  data: () => {
    return {
      events: [
        {
          name: 'SCIENCE',
          start: '2022-04-10T02:00:00',
          end: '2022-04-10T04:00:00',
          timed: true,
        },
        {
          name: 'MATH',
          start: '2022-04-12T08:00:00',
          end: '2022-04-12T10:00:00',
          timed: true,
        },
        {
          name: 'ENGLISH',
          start: '2022-04-15T04:00:00',
          end: '2022-04-15T06:00:00',
          timed: true,
        },
      ],
    };
  },
};
</script>