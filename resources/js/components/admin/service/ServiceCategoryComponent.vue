<template>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="title-main">
                        {{trans.get('messages.admin.serviceCategory.title')}}

                    </div>

                    <div class="card-body">
                        <div class="row pb-3">
                            <div class="col-12">
                                <button class="btn btn-primary" @click="initCreate()">
                                    <i class="fa fa-plus-square"></i>
                                    {{trans.get('messages.all.add')}}
                                </button>
                            </div>
                        </div>
                        <div>
                            <table id="users" class="table table-striped table-responsive-sm col-12">
                                <thead>
                                <tr>
                                    <th>{{trans.get('messages.admin.serviceCategory.name')}}</th>
                                    <th>{{trans.get('messages.admin.serviceCategory.description')}}</th>
                                    <th>{{trans.get('messages.admin.serviceCategory.country')}}</th>
                                    <th>{{trans.get('messages.all.order_num')}}</th>
                                    <th>{{trans.get('messages.admin.serviceCategory.show_standart_document_template')}}</th>
                                    <th>{{trans.get('messages.all.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(entity, index) in entityList.data">
                                    <td>{{entity.name}}</td>
                                    <td>{{entity.description}}</td>
                                    <td>{{entity.country_name}}</td>
                                    <td>{{entity.order_no}}</td>
                                    <td class="text-center"><i v-if="entity.is_standart_contract_template_show == 1" class="fas fa-check"></i></td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                <i class="fa fa-bars"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item"
                                                   @click="changePhoto(entity.id)">{{trans.get('messages.admin.serviceCategory.changePhoto')}}</a>
                                                <div class="dropdown-divider"></div>
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

        <div class="modal fade" tabindex="-1" role="dialog" id="set-model">
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
                                <div class="form-group">
                                    <label for="name">{{trans.get('messages.admin.serviceCategory.name')}}</label>

                                    <input :class="['form-control', form.errors.has('name') ? 'is-invalid' : '']"
                                           v-model="form.name" id="name" name="name" type="text"/>
                                    <span v-if="form.errors.has('name')" :class="['help-block invalid-feedback']">
                                        <strong v-text="form.errors.get('name')"></strong>
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label for="name_en">{{trans.get('messages.admin.serviceCategory.name_en')}}</label>

                                    <input :class="['form-control', form.errors.has('name_en') ? 'is-invalid' : '']"
                                           v-model="form.name_en" id="name_en" name="name_en" type="text"/>
                                    <span v-if="form.errors.has('name_en')" :class="['help-block invalid-feedback']">
                                        <strong v-text="form.errors.get('name_en')"></strong>
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label for="description">{{trans.get('messages.admin.serviceCategory.description')}}</label>

                                    <input :class="['form-control', form.errors.has('description') ? 'is-invalid' : '']"
                                           v-model="form.description" id="description" name="description" type="text"/>
                                    <span v-if="form.errors.has('description')" :class="['help-block invalid-feedback']">
                                        <strong v-text="form.errors.get('description')"></strong>
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label for="description_en">{{trans.get('messages.admin.serviceCategory.description_en')}}</label>

                                    <input :class="['form-control', form.errors.has('description_en') ? 'is-invalid' : '']"
                                           v-model="form.description_en" id="description_en" name="description_en" type="text"/>
                                    <span v-if="form.errors.has('description_en')" :class="['help-block invalid-feedback']">
                                        <strong v-text="form.errors.get('description_en')"></strong>
                                    </span>
                                </div>

                            </div>

                            <div class="col-6">

                                <div class="form-group">
                                    <label for="country_id">{{trans.get('messages.admin.serviceCategory.country')}}</label>
                                    <select class="form-control" id="country_id" v-model="form.country_id">
                                        <option :value="country.id" v-for="(country, index) in countryList">
                                            {{country.name}}
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="order_no">{{trans.get('messages.all.order_num')}}</label>

                                    <input :class="['form-control', form.errors.has('order_no') ? 'is-invalid' : '']"
                                           v-model="form.order_no" id="order_no" name="order_no" type="text"/>
                                    <span v-if="form.errors.has('order_no')" :class="['help-block invalid-feedback']">
                                        <strong v-text="form.errors.get('order_no')"></strong>
                                    </span>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                               :class="['custom-control-input', form.errors.has('is_standart_contract_template_show') ? 'is-invalid' : '']"
                                               id="is_standart_contract_template_show" v-model="form.is_standart_contract_template_show">
                                        <label class="custom-control-label" for="is_standart_contract_template_show">{{trans.get('messages.admin.serviceCategory.show_standart_document_template')}}</label>
                                    </div>

                                    <span v-if="form.errors.has('is_standart_contract_template_show')"
                                          :class="['help-block invalid-feedback']">
                                                <strong v-text="form.errors.get('is_standart_contract_template_show')"></strong>
                                            </span>
                                </div>
                            </div>
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

        <div class="modal fade" tabindex="-1" role="dialog" id="change-photo">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{trans.get('messages.admin.users.update_user')}}</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="file">{{trans.get('messages.admin.serviceCategory.name')}}</label>
                                <input :class="['form-control']" accept="image/*"
                                       type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">
                            {{trans.get('messages.all.cancel')}}
                        </button>
                        <button type="button" @click="uploadPhoto()" class="btn btn-primary">
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
        name: "ServiceCategoryComponent",
        data() {
            return {
                url: '/admin/vue/service_category',
                entityList: {},
                defaultEntity: {
                    id: 0,
                    name: '',
                    name_en: '',
                    description: '',
                    description_en: '',
                    country_id: null,
                    country_Name: null,
                    img: '',
                    order_no: 0,
                    is_standart_contract_template_show: false
                },
                form: new Form(this.defaultEntity),
                currentPage: 1,
                entityIdForPhoto: 0,
                countryList: this.initialCountryList,
                photo: ''
            }
        },
        props: {
            'initialCountryList': Array
        },
        mounted() {
            this.getEntityList();
        },
        methods: {
            getEntityList(page = 1) {
                this.currentPage = page;
                axios.get(this.url + '/list?page=' + page + '&withPaginate=true').then(response => {
                    this.entityList = response.data;
                });
            },
            initCreate() {
                this.form = new Form(this.defaultEntity);
                $('#set-model').modal('show');
            },
            initUpdate(index) {
                this.form = new Form(this.entityList.data[index]);
                this.form.is_standart_contract_template_show = this.form.is_standart_contract_template_show === "1";
                $('#set-model').modal('show');
            },
            set() {
                let self = this;

                let _url = this.url + "/store";
                let _message = this.trans.get('messages.admin.system.success.store');
                if (self.form.id !== 0) {
                    _url = this.url + "/update";
                    _message = this.trans.get('messages.admin.system.success.update');
                }

                self.form.post(_url)
                    .then(request => {
                        self.getEntityList(self.currentPage);
                        $('#set-model').modal('hide');

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
            changePhoto(entityId) {
                this.entityIdForPhoto = entityId;

                $('#change-photo').modal('show');
            },
            handleFileUpload() {
                this.photo = this.$refs.file.files[0];
            },
            uploadPhoto() {
                let self = this;
                let formData = new FormData();
                formData.append('photo', this.photo);

                axios.post(this.url + "/changePhoto/" + this.entityIdForPhoto,
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(function () {
                    $('#change-photo').modal('hide');

                    self.$notify({
                        group: 'all',
                        position: 'top right',
                        text: self.trans.get('messages.admin.system.success.update'),
                        type: 'success'
                    });
                });
            },
        },
    }
</script>

<style scoped>

</style>
