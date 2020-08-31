<template>
    <div class="container-fluid">
        <div class = "page-header text-center">
            <h4> Modifier locataire</h4>
        </div>
        <div class="dropdown-divider">

        </div>


        <div class="row justify-content-center">
            <div style="z-index: 1000"> <FlashMessage></FlashMessage></div>
            <div class="col-md-8">
                <div class="card mb-5">
                    <div class="card-header">Informations generales</div>

                    <div class="card-body">

                        <form enctype="multipart/form-data">

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nom">Noms</label>
                                    <input type="text" class="form-control" id="nom"  v-model="Edittenant.nom" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="prenom">Prenom</label>
                                    <input type="text" class="form-control" id="prenom" v-model="Edittenant.prenom">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="Email4">Email</label>
                                    <input type="email" class="form-control" id="Email4" v-model="Edittenant.email"  required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone">Numero de telephone</label>
                                    <input type="number" class="form-control" id="phone" v-model="Edittenant.numero">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="pays">nationalité</label>
                                    <input type="text" class="form-control" id="pays" v-model="Edittenant.nationalite" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cni">Numero CNI</label>
                                    <input type="number" class="form-control" id="cni"  v-model="Edittenant.cni"  required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="City">Profession</label>
                                    <input type="text" class="form-control" id="City" v-model="Edittenant.profession">
                                </div>
                            </div>

                            <div class="form-row justify-content-between" >
                                <div class="form-group  col-md-6">
                                    <label for="file">Photo</label>
                                    <input type="file" id="file"  @change="GetImage" />
                                </div>

                                <div class="form-group col-md-6 text-center" >
                                    <img :src="profil" alt="Image" width="150">
                                    <img :src=" avatar(Edittenant.photo) " alt="" width="150">
                                </div>
                            </div>

                            <div class="mt-5">
                                <router-link to="/tenants" class="btn bg-danger">retour</router-link>
                                <button class="btn btn-primary ml-4" @click="editTenant()">Appliquer</button>
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
        name: "Editenant",

        mounted() {

        },

        data(){
            return{
                profil: null, //GET editt IMG profil
                Edittenant: { 'nom':"",
                    'email':"",
                    'numero':"",
                    'nationalite':"",
                    'profession':"",
                    'prenom':"",
                    'cni':""
                },
            }
        },

        created(){
            axios.get('api/tenants/'+ this.$route.params.id +'/edit' )
                .then((response)=>{
                    this.Edittenant = response.data
                    // console.log(this.Edittenant)
                })
        },

        methods:{

            avatar(photo){
                console.log(photo)
                return "image/" + photo
            },

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

            editTenant(){
                axios.patch('api/tenants/' + this.Edittenant.id, {
                    nom:this.Edittenant.nom,
                    prenom:this.Edittenant.prenom,
                    email:this.Edittenant.email,
                    phone:this.Edittenant.numero,
                    pays:this.Edittenant.notionalite,
                    cni:this.Edittenant.cni,
                    proff:this.Edittenant.profession,
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
                                    position:top
                                }
                            });
                        } else {
                            this.flashMessage.error({title: 'Error Message Title', message: 'xxxxxxxxxx'});
                        }
                    })
                    .then(
                        this.Edittenant.nom='', this.Edittenant.prenom="", this.Edittenant.email='', this.Edittenant.numero ='',
                        this.Edittenant.notionalite = '', this.Edittenant.cni ='', this.Edittenant.profession= '',this.profil=""

                    )

            }
        }

    }
</script>

<style scoped>

</style>
