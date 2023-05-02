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
    <v-toolbar class="my-toolbar">
            <v-toolbar-title>Teacher Dashboard</v-toolbar-title>
              <v-spacer></v-spacer>
            <v-toolbar-items>
              <v-app-bar-nav-icon @click="showNotification = !showNotification">
                <v-badge :content="notifications.length" color="red" overlap>
                <v-icon>mdi-bell</v-icon>
              </v-badge>
              </v-app-bar-nav-icon>
              <v-menu v-model="showNotification" offset-y>
                <template v-slot:activator="{ on }">
                  <v-btn icon v-on="on"></v-btn>
                </template>
                <v-card>
                  <v-list>
                    <v-list-item v-for="notification in notifications" :key="notification.id">
                      <v-list-item-title>{{ notification.message }}</v-list-item-title>
                    </v-list-item>
                  </v-list>
                  <v-card-actions>
                    <v-btn color="primary" text @click="showNotification = false">Close</v-btn>
                  </v-card-actions>
                </v-card>
              </v-menu>
            </v-toolbar-items>
        </v-toolbar>
            <v-row no-gutters style="margin-bottom: 20px;">
              <v-col cols="12" md="4" class="mx-auto">
                <v-hover v-slot="{ hover }" open-delay="200">
                  <v-card class="mx-auto" color="primary darken-1" :elevation="hover ? 16 : 2">
                    <v-row no-gutters>
                      <v-col cols="3" sm="2">
                        <v-avatar size="60" class="mt-2" tile>
                          <v-icon size="36" color="white">mdi-calendar-check</v-icon>
                        </v-avatar>
                      </v-col>
                      <v-col cols="9" sm="10">
                        <v-list-item three-line>
                          <v-list-item-avatar>
                            <v-btn fab color="primary lighten-2" elevation="0">
                              <v-icon color="white">fab fa-bitcoin</v-icon>
                            </v-btn>
                          </v-list-item-avatar>
                          <v-list-item-content>
                            <v-list-item-title class="headline mb-1 white--text">
                              $8,520.50
                            </v-list-item-title>
                            <v-list-item-subtitle class="white--text">Attendance</v-list-item-subtitle>
                          </v-list-item-content>
                        </v-list-item>
                      </v-col>
                    </v-row>
                  </v-card>
                </v-hover>
              </v-col>

               <!-- Lesson Plan card-->
               <v-col cols="12" md="4" class="mx-auto">
                <v-hover v-slot="{ hover }" open-delay="200">
                  <v-card class="mx-auto" color="pink darken-1" :elevation="hover ? 16 : 2">
                    <v-row no-gutters>
                      <v-col cols="3" sm="2">
                        <v-avatar size="60" class="mt-2" tile>
                          <v-icon size="36" color="white">mdi-file-document</v-icon>
                        </v-avatar>
                      </v-col>
                      <v-col cols="9" sm="10">
                        <v-list-item three-line>
                          <v-list-item-avatar>
                            <v-btn fab color="pink lighten-2" elevation="0">
                              <v-icon color="white">fab fa-bitcoin</v-icon>
                            </v-btn>
                          </v-list-item-avatar>
                          <v-list-item-content>
                            <v-list-item-title class="headline mb-1 white--text">
                              $8,520.50
                            </v-list-item-title>
                            <v-list-item-subtitle class="white--text">Lesson Plans</v-list-item-subtitle>
                          </v-list-item-content>
                        </v-list-item>
                      </v-col>
                    </v-row>
                  </v-card>
                </v-hover>
              </v-col>

            </v-row>

            <v-row no-gutters>
              <!-- attendance card-->
              <v-col cols="12" md="4" class="mx-auto">
                <v-hover v-slot="{ hover }" open-delay="200">
                  <v-card class="mx-auto" color="yellow darken-1" :elevation="hover ? 16 : 2">
                    <v-row no-gutters>
                      <v-col cols="3" sm="2">
                        <v-avatar size="60" class="mt-2" tile>
                          <v-icon size="36" color="white">mdi-chart-bar</v-icon>
                        </v-avatar>
                      </v-col>
                      <v-col cols="9" sm="10">
                        <v-list-item three-line>
                          <v-list-item-avatar>
                            <v-btn fab color="yellow lighten-2" elevation="0">
                              <v-icon color="white">fab fa-bitcoin</v-icon>
                            </v-btn>
                          </v-list-item-avatar>
                          <v-list-item-content>
                            <v-list-item-title class="headline mb-1 white--text">
                              $8,520.50
                            </v-list-item-title>
                            <v-list-item-subtitle class="white--text">Grades</v-list-item-subtitle>
                          </v-list-item-content>
                        </v-list-item>
                      </v-col>
                    </v-row>
                  </v-card>
                </v-hover>
              </v-col>

               <!-- Lesson Plan card-->
               <v-col cols="12" md="4" class="mx-auto">
                <v-hover v-slot="{ hover }" open-delay="200">
                  <v-card class="mx-auto" color="green darken-1" :elevation="hover ? 16 : 2">
                    <v-row no-gutters>
                      <v-col cols="3" sm="2">
                        <v-avatar size="60" class="mt-2" tile>
                          <v-icon size="36" color="white">mdi-account-group</v-icon>
                        </v-avatar>
                      </v-col>
                      <v-col cols="9" sm="10">
                        <v-list-item three-line>
                          <v-btn fab color="green lighten-2" elevation="0" href="/student_information_teacher">
                            <v-icon color="white">fab fa-bitcoin</v-icon>
                          </v-btn>
                          <v-list-item-content>
                            <v-list-item-title class="headline mb-1 white--text">
                              {{ totalStudents }}
                            </v-list-item-title>
                            <v-list-item-subtitle class="white--text">Total Students</v-list-item-subtitle>
                          </v-list-item-content>
                        </v-list-item>
                      </v-col>

                    </v-row>
                  </v-card>
                </v-hover>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12" md="10" style="padding-left:10rem">
                <v-hover>
                  <v-card class="mx-auto" max-width="600">
                    <v-card-title class="text-h5">Recent Announcements</v-card-title>
                    <v-card-text>
                      <v-list>
                        <v-list-item v-if="announcements.length > 0">
                          <v-list-item-content>
                            <v-list-item-title class="text-h6">{{ announcements[0].title }}</v-list-item-title>
                            <v-list-item-subtitle class="text-caption">{{ new Date(announcements[0].created_at).toLocaleString() }}</v-list-item-subtitle>
                            <v-list-item-subtitle>{{ announcements[0].body }}</v-list-item-subtitle>
                          </v-list-item-content>
                          <v-list-item-action>
                            <v-btn color="primary" text :to="'/announcement_posts'">Read More</v-btn>
                          </v-list-item-action>
                        </v-list-item>
                        <v-list-item v-else>
                          <v-list-item-content>
                            <v-list-item-title class="text-h6">No announcements found</v-list-item-title>
                          </v-list-item-content>
                        </v-list-item>
                      </v-list>
                    </v-card-text>
                  </v-card>

                </v-hover>
              </v-col>
            </v-row>
      
   
  </v-col>
  </v-row>
</v-container>
  
</template>


<script>
    export default {
      components:{
        TeacherNavigation: TeacherNavigation,
      },
    };
</script>

<script>
export default {
    name: "Dashboard",
    data() {
        return {
      notifications: [],
          showNotification: false,
          announcements: [],
          selectedItem: null,
          totalStudents: 0, // Add this line to initialize the totalStudents variable to 0
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
          mounted() {
          this.fetchNotifications();
        },
    methods: {
          async fetchNotifications() {
        const response = await axios.get('/notifications');
        this.notifications = response.data;
      },
      
    },
      
}
</script>


<style scoped>
    .overlap-icon {
        position: absolute;
        top: -33px;
        text-align: center;
        padding-top: 12px;
    }
    .link {
color: #2C3E50;
font-weight: bold;
text-decoration: none;
border: 2px solid #2C3E50;
padding: 8px 16px;
border-radius: 4px;
transition: all 0.3s ease;
}

.link:hover {
background-color: #2C3E50;
color: #FFF;
}
</style>