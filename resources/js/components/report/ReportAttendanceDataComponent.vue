<template>
            <div class="card">
                <div class="card-header">
                    {{trans.get('messages.head.report.Attendance')}}

                </div>
                <div class="card-body">
                    <h1>{{Attendance}}</h1>
                </div>
            </div>
</template>

<script>
    export default {
        name: "ReportAttendanceDataComponent",
        data() {

            return {
                url:'/report/vue/getAttendanceData',
                endDate: this.initialEndDate,
                startDate: this.initialStartDate,
                countryId: this.initialCountryId,
                Attendance:null
            }
        },
        props: {
            'initialCountryId':Number,
            'initialStartDate':String,
            'initialEndDate':String

        },
        mounted() {
            this.getAttendanceReportData();
        },

        methods:{
            getAttendanceReportData(){

                let $requestURL = this.url + '?'
                    + 'countryId=' + this.countryId
                    + '&startDate=' + this.startDate
                    + '&endDate=' + this.endDate;

                axios.get($requestURL).then(response => {
                    this.Attendance= response.data;
                });
            },
        }
    }
</script>

<style scoped>

</style>