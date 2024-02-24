<template>
  <div>
    <div class="container mb-5">
      <div class="row">
        <div class="col-12">
          <div class="title-main">
            {{ trans.get('messages.admin.event.event_list') }}
          </div>
        </div>
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row pb-3">
                <div class="col-12">
                  <button class="btn btn-primary" @click="initCreate(null)">
                    <i class="fa fa-plus-square"></i>
                    {{ trans.get('messages.all.add') }}
                  </button>
                </div>
              </div>
              <div>
                <table id="users" class="table table-striped table-responsive-sm col-12">
                  <thead>
                  <tr>
                    <th>{{ trans.get('messages.admin.event.event_date') }}</th>
                    <th>{{ trans.get('messages.admin.event.name') }}</th>
                    <th>{{ trans.get('messages.admin.event.city') }}</th>
                    <th>{{ trans.get('messages.admin.event.place') }}</th>
                    <th>{{ trans.get('messages.admin.event.event_type') }}</th>
                    <th>{{ trans.get('messages.all.actions') }}</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(entity, index) in entityList.data">
                    <td>{{ entity.event_date | moment("DD.MM.YYYY") }}</td>
                    <td>{{ entity.name }}</td>
                    <td>{{ entity.city }}</td>
                    <td>{{ entity.place }}</td>
                    <td>{{ entity.event_type.name }}</td>
                    <td class="text-center">
                      <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                          <i class="fa fa-bars"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item"
                             @click="changePreviewPhoto(entity.id)">{{
                              trans.get('messages.admin.event.changePreviewPhoto')
                            }}</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item"
                             @click="changeLogoPhoto(entity.id)">{{
                              trans.get('messages.admin.event.changeLogoPhoto')
                            }}</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item cursor-pointer"
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
    <div class="modal fade" tabindex="-1" role="dialog" id="change-photo">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">{{ trans.get('messages.admin.event.changePreviewPhoto') }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form enctype="multipart/form-data">
              <div class="form-group">
                <label for="file">{{ trans.get('messages.admin.serviceCategory.name') }}</label>
                <input :class="['form-control']" accept="image/*"
                       type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>

              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">
              {{ trans.get('messages.all.cancel') }}
            </button>
            <button type="button" @click="uploadPhoto()" class="btn btn-primary">
              {{ trans.get('messages.all.submit') }}
            </button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" tabindex="-1" role="dialog" id="change-logo">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">{{ trans.get('messages.admin.event.changeLogoPhoto') }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form enctype="multipart/form-data">
              <div class="form-group">
                <label for="logo_file">{{ trans.get('messages.admin.serviceCategory.name') }}</label>
                <input :class="['form-control']" accept="image/*"
                       type="file" id="logo_file" ref="logo_file" v-on:change="handleLogoUpload()"/>

              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">
              {{ trans.get('messages.all.cancel') }}
            </button>
            <button type="button" @click="uploadLogo()" class="btn btn-primary">
              {{ trans.get('messages.all.submit') }}
            </button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" tabindex="-1" role="dialog" id="set-model">
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
                  <label for="name">{{ trans.get('messages.admin.event.name') }}</label>

                  <input :class="['form-control', form.errors.has('name') ? 'is-invalid' : '']" v-model="form.name"
                         id="name" name="name" type="text"/>
                  <span v-if="form.errors.has('name')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('name')"></strong>
                            </span>
                </div>

                <div class="form-group">
                  <label for="name_en">{{ trans.get('messages.admin.event.name_en') }}</label>

                  <input :class="['form-control', form.errors.has('name_en') ? 'is-invalid' : '']"
                         v-model="form.name_en"
                         id="name_en" name="name_en" type="text"/>
                  <span v-if="form.errors.has('name_en')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('name_en')"></strong>
                            </span>
                </div>


                <div class="form-group">
                  <label for="event_date">{{ trans.get('messages.admin.event.event_date') }}</label>

                  <date-picker id="event_date" name="event_date" v-model="form.event_date"
                               :config="datepickerOptions"></date-picker>
                  <span v-if="form.errors.has('event_date')"
                        :class="['help-block invalid-feedback']">
                                                    <strong v-text="form.errors.get('event_date')"></strong>
                                                </span>
                </div>
                <div class="form-group">
                  <label for="content">{{ trans.get('messages.admin.event.content') }}</label>

                  <textarea
                      :class="['form-control ckedit', form.errors.has('content') ? 'is-invalid' : '']"
                      v-model="form.content" id="content" name="content"></textarea>
                  <span v-if="form.errors.has('content')" :class="['help-block invalid-feedback']">
                                    <strong v-text="form.errors.get('content')"></strong>
                                </span>
                </div>

                <div class="form-group">
                  <label for="content_en">{{ trans.get('messages.admin.event.content_en') }}</label>

                  <textarea
                      :class="['form-control ckedit', form.errors.has('content_en') ? 'is-invalid' : '']"
                      v-model="form.content_en" id="content_en" name="content_en"></textarea>
                  <span v-if="form.errors.has('content_en')" :class="['help-block invalid-feedback']">
                                    <strong v-text="form.errors.get('content_en')"></strong>
                                </span>
                </div>
              </div>
              <div class="col-6">


                <div class="form-group">
                  <label for="city">{{ trans.get('messages.admin.event.city') }}</label>

                  <input :class="['form-control', form.errors.has('city') ? 'is-invalid' : '']" v-model="form.city"
                         id="city" name="city" type="text"/>
                  <span v-if="form.errors.has('city')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('city')"></strong>
                            </span>
                </div>

                <div class="form-group">
                  <label for="place">{{ trans.get('messages.admin.event.place') }}</label>

                  <input :class="['form-control', form.errors.has('place') ? 'is-invalid' : '']" v-model="form.place"
                         id="place" name="place" type="text"/>
                  <span v-if="form.errors.has('place')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('place')"></strong>
                            </span>
                </div>

                <div class="form-group">
                  <label for="event_type_id">{{ trans.get('messages.admin.event.event_type') }}</label>

                  <select :class="['form-control', form.errors.has('event_type_id') ? 'is-invalid' : '']"
                          v-model="form.event_type_id" id="event_type_id" name="event_type_id">
                    <option v-for="(eventType, index) in eventTypeList" :value="eventType.id">
                      {{ eventType.name }}
                    </option>
                  </select>

                  <span v-if="form.errors.has('event_type_id')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('event_type_id')"></strong>
                            </span>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">{{ trans.get('messages.all.cancel') }}
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
  name: "EventListComponent",
  data() {
    return {
      url: '/admin/vue/event',
      entityList: {},
      selectedEvent: null,
      eventCardKey: 0,
      currentPage: 1,
      entityIdForPhoto: null,
      eventTypeList: [],
      entity: {
        id: null,
        event_type_id: this.initialEventTypeId,
        event_date: '',
        name: '',
        name_en: '',
        content: '',
        content_en: '',
        city: '',
        place: '',
        logo_photo: null,
        preview_photo: null,
      },
      datepickerOptions: {
        format: 'DD.MM.YYYY'
      },
      form: new Form(this.entity)
    }
  },
  mounted() {
    this.getEntityList();
    this.getEventTypeList();
  },
  props: {
    'initialEventTypeId': Number
  },
  methods: {
    getEntityList(page = 1) {
      this.currentPage = page;
      axios.get(this.url + '/list?page=' + page).then(response => {
        this.entityList = response.data;
      });
    },
    getEventTypeList() {
      axios.get(this.url + "/getEventTypeList").then(response => {
        this.eventTypeList = response.data;
      });
    },
    initCreate() {
      this.form = new Form(this.entity);
      $('#set-model').modal('show');
    },
    initUpdate(index) {
      let entity = this.entityList.data[index];
      entity.event_date = moment(entity.event_date).format('DD.MM.YYYY');
      this.form = new Form(entity);
      $('#set-model').modal('show');
    },
    set() {
      let self = this;
      let _url = this.url + "/store";
      let _message = this.trans.get('messages.admin.system.success.store');
      if (self.form.id != null) {
        _url = this.url + "/update";
        _message = this.trans.get('messages.admin.system.success.update');
      }

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
    changePreviewPhoto(entityId) {
      this.entityIdForPhoto = entityId;

      $('#change-photo').modal('show');
    },
    handleFileUpload() {
      this.preview = this.$refs.file.files[0];
    },
    uploadPhoto() {
      let self = this;
      let formData = new FormData();
      formData.append('preview', this.preview);
      axios.post(this.url + '/changePreviewPhoto/' + this.entityIdForPhoto,
          formData,
          {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          }
      ).then(function () {

        $('#change-photo').modal('hide');

        self.$notify({
          group: 'all',
          position: 'top right',
          text: self.trans.get('messages.admin.system.success.update'),
          type: 'success'
        });
      });
    },
    changeLogoPhoto(entityId) {
      this.entityIdForPhoto = entityId;

      $('#change-logo').modal('show');
    },
    handleLogoUpload() {
      this.logo = this.$refs.logo_file.files[0];
    },
    uploadLogo() {
      let self = this;
      let formData = new FormData();
      formData.append('logo', this.logo);
      axios.post(this.url + '/changeLogoPhoto/' + this.entityIdForPhoto,
          formData,
          {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          }
      ).then(function () {

        $('#change-logo').modal('hide');

        self.$notify({
          group: 'all',
          position: 'top right',
          text: self.trans.get('messages.admin.system.success.update'),
          type: 'success'
        });
      });
    },

  }
}
</script>

<style scoped>

</style>
