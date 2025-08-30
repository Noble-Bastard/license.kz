<template>
  <div class="document-templates-page">
    <!-- Заголовок страницы -->
    <div class="page-header">
      <h1 class="page-title">{{ trans.get('messages.layouts.document_template') }}</h1>
      
      <!-- Правая часть заголовка с поиском и кнопкой -->
      <div class="header-actions">
        <div class="search-container">
          <div class="search-icon">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
              <path d="M17.5 17.5L12.5 12.5M14.1667 8.33333C14.1667 11.555 11.555 14.1667 8.33333 14.1667C5.11167 14.1667 2.5 11.555 2.5 8.33333C2.5 5.11167 5.11167 2.5 8.33333 2.5C11.555 2.5 14.1667 5.11167 14.1667 8.33333Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <input 
            type="text" 
            class="search-input" 
            :placeholder="trans.get('messages.company.documentTemplate.search_placeholder')"
            v-model="searchQuery"
            @input="onSearchInput"
          />
        </div>
        
        <button class="btn-new-document" @click="showNewDocumentModal">
          <div class="plus-icon">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
              <path d="M10 4.16667V15.8333M4.16667 10H15.8333" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <span>{{ trans.get('messages.company.documentTemplate.new_document') }}</span>
        </button>
      </div>
    </div>

    <!-- Фильтры по странам -->
    <div class="country-filters">
      <div 
        v-for="country in countryList" 
        :key="country.id"
        class="country-filter"
        :class="{ 'active': selectedCountryId === country.id }"
        @click="selectCountry(country.id)"
      >
        <img 
          :src="getCountryFlag(country.name)" 
          :alt="country.name"
          class="country-flag"
        />
        <span class="country-name">{{ country.name }}</span>
      </div>
    </div>

    <!-- Сетка карточек документов -->
    <div class="documents-grid">
      <div 
        v-for="(entity, index) in filteredEntityList" 
        :key="entity.id"
        class="document-card"
      >
        <div class="card-header">
          <div class="file-type-badge">
            <span class="file-extension">{{ getFileExtension(entity.name) }}</span>
          </div>
        </div>
        
        <div class="card-content">
          <h3 class="document-name">{{ entity.name }}</h3>
          <p class="document-description">{{ entity.document_template_type_name }}</p>
        </div>
        
        <div class="card-actions">
          <button class="btn-upload" @click="initUpload(index)">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
              <path d="M8 1V11M3 6L8 1L13 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            {{ trans.get('messages.all.uploadFile') }}
          </button>
          
          <button class="btn-download" @click="downloadFile(entity.id, index)">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
              <path d="M8 1V11M3 6L8 1L13 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            {{ trans.get('messages.all.downloadFile') }}
          </button>
        </div>
      </div>
    </div>

    <!-- Модальное окно для загрузки файла -->
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
        </div>
      </div>
    </div>
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
      selectedCountryId: this.initialCountryList[0].id,
      searchQuery: ''
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
    filteredEntityList() {
      if (!this.entityList) return [];
      
      return this.entityList.filter(entity => {
        const matchesSearch = !this.searchQuery || 
          entity.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
          entity.document_template_type_name.toLowerCase().includes(this.searchQuery.toLowerCase());
        
        return matchesSearch;
      });
    }
  },
  methods: {
    getEntityList() {
      let requestUrl = this.urlDocumentTemplate + '/list'
          + '?countryId=' + this.selectedCountryId;

      axios.get(requestUrl).then(response => {
        this.entityList = response.data;
      });
    },
    selectCountry(countryId) {
      this.selectedCountryId = countryId;
      this.getEntityList();
    },
    getCountryFlag(countryName) {
      const flagMap = {
        'Казахстан': '/images/flags/kazakhstan-flag.png',
        'Киргизия': '/images/flags/kyrgyzstan-flag-365d7f.png',
        'ОАЭ': '/images/flags/uae-flag.png',
        'Россия': '/images/flags/russia-flag.png',
        'Тайланд': '/images/flags/thailand-flag-56586a.png'
      };
      
      return flagMap[countryName] || '/images/flags/kazakhstan-flag.png';
    },
    getFileExtension(fileName) {
      if (!fileName) return '';
      const lastDotIndex = fileName.lastIndexOf('.');
      return lastDotIndex !== -1 ? fileName.substring(lastDotIndex + 1) : '';
    },
    onSearchInput() {
      // Поиск происходит автоматически через computed свойство
    },
    showNewDocumentModal() {
      // Показываем модальное окно для создания нового документа
      this.form = new Form(this.defaultEntity);
      $('#' + this.documentTemplateModalName).modal('show');
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
.document-templates-page {
  padding: 0;
  background: var(--color-bg-primary);
}

/* Заголовок страницы */
.page-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: var(--spacing-6);
  padding: var(--spacing-8) var(--spacing-12);
  background: var(--color-bg-primary);
  box-shadow: var(--shadow-sm);
}

.page-title {
  font-family: var(--font-family-sans);
  font-weight: var(--font-weight-normal);
  font-size: var(--font-size-4xl);
  line-height: var(--line-height-tight);
  letter-spacing: -2%;
  color: var(--color-text-primary);
  margin: 0;
}

.header-actions {
  display: flex;
  gap: var(--spacing-5);
  align-items: center;
}

/* Поиск */
.search-container {
  position: relative;
  display: flex;
  align-items: center;
  background: var(--color-bg-primary);
  border: 1px solid var(--color-border-light);
  border-radius: var(--radius-3xl);
  padding: var(--spacing-3) var(--spacing-5) var(--spacing-3) var(--spacing-4);
  height: 46px;
}

.search-icon {
  color: var(--color-text-primary);
  margin-right: var(--spacing-3);
}

.search-input {
  border: none;
  outline: none;
  background: transparent;
  font-family: var(--font-family-sans);
  font-weight: var(--font-weight-medium);
  font-size: var(--font-size-xs);
  line-height: var(--line-height-tight);
  color: var(--color-text-primary);
  width: 200px;
}

.search-input::placeholder {
  color: var(--color-text-muted);
}

/* Кнопка нового документа */
.btn-new-document {
  display: flex;
  align-items: center;
  gap: var(--spacing-1);
  background: var(--color-primary);
  border: none;
  border-radius: var(--radius-3xl);
  padding: var(--spacing-6) var(--spacing-5);
  height: 46px;
  color: var(--color-text-white);
  font-family: var(--font-family-sans);
  font-weight: var(--font-weight-semibold);
  font-size: var(--font-size-base);
  line-height: var(--line-height-tight);
  cursor: pointer;
  transition: background-color 0.2s;
}

.btn-new-document:hover {
  background: var(--color-primary-dark);
}

.plus-icon {
  display: flex;
  align-items: center;
  justify-content: center;
}

/* Фильтры по странам */
.country-filters {
  display: flex;
  gap: var(--spacing-5);
  margin-bottom: var(--spacing-7);
  padding: 0 var(--spacing-12);
}

.country-filter {
  display: flex;
  align-items: center;
  gap: var(--spacing-3);
  padding: 0 var(--spacing-4) 0 var(--spacing-4);
  height: 42px;
  border-radius: var(--radius-3xl);
  cursor: pointer;
  transition: all 0.2s;
}

.country-filter.active {
  background: var(--color-bg-tertiary);
  border: 1px solid var(--color-primary);
}

.country-filter:not(.active) {
  background: transparent;
}

.country-flag {
  width: var(--spacing-5);
  height: var(--spacing-5);
  border-radius: 50%;
  object-fit: cover;
}

.country-name {
  font-family: var(--font-family-sans);
  font-weight: var(--font-weight-medium);
  font-size: var(--font-size-xs);
  line-height: var(--line-height-tight);
  color: var(--color-text-primary);
}

.country-filter:not(.active) .country-name {
  color: var(--color-text-muted);
}

/* Сетка документов */
.documents-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  gap: var(--spacing-8);
  padding: var(--spacing-12);
}

