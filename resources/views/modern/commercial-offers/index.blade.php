@extends('layouts.modern-app')

@section('title', 'Коммерческие предложения')

@section('page-header')
    <div class="py-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-text-primary">Коммерческие предложения</h1>
                <p class="mt-1 text-sm text-text-secondary">
                    Управляйте коммерческими предложениями для ваших клиентов
                </p>
            </div>
            <div class="flex items-center space-x-3">
                @component('components.modern.button', [
                    'variant' => 'secondary',
                    'icon' => 'fas fa-search',
                    'attributes' => 'data-modal="search-modal"'
                ])
                    Поиск по имени
                @endcomponent
                
                @component('components.modern.button', [
                    'variant' => 'primary',
                    'icon' => 'fas fa-plus',
                    'href' => route('sale_manager.commercial_offer.create')
                ])
                    Создать КП
                @endcomponent
            </div>
        </div>
    </div>
@endsection

@section('content')
<div x-data="commercialOffers()" x-init="loadOffers()">
    <!-- Filters -->
    <div class="mb-6">
        @component('components.modern.card')
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    @component('components.modern.input', [
                        'type' => 'text',
                        'name' => 'search',
                        'placeholder' => 'Поиск по имени или email',
                        'icon' => 'fas fa-search',
                        'attributes' => 'x-model="filters.search" @input.debounce.300ms="applyFilters()"'
                    ])
                    @endcomponent
                </div>
                
                <div>
                    @component('components.modern.input', [
                        'type' => 'select',
                        'name' => 'type',
                        'placeholder' => 'Все типы',
                        'attributes' => 'x-model="filters.type" @change="applyFilters()"'
                    ])
                        <option value="КП">КП</option>
                        <option value="Требования">Требования</option>
                    @endcomponent
                </div>
                
                <div>
                    @component('components.modern.input', [
                        'type' => 'select',
                        'name' => 'license',
                        'placeholder' => 'Все лицензии',
                        'attributes' => 'x-model="filters.license" @change="applyFilters()"'
                    ])
                        <option value="Выдача сертификата специалиста для допуска к клинической практике">Выдача сертификата специалиста для допуска к клинической практике</option>
                        <option value="Выдача специального разрешения на проезд тяжеловесных и (или) крупногабаритных транспортных средств">Выдача специального разрешения на проезд тяжеловесных и (или) крупногабаритных транспортных средств</option>
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

    <!-- Table -->
    <div class="mb-6">
        @component('components.modern.card', ['padding' => 'none'])
            <div class="overflow-x-auto">
                @component('components.modern.table', ['hoverable' => true])
                    <x-slot name="head">
                        <tr>
                            <th class="table-th">
                                <div class="flex items-center space-x-1">
                                    <span>Дата создания</span>
                                    <button @click="sortBy('created_at')" class="text-text-tertiary hover:text-text-primary">
                                        <i class="fas fa-sort text-xs"></i>
                                    </button>
                                </div>
                            </th>
                            <th class="table-th">Имя</th>
                            <th class="table-th">E-mail</th>
                            <th class="table-th">Телефон</th>
                            <th class="table-th">Тип</th>
                            <th class="table-th">Лицензия</th>
                            <th class="table-th">Действия</th>
                        </tr>
                    </x-slot>

                    <template x-for="offer in offers" :key="offer.id">
                        <tr class="table-tr">
                            <td class="table-td">
                                <div class="text-sm">
                                    <div class="font-medium" x-text="formatDate(offer.created_at)"></div>
                                    <div class="text-text-secondary" x-text="formatTime(offer.created_at)"></div>
                                </div>
                            </td>
                            <td class="table-td">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-primary-100 flex items-center justify-center">
                                            <i class="fas fa-user text-primary-600"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-text-primary" x-text="offer.name"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="table-td">
                                <a :href="'mailto:' + offer.email" class="text-primary-600 hover:text-primary-900" x-text="offer.email"></a>
                            </td>
                            <td class="table-td">
                                <a :href="'tel:' + offer.phone" class="text-primary-600 hover:text-primary-900" x-text="offer.phone"></a>
                            </td>
                            <td class="table-td">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                      :class="offer.type === 'КП' ? 'bg-primary-100 text-primary-800' : 'bg-yellow-100 text-yellow-800'"
                                      x-text="offer.type"></span>
                            </td>
                            <td class="table-td">
                                <div class="max-w-xs">
                                    <div class="text-sm text-text-primary line-clamp-2" x-text="offer.license"></div>
                                </div>
                            </td>
                            <td class="table-td">
                                <div class="flex items-center space-x-2">
                                    <button @click="viewOffer(offer)" 
                                            class="text-primary-600 hover:text-primary-900" 
                                            title="Просмотр">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button @click="editOffer(offer)" 
                                            class="text-yellow-600 hover:text-yellow-900" 
                                            title="Редактировать">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button @click="deleteOffer(offer)" 
                                            class="text-red-600 hover:text-red-900" 
                                            title="Удалить">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>

                    <!-- Empty state -->
                    <tr x-show="offers.length === 0 && !loading">
                        <td colspan="7" class="table-td text-center py-12">
                            <div class="text-text-secondary">
                                <i class="fas fa-file-contract text-4xl mb-4"></i>
                                <p class="text-lg font-medium">Коммерческие предложения не найдены</p>
                                <p class="mt-1">Создайте первое коммерческое предложение для начала работы</p>
                            </div>
                        </td>
                    </tr>

                    <!-- Loading state -->
                    <tr x-show="loading">
                        <td colspan="7" class="table-td text-center py-12">
                            <div class="text-text-secondary">
                                <i class="fas fa-spinner fa-spin text-2xl mb-4"></i>
                                <p>Загрузка...</p>
                            </div>
                        </td>
                    </tr>
                @endcomponent
            </div>
        @endcomponent
    </div>

    <!-- Pagination -->
    <div x-show="pagination.total > pagination.per_page">
        <nav class="flex items-center justify-between border-t border-border-light bg-white px-4 py-3 sm:px-6 rounded-lg shadow-sm">
            <div class="flex flex-1 justify-between sm:hidden">
                <button @click="changePage(pagination.current_page - 1)" 
                        :disabled="pagination.current_page <= 1"
                        class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-text-secondary bg-white border border-border rounded-md hover:bg-neutral-50 disabled:opacity-50 disabled:cursor-not-allowed">
                    Предыдущая
                </button>
                <button @click="changePage(pagination.current_page + 1)" 
                        :disabled="pagination.current_page >= pagination.last_page"
                        class="relative ml-3 inline-flex items-center px-4 py-2 text-sm font-medium text-text-secondary bg-white border border-border rounded-md hover:bg-neutral-50 disabled:opacity-50 disabled:cursor-not-allowed">
                    Следующая
                </button>
            </div>
            <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-text-secondary">
                        Показано <span class="font-medium" x-text="pagination.from || 0"></span> по <span class="font-medium" x-text="pagination.to || 0"></span> из <span class="font-medium" x-text="pagination.total"></span> результатов
                    </p>
                </div>
                <div>
                    <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                        <!-- Previous page -->
                        <button @click="changePage(pagination.current_page - 1)" 
                                :disabled="pagination.current_page <= 1"
                                class="relative inline-flex items-center rounded-l-md px-2 py-2 text-text-secondary ring-1 ring-inset ring-border hover:bg-neutral-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-primary-600 disabled:opacity-50 disabled:cursor-not-allowed">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        
                        <!-- Page numbers -->
                        <template x-for="page in getPageNumbers()" :key="page">
                            <button @click="changePage(page)" 
                                    :class="page === pagination.current_page ? 
                                        'relative z-10 inline-flex items-center bg-primary-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600' : 
                                        'relative inline-flex items-center px-4 py-2 text-sm font-semibold text-text-secondary ring-1 ring-inset ring-border hover:bg-neutral-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-primary-600'"
                                    x-text="page"></button>
                        </template>
                        
                        <!-- Next page -->
                        <button @click="changePage(pagination.current_page + 1)" 
                                :disabled="pagination.current_page >= pagination.last_page"
                                class="relative inline-flex items-center rounded-r-md px-2 py-2 text-text-secondary ring-1 ring-inset ring-border hover:bg-neutral-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-primary-600 disabled:opacity-50 disabled:cursor-not-allowed">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </nav>
                </div>
            </div>
        </nav>
    </div>
