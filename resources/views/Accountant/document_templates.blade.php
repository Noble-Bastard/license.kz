@extends('layouts.accountant-app')

@section('title', 'Шаблоны документов')

@push('head')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
@endpush

@section('content')

<div class="max-w-[1440px] mx-auto px-6 py-8 bg-white min-h-screen font-inter" x-data="{ 
    searchQuery: '',
    filterDocuments() {
        const searchQuery = this.searchQuery.toLowerCase();
        const documentCards = document.querySelectorAll('.document-card');
        
        documentCards.forEach(card => {
            const title = card.querySelector('h3')?.textContent.toLowerCase() || '';
            const type = card.querySelector('p')?.textContent.toLowerCase() || '';
            
            const matchesSearch = title.includes(searchQuery) || type.includes(searchQuery);
            
            if (matchesSearch) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }
}">
  <!-- Page Title -->
  <div class="flex items-center justify-between mb-6 w-full">
    <h1 class="text-[22px] leading-[28px] font-semibold text-gray-900">
      <span class="hidden md:inline">Шаблоны документов</span>
      <span class="md:hidden block">Шаблоны<br/>документов</span>
    </h1>

    <div class="flex items-center gap-2 md:gap-3 justify-end">
      <!-- Search -->
      <div class="relative flex-1 md:flex-initial md:w-64">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
          <svg class="h-4 w-4 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
        </div>
        <input type="text" 
               x-model="searchQuery" 
               @input="filterDocuments()"
               placeholder="Поиск документов..."
               class="w-full pl-9 pr-3 py-2 text-sm text-gray-900 bg-white border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#279760] focus:border-transparent placeholder-gray-900">
      </div>
      
      <!-- New doc -->
      <button onclick="openModal('upload-document-modal')"
              class="inline-flex items-center justify-center h-10 w-10 md:w-auto px-0 md:px-5 rounded-full bg-[#279760] text-white text-sm font-medium hover:bg-[#218655] transition-colors flex-shrink-0">
        <svg class="w-5 h-5 md:mr-2" viewBox="0 0 20 20" fill="none">
          <path d="M10 4.16667V15.8333M4.16667 10H15.8333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span class="hidden md:inline">Новый документ</span>
      </button>
    </div>
  </div>

  <!-- Country pills -->
  @php
    $flagMap = [
      'kz' => 'kazakhstan-flag.png',
      'kg' => 'kyrgyzstan-flag-365d7f.png',
      'ru' => 'russia-flag.png', 
      'th' => 'thailand-flag-56586a.png',
      'ae' => 'uae-flag.png',
    ];
  @endphp
  <div class="flex gap-1 md:gap-3 mb-6 overflow-x-auto whitespace-nowrap pb-1" style="scrollbar-width:none; -ms-overflow-style:none;"> 
    <style>.overflow-x-auto::-webkit-scrollbar{display:none}</style>
    @foreach($countries as $country)
      <button
        class="inline-flex items-center gap-1 md:gap-2 h-7 md:h-8 px-2 md:px-3 rounded-full border whitespace-nowrap max-w-[120px] md:max-w-none overflow-hidden {{ $country->id === $selectedCountry->id ? 'bg-[#F3FBF7] border-[#279760]' : 'bg-white border-gray-200 hover:bg-gray-50' }}"
        data-country-id="{{ $country->id }}">
        <img src="{{ asset('images/flags/' . ($flagMap[$country->code] ?? 'russia-flag.png')) }}" alt="{{ $country->name }}"
             class="w-4 h-4 rounded-full object-cover">
        <span class="text-[10px] md:text-sm {{ $country->id === $selectedCountry->id ? 'text-[#279760]' : 'text-gray-700' }} block truncate max-w-[88px] md:max-w-none">
          {{ $country->name }}
        </span>
      </button>
    @endforeach
  </div>

  <div class="border-t border-gray-100 mb-6"></div>

  <!-- Grid -->
  <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4 sm:gap-5">
    @forelse($templates as $template)
      <div class="flex flex-col items-start">
        <div class="group document-card bg-white border border-gray-200 rounded-xl p-4 shadow-sm hover:shadow-md transition-[box-shadow,transform]"
             data-template-id="{{ $template->id }}"
             data-title="{{ strtolower($template->name) }}"
             data-type="{{ strtolower($template->document_template_type_name) }}" style="aspect-ratio:1/1; width:45vw; max-width:180px; min-width:140px;">
        <!-- File icon only inside card -->
        @php 
          $ext = strtolower(pathinfo($template->name, PATHINFO_EXTENSION));
          $displayExt = ($ext === 'doc' || $ext === 'docx') ? 'docx' : 'xlsx';
        @endphp
        <div class="flex items-center justify-center h-full">
          <!-- Default view with file icon -->
          <div class="file-icon-view" onclick="event.stopPropagation(); downloadDocument('{{ $template->id }}')" title="Скачать">
            <svg class="w-[60px] h-[74px]" viewBox="0 0 48 60" fill="none" xmlns="http://www.w3.org/2000/svg">
              <!-- sheet -->
              <path d="M8 2h22l10 10v46H8V2z" fill="#279760" stroke="#279760"/>
              <!-- dog-ear -->
              <path d="M30 2v10h10" fill="#279760"/>
              <!-- bottom bar (type area) -->
              <rect x="8" y="36" width="32" height="18" rx="2" fill="#218655" stroke="#218655"/>
              <!-- extension text (centered) -->
              <text x="24" y="32" text-anchor="middle" dominant-baseline="middle" font-size="11" font-weight="500" fill="#FFFFFF" font-family="Inter, Arial">.{{ $displayExt }}</text>
            </svg>
          </div>
          
          <!-- Search view with action buttons -->
          <div class="action-buttons-view hidden flex-row gap-3 items-center justify-center">
            <button onclick="event.stopPropagation(); window.open('/accountant/document-templates/{{ $template->id }}/download', '_blank')" 
                    class="p-3 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200 transition-colors">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.023 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
              </svg>
            </button>
            <button onclick="event.stopPropagation(); downloadDocument('{{ $template->id }}')" 
                    class="p-3 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200 transition-colors">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
              </svg>
            </button>
          </div>
        </div>

          <!-- No text inside the card -->
        </div>
        <!-- Title + subtitle outside (below card) -->
        <div class="mt-2 flex items-start w-full">
          <div class="flex-1 min-w-0">
            <div class="flex items-center gap-1">
              <h3 class="text-sm font-medium text-gray-900 truncate flex-1" title="{{ $template->name }}">{{ $template->name }}</h3>
              <div class="relative flex-shrink-0 doc-menu-{{ $template->id }}">
                <button onclick="toggleDocMenu({{ $template->id }})" class="p-0.5 hover:bg-gray-100 rounded transition-colors">
              <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 16 16">
                <circle cx="8" cy="2" r="1.5"/>
                <circle cx="8" cy="8" r="1.5"/>
                <circle cx="8" cy="14" r="1.5"/>
              </svg>
                </button>
                <div class="doc-menu-dropdown hidden absolute right-0 mt-1 w-32 bg-white rounded-lg shadow-lg border border-gray-200 z-10">
                  <button onclick="event.stopPropagation(); toggleCardView({{ $template->id }})" 
                          class="block w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-t-lg">
                    Редактировать
                  </button>
                  <button onclick="event.stopPropagation(); deleteDocument({{ $template->id }})" 
                          class="block w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-gray-50 rounded-b-lg">
                    Удалить
                  </button>
                </div>
              </div>
            </div>
            <p class="mt-1 text-[11px] leading-4 text-gray-500">{{ $template->document_template_type_name }}</p>
          </div>
        </div>
      </div>
    @empty
      <div class="col-span-full text-center py-12">
        <p class="text-gray-500">Нет доступных шаблонов документов</p>
      </div>
    @endforelse
  </div>
</div>

@endsection

<!-- Mobile Actions Modal -->
<div id="mobileActionsModal" class="fixed inset-0 bg-black/50 z-50 hidden md:hidden">
  <div class="fixed bottom-0 left-0 right-0 bg-white p-6 transform translate-y-full transition-transform" id="mobileActionsContent">
    <div class="flex items-center justify-end mb-6">
      <button onclick="closeMobileActionsModal()" class="p-1 hover:bg-gray-100 rounded-full transition-colors">
        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>
    
    <div class="space-y-3" id="mobileActionButtons">
      <!-- Buttons will be inserted here -->
    </div>
  </div>
</div>


<!-- Upload Document Modal -->
<div id="upload-document-modal" class="modal hidden fixed inset-0 bg-black/50 z-50">
    <div class="modal-content fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-white rounded-xl p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-semibold text-gray-900">Новый документ</h3>
            <button onclick="closeModal('upload-document-modal')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none">
                    <path d="M15 5L5 15M5 5L15 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
        
        <form id="uploadForm" class="space-y-6">
            <!-- Drag & Drop Area -->
            <div class="border-2 border-dashed border-gray-200 rounded-lg p-8 text-center hover:border-[#279760] transition-colors" id="dropZone">
                <div class="mb-4">
                    <svg class="mx-auto h-12 w-12 text-[#279760]" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <p class="text-sm text-gray-600 mb-2">Выберите документ или перетащите</p>
                <input type="file" 
                       id="file" 
                       name="file" 
                       class="hidden"
                       accept=".doc,.docx,.xlsx,.xls">
                <button type="button" onclick="document.getElementById('file').click()" class="text-[#279760] hover:text-[#218655] text-sm font-medium">
                    Выбрать файл
                </button>
                <p class="mt-2 text-xs text-gray-400">Поддерживаемые форматы: DOC, DOCX, XLS, XLSX</p>
                <div id="fileName" class="mt-2 text-sm text-gray-700 hidden"></div>
            </div>
            
            <!-- Document Name -->
            <div>
                <label for="document_name" class="block text-sm font-medium text-gray-700 mb-1">Название документа</label>
                <input type="text" 
                       id="document_name" 
                       name="document_name" 
                       placeholder="InvoiceTemplate"
                       class="w-full h-[42px] px-3 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#279760] focus:border-transparent">
            </div>
            
            <!-- Document Type -->
            <div>
                <label for="document_type" class="block text-sm font-medium text-gray-700 mb-1">Тип документа</label>
                <select id="document_type" 
                        name="document_template_type_id" 
                        class="w-full h-[42px] px-3 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#279760] focus:border-transparent">
                    @foreach($documentTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <!-- Country -->
            <div>
                <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Страна</label>
                <select id="country" 
                        name="country_id" 
                        class="w-full h-[42px] px-3 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#279760] focus:border-transparent">
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" {{ $country->id === ($selectedCountry->id ?? null) ? 'selected' : '' }}>{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="flex justify-center gap-3 pt-4">
                <button type="button" 
                        onclick="closeModal('upload-document-modal')"
                        class="px-6 h-[40px] border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                    Отмена
                </button>
                <button type="submit"
                        class="px-6 h-[40px] bg-[#279760] text-white rounded-lg text-sm font-medium hover:bg-[#218655] transition-colors">
                    Сохранить
                </button>
            </div>
        </form>
    </div>
</div>

@push('styles')
<style>
.modal {
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.15s ease, visibility 0.15s ease;
}

.modal.show {
    opacity: 1;
    visibility: visible;
}

.modal-content {
    transform: scale(0.98) translateY(5px);
    opacity: 0;
    transition: transform 0.15s ease, opacity 0.15s ease;
}

.modal.show .modal-content {
    transform: scale(1) translateY(0);
    opacity: 1;
}

/* Custom file input */
input[type="file"] {
    font-size: 0;
    cursor: pointer;
}

input[type="file"]::file-selector-button {
    display: none;
}

input[type="file"]::before {
    content: 'Выберите файл';
    display: inline-block;
    font-size: 0.875rem;
    color: #374151;
    cursor: pointer;
    line-height: 26px;
}

/* Hover effect for document cards */
.document-card {
    transition: transform 0.15s ease, box-shadow 0.15s ease;
}

.document-card:hover {
    transform: translateY(-2px);
}

/* Smooth transitions for buttons */
button {
    transition: all 0.15s ease;
}

/* Custom select styling */
select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg width='12' height='8' viewBox='0 0 12 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1.5L6 6.5L11 1.5' stroke='%236B7280' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    padding-right: 36px !important;
}

/* Focus styles */
.focus-ring {
    outline: none;
    box-shadow: 0 0 0 2px #E8F5F3, 0 0 0 4px #00A389;
}

input:focus, select:focus {
    outline: none;
    border-color: #279760;
    box-shadow: 0 0 0 1px #279760;
}

/* Placeholder styles */
::placeholder {
    color: #9CA3AF;
}
</style>
@endpush
@push('styles')
<style>
  .document-card{transition:transform .15s ease, box-shadow .15s ease}
  .document-card:hover{transform:translateY(-2px)}
  /* нижняя плашка светлая, текст расширения зелёный */
  .file-icon .ext-bar{ fill:#FFFFFF; stroke:#279760 }
  .file-icon .ext-text{ fill:#279760 }
  /* Сделать иконку зеленой: все линии в зеленый */
  .file-icon svg path[stroke]{ stroke:#279760 }
  .file-icon svg rect[stroke]{ stroke:#279760 }
  /* Центровка по вертикали в контейнере уже через flex items-center */
  /* Гладкая фильтрация карточек */
  .doc-hidden{opacity:0; pointer-events:none; transition:opacity .2s}
</style>
@endpush

@push('scripts')
<script>
// Global modal functions - define immediately
(function() {
    window.openModal = function(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('hidden');
            requestAnimationFrame(() => {
                modal.classList.add('show');
            });
        }
    };

    window.closeModal = function(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('show');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }
    };

    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        if (event.target.classList.contains('modal')) {
            const modal = event.target;
            modal.classList.remove('show');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }
    });
})();

function uploadDocument(templateId) {
    const form = document.getElementById('uploadForm');
    const hiddenInput = document.createElement('input');
    hiddenInput.type = 'hidden';
    hiddenInput.name = 'template_id';
    hiddenInput.value = templateId;
    form.appendChild(hiddenInput);
    openModal('upload-document-modal');
}

function downloadDocument(templateId) {
    window.location.href = `/accountant/document-templates/${templateId}/download`;
}

function toggleDocMenu(templateId) {
    const isMobile = window.innerWidth < 768;
    
    if (isMobile) {
        openMobileActionsModal(templateId);
    } else {
        const menu = document.querySelector(`.doc-menu-${templateId} .doc-menu-dropdown`);
        menu?.classList.toggle('hidden');
    }
}

function openMobileActionsModal(templateId) {
    const modal = document.getElementById('mobileActionsModal');
    const content = document.getElementById('mobileActionsContent');
    const buttonsContainer = document.getElementById('mobileActionButtons');
    
    buttonsContainer.innerHTML = `
        <button onclick="downloadDocument(${templateId}); closeMobileActionsModal()" 
                class="w-full flex items-center justify-center gap-3 p-4 bg-white border border-gray-200 hover:bg-gray-50 transition-colors" style="border-radius: 32px;">
            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
            </svg>
            <span class="text-gray-900 font-medium">Скачать</span>
        </button>
        
        <button onclick="window.open('/accountant/document-templates/${templateId}/download', '_blank'); closeMobileActionsModal()" 
                class="w-full flex items-center justify-center gap-3 p-4 bg-white border border-gray-200 hover:bg-gray-50 transition-colors" style="border-radius: 32px;">
            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
            </svg>
            <span class="text-gray-900 font-medium">Просмотреть</span>
        </button>
        
        <button onclick="toggleCardView(${templateId}); closeMobileActionsModal()" 
                class="w-full flex items-center justify-center gap-3 p-4 bg-white border border-gray-200 hover:bg-gray-50 transition-colors" style="border-radius: 32px;">
            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            <span class="text-gray-900 font-medium">Редактировать</span>
        </button>
        
        <button onclick="deleteDocument(${templateId}); closeMobileActionsModal()" 
                class="w-full flex items-center justify-center gap-3 p-4 bg-white border border-gray-200 hover:bg-gray-50 transition-colors" style="border-radius: 32px;">
            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
            <span class="text-red-600 font-medium">Удалить</span>
        </button>
    `;
    
    modal.classList.remove('hidden');
    setTimeout(() => {
        content.style.transform = 'translateY(0)';
    }, 10);
}

function closeMobileActionsModal() {
    const modal = document.getElementById('mobileActionsModal');
    const content = document.getElementById('mobileActionsContent');
    
    content.style.transform = 'translateY(100%)';
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

// Close on backdrop click
document.getElementById('mobileActionsModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeMobileActionsModal();
    }
});

