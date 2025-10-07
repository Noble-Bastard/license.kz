<!-- Profile Modal -->
<div x-show="showProfileModal" 
     x-transition:enter="ease-out duration-300" 
     x-transition:enter-start="opacity-0" 
     x-transition:enter-end="opacity-100"
     x-transition:leave="ease-in duration-200" 
     x-transition:leave-start="opacity-100" 
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 overflow-y-auto"
     style="display: none;"
     @click.away="showProfileModal = false">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full">
            <div class="bg-white px-6 pt-6 pb-6">
                <div class="flex items-center justify-between mb-6">
                    <button @click="showProfileModal = false" class="text-gray-400 hover:text-gray-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- User Avatar and Info -->
                <div class="text-center mb-6">
                    <div class="flex justify-center mb-4">
                        @if(Auth::check() && Auth::user()->profile && Auth::user()->profile->photo_id != null)
                            <img src="/storage_/{{Auth::user()->profile->photo_path}}" 
                                 class="w-16 h-16 rounded-full object-cover">
                        @else
                            <div class="w-16 h-16 bg-gray-300 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">
                        @if(Auth::check() && Auth::user()->profile)
                            {{ Auth::user()->profile->first_name ?? 'Иван' }} {{ Auth::user()->profile->last_name ?? 'Иванов' }}
                        @else
                            Иван Иванов
                        @endif
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        @if(Auth::check() && Auth::user()->profile)
                            {{ Auth::user()->profile->legal_entity_name ?? 'Иван Иванов Иванов' }}
                        @else
                            Иван Иванов Иванов
                        @endif
                    </p>
                </div>

                <!-- Contact Info -->
                <div class="space-y-4 mb-6">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Телефон</label>
                        <p class="text-sm text-gray-900">
                            @if(Auth::check() && Auth::user()->profile)
                                {{ Auth::user()->profile->phone ?? '+7 (777) 777 77 77' }}
                            @else
                                +7 (777) 777 77 77
                            @endif
                        </p>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Email</label>
                        <p class="text-sm text-gray-900">
                            @if(Auth::check())
                                {{ Auth::user()->email ?? 'example@mail.com' }}
                            @else
                                example@mail.com
                            @endif
                        </p>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Статус</label>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Активный
                        </span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-3">
                    <a href="{{ route('profile') }}" 
                       class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Связаться с менеджером
                    </a>
                    <a href="{{ route('profile') }}" 
                       class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Связаться со службой поддержки
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
