</div>

<!-- View Modal -->
@component('components.modern.modal', ['name' => 'view-offer', 'size' => 'lg', 'title' => 'Просмотр коммерческого предложения'])
    <div x-show="selectedOffer">
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-text-primary">Имя клиента</label>
                <p class="mt-1 text-sm text-text-secondary" x-text="selectedOffer?.name"></p>
            </div>
            <div>
                <label class="block text-sm font-medium text-text-primary">Email</label>
                <p class="mt-1 text-sm text-text-secondary" x-text="selectedOffer?.email"></p>
            </div>
            <div>
                <label class="block text-sm font-medium text-text-primary">Телефон</label>
                <p class="mt-1 text-sm text-text-secondary" x-text="selectedOffer?.phone"></p>
            </div>
            <div>
                <label class="block text-sm font-medium text-text-primary">Тип</label>
                <p class="mt-1 text-sm text-text-secondary" x-text="selectedOffer?.type"></p>
            </div>
            <div>
                <label class="block text-sm font-medium text-text-primary">Лицензия</label>
                <p class="mt-1 text-sm text-text-secondary" x-text="selectedOffer?.license"></p>
            </div>
        </div>
    </div>
    
    <x-slot name="footer">
        @component('components.modern.button', ['variant' => 'secondary', 'attributes' => '@click="closeModal(\'view-offer\')"'])
            Закрыть
        @endcomponent
    </x-slot>
