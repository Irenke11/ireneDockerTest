<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div v-if="!form.playerId" class="card-header">Create new player</div>
          <div v-if="form.playerId" class="card-header">Edit player</div>
          <div class="card-body">
            <b-form @submit="onSubmit" @reset="onReset" v-if="show">
          
              <b-form-group
                label-cols-lg="3"
                label="Please enter information"
                label-size="lg"
                label-class="font-weight-bold pt-0"
                class="mb-0"
              >
              
                <b-form-group
                  label-cols-sm="3"
                  label="Email:"
                  label-align-sm="right"
                  label-for="nested-Account"
                >
                  <b-form-input
                    v-model="form.account"
                    id="nested-Account"
                  ></b-form-input>
                  <li
                    v-if="errors.account"
                    v-for="error in errors.account"
                    class=" text-danger"
                  >
                    {{ error }}
                  </li>
                </b-form-group>

                <b-form-group 
                  label-cols-sm="3"
                  label="Password:"
                  label-align-sm="right"
                  label-for="nested-password"
                >
                  <b-button  
                    v-if="form.playerId" 
                    variant="outline-secondary"
                    v-on:click="restorePassword"
                    >Restore default</b-button>
                  <b-form-input 
                    v-if="!form.playerId"
                    v-model="form.password"
                    id="nested-password"
                    
                  ></b-form-input>
                  <li
                    v-if="errors.password"
                    v-for="error in errors.password"
                    class=" text-danger"
                  >
                    {{ error }}
                  </li>
                </b-form-group>

                <b-form-group
                  label-cols-sm="3"
                  label="Name:"
                  label-align-sm="right"
                  label-for="nested-name"
                >
                  <b-form-input
                    v-model="form.name"
                    id="nested-name"
                  ></b-form-input>
                  <li
                    v-if="errors.name"
                    v-for="error in errors.name"
                    class=" text-danger"
                  >
                    {{ error }}
                  </li>
                </b-form-group>

                <b-form-group
                  label-cols-sm="3"
                  label="Currency:"
                  label-align-sm="right"
                  class="mb-0"
                >
                  <b-form-radio-group
                    class="pt-2"
                    :options="data"
                    v-model="form.currency"
                  ></b-form-radio-group>
                  <li
                    v-if="errors.currency"
                    v-for="error in errors.currency"
                    class=" text-danger"
                  >
                    {{ error }}
                  </li>
                </b-form-group>
                <b-form-group
                  label-cols-sm="3"
                  label="status"
                  label-align-sm="right"
                  class="mb-0"
                >
                  <b-form-radio-group
                    class="pt-2"
                    id="radio-group-1"
                    v-model="form.status"
                    :options="options"
                    name="radio-options"
                  ></b-form-radio-group>
                </b-form-group>
                <b-button type="submit" variant="primary">Submit</b-button>
                <b-button type="reset" variant="danger">Reset</b-button>
              </b-form-group>
            </b-form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["data","playerinfo"],
  mounted() {
    // console.log(this.playerinfo);
  },
  data() {
    return {
      form: {
        playerId: this.playerinfo.playerId ? this.playerinfo.playerId : "",
        account: this.playerinfo.account ? this.playerinfo.account : "",
        name: this.playerinfo.name ? this.playerinfo.name : "",
        currency: this.playerinfo.currency ? this.playerinfo.currency : "RMB",
        password: this.playerinfo.password ? this.playerinfo.password : "",
        status: this.playerinfo.status ? this.playerinfo.status : "1",
      },
      options: [
        { text: "Open", value: "1" },
        { text: "Close", value: "0" }
      ],
      show: true,
      errors: false
    };
  },
  methods: {
    restorePassword: function (event) {
        axios
        .post("/players/restorePassword", this.form)
        .then(result => {
          this.errors = {
            account: false,
            name: false,
            currency: false,
            password: false
          };
          alert("success");
        })
        .catch(error => {
          // 请求失败处理
          // console.log(error.response.data.errors);
          this.errors = error.response.data.errors;
        });
      // alert('success')
    },
    onSubmit(event) {
      event.preventDefault();
      // alert(JSON.stringify(this.form))
      //post
      axios
        .post("/players/addData", this.form)
        .then(result => {
          // console.log(result);
          this.errors = {
            account: false,
            name: false,
            currency: false,
            password: false
          };
          alert("success");
        })
        .catch(error => {
          // 请求失败处理
          // console.log(error.response.data.errors);
          this.errors = error.response.data.errors;
        });
    },
    onReset(event) {
      event.preventDefault();
      // Reset our form values
      this.form.account = "";
      this.form.name = "";
      this.form.currency = null;
      this.form.password = "";
      // Trick to reset/clear native browser form validation state
      this.show = false;
      this.$nextTick(() => {
        this.show = true;
      });
    }
  }
};
</script>
<style></style>
