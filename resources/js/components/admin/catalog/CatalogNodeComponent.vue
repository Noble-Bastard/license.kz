<template>
    <div class="row">
        <div class="col-12">
            <i class="fal fa-plus-square" @click="expandNode" v-if="catalogNodeList === null"
               :title="trans.get('messages.admin.catalog.expand')"></i>
            <i class="fal fa-minus-square" @click="collapseNode" v-if="catalogNodeList !== null"
               :title="trans.get('messages.admin.catalog.collapse')"></i>
            <span>{{nodeTitle}}</span>
            <i class="fal fa-pencil-alt ml-2" @click="edit" :title="trans.get('messages.admin.catalog.edit')"></i>

            <i class="fal fa-file-plus ml-2" v-if="isNotAssignedService" @click="initAssignService"
               :title="trans.get('messages.admin.catalog.assignService')"></i>
            <i class="fas fa-file-minus ml-2" v-else @click="unassignService"
               :title="trans.get('messages.admin.catalog.unassignService')"></i>

            <i class="far fa-undo ml-2" @click="initChangeChildsType"
               :title="trans.get('messages.admin.catalog.changeChildsType')"></i>
            <i class="fal fa-arrow-up ml-3" v-if="initialCanMoveUp" @click="moveUp"
               :title="trans.get('messages.admin.catalog.moveUp')"></i>
            <i class="fal fa-arrow-down" v-if="initialCanMoveDown" @click="moveDown"
               :title="trans.get('messages.admin.catalog.moveDown')"></i>
            <i class="fal fa-eye-slash" v-if="isShow" @click="toggleVisibility"
               :title="trans.get('messages.admin.catalog.hide')"></i>
            <i class="fal fa-eye" v-if="isHide" @click="toggleVisibility"
               :title="trans.get('messages.admin.catalog.show')"></i>

            <i class="fas fa-file" v-if="isBlankPage" @click="toggleBlankPage"
               :title="trans.get('messages.admin.catalog.isBlankPage')"></i>
            <i class="fal fa-file" v-if="isNotBlankPage" @click="toggleBlankPage"
               :title="trans.get('messages.admin.catalog.isNotBlankPage')"></i>

            <i class="fal fa-trash-alt ml-5 text-danger" @click="remove"
               :title="trans.get('messages.admin.catalog.remove')"></i>
        </div>
        <div class="col-12 p-3" v-if="this.node.service_catalog_list.length > 0">
            <table class="table table-sm table-bordered table-hover ">
                <thead>
                <tr>
                    <th class="w-10">{{trans.get('messages.admin.catalog.service.code')}}</th>
                    <th>{{trans.get('messages.admin.catalog.service.name')}}</th>
                    <th class="w-15"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(serviceItem, index) in this.node.service_catalog_list">
                    <td>{{serviceItem.service.code}}</td>
                    <td>{{serviceItem.service.name}}</td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-danger" @click="removeService(serviceItem.id)" :title="trans.get('messages.admin.catalog.service.remove')">
                            <i class="fal fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="col-12 p-3" v-if="catalogNodeList !== null">
            <catalog-node-list-component
                    :initial-node-list="catalogNodeList"
                    :initial-parent-node-id="node.id"
                    :key="catalogNodeListKey"
            ></catalog-node-list-component>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" :id="modalDialogName">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{trans.get('messages.admin.catalog.addNode')}}</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                  <div class="modal-body">
                    <ul class="nav nav-tabs" :id="'myTab_'+node.id" role="tablist">
                      <li class="nav-item" role="presentation">
                        <a class="nav-link active" :id="'general-tab_'+node.id" data-toggle="tab" :href="'#general_'+node.id" role="tab"
                           aria-controls="general" aria-selected="true">Основная</a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a class="nav-link" :id="'seo-tab_'+node.id" data-toggle="tab" :href="'#seo_'+node.id" role="tab" aria-controls="seo"
                           aria-selected="false">Seo</a>
                      </li>
                    </ul>
                    <div class="tab-content" :id="'myTabContent_'+node.id">
                      <div class="tab-pane fade show active pt-3" :id="'general_'+node.id" role="tabpanel"
                           aria-labelledby="general-tab">
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
                              :for="'description_' + modalDialogName">{{
                              trans.get('messages.admin.catalog.description')
                            }}</label>

                          <textarea
                              :class="['form-control ckedit', form.errors.has('description') ? 'is-invalid' : '']"
                              v-model="form.description" :id="'description_' + modalDialogName"
                              name="description"></textarea>
                          <span v-if="form.errors.has('description')" :class="['help-block invalid-feedback']">
                                        <strong v-text="form.errors.get('description')"></strong>
                                    </span>
                        </div>

                        <div class="col-12">
                          <label
                              :for="'description_en_' + modalDialogName">{{
                              trans.get('messages.admin.catalog.description_en')
                            }}</label>

                          <textarea
                              :class="['form-control ckedit', form.errors.has('description_en') ? 'is-invalid' : '']"
                              v-model="form.description_en" :id="'description_en_' + modalDialogName"
                              name="description_en"></textarea>
                          <span v-if="form.errors.has('description_en')" :class="['help-block invalid-feedback']">
                                        <strong v-text="form.errors.get('description_en')"></strong>
                                    </span>
                        </div>
                        <div class="col-12" v-if="node.node_type.isPhotoExist === '1'">
                          <label for="file">{{ trans.get('messages.admin.catalog.image') }}</label>

                          <input :class="['form-control']" accept="image/*"
                                 type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
                          <span v-if="form.errors.has('image')" :class="['help-block invalid-feedback']">
                                    <strong v-text="form.errors.get('image')"></strong>
                                </span>
                        </div>
                      </div>
                      <div class="tab-pane fade pt-3" :id="'seo_'+node.id" role="tabpanel" aria-labelledby="seo-tab">
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
                          <label for="seo_description">{{
                              trans.get('messages.admin.catalog.seo_description')
                            }}</label>

                          <input :class="['form-control', form.errors.has('seo_description') ? 'is-invalid' : '']"
                                 v-model="form.seo_description" id="seo_description" name="seo_description"/>
                          <span v-if="form.errors.has('seo_description')" :class="['help-block invalid-feedback']">
                                    <strong v-text="form.errors.get('seo_description')"></strong>
                                </span>
                        </div>
                        <div class="col-12">
                          <label for="seo_description_en">{{
                              trans.get('messages.admin.catalog.seo_description_en')
                            }}</label>

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
                            {{trans.get('messages.all.cancel')}}
                        </button>
                        <button type="button" @click="update()" class="btn btn-primary">
                            {{trans.get('messages.all.submit')}}
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal fade" tabindex="-1" role="dialog" :id="appendServiceDialogName">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{trans.get('messages.admin.catalog.addNode')}}</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <label>{{trans.get('messages.admin.catalog.serviceList')}}</label>

                            <vue-select name="serviceStepName"  :options="serviceList"  label="name" v-model="selectedService">
                              <template #option="{ name, code }">
                                <b>{{code}}</b> <span>{{name}}</span>
                              </template>
                            </vue-select>

                            <span v-if="form.errors.has('name')" :class="['help-block invalid-feedback']">
                                    <strong v-text="form.errors.get('name')"></strong>
                                </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">
                            {{trans.get('messages.all.cancel')}}
                        </button>
                        <button type="button" @click="assignService()" class="btn btn-primary">
                            {{trans.get('messages.all.submit')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" :id="changeChildTypeDialogName">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{trans.get('messages.admin.catalog.addNode')}}</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <label for="nodeType">{{trans.get('messages.admin.catalog.type')}}</label>

                            <select name="nodeType" id="nodeType" v-model="selectedType">
                                <option v-for="type in typeList" :value="type.id">
                                    {{type.value}}
                                </option>
                            </select>
                            <span v-if="form.errors.has('nodeType')" :class="['help-block invalid-feedback']">
                                <strong v-text="form.errors.get('nodeType')"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">
                            {{trans.get('messages.all.cancel')}}
                        </button>
                        <button type="button" @click="changeChildsType()" class="btn btn-primary">
                            {{trans.get('messages.all.submit')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "CatalogNodeComponent",
        data() {
            return {
                nodeTypeList: [],
                url: '/admin/vue/catalog',
                node: this.initialCatalogNode,
                catalogNodeList: null,
                form: new Form(this.node),
                photo: null,
                selectedService: null,
                serviceList: [],
                typeList: null,
                selectedType: null,
                catalogNodeListKey:0
            }
        },
        mounted(){
        },
        created() {
          this.getNodeType();
        },
        props: {
            'initialCatalogNode': Object,
            'initialCanMoveUp': Boolean,
            'initialCanMoveDown': Boolean,
        },
        computed: {
            modalDialogName() {
                return 'update_node_' + this.node.id;
            },
            appendServiceDialogName(){
                return 'append_service_' + this.node.id;
            },
            changeChildTypeDialogName(){
                return 'change_type_' + this.node.id;
            },
            nodeTitle(){
                let result = this.node.name + ' (' + this.node.node_type.value + ')';

                if(this.node.service_catalog !== undefined && this.node.service_catalog != null){
                    result += ' - ' + this.node.service_catalog.service.code;
                }

                return result;
            },
            isShow(){
                return this.node.is_visible === 1;
            },
            isHide(){
                return this.node.is_visible === 0;
            },
            isBlankPage(){
                return this.node.is_blank_page === 1;
            },
            isNotBlankPage(){
                return this.node.is_blank_page === 0;
            },
            isNotAssignedService(){
                return this.node.service_catalog === undefined || this.node.service_catalog === null;
            }
        },
        methods: {
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
            edit() {
                $('textarea.ckedit').each(function () {
                    var editor = CKEDITOR.instances[this.id];
                    if (typeof(editor) === "object") {
                        CKEDITOR.instances[this.id].destroy(true);
                    }
                    CKEDITOR.replace(this.id, {
                        filebrowserBrowseUrl: '/ckfinder/browser',
                        filebrowserUploadUrl: '/ckfinder/connector?command=QuickUpload&type=Files'
                    });
                });

                this.node.type = this.node.catalog_node_type_id;
                this.node.parentId = this.node.catalog_parent_id;
                this.form = new Form(this.node);
                $('#' + this.modalDialogName).modal('show');
            },
            update() {
                let self = this;
                let _url = this.url + "/update";
                let _message = this.trans.get('messages.admin.system.success.update');

                self.form.description = CKEDITOR.instances['description_' + this.modalDialogName].getData();
                self.form.description_en = CKEDITOR.instances['description_en_' + this.modalDialogName].getData();

                let formData = new FormData();
                formData.append('id', this.node.id);
                formData.append('photo', this.photo);
                formData.append('type', this.node.type);
                formData.append('parentId', this.node.parentId);
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
                        self.node = response.data;
                        $('#' + self.modalDialogName).modal('hide');
                        self.$notify({
                            group: 'all',
                            position: 'top right',
                            text: _message,
                            type: 'success'
                        });
                    });
            },
            remove() {
                if(confirm(this.trans.get('messages.admin.catalog.confirm_delete_node') + " (" + this.node.name + ")")) {
                    axios.post(this.url + "/delete", {
                        entityId: this.node.id
                    })
                        .then(request => {
                            this.$parent.reloadNodeList();

                            this.$notify({
                                group: 'all',
                                position: 'top right',
                                text: this.trans.get('messages.admin.system.success.delete'),
                                type: 'success'
                            });
                        });
                }
            },
            initChangeChildsType() {
                let serviceCategoryId = $('#service_category_id').val();
                axios.get(this.url + "/" + serviceCategoryId + "/getNodeTypeList/null").then(response => {
                    this.typeList = response.data;
                    this.selectedType = null;
                    $('#' + this.changeChildTypeDialogName).modal('show');
                });
            },
            changeChildsType() {
                axios.post(this.url + "/changeNodeType",{
                    parentNodeId: this.node.id,
                    typeId: this.selectedType
                }).then(response => {
                    this.selectedType = null;
                    $('#' + this.changeChildTypeDialogName).modal('hide');

                    this.catalogNodeList = response.data;
                    this.catalogNodeListKey += 1;

                    this.$notify({
                        group: 'all',
                        position: 'top right',
                        text: this.trans.get('messages.admin.system.success.update'),
                        type: 'success'
                    });
                });
            },
            moveUp() {
                axios.get(this.url + "/moveUp/" + this.node.id).then(response => {
                    this.$parent.nodeList = response.data;
                    this.$parent.key += 1;
                });
            },
            moveDown() {
                axios.get(this.url + "/moveDown/" + this.node.id).then(response => {
                    this.$parent.nodeList = response.data;
                    this.$parent.key += 1;
                });
            },
            initAssignService() {
                axios.post(this.url + "/getServiceList", {
                    countryId: $('#country_id').val(),
                    serviceCategoryId: $('#service_category_id').val(),
                }).then(response => {
                    this.serviceList = response.data.sort(function(a, b){
                      if (a.code > b.code) {
                        return 1;
                      }
                      if (a.code < b.code) {
                        return -1;
                      }
                      return 0;
                    });
                    this.selectedService = null;
                    $('#' + this.appendServiceDialogName).modal('show');
                });

            },
            assignService() {
                axios.post(this.url + "/assignService",{
                    nodeId: this.node.id,
                    serviceId: this.selectedService.id
                }).then(response => {
                    this.node = response.data;

                    this.selectedService = null;
                    $('#' + this.appendServiceDialogName).modal('hide');

                    this.$notify({
                        group: 'all',
                        position: 'top right',
                        text: this.trans.get('messages.admin.system.success.update'),
                        type: 'success'
                    });
                });
            },
            expandNode() {
                axios.get(this.url + "/getByParentId/" + this.node.id).then(response => {
                    this.catalogNodeList = response.data;
                    this.catalogNodeListKey += 1;
                });
            },
            collapseNode() {
                this.catalogNodeList = null;
            },
            handleFileUpload() {
                this.photo = this.$refs.file.files[0];
            },
            toggleVisibility(){
                axios.get(this.url + "/toggleVisibility/" + this.node.id).then(response => {
                    this.node = response.data
                });
            },
            toggleBlankPage() {
                axios.get(this.url + "/toggleBlankPage/" + this.node.id).then(response => {
                    this.node = response.data
                });
            },
            removeService(serviceId){
                axios.post(this.url + "/unassignService",{
                    nodeId: this.node.id,
                    serviceCatalogId: serviceId
                }).then(response => {
                    this.node = response.data;

                    this.$notify({
                        group: 'all',
                        position: 'top right',
                        text: this.trans.get('messages.admin.system.success.update'),
                        type: 'success'
                    });
                });
            }
        }
    }
</script>

<style scoped>

</style>
