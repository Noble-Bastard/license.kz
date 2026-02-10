<template>
  <div>
    <div class="row">
      <div class="col-12">
        <div class="title-main">
          {{ trans.get('messages.layouts.document_template') }}
        </div>
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="row pb-3">
              <div class="col-3">
                <label for="country_id">{{ trans.get('messages.company.documentTemplate.country_name') }}</label>
                <select class="form-control" id="country_id" @change="onCountryChange()" v-model="selectedCountryId">
                  <option :value="country.id" v-for="(country, index) in countryList">
                    {{ country.name }}
                  </option>
                </select>
              </div>
            </div>
            <div>
              <table id="optionsetList" class="table table-striped table-responsive-sm col-12">
                <thead>
                <tr>
                  <th>{{ trans.get('messages.company.documentTemplate.id') }}</th>
                  <th>{{ trans.get('messages.company.documentTemplate.name') }}</th>
                  <th>{{ trans.get('messages.company.documentTemplate.document_template_type_name') }}</th>
                  <th>{{ trans.get('messages.all.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(entity, index) in entityList">
                  <td>{{ entity.id }}</td>
                  <td>{{ entity.name }}</td>
                  <td>{{ entity.document_template_type_name }}</td>
                  <td class="text-center">
                    <div class="dropdown">
                      <button class="btn btn-primary dropdown-toggle" type="button"
                              id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false">
                        <i class="fa fa-bars"></i>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item"
                           @click="initUpload(index)">{{ trans.get('messages.all.uploadFile') }}
                        </a>
                        <a class="dropdown-item"
                           @click="downloadFile(entity.id, index)"
                        >{{ trans.get('messages.all.downloadFile') }}
                        </a>
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

    <div class="modal fade" tabindex="-1" role="dialog" :id="documentTemplateModalName">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-if="form.id === 0">{{ trans.get('messages.admin.system.modal.create') }}</h4>
            <h4 class="modal-title" v-else>{{ trans.get('messages.admin.system.modal.update') }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" @change="form.errors.clear($event.target.name)"
               @keydown="form.errors.clear($event.target.name)">

            <div class="form-group">
              <label for="file">{{ trans.get('messages.company.documentTemplate.file') }}</label>
              <input ref="file" :class="['form-control', form.errors.has('file') ? 'is-invalid' : '']"
                     id="file" name="file" type="file" @change="onFileSelect()"/>
              <span v-if="form.errors.has('file')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('file')"></strong>
                            </span>
            </div>

            <div class="form-group">
              <label
                  for="document_template_type_id">{{ trans.get('messages.company.documentTemplate.document_template_type_name') }}</label>
              <select :disabled="true"
                      :class="['form-control', form.errors.has('document_template_type_id') ? 'is-invalid' : '']"
                      id="document_template_type_id" name="document_template_type_id"
                      v-model="form.document_template_type_id">
                <option v-for="(value, key) in documentTemplateTypeList" :value="value.id">
                  {{ value.name }}
                </option>
              </select>
              <span v-if="form.errors.has('document_template_type_id')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('document_template_type_id')"></strong>
                            </span>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">
              {{ trans.get('messages.all.cancel') }}
            </button>
            <button type="button" @click="set()" :disabled="form.errorsOrSend()" class="btn btn-primary">
              {{ trans.get('messages.all.upload') }}
            </button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  </div>
</template>

<script>

export default {
  name: "DocumentTemplateListComponent",
  data() {
    return {
      urlDocumentTemplate: '/company/vue/document_template',
      entityList: null,
      defaultEntity: {
        id: null,
        name: null,
        path: null,
        country_id: null,
        document_template_type_id: "",
        file: "",
      },
      form: new Form(this.defaultEntity),
      documentTemplateTypeList: this.initialDocumentTemplateTypeList,
      countryList: this.initialCountryList,
      msgSuccessStore: this.trans.get('messages.admin.system.success.store'),
      msgSuccessUpdate: this.trans.get('messages.admin.system.success.update'),
      msgSuccessDelete: this.trans.get('messages.admin.system.success.delete'),
      selectedCountryId: this.initialCountryList[0].id
    }
  },
  props: {
    'initialDocumentTemplateTypeList': Array,
    'initialCountryList': Array
  },
  mounted() {
    this.getEntityList();
  },
  computed: {
    documentTemplateModalName: function () {
      return ('set-document-template-modal');
    },
    fileErrorExist: function () {
      return (this.form.errors.has('file'));
    },
  },
  methods: {
    getEntityList() {
      let requestUrl = this.urlDocumentTemplate + '/list'
          + '?countryId=' + this.selectedCountryId;

      axios.get(requestUrl).then(response => {
        this.entityList = response.data;
      });
    },
    initUpload(index) {
      let formData = this.entityList[index];
      formData.country_id = this.selectedCountryId;
      formData.file = "";
      $('#file').val('');
      this.form = new Form(formData);
      $('#' + this.documentTemplateModalName).modal('show');
    },
    set() {
      let requestUrl = this.urlDocumentTemplate + "/store";
      let requestSuccessMessage = (this.form.id !== 0) ? this.msgSuccessUpdate : this.msgSuccessStore;

      this.form.postMultipart(requestUrl)
          .then(request => {
            this.getEntityList();
            $('#' + this.documentTemplateModalName).modal('hide');

            this.$notify({
              group: 'all',
              position: 'top right',
              text: requestSuccessMessage,
              type: 'success'
            });
          });
    },
    downloadFile(entityId, index) {
      let requestUrl = this.urlDocumentTemplate + "/download"
          + '?entityId=' + entityId
          + '&noCache=' + new Date().toString();
      window.open(requestUrl);
    },
    onCountryChange() {
      this.getEntityList();
    },
    onFileSelect() {
      if (this.form.errors.has('file')) {
        this.form.errors.clear('file');
        this.form.resetErrors();
      }
      this.form.file = this.$refs.file.files[0];
    }
  },
}
</script>

<style scoped>

</style>
