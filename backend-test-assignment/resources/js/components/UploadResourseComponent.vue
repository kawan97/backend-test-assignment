<template>
<div>
    <h2 class="text-center">Upload PDF Resources </h2>
    <div class="container row">
        <div class="col-3"></div>
        <form class="col-6">
            <div class="mb-3">
                <label for="title" class="form-label">Resources Title</label>
                <input type="text" class="form-control" id="title">
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">Upload PDF File</label>
                <input class="form-control" type="file" id="file" accept="application/pdf">
                <div id="emailHelp" class="form-text">Please Upload PDF File.</div>

            </div>
            <button type="submit" class="btn btn-primary col-12">Upload</button>
        </form>
    </div>
</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
