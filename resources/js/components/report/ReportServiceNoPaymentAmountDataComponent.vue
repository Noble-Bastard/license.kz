<template>
            <div class="card">
                <div class="card-header">
                    {{trans.get('messages.head.report.ServiceNoPaymentAmount')}}

                </div>
                <div class="card-body">
                    <h1> {{serviceNoPaymentAmountCount.sum}} {{serviceNoPaymentAmountCount.currency}}</h1>
                </div>
            </div>
</template>

<script>
    export default {
        name: "ReportServiceNoPaymentAmountDataComponent",
        data() {

            return {
                url:'/report/vue/getServiceNoPaymentAmountReportData',
                endDate: this.initialEndDate,
                startDate: this.initialStartDate,
                countryId: this.initialCountryId,
                serviceNoPaymentAmountCount: {
                    sum: 0,
                    currency: 'т'
                }
            }
        },
        props: {
            'initialCountryId':Number,
            'initialStartDate':String,
            'initialEndDate':String
        },
        mounted() {
            this.getServiceNoPaymentAmountReportData();
        },

        methods:{
            getServiceNoPaymentAmountReportData(){

                let $requestURL = this.url + '?'
                    + 'countryId=' + this.countryId
                    + '&startDate=' + this.startDate
                    + '&endDate=' + this.endDate;

                axios.get($requestURL).then(response => {
                    if(response.data.sum != undefined) {
                        this.serviceNoPaymentAmountCount = response.data;
                    }
                });
            },
        }
    }
</script>

<style scoped>

</style>