@endcomponent
@endsection

@section('js')
<script>
function commercialOffers() {
    return {
        offers: [],
        loading: false,
        selectedOffer: null,
        filters: {
            search: '',
            type: '',
            license: ''
        },
        pagination: {
            current_page: 1,
            last_page: 1,
            per_page: 10,
            total: 0,
            from: 0,
            to: 0
        },
        sortField: 'created_at',
        sortDirection: 'desc',

        async loadOffers() {
            this.loading = true;
            try {
                const params = new URLSearchParams({
                    page: this.pagination.current_page,
                    search: this.filters.search,
                    type: this.filters.type,
                    license: this.filters.license,
                    sort: this.sortField,
                    direction: this.sortDirection
                });

                const response = await fetch(`/api/commercial-offers?${params}`);
                const data = await response.json();
                
                this.offers = data.data;
                this.pagination = {
                    current_page: data.current_page,
                    last_page: data.last_page,
                    per_page: data.per_page,
                    total: data.total,
                    from: data.from,
                    to: data.to
                };
            } catch (error) {
                console.error('Error loading offers:', error);
                showNotification('error', 'Ошибка', 'Не удалось загрузить коммерческие предложения');
            } finally {
                this.loading = false;
            }
        },

        applyFilters() {
            this.pagination.current_page = 1;
            this.loadOffers();
        },

        resetFilters() {
            this.filters = {
                search: '',
                type: '',
                license: ''
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
            this.loadOffers();
        },

        changePage(page) {
            if (page >= 1 && page <= this.pagination.last_page) {
                this.pagination.current_page = page;
                this.loadOffers();
            }
        },

        getPageNumbers() {
            const pages = [];
            const current = this.pagination.current_page;
            const last = this.pagination.last_page;
            
            // Show first page
            if (current > 3) pages.push(1);
            
            // Show ellipsis if needed
            if (current > 4) pages.push('...');
            
            // Show pages around current
            for (let i = Math.max(1, current - 2); i <= Math.min(last, current + 2); i++) {
                pages.push(i);
            }
            
            // Show ellipsis if needed
            if (current < last - 3) pages.push('...');
            
            // Show last page
            if (current < last - 2) pages.push(last);
            
            return pages;
        },

        viewOffer(offer) {
            this.selectedOffer = offer;
            openModal('view-offer');
        },

        editOffer(offer) {
            window.location.href = `/commercial-offers/${offer.id}/edit`;
        },

        async deleteOffer(offer) {
            if (confirm('Вы уверены, что хотите удалить это коммерческое предложение?')) {
                try {
                    await fetch(`/api/commercial-offers/${offer.id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });
                    
                    showNotification('success', 'Успешно', 'Коммерческое предложение удалено');
                    this.loadOffers();
                } catch (error) {
                    showNotification('error', 'Ошибка', 'Не удалось удалить коммерческое предложение');
                }
            }
        },

        formatDate(dateString) {
            return new Date(dateString).toLocaleDateString('ru-RU');
        },

        formatTime(dateString) {
            return new Date(dateString).toLocaleTimeString('ru-RU', { 
                hour: '2-digit', 
                minute: '2-digit' 
            });
        }
    };
}
</script>
@endsection



