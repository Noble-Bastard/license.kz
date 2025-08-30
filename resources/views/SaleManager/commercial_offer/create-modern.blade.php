@extends('new.layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">
                        @lang('messages.sale_manager.commercial_offer.create.title')
                    </h1>
                    <p class="mt-2 text-sm text-gray-600">
                        Создайте коммерческое предложение для клиента
                    </p>
                </div>
                <div class="flex items-center space-x-3">
                    <button type="button" 
                            onclick="window.history.back()"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Назад
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Form -->
        <div class="bg-white shadow-sm rounded-lg">
            <form method="post" id="createCommercialOfferForm" action="{{route('sale_manager.commercial_offer.store')}}" class="space-y-8">
                @csrf
                
                <!-- Service Information Section -->
                <div class="border-b border-gray-200 pb-8">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Информация об услуге</h3>
                        <p class="text-sm text-gray-600">Основные данные о разрешительном документе</p>
                    </div>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- ID List -->
                        <div class="lg:col-span-2">
                            <label for="idList" class="block text-sm font-medium text-gray-700 mb-2">
                                ID подвидов услуг
                            </label>
                            <div class="flex space-x-3">
                                <input class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" 
                                       type="text" 
                                       id="idList" 
                                       name="idList" 
                                       placeholder="Укажите ID подвидов через `;`" />
                                <button type="button" 
                                        id="addById"
                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                    <i class="fas fa-magic mr-2"></i>
                                    Заполнить по ID
                                </button>
                            </div>
                        </div>

                        <!-- Service Name -->
                        <div>
                            <label for="serviceName" class="block text-sm font-medium text-gray-700 mb-2">
                                Наименование разрешительного документа
                            </label>
                            <input class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" 
                                   type="text" 
                                   id="serviceName" 
                                   name="serviceName" />
                        </div>

                        <!-- Executive Agency -->
                        <div>
                            <label for="executiveAgency" class="block text-sm font-medium text-gray-700 mb-2">
                                Уполномоченный орган
                            </label>
                            <input class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" 
                                   type="text" 
                                   id="executiveAgency" 
                                   name="executiveAgency" />
                        </div>

                        <!-- Service List -->
                        <div class="lg:col-span-2">
                            <label for="serviceList" class="block text-sm font-medium text-gray-700 mb-2">
                                Выбранные подвиды
                            </label>
                            <textarea class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" 
                                      id="serviceList" 
                                      name="serviceList" 
                                      rows="3"
                                      placeholder="Укажите наименование подвидов через `;`"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Requirements Section -->
                <div class="border-b border-gray-200 pb-8">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Требования и документы</h3>
                        <p class="text-sm text-gray-600">Дополнительные требования и необходимые документы</p>
                    </div>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Additional Requirements -->
                        <div>
                            <label for="serviceAdditionalRequirements" class="block text-sm font-medium text-gray-700 mb-2">
                                Дополнительные требования
                            </label>
                            <textarea class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" 
                                      id="serviceAdditionalRequirements" 
                                      name="serviceAdditionalRequirements" 
                                      rows="4"
                                      placeholder="Укажите перечисление групп через `||`"></textarea>
                        </div>

                        <!-- Required Documents -->
                        <div>
                            <label for="serviceRequiredDocument" class="block text-sm font-medium text-gray-700 mb-2">
                                Необходимые документы
                            </label>
                            <textarea class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" 
                                      id="serviceRequiredDocument" 
                                      name="serviceRequiredDocument" 
                                      rows="4"
                                      placeholder="Укажите наименование документов через `;`"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Financial Information Section -->
                <div class="border-b border-gray-200 pb-8">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Финансовая информация</h3>
                        <p class="text-sm text-gray-600">Стоимость и сроки оказания услуги</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Tax -->
                        <div>
                            <label for="tax" class="block text-sm font-medium text-gray-700 mb-2">
                                Государственная пошлина (МРП)
                            </label>
                            <div class="relative">
                                <input class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm pr-8" 
                                       type="number" 
                                       id="tax" 
                                       name="tax" 
                                       step="0.01" />
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">МРП</span>
                                </div>
                            </div>
                        </div>

                        <!-- Execution Time -->
                        <div>
                            <label for="executionWorkDay" class="block text-sm font-medium text-gray-700 mb-2">
                                Срок оказания услуги
                            </label>
                            <input class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" 
                                   type="text" 
                                   id="executionWorkDay" 
                                   name="executionWorkDay" 
                                   placeholder="например: 10 рабочих дней" />
                        </div>

                        <!-- Cost -->
                        <div>
                            <label for="cost" class="block text-sm font-medium text-gray-700 mb-2">
                                Стоимость услуги
                            </label>
                            <div class="relative">
                                <input class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm pr-12" 
                                       type="number" 
                                       id="cost" 
                                       name="cost" 
                                       step="100" 
                                       min="1" />
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">₸</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Information Section -->
                <div class="pb-8">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Контактная информация</h3>
                        <p class="text-sm text-gray-600">Данные для отправки коммерческого предложения</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Email -->
                        <div>
                            <label for="emailToSend" class="block text-sm font-medium text-gray-700 mb-2">
                                Email для отправки
                            </label>
                            <input class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" 
                                   type="email" 
                                   id="emailToSend" 
                                   name="emailToSend" 
                                   value="{{\Illuminate\Support\Facades\Auth::user()->email}}" />
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                Телефон
                            </label>
                            <input class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" 
                                   type="text" 
                                   id="phone" 
                                   name="phone" 
                                   value="{{\Illuminate\Support\Facades\Auth::user()->profile->phone}}" />
                        </div>

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Имя
                            </label>
                            <input class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" 
                                   type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{\Illuminate\Support\Facades\Auth::user()->name}}" />
                        </div>
                    </div>
                </div>

                <!-- Submit Section -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <button type="button" 
                            onclick="window.history.back()"
                            class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Отмена
                    </button>
                    <button type="submit" 
                            id="submitBtn" 
                            class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 disabled:opacity-50 disabled:cursor-not-allowed">
                        <i class="fas fa-paper-plane mr-2"></i>
                        <span class="submit-text">Отправить КП</span>
                        <span class="loading-text hidden">Отправка...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Loading Overlay -->
