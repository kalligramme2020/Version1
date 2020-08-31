<template>
    <div id="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-right ">
                            </div>
                        </div>
                    </div>
                </div>
                <div style="z-index: 1000"> <FlashMessage></FlashMessage></div>

            </div>


            <div class="row justify-content-center mt-5">
                <div class="col-md-11">
                    <div class="text-right mb-3">
                        <router-link to="/newBien" class="btn btn-outline-success text-success">Nouveau bien</router-link>
                    </div>
                    <div class="card">
                        <div class="card-body">

                            <table class="table table-bordered">
                                <thead class=" text-center">
                                <tr>
                                    <th scope="col">photo</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Adresse</th>
                                    <th scope="col">ville</th>
                                    <th scope="col"> action </th>
                                </tr>
                                </thead>

                                <tbody v-for=" bien in Biens" v-bind:key="bien.id">
                                <tr>

                                    <td>
                                        <img :src=" avatar(bien.photo) " alt="" width="50">

                                    </td>
                                    <td>
                                        <router-link :to="{ name: 'showbien', params: { id: bien.id }}" class="text-primary">{{bien.name}}</router-link>
                                    </td>
                                    <td>{{bien.addresse}}</td>
                                    <td>{{bien.ville}}</td>
                                    <th class="text-center">
                                        <div class="btn-group">
                                            <button class="btn btn-secondary btn-sm " type="button" data-toggle="dropdown" aria-expanded="false">
                                                actions
                                            </button>
                                            <div class="dropdown-menu">
<!--                                                <a href="#" class="dropdown-item"><i class="fas fa-edit fa-sm"> </i> modifier</a>-->
                                                <router-link :to="{ name: 'editbien', params: { id: bien.id }}" class="dropdown-item"><i class="fas fa-edit fa-sm"> </i> modifier</router-link>

                                                <button @click="deleteBien(bien.id)" class="dropdown-item"> <i class="fas fa-trash-alt fa-sm"></i> suprimer</button>

                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Autres</a>
                                            </div>
                                        </div>
                                    </th>
                                </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "Bien.vue",

        data(){
            return{
                Biens:""
            }
        },


        created(){
            axios.get('api/bien')
                .then((response)=>{
                    // console.log(response.data)
                    this.Biens = response.data
                })
        },

        methods:{

            avatar(photo){
                // console.log(photo)
                return "image/" + photo
            },

            deleteBien(id){
                axios.delete('api/bien/' + id)
                    .then((response)=>{
                        // console.log(response.data)

                        if (response.data){
                            this.flashMessage.success({
                                title: 'Supprimer',
                                message: 'Action reussit',
                                time: 3000,
                                flashMessageStyle: {
                                    backgroundColor: 'linear-gradient(#e66465, #9198e5)'
                                }
                            });
                        } else {
                            this.flashMessage.error({title: 'Error Message Title', message: 'xxxxxxxxxx'});
                        }
                    })
            },
        },
    }
</script>

<style scoped>

</style>
