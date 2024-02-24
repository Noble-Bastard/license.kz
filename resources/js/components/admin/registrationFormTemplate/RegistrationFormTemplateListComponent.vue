<template>
    <div>
        <div class="title-main">
            {{trans.get('messages.admin.registrationFormTemplate.title')}}

        </div>

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
                                    <th>{{trans.get('messages.admin.registrationFormTemplate.id')}}</th>
                                    <th>{{trans.get('messages.admin.registrationFormTemplate.name')}}</th>
                                    <th>{{trans.get('messages.admin.registrationFormTemplate.counterTypeName')}}</th>
                                    <th>{{trans.get('messages.all.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(entity, index) in entityList.data">
                                    <td>{{entity.id}}</td>
                                    <td>{{entity.name}}</td>
                                    <td>{{entity.counter_type_name}}</td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                <i class="fa fa-bars"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item"
                                                   @click="openRegistrationFormTemplateCard(entity.id)">{{trans.get('messages.admin.registrationFormTemplate.openCard')}}
                                                </a>
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

        <div class="modal fade" tabindex="-1" role="dialog" id="set-optionset-type-model">
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
                            <label for="name">{{trans.get('messages.admin.registrationFormTemplate.name')}}</label>

                            <input :class="['form-control', form.errors.has('name') ? 'is-invalid' : '']"
                                   v-model="form.name" id="name" name="name" type="text"/>
                            <span v-if="form.errors.has('name')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('name')"></strong>
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="counter_type_id">{{trans.get('messages.admin.registrationFormTemplate.counterTypeName')}}</label>

                            <select :class="['form-control', form.errors.has('counter_type_id') ? 'is-invalid' : '']"
                                    id="counter_type_id" name="counter_type_id" v-model="form.counter_type_id">
                                <option v-for="(value, key) in counterTypeList" :value="value.id">{{value.name}}
                                </option>
                            </select>
                            <span v-if="form.errors.has('counter_type_id')"
                                  :class="['help-block invalid-feedback']">
                                            <strong v-text="form.errors.get('counter_type_id')"></strong>
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
        name: "RegistrationFormTemplateListComponent",
        data() {
            return {
                url: '/admin/vue/registration_form_template',
                card_url: '/admin/registration_form_template/show',
                entityList: {},
                currentPage: 1,
                defaultEntity: {
                    id: null,
                    name: '',
                    counter_type_id: null,
                    counter_type_name: "",
                },
                form: new Form(this.defaultEntity),
                optionsetValueTemplateListComponentKey: 0,
                counterTypeList: this.initialCounterTypeList
            }
        },
        props: {
            'initialCounterTypeList': Array
        },
        mounted() {
            this.getEntityList();
        },
        methods: {
            getEntityList(page = 1) {
                this.currentPage = page;
                let serviceUrl = this.url + '/list?'
                    + 'page=' + page;

                axios.get(serviceUrl).then(response => {
                    this.entityList = response.data;
                });
            },
            initCreate() {
                this.form = new Form(this.defaultEntity);
                $('#set-optionset-type-model').modal('show');
            },
            initUpdate(index) {
                this.form = new Form(this.entityList.data[index]);

                $('#set-optionset-type-model').modal('show');
            },
            editOptionsetValues(entityId, index) {
                this.optionsetValueTemplateListComponentKey++;
                this.form = new Form(this.entityList.data[index]);
                $('#edit-optionset-value-template').modal('show');
            },
            set() {
                let self = this;
                let _url = this.url + "/store";
                let _message = this.trans.get('messages.admin.system.success.store');
                if (self.form.id !== 0) {
                    _message = this.trans.get('messages.admin.system.success.update');
                }

                self.form.post(_url)
                    .then(request => {
                        self.getEntityList(self.currentPage);
                        $('#set-optionset-type-model').modal('hide');

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
            openRegistrationFormTemplateCard(registrationFormTemplateId){
                window.location.href = this.card_url + '/' + registrationFormTemplateId;
            },
        },
    }
</script>

<style scoped>

</style>
