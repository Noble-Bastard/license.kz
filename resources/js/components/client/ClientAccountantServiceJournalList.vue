<template>
    <div>
        <div class="row">
            <div class="col-12">

                <div class="row pb-3">
                    <div class="col-3">
                        <label for="service_status_id">{{trans.get('messages.all.service_status')}}</label>
                        <select class="form-control" id="service_status_id" @change="onServiceStatusChange()" v-model="selectedServiceStatusId">
                            <option :value="serviceStatus.id" v-for="(serviceStatus, index) in pServiceStatuses">
                                {{serviceStatus.name}}
                            </option>
                        </select>
                    </div>
                </div>

                <div>
                    <table class="table table-striped table-responsive-sm col-12">
                        <thead>
                            <tr>
                                <th class="w-10">{{trans.get('messages.all.service_number')}}</th>
                                <th class="w-55">{{trans.get('messages.all.name')}}</th>
                                <th class="w-55">{{trans.get('messages.all.cost')}}</th>
                                <th class="w-55">{{trans.get('messages.admin.service.service_step.tax')}}</th>
                                <th class="w-55">{{trans.get('messages.accountant.is_client_check_paid')}}</th>
                                <th class="w-55">{{trans.get('messages.accountant.is_prepayment_paid')}}</th>
                                <th class="w-55">{{trans.get('messages.accountant.is_final_paid')}}</th>
                                <th class="w-55"/>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="serviceJournalList.length === 0">
                                <td colspan="9">
                                    {{trans.get('messages.all.no_rows')}}
                                </td>
                            </tr>

                            <tr v-for="(serviceJournal, index) in serviceJournalList">
                                <td class="text-center">№{{serviceJournal.service_no}}</td>
                                <td>
                                    {{serviceJournal.service_name}}
                                </td>
                                <td class="text-center">
                                    {{serviceJournal.amount}}
                                    {{serviceJournal.currency_name}}
                                </td>
                                <td class="text-center">
                                    {{serviceJournal.tax === null ? 0 : serviceJournal.tax}}
                                    {{serviceJournal.currency_name}}
                                </td>

                                <td class="td-container">
                                    <confirm-payment-cell
                                            :confirm-payment-callback="null"
                                            :p-service-journal-id="serviceJournal.id"
                                            :p-service-description="serviceJournal.service_no + ' ' + trans.get('messages.accountant.is_client_check_paid')"
                                            :p-confirm-amount="serviceJournal.client_check_amount"
                                            :p-confirm-amount-currency="serviceJournal.currency_name"
                                            :p-confirm-flag="serviceJournal.is_client_check_paid * 1"
                                            :p-preview-mode="true"
                                            :p-invoice-type-id="1"/>
                                </td>

                                <td class="td-container">
                                    <confirm-payment-cell
                                            :confirm-payment-callback="null"
                                            :p-service-journal-id="serviceJournal.id"
                                            :p-service-description="serviceJournal.service_no + ' ' + trans.get('messages.accountant.is_prepayment_paid')"
                                            :p-confirm-amount="serviceJournal.prepayment_amount"
                                            :p-confirm-amount-currency="serviceJournal.currency_name"
                                            :p-confirm-flag="serviceJournal.is_prepayment_paid * 1"
                                            :p-preview-mode="true"
                                            :p-invoice-type-id="2"/>
                                </td>

                                <td class="td-container">
                                    <confirm-payment-cell
                                            :confirm-payment-callback="null"
                                            :p-service-journal-id="serviceJournal.id"
                                            :p-service-description="serviceJournal.service_no + ' ' + trans.get('messages.accountant.is_final_paid')"
                                            :p-confirm-amount="serviceJournal.final_amount"
                                            :p-confirm-amount-currency="serviceJournal.currency_name"
                                            :p-confirm-flag="serviceJournal.is_final_paid * 1"
                                            :p-preview-mode="true"
                                            :p-invoice-type-id="3"/>
                                </td>

                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                            <i class="fa fa-bars"/>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item"
                                               @click="showDocuments(serviceJournal.id, serviceJournal.service_no)">{{trans.get('messages.company.documents')}}
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

        <div class="modal fade" role="dialog" id="service-journal-documents-modal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{selectedServiceJournalDescription}}</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <service-journal-documents
                            :key="serviceJournalDocumentsKey"
                            :p-preview-mode="true"
                            :p-service-journal-id="selectedServiceJournalId">

                        </service-journal-documents>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">
                                {{trans.get('messages.all.cancel')}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import ConfirmPaymentCell from '../accountant/ConfirmPaymentCell.vue'
    import ServiceJournalDocuments from '../service-journal/ServiceJournalDocuments.vue'

    export default {
        components: {
            ConfirmPaymentCell: ConfirmPaymentCell,
            ServiceJournalDocuments
        },
        name: "ClientAccountantServiceJournalList",
        data() {
            return {
                baseUrl: '/client/vue/services',
                serviceJournalList: [],
                selectedServiceStatusId: this.pServiceStatuses[0].id,
                selectedServiceJournalId: null,
                serviceJournalDocumentsKey: 0,
                selectedServiceJournalDescription: this.trans.get('messages.company.documents')
            }
        },
        props: {
            'pServiceJournalList': Array,
            'pServiceStatuses': Array,
        },
        mounted() {
            this.serviceJournalList = this.pServiceJournalList;
        },
        computed: {
        },
        methods: {
            getEntityList() {
                let requestUrl = this.baseUrl + '/list'
                    + '?serviceStatusId=' + this.selectedServiceStatusId;

                axios.get(requestUrl).then(response => {
                    this.serviceJournalList = response.data.serviceJournalList;
                });
            },
            showDocuments(serviceJournalId, serviceJournalDescription) {
                this.selectedServiceJournalId = serviceJournalId;
                this.selectedServiceJournalDescription = this.trans.get('messages.company.documents')
                    + ' ' + serviceJournalDescription;
                this.serviceJournalDocumentsKey++;
                $('#service-journal-documents-modal').modal('show');
            },
            onServiceStatusChange(){
                this.getEntityList();
            },
        },
    }

</script>

<style scoped>
    table td.td-container {
        height: 1px;
        padding: 0;
    }
</style>


