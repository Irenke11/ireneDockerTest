<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div v-if="!form.gameId" class="card-header">Create new game</div>
          <div v-if="form.gameId" class="card-header">
            Edit game information
          </div>
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
                  label="Name(EN):"
                  label-align-sm="right"
                  label-for="nameEn"
                >
                  <b-form-input
                    v-model="form.gameNameEn"
                    id="nameEn"
                  ></b-form-input>
                  <li
                    v-if="errors.nameEn"
                    v-for="error in errors.gameNameEn"
                    class=" text-danger"
                  >
                    {{ error }}
                  </li>
                </b-form-group>
                <b-form-group
                  label-cols-sm="3"
                  label="Name(CN):"
                  label-align-sm="right"
                  label-for="nameCn"
                >
                  <b-form-input
                    v-model="form.gameNameCn"
                    id="nameCn"
                  ></b-form-input>
                  <li
                    v-if="errors.nameCn"
                    v-for="error in errors.gameNameCn"
                    class=" text-danger"
                  >
                    {{ error }}
                  </li>
                </b-form-group>
                <b-form-group
                  label-cols-sm="3"
                  label="Name(TW):"
                  label-align-sm="right"
                  label-for="nameTw"
                >
                  <b-form-input
                    v-model="form.gameNameTw"
                    id="nameTw"
                  ></b-form-input>
                  <li
                    v-if="errors.nameTw"
                    v-for="error in errors.gameNameTw"
                    class=" text-danger"
                  >
                    {{ error }}
                  </li>
                </b-form-group>

                <b-form-group
                  label-cols-sm="3"
                  label="Game Type:"
                  label-align-sm="right"
                  class="mb-0"
                >
                  <b-form-radio-group
                    class="pt-2"
                    :options="getopengametypelist"
                    v-model="form.gameType"
                  ></b-form-radio-group>
                  <li
                    v-if="errors.gameType"
                    v-for="error in errors.gameType"
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
  props: ["data", "info", "getopengametypelist"],
  mounted() {
    // console.log(typeof JSON.parse(this.data.gameName))
    // console.log(this.data.gameName->en)
  },
  data() {
    return {
      options: [
        { text: "Open", value: "1" },
        { text: "Close", value: "0" }
      ],
      form: {
        gameId: this.info.gameId ? this.info.gameId : "",
        gameNameEn: this.info.gameName ? JSON.parse(this.info.gameName).en : "",
        gameNameCn: this.info.gameName ? JSON.parse(this.info.gameName).cn : "",
        gameNameTw: this.info.gameName ? JSON.parse(this.info.gameName).tw : "",
        gameType: this.info.gameType ? this.info.gameType : "slot",
        status: this.info.status ? this.info.status : 1
      },
      show: true,
      errors: false
    };
  },
  methods: {
    onSubmit(event) {
      event.preventDefault();
      // alert(JSON.stringify(this.props))
      // //post
      axios
        .put("/games/editData", this.form)
        .then(result => {
          console.log(result);
          this.errors = {
            gameId: false,
            gameNameEn: false,
            gameNameCn: false,
            gameNameTw: false,
            gameType: false
          };
          alert("success");
          location.href = "/games/all";
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
      this.form.gameNameEn = this.info.gameName
        ? JSON.parse(this.info.gameName).en
        : "";
      this.form.gameNameCn = this.info.gameName
        ? JSON.parse(this.info.gameName).cn
        : "";
      this.form.gameNameTw = this.info.gameName
        ? JSON.parse(this.info.gameName).tw
        : "";
      this.form.gameType = this.info.gameType ? this.info.gameType : "slot";
      this.form.status = this.info.status ? this.info.status : 1;
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
