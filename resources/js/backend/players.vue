<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <th>新增用户</th>
                <div class="card-body">
                <b-button v-b-modal.modal-prevent-closing>Open Modal</b-button>

                <div class="mt-3">
      Submitted Names:
      <div v-if="submittedNames.length === 0">--</div>
      <ul v-else class="mb-0 pl-3">
        <li v-for="name in submittedNames">{{ name }}</li>
      </ul>
    </div>

    <b-modal
      id="modal-prevent-closing"
      ref="modal"
      title="Submit Your Name"
      @show="resetModal"
      @hidden="resetModal"
      @ok="handleOk"
    >
      <form ref="form" @submit.stop.prevent="handleSubmit">
        <b-form-group
          label="Name"
          label-for="name-input"
          invalid-feedback="Name is required"
          :state="nameState"
        >
          <b-form-input
            id="name-input"
            v-model="name"
            :state="nameState"
            required
          ></b-form-input>
        </b-form-group>
      </form>
    </b-modal>






                    <form action="/POST/addPlayer" method="POST">
                
                         <br>account:<input required  type="text" text="account" value="irene"name="account"> 
                         <br>password:<input required  type="text" text="password" value="123456"name="password">
                         <br>name:<input required  type="text" text="name" value="Irene"name="name">
                         <br>currency:
                         <select name="currency" id="currency" text>
                            <option value="RMB" >人民币</option>
                            <option value="USD" selected>美金</option>
                            <option value="NTD">台币</option>
                         </select>
                         <br>
                         status: 
                         开启<input type="radio"  name="status" value="1" checked>
                         关闭<input type="radio"  name="status" value="0">
                         <br><button type="submit" >addplayer</button>
                    </form>
                    <!-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif -->
                    <br>
                </div>

                <br>
                <th>搜寻用户</th>
                <div class="card-body">
                    <form action="/POST/searchPlayers" method="POST" >
                        <!-- @csrf -->
                        搜寻playerId：
                        <input required type="search" name="search[playerId]">
                        <button type="submit" >go</button>
                    </form> 
                        <br>
                    <form action="/POST/searchPlayers" method="POST" >
                    <!-- @csrf -->
                        搜寻account：
                        <input required type="search" name="search[account]">
                       <button type="submit" >go</button>
                     </form> 
                        <br>
                    <form action="/POST/searchPlayers" method="POST" >
                    <!-- @csrf -->
                        搜寻name：
                        <input required type="search" name="search[name]">
                        <button type="submit" >go</button>
                    </form>   
                        <br>
                    {{ $searchPlayerInfo}}
                    <br>
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
        name: '',
        nameState: null,
        submittedNames: []
      }
    },
    methods: {
      checkFormValidity() {
        const valid = this.$refs.form.checkValidity()
        this.nameState = valid
        return valid
      },
      resetModal() {
        this.name = ''
        this.nameState = null
      },
      handleOk(bvModalEvt) {
        // Prevent modal from closing
        bvModalEvt.preventDefault()
        // Trigger submit handler
        this.handleSubmit()
      },
      handleSubmit() {
        // Exit when the form isn't valid
        if (!this.checkFormValidity()) {
          return
        }
        // Push the name to submitted names
        this.submittedNames.push(this.name)
        // Hide the modal manually
        this.$nextTick(() => {
          this.$bvModal.hide('modal-prevent-closing')
        })
      }
    }
  }
</script>
