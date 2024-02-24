<template>
    <div>

        <div>
            <div class="title-main">
                {{trans.get('messages.head.report.title')}}

            </div>
            <div class="row justify-content-end pb-3">
                <div class="col-xl-4 col-md-5 col-sm-7">
                    <div class="row">
                        <div class="col-12">
                            <label for="country_id">{{trans.get('messages.head.report.countryFilter')}}</label>
                            <select class="form-control" id="country_id" @change="onCountryChange()" v-model="countryId">
                                <option :value="country.id" v-for="(country, index) in countryList">
                                    {{country.name}}
                                </option>
                            </select>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="col-6">
<!--                                    <datepicker v-model="startDate" :class="['form-control']" :format="customFormatter"></datepicker>-->
                                    <div class="form-group">
                                        <label for="startDate">{{trans.get('messages.head.report.startDate')}}</label>
                                        <date-picker id="startDate" name="startDate" v-model="startDate"
                                                     :config="datepickerOptions"/>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <!--                                    <datepicker v-model="endDate" :class="['form-control']" :format="customFormatter"></datepicker>-->
                                    <div class="form-group">
                                        <label for="endDate">{{trans.get('messages.head.report.endDate')}}</label>
                                        <date-picker id="endDate" name="endDate" v-model="endDate"
                                                     :config="datepickerOptions"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <button  class="btn btn-primary pull-right" @click="applyFilter()">
                                <i class="fa fa-plus-square"></i>
                                {{trans.get('messages.all.applyFilter')}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card analytic">
                <div class="card-header main">

                </div>
                <div class="card-body main">
                    <div class="row">
                        <div class="col-12">

                            <div class="row">

                                <div class="col-xl-4 col-md-4 col-sm-6 mb-2"><client-count :key="reportClientCountKey" :initial-country-id="countryId"  :initial-start-date="startDate" :initial-end-date="endDate"></client-count></div>
                                <div class="col-xl-4 col-md-4 col-sm-6 mb-2"><service-in-progress-data :key="reportServiceInProgressDataKey" :initial-country-id="countryId"  :initial-start-date="startDate" :initial-end-date="endDate"></service-in-progress-data></div>
                                <div class="col-xl-4 col-md-4 col-sm-6 mb-2"><service-compete-data :key="reportServiceCompeteDataKey" :initial-country-id="countryId"  :initial-start-date="startDate" :initial-end-date="endDate"></service-compete-data></div>
                                <div class="col-xl-4 col-md-4 col-sm-6 mb-2"><service-no-payment-amount-data :key="reportServiceNoPaymentAmountDataKey" :initial-country-id="countryId"  :initial-start-date="startDate" :initial-end-date="endDate"></service-no-payment-amount-data></div>
                                <div class="col-xl-4 col-md-4 col-sm-6 mb-2"><attendance-data :key="reportAttendanceDataKey" :initial-country-id="countryId"  :initial-start-date="startDate" :initial-end-date="endDate"></attendance-data></div>
                                <div class="col-xl-4 col-md-4 col-sm-6 mb-2"><job-evaluation-data :key="reportJobEvaluationDataKey" :initial-country-id="countryId"  :initial-start-date="startDate" :initial-end-date="endDate"></job-evaluation-data></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>



<script>
    import ClientCount from "./ReportClientCountComponent";
    import ServiceInProgressData from "./ReportServiceInProgressDataComponent";

    import ServiceNoPaymentAmountData from "./ReportServiceNoPaymentAmountDataComponent";

    import ServiceCompeteData from "./ReportServiceCompeteDataComponent";

    import AttendanceData from "./ReportAttendanceDataComponent";
    import JobEvaluationData from "./ReportJobEvaluationDataComponent";
    import moment from 'moment';
    export default {
        name: "HeadDashBoardComponent",
        components: {
            ClientCount,
            ServiceCompeteData,
            ServiceInProgressData,
            ServiceNoPaymentAmountData,
            AttendanceData,
            JobEvaluationData,
            moment
        },
        data() {
            return {
                startDate: null,
                endDate: null,
                countryId: this.initialCountryId,
                countryList: this.initialCountryList,
                reportClientCountKey:0,
                reportServiceInProgressDataKey:1,
                reportServiceCompeteDataKey:2,
                reportServiceNoPaymentAmountDataKey:3,
                reportAttendanceDataKey:4,
                reportJobEvaluationDataKey:5,
                datepickerOptions: {
                    format: 'DD.MM.YYYY'
                },
            }
        },
        props: {
            'initialCountryList': Array,
            'initialCountryId':Number,
            'initialStartDate':String,
            'initialEndDate':String
        },
        mounted() {
            this.startDate = this.initStartDate;
            this.endDate = this.initEndDate;
        },
        computed:{
            initStartDate(){
                return moment(this.initialStartDate).format('DD.MM.YYYY');
            },
            initEndDate(){
                return moment(this.initialEndDate).format('DD.MM.YYYY');
            },

        },
        methods:{
            applyFilter(){
                this.reportClientCountKey++;
                this.reportServiceInProgressDataKey++;
                this.reportServiceCompeteDataKey++;
                this.reportServiceNoPaymentAmountDataKey++;
                this.reportAttendanceDataKey++;
                this.reportJobEvaluationDataKey++;
            },
            customFormatter(date) {
                return moment(date).format('DD.MM.YYYY');
            }
        }
    }

</script>

<style scoped>

</style>