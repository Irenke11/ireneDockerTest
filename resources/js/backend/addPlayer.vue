<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Create new player</div>
          <div class="card-body">
            <b-form @submit="onSubmit" @reset="onReset" v-if="show">
              <csrf-token-input />
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
                  <b-form-input
                    v-model="form.password"
                    id="nested-password"
                    value="1234456789"
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
                    value="irene3"
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
                    :options="['RMB', 'USD', 'TWD']"
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
  data() {
    return {
      form: {
        account: "",
        name: "",
        currency: "",
        password: ""
      },
      show: true,
      errors: false
    };
  },
  methods: {
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
