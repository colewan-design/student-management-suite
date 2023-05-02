<template>
  <v-card height="100%">
    <v-layout>
      <staff-navigation></staff-navigation>
  <v-main>
    <v-toolbar color="primary" dark>
      <v-toolbar-title>Staff Dashboard</v-toolbar-title>
    </v-toolbar>

    <v-container>
      <v-row>
        <v-col cols="6">
          <v-card color="red" style="height: 150px;" to="finance_officer_dashboard">
            <v-card-title style="font-size: 22px; font-weight: bold;">
              Finance
            </v-card-title>
            <v-icon color="white" style="padding-left: 500px; font-size: 50px;">mdi-currency-usd</v-icon>
          </v-card>
        </v-col>
        <v-col cols="6">
          <v-card color="blue" style="height: 150px;" to="guard_dashboard">
            <v-card-title style="font-size: 22px; font-weight: bold;">
              Guards
            </v-card-title>
            <v-icon color="white" style="padding-left: 500px; font-size: 50px;">mdi-security</v-icon>
          </v-card>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="6">
          <v-card color="green" style="height: 150px;" to="school_admin_dashboard">
            <v-card-title style="font-size: 22px; font-weight: bold;">
              School Admin
            </v-card-title>
            <v-icon color="white" style="padding-left: 500px; font-size: 50px;">mdi-account-tie</v-icon>
          </v-card>
        </v-col>
        <v-col cols="6">
          <v-card color="yellow" style="height: 150px;">
            <v-card-title style="font-size: 22px; font-weight: bold;">
              Profiles
            </v-card-title>
            <v-icon color="black" style="padding-left: 500px; font-size: 50px;">mdi-account-circle</v-icon>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-main>
</v-layout>
  </v-card>
</template>

<script>
import StaffNavigation from "./components/StaffNavigation.vue";
export default {
  components:{
    StaffNavigation: StaffNavigation,
  },
};
</script>

<script>
export default {
 
  data: () => ({
      dialog: false,
      dialogDelete: false,
      headers: [
        { text: "First Name", value: "first_name" },
       { text: "Last Name", value: "last_name" },
       { text: "Email", value: "email" },
       { text: "Role", value: "role" },
       { text: "Contract Type", value: "contract_type" },
       { text: "Shift", value: "shift" },
       { text: "Location", value: "location" },
       { text: "Joining Date", value: "joining_date" },
      { text: "Actions", value: "actions", sortable: false, align: "right" },

       
      ],
      search:"",
      staffs: [],
      staffs_items:{
            first_name:"",
            last_name:"",
            email:"",
            role:"",
            contract_type:"",
            shift:"",
            location:"",
            joining_date:"",
      },
      editedIndex: -1,
      defaultItem: {  
            staff:"",
      },
      id:null,
      valid: false,
   
   
   
    }),
    computed: {
      formTitle() {
        return this.editedIndex === -1 ? "New Staff" : "Edit Staff";
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
    },
    methods: {
      logout() {
      // Your logout implementation here

      // Redirect to the login page
      this.$router.push('/login');
    },
      initialize() {
        this.StaffList();
      },
      async StaffList() {
        var res = await axios.get("/staffs");
        if (res.status === 200) this.staffs = res.data;
        else {
          this.$Notice.error({
            title: "Error",
            desc: "Error occurred while loading data",
          });
        }
      },
      editItem(item) {
        this.id = item.id;
        this.editedIndex = this.staffs.indexOf(item);
        this.staffs_items = Object.assign({}, item);
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
        var res = await axios.delete("/staffs/delete/" + this.id);
        if (res.status === 200) {
          this.StaffList();
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
          this.staffs_items = Object.assign({}, this.defaultItem);
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
              .put("/staffs/update/" + this.id, this.staffs_items)
              .then((response) => {
                this.StaffList();
                this.close();
              })
              .catch((error) => {
                console.error("There was an error!", error);
              });
          } else {
            axios
              .post("/staffs/create", this.staffs_items)
              .then((response) => {
                this.StaffList();
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