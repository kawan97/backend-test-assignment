<template>
<div>
    <hr>
    <h2 class="text-center">Upload Link Resources</h2>
    <div class="container row">
        <div class="col-3"></div>
        <form class="col-6">
            <div class="mb-3">
                <label for="linkTitle" class="form-label">Link Title</label>
                <input type="text" class="form-control" id="linkTitle" name="linkTitle">
            </div>
            <div class="mb-3">
                <label for="linkUrl" class="form-label">Enter URL</label>
                <input type="url" class="form-control" id="linkUrl" name="linkUrl">
            </div>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="linkNewTabCheck" id="linkNewTabCheck">
                <label class="form-check-label" for="linkNewTabCheck">Open in a new tab</label>
            </div>
            <button type="submit" class="btn btn-warning col-12">Upload Link</button>
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
