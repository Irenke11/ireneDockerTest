<template>
  <div id="app">
    <div class="container-fluid">
      <div class="col justify-content-center">
        <b-form class="row">
          <!-- <div class="col"> -->
          <!-- <label for="">Time range: </label> -->
          <!-- <date-range-picker
                v-model="form.dateRange"
                :locale-data="{ format: 'yyyy-mm-dd' }"
                :autoApply="autoApply"
              >
              </date-range-picker> -->
          <div class="col">
            <b-form-datepicker
              v-model="form.dateRange.startDate"
              id="datepicker"
              locale="en"
              class="mb-2"
              today-button
              reset-button
              close-button
              :max="form.max"
            ></b-form-datepicker>
          </div>
          ~
          <div class="col">
            <b-form-datepicker
              v-model="form.dateRange.endDate"
              id="datepicker2"
              locale="en"
              class="mb-2"
              today-button
              reset-button
              close-button
              :max="form.max"
            ></b-form-datepicker>
          </div>
          <!-- </div> -->
          <div class="col">
            <select v-model="form.currency" class="form-control">
              <option value>Currency</option>
              <option
                v-for="(currency, index) in opencurrencylist"
                :value="index"
                >{{ currency }}</option
              >
            </select>
          </div>
          <div class="col">
            <select v-model="form.gametype" class="form-control">
              <option value>Game Type</option>
              <option
                v-for="(gametype, index) in opengametypelist"
                :value="index"
                >{{ gametype }}</option
              >
            </select>
          </div>
          <div class="col">
            <b-button
              @click="onSubmit"
              type="button"
              class="col "
              variant="primary"
              >Submit</b-button
            >
          </div>
          <div class="col">
            <select v-model="chartdataloaded" class="form-control">
              <option v-for="(item, index) in test" :key="index" :value="item">
                {{ item["datasets"][0]["select"] }}
              </option>
            </select>
          </div>
        </b-form>
      </div>
      <div id="Chart">
        <Chart v-if="chart_loaded" :chart-data="chartdataloaded" />
      </div>
      <!-- 圓餅圖 -->
      <!-- <div id="Pie">
              <Pie v-if="chart_loaded" :chart-data="chartdataloaded" />
            </div> -->
      <!-- 圓餅圖 -->
      <div v-if="noData">
        <p>No data</p>
      </div>
    </div>
  </div>
</template>
<script>
import Chart from "./components/Chart.vue";
import Pie from "./components/Pie.vue";
import DateRangePicker from "vue2-daterange-picker";
import "vue2-daterange-picker/dist/vue2-daterange-picker.css";

export default {
  props: [
    "currencylist",
    "gametypelist",
    "opencurrencylist",
    "opengametypelist"
  ],
  name: "App",
  components: {
    Chart,
    Pie,
    DateRangePicker
  },
  data() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, "0");
    var mm = String(today.getMonth() + 1).padStart(2, "0");
    var yyyy = today.getFullYear();
    today = String(yyyy + "-" + mm + "-" + dd);
    return {
      filters: {
        currency: "",
        gametype: ""
      },
      chart_loaded: true /* 圖表讀取 */,
      form: {
        dateRange: {
          startDate: today + " 00:00:00",
          endDate: today + " 23:59:59",
          max: today
        },
        currency: "",
        gametype: ""
      },
      autoApply: true,
      chartData: {
        Books: 24,
        Magazine: 30,
        Newspapers: 10
      },
      noData: false,
      chartdataloaded: {},
      test: [
        // {
        //   labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        //   datasets: [
        //     {
        //       label: '測試1',
        //       borderColor: 'red',
        //       pointBackgroundColor: 'red',
        //       borderWidth: 1,
        //       pointBorderColor: 'white',
        //       data: [40, 35, 10, 40, 39, 80, 40],
        //     },
        //   ],
        // }
      ]
    };
  },
  mounted() {
    this.onSubmit();
  },
  methods: {
    onSubmit(event) {
      const vm = this;
      axios
        .post("/bets/barChartData", this.form)
        .then(function(response) {
          vm.noData = response.data.noData;
          vm.chartdataloaded = response.data.chartdataloaded;
          vm.test = response.data.test;
        })
        .catch(error => {
          // 请求失败处理
          console.log(error + "!  error !");
        });
    }
  }
};
</script>

<style>
#app {
  /* font-family: "Avenir", Helvetica, Arial, sans-serif; */
  /* -webkit-font-smoothing: antialiased; */
  /* -moz-osx-font-smoothing: grayscale; */
  /* text-align: center; */
  color: #2c3e50;
  /* margin-top: 60px; */
}
.calendars {
  flex-wrap: nowrap !important;
}
</style>
