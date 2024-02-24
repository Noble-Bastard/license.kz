<template>

            <div class="card">
                <div class="card-header">
                    {{trans.get('messages.head.report.ServiceInProgres')}}
                </div>
                <div class="card-body">
                    <h1> {{ServiceInProgressCount}} {{trans.get('messages.head.report.requests')}}</h1>
                </div>
            </div>

</template>

<script>
    export default {
        name: "ReportServiceInProgressDataComponent",
        data() {

            return {
                url:'/report/vue/getServiceInProgressReportData',
                endDate: this.initialEndDate,
                startDate: this.initialStartDate,
                countryId: this.initialCountryId,
                ServiceInProgressCount:null
            }
        },
        props: {
            'initialCountryId':Number,
            'initialStartDate':String,
            'initialEndDate':String

        },
        mounted() {
            this.getServiceInProgressReportData();
        },

        methods:{
            getServiceInProgressReportData(){

                let $requestURL = this.url + '?'
                    + 'countryId=' + this.countryId
                    + '&startDate=' + this.startDate
                    + '&endDate=' + this.endDate;

                axios.get($requestURL).then(response => {
                    this.ServiceInProgressCount = response.data;
                });
            },
        }
    }
</script>

<style scoped>

</style>