<template>
    <div>
        <div class="title-main">
            {{trans.get('messages.admin.serviceList.title')}}
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">

                        <div class="row pb-3">
                            <div class="col-3">
                                <label for="country_id">{{trans.get('messages.admin.serviceList.countryFilter')}}</label>
                                <select class="form-control" id="country_id" @change="onCountryChange()" v-model="selectedCountryId">
                                    <option :value="country.id" v-for="(country, index) in countryList">
                                        {{country.name}}
                                    </option>
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="service_category_id">{{trans.get('messages.admin.serviceList.serviceCategoryFilter')}}</label>
                                <select class="form-control" id="service_category_id" @change="onServiceCategoryChange()" v-model="selectedServiceCategoryId" :disabled="!serviceCategoryList">
                                    <option :value="null"></option>
                                    <option :value="serviceCategory.id" v-for="(serviceCategory, index) in serviceCategoryList">
                                        {{serviceCategory.service_category_type_id == cnstFreeEconomicZoneCategoryType ?
                                        "(" + serviceCategory.name + ") " + serviceCategory.description
                                        : serviceCategory.name
                                        }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <div  class="col-3 pl-0 d-inline">
                                <button :disabled="isAddServiceDisabled" class="btn btn-primary pull-right" @click="openServiceCard(null, selectedServiceCategoryId, null)">
                                    <i class="fa fa-plus-square"></i>
                                    {{trans.get('messages.all.add')}}
                                </button>
                            </div>

                            <div class="input-group pr-0 pb-3 col-4 float-right">
                                <input type="text" class="form-control" v-model="searchText" :placeholder="trans.get('messages.all.search')">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="button" @click="searchService()">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <table id="users" class="table table-striped table-responsive-sm col-12">
                                <thead>
                                <tr>
                                    <th>{{trans.get('messages.admin.serviceList.code')}}</th>
                                    <th>{{trans.get('messages.admin.serviceList.name')}}</th>
<!--                                    <th>{{trans.get('messages.admin.serviceList.categoryName')}}</th>-->
                                    <th>{{trans.get('messages.admin.serviceList.thematicGroupName')}}</th>
                                    <th>{{trans.get('messages.all.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(entity, index) in entityList.data">
                                    <td>{{entity.code}}</td>
                                    <td>{{entity.name}}</td>
<!--                                    <td>{{entity.service_category_name}}</td>-->
                                    <td>{{entity.service_thematic_group_name}}</td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                <i class="fa fa-bars"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item"
                                                   @click="openServiceCard(entity.id, entity.service_category_id, entity.service_thematic_group_id)">{{trans.get('messages.admin.serviceList.openCard')}}</a>
                                                <a class="dropdown-item"
                                                   @click="preMove(entity.id)">{{trans.get('messages.admin.serviceList.move')}}</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item"
                                                   @click="deleteEntity(entity.id, index)">{{trans.get('messages.all.delete')}}</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="row padding-t-15">
                                <div class="col-12">
                                    <pagination class="float-right" :data="entityList"
                                                @pagination-change-page="getEntityList"></pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="service-move">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{trans.get('messages.admin.serviceList.move')}}</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <label for="move_country_id">{{trans.get('messages.admin.serviceList.countryFilter')}}</label>
                            <select class="form-control" id="move_country_id" @change="onCountryChange()" v-model="move.selectedCountryId">
                                <option :value="country.id" v-for="(country, index) in countryList">
                                    {{country.name}}
                                </option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="move_service_category_id">{{trans.get('messages.admin.serviceList.serviceCategoryFilter')}}</label>
                            <select class="form-control" id="move_service_category_id" @change="onMoveServiceCategoryChange()" v-model="move.selectedServiceCategoryId">
                                <option :value="serviceCategory.id" v-for="(serviceCategory, index) in serviceCategoryList">
                                    {{serviceCategory.service_category_type_id == cnstFreeEconomicZoneCategoryType ?
                                    "(" + serviceCategory.name + ") " + serviceCategory.description
                                    : serviceCategory.name
                                    }}
                                </option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="move_service_thematic_group_id">{{trans.get('messages.admin.serviceList.thematicGroupName')}}</label>
                            <select class="form-control" id="move_service_thematic_group_id" v-model="move.selectedServiceThematicGroupId">
                                <option :value="serviceThematicGroup.id" v-for="(serviceThematicGroup, index) in move.serviceThematicGroupList">
                                    {{serviceThematicGroup.name}}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">
                            {{trans.get('messages.all.cancel')}}
                        </button>
                        <button type="button" @click="doMove()" class="btn btn-primary">
                            {{trans.get('messages.all.submit')}}
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
</template>


<script>
    export default {
        name: "ServiceListComponent",
        data() {
            return {
                url: '/admin/vue/service_list',
                card_url: '/admin/service/show',
                service_category_url: '/admin/vue/service_category_with_system',
                service_thematic_group_url: 'vue/service_thematic_group/list/',
                entityList: {},
                currentPage: 1,
                countryList: this.initialCountryList,
                serviceCategoryList: null,
                selectedCountryId: this.initialCountryId,
                selectedServiceCategoryId: null,
                move: {
                    url: '/admin/vue/service/move',
                    serviceId: 0,
                    selectedCountryId: null,
                    selectedServiceCategoryId: null,
                    selectedServiceThematicGroupId: null,
                    serviceThematicGroupList: null
                },
                searchText: null,
                cnstFreeEconomicZoneCategoryType: 3
            }
        },
        props: {
            'initialCountryList': Array,
            'initialCountryId': Number
        },
        mounted() {
            this.onCountryChange();
        },
        computed: {
            isAddServiceDisabled: function(){
                return (this.selectedServiceCategoryId === null);
            }
        },
        methods: {
            getEntityList(page = 1) {
                this.currentPage = page;
                let serviceUrl = this.url + '/list?'
                    + 'page=' + page
                    + '&countryId=' + this.selectedCountryId;
                if(this.selectedServiceCategoryId !== null) {
                    serviceUrl = serviceUrl + '&serviceCategoryId=' + this.selectedServiceCategoryId;
                }
                if(this.searchText !== null) {
                    serviceUrl = serviceUrl + '&searchText=' + this.searchText;
                }
                axios.get(serviceUrl).then(response => {
                    this.entityList = response.data;
                });
            },
            openServiceCard(serviceId, serviceCategoryId, serviceThematicGroupId){
                window.location.href = this.card_url + '/' + serviceCategoryId + '/' + serviceThematicGroupId + '/' + serviceId ;
            },
            onCountryChange(){

                this.searchText = null;

                let categoryUrl = this.service_category_url + '/list?'
                    + 'countryId=' + this.selectedCountryId
                    + '&withPaginate=false';

                axios.get(categoryUrl).then(response => {
                    this.serviceCategoryList = response.data;
                    this.selectedServiceCategoryId = null;
                });

                //this.getEntityList();
            },
            onServiceCategoryChange(){
                this.searchText = null;
                this.getEntityList();
            },
            preMove(serviceId){
                this.move.serviceId = serviceId;

                this.move.selectedCountryId = null;
                this.move.selectedServiceCategoryId = null;
                this.move.selectedServiceThematicGroupId = null;

                $('#service-move').modal('show');
            },
            doMove(){
                axios.post(this.move.url, {
                    entityId: this.move.serviceId,
                    serviceThematicGroupId: this.move.selectedServiceThematicGroupId
                }).then(response => {
                    this.getEntityList();

                    $('#service-move').modal('hide');

                    this.$notify({
                        group: 'all',
                        position: 'top right',
                        text: this.trans.get('messages.admin.system.success.move'),
                        type: 'success'
                    });
                });
            },
            onMoveServiceCategoryChange(){
                let serviceThematicGroupUrl = this.service_thematic_group_url
                    + this.move.selectedServiceCategoryId
                    + '?withPaginate=false';

                axios.get(serviceThematicGroupUrl).then(response => {
                    this.move.serviceThematicGroupList = response.data;
                });
            },
            searchService(){
                this.getEntityList();
            },
            deleteEntity(entityId, index) {
                axios.post(this.url + "/delete", {
                    entityId: entityId
                })
                    .then(request => {
                        this.entityList.data.splice(index, 1);

                        this.$notify({
                            group: 'all',
                            position: 'top right',
                            text: this.trans.get('messages.admin.system.success.delete'),
                            type: 'success'
                        });
                    });
            },
        },
    }
</script>

<style scoped>

</style>
