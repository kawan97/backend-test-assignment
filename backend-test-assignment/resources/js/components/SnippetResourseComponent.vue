<template>
    <div>
        <hr />
        <!-- <button v-on:click="btn" class="btn btn-success col-12">Upload Snippet</button> -->
        <h2 class="text-center">Upload HTML Resources</h2>
        <div class="container row">
            <div class="col-3"></div>
            <form class="col-6" @submit.prevent="onSubmit">
                <div class="mb-3">
                    <label for="snippetTitle" class="form-label"
                        >Snippet Title</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        id="snippettitle"
                        name="snippettitle"
                    />
                </div>
                <div class="mb-3">
                    <label for="snippetDescription" class="form-label"
                        >Snippet Description</label
                    >
                    <textarea
                        class="form-control"
                        id="snippetDescription"
                        rows="3"
                        name="snippetDescription"
                    ></textarea>
                </div>
                <div class="mb-3">
                    <label for="snippetHtml" class="form-label"
                        >HTML Snippet</label
                    >
                    <textarea
                        class="mceEditor"
                        id="snippetHtml"
                        rows="3"
                        name="snippetHtml"
                    ></textarea>
                </div>
                <button type="submit" class="btn btn-success col-12">
                    Upload Snippet
                </button>
            </form>
        </div>
    </div>
</template>

<script>
tinymce.init({
    selector: "#snippetHtml",
    plugins:
        "a11ychecker advcode casechange export formatpainter image editimage linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tableofcontents tinycomments tinymcespellchecker",
    toolbar:
        "a11ycheck addcomment showcomments casechange checklist code export formatpainter image editimage pageembed permanentpen table tableofcontents",
    toolbar_mode: "floating",
    tinycomments_mode: "embedded",
    tinycomments_author: "Author name",
});
export default {
    mounted() {
        // console.log('Component mounted.')
    },
    methods: {
        btn: function () {
            console.log(tinymce.activeEditor.getContent());
        },
        onSubmit() {
            const snippetDescription =
                document.getElementById("snippetDescription");
            const snippettitle = document.getElementById("snippettitle");
            const snippetContent = tinymce.activeEditor.getContent();
            const content = document.getElementById("snippetHtml");

            if (
                snippetDescription.value == "" ||
                snippettitle.value == "" ||
                snippetContent == ""
            ) {
                toastr.error("All fields are required");
            } else {
                const formData = new FormData();
                formData.append("title", snippettitle.value);
                formData.append("snippet", snippetContent);
                formData.append("description", snippetDescription.value);
                formData.append("type", "snippet");
                axios({
                    method: "post",
                    url: "/api/admin/create",
                    data: formData,
                }).then(function (response) {
                    if (response.data.result) {
                        toastr.success("successfully add one record");
                        snippettitle.value = "";
                        snippetDescription.value = "";
                        content.value = "";
                        tinymce.activeEditor.setContent('');

                    } else {
                        toastr.error("Sorry you have an error");
                    }
                });
            }
        },
    },
};
</script>
