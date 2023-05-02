<style>
  .my-toolbar {
    margin-bottom: 20px;
  }
  .card-height {
    height: 100%;
  }
</style>
<template>
  <v-container fluid>
    <v-row>
      <student-navigation></student-navigation>
      <v-col>
      <v-toolbar>
        <v-toolbar-title>Student Payment</v-toolbar-title>
      </v-toolbar>
          <v-card-text>
            <v-layout justify-space-between>
              <v-list-item>
                  <v-card
                    class="mx-auto card-height"
                    style="padding: 3%; width: 100%;"
                  >
                  <v-container>
                <v-row>
                  <v-col>
                    <v-card-text>
                      <p class="text-h4 text--primary">
                        Tuition 
                      </p>
                      <div class="text--primary" style="width: 140%;">
                        Payment is Due on April 28, 2023
                      </div>
                    </v-card-text>
                  </v-col>

                  <v-spacer></v-spacer>

                  <v-col>
                    <v-card-text  class="d-flex justify-end">
                      <p class="text-h4 text--primary">
                        ₱999
                      </p>
                    </v-card-text>
                  </v-col>
                </v-row>
              </v-container>
                    <v-card-actions class="d-flex justify-end bg-surface-variant">
                      <v-btn variant="text" color="primary">Pay</v-btn>
                      <v-btn variant="text" color="primary">Dismiss</v-btn>
                    </v-card-actions>
                  </v-card>
              </v-list-item>
              <v-list-item>
                  <v-card
                    class="mx-auto card-height"
                    style="padding: 3%; width: 100%;"
                  >
                  <v-container>
                <v-row>
                  <v-col>
                    <v-card-text>
                      <p class="text-h4 text--primary">
                        Miscellaneous 
                      </p>
                      <div class="text--primary" style="width: 140%;">
                        Payment is Due on April 28, 2023
                      </div>
                    </v-card-text>
                  </v-col>

                  <v-spacer></v-spacer>

                  <v-col>
                    <v-card-text  class="d-flex justify-end">
                      <p class="text-h4 text--primary">
                        ₱999
                      </p>
                    </v-card-text>
                  </v-col>
                </v-row>
              </v-container>
                    <v-card-actions class="d-flex justify-end bg-surface-variant">
                      <v-btn variant="text" color="primary">Pay</v-btn>
                      <v-btn variant="text" color="primary">Dismiss</v-btn>
                    </v-card-actions>
                  </v-card>
              </v-list-item>
              <v-list-item>
                  <v-card
                    class="mx-auto card-height"
                    style="padding: 3%; width: 100%;"
                  >
                  <v-container>
                <v-row>
                  <v-col>
                    <v-card-text>
                      <p class="text-h4 text--primary">
                        ExtraCurricular
                      </p>
                      <div class="text--primary">
                        Payment is Due on April 28, 2023
                      </div>
                    </v-card-text>
                  </v-col>

                  <v-spacer></v-spacer>

                  <v-col>
                    <v-card-text  class="d-flex justify-end">
                      <p class="text-h4 text--primary">
                        ₱999
                      </p>
                    </v-card-text>
                  </v-col>
                </v-row>
              </v-container>
                    <v-card-actions class="d-flex justify-end bg-surface-variant">
                      <v-btn variant="text" color="primary">Pay</v-btn>
                      <v-btn variant="text" color="primary">Dismiss</v-btn>
                    </v-card-actions>
                  </v-card>
              </v-list-item>
            </v-layout>
          </v-card-text>
        </v-col>
    </v-row>
  </v-container>
</template>
  
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
    methods: {
          logout() {
          // Your logout implementation here
    
          // Redirect to the login page
          this.$router.push('/login');
        },
      },
  }
  </script>