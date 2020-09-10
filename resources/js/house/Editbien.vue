<template>
    <div class="container-fluid">
        <div class = "page-header text-center">
            <h4> Modifier ce bien</h4>

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
                                    <select class="form-control" id="ty" v-model="tb.id" required>
                                        <option>{{tb.name}}</option>
                                        <option v-for="typebien in typeBiens" :key="typebien.id"  v-bind:value="typebien.id"  >{{typebien.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="non">Nom</label>
                                    <input type="text" class="form-control" id="non" v-model="edithouse.name" required>
                                </div>

                                <div class="form-group col-md-6 ml-2" >
                                    <label for="papa" class="text-success">bien parent</label>
                                    <select class="form-control" id="papa" v-model="edithouse.parent_id" >
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
                                    <input type="text" class="form-control" id="nom" v-model="edithouse.addresse">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pre">ville </label>
                                    <input type="text" class="form-control" id="pre" v-model="edithouse.ville">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pays">pays <i class="fa fa-flag-checkered" aria-hidden="true"></i></label>
                                    <select class="form-control" id="pays" v-model="city.id" >
                                        <option>{{city.pays}}</option>
                                        <option v-for="country in countries" v-bind:value="country.id" >{{ country.pays }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="region">region</label>
                                    <input type="text" class="form-control" id="region" v-model="edithouse.region">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="air">surface M²</label>
                                    <input type="number" class="form-control" id="air" v-model="edithouse.surface">
                                </div>
                                <div class="form-group col-md-8">
                                    <textarea class="form-control" placeholder="description" rows="3" v-model="edithouse.description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-header">photo</div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group  col-md-6">
                                    <label for="file">Photo</label>
                                    <!--<input type="file" class="form-control-file" id="file">-->
                                    <input type="file" class="form-control-file" id="file"  @change="GetImage" />
                                </div>
                                <div style="z-index:2000"> <FlashMessage></FlashMessage></div>

                                <div class="form-group col-md-6">
                                    <img :src="profil" alt="Image" width="150">
                                </div>
                            </div>
                        </div>
                        <div class="cache" >
                            <div class="card-header">cas himeuble</div>
                            <div class="card-body" v-if="TbienEdit === 1">
                                <div class="form-row" v-for="piece in pieces">
                                    <div class="form-group col-md-3">
                                        <label for="appt">Appartement</label>
                                        <input type="number" class="form-control" id="appt" v-model="piece.appartement">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="studio">studio</label>
                                        <input type="number" class="form-control" id="studio" v-model="piece.studio">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="prenon">appartement meuble</label>
                                        <input type="number" class="form-control" id="prenon" v-model="piece.appart_meuble">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="magasin">magasin</label>
                                        <input type="number" class="form-control" id="magasin" v-model="piece.magasin">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="salle">salle de banquet</label>
                                        <input type="number" class="form-control" id="salle" v-model="piece.banquet">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="piece">
                            <div class="card-header">pieces</div>
                            <div class="card-body" v-if="TbienEdit > 1 && TbienEdit !== null" v-for="piece in pieces">
                                <div class="form-row justify-content-around">
                                    <div class="form-group col-md-2">
                                        <label for="chambre">chambre</label>
                                        <input type="number" class="form-control hide" id="chambre" v-model="piece.chambre">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="salon">salon</label>
                                        <input type="number" class="form-control hide" id="salon" v-model="piece.salon">
                                    </div>
                                </div>
                                <div class="form-row justify-content-around ">
                                    <div class="form-group col-md-2">
                                        <label for="bain">sale de bain</label>
                                        <input type="number" class="form-control hide" id="bain" v-model="piece.bain">
                                    <input type="number" class="form-control hide" style="display: none" id="df" v-model="piece.id">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="cuisine"> cuisine</label>
                                        <input type="number" class="form-control hide" id="cuisine" v-model="piece.cuisine">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="mt-5">
                                <router-link to="/bien" class="btn bg-danger">retour</router-link>
                                <button class="btn btn-primary" @click="editbien()"> Appliquer</button>
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
        name: "Editbien",

        mounted() {

        },

        data(){
            return{
                edithouse:{
                    'description':"",'surface':"", 'region':"", 'bain':"",
                    'pays':"", 'ville':"",'addresse':"", 'name':"",'parent_id':"", 'id':''
                },
                bienParent:{},
                profil:null,
                 TbienEdit:'',
                editpays:'',
                countries:"", typeBiens:"", //get pays
                tb:{ 'name':"", 'id':"" },//tupe du bien
                city:{ 'pays':"", "id":''}, //ville du bien

                pieces:{
                    'banquet':"", 'appart':'',  'cuisine':"", 'bain':"",'salon':"",'chambre':"",
                   'studio':"",'meuble':"", 'magasin':"",'bienParent':"", 'id':""
                },//get edit pieces
            }
        },

        created() {
            // console.log(this.$route.params.id)
            axios.get('api/pays')
                .then((response )=> {
                    this.countries= response.data.land;
                    this.typeBiens= response.data.peol
                });

            axios.get('api/bien/'+ this.$route.params.id +'/edit' )
                .then((response)=>{
                    this.edithouse = response.data;
                    this.tb = response.data.tbien;
                    this.city = response.data.countrie;
                    this.pieces = response.data.pieces;
                    console.log(response.data)

                });

            axios.get('api/bien/create')
                .then((response)=>{
                    this.bienParent = response.data
                    // console.log(this.bienParent)
                })
        },

        methods:{

            avatar(photo){
                console.log(photo)
                return "image/" + photo
            },

            GetImage(e){
                // console.log(e.target.files)
                let image = e.target.files[0];
                let reader = new FileReader();
                reader.readAsDataURL(image);
                reader.onload = e => {
                    this.profil = e.target.result
                }
            },

            editbien(){
                axios.patch('api/bien/' + this.$route.params.id, {
                    parent_id:this.edithouse.parent_id,
                    typebien:this.tb.id,
                    name:this.edithouse.name,
                    ville:this.edithouse.ville,
                    pays:this.city.id,
                    region:this.edithouse.region,
                    surface:this.edithouse.surface,
                    addresse:this.edithouse.addresse,
                    description:this.edithouse.description,
                    chambre:this.pieces.chambre,
                    salon:this.pieces.salon,
                    cuisine:this.pieces.cuisine,
                    parking:this.pieces.parking,
                    bain:this.pieces.bain,
                    appart_meuble:this.pieces.appart_meuble,
                    studio:this.pieces.studio,
                    magasin:this.pieces.magasin,
                    appart:this.pieces.appart,
                    pieces_id:this.pieces.id,
                    image:this.profil

                })

                    .then((response)=>{
                        // console.log(response.data);
                        if (response.data){
                            this.flashMessage.success({
                                title: 'Modifier locataire',
                                message: 'Modification terminé',
                                time: 3050,
                                flashMessageStyle: {
                                    backgroundColor: 'linear-gradient(#e66465, #9198e5)',

                                }
                            });
                        } else {
                            this.flashMessage.error({title: 'Error Message Title', message: 'xxxxxxxxxx'});
                        }
                    })
                    .then(
                        this.edithouse.parent_id='', this.TbienEdit='', this.edithouse.name='',this.edithouse.ville='',this.editpays='',this.edithouse.region='',
                        this.edithouse.surface='',this.edithouse.addresse='', this.edithouse.description='',this.pieces.chambre='',this.pieces.salon='',this.pieces.salon='',
                        this.pieces.bain='',this.pieces.parking='',this.pieces.bain='',this.pieces.appart_meuble='',this.pieces.studio='',this.pieces.magasin='',this.pieces.appart='',
                        this.profil=""
                    )



            }
        }

    }
</script>

<style scoped>

</style>
