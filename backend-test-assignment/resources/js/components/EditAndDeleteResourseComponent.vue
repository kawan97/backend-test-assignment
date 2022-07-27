<template>
    <div class="row">
        <h2 class="text-center">Edit and Delete Resources</h2>
        <center v-if="loading">
            <div class="spinner-border text-danger">
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
                    <tr
                        v-for="resource in resources.data"
                        v-bind:key="resource.id"
                    >
                        <th scope="row">{{ resource.id }}</th>
                        <th>{{ resource.type }}</th>
                        <td v-if="resource.link">{{ resource.link.title }}</td>
                        <td v-if="resource.snippet">
                            {{ resource.snippet.title }}
                        </td>
                        <td v-if="resource.file">{{ resource.file.title }}</td>
                        <td>
                            <button
                                class="btn btn-warning"
                                @click="editHundlerResource(resource.id)"
                            >
                                Edit
                            </button>
                        </td>
                        <td>
                            <button
                                class="btn btn-danger"
                                @click="deleteResource(resource.id)"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- models -->
        <!-- model for file -->
        <div
            class="modal fade show"
            :style="{ display: filemodelshow ? 'block' : 'none' }"
            id="fileModal"
            tabindex="-1"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Edit File
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            @click="closeModel"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <form class="col-12" @submit.prevent="onSubmit">
                            <div class="mb-3">
                                <label for="resourcesTitle" class="form-label"
                                    >Resources Title</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    name="resourcesTitle"
                                    id="resourcesTitle"
                                />
                            </div>
                            <div class="mb-3">
                                <label for="resourcesFile" class="form-label"
                                    >Upload PDF File</label
                                >
                                <input
                                    class="form-control"
                                    type="file"
                                    id="resourcesFile"
                                    name="resourcesFile"
                                    accept="application/pdf"
                                />
                                <div class="form-text">
                                    Please Upload PDF File.
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            @click="closeModel"
                        >
                            Close
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="editResource"
                        >
                            Save changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end model for file -->

        <!-- model for link -->
        <div
            class="modal fade show"
            :style="{ display: linkmodelshow ? 'block' : 'none' }"
            id="linkModal"
            tabindex="-1"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Edit Link
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            @click="closeModel"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <form class="col-12" @submit.prevent="onSubmit">
                            <div class="mb-3">
                                <label for="linkTitle" class="form-label"
                                    >Link Title</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="linkTitle"
                                    name="linkTitle"
                                />
                            </div>
                            <div class="mb-3">
                                <label for="linkUrl" class="form-label"
                                    >Enter URL</label
                                >
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
                                <label
                                    class="form-check-label"
                                    for="linkNewTabCheck"
                                    >Open in a new tab</label
                                >
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            @click="closeModel"
                        >
                            Close
                        </button>
                        <button
                            type="button"
                            class="btn btn-warning"
                            @click="editResource"
                        >
                            Save changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end model for link -->

        <!--  model for snippet -->
        <div
            class="modal fade show"
            :style="{ display: snippetmodelshow ? 'block' : 'none' }"
            id="linkModal"
            tabindex="-1"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Edit Snippet
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            @click="closeModel"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <form class="col-12" @submit.prevent="onSubmit">
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
                                <label
                                    for="snippetDescription"
                                    class="form-label"
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
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            @click="closeModel"
                        >
                            Close
                        </button>
                        <button
                            type="button"
                            class="btn btn-success"
                            @click="editResource"
                        >
                            Save changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!--  end for snippet -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            resources: null,
            resource: null,
            loading: true,
            filemodelshow: false,
            linkmodelshow: false,
            snippetmodelshow: false,
        };
    },
    beforeMount() {
        this.getResource();
    },
    methods: {
        deleteResource(id) {
            console.log(id);
            var self = this;
            this.loading = true;
            axios({
                method: "delete",
                url: "/api/admin/resources/" + id,
            }).then(function (res) {
                console.log(res.data);
                if (res.data.result) {
                    toastr.success("successfully Delete one record");
                } else {
                    toastr.error("Sorry you have an error");
                    this.loading = false;
                }
            });

            this.getResource();
        },
        editHundlerResource(id) {
            const found = this.resources.data.find((element) => {
                return element.id == id;
            });
            this.resource = found;
            if (found.type == "file") {
                const resourcesTitle =
                    document.getElementById("resourcesTitle");
                resourcesTitle.value = found.file.title;
                this.filemodelshow = true;
            } else if (found.type == "snippet") {
                document.getElementById("snippetDescription").value =
                    found.snippet.description;
                document.getElementById("snippettitle").value =
                    found.snippet.title;
                tinymce.activeEditor.setContent(found.snippet.snippet);
                // document.getElementById("snippetHtml").value=found.snippet.snippet
                this.snippetmodelshow = true;
            } else {
                this.linkmodelshow = true;
                document.getElementById("linkTitle").value =
                    this.resource.link.title;
                document.getElementById("linkUrl").value =
                    this.resource.link.link;
                document.getElementById("linkNewTabCheck").checked = false;
                if (this.resource.link.newtabcheck == 1) {
                    document.getElementById("linkNewTabCheck").checked = true;
                }
            }
        },
        update(formData) {
            var self = this;
            axios({
                method: "put",
                url: "/api/admin/resources/" + this.resource.id,
                data: formData,
            }).then(function (response) {
                if (response.data.typeerror) {
                    toastr.error(response.data.message);
                } else if (response.data.result) {
                    // console.log(response.data);
                    toastr.success("successfully update one record");
                    self.getResource();
                    self.closeModel();
                } else {
                    // console.log(response.data);
                    toastr.error("Sorry you have an error");
                }
            });
        },
        editResource() {
            // update file
            if (this.resource.type == "file") {
                const resourcesFile = document.getElementById("resourcesFile");
                const resourcesTitle =
                    document.getElementById("resourcesTitle");
                if (resourcesTitle.value == "") {
                    toastr.error("title is required");
                } else {
                    var formData = {
                        title: resourcesTitle.value,
                        type: "file",
                    };
                    if (resourcesFile.files[0]) {
                        var self = this;
                        const formDataImg = new FormData();
                        formDataImg.append("path", resourcesFile.files[0]);
                        formDataImg.append("type", "file");
                        axios({
                            method: "post",
                            url:
                                "/api/admin/resources/updatepdf/" +
                                this.resource.id,
                            data: formDataImg,
                        }).then(function (response) {
                            if (response.data.typeerror) {
                                toastr.error(response.data.message);
                            }
                            if (response.data.result) {
                                self.update(formData);
                            }
                        });
                    } else {
                        this.update(formData);
                    }
                }
            }
            // end update file

            // update link
            if (this.resource.type == "link") {
                const linkTitle = document.getElementById("linkTitle");
                const linkUrl = document.getElementById("linkUrl");
                const linkNewTabCheck =
                    document.getElementById("linkNewTabCheck");
                if (linkTitle.value == "" || linkUrl.value == "") {
                    toastr.error("Link title and URL are required");
                } else {
                    var check = 0;
                    if (linkNewTabCheck.checked) {
                        var check = 1;
                    }
                    var formData = {
                        title: linkTitle.value,
                        type: "link",
                        newtabcheck: check,
                        link: linkUrl.value,
                    };
                    this.update(formData);
                }
            }
            //end update link

            // update snippet
            if (this.resource.type == "snippet") {
                const snippetDescription =
                    document.getElementById("snippetDescription");
                const snippettitle = document.getElementById("snippettitle");
                const snippetContent = tinymce.activeEditor.getContent();

                if (
                    snippetDescription.value == "" ||
                    snippettitle.value == "" ||
                    snippetContent == ""
                ) {
                    toastr.error("All fields are required");
                } else {
                    var formData = {
                        title: snippettitle.value,
                        type: "snippet",
                        snippet: snippetContent,
                        description: snippetDescription.value,
                    };
                    this.update(formData);
                }
            }
            //end update snippet
        },
        closeModel() {
            this.loading = true;
            this.filemodelshow = false;
            this.snippetmodelshow = false;
            this.linkmodelshow = false;
            this.loading = false;
        },
        getResource() {
            this.loading = true;
            var self = this;
            axios({
                method: "get",
                url: "/api/admin/resources",
            }).then(function (res) {
                // console.log(res.data.resource)
                self.loading = false;
                self.resources = res.data.resource;
            });
        },
    },
};
</script>
