<template>
    <div class="container-fluid">
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="card mb-3 col-md-12">

                    <div class="row no-gutters ">
                        <div class="col-md-4 border-right">
                            <img :src=" avatar(tenant.photo) " alt="" width="250">

                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <dl class="row pl-5 ">
                                    <dt class="col-sm-3 mt-3">Nom</dt>
                                    <dd class="col-sm-9 mt-3">{{tenant.nom}}</dd>

                                    <dt class="col-sm-3 mt-3">prenom</dt>
                                    <dd class="col-sm-9 mt-3">{{tenant.prenom}}</dd>


                                    <dt class="col-sm-3 mt-3">Email</dt>
                                    <dd class="col-sm-9 mt-3">{{tenant.email}}</dd>

                                    <dt class="col-sm-3 mt-3 text-truncate">Numero de CNI</dt>
                                    <dd class="col-sm-9 mt-3">{{tenant.cin}}</dd>

                                    <dt class="col-sm-3 mt-3 text-truncate">profession</dt>
                                    <dd class="col-sm-9 mt-3">{{tenant.profession}}</dd>

                                    <dt class="col-sm-3 mt-3 text-truncate">nationalité</dt>
                                    <dd class="col-sm-9 mt-3">{{tenant.nationalite}}</dd>

                                    <dt class="col-sm-3 mt-3 text-truncate">ville</dt>
                                    <dd class="col-sm-9 mt-3">{{tenant.ville}}</dd>

                                    <dt class="col-sm-3 mt-3">Telephone</dt>
                                    <dd class="col-sm-9 mt-3">
                                        <dl class="row">
                                            <dt class="col-sm-4">{{tenant.numero}}</dt>

                                        </dl>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-10">
                    <div class="card ">
                        <div class="card-header">
                            <router-link to="/tenants" class="btn bg-danger">retour</router-link>


                            <router-link to="/tenants" class="btn btn-warning ml-2"> Modifier</router-link>

                            <button @click="deletetenant(tenant.id)" class="btn btn-danger">suprimer</button>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "Showtenant",

        data(){
            return{
                tenant:{}
            }
        },


        created() {
            // console.log(this.$route.params.id)
            axios.get('api/tenants/'+ this.$route.params.id)
                .then((response)=>{
                    console.log(response.data)
                    this.tenant = response.data
                });
        },

        methods:{

            avatar(photo){
                // console.log(photo)
                return "image/" + photo
            },

            deletetenant(id){
                axios.delete('api/tenants/' + id)
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
