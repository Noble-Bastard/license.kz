<template>

            <div class="card">
                <div class="card-header">
                    {{trans.get('messages.head.report.ServiceCompete')}}
                </div>
                <div class="card-body">
                    <h1> {{ServiceCompeteCount}}  {{trans.get('messages.head.report.requests')}}</h1>
                </div>
            </div>

</template>

<script>
    export default {
        name: "ReportServiceCompeteDataComponent",
        data() {

            return {
                url:'/report/vue/getServiceCompeteReportData',
                endDate: this.initialEndDate,
                startDate: this.initialStartDate,
                countryId: this.initialCountryId,
                ServiceCompeteCount:null
            }
        },
        props: {
            'initialCountryId':Number,
            'initialStartDate':String,
            'initialEndDate':String

        },
        mounted() {
            this.getServiceCompeteReportData();
        },

        methods:{
            getServiceCompeteReportData(){

                let $requestURL = this.url + '?'
                    + 'countryId=' + this.countryId
                    + '&startDate=' + this.startDate
                    + '&endDate=' + this.endDate;

                axios.get($requestURL).then(response => {
                    this.ServiceCompeteCount = response.data;
                });
            },
        }
    }
</script>

<style scoped>

</style>