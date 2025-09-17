/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */



require('./bootstrap.js');
window.Vue = require('vue');

import Vue from 'vue';
import Lang from 'lang.js';

import vueSelect from 'vue-select';
import ErrorBootstrap from './components/core/ErrorBootstrapComponent';
import TotalErrorBootstrap from './components/core/TotalErrorBootstrapComponent';
import InputBootstrap from './components/core/InputBootstrapComponent';
import InputWithDatalistBootstrap from './components/core/InputWithDatalistBootstrapComponent';
import SelectBootstrap from './components/core/SelectBootstrapComponent';
import Select2Bootstrap from './components/core/Select2BootstrapComponent';
import TextareaBootstrap from './components/core/TextareaBootstrapComponent';
import CheckBoxBootstrap from './components/core/CheckBoxBootstrapComponent';
import FileInputBootstrap from './components/core/FileInputBootstrap';

import InputBootstrapMultiLang from './components/core/InputBootstrapMultiLangComponent';
import TextareaBootstrapMultiLang from './components/core/TextareaBootstrapMultiLangComponent';
import MultiLangFormGroupComponent from './components/core/MultiLangFormGroupComponent.vue';
import FormGroupComponent from './components/core/FormGroupComponent.vue';

import pagination from 'laravel-vue-pagination';
import userList from './components/admin/user/user-list';
import saleManagerClientList from './components/sale-manager/client/client-list';
import agentClientList from './components/agent/client/client-list';

import counterList from './components/admin/dictionary/CounterListComponent';
import cityList from './components/admin/dictionary/CityListComponent';
import companyProfileAddressList from './components/admin/dictionary/CompanyListComponent';

import serviceCategory from './components/admin/service/ServiceCategoryComponent';
import serviceThematicGroup from './components/admin/service/ServiceThematicGroupComponent';

import serviceList from './components/admin/service/ServiceListComponent';
import serviceImport from './components/admin/service/ServiceImportComponent';
import serviceCard from './components/admin/service/ServiceCardComponent';
import serviceStepList from './components/admin/service/ServiceStepListComponent';
import serviceStepMapList from './components/admin/service/ServiceStepMapListComponent';
import serviceStepRequiredDocumentListComponent
    from './components/admin/service/ServiceStepRequiredDocumentListComponent';
import serviceStepResultListComponent from './components/admin/service/ServiceStepResultListComponent';
import serviceAdditionalRequirementsMapListComponent
    from './components/admin/service/ServiceAdditionalRequirementsMapListComponent';

import registrationFormTemplateOptionsetList
    from './components/admin/registrationFormTemplate/OptionsetTypeListComponent';
import registrationFormTemplateOptionsetValueTemplateList
    from './components/admin/registrationFormTemplate/OptionsetValueTemplateListComponent';
import parameterGroupList from './components/admin/registrationFormTemplate/ParameterGroupListComponent';
import registrationFormTemplateList
    from './components/admin/registrationFormTemplate/RegistrationFormTemplateListComponent';
import registrationFormParameterTemplateList
    from './components/admin/registrationFormTemplate/RegistrationFormParameterTemplateListComponent';
import registrationFormParameterTemplateTableStructure
    from './components/admin/registrationFormTemplate/RegistrationFormParameterTemplateTableStructureComponent';
import registrationFormTemplateCard
    from './components/admin/registrationFormTemplate/RegistrationFormTemplateCardComponent';

import reportClientCount from './components/report/ReportClientCountComponent';
import headDashBoard from './components/report/HeadDashBoardComponent';
import reportServiceInProgressData from './components/report/ReportServiceInProgressDataComponent';
import reportServiceCompeteData from './components/report/ReportServiceCompeteDataComponent';
import reportServiceNoPaymentAmountData from './components/report/ReportServiceNoPaymentAmountDataComponent';
import reportAttendanceData from './components/report/ReportAttendanceDataComponent';
import reportJobEvaluationData from './components/report/ReportJobEvaluationDataComponent';

import employeeList from './components/admin/employee/EmployeeListComponent';
import employeeCard from './components/admin/employee/EmployeeCardComponent';
import employeeEducation from './components/admin/employee/EmployeeEducationComponent';
import employeeSkill from './components/admin/employee/EmployeeSkillComponent';
import employeeWorkExperience from './components/admin/employee/EmployeeWorkExperienceComponent';
import employeeSpeciality from './components/admin/employee/EmployeeSpecialityComponent';
import employeeSocial from './components/admin/employee/EmployeeSocialComponent';

import documentTemplateList from './components/company/DocumentTemplateListComponent';
import standartContractTemplateList from './components/company/StandartContractTemplateListComponent';
import standartContractTemplateDownloadList from './components/company/StandartContractTemplateDownloadListComponent';
import standartContractTemplateTypeList from './components/company/StandartContractTemplateTypeListComponent';

