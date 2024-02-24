<template>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="title-main">
                    {{trans.get('messages.all.services')}}
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row pb-3">
                            <div class="col-12 flex-align-right">
                                <div class="btn-group btn-group-toggle">
                                    <button :value="projectStatus.id" v-for="(projectStatus, index) in pProjectStatuses"
                                       class="btn btn-primary pointer"
                                       :class="selectedProjectStatusId === projectStatus.id ? 'active' : ''"
                                       @click="onServiceStatusChange(projectStatus.id)">
                                        {{projectStatus.name}}
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div>
                            <table id="services" class="table table-striped table-responsive-sm col-12">
                                <thead>
                                <tr>
                                    <th>{{trans.get('messages.manager.number')}}</th>
                                    <th>{{trans.get('messages.all.status')}}</th>
                                    <th>{{trans.get('messages.manager.name')}}</th>
                                    <th>{{trans.get('messages.manager.request_date')}}</th>
                                    <th>{{trans.get('messages.manager.client')}}</th>
                                    <th>{{trans.get('messages.all.manager')}}</th>
                                    <th>{{trans.get('messages.accountant.is_client_check_paid')}}</th>
                                    <th>{{trans.get('messages.accountant.is_prepayment_paid')}}</th>
                                    <th>{{trans.get('messages.accountant.is_final_paid')}}</th>
                                    <th/>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-if="serviceJournalList.length === 0">
                                    <td colspan="10">
                                        {{trans.get('messages.all.no_rows')}}
                                    </td>
                                </tr>
                                <tr v-for="(serviceJournal, index) in serviceJournalList">
                                    <td>
                                        <a v-if="serviceJournal.project_status_id === cnstReviewProjectStatus"
                                           class="messageWindowLink"
                                           :href="'/manager/review/' + serviceJournal.project_id + '/show'">
                                            {{serviceJournal.service_no }}
                                        </a>

                                        <a v-else class="messageWindowLink"
                                           :href="'/manager/services/' + serviceJournal.id">
                                            {{serviceJournal.service_no }}
                                        </a>

                                    </td>
                                    <td>
                                        {{serviceJournal.service_status_name }}
                                        <span v-if="serviceJournal.service_status_id === cnstClientCheckServiceStatus
                                                            && serviceJournal.is_client_check_paid === 0">
                                                <strong>({{trans.get('messages.manager.payment-waiting')}})</strong>
                                            </span>
                                    </td>
                                    <td>{{serviceJournal.service_name }}</td>
                                    <td>{{serviceJournal.create_date | moment("DD.MM.YYYY") }}</td>
                                    <td class="text-center">{{serviceJournal.client_full_name}}</td>
                                    <td class="text-center">{{serviceJournal.manager_full_name }}</td>
                                    <td class="text-center"
                                        :class="getBackgroundColor(serviceJournal.client_check_amount, serviceJournal.is_client_check_paid)">
                                        {{(serviceJournal.is_client_check_paid === 1) ? trans.get('messages.all.yes') :
                                        trans.get('messages.all.no')}}
                                    </td>
                                    <td class="text-center"
                                        :class="getBackgroundColor(serviceJournal.prepayment_amount, serviceJournal.is_prepayment_paid)">
                                        {{(serviceJournal.is_prepayment_paid === 1) ? trans.get('messages.all.yes') :
                                        trans.get('messages.all.no')}}
                                    </td>
                                    <td class="text-center"
                                        :class="getBackgroundColor(serviceJournal.final_amount, serviceJournal.is_final_paid)">
                                        {{(serviceJournal.is_final_paid === 1) ? trans.get('messages.all.yes') :
                                        trans.get('messages.all.no')}}
                                    </td>
                                    <td>

                                        <div class="dropdown"
                                             v-if="serviceJournal.service_status_id === cnstClientCheckServiceStatus
                                                                && serviceJournal.is_client_check_paid === 1
                                                        || serviceJournal.project_status_id === cnstClosedProjectStatus
                                                        || serviceJournal.service_status_id === cnstCheckServiceStatus"
                                        >
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                <i class="fa fa-bars"/>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a v-if="serviceJournal.service_status_id === cnstClientCheckServiceStatus
                                                                && serviceJournal.is_client_check_paid === 1"
                                                   class="dropdown-item"
                                                   @click="showFinishClientCheckModal(serviceJournal.id)">
                                                    {{trans.get('messages.manager.finish_client_check')}}
                                                </a>
                                                <!--                                                    <a v-if="serviceJournal.project_status_id === cnstDoneProjectStatus"-->
                                                <!--                                                       class="dropdown-item"-->
                                                <!--                                                       @click="showSendToCuratorModal(serviceJournal.id)">-->
                                                <!--                                                        {{trans.get('messages.manager.finish_client_check')}}-->
                                                <!--                                                    </a>-->
                                                <a v-if="serviceJournal.project_status_id === cnstClosedProjectStatus"
                                                   class="dropdown-item"
                                                   @click="showCloseServiceJournalModal(serviceJournal.id)">
                                                    {{trans.get('messages.manager.finish')}}
                                                </a>
                                                <a v-if="serviceJournal.project_status_id === cnstClosedProjectStatus"
                                                   class="dropdown-item"
                                                   @click="showStartReviewModal(serviceJournal.id)">
                                                    {{trans.get('messages.manager.start_review')}}
                                                </a>

                                                <a v-if="serviceJournal.service_status_id === cnstCheckServiceStatus"
                                                   class="dropdown-item"
                                                   :href="'./servicesJournal/' + serviceJournal.id" target="_blank">
                                                    {{trans.get('messages.manager.check_client_documents')}}
                                                </a>

                                                <a v-if="serviceJournal.service_status_id === cnstCheckServiceStatus"
                                                   class="dropdown-item"
                                                   @click="showSendBackToClientDataCollectionModal(serviceJournal.id)">
                                                    {{trans.get('messages.manager.send_back_to_client')}}
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
            </div>
        </div>

        <div class="modal fade" role="dialog" :id="startReviewModalName">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{selectedServiceJournalDescription}}</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" @change="form.errors.clear($event.target.name)"
                         @keydown="form.errors.clear($event.target.name)">

                        <div class="row">
                            <div class="col-12">
                                <span>
                                    {{trans.get('messages.manager.start_review_confirmation')}}
                                </span>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">
                            {{trans.get('messages.all.cancel')}}
                        </button>
                        <button type="button" @click="startReview()" :disabled="form.errorsOrSend()"
                                class="btn btn-primary">
                            {{trans.get('messages.all.confirm')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" role="dialog" :id="closeServiceJournalModalName">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{selectedServiceJournalDescription}}</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" @change="form.errors.clear($event.target.name)"
                         @keydown="form.errors.clear($event.target.name)">

                        <div class="row">
                            <div class="col-12">
                                <span>
                                    {{trans.get('messages.manager.close_service_journal_confirmation')}}
                                </span>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">
                            {{trans.get('messages.all.cancel')}}
                        </button>
                        <button type="button" @click="closeServiceJournal()" :disabled="form.errorsOrSend()"
                                class="btn btn-primary">
                            {{trans.get('messages.all.confirm')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" :id="finishClientCheckModalName">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>{{selectedServiceJournalDescription}}</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" @change="form.errors.clear($event.target.name)"
                         @keydown="form.errors.clear($event.target.name)">

                        <div class="row">
                            <div class="col-12">
                                <form-group
                                        :p-caption="trans.get('messages.manager.client_check_result')"
                                        p-field-name="clientCheckResultTypeId"
                                        :p-form="form"
                                        :p-type="componentType.Select"
                                        :p-dict-list="clientCheckResultTypeList"
                                        p-dict-val-name="name"
                                        :p-is-empty-choice-available="false"
                                />
                            </div>
                        </div>

                        <div v-if="form.clientCheckResultTypeId === clientCheckResultTypeList[0].id" class="row">
                            <div class="col-12">
                                <form-group
                                        :p-caption="trans.get('messages.manager.prepayment_percent')"
                                        p-field-name="prepaymentPercent"
                                        :p-form="form"
                                        :p-type="componentType.Input"
                                        p-input-type="number"
                                        :p-read-only="false"
                                />
                            </div>
                        </div>

                        <div v-else-if="form.clientCheckResultTypeId === clientCheckResultTypeList[1].id" class="row">
                            <div class="col-12">
                                <form-group
                                        :p-caption="trans.get('messages.manager.reject_reason')"
                                        p-field-name="rejectReason"
                                        :p-form="form"
                                        :p-type="componentType.Input"
                                        p-input-type="text"
                                        :p-read-only="false"
                                />
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">
                            {{trans.get('messages.all.cancel')}}
                        </button>
                        <button type="button" @click="finishClientCheck()" :disabled="form.errorsOrSend()"
                                class="btn btn-primary">
                            {{trans.get('messages.all.submit')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" :id="sendBackToClientDataCollectionModalName">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>{{selectedServiceJournalDescription}}</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" @change="form.errors.clear($event.target.name)"
                         @keydown="form.errors.clear($event.target.name)">

                        <div class="row">
                            <div class="col-12">
                                <form-group
                                        :p-caption="trans.get('messages.manager.reject_reason')"
                                        p-field-name="rejectReason"
                                        :p-form="form"
                                        :p-type="componentType.Textarea"
                                        p-input-type="text"
                                        :p-read-only="false"
                                />
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">
                            {{trans.get('messages.all.cancel')}}
                        </button>
                        <button type="button" @click="sendBackToClientDataCollection()" :disabled="form.errorsOrSend()"
                                class="btn btn-primary">
                            {{trans.get('messages.all.submit')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>

<script>

    export default {
        name: "ManagerServiceJournalList",
        props: {
            'pProjectStatuses': Array,
            'pServiceJournalList': Array
        },
        data() {
            return {
                baseUrl: '/manager/services',
                serviceJournalList: [],
                selectedServiceJournalId: null,
                selectedProjectStatusId: null,
                selectedServiceJournalDescription: '',
                form: {},
                defaultEntity: {
                    serviceJournalId: null,
                    clientCheckResultTypeId: clientCheckResultType.Success,
                    prepaymentPercent: 0,
                    rejectReason: ''
                },
                componentType: formComponentType,
                cnstClientCheckServiceStatus: serviceStatus.ClientCheck,
                cnstCheckServiceStatus: serviceStatus.Check,
                cnstDoneProjectStatus: projectStatus.Done,
                cnstReviewProjectStatus: projectStatus.Review,
                cnstClosedProjectStatus: projectStatus.Closed,
                clientCheckResultTypeList: [
                    {
                        id: clientCheckResultType.Success,
                        name: this.trans.get('messages.manager.client_check_result_success')
                    },
                    {
                        id: clientCheckResultType.Reject,
                        name: this.trans.get('messages.manager.client_check_result_reject')
                    }
                ],
            }
        },
        created() {
            this.form = new Form(this.defaultEntity);
            this.selectedProjectStatusId = this.pProjectStatuses[0].id;
        },
        mounted() {
            this.serviceJournalList = this.pServiceJournalList;
        },
        computed: {
            finishClientCheckModalName: function () {
                return 'finish-client-check-modal';
            },
            closeServiceJournalModalName: function () {
                return 'close-service-journal-modal';
            },
            sendBackToClientDataCollectionModalName: function () {
                return 'send-back-to-client-modal';
            },
            startReviewModalName: function () {
                return 'start-review-modal';
            }
        },
        methods: {
            getEntityList() {
                let requestUrl = this.baseUrl + '/' + this.selectedProjectStatusId + '/list';
                axios.get(requestUrl).then(response => {
                    this.serviceJournalList = response.data.serviceJournalList;
                });
            },
            onServiceStatusChange(projectStatusId) {
                this.selectedProjectStatusId = projectStatusId;
                this.getEntityList();
            },
            getServiceJournal(serviceJournalId) {
                return this.serviceJournalList.filter(sjl => sjl.id === serviceJournalId)[0];
            },
            spliceServiceJournal(serviceJournalId) {
                let index = this.serviceJournalList.findIndex(sjl => sjl.id === serviceJournalId);
                this.serviceJournalList.splice(index);
            },
            showSendBackToClientDataCollectionModal(serviceJournalId) {
                let serviceJournal = this.getServiceJournal(serviceJournalId);
                this.form = new Form(this.defaultEntity);
                this.form.serviceJournalId = serviceJournalId;
                this.selectedServiceJournalDescription = this.trans.get('messages.manager.send_back_to_client')
                    + ' ' + serviceJournal.service_no;

                $('#' + this.sendBackToClientDataCollectionModalName).modal('show');
            },
            sendBackToClientDataCollection() {
                let url = this.baseUrl + '/sendBackToClient';
                this.form.post(url)
                    .then(response => {
                        this.spliceServiceJournal(this.form.serviceJournalId);
                        $('#' + this.sendBackToClientDataCollectionModalName).modal('hide');
                        this.$notify({
                            group: 'all',
                            position: 'top right',
                            text: this.trans.get('messages.admin.system.success.update'),
                            type: 'success'
                        });
                    });
            },
            showFinishClientCheckModal(serviceJournalId) {
                let serviceJournal = this.getServiceJournal(serviceJournalId);
                this.form = new Form(this.defaultEntity);
                this.form.serviceJournalId = serviceJournalId;
                this.selectedServiceJournalId = serviceJournalId;
                this.selectedServiceJournalDescription = this.trans.get('messages.manager.finish_client_check')
                    + ' ' + serviceJournal.service_no;

                $('#' + this.finishClientCheckModalName).modal('show');
            },
            finishClientCheck() {
                let url = this.baseUrl + '/finishClientCheck';
                this.form.post(url)
                    .then(response => {
                        this.spliceServiceJournal(this.form.serviceJournalId);
                        $('#' + this.finishClientCheckModalName).modal('hide');
                        this.$notify({
                            group: 'all',
                            position: 'top right',
                            text: this.trans.get('messages.admin.system.success.update'),
                            type: 'success'
                        });
                    });
            },
            showStartReviewModal(serviceJournalId) {
                let serviceJournal = this.getServiceJournal(serviceJournalId);
                this.form = new Form(this.defaultEntity);
                this.form.serviceJournalId = serviceJournalId;
                this.selectedServiceJournalDescription = this.trans.get('messages.manager.start_review')
                    + ' ' + serviceJournal.service_no;
                this.selectedServiceJournalId = serviceJournalId;

                $('#' + this.startReviewModalName).modal('show');
            },
            startReview() {
                let requestUrl = this.baseUrl + '/startReview';
                this.form.post(requestUrl).then(response => {
                    this.spliceServiceJournal(this.selectedServiceJournalId);

                    this.$notify({
                        group: 'all',
                        position: 'top right',
                        text: this.trans.get('messages.admin.system.success.update'),
                        type: 'success'
                    });

                    $('#' + this.startReviewModalName).modal('hide');

                    window.open('./review/' + response.data.project.id + '/show');

                });
            },
            showCloseServiceJournalModal(serviceJournalId) {
                let serviceJournal = this.getServiceJournal(serviceJournalId);
                this.selectedServiceJournalDescription = this.trans.get('messages.manager.finish_client_check')
                    + ' ' + serviceJournal.service_no;
                this.selectedServiceJournalId = serviceJournalId;

                $('#' + this.closeServiceJournalModalName).modal('show');
            },
            closeServiceJournal() {
                let requestUrl = this.baseUrl + '/' + this.selectedServiceJournalId + '/close';
                axios.get(requestUrl).then(response => {
                    this.spliceServiceJournal(this.selectedServiceJournalId);

                    this.$notify({
                        group: 'all',
                        position: 'top right',
                        text: this.trans.get('messages.admin.system.success.update'),
                        type: 'success'
                    });

                    $('#' + this.closeServiceJournalModalName).modal('hide');

                });
            },
            getBackgroundColor(amount, paymentFlag) {
                if (amount === null)
                    return 'bg-light';

                return paymentFlag === 1 ? 'bg-light-success' : 'bg-light-danger';
            }
        },
    }

</script>

<style scoped>
    table td.td-container {
        height: 1px;
        padding: 0;
    }

    .bg-light-success {
        background-color: rgba(0, 128, 0, 0.11);
    }

    .bg-light-danger {
        background-color: rgba(255, 0, 0, 0.11);
    }

    .pointer {
        cursor: pointer;
    }

</style>


