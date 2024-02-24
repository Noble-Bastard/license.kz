<template>
    <div>

        <div class="row">
            <div class="col-12">
                <div class="row pb-3">
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
                            <th>{{trans.get('messages.company.standartContractTemplateType.id')}}</th>
                            <th>{{trans.get('messages.company.standartContractTemplateType.name')}}</th>
                            <th>{{trans.get('messages.all.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(entity, index) in entityList">
                            <td>{{entity.id}}</td>
                            <td>{{entity.name}}</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        <i class="fa fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-la belledby="dropdownMenuButton">
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


        <div class="modal fade" tabindex="-1" role="dialog" :id="entityModalName">
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
                            <label for="name">{{trans.get('messages.company.standartContractTemplateType.name')}}</label>

                            <input :class="['form-control', form.errors.has('name') ? 'is-invalid' : '']"
                                   v-model="form.name" id="name" name="name" type="text"/>
                            <span v-if="form.errors.has('name')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('name')"></strong>
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="name_en">{{trans.get('messages.company.standartContractTemplateType.name_en')}}</label>

                            <input :class="['form-control', form.errors.has('name_en') ? 'is-invalid' : '']"
                                   v-model="form.name_en" id="name_en" name="name_en" type="text"/>
                            <span v-if="form.errors.has('name_en')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('name_en')"></strong>
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


    </div>
</template>

<script>
    export default {
        name: "StandartContractTemplateTypeListComponent",
        data() {
            return {
                urlStandartContractTemplateType: '/company/vue/standart_contract_template_type',
                entityList: null,
                defaultEntity: {
                    id: null,
                    name: null,
                    name_en: null,
                },
                form: new Form(this.defaultEntity),
                msgSuccessStore: this.trans.get('messages.admin.system.success.store'),
                msgSuccessUpdate: this.trans.get('messages.admin.system.success.update'),
                msgSuccessDelete: this.trans.get('messages.admin.system.success.delete')
            }
        },
        mounted() {
            this.getEntityList();
        },
        computed: {
            entityModalName: function(){
                return ('set-standart-contract-template-type-modal');
            },
        },
        methods: {
            getEntityList() {
                let requestUrl = this.urlStandartContractTemplateType + '/list';
                axios.get(requestUrl).then(response => {
                    this.entityList = response.data;
                });
            },
            initCreate() {
                this.form = new Form(this.defaultEntity);
                $('#' + this.entityModalName).modal('show');
            },
            initUpdate(index) {
                this.form = new Form(this.entityList[index]);
                $('#' + this.entityModalName).modal('show');
            },
            set() {
                let requestUrl = this.urlStandartContractTemplateType + "/store";
                let requestSuccessMessage = (this.form.id !== 0) ? this.msgSuccessUpdate : this.msgSuccessStore;

                this.form.postMultipart(requestUrl)
                    .then(request => {
                        this.getEntityList();
                        $('#' + this.entityModalName).modal('hide');

                        this.$notify({
                            group: 'all',
                            position: 'top right',
                            text: requestSuccessMessage,
                            type: 'success'
                        });
                    });
            },
            deleteEntity(entityId, index) {
                axios.post(this.urlStandartContractTemplateType + "/delete", {
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
        },
    }
</script>

<style scoped>

</style>
