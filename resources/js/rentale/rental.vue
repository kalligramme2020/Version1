<template>
    <div id="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <FlashMessage class="flashmessage"></FlashMessage>

                        </div>
                    </div>
                </div>
            </div>


            <div class="row justify-content-center mt-5">
                <div class="col-md-11">
                    <div class="text-right mb-3">
                        <router-link to="/newrent" class="btn btn-outline-success text-success">Nouvel location </router-link>
                    </div>
                    <div class="card">
                        <div class="card-header"></div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead class=" text-center">
                                <tr>
                                    <th scope="col">identifiant</th>
                                    <th scope="col">bien</th>
                                    <th scope="col">locataire</th>
                                    <th scope="col">loyer</th>
                                    <th scope="col">duree</th>
                                    <th scope="col">actions</th>

                                </tr>
                                </thead>
                                <tbody v-for="location in locations" :key="location.id">
                                <tr>
                                    <td><router-link :to="{ name: 'showrent', params: { id: location.id }}" class="text-primary">{{location.identifiant}}</router-link></td>
                                    <td>
                                        <router-link :to="{ name: 'showtenant', params: { id: location.bien.id }}" >{{location.bien.name}}</router-link>
                                    </td>
                                    <td class="text-primary">
                                        <router-link :to="{ name: 'showtenant', params: { id: location.locataire.id }}" >{{location.locataire.nom}}</router-link>
                                    </td>
                                    <td>{{location.loyer_hc}}</td>
                                    <td>{{location.debut_bail}} - {{location.fin_bail}}</td>
                                    <th class="text-center">
                                        <div class="btn-group">
                                            <button class="btn btn-secondary btn-sm  " type="button" data-toggle="dropdown" aria-expanded="false">
                                                actions
                                            </button>
                                            <div class="dropdown-menu">

                                                <router-link :to="{ name: 'editrent', params: { id: location.id }}" class="dropdown-item"><i class="fas fa-edit fa-sm"> </i> modifier</router-link>


                                                <a href="#" class="dropdown-item"> <i class="fa fa-eur" aria-hidden="true"></i> finances</a>

                                                    <button @click="deleteRent(location.id)" class="dropdown-item"> <i class="fas fa-trash-alt fa-sm"></i> suprimer</button>

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
    import Swal from 'sweetalert2'

    export default {
        name: "rental",
        data(){
            return{
                locations:{},
            }
        },

        created() {
            axios.get('api/rentale')
            .then((response)=>{
                // console.log(response.data)
                this.locations = response.data
            })

        },

        methods:{
            deleteRent(id){
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
                        axios.delete('api/rentale/' + id)
                            .then((response) => {

                            })
                        Swal.fire(
                            'Supprimer',
                            'success'
                        )
                    }
                })
            },
        },

    }
</script>

<style scoped>

</style>
