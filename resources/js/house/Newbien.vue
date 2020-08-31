<template>
    <div class="container-fluid">
        <div class = "page-header text-center">
            <h4> Nouveau bien</h4>
            <div style="z-index:2000"> <FlashMessage></FlashMessage></div>

        </div>
        <div class="dropdown-divider"></div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-5">
                    <form enctype="multipart/form-data">
                        <div class="card-header">Informations generales</div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="ty">type du bien</label>
                                    <select class="form-control" id="ty" v-model="newHouse.typebien"  required>
                                        <option value=""></option>
                                        <option v-for="typebien in typeBiens" :key="typebien.id"  v-bind:value="typebien.id"  >{{typebien.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="non">Nom</label>
                                    <input type="text" class="form-control" id="non" v-model="newHouse.name"required >
                                </div>

                                <div class="form-group col-md-6 ml-2" >
                                    <label for="papa" class="text-success">Est ce un sous bien? si oui chosir le bien parent</label>
                                    <select class="form-control" id="papa" v-model="newHouse.parent_id" >
                                        <option></option>
                                        <option v-for="parent in bienParent" :key="parent.id" v-bind:value="parent.id">{{parent.name}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-header">Address</div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nom">addresse</label>
                                    <input type="text" class="form-control" id="nom" v-model="newHouse.addresse">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pre">ville </label>
                                    <input type="text" class="form-control" id="pre" v-model="newHouse.ville">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pays">pays <i class="fa fa-flag-checkered" aria-hidden="true"></i></label>
                                    <select class="form-control" id="pays" v-model="newHouse.pays">
                                        <option></option>
                                        <option v-for="country in countries" v-bind:value="country.id" >{{ country.pays }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="region">region</label>
                                    <input type="text" class="form-control" id="region" v-model="newHouse.region">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="air">surface M²</label>
                                    <input type="number" class="form-control" id="air" v-model="newHouse.surface">
                                </div>
                                <div class="form-group col-md-8">
                                    <textarea class="form-control" placeholder="description" rows="3" v-model="newHouse.description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-header">photo</div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group  col-md-6">
                                    <label for="file">Photo</label>
<!--                                    <input type="file" class="form-control-file" id="file">-->
                                    <input type="file" class="form-control-file" id="file"  @change="GetImage" />
                                </div>

                                <div class="form-group col-md-6">
                                    <img :src="profil" alt="Image" width="150">
                                </div>
                            </div>
                        </div>
                        <div class="cache">
                            <div class="card-header">cas himeuble</div>
                            <div class="card-body" v-if="newHouse.typebien === 1">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="appt">Appartement</label>
                                        <input type="number" class="form-control" id="appt" v-model="newHouse.appart">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="studio">studio</label>
                                        <input type="number" class="form-control" id="studio" v-model="newHouse.studio">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="prenon">appartement meuble</label>
                                        <input type="number" class="form-control" id="prenon" v-model="newHouse.meuble">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="magasin">magasin</label>
                                        <input type="number" class="form-control" id="magasin" v-model="newHouse.magasin">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="salle">salle de banquet</label>
                                        <input type="number" class="form-control" id="salle" v-model="newHouse.banquet">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="piece">
                            <div class="card-header">pieces</div>
                            <div class="card-body" v-if="newHouse.typebien > 1 && newHouse.typebien !== null ">
                                <div class="form-row justify-content-around">
                                    <div class="form-group col-md-2">
                                        <label for="chambre">chambre</label>
                                        <input type="number" class="form-control hide" id="chambre" v-model="newHouse.chambre">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="salon">salon</label>
                                        <input type="number" class="form-control hide" id="salon" v-model="newHouse.salon">
                                    </div>
                                </div>
                                <div class="form-row justify-content-around ">
                                    <div class="form-group col-md-2">
                                        <label for="bain">sale de bain</label>
                                        <input type="number" class="form-control hide" id="bain" v-model="newHouse.bain">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="cuisine"> cuisine</label>
                                        <input type="number" class="form-control hide" id="cuisine" v-model="newHouse.cuisine">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="mt-5">
                                <router-link to="/bien" class="btn bg-danger">retour</router-link>
                                <button class="btn btn-primary" @click="addbien">Enregistrer</button>
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
        name: "Newbien",

        data(){
            return{
                newHouse:{
                    'cuisine':"", 'bain':"",'salon':"",'chambre':"",
                    'studio':"",'meuble':"", 'magasin':"",'bienParent':"",'typebien':"",
                    'banquet':"", 'appart':'','description':"",'surface':"", 'region':"",
                    'pays':"", 'ville':"",'addresse':"", 'name':"",'parent_id':""
                },
                profil: null,

                countries:"",
                bienParent:{},
                typeBiens:"",



            }
        },

        created() {
            axios.get('api/pays')
                .then((response )=> {
                    this.countries= response.data.land
                    this.typeBiens= response.data.peol
                    // console.log( this.country, this.typeBiens)
                });

            axios.get('api/bien')
                .then((response)=>{
                    this.bienParent = response.data
                    // console.log(this.bienParent)
                })
        },


        methods:{
            //ajout d'un //

            GetImage(e){
                // console.log(e.target.files)

                let image = e.target.files[0]
                let reader = new FileReader();
                reader.readAsDataURL(image);
                reader.onload = e => {
                    // console.log(e)
                    this.profil = e.target.result
                }
            },

            addbien(){
                axios.post('api/bien', {
                    name:this.newHouse.name,
                    typebien:this.newHouse.typebien,
                    ville:this.newHouse.ville,
                    region:this.newHouse.region,
                    pays:this.newHouse.pays,
                    addresse:this.newHouse.addresse,
                    surface:this.newHouse.surface,
                    description:this.newHouse.description,
                    chambre:this.newHouse.chambre,
                    cuisine:this.newHouse.cuisine,
                    salon:this.newHouse.salon,
                    bain:this.newHouse.bain,
                    studio:this.newHouse.studio,
                    appartement:this.newHouse.appart,
                    banquet:this.newHouse.banquet,
                    Parent_id:this.newHouse.parent_id,
                    appart_meuble:this.meuble,
                    magasin:this.newHouse.magasin,
                    image:this.profil
                })
                    .then((response)=>{
                        if (response.data){
                            this.flashMessage.success({
                                title: 'Nouveau bien',
                                message: 'Enregistrement terminé',
                                time: 3000,
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
                        this.newHouse.description = '',this.newHouse.name = '', this.newHouse.typebien ='', this.newHouse.ville = '',
                        this.newHouse.region = "",this.newHouse.pays='',this.newHouse.address, this.newHouse.surface ='',this.newHouse.chambre = '',
                        this.newHouse.cuisine = '',this.newHouse.salon="",this.newHouse.bain='',this.newHouse.studio ='',
                        this.newHouse.appart = '',this.newHouse.banquet ='', this.newHouse.addresse='', this.newHouse.parent_id ='',
                    )
            }

        }
    }
</script>

<style scoped>

</style>
