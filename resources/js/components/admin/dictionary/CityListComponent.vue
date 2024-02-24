<template>
  <div>
    <div class="container mb-5">
      <div class="row">
        <div class="col-12">
          <div class="title-main">
            {{ trans.get('messages.admin.dictionary.city.title') }}
          </div>
        </div>
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-12">

                  <div class="row pb-3">
                    <div class="col-3">
                      <label for="country_id">{{ trans.get('messages.admin.serviceList.countryFilter') }}</label>
                      <select class="form-control" id="country_id" @change="onCountryChange()"
                              v-model="selectedCountryId">
                        <option :value="country.id" v-for="(country, index) in countryList">
                          {{ country.name }}
                        </option>
                      </select>
                    </div>
                    <div class="col-9">
                      <button :disabled="isAddCityDisabled" class="btn btn-primary float-right" @click="initCreate()">
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
                      <th>{{ trans.get('messages.admin.dictionary.city.value') }}</th>
                      <th>{{ trans.get('messages.admin.dictionary.city.value_en') }}</th>
                      <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(entity, index) in entityList">
                      <td>{{ entity.value }}</td>
                      <td>{{ entity.value_en }}</td>

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
            <button type="button" class="close" @click="hideModal()" aria-label="Close"><span
                aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body" @change="form.errors.clear($event.target.name)"
               @keydown="form.errors.clear($event.target.name)">

            <div class="form-group">
              <label for="value">{{ trans.get('messages.admin.dictionary.city.value') }}</label>

              <input :class="['form-control', form.errors.has('value') ? 'is-invalid' : '']"
                     v-model="form.value" id="value" name="value"/>
              <span v-if="form.errors.has('value')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('value')"></strong>
                            </span>
            </div>

            <div class="form-group">
              <label for="value_en">{{ trans.get('messages.admin.dictionary.city.value_en') }}</label>

              <input :class="['form-control', form.errors.has('value_en') ? 'is-invalid' : '']"
                     v-model="form.value_en" id="value_en" name="value_en" type="text"/>
              <span v-if="form.errors.has('value_en')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('value_en')"></strong>
                            </span>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" @click="hideModal()">
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
  name: "CityListComponent",
  data() {
    return {
      url: '/admin/vue/dictionary/city',
      countryList: this.initialCountryList,
      selectedCountryId: null,
      entityList: {},
      defaultEntity: {
        id: null,
        country_id: null,
        value: '',
        value_en: ''
      },
      form: new Form(this.defaultEntity),
    }
  },
  props: {
    'initialCountryList': Array
  },
  mounted() {
    this.onCountryChange();
  },
  computed: {
    isAddCityDisabled: function () {
      return (this.selectedCountryId === null);
    }
  },
  methods: {
    onCountryChange() {
      if (this.selectedCountryId != null) {
        this.getEntityList();
      }
    },
    getEntityList() {
      let cityUrl = this.url + '/list/' + this.selectedCountryId;

      axios.get(cityUrl).then(response => {
        this.entityList = response.data;
      });
    },
    initCreate() {
      this.form = new Form(this.defaultEntity);
      $('#set-model').modal('show');
    },
    initUpdate(index) {
      let entity = this.entityList[index];
      this.form = new Form(entity);
      $('#set-model').modal('show');
    },
    set() {
      let self = this;
      let _url = this.url + "/store";
      let _message = this.trans.get('messages.admin.system.success.store');
      if (self.form.id !== null) {
        _url = this.url + "/update";
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

            this.hideModal();
          });
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
    hideModal() {
      $('#set-model').modal('hide');
    }
  },
}
</script>

<style scoped>

</style>