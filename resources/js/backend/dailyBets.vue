<template>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Daily Bets page</div>
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
                      v-model="filters.datepicker"
                      id="datepicker"
                      locale="en"
                      class="mb-2"
                      today-button
                      reset-button
                      close-button
                    ></b-form-datepicker>
                  </div>
                  <div class="col">
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
  props: ["data"],
  mounted() {
    // console.log(this.data);
    // console.log(typeof this.data);
  },
  // methods: {
  //     checkID: function(data) {
  //         console.log(typeof data);
  //     },
  // },
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
        endTime: "23:59:59"
      },
      columns: [
        { name: "id", label: "Id", orderable: true },
        { name: "gameType", label: "gameType", orderable: true },
        { name: "betsDay", label: "betsDay", orderable: true },
        { name: "count", label: "count", orderable: false },
        { name: "allAmount", label: "allAmount", orderable: false },
        { name: "allPayout", label: "allPayout", orderable: false },
        { name: "allProfit", label: "allProfit", orderable: false }
      ]
    };
  }
};
</script>
