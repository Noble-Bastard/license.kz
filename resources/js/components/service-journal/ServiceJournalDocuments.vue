<template>
    <div>

        <div class="row">
            <div class="col-12">

                <div>
                    <table class="table table-striped table-responsive-sm col-12">
                        <thead>
                            <tr>
                                <th class="w-10">{{trans.get('messages.serviceJournal.document.no')}}</th>
                                <th class="w-10">{{trans.get('messages.serviceJournal.document.date')}}</th>
                                <th class="w-55">{{trans.get('messages.serviceJournal.document.type')}}</th>
                                <th class="w-55">{{trans.get('messages.serviceJournal.document.accountDocumentSubType')}}</th>
                                <th class="w-55"/>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="serviceJournalDocuments.length === 0">
                                <td colspan="5">
                                    {{trans.get('messages.all.no_rows')}}
                                </td>
                            </tr>

                            <tr v-for="(serviceJournalDocument, index) in serviceJournalDocuments">
                                <td class="text-center">№{{serviceJournalDocument.document_no}}</td>
                                <td>{{serviceJournalDocument.document_date  | moment("DD.MM.YYYY")}}</td>
                                <td class="text-center">{{serviceJournalDocument.document_type_name}}</td>
                                <td class="text-center">{{serviceJournalDocument.document_sub_type_name}}</td>

                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                            <i class="fa fa-bars"/>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a v-if="!pPreviewMode" class="dropdown-item"
                                               @click="download(serviceJournalDocument.document_sub_type_id, serviceJournalDocument.document_type_id, 0)">{{trans.get('messages.serviceJournal.document.download')}}
                                            </a>
                                            <a class="dropdown-item"
                                               @click="download(serviceJournalDocument.document_sub_type_id, serviceJournalDocument.document_type_id, 1)">{{trans.get('messages.serviceJournal.document.downloadCopy')}}
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
</template>

<script>
    export default {
        name: "ServiceJournalDocuments",
        props: {
            'pServiceJournalId': Number,
            'pPreviewMode': {
                type: Boolean,
                default: true
            }
        },
        data() {
            return {
                baseUrl: '/service_journal/vue/documents',
                serviceJournalDocuments: []
            }
        },
        mounted() {
            this.getEntityList();
        },
        computed: {
        },
        methods: {
            getEntityList() {
                let requestUrl = this.baseUrl + '/list'
                    + '?serviceJournalId=' + this.pServiceJournalId;

                axios.get(requestUrl).then(response => {
                    this.serviceJournalDocuments = response.data.serviceJournalDocuments;
                });
            },
            download(documentSubTypeId, documentTypeId, isCopy) {
                let requestUrl = this.baseUrl + '/download'
                    + '?serviceJournalId=' + this.pServiceJournalId
                + '&documentTypeId=' + documentTypeId
                + '&documentSubTypeId=' + documentSubTypeId
                + '&isCopy=' + isCopy;

                window.open(requestUrl);
            }
        },
    }
</script>

<style scoped>

</style>
