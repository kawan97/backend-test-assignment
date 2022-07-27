<template>
    <div class="row">
        <h2 class="text-center">Edit and Delete Resources </h2>
        <center v-if="loading">
            <div class="spinner-border text-danger" >
                <span class="sr-only"></span>
            </div>
        </center>
        <div v-else>
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Type</th>
                    <th scope="col">Title</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="resource in resources.data" v-bind:key="resource.id">
                    <th scope="row">{{resource.id}}</th>
                    <th >{{resource.type}}</th>
                    <td v-if="resource.link">{{resource.link.title}}</td>
                    <td v-if="resource.snippet">{{resource.snippet.title}}</td>
                    <td v-if="resource.file">{{resource.file.title}}</td>
                    <td><button class="btn btn-warning" @click="editHundlerResource(resource.id)">Edit</button></td>
                    <td><button class="btn btn-danger" @click="deleteResource(resource.id)">Delete</button></td>
                    </tr>
                </tbody>
            </table>
        </div>

<!-- models -->
<!-- model for file -->
<div class="modal fade show" :style="{ 'display': filemodelshow ? 'block' : 'none' }" id="fileModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit File</h5>
        <button type="button" class="btn-close" @click='closeModel'></button>
      </div>
      <div class="modal-body">

        <form class="col-12" @submit.prevent="onSubmit">
            <div class="mb-3">
                <label for="resourcesTitle" class="form-label">Resources Title</label>
                <input type="text" class="form-control"  name="resourcesTitle" id="resourcesTitle">
            </div>
            <div class="mb-3">
                <label for="resourcesFile" class="form-label">Upload PDF File</label>
                <input class="form-control" type="file" id="resourcesFile" name="resourcesFile" accept="application/pdf">
                <div class="form-text">Please Upload PDF File.</div>
            </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" @click='closeModel'>Close</button>
        <button type="button" class="btn btn-primary" @click='editResource'>Save changes</button>
      </div>
    </div>
  </div>
</div>


    </div>


</template>

<script>
    export default {
        data() {
            return { 
                resources:null,
                resource:null,
                loading:true,
                filemodelshow:false,
                linkmodelshow:false,
                snippetmodelshow:false,

             }
        },
        beforeMount() {
            this.getResource()
        },
        methods: {
            deleteResource(id){
                console.log(id)
                var self=this
                this.loading=true
                axios({
                    method:'delete',
                    url: '/api/admin/resources/'+id,
                }).then(function (res){

                    console.log(res.data)
                    if(res.data.result){
                        toastr.success('successfully Delete one record')

                    }else{
                        toastr.error('Sorry you have an error')
                        this.loading=false

                    }
                })

                 this.getResource()

            },
            editHundlerResource(id){
                const found = this.resources.data.find(element => {
                return element.id == id
                });
                this.resource=found
                if(found.type=='file'){
                    const resourcesTitle = document.getElementById("resourcesTitle");
                    resourcesTitle.value=found.file.title
                    this.filemodelshow=true
                }else if(found.type=='snippet'){
                    this.snippetmodelshow=true
                }else{
                    this.linkmodelshow=true
                }


            },
            editResource(){
                console.log(this.resource.id)
                // update file
                const resourcesFile = document.getElementById("resourcesFile")
                const resourcesTitle = document.getElementById("resourcesTitle");
                if(resourcesTitle.value == ''){
                toastr.error('title is required')
                }else{
                    const formData = new FormData()
                    formData.append("title", resourcesTitle.value)
                    if(resourcesFile.files[0]){
                        formData.append("path", resourcesFile.files[0]);
                    }
                    formData.append("type", 'file')
                        axios({
                        method: 'put',
                        url: '/api/admin/resources/'+this.resource.id,
                        data:formData,
                        })
                        .then(function (response) {
                            if(response.data.typeerror){
                             toastr.error(response.data.message)
  
                            }else if(response.data.result){
                                console.log(response.data)
                                toastr.success('successfully update one record')
                                resourcesTitle.value=''
                                resourcesFile.value=''
                                this.closeModel()
                            }else{
                                console.log(response.data)
                                toastr.error('Sorry you have an error')
                            }
                        });

                }
                // end update file


            },
            closeModel(){
                this.filemodelshow=false
                this.snippetmodelshow=false
                this.linkmodelshow=false
            },
            getResource(){
            var self=this
            axios({
                method:'get',
                url: '/api/admin/resources',
            }).then(function (res){
                // console.log(res.data.resource)
                self.loading=false
                self.resources=res.data.resource
            })
            },

        }
    }
</script>
