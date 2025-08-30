@extends('layouts.modern-app')

@section('title', 'Управление новостями')

@section('page-header')
    <div class="py-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-text-primary">@lang('messages.admin.news.newses')</h1>
                <p class="mt-1 text-sm text-text-secondary">
                    Управляйте новостями и публикациями
                </p>
            </div>
            <div class="flex items-center space-x-3">
                @component('components.modern.button', [
                    'variant' => 'primary',
                    'icon' => 'fas fa-plus',
                    'href' => route('admin.news.create')
                ])
                    @lang('messages.all.add')
                @endcomponent
            </div>
        </div>
    </div>
@endsection

@section('content')
<div x-data="newsManager()" x-init="init()">
    <!-- Filters -->
    <div class="mb-6">
        @component('components.modern.card')
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    @component('components.modern.input', [
                        'type' => 'text',
                        'name' => 'search',
                        'placeholder' => 'Поиск по заголовку или содержанию',
                        'icon' => 'fas fa-search',
                        'attributes' => 'x-model="filters.search" @input.debounce.300ms="applyFilters()"'
                    ])
                    @endcomponent
                </div>
                
                <div>
                    @component('components.modern.input', [
                        'type' => 'select',
                        'name' => 'country',
                        'placeholder' => 'Все страны',
                        'attributes' => 'x-model="filters.country" @change="applyFilters()"'
                    ])
                        <option value="">Все страны</option>
                        @foreach(App\Data\Helper\CountryList::getList() as $key => $country)
                            <option value="{{ $key }}">{{ $country }}</option>
                        @endforeach
                    @endcomponent
                </div>
                
                <div>
                    @component('components.modern.input', [
                        'type' => 'select',
                        'name' => 'is_actual',
                        'placeholder' => 'Все статусы',
                        'attributes' => 'x-model="filters.is_actual" @change="applyFilters()"'
                    ])
                        <option value="">Все статусы</option>
                        <option value="1">Актуальные</option>
                        <option value="0">Неактуальные</option>
                    @endcomponent
                </div>
                
                <div class="flex items-end">
                    @component('components.modern.button', [
                        'variant' => 'outline',
                        'icon' => 'fas fa-redo',
                        'attributes' => '@click="resetFilters()"'
                    ])
                        Сбросить
                    @endcomponent
                </div>
            </div>
        @endcomponent
    </div>

    <!-- News Table -->
    <div class="mb-6">
        @component('components.modern.card', ['padding' => 'none'])
            <div class="overflow-x-auto">
                @component('components.modern.table', ['hoverable' => true])
                    <x-slot name="head">
                        <tr>
                            <th class="table-th">
                                <div class="flex items-center space-x-1">
                                    <span>@lang('messages.admin.news.header')</span>
                                    <button @click="sortBy('header')" class="text-text-tertiary hover:text-text-primary">
                                        <i class="fas fa-sort text-xs"></i>
                                    </button>
                                </div>
                            </th>
                            <th class="table-th">@lang('messages.admin.news.news')</th>
                            <th class="table-th">@lang('messages.admin.news.news_is_actual')</th>
                            <th class="table-th">@lang('messages.all.order_num')</th>
                            <th class="table-th">@lang('messages.admin.countries.country')</th>
                            <th class="table-th">@lang('messages.all.actions')</th>
                        </tr>
                    </x-slot>

                    @foreach($newsList as $news)
                        <tr class="table-tr">
                            <td class="table-td">
                                <div class="max-w-xs">
                                    <div class="font-medium text-text-primary">{{ $news->header }}</div>
                                </div>
                            </td>
                            <td class="table-td">
                                <div class="max-w-md">
                                    <p class="text-sm text-text-secondary line-clamp-3">
                                        {!! App\Data\Helper\Assistant::subStrCutByWord(str_replace(array("\n","\r"), '', strip_tags($news->content)), 200) !!}...
                                    </p>
                                </div>
                            </td>
                            <td class="table-td">
                                @if($news->is_actual == 1)
                                    @component('components.modern.badge', ['variant' => 'success', 'dot' => true])
                                        @lang('messages.all.yes')
                                    @endcomponent
                                @else
                                    @component('components.modern.badge', ['variant' => 'danger', 'dot' => true])
                                        @lang('messages.all.no')
                                    @endcomponent
                                @endif
                            </td>
                            <td class="table-td">
                                @component('components.modern.badge', ['variant' => 'outline-default'])
                                    {{ $news->orderNum }}
                                @endcomponent
                            </td>
                            <td class="table-td">
                                <span class="text-sm text-text-secondary">{{ $news->country_name }}</span>
                            </td>
                            <td class="table-td">
                                <div class="flex items-center space-x-2">
                                    <button @click="changePreviewPhoto({{ $news->id }})" 
                                            class="text-blue-600 hover:text-blue-900" 
                                            title="Изменить фото">
                                        <i class="fas fa-image"></i>
                                    </button>
                                    <a href="{{ route('admin.news.edit', ['id' => $news->id]) }}" 
                                       class="text-yellow-600 hover:text-yellow-900" 
                                       title="Редактировать">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('admin.news.commentList', ['id' => $news->id]) }}" 
                                       class="text-green-600 hover:text-green-900" 
                                       title="Комментарии">
                                        <i class="fas fa-comments"></i>
                                    </a>
                                    <button @click="deleteNews({{ $news->id }})" 
                                            class="text-red-600 hover:text-red-900" 
                                            title="Удалить">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    <!-- Empty state -->
                    @if($newsList->isEmpty())
                        <tr>
                            <td colspan="6" class="table-td text-center py-12">
                                <div class="text-text-secondary">
                                    <i class="fas fa-newspaper text-4xl mb-4"></i>
                                    <p class="text-lg font-medium">Новости не найдены</p>
                                    <p class="mt-1">Создайте первую новость для начала работы</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endcomponent
            </div>
        @endcomponent
    </div>

    <!-- Pagination -->
    @if($newsList->hasPages())
        @component('components.modern.pagination', ['paginator' => $newsList])
        @endcomponent
    @endif
