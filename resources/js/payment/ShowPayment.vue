<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5" >
                    <div class="card-header">Facture de loyer</div>

                    <div class="card-body">
                        <div class="row no-gutters ">
                            <div class="col-md-8">
                                <div class="card-body">
                                    <dl class="row pl-5 ">
                                        <dt class="col-sm-5 mt-1">location</dt>
                                        <dd class="col-sm-5 mt-1 text-primary">{{local.identifiant}}</dd>

                                        <dt class="col-sm-5 mt-1">locataire</dt>
                                        <dd class="col-sm-5 mt-1"></dd>


                                        <dt class="col-sm-5 mt-1">bien</dt>
                                        <dd class="col-sm-5 mt-1"></dd>

                                        <dt class="col-sm-5 mt-1">avance</dt>
                                        <dd class="col-sm-5 mt-1">{{invoice.avance}}  Fcfa</dd>

                                        <dt class="col-sm-5 mt-1">reste</dt>
                                        <dd class="col-sm-5 mt-1">{{invoice.reste}}  Fcfa</dd>

                                        <dt class="col-sm-5 mt-1">total</dt>
                                        <dd class="col-sm-5 mt-1">{{invoice.total}}  Fcfa</dd>

                                        <dt class="col-sm-5 mt-1">fait le:</dt>
                                        <dd class="col-sm-5 mt-1">{{invoice.fait_le}} </dd>

                                        <div class="c-callout c-callout-warning b-t-1 b-r-1 b-b-1">
                                            <small class="text-muted">description</small><br>
                                            <strong class="h6">{{invoice.description}}</strong>
                                        </div>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <router-link to="/payment" class="btn btn-info">Retour</router-link>

                        <router-link :to="{ name: 'edit_payment', params: { id: invoice.id }}" class="btn btn-warning ml-2"> Modifier</router-link>

                        <button @click="deletetenant(tenant.id)" class="btn btn-danger ml-2">suprimer</button>

                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ShowPayment",

        data(){
            return{
                invoice:{}, local:'',
            }
        },


        created() {
            // console.log(this.$route.params.id)
            axios.get('api/payment/'+ this.$route.params.id)
                .then((response)=>{
                    // console.log(response.data)
                    this.invoice = response.data
                    this.local = response.data.location
                    // console.log(this.local)
                });
        },

        // methods:{
        //     deletetenant(id){
        //         axios.delete('api/tenants/' + id)
        //             .then((response)=>{
        //                 // console.log(response.data)
        //
        //                 if (response.data){
        //                     this.flashMessage.success({
        //                         title: 'Supprimer',
        //                         message: 'Action reussit',
        //                         time: 3000,
        //                         flashMessageStyle: {
        //                             backgroundColor: 'linear-gradient(#e66465, #9198e5)'
        //                         }
        //                     });
        //                 } else {
        //                     this.flashMessage.error({title: 'Error Message Title', message: 'xxxxxxxxxx'});
        //                 }
        //             })
        //     },
        // },
    }
</script>

<style scoped>

</style>
