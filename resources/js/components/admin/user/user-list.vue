<template>
  <div class="mt-3">
    <div class="row">
      <div class="col-12">
        <div class="title-main">
          {{ trans.get('messages.admin.users.user_list') }}
        </div>
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div>

              <div class="row pb-3">
                <div class="col-3">
                  <label for="role_type_id">{{ trans.get('messages.admin.users.roleTypeFilter') }}</label>
                  <select class="form-control" id="role_type_id" @change="onRoleTypeChange()"
                          v-model="roleTypeId">
                    <option :value="item.id" v-for="(item, index) in this.initialRoleTypeList">
                      {{ item.name }}
                    </option>
                  </select>
                </div>
              </div>

              <div class="col-3 pl-0 d-inline">
                <button :disabled="roleTypeId == cnstRoleTypeExternal" class="btn btn-primary"
                        @click="initCreate()">
                  <i class="fa fa-plus-square"></i>
                  {{ trans.get('messages.all.add') }}
                </button>
              </div>

              <div class="input-group pr-0 pb-3 col-4 float-right">
                <input type="text" class="form-control" v-model="searchText"
                       :placeholder="trans.get('messages.all.search')">
                <div class="input-group-append">
                  <button class="btn btn-secondary" type="button" @click="searchUser()">
                    <i class="fa fa-search"></i>
                  </button>
                </div>
              </div>

              <table id="users" class="table table-striped table-responsive-sm col-12">
                <thead>
                <tr>
                  <th>{{ trans.get('messages.admin.users.user_name_name') }}</th>
                  <th>{{ trans.get('messages.admin.users.email') }}</th>
                  <th>{{ trans.get('messages.admin.users.user_role') }}</th>
                  <th>{{ trans.get('messages.admin.users.user_is_active') }}</th>
                  <th>{{ trans.get('messages.admin.users.manager') }}</th>
                  <th>{{ trans.get('messages.all.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(user, index) in userList.data">
                  <td>{{ user.user_name }}</td>
                  <td>{{ user.email }}</td>
                  <td>{{ user.role_caption }}</td>
                  <td>{{ isActive(user) }}
                  </td>
                  <td>{{ user.manager_name }}</td>
                  <td class="text-center">
                    <div class="dropdown">
                      <button class="btn btn-primary dropdown-toggle" type="button"
                              id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false">
                        <i class="fa fa-bars"></i>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a v-if="canEdit()" class="dropdown-item cursor-pointer"
                           @click="initUpdate(index)">{{ trans.get('messages.all.edit') }}</a>
                        <a class="dropdown-item cursor-pointer" v-if="user.is_active === 1"
                           @click="deActivateUser(user.user_id, index)"
                           data-method="delete">{{ trans.get('messages.admin.users.deactivate') }}</a>
                        <a class="dropdown-item cursor-pointer" v-else
                           @click="activateUser(user.user_id, index)"
                           data-method="delete">{{ trans.get('messages.admin.users.activate') }}</a>
                        <a v-if="roleTypeId === roleTypeHelperList.partner"
                           class="dropdown-item cursor-pointer"
                           @click="initPartnerExtra(index)">{{ trans.get('messages.all.editPartnerExtra') }}</a>
                        <div class="dropdown-divider" v-if="user.role_id === roleHelperList.SaleManager"></div>
                        <a v-if="user.role_id === roleHelperList.SaleManager"
                           class="dropdown-item cursor-pointer"
                           @click="initProfileCityList(user.user_id)">{{ trans.get('messages.admin.users.attached_city_list') }}</a>
                        <a v-if="user.role_id === roleHelperList.SaleManager"
                           class="dropdown-item cursor-pointer"
                           @click="initProfileLicenseTypeList(user.user_id)">{{ trans.get('messages.admin.users.attached_license_type') }}</a>
                      </div>
                    </div>
                  </td>
                </tr>
                </tbody>
              </table>
              <div class="row padding-t-15">
                <div class="col-12">
                  <pagination class="float-right" :data="userList"
                              @pagination-change-page="getUserList"></pagination>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="set-model">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-if="form.id === 0">
              {{ trans.get('messages.admin.system.modal.create') }}</h4>
            <h4 class="modal-title" v-else>{{ trans.get('messages.admin.system.modal.update') }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" @change="form.errors.clear($event.target.name)"
               @keydown="form.errors.clear($event.target.name)">
            <div class="form-group">
              <label for="user_name">{{ trans.get('messages.admin.users.user_name') }}</label>

              <input :class="['form-control', form.errors.has('user_name') ? 'is-invalid' : '']"
                     v-model="form.user_name" id="user_name" name="user_name" type="text"/>
              <span v-if="form.errors.has('user_name')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('user_name')"></strong>
                            </span>
            </div>

            <div class="form-group">
              <label for="email">{{ trans.get('messages.admin.users.email') }}</label>

              <input :class="['form-control', form.errors.has('email') ? 'is-invalid' : '']"
                     v-model="form.email" id="email" name="email" type="text"/>
              <span v-if="form.errors.has('email')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('email')"></strong>
                            </span>
            </div>

            <div class="form-group" v-if="roleTypeId == roleTypeHelperList.employees">
              <label for="role_id">{{ trans.get('messages.admin.users.user_role') }}</label>

              <select :class="['form-control', form.errors.has('role_id') ? 'is-invalid' : '']"
                      id="role_id" name="role_id" v-model="form.role_id">
                <option :value="item.id" v-for="(item, index) in roleList">
                  {{ item.caption }}
                </option>
              </select>
              <span v-if="form.errors.has('role_id')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('role_id')"></strong>
                            </span>
            </div>

            <div class="form-group" v-if="roleTypeId == roleTypeHelperList.employees">
              <label for="company_id">{{ trans.get('messages.admin.users.company') }}</label>

              <select :class="['form-control', form.errors.has('company_id') ? 'is-invalid' : '']"
                      id="company_id" name="company_id" v-model="form.company_id">
                <option :value="item.id" v-for="(item, index) in companyProfileAddressList">
                  {{ item.country_name }} - {{ item.city_name }}
                </option>
              </select>
              <span v-if="form.errors.has('company_id')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('company_id')"></strong>
                            </span>
            </div>

            <div class="form-group" v-if="roleTypeId == roleTypeHelperList.partner">
              <label for="city_id">{{ trans.get('messages.admin.users.city') }}</label>

              <select :class="['form-control', form.errors.has('city_id') ? 'is-invalid' : '']"
                      id="city_id" name="city_id" v-model="form.city_id" v-on:change="cityChange">
                <option :value="item.id" v-for="(item, index) in cityList">
                  {{ item.country_name }} - {{ item.value }}
                </option>
                <option :value="defaultCity">{{ trans.get('messages.admin.users.city_other') }}</option>
              </select>
              <span v-if="form.errors.has('city_id')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('city_id')"></strong>
                            </span>
            </div>

            <div v-if="form.city_id == -1">
              <input type="hidden" id="country_code" name="country_code" v-model="form.country_code"/>

              <div class="form-group">
                <label for="city_name">{{ trans.get('messages.admin.users.city') }}</label>

                <input :class="['form-control', form.errors.has('city_name') ? 'is-invalid' : '']"
                       id="city_name" name="city_name" v-model="form.city_name"/>

                <span v-if="form.errors.has('city_name')" :class="['help-block invalid-feedback']">
                                    <strong v-text="form.errors.get('city_name')"></strong>
                                </span>
              </div>
            </div>

            <div class="form-group" v-if="form.role_id == roleHelperList.Executor">
              <label for="manager">{{ trans.get('messages.admin.users.manager') }}</label>

              <select :class="['form-control', form.errors.has('manager') ? 'is-invalid' : '']"
                      id="manager" name="manager" v-model="form.manager_id">
                <option :value="item.id" v-for="(item, index) in managerList">
                  {{ item.full_name }}
                </option>
              </select>
              <span v-if="form.errors.has('manager')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('manager')"></strong>
                            </span>
            </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">
              {{ trans.get('messages.all.cancel') }}
            </button>
            <button type="button" @click="set()" :disabled="form.errorsOrSend()" class="btn btn-primary">
              {{ trans.get('messages.all.submit') }}
            </button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="partner-extra-model">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-if="formPartnerExtra.id === 0">
              {{ trans.get('messages.admin.system.modal.create') }}</h4>
            <h4 class="modal-title" v-else>{{ trans.get('messages.admin.system.modal.update') }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" @change="formPartnerExtra.errors.clear($event.target.name)"
               @keydown="formPartnerExtra.errors.clear($event.target.name)">
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="company_name">{{ trans.get('messages.admin.users.partner.company_name') }}</label>

                  <input :class="['form-control', formPartnerExtra.errors.has('company_name') ? 'is-invalid' : '']"
                         v-model="formPartnerExtra.company_name" id="company_name" name="company_name"
                         type="text"/>
                  <span v-if="formPartnerExtra.errors.has('company_name')"
                        :class="['help-block invalid-feedback']">
                                        <strong v-text="formPartnerExtra.errors.get('company_name')"></strong>
                                    </span>
                </div>
                <div class="form-group">
                  <label for="company_name_en">{{ trans.get('messages.admin.users.partner.company_name_en') }}</label>

                  <input :class="['form-control', formPartnerExtra.errors.has('company_name_en') ? 'is-invalid' : '']"
                         v-model="formPartnerExtra.company_name_en" id="company_name_en"
                         name="company_name_en"
                         type="text"/>
                  <span v-if="formPartnerExtra.errors.has('company_name_en')"
                        :class="['help-block invalid-feedback']">
                                    <strong v-text="formPartnerExtra.errors.get('company_name_en')"></strong>
                                </span>
                </div>


                <div class="form-group">
                  <label
                      for="company_activity_field">{{ trans.get('messages.admin.users.partner.company_activity_field') }}</label>

                  <input
                      :class="['form-control', formPartnerExtra.errors.has('company_activity_field') ? 'is-invalid' : '']"
                      v-model="formPartnerExtra.company_activity_field" id="company_activity_field"
                      name="company_activity_field" type="text"/>
                  <span v-if="formPartnerExtra.errors.has('company_activity_field')"
                        :class="['help-block invalid-feedback']">
                                    <strong v-text="formPartnerExtra.errors.get('company_activity_field')"></strong>
                                </span>
                </div>
                <div class="form-group">
                  <label
                      for="company_activity_field_en">{{ trans.get('messages.admin.users.partner.company_activity_field_en') }}</label>

                  <input
                      :class="['form-control', formPartnerExtra.errors.has('company_activity_field_en') ? 'is-invalid' : '']"
                      v-model="formPartnerExtra.company_activity_field_en"
                      id="company_activity_field_en"
                      name="company_activity_field_en" type="text"/>
                  <span v-if="formPartnerExtra.errors.has('company_activity_field_en')"
                        :class="['help-block invalid-feedback']">
                                    <strong v-text="formPartnerExtra.errors.get('company_activity_field_en')"></strong>
                                </span>
                </div>
                <div class="form-group">
                  <label for="company_founder">{{ trans.get('messages.admin.users.partner.company_founder') }}</label>

                  <input :class="['form-control', formPartnerExtra.errors.has('company_founder') ? 'is-invalid' : '']"
                         v-model="formPartnerExtra.company_founder" id="company_founder"
                         name="company_founder"
                         type="text"/>
                  <span v-if="formPartnerExtra.errors.has('company_founder')"
                        :class="['help-block invalid-feedback']">
                                    <strong v-text="formPartnerExtra.errors.get('company_founder')"></strong>
                                </span>
                </div>
                <div class="form-group">
                  <label
                      for="company_founder_en">{{ trans.get('messages.admin.users.partner.company_founder_en') }}</label>

                  <input
                      :class="['form-control', formPartnerExtra.errors.has('company_founder_en') ? 'is-invalid' : '']"
                      v-model="formPartnerExtra.company_founder_en" id="company_founder_en"
                      name="company_founder_en"
                      type="text"/>
                  <span v-if="formPartnerExtra.errors.has('company_founder_en')"
                        :class="['help-block invalid-feedback']">
                                    <strong v-text="formPartnerExtra.errors.get('company_founder_en')"></strong>
                                </span>
                </div>
                <div class="form-group">
                  <label for="company_services">{{ trans.get('messages.admin.users.partner.company_services') }}</label>

                  <textarea
                      :class="['form-control', formPartnerExtra.errors.has('company_services') ? 'is-invalid' : '']"
                      v-model="formPartnerExtra.company_services" id="company_services"
                      name="company_services"
                      type="text"></textarea>
                  <span v-if="formPartnerExtra.errors.has('company_services')"
                        :class="['help-block invalid-feedback']">
                                    <strong v-text="formPartnerExtra.errors.get('company_services')"></strong>
                                </span>
                </div>
                <div class="form-group">
                  <label
                      for="company_services_en">{{ trans.get('messages.admin.users.partner.company_services_en') }}</label>

                  <textarea
                      :class="['form-control', formPartnerExtra.errors.has('company_services_en') ? 'is-invalid' : '']"
                      v-model="formPartnerExtra.company_services_en" id="company_services_en"
                      name="company_services_en" type="text"></textarea>
                  <span v-if="formPartnerExtra.errors.has('company_services_en')"
                        :class="['help-block invalid-feedback']">
                                    <strong v-text="formPartnerExtra.errors.get('company_services_en')"></strong>
                                </span>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="company_site">{{ trans.get('messages.admin.users.partner.company_site') }}</label>

                  <input :class="['form-control', formPartnerExtra.errors.has('company_site') ? 'is-invalid' : '']"
                         v-model="formPartnerExtra.company_site" id="company_site" name="company_site"
                         type="text"/>
                  <span v-if="formPartnerExtra.errors.has('company_site')"
                        :class="['help-block invalid-feedback']">
                                    <strong v-text="formPartnerExtra.errors.get('company_site')"></strong>
                                </span>
                </div>
                <div class="form-group">
                  <label for="company_logo">{{ trans.get('messages.admin.users.partner.company_logo') }}</label>

                  <input :class="['form-control']" accept="image/*"
                         type="file" id="company_logo" ref="company_logo"
                         v-on:change="handleFileUpload()"/>
                  <span v-if="form.errors.has('company_logo')"
                        :class="['help-block invalid-feedback']">
                                        <strong v-text="form.errors.get('company_logo')"></strong>
                                    </span>
                </div>

                <div class="form-group">
                  <label for="company_projects">{{ trans.get('messages.admin.users.partner.company_projects') }}</label>

                  <textarea
                      :class="['form-control', formPartnerExtra.errors.has('company_projects') ? 'is-invalid' : '']"
                      v-model="formPartnerExtra.company_projects" id="company_projects"
                      name="company_projects"
                      type="text"></textarea>
                  <span v-if="formPartnerExtra.errors.has('company_projects')"
                        :class="['help-block invalid-feedback']">
                                    <strong v-text="formPartnerExtra.errors.get('company_projects')"></strong>
                                </span>
                </div>
                <div class="form-group">
                  <label
                      for="company_projects_en">{{ trans.get('messages.admin.users.partner.company_projects_en') }}</label>

                  <textarea
                      :class="['form-control', formPartnerExtra.errors.has('company_projects_en') ? 'is-invalid' : '']"
                      v-model="formPartnerExtra.company_projects_en" id="company_projects_en"
                      name="company_projects_en" type="text"></textarea>
                  <span v-if="formPartnerExtra.errors.has('company_projects_en')"
                        :class="['help-block invalid-feedback']">
                                    <strong v-text="formPartnerExtra.errors.get('company_projects_en')"></strong>
                                </span>
                </div>
                <div class="form-group">
                  <label for="company_awards">{{ trans.get('messages.admin.users.partner.company_awards') }}</label>

                  <textarea
                      :class="['form-control', formPartnerExtra.errors.has('company_awards') ? 'is-invalid' : '']"
                      v-model="formPartnerExtra.company_awards" id="company_awards"
                      name="company_awards"
                      type="text"></textarea>
                  <span v-if="formPartnerExtra.errors.has('company_awards')"
                        :class="['help-block invalid-feedback']">
                                    <strong v-text="formPartnerExtra.errors.get('company_awards')"></strong>
                                </span>
                </div>
                <div class="form-group">
                  <label
                      for="company_awards_en">{{ trans.get('messages.admin.users.partner.company_awards_en') }}</label>

                  <textarea
                      :class="['form-control', formPartnerExtra.errors.has('company_awards_en') ? 'is-invalid' : '']"
                      v-model="formPartnerExtra.company_awards_en" id="company_awards_en"
                      name="company_awards_en"
                      type="text"/>
                  <span v-if="formPartnerExtra.errors.has('company_awards_en')"
                        :class="['help-block invalid-feedback']">
                                    <strong v-text="formPartnerExtra.errors.get('company_awards_en')"></strong>
                                </span>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">
              {{ trans.get('messages.all.cancel') }}
            </button>
            <button type="button" @click="setPartnerExtra()" :disabled="form.errorsOrSend()"
                    class="btn btn-primary">
              {{ trans.get('messages.all.submit') }}
            </button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" tabindex="-1" role="dialog" id="profile_city_model">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <form class="form-inline text-right">
                  <vue-select
                      :class="['form-control mb-2 mr-sm-2']"
                      :options="cityList"
                      label="value"
                      v-model="profile_city.city">
                  </vue-select>

                  <button type="button" class="btn btn-primary mb-2" v-on:click="addProfileCity()">
                    {{trans.get('messages.all.add')}}
                  </button>
                </form>
              </div>
              <div class="col-12">
                <table class="table table-striped table-responsive-sm col-12">
                  <thead>
                  <tr>
                    <th>{{ trans.get('messages.all.name') }}</th>
                    <th>{{ trans.get('messages.all.actions') }}</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(profileCity, index) in profileCitesList">
                    <td>{{profileCity.city.value}}</td>
                    <td>
                      <button class="btn btn-danger btn-sm" v-on:click="deleteProfileCity(profileCity.id)">
                        <i class="fal fa-trash"></i>
                      </button>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">
              {{ trans.get('messages.all.cancel') }}
            </button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" tabindex="-1" role="dialog" id="profile_license_type_model">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                  <div class="col-12 mb-3">
                    <vue-select
                        :options="licenseTypeList"
                        label="name"
                        v-model="profile_license_type.license_type">
                    </vue-select>
                  </div>
                  <div class="col-12 text-right">
                    <button type="button" class="btn btn-primary mb-2" v-on:click="addProfileLicenseType()">
                      {{ trans.get('messages.all.add') }}
                    </button>
                  </div>
              </div>
              <div class="col-12">
                <table class="table table-striped table-responsive-sm col-12">
                  <thead>
                  <tr>
                    <th>{{ trans.get('messages.all.name') }}</th>
                    <th>{{ trans.get('messages.all.actions') }}</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(profileLicenseType, index) in profileLicenseTypeList">
                    <td>{{profileLicenseType.license_type.name}}</td>
                    <td>
                      <button class="btn btn-danger btn-sm" v-on:click="deleteProfileLicenseType(profileLicenseType.id)">
                        <i class="fal fa-trash"></i>
                      </button>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">
              {{ trans.get('messages.all.cancel') }}
            </button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  </div>
</template>

<script>
export default {
  name: 'user-list',
  data() {
    return {
      url: '/admin/vue/users',
      userList: {},
      defaultCity: -1,
      defaultUser: {
        id: 0,
        user_name: '',
        email: '',
        role_name: '',
        role_id: null,
        is_active: true,
        manager_name: '',
        manager_id: '',
        company_id: null,
        city_id: null,
        country_name: '',
        country_code: '',
        city_name: '',
      },
      defaultPartnerExtra: {
        id: 0,
        profile_id: 0,
        company_name: '',
        company_name_en: '',
        company_site: '',
        company_logo: '',
        company_activity_field: '',
        company_activity_field_en: '',
        company_founder: '',
        company_founder_en: '',
        company_services: '',
        company_services_en: '',
        company_projects: '',
        company_projects_en: '',
        company_awards: '',
        company_awards_en: ''
      },
      form: new Form(this.defaultUser),
      formPartnerExtra: new Form(this.defaultPartnerExtra),
      roleList: this.roleListProp,
      companyProfileAddressList: this.companyProfileAddressListProp,
      cityList: this.cityListProp,
      managerList: this.managerListProp,
      currentPage: 1,
      searchText: null,
      roleTypeId: this.cnstRoleTypeEmployees,
      roleHelperList: roleHelperList,
      roleTypeHelperList: roleTypeHelperList,

      licenseTypeList: [],

      profileCitesList: [],
      profileLicenseTypeList: [],
      profile_city: {
        id: null,
        city: null,
      },
      profile_license_type: {
        id: null,
        license_type: null,
      }
    }
  },
  props: {
    "roleListProp": Array,
    "managerListProp": Array,
    "companyProfileAddressListProp": Array,
    "cityListProp": Array,
    "initialRoleTypeList": Array,
    cnstRoleTypeExternal: {
      type: Number,
      default: 2
    },
    cnstRoleTypeEmployees: {
      type: Number,
      default: 1
    },
  },
  created() {
    // VueEvent.listen('MapsApiLoaded', this.initGooglePlace);
  },
  mounted() {
    this.getUserList();
    this.getLicenseTypeList();
  },
  methods: {
    getUserList(page = 1) {
      this.currentPage = page;
      let requestUrl = this.url + '?page=' + page;
      if (this.searchText !== null) {
        requestUrl = requestUrl + '&searchText=' + this.searchText;
      }
      if (this.roleTypeId !== null) {
        requestUrl = requestUrl + '&roleTypeId=' + this.roleTypeId;
      }

      axios.get(requestUrl).then(response => {
        this.userList = response.data;
      });
    },
    canEdit() {
      return this.roleTypeId !== this.roleTypeHelperList.external;
    },
    initCreate() {
      this.getCityList();
      this.getManagerList();
      this.form = new Form(this.defaultUser);

      $('#set-model').modal('show');
    },
    set() {
      let self = this;
      let _url = this.url + "/store";
      let _message = this.trans.get('messages.admin.system.success.store');
      if (self.form.id !== 0) {
        _url = this.url + "/update";
        _message = this.trans.get('messages.admin.system.success.update');
      }

      if (self.roleTypeId !== self.roleTypeHelperList.employees) {
        switch (self.roleTypeId) {
          case self.roleTypeHelperList.partner:
            self.form.role_id = self.roleHelperList.Partner;
            break;
          case this.roleTypeHelperList.agent:
            self.form.role_id = self.roleHelperList.Agent;
            break;
        }
      }

      self.form.post(_url)
          .then(request => {
            self.getUserList(self.currentPage);
            $('#set-model').modal('hide');

            self.$notify({
              group: 'all',
              position: 'top right',
              text: _message,
              type: 'success'
            });
          });
    },
    initUpdate(index) {
      this.getCityList();
      this.getManagerList();
      this.form = new Form(this.userList.data[index]);
      this.form.is_active = this.form.is_active === 1;

      $('#set-model').modal('show');
    },
    deActivateUser(id, index) {
      let self = this;

      self._setUserActiveStatus(self, this.url + '/deactivate/' + id, index, '0');
    },
    activateUser(id, index) {
      let self = this;

      self._setUserActiveStatus(self, this.url + '/activate/' + id, index, '1');
    },
    isActive(user) {
      return user.is_active * 1 === 1 ? this.trans.get('messages.all.yes') :
          this.trans.get('messages.all.no')
    },
    _setUserActiveStatus(obj, url, index, status) {
      axios.get(url).then(response => {
        obj.userList.data[index].is_active = status;

        let message = status === '0' ? obj.trans.get('messages.admin.users.success.deactivate') : this.trans.get('messages.admin.users.success.activate')

        obj.$notify({
          group: 'all',
          position: 'top right',
          text: message,
          type: 'success'
        });
      })
          .catch(error => {
            obj.onFail(error.response.data.errors);

            reject(error.response.data);
          });
    },
    searchUser() {
      this.getUserList();
    },
    onRoleTypeChange() {
      this.searchText = null;
      this.getUserList();
    },
    getLicenseTypeList() {
      axios.get(this.url + '/getLicenseTypeList').then(response => {
        this.licenseTypeList = response.data;
      });
    },
    getCityList() {
      axios.get(this.url + '/getCityList').then(response => {
        this.cityList = response.data;
      });
    },
    getManagerList() {
      axios.get(this.url + '/getManagerList').then(response => {
        this.managerList = response.data;
      });
    },
    initGooglePlace() {
      if ($('#city_name')[0] !== undefined) {
        let self = this;
        let options = {
          types: ['(cities)']
        };

        let autocomplete = new google.maps.places.Autocomplete(document.getElementById("city_name"), options);

        google.maps.event.addListener(autocomplete, 'place_changed', function () {
          self.getGooglePaceCountryCode(autocomplete);
        });
      } else {
        setTimeout(this.initGooglePlace, 100);
      }
    },
    getGooglePaceCountryCode(autocomplete) {
      let place = autocomplete.getPlace();

      for (let i = 0; i < place.address_components.length; i++) {
        let addressType = place.address_components[i].types[0];

        if (addressType === "country") {
          this.form.country_code = place.address_components[i].short_name;
        }
      }

      this.form.city_name = place.formatted_address;
    },
    cityChange() {
      if (this.form.city_id === -1) {
        this.initGooglePlace();
      }
    },
    initPartnerExtra(index) {
      let user = this.userList.data[index];
      axios.get(this.url + '/getPartnerExtra/' + user.id).then(response => {
        if (JSON.stringify(response.data) === JSON.stringify({})) {
          this.formPartnerExtra = new Form(this.defaultPartnerExtra);
        } else {
          this.formPartnerExtra = new Form(response.data);
        }
        this.formPartnerExtra.profile_id = user.id;

        $('#partner-extra-model').modal('show');
      });
    },
    setPartnerExtra() {
      let self = this;

      self.formPartnerExtra.postMultipart(this.url + "/setPartnerExtra")
          .then(request => {
            $('#partner-extra-model').modal('hide');

            self.$notify({
              group: 'all',
              position: 'top right',
              text: _message,
              type: 'success'
            });
          });
    },
    handleFileUpload() {
      this.formPartnerExtra.company_logo = this.$refs.company_logo.files[0];
    },
    initProfileCityList(userId) {
      this.profile_city.id= userId;
      this.profile_city.city = null;
      axios.get(this.url + '/' + userId + '/getProfileCites').then(response => {
        this.profileCitesList = response.data;
        $('#profile_city_model').modal('show');
      });
    },
    addProfileCity(){
      axios.get(this.url + '/' + this.profile_city.id + '/setProfileCity/' + this.profile_city.city.id).then(response => {
        this.profileCitesList = response.data;
        this.profile_city.city = null;
      });
    },
    deleteProfileCity(id){
      axios.get(this.url + '/' + this.profile_city.id + '/deleteProfileCity/' + id).then(response => {
        this.profileCitesList = response.data;
      });
    },

    initProfileLicenseTypeList(userId) {
      this.profile_license_type.id= userId;
      this.profile_license_type.license_type = null;
      axios.get(this.url + '/' + userId + '/getProfileLicenseType').then(response => {
        this.profileLicenseTypeList = response.data;
        $('#profile_license_type_model').modal('show');
      });
    },

    addProfileLicenseType(){
      axios.get(this.url + '/' + this.profile_license_type.id + '/setProfileLicenseType/' + this.profile_license_type.license_type.id).then(response => {
        this.profileLicenseTypeList = response.data;
        this.profile_license_type.license_type = null;
      });
    },
    deleteProfileLicenseType(id){
      axios.get(this.url + '/' + this.profile_license_type.id + '/deleteProfileLicenseType/' + id).then(response => {
        this.profileLicenseTypeList = response.data;
      });
    },
  }
}
</script>

<style scoped>

</style>