import careerFormList from './components/head/career/CareerFormListComponent';
import partnerFormList from './components/head/partner/PartnerFormListComponent';

import catalog from './components/admin/catalog/CatalogComponent';
import catalogNodeListComponent from './components/admin/catalog/CatalogNodeListComponent';
import catalogNodeComponent from './components/admin/catalog/CatalogNodeComponent';

import eventList from './components/admin/event/EventListComponent';
import LicenseTypeComponent from "./components/admin/dictionary/LicenseTypeComponent";
import ServiceResultComponent from "./components/admin/dictionary/ServiceResultComponent";
import ServiceRequiredDocumentComponent from "./components/admin/dictionary/ServiceRequiredDocumentComponent";
import ServiceAdditionalRequirementsTypeComponent
    from "./components/admin/dictionary/ServiceAdditionalRequirementsTypeComponent";
import ServiceAdditionalRequirementsComponent
    from "./components/admin/dictionary/ServiceAdditionalRequirementsComponent";
import AccountantServiceJournalList from "./components/accountant/AccountantServiceJournalList";
import ClientAccountantServiceJournalList from "./components/client/ClientAccountantServiceJournalList";
import HeadAccountantServiceJournalList from "./components/head/HeadAccountantServiceJournalList";
import ManagerServiceJournalList from "./components/manager/ManagerServiceJournalList";

import CallMeComponent from "./components/main/CallMeComponent";

import faqList from './components/admin/faq/faq-list';


import moment from 'moment';
import Notifications from 'vue-notification';
//import Datepicker from '../../../node_modules/vuejs-datepicker/src/components/Datepicker.vue';
import Datepicker from 'vuejs-datepicker';
import datePicker from 'vue-bootstrap-datetimepicker';
import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';

