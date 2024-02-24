<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row pb-3">
                        <div class="col-3">
                            <label for="licenseTypeId">{{trans.get('messages.admin.serviceStep.licenseTypeFilter')}}</label>
                            <select class="form-control" id="licenseTypeId" @change="onLicenseTypeChange()" v-model="selectedLicenseTypeId">
                                <option :value="licenseType.id" v-for="(licenseType, index) in pLicenseTypes">
                                    {{licenseType.name}}
                                </option>
                            </select>
                        </div>
                    </div>
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
                                    <td>{{trans.get('messages.admin.service.service_step.description')}}</td>
                                    <td>{{trans.get('messages.admin.service.service_step.execution_work_day_cnt')}}</td>
                                    <td>{{trans.get('messages.admin.service.service_step.execution_time_plan')}}</td>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(entity, index) in entityList">
                                    <td>{{entity.description}}</td>
                                    <td>{{entity.execution_work_day_cnt}}</td>
                                    <td>{{entity.execution_time_plan}}</td>
                                    <td class="text-center">
                                        <div class="dropdown">
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
                            <div class="col-4">
                                <form-group
                                        :p-caption="trans.get('messages.admin.service.license_type')"
                                        p-field-name="license_type_id"
                                        :p-form="form"
                                        :p-type="componentType.Select2"
                                        :p-dict-list="pLicenseTypes"
                                        p-dict-val-name="name"
                                        :p-is-empty-choice-available="false"
                                />
                            </div>
                            <div class="col-4">
                                <form-group
                                        :p-caption="trans.get('messages.admin.service.counter_type')"
                                        p-field-name="counter_type_id"
                                        :p-form="form"
                                        :p-type="componentType.Select2"
                                        :p-dict-list="counterTypeList"
                                        p-dict-val-name="name"
                                        :p-is-empty-choice-available="false"
                                />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <form-group
                                        :p-caption="trans.get('messages.admin.service.service_step.currency_id')"
                                        p-field-name="currency_id"
                                        :p-form="form"
                                        :p-type="componentType.Select2"
                                        :p-dict-list="currencyTypeList"
                                        p-dict-val-name="name"
                                        :p-is-empty-choice-available="false"
                                />
                            </div>
                            <div class="col-4">
                                <form-group
                                        :p-caption="trans.get('messages.admin.service.service_step.cost')"
                                        p-field-name="cost"
                                        :p-form="form"
                                        :p-type="componentType.Input"
                                        p-input-type="number"
                                />
                            </div>
                            <div class="col-4">
                                <form-group
                                        :p-caption="trans.get('messages.admin.service.service_step.tax')"
                                        p-field-name="tax"
                                        :p-form="form"
                                        :p-type="componentType.Input"
                                        p-input-type="number"
                                />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <multi-lang-form-group
                                        :p-caption="trans.get('messages.admin.service.service_step.description')"
                                        p-field-name="description"
                                        :p-form="form"
                                        :p-type="componentType.Textarea"
                                />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <form-group
                                        :p-caption="trans.get('messages.admin.service.service_step.execution_work_day_cnt')"
                                        p-field-name="execution_work_day_cnt"
                                        :p-form="form"
                                        :p-type="componentType.Input"
                                        p-input-type="number"
                                />
                            </div>
                            <div class="col-6">
                                <form-group
                                        :p-caption="trans.get('messages.admin.service.service_step.execution_time_plan')"
                                        p-field-name="execution_time_plan"
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

    </div>
</template>

<script>
    export default {
        name: "ServiceStepListComponent",
        props: {
            'pLicenseTypes': []
        },
        data() {
            return {
                url: '/admin/vue/service_step',
                selectedLicenseTypeId: null,
                counterTypeList: [],
                currencyTypeList: [],
                entityList: [],
                defaultEntity: {
                    id: 0,
                    description: '',
                    description_en: '',
                    execution_work_day_cnt: 0,
                    counter_type_id: 0,
                    execution_time_plan: 0,
                    currency_id: 0,
                    cost: 0,
                    tax: 0,
                    license_type_id: 0
                },
                selectedServiceStep: 0,
                form: new Form(this.defaultEntity),
                componentType: formComponentType
            }
        },
        mounted() {
            this.getEntityList();
        },
        methods: {
            onLicenseTypeChange(){
                this.getEntityList();
            },
            getEntityList() {
                if (this.serviceId !== 0) {
                    axios.get(this.url + '/listAndDict/' + this.selectedLicenseTypeId).then(response => {
                        this.entityList = response.data.stepList;
                        this.counterTypeList = response.data.counterTypeList;
                        this.currencyTypeList = response.data.currencyTypeList;
                    });
                }
            },
            initCreate() {
                this.form = new Form(this.defaultEntity);
                $('#set-model-step').modal('show');
            },
            initUpdate(index) {
                let entity = this.entityList[index];
                this.form = new Form(entity);
                this.form.cost = entity.latest_service_step_cost_hist.cost;
                this.form.tax = entity.latest_service_step_cost_hist.tax;
                this.form.currency_id = entity.latest_service_step_cost_hist.currency_id;
                $('#set-model-step').modal('show');
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
            }
        }
    }
</script>

<style scoped>

</style>
