<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="container px-lg-5">
                        <div class="row mx-lg-n5">
                            <div class="col py-3 px-lg-5 border bg-light">
                                <div class="form-control">
                                    <input class="hidden" @change="imageChange" type="file" name="images " ref="files" multiple />
                                </div>

                                <div class="m-auto">
                                    <p v-for="(image, index) in image" :key="index" >
                                        {{image.name}}
                                    </p>
                                </div>

                            </div>


                            <div class="col py-3 px-lg-5 border bg-light">

                                <div class="form-group">
                                    <textarea name="body" class="form-control" v-model="state.description" rows="4" placeholder="description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="ex">location lier</label>
                                    <select class="form-control" id="ex" v-model="state.location" >
                                        <option>1</option>
                                        <option v-for=" (rent ,index) in rental " :key="index" :value="rent.id" >{{rent.identifiant}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="btn btn-outline-danger" @click="AddImages">enregistrer</button>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                image:[], rental:null, state:{ 'location':'', 'description':'' }
            }
        },

        created(){
            axios.get(' api/state/create')
                .then((response)=>{
                    console.log(response.data);
                    this.rental = response.data;
                })
        },
        methods:{
            imageChange(){
                for( let i = 0; i < this.$refs.files.files.length; i++){
                    this.image.push(this.$refs.files.files[i]);
                    // console.log(this.image);
                }
            },

            AddImages(){
                var self = this;
                let formData = new FormData();

                for( let i = 0; i < this.image.length; i++){
                    let file = self.image[i];
                    formData.append('file['+ i + ']', file);

                }

                const config = {
                    headers:{"content-type" : "multipart/form-data"}
                };

                axios.post('/api/state', formData)
                    .then(response => {
                        self.$refs.files.value = "";
                        self.image = [];
                        this.state.location="";
                        this.state.description=""
                    })
                    .catch(error => {
                        console.log(error);
                    })

            }
        },
    }

</script>

<style>

</style>

