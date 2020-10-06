<template>
    <div class="container-fluid">

        <div class = "page-header text-center">
            <h4> Nouvelle location.</h4>
        </div>
        <div class="dropdown-divider"></div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-5">
                    <form enctype="multipart/form-data">
                        <FlashMessage class="flashmessage"></FlashMessage>

                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-8" id="type">
                                    <label for="bien">bien louer</label>
                                    <select class="form-control" id="bien" v-model="NewRent.bienlouer">
                                        <option></option>
                                        <option v-for="bien in biens" :key="bien.id" :value="bien.id" >
                                            <span>{{bien.name}}</span>
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group col-md-8">
                                    <label for="bienl">locataire</label>
                                    <select class="form-control" id="bienl" v-model="NewRent.locataire_id">
                                        <option></option>
                                        <option v-for="locataire in locataires" :key="locataire.id" :value="locataire.id" >{{locataire.nom}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card-header">detail de location</div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="ident">identifiant</label>
                                    <input type="text" class="form-control" id="ident" v-model="NewRent.identifiant">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="typeb">type du bail</label>
                                    <select class="form-control" id="typeb" v-model="NewRent.typebail">
                                        <option value=""></option>
                                        <option value="bail d'habitation vide">bail d'habitation vide</option>
                                        <option value="bail d'habitation meuble">bail d'habitation meuble</option>
                                        <option value="bail commerciale">bail commerciale</option>
                                        <option value="bail de stokage">bail de stokage</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-11">
                                    <div class="form-check mb-4" >
                                        <input class="form-check-input" type="radio" v-model="NewRent.residence1" id="principale" value="Résidence principale du locataire" >
                                        <label class="form-check-label" for="principale">
                                            Résidence principale du locataire
                                        </label>
                                    </div>
                                    <div class="form-check mb-4" >
                                        <input class="form-check-input" type="radio" v-model="NewRent.residence2" id="secondaire" value="Résidence secondaire du locataire">
                                        <label class="form-check-label" for="secondaire">
                                            Résidence secondaire du locataire
                                        </label>
                                    </div>
                                    <div class="form-check mb-4">
                                        <input class="form-check-input act" type="checkbox">
                                        <label class="form-check-label" for="porActivite">
                                            Le locataire est autorisé à exercer son activité professionnelle
                                        </label>
                                        <textarea v-model="NewRent.activite" id="porActivite" class="form-control" placeholder="activité exercée dans les lieux louer"></textarea>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="toDate">debut du bail</label>
                                    <p><input type="date" class="form-control" name="toDate" id="toDate"  v-model="NewRent.debutb" /></p>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="fromDate">fin du bail</label>
                                    <p><input type="date" class="form-control" name="fromDate" id="fromDate" v-model="NewRent.finb"  /></p>
                                </div>

                                <div class="form-group col-md-6" >
                                    <label for="result">Duree du bail</label>
                                    <input type="button"  name="calculate" id="dura" value="Calculer" @click="calculate()" /> :
                                </div>
                                <div class="form-group col-md-6" >
                                    <input type="text" class="form-control" id="result" v-model="NewRent.duration" >
                                </div>


                            </div>
                        </div>

                        <div class="card-header">loyer</div>
                        <div class="card-body">
                            <div class="">
                                <div class="form-group col-md-6">
                                    <label for="hors">loyer hors charge</label>
                                    <input type="number" class="form-control" id="hors" v-model="NewRent.loyerhc" placeholder="fcfa">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="charge">charge</label>
                                    <input type="number" class="form-control" id="charge" v-model="NewRent.charge" placeholder="fcfa">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="ave">loyer avec charge</label>
                                    <input type="number" class="form-control" id="ave" v-model="NewRent.loyerac" placeholder="fcfa">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="avec">date de paiement</label>
                                    <input type="number" class="form-control" id="avec" v-model="NewRent.paiement_date">
                                    <span></span>
                                </div>

                            </div>
                        </div>
                        <div class="card-header">depot de garantir</div>
                        <div class="card-body">
                            <div class="form-group row ml-2" >
                                <label for="garantir" class=" col-form-label">depot de grantir</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="garantir" v-model="NewRent.garantir" placeholder="fcfa">
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
                                <textarea class="form-control" id="desc" rows="3" v-model="NewRent.description"></textarea>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="mt-5">
                                <router-link to="/rent" class="btn bg-danger">retour</router-link>
                                <button class="btn btn-primary" @click="AddLocation">Enregistrer</button>
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
        name: "Newrent",

        data(){
            return{
              NewRent:{
                  'bienlouer':"", 'locataire_id':"", 'identifiant':"", 'typebail':"",
                  'residence2':"", 'residence1':"", 'activite':"",'debutb':"" , 'finb':"",
                  'loyerac':"", 'loyerhc':"",'charge':"", 'paiement_date':"", 'garantir':"",
                  'description':"", 'duration':"",
              },
                biens:"",
                locataires:"" , //liste des bien et locataire
            }
        },

        mounted() {
        },

        created(){
            axios.get('api/rentale/create')
                .then((response)=>{
                    this.biens = response.data.biens;
                    this.locataires = response.data.locataires;
                    console.log(this.biens)

                })
        },

        methods:{
            AddLocation(){
                axios.post('api/rentale', {
                    bienlouer:this.NewRent.bienlouer,
                    locataire_id:this.NewRent.locataire_id,
                    description:this.NewRent.description,
                    identifiant:this.NewRent.identifiant,
                    residence1:this.NewRent.residence1,
                    residence2:this.NewRent.residence2,
                    activite:this.NewRent.activite,
                    loyerhc:this.NewRent.loyerhc,
                    loyerac:this.NewRent.loyerac,
                    debutb:this.NewRent.debutb,
                    finb:this.NewRent.finb,
                    typebail:this.typebail,
                    paiement_date:this.NewRent.paiement_date,
                    garantir:this.NewRent.garantir,
                    charge:this.NewRent.charge,
                    duree_bail:this.NewRent.duration
                })
                .then((response)=>{
                    if (response.data === 200){
                        this.flashMessage.success({
                            title: 'Nouvel location',
                            message: 'Enregistrement terminé',
                            time: 3000,
                            flashMessageStyle: {
                                backgroundColor: 'linear-gradient(#e66465, #9198e5)'
                            }
                        });
                    } else {
                        this.flashMessage.info({
                            title: 'Oooops',
                            message: " Desoler vous ne pouver louer ce bien car il fait deja l'obet d'une location en cour. Merci ! "
                        });
                    }
                })
                .then(
                    this.NewRent.bienlouer='', this.NewRent.locataire_id="", this.NewRent.description='', this.NewRent.identifiant ='',
                    this.NewRent.residence1 = '', this.NewRent.residence2 ='',
                    this.NewRent.activite= '', this.NewRent.loyerhc="", this.NewRent.loyerac="",
                    this.NewRent.debutb="", this.NewRent.finb="", this.NewRent.typebail="",
                    this.NewRent.paiement_date="", this.NewRent.garantir="", this.NewRent.garantir="",
                )
            },

            calculate(){
                var fromDate = this.NewRent.debutb;
                var toDate = this.NewRent.finb;

                try {
                    document.getElementById('result').innerHTML = '';

                    var result = this.getDateDifference(new Date(fromDate), new Date(toDate));

                    if (result && !isNaN(result.years)) {

                        document.getElementById('result').value =
                            result.years + ' an' + (result.years === 1 ? ' ' : 's ') +
                            result.months + ' moi' + (result.months === 1 ? ' ' : 's ') + 'et ' +
                            result.days + ' jour' + (result.days === 1 ? '' : 's');
                        this.NewRent.duration = document.getElementById('result').value;

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

    }



</script>


<style scoped>

</style>
