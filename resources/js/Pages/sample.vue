<template>
    <v-data-table
      :headers="headers"
      :items="samples"
      :search="search"
      sort-by="sample"
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
  
            <v-form ref="form" v-model="valid">
              <v-card class="py-5">
                <v-card-title class="px-5">
                  <span class="text-h6">{{ formTitle }}</span>
                </v-card-title>
  
                <v-card-text class="px-5">
                  <v-text-field
                    label="Title"
                    v-model="samples_items.sample"
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
  </template>
  <script>
  export default {
    data: () => ({
      dialog: false,
      dialogDelete: false,
      headers: [
        { text: "Title", value: "sample" },
         { text: "First name", value: "sample" },
         { text: "Last name", value: "sample" },
         { text: "Middle name", value: "sample" },
        { text: "Actions", value: "actions", sortable: false, align: "right" },
      ],
      search:"",
      samples: [],
      samples_items:{
            sample:"",
      },
      editedIndex: -1,
      defaultItem: {  
            sample:"",
      },
      id:null,
      valid: false,
   
   
   
    }),
    computed: {
      formTitle() {
        return this.editedIndex === -1 ? "New Sample" : "Edit Sample";
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
      initialize() {
        this.SampleList();
      },
      async SampleList() {
        var res = await axios.get("/samples");
        if (res.status === 200) {
          this.samples = res.data;
        console.log(res.data);
        }else {
          this.$Notice.error({
            title: "Error",
            desc: "Error occurred while loading data",
          });
        }
      },
      editItem(item) {
        this.id = item.id;
        this.editedIndex = this.samples.indexOf(item);
        this.samples_items = Object.assign({}, item);
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
        var res = await axios.delete("/samples/delete/" + this.id);
        if (res.status === 200) {
          this.SampleList();
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
          this.samples_items = Object.assign({}, this.defaultItem);
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
              .put("/samples/update/" + this.id, this.samples_items)
              .then((response) => {
                this.SampleList();
                this.close();
              })
              .catch((error) => {
                console.error("There was an error!", error);
              });
          } else {
            axios
              .post("/samples/create", this.samples_items)
              .then((response) => {
                this.SampleList();
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