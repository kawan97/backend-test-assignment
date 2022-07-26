<template>
<div>
    <h2 class="text-center">Upload PDF Resources </h2>
    <div class="container row">
        <div class="col-3"></div>
        <form class="col-6" @submit.prevent="onSubmit">
            <div class="mb-3">
                <label for="resourcesTitle" class="form-label">Resources Title</label>
                <input type="text" class="form-control" name="resourcesTitle" id="resourcesTitle">
            </div>
            <div class="mb-3">
                <label for="resourcesFile" class="form-label">Upload PDF File</label>
                <input class="form-control" type="file" id="resourcesFile" name="resourcesFile" accept="application/pdf">
                <div class="form-text">Please Upload PDF File.</div>

            </div>
            <button type="submit" class="btn btn-primary col-12">Upload PDF</button>
        </form>
    </div>
</div>
</template>

<script>
    export default {
        mounted() {
            // console.log('Component mounted.')
        },
                methods: {
            onSubmit() {
                const resourcesFile = document.getElementById("resourcesFile")
                const resourcesTitle = document.getElementById("resourcesTitle");
                if(resourcesFile.value =='' || resourcesFile.value == ''){
                toastr.error('title and file are required')

                }else{
                    const formData = new FormData()
                    formData.append("title", resourcesTitle.value)
                    formData.append("path", resourcesFile.files[0]);
                    formData.append("type", 'file')
                        axios({
                        method: 'post',
                        url: '/api/admin/create',
                        data:formData,
                        })
                        .then(function (response) {
                            if(response.data.typeerror){
                             toastr.error(response.data.message)
  
                            }else if(response.data.result){
                                console.log(response.data)
                                toastr.success('successfully add one record')
                                resourcesTitle.value=''
                                resourcesFile.value=''
                            }else{
                                toastr.error('Sorry you have an error')
                            }
                        });

                }


            }
        }
    }
</script>