.document-card {
  background: var(--color-bg-secondary);
  border: 1px solid var(--color-border-medium);
  border-radius: var(--spacing-5);
  padding: var(--spacing-5);
  display: flex;
  flex-direction: column;
  gap: var(--spacing-5);
  transition: transform 0.2s, box-shadow 0.2s;
  cursor: pointer;
}

.document-card:hover {
  transform: translateY(-2px);
  box-shadow: var(--shadow-md);
}

.card-header {
  display: flex;
  justify-content: center;
  align-items: center;
}

.file-type-badge {
  background: var(--color-primary);
  border-radius: var(--radius-lg);
  padding: var(--spacing-2) var(--spacing-4);
  display: flex;
  align-items: center;
  justify-content: center;
}

.file-extension {
  color: var(--color-text-white);
  font-family: var(--font-family-sans);
  font-weight: var(--font-weight-semibold);
  font-size: var(--font-size-xl);
  line-height: var(--line-height-tight);
}

.card-content {
  text-align: center;
}

.document-name {
  font-family: var(--font-family-sans);
  font-weight: var(--font-weight-medium);
  font-size: var(--font-size-sm);
  line-height: var(--line-height-tight);
  color: var(--color-text-primary);
  margin: 0 0 var(--spacing-3) 0;
  word-break: break-word;
}

.document-description {
  font-family: var(--font-family-sans);
  font-weight: var(--font-weight-normal);
  font-size: var(--font-size-xs);
  line-height: var(--line-height-tight);
  letter-spacing: 1%;
  color: var(--color-text-muted);
  margin: 0;
}

.card-actions {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.btn-upload,
.btn-download {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  padding: var(--spacing-2) 12px;
  border: 1px solid var(--color-border-light);
  border-radius: var(--spacing-2);
  background: var(--color-bg-primary);
  color: var(--color-text-muted);
  font-family: var(--font-family-sans);
  font-weight: var(--font-weight-medium);
  font-size: var(--font-size-xs);
  cursor: pointer;
  transition: all 0.2s;
}

.btn-upload:hover,
.btn-download:hover {
  background: var(--color-bg-secondary);
  border-color: var(--color-primary);
  color: var(--color-primary);
}

.btn-upload svg,
.btn-download svg {
  width: 14px;
  height: 14px;
}

/* Адаптивность */
@media (max-width: 768px) {
  .page-header {
    flex-direction: column;
    gap: 20px;
    align-items: flex-start;
    padding: 20px;
  }
  
  .header-actions {
    width: 100%;
    flex-direction: column;
    gap: 15px;
  }
  
  .search-container {
    width: 100%;
  }
  
  .search-input {
    width: 100%;
  }
  
  .btn-new-document {
    width: 100%;
    justify-content: center;
  }
  
  .country-filters {
    padding: 0 20px;
    overflow-x: auto;
    gap: 15px;
  }
  
  .documents-grid {
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    gap: 20px;
    padding: 20px;
  }
  
  .page-title {
    font-size: var(--font-size-3xl);
  }
}

@media (max-width: 480px) {
  .documents-grid {
    grid-template-columns: 1fr;
    gap: 15px;
    padding: 15px;
  }
  
  .document-card {
    padding: 15px;
  }
}
</style>
