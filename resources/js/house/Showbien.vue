import Swal from "sweetalert2";
<template>
    <div id="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">

                            <div class="card text-center" v-if="loading">
                                <h1><span class="fas fa-spinner fa-pulse"></span></h1>
                            </div>

                            <div class=" mr-5 d-flex">
                                <h4>details sur le bien</h4>:<h5 class="card-title text-primary">{{bien.name}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card mb-3 col-md-12" v-for="piece in pieces">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img :src="bien.photos " alt="" width="100%" height="250">

                            <ul class="list-group mt-4" @click="getparentBiendata(bienParent.id)" v-if="bienParent !== null">
                                <a href="#" class="list-group-item pointer-event d-flex justify-content-between align-items-center">
                                    {{bienParent.name}}
                                    <span class="badge badge-primary badge-pill">Bien parent</span>
                                </a>
                            </ul>

                        <div class="container mt-3 mb-3" v-if="bienParent === null" style="max-width: 18rem;">
                            <h4> Sous bien</h4>
                            <div class="list-group" v-for="enfant in bienenfant">
                                <a class="list-group-item list-group-item-action" @click="getsoubiendata(enfant.id)" type="button">
                                    {{enfant.name}} <i class=" float-right  fas fa-home fa-sm"></i>
                                </a>
                            </div>
                        </div>


                        <div class=" mt-5">
                            <router-link to="/bien" class="btn btn-info">Retour</router-link>
                            <router-link :to="{ name: 'editbien', params: { id: bien.id }}" class="btn btn-warning ml-2"> Modifier</router-link>
                            <button @click="deleteBien(bien.id)" class="btn btn-danger">suprimer</button>
                        </div>

                    </div>
                    <div class="col-md-8">
                        <div class="card-body" >

                            <ul class="list-group list-group-flush" >

                                <li class="list-group-item">
                                    <dl class="row pl-5 ">
                                        <dt class="col-sm-6 ">type du bien</dt>
                                        <dd class="col-sm-6 ">{{tb.name}}</dd>
                                    </dl>
                                </li>
                                <li class="list-group-item">
                                    <dl class="row pl-5 ">
                                        <dt class="col-sm-6 ">addresse</dt>
                                        <dd v-if="bien.parentid !== null" class="col-sm-6 ">{{bien.parentid.addresse}}</dd>
                                        <dd v-else class="col-sm-6 ">{{bien.addresse}}</dd>
                                    </dl>
                                </li>


                                <div v-if="piece.chambre !== null && piece.salon != null && piece.salle_bain !== null ">
                                    <li class="list-group-item">
                                        <dl class="row pl-5">
                                            <dt class="col-sm-6">chambre</dt>
                                            <dd class="col-sm-6">{{piece.chambre}}</dd>
                                        </dl>
                                    </li>
                                    <li class="list-group-item">
                                        <dl class="row pl-5">
                                            <dt class="col-sm-6">salon</dt>
                                            <dd class="col-sm-6">{{piece.salon}}</dd>
                                        </dl>
                                    </li>
                                    <li class="list-group-item">
                                        <dl class="row pl-5">
                                            <dt class="col-sm-6">salle de bain</dt>
                                            <dd class="col-sm-6">{{piece.salle_bain}}</dd>
                                        </dl>
                                    </li>
                                </div>

                                <div v-if="piece.appartement !== null && piece.studio != null && piece.magasin !== null ">
                                    <li class="list-group-item">
                                        <dl class="pl-5 row">
                                            <dt class="col-sm-3 mt-3">appartement</dt>
                                            <dd class="col-sm-9 mt-3">{{piece.appartement}}</dd>
                                        </dl>
                                    </li>
                                    <li class="list-group-item">
                                        <dl class="pl-5 row">
                                            <dt class="col-sm-3">studio</dt>
                                            <dd class="col-sm-9">{{piece.studio}}</dd>
                                        </dl>
                                    </li>
                                    <li class="list-group-item">
                                        <dl class="pl-5 row">
                                            <dt class="col-sm-3">magasin</dt>
                                            <dd class="col-sm-9">{{piece.magasin}}</dd>
                                        </dl>
                                    </li>
                                </div>

                                <div class="list-group-item list-group-item-accent-primary list-group-item-primary mt-5">
                                    <h5 class="card-title text-primary">description</h5>
                                    <p class="text-dark">
                                        {{bien.description}}
                                    </p>
                                </div>

                            </ul>

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
        name: "Showbien",

        data(){
            return{
              bien:{},
                bienParent:{},
                bienenfant:{},
                pieces:{},
                tb:{},
                loading: true,
            }
        },


        created() {
            // console.log(this.$route.params.id)
            axios.get('api/bien/'+ this.$route.params.id)
                .then((response)=>{
                    this.bien = response.data;
                    this.tb = response.data.tbien;
                    this.pieces = response.data.pieces;
                    this.bienenfant = response.data.enfantsid;
                    this.bienParent = response.data.parentid;
                    console.log(response.data);
                    this.loading = false;
                });
        },

        methods:{

            getsoubiendata(id){
                axios.get('api/bien/'+ id)
                    .then((response)=>{
                        this.bien = response.data;
                        this.tb = response.data.tbien;
                        this.pieces = response.data.pieces;
                        this.bienenfant = response.data.enfantsid;
                        this.bienParent = response.data.parentid;
                        console.log(response.data)
                    });
            },

            getparentBiendata(id){
                axios.get('api/bien/'+ id)
                    .then((response)=>{
                        this.bien = response.data;
                        this.tb = response.data.tbien;
                        this.pieces = response.data.pieces;
                        this.bienenfant = response.data.enfantsid;
                        this.bienParent = response.data.parentid;
                        console.log(response.data)
                    });
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

                            });
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
