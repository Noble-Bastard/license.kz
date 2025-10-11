@extends('layouts.figma-app')

<div class="w-full">
    <div class="px-5 py-5" style="padding-left:20px;padding-right:20px;">
        <div class="flex items-center justify-between gap-[10px] mb-[30px]">
            <h1 class="text-[39px] leading-[1] font-normal tracking-[-0.02em] text-text-primary">Редактировать группу: {{ $executorGroup->name }}</h1>
        </div>
    </div>

    <div class="px-5 pb-20" style="padding-left:20px;padding-right:20px;">
        <div class="max-w-md mx-auto">
            <div class="bg-white rounded-lg p-6 shadow-sm border border-border-light">

            {!! Form::open(['url' => route('Manager.groups.update', $executorGroup->id), 'method' => 'put', 'class' => 'space-y-6']) !!}
            <input name="id" type="hidden" value="{{ $executorGroup->id }}"/>

            <div>
                {!! Form::label('name', 'Название группы', ['class' => 'block text-sm font-medium text-text-primary mb-2']) !!}
                {!! Form::text('name', $executorGroup->name, array_merge([
                    'class' => 'w-full px-3 py-2 border border-border-light rounded-lg bg-white text-text-primary placeholder-text-secondary focus:outline-none focus:ring-2 focus:ring-[#279760] focus:border-transparent',
                    'placeholder' => 'Введите название группы',
                    'autofocus' => 'autofocus'
                ])) !!}

                @if ($errors->has('name'))
                    <p class="mt-1 text-sm text-red-600">{{ $errors->first('name') }}</p>
                @endif
            </div>

            <div class="flex items-center gap-3 pt-4">
                <a href="/manager/groupsList" class="inline-flex items-center justify-center px-4 py-2 border border-border-light rounded-lg text-text-primary bg-white hover:bg-bg-tertiary transition-colors">
                    Отмена
                </a>
                {!! Form::submit('Сохранить изменения', ['class' => 'inline-flex items-center justify-center px-4 py-2 bg-[#279760] text-white rounded-lg hover:bg-[#1f7a4f] transition-colors']) !!}
            </div>
            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
