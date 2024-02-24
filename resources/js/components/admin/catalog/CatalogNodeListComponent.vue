<template>
  <div class="col-12" :key="key">
    <div v-if="nodeList != null">
      <catalog-node-component v-for="(catalogNode, index) in nodeList" :key="index"
                              :initial-catalog-node="catalogNode"
                              :initial-can-move-up="canMoveUpCatalogNode(index)"
                              :initial-can-move-down="canMoveDownCatalogNode(index)"
      ></catalog-node-component>
    </div>
    <button type="button" class="btn btn-sm btn-primary mt-1" @click="addNode">
      <i class="fa fa-plus"></i>
      {{ trans.get('messages.all.add') }}
    </button>

    <div class="modal fade" tabindex="-1" role="dialog" :id="modalDialogName">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">{{ trans.get('messages.admin.catalog.addNode') }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab"
                   aria-controls="general" aria-selected="true">Основная</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="seo-tab" data-toggle="tab" href="#seo" role="tab" aria-controls="seo"
                   aria-selected="false">Seo</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active pt-3" id="general" role="tabpanel" aria-labelledby="general-tab">
                <div class="col-12">
                  <label for="name">{{ trans.get('messages.admin.catalog.name') }}</label>

                  <input :class="['form-control', form.errors.has('name') ? 'is-invalid' : '']"
                         v-model="form.name" id="name" name="name"/>
                  <span v-if="form.errors.has('name')" :class="['help-block invalid-feedback']">
                                    <strong v-text="form.errors.get('name')"></strong>
                                </span>
                </div>
                <div class="col-12">
                  <label for="name_en">{{ trans.get('messages.admin.catalog.name_en') }}</label>

                  <input :class="['form-control', form.errors.has('name_en') ? 'is-invalid' : '']"
                         v-model="form.name_en" id="name_en" name="name_en"/>
                  <span v-if="form.errors.has('name_en')" :class="['help-block invalid-feedback']">
                                    <strong v-text="form.errors.get('name_en')"></strong>
                                </span>
                </div>

                <div class="col-12">
                  <label for="type">{{ trans.get('messages.admin.catalog.type') }}</label>

                  <select :class="['form-control', form.errors.has('name_en') ? 'is-invalid' : '']"
                          v-model="form.type" id="type" name="type">
                    <option v-for="(nodeType, index) in nodeTypeList" :value="nodeType.id"
                            :selected="nodeTypeList.length === 1">
                      {{ nodeType.value }}
                    </option>
                  </select>
                  <span v-if="form.errors.has('type')" :class="['help-block invalid-feedback']">
                                    <strong v-text="form.errors.get('type')"></strong>
                                </span>
                </div>
                <div class="col-12">
                  <label
                      :for="'description_' + modalDialogName">{{ trans.get('messages.admin.catalog.description') }}</label>

                  <textarea
                      :class="['form-control ckedit', form.errors.has('description') ? 'is-invalid' : '']"
                      v-model="form.description" :id="'description_' + modalDialogName" name="description"></textarea>
                  <span v-if="form.errors.has('description')" :class="['help-block invalid-feedback']">
                                    <strong v-text="form.errors.get('description')"></strong>
                                </span>
                </div>
                <div class="col-12">
                  <label
                      :for="'description_en_' + modalDialogName">{{ trans.get('messages.admin.catalog.description_en') }}</label>

                  <textarea
                      :class="['form-control ckedit', form.errors.has('description_en') ? 'is-invalid' : '']"
                      v-model="form.description_en" :id="'description_en_' + modalDialogName"
                      name="description_en"></textarea>
                  <span v-if="form.errors.has('description_en')" :class="['help-block invalid-feedback']">
                                    <strong v-text="form.errors.get('description_en')"></strong>
                                </span>
                </div>
                <div class="col-12" v-if="isPhotoExist()">
                  <label for="file">{{ trans.get('messages.admin.catalog.image') }}</label>

                  <input :class="['form-control']" accept="image/*"
                         type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
                  <span v-if="form.errors.has('image')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('image')"></strong>
                            </span>
                </div>
              </div>
              <div class="tab-pane fade pt-3" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                <div class="col-12">
                  <label for="pretty_url">{{ trans.get('messages.admin.catalog.pretty_url') }}</label>

                  <input :class="['form-control', form.errors.has('pretty_url') ? 'is-invalid' : '']"
                         v-model="form.pretty_url" id="pretty_url" name="pretty_url"/>
                  <span v-if="form.errors.has('pretty_url')" :class="['help-block invalid-feedback']">
                                    <strong v-text="form.errors.get('pretty_url')"></strong>
                                </span>
                </div>

                <div class="col-12">
                  <label for="seo_title">{{ trans.get('messages.admin.catalog.seo_title') }}</label>

                  <input :class="['form-control', form.errors.has('seo_title') ? 'is-invalid' : '']"
                         v-model="form.seo_title" id="seo_title" name="seo_title"/>
                  <span v-if="form.errors.has('seo_title')" :class="['help-block invalid-feedback']">
                                    <strong v-text="form.errors.get('seo_title')"></strong>
                                </span>
                </div>
                <div class="col-12">
                  <label for="seo_title_en">{{ trans.get('messages.admin.catalog.seo_title_en') }}</label>

                  <input :class="['form-control', form.errors.has('seo_title_en') ? 'is-invalid' : '']"
                         v-model="form.seo_title_en" id="seo_title_en" name="seo_title_en"/>
                  <span v-if="form.errors.has('seo_title_en')" :class="['help-block invalid-feedback']">
                                    <strong v-text="form.errors.get('seo_title_en')"></strong>
                                </span>
                </div>

                <div class="col-12">
                  <label for="seo_description">{{ trans.get('messages.admin.catalog.seo_description') }}</label>

                  <input :class="['form-control', form.errors.has('seo_description') ? 'is-invalid' : '']"
                         v-model="form.seo_description" id="seo_description" name="seo_description"/>
                  <span v-if="form.errors.has('seo_description')" :class="['help-block invalid-feedback']">
                                    <strong v-text="form.errors.get('seo_description')"></strong>
                                </span>
                </div>
                <div class="col-12">
                  <label for="seo_description_en">{{ trans.get('messages.admin.catalog.seo_description_en') }}</label>

                  <input :class="['form-control', form.errors.has('seo_description_en') ? 'is-invalid' : '']"
                         v-model="form.seo_description_en" id="seo_description_en" name="seo_description_en"/>
                  <span v-if="form.errors.has('seo_description_en')" :class="['help-block invalid-feedback']">
                                    <strong v-text="form.errors.get('seo_description_en')"></strong>
                                </span>
                </div>

                <div class="col-12">
                  <label for="seo_keys">{{ trans.get('messages.admin.catalog.seo_keys') }}</label>

                  <input :class="['form-control', form.errors.has('seo_keys') ? 'is-invalid' : '']"
                         v-model="form.seo_keys" id="seo_keys" name="seo_keys"/>
                  <span v-if="form.errors.has('seo_keys')" :class="['help-block invalid-feedback']">
                                    <strong v-text="form.errors.get('seo_keys')"></strong>
                                </span>
                </div>
                <div class="col-12">
                  <label for="seo_keys_en">{{ trans.get('messages.admin.catalog.seo_keys_en') }}</label>

                  <input :class="['form-control', form.errors.has('seo_keys_en') ? 'is-invalid' : '']"
                         v-model="form.seo_keys_en" id="seo_keys_en" name="seo_keys_en"/>
                  <span v-if="form.errors.has('seo_keys_en')" :class="['help-block invalid-feedback']">
                                    <strong v-text="form.errors.get('seo_keys_en')"></strong>
                                </span>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">
              {{ trans.get('messages.all.cancel') }}
            </button>
            <button type="button" :disabled="isDataSending" @click="createNode()" class="btn btn-primary">
              {{ trans.get('messages.all.submit') }}!!!
            </button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  </div>
