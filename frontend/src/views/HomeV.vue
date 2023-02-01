<template>
<NavbarCom />
<CreneauCom />
</template>

<script>
import NavbarCom from "@/components/Navbar.vue";
import CreneauCom from "@/components/Creneau.vue";
import {
    mapActions
} from 'vuex'
export default {
    name: "HomeV",
    data() {
        return {
            client_name: "",
            date: ""
        }
    },
    components: {
        NavbarCom,
        CreneauCom
    },
    mounted() {
        let client = localStorage.getItem("client-info");
        if (!client) {
            this.redirect({
                val: 'SignUp'
            });
        } else {
            this.client_name = JSON.parse(client).nom;
        }

    },
    methods: {
        ...mapActions(['redirect']),
    }
}
</script>

<style>
.form{
  width: 310px;
  margin:22px 50px;
}
.form-label{
  font-size: 22px;
}
.input{
    width: 200px;
}
</style>