<div id="loadingOverlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg p-6 flex items-center space-x-3">
        <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-primary-600"></div>
        <span class="text-gray-700">Создание коммерческого предложения...</span>
    </div>
</div>
@endsection

@section('js')
<script>
$(function () {
    // Fill form by ID
    $(document).on('click', '#addById', function(){
        const idList = $('#idList').val();
        if (!idList.trim()) {
            showNotification('warning', 'Внимание', 'Введите ID подвидов услуг');
            return;
        }

        // Show loading state
        const $btn = $(this);
        const originalText = $btn.html();
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Загрузка...');

        $.ajax({
            type: 'get',
            url: '{{route('sale_manager.commercial_offer.prepareServiceById')}}',
            data: { idList: idList },
            success: function (data) {
                $('#serviceName').val(data.serviceName || '');
                $('#serviceList').val(data.serviceList || '');
                $('#executiveAgency').val(data.executiveAgency || '');
                $('#tax').val(data.tax || '');
                $('#executionWorkDay').val(data.executionWorkDay || '');
                $('#serviceAdditionalRequirements').val(data.serviceAdditionalRequirements || '');
                $('#serviceRequiredDocument').val(data.serviceRequiredDocument || '');
                $('#cost').val(data.cost || '');
                
                showNotification('success', 'Успешно!', 'Форма заполнена данными по ID');
            },
            error: function() {
                showNotification('error', 'Ошибка!', 'Не удалось загрузить данные по ID');
            },
            complete: function() {
                $btn.prop('disabled', false).html(originalText);
            }
        });
    });

    // Form submission
    $(document).on('click', '#submitBtn', function(){
        const $btn = $(this);
        const $submitText = $btn.find('.submit-text');
        const $loadingText = $btn.find('.loading-text');
        
        // Show loading state
        $btn.prop('disabled', true);
        $submitText.addClass('hidden');
        $loadingText.removeClass('hidden');
        
        // Show loading overlay
        $('#loadingOverlay').removeClass('hidden');
        
        // Submit form
        $("#createCommercialOfferForm").submit();
    });

    // Form validation
    $('#createCommercialOfferForm').on('submit', function(e) {
        const requiredFields = ['serviceName', 'serviceList', 'executiveAgency', 'tax', 'executionWorkDay', 'cost', 'emailToSend'];
        let isValid = true;
        
        requiredFields.forEach(field => {
            const $field = $(`#${field}`);
            if (!$field.val().trim()) {
                $field.addClass('border-red-300 focus:border-red-500 focus:ring-red-500');
                isValid = false;
            } else {
                $field.removeClass('border-red-300 focus:border-red-500 focus:ring-red-500');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            showNotification('error', 'Ошибка валидации', 'Пожалуйста, заполните все обязательные поля');
            
            // Reset button state
            const $btn = $('#submitBtn');
            const $submitText = $btn.find('.submit-text');
            const $loadingText = $btn.find('.loading-text');
            $btn.prop('disabled', false);
            $submitText.removeClass('hidden');
            $loadingText.addClass('hidden');
            $('#loadingOverlay').addClass('hidden');
        }
    });

    // Real-time validation feedback
    $('input, textarea').on('blur', function() {
        const $field = $(this);
        if ($field.val().trim()) {
            $field.removeClass('border-red-300 focus:border-red-500 focus:ring-red-500');
        }
    });
});

// Notification function (if not already defined)
function showNotification(type, title, message) {
    // You can implement your own notification system here
    // For now, using browser alert as fallback
    alert(`${title}: ${message}`);
}
</script>
@endsection
