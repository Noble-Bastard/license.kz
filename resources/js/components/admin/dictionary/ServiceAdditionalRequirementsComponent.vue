<template>
  <div>
    <div class="container mb-5">
      <div class="row">
        <div class="col-12">
          <div class="title-main">
            {{ trans.get('messages.admin.dictionary.serviceAdditionalRequirements.title') }}
          </div>
        </div>
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <div class="row pb-3">
                    <div class="col-3">
                    </div>
                    <div class="col-9">
                      <button class="btn btn-primary float-right" @click="initCreate()">
                        <i class="fa fa-plus-square"></i>
                        {{ trans.get('messages.all.add') }}
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 mt-3">
                  <table class="table table-striped table-responsive-sm col-12">
                    <thead>
                    <tr>
                      <th>{{ trans.get('messages.admin.dictionary.serviceAdditionalRequirements.licenseType') }}</th>
                      <th>
                        {{ trans.get('messages.admin.dictionary.serviceAdditionalRequirements.serviceAdditionalRequirementsType') }}
                      </th>
                      <th>{{ trans.get('messages.admin.dictionary.serviceAdditionalRequirements.description') }}</th>
                      <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(entity, index) in entityList">
                      <td>{{ entity.license_type.name }}</td>
                      <td>{{ entity.service_additional_requirements_type.name }}</td>
                      <td>{{ entity.description }}</td>

                      <td class="text-center">
                        <div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button"
                                  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                  aria-expanded="false">
                            <i class="fa fa-bars"></i>
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item"
                               @click="initUpdate(index)">{{ trans.get('messages.all.edit') }}</a>
                            <a class="dropdown-item"
                               @click="deleteEntity(entity.id, index)"
                               data-method="delete">{{ trans.get('messages.all.delete') }}</a>
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
      </div>
    </div>

    <div class="modal fade" role="dialog" id="set-model">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-if="form.id === null">{{ trans.get('messages.admin.system.modal.create') }}</h4>
            <h4 class="modal-title" v-else>{{ trans.get('messages.admin.system.modal.update') }}</h4>
            <button type="button" class="close" @click="modal('hide')" aria-label="Close"><span
                aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body" @change="form.errors.clear($event.target.name)"
               @keydown="form.errors.clear($event.target.name)">
            <form-group
                :p-caption="trans.get('messages.admin.dictionary.serviceAdditionalRequirements.licenseType')"
                p-field-name="license_type_id"
                :p-form="form"
                :p-type="componentType.Select2"
                :p-dict-list="pLicenseTypeList"
                p-dict-val-name="name"
            ></form-group>
            <form-group
                :p-caption="trans.get('messages.admin.dictionary.serviceAdditionalRequirements.serviceAdditionalRequirementsType')"
                p-field-name="service_additional_requirements_type_id"
                :p-form="form"
                :p-type="componentType.Select2"
                :p-dict-list="pServiceAdditionalRequirementsTypeList"
                p-dict-val-name="name"
            ></form-group>
            <multi-lang-form-group
                :p-caption="trans.get('messages.admin.dictionary.serviceAdditionalRequirements.description')"
                p-field-name="description"
                :p-form="form"
                :p-type="componentType.Textarea"
            ></multi-lang-form-group>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" @click="modal('hide')">
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
</template>

<script>
export default {
  name: "ServiceAdditionalRequirementsComponent",
  props: {
    pLicenseTypeList: Array,
    pServiceAdditionalRequirementsTypeList: Array
  },
  data() {
    return {
      url: '/admin/vue/dictionary/serviceAdditionalRequirements',
      entityList: [],
      defaultEntity: {
        id: null,
        service_additional_requirements_type_id: 0,
        license_type_id: 0,
        description: '',
        description_en: ''
      },
      form: new Form(this.defaultEntity),
      componentType: formComponentType
    }
  },
  mounted() {
    this.getEntityList();
  },
  methods: {
    modal(value) {
      $('#set-model').modal(value);
    },
    getEntityList() {

      axios.get(this.url + '/list').then(response => {
        this.entityList = response.data;
      });
    },
    initCreate() {
      this.form = new Form(this.defaultEntity);
      this.modal('show');
    },
    initUpdate(index) {
      let entity = this.entityList[index];
      this.form = new Form(entity);
      this.modal('show');
    },
    set() {
      let self = this;
      let _url = this.url + "/set";
      let _message = this.trans.get('messages.admin.system.success.store');
      if (self.form.id !== null) {
        _message = this.trans.get('messages.admin.system.success.update');
      }

      self.form.country_id = this.selectedCountryId;

      self.form.post(_url)
          .then(response => {
            this.entity = response;
            this.form = new Form(this.entity);
            self.$notify({
              group: 'all',
              position: 'top right',
              text: _message,
              type: 'success'
            });

            this.getEntityList();

            this.modal('hide');
          });
    },
    deleteEntity(entityId, index) {
      axios.delete(this.url + "/delete/" + entityId)
          .then(request => {
            this.entityList.splice(index, 1);

            this.$notify({
              group: 'all',
              position: 'top right',
              text: this.trans.get('messages.admin.system.success.delete'),
              type: 'success'
            });
          });
    }
  }
}
</script>

<style scoped>

</style>