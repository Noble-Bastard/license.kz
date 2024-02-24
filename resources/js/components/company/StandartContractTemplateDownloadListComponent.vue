<template>
    <div>

        <div class="row">
            <div class="col-12">
                <div class="row pb-3">
                    <div class="col-6">
                        <label class="text-bold secondary-sm-header " for="standart_contract_template_type_id">{{trans.get('messages.company.standartContractTemplateType.find')}}</label>
                        <select class="form-control" id="standart_contract_template_type_id" @change="onStandartContractTemplateTypeChange()" v-model="selectedStandartContractTemplateTypeId">
                            <option :value="standartContractTemplateType.id" v-for="(standartContractTemplateType, index) in standartContractTemplateTypeList">
                                {{standartContractTemplateType.name}}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <table id="standartContractTemplateList" class="table table-striped">
                            <!--<thead>-->
                            <!--<tr>-->
                                <!--<th>{{trans.get('messages.company.standartContractTemplate.common_data_name')}}</th>-->
                                <!--<th></th>-->
                            <!--</tr>-->
                            <!--</thead>-->
                            <tbody>
                            <tr v-for="(entity, index) in entityList">
                                <td>{{entity.friendly_name}}</td>
                                <td class="text-right">
                                    <i class="fas fa-arrow-alt-to-bottom cursor-pointer"
                                       :title="trans.get('messages.all.downloadFile')"
                                       @click="downloadFile(entity.id, index)"></i>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: "StandartContractTemplateDownloadListComponent",
        data() {
            return {
                urlStandartContractTemplate: '/common_data/vue/standart_contract_template',
                urlStandartContractTemplateType: '/common_data/vue/standart_contract_template_type',
                entityList: null,
                standartContractTemplateTypeList: null,
                selectedStandartContractTemplateTypeId: null
            }
        },
        mounted() {
            this.getEntityTypeList();
        },
        methods: {
            getEntityTypeList() {
                let requestUrl = this.urlStandartContractTemplateType + '/list';

                axios.get(requestUrl).then(response => {
                    this.standartContractTemplateTypeList = response.data;
                    this.selectedStandartContractTemplateTypeId = this.standartContractTemplateTypeList[0].id;
                    this.getEntityList();
                });
            },
            getEntityList() {
                let requestUrl = this.urlStandartContractTemplate + '/list'
                    + '?standartContractTemplateTypeId=' + this.selectedStandartContractTemplateTypeId;

                axios.get(requestUrl).then(response => {
                    this.entityList = response.data;
                });
            },

            downloadFile(entityId, index) {
                let requestUrl = this.urlStandartContractTemplate + "/download"
                    + '?entityId=' + entityId;
                window.open(requestUrl);
            },

            onStandartContractTemplateTypeChange(){
                this.getEntityList();
            },
        },
    }
</script>

<style scoped>

</style>