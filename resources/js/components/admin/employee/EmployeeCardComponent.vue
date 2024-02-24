<template>
    <div class="modal fade" role="dialog" id="set-model-employee">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        {{trans.get('messages.admin.employee.title')}}</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a
                                        class="nav-item nav-link active"
                                        id="nav-general-tab"
                                        data-toggle="tab"
                                        href="#nav-general"
                                        role="tab"
                                        aria-controls="nav-general"
                                        aria-selected="true">
                                    {{trans.get('messages.admin.employee.card.general')}}
                                </a>
                                <a
                                        :class="['nav-item', 'nav-link', entity.id === 0 ? 'disabled' : '']"
                                        id="nav-education-tab"
                                        :data-toggle="entity.id === null ? '' : 'tab'"
                                        href="#nav-education"
                                        role="tab" aria-controls="nav-education" aria-selected="false">
                                    {{trans.get('messages.admin.employee.card.education')}}
                                </a>
                                <a
                                        :class="['nav-item', 'nav-link', entity.id === 0 ? 'disabled' : '']"
                                        id="nav-work_experience-tab"
                                        :data-toggle="entity.id === null ? '' : 'tab'"
                                        href="#nav-work_experience"
                                        role="tab" aria-controls="nav-work_experience" aria-selected="false">
                                    {{trans.get('messages.admin.employee.card.work_experience')}}
                                </a>
                                <a
                                        :class="['nav-item', 'nav-link', entity.id === 0 ? 'disabled' : '']"
                                        id="nav-skill-tab"
                                        :data-toggle="entity.id === null ? '' : 'tab'"
                                        href="#nav-skill"
                                        role="tab" aria-controls="nav-skill" aria-selected="false">
                                    {{trans.get('messages.admin.employee.card.skill')}}
                                </a>
                                <a
                                        :class="['nav-item', 'nav-link', entity.id === 0 ? 'disabled' : '']"
                                        id="nav-speciality-tab"
                                        :data-toggle="entity.id === null ? '' : 'tab'"
                                        href="#nav-speciality"
                                        role="tab" aria-controls="nav-speciality" aria-selected="false">
                                    {{trans.get('messages.admin.employee.card.speciality')}}
                                </a>
                                <a
                                        :class="['nav-item', 'nav-link', entity.id === 0 ? 'disabled' : '']"
                                        id="nav-social-tab"
                                        :data-toggle="entity.id === null ? '' : 'tab'"
                                        href="#nav-social"
                                        role="tab" aria-controls="nav-social" aria-selected="false">
                                    {{trans.get('messages.admin.employee.card.social')}}
                                </a>
                            </div>

                            <div class="tab-content mt-3">
                                <div class="tab-pane fade show active" id="nav-general" role="tabpanel"
                                     aria-labelledby="nav-general-tab">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="employee_position_id">{{trans.get('messages.admin.employee.position')}}</label>

                                                        <select :class="['form-control', form.errors.has('employee_position_id') ? 'is-invalid' : '']"
                                                                id="employee_position_id" name="employee_position_id"
                                                                v-model="form.employee_position_id">
                                                            <option v-for="(value, key) in employeePositionList"
                                                                    :value="value.id">
                                                                {{value.value}}
                                                            </option>
                                                        </select>
                                                        <span v-if="form.errors.has('employee_position_id')"
                                                              :class="['help-block invalid-feedback']">
                                            <strong v-text="form.errors.get('employee_position_id')"></strong>
                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="last_name">{{trans.get('messages.admin.employee.last_name')}}</label>

                                                        <input :class="['form-control', form.errors.has('last_name') ? 'is-invalid' : '']"
                                                               id="last_name"
                                                               name="last_name" v-model="form.last_name"/>
                                                        <span v-if="form.errors.has('last_name')"
                                                              :class="['help-block invalid-feedback']">
                                            <strong v-text="form.errors.get('last_name')"></strong>
                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="first_name">{{trans.get('messages.admin.employee.first_name')}}</label>

                                                        <input :class="['form-control', form.errors.has('first_name') ? 'is-invalid' : '']"
                                                               id="first_name"
                                                               name="first_name" v-model="form.first_name"/>
                                                        <span v-if="form.errors.has('first_name')"
                                                              :class="['help-block invalid-feedback']">
                                            <strong v-text="form.errors.get('first_name')"></strong>
                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="description">{{trans.get('messages.admin.employee.description')}}</label>

                                                        <textarea rows="5"
                                                                  :class="['form-control', form.errors.has('description') ? 'is-invalid' : '']"
                                                                  id="description"
                                                                  name="description"
                                                                  v-model="form.description"></textarea>
                                                        <span v-if="form.errors.has('description')"
                                                              :class="['help-block invalid-feedback']">
                                            <strong v-text="form.errors.get('description')"></strong>
                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="phone">{{trans.get('messages.admin.employee.phone')}}</label>

                                                        <input :class="['form-control', form.errors.has('phone') ? 'is-invalid' : '']"
                                                               id="phone"
                                                               name="phone" v-model="form.phone"/>
                                                        <span v-if="form.errors.has('phone')"
                                                              :class="['help-block invalid-feedback']">
                                            <strong v-text="form.errors.get('phone')"></strong>
                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="address">{{trans.get('messages.admin.employee.address')}}</label>

                                                        <input :class="['form-control', form.errors.has('address') ? 'is-invalid' : '']"
                                                               id="address"
                                                               name="address" v-model="form.address"/>
                                                        <span v-if="form.errors.has('address')"
                                                              :class="['help-block invalid-feedback']">
                                            <strong v-text="form.errors.get('address')"></strong>
                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="email">{{trans.get('messages.admin.employee.email')}}</label>

                                                        <input :class="['form-control', form.errors.has('email') ? 'is-invalid' : '']"
                                                               id="email"
                                                               name="email" v-model="form.email"/>
                                                        <span v-if="form.errors.has('email')"
                                                              :class="['help-block invalid-feedback']">
                                            <strong v-text="form.errors.get('email')"></strong>
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

                                <div id="nav-education" class="tab-pane fade" role="tabpanel"
                                     aria-labelledby="nav-education-tab">
                                    <employee-education :key="entity.id"
                                                        :initial-employee-id="entity.id"></employee-education>
                                </div>
                                <div id="nav-work_experience" class="tab-pane fade" role="tabpanel"
                                     aria-labelledby="nav-work_experience-tab">
                                    <employee-work-experience :key="entity.id"
                                                              :initial-employee-id="entity.id"></employee-work-experience>
                                </div>
                                <div id="nav-skill" class="tab-pane fade" role="tabpanel"
                                     aria-labelledby="nav-skill-tab">
                                    <employee-skill :key="entity.id" :initial-employee-id="entity.id"></employee-skill>
                                </div>
                                <div id="nav-speciality" class="tab-pane fade" role="tabpanel"
                                     aria-labelledby="nav-speciality-tab">
                                    <employee-speciality :key="entity.id"
                                                                :initial-employee-id="entity.id"></employee-speciality>
                                </div>
                                <div id="nav-social" class="tab-pane fade" role="tabpanel"
                                     aria-labelledby="nav-social-tab">
                                    <employee-social :key="entity.id"
                                                                :initial-employee-id="entity.id"></employee-social>
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
        name: "EmployeeCardComponent",
        data() {
            return {
                url: '/admin/vue/employee',
                employeePositionList: null,
                entity: {
                    id: null,
                    employee_position_id: 0,
                    first_name: '',
                    last_name: '',
                    description: '',
                    phone: '',
                    address: '',
                    email: ''
                },
                form: new Form(this.entity),
                entityId: this.initialEmployeeId,
            }
        },
        props: {
            'initialEmployeeId': Number
        },
        mounted() {
            this.getEntity();
        },
        methods: {
            getEntity() {
                if(this.$vnode.key > 0) {
                    if (this.entityId !== null) {
                        axios.get(this.url + '/get/' + this.entityId).then(response => {
                            this.entity = response.data.entity;
                            this.employeePositionList = response.data.employeePositionList;
                            this.form = new Form(this.entity);

                            $('#set-model-employee').modal('show');
                        });
                    } else {
                        axios.get('vue/employee/position/list').then(response => {
                            this.employeePositionList = response.data;
                        });

                        this.form = new Form(this.entity);
                        $('#set-model-employee').modal('show');
                    }
                }
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
                        self.entity = response;

                        self.form = new Form(this.entity);
                        self.$notify({
                            group: 'all',
                            position: 'top right',
                            text: _message,
                            type: 'success'
                        });

                        let parent = self.$parent;
                        parent.getEntityList(parent.currentPage);
                    });
            }
        }
    }
</script>

<style scoped>

</style>