<template>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Bets Page</div>
          <div class="card-body">
            <data-table
              :columns="columns"
              url="/bets/allData"
              order-by="betId"
              :filters="filters"
              order-dir="desc"
              :per-page="perpage"
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
                    <input
                      name="name"
                      class="form-control"
                      v-model="tableFilters.filters.betId"
                      placeholder="Search betId"
                    />
                  </div>
                  <div class="col">
                    <input
                      name="name"
                      class="form-control"
                      v-model="tableFilters.filters.bureauNo"
                      placeholder="Search bureau No"
                    />
                  </div>
                  <div class="col">
                    <input
                      name="name"
                      class="form-control"
                      v-model="tableFilters.filters.playerId"
                      placeholder="Search playerId"
                    />
                  </div>
                  <div class="col">
                    <select
                      v-model="tableFilters.filters.currency"
                      class="form-control"
                    >
                      <option value>Currency</option>
                      <option
                        v-for="(currency, index) in currencylist"
                        :value="index"
                        >{{ currency }}</option
                      >
                    </select>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-md-4">
                    <b-form-datepicker
                      v-model="filters.datepicker"
                      id="datepicker"
                      locale="en"
                      class="mb-2"
                      today-button
                      reset-button
                      close-button
                      :max="max"
                    ></b-form-datepicker>
                  </div>
                  <div class="col-md-3">
                    <b-form-timepicker
                      v-model="filters.startTime"
                      locale="en"
                    ></b-form-timepicker>
                  </div>
                  ~
                  <div class="col-md-3">
                    <b-form-timepicker
                      v-model="filters.endTime"
                      locale="en"
                    ></b-form-timepicker>
                  </div>
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
export default {
  props: ["currencylist", "configcurrency"],
  mounted() {
    // console.log(this.data)
    // console.log(typeof this.data);
  },
  // methods: {
  //     checkID: function(data) {
  //         console.log(typeof data);
  //     },
  // },
  data() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, "0");
    var mm = String(today.getMonth() + 1).padStart(2, "0");
    var yyyy = today.getFullYear();
    today = String(yyyy + "-" + mm + "-" + dd);
    return {
      max: today,
      filters: {
        currency: "",
        bureauNo: "",
        datepicker: today,
        startTime: "00:00:00",
        endTime: "23:59:59",
        betId: "",
        playerId: ""
      },
      perpage: ["100", "250", "500"],
      columns: [
        { name: "betId", label: "Bet Id", orderable: true },
        { name: "bureauNo", label: "Bureau No", orderable: true },
        { name: "gameName", label: "Game Name", orderable: true },
        { name: "playerId", label: "Player Id", orderable: true },
        {
          name: "currency",
          label: "Currency",
          orderable: true,
          transform: ({ data, name }) => `${this.configcurrency[data[name]]}`
        },
        { name: "betTime", label: "Bet Time", orderable: true },
        {
          name: "stake",
          label: "Stake",
          orderable: true,
          transform: ({ data, name }) =>
            "$ " + new Intl.NumberFormat().format(data[name])
        },
        {
          name: "winning",
          label: "Winning",
          orderable: true,
          transform: ({ data, name }) =>
            "$ " + new Intl.NumberFormat().format(data[name])
        },
        {
          name: "GGR",
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
