<template>
    <div>
        <div class="title-main">
            {{this.registrationFormTemplate.name}}

        </div>

        <div id="accordionFormGroupTemplate">
            <div class="col-12">

                <div class="row pb-3">
                    <div  class="col-12 pt-3">
                        <button class="btn btn-primary" @click="initCreate()">
                            <i class="fa fa-plus-square"></i>
                            {{trans.get('messages.all.add')}}
                        </button>
                    </div>
                </div>

                <div class="card" v-for="(entity, index) in registrationFormGroupTemplateList">
                    <div class="card-header">

                        <a class="btn btn-link"   data-toggle="collapse" :href="'#collapse' + entity.id">
                            {{entity.parameter_group_name}}
                        </a>


                        <div class="dropdown float-right">
                            <button class="btn btn-primary dropdown-toggle" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                <i class="fa fa-bars"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" @click="deleteEntity(entity.id, index)" data-method="delete">
                                    {{trans.get('messages.all.delete')}}
                                </a>
                                <a class="dropdown-item" @click="move(entity.id,1)">
                                    <i class="fas fa-arrow-up"></i> {{trans.get('messages.all.moveUp')}}
                                </a>
                                <a class="dropdown-item" @click="move(entity.id,2)">
                                    <i class="fas fa-arrow-down"></i> {{trans.get('messages.all.moveDown')}}
                                </a>
                            </div>
                        </div>


                    </div>
                    <div :id="'collapse' + entity.id" class="collapse show" data-parent="#accordionFormGroupTemplate">
                        <div class="card-body">
                            <registration-form-parameter-template-list-component
                                    :initial-registration-form-group-template-id="entity.id"
                                    :initial-optionset-type-list="initialOptionsetTypeList"
                                    :initial-parameter-type-list="initialParameterTypeList">
                            </registration-form-parameter-template-list-component>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" tabindex="-1" role="dialog" id="set-registration-form-group-template-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" v-if="formRFGT.id === 0">{{trans.get('messages.admin.system.modal.create')}}</h4>
                        <h4 class="modal-title" v-else>{{trans.get('messages.admin.system.modal.update')}}</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" @change="formRFGT.errors.clear($event.target.name)"
                         @keydown="formRFGT.errors.clear($event.target.name)">

                        <div class="form-group">
                            <label for="parameter_group_id">{{trans.get('messages.admin.registrationFormGroupTemplate.parameterGroupName')}}</label>
                            <select :class="['form-control', formRFGT.errors.has('parameter_group_id') ? 'is-invalid' : '']"
                                    id="parameter_group_id" name="parameter_group_id" v-model="formRFGT.parameter_group_id">
                                <option v-for="(item, key) in parameterGroupList" :value="item.id">{{item.name}}
                                </option>
                            </select>
                            <span v-if="formRFGT.errors.has('parameter_group_id')" :class="['help-block invalid-feedback']">
                                <strong v-text="formRFGT.errors.get('parameter_group_id')"></strong>
                            </span>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">
                            {{trans.get('messages.all.cancel')}}
                        </button>
                        <button type="button" @click="set()" :disabled="formRFGT.errors.any()" class="btn btn-primary">
                            {{trans.get('messages.all.submit')}}
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </div>
</template>

<script>

    import RegistrationFormParameterTemplateListComponent from "./RegistrationFormParameterTemplateListComponent";
    export default {
        name: "RegistrationFormTemplateCardComponent",
        components: {RegistrationFormParameterTemplateListComponent},
        data() {
            return {
                urlRegistrationFormGroupTemplate: '/admin/vue/registration_form_group_template',
                registrationFormTemplate: this.initialRegistrationFormTemplate,
                registrationFormGroupTemplateList: {},
                parameterGroupList: {},
                defaultRegistrationFormGroupTemplateEntity: {
                    id: null,
                    registration_form_template_id: this.initialRegistrationFormTemplate.id,
                    parameter_group_id: null,
                    order_number: "",
                },
                formRFGT: new Form(this.defaultRegistrationFormGroupTemplateEntity),
                msgSuccessStore: this.trans.get('messages.admin.system.success.store'),
                msgSuccessUpdate: this.trans.get('messages.admin.system.success.update'),
                msgSuccessDelete: this.trans.get('messages.admin.system.success.delete'),
            }
        },
        props: {
            'initialRegistrationFormTemplate': Object,
            'initialParameterTypeList': Array,
            'initialOptionsetTypeList': Array,
        },
        mounted() {
            this.getRegistrationFromGroupTemplateList();
        },
        methods: {
            initCreate() {
                this.getParameterGroupList();
                this.formRFGT = new Form(this.defaultRegistrationFormGroupTemplateEntity);
                $('#set-registration-form-group-template-modal').modal('show');
            },
            deleteEntity(entityId, index) {
                axios.post(this.urlRegistrationFormGroupTemplate + "/delete", {
                    entityId: entityId
                })
                    .then(request => {
                        this.registrationFormGroupTemplateList.splice(index, 1);

                        self.$notify({
                            group: 'all',
                            position: 'top right',
                            text: this.msgSuccessDelete,
                            type: 'success'
                        });
                    });
            },
            set() {
                let self = this;
                let requestUrl = this.urlRegistrationFormGroupTemplate + "/store";
                let requestSuccessMessage = (self.formRFGT.id !== 0) ? this.msgSuccessUpdate : this.msgSuccessStore;

                self.formRFGT.post(requestUrl)
                    .then(request => {
                        self.getRegistrationFromGroupTemplateList();
                        $('#set-registration-form-group-template-modal').modal('hide');
                        self.$notify({
                            group: 'all',
                            position: 'top right',
                            text: requestSuccessMessage,
                            type: 'success'
                        });
                    });
            },
            getRegistrationFromGroupTemplateList() {
                let requestUrl = this.urlRegistrationFormGroupTemplate
                    + '/list?registrationFormTemplateId='+ this.registrationFormTemplate.id;

                axios.get(requestUrl).then(response => {
                    this.registrationFormGroupTemplateList = response.data;
                });
            },
            getParameterGroupList(){
                let requestUrl = this.urlRegistrationFormGroupTemplate
                    + '/parameterGroupList/' + this.registrationFormTemplate.id;
                axios.get(requestUrl).then(response => {
                    this.parameterGroupList =  response.data;
                });

            },
            move(entityId, moveType){
                let requestUrl = this.urlRegistrationFormGroupTemplate
                    + '/move?registrationFormGroupTemplateId='+ entityId
                    + '&moveType=' + moveType;


                axios.get(requestUrl).then(response => {
                    this.getRegistrationFromGroupTemplateList();

                    this.$notify({
                        group: 'all',
                        position: 'top right',
                        text: this.msgSuccessUpdate,
                        type: 'success'
                    });

                });
            },
        },
    }
</script>

<style scoped>

</style>
