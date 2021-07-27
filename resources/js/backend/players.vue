<template>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Players Page</div>
          <div class="card-body">
            <data-table
              :columns="columns"
              url="/players/allData"
              order-by="playerId"
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
                      v-model="tableFilters.filters.playerId"
                      placeholder="Search playerId"
                    />
                  </div>
                  <div class="col">
                    <input
                      name="name"
                      class="form-control"
                      v-model="tableFilters.search"
                      placeholder="Search Name&Account"
                    />
                  </div>
                  <div class="col">
                    <select
                      v-model="tableFilters.filters.currency"
                      class="form-control"
                    >
                      <option value>Currency</option>
                      <option v-for="id in opencurrencylist" :value="id['id']">
                        {{ data[id["id"]] }}</option
                      >
                    </select>
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
import Buttonexp from "./tools/button.vue";
export default {
  props: ["data", "opencurrencylist"],
  mounted() {
    // console.log(this.data);
  },
  // methods: {
  //     checkID: function(data) {
  //         console.log(typeof data);
  //     },
  // },
  data() {
    return {
      filters: {
        currency: ""
      },
      perpage: ["100", "250", "500"],
      columns: [
        { name: "playerId", label: "Id", orderable: true },
        { name: "account", label: "Account", orderable: true },
        { name: "name", label: "Name", orderable: true },
        {
          name: "currency",
          label: "Currency",
          orderable: true,
          transform: ({ data, name }) => `${this.data[data[name]]}`
        },
        {
          name: "status",
          label: "Open",
          orderable: true,
          transform: ({ data, name }) => `${data[name] == 1 ? "✓" : "x"}`
        },
        { name: "created_at", label: "Created", orderable: true },
        {
          label: "Edit",
          name: "Edit",
          orderable: false,
          classes: {
            btn: true,
            "btn-primary": true,
            "btn-sm": true
          },
          transform: ({ data, name }) => `${data["playerId"]}`,
          event: "click",
          handler: this.edit,
          component: Buttonexp
        }
        // ,{
        //   label: "Bet",
        //   name: "Bet",
        //   orderable: false,
        //   classes: {
        //     btn: true,
        //     "btn-primary": true,
        //     "btn-sm": true
        //   },
        //   transform: ({ data, name }) => `${data["playerId"]}`,
        //   event: "click",
        //   handler: this.Bet,
        //   component: Buttonexp
        // }
      ]
    };
  },
  components: {
    // eslint-disable-next-line
    Buttonexp
  },
  methods: {
    edit(data) {
      // alert(`You clicked row ${data["gameId"]}`);
      location.href = "edit/" + data["playerId"];
    },
    Bet(data) {
      // alert(`You clicked row ${data["gameId"]}`);
      location.href = "/bets/all?playerId=" + data["playerId"];
    }
  }
};
</script>
