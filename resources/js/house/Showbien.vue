<template>
    <div id="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
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
                        <img :src=" avatar(bien.photo) " alt="" width="100%" height="250">

                        <div class="list-group-item list-group-item-accent-primary list-group-item-primary mt-5">
                            <h5 class="card-title text-primary">description</h5>
                            <p class="text-dark">
                                {{bien.description}}
                            </p>
                        </div>

                        <div class="card-header mt-5">
                            <router-link to="/bien" class="btn btn-info">Retour</router-link>
                            <router-link :to="{ name: 'editbien', params: { id: bien.id }}" class="btn btn-warning ml-2"> Modifier</router-link>
                            <button @click="deleteBien(bien.id)" class="btn btn-danger">suprimer</button>
                        </div>

                    </div>
                    <div class="col-md-8">
                        <div class="card-body" >

                            <ul class="list-group list-group-flush" >

                                 <li class="list-group-item" v-if="bienParent !== null">
                                        <dl class="row pl-5">
                                           <dt class="col-sm-6">appartient a</dt>
                                            <dd class="col-sm-6 text-primary">{{bienParent.name}}</dd>
                                        </dl>
                                 </li>
                                <li class="list-group-item">
                                    <dl class="row pl-5 ">
                                        <dt class="col-sm-6 ">type du bien</dt>
                                        <dd class="col-sm-6 ">{{tb.name}}</dd>
                                    </dl>
                                </li>
                                <li class="list-group-item">
                                    <dl class="row pl-5 ">
                                        <dt class="col-sm-6 ">addresse</dt>
                                        <dd class="col-sm-6 ">{{bien.addresse}}</dd>
                                    </dl>
                                </li>
                                <li class="list-group-item">
                                    <dl class="row pl-5 ">
                                        <dt class="col-sm-6 ">ville</dt>
                                        <dd class="col-sm-6 ">{{bien.ville}}</dd>
                                    </dl>
                                </li>
                                <li class="list-group-item">
                                    <dl class="row pl-5">
                                        <dt class="col-sm-6">region</dt>
                                        <dd class="col-sm-6">{{bien.region}}</dd>
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

                                <li class="list-group-item">
                                    <dl class="pl-5 row" v-if="bienParent === null">
                                             <dt class="col-sm-6">liste des biens de cette himeuble:</dt>
                                            <dd class="col-sm-6 text-primary" v-for="enfant in bienenfant">{{enfant.name}}</dd>
                                    </dl>
                                </li>

                            </ul>

                        </div>
                    </div>
                </div>
            </div>

            </div>
        </div>
</template>

<script>
    export default {
        name: "Showbien",

        data(){
            return{
              bien:{}, bienParent:{}, bienenfant:{}, pieces:{}, tb:{},
            }
        },


        created() {
            // console.log(this.$route.params.id)
            axios.get('api/bien/'+ this.$route.params.id)
                .then((response)=>{
                    this.bien = response.data
                    this.tb = response.data.tbien
                    this.pieces = response.data.pieces
                    this.bienenfant = response.data.enfantsid
                    this.bienParent = response.data.parentid
                    console.log(response.data)
                });
        },

        methods:{

            avatar(photo){
                // console.log(photo)
                return "image/" + photo
            },

            deleteBien(id){
                axios.delete('api/bien/' + id)
                    .then((response)=>{
                        // console.log(response.data)

                        if (response.data){
                            this.flashMessage.success({
                                title: 'Supprimer',
                                message: 'Action reussit',
                                time: 3000,
                                flashMessageStyle: {
                                    backgroundColor: 'linear-gradient(#e66465, #9198e5)'
                                }
                            });
                        } else {
                            this.flashMessage.error({title: 'Error Message Title', message: 'xxxxxxxxxx'});
                        }
                    })
            },
        },
    }
</script>

<style scoped>

</style>
