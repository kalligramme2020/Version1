<template>
    <div class="container-fluid">

        <div class = "page-header text-center">
            <h4> Modifier location</h4>
        </div>
        <div class="dropdown-divider"></div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-5">
                    <form enctype="multipart/form-data">

                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-8" id="type">
                                    <label for="bien">bien louer</label>
                                    <select class="form-control" id="bien" v-model="bienedit.id" >
                                        <option></option>
                                        <option v-for="bien in biens" :key="bien.id" :value="bien.id" >{{bien.name}}</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-8" v-if="locataire !== null">
                                    <label for="bienl">locataire</label>
                                    <select class="form-control" id="bienl" v-model="locataire.id">
                                        <option selected></option>
                                        <option v-for="locataire in locataires" :key="locataire.id" :value="locataire.id" >
                                            {{locataire.nom}}
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group col-md-8" v-else>
                                    <label for="bie">locataire</label>
                                    <select class="form-control" id="bie" v-model="editrent.locataire_id">
                                        <option selected></option>
                                        <option v-for="locataires in locataires" :key="locataires.id" :value="locataires.id" >
                                            {{locataires.nom}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card-header">detail de location</div>

                        <div class="card-body">
                            <FlashMessage class="flashmessage"></FlashMessage>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="ident">identifiant</label>
                                    <input type="text" class="form-control" id="ident" v-model="editrent.identifiant">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="typeb">type du bail</label>
                                    <select class="form-control" id="typeb" v-model="editrent.typebail">
                                        <option value=""></option>
                                        <option value="bail d'habitation vide">bail d'habitation vide</option>
                                        <option value="bail d'habitation meuble">bail d'habitation meuble</option>
                                        <option value="bail commerciale">bail commerciale</option>
                                        <option value="bail de stokage">bail de stokage</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-11">
                                    <div class="form-check mb-4" >
                                        <input class="form-check-input" type="radio"  id="principale" value="Résidence principale du locataire" >
                                        <label class="form-check-label" for="principale">
                                            Résidence principale du locataire
                                        </label>
                                    </div>
                                    <div class="form-check mb-4" >
                                        <input class="form-check-input" type="radio"  id="secondaire" value="Résidence secondaire du locataire">
                                        <label class="form-check-label" for="secondaire">
                                            Résidence secondaire du locataire
                                        </label>
                                    </div>
                                    <div class="form-check mb-4">
                                        <input class="form-check-input act" type="checkbox">
                                        <label class="form-check-label" for="porActivite">
                                            Le locataire est autorisé à exercer son activité professionnelle
                                        </label>
                                        <textarea v-model="editrent.activite" id="porActivite" class="form-control" placeholder="activité exercée dans les lieux louer"></textarea>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="toDate">debut du bail</label>
                                    <input type="date" class="form-control" name="toDate" id="toDate" v-model="editrent.debut_bail">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="fromDate">fin du bail</label>
                                    <input type="date" v-model="editrent.fin_bail" class="form-control" name="fromDate" id="fromDate" >
                                </div>

                                <div class="form-group col-md-6" >
                                    <label for="result">Duree du bail</label>
                                    <input type="button"  name="calculate" id="dura" value="Calculer" @click="calculate()" /> :
                                </div>
                                <div class="form-group col-md-6" >
                                    <input type="text" class="form-control" id="result" v-model="editrent.duree_bail">
                                </div>

                            </div>
                        </div>

                        <div class="card-header">loyer</div>
                        <div class="card-body">
                            <div class="">
                                <div class="form-group col-md-6">
                                    <label for="hors">loyer hors charge</label>
                                    <input type="number" class="form-control" id="hors" v-model="editrent.loyer_hc"  placeholder="fcfa">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="charge">charge</label>
                                    <input type="number" class="form-control" id="charge" v-model="editrent.charge" placeholder="fcfa">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="ave">loyer avec charge</label>
                                    <input type="number" class="form-control" id="ave" v-model="editrent.loyer_ac" placeholder="fcfa">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="avec">date de paiement</label>
                                    <input type="date" class="form-control" id="avec" v-model="editrent.payment_date" placeholder="fcfa">
                                </div>

                            </div>
                        </div>
                        <div class="card-header">depot de garantir</div>
                        <div class="card-body">
                            <div class="form-group row ml-2" >
                                <label for="garantir" class=" col-form-label">depot de grantir</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="garantir" v-model="editrent.garantir" placeholder="fcfa">
                                </div>
                            </div>
                        </div>

                        <div class="card-header proprio" type="button"> <i class="fa fa-chevron-down fa-lg" aria-hidden="true"></i> Travaux propriétaire</div>
                        <!--                        <div class="card-body">-->
                        <!--                            <div class="form-row">-->
                        <!--                                <div class="form-group col-md-3">-->
                        <!--                                    <label for="cout">Montant</label>-->
                        <!--                                    <input type="number" class="form-control" id="cout" v-model="proprio">-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                            <div class="form-group col-md-8">-->
                        <!--                                <label for="de">description</label>-->
                        <!--                                <textarea class="form-control" id="de" rows="3" v-model="proprioDescription"></textarea>-->
                        <!--                            </div>-->
                        <!--                        </div>-->

                        <div class="card-header tenant" type="button"> <i class="fa fa-chevron-down fa-lg" aria-hidden="true"></i> Travaux locataire</div>
                        <!--                        <div class="card-body" id="tenant">-->
                        <!--                            <div class="form-row">-->
                        <!--                                <div class="form-group col-md-3">-->
                        <!--                                    <label for="cou">Montant</label>-->
                        <!--                                    <input type="number" id="cou"  class="form-control" v-model="locataire">-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                            <div class="form-group col-md-8">-->
                        <!--                                <label for="des">description</label>-->
                        <!--                                <textarea class="form-control" id="des" rows="3" v-model="locataireDescription"></textarea>-->
                        <!--                            </div>-->
                        <!--                        </div>-->

                        <div class="card-header condition" type="button"> <i class="fa fa-chevron-down fa-lg" aria-hidden="true"></i> autres conditions</div>
                                                <div class="card-body">

                                                    <div class="form-group col-md-8">
                                                        <label for="desc">description</label>
                                                        <textarea class="form-control" id="desc" rows="3" v-model="editrent.description"></textarea>
                                                    </div>
                                                </div>

                        <div class="card-footer">
                            <div class="mt-5">
                                <router-link to="/rent" class="btn bg-danger">retour</router-link>
                                <button @click="EditRent" class="btn btn-primary">Appliquer</button>
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
        name: "Editrent",

        data(){
            return{
                editrent:{
                    'locataire_id':"", 'loyer_hc':"",'loyer_ac':"",'debut_bail':"",'residence2':"",
                    "payment_date":'','fin_bail':"",'typebail':'','duration':"",'residence1':"",
                },
                bienedit:{'id':"", 'name':""} ,locataire:{'id':"", 'nom':""},

                biens:"", locataires:"" , //liste des bien et locataire
            }
        },

        created(){
            axios.get('api/rentale/'+ this.$route.params.id +'/edit' )
                .then((response)=>{
                    this.editrent = response.data
                    this.bienedit = response.data.bien
                    this.locataire = response.data.locataire
                    console.log( this.bienedit)

                })

            axios.get('api/rentale/create')
                .then((response)=>{
                    this.biens = response.data.biens
                    this.locataires = response.data.locataires

                })
        },

        methods:{
            EditRent(){
                axios.patch('api/rentale/'+ this.editrent.id,{
                    bienlouer:this.bienedit.id,
                    locataire_id:this.locataireId,
                    description:this.editrent.description,
                    identifiant:this.editrent.identifiant,
                    residence1:this.editrent.residence1,
                    residence2:this.editrent.residence2,
                    activite:this.editrent.activite,
                    loyerhc:this.editrent.loyer_hc,
                    loyerac:this.editrent.loyer_ac,
                    debutb:this.editrent.debut_bail,
                    finb:this.editrent.fin_bail,
                    typebail:this.editrent.typebail,
                    paiement_date:this.editrent.payment_date,
                    garantir:this.editrent.garantir,
                    charge:this.editrent.charge,
                    duree_bail:this.editrent.duration

                })
                    .then( (response) => {
                        // console.log(response.data);
                        if (response.data === 200){
                            this.flashMessage.success({
                                title: 'Location modifier',
                                message: 'Modification terminé',
                                time: 3050,
                                flashMessageStyle: {
                                    backgroundColor: 'linear-gradient(#e66465, #9198e5)',
                                    position:top
                                }
                            });
                        }
                        else{
                            this.flashMessage.error({
                                title: 'Oups',
                                message: "une erreur c'est produite tenter a nouveau " });
                        }
                    })
                    .then(
                        this.bienlouer='', this.locataire_id="", this.editrent.description='', this.editrent.identifiant ='',
                        this.editrent.residence1 = '', this.NewRent.residence2 ='',
                        this.editrent.activite= '', this.editrent.loyerhc="", this.editrent.loyerac="",
                        this.editrent.debutb="", this.editrent.finb="", this.typebail="",
                        this.editrent.paiement_date="", this.editrent.garantir="", this.editrent.garantir="",
                    )
            },

            calculate(){
                var fromDate = this.editrent.debut_bail;
                var toDate = this.editrent.fin_bail;

                try {
                    document.getElementById('result').innerHTML = '';

                    var result = this.getDateDifference(new Date(fromDate), new Date(toDate));

                    if (result && !isNaN(result.years)) {
                        document.getElementById('result').value =
                            result.years + ' an' + (result.years === 1 ? ' ' : 's ') +
                            result.months + ' moi' + (result.months === 1 ? ' ' : 's ') + 'et ' +
                            result.days + ' jour' + (result.days === 1 ? '' : 's');
                        this.editrent.duration = document.getElementById('result').value;

                    }
                } catch (e) {
                    console.error(e);
                }
            },

            getDateDifference(startDate, endDate){
                if (startDate > endDate) {
                    console.error('Start date must be before end date');
                    return null;
                }
                var startYear = startDate.getFullYear();
                var startMonth = startDate.getMonth();
                var startDay = startDate.getDate();

                var endYear = endDate.getFullYear();
                var endMonth = endDate.getMonth();
                var endDay = endDate.getDate();

                // We calculate February based on end year as it might be a leep year which might influence the number of days.
                var february = (endYear % 4 === 0 && endYear % 100 !== 0) || endYear % 400 === 0 ? 29 : 28;
                var daysOfMonth = [31, february, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

                var startDateNotPassedInEndYear = (endMonth < startMonth) || endMonth === startMonth && endDay < startDay;
                var years = endYear - startYear - (startDateNotPassedInEndYear ? 1 : 0);

                var months = (12 + endMonth - startMonth - (endDay < startDay ? 1 : 0)) % 12;

                // (12 + ...) % 12 makes sure index is always between 0 and 11
                var days = startDay <= endDay ? endDay - startDay : daysOfMonth[(12 + endMonth - 1) % 12] - startDay + endDay;

                return {
                    years: years,
                    months: months,
                    days: days
                };
            }

        },

        computed:{
            locataireId(){
                if (this.locataire === null)
                    return this.editrent.locataire_id
                else
                    return this.locataire.id
            }
        }


    }
</script>

<style scoped>

</style>
