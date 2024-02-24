<template>
    <div>

        <div class="row">
            <div class="col-12">
                <div class="row pb-3">
                    <div class="col-3">
                        <label for="country_id">{{trans.get('messages.company.standartContractTemplate.country_name')}}</label>
                        <select class="form-control" id="country_id" @change="onCountryChange()" v-model="selectedCountryId">
                            <option :value="country.id" v-for="(country, index) in countryList">
                                {{country.name}}
                            </option>
                        </select>
                    </div>
                </div>
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
                            <th>{{trans.get('messages.company.standartContractTemplate.id')}}</th>
                            <th>{{trans.get('messages.company.standartContractTemplate.name')}}</th>
                            <th>{{trans.get('messages.company.standartContractTemplate.friendly_name')}}</th>
                            <th>{{trans.get('messages.company.standartContractTemplate.standart_contract_template_type_name')}}</th>
                            <th>{{trans.get('messages.all.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(entity, index) in entityList">
                            <td>{{entity.id}}</td>
                            <td>{{entity.name}}</td>
                            <td>{{entity.friendly_name}}</td>
                            <td>{{entity.standart_contract_template_type_name}}</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        <i class="fa fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item"
                                           @click="deleteEntity(entity.id, index)"
                                           data-method="delete">{{trans.get('messages.all.delete')}}</a>
                                        <a class="dropdown-item"
                                           @click="downloadFile(entity.id, index)"
                                           >{{trans.get('messages.all.downloadFile')}}
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


        <div class="modal fade" tabindex="-1" role="dialog" :id="standartContractTemplateModalName">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" v-if="form.id === null">{{trans.get('messages.admin.system.modal.create')}}</h4>
                        <h4 class="modal-title" v-else>{{trans.get('messages.admin.system.modal.update')}}</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" @change="form.errors.clear($event.target.name)"
                         @keydown="form.errors.clear($event.target.name)">

                        <div class="form-group">
                            <label for="file">{{trans.get('messages.company.standartContractTemplate.file')}}</label>
                            <input ref="file" :class="['form-control', form.errors.has('file') ? 'is-invalid' : '']"
                                    id="file" name="file" type="file" @change="onFileSelect()"/>
                            <span v-if="form.errors.has('file')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('file')"></strong>
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="friendly_name">{{trans.get('messages.company.standartContractTemplate.friendly_name')}}</label>

                            <input :class="['form-control', form.errors.has('friendly_name') ? 'is-invalid' : '']"
                                   v-model="form.friendly_name" id="friendly_name" name="friendly_name" type="text"/>
                            <span v-if="form.errors.has('friendly_name')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('friendly_name')"></strong>
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="standart_contract_template_type_id">{{trans.get('messages.company.standartContractTemplate.standart_contract_template_type_name')}}</label>
                            <select :class="['form-control', form.errors.has('standart_contract_template_type_id') ? 'is-invalid' : '']"
                                    id="standart_contract_template_type_id" name="standart_contract_template_type_id" v-model="form.standart_contract_template_type_id">
                                <option v-for="(value, key) in standartContractTemplateTypeList" :value="value.id">
                                    {{value.name}}
                                </option>
                            </select>
                            <span v-if="form.errors.has('standart_contract_template_type_id')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('standart_contract_template_type_id')"></strong>
                            </span>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">
                            {{trans.get('messages.all.cancel')}}
                        </button>
                        <button type="button" @click="set()" :disabled="form.errorsOrSend()" class="btn btn-primary">
                            {{trans.get('messages.all.upload')}}
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


    </div>
</template>

<script>

    export default {
        name: "StandartContractTemplateListComponent",
        data() {
            return {
                urlStandartContractTemplate: '/company/vue/standart_contract_template',
                entityList: null,
                defaultEntity: {
                    id: null,
                    name: null,
                    friendly_name: null,
                    path: null,
                    country_id: null,
                    standart_contract_template_type_id: "",
                    file: "",
                },
                form: new Form(this.defaultEntity),
                standartContractTemplateTypeList: this.initialStandartContractTemplateTypeList,
                countryList: this.initialCountryList,
                msgSuccessStore: this.trans.get('messages.admin.system.success.store'),
                msgSuccessUpdate: this.trans.get('messages.admin.system.success.update'),
                msgSuccessDelete: this.trans.get('messages.admin.system.success.delete'),
                selectedCountryId: this.initialCountryList[0].id
            }
        },
        props: {
            'initialStandartContractTemplateTypeList': Array,
            'initialCountryList': Array
        },
        mounted() {
            this.getEntityList();
        },
        computed: {
            standartContractTemplateModalName: function(){
                return ('set-standart-contract-template-modal');
            },
            fileErrorExist: function(){
                return (this.form.errors.has('file'));
            },
        },
        methods: {
            getEntityList() {
                let requestUrl = this.urlStandartContractTemplate + '/list'
                    + '?countryId=' + this.selectedCountryId;

                axios.get(requestUrl).then(response => {
                    this.entityList = response.data;
                });
            },
            initCreate() {
                let formData = new Form(this.defaultEntity);
                formData.country_id = this.selectedCountryId;
                formData.file = "";
                $('#file').val('');
                this.form = new Form(formData);

                $('#' + this.standartContractTemplateModalName).modal('show');
            },
            initUpload(index) {
                let formData = this.entityList[index];
                formData.country_id = this.selectedCountryId;
                formData.file = "";
                $('#file').val('');
                this.form = new Form(formData);
                $('#' + this.standartContractTemplateModalName).modal('show');
            },
            set() {
                let requestUrl = this.urlStandartContractTemplate + "/store";
                let requestSuccessMessage = (this.form.id !== 0) ? this.msgSuccessUpdate : this.msgSuccessStore;

                this.form.postMultipart(requestUrl)
                    .then(request => {
                        this.getEntityList();
                        $('#' + this.standartContractTemplateModalName).modal('hide');

                        this.$notify({
                            group: 'all',
                            position: 'top right',
                            text: requestSuccessMessage,
                            type: 'success'
                        });
                    });
            },
            downloadFile(entityId, index) {
                let requestUrl = this.urlStandartContractTemplate + "/download"
                    + '?entityId=' + entityId;
                window.open(requestUrl);
            },
            deleteEntity(entityId, index) {
                axios.post(this.urlStandartContractTemplate + "/delete", {
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
            onCountryChange(){
                this.getEntityList();
            },
            onFileSelect(){
                if(this.form.errors.has('file')){
                    this.form.errors.clear('file');
                    this.form.resetErrors();
                }
                this.form.file = this.$refs.file.files[0];
            }
        },
    }
</script>

<style scoped>

</style>