</div>

<!-- Change Preview Photo Modal -->
@component('components.modern.modal', [
    'name' => 'preview-photo-modal',
    'size' => 'md',
    'title' => trans('messages.all.previewPhoto')
])
    <form x-ref="previewPhotoForm" 
          method="post" 
          action="{{ route('admin.news.previewPhoto') }}" 
          enctype="multipart/form-data"
          @submit.prevent="submitPreviewPhoto()">
        @csrf
        <input type="hidden" name="newsId" x-model="selectedNewsId">
        
        <div class="space-y-4">
            @component('components.modern.input', [
                'type' => 'file',
                'name' => 'previewPhoto',
                'label' => trans('messages.all.previewPhoto'),
                'required' => true,
                'help' => 'Поддерживаются форматы: JPG, PNG, GIF. Максимальный размер: 5MB'
            ])
            @endcomponent
        </div>
    </form>
    
    <x-slot name="footer">
        @component('components.modern.button', [
            'variant' => 'secondary',
            'attributes' => '@click="closeModal(\'preview-photo-modal\')"'
        ])
            Отмена
        @endcomponent
        @component('components.modern.button', [
            'variant' => 'primary',
            'attributes' => '@click="submitPreviewPhoto()"'
        ])
            @lang('messages.all.set')
        @endcomponent
    </x-slot>
@endcomponent
@endsection

@section('js')
<script>
function newsManager() {
    return {
        selectedNewsId: null,
        filters: {
            search: '',
            country: '',
            is_actual: ''
        },
        sortField: 'header',
        sortDirection: 'asc',

        init() {
            // Инициализация
        },

        applyFilters() {
            // В реальном приложении здесь будет AJAX запрос для фильтрации
            console.log('Applying filters:', this.filters);
        },

        resetFilters() {
            this.filters = {
                search: '',
                country: '',
                is_actual: ''
            };
            this.applyFilters();
        },

        sortBy(field) {
            if (this.sortField === field) {
                this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
            } else {
                this.sortField = field;
                this.sortDirection = 'asc';
            }
            
            // В реальном приложении здесь будет AJAX запрос для сортировки
            console.log('Sorting by:', field, this.sortDirection);
        },

        changePreviewPhoto(newsId) {
            this.selectedNewsId = newsId;
            openModal('preview-photo-modal');
        },

        async submitPreviewPhoto() {
            const form = this.$refs.previewPhotoForm;
            const formData = new FormData(form);

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (response.ok) {
                    showNotification('success', 'Успешно!', 'Фото превью обновлено');
                    closeModal('preview-photo-modal');
                    window.location.reload(); // Перезагружаем страницу для обновления
                } else {
                    throw new Error('Ошибка сервера');
                }
            } catch (error) {
                showNotification('error', 'Ошибка!', 'Не удалось обновить фото превью');
            }
        },

        async deleteNews(newsId) {
            if (!confirm('Вы уверены, что хотите удалить эту новость?')) {
                return;
            }

            try {
                const response = await fetch(`/admin/news/${newsId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    }
                });

                if (response.ok) {
                    showNotification('success', 'Успешно!', 'Новость удалена');
                    window.location.reload();
                } else {
                    throw new Error('Ошибка сервера');
                }
            } catch (error) {
                showNotification('error', 'Ошибка!', 'Не удалось удалить новость');
            }
        }
    };
}
</script>
@endsection