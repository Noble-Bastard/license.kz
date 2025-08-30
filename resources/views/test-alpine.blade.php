@extends('layouts.figma-sales')

@section('title', 'Тест JavaScript')

@section('content')
<div class="px-6 lg:px-8">
    <div class="py-6">
        <h1 class="text-2xl font-bold text-text-primary mb-6">Тест JavaScript</h1>
        
        <!-- Тест простого JavaScript -->
        <div class="mb-6">
            <h3 class="text-lg font-medium mb-3">Простой тест:</h3>
            <div class="border border-border-medium rounded-lg p-4">
                <p class="mb-2">Счетчик: <span id="counter">0</span></p>
                <button onclick="incrementCounter()" class="bg-primary-600 text-white px-4 py-2 rounded-md">
                    Увеличить
                </button>
            </div>
        </div>

        <!-- Тест модального окна -->
        <div class="mb-6">
            <h3 class="text-lg font-medium mb-3">Тест модального окна:</h3>
            <button onclick="openModal('test-modal')" class="bg-primary-600 text-white px-4 py-2 rounded-md">
                Открыть модальное окно
            </button>
        </div>

        <!-- Тест аккордеона -->
        <div class="mb-6">
            <h3 class="text-lg font-medium mb-3">Тест аккордеона:</h3>
            <div class="border border-border-medium rounded-lg">
                <button onclick="toggleSimpleAccordion()" class="w-full px-4 py-3 text-left flex items-center justify-between hover:bg-bg-tertiary">
                    <span>Нажми меня для аккордеона</span>
                    <i class="fas fa-chevron-down" id="simple-accordion-icon"></i>
                </button>
                <div id="simple-accordion-content" style="display: none;" class="px-4 py-3 bg-bg-tertiary border-t border-border-medium">
                    <p>Это скрытый контент аккордеона!</p>
                </div>
            </div>
        </div>

        <!-- Тест таблицы с аккордеоном -->
        <div class="mb-6">
            <h3 class="text-lg font-medium mb-3">Тест таблицы с аккордеоном:</h3>
            <div class="border border-border-medium rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-bg-tertiary">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-medium text-text-primary">Имя</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-text-primary">Описание</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-border-light">
                            <td class="px-4 py-3">Тест 1</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-between">
                                    <div class="line-clamp-1">Короткое описание которое обрезается...</div>
                                    <button onclick="toggleTableAccordion()" class="ml-2 text-text-muted hover:text-text-primary">
                                        <i class="fas fa-chevron-down" id="table-accordion-icon"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr id="table-accordion-row" style="display: none;">
                            <td colspan="2" class="px-4 py-3 bg-bg-secondary">
                                <div class="text-sm text-text-primary">
                                    Полное описание: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Тестовое модальное окно -->
<div id="test-modal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Тестовое модальное окно</h3>
            <button onclick="closeModal('test-modal')" class="modal-close">&times;</button>
        </div>
        <div class="modal-body">
            <p>Это тестовое модальное окно!</p>
            <div class="mt-4">
                <button onclick="closeModal('test-modal')" class="bg-primary-600 text-white px-4 py-2 rounded-md">
                    Закрыть
                </button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript функции -->
<script>
let counter = 0;

function incrementCounter() {
    counter++;
    document.getElementById('counter').textContent = counter;
}

function openModal(modalId) {
    document.getElementById(modalId).style.display = 'block';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

function toggleSimpleAccordion() {
    const content = document.getElementById('simple-accordion-content');
    const icon = document.getElementById('simple-accordion-icon');
    
    if (content.style.display === 'none' || content.style.display === '') {
        content.style.display = 'block';
        icon.className = 'fas fa-chevron-up';
    } else {
        content.style.display = 'none';
        icon.className = 'fas fa-chevron-down';
    }
}

function toggleTableAccordion() {
    const row = document.getElementById('table-accordion-row');
    const icon = document.getElementById('table-accordion-icon');
    
    if (row.style.display === 'none' || row.style.display === '') {
        row.style.display = 'table-row';
        icon.className = 'fas fa-chevron-up';
    } else {
        row.style.display = 'none';
        icon.className = 'fas fa-chevron-down';
    }
}

// Закрытие модального окна при клике вне его
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
    }
}
</script>

<!-- CSS для модальных окон -->
<style>
.modal {
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
}

.modal-content {
    background-color: white;
    margin: 5% auto;
    border-radius: 8px;
    width: 90%;
    max-width: 500px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 24px;
    border-bottom: 1px solid #e5e7eb;
}

.modal-title {
    font-size: 18px;
    font-weight: 600;
    color: #111827;
    margin: 0;
}

.modal-close {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: #6b7280;
    padding: 0;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-close:hover {
    color: #374151;
}

.modal-body {
    padding: 24px;
}
</style>
@endsection
