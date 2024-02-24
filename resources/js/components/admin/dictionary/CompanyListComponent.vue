<template>
    <div>
        <div class="title-main">
            {{trans.get('messages.admin.dictionary.company.title')}}

        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">

                        <div class="row pb-3">
                            <div class="col-3">
                                <label for="country_id">{{trans.get('messages.admin.serviceList.countryFilter')}}</label>
                                <select class="form-control" id="country_id" @change="onCountryChange()"
                                        v-model="selectedCountryId">
                                    <option :value="country.id" v-for="(country, index) in countryList">
                                        {{country.name}}
                                    </option>
                                </select>
                            </div>
                            <div class="col-9">
                                <button :disabled="isAddCityDisabled" class="btn btn-primary float-right" @click="initCreate()">
                                    <i class="fa fa-plus-square"></i>
                                    {{trans.get('messages.all.add')}}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-3">
                        <table class="table table-striped table-responsive-sm col-12">
                            <thead>
                            <tr>
                                <th>{{trans.get('messages.admin.dictionary.company.city_name')}}</th>
                                <th>{{trans.get('messages.admin.dictionary.company.name')}}</th>
                                <th>{{trans.get('messages.admin.dictionary.company.address')}}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(entity, index) in entityList">
                                <td>{{entity.city.value}}</td>
                                <td>{{entity.name}}</td>
                                <td>{{entity.address}}</td>

                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                            <i class="fa fa-bars"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item"
                                               @click="changePhoto(entity.id)">{{trans.get('messages.admin.dictionary.company.changePhoto')}}</a>
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
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" role="dialog" id="set-model">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" v-if="form.id === null">{{trans.get('messages.admin.system.modal.create')}}</h4>
                        <h4 class="modal-title" v-else>{{trans.get('messages.admin.system.modal.update')}}</h4>
                        <button type="button" class="close" @click="hideModal()" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body" @change="form.errors.clear($event.target.name)"
                         @keydown="form.errors.clear($event.target.name)">

                        <div class="row">
                            <div class="col-6">
                                <label for="city_id">{{trans.get('messages.admin.dictionary.company.city_name')}}</label>
                                <select :class="['form-control', form.errors.has('city_id') ? 'is-invalid' : '']" id="city_id" v-model="form.city_id">
                                    <option :value="city.id" v-for="(city, index) in cityList">
                                        {{city.value}}
                                    </option>
                                </select>
                                <span v-if="form.errors.has('city_id')" :class="['help-block invalid-feedback']">
                                    <strong v-text="form.errors.get('city_id')"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="name">{{trans.get('messages.admin.dictionary.company.name')}}</label>

                                <input :class="['form-control', form.errors.has('name') ? 'is-invalid' : '']"
                                       v-model="form.name" id="name" name="name"/>
                                <span v-if="form.errors.has('name')" :class="['help-block invalid-feedback']">
                                    <strong v-text="form.errors.get('name')"></strong>
                                </span>
                            </div>
                            <div class="col-6">
                                <label for="name_en">{{trans.get('messages.admin.dictionary.company.name_en')}}</label>

                                <input :class="['form-control', form.errors.has('name_en') ? 'is-invalid' : '']"
                                       v-model="form.name_en" id="name_en" name="name"/>
                                <span v-if="form.errors.has('name_en')" :class="['help-block invalid-feedback']">
                                    <strong v-text="form.errors.get('name_en')"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="address">{{trans.get('messages.admin.dictionary.company.address')}}</label>

                                <input :class="['form-control', form.errors.has('address') ? 'is-invalid' : '']"
                                       v-model="form.address" id="address" name="address"/>
                                <span v-if="form.errors.has('address')" :class="['help-block invalid-feedback']">
                                    <strong v-text="form.errors.get('address')"></strong>
                                </span>
                            </div>
                            <div class="col-12">
                                <label for="address_en">{{trans.get('messages.admin.dictionary.company.address_en')}}</label>

                                <input :class="['form-control', form.errors.has('address_en') ? 'is-invalid' : '']"
                                       v-model="form.address_en" id="address_en" name="address_en"/>
                                <span v-if="form.errors.has('address_en')" :class="['help-block invalid-feedback']">
                                    <strong v-text="form.errors.get('address_en')"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="phone">{{trans.get('messages.admin.dictionary.company.phone')}}</label>

                                <input :class="['form-control', form.errors.has('phone') ? 'is-invalid' : '']"
                                       v-model="form.phone" id="phone" name="phone"/>
                                <span v-if="form.errors.has('phone')" :class="['help-block invalid-feedback']">
                                    <strong v-text="form.errors.get('phone')"></strong>
                                </span>
                            </div>
                            <div class="col-6">
                                <label for="phone_1">{{trans.get('messages.admin.dictionary.company.phone')}} 2</label>

                                <input :class="['form-control', form.errors.has('phone_1') ? 'is-invalid' : '']"
                                       v-model="form.phone_1" id="phone_1" name="phone_1"/>
                                <span v-if="form.errors.has('phone_1')" :class="['help-block invalid-feedback']">
                                    <strong v-text="form.errors.get('phone_1')"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="email">{{trans.get('messages.admin.dictionary.company.email')}}</label>

                                <input :class="['form-control', form.errors.has('email') ? 'is-invalid' : '']"
                                       v-model="form.email" id="email" name="email" type="email"/>
                                <span v-if="form.errors.has('email')" :class="['help-block invalid-feedback']">
                                    <strong v-text="form.errors.get('email')"></strong>
                                </span>
                            </div>
                            <div class="col-6">
                                <label for="skype">{{trans.get('messages.admin.dictionary.company.skype')}}</label>

                                <input :class="['form-control', form.errors.has('skype') ? 'is-invalid' : '']"
                                       v-model="form.skype" id="skype" name="skype"/>
                                <span v-if="form.errors.has('skype')" :class="['help-block invalid-feedback']">
                                    <strong v-text="form.errors.get('skype')"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="fax">{{trans.get('messages.admin.dictionary.company.fax')}}</label>

                                <input :class="['form-control', form.errors.has('fax') ? 'is-invalid' : '']"
                                       v-model="form.fax" id="fax" name="fax"/>
                                <span v-if="form.errors.has('fax')" :class="['help-block invalid-feedback']">
                                    <strong v-text="form.errors.get('fax')"></strong>
                                </span>
                            </div>
                            <div class="col-6">
                                <label for="location">{{trans.get('messages.admin.dictionary.company.location')}}</label>

                                <input :class="['form-control', form.errors.has('location') ? 'is-invalid' : '']"
                                       v-model="form.location" id="location" name="location"/>
                                <span v-if="form.errors.has('location')" :class="['help-block invalid-feedback']">
                                    <strong v-text="form.errors.get('location')"></strong>
                                </span>
                            </div>
                        </div>
