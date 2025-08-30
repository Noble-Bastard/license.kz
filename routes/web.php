<?php

use App\Data\Notify\Dal\EmailDal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');


Route::post('/setLocationCountry', 'HelperController@setLocationCountry')->name('global.setLocationCountry');
//Route::post('/setLocale', 'HelperController@setLocale')->name('global.setLocale');

Route::get('/serviceCarouselImage/{mainServiceCarouselId}/{displayDimensionType}', 'Admin\MainServiceCarouselController@getImage');
Route::get('/generatePrettyUrl', 'HomeController@generatePrettyUrl');


Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'localizeDatetime', 'checkUTM']], function () {
//    Route::group(['middleware' => ['setLocationByIP']], function () {

    Auth::routes();

//    Route::prefix('new-version')->group(function () {
        Route::get('/', [\App\Http\Controllers\HomeController::class, 'indexNew'])->name('new-index');
        Route::get('home', [\App\Http\Controllers\HomeController::class, 'indexNew'])->name('new-home');
        Route::get('about', [\App\Http\Controllers\AboutController::class, 'indexNew'])->name('new-about');
        Route::get('/partners', [\App\Http\Controllers\ExternalPartnerController::class, 'indexNew'])->name('new-partners');
        Route::get('/reviews', [\App\Http\Controllers\ReviewController::class, 'indexNew'])->name('new-reviews');

        Route::get('/service-group/{serviceGroupName}', [\App\Http\Controllers\ServicesController::class, 'serviceGroupInfoNew'])->name('new.services-group.info');
        Route::get('/service-group/catalog/{catalogName}', [\App\Http\Controllers\ServicesController::class, 'serviceGroupCatalogNew'])->name('new.services-group.catalog');
        Route::post('/service-group/compare/', [\App\Http\Controllers\ServicesController::class, 'serviceGroupCompareNew'])->name('new.services-group.compare');

        Route::get('/construction', [\App\Http\Controllers\HomeController::class, 'constructionNew'])->name('new-construction');
        Route::get('/services', [\App\Http\Controllers\HomeController::class, 'servicesNew'])->name('new-services');
        Route::get('/services/child-nodes/{serviceCategoryId}', [\App\Http\Controllers\ServicesController::class, 'childNodesNew'])->name('new-services.child-nodes');

//    });

//    Route::get('/', 'HomeController@index')->name('index');
    Route::get('new-home', 'HomeController@newHome');
    Route::get('offer', 'HomeController@offer')->name('offer');
    Route::get('services', 'ServicesController@index')->name('services');
    Route::get('search', 'ServicesController@search')->name('service.search');
    Route::get('searchSelected/{serviceCatalogId}/{serviceId}', 'ServicesController@searchSelected')->name('service.searchSelected');

    Route::get('serviceCategory', 'ServicesController@categoryList')->name('services.categoryList');
    Route::get('serviceCategory/listByServiceCategoryAndType', 'ServicesController@listByServiceCategoryAndType')->name('services.catalog.listByServiceCategoryAndType');
    Route::get('serviceGroup/{serviceCategoryId}', 'ServicesController@serviceGroupList')->name('services.groupList');
    Route::get('serviceGroup/catalog/{catalogId}/{preSelected?}', 'ServicesController@catalogNode')->name('services.catalog.list');

    Route::get('common_data/getFreeZonePartial', 'ServicesController@getFreeZonePartial')->name('common_data.getFreeZonePartial');

//    Route::get('contacts', 'ContactsController@index')->name('contacts');
//    Route::get('about', 'AboutController@index')->name('about');

    Route::get('news/list', 'Admin\NewsController@newsList')->name('news.list');
    Route::get('government_agencies_news/list', 'Admin\NewsController@governmentAgenciesNewsList')->name('news.government_agencies.list');
    Route::get('npa_news/list', 'Admin\NewsController@npaNewsList')->name('news.npa.list');
    Route::get('expert_news/list', 'Admin\NewsController@expertNewsList')->name('news.expert.list');
    Route::get('faq/list', 'Admin\NewsController@faqList')->name('news.faq.list');
    Route::post('faq', 'Admin\NewsController@faqNew')->name('news.faq.new');

//    Route::get('news/{tag}/list', 'Admin\NewsController@newsListByTag')->name('news.listByTag');
    Route::get('news/{id}', 'Admin\NewsController@get')->name('news.get');
    Route::post('news/{id}/like', 'Admin\NewsController@likeNews')->name('news.like');
    Route::post('news/{id}/unlike', 'Admin\NewsController@unlikeNews')->name('news.unlike');
    Route::post('news/newsCommentStore', 'Admin\NewsController@newsCommentStore')->name('news.newsCommentStore');
    Route::post('news/subscribe', 'Admin\NewsController@subscribe')->name('news.subscribe');
    Route::get('news/unsubscribe/{uuid}', 'Admin\NewsController@unsubscribe')->name('news.unsubscribe');

    Route::get('employee/{employeeId}', 'AboutController@showEmployee')->name('employee.show');

    Route::get('career', 'CareerController@index')->name('career');
    Route::get('career/create', 'CareerController@create')->name('career.form.create');
    Route::post('career/store', 'CareerController@store')->name('career.form.store');

//    Route::get('partner', 'ExternalPartnerController@index')->name('partner');
    Route::get('partner/info/{id}', 'ExternalPartnerController@info')->name('partner.info');
//    Route::get('partner/{id}/summary', 'PartnerController@summary')->name('partner.summary');
//    Route::get('partner/create', 'PartnerController@create')->name('partner.form.create');
//    Route::post('partner/store', 'PartnerController@store')->name('partner.form.store');


    Route::get('storage_/docs/{profile}/{image}', "FileController@showDocs");
    Route::get('storage_/profilePhoto/{profile}/{image}', "FileController@showPhoto");
    Route::get('storage_/ServiceJournal/{serviceJournalId}/client_docs/{image}', "FileController@serviceClientDocShow");
    Route::get('storage_/ServiceJournal/{serviceJournalId}/accountant_docs/{image}', "FileController@serviceAccountantDocShow");

    //Route::get('services', 'ServicesController@index')->name('services.list');
    //Route::get('services/{servicesId}/order', 'ServicesController@serviceOrder')->name('services.create');
    Route::get('choseServices/{catalogId}', 'ServicesController@choseServices')->name('services.choseServices');
    Route::get('services/{servicesId}', 'ServicesController@serviceInfo')->name('services.serviceInfo');
    Route::get('servicesCompare', 'ServicesController@servicesCompare')->name('services.servicesCompare');
    Route::get('paymentInfo', 'ServicesController@paymentInfo')->name('Client.services.paymentInfo');
    Route::post('services/getServiceTotals', 'ServicesController@getServiceTotals')->name('services.getServiceTotals');
    Route::post('services/sendCommercialOffer', 'ServicesController@sendCommercialOffer')->name('services.sendCommercialOffer');
    Route::post('services/sendServiceRequirement', 'ServicesController@sendServiceRequirement')->name('services.sendServiceRequirement');

    Route::get('common_data/vue/standart_contract_template_type/list', 'Company\StandartContractTemplateTypeController@entityList');
    Route::get('common_data/vue/standart_contract_template/list', 'Company\StandartContractTemplateController@commonDataEntityList');
    Route::get('common_data/vue/standart_contract_template/download', 'Company\StandartContractTemplateController@download');

    Route::get('services/getCatalogNode/{nodeId}', 'ServicesController@getCatalogNode')->name('services.getCatalogNode');

    Route::get('events', 'EventsController@index')->name('events');

    Route::post('callMe', 'HomeController@callMe')->name('callMe');
    Route::post('becomePartner', 'HomeController@becomePartner')->name('becomePartner');

    Route::post('/newPotentialClient', 'HomeController@newPotentialClient')->name('newPotentialClient');
    Route::get('/createPotentialClientSuccess', 'HomeController@createPotentialClientSuccess')->name('createPotentialClientSuccess');

    Route::get('tnved', [\App\Http\Controllers\OkedController::class, 'index'])->name('oked.index');
//    Route::get('review', [\App\Http\Controllers\ReviewController::class, 'index'])->name('review.index');
    Route::get('check_partner', [\App\Http\Controllers\HomeController::class, 'check_partner'])->name('check_partner.index');

//    Route::get('/service_consultation/info', [\App\Http\Controllers\ConsultationService::class, 'info'])->name('service.consultation.info');
//    Route::get('/service_consultation/form', [\App\Http\Controllers\ConsultationService::class, 'form'])->name('service.consultation.form');
//    Route::post('/service_consultation', [\App\Http\Controllers\ConsultationService::class, 'newQuestion'])->name('service.consultation.new_question');
//    Route::get('/service_consultation/paymentComplete',  [\App\Http\Controllers\ConsultationService::class, 'paymentComplete'])->name('service.consultation.paymentComplete');

  Route::group(['middleware' => ['auth', 'setLocale', 'role:Client', 'setLocationByIP']], function () {
    Route::get('extra_services/paymentType', [\App\Http\Controllers\ExtraServicesController::class, 'setPaymentType'])->name('ExtraServices.setPaymentType');
    Route::get('extra_services/preOrder', [\App\Http\Controllers\ExtraServicesController::class, 'preOrder'])->name('ExtraServices.preOrder');
    Route::post('extra_services/order', [\App\Http\Controllers\ExtraServicesController::class, 'order'])->name('ExtraServices.order');
  });


  Route::get('extra_services/paymentInfo', [\App\Http\Controllers\ExtraServicesController::class, 'paymentInfo'])->name('ExtraServices.paymentInfo');
  Route::get('extra_services/{serviceCode}', [\App\Http\Controllers\ExtraServicesController::class, 'index'])->name('ExtraServices.index');
  Route::post('extra_services/steps', [\App\Http\Controllers\ExtraServicesController::class, 'steps'])->name('ExtraServices.steps');

    Route::namespace('Payment')->prefix('payment')->group(function () {
        Route::post('/paybox/payment_result', 'PayboxController@payment_result')->name('Payment.paybox.payment_result');
    });


    Route::group(['middleware' => ['auth']], function () {
        Route::get('/profile', 'ProfileController@index')->name('profile');
        Route::post('profile/addPhoto', 'ProfileController@addPhoto')->name('profile.photo.add');
    });

    Route::prefix('salemanager')->group(function () {
        Route::group(['middleware' => ['auth', 'role:SaleManager']], function () {
            Route::get('services', 'SaleManager\ServicesController@serviceList')->name('sale_manager.service.list');
            Route::get('services/{service_status_id}', 'SaleManager\ServicesController@serviceListByStatus')->name('sale_manager.service.list_by_status');
            Route::post('services/setManager', 'SaleManager\ServicesController@setManager')->name('sale_manager.service.setManager');
            Route::post('services/setProfileLegalInfo', 'SaleManager\ServicesController@setProfileLegalInfo')->name('sale_manager.service.setProfileLegalInfo');
            Route::get('services/setInWork/{serviceJournal}', 'SaleManager\ServicesController@setInWork')->name('sale_manager.service.setInWork');

            Route::get('servicesJournal/{servicesJournalId}', 'ServicesController@show')->name('sale_manager.serviceJournal.show');
            // Modal content for service details (Sale Manager)
            Route::get('vue/servicesJournal/{servicesJournalId}/modal', 'SaleManager\ServicesController@serviceJournalModal')->name('sale_manager.serviceJournal.modal');

            Route::get('clients', 'SaleManager\ClientController@index')->name('sale_manager.client.index');
            Route::get('vue/clientList', 'SaleManager\ClientController@clientList')->name('sale_manager.client.list');
            Route::post('vue/clientList/setAgent', 'SaleManager\ClientController@setAgent')->name('sale_manager.client.setAgent');

            Route::get('commercial_offers', 'SaleManager\CommercialOfferController@index')->name('sale_manager.commercial_offer.index');
            Route::get('commercial_offers/create', 'SaleManager\CommercialOfferController@create')->name('sale_manager.commercial_offer.create');
            Route::post('commercial_offers/store', 'SaleManager\CommercialOfferController@store')->name('sale_manager.commercial_offer.store');
            Route::get('commercial_offers/prepareServiceById', 'SaleManager\CommercialOfferController@prepareServiceById')->name('sale_manager.commercial_offer.prepareServiceById');
            
            // Test route for debugging
            Route::get('test-button', function() {
    return view('test-button');
})->name('test.button');

Route::get('test-simple', function() {
    return view('test-simple');
})->name('test.simple');

Route::get('test-alpine', function() {
    return view('test-alpine');
})->name('test.alpine');


            Route::get('potential_client', 'SaleManager\PotentialClientController@index')->name('sale_manager.potential_client.index');
            Route::get('createCabinet/{potentialClientId}', 'SaleManager\PotentialClientController@createCabinet')->name('sale_manager.potential_client.createCabinet');
            Route::get('setContacted/{potentialClientId}', 'SaleManager\PotentialClientController@setContacted')->name('sale_manager.potential_client.setContacted');

        });
    });


    Route::namespace('Admin')->prefix('admin')->group(function () {
        Route::group(['middleware' => ['auth', 'setLocale', 'role:Administrator']], function () {

            Route::get('registration_form_template/optionset_type', 'RegistrationFormTemplateController@indexOptionsetType')
                ->name('admin.registrationFormTemplate.optionsetType.index');
            Route::get('vue/registration_form_template/optionset_type/list', 'RegistrationFormTemplateController@entityListOptionsetType');
            Route::post('vue/registration_form_template/optionset_type/store', 'RegistrationFormTemplateController@storeOptionsetType');
            Route::post('vue/registration_form_template/optionset_type/delete', 'RegistrationFormTemplateController@deleteOptionsetType');

            Route::get('registration_form_template/parameter_group', 'RegistrationFormTemplateController@indexParameterGroup')
                ->name('admin.registrationFormTemplate.parameterGroup.index');
            Route::get('vue/registration_form_template/parameter_group/list', 'RegistrationFormTemplateController@entityListParameterGroup');
            Route::post('vue/registration_form_template/parameter_group/store', 'RegistrationFormTemplateController@storeParameterGroup');
            Route::post('vue/registration_form_template/parameter_group/delete', 'RegistrationFormTemplateController@deleteParameterGroup');


            Route::get('vue/registration_form_template/optionset_value_template/list', 'RegistrationFormTemplateController@entityListOptionsetValueTemplate');
            Route::post('vue/registration_form_template/optionset_value_template/store', 'RegistrationFormTemplateController@storeOptionsetValueTemplate');
            Route::post('vue/registration_form_template/optionset_value_template/delete', 'RegistrationFormTemplateController@deleteOptionsetValueTemplate');


            Route::get('registration_form_template', 'RegistrationFormTemplateController@index')
                ->name('admin.registrationFormTemplate.index');
            Route::get('registration_form_template/show/{registrationFormTemplateId}', 'RegistrationFormTemplateController@show')->name('admin.registrationFormTemplate.show');
            Route::get('vue/registration_form_template/list', 'RegistrationFormTemplateController@entityList');
            Route::post('vue/registration_form_template/store', 'RegistrationFormTemplateController@store');
            Route::post('vue/registration_form_template/delete', 'RegistrationFormTemplateController@delete');

            Route::get('vue/registration_form_group_template/list', 'RegistrationFormGroupTemplateController@entityList');
            Route::post('vue/registration_form_group_template/store', 'RegistrationFormGroupTemplateController@store');
            Route::post('vue/registration_form_group_template/delete', 'RegistrationFormGroupTemplateController@delete');
            Route::get('vue/registration_form_group_template/move', 'RegistrationFormGroupTemplateController@move');
            Route::get('vue/registration_form_group_template/parameterGroupList/{registrationFormTemplateId}', 'RegistrationFormGroupTemplateController@getParameterGroupList');

            Route::get('vue/registration_form_parameter_template/list/{registrationFormGroupTemplateId}', 'RegistrationFormParameterTemplateController@entityList');
            Route::post('vue/registration_form_parameter_template/store', 'RegistrationFormParameterTemplateController@store');
            Route::post('vue/registration_form_parameter_template/delete', 'RegistrationFormParameterTemplateController@delete');
            Route::get('vue/registration_form_parameter_template/move', 'RegistrationFormParameterTemplateController@move');


            Route::get('vue/rfpt_table_structure/list/{parameterTemplateId}', 'RegistrationFormParameterTemplateTableStructureController@entityList');
            Route::post('vue/rfpt_table_structure/store', 'RegistrationFormParameterTemplateTableStructureController@store');
            Route::post('vue/rfpt_table_structure/delete', 'RegistrationFormParameterTemplateTableStructureController@delete');
            Route::get('vue/rfpt_table_structure/move', 'RegistrationFormParameterTemplateTableStructureController@move');

            Route::get('users', 'UserController@index')->name('admin.users.list');
            Route::get('vue/users', 'UserController@userList');
            Route::post('vue/users/update', 'UserController@update');
            Route::post('vue/users/store', 'UserController@store');
            Route::get('vue/users/activate/{id}', 'UserController@activate');
            Route::get('vue/users/deactivate/{id}', 'UserController@deactivate');
            Route::get('vue/users/getCityList', 'UserController@getCityList');
            Route::get('vue/users/getPartnerExtra/{id}', 'UserController@getPartnerExtra');
            Route::post('vue/users/setPartnerExtra', 'UserController@setPartnerExtra');
            Route::get('vue/users/getManagerList', 'UserController@getManagerList');
            Route::get('vue/users/{id}/getProfileCites', 'UserController@getProfileCites');
            Route::get('vue/users/{id}/setProfileCity/{cityId}', 'UserController@setProfileCity');
            Route::get('vue/users/{id}/deleteProfileCity/{profileCityId}', 'UserController@deleteProfileCity');

            Route::get('vue/users/getLicenseTypeList', 'UserController@getLicenseTypeList');
            Route::get('vue/users/{id}/getProfileLicenseType', 'UserController@getProfileLicenseType');
            Route::get('vue/users/{id}/setProfileLicenseType/{licenseTypeId}', 'UserController@setProfileLicenseType');
            Route::get('vue/users/{id}/deleteProfileLicenseType/{profileLicenseTypeId}', 'UserController@deleteProfileLicenseType');


            Route::get('service_category', 'Service\ServiceCategoryController@index')->name('admin.service_category');
            Route::get('vue/service_category/list', 'Service\ServiceCategoryController@entityList');
            Route::get('vue/service_category_with_system/list', 'Service\ServiceCategoryController@entityWithSystemList');
            Route::post('vue/service_category/update', 'Service\ServiceCategoryController@update');
            Route::post('vue/service_category/store', 'Service\ServiceCategoryController@store');
            Route::post('vue/service_category/delete', 'Service\ServiceCategoryController@delete');
            Route::post('vue/service_category/changePhoto/{id}', 'Service\ServiceCategoryController@changePhoto');

            Route::get('service_list', 'Service\ServiceController@index')->name('admin.service_list');
            Route::get('vue/service_list/list', 'Service\ServiceController@entityList');
            Route::post('vue/service_list/delete', 'Service\ServiceController@delete');

            Route::get('service_import', 'Service\ServiceImportController@index')->name('admin.service_import');
            Route::post('vue/service_import/store', 'Service\ServiceImportController@store')->name('admin.service_import.store');


            Route::get('vue/get_service_category_list', 'Service\ServiceCategoryController@getServiceCategoryList');
            Route::get('vue/get_service_thematic_group_list', 'Service\ServiceThematicGroupController@getServiceThematicGroupList');

            Route::get('service_thematic_group', 'Service\ServiceThematicGroupController@index')->name('admin.service_thematic_group');
            Route::get('vue/service_thematic_group/list/{service_category}', 'Service\ServiceThematicGroupController@entityList');
            Route::post('vue/service_thematic_group/update', 'Service\ServiceThematicGroupController@update');
            Route::post('vue/service_thematic_group/store', 'Service\ServiceThematicGroupController@store');
            Route::post('vue/service_thematic_group/delete', 'Service\ServiceThematicGroupController@delete');


            Route::get('/vue/counter_type/entity_list', 'Dictionary\CounterTypeController@entityList');

            Route::get('service/show/{serviceCategory}/{serviceThematicGroupId}/{serviceId}', 'Service\ServiceController@show')->name('admin.service.show');
            Route::get('vue/service/get/{serviceId}', 'Service\ServiceController@get')->name('admin.service.get');
            Route::post('vue/service/update', 'Service\ServiceController@update')->name('admin.service.update');
            Route::post('vue/service/store', 'Service\ServiceController@store')->name('admin.service.store');
            Route::post('vue/service/move', 'Service\ServiceController@move')->name('admin.service.move');

            Route::get('service_step_list', 'Service\ServiceStepController@index')->name('admin.service_step_list');
            Route::get('vue/service_step/list/{serviceId}', 'Service\ServiceStepController@getListByServiceId')->name('admin.service_step.getStepList');
            Route::get('vue/service_step/listAndDict/{serviceId}', 'Service\ServiceStepController@getListAndDict')->name('admin.service_step.getStepListAndDict');
            Route::post('vue/service_step/set', 'Service\ServiceStepController@set');
            Route::post('vue/service_step/delete/{id}', 'Service\ServiceStepController@delete');

            Route::get('vue/service_step_map/list/{serviceId}', 'Service\ServiceStepMapController@getListByService')->name('admin.service_step.getStepList');
            Route::get('vue/service_step_map/listAndDict/{serviceId}', 'Service\ServiceStepMapController@getListAndDict')->name('admin.service_step.getStepListAndDict');
            Route::post('vue/service_step_map/set', 'Service\ServiceStepMapController@set');
            Route::post('vue/service_step_map/delete/{id}', 'Service\ServiceStepMapController@delete');

            Route::get('vue/service_additional_requirements_map/list/{serviceId}', 'Service\ServiceAdditionalRequirementsMapController@getListByService')->name('admin.service_additional_requirements_map.getStepList');
            Route::get('vue/service_additional_requirements_map/listAndDict/{serviceId}', 'Service\ServiceAdditionalRequirementsMapController@getListAndDict')->name('admin.service_additional_requirements_map.getStepListAndDict');
            Route::post('vue/service_additional_requirements_map/set', 'Service\ServiceAdditionalRequirementsMapController@set');
            Route::post('vue/service_additional_requirements_map/delete/{id}', 'Service\ServiceAdditionalRequirementsMapController@delete');


            Route::get('vue/service_step_required_document/list/{serviceStepId}/{serviceId}', 'Service\ServiceStepRequiredDocumentController@getListByServiceStepAndService')->name('admin.service_step.getRequiredDocumentList');
            Route::post('vue/service_step_required_document/set', 'Service\ServiceStepRequiredDocumentController@set');
            Route::post('vue/service_step_required_document/delete/{id}', 'Service\ServiceStepRequiredDocumentController@delete');

            Route::get('vue/service_step_result/list/{serviceStepId}/{serviceId}', 'Service\ServiceStepResultController@getListByServiceStepAndService')->name('admin.service_step.getResultList');
            Route::post('vue/service_step_result/set', 'Service\ServiceStepResultController@set');
            Route::post('vue/service_step_result/delete/{id}', 'Service\ServiceStepResultController@delete');

            Route::get('employee', 'Employee\EmployeeController@index')->name('admin.employee');
            Route::get('vue/employee/list', 'Employee\EmployeeController@getList')->name('admin.employee.getList');
            Route::get('vue/employee/get/{employeeId}', 'Employee\EmployeeController@get')->name('admin.employee.get');
            Route::post('vue/employee/store', 'Employee\EmployeeController@store')->name('admin.employee.store');
            Route::post('vue/employee/update', 'Employee\EmployeeController@update')->name('admin.employee.update');
            Route::post('vue/employee/delete', 'Employee\EmployeeController@delete')->name('admin.employee.delete');
            Route::get('vue/employee/position/list', 'Employee\EmployeeController@getPositionList')->name('admin.employee.getPositionList');
            Route::post('vue/employee/changePhoto/{id}', 'Employee\EmployeeController@changePhoto')->name('admin.employee.changePhoto');

            Route::get('vue/employee_education/getList/{employeeId}', 'Employee\EmployeeEducationController@getList')->name('admin.employee_education.getList');
            Route::get('vue/employee_education/get/{employeeEducationId}', 'Employee\EmployeeEducationController@get')->name('admin.employee_education.get');
            Route::post('vue/employee_education/store', 'Employee\EmployeeEducationController@store')->name('admin.employee_education.store');
            Route::post('vue/employee_education/update', 'Employee\EmployeeEducationController@update')->name('admin.employee_education.update');
            Route::post('vue/employee_education/delete', 'Employee\EmployeeEducationController@delete')->name('admin.employee_education.delete');

            Route::get('vue/employee_skill/getList/{employeeId}', 'Employee\EmployeeSkillController@getList')->name('admin.employee_skill.getList');
            Route::get('vue/employee_skill/get/{employeeSkillId}', 'Employee\EmployeeSkillController@get')->name('admin.employee_skill.get');
            Route::post('vue/employee_skill/store', 'Employee\EmployeeSkillController@store')->name('admin.employee_skill.store');
            Route::post('vue/employee_skill/update', 'Employee\EmployeeSkillController@update')->name('admin.employee_skill.update');
            Route::post('vue/employee_skill/delete', 'Employee\EmployeeSkillController@delete')->name('admin.employee_skill.delete');

            Route::get('vue/employee_work_experience/getList/{employeeId}', 'Employee\EmployeeWorkExperienceController@getList')->name('admin.employee_work_experience.getList');
            Route::get('vue/employee_work_experience/get/{employeeSkillId}', 'Employee\EmployeeWorkExperienceController@get')->name('admin.employee_work_experience.get');
            Route::post('vue/employee_work_experience/store', 'Employee\EmployeeWorkExperienceController@store')->name('admin.employee_work_experience.store');
            Route::post('vue/employee_work_experience/update', 'Employee\EmployeeWorkExperienceController@update')->name('admin.employee_work_experience.update');
            Route::post('vue/employee_work_experience/delete', 'Employee\EmployeeWorkExperienceController@delete')->name('admin.employee_work_experience.delete');

            Route::get('vue/employee_speciality/getList/{employeeId}', 'Employee\EmployeeSpecialityController@getList')->name('admin.employee_speciality.getList');
            Route::get('vue/employee_speciality/get/{employeeSkillId}', 'Employee\EmployeeSpecialityController@get')->name('admin.employee_speciality.get');
            Route::post('vue/employee_speciality/store', 'Employee\EmployeeSpecialityController@store')->name('admin.employee_speciality.store');
            Route::post('vue/employee_speciality/update', 'Employee\EmployeeSpecialityController@update')->name('admin.employee_speciality.update');
            Route::post('vue/employee_speciality/delete', 'Employee\EmployeeSpecialityController@delete')->name('admin.employee_speciality.delete');

            Route::get('vue/employee_social/getList/{employeeId}', 'Employee\EmployeeSocialController@getList')->name('admin.employee_social.getList');
            Route::get('vue/employee_social/get/{employeeSkillId}', 'Employee\EmployeeSocialController@get')->name('admin.employee_social.get');
            Route::post('vue/employee_social/store', 'Employee\EmployeeSocialController@store')->name('admin.employee_social.store');
            Route::post('vue/employee_social/update', 'Employee\EmployeeSocialController@update')->name('admin.employee_social.update');
            Route::post('vue/employee_social/delete', 'Employee\EmployeeSocialController@delete')->name('admin.employee_social.delete');
            Route::get('vue/employee_social/social_type/getList', 'Employee\EmployeeSocialController@getSocialTypeList')->name('admin.employee_social.social_type.getList');


            Route::get('countries', 'CountriesController@index')->name('admin.countries.list');
            Route::get('countries/{id}', 'CountriesController@get')->name('admin.countries.get');
            Route::get('countries_/create', 'CountriesController@create')->name('admin.countries.create');
            Route::post('countries/store', 'CountriesController@store')->name('admin.countries.store');
            Route::get('countries/{id}/edit', 'CountriesController@edit')->name('admin.countries.edit');
            Route::put('countries/{id}', 'CountriesController@update')->name('admin.countries.update');
            Route::get('countries/destroy/{id}', 'CountriesController@destroy')->name('admin.countries.destroy');

            Route::get('dictionary/city', 'Dictionary\CityController@index')->name('admin.dictionary.city');
            Route::get('vue/dictionary/city/list/{countryId}', 'Dictionary\CityController@getList')->name('admin.dictionary.city.getList');
            Route::post('vue/dictionary/city/store', 'Dictionary\CityController@store')->name('admin.dictionary.city.store');
            Route::post('vue/dictionary/city/update', 'Dictionary\CityController@update')->name('admin.dictionary.city.update');
            Route::post('vue/dictionary/city/delete', 'Dictionary\CityController@delete')->name('admin.dictionary.city.delete');

            Route::get('dictionary/company', 'Dictionary\CompanyController@index')->name('admin.dictionary.company');
            Route::get('vue/dictionary/company/list/{countryId}', 'Dictionary\CompanyController@getListByCountry')->name('admin.dictionary.company.getList');
            Route::post('vue/dictionary/company/store', 'Dictionary\CompanyController@store')->name('admin.dictionary.company.store');
            Route::post('vue/dictionary/company/update', 'Dictionary\CompanyController@update')->name('admin.dictionary.company.update');
            Route::post('vue/dictionary/company/delete', 'Dictionary\CompanyController@delete')->name('admin.dictionary.company.delete');
            Route::post('vue/dictionary/company/changePhoto/{id}', 'Dictionary\CompanyController@changePhoto')->name('admin.dictionary.company.changePhoto');

            Route::get('dictionary/licenseType', 'Dictionary\LicenseTypeController@index')->name('admin.dictionary.licenseType');
            Route::get('vue/dictionary/licenseType/list', 'Dictionary\LicenseTypeController@getList')->name('admin.dictionary.licenseType.getList');
            Route::post('vue/dictionary/licenseType/set', 'Dictionary\LicenseTypeController@set')->name('admin.dictionary.licenseType.set');
            Route::delete('vue/dictionary/licenseType/delete/{id}', 'Dictionary\LicenseTypeController@delete')->name('admin.dictionary.licenseType.delete');

            Route::get('dictionary/serviceResult', 'Dictionary\ServiceResultController@index')->name('admin.dictionary.serviceResult');
            Route::get('vue/dictionary/serviceResult/list', 'Dictionary\ServiceResultController@getList')->name('admin.dictionary.serviceResult.getList');
            Route::post('vue/dictionary/serviceResult/set', 'Dictionary\ServiceResultController@set')->name('admin.dictionary.serviceResult.set');
            Route::delete('vue/dictionary/serviceResult/delete/{id}', 'Dictionary\ServiceResultController@delete')->name('admin.dictionary.serviceResult.delete');


            Route::get('dictionary/serviceRequiredDocument', 'Dictionary\ServiceRequiredDocumentController@index')->name('admin.dictionary.serviceRequiredDocument');
            Route::get('vue/dictionary/serviceRequiredDocument/list', 'Dictionary\ServiceRequiredDocumentController@getList')->name('admin.dictionary.serviceRequiredDocument.getList');
            Route::post('vue/dictionary/serviceRequiredDocument/set', 'Dictionary\ServiceRequiredDocumentController@set')->name('admin.dictionary.serviceRequiredDocument.set');
            Route::delete('vue/dictionary/serviceRequiredDocument/delete/{id}', 'Dictionary\ServiceRequiredDocumentController@delete')->name('admin.dictionary.serviceRequiredDocument.delete');


            Route::get('dictionary/serviceAdditionalRequirementsType', 'Dictionary\ServiceAdditionalRequirementsTypeController@index')->name('admin.dictionary.serviceAdditionalRequirementsType');
            Route::get('vue/dictionary/serviceAdditionalRequirementsType/list', 'Dictionary\ServiceAdditionalRequirementsTypeController@getList')->name('admin.dictionary.serviceAdditionalRequirementsType.getList');
            Route::post('vue/dictionary/serviceAdditionalRequirementsType/set', 'Dictionary\ServiceAdditionalRequirementsTypeController@set')->name('admin.dictionary.serviceAdditionalRequirementsType.set');
            Route::delete('vue/dictionary/serviceAdditionalRequirementsType/delete/{id}', 'Dictionary\ServiceAdditionalRequirementsTypeController@delete')->name('admin.dictionary.serviceAdditionalRequirementsType.delete');

            Route::get('dictionary/serviceAdditionalRequirements', 'Dictionary\ServiceAdditionalRequirementsController@index')->name('admin.dictionary.serviceAdditionalRequirements');
            Route::get('vue/dictionary/serviceAdditionalRequirements/list', 'Dictionary\ServiceAdditionalRequirementsController@getList')->name('admin.dictionary.serviceAdditionalRequirements.getList');
            Route::post('vue/dictionary/serviceAdditionalRequirements/set', 'Dictionary\ServiceAdditionalRequirementsController@set')->name('admin.dictionary.serviceAdditionalRequirements.set');
            Route::delete('vue/dictionary/serviceAdditionalRequirements/delete/{id}', 'Dictionary\ServiceAdditionalRequirementsController@delete')->name('admin.dictionary.serviceAdditionalRequirements.delete');

            Route::get('mainServiceCarousels', 'MainServiceCarouselController@index')->name('admin.mainServiceCarousel.list');
            Route::get('mainServiceCarousels/create', 'MainServiceCarouselController@create')->name('admin.mainServiceCarousel.create');
            Route::post('mainServiceCarousels/store', 'MainServiceCarouselController@store')->name('admin.mainServiceCarousel.store');
            Route::get('mainServiceCarousels/{id}', 'MainServiceCarouselController@get')->name('admin.serviceCarousel.get');
            Route::get('mainServiceCarousels/{id}/edit', 'MainServiceCarouselController@edit')->name('admin.serviceCarousel.edit');
            Route::put('mainServiceCarousels/{id}', 'MainServiceCarouselController@update')->name('admin.mainServiceCarousel.update');
            Route::get('mainServiceCarousels/destroy/{id}', 'MainServiceCarouselController@destroy')->name('admin.mainServiceCarousel.destroy');
            Route::get('_serviceListByCategory/{serviceCategory}/{countryId}', 'MainServiceCarouselController@serviceListByCategory');


            Route::get('article', 'ArticleController@index')->name('admin.article.list');
            Route::get('article/create', 'ArticleController@create')->name('admin.article.create');
            Route::post('article/store', 'ArticleController@store')->name('admin.article.store');
            Route::get('article/{id}/edit', 'ArticleController@edit')->name('admin.article.edit');
            Route::put('article', 'ArticleController@update')->name('admin.article.update');
            Route::get('article/destroy/{id}', 'ArticleController@destroy')->name('admin.article.destroy');


            Route::get('workingCalendar', 'WorkingCalendarController@index')->name('admin.workingCalendar.list');
            Route::get('workingCalendar/{id}', 'WorkingCalendarController@get')->name('admin.workingCalendar.get');
            Route::get('workingCalendar/create', 'WorkingCalendarController@create')->name('admin.workingCalendar.create');
            Route::post('workingCalendar/store', 'WorkingCalendarController@store')->name('admin.workingCalendar.store');
            Route::get('workingCalendar/{id}/edit', 'WorkingCalendarController@edit')->name('admin.workingCalendar.edit');
            Route::put('workingCalendar/{id}/update', 'WorkingCalendarController@update')->name('admin.workingCalendar.update');
            Route::get('workingCalendar/destroy/{id}', 'WorkingCalendarController@destroy')->name('admin.workingCalendar.destroy');
            Route::put('workingCalendar/{id}', 'WorkingCalendarController@updateWeekDays')->name('admin.workingCalendar.updateWeekDays');

            Route::get('constants', 'ConstantsController@index')->name('admin.constants.index');
            Route::post('constants/setConstant', 'ConstantsController@setConstant')->name('admin.constants.setConstant');

            Route::get('dictionary/counter', 'Dictionary\CounterController@index')->name('admin.dictionary.counter');
            Route::get('vue/dictionary/counter/list', 'Dictionary\CounterController@entityList');
            Route::post('vue/dictionary/counter/update', 'Dictionary\CounterController@update');
            Route::post('vue/dictionary/counter/store', 'Dictionary\CounterController@store');
            Route::post('vue/dictionary/counter/delete', 'Dictionary\CounterController@delete');

            Route::get('catalog', 'Catalog\CatalogController@index')->name('admin.catalog');
            Route::get('vue/catalog/{serviceCategoryId}/getNodeTypeList/{parentNodeId}', 'Catalog\CatalogController@getNodeTypeList')->name('admin.catalog.getNodeTypeList');
            Route::get('vue/catalog/getByParentId/{parentId}', 'Catalog\CatalogController@getByParentId')->name('admin.catalog.getByParentId');
            Route::get('vue/catalog/getByServiceCategory/{serviceCategoryId}', 'Catalog\CatalogController@getByServiceCategory')->name('admin.catalog.getByServiceCategory');
            Route::get('vue/catalog/getByParentNode', 'Catalog\CatalogController@getByParentNode')->name('admin.catalog.getByParentNode');
            Route::post('vue/catalog/getServiceList', 'Catalog\CatalogController@getServiceList')->name('admin.catalog.getServiceList');
            Route::post('vue/catalog/assignService', 'Catalog\CatalogController@assignService')->name('admin.catalog.assignService');
            Route::post('vue/catalog/unassignService', 'Catalog\CatalogController@unassignService')->name('admin.catalog.unassignService');
            Route::post('vue/catalog/changeNodeType', 'Catalog\CatalogController@changeNodeType')->name('admin.catalog.changeNodeType');
            Route::post('vue/catalog/store', 'Catalog\CatalogController@store');
            Route::post('vue/catalog/update', 'Catalog\CatalogController@update');
            Route::post('vue/catalog/delete', 'Catalog\CatalogController@delete');
            Route::get('vue/catalog/moveUp/{nodeId}', 'Catalog\CatalogController@moveUp');
            Route::get('vue/catalog/moveDown/{nodeId}', 'Catalog\CatalogController@moveDown');
            Route::get('vue/catalog/toggleVisibility/{nodeId}', 'Catalog\CatalogController@toggleVisibility');
            Route::get('vue/catalog/toggleBlankPage/{nodeId}', 'Catalog\CatalogController@toggleBlankPage');


            Route::get('event', 'Event\EventController@index')->name('admin.event');
            Route::get('vue/event/list', 'Event\EventController@getList')->name('admin.event.getList');
            Route::get('vue/event/get/{eventId}', 'Event\EventController@get')->name('admin.event.get');
            Route::get('vue/event/getEventTypeList', 'Event\EventController@getEventTypeList')->name('admin.event.getEventTypeList');
            Route::post('vue/event/store', 'Event\EventController@store')->name('admin.event.store');
            Route::post('vue/event/update', 'Event\EventController@update')->name('admin.event.update');
            Route::post('vue/event/delete', 'Event\EventController@delete')->name('admin.event.delete');
            Route::post('vue/event/changePreviewPhoto/{id}', 'Event\EventController@changePreviewPhoto')->name('admin.event.changePreviewPhoto');
            Route::post('vue/event/changeLogoPhoto/{id}', 'Event\EventController@changeLogoPhoto')->name('admin.event.changeLogoPhoto');

            Route::get('faq', 'FaqController@index')->name('admin.faq.list');
            Route::get('vue/faq', 'FaqController@faqList');
            Route::post('vue/faq/update', 'FaqController@update');
            Route::post('vue/faq/store', 'FaqController@store');
        });
    });


    Route::prefix('company')->group(function () {
        Route::group(['middleware' => ['auth', 'setLocale']], function () {
            Route::get('standart_contract_template', 'Company\StandartContractTemplateController@index')->name('company.standart_contract_template');
            Route::get('vue/standart_contract_template/list', 'Company\StandartContractTemplateController@entityList');
            Route::get('vue/standart_contract_template/download', 'Company\StandartContractTemplateController@download');
            Route::post('vue/standart_contract_template/delete', 'Company\StandartContractTemplateController@delete');
            Route::post('vue/standart_contract_template/store', 'Company\StandartContractTemplateController@store');

            Route::get('standart_contract_template_type', 'Company\StandartContractTemplateTypeController@index')->name('company.standart_contract_template_type');
            Route::get('vue/standart_contract_template_type/list', 'Company\StandartContractTemplateTypeController@entityList');
            Route::post('vue/standart_contract_template_type/delete', 'Company\StandartContractTemplateTypeController@delete');
            Route::post('vue/standart_contract_template_type/store', 'Company\StandartContractTemplateTypeController@store');

            // Legacy accountant-facing document templates URL -> redirect to new accountant page
            Route::get('document_template', function() {
                return redirect()->route('Accountant.document_templates');
            })->name('company.document_template');
        });
    });


    Route::namespace('Executor')->prefix('executor')->group(function () {
        Route::group(['middleware' => ['auth', 'setLocale', 'role:Executor']], function () {
            Route::get('projects', 'ProjectController@projectList')->name('executor.project.list');
            Route::get('projects/{projectId}', 'ProjectController@projectShow')->name('executor.project.show');
            Route::get('projects/{service_status_id}/list', 'ProjectController@projectListByStatus')->name('executor.project.list_by_status');

            Route::get('task/{taskId}', 'TaskController@taskShow')->name('executor.task.show');
            Route::get('task/start/{taskId}', 'TaskController@start')->name('executor.task.start');
            Route::get('task/end/{taskId}', 'TaskController@end')->name('executor.task.end');

            Route::post('task/addDocument', 'TaskController@addDocument')->name('executor.taskDocument.add');
            Route::get('task/deleteDocument/{taskId}/{docId}', 'TaskController@deleteDocument')->name('executor.taskDocument.delete');
            Route::post('task/close', 'TaskController@close')->name('executor.taskDocument.close');
            Route::post('task/start/{$taskId}', 'TaskController@start')->name('executor.taskDocument.start');
            Route::post('task/messageList', 'TaskController@messageList')->name('executor.task.messageList');
            Route::post('task/message/create', 'TaskController@messageCreate')->name('executor.task.message.create');

            // Executor Messages page
            Route::get('messages', 'MessageController@index')->name('executor.messages');

        });
    });

    Route::prefix('manager')->group(function () {
        Route::group(['middleware' => ['auth', 'setLocale', 'role:Manager|Partner']], function () {
            Route::get('executorList', 'Manager\ManagerController@executorsList')->name('manager.executor.list');
            Route::get('servicesList', 'Manager\ManagerController@servicesList')->name('manager.services.list');
            Route::get('services/{projectStatusId}/list', 'Manager\ManagerController@servicesListByStatus')->name('manager.project.list_by_status');

            Route::get('groupsList', 'Manager\ManagerController@groupsList')->name('manager.groups.list');
            Route::get('manager/groups/create', 'Manager\ManagerController@createGroup')->name('Manager.groups.create');
            Route::post('manager/groups/store', 'Manager\ManagerController@storeGroup')->name('Manager.groups.store');
            Route::get('manager/groups/{id}/edit', 'Manager\ManagerController@editGroup')->name('Manager.groups.edit');
            Route::put('manager/groups/{id}', 'Manager\ManagerController@updateGroup')->name('Manager.groups.update');
            Route::get('manager/groups/destroy/{id}', 'Manager\ManagerController@destroyGroup')->name('Manager.groups.destroy');
            Route::get('manager/groups/{id}/bodyEdit', 'Manager\ManagerController@bodyEditGroup')->name('Manager.groups.bodyEdit');
            Route::put('manager/groups/{id}/bodyUpdate', 'Manager\ManagerController@bodyUpdateGroup')->name('Manager.groups.bodyUpdate');
            Route::get('manager/groups/destroy/{id}/bodyDestroy', 'Manager\ManagerController@bodyDestroyGroup')->name('Manager.groups.bodyDestroy');

            Route::get('services/{servicesJournalId}', 'Manager\ManagerController@servicesJournalShow')->name('Manager.services.show');
            Route::get('services/{servicesJournalId}/startExecution', 'Manager\ManagerController@startExecution')->name('Manager.services.startExecution');
            Route::post('services/startReview', 'Manager\ManagerController@startReview')->name('Manager.services.startReview');
            Route::post('services/finishClientCheck', 'Manager\ManagerController@finishClientCheck')->name('Manager.services.finishClientCheck');
            Route::post('services/sendBackToClient', 'Manager\ManagerController@sendBackToClient')->name('Manager.services.sendBackToClient');
            Route::get('services/{servicesJournalId}/close', 'Manager\ManagerController@close')->name('Manager.services.close');


            Route::get('services/{servicesJournalId}/taskExecutorAdd', 'Manager\ManagerController@taskExecutorAdd')->name('Manager.services.taskExecutorAdd');
            Route::get('services/{servicesJournalId}/taskGroupAdd', 'Manager\ManagerController@taskGroupAdd')->name('Manager.services.taskGroupAdd');
            Route::put('services/taskExecutorAdd/{id}/Add', 'Manager\ManagerController@taskExecutorUpdate')->name('Manager.services.taskExecutorUpdate');
            Route::put('services/taskGroupAdd/{id}/Add', 'Manager\ManagerController@taskGroupUpdate')->name('Manager.services.taskGroupUpdate');
            Route::get('services/taskExecutor/destroy/{id}', 'Manager\ManagerController@taskExecutorDestroy')->name('Manager.services.taskExecutorDestroy');
            Route::get('service/getTaskExecutorList', 'Manager\ManagerController@getTaskExecutorList')->name('Manager.services.getTaskExecutorList');
            //Route::get('services/{servicesJournalId}/taskExecutorAdd', 'Manager\ManagerController@taskExecutorAdd')->name('Manager.services.taskExecutorAdd');
            //Route::get('services/{servicesJournalId}/taskGroupAdd', 'Manager\ManagerController@taskGroupAdd')->name('Manager.services.taskGroupAdd');

            Route::post('services/taskExecutorAdd', 'Manager\ManagerController@taskExecutorAdd')->name('Manager.services.taskExecutorAdd');
            //Route::put('services/taskGroupAdd/{id}/Add', 'Manager\ManagerController@taskGroupUpdate')->name('Manager.services.taskGroupUpdate');
            Route::get('services/taskExecutor/destroy', 'Manager\ManagerController@taskExecutorDestroy')->name('Manager.services.taskExecutorDestroy');
            Route::get('manager/services/executorListPart', 'Manager\ManagerController@executorListPart')->name('Manager.services.executorListPart');
            Route::get('services/taskExecutor/destroyGroup/{id}', 'Manager\ManagerController@taskExecutorDestroyGroup')->name('Manager.services.taskExecutorDestroyGroup');
            Route::post('services/messageList/{servicesJournalId}', 'MessageController@managerMessageList')->name('Manager.services.messageList');
            Route::post('services/message/serviceJournalCreate', 'MessageController@addManagerServiceMessage')->name('Manager.service.message.create');

            Route::post('services/messageTaskList', 'MessageController@messageTaskList')->name('Manager.services.messageTaskList');
            Route::post('services/messageTask/create', 'MessageController@addTaskMessage')->name('Manager.service.messageTask.create');
            Route::post('executor/setHourlyRate', 'Manager\ManagerController@setHourlyRate')->name('Manager.executor.setHourlyRate');

        });
    });

    Route::group(['middleware' => ['auth', 'setLocale', 'role:Manager|Partner']], function () {
        Route::get('manager/messages', 'MessageController@managerServiceMessageList')->name('Manager.service.message.list');
        Route::get('manager/messageList/{serviceJournalId}', 'MessageController@managerMessageList')->name('Manager.message.list');
        Route::post('manager/messages/serviceJournalCreate', 'MessageController@addManagerServiceMessage')->name('Manager.service.message.create');
    });

    Route::prefix('curator')->group(function () {
        Route::group(['middleware' => ['auth', 'setLocale', 'role:Curator']], function () {
            Route::get('reviewList', 'Curator\CuratorController@reviewList')->name('curator.review.list');
            Route::get('review/{projectId}/show', 'Curator\CuratorController@reviewShow')->name('curator.review.show');
            Route::get('review/comments', 'Curator\CuratorController@reviewComments')->name('curator.review.comments');
            Route::post('review/commentAdd', 'Curator\CuratorController@addComment')->name('curator.review.addComment');
            Route::get('review/setStatus/{projectId}/{statusId}', 'Curator\CuratorController@setStatus')->name('curator.review.setStatus');
        });
    });

    Route::prefix('manager')->group(function () {
        Route::group(['middleware' => ['auth', 'setLocale', 'role:Manager']], function () {
            Route::get('review/{projectId}/show', 'Manager\ManagerController@reviewShow')->name('manager.review.show');
            Route::get('review/comments', 'Manager\ManagerController@reviewComments')->name('manager.review.comments');
            Route::post('review/commentAdd', 'Manager\ManagerController@addComment')->name('manager.review.addComment');
            Route::get('review/setStatus/{projectId}/{statusId}', 'Manager\ManagerController@setStatus')->name('manager.review.setStatus');
        });
    });


    Route::group(['middleware' => ['auth', 'setLocale', 'role:Client|Manager|SaleManager',]], function () {
        Route::get('servicesJournal/{servicesJournalId}/edit', 'ServicesController@edit')->name('Client.serviceJournal.edit');
    });

    Route::group(['middleware' => ['auth', 'setLocale', 'role:Manager',]], function () {
        Route::get('manager/servicesJournal/{servicesJournalId}', 'ServicesController@show')->name('manager.serviceJournal.show');
    });


    Route::group(['middleware' => ['auth', 'setLocale', 'role:Client', 'setLocationByIP']], function () {
        Route::get('profile/_documentList', 'ProfileController@documentList')->name('Client._documentList');
        Route::post('profile/addDocument', 'ProfileController@addDocument')->name('profile.document.add');
        Route::get('profile/uploadFile', 'ProfileController@uploadForm')->name('Client.uploadFile');
        Route::get('profile/services', 'ProfileController@serviceList')->name('Client.service.list');
        Route::get('profile/deleteDocument/{documentId}', 'ProfileController@deleteDocument')->name('profile.document.delete');
        Route::get('profile/bookkeeping', 'ProfileController@bookkeeping')->name('profile.bookkeeping');
        Route::get('profile/documents', 'ProfileController@documentList')->name('profile.documentList');

        Route::get('client/_serviceDocList/{serviceStep}/{serviceJournal}', 'ServicesController@stepReqDocList')->name('Client._serviceDocList');
        Route::get('messages', 'MessageController@clientServiceMessageList')->name('Client.service.message.list');
        Route::get('servicesJournal/{servicesJournalId}', 'ServicesController@show')->name('Client.serviceJournal.show');

        Route::get('servicesJournal/{servicesJournalId}/sendToCheck', 'ServicesController@sendToCheck')->name('Client.serviceJournal.sendToCheck');
        Route::post('servicesJournal/addStepDocument', 'ServicesController@addStepDocument')->name('Client.StepDocument.add');
        Route::post('servicesJournal/setData', 'ServicesController@setData')->name('Client.serviceJournal.setData');

        Route::get('orderInfo', 'ServicesController@preOrder')->name('Client.services.preOrder');
        Route::get('paymentType', 'ServicesController@setPaymentType')->name('Client.services.setPaymentType');
        Route::post('services/store', 'ServicesController@order')->name('Client.services.order');
        Route::get('servicesJournal/deleteDocument/{serviceJournal}/{serviceJournalClientDocumentId}/{isactive}', 'ServicesController@deleteDocument')->name('Client.deleteDocument');
        Route::get('messages', 'MessageController@clientServiceMessageList')->name('Client.service.message.list');
        Route::get('messageList/{serviceJournalId}', 'MessageController@clientMessageList')->name('Client.message.list');
        Route::post('messages/clientServiceJournalCreate', 'MessageController@addClientServiceMessage')->name('Client.service.message.create');

        Route::post('servicesJournal/{servicesJournalId}/setPayment', 'ServicesController@setPayment')->name('Client.serviceJournal.setPayment');
        Route::get('servicesJournal/{servicesJournalId}/successPayment', 'ServicesController@successPayment')->name('Client.serviceJournal.successPayment');
        Route::get('servicesJournal/{servicesJournalId}/failPayment', 'ServicesController@failPayment')->name('Client.serviceJournal.failPayment');

        Route::get('tempTemplate', 'ServicesController@tempTemplate');

        Route::get('client/agreement/downloadPdf', 'ClientController@downloadAgreementPdf')->name('client.agreement.downloadPdf');
        Route::get('client/paymentInvoice/downloadPdf', 'ClientController@downloadPaymentInvoicePdf')->name('client.paymentInvoice.downloadPdf');
        Route::get('client/invoice/downloadPdf', 'ClientController@downloadInvoicePdf')->name('client.invoice.downloadPdf');
        Route::get('client/getAccounting', 'ClientController@getAccounting')->name('client.accounting');
        Route::get('client/vue/services/list', 'ClientController@getServiceJounalList')->name('client.getServiceJounalList');

    });

    Route::group(['middleware' => ['auth', 'setLocale', 'role:Head']], function () {
        Route::namespace('Report')->prefix('report')->group(function () {
            Route::get('/', 'ReportController@index')->name('Report.index');
            Route::get('/vue/getClientReportData', 'ReportController@getClientCountReportData')->name('Report.getClientReportData');
            Route::get('/vue/getServiceCompeteReportData', 'ReportController@getServiceCompeteReportData')->name('Report.getServiceCompeteReportData');
            Route::get('/vue/getServiceInProgressReportData', 'ReportController@getServiceInProgressReportData')->name('Report.getServiceInProgressReportData');
            Route::get('/vue/getServiceNoPaymentAmountReportData', 'ReportController@getServiceNoPaymentAmountReportData')->name('Report.getServiceNoPaymentAmountReportData');
            Route::get('/vue/getAttendanceData', 'ReportController@getAttendanceReportData')->name('Report.getAttendanceReportData');
            Route::get('/vue/getJobEvaluationReportData', 'ReportController@getJobEvaluationReportData')->name('Report.getJobEvaluationReportData');
        });

        Route::namespace('Head')->prefix('career')->group(function () {
            Route::get('/index', 'CareerController@index')->name('head.career.index');
            Route::get('/vue/list', 'CareerController@getList')->name('head.career.getList');
            Route::post('/vue/list/delete', 'CareerController@delete')->name('head.career.delete');
            Route::get('/show/{careerFormId}', 'CareerController@show')->name('head.career.show');
        });

        Route::namespace('Head')->prefix('partner')->group(function () {
            Route::get('/index', 'PartnerController@index')->name('head.partner.index');
            Route::get('/vue/list', 'PartnerController@getList')->name('head.partner.getList');
            Route::post('/vue/list/delete', 'PartnerController@delete')->name('head.partner.delete');
            Route::get('/show/{partnerFormId}', 'PartnerController@show')->name('head.partner.show');
        });

        Route::namespace('Head')->prefix('head')->group(function () {
            Route::get('services', 'HeadController@getServiceList')->name('head.services');
            Route::post('services/setServiceJournalStatus', 'HeadController@setServiceJournalStatus')->name('head.service.setServiceJournalStatus');
            Route::get('agreement/downloadPdf', 'HeadController@downloadAgreementPdf');
            Route::get('agreement/downloadWord', 'HeadController@downloadAgreementWord');
            Route::get('vue/services/list', 'HeadController@entityList');
        });
    });

    Route::namespace('Accountant')->prefix('accountant')->group(function () {
        Route::group(['middleware' => ['auth', 'setLocale', 'role:Accountant']], function () {
            Route::get('/', 'AccountantController@index')->name('Accountant.index');
            Route::get('services', 'AccountantController@getServiceList')->name('Accountant.services');
            Route::get('document-templates', 'AccountantController@documentTemplates')->name('Accountant.document_templates');
            Route::post('document-templates/upload', 'AccountantController@uploadDocument')->name('Accountant.document_templates.upload');
            Route::get('document-templates/{id}/download', 'AccountantController@downloadDocument')->name('Accountant.document_templates.download');
            Route::get('vue/services/list', 'AccountantController@entityList');
            Route::post('vue/services/confirmPayment', 'AccountantController@confirmPayment')->name('accountant.service.confirmPayment');
            Route::post('services/generateAgreement', 'AccountantController@generateAgreement')->name('accountant.service.generateAgreement');
            Route::get('agreement/downloadPdf', 'AccountantController@downloadAgreementPdf');
            Route::get('agreement/downloadWord', 'AccountantController@downloadAgreementWord');

            Route::post('services/generatePaymentInvoice', 'AccountantController@generatePaymentInvoice')->name('accountant.service.generatePaymentInvoice');
            Route::get('paymentInvoice/downloadPdf', 'AccountantController@downloadPaymentInvoicePdf');
            Route::get('paymentInvoice/downloadExcel', 'AccountantController@downloadPaymentInvoiceExcel');

            Route::post('services/generateInvoice', 'AccountantController@generateInvoice')->name('accountant.service.generateInvoice');
            Route::get('invoice/downloadPdf', 'AccountantController@downloadInvoicePdf');
            Route::get('invoice/downloadExcel', 'AccountantController@downloadInvoiceExcel');
            Route::get('generateDocuments', 'AccountantController@generateDocuments');
        });
    });

    // Moved to accountant section

    Route::prefix('service_journal')->group(function () {
        Route::group(['middleware' => ['auth', 'setLocale', 'role:Accountant|Head|Client']], function () {
            Route::get('vue/documents/list', 'Company\DocumentController@documentList');
            Route::get('vue/documents/download', 'Company\DocumentController@download');
        });
    });

    Route::namespace('Agent')->prefix('agent')->group(function () {
        Route::group(['middleware' => ['auth', 'setLocale', 'role:Agent']], function () {
            Route::get('client', 'ClientController@index')->name('agent.client.index');
            Route::get('/vue/agent/clientList', 'ClientController@clientList')->name('agent.client.clientList');
            Route::get('/vue/agent/getServiceJournalList/{clientId}', 'ClientController@getServiceJournalList')->name('agent.client.getServiceJournalList');
        });
    });
});

Route::namespace('Core')->prefix('art')->group(function () {
    // Controllers Within The "App\Http\Controllers\Core" Namespace
    // Matches The "/art/.." URL
    Route::get('migrate_install', 'ArtisanController@migrate_install');
    Route::get('migrate', 'ArtisanController@migrate');
    Route::get('clear_cache', 'ArtisanController@clearCache');
    Route::get('cache', 'ArtisanController@cache');
    Route::get('clearCompiled', 'ArtisanController@clearCompiled');
    Route::get('storageLink', 'ArtisanController@storageLink');
//    Route::get('seed', 'ArtisanController@seedData');
});


//Route::get('testPHP', function () {
//    return view('testPHP');
//});
//
//Route::get('testMail', function () {
//    EmailDal::sendNewEmails();
//});

Route::get('fix_tags', [\App\Http\Controllers\HomeController::class, 'fixTagList']);


Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');

Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');


Route::get('testMailN', [\App\Http\Controllers\HomeController::class, 'testMail']);

Route::get('test_document', [\App\Http\Controllers\Accountant\AccountantController::class, 'generatePrepaymentDocuments']);

Route::get('php_info', function () {
  phpinfo();
});
