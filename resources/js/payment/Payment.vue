import Swal from "sweetalert2";
<template>
    <div id="content">
        <router-view></router-view>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            This is some text within a card body.
                            <FlashMessage></FlashMessage>
                            <div class="float-right ">
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Nouvel transaction <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        <router-link to="/newpayment" class="dropdown-item text-primary"><i class="fa fa-eur" aria-hidden="true"></i> ajouter un revenue</router-link>
                                        <button class="dropdown-item" type="button">Another action</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="z-index: 1000"> </div>


                    </div>
                </div>
            </div>


            <div class="row justify-content-center mt-5">
                <div class="col-md-11">
                    <div class="card">
                        <div class="card-header"></div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead class=" text-center">
                                <tr>
                                    <th scope="col">location</th>
                                    <th scope="col">avance cfa</th>
                                    <th scope="col">reste cfa</th>
                                    <th scope="col">total cfa</th>
                                    <th scope="col">fait le</th>
                                    <th scope="col">actions</th>

                                </tr>
                                </thead>
                                <tbody v-for="inv in invoice">
                                <tr>
                                    <td>
                                        <router-link :to="{ name: 'show_payment', params: { id: inv.id }}" class="text-primary">{{inv.location.identifiant}}</router-link>
                                    </td>

                                    <td>{{inv.avance}}</td>
                                    <td>{{inv.reste}}</td>
                                    <td>{{inv.total}}</td>
                                    <td>{{inv.fait_le}}</td>
                                    <th class="text-center">
                                        <div class="btn-group">
                                            <button class="btn btn-secondary btn-sm " type="button" data-toggle="dropdown" aria-expanded="false">
                                                actions
                                            </button>
                                            <div class="dropdown-menu">
                                                <router-link :to="{ name: 'edit_payment', params: { id: inv.id }}" class="dropdown-item"><i class="fas fa-edit fa-sm"> </i> modifier</router-link>

                                                <router-link to="/newpayment" class="dropdown-item"> <i class="fa fa-eur" aria-hidden="true"></i> ajout finances</router-link>
                                                    <button @click="deleteInvoice(inv.id)" class="dropdown-item"> <i class="fas fa-trash-alt fa-sm"></i> suprimer</button>
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
        name: "Payment",

        data(){
            return  {
                invoice:{},
            }
        },
        created(){
            axios.get('api/payment')
                .then((response)=>{
                    console.log(response.data)
                    this.invoice = response.data
                })
        },

        methods:{
            deleteInvoice(id){
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
                        axios.delete('api/payment/' + id)
                            .then((response) => {

                            })
                        Swal.fire(
                            'Supprimer',
                            'success'
                        )
                    }
                })
            },
        }
    }
</script>

<style scoped>

</style>
