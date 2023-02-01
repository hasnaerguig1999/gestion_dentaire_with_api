<template>
<div class="alert alert-danger text-center" v-if="deleted" role="alert">
    {{deleted}}
</div>
<div class="alert alert-success text-center" v-if="updated" role="alert">
    {{updated}}
</div>
<div class="alert alert-warning text-center" v-if="error" role="alert">
    {{error}}
</div>
<!-- Button trigger modal -->
<div class="container mt-5">
    <button type="button" @click="redirect({ val : 'HomeV'})" class="btn btn-primary">
        Add New Appointment
    </button>
</div>
<!-- <div class="container mt-5" v-if="appointment.length==0">
    {{empty}}
</div> -->
<div class="container mt-3">
    <h1 class="text-center">View All Appointment</h1>
    <table class="table">
        <thead>
            <tr class="bc-dark">
                <th scope="col" class="text-center">Date</th>
                <th scope="col" class="text-center">Start</th>
                <th scope="col" class="text-center">End</th>
                <th scope="col">Subject Of Appointment</th>
                <th scope="col-2" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody v-if="appointment.length>0">
            <tr v-for="a in appointment" :key="a.id">
                <td class="text-center">{{a.date_creneau}}</td>
                <td class="text-center">{{a.heure_debut}}</td>
                <td class="text-center">{{a.heure_fin}}</td>
                <td>{{a.sjt_rdv}}</td>
                <td class="action_btn text-center">
                    <button type="submit" @click="passingDataDel(a)" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete">Delete</button>
                    <!-- Modal -->
                    <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Appointment</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are You Sure You want To Delete This Appointment
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" @click="deleteRdv()" class="btn btn-danger" data-bs-dismiss="modal">Yes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-warning" @click="passingDataUpd(a)" data-bs-toggle="modal" data-bs-target="#update">Update</button>
                    <!-- Modal -->
                    <div class="modal fade" id="update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Appointment</h5>
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
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" @click="updateRdv()" data-bs-dismiss="modal" class="btn btn-warning">Yes</button>
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
import {
    mapActions
} from "vuex";
export default {
    name: "AddRdv",
    data() {
        return {
            appointment: [],
            uniq_id: "",
            empty: "",
            id_appointment: "",
            deleted: "",
            updated: "",
            error: "",
            sjt_rdv: "",
            date_creneau: "",
            id_creneau: ""
        }
    },
    async mounted() {
        let client = localStorage.getItem("client-info");
        if (!client) {
            this.redirect({
                val: 'SignUp'
            });
        } else {
            this.uniq_id = JSON.parse(client).uniqueId;
        }
        this.getRdv();
    },
    methods: {
        ...mapActions(['redirect']),
        passingDataUpd(a) {
            this.id_appointment = a.id;
            this.sjt_rdv = a.sjt_rdv;
            this.date_creneau = a.date_creneau;
            this.uniq_id = a.uniq_id;
            this.id_creneau = a.id_creneau
        },
        passingDataDel(a) {
            this.id_appointment = a.id;
        },
        async deleteRdv() {
            let res = await axios.post("http://backend.com/rdv/delete/" + this.id_appointment);
            if (res.status == 200) {
                this.getRdv();
                this.deleted = "Appointment Deleted Successfully";

            } else {
                this.error = "Error on updating Appointment";
            }
        },
        async updateRdv() {

            let res = await axios.post("http://backend.com/rdv/update/" + this.id_appointment, {
                sjt_rdv: this.sjt_rdv,

            });
            if (res.status == 200) {
                this.getRdv();
                this.updated = "Appointment Updated Successfully";

            } else {
                this.error = "Error on Updating Appointment";
            }
        },
        async getRdv() {
            let res = await axios.get("http://backend.com/Rdv/read_single_rdv/" + this.uniq_id);
            if (res.status == 200) {
                this.appointment = res.data;
            } else {
                this.empty = "You don't have any Appointment yet";
            }
        }
    }
}
</script>

<style>
form {
    width: 100%;
    margin-top: 0;
}

.action_btn {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-evenly;
}
</style>
