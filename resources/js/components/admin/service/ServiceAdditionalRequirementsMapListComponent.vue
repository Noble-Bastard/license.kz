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
                                    <td>{{trans.get('messages.admin.service.service_additional_requirements.type')}}</td>
                                    <td>{{trans.get('messages.admin.service.service_additional_requirements.value')}}</td>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(entity, index) in entityList">
                                    <td>{{entity.service_additional_requirements.service_additional_requirements_type.name}}</td>
                                    <td>{{entity.service_additional_requirements.description}}</td>

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

        <div class="modal fade" role="dialog" id="set-model-additional-requirements">
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
                                        :p-caption="trans.get('messages.admin.service.service_additional_requirements.type')"
                                        p-field-name="service_additional_requirements_type_id"
                                        :p-form="form"
                                        :p-type="componentType.Select2"
                                        :p-dict-list="serviceAdditionalRequirementsTypeList"
                                        p-dict-val-name="name"
                                />
                            </div>
                            <div class="col-6">
                                <form-group
                                        :p-caption="trans.get('messages.admin.service.service_additional_requirements.value')"
                                        p-field-name="service_additional_requirements_id"
                                        :p-form="form"
                                        :p-type="componentType.Select2"
                                        :p-dict-list="getServiceAdditionalRequirements()"
                                        p-dict-val-name="description"
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
        name: "ServiceAdditionalRequirementsMapListComponent",
        props: {
            'initialServiceId': Number
        },
        data() {
            return {
                url: '/admin/vue/service_additional_requirements_map',
                entityList: [],
                serviceAdditionalRequirementsTypeList: [],
                serviceAdditionalRequirementsList: [],

                serviceStepList: [],
                defaultEntity: {
                    id: 0,
                    service_id: this.serviceId,
                    service_additional_requirements_type_id: null,
                    service_additional_requirements_id: null
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
                        this.entityList = response.data.serviceAdditionalRequirementsMapList;
                        this.serviceAdditionalRequirementsTypeList = response.data.serviceAdditionalRequirementsTypeList;
                        this.serviceAdditionalRequirementsList = response.data.serviceAdditionalRequirementsList;
                    });
                }
            },
            initCreate() {
                this.form = new Form(this.defaultEntity);
                $('#set-model-additional-requirements').modal('show');
            },
            initUpdate(index) {
                let entity = this.entityList[index];
                this.form = new Form({
                    id: entity.id,
                    service_id: this.serviceId,
                    service_additional_requirements_type_id: entity.service_additional_requirements.service_additional_requirements_type_id,
                    service_additional_requirements_id: entity.service_additional_requirements.id
                });
                $('#set-model-additional-requirements').modal('show');
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
                    $('#set-model-additional-requirements').modal('hide');
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
            getServiceAdditionalRequirements(){
                return this.serviceAdditionalRequirementsList.filter(sar => sar.service_additional_requirements_type_id === this.form.service_additional_requirements_type_id);
            }
        }
    }
</script>

<style scoped>

</style>
