<template>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <div class="card-header">Players page</div>
              <div class="card-body">
                        <!-- 這個是bootserat原生版本的 -->
                        <!-- <b-table striped hover :items="items"  :fields="fields"></b-table> -->
                        <!-- 這個是bootserat原生版本的 -->
                  <data-table
                      :columns="columns"
                      url="/GET/playersData"
                      order-by="playerId"
                      :filters="filters"
                      >
                      <div slot="filters" slot-scope="{ tableFilters, perPage }">
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <select class="form-control" v-model="tableFilters.length">
                                    <option :key="page" v-for="page in perPage">{{ page }}</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input
                                    name="name"
                                    class="form-control"
                                    v-model="tableFilters.filters.playerId"
                                    placeholder="Search playerId">
                            </div>
                            <div class="col-md-4">
                                <input
                                    name="name"
                                    class="form-control"
                                    v-model="tableFilters.search"
                                    placeholder="Search Name&Account">
                            </div>
                            <div class="col-md-2">
                                <select
                                    v-model="tableFilters.filters.currency"
                                    class="form-control">
                                    <option value>Currency</option>
                                    <option value='USD'>USD</option>
                                    <option value='RMB'>RMB</option>
                                    <option value='TWD'>TWD</option>
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
  export default {
    props: ['data'],
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
          currency: '',
        },
        columns: [
          { name: 'playerId', label: 'Id', orderable: true},
          { name: 'account', label: 'Account', orderable: true},
          { name: 'name', label: 'Name', orderable: true},
          { name: 'currency', label: 'Currency', orderable: false},
          { name: 'created_at', label: 'Created', orderable: true},
          // { name: 'password', label: 'Password', orderable: true},
          // { name: 'updated_at', label: 'updated_at', orderable: true},
        ],

        // items: this.data,
        // fields: [
        //   { key: 'playerId', label: 'Player Id' },
        //   { key: 'account', label: 'Account' },
        //   // { key: 'password', label: 'Password' },
        //   { key: 'name', label: 'Name' },
        //   { key: 'currency', label: 'Currency' },
        //   { key: 'created_at', label: 'Created' },
        // ]
      }
    }
  }
</script>
