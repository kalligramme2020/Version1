<template>
    <div class="container-fluid">


        <div class = "page-header text-center">
            <h4> Nouveau locataire</h4>
        </div>
        <div class="dropdown-divider"></div>


        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-5">
                    <div class="card-header">Informations generaless</div>
                <FlashMessage class="flashmessage"></FlashMessage>

                    <div class="card-body">

                        <form enctype="multipart/form-data">

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nom">Noms</label>
                                    <input type="text" class="form-control" id="nom" v-model="Newtenant.nom"  required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="prenom">Prenom</label>
                                    <input type="text" class="form-control" id="prenom" v-model="Newtenant.prenom">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="Email4">Email</label>
                                    <input type="email" class="form-control" id="Email4" v-model="Newtenant.email"  required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone">Numero de telephone</label>
                                    <input type="number" class="form-control" id="phone" v-model="Newtenant.phone" >
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="pays">nationalité</label>
                                    <input type="text" class="form-control" id="pays" v-model="Newtenant.pays" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cni">Numero CNI</label>
                                    <input type="number" class="form-control" id="cni" v-model="Newtenant.cni">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="City">Profession</label>
                                    <input type="text" class="form-control" id="City" v-model="Newtenant.proff">
                                </div>
                            </div>

                            <div class="form-row justify-content-between" >
                                <div class="form-group  col-md-6">
                                    <label for="file">Photo</label>
                                    <input type="file" id="file"  @change="GetImage" />
                                </div>

                                <div class="form-group col-md-6 text-center" >
                                    <img :src="profil" alt="Image" width="150">
                                </div>
                            </div>

                            <div class="mt-5">
                                <router-link to="/tenants" class="btn bg-danger">retour</router-link>
                                <button class="btn btn-primary ml-4" @click="addtenant" >Enregistrer</button>
                            </div>

                        </form>

                    </div>


                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "newTenant",

        mounted() {
       },

        data(){
            return{
                Newtenant: { 'nom':"",
                    'email':"",
                    'phone':"",
                    'pays':"",
                    'proff':"",
                    'prenom':"",
                    'cni':""
                },

                profil: null //GET IMG profil
            }
        },

        methods:{
            GetImage(e){
                // console.log(e.target.files)
                let image = e.target.files[0]
                let reader = new FileReader();
                reader.readAsDataURL(image);
                reader.onload = e => {
                    // console.log(e)
                    this.profil = e.target.result
                    console.log(this.profil)
                }
            },

            addtenant(){
                axios.post('api/tenants', {
                    nom:this.Newtenant.nom,
                    prenom:this.Newtenant.prenom,
                    email:this.Newtenant.email,
                    phone:this.Newtenant.phone,
                    pays:this.Newtenant.pays,
                    cni:this.Newtenant.cni,
                    proff:this.Newtenant.proff,
                    image:this.profil
                })
              .then((response)=>{
                    // console.log(response.data);
                    if (response.data){
                        this.flashMessage.success({
                            title: 'Nouveau locataire',
                            message: 'Enregistrement terminé',
                            time: 3050,
                            flashMessageStyle: {
                                backgroundColor: 'linear-gradient(#e66465, #9198e5)',
                                position:top,
                            }
                        });
                    } else {
                        this.flashMessage.error({title: 'Error Message Title', message: 'xxxxxxxxxx'});
                    }
                })
                .then(
                    this.Newtenant.nom='', this.Newtenant.prenom="", this.Newtenant.email='', this.Newtenant.phone =''
                    , this.Newtenant.pays = '', this.Newtenant.cni ='', this.Newtenant.proff= '', this.profil=''
                )

            }

        }
    }

</script>

<style scoped>

</style>
