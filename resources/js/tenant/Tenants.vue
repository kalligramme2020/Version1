<template>
    <div id="content">

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-right ">

                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="row justify-content-center mt-5">
                <div class="col-md-11">
                    <div class="text-right mb-3">
                        <div class="row">
                            <div class="col-6  ">
                                <div class="input-group col-md-6 mb-3">
                                    <input type="text" class="form-control" v-model="keyword" placeholder="Recherche">

                                </div>
                            </div>
                            <div class="col-6 text-right">
                                <router-link to="/new-tenant" class="btn btn-outline-success text-success">Nouveau locataire</router-link>
                            </div>
                        </div>

                        <FlashMessage class="flashmessage"></FlashMessage>

                    </div>
                    <div class="card">
                        <div class="card text-center" v-if="loading">
                            <h1><span class="fas fa-spinner fa-pulse"></span></h1>
                        </div>
                        <div class="card-body" v-else>
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th><input type="checkbox" onclick="checkAll(this)"></th>
                                    <th>Profil</th>
                                    <th>Locataire</th>
                                    <th>email</th>
                                    <th>Numero</th>
                                    <th>Cni</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody v-for=" tenant in tenants" :key="tenant.id">
                                <tr>
                                    <td><input type="checkbox" name=""></td>
                                    <td>
                                        <img :src="tenant.photo " alt="" class="avatar">
                                    </td>
                                    <td>
                                        <router-link :to="{ name: 'showtenant', params: { id: tenant.id }}" class="text-primary">{{tenant.nom}} <span class="bien_local">{{tenant.prenom}}</span></router-link>
                                    </td>
                                    <td>{{tenant.email}}</td>
                                    <td>{{tenant.numero}}</td>
                                    <td>{{tenant.cni}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-secondary btn-sm " type="button" data-toggle="dropdown" aria-expanded="false">actions </button>
                                            <div class="dropdown-menu">
                                                <router-link :to="{ name: 'edit', params: { id: tenant.id }}" class="dropdown-item"><i class="fas fa-edit fa-sm"> </i> modifier</router-link>

                                                <button @click="deleteTenant(tenant.id)" class="dropdown-item"> <i class="fas fa-trash-alt fa-sm"></i> suprimer</button>
                                                <vue-confirm-dialog></vue-confirm-dialog>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Autres</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <pagination :data="metaTenant" @pagination-change-page="getResultsPaginate" class="mt-3"></pagination>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import Swal from 'sweetalert2'
    export default {
        name: "Tenants",

        data(){
            return{
                loading: true,
                metaTenant: [],
                keyword: null,
            }
        },

        mounted(){
            Echo.channel('Tenant')
                .listen('.App\\Events\\DeleteEvent', (e) => {
                    console.log(e);
                    this.tenants.splice(this.tenants.indexOf(e.delete), 1);
                });
        },

        created(){
            axios.get('api/tenants')
                .then((response)=>{
                    console.log(response.data);
                    this.metaTenant = response.data;
                    this.loading = false;
                })
        },

        methods:{
            deleteTenant(id){
                Swal.fire({
                    text: "Etes-vous de cette action !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Abandonner',
                    confirmButtonText: 'Oui, supprimer!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('api/tenants/' + id)
                            .then((response) => {
                                if (response.data === 200)
                                {
                                    Swal.fire(
                                        'Supprimer',
                                        'success'
                                    )
                                }
                                else
                                {
                                    this.flashMessage.error({
                                        title: 'oups',
                                        message: 'Vous ne pouver supprimer ce locataire car il fait l\'objet d\'une location en cour vous devrez d\'abord la supprimer'});
                                }

                            });

                    }
                })

            },


            // Our method to GET results from a Laravel endpoint
            getResultsPaginate(page = 1) {
                axios.get('api/tenants?page=' + page)
                    .then(response => {
                        this.metaTenant = response.data;
                    });
            },

        },

        computed: {
            tenants(){
                if (this.keyword !== null)
                    return this.metaTenant.data.filter(({nom, prenom}) => {
                        return nom.toLowerCase().includes(this.keyword.toLowerCase())
                            || prenom.toLowerCase().includes(this.keyword.toLowerCase())
                    });
                else {
                    return this.metaTenant.data
                }

            }
        }
    }
</script>

<style scoped>
.bien_local{
    font-size:11px;
}
</style>

