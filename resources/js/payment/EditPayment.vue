<template>
    <div id="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            modifier cette facture
                        </div>
                    </div>
                </div>

            </div>


            <div class="row justify-content-center mt-5">
                <div class="col-md-8">
                    <form>
                        <div class="card">
                            <div class="card-header">reglement de loyer <div style="z-index: 1000"> <FlashMessage></FlashMessage></div>
                            </div>
                            <div class="card-body mb-2">
                                <div class="form-row justify-content-center">
                                    <div class="col-md-8 mb-4 "> <label for="inputState">location lier</label>
                                        <select id="inputState" class="form-control" v-model="location.id">
                                            <option ></option>
                                            <option v-for="rent in rental" :value="rent.id" :key="rent.id">{{rent.identifiant}}</option>
                                        </select>
                                    </div>
                                    <!--                                    <div class="col-md-6 mb-2"> <label for="State">biens</label>-->
                                    <!--                                        <select id="State" class="form-control" v-model="bien">-->
                                    <!--                                            <option selected>Choose...</option>-->
                                    <!--                                            <option></option>-->
                                    <!--                                        </select>-->
                                    <!--                                    </div>-->
                                    <!--                                    <div class="col-md-6 mb-2">-->
                                    <!--                                        <label for="input">locataire</label>-->
                                    <!--                                        <select id="input" class="form-control" v-model="locataire">-->
                                    <!--                                            <option selected>Choose...</option>-->
                                    <!--                                            <option></option>-->
                                    <!--                                        </select>-->
                                    <!--                                    </div>-->

                                    <div class="col-md-6 mb-2">
                                        <label for="debut">debut</label>
                                        <input type="date" class="form-control" id="debut" v-model="Editfacture.debut">
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label for="fin">fin</label>
                                        <input type="date" class="form-control" id="fin" v-model="Editfacture.fin">
                                    </div>
                                </div>
                            </div>


                            <div class="card-header">montant</div>
                            <div class="card-body jus">
                                <div class="form-row justify-content-center">


                                    <div class="col-md-8 mb-2">
                                        <label for="avance">avance</label>
                                        <input type="number" class="form-control" id="avance" v-model="Editfacture.avance" placeholder="CFA ">
                                    </div>

                                    <div class="col-md-8 mb-2">
                                        <label for="reste">reste</label>
                                        <input type="number" class="form-control" id="reste" v-model="Editfacture.reste" placeholder="CFA   ">
                                    </div>

                                    <div class="col-md-8 mb-2">
                                        <label for="cout">total</label>
                                        <input type="number" class="form-control" id="cout" v-model="Editfacture.total" placeholder="CFA ">
                                    </div>

                                    <div class="col-md-8 mb-2">
                                        <label for="desc">description</label>
                                        <textarea v-model="Editfacture.description" id="desc" class="form-control"></textarea>
                                    </div>

                                    <div class="col-md-8 mb-2">
                                        <label for="date">fait le:</label>
                                        <input type="date" class="form-control" id="date" v-model="Editfacture.fait_le">
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button  @click="editpayment" class="btn btn-outline-primary float-right mr-5">appliquer</button>
                                <router-link to="/payment" class="btn btn-outline-danger float-right mr-3">retour</router-link>
                            </div>
                        </div>


                    </form>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "EditPayment",

        data(){
            return{
                rental:{},
                location:{'id':"",'identifian':""},
                Editfacture:{
                    'locataire':'', 'bien':'', 'debut':'', 'fin':'',
                    'avance':'', 'reste':'', 'total':'', 'fait_le':'', 'description':'',
                },
            }
        },

        created(){
            axios.get(' api/payment/create')
                .then((response)=>{
                    // console.log(response.data)
                    this.rental = response.data
                })

            axios.get('api/payment/'+ this.$route.params.id +'/edit' )
                .then((response)=>{
                    this.Editfacture = response.data
                    this.location = response.data.location
                    console.log(response.data)
                })
        },

        methods:{
            editpayment(){
                axios.patch('api/payment/' + this.Editfacture.id, {
                    locataire:this.Editfacture.locataire,
                    location:this.location.id,
                    bien:this.Editfacture.bien,
                    debut:this.Editfacture.debut,
                    fin:this.Editfacture.fin,
                    avance:this.Editfacture.avance,
                    reste:this.Editfacture.reste,
                    total:this.Editfacture.total,
                    date:this.Editfacture.fait_le,
                    description:this.Editfacture.description,
                })
                    .then((response)=>{
                        // console.log(response.data);
                        if (response.data === 200){
                            this.flashMessage.success({
                                title: 'modifier facture',
                                message: 'Enregistrement terminé',
                                time: 3000,
                                flashMessageStyle: {
                                    backgroundColor: 'linear-gradient(#e66465, #9198e5)'
                                }
                            });
                        } else {
                            this.flashMessage.error({
                                title: 'Oupss',
                                message: 'un probleme rencontrer tenter plus tard svp'});
                        }
                    })
                    .then(
                        this.location='', this.Editfacture.locataire="", this.Editfacture.bien='', this.Editfacture.debut='',
                        this.Editfacture.fin = '', this.Editfacture.avance ='', this.Editfacture.total= '',
                        this.Editfacture.reste= '', this.Editfacture.description='',this.Editfacture.date='',
                    )

            }

        }


    }
</script>

<style scoped>

</style>
