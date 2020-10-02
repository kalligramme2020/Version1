<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">


                    <div class="row justify-content-center">

                        <div class="col-9 mt-5 mb-4">
                            <div class="container">
                            <h2>Selectionner</h2>

                                    <div class="form-group">
                                        <label for="files">Selectionner</label>
                                        <input type="file" class="form-control-file" id="files" ref="files" multiple v-on:change="handleFileUploads()" />
                                    </div>

                                    <div class="form-group col-md-6">
                                          <label for="inputState">Location lier</label>
                                        <select id="inputState" class="form-control" v-model="state.location">
                                          <option selected>Choose...</option>
                                            <option v-for="rent in rental" :value="rent.id" :key="rent.id">{{rent.identifiant}}</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                         <label for="Textarea1">Description</label>
                                         <textarea class="form-control" id="Textarea1" rows="3" v-model="state.description"></textarea>
                                    </div>


                                <button class="btn btn-outline-secondary" v-on:click="submitFiles()">Appliquer</button>
                            </div>
                        </div>


                         <div class="col-3 border-left ">
                            <div class=" text-center mt-2 ml-2">
                             <router-link to="/state" type="button" class="btn btn-danger btn-sm">Retour</router-link>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                rental:null,
                state:{ 'location':'', 'description':'' },

                files:"",

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

            handleFileUploads(){
                this.files = this.$refs.files.files;
                console.log(this.files)
            },

            submitFiles(){
                let formData = new FormData();
                formData.append('description', this.state.description);
                formData.append('location_lier', this.state.location);

                for( var i = 0; i < this.files.length; i++ ){
                    let file = this.files[i];
                    formData.append('files[' + i + ']', file);
                }

               axios.post( '/api/state',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                    ).then(function(){
                    console.log('SUCCESS!!');
                    })
                    .catch(function(){
                    console.log('FAILURE!!');
                     })
                     .then(
                         this.state.description="", this.state.location=''
                     )
            }
        }


    }

    $(document).ready(function() {
        if (window.File && window.FileList && window.FileReader) {
            $("#files").on("change", function(e) {
                var files = e.target.files,
                    filesLength = files.length;
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i];
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $("<span class=\"pip\">" +
                            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                            "<br/><span class=\"remove\">Annuler</span>" +
                            "</span>").insertAfter("#files");
                        $(".remove").click(function(){
                            $(this).parent(".pip").remove();
                        });
                    });
                    fileReader.readAsDataURL(f);
                }
            });
        }
        else {
            alert("Your browser doesn't support to File API")
        }
    });

</script>

 <style>
    input[type="file"] {
        display: block;
    }
    .imageThumb {
        max-height: 75px;
        border: 2px solid;
        padding: 1px;
        cursor: pointer;
    }
    .pip {
        display: inline-block;
        margin: 10px 10px 0 0;
    }
    .remove {
        display: block;
        background: #444;
        border: 1px solid black;
        color: white;
        text-align: center;
        cursor: pointer;
    }
    .remove:hover {
        background: white;
        color: black;
    }
</style>

