
<template>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Games Page</div>
          <div class="card-body">
            <data-table
              :columns="columns"
              url="/games/allData"
              order-by="gameId"
              :filters="filters"
              order-dir="desc"
            >
              <div slot="filters" slot-scope="{ tableFilters, perPage }">
                <div class="row mb-2">
                  <div class="col col-md-2">
                    <select class="form-control" v-model="tableFilters.length">
                      <option :key="page" v-for="page in perPage">{{
                        page
                      }}</option>
                    </select>
                  </div>
                  <div class="col col-md-3">
                    <input
                      name="SearchgameId"
                      class="form-control"
                      v-model="tableFilters.filters.gameId"
                      placeholder="Search Game Id"
                    />
                  </div>
                  <div class="col  col-md-3">
                    <select
                      v-model="tableFilters.filters.gameType"
                      class="form-control"
                    >
                      <option value>Game Type</option>
                      <option v-for="gametype in data" :value="gametype">{{
                        gametype
                      }}</option>
                      <!-- <option value="slot">Slot</option>
                      <option value="poker">Poker</option>
                      <option value="fish">Fish</option> -->
                    </select>
                  </div>
                  <div class="col col-md-4">
                    <input
                      name="name"
                      class="form-control"
                      v-model="tableFilters.search"
                      placeholder="Search Name"
                    />
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
  props: ["data"],
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
    return {
      filters: {
        gameType: ""
      },
      columns: [
        { name: "gameId", label: "Id", orderable: true },
        { name: "gameType", label: "Type", orderable: true },
        {
          name: "gameNameEn",
          label: "Name English",
          orderable: true,
          transform: ({ data, name }) => `${JSON.parse(data["gameName"]).en}`
        },
        {
          name: "gameNameCn",
          label: "Name Chinses",
          orderable: true,
          transform: ({ data, name }) => `${JSON.parse(data["gameName"]).cn}`
        },
        {
          name: "gameNameTw",
          label: "Name TaiWan",
          orderable: true,
          transform: ({ data, name }) => `${JSON.parse(data["gameName"]).tw}`
        },
        { name: "created_at", label: "Created", orderable: true },
        {
          name: "status",
          label: "Status",
          orderable: false,
          transform: ({ data, name }) => `${data[name] == 1 ? "yes" : "no"}`
        },
        {
          label: "Edit",
          name: "Edit",
          orderable: false,
          classes: {
            btn: true,
            "btn-primary": true,
            "btn-sm": true
          },
          transform: ({ data, name }) => `${data["gameId"]}`,
          event: "click",
          handler: this.displayRow,
          component: Buttonexp
        }
      ]
    };
  },
  components: {
    // eslint-disable-next-line
    Buttonexp
  },
  methods: {
    displayRow(data) {
      // alert(`You clicked row ${data["gameId"]}`);
      location.href = "edit/" + data["gameId"];
    }
  }
};
</script>
