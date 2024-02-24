<template>
    <div>
        <div class="card">
            <div class="card-body">
                <div class="col-6">
                    <label for="serviceCategory">{{trans.get('messages.admin.serviceCategory.serviceCategory')}}</label>
                    <select class="form-control" id="serviceCategory" v-model="currentServiceCategory">
                        <option :value="serviceCategory.id" v-for="(serviceCategory, index) in serviceCategoryList">
                            {{serviceCategory.service_category_type_id == cnstFreeEconomicZoneCategoryType ?
                            "(" + serviceCategory.name + ") " + serviceCategory.description
                            : serviceCategory.name
                            }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="card-body" v-if="currentServiceCategory !== 0">
                <div class="row pb-3">
                    <div class="col-12">
                        <button class="btn btn-primary" @click="initCreate()">
                            <i class="fa fa-plus-square"></i>
                            {{trans.get('messages.all.add')}}
                        </button>
                    </div>
                </div>
                <div>
                    <table id="users" class="table table-striped table-responsive-sm col-12">
                        <thead>
                        <tr>
                            <th>{{trans.get('messages.admin.serviceThematicGroup.name')}}</th>
                            <th>{{trans.get('messages.admin.serviceThematicGroup.description')}}</th>
                            <th>{{trans.get('messages.all.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(entity, index) in entityList">
                            <td>{{entity.name}}</td>
                            <td>{{entity.description}}</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        <i class="fa fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                         <a class="dropdown-item"
                                           @click="initUpdate(index)">{{trans.get('messages.all.edit')}}</a>
                                        <a class="dropdown-item"
                                           @click="deleteEntity(entity.id, index)"
                                           data-method="delete">{{trans.get('messages.all.delete')}}</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="set-model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" v-if="form.id === 0">{{trans.get('messages.admin.system.modal.create')}}</h4>
                        <h4 class="modal-title" v-else>{{trans.get('messages.admin.system.modal.update')}}</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" @change="form.errors.clear($event.target.name)"
                         @keydown="form.errors.clear($event.target.name)">
                        <div class="form-group">
                            <label for="name">{{trans.get('messages.admin.serviceThematicGroup.name')}}</label>

                            <input :class="['form-control', form.errors.has('name') ? 'is-invalid' : '']"
                                   v-model="form.name" id="name" name="name" type="text"/>
                            <span v-if="form.errors.has('name')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('name')"></strong>
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="description">{{trans.get('messages.admin.serviceThematicGroup.description')}}</label>

                            <input :class="['form-control', form.errors.has('description') ? 'is-invalid' : '']"
                                   v-model="form.description" id="description" name="description" type="text"/>
                            <span v-if="form.errors.has('description')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('description')"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">
                            {{trans.get('messages.all.cancel')}}
                        </button>
                        <button type="button" @click="set()" :disabled="form.errorsOrSend()" class="btn btn-primary">
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
        name: "ServiceThematicGroupComponent",
        data() {
            return {
                url: '/admin/vue/service_thematic_group/',
                serviceCategoryList: [],
                currentServiceCategory: 0,
                entityList: {},
                defaultEntity: {
                    id: 0,
                    service_category_id: 0,
                    name: '',
                    description: ''
                },
                form: new Form(this.defaultEntity),
                cnstFreeEconomicZoneCategoryType: 3
            }
        },
        mounted() {
            this.getServiceCategoryList();
        },
        watch: {
            currentServiceCategory: function () {
                this.getEntityList();
            },
        },
        methods: {
            getServiceCategoryList() {
                axios.get('/admin/vue/service_category_with_system/list').then(response => {
                    this.serviceCategoryList = response.data;
                })
            },
            getEntityList() {
                axios.get(this.url + 'list/' + this.currentServiceCategory).then(response => {
                    this.entityList = response.data;
                })
            },
            initCreate() {
                this.form = new Form(this.defaultEntity);
                $('#set-model').modal('show');
            },
            initUpdate(index) {
                this.form = new Form(this.entityList[index]);

                $('#set-model').modal('show');
            },
            set() {
                let self = this;
                let _url = this.url + "store";
                let _message = this.trans.get('messages.admin.system.success.store');
                if (self.form.id !== 0) {
                    _url = this.url + "update";
                    _message = this.trans.get('messages.admin.system.success.update');
                }

                self.form.service_category_id = self.currentServiceCategory;

                self.form.post(_url)
                    .then(request => {
                        self.getEntityList(self.currentPage);
                        $('#set-model').modal('hide');

                        self.$notify({
                            group: 'all',
                            position: 'top right',
                            text: _message,
                            type: 'success'
                        });
                    });
            },
            deleteEntity(entityId, index) {
                axios.post(this.url + "delete", {
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
