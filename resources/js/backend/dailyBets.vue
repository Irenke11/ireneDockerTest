<template>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Daily Bets Page</div>
          <div class="card-body">
            <data-table
              :columns="columns"
              url="/dailyBets/allData"
              order-by="id"
              :filters="filters"
              order-dir="desc"
            >
              <div slot="filters" slot-scope="{ tableFilters, perPage }">
                <div class="row mb-2">
                  <div class="col">
                    <select class="form-control" v-model="tableFilters.length">
                      <option :key="page" v-for="page in perPage">{{
                        page
                      }}</option>
                    </select>
                  </div>
                  <div class="col">
                    <b-form-datepicker
                      v-model="tableFilters.filters.datepicker"
                      id="datepicker"
                      locale="en"
                      class="mb-2"
                      today-button
                      reset-button
                      close-button
                    ></b-form-datepicker>
                  </div>
                  <div class="col">
                    <select
                      v-model="tableFilters.filters.currency"
                      class="form-control"
                    >
                      <option value>Currency</option>
                      <option
                        v-for="(currency, index) in opencurrencylist"
                        :value="index"
                        >{{ currency }}</option
                      >
                    </select>
                  </div>
                  <div class="col">
                    <select
                      v-model="tableFilters.filters.gametype"
                      class="form-control"
                    >
                      <option value>Game Type</option>
                      <option value="All">All</option>
                      <option
                        v-for="(gametype, index) in opengametypelist"
                        :value="index"
                        >{{ gametype }}</option
                      >
                    </select>
                  </div>
                  <!-- 時間 -->
                  <!-- <div class="col">
                    <b-form-timepicker
                      v-model="filters.startTime"
                      locale="en"
                    ></b-form-timepicker>
                  </div>
                  ~
                  <div class="col">
                    <b-form-timepicker
                      v-model="filters.endTime"
                      locale="en"
                    ></b-form-timepicker>
                  </div> -->
                  <!-- 時間 -->
                </div>
              </div>
            </data-table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import DataTableCurrencyCell from "./tools/DataTableCurrencyCell.vue";
export default {
  props: [
    "currencylist",
    "gametypelist",
    "opencurrencylist",
    "opengametypelist"
  ],
  mounted() {
    // console.log(this.data);
    // console.log(typeof this.data);
  },
  // methods: {
  //     checkID: function(data) {
  //         console.log(typeof data);
  //     },
  // },
  components: {
    DataTableCurrencyCell
  },
  data() {
    var yesterday = new Date(Date.now() - 864e5);
    var dd = String(yesterday.getDate()).padStart(2, "0");
    var mm = String(yesterday.getMonth() + 1).padStart(2, "0");
    var yyyy = yesterday.getFullYear();
    yesterday = String(yyyy + "-" + mm + "-" + dd);

    return {
      filters: {
        search: "",
        datepicker: yesterday,
        startTime: "00:00:00",
        endTime: "23:59:59",
        currency: "",
        gametype: ""
      },
      columns: [
        { name: "id", label: "Id", orderable: true },
        {
          name: "gameType",
          label: "Game Type",
          orderable: true,
          transform: ({ data, name }) => `${this.gametypelist[data[name]]}`
        },
        {
          name: "currency",
          label: "currency",
          orderable: true,
          transform: ({ data, name }) => `${this.currencylist[data[name]]}`
        },
        { name: "betsDay", label: "Bets Day", orderable: true },
        { name: "count", label: "Count", orderable: true },
        {
          name: "allStake",
          label: "Stake",
          orderable: true,
          transform: ({ data, name }) =>
            "$ " + new Intl.NumberFormat().format(data[name])
        },
        {
          name: "allWinning",
          label: "Winning",
          orderable: true,
          transform: ({ data, name }) =>
            "$ " + new Intl.NumberFormat().format(data[name])
        },
        {
          name: "allGGR",
          label: "GGR",
          orderable: true,
          transform: ({ data, name }) =>
            "$ " + new Intl.NumberFormat().format(data[name])
        }
      ]
    };
  }
};
</script>
