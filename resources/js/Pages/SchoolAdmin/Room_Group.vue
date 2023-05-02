<template>

     
      <v-container fluid>
        <v-row>
          <schooladmin-navigation></schooladmin-navigation>
          <v-col>
          <v-toolbar>
            <v-toolbar-title>Rooms</v-toolbar-title>
          </v-toolbar>
  
   
            <v-data-table
        :headers="headers"
        :items="rooms"
        :search="search"
        sort-by="room_name"
        class="elevation-1"
      >
      
        <template v-slot:top>
          <v-text-field
              v-model="search"
              label="Search"
              class="mx-4 code"
            ></v-text-field>
          <v-toolbar flat class="px-0">
            <v-divider class="mx-4" inset vertical></v-divider>
            <v-spacer></v-spacer>
    
            <v-dialog v-model="dialog" max-width="500px">
              <template v-slot:activator="{ on, attrs }">
                <v-btn x-small fab color="primary" dark v-bind="attrs" v-on="on">
                  <v-icon dark> mdi-plus </v-icon>
                </v-btn>
              </template>
    <!-- modal for edit -->
              <v-form ref="form" v-model="valid">
                <v-card class="py-5">
                  <v-card-title class="px-5">
                    <span class="text-h6">{{ formTitle }}</span>
                  </v-card-title>
              <!--  Room name field -->
                  <v-card-text class="px-5">
                    <v-text-field
                      label="Room Name"
                      v-model="rooms_items.room_name"
                      prepend-inner-icon="mdi-pencil"
                    ></v-text-field>
    
                  </v-card-text>
                   <!--  building ID field -->
                   <v-card-text class="px-5">
                    <v-select
                      label="Building ID"
                      v-model="rooms_items.building_id"
                      :items="subjects"
                      item-value="building_id"
                      item-text="building_name"
                      prepend-inner-icon="mdi-pencil"
                      ></v-select>
    
                  </v-card-text>
                   <!--  Room number field -->
                   <v-card-text class="px-5">
                    <v-text-field
                      label="Room Number"
                      v-model="rooms_items.room_number"
                      prepend-inner-icon="mdi-pencil"
                    ></v-text-field>
    
                  </v-card-text>
                   <!--  Max Capacity field -->
                   <v-card-text class="px-5">
                    <v-text-field
                      label="Maximum Capacity"
                      v-model="rooms_items.maximum_capacity"
                      prepend-inner-icon="mdi-pencil"
                    ></v-text-field>
    
                  </v-card-text>
                  
                  <v-card-actions class="px-5">
                    <v-spacer></v-spacer>
                    <v-tooltip top>
                      <template v-slot:activator="{ on, attrs }">
                        <v-btn
                          x-small
                          fab
                          dark
                          color="primary"
                          v-bind="attrs"
                          v-on="on"
                          @click="Submit"
                          :disabled="!valid"
                        >
                          <v-icon style="color: #fff !important">
                            mdi-check
                          </v-icon>
                        </v-btn>
                      </template>
                      <span>Save</span>
                    </v-tooltip>
                    <v-tooltip top>
                      <template v-slot:activator="{ on, attrs }">
                        <v-btn
                          x-small
                          fab
                          dark
                          color="secondary"
                          v-bind="attrs"
                          v-on="on"
                          class="ml-2"
                          @click="close"
                        >
                          <v-icon style="color: #fff !important">
                            mdi-close
                          </v-icon>
                        </v-btn>
                      </template>
                      <span>Cancel</span>
                    </v-tooltip>
                  </v-card-actions>
                </v-card>
              </v-form>
            </v-dialog>
    
            <v-dialog v-model="dialogDelete" max-width="500px">
              <v-card>
                <v-card-title class="text-h6 justify-center">
                  Are you sure you want to delete?
                </v-card-title>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-tooltip top>
                    <template v-slot:activator="{ on, attrs }">
                      <v-btn
                        x-small
                        fab
                        dark
                        color="secondary"
                        v-bind="attrs"
                        v-on="on"
                        class="ml-2"
                        @click="closeDelete"
                      >
                        <v-icon style="color: #fff !important">
                          mdi-close
                        </v-icon></v-btn
                      >
                    </template>
                    <span>Cancel</span>
                  </v-tooltip>
                  <v-tooltip top>
                    <template v-slot:activator="{ on, attrs }">
                      <v-btn
                        x-small
                        fab
                        dark
                        color="error"
                        v-bind="attrs"
                        v-on="on"
                        class="ml-2"
                        @click="deleteItemConfirm"
                      >
                        <v-icon style="color: #fff !important">
                          mdi-check
                        </v-icon></v-btn
                      >
                    </template>
                    <span>Continue</span>
                    
                  </v-tooltip>
                  
                  <v-spacer></v-spacer>
                </v-card-actions>
                
              </v-card>
              
            </v-dialog>
          </v-toolbar>
          
      </template>
      
      <template v-slot:item.actions="{ item }">
        <v-icon small class="mr-2" @click="editItem(item)"> mdi-pencil </v-icon>
        <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
        <!-- <v-btn depressed @click="TimeOut(item.id)"> 
          Time Out
        </v-btn>-->
      </template>
      </v-data-table>
        
        </v-col>
          </v-row>
        </v-container>
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
   
    data: () => ({
        dialog: false,
        dialogDelete: false,
        headers: [
          { text: "Room Name", value: "room_name" },
          { text: "Building ID", value: "building_id" },
          { text: "Room Number", value: "room_number" },
          { text: "Maximum Capacity", value: "maximum_capacity" },
        
        { text: "Actions", value: "actions", sortable: false, align: "right" },

         
        ],
        search:"",
        subjects: [],
        rooms: [],
        rooms_items:{
          room_name:"",
          building_id:"",
          room_number:"",
          maximum_capacity:"",
              
        },
        editedIndex: -1,
        defaultItem: {  
          room_name:"",
          building_id:"",
          room_number:"",
          maximum_capacity:"",
             
        },
        id:null,
        valid: false,
     
     
     
      }),
      computed: {
        formTitle() {
          return this.editedIndex === -1 ? "New Room" : "Edit Room";
        },
      },
      watch: {
        dialog(val) {
          val || this.close();
        },
        dialogDelete(val) {
          val || this.closeDelete();
        },
      },
      created() {
        this.initialize();
        this.fetchBuildings();
      },
      methods: {
        async fetchBuildings() {
          try {
          const response = await axios.get('/buildings');
          this.subjects = response.data;
          } catch (error) {
          console.error(error);
          }
      },
        logout() {
        axios.post('/logout')
          .then(response => {
            // Success message
            console.log(response.data.message);
            // Redirect to the login page
            this.$router.push('/login');
          })
          .catch(error => {
            console.log(error.response.data.message);
          });
      },
        initialize() {
          this.RoomList();
        },
        async RoomList() {
          var res = await axios.get("/rooms");
          if (res.status === 200) this.rooms = res.data;
          else {
            this.$Notice.error({
              title: "Error",
              desc: "Error occurred while loading data",
            });
          }
        },
        editItem(item) {
          this.id = item.id;
          this.editedIndex = this.rooms.indexOf(item);
          this.rooms_items = Object.assign({}, item);
          this.dialog = true;
          // console.log(item);
        },
        deleteItem(item) {
          // this.editedIndex = this.tmcDepartments.indexOf(item);
          // this.editedItem = Object.assign({}, item);
          this.id = item.id;
          this.dialogDelete = true;
        },
        async deleteItemConfirm() {
          var res = await axios.delete("/rooms/delete/" + this.id);
          if (res.status === 200) {
            this.RoomList();
            // this.tmcDepartments.splice(this.editedIndex, 1);
            this.closeDelete();
          } else {
            this.$Notice.error({
              title: "Error",
              desc: "Error occurred while loading data",
            });
          }
        },
        close() {
          this.dialog = false;
          this.$nextTick(() => {
            this.rooms_items = Object.assign({}, this.defaultItem);
            this.editedIndex = -1;
          });
        },
        closeDelete() {
          this.dialogDelete = false;
          this.$nextTick(() => {
            this.editedItem = Object.assign({}, this.defaultItem);
            this.editedIndex = -1;
          });
        },
        Submit() {
          if (this.$refs.form.validate()) {
            if (this.id) {
              axios
                .put("/rooms/update/" + this.id, this.rooms_items)
                .then((response) => {
                  this.RoomList();
                  this.close();
                })
                .catch((error) => {
                  console.error("There was an error!", error);
                });
            } else {
              axios
                .post("/rooms/create", this.rooms_items)
                .then((response) => {
                  this.RoomList();
                  this.close();
                })
                .catch((error) => {
                  console.error("There was an error!", error);
                });
              // this.close();
            }
          }
        },
      },
  };
  </script>