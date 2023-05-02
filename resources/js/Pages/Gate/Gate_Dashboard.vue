<template>
  
  <v-container fluid>
    
    <v-row justify="center" align="center">
      <v-col cols="12" md="6">
        <v-card class="elevation-3">
          <v-toolbar color="primary" dark>
            <v-snackbar v-model="successSnackbar" color="success">{{ successMessage }}</v-snackbar>
            <v-toolbar-title class="text-uppercase">Gate Pass</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <div class="image-container">
              <img :src="getImagePath()" alt="Student Image">
            </div>
            <v-form @submit.prevent="saveData">
          <v-text-field v-model="data" label="Enter Your ID Number"></v-text-field>
          <v-btn color="primary" class="white--text mt-4" @click="saveData">Save Data</v-btn>
        </v-form>
      </v-card-text>
    </v-card>
  </v-col>
</v-row>
</v-container>
</template>
<style scoped>
  .image-container {
    width: 300px;
    height: 300px;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 auto;
  }

  .image-container img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
  }

  .v-btn__content {
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>

  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      
      return {
        successSnackbar: false,
        students: [],
        selectedActivity: null,
        data: null
      };
    },
    mounted() {
      this.loadStudents();
    },
    methods: {
      getImagePath() {
  if (this.data) {
    const img = new Image();
    img.onload = () => {
      // if the image loads successfully, return the URL of the image file being loaded
      return img.src;
    };
    img.onerror = () => {
      // if the image fails to load, set the source to the default image file and return its URL
      img.src = 'http://localhost/student-management-suite/public/images/default_gate.png';
      return img.src;
    };
    img.src = `http://localhost/student-management-suite/public/images/${this.data}_student.png`;
    // return the URL of the image file being loaded or the default image file if the image fails to load
    return img.src;
  } else {
    // if there is no data, return the URL of the default image file
    return 'http://localhost/student-management-suite/public/images/default_gate.png';
  }
},
saveData() {
  const student = this.students.find(s => s.account_id === this.data);
  if (student) {
    console.log("Account ID matched:", this.data);
    const currentDate = new Date(Date.now() + (28800 * 1000)).toISOString().slice(0, 19).replace('T', ' ');

     let status = "";
    const currentHour = new Date().getHours(); // Get current hour of the day
    if (currentHour >= 8 && currentHour < 12) {
      status = "in"; // Classify as in if current hour is between 8AM to 12PM
    } else if (currentHour >= 12 && currentHour < 13) {
      status = "lunch out"; // Classify as lunch out if current hour is between 12PM to 1PM
    } else if (currentHour >= 13 && currentHour < 17) {
      status = "lunch in"; // Classify as lunch in if current hour is between 1PM to 5PM
    } else {
      status = "out"; // Classify as out if current hour is outside of the above time ranges
    }
    axios.post('/gates/saveLog', { // Send POST request to insert data into gates table
      student_id: student.account_id,
      status: status,
      dateTime: currentDate
    })
    .then(response => {
      console.log(response.data);
      this.successMessage = 'Saved successfully! Current status: ' + status;
      this.successSnackbar = true; // Display success snackbar
    })
    .catch(error => {
      console.error(error);
    });
  } else {
    const errorMessage = "Invalid ID entered: " + this.data;
    console.log(errorMessage);
    this.successMessage = errorMessage;
    this.successSnackbar = true; // Display success snackbar
  }

},

      loadStudents() {
        const authToken = localStorage.getItem('auth_token');
        axios.get('/students/students', {
          headers: {
            'Authorization': `Bearer ${authToken}`
          }
        })
        .then(response => {
          this.students = response.data;
        })
        .catch(error => {
          console.error(error);
          if (error.response.status === 401) {
            window.location.href = '/'; // Redirect to login page if user is unauthorized
          }
        });
      },
      submitForm() {
        // Submit form when button is clicked
        this.$refs.form.submit();
      },
    }
  };
  </script>
  