<!--                        <hr class="col-xs-12">-->
<!--                        <div class="row">-->
<!--                            <div class="col-12">-->
<!--                                <label for="beneficiary">{{trans.get('messages.admin.dictionary.company.beneficiary')}}</label>-->

<!--                                <input :class="['form-control', form.errors.has('beneficiary') ? 'is-invalid' : '']"-->
<!--                                       v-model="form.beneficiary" id="beneficiary" name="beneficiary"/>-->
<!--                                <span v-if="form.errors.has('beneficiary')" :class="['help-block invalid-feedback']">-->
<!--                                    <strong v-text="form.errors.get('beneficiary')"></strong>-->
<!--                                </span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="row">-->
<!--                            <div class="col-6">-->
<!--                                <label for="bank">{{trans.get('messages.admin.dictionary.company.bank')}}</label>-->

<!--                                <input :class="['form-control', form.errors.has('bank') ? 'is-invalid' : '']"-->
<!--                                       v-model="form.bank" id="bank" name="bank"/>-->
<!--                                <span v-if="form.errors.has('bank')" :class="['help-block invalid-feedback']">-->
<!--                                    <strong v-text="form.errors.get('bank')"></strong>-->
<!--                                </span>-->
<!--                            </div>-->
<!--                            <div class="col-6">-->
<!--                                <label for="BIN">{{trans.get('messages.admin.dictionary.company.BIN')}}</label>-->

<!--                                <input :class="['form-control', form.errors.has('BIN') ? 'is-invalid' : '']"-->
<!--                                       v-model="form.BIN" id="BIN" name="BIN"/>-->
<!--                                <span v-if="form.errors.has('BIN')" :class="['help-block invalid-feedback']">-->
<!--                                    <strong v-text="form.errors.get('BIN')"></strong>-->
<!--                                </span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="row">-->
<!--                            <div class="col-6">-->
<!--                                <label for="IIK">{{trans.get('messages.admin.dictionary.company.IIK')}}</label>-->

