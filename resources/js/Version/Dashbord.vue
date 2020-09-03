<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">


                        <input type="number" v-model="date1">
                        <input type="number" v-model="date2">
                        <h4 class="text-danger">{{title}}</h4>


<!--                        <div class="jumbotron jumbotron-fluid">-->
<!--                        <div class="container">-->
<!--                            <h1 class="display-4">Dashboaphprd</h1-->
<!--                        </div>-->
<!--                    </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Dashbord",
        data(){
            return{
                date2:'', date1:''
            }
        },

        computed:{
            title(){
                return this.date1 + this.date2
            }
        }
    }
</script>

<style scoped>

</style>
