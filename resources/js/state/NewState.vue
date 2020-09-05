<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="container px-lg-5">
                        <div class="row mx-lg-n5">
                            <div class="col py-3 px-lg-5 border bg-light">
                                <div class="form-control">
<!--                                    <input class="hidden" @change="imageChange" type="file" name="images " ref="files" multiple />-->
                                    <input type="file" id="file"  @change="GetImage" multiple/>



                                </div>

                                <div class="m-auto preview">
<!--                                    <p v-for="(image, index) in image" :key="index" >-->
<!--                                        {{image.name}}-->
<!--                                    </p>-->
                                </div>

                            </div>


                            <div class="col py-3 px-lg-5 border bg-light">

                                <div class="form-group">
                                    <textarea name="body" class="form-control" v-model="state.description" rows="4" placeholder="description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="ex">location lier</label>
                                    <select class="form-control" id="ex" v-model="state.location" >
                                        <option></option>
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
                    // console.log(response.data);
                    this.rental = response.data;
                })
        },
        methods:{
            GetImage(e){
                var files = e.target.files ,
                    filesLength = files.length ;
                for (var i = 0; i < filesLength ; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        console.log(file.result)

                        $("<img>",{
                            class : "imageThumb ml-4",
                            width : 100,
                            src : e.target.result,
                            title : file.name
                        }).insertAfter(".preview");
                    });
                    fileReader.readAsDataURL(f);
                }
            },


            AddImages(){
                console.log(this.image)

                axios.post('/api/state',{
                    papa:this.image
                })
                    .then(response => {
                        this.state.location="";
                        this.state.description=""
                    })
                    .catch(error => {
                        console.log(error);
                    })

            }

        }
    }



</script>

<style>

</style>

