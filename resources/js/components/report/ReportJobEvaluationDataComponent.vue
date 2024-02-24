<template>
            <div class="card">
                <div class="card-header">
                    {{trans.get('messages.head.report.JobEvaluation')}}

                </div>
                <div class="card-body">
                    <h1>{{JobEvaluation}}</h1>
                </div>
            </div>
</template>

<script>
    export default {
        name: "ReportJobEvaluationDataComponent",
        data() {

            return {
                url:'/report/vue/getJobEvaluationReportData',
                endDate: this.initialEndDate,
                startDate: this.initialStartDate,
                countryId: this.initialCountryId,
                JobEvaluation:null
            }
        },
        props: {
            'initialCountryId':Number,
            'initialStartDate':String,
            'initialEndDate':String

        },
        mounted() {
            this.getJobEvaluationReportData();
        },

        methods:{
            getJobEvaluationReportData(){

                let $requestURL = this.url + '?'
                    + 'countryId=' + this.countryId
                    + '&startDate=' + this.startDate
                    + '&endDate=' + this.endDate;

                axios.get($requestURL).then(response => {
                    this.JobEvaluation= response.data;
                });
            },
        }
    }
</script>

<style scoped>

</style>