function toggleCardView(templateId) {
    const card = document.querySelector(`[data-template-id="${templateId}"]`);
    const iconView = card?.querySelector('.file-icon-view');
    const buttonsView = card?.querySelector('.action-buttons-view');
    
    if (iconView && buttonsView) {
        iconView.classList.toggle('hidden');
        buttonsView.classList.toggle('hidden');
        buttonsView.classList.toggle('flex');
    }
    
    // Close menu
    toggleDocMenu(templateId);
}

// Close card view when clicking outside
document.addEventListener('click', function(event) {
    const cards = document.querySelectorAll('.document-card');
    cards.forEach(card => {
        const iconView = card.querySelector('.file-icon-view');
        const buttonsView = card.querySelector('.action-buttons-view');
        
        // If buttons are visible and click is outside the card
        if (buttonsView && !buttonsView.classList.contains('hidden') && !card.contains(event.target)) {
            iconView?.classList.remove('hidden');
            buttonsView.classList.add('hidden');
            buttonsView.classList.remove('flex');
        }
    });
});

function deleteDocument(templateId) {
    if (confirm('Вы уверены, что хотите удалить этот документ?')) {
        fetch(`/document-delete/${templateId}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            } else {
                alert('Ошибка при удалении: ' + (data.message || 'Неизвестная ошибка'));
            }
        })
        .catch(error => {
            alert('Ошибка при удалении: ' + error.message);
        });
    }
}

// Search functionality with debounce
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Country filter functionality
document.querySelectorAll('[data-country-id]').forEach(button => {
    button.addEventListener('click', function() {
        const countryId = this.dataset.countryId;
        // Update modal country id when switching countries
        const modalCountryInput = document.getElementById('modal-country-id');
        if (modalCountryInput) {
            modalCountryInput.value = countryId;
        }
        window.location.href = `/accountant/document-templates?country_id=${countryId}`;
    });
});

// Drag & Drop functionality
const dropZone = document.getElementById('dropZone');
const fileInput = document.getElementById('file');
const fileName = document.getElementById('fileName');

if (dropZone && fileInput) {
    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    // Highlight drop area when item is dragged over it
    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, unhighlight, false);
    });

    // Handle dropped files
    dropZone.addEventListener('drop', handleDrop, false);
    
    // Handle file input change
    fileInput.addEventListener('change', function() {
        handleFiles(this.files);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    function highlight() {
        dropZone.classList.add('border-[#279760]', 'bg-green-50');
    }

    function unhighlight() {
        dropZone.classList.remove('border-[#279760]', 'bg-green-50');
    }

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        fileInput.files = files;
        handleFiles(files);
    }

    function handleFiles(files) {
        if (files.length > 0) {
            const file = files[0];
            fileName.textContent = `Выбран файл: ${file.name}`;
            fileName.classList.remove('hidden');
        }
    }
}

// Form submission with validation and feedback
const uploadForm = document.getElementById('uploadForm');
if (uploadForm) {
    const submitButton = uploadForm.querySelector('button[type="submit"]');

    uploadForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        // Validation
        if (!formData.get('file') || formData.get('file').size === 0) {
            alert('Пожалуйста, выберите файл');
            return;
        }
        
        submitButton.disabled = true;
        submitButton.innerHTML = '<svg class="animate-spin h-5 w-5 mr-2" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Загрузка...';
        
        try {
            const response = await fetch('/accountant/document-templates/upload', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
            
            const result = await response.json();
            
            if (response.ok) {
                closeModal('upload-document-modal');
                window.location.reload();
            } else {
                throw new Error(result.message || 'Ошибка при загрузке файла');
            }
        } catch (error) {
            alert('Ошибка: ' + error.message);
        } finally {
            submitButton.disabled = false;
            submitButton.innerHTML = 'Сохранить';
        }
    });
}
</script>
@endpush
