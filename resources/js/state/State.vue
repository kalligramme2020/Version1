<template>
    <div class="container-fluid">

        <div class="row justify-content-center mt-5">
            <div class="col-md-10">
                <div class="text-right mb-3">
                    <FlashMessage class="flashmessage"></FlashMessage>
                    <router-link to="/new_state" class="btn btn-outline-primary">ajout d'image</router-link>
                </div>
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <caption>List of state</caption>
                            <thead>
                            <tr>
                                <th scope="col">location</th>
                                <th scope="col">Etats</th>
                                <th scope="col">descriptio</th>
                                <th scope="col">action</th>
                            </tr>
                            </thead>
                            <tbody v-for="(state,index) in getSate " :key="index">
                            <tr>
                                <th scope="row">{{state.location.identifiant}}</th>
                                <td> <img v-for=" (img, index) in state.photo " :src="img" width="100" height="100" class="ml-2">  </td>
                                <td>{{state.description}}</td>

                                <td>
                                    <i @click="deleteEtat(state.id)" class="fas fa-trash-alt fa-lg pointer-event" type="button"></i>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "State",

        data(){
            return{
                getSate:null,
            }
        },

        created(){
            axios.get('api/state')
                .then((response)=>{
                    console.log(response.data)
                    this.getSate = response.data
                    // console.log(this.getSate)
                })
        },

      methods:{
          deleteEtat(id){
          axios.delete('api/state/' + id)
              .then((response)=>{
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
