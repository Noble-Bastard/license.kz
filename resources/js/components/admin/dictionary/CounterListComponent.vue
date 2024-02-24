<template>
  <div>
    <div class="container mb-5">
      <div class="row">
        <div class="col-12">
          <div class="title-main">
            {{ trans.get('messages.admin.dictionary.counter.title') }}
          </div>
        </div>

        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <button class="btn btn-primary float-right" @click="initCreate()">
                    <i class="fa fa-plus-square"></i>
                    {{ trans.get('messages.all.add') }}
                  </button>
                </div>
                <div class="col-12 mt-3">
                  <table id="users" class="table table-striped table-responsive-sm col-12">
                    <thead>
                    <tr>
                      <th>{{ trans.get('messages.admin.dictionary.counter.counter_type_code') }}</th>
                      <th>{{ trans.get('messages.admin.dictionary.counter.counter_type_name') }}</th>
                      <th>{{ trans.get('messages.admin.dictionary.counter.mask') }}</th>
                      <th>{{ trans.get('messages.admin.dictionary.counter.length') }}</th>
                      <th>{{ trans.get('messages.admin.dictionary.counter.increase') }}</th>
                      <th>{{ trans.get('messages.admin.dictionary.counter.country_name') }}</th>
                      <th>{{ trans.get('messages.all.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(entity, index) in entityList">
                      <td>{{ entity.counter_type_code }}</td>
                      <td>{{ entity.counter_type_name }}</td>
                      <td>{{ entity.mask }}</td>
                      <td>{{ entity.length }}</td>
                      <td>{{ entity.increase }}</td>
                      <td>{{ entity.country == null ? "" : entity.country.name }}</td>

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
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-if="form.id === 0">{{ trans.get('messages.admin.system.modal.create') }}</h4>
            <h4 class="modal-title" v-else>{{ trans.get('messages.admin.system.modal.update') }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" @change="form.errors.clear($event.target.name)"
               @keydown="form.errors.clear($event.target.name)">

            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label
                      for="counter_type_code">{{ trans.get('messages.admin.dictionary.counter.counter_type_code') }}</label>

                  <input :class="['form-control', form.errors.has('counter_type_code') ? 'is-invalid' : '']"
                         v-model="form.counter_type_code" id="counter_type_code" name="counter_type_code" type="text"/>
                  <span v-if="form.errors.has('counter_type_code')"
                        :class="['help-block invalid-feedback']">
                                        <strong v-text="form.errors.get('counter_type_code')"></strong>
                                    </span>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label
                      for="counter_type_name">{{ trans.get('messages.admin.dictionary.counter.counter_type_name') }}</label>

                  <input :class="['form-control', form.errors.has('counter_type_name') ? 'is-invalid' : '']"
                         v-model="form.counter_type_name" id="counter_type_name" name="counter_type_name" type="text"/>
                  <span v-if="form.errors.has('counter_type_name')"
                        :class="['help-block invalid-feedback']">
                                        <strong v-text="form.errors.get('counter_type_name')"></strong>
                                    </span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                <div class="form-group">
                  <label for="mask">{{ trans.get('messages.admin.dictionary.counter.mask') }}</label>

                  <input :class="['form-control', form.errors.has('mask') ? 'is-invalid' : '']"
                         v-model="form.mask" id="mask" name="mask" type="text"/>
                  <span v-if="form.errors.has('mask')"
                        :class="['help-block invalid-feedback']">
                                        <strong v-text="form.errors.get('mask')"></strong>
                                    </span>
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label for="length">{{ trans.get('messages.admin.dictionary.counter.length') }}</label>

                  <input :class="['form-control', form.errors.has('length') ? 'is-invalid' : '']"
                         v-model="form.length" id="length" name="length" type="number"/>
                  <span v-if="form.errors.has('length')"
                        :class="['help-block invalid-feedback']">
                                        <strong v-text="form.errors.get('length')"></strong>
                                    </span>
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label for="increase">{{ trans.get('messages.admin.dictionary.counter.increase') }}</label>

                  <input :class="['form-control', form.errors.has('increase') ? 'is-invalid' : '']"
                         v-model="form.increase" id="increase"
                         name="increase" type="number"/>
                  <span v-if="form.errors.has('increase')"
                        :class="['help-block invalid-feedback']">
                                        <strong v-text="form.errors.get('increase')"></strong>
                                    </span>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="country_id">{{ trans.get('messages.admin.serviceCategory.country') }}</label>
                  <select class="form-control" id="country_id" v-model="form.country_id">
                    <option value=""></option>
                    <option :value="country.id" v-for="(country, index) in initialCountryList">
                      {{ country.name }}
                    </option>
                  </select>
                </div>
              </div>
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
  </div>
</template>

<script>
export default {
  name: "CounterListComponent",
  props: {
    'initialCountryList': Array
  },
  data() {
    return {
      url: '/admin/vue/dictionary/counter',
      entityList: [],
      defaultEntity: {
        id: 0,
        counter_type_id: 0,
        counter_type_code: '',
        counter_type_name: '',
        mask: '',
        length: 2,
        increase: 1,
        sequence: 1,
        country_id: null
      },
      form: new Form(this.defaultEntity)
    }
  },
  mounted() {
    this.getEntityList();
  },
  methods: {
    getEntityList() {
      axios.get(this.url + '/list').then(response => {
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
      this.form.is_active = entity.is_active === "1";
      this.form.is_required = entity.is_required === "1";

      this.editEntityIndex = index;
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

            $('#set-model').modal('hide');
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
  }
}
</script>

<style scoped>

</style>
