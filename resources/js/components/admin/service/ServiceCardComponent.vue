<template>
    <div>
        <div class="row" v-if="!canShow">
            <div class="col-12">
                <div class="title-sub text-center">
                    {{trans.get('messages.all.downloading')}}
                </div>
            </div>
        </div>
        <div class="row" v-show="canShow">
            <div class="col-12">
                <div class="title-main">
                    <small>{{entity.code}}</small>
                    <span v-html="entity.description"></span>
                    <div>
                        <small v-html="entity.description_en"></small>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-general-tab" data-toggle="tab" href="#nav-general"
                           role="tab" aria-controls="nav-general" aria-selected="true">{{trans.get('messages.admin.service.general')}}</a>
                        <a :class="['nav-item', 'nav-link', entity.id === 0 ? 'disabled' : '']" id="nav-step-tab"
                           :data-toggle="entity.id === 0 ? '' : 'tab'" href="#nav-step" role="tab"
                           aria-controls="nav-step"
                           aria-selected="false">{{trans.get('messages.admin.service.step_list')}}</a>
                        <a :class="['nav-item', 'nav-link', entity.id === 0 ? 'disabled' : '']"
                           id="nav-additional-requirements-tab" :data-toggle="entity.id === 0 ? '' : 'tab'"
                           href="#nav-additional-requirements" role="tab" aria-controls="nav-profile"
                           aria-selected="false">{{trans.get('messages.admin.service.additional_requirements')}}</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-general" role="tabpanel"
                         aria-labelledby="nav-general-tab">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group mt-4">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                               :class="['custom-control-input', form.errors.has('is_active') ? 'is-invalid' : '']"
                                                               id="is_active" v-model="form.is_active">
                                                        <label class="custom-control-label" for="is_active">{{trans.get('messages.admin.service.is_active')}}</label>
                                                    </div>

                                                    <span v-if="form.errors.has('is_active')"
                                                          :class="['help-block invalid-feedback']">
                                                    <strong v-text="form.errors.get('is_active')"></strong>
                                                </span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="service_type_id">{{trans.get('messages.admin.service.service_type')}}</label>
                                                    <select :class="['form-control', form.errors.has('service_type_id') ? 'is-invalid' : '']"
                                                            id="service_type_id" name="service_type_id"
                                                            v-model="form.service_type_id">
                                                        <option v-for="(value, key) in serviceTypeList"
                                                                :value="value.id">
                                                            {{value.name}}
                                                        </option>
                                                    </select>
                                                    <span v-if="form.errors.has('service_type_id')"
                                                          :class="['help-block invalid-feedback']">
                                                    <strong v-text="form.errors.get('service_type_id')"></strong>
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="counter_type_id">{{trans.get('messages.admin.service.service_thematic_group')}}</label>

                                                    <select :class="['form-control', form.errors.has('service_thematic_group_id') ? 'is-invalid' : '']"
                                                            id="service_thematic_group_id"
                                                            name="service_thematic_group_id"
                                                            v-model="form.service_thematic_group_id">
                                                        <option v-for="(value, key) in serviceThematicGroupList"
                                                                :value="value.id">{{value.name}}
                                                        </option>
                                                    </select>
                                                    <span v-if="form.errors.has('service_thematic_group_id')"
                                                          :class="['help-block invalid-feedback']">
                                                    <strong v-text="form.errors.get('service_thematic_group_id')"></strong>
                                                </span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="counter_type_id">{{trans.get('messages.admin.service.counter_type')}}</label>

                                                    <select :class="['form-control', form.errors.has('counter_type_id') ? 'is-invalid' : '']"
                                                            id="counter_type_id" name="counter_type_id"
                                                            v-model="form.counter_type_id">
                                                        <option v-for="(value, key) in counterTypeList"
                                                                :value="value.id">
                                                            {{value.name}}
                                                        </option>
                                                    </select>
                                                    <span v-if="form.errors.has('counter_type_id')"
                                                          :class="['help-block invalid-feedback']">
                                                    <strong v-text="form.errors.get('counter_type_id')"></strong>
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">

                                        <div class="form-group">
                                            <label for="license_type_id">{{trans.get('messages.admin.service.license_type')}}</label>

                                            <select :class="['form-control', form.errors.has('license_type_id') ? 'is-invalid' : '']"
                                                    id="license_type_id" name="license_type_id"
                                                    v-model="form.license_type_id">
                                                <option v-for="(value, key) in licenseTypeList" :value="value.id">
                                                    {{value.name}}
                                                </option>
                                            </select>
                                            <span v-if="form.errors.has('license_type_id')"
                                                  :class="['help-block invalid-feedback']">
                                            <strong v-text="form.errors.get('license_type_id')"></strong>
                                        </span>
                                        </div>

                                        <div class="form-group">
                                            <label for="code">{{trans.get('messages.admin.service.code')}}</label>

                                            <input :class="['form-control', form.errors.has('code') ? 'is-invalid' : '']"
                                                   id="code"
                                                   name="code" v-model="form.code"/>

                                            <span v-if="form.errors.has('code')"
                                                  :class="['help-block invalid-feedback']">
                                            <strong v-text="form.errors.get('code')"></strong>
                                        </span>
                                        </div>
                                        <div class="form-group">
                                            <label for="code_en">{{trans.get('messages.admin.service.code_en')}}</label>

                                            <input :class="['form-control', form.errors.has('code_en') ? 'is-invalid' : '']"
                                                   id="code_en"
                                                   name="code_en" v-model="form.code_en"/>

                                            <span v-if="form.errors.has('code_en')"
                                                  :class="['help-block invalid-feedback']">
                                            <strong v-text="form.errors.get('code_en')"></strong>
                                        </span>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">{{trans.get('messages.admin.service.description')}}</label>

                                            <textarea
                                                    :class="['form-control ckedit', form.errors.has('description') ? 'is-invalid' : '']"
                                                    id="description"
                                                    name="description" v-model="form.description" rows="9"></textarea>

                                            <span v-if="form.errors.has('description')"
                                                  :class="['help-block invalid-feedback']">
                                            <strong v-text="form.errors.get('description')"></strong>
                                        </span>
                                        </div>
                                        <div class="form-group">
                                            <label for="description_en">{{trans.get('messages.admin.service.description_en')}}</label>

                                            <textarea
                                                    :class="['form-control ckedit', form.errors.has('description_en') ? 'is-invalid' : '']"
                                                    id="description_en"
                                                    name="description_en" v-model="form.description_en"
                                                    rows="9"></textarea>

                                            <span v-if="form.errors.has('description_en')"
                                                  :class="['help-block invalid-feedback']">
                                            <strong v-text="form.errors.get('description_en')"></strong>
                                        </span>
                                        </div>

                                        <div class="form-group">
                                            <label for="executive_agency">{{trans.get('messages.admin.service.executive_agency')}}</label>

                                            <input :class="['form-control', form.errors.has('executive_agency') ? 'is-invalid' : '']"
                                                   id="executive_agency"
                                                   name="executive_agency" v-model="form.executive_agency"/>

                                            <span v-if="form.errors.has('executive_agency')"
                                                  :class="['help-block invalid-feedback']">
                                            <strong v-text="form.errors.get('executive_agency')"></strong>
                                        </span>
                                        </div>

                                        <div class="form-group">
                                            <label for="executive_agency_en">{{trans.get('messages.admin.service.executive_agency_en')}}</label>

                                            <input :class="['form-control', form.errors.has('executive_agency_en') ? 'is-invalid' : '']"
                                                   id="executive_agency_en"
                                                   name="executive_agency_en" v-model="form.executive_agency_en"/>

                                            <span v-if="form.errors.has('executive_agency_en')"
                                                  :class="['help-block invalid-feedback']">
                                            <strong v-text="form.errors.get('executive_agency_en')"></strong>
                                        </span>
                                        </div>

                                        <div class="form-group">
                                            <label for="live_period">{{trans.get('messages.admin.service.live_period')}}</label>

                                            <input :class="['form-control', form.errors.has('live_period') ? 'is-invalid' : '']"
                                                   id="live_period"
                                                   name="live_period" v-model="form.live_period"/>

                                            <span v-if="form.errors.has('live_period')"
                                                  :class="['help-block invalid-feedback']">
                                            <strong v-text="form.errors.get('live_period')"></strong>
                                        </span>
                                        </div>

                                        <div class="form-group">
                                            <label for="live_period_en">{{trans.get('messages.admin.service.live_period_en')}}</label>

                                            <input :class="['form-control', form.errors.has('live_period_en') ? 'is-invalid' : '']"
                                                   id="live_period_en"
                                                   name="live_period_en" v-model="form.live_period_en"/>

                                            <span v-if="form.errors.has('live_period_en')"
                                                  :class="['help-block invalid-feedback']">
                                            <strong v-text="form.errors.get('live_period_en')"></strong>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-6">

                                        <div class="form-group">
                                            <label for="registration_form_template_id">{{trans.get('messages.admin.service.registration_form_template')}}</label>

                                            <select :class="['form-control', form.errors.has('registration_form_template_id') ? 'is-invalid' : '']"
                                                    id="registration_form_template_id"
                                                    name="registration_form_template_id"
                                                    v-model="form.registration_form_template_id">
                                                <option :value="null"></option>
                                                <option v-for="(value, key) in registrationFormTemplateList"
                                                        :value="value.id">
                                                    {{value.name}}
                                                </option>
                                            </select>
                                            <span v-if="form.errors.has('registration_form_template_id')"
                                                  :class="['help-block invalid-feedback']">
                                            <strong v-text="form.errors.get('registration_form_template_id')"></strong>
                                        </span>
                                        </div>

                                        <div class="form-group">
                                            <label for="name">{{trans.get('messages.admin.service.name')}}</label>

                                            <input :class="['form-control', form.errors.has('name') ? 'is-invalid' : '']"
                                                   id="name"
                                                   name="name" v-model="form.name"/>

                                            <span v-if="form.errors.has('name')"
                                                  :class="['help-block invalid-feedback']">
                                            <strong v-text="form.errors.get('name')"></strong>
                                        </span>
                                        </div>
                                        <div class="form-group">
                                            <label for="name_en">{{trans.get('messages.admin.service.name_en')}}</label>

                                            <input :class="['form-control', form.errors.has('name_en') ? 'is-invalid' : '']"
                                                   id="name_en"
                                                   name="name_en" v-model="form.name_en"/>

                                            <span v-if="form.errors.has('name_en')"
                                                  :class="['help-block invalid-feedback']">
                                            <strong v-text="form.errors.get('name_en')"></strong>
                                        </span>
                                        </div>
                                        <div class="form-group">
                                            <label for="comment">{{trans.get('messages.admin.service.comment')}}</label>

                                            <textarea
                                                    :class="['form-control ckedit', form.errors.has('comment') ? 'is-invalid' : '']"
                                                    id="comment"
                                                    name="comment" v-model="form.comment" rows="9"></textarea>

                                            <span v-if="form.errors.has('comment')"
                                                  :class="['help-block invalid-feedback']">
                                            <strong v-text="form.errors.get('comment')"></strong>
                                        </span>
                                        </div>
                                        <div class="form-group">
                                            <label for="comment_en">{{trans.get('messages.admin.service.comment_en')}}</label>

                                            <textarea
                                                    :class="['form-control ckedit', form.errors.has('comment_en') ? 'is-invalid' : '']"
                                                    id="comment_en"
                                                    name="comment_en" v-model="form.comment_en" rows="9"></textarea>

                                            <span v-if="form.errors.has('comment_en')"
                                                  :class="['help-block invalid-feedback']">
                                            <strong v-text="form.errors.get('comment_en')"></strong>
                                        </span>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="base_cost">{{trans.get('messages.admin.service.base_cost')}}</label>
                                                            <input type="number"
                                                                   :class="['form-control', form.errors.has('base_cost') ? 'is-invalid' : '']"
                                                                   id="base_cost"
                                                                   name="base_cost" v-model="form.base_cost"/>

                                                            <span v-if="form.errors.has('base_cost')"
                                                                  :class="['help-block invalid-feedback']">
                                                    <strong v-text="form.errors.get('base_cost')"></strong>
                                                        </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="additional_cost">{{trans.get('messages.admin.service.additional_cost')}}</label>
                                                            <input type="number"
                                                                   :class="['form-control', form.errors.has('additional_cost') ? 'is-invalid' : '']"
                                                                   id="additional_cost"
                                                                   name="additional_cost"
                                                                   v-model="form.additional_cost"/>

                                                            <span v-if="form.errors.has('additional_cost')"
                                                                  :class="['help-block invalid-feedback']">
                                                    <strong v-text="form.errors.get('additional_cost')"></strong>
                                                        </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="execution_days_from">{{trans.get('messages.admin.service.execution_days')}}</label>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="execution_days_from">{{trans.get('messages.admin.service.execution_days_from')}}</label>

                                                            <input type="number"
                                                                   :class="['form-control', form.errors.has('execution_days_from') ? 'is-invalid' : '']"
                                                                   id="execution_days_from"
                                                                   name="execution_days_from"
                                                                   v-model="form.execution_days_from"/>

                                                            <span v-if="form.errors.has('execution_days_from')"
                                                                  :class="['help-block invalid-feedback']">
                                                    <strong v-text="form.errors.get('execution_days_from')"></strong>
                                                </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="execution_days_to">{{trans.get('messages.admin.service.execution_days_to')}}</label>

                                                            <input type="number"
                                                                   :class="['form-control', form.errors.has('execution_days_to') ? 'is-invalid' : '']"
                                                                   id="execution_days_to"
                                                                   name="execution_days_to"
                                                                   v-model="form.execution_days_to"/>

                                                            <span v-if="form.errors.has('execution_days_from')"
                                                                  :class="['help-block invalid-feedback']">
                                                    <strong v-text="form.errors.get('execution_days_from')"></strong>
                                                </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary btn-sm float-right" @click="set">
                                            {{trans.get('messages.all.submit')}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-step" role="tabpanel" aria-labelledby="nav-step-tab">
                        <service-step-map-list :key="entity.id" :initial-service-id="entity.id"></service-step-map-list>
                    </div>
                    <div class="tab-pane fade" id="nav-additional-requirements" role="tabpanel"
                         aria-labelledby="nav-step-tab">
                        <service-additional-requirements-map-list :key="entity.id"
                                                                  :initial-service-id="entity.id"></service-additional-requirements-map-list>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ServiceCardComponent",
        data() {
            return {
                url: '/admin/vue/service',
                counterTypeList: [],
                licenseTypeList: [],
                serviceTypeList: [],
                serviceThematicGroupList: [],
                registrationFormTemplateList: this.initialRegistrationFormTemplateList,
                entity: {
                    id: 0,
                    service_category_id: this.initialServiceCategoryId,
                    service_thematic_group_id: this.initialServiceThematicGroupId,
                    code: '',
                    name: '',
                    description: '',
                    comment: '',
                    code_en: '',
                    name_en: '',
                    description_en: '',
                    comment_en: '',
                    execution_days_from: 0,
                    execution_days_to: 0,
                    is_active: true,
                    service_start_date: '',
                    service_end_date: '',
                    counter_type_id: null,
                    license_type_id: null,
                    registrationFormTemplateId: null,
                    executive_agency: '',
                    executive_agency_en: '',
                    live_period: '',
                    live_period_en: '',
                    service_type_id: null,
                    base_cost: 0,
                    additional_cost: 0
                },
                form: new Form(this.entity),
                entityId: this.initialEntityId,
                canShow: false,
            }
        },
        props: {
            'initialEntityId': Number,
            'initialServiceCategoryId': Number,
            'initialServiceThematicGroupId': Number,
            'initialRegistrationFormTemplateList': Array
        },
        mounted() {
            $(function () {
                CKEDITOR.config.toolbar = [
                    ['Styles', 'Format', 'Font', 'FontSize'],
                    ['Bold', 'Italic', 'Underline', 'StrikeThrough', '-', 'Undo', 'Redo', '-', 'Cut', 'Copy', 'Paste', 'Find', 'Replace', '-', 'Outdent', 'Indent', '-', 'Print'],
                    ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'NumberedList', 'BulletedList'],
                    ['Table', '-', 'Link', 'Flash', 'Smiley', 'TextColor', 'BGColor', 'Source']
                ];
            });
            this.getEntity();
        },
        methods: {
            getEntity() {
                if (this.entityId !== null) {
                    axios.get(this.url + '/get/' + this.entityId).then(response => {
                        this.entity = response.data.entity;
                        this.form = new Form(this.entity);
                        this.counterTypeList = response.data.counterTypeList;
                        this.licenseTypeList = response.data.licenseTypeList;
                        this.serviceTypeList = response.data.serviceTypeList;

                        this.canShow = true;
                        this.initEditor();
                        //VueEvent.fire('loadServiceCard', this.entity.id);
                    });
                } else {
                    axios.get(this.url + '/get/' + this.entityId).then(response => {
                        this.form = new Form(this.entity);

                        this.counterTypeList = response.data.counterTypeList;
                        this.licenseTypeList = response.data.licenseTypeList;
                        this.serviceTypeList = response.data.serviceTypeList;

                        this.canShow = true;
                        this.initEditor();
                    });
                }

                let serviceThematicGroupUrl = '/admin/vue/service_thematic_group/list/'
                    + this.entity.service_category_id
                    + '?withPaginate=false';
                axios.get(serviceThematicGroupUrl).then(response => {
                    this.serviceThematicGroupList = response.data;

                });
            },
            set() {
                let self = this;
                let _url = this.url + "/store";
                let _message = this.trans.get('messages.admin.system.success.store');
                if (self.form.id !== 0) {
                    _url = this.url + "/update";
                    _message = this.trans.get('messages.admin.system.success.update');
                }

                self.form.description = CKEDITOR.instances['description'].getData();
                self.form.description_en = CKEDITOR.instances['description_en'].getData();
                self.form.comment = CKEDITOR.instances['comment'].getData();
                self.form.comment_en = CKEDITOR.instances['comment_en'].getData();

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

                        //VueEvent.fire('loadServiceCard', this.entity.id);
                    });
            },
            initEditor() {
                $('textarea.ckedit').each(function () {
                    var editor = CKEDITOR.instances[this.id];
                    if (typeof (editor) === "object") {
                        CKEDITOR.instances[this.id].destroy(true);
                    }
                    CKEDITOR.replace(this.id, {
                        filebrowserBrowseUrl: '/ckfinder/browser',
                        filebrowserUploadUrl: '/ckfinder/connector?command=QuickUpload&type=Files'
                    });
                });
            }
        },
    }
</script>

<style scoped>

</style>