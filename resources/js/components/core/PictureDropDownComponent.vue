<template>
    <vue-dropzone
        :id="pId"
        :options="dropzoneOptions"
        ref="dropzone"
        v-on:vdropzone-removed-file="removePicture"
        v-on:vdropzone-success="fileUploadedSuccess"
        v-on:vdropzone-thumbnail="thumbnail"
    ></vue-dropzone>
</template>

<script>
    import vue2Dropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'

    export default {
        name: "PictureDropDownComponent",
        components: {
            vueDropzone: vue2Dropzone
        },
        props: {
            pId: String,
            pFileList: {
                type: Array,
                default: []
            },
        },
        data() {
            return {
                dropzoneOptions: {
                    url: '/admin/uploadPicture',
                    thumbnailWidth: 150,
                    maxFilesize: 0.5,
                    addRemoveLinks: true,
                    removeType: "server",
                    // previewTemplate: this.template(),
                    headers: {
                        "X-CSRF-TOKEN": document.head.querySelector("[name=csrf-token]").content
                    }
                },
                uploadedFiles: []
            }
        },
        mounted(){
            this.addFiles(this.pFileList);
        },
        beforeDestroy(){
            this.dropzoneOptions.removeType = "client";
        },
        methods: {
            thumbnail: function(file, dataUrl) {
                var j, len, ref, thumbnailElement;
                if (file.previewElement) {
                    let detail = file.previewElement.querySelectorAll(".dz-details")[0];
                    let showFile = document.createElement("div");
                    showFile.innerHTML = '<a href="' + dataUrl + '" class="dz-show" target="_blank">Просмотреть</a>';
                    detail.appendChild(showFile);

                    return setTimeout(((function(_this) {
                        return function() {
                            return file.previewElement.classList.add("dz-image-preview");
                        };
                    })(this)), 1);
                }
            },
            addFiles(fileArray) {
                let self = this;
                self.removeAllFiles();
                fileArray.forEach(function (item) {
                    let file = {id: item.id, size: 0, name: "", type: "image/png"};
                    self.$refs.dropzone.manuallyAddFile(file, item.site_path);
                })
            },
            removePicture: function (file) {
                let self = this;
                let fileId = file.id;

                if (self.dropzoneOptions.removeType === "server") {
                    if (confirm("Вы действительно хотите удалить?")) {
                        axios.delete('/admin/deletePicture/' + fileId).then(response => {
                            var _ref;
                            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                        });

                        this.$emit('file-remove', fileId);
                    }
                    return;
                } else {
                    file.previewElement.remove();
                }
            },
            getFileList() {
                let result = [];
                this.$refs.dropzone.getAcceptedFiles().forEach(function (file) {
                    result.push( {id: file.xhr.response});
                });
                this.$refs.dropzone.getFilesWithStatus().forEach(function (file) {
                    result.push({id:file.id});
                });

                return result;
            },
            removeAllFiles: function () {
                this.dropzoneOptions.removeType = "client";
                this.$refs.dropzone.removeAllFiles();
                this.dropzoneOptions.removeType = "server";
            },
            fileUploadedSuccess: function(file, response){
                this.$emit('file-uploaded-success', file, response);
            }
        }
    }
</script>

<style scoped>
    .vue-dropzone{
        font-family: inherit;
    }
    .vue-dropzone >>> .dz-details .dz-size,
    .vue-dropzone >>> .dz-details .dz-filename
    {
        display: none;
    }
    .vue-dropzone >>> .dz-preview .dz-remove {
        position: absolute;
        z-index: 30;
        color: #fff;
        margin-left: 5px;
        padding: 0;
        top: inherit;
        bottom: 0;
        border: none;
        text-decoration: none;
        text-transform: none;
        font-size: .8rem;
        font-weight: 800;
        letter-spacing: inherit;
    }

    .vue-dropzone >>> .dz-preview .dz-show {
        color: #fff;
        margin-left: 5px;
        padding: 0;
        text-decoration: none;
        text-transform: none;
        font-size: .8rem;
        font-weight: 800;
        letter-spacing: inherit;
        cursor: pointer;
    }

</style>
