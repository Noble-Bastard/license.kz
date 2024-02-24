<template>

            <div class="card">
                <div class="card-header">
                    {{trans.get('messages.head.report.ClientCount')}}

                </div>
                <div class="card-body">
                    <h1> {{clientCount}} {{trans.get('messages.head.report.Clients')}}</h1>
                </div>
            </div>

</template>

<script>
    export default {
        name: "ReportClientCountComponent",
        data() {

            return {
                url:'/report/vue/getClientReportData',
                endDate: this.initialEndDate,
                startDate: this.initialStartDate,
                countryId: this.initialCountryId,
                clientCount:null
            }
        },
        props: {
            'initialCountryId':Number,
            'initialStartDate':String,
            'initialEndDate':String

        },
        mounted() {
            this.getClientCountReportData();
        },

        methods:{
            getClientCountReportData(){

                let $requestURL = this.url + '?'
                    + 'countryId=' + this.countryId
                    + '&startDate=' + this.startDate
                    + '&endDate=' + this.endDate;

                axios.get($requestURL).then(response => {
                    this.clientCount = response.data;
                });
            },
        }
    }
</script>

<style scoped>

</style>