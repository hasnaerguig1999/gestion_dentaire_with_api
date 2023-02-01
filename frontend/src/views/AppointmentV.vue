<template>
  <NavbarCom/>
  <AddRdv/>
</template>

<script>
import NavbarCom from "@/components/Navbar.vue";
import AddRdv from "@/components/Appointment.vue";
import { mapActions } from 'vuex'
export default {
    name:"appoitmentV",
    components:{
        NavbarCom,
        AddRdv
    },
    mounted(){
      let client=localStorage.getItem("client-info");
      if(!client){  
        this.redirect({val:'SignUp'});
      }
    },
    methods:{
      ...mapActions(['redirect']),
    }
}
</script>

<style>

</style>
