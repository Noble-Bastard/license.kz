<template>
    <div class="main-conainer">
        <div class="text-center confirm-payment-container p-3"
            :class="getBackgroundColor">

            {{pConfirmAmount === null ? 0 : (pConfirmAmount * 1).toFixed(2)}}
            {{pConfirmAmountCurrency}}

            <div v-if="(pConfirmFlag * 1) === 0 && pConfirmAmount !== null && !pPreviewMode" class="text-success pointer confirm-payment">
                <span class="far fa-check-circle"
                      :title="trans.get('messages.accountant.confirm_payment')"
                      @click="showConfirmPaymentModal()"/>
            </div>

        </div>

        <div v-if="!pPreviewMode" class="modal fade" tabindex="-1" role="dialog" :id="confirmPaymentModalName">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>{{pServiceDescription}}</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" @change="form.errors.clear($event.target.name)"
                         @keydown="form.errors.clear($event.target.name)">

                        <div class="row">
                            <div class="col-12">
                                <form-group
                                        :p-caption="trans.get('messages.sale_manager.document_number')"
                                        p-field-name="documentNo"
                                        :p-form="form"
                                        :p-type="componentType.Input"
                                        p-input-type="text"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="documentDate">{{trans.get('messages.sale_manager.document_date')}}</label>
                                    <date-picker id="documentDate" name="documentDate" v-model="form.documentDate"
                                                 :config="datepickerOptions"/>
                                    <span v-if="form.errors.has('documentDate')"  :class="['help-block invalid-feedback']">
                                            <strong v-text="form.errors.get('documentDate')"/>
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">
                            {{trans.get('messages.all.cancel')}}
                        </button>
                        <button v-if="!pPreviewMode" type="button" @click="confirmPayment()" :disabled="form.errorsOrSend()" class="btn btn-primary">
                            {{trans.get('messages.accountant.confirm_payment')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';

    export default {
        components: {
            moment: moment,
        },
        name: "ConfirmPaymentCell",
        props: {
            'pConfirmFlag': Number,
            'pConfirmAmount': String,
            'pConfirmAmountCurrency': String,
            'pServiceJournalId': Number,
            'pServiceDescription': String,
            'pInvoiceTypeId': Number,
            'ConfirmPaymentCallback' : Function,
            'pPreviewMode': {
                type: Boolean,
                default: true
            }
        },
        data() {
            return {
                baseUrl: '/accountant/vue/services',
                defaultEntity: {
                    serviceJournalId: null,
                    invoiceTypeId: null,
                    documentNo: '',
                    documentDate: moment(Date.now()).format('DD.MM.YYYY'),
                },
                form: {},
                datepickerOptions: {
                    format: 'DD.MM.YYYY'
                },
                componentType: formComponentType
            }
        },
        created() {
            this.form = new Form(this.defaultEntity);
        },
        initCreate() {
        },
        computed: {
            confirmPaymentModalName: function(){
                return ('confirm-payment-modal-' + this.pServiceJournalId + '-' + this.pInvoiceTypeId);
            },
            getBackgroundColor() {
                if(this.pConfirmAmount === null)
                    return 'bg-light';

                return (this.pConfirmFlag * 1) === 1 ? 'bg-light-success' : 'bg-light-danger';
            }
        },
        methods: {
            confirmPayment() {
                if(this.pPreviewMode)
                    return;
                let url = this.baseUrl + "/confirmPayment";
                this.form.post(url)
                    .then(response => {
                        this.ConfirmPaymentCallback(this.pServiceJournalId, this.pInvoiceTypeId);
                        $('#' + this.confirmPaymentModalName).modal('hide');
                    });
            },
            showConfirmPaymentModal() {
                if(this.pPreviewMode)
                    return;
                this.form = new Form(this.defaultEntity);
                this.form.serviceJournalId = this.pServiceJournalId;
                this.form.invoiceTypeId = this.pInvoiceTypeId;
                $('#' + this.confirmPaymentModalName).modal('show');
            },
        },
    }

</script>

<style scoped>
    .pointer {cursor: pointer;}

    .main-conainer {
        height: 100%;
    }

    .confirm-payment-container {
        position: relative;
        height: 100%;
    }

    .bg-light-success {
        background-color: rgba(0, 128, 0, 0.11);
    }

    .bg-light-danger {
        background-color: rgba(255, 0, 0, 0.11);
    }

    .confirm-payment {
        position: absolute;
        top: 0;
        right: 2px;
    }

</style>
