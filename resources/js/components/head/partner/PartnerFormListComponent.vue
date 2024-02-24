<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="title-main">
                    {{trans.get('messages.partner_form.list')}}

                </div>

                <div class="card-body">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <table id="users" class="table table-striped table-responsive-sm col-12">
                                    <thead>
                                    <tr>
                                        <th>{{trans.get('messages.partner_form.company_name')}}</th>
                                        <th>{{trans.get('messages.partner_form.fio')}}</th>
                                        <th>{{trans.get('messages.partner_form.position')}}</th>
                                        <th>{{trans.get('messages.partner_form.phone')}}</th>
                                        <th>{{trans.get('messages.all.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(entity, index) in entityList.data">
                                        <td class="text-center">
                                            <a :href="entity.company_site" target="_blank">
                                                {{entity.company_name}}
                                            </a>
                                        </td class="text-center">
                                        <td class="text-center">{{entity.fio}}</td>
                                        <td class="text-center">{{entity.position}}</td>
                                        <td class="text-center">{{entity.phone}}</td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false">
                                                    <i class="fa fa-bars"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item cursor-pointer"
                                                       @click="showCard(entity.id)">{{trans.get('messages.all.show')}}</a>
                                                    <a class="dropdown-item"
                                                       @click="deleteEntity(entity.id, index)"
                                                       data-method="delete">{{trans.get('messages.all.delete')}}</a>
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
        </div>
    </div>
</template>

<script>
    export default {
        name: "PartnerFormListComponent",
        data() {
            return {
                url: '/partner/vue/list',
                entityList: {},
                selectedEmployee: null,
                employeeCardKey: 0,
                currentPage: 1
            }
        },
        mounted() {
            this.getEntityList();
        },
        methods: {
            getEntityList(page = 1) {
                this.currentPage = page;
                axios.get(this.url + '?page=' + page).then(response => {
                    this.entityList = response.data;
                });
            },
            showCard(employeeId) {
                window.open('/partner/show/' + employeeId,'_blank');
            },
            deleteEntity(entityId, index) {
                axios.post(this.url + "/delete", {
                    entityId: entityId
                })
                    .then(request => {
                        this.entityList.splice(index, 1);

                        this.$notify({
                            group: 'all',
                            position: 'top right',
                            text: this.trans.get('messages.admin.system.success.delete'),
                            type: 'success'
                        });

                    });
            },
        }
    }
</script>

<style scoped>

</style>