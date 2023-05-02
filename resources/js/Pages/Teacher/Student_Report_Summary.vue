<style>
/* Top Performing Students Card */
.v-card__title {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 20px;
}

.v-select {
  width: 100%;
  margin-bottom: 20px;
}

.d-flex.justify-end {
  display: flex;
  justify-content: flex-end;
}

.v-btn {
  margin-left: 20px;
}

/* Least Performing Students Card */
.v-divider {
  margin: 30px 0;
}

  .title {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
  }

  .d-flex {
    display: flex;
  }

  .justify-content-between {
    justify-content: space-between;
  }

  .justify-content-end {
    justify-content: flex-end;
  }
  /* All Student Summary Report card */
.all-student-summary-report-card {
  margin: 20px;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.all-student-summary-report-card v-card-title {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 10px;
}

.all-student-summary-report-card v-card-text {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.all-student-summary-report-card v-divider {
  margin: 20px 0;
}

.all-student-summary-report-card v-card-title:last-of-type {
  margin-top: 20px;
}

.all-student-summary-report-card v-card-text v-btn {
  color: white;
  font-weight: bold;
}

.all-student-summary-report-card v-card-text v-btn:first-of-type {
  margin-right: 10px;
}

/* Student Summary Report Filter card */
.student-summary-report-filter-card {
  margin: 20px;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.student-summary-report-filter-card v-card-title {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 10px;
}

.student-summary-report-filter-card v-card-text {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  align-items: center;
}

.student-summary-report-filter-card v-row {
  margin-top: 10px;
}

.student-summary-report-filter-card v-col {
  margin-bottom: 10px;
}

.student-summary-report-filter-card v-select {
  width: 100%;
}

.student-summary-report-filter-card v-card-text v-btn {
  color: white;
  font-weight: bold;
}

.student-summary-report-filter-card v-card-text v-btn:first-of-type {
  margin-right: 10px;
}

</style>
<template>
  <v-container fluid>
    <v-row>
      <teacher-navigation />
      <v-col>
        <v-toolbar color="primary" dark>
          <v-toolbar-title>Student Report Summary</v-toolbar-title>
        </v-toolbar>
        <v-container>
          <v-card class="all-student-summary-report-card"> 
            <v-card-title class="title">
              All Student Summary Report
            </v-card-title>
            <v-card-text class="d-flex justify-content-between">
              <v-btn color="primary" @click="downloadAllExcel">
                <v-icon left>mdi-file-excel</v-icon>
                Excel Report
              </v-btn>
              <v-btn color="primary" @click="downloadPDF">
                <v-icon left>mdi-file-pdf</v-icon>
                PDF Report
              </v-btn>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-title class="title">
              Student Summary Report Per Section
            </v-card-title>
            <v-card-text>
              <v-row>
                <v-col cols="12" md="4">
                  <v-select
                    label="Section"
                    v-model="selectedSection"
                    :items="sections"
                    item-text="name"
                    item-value="id"
                  ></v-select>
                </v-col>
                <v-col cols="12" md="8" class="d-flex justify-content-end">
                  <v-btn color="primary" @click="downloadExcelPerSection">
                    <v-icon left>mdi-file-excel</v-icon>
                    Excel per Section
                  </v-btn>
                  <v-btn color="primary" @click="downloadPDFPerSection">
                    <v-icon left>mdi-file-pdf</v-icon>
                    PDF per Section
                  </v-btn>
                </v-col>
              </v-row>
            </v-card-text>
            <v-divider></v-divider>
          </v-card>

          <v-card class="student-summary-report-filter-card">
            <!--Student report based on filter-->
          <v-card-title>Student Summary Report Filter</v-card-title>
          <v-card-text>
            <v-row>
              <v-col cols="12" md="4">
                <v-select
                  label="Section"
                  v-model="selectedFilterSection"
                  :items="sections"
                  item-text="name"
                  item-value="id"
                ></v-select>
              </v-col>
              <v-col cols="12" md="4">
                <v-select
                  label="Age"
                  v-model="selectedFilterAge"
                  :items="ages"
                  item-text="name"
                  item-value="id"
                ></v-select>
              </v-col>
              <v-col cols="12" md="4">
                <v-select
                  label="Dropout"
                  v-model="selectedFilterDropout"
                  :items="dropouts"
                  item-text="name"
                  item-value="id"
                ></v-select>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12" md="4">
                <v-select
                  label="Gender"
                  v-model="selectedFilterGender"
                  :items="genders"
                  item-text="name"
                  item-value="id"
                ></v-select>
              </v-col>
              <v-col cols="12" md="4">
                <v-select
                  label="Address"
                  v-model="selectedFilterAddress"
                  :items="addresses"
                  item-text="name"
                  item-value="id"
                ></v-select>
              </v-col>
              <v-col cols="12" md="8" class="d-flex justify-end">
                <v-btn color="primary" @click="downloadExcelPerFilterButton">
                  <v-icon left>mdi-file-excel</v-icon>
                  Excel per filter
                </v-btn>
                <v-btn color="primary" @click="downloadPDFPerFilter">
                  <v-icon left>mdi-file-pdf</v-icon>
                  PDF per filter
                </v-btn>
              </v-col>
            </v-row>
          </v-card-text>
          </v-card>
          <!--End Filter Card-->
          <v-divider></v-divider>
        <v-card>
             <!--Start Top Students Card-->
             <v-card-title>Top Performing Students Per Section</v-card-title>
          <v-card-text>
            <v-row>
              <v-col cols="12" md="4">
                <v-select
                  label="Section"
                  v-model="selectedTopStudentsSection"
                  :items="sections"
                  item-text="name"
                  item-value="id"
                ></v-select>
              </v-col>
              <v-col cols="12" md="8" class="d-flex justify-end">
                <v-btn color="primary" @click="downloadExcelTopStudentsPerSection">
                  <v-icon left>mdi-file-excel</v-icon>
                  Excel per Section
                </v-btn>
                <v-btn color="primary" @click="downloadPDFTopStudentsPerSection">
                  <v-icon left>mdi-file-pdf</v-icon>
                  PDF per Section
                </v-btn>
              </v-col>
            </v-row>
          </v-card-text>
          <v-divider></v-divider>
          <!--End Top Students Card-->
            <!--Start Least Students Card-->
            <v-card-title>Least Performing Students Per Section</v-card-title>
          <v-card-text>
            <v-row>
              <v-col cols="12" md="4">
                <v-select
                  label="Section"
                  v-model="selectedLeastStudentsSection"
                  :items="sections"
                  item-text="name"
                  item-value="id"
                ></v-select>
              </v-col>
              <v-col cols="12" md="8" class="d-flex justify-end">
                <v-btn color="primary" @click="downloadExcelLeastStudentsPerSection">
                  <v-icon left>mdi-file-excel</v-icon>
                  Excel per Section
                </v-btn>
                <v-btn color="primary" @click="downloadPDFLeastStudentsPerSection">
                  <v-icon left>mdi-file-pdf</v-icon>
                  PDF per Section
                </v-btn>
              </v-col>
            </v-row>
          </v-card-text>
          
        </v-card>
        <v-divider></v-divider>
          <!--End Top Students Card-->
            <v-card>
              <!--start Transcript of Record Card-->
            <v-card-title>Transcript of Records</v-card-title>
          <v-card-text>
            <v-row>
              <v-col cols="12" md="4">
                <v-select
                  label="Student"
                  v-model="selectedStudent"
                  :items="students"
                  :item-text="item => `${item.first_name} ${item.middle_name} ${item.last_name}`"
                  item-value="account_id"
                ></v-select>
              </v-col>
              <v-col cols="12" md="8" class="d-flex justify-end">
                <v-btn color="primary" @click="downloadExcelTranscriptRecords">
                  <v-icon left>mdi-file-excel</v-icon>
                  Excel per student
                </v-btn>
                <v-btn color="primary" @click="downloadPDFTranscriptRecords">
                  <v-icon left>mdi-file-pdf</v-icon>
                  PDF per student
                </v-btn>
              </v-col>
            </v-row>
          </v-card-text>
          <v-divider></v-divider>
          <!--End Transcript of Record Card-->
           <!--start Transcript of Record Card-->
           <v-card-title>Student Attendance</v-card-title>
          <v-card-text>
            <v-row>
              <v-col cols="12" md="4">
                <v-select
                  label="Student"
                  v-model="selectedAttendanceStudent"
                  :items="students"
                  :item-text="item => `${item.first_name} ${item.middle_name} ${item.last_name}`"
                  item-value="account_id"
                ></v-select>
              </v-col>
              <v-col cols="12" md="8" class="d-flex justify-end">
                <v-btn color="primary" @click="downloadExcelAttendance">
                  <v-icon left>mdi-file-excel</v-icon>
                  Excel per student
                </v-btn>
                <v-btn color="primary" @click="downloadPDFAttendance">
                  <v-icon left>mdi-file-pdf</v-icon>
                  PDF per student
                </v-btn>
              </v-col>
            </v-row>
          </v-card-text>
            </v-card>
          <v-divider></v-divider>
          <v-card>
            <v-card-title>Student Gate Pass</v-card-title>
          <v-card-text>
            <v-row>
              
              <v-col cols="12" md="8" class="d-flex justify-end">
                <v-btn color="primary" @click="downloadAllGatePassExcel">
                  <v-icon left>mdi-file-excel</v-icon>
                  Excel - All student
                </v-btn>
                <v-btn color="primary" @click="downloadallGatePassPDF">
                  <v-icon left>mdi-file-pdf</v-icon>
                  PDF - All student
                </v-btn>
              </v-col>
            </v-row>
          </v-card-text>
          </v-card>
          <v-divider></v-divider>
          <!--End Transcript of Record Card-->
        </v-container>
      </v-col>
      
    </v-row>
  </v-container>
</template>

<style scoped>
.v-btn__content {
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>

<script>
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
      selectedAttendanceStudent: null,
      selectedStudent: null,
      selectedSection: null,
      selectedTopStudentsSection: null,
      selectedLeastStudentsSection: null,
      selectedFilterSection: null,
      selectedFilterGender: null,
      selectedFilterAge: null,
      selectedFilterAddress: null,
      selectedFilterDropout: null,
    
      students: [],
      sections: [],
      ages: [],
      addresses: [],
      genders: [],
      dropouts: [],
       // Initialize the sections array
    };
  },
  mounted() {
    // Load the sections from the server when the component is mounted
    this.loadSections();
    this.loadStudents();
    this.loadGenders();
    this.loadAddresses();
    this.loadDropouts();
    this.loadAges();
    
  },
 
  methods: {
    downloadallGatePassPDF() {
    const authToken = localStorage.getItem('auth_token');
    const queryParams = '?all=true'; // Add this to the URL
    axios.get(`/gate_logs/pdf${queryParams}`, {
      headers: {
        'Authorization': `Bearer ${authToken}`
      },
      responseType: 'blob'
    })
    .then(response => {
      const url = window.URL.createObjectURL(new Blob([response.data]));
      const link = document.createElement('a');
      link.href = url;
      link.setAttribute('download', 'gate_logs.pdf');
      document.body.appendChild(link);
      link.click();
    })
    .catch(error => {
      console.error(error);
      if (error.response.status === 401) {
        window.location.href = '/'; // Redirect to login page if user is unauthorized
      }
    });
  },
    downloadAllGatePassExcel() {
  const authToken = localStorage.getItem('auth_token');
  const url = '/gate_logs/export';
  axios.get(url, {
    headers: {
      'Authorization': `Bearer ${authToken}`
    },
    responseType: 'blob'
  })
  .then(response => {
    const url = window.URL.createObjectURL(new Blob([response.data]));
    const link = document.createElement('a');
    link.setAttribute('download', 'gate_logs.xlsx');
    link.href = url;
    document.body.appendChild(link);
    link.click();
  })
  .catch(error => {
    console.error(error);
    if (error.response.status === 401) {
      window.location.href = '/'; // Redirect to login page if user is unauthorized
    }
  });
},


    downloadPDFAttendance() {
      const authToken = localStorage.getItem('auth_token');
      axios.get(`/students/pdf-attendance?student=${this.selectedAttendanceStudent}`, {
        headers: {
          'Authorization': `Bearer ${authToken}`
        },
        responseType: 'blob'
      })
      .then(response => {
        const url = window.URL.createObjectURL(new Blob([response.data]));
        const link = document.createElement('a');
        link.href = url;
        link.setAttribute('download', `attendance_${this.selectedAttendanceStudent}.pdf`);
        document.body.appendChild(link);
        link.click();
      })
      .catch(error => {
        console.error(error);
        if (error.response.status === 401) {
          window.location.href = '/'; // Redirect to login page if user is unauthorized
        }
      });
    },
    downloadAttendanceExcel(studentId = null) {
    const authToken = localStorage.getItem('auth_token');
    let url = studentId ? `/students/export-attendance/${studentId}` : '/students/export';
    axios.get(url, {
      headers: {
        'Authorization': `Bearer ${authToken}`
      },
      responseType: 'blob'
    })
    .then(response => {
      const excelUrl = window.URL.createObjectURL(new Blob([response.data]));
      const link = document.createElement('a');
      if (studentId) {
        link.setAttribute('download', `attendance_${studentId}.xlsx`);
      } else {
        link.setAttribute('download', 'students.xlsx');
      }
      link.href = excelUrl;
      document.body.appendChild(link);
      link.click();
    })
    .catch(error => {
      console.error(error);
      if (error.response.status === 401) {
        window.location.href = '/'; // Redirect to login page if user is unauthorized
      }
    });
  },

  downloadExcelAttendance() {
    this.downloadAttendanceExcel(this.selectedAttendanceStudent);
  },
    downloadTranscriptRecordsExcel(studentId = null) {
    const authToken = localStorage.getItem('auth_token');
    let url = studentId ? `/students/export-transcript-records/${studentId}` : '/students/export';
    axios.get(url, {
      headers: {
        'Authorization': `Bearer ${authToken}`
      },
      responseType: 'blob'
    })
    .then(response => {
      const excelUrl = window.URL.createObjectURL(new Blob([response.data]));
      const link = document.createElement('a');
      if (studentId) {
        link.setAttribute('download', `transcript_records_${studentId}.xlsx`);
      } else {
        link.setAttribute('download', 'students.xlsx');
      }
      link.href = excelUrl;
      document.body.appendChild(link);
      link.click();
    })
    .catch(error => {
      console.error(error);
      if (error.response.status === 401) {
        window.location.href = '/'; // Redirect to login page if user is unauthorized
      }
    });
  },

  downloadExcelTranscriptRecords() {
    this.downloadTranscriptRecordsExcel(this.selectedStudent);
  },

    downloadPDFTranscriptRecords() {
      const authToken = localStorage.getItem('auth_token');
      axios.get(`/students/pdf-transcript-records?student=${this.selectedStudent}`, {
        headers: {
          'Authorization': `Bearer ${authToken}`
        },
        responseType: 'blob'
      })
      .then(response => {
        const url = window.URL.createObjectURL(new Blob([response.data]));
        const link = document.createElement('a');
        link.href = url;
        link.setAttribute('download', `transcript_of_students_${this.selectedStudent}.pdf`);
        document.body.appendChild(link);
        link.click();
      })
      .catch(error => {
        console.error(error);
        if (error.response.status === 401) {
          window.location.href = '/'; // Redirect to login page if user is unauthorized
        }
      });
    },
    downloadPDFLeastStudentsPerSection() {
      const authToken = localStorage.getItem('auth_token');
      axios.get(`/students/pdf-least-students?section=${this.selectedLeastStudentsSection}`, {
        headers: {
          'Authorization': `Bearer ${authToken}`
        },
        responseType: 'blob'
      })
      .then(response => {
        const url = window.URL.createObjectURL(new Blob([response.data]));
        const link = document.createElement('a');
        link.href = url;
        link.setAttribute('download', `least_students_${this.selectedLeastStudentsSection}.pdf`);
        document.body.appendChild(link);
        link.click();
      })
      .catch(error => {
        console.error(error);
        if (error.response.status === 401) {
          window.location.href = '/'; // Redirect to login page if user is unauthorized
        }
      });
    },
    downloadLeastStudentsExcel(sectionId = null) {
    const authToken = localStorage.getItem('auth_token');
    let url = sectionId ? `/students/export-least-students/${sectionId}` : '/students/export';
    axios.get(url, {
      headers: {
        'Authorization': `Bearer ${authToken}`
      },
      responseType: 'blob'
    })
    .then(response => {
      const url = window.URL.createObjectURL(new Blob([response.data]));
      const link = document.createElement('a');
      if (sectionId) {
        link.setAttribute('download', `least_students_per_section_${sectionId}.xlsx`);
      } else {
        link.setAttribute('download', 'students.xlsx');
      }
      link.href = url;
      document.body.appendChild(link);
      link.click();
    })
    .catch(error => {
      console.error(error);
      if (error.response.status === 401) {
        window.location.href = '/'; // Redirect to login page if user is unauthorized
      }
    });
  },

downloadExcelLeastStudentsPerSection() {
  this.downloadLeastStudentsExcel(this.selectedLeastStudentsSection);
},
    downloadTopStudentsExcel(sectionId = null) {
    const authToken = localStorage.getItem('auth_token');
    let url = sectionId ? `/students/export-top-students/${sectionId}` : '/students/export';
    axios.get(url, {
      headers: {
        'Authorization': `Bearer ${authToken}`
      },
      responseType: 'blob'
    })
    .then(response => {
      const url = window.URL.createObjectURL(new Blob([response.data]));
      const link = document.createElement('a');
      if (sectionId) {
        link.setAttribute('download', `top_students_per_section_${sectionId}.xlsx`);
      } else {
        link.setAttribute('download', 'students.xlsx');
      }
      link.href = url;
      document.body.appendChild(link);
      link.click();
    })
    .catch(error => {
      console.error(error);
      if (error.response.status === 401) {
        window.location.href = '/'; // Redirect to login page if user is unauthorized
      }
    });
  },

downloadExcelTopStudentsPerSection() {
  this.downloadTopStudentsExcel(this.selectedTopStudentsSection);
},
downloadPDFTopStudentsPerSection() {
      const authToken = localStorage.getItem('auth_token');
      axios.get(`/students/pdf-top-students?section=${this.selectedTopStudentsSection}`, {
        headers: {
          'Authorization': `Bearer ${authToken}`
        },
        responseType: 'blob'
      })
      .then(response => {
        const url = window.URL.createObjectURL(new Blob([response.data]));
        const link = document.createElement('a');
        link.href = url;
        link.setAttribute('download', `top_students_${this.selectedTopStudentsSection}.pdf`);
        document.body.appendChild(link);
        link.click();
      })
      .catch(error => {
        console.error(error);
        if (error.response.status === 401) {
          window.location.href = '/'; // Redirect to login page if user is unauthorized
        }
      });
    },
    downloadExcelPerFilter(selectedFilterSection, selectedFilterAge, selectedFilterDropout, selectedFilterGender, selectedFilterAddress) {
  const authToken = localStorage.getItem('auth_token');
  let url = `/students/export-per-filter/${selectedFilterSection}/${selectedFilterAge}/${selectedFilterDropout}/${selectedFilterGender}/${selectedFilterAddress}?`;


  if (selectedFilterSection) {
    url += `sectionId=${selectedFilterSection}&`;
  }

  if (selectedFilterAge) {
    url += `age=${selectedFilterAge}&`;
  }

  if (selectedFilterDropout) {
    url += `dropout=${selectedFilterDropout}&`;
  }

  if (selectedFilterGender) {
    url += `gender=${selectedFilterGender}&`;
  }

  if (selectedFilterAddress) {
    url += `address=${selectedFilterAddress}&`;
  }

  axios.get(url.slice(0, -1), {
    headers: {
      'Authorization': `Bearer ${authToken}`
    },
    responseType: 'blob'
  })
  .then(response => {
    const url = window.URL.createObjectURL(new Blob([response.data]));
    const link = document.createElement('a');
    if (selectedFilterSection) {
      link.setAttribute('download', `students_section_${selectedFilterSection}.xlsx`);
    } else {
      link.setAttribute('download', 'students.xlsx');
    }
    link.href = url;
    document.body.appendChild(link);
    link.click();
  })
  .catch(error => {
    console.error(error);
    if (error.response.status === 401) {
      window.location.href = '/'; // Redirect to login page if user is unauthorized
    }
  });
},

downloadExcelPerFilterButton() {
  this.downloadExcelPerFilter(this.selectedFilterSection, this.selectedFilterAge, this.selectedFilterDropout, this.selectedFilterGender, this.selectedFilterAddress);
},
//fetch Sections from students Table
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
  //fetch Sections from students Table
    loadSections() {
      const authToken = localStorage.getItem('auth_token');
      axios.get('/students/sections', {
        headers: {
          'Authorization': `Bearer ${authToken}`
        }
      })
      .then(response => {
        this.sections = response.data;
      })
      .catch(error => {
        console.error(error);
        if (error.response.status === 401) {
          window.location.href = '/'; // Redirect to login page if user is unauthorized
        }
      });
    },
//fetch Genders from students Table
    loadGenders() {
      const authToken = localStorage.getItem('auth_token');
      axios.get('/students/genders', {
        headers: {
          'Authorization': `Bearer ${authToken}`
        }
      })
      .then(response => {
        this.genders = response.data;
      })
      .catch(error => {
        console.error(error);
        if (error.response.status === 401) {
          window.location.href = '/'; // Redirect to login page if user is unauthorized
        }
      });
    },
    //fetch Ages from students Table
    loadAges() {
      const authToken = localStorage.getItem('auth_token');
      axios.get('/students/ages', {
        headers: {
          'Authorization': `Bearer ${authToken}`
        }
      })
      .then(response => {
        this.ages = response.data;
      })
      .catch(error => {
        console.error(error);
        if (error.response.status === 401) {
          window.location.href = '/'; // Redirect to login page if user is unauthorized
        }
      });
    },
    //fetch Address from students Table
    loadDropouts() {
      const authToken = localStorage.getItem('auth_token');
      axios.get('/students/dropouts', {
        headers: {
          'Authorization': `Bearer ${authToken}`
        }
      })
      .then(response => {
        this.dropouts = response.data;
      })
      .catch(error => {
        console.error(error);
        if (error.response.status === 401) {
          window.location.href = '/'; // Redirect to login page if user is unauthorized
        }
      });
    },
    //fetch Address from students Table
    loadAddresses() {
      const authToken = localStorage.getItem('auth_token');
      axios.get('/students/addresses', {
        headers: {
          'Authorization': `Bearer ${authToken}`
        }
      })
      .then(response => {
        this.addresses = response.data;
      })
      .catch(error => {
        console.error(error);
        if (error.response.status === 401) {
          window.location.href = '/'; // Redirect to login page if user is unauthorized
        }
      });
    },
    downloadAllExcel(sectionId = null) {
      const authToken = localStorage.getItem('auth_token');
  let url = '/students/export';
  if (sectionId && typeof sectionId === 'number') {
    url = `/students/export-per-section/${sectionId}`;
  }
  axios.get(url, {
    headers: {
      'Authorization': `Bearer ${authToken}`
    },
    responseType: 'blob'
  })
  .then(response => {
    const url = window.URL.createObjectURL(new Blob([response.data]));
    const link = document.createElement('a');
    if (sectionId && typeof sectionId === 'number') {
      link.setAttribute('download', `students_section_${sectionId}.xlsx`);
    } else {
      link.setAttribute('download', 'students.xlsx');
    }
    link.href = url;
    document.body.appendChild(link);
    link.click();
  })
  .catch(error => {
    console.error(error);
    if (error.response.status === 401) {
      window.location.href = '/'; // Redirect to login page if user is unauthorized
    }
  });
  },
    downloadExcel(sectionId = null) {
  const authToken = localStorage.getItem('auth_token');
  let url = sectionId ? `/students/export-per-section/${sectionId}` : '/students/export';
  axios.get(url, {
    headers: {
      'Authorization': `Bearer ${authToken}`
    },
    responseType: 'blob'
  })
  .then(response => {
    const url = window.URL.createObjectURL(new Blob([response.data]));
    const link = document.createElement('a');
    if (sectionId) {
      link.setAttribute('download', `students_section_${sectionId}.xlsx`);
    } else {
      link.setAttribute('download', 'students.xlsx');
    }
    link.href = url;
    document.body.appendChild(link);
    link.click();
  })
  .catch(error => {
    console.error(error);
    if (error.response.status === 401) {
      window.location.href = '/'; // Redirect to login page if user is unauthorized
    }
  });
},

downloadExcelPerSection() {
  this.downloadExcel(this.selectedSection);
},

  
    downloadPDF() {
    const authToken = localStorage.getItem('auth_token');
    const queryParams = '?all=true'; // Add this to the URL
    axios.get(`/students/pdf${queryParams}`, {
      headers: {
        'Authorization': `Bearer ${authToken}`
      },
      responseType: 'blob'
    })
    .then(response => {
      const url = window.URL.createObjectURL(new Blob([response.data]));
      const link = document.createElement('a');
      link.href = url;
      link.setAttribute('download', 'students.pdf');
      document.body.appendChild(link);
      link.click();
    })
    .catch(error => {
      console.error(error);
      if (error.response.status === 401) {
        window.location.href = '/'; // Redirect to login page if user is unauthorized
      }
    });
  },

  downloadPDFPerSection() {
      const authToken = localStorage.getItem('auth_token');
      axios.get(`/students/pdf-per-section?section=${this.selectedSection}`, {
        headers: {
          'Authorization': `Bearer ${authToken}`
        },
        responseType: 'blob'
      })
      .then(response => {
        const url = window.URL.createObjectURL(new Blob([response.data]));
        const link = document.createElement('a');
        link.href = url;
        link.setAttribute('download', `students_${this.selectedSection}.pdf`);
        document.body.appendChild(link);
        link.click();
      })
      .catch(error => {
        console.error(error);
        if (error.response.status === 401) {
          window.location.href = '/'; // Redirect to login page if user is unauthorized
        }
      });
    },
   downloadPDFPerFilter() {
    const authToken = localStorage.getItem('auth_token');
let url = '/students/pdf-per-filter?';

if (this.selectedFilterSection) {
  url += `section=${this.selectedFilterSection}&`;
}

if (this.selectedFilterAge) {
  url += `age=${this.selectedFilterAge}&`;
}

if (this.selectedFilterDropout) {
  url += `dropout=${this.selectedFilterDropout}&`;
}

if (this.selectedFilterGender) {
  url += `gender=${this.selectedFilterGender}&`;
}

if (this.selectedFilterAddress) {
  url += `address=${this.selectedFilterAddress}&`;
}

axios.get(url.slice(0, -1), {
  headers: {
    'Authorization': `Bearer ${authToken}`
  },
  responseType: 'blob'
})
.then(response => {
  const url = window.URL.createObjectURL(new Blob([response.data]));
  const link = document.createElement('a');
  let filename = 'students';

  if (this.selectedSection) {
    filename += `_section_${this.selectedSection}`;
  }

  filename += '.pdf';

  link.href = url;
  link.setAttribute('download', filename);
  document.body.appendChild(link);
  link.click();
})
.catch(error => {
  console.error(error);
  if (error.response.status === 401) {
    window.location.href = '/'; // Redirect to login page if user is unauthorized
  }
});
},


  




  }
};
</script>
