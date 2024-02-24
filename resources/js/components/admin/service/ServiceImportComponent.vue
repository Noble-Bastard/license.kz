<template>
    <div>
        <div class="title-main">
            {{trans.get('messages.admin.service.import.title')}}

        </div>

        <div class="card" v-if="!isResultVisible">
            <div class="card-body">


                <div class="row" @change="form.errors.clear($event.target.name)"
                     @keydown="form.errors.clear($event.target.name)">

                    <div class="col-12">
                        <div class="row pb-3">
                            <div class="col-3">
                                <label for="countryId">{{trans.get('messages.admin.serviceList.countryFilter')}}</label>
                                <select :class="['form-control', form.errors.has('countryId') ? 'is-invalid' : '']"
                                        id="countryId" @change="onCountryChange()"
                                        v-model="form.countryId">
                                    <option :value="country.id" v-for="(country, index) in countryList">
                                        {{country.name}}
                                    </option>
                                </select>
                                <span v-if="form.errors.has('countryId')"
                                      :class="['help-block invalid-feedback']">
                                                        <strong v-text="form.errors.get('countryId')"></strong>
                                    </span>
                            </div>
                            <div class="col-3">
                                <label for="serviceCategoryId">{{trans.get('messages.admin.serviceList.serviceCategoryFilter')}}</label>
                                <select :class="['form-control', form.errors.has('serviceCategoryId') ? 'is-invalid' : '']"
                                        id="serviceCategoryId"
                                        @change="onServiceCategoryChange()" v-model="form.serviceCategoryId">
                                    <option :value="serviceCategory.id"
                                            v-for="(serviceCategory, index) in serviceCategoryList">
                                        {{serviceCategory.service_category_type_id ==
                                        cnstFreeEconomicZoneCategoryType ?
                                        "(" + serviceCategory.name + ") " + serviceCategory.description
                                        : serviceCategory.name
                                        }}
                                    </option>
                                </select>
                                <span v-if="form.errors.has('serviceCategoryId')"
                                      :class="['help-block invalid-feedback']">
                                                        <strong v-text="form.errors.get('serviceCategoryId')"></strong>
                                    </span>
                            </div>

                            <div class="col-3">
                                <label for="serviceThematicGroupId">{{trans.get('messages.admin.service.service_thematic_group')}}</label>

                                <select :class="['form-control', form.errors.has('serviceThematicGroupId') ? 'is-invalid' : '']"
                                        id="serviceThematicGroupId" name="serviceThematicGroupId"
                                        v-model="form.serviceThematicGroupId">
                                    <option v-for="(value, key) in serviceThematicGroupList" :value="value.id">
                                        {{value.name}}
                                    </option>
                                </select>
                                <span v-if="form.errors.has('serviceThematicGroupId')"
                                      :class="['help-block invalid-feedback']">
                                                        <strong v-text="form.errors.get('serviceThematicGroupId')"></strong>
                                    </span>
                            </div>

                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="file">{{trans.get('messages.company.documentTemplate.file')}}</label>
                            <input ref="file" :class="['form-control', form.errors.has('file') ? 'is-invalid' : '']"
                                   id="file" name="file" type="file" @change="onFileSelect()"/>
                            <span v-if="form.errors.has('file')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('file')"></strong>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-12 text-right">
                    <button type="button" @click="set()" :disabled="form.errorsOrSend()" class="btn btn-primary">
                        {{trans.get('messages.all.upload')}}
                    </button>
                </div>

            </div>
        </div>

        <div class="card" id="import-result" v-if="isResultVisible">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 text-right pb-3">
                        <button type="button" @click="newImport()"  class="btn btn-primary">
                            {{trans.get('messages.admin.service.import.new')}}
                        </button>
                    </div>
                    <div class="col-12">
                        <table id="users" class="table table-striped table-responsive-sm col-12">
                            <thead>
                            <tr>
                                <th>{{trans.get('messages.admin.serviceList.code')}}</th>
                                <th>{{trans.get('messages.admin.serviceList.name')}}</th>
                                <th>{{trans.get('messages.admin.serviceList.thematicGroupName')}}</th>
                                <th>{{trans.get('messages.all.actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(entity, index) in entityList">
                                <td>{{entity.code}}</td>
                                <td>{{entity.name}}</td>
                                <td>{{entity.service_thematic_group_name}}</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                            <i class="fa fa-bars"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item"
                                               @click="openServiceCard(entity.id, entity.service_category_id, entity.service_thematic_group_id)">{{trans.get('messages.admin.serviceList.openCard')}}</a>
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
</template>


<script>
    export default {
        name: "ServiceImportComponent",
        data() {
            return {
                url: '/admin/vue/service_import',
                card_url: '/admin/service/show',
                serviceCategoryUrl: '/admin/vue/service_category_with_system',
                serviceCategoryList: null,
                serviceThematicGroupList: null,
                countryList: this.initialCountryList,
                isResultVisible: false,
                cnstFreeEconomicZoneCategoryType: 3,
                defaultEntity: {
                    id: null,
                    countryId: this.initialCountryId,
                    serviceCategoryId: null,
                    serviceThematicGroupId: null,
                    file: "",
                },
                form: new Form(this.defaultEntity),
                msgSuccessStore: this.trans.get('messages.admin.system.success.store'),
                msgSuccessUpdate: this.trans.get('messages.admin.system.success.update'),
                msgSuccessDelete: this.trans.get('messages.admin.system.success.delete'),
                entityList: []
            }
        },
        props: {
            'initialCountryList': Array,
            'initialCountryId': Number
        },
        mounted() {
            this.form = new Form(this.defaultEntity);
            this.onCountryChange();
        },
        computed: {},
        methods: {
            onCountryChange() {
                let categoryUrl = this.serviceCategoryUrl + '/list?'
                    + 'countryId=' + this.form.countryId
                    + '&withPaginate=false';

                axios.get(categoryUrl).then(response => {
                    this.serviceCategoryList = response.data;
                    this.form.serviceCategoryId = null;
                    this.onServiceCategoryChange();
                });
            },

            onServiceCategoryChange() {
                let serviceThematicGroupUrl = '/admin/vue/service_thematic_group/list/'
                    + this.form.serviceCategoryId
                    + '?withPaginate=false';
                axios.get(serviceThematicGroupUrl).then(response => {
                    this.serviceThematicGroupList = response.data;
                    this.form.serviceThematicGroupId = null;
                });
            },

            onFileSelect() {
                if (this.form.errors.has('file')) {
                    this.form.errors.clear('file');
                    this.form.resetErrors();
                }
                this.form.file = this.$refs.file.files[0];
            },

            set() {

                let requestUrl = this.url + "/store";
                let requestSuccessMessage = this.msgSuccessStore;


                let self = this;

                self.form.postMultipart(requestUrl)
                    .then(request => {
                        this.entityList = request;
                        this.isResultVisible = true;
                        this.form = new Form(this.defaultEntity);

                        this.$notify({
                            group: 'all',
                            position: 'top right',
                            text: requestSuccessMessage,
                            type: 'success'
                        });
                    });
            },

            newImport() {
                this.form = new Form(this.defaultEntity);
                this.onCountryChange();
                this.isResultVisible = false;
            },
            openServiceCard(serviceId, serviceCategoryId, serviceThematicGroupId){
                window.open(this.card_url + '/' + serviceCategoryId + '/' + serviceThematicGroupId + '/' + serviceId) ;
            },
        },
    }
</script>

<style scoped>

</style>