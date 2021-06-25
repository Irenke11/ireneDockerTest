<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div  class="card-header">編輯遊戲資料</div>
                <!-- <div v-if="this.edit" class="card-header">新增遊戲</div> -->
                <div class="card-body">
                <b-form @submit="onSubmit" @reset="onReset" v-if="show" >
                    <b-form-group
                    label-cols-lg="3"
                    label="請輸入資料"
                    label-size="lg"
                    label-class="font-weight-bold pt-0"
                    class="mb-0"
                    >
                       <b-form-group
                         
                            label-cols-sm="3"
                            label="game Id:"
                            label-align-sm="right"
                            label-for="gameId"
                        >
                            <b-form-input  v-model="props.gameId" id="gameId" ></b-form-input>
                            <!-- <b-form-input v-if="this.edit" v-model="props.gameId" id="gameId" ></b-form-input> -->
                            <li v-if="errors.gameId" v-for="error in errors.gameId" class=" text-danger">
                                {{ error }}
                            </li> 
                        </b-form-group>

                         <b-form-group
                            label-cols-sm="3"
                            label="Name(EN):"
                            label-align-sm="right"
                            label-for="nameEn"
                        >
                            <b-form-input v-model="props.gameNameEn" id="nameEn" ></b-form-input>
                            <li v-if="errors.nameEn" v-for="error in errors.gameNameEn" class=" text-danger">
                                {{ error }}
                            </li>
                        </b-form-group>
                        <b-form-group
                            label-cols-sm="3"
                            label="Name(CN):"
                            label-align-sm="right"
                            label-for="nameCn"
                        >
                            <b-form-input v-model="props.gameNameCn" id="nameCn" ></b-form-input>
                            <li v-if="errors.nameCn" v-for="error in errors.gameNameCn" class=" text-danger">
                                {{ error }}
                            </li>
                        </b-form-group>
                        <b-form-group
                            label-cols-sm="3"
                            label="Name(TW):"
                            label-align-sm="right"
                            label-for="nameTw"
                        >
                            <b-form-input v-model="props.gameNameTw" id="nameTw" ></b-form-input>
                            <li v-if="errors.nameTw" v-for="error in errors.gameNameTw" class=" text-danger">
                                {{ error }}
                            </li>
                        </b-form-group>

                        <b-form-group
                            label-cols-sm="3"
                            label="Game Type:"
                            label-align-sm="right" class="mb-0"
                        >
                            <b-form-radio-group
                            class="pt-2"
                            :options="['slot', 'poker', 'fish']"
                            v-model="props.gameType"
                            ></b-form-radio-group>
                            <li v-if="errors.gameType" v-for="error in errors.gameType" class=" text-danger">
                                {{ error }}
                            </li>
                        </b-form-group>
                        <b-form-group
                            label-cols-sm="3"
                            label="Status"
                            label-align-sm="right" class="mb-0"
                        >
                            <b-form-radio-group
                            class="pt-2"
                                id="radio-group-1"
                                v-model="selected"
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
    props: ['data'], 
    mounted() {
            // console.log(typeof JSON.parse(this.data.gameName))
            // console.log(JSON.parse(this.data.gameName).en)
    },
    data() {
        return {
        selected: this.data.status,
        options: [
          { text: 'Open', value: '1' },
          { text: 'Close', value: '0' },
        ], 
        props: {
            gameId:this.data.gameId?"1":"2",
            gameNameEn:JSON.parse(this.data.gameName).en,
            gameNameCn:JSON.parse(this.data.gameName).cn,
            gameNameTw:JSON.parse(this.data.gameName).tw,
            gameType:this.data.gameType,
            status:this.data.status,
        },
        show: true,
        errors: false,
        
      }
    },
    methods: {
        onSubmit(event) {
        event.preventDefault()
        // alert(JSON.stringify(this.props))
        // //post
        axios
        .post('/POST/editGameData',this.props)
        .then((result) =>  { 
            console.log(result);
            this.errors = {
                gameId: false,
                gameNameEn: false,
                gameNameCn: false,
                gameNameTw: false,
                gameType: false,
            }
            alert("創建成功");
            location.href='/GET/games';
        })
        .catch( (error) => { // 请求失败处理
            // console.log(error.response.data.errors);
            this.errors = error.response.data.errors;
        });
      },
      onReset(event) {
        event.preventDefault()
        // Reset our form values
        this.form.account = ''
        this.form.name = ''
        this.form.currency = null
        this.form.password = ''
        // Trick to reset/clear native browser form validation state
        this.show = false
        this.$nextTick(() => {
          this.show = true
        })
      }
    }

  };
</script>
<style></style>
