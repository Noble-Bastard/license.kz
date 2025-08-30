@extends('layouts.accountant-app')

@section('title', 'Шаблоны документов')

@push('head')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
@endpush

@section('content')

<div class="max-w-[1440px] mx-auto px-6 py-8 bg-white min-h-screen font-inter">
  <!-- Page Title -->
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-[22px] leading-[28px] font-semibold text-gray-900">Шаблоны документов</h1>

    <div class="flex items-center gap-3">
      <!-- Search -->
      <label class="relative block">
        <span class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
          <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="none">
            <path d="M17.5 17.5L12.5 12.5M14.1667 8.33333C14.1667 11.555 11.555 14.1667 8.33333 14.1667C5.11167 14.1667 2.5 11.555 2.5 8.33333C2.5 5.11167 5.11167 2.5 8.33333 2.5C11.555 2.5 14.1667 5.11167 14.1667 8.33333Z"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </span>
        <input id="searchInput" type="text" placeholder="Поиск по названию документа"
               class="h-10 w-[320px] rounded-full bg-gray-50 border border-gray-200 pl-10 pr-4 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-[#00A389] focus:border-transparent">
      </label>

      <!-- New doc -->
      <button onclick="openModal('upload-document-modal')"
              class="inline-flex items-center h-10 px-5 rounded-full bg-[#279760] text-white text-sm font-medium hover:bg-[#218655] transition-colors">
        <svg class="w-5 h-5 mr-2" viewBox="0 0 20 20" fill="none">
          <path d="M10 4.16667V15.8333M4.16667 10H15.8333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Новый документ
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
  <div class="flex gap-3 mb-6">
    @foreach($countries as $country)
      <button
        class="inline-flex items-center gap-2 h-8 px-3 rounded-full border {{ $country->id === $selectedCountry->id ? 'bg-[#F3FBF7] border-[#279760]' : 'bg-white border-gray-200 hover:bg-gray-50' }}"
        data-country-id="{{ $country->id }}">
        <img src="{{ asset('images/flags/' . ($flagMap[$country->code] ?? 'russia-flag.png')) }}" alt="{{ $country->name }}"
             class="w-4 h-4 rounded-full object-cover">
        <span class="text-sm {{ $country->id === $selectedCountry->id ? 'text-[#279760]' : 'text-gray-700' }}">
          {{ $country->name }}
        </span>
      </button>
    @endforeach
  </div>

  <div class="border-t border-gray-100 mb-6"></div>

  <!-- Grid -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-6 gap-6">
    @forelse($templates as $template)
      <div
        class="group document-card bg-white border border-gray-200 rounded-xl p-5 shadow-sm hover:shadow-md transition-[box-shadow,transform]"
        data-title="{{ strtolower($template->name) }}"
        data-type="{{ strtolower($template->document_template_type_name) }}"
      >
        <!-- File icon -->
        @php 
          $ext = strtolower(pathinfo($template->name, PATHINFO_EXTENSION));
          $displayExt = ($ext === 'doc' || $ext === 'docx') ? 'docx' : 'xlsx';
        @endphp
        <div class="flex justify-center mb-4">
          <div class="file-icon" onclick="event.stopPropagation(); downloadDocument('{{ $template->id }}')" title="Скачать">
            <svg class="w-[60px] h-[74px]" viewBox="0 0 48 60" fill="none" xmlns="http://www.w3.org/2000/svg">
              <!-- sheet -->
              <path d="M8 2h22l10 10v46H8V2z" fill="#EAFBF7" stroke="#D9E8E5"/>
              <!-- dog-ear -->
              <path d="M30 2v10h10" fill="#DFF6F1"/>
              <!-- bottom bar (type color) -->
              <rect x="8" y="36" width="32" height="18" rx="2" class="fill-type"/>
              <!-- extension -->
              <text x="24" y="49" text-anchor="middle" font-size="12" font-weight="700" fill="white" font-family="Inter, Arial">{{ $displayExt }}</text>
            </svg>
          </div>
        </div>

        <!-- Title + subtitle -->
        <div class="text-center">
          <h3 class="text-sm font-medium text-gray-900 truncate" title="{{ $template->name }}">
            {{ $template->name }}
          </h3>
          <p class="mt-1 text-[11px] leading-4 text-gray-500">
            {{ $template->document_template_type_name }}
          </p>
        </div>

        <!-- no corner download button; click on icon to download -->
      </div>
    @empty
      <div class="col-span-full text-center py-12">
        <p class="text-gray-500">Нет доступных шаблонов документов</p>
      </div>
    @endforelse
  </div>
</div>

@endsection


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
  .file-icon .fill-type{ fill:#279760 } /* зелёная плашка как на скрине */
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

const searchInput = document.getElementById('searchInput');
if (searchInput) {
    const performSearch = debounce(function(searchTerm) {
        const cards = document.querySelectorAll('.document-card');
        searchTerm = searchTerm.toLowerCase().trim();
        
        cards.forEach(card => {
            const title = card.querySelector('h3').textContent.toLowerCase();
            const type = card.querySelector('p').textContent.toLowerCase();
            const matches = title.includes(searchTerm) || type.includes(searchTerm);
            
            // Use opacity for smooth transition
            card.style.opacity = matches ? '1' : '0';
            setTimeout(() => {
                card.style.display = matches ? '' : 'none';
                if (matches) card.style.opacity = '1';
            }, matches ? 0 : 200);
        });
    }, 300);

    searchInput.addEventListener('input', (e) => performSearch(e.target.value));
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
