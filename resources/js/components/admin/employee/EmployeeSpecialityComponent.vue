<template>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
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
                                    <th>{{trans.get('messages.admin.employee.employee_speciality.name')}}</th>
                                    <th>{{trans.get('messages.admin.employee.employee_speciality.value')}}</th>

                                    <th>{{trans.get('messages.all.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(entity, index) in entityList">
                                    <td>{{entity.name}}</td>
                                    <td>{{entity.value}}</td>
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
            </div>
        </div>

        <div class="modal fade" role="dialog" id="set-model-employee-speciality">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            {{trans.get('messages.admin.employee.employee_speciality.title')}}</h4>
                        <button type="button" class="close" @click="closeModal()"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name">{{trans.get('messages.admin.employee.employee_speciality.name')}}</label>

                                            <input :class="['form-control', form.errors.has('name') ? 'is-invalid' : '']"
                                                   id="name"
                                                   name="name" v-model="form.name"/>
                                            <span v-if="form.errors.has('name')"
                                                  :class="['help-block invalid-feedback']">
                                                <strong v-text="form.errors.get('name')"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="value">{{trans.get('messages.admin.employee.employee_speciality.value')}}</label>

                                            <input :class="['form-control', form.errors.has('value') ? 'is-invalid' : '']"
                                                   id="value" type="number" min="1" max="10" step="1"
                                                   name="value" v-model="form.value"/>
                                            <span v-if="form.errors.has('value')"
                                                  :class="['help-block invalid-feedback']">
                                                <strong v-text="form.errors.get('value')"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary btn-sm float-right" @click="set">
                                    {{trans.get('messages.all.submit')}}
                                </button>
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
        name: "EmployeeSpecialityComponent",
        data() {
            return {
                url: '/admin/vue/employee_speciality',
                entityList: [],
                entity: {
                    id: null,
                    employee_id: this.initialEmployeeId,
                    name: '',
                    value: 1
                },
                form: new Form(this.entity),
                employeeId: this.initialEmployeeId,
            }
        },
        props: {
            'initialEmployeeId': Number
        },
        mounted() {
            this.getEntityList();
        },
        methods: {
            getEntityList() {
                if (this.employeeId !== null) {
                    axios.get(this.url + '/getList/' + this.employeeId).then(response => {
                        this.entityList = response.data;
                    });
                }
            },
            initCreate() {
                this.form = new Form(this.entity);
                $('#set-model-employee-speciality').modal('show');
            },
            initUpdate(index) {
                this.form = new Form(this.entityList[index]);
                $('#set-model-employee-speciality').modal('show');
            },
            set() {
                let self = this;
                let _url = this.url + "/store";
                let _message = this.trans.get('messages.admin.system.success.store');
                if (self.form.id !== null) {
                    _url = this.url + "/update";
                    _message = this.trans.get('messages.admin.system.success.update');
                }

                self.form.post(_url)
                    .then(response => {
                        self.$notify({
                            group: 'all',
                            position: 'top right',
                            text: _message,
                            type: 'success'
                        });

                        this.getEntityList();

                        this.closeModal();
                    });
            },
            deleteEntity(entityId, index) {
                let self = this;
                axios.post(this.url + "/delete", {
                    entityId: entityId
                })
                    .then(request => {
                        self.entityList.splice(index, 1);

                        self.$notify({
                            group: 'all',
                            position: 'top right',
                            text: this.trans.get('messages.admin.system.success.delete'),
                            type: 'success'
                        });
                    });
            },
            closeModal() {
                $('#set-model-employee-speciality').modal('hide');
            }
        }
    }
</script>

<style scoped>

</style>