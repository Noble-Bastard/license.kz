<template>
    <div>

        <div class="row">
            <div class="col-12">
                <div class="row pb-3">
                    <div  class="col-12 pt-3">
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
                            <th>{{trans.get('messages.admin.registrationFormParameterTemplate.id')}}</th>
                            <th>{{trans.get('messages.admin.registrationFormParameterTemplate.caption')}}</th>
                            <th>{{trans.get('messages.admin.registrationFormParameterTemplate.parameter_type_name')}}</th>
                            <th>{{trans.get('messages.admin.registrationFormParameterTemplate.optionset_type_name')}}</th>
                            <th>{{trans.get('messages.admin.registrationFormParameterTemplate.is_active')}}</th>
                            <th>{{trans.get('messages.all.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(entity, index) in entityList">
                            <td>{{entity.id}}</td>
                            <td>{{entity.caption}}</td>
                            <td>{{entity.parameter_type_name}}</td>
                            <td>{{entity.optionset_type_name}}</td>
                            <td><i v-if="entity.is_active == 1" class="fas fa-check"></i></td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        <i class="fa fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a v-if="entity.parameter_type_id == cnstTableParameter" class="dropdown-item" @click="editTableStructure(entity.id,index)">
                                            {{trans.get('messages.admin.registrationFormParameterTemplate.editTableStructure')}}
                                        </a>
                                        <a class="dropdown-item"
                                           @click="initUpdate(index)">{{trans.get('messages.all.edit')}}
                                        </a>
                                        <a class="dropdown-item"
                                           @click="deleteEntity(entity.id, index)"
                                           data-method="delete">{{trans.get('messages.all.delete')}}
                                        </a>
                                        <a class="dropdown-item" @click="move(entity.id,1)">
                                            <i class="fas fa-arrow-up"></i> {{trans.get('messages.all.moveUp')}}
                                        </a>
                                        <a class="dropdown-item" @click="move(entity.id,2)">
                                            <i class="fas fa-arrow-down"></i> {{trans.get('messages.all.moveDown')}}
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="modal fade" tabindex="-1" role="dialog" :id="modalFormName">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" v-if="form.id === 0">{{trans.get('messages.admin.system.modal.create')}}</h4>
                        <h4 class="modal-title" v-else>{{trans.get('messages.admin.system.modal.update')}}</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" @change="form.errors.clear($event.target.name)"
                         @keydown="form.errors.clear($event.target.name)">

                        <div class="form-group">
                            <label for="caption">{{trans.get('messages.admin.registrationFormParameterTemplate.caption')}}</label>

                            <input :class="['form-control', form.errors.has('caption') ? 'is-invalid' : '']"
                                   v-model="form.caption" id="caption" name="caption" type="text"/>
                            <span v-if="form.errors.has('caption')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('caption')"></strong>
                            </span>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox"
                                       :class="['custom-control-input', form.errors.has('is_active') ? 'is-invalid' : '']"
                                       :id="'is_active_' + form.id"
                                       v-model="form.is_active">
                                <label class="custom-control-label" :for="'is_active_' + form.id">{{trans.get('messages.admin.registrationFormParameterTemplate.is_active')}}</label>
                            </div>

                            <span v-if="form.errors.has('is_active')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('is_active')"></strong>
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="parameter_type_id">{{trans.get('messages.admin.registrationFormParameterTemplate.parameter_type_name')}}</label>

                            <select :class="['form-control', form.errors.has('parameter_type_id') ? 'is-invalid' : '']"
                                    id="parameter_type_id" name="parameter_type_id" v-model="form.parameter_type_id" @change="onParameterTypeChange">
                                <option v-for="(value, key) in parameterTypeList" :value="value.id">
                                    {{value.name}}
                                </option>
                            </select>
                            <span v-if="form.errors.has('parameter_type_id')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('parameter_type_id')"></strong>
                            </span>
                        </div>

                        <div v-if="form.parameter_type_id == cnstOptionsetParameter" class="form-group">
                            <label for="optionset_type_id">{{trans.get('messages.admin.registrationFormParameterTemplate.optionset_type_name')}}</label>

                            <select :class="['form-control', form.errors.has('optionset_type_id') ? 'is-invalid' : '']"
                                    id="optionset_type_id" name="optionset_type_id" v-model="form.optionset_type_id">
                                <option v-for="(value, key) in optionsetTypeList" :value="value.id">
                                    {{value.name}}
                                </option>
                            </select>
                            <span v-if="form.errors.has('optionset_type_id')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('optionset_type_id')"></strong>
                            </span>
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
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


        <div class="modal fade" tabindex="-1" role="dialog" :id="tableStructureModalFormName" aria-hidden="true">
            <div class="modal-dialog modal-full" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" v-text="trans.get('messages.admin.registrationFormParameterTemplateTableStructure.title') + ': ' + form.caption"></h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <registration-form-parameter-template-table-structure :key="tableStructureComponentKey"
                            :initial-table-parameter-id="form.id == null ? 0 : form.id"
                            :initial-optionset-type-list="initialOptionsetTypeList"
                            :initial-parameter-type-list="initialParameterTypeList">
                        </registration-form-parameter-template-table-structure>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">
                            {{trans.get('messages.all.close')}}
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </div>
</template>

<script>

    import RegistrationFormParameterTemplateTableStructureComponent
        from "./RegistrationFormParameterTemplateTableStructureComponent";
    export default {
        name: "RegistrationFormParameterTemplateListComponent",
        components: {RegistrationFormParameterTemplateTableStructureComponent},
        data() {
            return {
                rfptUrl: '/admin/vue/registration_form_parameter_template',
                entityList: null,
                defaultEntity: {
                    id: null,
                    registration_form_group_template_id: this.initialRegistrationFormGroupTemplateId,
                    parameter_type_id: null,
                    optionset_type_id: null,
                    caption: "",
                    is_active: true,
                    order_number: null,
                },
                form: new Form(this.defaultEntity),
                optionsetTypeList: this.initialOptionsetTypeList,
                parameterTypeList: this.initialParameterTypeList,
                msgSuccessStore: this.trans.get('messages.admin.system.success.store'),
                msgSuccessUpdate: this.trans.get('messages.admin.system.success.update'),
                msgSuccessDelete: this.trans.get('messages.admin.system.success.delete'),
                cnstTableParameter: 6,
                cnstOptionsetParameter: 5,
                tableStructureComponentKey: 0
            }
        },
        props: {
            'initialRegistrationFormGroupTemplateId': Number,
            'initialParameterTypeList': Array,
            'initialOptionsetTypeList': Array
        },
        mounted() {
            this.getEntityList();
        },
        computed: {
            modalFormName: function(){
                return ('set-registration-form-parameter-template-modal-' + this.initialRegistrationFormGroupTemplateId);
            },
            tableStructureModalFormName: function(){
                return ('edit-parameter-table-structure-modal-' + this.initialRegistrationFormGroupTemplateId);
            },
        },
        methods: {
            getEntityList() {
                let requestUrl = this.rfptUrl + '/list/'+this.initialRegistrationFormGroupTemplateId;

                axios.get(requestUrl).then(response => {
                    this.entityList = response.data;
                });
            },
            initCreate() {
                this.form = new Form(this.defaultEntity);
                $('#' + this.modalFormName).modal('show');
            },
            initUpdate(index) {
                this.form = new Form(this.entityList[index]);
                this.form.is_active = this.form.is_active == 1;
                $('#' + this.modalFormName).modal('show');
            },
            onParameterTypeChange(){
                if(this.form.parameter_type_id != this.cnstOptionsetParameter)
                {
                    this.form.optionset_type_id = null;
                }
            },
            set() {
                let self = this;
                let requestUrl = this.rfptUrl + "/store";
                let requestSuccessMessage = (self.form.id !== 0) ? this.msgSuccessUpdate : this.msgSuccessStore;

                self.form.post(requestUrl)
                    .then(request => {
                        self.getEntityList();
                        $('#' + this.modalFormName).modal('hide');

                        self.$notify({
                            group: 'all',
                            position: 'top right',
                            text: requestSuccessMessage,
                            type: 'success'
                        });
                    });
            },
            editTableStructure(entityId, index) {
                this.form = new Form(this.entityList[index]);
                this.tableStructureComponentKey++;
                $('#'+this.tableStructureModalFormName).modal('show');
            },
            deleteEntity(entityId, index) {
                axios.post(this.rfptUrl + "/delete", {
                    entityId: entityId
                })
                    .then(request => {
                        this.entityList.splice(index, 1);

                        self.$notify({
                            group: 'all',
                            position: 'top right',
                            text: this.trans.get('messages.admin.system.success.delete'),
                            type: 'success'
                        });
                    });
            },
            move(entityId, moveType){
                let requestUrl = this.rfptUrl
                    + '/move?registrationFormParameterTemplateId='+ entityId
                    + '&moveType=' + moveType;


                axios.get(requestUrl).then(response => {
                    this.getEntityList();

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
