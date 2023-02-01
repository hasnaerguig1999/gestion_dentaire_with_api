<template>
<nav class="navbar navbar-expand-lg navbar-light bg-light ">
    <div class="container-fluid">
        <div>
            <router-link style="text-decoration:none;" :to="{ name: 'HomeV',params:{ title : 'View All creneau available'}}">
                <a class="nav-link active" aria-current="page">
                  <img src="../assets/images/cabinet1.svg" alt="">
                </a>
            </router-link>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <router-link style="text-decoration:none;" :to="{ name: 'HomeV',params:{ title : 'View All creneau available'}}">
                        <a class="nav-link active" aria-current="page">Home</a>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link style="text-decoration:none;" :to="{ name: 'AppointmentV'}">
                        <a class="nav-link" aria-current="page">Appointments</a>
                    </router-link>
                </li>
            </ul>
            <button class="btn btn-outline-success" @click="logout()" type="submit">Log out</button>
        </div>
    </div>
</nav>
</template>

<script>
import {
    mapActions
} from 'vuex';
export default {
    name: "NavbarCom",
    methods: {
        ...mapActions(['redirect']),
        logout() {
            localStorage.clear();
            this.redirect({
                val: "Login"
            });
        }
    }
}
</script>

<style>
a {
    text-decoration: none;
}
img{
  width: 54px;
  height: 54px;
}
</style>
