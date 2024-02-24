<template>
    <div>
        <div class="title-main">
            {{trans.get('messages.admin.catalog.title')}}

        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">

                        <div class="row pb-3">
                            <div class="col-3">
                                <label for="country_id">{{trans.get('messages.admin.serviceList.countryFilter')}}</label>
                                <select class="form-control" id="country_id" @change="onCountryChange()"
                                        v-model="selectedCountryId">
                                    <option :value="country.id" v-for="(country, index) in countryList">
                                        {{country.name}}
                                    </option>
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="country_id">{{trans.get('messages.all.service_category')}}</label>
                                <select class="form-control" id="service_category_id" @change="onServiceCategoryChange()"
                                        v-model="selectedServiceCategoryId">
                                    <option :value="serviceCategory.id" v-for="(serviceCategory, index) in serviceCategoryList">
                                        {{serviceCategory.service_category_type_id == cnstFreeEconomicZoneCategoryType ?
                                            "(" + serviceCategory.name + ") " + serviceCategory.description
                                            : serviceCategory.name
                                        }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="row" v-if="catalogNodeList !== null">

                                <catalog-node-list-component :key="rootNode.id"
                                        :initial-node-list="catalogNodeList"
                                        :initial-parent-node-id="rootNode.id"
                                ></catalog-node-list-component>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CatalogComponent",
        data() {
            return {
                url: '/admin/vue/catalog',
                service_category_url: '/admin/vue/service_category_with_system',
                countryList: this.initialCountryList,
                serviceCategoryList: null,
                categoryList: null,
                catalogNodeList: null,
                selectedCountryId: 1, //TODO set null
                selectedServiceCategoryId: null,
                rootNode: null,
                cnstFreeEconomicZoneCategoryType: 3
            }
        },
        props: {
            'initialCountryList': Array
        },
        mounted() {
            this.onCountryChange(); //todo remove
        },
        methods: {
            onCountryChange(){
                let categoryUrl = this.service_category_url + '/list?'
                    + 'countryId=' + this.selectedCountryId
                    + '&withPaginate=false';

                axios.get(categoryUrl).then(response => {
                    this.serviceCategoryList = response.data;
                    this.selectedServiceCategoryId = null;
                });
            },
            onServiceCategoryChange(){
                if(this.selectedServiceCategoryId == null || this.selectedServiceCategoryId === undefined){
                    return;
                }
                axios.get(this.url + "/getByServiceCategory/" + this.selectedServiceCategoryId).then(response => {
                    this.catalogNodeList = response.data.nodeList;
                    this.rootNode = response.data.rootNode;
                });
            }
        }
    }
</script>

<style scoped>

</style>