<template>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-primary float-right" @click="initCreate()">
                                <i class="fa fa-plus-square"></i>
                                {{trans.get('messages.all.add')}}
                            </button>
                        </div>
                        <div class="col-12 mt-3">
                            <table class="table">
                                <thead>
                                <tr>
                                    <td>{{trans.get('messages.admin.service.service_step.step_number')}}</td>
                                    <td>{{trans.get('messages.admin.service.service_step.description')}}</td>
                                    <td>{{trans.get('messages.admin.service.service_step.is_required')}}</td>
                                    <td>{{trans.get('messages.admin.service.service_step.is_active')}}</td>
                                    <td>{{trans.get('messages.admin.service.service_step.execution_parallel_no')}}</td>
                                    <td>{{trans.get('messages.admin.service.service_step.tax')}}</td>
                                    <td>{{trans.get('messages.admin.service.service_step.cost')}}</td>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(entity, index) in entityList">
                                    <td>{{entity.step_number}}</td>
                                    <td>{{entity.service_step.description}}</td>
                                    <td><i v-if="entity.is_required == 1" class="fas fa-check"></i></td>
                                    <td><i v-if="entity.is_active == 1" class="fas fa-check"></i></td>
                                    <td>{{entity.execution_parallel_no}}</td>
                                    <td>{{entity.service_step.latest_service_step_cost_hist.tax}}</td>
                                    <td>{{entity.service_step.latest_service_step_cost_hist.cost}}</td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                <i class="fa fa-bars"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item"
                                                   @click="showRequiredDocumentList(entity.service_step.id)">{{trans.get('messages.admin.service.service_step.required_document.title')}}</a>
                                                <a class="dropdown-item"
                                                   @click="showResultList(entity.service_step.id)">{{trans.get('messages.admin.service.service_step.result.title')}}</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item"
                                                   @click="initUpdate(index,entity.id)">{{trans.get('messages.all.edit')}}</a>
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
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" role="dialog" id="set-model-step">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" v-if="form.id === 0">{{trans.get('messages.admin.system.modal.create')}}</h4>
                        <h4 class="modal-title" v-else>{{trans.get('messages.admin.system.modal.update')}}</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" @change="form.errors.clear($event.target.name)"
                         @keydown="form.errors.clear($event.target.name)">

                        <div class="row">
                            <div class="col-6">
                                <form-group
                                        :p-caption="trans.get('messages.admin.service.service_step.is_active')"
                                        p-field-name="is_active"
                                        :p-form="form"
                                        :p-type="componentType.CheckBox"
                                />
                            </div>
                            <div class="col-6">
                                <form-group
                                        :p-caption="trans.get('messages.admin.service.service_step.is_required')"
                                        p-field-name="is_required"
                                        :p-form="form"
                                        :p-type="componentType.CheckBox"
                                />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <form-group
                                        :p-caption="trans.get('messages.admin.serviceStepMap.serviceStepList')"
                                        p-field-name="service_step_id"
                                        :p-form="form"
                                        :p-type="componentType.Select2"
                                        :p-dict-list="serviceStepList"
                                        p-dict-val-name="description"
                                />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <form-group
                                        :p-caption="trans.get('messages.admin.service.service_step.step_number')"
                                        p-field-name="step_number"
                                        :p-form="form"
                                        :p-type="componentType.Input"
                                        p-input-type="number"
                                />
                            </div>
                            <div v-if="form.id !== 0" class="col-6">
                                <div class="form-group">
                                    <label for="execution_parallel_no">{{trans.get('messages.admin.service.service_step.execution_parallel_no')}}</label>
                                    <select :class="['form-control', form.errors.has('execution_parallel_no') ? 'is-invalid' : '']"
                                            id="execution_parallel_no" name="execution_parallel_no" v-model="form.execution_parallel_no">
                                        <option v-for="item in entityList.length" :value="item">
                                            {{item}}
                                        </option>
                                    </select>
                                    <span v-if="form.errors.has('execution_parallel_no')"  :class="['help-block invalid-feedback']">
                                        <strong v-text="form.errors.get('execution_parallel_no')"></strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <form-group
                                        :p-caption="trans.get('messages.admin.service.service_step.cost')"
                                        p-field-name="cost"
                                        :p-form="form"
                                        :p-type="componentType.Input"
                                        p-input-type="number"
                                />
                            </div>
                            <div v-if="form.id !== 0" class="col-6">
                                <form-group
                                        :p-caption="trans.get('messages.admin.service.service_step.tax')"
                                        p-field-name="tax"
                                        :p-form="form"
                                        :p-type="componentType.Input"
                                        p-input-type="number"
                                />
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">
                                {{trans.get('messages.all.cancel')}}
                            </button>
                            <button type="button" @click="set()" :disabled="form.errorsOrSend()" class="btn btn-primary">
                                {{trans.get('messages.all.submit')}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" role="dialog" id="modal-service-step-required-document-list">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            {{trans.get('messages.admin.service.service_step.required_document.title')}}</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <service-step-required-document-list-component
                                        :key="selectedServiceStep"
                                        :initial-service-step-id="selectedServiceStep"
                                        :initial-service-id="serviceId"
                                        :p-read-only="false">
                                </service-step-required-document-list-component>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" role="dialog" id="modal-service-step-result-list">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            {{trans.get('messages.admin.service.service_step.result.title')}}</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <service-step-result-list-component
                                        :key="selectedServiceStep"
                                        :initial-service-step-id="selectedServiceStep"
                                        :initial-service-id="serviceId"
                                        :p-read-only="false">

                                </service-step-result-list-component>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>



<script>
    export default {
        name: "ServiceStepMapListComponent",
        props: {
            'initialServiceId': Number
        },
        data() {
            return {
                url: '/admin/vue/service_step_map',
                entityList: [],
                selectedServiceStep: null,
                serviceStepList: [],
                defaultEntity: {
                    id: 0,
                    service_id: this.serviceId,
                    service_step_id: null,
                    step_number: 0,
                    is_required: false,
                    is_active: false,
                    execution_parallel_no: null,
                    cost: 0,
                    tax: 0
                },
                form: new Form(this.defaultEntity),
                serviceId: this.initialServiceId,
                componentType: formComponentType
            }
        },
        mounted() {
            this.getEntityList();
        },
        methods: {
            getEntityList() {
                if (this.serviceId !== 0) {
                    axios.get(this.url + '/listAndDict/' + this.serviceId).then(response => {
                        this.entityList = response.data.stepList;
                        this.serviceStepList = response.data.fullServiceStepList;
                    });
                }
            },
            initCreate() {
                this.form = new Form(this.defaultEntity);
                $('#set-model-step').modal('show');
            },
            initUpdate(index, entityId) {
                let entity = this.entityList[index];
                entity.cost  = entity.service_step.latest_service_step_cost_hist.cost;
                entity.tax = entity.service_step.latest_service_step_cost_hist.tax;
                this.form = new Form(entity);
                $('#set-model-step').modal('show');
            },
            set() {
                let self = this;
                let url = this.url + "/set";
                let message = (this.form.id === 0) ? this.trans.get('messages.admin.system.success.store')
                    : this.trans.get('messages.admin.system.success.update');

                self.form.service_id = this.serviceId;
                self.form.post(url)
                    .then(response => {
                        this.entity = response;
                        this.form = new Form(this.entity);
                        self.$notify({
                            group: 'all',
                            position: 'top right',
                            text: message,
                            type: 'success'
                    });

                    this.getEntityList();
                    $('#set-model-step').modal('hide');
                });
            },
            deleteEntity(entityId, index) {
                axios.post(this.url + "/delete/" + entityId)
                    .then(request => {
                        this.entityList.splice(index, 1);

                        this.getEntityList();

                        this.$notify({
                            group: 'all',
                            position: 'top right',
                            text: this.trans.get('messages.admin.system.success.delete'),
                            type: 'success'
                        });
                    });
            },
            showRequiredDocumentList(entityId) {
                this.selectedServiceStep = entityId;
                $('#modal-service-step-required-document-list').modal('show');
            },
            showResultList(entityId) {
                this.selectedServiceStep = entityId;
                $('#modal-service-step-result-list').modal('show');
            }
        }
    }
</script>

<style scoped>

</style>