<!--                                <input :class="['form-control', form.errors.has('IIK') ? 'is-invalid' : '']"-->
<!--                                       v-model="form.IIK" id="IIK" name="IIK"/>-->
<!--                                <span v-if="form.errors.has('IIK')" :class="['help-block invalid-feedback']">-->
<!--                                    <strong v-text="form.errors.get('IIK')"></strong>-->
<!--                                </span>-->
<!--                            </div>-->
<!--                            <div class="col-6">-->
<!--                                <label for="KBE">{{trans.get('messages.admin.dictionary.company.KBE')}}</label>-->

<!--                                <input :class="['form-control', form.errors.has('KBE') ? 'is-invalid' : '']"-->
<!--                                       v-model="form.KBE" id="KBE" name="KBE"/>-->
<!--                                <span v-if="form.errors.has('KBE')" :class="['help-block invalid-feedback']">-->
<!--                                    <strong v-text="form.errors.get('KBE')"></strong>-->
<!--                                </span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="row">-->
<!--                            <div class="col-6">-->
<!--                                <label for="BIK">{{trans.get('messages.admin.dictionary.company.BIK')}}</label>-->

<!--                                <input :class="['form-control', form.errors.has('BIK') ? 'is-invalid' : '']"-->
<!--                                       v-model="form.BIK" id="BIK" name="BIK"/>-->
<!--                                <span v-if="form.errors.has('BIK')" :class="['help-block invalid-feedback']">-->
<!--                                    <strong v-text="form.errors.get('BIK')"></strong>-->
<!--                                </span>-->
<!--                            </div>-->
<!--                            <div class="col-6">-->
<!--                                <label for="payment_code">{{trans.get('messages.admin.dictionary.company.payment_code')}}</label>-->

<!--                                <input :class="['form-control', form.errors.has('payment_code') ? 'is-invalid' : '']"-->
<!--                                       v-model="form.payment_code" id="payment_code" name="payment_code"/>-->
<!--                                <span v-if="form.errors.has('payment_code')" :class="['help-block invalid-feedback']">-->
<!--                                    <strong v-text="form.errors.get('payment_code')"></strong>-->
<!--                                </span>-->
<!--                            </div>-->
<!--                        </div>-->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" @click="hideModal()">
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
                        <h4 class="modal-title">{{trans.get('messages.admin.dictionary.company.changePhoto')}}</h4>
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
        name: "CompanyListComponent",
        data() {
            return {
                url: '/admin/vue/dictionary/company',
                countryList: this.initialCountryList,
                cityList: [],
                selectedCountryId: null,
                entityList: {},
                entityIdForPhoto: null,
                defaultEntity:{
                    id: null,
                    city_id: null,
                    name: '',
                    name_en: '',
                    address: '',
                    address_en: '',
                    phone: '',
                    email: '',
                    skype: '',
                    fax: '',
                    location: '',
                    beneficiary: '',
                    bank: '',
                    BIN: '',
                    IIK: '',
                    KBE: '',
                    BIK: '',
                    payment_code: ''
                },
                form: new Form(this.defaultEntity),
            }
        },
        props: {
            'initialCountryList': Array
        },
        mounted() {
            this.onCountryChange();
        },
        computed: {
            isAddCityDisabled: function(){
                return (this.selectedCountryId === null);
            }
        },
        methods: {
            onCountryChange(){
                if(this.selectedCountryId != null) {
                    this.getEntityList();
                }
            },
            getEntityList(){
                let cityUrl = this.url + '/list/' + this.selectedCountryId;

                axios.get(cityUrl).then(response => {
                    this.entityList = response.data.entityList;
                    this.cityList = response.data.cityList;
                });
            },
            initCreate() {
                this.form = new Form(this.defaultEntity);
                $('#set-model').modal('show');
            },
            initUpdate(index) {
                let entity = this.entityList[index];
                this.form = new Form(entity);
                $('#set-model').modal('show');
            },
            set() {
                let self = this;
                let _url = this.url + "/store";
                let _message = this.trans.get('messages.admin.system.success.store');
                if (self.form.id !== null) {
                    _url = this.url + "/update";
                    _message = this.trans.get('messages.admin.system.success.update');
                }

                self.form.country_id = this.selectedCountryId;

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

                        this.hideModal();
                    });
            },
            deleteEntity(entityId, index) {
                axios.post(this.url + "/delete", {
                    entityId: entityId
                })
                    .then(request => {
                        this.entityList.splice(index, 1);

                        this.$notify({
                            group: 'all',
                            position: 'top right',
                            text: this.trans.get('messages.admin.system.success.delete'),
                            type: 'success'
                        });
                    });
            },
            hideModal(){
                $('#set-model').modal('hide');
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
