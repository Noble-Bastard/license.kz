@extends('layouts.client-app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm">
        <div class="px-5 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-xl font-semibold text-gray-900">Услуга УСЛ-{{ $serviceJournal->service_no }}</h1>
                    <p class="text-sm text-gray-500 mt-1">{{ $serviceJournal->service_name ?? 'Название услуги' }}</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('Client.serviceList') }}" 
                       class="inline-flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Назад к услугам
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="px-5 py-6">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-sm">
                <div class="p-6">
                    <!-- Service Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <!-- Service Details -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900">Информация об услуге</h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Название услуги</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $serviceJournal->service_name ?? 'Не указано' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Номер услуги</label>
                                    <p class="mt-1 text-sm text-gray-900">УСЛ-{{ $serviceJournal->service_no }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Статус</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $serviceJournal->service_status_name ?? 'Неизвестно' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Стоимость</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ number_format($serviceJournal->amount ?? 0, 2, '.', ' ') }} ₸</p>
                                </div>
                            </div>
                        </div>

                        <!-- Manager Info -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900">Менеджер</h3>
                            <div class="flex items-center space-x-4">
                                @if($manager != null)
                                    <div class="w-12 h-12 rounded-full bg-gray-200 overflow-hidden">
                                        @if($manager->photo_id != null)
                                            <img src="/storage_/{{ $manager->photo_path }}" class="w-full h-full object-cover" alt="Manager">
                                        @else
                                            <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                                                <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $manager->first_name }} {{ $manager->last_name }}</p>
                                        <p class="text-sm text-gray-500">Менеджер</p>
                                    </div>
                                @else
                                    <div class="w-12 h-12 rounded-full bg-gray-200 overflow-hidden">
                                        <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Не назначен</p>
                                        <p class="text-sm text-gray-500">Менеджер</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Service Steps -->
                    @if(isset($serviceJournalStepList) && $serviceJournalStepList->isNotEmpty())
                        <div class="space-y-6">
                            <h3 class="text-lg font-medium text-gray-900">Этапы выполнения</h3>
                            <div class="space-y-4">
                                @foreach($serviceJournalStepList as $step)
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-8 h-8 rounded-full {{ $step->is_completed ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-600' }} flex items-center justify-center">
                                                    @if($step->is_completed)
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                        </svg>
                                                    @else
                                                        <span class="text-xs font-medium">{{ $step->service_step_no }}</span>
                                                    @endif
                                                </div>
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">{{ $step->service_step_description ?? 'Этап ' . $step->service_step_no }}</p>
                                                    @if($step->is_completed && $step->completion_date)
                                                        <p class="text-xs text-gray-500">Завершен: {{ \App\Data\Helper\Assistant::formatDate($step->completion_date) }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                @if($step->is_completed)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        Завершен
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        В процессе
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Documents -->
                    @if(isset($serviceJournalClientDocumentList) && $serviceJournalClientDocumentList->isNotEmpty())
                        <div class="space-y-6 mt-8">
                            <h3 class="text-lg font-medium text-gray-900">Документы</h3>
                            <div class="space-y-2">
                                @foreach($serviceJournalClientDocumentList as $document)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center space-x-3">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">{{ $document->document->name ?? 'Документ' }}</p>
                                                <p class="text-xs text-gray-500">{{ $document->document->file_name ?? 'Файл' }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <button class="text-gray-400 hover:text-gray-600" title="Просмотр">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </button>
                                            <button class="text-gray-400 hover:text-gray-600" title="Скачать">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
