<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5" >
                    <div class="card-header text-white bg-info mb-1">
                        <div class="row">

                            <div class="col">
                                <h2 class="card-title">Facture</h2>
                                <div><i class="fas fa-coins fa-lg"></i></div>
                            </div>

                            <div class="col  text-center">
                            </div>

                            <div class="col text-right">
                                <span class="mb-2">Addresse</span>
                                <span >ville region pays </span>
                                <span >ville region pays </span>
                                <span >email@gmail.com</span>
                                <span class="mb-2">697535871</span>


                            </div>

                        </div>
                    </div>

                    <div class="card-body">

                            <div class="row ">
                                <div class="col order-last">
                                    <h5 class="text-muted">Total</h5>
                                    <h4 class="text-muted">12000 Fcfa</h4>
                                </div>

                                <div class="col">
                                    <h6 class="mt-2 mb-1 text-muted">identifiant de location</h6>
                                    <h5 class="bt-5">{{local.identifiant}}</h5>

                                </div>

                                <div class="col order-first">
                                    <h6 class="card-title text-muted" >Client</h6>
                                        <p>
                                            <span class="d-flex">email@gmail.com</span>
                                            <span class="d-flex">numero</span>
                                            <span class="d-flex">no-cni</span>
                                            <span class="d-flex">names</span>
                                        </p>
                                </div>
                            </div>

                        <div class="dropdown-divider border-primary w-100 "></div>

                        <dl class="row  mt-3">
                            <dt class="col-sm-6">Avance</dt>
                            <dd class="col-sm-6">{{invoice.avance}} CFA</dd>
                            <dt class="col-sm-6 ">Reste</dt>
                            <dd class="col-sm-6">{{invoice.reste}} CFA</dd>
                            <dt class="col-sm-6">Total</dt>
                            <dd class="col-sm-6">{{invoice.total}}  CFA</dd>
                        </dl>

                        <div class="alert alert-success" role="alert">
                            <h5 class="alert-heading">Description</h5>
                            <p class="mb-0">{{invoice.description}}</p>
                        </div>
                    </div>

                    <div class="text-left ml-5">
                        <p><span>fait le</span> : <span>{{invoice.fait_le}}</span></p>
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
                    console.log(response.data)
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


