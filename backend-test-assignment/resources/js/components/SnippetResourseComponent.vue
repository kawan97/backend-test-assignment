<template>
<div>
    <hr>
    <h2 class="text-center">Upload HTML Resources</h2>
    <div class="container row">
        <div class="col-3"></div>
        <form class="col-6">
            <div class="mb-3">
                <label for="snippetTitle" class="form-label">Snippet Title</label>
                <input type="text" class="form-control" id="snippettitle" name="snippettitle">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Snippet Description</label>
                <textarea class="form-control" id="description" rows="3" name="snippetDescription"></textarea>
            </div>
            <button type="submit" class="btn btn-success col-12">Upload Snippet</button>
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
