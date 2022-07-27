<template>
    <div>
        <hr />
        <h2 class="text-center">Upload Link Resources</h2>
        <div class="container row">
            <div class="col-3"></div>
            <form class="col-6" @submit.prevent="onSubmit">
                <div class="mb-3">
                    <label for="linkTitle" class="form-label">Link Title</label>
                    <input
                        type="text"
                        class="form-control"
                        id="linkTitle"
                        name="linkTitle"
                    />
                </div>
                <div class="mb-3">
                    <label for="linkUrl" class="form-label">Enter URL</label>
                    <input
                        type="url"
                        class="form-control"
                        id="linkUrl"
                        name="linkUrl"
                    />
                </div>
                <div class="mb-3 form-check">
                    <input
                        type="checkbox"
                        class="form-check-input"
                        value="1"
                        name="linkNewTabCheck"
                        id="linkNewTabCheck"
                    />
                    <label class="form-check-label" for="linkNewTabCheck"
                        >Open in a new tab</label
                    >
                </div>
                <button type="submit" class="btn btn-warning col-12">
                    Upload Link
                </button>
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
            const linkTitle = document.getElementById("linkTitle");
            const linkUrl = document.getElementById("linkUrl");
            const linkNewTabCheck = document.getElementById("linkNewTabCheck");
            if (linkTitle.value == "" || linkUrl.value == "") {
                toastr.error("Link title and URL are required");
            } else {
                var check = 0;
                if (linkNewTabCheck.checked) {
                    var check = 1;
                }

                const formData = new FormData();
                formData.append("title", linkTitle.value);
                formData.append("link", linkUrl.value);
                formData.append("newtabcheck", check);
                formData.append("type", "link");
                axios({
                    method: "post",
                    url: "/api/admin/create",
                    data: formData,
                }).then(function (response) {
                    if (response.data.result) {
                        toastr.success("successfully add one record");
                        linkUrl.value = "";
                        linkTitle.value = "";
                    } else {
                        toastr.error("Sorry you have an error");
                    }
                });
            }
        },
    },
};
</script>
