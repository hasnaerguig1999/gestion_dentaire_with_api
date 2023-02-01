<template>
<div class="alert alert-success text-center" v-if="success" role="alert">
    {{success}}
</div>
<div class="alert alert-success text-center" v-if="error" role="alert">
    {{error}}
</div>
<form class="form" @submit="searchCreneau">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Search for creneau available</label>
        <input type="date" class="form-control input" :min =this.min :max =this.max v-model="date_creneau" id="exampleInputEmail1">
        <span class="error-feedback text-danger" v-if="v$.date_creneau.$error">{{v$.date_creneau.$errors[0].$message}}</span>
    </div>
    <button type="submit"  class="btn btn-primary">Search</button>
</form>
<div class="container mt-3" v-if="creneau.length>0">
    <h1 class="text-center">All Creneau Available</h1>
    <table class="table creneau">
        <thead>
            <tr>
                <th scope="col" class="text-center">start time</th>
                <th scope="col" class="text-center">end time</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="c in creneau" :key="c.id_creneau">
                <td class="text-center">{{c.heure_debut}}</td>
                <td class="text-center">{{c.heure_fin}}</td>
                <td class="text-center">
                    <!-- Button trigger modal -->
                    <div class="container">
                        <button type="button" @click="passingData(c)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Rdv
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add New Appointment</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form @click.prevent>
                                            <div class="mb-1">
                                                <label for="exampleInputEmail1" class="form-label">subject of appointment</label>
                                                <input type="text" v-model="sjt_rdv" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" @click="addRdv()" class="btn btn-primary" data-bs-dismiss="modal">Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</template>

<script>
import axios from "axios";
import useVuelidate from '@vuelidate/core';
import {
    required
} from '@vuelidate/validators';
export default {
    name: "CreneauCom",
    data() {
        return {
            v$: useVuelidate(),
            client_info: [],
            creneau: [],
            uniq_id: "",
            id_creneau: "",
            sjt_rdv: "",
            date_creneau: "",
            success:"",
            error:"",
            min:'',
            max:'',
        }
    },
    validations() {
        return {
            date_creneau: {
                required
            },
        }
    },
    async mounted() {
        // let result=await axios.get("")
        this.min = new Date().toISOString().slice(0, 10);
        const threeMonthsFromToday = new Date();
        threeMonthsFromToday.setMonth(threeMonthsFromToday.getMonth() + 3);
        this.max = threeMonthsFromToday.toISOString().slice(0, 10)
    },
    methods: {
        async searchCreneau(e) {
            e.preventDefault();
            this.v$.$validate();
            if (!this.v$.$error) {
                
                let res = await axios.get("http://backend.com/Creneau/read/" + this.date_creneau);
                if (res.status == 200) {
                    this.creneau = res.data;
                } else {
                    console.log("error")
                }
            } else {
                console.log('this is an error')
            }
        },
        passingData(c) {
            this.sjt_rdv = "";
            this.client_info = JSON.parse(localStorage.getItem("client-info"));
            this.uniq_id = this.client_info['uniqueId'];
            this.id_creneau = c.id;
            // console.log(this.uniq_id);
        },
        async addRdv() {
            var form = new FormData();
            form.append('sjt_rdv', this.sjt_rdv);
            form.append('uniq_id', this.uniq_id);
            form.append('id_creneau', this.id_creneau);
            form.append('date_creneau', this.date_creneau);
            let res = await axios({
                method: "POST",
                url: 'http://backend.com/rdv/create',
                data: form,
                headers: {
                    "Content-Type": "multipart/form-data"
                },
            })
            if (res.data.message == "Appointment created successfully") {
                this.success="Appointment created successfully";
            } else {
                this.error="Error on added new appointment";
            }
        }
    }

}
</script>

<style>
.input{
    width: 100px;
}
</style>
