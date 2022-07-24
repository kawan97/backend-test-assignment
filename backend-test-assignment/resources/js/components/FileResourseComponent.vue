<template>
<div>
    <h2 class="text-center">Upload PDF Resources </h2>
    <div class="container row">
        <div class="col-3"></div>
        <form class="col-6">
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
        }
    }
</script>
