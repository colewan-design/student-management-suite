<style>
.my-toolbar{
  margin-bottom: 20px;
}
</style>
<template>
  <v-container fluid>
    <v-row>
      <guard-navigation></guard-navigation>
      <v-col>
        <v-toolbar class="my-toolbar">
          <v-toolbar-title>Gate Logs</v-toolbar-title>
          <v-spacer></v-spacer>
        </v-toolbar>
        <template>
          <v-row>
            <v-col cols="12" sm="6" md="4" lg="3" v-for="(item, index) in gate_logs" :key="index">
              <v-card>
                <v-img :src="item.image" aspect-ratio="1"></v-img>
                <v-card-title>{{ item.student_id }}</v-card-title>
                <v-card-text>
                  <div>Date & Time: {{ item.dateTime }}</div>
                  <div>Status: {{ item.status }}</div>
                </v-card-text>
              </v-card>
            </v-col>
          </v-row>
        </template>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
    export default {
      components:{
        GuardNavigation: GuardNavigation,
      },
    };
</script>
<script>
  export default {
    data: () => ({
      gate_logs: [],
    }),
    created() {
      this.initialize();
    },
    methods: {
      async GateLogsList() {
  try {
    const response = await axios.get('/gate_logs');
    if (response.status === 200) {
      this.gate_logs = response.data.map(item => ({
        ...item,
        image: "http://localhost/student-management-suite/public/images/" + item.student_id + "_student.png",
      }));
    } else {
      this.$Notice.error({
        title: "Error",
        desc: "Error occurred while loading data",
      });
    }
  } catch (error) {
    console.error(error);
    this.$Notice.error({
      title: "Error",
      desc: "Error occurred while loading data",
    });
  }
},

      initialize() {
        this.GateLogsList();
      },
    },
  };
</script>
