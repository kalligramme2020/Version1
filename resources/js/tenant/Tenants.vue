<template>
    <div id="content">

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-right ">
                                <a href="" class="btn btn-outline-secondary">mlkmfkhmfm</a>

                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="row justify-content-center mt-5">
                <div class="col-md-11">
                    <div class="text-right mb-3">
                        <router-link to="/new-tenant" class="btn btn-outline-success text-success">Nouveau locataire</router-link>
                        <FlashMessage class="flashmessage"></FlashMessage>

                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead class=" text-center">
                                <tr>
                                    <th scope="col">photo</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Telephone</th>
                                    <th scope="col"> action </th>
                                </tr>
                                </thead>

                                <tbody v-for=" tenant in Tenants" v-bind:key="Tenants.id">
                                <tr>
                                    <td>
<!--                                        <img :src=" 'image/+tenant.photo ' " alt="" width="50">-->
                                        <img :src=" avatar(tenant.photo) " alt="" width="50">
                                    </td>
                                    <td>
                                        <router-link :to="{ name: 'showtenant', params: { id: tenant.id }}" class="text-primary">{{tenant.nom}} {{tenant.prenom}}</router-link>
                                    </td>
                                    <td>{{tenant.email}}</td>
                                    <td>{{tenant.numero}}</td>
                                    <th class="text-center">
                                        <div class="btn-group">
                                            <button class="btn btn-secondary btn-sm " type="button" data-toggle="dropdown" aria-expanded="false">
                                                actions
                                            </button>
                                            <div class="dropdown-menu">
                                                <router-link :to="{ name: 'edit', params: { id: tenant.id }}" class="dropdown-item"><i class="fas fa-edit fa-sm"> </i> modifier</router-link>

                                                <button @click="deleteTenant(tenant.id)" class="dropdown-item"> <i class="fas fa-trash-alt fa-sm"></i> suprimer</button>
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
        name: "Tenants",

        data(){
            return{
                Tenants:"",



            }
        },

        created(){
            axios.get('api/tenants')
                .then((response)=>{
                    // console.log(response.data)
                    this.Tenants = response.data
            })
        },

        methods:{

            avatar(photo){
                // console.log(photo)
                return "image/" + photo
            },

            deleteTenant(id){
                axios.delete('api/tenants/' + id)
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
        },
    }
</script>

<style scoped>

</style>