</template>

<script>
export default {
  name: "CatalogNodeListComponent",
  data() {
    return {
      url: '/admin/vue/catalog',
      nodeTypeList: [],
      nodeList: this.initialNodeList,
      // selectedNodeTypePhotoExist: null,
      entity: {
        parentId: this.initialParentNodeId,
        name: '',
        name_en: '',
        type: null,
        description: '',
        description_en: '',
        image: null,
        pretty_url: '',
        seo_title: '',
        seo_title_en: '',
        seo_description: '',
        seo_description_en: '',
        seo_keys: '',
        seo_keys_en: '',
      },
      form: new Form(this.entity),
      key: 0,
      photo: null,
      isDataSending: false
    }
  },
  props: {
    'initialNodeList': Array,
    'initialParentNodeId': Number,
  },
  created() {
    this.getNodeType();
  },
  computed: {
    modalDialogName() {
      return 'add_node_' + this.initialParentNodeId;
    }
  },
  methods: {
    addNode() {
      //this.getNodeType();

      this.selectedNodeType = null;
      $('textarea.ckedit').each(function () {
        var editor = CKEDITOR.instances[this.id];
        if (typeof (editor) === "object") {
          CKEDITOR.instances[this.id].destroy(true);
        }
        CKEDITOR.replace(this.id, {
          filebrowserBrowseUrl: '/ckfinder/browser',
          filebrowserUploadUrl: '/ckfinder/connector?command=QuickUpload&type=Files'
        });
      });

      this.form = new Form(this.entity);
      $('#' + this.modalDialogName).modal('show');
    },
    reloadNodeList() {
      axios.get(this.url + "/getByParentId/" + this.initialParentNodeId).then(response => {
        this.nodeList = response.data;
      });
    },
    getNodeType() {
      let serviceCategory = $('#service_category_id').val();
      // axios.get(this.url + "/" + serviceCategory + "/getNodeTypeList/" + this.initialParentNodeId).then(response => {
      axios.get(this.url + "/" + serviceCategory + "/getNodeTypeList/null").then(response => {
        this.nodeTypeList = response.data;

        if (this.nodeTypeList.length === 1) {
          this.form.type = this.nodeTypeList[0].id;
        }
      });
    },
    createNode() {
      let self = this;
      let _url = this.url + "/store";
      let _message = this.trans.get('messages.admin.system.success.store');

      self.isDataSending = true;

      self.form.description = CKEDITOR.instances['description_' + this.modalDialogName].getData();
      self.form.description_en = CKEDITOR.instances['description_en_' + this.modalDialogName].getData();

      let formData = new FormData();
      formData.append('photo', this.photo);
      formData.append('type', self.form.type);
      formData.append('parentId', this.initialParentNodeId);
      formData.append('name', self.form.name);
      formData.append('name_en', self.form.name_en);
      formData.append('description', self.form.description);
      formData.append('description_en', self.form.description_en);

      formData.append('pretty_url', self.form.pretty_url);
      formData.append('seo_title', self.form.seo_title);
      formData.append('seo_title_en', self.form.seo_title_en);
      formData.append('seo_description', self.form.seo_description);
      formData.append('seo_description_en', self.form.seo_description_en);
      formData.append('seo_keys', self.form.seo_keys);
      formData.append('seo_keys_en', self.form.seo_keys_en);

      axios.post(_url,
          formData,
          {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          }
      )
          .then(response => {
            self.reloadNodeList();
            $('#' + this.modalDialogName).modal('hide');
            self.isDataSending = false;
            self.$notify({
              group: 'all',
              position: 'top right',
              text: _message,
              type: 'success'
            });
          });
    },
    canMoveUpCatalogNode(index) {
      return this.initialNodeList.length > 1 && index !== 0;
    },
    canMoveDownCatalogNode(index) {
      return this.initialNodeList.length > 1 && index !== this.initialNodeList.length - 1;
    },
    isPhotoExist() {
      let self = this;
      let selectedNodeType = null;
      this.nodeTypeList.forEach(function (el) {
        if (el.id == self.form.type) {
          selectedNodeType = el;
        }
      });
      return selectedNodeType != null && selectedNodeType.isPhotoExist === '1';
    },
    handleFileUpload() {
      this.photo = this.$refs.file.files[0];
    },
  }
}
</script>

<style scoped>

</style>
