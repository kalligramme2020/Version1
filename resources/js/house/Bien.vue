import Swal from "sweetalert2";
<template>
    <div id="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-right ">
                            </div>
                        </div>
                    </div>
                </div>
                <div style="z-index: 1000"></div>

            </div>


            <div class="row justify-content-center mt-5">
                <div class="col-md-11">
                    <div class="row">
                        <div class="col-6  ">
                            <div class="input-group col-md-6 mb-3">
                                <input type="text" class="form-control"  v-model="Q" placeholder="Recherche">

                            </div>
                        </div>
                        <div class="col-6 text-right">
                            <router-link to="/newBien" class="btn btn-outline-success text-success">Nouveau bien</router-link>
                        </div>
                    </div>
                    <div class="text-right mb-3">
                    </div>
                    <div class="card">
                        <div class="card-body">

                            <table class="table table-striped table-bordered" style="width:100%">
                                <thead class=" text-center">
                                <tr>
                                    <th scope="col">photo</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Adresse</th>
                                    <th scope="col">ville</th>
                                    <th scope="col"> action </th>
                                </tr>
                                </thead>

                                <tbody v-for=" bien in Biens" v-bind:key="bien.id">
                                <tr>

                                    <td>
                                        <img :src=" avatar(bien.photo) " alt="" class="avatar">

                                    </td>
                                    <td>
                                        <router-link :to="{ name: 'showbien', params: { id: bien.id }}" class="text-primary">{{bien.name}}</router-link>
                                    </td>
                                    <td v-if="bien.parentid !== null">{{bien.parentid.addresse}}</td>
                                    <td v-else>{{bien.addresse}}</td>

                                    <td v-if="bien.parentid !== null">{{bien.parentid.ville}}</td>
                                    <td v-else>{{bien.ville}}</td>

                                    <th class="text-center">
                                        <div class="btn-group">
                                            <button class="btn btn-secondary btn-sm " type="button" data-toggle="dropdown" aria-expanded="false">
                                                actions
                                            </button>
                                            <div class="dropdown-menu">
<!--                                                <a href="#" class="dropdown-item"><i class="fas fa-edit fa-sm"> </i> modifier</a>-->
                                                <router-link :to="{ name: 'editbien', params: { id: bien.id }}" class="dropdown-item"><i class="fas fa-edit fa-sm"> </i> modifier</router-link>

                                                <button @click="deleteBien(bien.id)" class="dropdown-item"> <i class="fas fa-trash-alt fa-sm"></i> suprimer</button>

                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Autres</a>
                                            </div>
                                        </div>
                                    </th>
                                </tr>

                                </tbody>
                            </table>
<!--                            <pagination :data="Biens" @pagination-change-page="getResultsPaginate" class="mt-3"></pagination>-->

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
        name: "Bien.vue",

        data(){
            return{
                Biens:{},
                Q:''
            }
        },


        created(){
            axios.get('api/bien')
                .then((response)=>{
                    console.log(response.data)
                    this.Biens = response.data
                })
        },

        methods:{

            avatar(photo){
                // console.log(photo)
                return "image/" + photo
            },

            deleteBien(id){
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
                        axios.delete('api/bien/' + id)
                            .then((response) => {

                            })
                        Swal.fire(
                            'Supprimer',
                            'success'
                        )
                    }
                })
            },

            // Our method to GET results from a Laravel endpoint
            getResultsPaginate(page = 1) {
                // axios.get('api/bien?page=' + page)
                //     .then(response => {
                //         this.Biens = response.data;
                //     });
            },
        },

        computed:{
            getFilterBiens() {
                return this.Biens.filter(bien => {
                    return bien.indentifiant.toLowerCase().includes(this.Q.toLowerCase())
                })
            }
        }
    }
</script>

<style scoped>

</style>
