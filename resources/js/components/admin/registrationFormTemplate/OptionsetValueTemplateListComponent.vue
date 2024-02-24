<template>
    <div>

        <div class="card">
            <div class="card-body">
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
                                    <th>{{trans.get('messages.admin.registrationFormTemplate.optionsetValueTemplate.id')}}</th>
                                    <th>{{trans.get('messages.admin.registrationFormTemplate.optionsetValueTemplate.optionsetId')}}</th>
                                    <th>{{trans.get('messages.admin.registrationFormTemplate.optionsetValueTemplate.optionsetValue')}}</th>
                                    <th>{{trans.get('messages.admin.registrationFormTemplate.optionsetValueTemplate.isDefault')}}</th>
                                    <th>{{trans.get('messages.all.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(entity, index) in entityList.data">
                                    <td>{{entity.id}}</td>
                                    <td>{{entity.optionset_id}}</td>
                                    <td>{{entity.optionset_value}}</td>
                                    <td><i v-if="entity.is_default == 1" class="fas fa-check"></i></td>
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
                            <div class="row padding-t-15">
                                <div class="col-12">
                                    <pagination class="float-right" :data="entityList"
                                                @pagination-change-page="getEntityList"></pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="set-optionset-value-template-model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" v-if="form.id === null">{{trans.get('messages.admin.system.modal.create')}}</h4>
                        <h4 class="modal-title" v-else>{{trans.get('messages.admin.system.modal.update')}}</h4>
                        <button type="button" class="close" @click="hideSetOptionsetValueTemplateModal()" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body" @change="form.errors.clear($event.target.name)"
                         @keydown="form.errors.clear($event.target.name)">
                        <div class="form-group">
                            <label for="optionset_value">{{trans.get('messages.admin.registrationFormTemplate.optionsetValueTemplate.optionsetValue')}}</label>

                            <input :class="['form-control', form.errors.has('optionset_value') ? 'is-invalid' : '']"
                                   v-model="form.optionset_value" id="optionset_value" name="optionset_value" type="text"/>
                            <span v-if="form.errors.has('optionset_value')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('optionset_value')"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox"
                                       :class="['custom-control-input', form.errors.has('is_default') ? 'is-invalid' : '']"
                                       id="is_default"
                                       v-model="form.is_default">
                                <label class="custom-control-label" for="is_default">{{trans.get('messages.admin.registrationFormTemplate.optionsetValueTemplate.isDefault')}}</label>
                            </div>

                            <span v-if="form.errors.has('is_default')"
                                  :class="['help-block invalid-feedback']">
                                        <strong v-text="form.errors.get('is_default')"></strong>
                                    </span>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" @click="hideSetOptionsetValueTemplateModal()">
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
        name: "OptionsetValueTemplateListComponent",
        props: {
            'initialOptionsetTypeId': Number
        },
        data() {
            return {
                url: '/admin/vue/registration_form_template/optionset_value_template',
                entityList: {},
                currentPage: 1,
                defaultEntity: {
                    id: null,
                    optionset_value: '',
                    optionset_type_id: this.initialOptionsetTypeId,
                    is_default: false,
                    optionset_id: 0
                },
                form: new Form(this.defaultEntity),
                optionsetTypeId: this.initialOptionsetTypeId
            }
        },
        mounted() {
            this.getEntityList();
        },
        methods: {
            getEntityList(page = 1) {
                this.currentPage = page;
                let serviceUrl = this.url + '/list?'
                    + 'page=' + page
                    + '&optionset_type_id=' + this.optionsetTypeId;

                axios.get(serviceUrl).then(response => {
                    this.entityList = response.data;
                });
            },
            initCreate() {
                this.form = new Form(this.defaultEntity);
                $('#set-optionset-value-template-model').modal('show');
            },
            initUpdate(index) {
                this.form = new Form(this.entityList.data[index]);
                this.form.is_default = this.form.is_default == 1;
                $('#set-optionset-value-template-model').modal('show');
            },
            set() {
                let self = this;
                let _url = this.url + "/store";
                let _message = this.trans.get('messages.admin.system.success.store');
                if (self.form.id !== null) {
                    _message = this.trans.get('messages.admin.system.success.update');
                }

                self.form.post(_url)
                    .then(request => {
                        self.getEntityList(self.currentPage);
                        $('#set-optionset-value-template-model').modal('hide');

                        self.$notify({
                            group: 'all',
                            position: 'top right',
                            text: _message,
                            type: 'success'
                        });
                    });
            },
            deleteEntity(entityId, index) {
                axios.post(this.url + "/delete", {
                    entityId: entityId
                })
                    .then(request => {
                        this.entityList.data.splice(index, 1);

                        self.$notify({
                            group: 'all',
                            position: 'top right',
                            text: this.trans.get('messages.admin.system.success.delete'),
                            type: 'success'
                        });
                    });
            },
            hideSetOptionsetValueTemplateModal(){
                $('#set-optionset-value-template-model').modal('hide');
            },
        },
    }
</script>

<style scoped>

</style>