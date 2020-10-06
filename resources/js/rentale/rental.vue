<template>
    <div id="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <FlashMessage class="flashmessage"></FlashMessage>
                            <div class="card text-center" v-if="loading">
                                <h1><span class="fas fa-spinner fa-pulse"></span></h1>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="row justify-content-center mt-5">
                <div class="col-md-11">

                    <div class="row">
                        <div class="col-6  ">

                            <div class="input-group col-md-6 mb-3">
                                <input type="text" class="form-control" v-model="keyword" placeholder="Recherche">
                            </div>
                        </div>
                        <div class="col-6 text-right">
                            <router-link to="/newrent" class="btn btn-outline-success text-success">Nouvel location </router-link>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header"></div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead class=" text-center">
                                <tr>
                                    <th scope="col">Bien</th>
                                    <th scope="col">locataire</th>
                                    <th scope="col">loyer</th>
                                    <th scope="col">dureé</th>
                                    <th scope="col">Etat</th>
                                    <th scope="col">actions</th>

                                </tr>
                                </thead>
                                <tbody v-for="location in locations" :key="location.id">
                                <tr>
                                    <td>
                                        <router-link :to="{ name: 'showrent', params: { id: location.id }}" class="text-primary">{{location.identifiant}}</router-link>
                                        <router-link :to="{ name: 'showbien', params: { id: location.bien_id }}"  class="bien_local">{{location.bien.name}}</router-link>
                                        <br>
                                        <span class="bien_local" >{{location.type_bail}}</span>
                                        <i class="fas fa-map-marker-alt fa-sm"></i> <span class="bien_local" >{{location.bien.addresse}}</span>
                                    </td>
                                    <td class="text-primary">
                                        <router-link :to="{ name: 'showtenant', params: { id: location.locataire.id }}" >{{location.locataire.nom}}</router-link>
                                    </td>
                                    <td>{{location.loyer_hc}}</td>
                                    <td>{{location.debut_bail}} - {{location.fin_bail}}</td>

                                    <td><span class="badge badge-success">{{location.statut}}</span></td>

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

                            <pagination :data="metalocations" @pagination-change-page="getResultsPaginate" class="mt-3"></pagination>

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
                metalocations:{},
                loading:true,
                keyword:null,
                currentDate:null,
            }
        },

        mounted(){
            this.currentDate = moment().format("YYYY-MM-DD")

            Echo.channel('Tenant')
                .listen('.App\\Events\\DeleteEvent', (e) => {
                    // console.log(e);
                    this.locations.splice(this.locations.indexOf(e.delete), 1);

                });

        },

        created() {
            axios.get('api/rentale')
            .then((response)=>{
                console.log(response.data);
                this.metalocations = response.data;
               this.loading = false
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
                                if (response.data)
                                    Swal.fire(
                                        'Supprimer',
                                        'success'
                                    )
                            })

                    }
                })
            },

            // Our method to GET results from a Laravel endpoint
            getResultsPaginate(page = 1) {
                axios.get('api/rentale?page=' + page)
                    .then(response => {
                        this.metalocations = response.data;
                    });
            },
        },

        computed: {
            locations(){
                if (this.keyword)
                    return this.metalocations.data.filter(({identifiant}) => {
                        return identifiant.toLowerCase().includes(this.keyword.toLowerCase())
                            // || prenom.toLowerCase().includes(this.keyword.toLowerCase())
                    });
                else
                    return this.metalocations.data;
            }
        }

    }
</script>

<style scoped>
.bien_local{
    font-size:10px;
}
</style>
