<template>
  <div class="container mt-5 p-3" style="display:flex;flex-direction:column;justify-content:center;align-items:center;">
     <h1 class="text-center text-primary">Login</h1>
    <form class="border shadow p-4 mt-4 rounded" @click.prevent style="border: 1px solid red;width:50%;">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Unique id</label>
        <input type="password" class="form-control" id="exampleInputEmail1" v-model="state.uniqId" required aria-describedby="emailHelp">
        <span class="error-feedback text-danger" v-if="v$.uniqId.$error">{{v$.uniqId.$errors[0].$message}}</span>
    </div>
    <span class="error-feedback text-danger">{{error_login}}</span>
    <button type="button" @click="redirect({ val : 'SignUp'})" class="btn btn-primary mb-1 w-100">Sign Up</button>
    <button type="submit" @click="login()" class="btn btn-success w-100">Login</button>
    </form>
 </div>
</template>

<script>
import { mapActions } from "vuex";
import axios from "axios";
import useVuelidate from '@vuelidate/core';
import { required } from '@vuelidate/validators';
import { reactive,computed } from 'vue';
export default {
    name: "LoginForm",
    //composition API
    setup(){
      const state = reactive({
        uniqId:"",
      });
      // validations
      const rules = computed(()=>{
        return{
          uniqId:{required},
        };
      });
      const v$=useVuelidate(rules,state);
      return {
        state,v$
      }
    },
    data(){
        return{
          id:"",
          error_login:""
        }
    },
    mounted(){
    },
    methods:{
        ...mapActions(['redirect']),
        async login(){
          this.v$.$validate();
          if(!this.v$.$error){
            var form=new FormData();
            form.append('uniqId', this.state.uniqId);
            let result=await axios({
              method:"POST",
              url:'http://backend.com/register/login',
              data:form,
              headers:{"Content-Type":"multipart/form-data"},
            })
            if(result.data.message=="Login success"){
              alert("Login successfully")
              var object={};
              form.forEach((value,key)=> object[key]=value);
              localStorage.setItem("client-info",JSON.stringify(result.data));
              this.redirect({val:'HomeV'})
            }else{
              
              this.error_login="Client not found"
            }
          }else{
            console.log("error");
          }
        }
    }
}
</script>

<style>
  .text-center{
    font-weight: bold;
  }
</style>