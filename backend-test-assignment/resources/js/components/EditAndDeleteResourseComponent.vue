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
                    <td><button class="btn btn-warning" @click="editResource(resource.id)">Edit</button></td>
                    <td><button class="btn btn-danger" @click="deleteResource(resource.id)">Delete</button></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return { 
                resources:null,
                loading:true,
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
            editResource(id){
                console.log(id)

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
