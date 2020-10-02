import Swal from "sweetalert2";
<template>
    <div class="container-fluid">
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="card mb-3 col-md-12">
                    <div class="card text-center" v-if="loading">
                        <h1><span class="fas fa-spinner fa-pulse"></span></h1>
                    </div>
                    <div class="row no-gutters ">
                        <div class="col-md-4 border-right">
                            <img :src="tenant.photo " alt=""  width="220">


                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <dl class="row pl-5 ">
                                    <dt class="col-sm-3 mt-3">Nom</dt>
                                    <dd class="col-sm-9 mt-3">{{tenant.nom}}</dd>

                                    <dt class="col-sm-3 mt-3">prenom</dt>
                                    <dd class="col-sm-9 mt-3">{{tenant.prenom}}</dd>


                                    <dt class="col-sm-3 mt-3">Email</dt>
                                    <dd class="col-sm-9 mt-3">{{tenant.email}}</dd>

                                    <dt class="col-sm-3 mt-3 text-truncate">Numero de CNI</dt>
                                    <dd class="col-sm-9 mt-3">{{tenant.cin}}</dd>

                                    <dt class="col-sm-3 mt-3 text-truncate">profession</dt>
                                    <dd class="col-sm-9 mt-3">{{tenant.profession}}</dd>

                                    <dt class="col-sm-3 mt-3 text-truncate">nationalité</dt>
                                    <dd class="col-sm-9 mt-3">{{tenant.nationalite}}</dd>

                                    <dt class="col-sm-3 mt-3 text-truncate">ville</dt>
                                    <dd class="col-sm-9 mt-3">{{tenant.ville}}</dd>

                                    <dt class="col-sm-3 mt-3">Telephone</dt>
                                    <dd class="col-sm-9 mt-3">
                                        <dl class="row">
                                            <dt class="col-sm-4">{{tenant.numero}}</dt>

                                        </dl>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-10">
                    <div class="card ">
                        <div class="card-header">
                            <router-link to="/tenants" class="btn bg-danger">retour</router-link>


                            <router-link :to="{ name: 'edit', params: { id: tenant.id }}" class="btn btn-warning ml-2"> Modifier</router-link>

                            <button @click="deletetenant(tenant.id)" class="btn btn-danger">suprimer</button>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import Swal from 'sweetalert2'

    export default {
        name: "Showtenant",

        data(){
            return{
                tenant:{},
                loading: true,
            }
        },


        created() {
            // console.log(this.$route.params.id)
            axios.get('api/tenants/'+ this.$route.params.id)
                .then((response)=>{
                    console.log(response.data)
                    this.tenant = response.data
                    this.loading = false;

                });
        },

        methods:{
            deletetenant(id){
                Swal.fire({
                    text: "Etes-vous de cette action !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Abandonner',
                    confirmButtonText: 'Oui, supprimer!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('api/tenants/' + id)
                            .then((response) => {

                            })
                        Swal.fire(
                            'Supprimer',
                            'success'
                        )
                    }
                })
            },
        },
    }
</script>

<style scoped>

</style>
