<template>
    <div class="container-fluid">
        <div class="container">
            <h2>{{rent.identifiant}}</h2>
            <div class="row justify-content-center mt-5">
                <div class="card mb-3 col-md-12">

                    <div class="row no-gutters ">

                        <div class="col-md-8">
                            <div class="card-body">
                                <dl class="row pl-5 ">
                                    <dt class="col-sm-3 mt-3">bien louer</dt>
                                    <dd class="col-sm-9 mt-3">{{bien.name}}</dd>


                                    <dt class="col-sm-3 mt-3">locataire</dt>
                                    <dd class="col-sm-9 mt-3">{{locataire.nom}}</dd>


                                    <dt class="col-sm-3 mt-3">montant</dt>
                                    <dd class="col-sm-9 mt-3">{{rent.loyer_hc}} frc</dd>

                                    <dt class="col-sm-3 mt-3 text-truncate">loyer + charge</dt>
                                    <dd class="col-sm-9 mt-3">{{rent.loyer_ac}} frc</dd>

                                    <dt class="col-sm-3 mt-3 text-truncate">charge </dt>
                                    <dd class="col-sm-9 mt-3">{{rent.charge}} frc</dd>

                                    <dt class="col-sm-3 mt-3 text-truncate">garantir</dt>
                                    <dd class="col-sm-9 mt-3">{{rent.garantir}} frc</dd>

                                    <dt class="col-sm-3 mt-3 text-truncate">duree</dt>
                                    <dd class="col-sm-9 mt-3">{{rent.debut_bail}} - {{rent.fin_bail}} </dd>


                                    <dt class="col-sm-3 mt-3 text-truncate">nationalité</dt>
                                    <dd class="col-sm-9 mt-3"></dd>

                                    <dt class="col-sm-3 mt-3 text-truncate">ville</dt>
                                    <dd class="col-sm-9 mt-3"></dd>

                                    <dt class="col-sm-3 mt-3">Telephone</dt>
                                    <dd class="col-sm-9 mt-3">
                                        <dl class="row">
                                            <dt class="col-sm-4"></dt>

                                        </dl>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header">
                            <a class="btn btn-info">Retour</a>

                            <router-link to="" class="btn btn-warning ml-2"> Modifier</router-link>

                            <button class="btn btn-danger">suprimer</button>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "Showrent",

        data(){
            return{
                rent:{}, bien:{}, locataire:{},
            }
        },


        created() {
            // console.log(this.$route.params.id)
            axios.get('api/rentale/'+ this.$route.params.id)
                .then((response)=>{
                    console.log(response.data)
                    this.rent = response.data
                    this.bien = response.data.bien
                    this.locataire = response.data.locataire
                });
        },
    }
</script>

<style scoped>

</style>