//bugfix
Lang.prototype._parseKey = function(key, locale) {
    if (typeof key !== 'string' || typeof locale !== 'string') {
        return null;
    }

    var segments = key.split('.');
    var source = segments[0].replace(/\//g, '.');

    return {
        source: locale,
        sourceFallback: this.getFallback() + '.' + source,
        entries: segments
    };
};

window.Errors = require('./errors.js');
Vue.use(window.Errors);

window.Form = require('./form.js');
Vue.use(window.Form);

Vue.use(moment);

Vue.use(require('vue-moment'));

Vue.use(Notifications);

Vue.use(Datepicker);

Vue.use(datePicker);

window.messages = require('./messages.js');

Vue.prototype.trans = new Lang({
    messages: window.messages.default,
    locale: window.default_language,
    fallback: window.fallback_locale
});

axios.interceptors.response.use(function (response) {
    return response;
}, function (error) {
    console.log(error);
    if (error.response.status === 401) {
        window.location = "/login";
    }

    Vue.notify({
        group: 'all',
        position: 'top right',
        title: app.trans.get('messages.admin.system.error'),
        text: error.response.data.message,
        type: 'error'
    });

    return Promise.reject(error);
});

window.VueEvent = new class {
    constructor(){
        this.vue = new Vue();
    };
    fire(event, data = null){
        this.vue.$emit(event, data);
    };
    listen(event, callback){
        this.vue.$on(event, callback);
    };
};

Vue.prototype.$datepicker_options = {
    format: 'DD.MM.YYYY',
    useCurrent: false,
};
jQuery.extend(true, jQuery.fn.datetimepicker.defaults, {
    icons: {
        time: 'far fa-clock',
        date: 'far fa-calendar',
        up: 'fas fa-arrow-up',
        down: 'fas fa-arrow-down',
        previous: 'fas fa-chevron-left',
        next: 'fas fa-chevron-right',
        today: 'fas fa-calendar-check',
        clear: 'far fa-trash-alt',
        close: 'far fa-times-circle'
    }
});

window.roleHelperList = {
    Administrator: 1,
    Executor: 2,
    Client: 3,
    Manager: 4,
    SaleManager: 5,
    Curator: 6,
    Head: 7,
    Accountant: 8,
    Partner: 9,
    Agent: 10
};

window.roleTypeHelperList = {
    employees: 1,
    external: 2,
    partner: 3,
    agent: 4
};

window.formComponentType = {
    Input: 1,
    Select: 2,
    Textarea: 3,
    CheckBox: 4,
    InputWithDatalist: 5,
    Select2: 6
};

window.serviceStatus = {
    ClientCheck: 9,
    Check: 4,
};

window.projectStatus = {
    Closed: 3,
    Done: 4,
    Review: 5,
};

window.clientCheckResultType = {
    Success: 1,
    Reject: 2
};




/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('vue-select', vueSelect);
Vue.component('error-bootstrap', ErrorBootstrap);
Vue.component('total-error-bootstrap', TotalErrorBootstrap);
Vue.component('select-bootstrap', SelectBootstrap);
Vue.component('select2-bootstrap', Select2Bootstrap);
Vue.component('input-bootstrap', InputBootstrap);
Vue.component('input-with-datalist-bootstrap', InputWithDatalistBootstrap);
Vue.component('textarea-bootstrap', TextareaBootstrap);
Vue.component('checkbox-bootstrap', CheckBoxBootstrap);
Vue.component('file-input-bootstrap', FileInputBootstrap);

Vue.component('input-bootstrap-multi-lang', InputBootstrapMultiLang);
Vue.component('textarea-bootstrap-multi-lang', TextareaBootstrapMultiLang);
Vue.component('multi-lang-form-group', MultiLangFormGroupComponent);

Vue.component('form-group', FormGroupComponent);

Vue.component('pagination', pagination);
Vue.component('user-list', userList);
Vue.component('salemanager-client-list', saleManagerClientList);
Vue.component('agent-client-list', agentClientList);

Vue.component('counter-list', counterList);
Vue.component('city-list', cityList);
Vue.component('company-profile-address-list', companyProfileAddressList);

Vue.component('service-category', serviceCategory);
Vue.component('service-thematic-group', serviceThematicGroup);

Vue.component('service-list', serviceList);
Vue.component('service-import', serviceImport);
Vue.component('serviceCard', serviceCard);
Vue.component('service-step-list', serviceStepList);
Vue.component('service-step-map-list', serviceStepMapList);
Vue.component('service-step-required-document-list-component', serviceStepRequiredDocumentListComponent);
Vue.component('service-step-result-list-component', serviceStepResultListComponent);
Vue.component('service-additional-requirements-map-list', serviceAdditionalRequirementsMapListComponent);

Vue.component('registration-form-template-optionset-list', registrationFormTemplateOptionsetList);
Vue.component('registration-form-template-optionset-value-template-list', registrationFormTemplateOptionsetValueTemplateList);
Vue.component('parameter-group-list', parameterGroupList);
Vue.component('registration-form-template-list', registrationFormTemplateList);
Vue.component('registration-form-parameter-template-list', registrationFormParameterTemplateList);
Vue.component('registration-form-parameter-template-table-structure', registrationFormParameterTemplateTableStructure);
Vue.component('registration-form-template-card', registrationFormTemplateCard);

Vue.component('report-client-count', reportClientCount);
Vue.component('head-dash-board', headDashBoard);
Vue.component('reportService-in-progressData', reportServiceInProgressData);
Vue.component('reportService-competeData', reportServiceCompeteData);
Vue.component('reportService-no-payment-amountData', reportServiceNoPaymentAmountData);
Vue.component('report-attendanceData', reportAttendanceData);
Vue.component('report-job-evaluationData', reportJobEvaluationData);

Vue.component('employee-list', employeeList);
Vue.component('employeeCard', employeeCard);
Vue.component('employee-education', employeeEducation);
Vue.component('employee-skill', employeeSkill);
Vue.component('employee-work-experience', employeeWorkExperience);
Vue.component('employee-speciality', employeeSpeciality);
Vue.component('employee-social', employeeSocial);

Vue.component('document-template-list', documentTemplateList);
Vue.component('standart-contract-template-list', standartContractTemplateList);
Vue.component('standart-contract-template-download-list', standartContractTemplateDownloadList);
Vue.component('standart-contract-template-type-list', standartContractTemplateTypeList);

Vue.component('careerForm-list', careerFormList);
Vue.component('partnerForm-list', partnerFormList);

Vue.component('catalog', catalog);
Vue.component('catalog-node-list-component', catalogNodeListComponent);
Vue.component('catalog-node-component', catalogNodeComponent);

Vue.component('event-list', eventList);

Vue.component('license-type', LicenseTypeComponent);
Vue.component('service-result', ServiceResultComponent);
Vue.component('service-required-document', ServiceRequiredDocumentComponent);
Vue.component('service-additional-requirements-type', ServiceAdditionalRequirementsTypeComponent);
Vue.component('service-additional-requirements', ServiceAdditionalRequirementsComponent);
Vue.component('accountant-service-journal-list', AccountantServiceJournalList);
Vue.component('client-accountant-service-journal-list', ClientAccountantServiceJournalList);
Vue.component('head-accountant-service-journal-list', HeadAccountantServiceJournalList);
Vue.component('manager-service-journal-list', ManagerServiceJournalList);

Vue.component('call-me', CallMeComponent);

Vue.component('faq-list', faqList);

const app = window.App = new Vue({
    el: '#app',
    components: {
        Datepicker
    },
    methods: {
        init: function(){
            VueEvent.fire('MapsApiLoaded');
        }
    }
});
