<template>
    <div>
        <div class="row pb-3">
            <div v-if="!pReadOnly"  class="col-12 pt-3">
                <button class="btn btn-primary" @click="initCreate()">
                    <i class="fa fa-plus-square"></i>
                    {{trans.get('messages.all.add')}}
                </button>
            </div>
        </div>
        <div>
            <table id="optionsetList" class="table table-striped table-responsive-sm col-12">
                <thead>
                <tr>
                    <th>{{trans.get('messages.admin.service.service_step.result.description')}}</th>
                    <th>{{trans.get('messages.all.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(entity, index) in entityList">
                    <td>{{entity.service_result.description}}</td>
                    <td class="text-center">
                        <div v-if="!pReadOnly" class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                <i class="fa fa-bars"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
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

        <div class="modal fade" role="dialog" id="modal-service-step-result-set">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" v-if="form.id === 0">{{trans.get('messages.admin.system.modal.create')}}</h4>
                        <h4 class="modal-title" v-else>{{trans.get('messages.admin.system.modal.update')}}</h4>
                        <button type="button" class="close" @click="hideServiceStepResultModal()" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body" @change="form.errors.clear($event.target.name)"
                         @keydown="form.errors.clear($event.target.name)">

                        <form-group
                                :p-caption="trans.get('messages.admin.service.service_step.required_document.description')"
                                p-field-name="service_result_id"
                                :p-form="form"
                                :p-type="componentType.Select2"
                                :p-dict-list="serviceResultList"
                                p-dict-val-name="description"
                        />

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" @click="hideServiceStepResultModal()">
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
        name: "ServiceStepResultListComponent",
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
                url: '/admin/vue/service_step_result',
                serviceStepId: this.initialServiceStepId,
                serviceId: this.initialServiceId,
                entityList: [],
                serviceResultList: [],
                defaultEntity: {
                    id: 0,
                    service_step_id: this.initialServiceStepId,
                    service_id: this.initialServiceId,
                    service_result_id: 0
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
                        this.serviceResultList = response.data.serviceResultList
                    });
                }
            },
            initCreate() {
                this.form = new Form(this.defaultEntity);
                $('#modal-service-step-result-set').modal('show');
            },
            initUpdate(index) {
                let entity = this.entityList[index];
                this.form = new Form(entity);

                this.editEntityIndex = index;
                $('#modal-service-step-result-set').modal('show');
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

                        this.hideServiceStepResultModal();
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
            hideServiceStepResultModal(){
                $('#modal-service-step-result-set').modal('hide');
            }
        }
    }
</script>

<style scoped>

</style>