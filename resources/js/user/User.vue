<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="row">
                        <FlashMessage class="flashmessage"></FlashMessage>

                        <div class=" card-body col-8">

                            <div class="card-block user-details p-1" v-show="profile">
                                <h3 class="card-title">Informations personnelles</h3>
                                <div class="dropdown-divider"></div>

                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5 text-left"><i class="fas fa-user"></i>Nom et prenoms</div>
                                            <div class="col-md-5 text-right">{{User.name}}  {{User.prenom}}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5 text-left"><i class="fas fa-envelope"></i> Email</div>
                                            <div class="col-md-5 text-right">{{User.email}}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5 text-left"> <i class="fas fa-phone"></i> Telephone</div>
                                            <div class="col-md-5 text-right">{{User.numero}}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5 text-left"><i class="fas fa-flag"></i> Pays</div>
                                            <div class="col-md-5 text-right">{{User.pays}}</div>
                                        </div>
                                    </li>

                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5 text-left"><i class="fas fa-flag"></i> CNI</div>
                                            <div class="col-md-5 text-right">{{User.cni}}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5 text-left"><i class="fas fa-calendar-alt"></i> Creer le:</div>
                                            <div class="col-md-5 text-right">{{User.created_at}}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-4 text-left"><i class="fas fa-transgender"></i> Genre</div>
                                            <div class="col-md-6 text-right">masculin</div>
                                        </div>
                                    </li>

                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-4 text-left">photo</div>
                                            <div class="col-md-6 text-right"><img :src="avatar(User.profil) " alt="" width="50"></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="card-block user-modifir p-3 mt-3" v-show="Modifier">
                                <h3 class="card-title">Modifier Mon Compte</h3>
                                <div class="dropdown-divider"></div>
                                <form>
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-10">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="nom">Nom</label>
                                                <div class="col-sm-9">
                                                    <input type="text" id="nom" class="form-control" v-model="User.name"/>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="prenom">Prenom</label>
                                                <div class="col-sm-9">
                                                    <input type="text" id="prenom" class="form-control" v-model="User.prenom"/>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="email">email</label>
                                                <div class="col-sm-9">
                                                    <input type="email" id="email" class="form-control" v-model="User.email"/>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="phone">numero</label>
                                                <div class="col-sm-9">
                                                    <input type="number" id="phone" class="form-control" v-model="User.numero"/>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="phone">Cni</label>
                                                <div class="col-sm-9">
                                                    <input type="number" id="cni" class="form-control" v-model="User.cni"/>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="pays">pays</label>
                                                <div class="col-sm-9">
                                                    <input type="text" id="pays" class="form-control" v-model="User.pays"/>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="ville">ville</label>
                                                <div class="col-sm-9">
                                                    <input type="text" id="ville" class="form-control" v-model="User.ville"/>
                                                </div>
                                            </div>


                                            <div class="form-row justify-content-between" >
                                                <div class="form-group  col-md-6">
                                                    <label for="file">Photo</label>
                                                    <input type="file" id="file"  @change="GetImage" />
                                                </div>

                                                <div class="form-group col-md-6 text-center" >
                                                    <img :src="home" alt="Image" width="150">
                                                </div>
                                            </div>

                                            <div class="dropdown-divider"></div>

                                            <div>
                                                <button @click="BackProfil" class="btn btn-outline-danger mr-4" > <i class="fas fa-arrow-left"></i>Annuler</button>
                                                <button @click="EditProfil" class="btn btn-outline-primary"><i class="fas fa-check"></i> Confirmer</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="card-block user-passw p-3 mt-3" v-show="mots_passe">
                                <h3 class="card-title">Changer le mots de passe </h3>
                                <div class="dropdown-divider"></div>
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <div class="col-sm-9">
                                                    <input type="password" placeholder="mots de passe actuel" v-model="User.actulpass"  class="form-control"/>
                                                </div>
                                                <div class="col-sm-9 mt-3">
                                                    <input type="password" placeholder="nouveau mots de passe" v-model="User.newpass"  class="form-control"/>
                                                </div>
                                                <div class="col-sm-9 mt-3">
                                                    <input type="password" placeholder="Confirmer" v-model="User.confirm" class="form-control"/>
                                                </div>
                                                <div class="dropdown-divider"></div>

                                                <div class="mt-4 text-center">
                                                    <button @click="ChangePassword" class="btn btn-outline-primary">Appliquer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>

                        </div>

                        <div class=" card-body border-left col-3">
                            <div class="mb-4">
                                <button @click="BackProfil" class="btn btn-outline-danger mr-4" > <i class="fas fa-arrow-left"></i>Annuler</button>

                            </div>

                            <div>
                                <button  @click="EditBlock" class=" btn btn-outline-secondary">Modifier mon Profil</button>
                            </div>

                            <div class="mt-3">
                                <button @click="showpass"  class=" btn btn-outline-success">Changer le mots de passe</button>
                            </div>
                            <div class="mt-3">
                                <button @click="DeleteAccount(User.id)"  class=" btn btn-outline-danger">Supprimer mon compte</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "User",
        data(){
            return{
                profile:true, Modifier:false, mots_passe:false,
                home:null,
                User:{
                    "name":'', "prenom":'',"email":'',"numero":'', "cni":'', "pays":'',"ville":'', "newpass":'', "actulpass":'' , "confirm":''
                }
            }
        },

        created() {
            axios.get('/api/user')
                .then(response => {
                    console.log(response.data);
                    this.User = response.data
                });
        },

        methods:{
            EditBlock(){
                this.profile = false
                this.mots_passe = false
                this.Modifier = true

            },

            BackProfil(){
                this.profile = true
                this.Modifier = false
                this.mots_passe = false
            },
            showpass(){
                this.profile = false
                this.Modifier = false
                this.mots_passe = true
            },

            EditProfil(){
                axios.patch('/api/profil/' + this.User.id,{
                    name:this.User.name,
                    prenom:this.User.prenom,
                    email:this.User.email,
                    cni:this.User.cni,
                    phone:this.User.numero,
                    profil:this.User.image,
                    ville:this.User.ville,
                    pays:this.User.pays,
                    file:this.home
                })
                .then(response => {
                    console.log(response.data)
                })
                .then(
                    this.User.name="",this.User.prenom="",this.User.email="",this.User.pays="",this.User.ville="",this.User.cni="",this.home="",this.User.numero=''
                )
            },

            EditPasseWord(){

            },

            GetImage(e){
                // console.log(e.target.files)
                let image = e.target.files[0];
                let reader = new FileReader();
                reader.readAsDataURL(image);
                reader.onload = e => {
                    // console.log(e)
                    this.home = e.target.result
                    console.log(this.profil)
                }
            },

            avatar(profil){
                // console.log(photo)
                return "image/" + profil
            },

            ChangePassword(){
                axios.post('/api/password',{
                    new:this.User.newpass,
                    current:this.User.actulpass,
                    confirm:this.User.confirm
                })
                .then(response=>{
                    console.log(response.data)
                })
                .then(
                    this.User.confirm="",
                    this.User.actulpass="", this.User.newpass=""
                )

            },

            DeleteAccount(id){
                axios.delete('api/password/' + id)
                    .then((response)=>{
                        this.tenants = response.data
                        if (response.data){
                            this.flashMessage.success({
                                title: 'Supprimer',
                                message: 'Action reussit',
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
            },

        }

    }
</script>

<style scoped>

</style>
