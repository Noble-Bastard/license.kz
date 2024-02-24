<template>
    <div>
        <div class="row pb-3">
            <div  class="col-12 pt-3">
                <button v-if="!pReadOnly" class="btn btn-primary" @click="initCreate()">
                    <i class="fa fa-plus-square"></i>
                    {{trans.get('messages.all.add')}}
                </button>
            </div>
        </div>
        <div>
            <table id="optionsetList" class="table table-striped table-responsive-sm col-12">
                <thead>
                <tr>
                    <th>{{trans.get('messages.admin.service.service_step.required_document.document_number')}}</th>
                    <th>{{trans.get('messages.admin.service.service_step.required_document.description')}}</th>
                    <th>{{trans.get('messages.all.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(entity, index) in entityList">
                    <td>{{entity.document_number}}</td>
                    <td>{{entity.service_required_document.description}}</td>
                    <td class="text-center">
                        <div v-if="!pReadOnly" class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                <i class="fa fa-bars"></i>
                            </button>
                            <div  class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item"
                                   @click="initUpdate(index)">{{trans.get('messages.all.edit')}}</a>
                                <a class="dropdown-item"
                                   @click="deleteEntity(entity.id, index)"
                                   data-method="delete">{{trans.get('messages.all.delete')}}</a>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="modal fade" role="dialog" id="modal-service-step-required-document-set">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" v-if="form.id === 0">{{trans.get('messages.admin.system.modal.create')}}</h4>
                        <h4 class="modal-title" v-else>{{trans.get('messages.admin.system.modal.update')}}</h4>
                        <button  type="button" class="close" @click="hideServiceStepRequiredDocumentModal()" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body" @change="form.errors.clear($event.target.name)"
                         @keydown="form.errors.clear($event.target.name)">

                        <div class="form-group">
                            <label for="document_number">{{trans.get('messages.admin.service.service_step.required_document.document_number')}}</label>

                            <input :class="['form-control', form.errors.has('document_number') ? 'is-invalid' : '']"
                                   v-model="form.document_number" id="document_number" name="document_number" type="number"/>
                            <span v-if="form.errors.has('document_number')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('document_number')"></strong>
                            </span>
                        </div>

                        <form-group
                                :p-caption="trans.get('messages.admin.service.service_step.required_document.description')"
                                p-field-name="service_required_document_id"
                                :p-form="form"
                                :p-type="componentType.Select2"
                                :p-dict-list="serviceRequiredDocumentList"
                                p-dict-val-name="description"
                        />

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" @click="hideServiceStepRequiredDocumentModal()">
                            {{trans.get('messages.all.cancel')}}
                        </button>
                        <button type="button" @click="set()" :disabled="form.errorsOrSend()" class="btn btn-primary">
                            {{trans.get('messages.all.submit')}}
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
</template>

<script>
    export default {
        name: "ServiceStepRequiredDocumentListComponent",
        props: {
            'initialServiceStepId': Number,
            'initialServiceId': Number,
            'pReadOnly': {
                type: Boolean,
                default: false
            }
        },
        data() {
            return {
                url: '/admin/vue/service_step_required_document',
                serviceStepId: this.initialServiceStepId,
                serviceId: this.initialServiceId,
                entityList: [],
                serviceRequiredDocumentList: [],
                defaultEntity: {
                    id: 0,
                    service_step_id: this.initialServiceStepId,
                    service_id: this.initialServiceId,
                    service_required_document_id: 0,
                    document_number: 0
                },
                form: new Form(this.defaultEntity),
                componentType: formComponentType
            }
        },
        mounted() {
            this.getEntityList();
        },
        methods: {
            getEntityList(){
                if (this.serviceStepId !== 0) {
                    axios.get(this.url + '/list/' + this.serviceStepId + '/' + this.serviceId).then(response => {
                        this.entityList = response.data.entityList;
                        this.serviceRequiredDocumentList = response.data.serviceRequiredDocumentList;
                    });
                }
            },
            initCreate() {
                this.form = new Form(this.defaultEntity);
                $('#modal-service-step-required-document-set').modal('show');
            },
            initUpdate(index) {
                let entity = this.entityList[index];
                this.form = new Form(entity);

                this.editEntityIndex = index;
                $('#modal-service-step-required-document-set').modal('show');
            },
            set() {
                let self = this;
                let _url = this.url + "/set";
                let _message = this.trans.get('messages.admin.system.success.store');
                if (self.form.id !== 0) {
                    _message = this.trans.get('messages.admin.system.success.update');
                }

                self.form.post(_url)
                    .then(response => {

                        this.entity = response;
                        this.form = new Form(this.entity);
                        self.$notify({
                            group: 'all',
                            position: 'top right',
                            text: _message,
                            type: 'success'
                        });

                        this.getEntityList();

                        this.hideServiceStepRequiredDocumentModal()
                    });
            },
            deleteEntity(entityId, index) {
                let self = this;
                axios.post(this.url + "/delete/" + entityId)
                    .then(request => {
                        self.entityList.splice(index, 1);

                        self.$notify({
                            group: 'all',
                            position: 'top right',
                            text: this.trans.get('messages.admin.system.success.delete'),
                            type: 'success'
                        });
                    });
            },
            hideServiceStepRequiredDocumentModal(){
                $('#modal-service-step-required-document-set').modal('hide');
            }
        }
    }
</script>

<style scoped>

</style>