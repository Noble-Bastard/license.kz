@extends('new.layouts.app')

@section('title', 'Рабочий календарь')

@section('content')
    <div class="container py-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="h3 fw-bold">@lang('messages.admin.workingCalendar.working_calendar')</h1>
                <p class="text-muted mb-0">
                    Настройте рабочие дни недели и календарь событий
                </p>
            </div>
            <div>
                <a href="{{ route('admin.workingCalendar.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-1"></i> @lang('messages.all.add')
                </a>
            </div>
        </div>

        <!-- Working Days Configuration -->
        <div class="card shadow-sm mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-calendar-week me-2 text-success"></i>
                    Настройка рабочих дней недели
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.workingCalendar.updateWeekDays', $weekWorkingDay->id) }}">
                    @csrf
                    @method('PUT')
                    <input name="id" type="hidden" value="{{ $weekWorkingDay->id }}"/>
                    
                    <div class="row g-4">
                        <div class="col-md-3">
                            <h6 class="text-uppercase text-muted small fw-bold mb-3">Будние дни</h6>
                            
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" id="mon"
                                       name="mon" value="1"
                                       {{ $weekWorkingDay->mon == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="mon">@lang('messages.all.week_days.monday')</label>
                            </div>
                            
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" id="tue"
                                       name="tue" value="1"
                                       {{ $weekWorkingDay->tue == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="tue">@lang('messages.all.week_days.tuesday')</label>
                            </div>
                            
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" id="wed"
                                       name="wed" value="1"
                                       {{ $weekWorkingDay->wed == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="wed">@lang('messages.all.week_days.wednesday')</label>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <h6 class="text-uppercase text-muted small fw-bold mb-3">&nbsp;</h6>
                            
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" id="thu"
                                       name="thu" value="1"
                                       {{ $weekWorkingDay->thu == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="thu">@lang('messages.all.week_days.thursday')</label>
                            </div>
                            
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" id="fri"
                                       name="fri" value="1"
                                       {{ $weekWorkingDay->fri == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="fri">@lang('messages.all.week_days.friday')</label>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <h6 class="text-uppercase text-muted small fw-bold mb-3">Выходные</h6>
                            
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" id="sat"
                                       name="sat" value="1"
                                       {{ $weekWorkingDay->sat == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="sat">@lang('messages.all.week_days.saturday')</label>
                            </div>
                            
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" id="sun"
                                       name="sun" value="1"
                                       {{ $weekWorkingDay->sun == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="sun">@lang('messages.all.week_days.sunday')</label>
                            </div>
                        </div>
                        
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i> @lang('messages.all.change')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Calendar Events -->
        <div class="card shadow-sm mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-calendar-alt me-2 text-success"></i>
                    События календаря
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>@lang('messages.all.decsription')</th>
                                <th>@lang('messages.admin.workingCalendar.start_date')</th>
                                <th>@lang('messages.admin.workingCalendar.end_date')</th>
                                <th>@lang('messages.admin.workingCalendar.type')</th>
                                <th>@lang('messages.all.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($workingCalendarList as $workingCalendar)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-success bg-opacity-10 d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                                <i class="fas fa-calendar text-success"></i>
                                            </div>
                                            <div class="fw-medium">{{ $workingCalendar->decsription }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-medium">{{ \Carbon\Carbon::parse($workingCalendar->start_date)->format('d.m.Y') }}</div>
                                        <div class="text-muted small">{{ \Carbon\Carbon::parse($workingCalendar->start_date)->format('l') }}</div>
                                    </td>
                                    <td>
                                        <div class="fw-medium">{{ \Carbon\Carbon::parse($workingCalendar->end_date)->format('d.m.Y') }}</div>
                                        <div class="text-muted small">{{ \Carbon\Carbon::parse($workingCalendar->end_date)->format('l') }}</div>
                                    </td>
                                    <td>
                                        @php
                                            $dayTypeName = $workingCalendar->dayType->name ?? 'Неизвестно';
                                            $badgeClass = 'bg-secondary';
                                            
                                            if (str_contains(strtolower($dayTypeName), 'выходной') || str_contains(strtolower($dayTypeName), 'отпуск')) {
                                                $badgeClass = 'bg-danger';
                                            } elseif (str_contains(strtolower($dayTypeName), 'рабочий')) {
                                                $badgeClass = 'bg-success';
                                            } elseif (str_contains(strtolower($dayTypeName), 'сокращенный')) {
                                                $badgeClass = 'bg-warning text-dark';
                                            }
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ $dayTypeName }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.workingCalendar.edit', ['id' => $workingCalendar->id]) }}" 
                                               class="btn btn-sm btn-outline-warning" title="Редактировать">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            
                                            <form method="POST" 
                                                  action="{{ route('admin.workingCalendar.destroy', $workingCalendar->id) }}" 
                                                  style="display: inline;"
                                                  onsubmit="return confirm('Вы уверены, что хотите удалить это событие?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Удалить">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-calendar-times fa-3x mb-3 d-block"></i>
                                            <p class="fw-medium fs-5">События календаря не найдены</p>
                                            <p>Добавьте первое событие для начала работы</p>
                                            <a href="{{ route('admin.workingCalendar.create') }}" class="btn btn-success mt-2">
                                                <i class="fas fa-plus me-1"></i> Добавить событие
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        @if($workingCalendarList->hasPages())
            <div class="d-flex justify-content-center">
                {{ $workingCalendarList->links() }}
            </div>
        @endif
    </div>
@endsection
