<template>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <div class="card-header">Bets page</div>
              <div class="card-body">
                  <data-table
                      :columns="columns"
                      url="/GET/betsData"
                      order-by="betId"
                      :filters="filters"
                      order-dir="desc"
                      >
                      <div slot="filters" slot-scope="{ tableFilters, perPage }">
                        <div class="row mb-2">
                            <div class="col">
                                <select class="form-control" v-model="tableFilters.length">
                                    <option :key="page" v-for="page in perPage">{{ page }}</option>
                                </select>
                            </div>
                            <div class="col">
                                <input
                                    name="name"
                                    class="form-control"
                                    v-model="tableFilters.filters.bureauNo"
                                    placeholder="Search bureauNo">
                            </div>
                            <div class="col">
                                <input
                                    name="name"
                                    class="form-control"
                                    v-model="tableFilters.filters.betId"
                                    placeholder="Search betId">
                            </div>
                            <div class="col">
                                <input
                                    name="name"
                                    class="form-control"
                                    v-model="tableFilters.filters.playerId"
                                    placeholder="Search playerId">
                            </div>
                            <div class="col">
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
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <!-- <label for="datepicker-sm">Small date picker</label> -->
                                <b-form-datepicker v-model="filters.datepicker"   
                                id="datepicker" locale="en" class="mb-2"    
                                today-button
                                reset-button
                                close-button
                                ></b-form-datepicker>
                            </div>
                            <div class="col-md-3">
                                <b-form-timepicker v-model="filters.startTime" locale="en"></b-form-timepicker>
                                <!-- <div class="mt-2">Value: '{{ value }}'</div> -->
                            </div>
                            ~
                            <div class="col-md-3">
                                <b-form-timepicker v-model="filters.endTime" locale="en"></b-form-timepicker>
                                <!-- <div class="mt-2">Value: '{{ value }}'</div> -->
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
        const now = new Date()
        const today = new Date(now.getFullYear(), now.getMonth(), now.getDate())
      return {
        filters: {
            currency: '',
            no: '',
            datepicker: '',
            startTime: '',
            endTime: '',
            betId: '',
            playerId: '',
            // datepicker: new Date(today),
            // startTime:"00:00:00",
            // endTime:"23:59:59",
        },
        columns: [
            { name: 'betId', label: 'betId', orderable: true},
            { name: 'bureauNo', label: 'bureauNo', orderable: true},
            { name: 'gameName', label: 'gameName', orderable: true},
            { name: 'playerId', label: 'playerId', orderable: true},
            { name: 'currency', label: 'currency', orderable: true},
            { name: 'betTime', label: 'betTime', orderable: true},
            { name: 'amount', label: 'amount', orderable: true},
            { name: 'payout', label: 'payout', orderable: true},
            { name: 'profit', label: 'profit', orderable: true,
                transform: ({data, name}) => `${data['payout']-data['amount']}`,
            },
        ],
      }
    }
  }
</script>
