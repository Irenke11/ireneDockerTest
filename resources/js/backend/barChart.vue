<template>
  <div id="app">
     <div class="container">
        <div class="row justify-content-center">
          <div class="col">
            <div class="row">
              <b-form class="pr-3">
                <label for="">Time: </label>
                <date-range-picker
                  v-model="dateRange"
                  :locale-data="{ format: 'yyyy-mm-dd' }"
                  :maxDate="new Date()"
                  :autoApply="autoApply"
                ></date-range-picker>

                <b-button @click="onSubmit" type="button"  class="" variant="primary">Submit</b-button>
              </b-form>

              <select v-model="chartdataloaded" class="">
                <option v-for="(item, index) in test" :key="index" :value="item">
                  {{ item["datasets"][0]["label"] }}
                </option>
              </select>
              
            </div>

            <div id="Chart">
              <Chart v-if="chart_loaded" :chart-data="chartdataloaded" />
            </div>

            <div id="Pie">
              <Pie v-if="chart_loaded" :chart-data="chartdataloaded" />
            </div>

            <div v-if="noData">
              <p>No data</p>
            </div>
          </div>
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
  // extends: Line,
  props: ["startdate", "enddate"],
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
      chart_loaded: true /* 圖表讀取 */,
      dateRange: {
        startDate: today,
        endDate: today,
        max: today,
      },
      autoApply:true,
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
    // this.renderChart(this.chartData, this.options);
  },
  methods: {
    onSubmit(event) {
      // event.preventDefault();
      // alert(JSON.stringify(this.dateRange));
      const vm = this;
      axios
        .post("/bets/barChartData", this.dateRange)
        .then(function(response) {
          // alert(JSON.stringify(response.data.dateRange));
          // console.log(response.data);
          vm.noData=response.data.noData;
          vm.chartdataloaded = response.data.chartdataloaded;
          vm.test = response.data.test;
        })
        .catch(error => {
          // 请求失败处理
          console.log(error + "111111111 error !!!!!!!");
        });
    }
    // dateFormat(classes, date) {
    //   if (!classes.disabled) {
    //     classes.disabled = date.getTime() < new Date();
    //   }
    //   return classes;
    // }
  }
};
</script>

<style>
#app {
  /* font-family: "Avenir", Helvetica, Arial, sans-serif; */
  /* -webkit-font-smoothing: antialiased; */
  /* -moz-osx-font-smoothing: grayscale; */
  text-align: center;
  color: #2c3e50;
  /* margin-top: 60px; */
}
.calendars{
  flex-wrap: nowrap !important;
}
</style>
