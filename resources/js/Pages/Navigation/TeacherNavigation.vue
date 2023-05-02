<template>
    <main>
      <v-card height="100vh">
        <v-layout>
          <v-navigation-drawer clipped permanent>
            <v-toolbar color="primary" dark>
              <v-toolbar-title class="text-h6">Student Management Suite</v-toolbar-title>
              <v-spacer></v-spacer>
            
              <div>
                <v-dialog v-model="dialog" max-width="400">
                  <v-card>
                    <v-card-title class="headline">Confirm Logout</v-card-title>
                    <v-card-text>
                      Are you sure you want to logout?
                    </v-card-text>
                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn color="error" text @click="dialog = false">Cancel</v-btn>
                      <v-btn color="success" text @click="logout">Logout</v-btn>
                    </v-card-actions>
                  </v-card>
                </v-dialog>

                <v-btn icon @click="dialog = true">
                  <v-icon>mdi-logout</v-icon>
                </v-btn>
              </div>
            </v-toolbar>
            
            <v-list-item class="px-2">
            <v-list-item-avatar style="height: 100px; margin: 20px auto; width: 100px; display: block;">
              <img :src="profilePicture">
            </v-list-item-avatar>
          </v-list-item>
            <v-list-item to="/teacher_profile">
              <v-list-item-content>
                <v-list-item-title class="text-h6">
                  {{ userName }}
                </v-list-item-title>
                <v-list-item-subtitle>{{ email }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
            <v-divider></v-divider>
            <v-list nav dense>
              <v-list-item to="/teacher_dashboard">
                <v-list-item-icon>
                  <v-icon color="primary">mdi-view-dashboard</v-icon>
                </v-list-item-icon>
                <v-list-item-title class="text-uppercase">Dashboard</v-list-item-title>
              </v-list-item>
  <v-divider></v-divider>
  <v-list-item-group>
  <v-list-item to="/gate_dashboard">
    <v-list-item-icon>
      <v-icon color="indigo" size="24">mdi-view-dashboard</v-icon>
    </v-list-item-icon>
    <v-list-item-title class="text-uppercase">Gate</v-list-item-title>
  </v-list-item>
  <v-list-item to="/attendance">
    <v-list-item-icon>
      <v-icon color="indigo" size="24">mdi-account-check</v-icon>
    </v-list-item-icon>
    <v-list-item-title class="text-uppercase">Attendance</v-list-item-title>
  </v-list-item>
  <v-list-item to="/quiz_group">
    <v-list-item-icon>
      <v-icon color="teal" size="24">mdi-format-list-checks</v-icon>
    </v-list-item-icon>
    <v-list-item-title class="text-uppercase">Quizzes</v-list-item-title>
  </v-list-item>
  <v-list-item to="/exam_group">
    <v-list-item-icon>
      <v-icon color="teal" size="24">mdi-file-check</v-icon>
    </v-list-item-icon>
    <v-list-item-title class="text-uppercase">Exams</v-list-item-title>
  </v-list-item>
  <v-list-item to="/question_group">
    <v-list-item-icon>
      <v-icon color="green" size="24">mdi-help-circle</v-icon>
    </v-list-item-icon>
    <v-list-item-title class="text-uppercase">Questions</v-list-item-title>
  </v-list-item>
  <v-list-item to="/grade_computation">
    <v-list-item-icon>
      <v-icon color="indigo" size="24">mdi-calculator</v-icon>
    </v-list-item-icon>
    <v-list-item-title class="text-uppercase">Grades Calculator</v-list-item-title>
  </v-list-item>
  <v-list-item to="/student_report_summary">
    <v-list-item-icon>
      <v-icon color="indigo" size="24">mdi-account-group</v-icon>
    </v-list-item-icon>
    <v-list-item-title class="text-uppercase">Student Summary</v-list-item-title>
  </v-list-item>
</v-list-item-group>
<v-divider></v-divider>
<v-list-item to="/relationship">
  <v-list-item-icon>
    <v-icon color="purple">mdi-account-switch-outline</v-icon>
  </v-list-item-icon>
  <v-list-item-title class="text-uppercase">Assign Students</v-list-item-title>
</v-list-item>
<v-list-item to="/assign_exams">
  <v-list-item-icon>
    <v-icon color="purple">mdi-file-document-edit-outline</v-icon>
  </v-list-item-icon>
  <v-list-item-title class="text-uppercase">Assign Exam</v-list-item-title>
</v-list-item>
<v-list-item to="/assign_quizzes">
  <v-list-item-icon>
    <v-icon color="purple">mdi-file-document-edit-outline</v-icon>
  </v-list-item-icon>
  <v-list-item-title class="text-uppercase">Assign Quizzes</v-list-item-title>
</v-list-item>
<v-list-item to="/announcement_posts">
    <v-list-item-icon>
      <v-icon color="indigo darken-2">mdi-bullhorn-outline</v-icon>
    </v-list-item-icon>
    <v-list-item-title class="text-uppercase">Announcement Posts</v-list-item-title>
  </v-list-item>
  <v-divider></v-divider>
  <v-list-item to="/schooladmin_document_page">
  <v-list-item-icon>
    <v-icon style="color: mediumseagreen;">mdi-file-outline</v-icon>
  </v-list-item-icon>
  <v-list-item-title class="text-uppercase">Documents</v-list-item-title>
</v-list-item>
</v-list> 
          </v-navigation-drawer>
        </v-layout>
      </v-card>
    </main>
  </template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      userName: '',
      email: '',
      dialog: false,
      account_id: '',
    };
  },
  mounted() {
    const authToken = localStorage.getItem('auth_token');

    axios.get('/user', {
        headers: {
            'Authorization': `Bearer ${authToken}`
        }
    })
    .then(response => {
        this.userName = response.data.name;
        this.email = response.data.email;
        this.account_id = response.data.account_id;
    })
    .catch(error => {
        console.error(error);
        if (error.response.status === 401) {
            window.location.href = '/'; // Redirect to login page
        }
    });
},
  name: 'TeacherNavigation',
  components: {},
  computed: {
    profilePicture() {
      return `http://localhost/student-management-suite/public/images/${this.account_id}_student.png`;
    },
    // other computed properties
  },
  methods: {
    logout() {
        const authToken = localStorage.getItem('auth_token');
        axios.post('/logout', null, {
            headers: {
                'Authorization': `Bearer ${authToken}`
            },
            withCredentials: true
        })
        .then(response => {
            // handle successful logout
            window.location.href = '/';
        })
        .catch(error => {
            // handle logout error
        });
    },
},
 
};

</script>   

