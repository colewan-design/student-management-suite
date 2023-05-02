<template>
  <v-card height="100%">
    <v-layout>
      <finance-navigation></finance-navigation>
<v-main>
    <v-toolbar color="primary" dark>
      <v-toolbar-title>Finance Officer Dashboard</v-toolbar-title>
    </v-toolbar>

    <v-container fluid>
    <v-row>
      <v-col cols="12" md="6">
        <v-card>
          <v-card-title>Income</v-card-title>
          <v-card-text>
            <v-data-table :headers="incomeHeaders" :items="incomeData" hide-default-footer>
              <template v-slot:[`item.total`]="{ item }">
                {{ formatCurrency(item.total) }}
              </template>
            </v-data-table>
          </v-card-text>
        </v-card>
      </v-col>
      <v-col cols="12" md="6">
        <v-card>
          <v-card-title>Expenses</v-card-title>
          <v-card-text>
            <v-data-table :headers="expensesHeaders" :items="expensesData" hide-default-footer>
              <template v-slot:[`item.total`]="{ item }">
                {{ formatCurrency(item.total) }}
              </template>
            </v-data-table>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12">
        <v-card>
          <v-card-title>School Revenue</v-card-title>
          <v-card-text>
            <v-chart :options="chartOptions" :series="chartSeries"></v-chart>
          </v-card-text>
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
  data() {
    return {
      incomeHeaders: [
        { text: 'Type', value: 'type' },
        { text: 'Total', value: 'total' },
      ],
      incomeData: [
        { type: 'Tuition', total: 100000 },
        { type: 'Donations', total: 5000 },
        { type: 'Other', total: 2000 },
      ],
      expensesHeaders: [
        { text: 'Type', value: 'type' },
        { text: 'Total', value: 'total' },
      ],
      expensesData: [
        { type: 'Salaries', total: 60000 },
        { type: 'Supplies', total: 20000 },
        { type: 'Rent', total: 10000 },
      ],
      chartOptions: {
        chart: {
          type: 'pie',
        },
        labels: ['Income', 'Expenses'],
        colors: ['#4CAF50', '#F44336'],
      },
      chartSeries: [125000, 90000],
    };
  },
  methods: {
    formatCurrency(value) {
      return `Php ${value.toLocaleString()}.00`;
    },
  },
};
</script>