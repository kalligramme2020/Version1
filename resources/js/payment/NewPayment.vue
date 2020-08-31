<template>
    <div id="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            Ajouter un revenue

                        </div>
                    </div>
                </div>

            </div>


            <div class="row justify-content-center mt-5">
                <div class="col-md-8">
                    <form>
                        <div class="card">
                            <div class="card-header">reglement de loyer  <FlashMessage></FlashMessage>
                            </div>
                            <div class="card-body mb-2">
                                <div class="form-row justify-content-center">
                                    <div class="col-md-8 mb-4 ">
                                        <label for="inputState">location lier</label>
                                        <select id="inputState" class="form-control" v-model="location">
                                            <option selected>Choose...</option>
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
                                        <input type="date" class="form-control" id="debut" v-model="facture.debut">
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label for="fin">fin</label>
                                        <input type="date" class="form-control" id="fin" v-model="facture.fin">
                                    </div>
                                </div>
                            </div>


                            <div class="card-header">montant</div>
                            <div class="card-body jus">
                                <div class="form-row justify-content-center">


                                    <div class="col-md-8 mb-2">
                                        <label for="avance">avance</label>
                                        <input type="number" class="form-control" id="avance" v-model="facture.avance" placeholder="CFA ">
                                    </div>

                                    <div class="col-md-8 mb-2">
                                        <label for="reste">reste</label>
                                        <input type="number" class="form-control" id="reste" v-model="facture.reste" placeholder="CFA   ">
                                    </div>

                                    <div class="col-md-8 mb-2">
                                        <label for="cout">total</label>
                                        <input type="number" class="form-control" id="cout" v-model="facture.total" placeholder="CFA ">
                                    </div>

                                    <div class="col-md-8 mb-2">
                                        <label for="desc">description</label>
                                        <textarea v-model="facture.description" id="desc" class="form-control"></textarea>
                                    </div>

                                    <div class="col-md-8 mb-2">
                                        <label for="date">fait le:</label>
                                        <input type="date" class="form-control" id="date" v-model="facture.date">
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button @click="addpayment"  class="btn btn-outline-primary float-right mr-5">enregistrer</button>
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
        name: "NewPayment",
        data(){
            return{

                facture:{
                    'locataire':'', 'bien':'', 'debut':'', 'fin':'',
                    'avance':'', 'reste':'', 'total':'', 'date':'', 'description':'',
                },
                location:'',
                rental:{},
            }
        },

        created(){
            axios.get(' api/payment/create')
                .then((response)=>{
                    console.log(response.data)
                    this.rental = response.data
                })
        },

        methods:{
            addpayment(){
                axios.post('api/payment', {
                    locataire:this.facture.locataire,
                    location:this.location,
                    bien:this.facture.bien,
                    debut:this.facture.debut,
                    fin:this.facture.fin,
                    avance:this.facture.avance,
                    reste:this.facture.reste,
                    total:this.facture.total,
                    date:this.facture.date,
                    description:this.facture.description,
                })
                    .then((response)=>{
                        // console.log(response.data);
                        if (response.data){
                            this.flashMessage.success({
                                title: 'Nouvel facture',
                                message: 'Enregistrement terminé',
                                time: 3000,
                                flashMessageStyle: {
                                    backgroundColor: 'linear-gradient(#e66465, #9198e5)'
                                }
                            });
                        } else {
                            this.flashMessage.error({title: 'Error Message Title', message: 'xxxxxxxxxx'});
                        }
                    })
                    .then(
                        this.location='', this.facture.locataire="", this.facture.bien='', this.facture.debut='',
                        this.facture.fin = '', this.facture.avance ='', this.facture.total= '',
                        this.facture.reste= '', this.facture.description='',this.facture.date='',
                    )

            }

        }
    }
</script>

<style scoped>

</style>
