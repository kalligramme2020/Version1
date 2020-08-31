<template>
    <div class="container-fluid">
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="card mb-3 col-md-12">

                    <div class="row no-gutters ">
                        <div class="col-md-8">
                            <div class="card-body">
                                <dl class="row pl-5 ">
                                    <dt class="col-sm-3 mt-3">location</dt>
                                    <dd class="col-sm-9 mt-3 text-primary">{{local.identifiant}}</dd>

                                    <dt class="col-sm-3 mt-3">locataire</dt>
                                    <dd class="col-sm-9 mt-3"></dd>


                                    <dt class="col-sm-3 mt-3">bien</dt>
                                    <dd class="col-sm-9 mt-3"></dd>

                                    <dt class="col-sm-3 mt-3 text-truncate">avance</dt>
                                    <dd class="col-sm-9 mt-3">{{invoice.avance}}</dd>

                                    <dt class="col-sm-3 mt-3 text-truncate">reste</dt>
                                    <dd class="col-sm-9 mt-3">{{invoice.reste}}</dd>

                                    <dt class="col-sm-3 mt-3 text-truncate">total</dt>
                                    <dd class="col-sm-9 mt-3">{{invoice.total}}</dd>

                                    <dt class="col-sm-3 mt-3 text-truncate">fait le:</dt>
                                    <dd class="col-sm-9 mt-3">{{invoice.fait_le}}</dd>

                                    <dt class="col-sm-3 mt-3"></dt>
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


                <div class="col-md-10">
                    <div class="card ">


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
