<template>
    <div class="modal fade" tabindex="-1" role="dialog" ref="modalDialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{pModalTitle}}</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data">
                        <div class="form-group">
                            <label>{{pInputCaption}}</label>
                            <div class="custom-file">
                                <input
                                        ref="file"
                                        type="file"
                                        :accept="pAccept"
                                        class="custom-file-input"
                                        v-on:change="handleFileUpload()"
                                >
                                <label ref="fileCaption" class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">
                        Отмена
                    </button>
                    <button type="button" @click="uploadFile()" class="btn btn-primary">
                        Сохранить
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</template>

<script>
    export default {
        name: "FileInputBootstrap",
        props: {
            pModalTitle: String,
            pInputCaption: String,
            pAccept: String,
            pUrl: String
        },
        data() {
            return {
                preview: null,
                entityId: null
            }
        },
        methods: {
            showModal(entityId) {
                this.entityId = entityId;
                this.preview = null;

                $(this.$refs.modalDialog).modal('show');
            },
            handleFileUpload() {
                this.preview = this.$refs.file.files[0];
                this.$refs.fileCaption.textContent = this.preview.name;
            },
            uploadFile() {
                let self = this;
                let formData = new FormData();
                formData.append('file', this.preview);
                axios.post(this.pUrl + '/' + this.entityId,
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(function () {
                    $(self.$refs.modalDialog).modal('hide');

                    self.$notify({
                        group: 'all',
                        position: 'top right',
                        text: 'Запись изменена',
                        type: 'success'
                    });
                });
            },
        }
    }
</script>

<style scoped>

</style>
