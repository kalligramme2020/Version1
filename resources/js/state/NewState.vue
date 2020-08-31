<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mt-5">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ex">Selectionner vos images</label>
                                    <input type="file" id="ex"  @change="GetImage"  multiple />

                                </div>

                                <div class="preview" style="display: inline-block">

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="inputState">location lier</label>
                                    <select id="inputState" class="form-control" v-model="location_lier.identifiant">
                                        <option selected>Choose...</option>
                                        <option v-for="rent in rental" :value="rent.id" :key="rent.id">{{rent.identifiant}}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="desc">description</label>
                                    <textarea v-model="location_lier.description" id="desc" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button @click="AddState" class="btn btn-outline-secondary">Ajouter</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'NewState',
        data () {
            return {
                location_lier:{
                    'identifiant':"",
                    'description':""
                },
                rental:{},

                profils:[],

            }
        },


        created(){
            axios.get(' api/state/create')
                .then((response)=>{
                    // console.log(response.data)
                    this.rental = response.data
                })
        },

        methods: {
            GetImage(e){
                var files = e.target.files ,
                    filesLength = files.length ;
                for (var i = 0; i < filesLength ; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    var that = this;
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        that.profils.push(file.result)
                        // console.log(file.result)
                        $("<img>",{
                            class : "imageThumb ml-4",
                            width : 100,
                            src : e.target.result,
                            title : file.name
                        }).insertAfter(".preview");
                    });
                    fileReader.readAsDataURL(f);
                }
                // console.log(this.profils)
            },

            AddState(){
                console.log(this.profils)
                axios.post('api/state', {
                    photos:this.profils,
                    location_lier:this.location_lier.identifiant,
                    description:this.location_lier.description,
                })
                    .then(response => {
                })
                .then(
                    this.location_lier.description="", this.location_lier.identifiant="",
                )
            }

        }


    }

</script>

<style>
    #my-strictly-unique-vue-upload-multiple-image {
        font-family: 'Avenir', Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: center;
        color: #2c3e50;
        margin-top: 60px;
    }

    h1, h2 {
        font-weight: normal;
    }

    ul {
        list-style-type: none;
        padding: 0;
    }

    li {
        display: inline-block;
        margin: 0 10px;
    }

    a {
        color: #42b983;
    }
</style>

