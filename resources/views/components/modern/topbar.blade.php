<!-- Modern Top Navigation Bar -->
<header class="bg-white border-b border-gray-200" x-data="{ 
    userMenuOpen: false,
    notificationsOpen: false,
    searchQuery: '',
    searchOpen: false
}">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-14">
            
            <!-- Left section -->
            <div class="flex items-center space-x-4">
                <!-- Mobile menu toggle -->
                <button @click="$store.sidebar.toggle()" 
                        type="button"
                        class="lg:hidden -ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                    <span class="sr-only">Открыть боковое меню</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <!-- Page title -->
                <div class="flex items-center">
                    <h1 class="text-lg font-semibold text-gray-900">
                        {{ $pageTitle ?? 'Панель управления' }}
                    </h1>
                </div>
            </div>

            <!-- Right section -->
            <div class="flex items-center space-x-3">
                
                <!-- Search (hidden on mobile) -->
                <div class="hidden md:block relative">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input x-model="searchQuery"
                               type="text" 
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md text-sm placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="Поиск..."
                               style="width: 280px;">
                    </div>
                </div>

                <!-- Quick actions -->
                @auth
                    @if(Auth::user()->isUserInRole(\App\Data\Helper\RoleList::SaleManager))
                        @if(Route::has('sale_manager.commercial_offer.create'))
                            <a href="{{ route('sale_manager.commercial_offer.create') }}" 
                               class="hidden lg:inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="-ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Создать КП
                            </a>
                        @endif
                    @elseif(Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Manager))
                        @if(Route::has('manager.services.list'))
                            <a href="{{ route('manager.services.list') }}" 
                               class="hidden lg:inline-flex items-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="-ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Услуги
                            </a>
                        @endif
                    @endif
                @endauth

                <!-- Notifications -->
                <div class="relative">
                    <button @click="notificationsOpen = !notificationsOpen"
                            type="button"
                            class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span class="sr-only">Посмотреть уведомления</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4.257 9.962c0-1.69.853-3.19 2.153-4.08A5.978 5.978 0 0112 3c2.197 0 4.24 1.18 5.345 3.074A7 7 0 0119 13v4h-2v-4c0-2.757-2.243-5-5-5s-5 2.243-5 5v4H5v-4c0-1.864.728-3.55 1.913-4.795z" />
                        </svg>
                        <!-- Notification badge -->
                        <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-400 ring-2 ring-white"></span>
                    </button>

                    <!-- Notifications dropdown -->
                    <div x-show="notificationsOpen" 
                         @click.away="notificationsOpen = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="origin-top-right absolute right-0 mt-2 w-80 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                        <div class="p-4">
                            <h3 class="text-sm font-medium text-gray-900">Уведомления</h3>
                            <div class="mt-2 space-y-2">
                                <div class="p-3 bg-blue-50 rounded-md">
                                    <p class="text-sm text-gray-900 font-medium">Новая услуга</p>
                                    <p class="text-sm text-gray-500">УСЛ-000319 требует внимания</p>
                                    <p class="text-xs text-gray-400 mt-1">5 мин назад</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile dropdown -->
                @auth
                <div class="relative">
                    <button @click="userMenuOpen = !userMenuOpen" 
                            type="button"
                            class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span class="sr-only">Открыть меню пользователя</span>
                        @if(Auth::user()->profile->photo_id != null)
                            <img class="h-8 w-8 rounded-full" 
                                 src="/storage_/{{Auth::user()->profile->photo_path}}" 
                                 alt="Профиль">
                        @else
                            <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        @endif
                        <span class="hidden lg:ml-3 lg:block">
                            <span class="text-sm font-medium text-gray-700">{{ Auth::user()->profile->first_name }}</span>
                            <span class="text-xs text-gray-500 block">
                                @if(Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Administrator))
                                    Администратор
                                @elseif(Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Manager))
                                    Менеджер
                                @elseif(Auth::user()->isUserInRole(\App\Data\Helper\RoleList::SaleManager))
                                    Менеджер по продажам
                                @elseif(Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Client))
                                    Клиент
                                @elseif(Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Executor))
                                    Исполнитель
                                @elseif(Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Accountant))
                                    Бухгалтер
                                @else
                                    Пользователь
                                @endif
                            </span>
                        </span>
                        <svg class="hidden lg:block ml-1 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Profile dropdown menu -->
                    <div x-show="userMenuOpen" 
                         @click.away="userMenuOpen = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                        <div class="py-1">
                            @if(Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Client))
                                @if(Route::has('profile'))
                                    <a href="{{ route('profile') }}" 
                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Мой профиль
                                    </a>
                                @endif
                                @if(Route::has('profile.documentList'))
                                    <a href="{{ route('profile.documentList') }}" 
                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Мои документы
                                    </a>
                                @endif
                            @else
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Профиль
                                </a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Настройки
                                </a>
                            @endif
                            
                            <div class="border-t border-gray-100"></div>
                            
                            @if(Route::has('logout'))
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" 
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Выйти
                                    </button>
                                </form>
                            @else
                                <a href="/logout" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Выйти
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @else
                    @if(Route::has('login'))
                        <a href="{{ route('login') }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            Войти
                        </a>
                    @else
                        <a href="/login" 
                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            Войти
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</header>

