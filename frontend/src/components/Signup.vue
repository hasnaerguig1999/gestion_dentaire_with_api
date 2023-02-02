<template>
<h1 class="text-center text-primary">Sign Up</h1>
<div class="container">
 <form  class="border shadow p-4 rounded" style="width:60%;" @click.prevent>
    <div class="row mb-3">
      <div class="col">
        <input type="text" class="form-control" v-model="nom" placeholder="First name" aria-label="First name">
        <span class="error-feedback text-danger" v-if="v$.nom.$error">{{v$.nom.$errors[0].$message}}</span>
      </div>
      <div class="col">
        <input type="text" class="form-control" v-model="prenom" placeholder="Last name" aria-label="Last name">
        <span class="error-feedback text-danger" v-if="v$.prenom.$error">{{v$.prenom.$errors[0].$message}}</span>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col">
        <input type="date" class="form-control" v-model="date_naissance" placeholder="Date of birth" aria-label="Date of birth">
      </div>
      <div class="col">
        <input type="email" class="form-control" v-model="email" placeholder="Email address" aria-label="Email address">
        <span class="error-feedback text-danger" v-if="v$.email.$error">{{v$.email.$errors[0].$message}}</span>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col">
        <input type="text" class="form-control" v-model="situation_familiale" placeholder="situation_familiale" aria-label="situation_familiale">
        <span class="error-feedback text-danger" v-if="v$.situation_familiale.$error">{{v$.situation_familiale.$errors[0].$message}}</span>
      </div>
      <div class="col">
        <input type="text" class="form-control" v-model="adress" placeholder="adress" aria-label="adress">
        <span class="error-feedback text-danger" v-if="v$.adress.$error">{{v$.adress.$errors[0].$message}}</span>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col">
        <input type="text" class="form-control" v-model="date_depart" placeholder="date_depart" aria-label="date_depart">
        <span class="error-feedback text-danger" v-if="v$.date_depart.$error">{{v$.date_depart.$errors[0].$message}}</span>
      </div>
      <div class="col">
        <input type="text" class="form-control" v-model="date_darrive" placeholder="date_darrive" aria-label="date_darrive">
        <span class="error-feedback text-danger" v-if="v$.date_darrive.$error">{{v$.date_darrive.$errors[0].$message}}</span>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col">
        <input type="text" class="form-control" v-model="type_pass" placeholder="type_pass" aria-label="type_pass">
        <span class="error-feedback text-danger" v-if="v$.type_pass.$error">{{v$.type_pass.$errors[0].$message}}</span>
      </div>
      <div class="col">
        <input type="text" class="form-control" v-model="num_pass" placeholder="num_pass" aria-label="num_pass">
        <span class="error-feedback text-danger" v-if="v$.num_pass.$error">{{v$.num_pass.$errors[0].$message}}</span>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col">
        <input type="text" class="form-control" v-model="type_visa" placeholder="type_visa" aria-label="type_visa">
        <span class="error-feedback text-danger" v-if="v$.type_visa.$error">{{v$.type_visa.$errors[0].$message}}</span>
      </div>
      <div class="col">
        <input type="text" class="form-control" v-model="nationalite" placeholder="nationalite" aria-label="nationalite">
        <span class="error-feedback text-danger" v-if="v$.nationalite.$error">{{v$.nationalite.$errors[0].$message}}</span>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col">
        <input type="password" class="form-control" v-model="uniqId" placeholder="Unique id" aria-label="Unique id">
        <span class="error-feedback text-danger" v-if="v$.uniqId.$error">{{v$.uniqId.$errors[0].$message}}</span>
      </div>
    </div>
  <button type="submit" @click="signup()" class="btn btn-primary mb-1 w-100">Sign Up</button>
  <button type="button" @click="redirect({val:'Login'})" class="btn btn-success w-100">Login</button>
 </form>
</div>
</template>

<script>
import { mapActions } from 'vuex'
import axios from 'axios'
import useVuelidate from '@vuelidate/core'
import { required,email,minLength } from '@vuelidate/validators'
    export default{
        name: 'SignUpForm',
        data(){
          return{
            v$: useVuelidate(),
            email: "",
            nom: "",
            prenom:"",
            date_naissance:"",    
            situation_familiale:"",
            adress:"",
            date_depart:"",
            date_darrive:"",
            type_pass:"",
            num_pass:"",
            type_visa:"",
            nationalite:"",
            uniqId:""
          }
        },
        validations (){
          return{
            nom: { required,minLength: minLength(6) },
            prenom: { required,minLength: minLength(6) },
            email: { required,email } ,
            uniqId:{required,minLength: minLength(10)}
          }
        },
        // mounted(){
        //   let client=localStorage.getItem("client-info");
        //   if(client){
        //     this.redirect({val:'HomeV'});
        //   }
        // },
        methods:{
          ...mapActions(['redirect']),
           async signup(){
             this.v$.$validate();
             if(!this.v$.$error){
                var form=new FormData();
                form.append('nom', this.nom);
                form.append('prenom', this.prenom);
                form.append('date_naissance', this.date_naissance);
                form.append('email', this.email);
                form.append('situation_familiale', this.situation_familiale);
                form.append('adress', this.adress);
                form.append('date_depart', this.date_depart);
                form.append('date_darrive', this.date_darrive);
                form.append('type_pass', this.type_pass);
                form.append('num_pass', this.num_pass);
                form.append('type_visa', this.type_visa);
                form.append('nationalite', this.nationalite);
                form.append('uniqId', this.uniqId);

                let result=await axios({
                  method:"POST",
                  url:'http://backend.com/register/sign_up',
                  data:form,
                  headers:{"Content-Type":"multipart/form-data"},
                })
               if(result.status == 200){
                 alert('Added new client successfully');
                 // save client data in local storage
                 var object={};
                 form.forEach((value,key)=> object[key]=value);
                 localStorage.setItem("client-info",JSON.stringify(object));
                 //redirect to login page
                 this.redirect({val:'Login'});
               }else{
                 console.log('Error on added new client');
               }
             }else{
               console.log('error')
             }
          }
        }
        
    }
</script>
<style scoped>
  .container{
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
  }
  .text-center{
    font-weight: bold;
  }
  .pass{
    margin-left:2px;
    width: 100%;
  }
</style>
 