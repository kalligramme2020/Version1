<template>
  <div class="container">
      <div class="row">
          <div class="col-md-6">
              <div class="card border-primary">
                  <div class="card-header">Informations</div>
                  <div class="card-body">
                      <h4 class="card-title text-primary">{{rent.identifiant}}</h4>
                      <h6 class="card-title">{{rent.debut_bail}} - {{rent.fin_bail}}</h6>
                      <div class="alert alert-primary text-center " role="alert">
                          <i class="fas fa-coins fa-lg"></i>
                          <span class="title">Loyer:</span>
                          <span  class="title" style="font-size: x-large">{{rent.loyer_hc}} Cfa</span>
                      </div>

                      <div class="row">
                          <div class=" border-right col">
                              <h6 class="card-title text-info">Locataire:</h6>
                              <div class="dropdown-divider"></div>
                              <p> Nom:{{locataire.nom}} {{locataire.prenom}}</p>

                          </div>
                          <div class=" border-right col">
                              <h6 class="card-title text-info" >Adresse:</h6>
                              <div class="dropdown-divider"></div>
                              <span class="d-flex"> {{locataire.email}} </span>
                              <span class="d-flex"> {{locataire.numero}} </span>
                              <span class="d-flex"> {{locataire.ville}} </span>
                              <span class="d-flex"> {{locataire.nationalite}} </span>
                          </div>
                      </div>
                      <div class="dropdown-divider"></div>

                      <div class="row">
                          <div class=" border-right col">
                              <h6 class="card-title text-info">Proprio:</h6>
                              <div class="dropdown-divider"></div>
                              <p> Nom:{{bailieur.name}} {{bailieur.prenom}}</p>

                          </div>
                          <div class=" border-right col">
                              <h6 class="card-title text-info" >Adresse:</h6>
                              <div class="dropdown-divider"></div>
                              <span class="d-flex"> {{bailieur.email}} </span>
                              <span class="d-flex"> {{bailieur.numero}} </span>
                              <span class="d-flex"> {{bailieur.ville}} </span>
                              <span class="d-flex"> {{bailieur.pays}} </span>
                          </div>
                      </div>

                      <div class="dropdown-divider"></div>

                      <div class="row">
                          <div class=" border-right col">
                              <h6 class="card-title text-info">paiement:</h6>
                              <div class="dropdown-divider"></div>
                              <p> Paiement: Mensuel</p>
                              <span class="d-flex">Charge: {{rent.charge}} </span>
                              <span class="d-flex">loyer hors Charge: {{rent.loyer_hc}} </span>
                              <span class="d-flex">loyer avec Charge: {{rent.loyer_ac}} </span>


                          </div>
                          <div class=" border-right col">
                              <h6 class="card-title text-info" >Depots:</h6>
                              <div class="dropdown-divider"></div>
                              <span class="d-flex">Depot de garantir: {{rent.garantir}} frc </span>
                          </div>
                      </div>

                      <div class="dropdown-divider"></div>

                      <a href="#" class="btn btn-primary">Go somewhere</a>
                  </div>
              </div>
          </div>


          <div class="col-md-6">
              <div class="card text-center">
                  <div class="card-header">
                      Etats des lieux
                  </div>
                  <div class="card-body">
                      <h5 class="card-title"></h5>
                      <p class="card-text"></p>
                      <a href="#" class="btn btn-primary"></a>
                  </div>


                  <div class="card border-success">
                      <div class="card-body">
                          <h6 class="card-title text-left text-muted">Description:</h6>
                          <p>{{rent.description}}</p>
                      </div>
                  </div>


              </div>
          </div>


      </div>
      <div class="card mt-4 ">
          <div class="card-footer text-center">
              <router-link to="/rent" class="btn btn-info">Retour</router-link>

              <router-link :to="{ name: 'editrent', params: { id: rent.id }}" class="btn btn-warning ml-2"> Modifier</router-link>

              <button class="btn btn-danger">suprimer</button>

          </div>

      </div>
  </div>
</template>

<script>
    export default {
        name: "Showrent",

        data(){
            return{
                rent:{}, bien:{}, locataire:{},bailieur:{},
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
                    this.bailieur = response.data.bailler
                });
        },
    }
</script>

<style scoped>

</style>
