<div class="p-6">
    <form action="#" method="POST">
        <div class="space-y-4">
            <div>
                <label for="offer_name" class="block text-sm font-medium text-text-primary mb-1">Название КП</label>
                @component('components.modern.input', [
                    'type' => 'text',
                    'name' => 'offer_name',
                    'id' => 'offer_name',
                    'placeholder' => 'Введите название коммерческого предложения',
                    'required' => true,
                ])
            </div>
            <div>
                <label for="client_name" class="block text-sm font-medium text-text-primary mb-1">Имя клиента</label>
                @component('components.modern.input', [
                    'type' => 'text',
                    'name' => 'client_name',
                    'id' => 'client_name',
                    'placeholder' => 'Введите имя клиента',
                ])
            </div>
            <div>
                <label for="client_email" class="block text-sm font-medium text-text-primary mb-1">E-mail клиента</label>
                @component('components.modern.input', [
                    'type' => 'email',
                    'name' => 'client_email',
                    'id' => 'client_email',
                    'placeholder' => 'Введите e-mail клиента',
                ])
            </div>
            <div>
                <label for="client_phone" class="block text-sm font-medium text-text-primary mb-1">Телефон клиента</label>
                @component('components.modern.input', [
                    'type' => 'tel',
                    'name' => 'client_phone',
                    'id' => 'client_phone',
                    'placeholder' => 'Введите телефон клиента',
                ])
            </div>
            <div>
                <label for="offer_type" class="block text-sm font-medium text-text-primary mb-1">Тип предложения</label>
                {{-- Здесь должен быть компонент для выбора типа, пока используем placeholder --}}
                @component('components.modern.input', [
                    'type' => 'text',
                    'name' => 'offer_type',
                    'id' => 'offer_type',
                    'placeholder' => 'Выберите тип предложения',
                ])
            </div>
            <div>
                <label for="offer_services" class="block text-sm font-medium text-text-primary mb-1">Услуги</label>
                {{-- Здесь должен быть компонент для выбора услуг, пока используем placeholder --}}
                @component('components.modern.input', [
                    'type' => 'text',
                    'name' => 'offer_services',
                    'id' => 'offer_services',
                    'placeholder' => 'Выберите услуги',
                ])
            </div>
            <div>
                <label for="offer_notes" class="block text-sm font-medium text-text-primary mb-1">Примечания</label>
                <textarea id="offer_notes" name="offer_notes" rows="3" class="block w-full px-3 py-2 border border-border-medium rounded-md shadow-sm placeholder-text-muted focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm"></textarea>
            </div>
        </div>

        <div class="mt-6 flex justify-end space-x-3">
            @component('components.modern.button', [
                'variant' => 'secondary',
                'content' => 'Отмена',
                'attributes' => 'onclick="closeModal(\'create-commercial-offer\')" type="button"'
            ])
            @component('components.modern.button', [
                'type' => 'submit',
                'variant' => 'primary',
                'icon' => 'fas fa-plus',
                'content' => 'Создать КП',
            ])
        </div>
    </form>
</div>
