@extends('new.layouts.manager')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Исполнители</h1>
        <div class="header-actions">
            <div class="search-bar">
                <img src="{{ asset('new/images/manager/icon-search.svg') }}" alt="Search"/>
                <input type="text" placeholder="Поиск по номеру услуги или компании">
            </div>
        </div>
    </div>

    <div class="manager-table">
        <div class="table-header">
            <div class="table-header-cell name">Имя исполнителя</div>
            <div class="table-header-cell email">E-mail</div>
            <div class="table-header-cell phone">Телефон</div>
            <div class="table-header-cell groups">Группы</div>
            <div class="table-header-cell rate">Ставка в час, ₸</div>
            <div class="table-header-cell status">Активность</div>
        </div>

        @foreach($executorList as $executor)
            <div class="table-row" data-bs-toggle="modal" data-bs-target="#executorModal"
                 data-executor='@json($executor)'>
                <div class="table-cell name">
                    <div class="executor-avatar">
                        <img src="{{ asset('images/user1.png') }}" alt="{{ $executor->full_name }}"/>
                    </div>
                    <span class="executor-name">{{ $executor->full_name }}</span>
                </div>
                <div class="table-cell email">{{ $executor->email }}</div>
                <div class="table-cell phone">{{ $executor->phone ?? '+7 880 765 67 78' }}</div>
                <div class="table-cell groups">
                    @if($executor->groups && $executor->groups->isNotEmpty())
                        {{ $executor->groups->pluck('name')->implode(', ') }}
                    @else
                        -
                    @endif
                </div>
                <div class="table-cell rate hourlyRate_{!! $executor->id !!}">{{ $executor->hourlyRate ?? 140 }}</div>
                <div class="table-cell status">
                    <div class="status-indicator">
                        <span class="status-dot {{ $executor->is_active ? 'online' : 'offline' }}"></span>
                        <span class="status-text">{{ $executor->is_active ? 'В сети' : 'Не в сети' }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if(isset($executorList) && $executorList->hasPages())
        {{ $executorList->links('components.manager-pagination') }}
    @endif

    <!-- Executor Details Modal -->
    <div class="modal fade" id="executorModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="executor-modal-header">
                        <div class="executor-avatar">
                            <img src="" alt="Executor Avatar" id="modalExecutorAvatar"/>
                        </div>
                        <h5 class="modal-title" id="modalExecutorName"></h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="executorForm" method="post" action="">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="executorId" id="modalExecutorId"/>

                        <div class="mb-3">
                            <label for="modalHourlyRate" class="form-label">Ставка в час, ₸</label>
                            <input class="form-control" type="number" name="hourlyRate" id="modalHourlyRate" min="0" step="1" required/>
                        </div>

                        <div class="contact-info">
                            <h6 class="info-title">Контакты</h6>
                            <div class="mb-3">
                                <label for="modalExecutorEmail" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="modalExecutorEmail" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="modalExecutorPhone" class="form-label">Телефон</label>
                                <input type="text" class="form-control" id="modalExecutorPhone" name="phone">
                            </div>
                        </div>

                        <div class="groups-info">
                            <h6 class="info-title">Группы</h6>
                            <div class="mb-3 search-container">
                                <img src="{{ asset('new/images/manager/icon-search-gray.svg') }}" alt="Search"/>
                                <input type="text" class="form-control" id="modalGroupSearch" placeholder="Добавить в группу">
                            </div>
                            <div id="modal-executor-groups-list" class="members-list">
                                {{-- Executor's groups will be rendered here --}}
                            </div>
                        </div>

                        <div class="modal-actions justify-content-between mt-4">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                            <button type="button" class="btn btn-secondary-outline">Связаться с исполнителем</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const executorModal = document.getElementById('executorModal');
    executorModal.addEventListener('show.bs.modal', function (event) {
        const row = event.relatedTarget;
        const executorData = JSON.parse(row.getAttribute('data-executor'));

        const modalAvatar = document.getElementById('modalExecutorAvatar');
        const modalName = document.getElementById('modalExecutorName');
        const modalId = document.getElementById('modalExecutorId');
        const modalHourlyRate = document.getElementById('modalHourlyRate');
        const modalEmail = document.getElementById('modalExecutorEmail');
        const modalPhone = document.getElementById('modalExecutorPhone');
        const modalGroupsList = document.getElementById('modal-executor-groups-list');
        const form = document.getElementById('executorForm');

        modalAvatar.src = '{{ asset('images/user1.png') }}'; // Replace with actual avatar if available
        modalName.textContent = executorData.full_name;
        modalId.value = executorData.id;
        modalHourlyRate.value = executorData.hourlyRate || 140;
        modalEmail.value = executorData.email;
        modalPhone.value = executorData.phone || '';
        form.action = `/manager/executor/${executorData.id}`;

        modalGroupsList.innerHTML = '';
        if (executorData.groups && executorData.groups.length > 0) {
            executorData.groups.forEach(group => {
                const groupItem = document.createElement('div');
                groupItem.classList.add('member-item');
                groupItem.innerHTML = `
                    <span class="member-name">${group.name}</span>
                    <input type="hidden" name="groups[]" value="${group.id}">
                    <button type="button" class="btn-icon remove-member-btn">
                        <img src="{{ asset('new/images/manager/icon-trash.svg') }}" alt="Remove"/>
                    </button>
                `;
                modalGroupsList.appendChild(groupItem);
                groupItem.querySelector('.remove-member-btn').addEventListener('click', () => {
                    groupItem.remove();
                });
            });
        }
    });

    // Form submission (basic example)
    document.getElementById('executorForm').addEventListener('submit', function(e) {
        e.preventDefault();
        // Here you would typically use AJAX to submit the form data
        alert('Данные сохранены (демо)');
        const modal = bootstrap.Modal.getInstance(executorModal);
        modal.hide();

        // Update the table row with new data
        const executorId = document.getElementById('modalExecutorId').value;
        const newRate = document.getElementById('modalHourlyRate').value;
        const rowToUpdate = document.querySelector(`.hourlyRate_${executorId}`);
        if(rowToUpdate) {
            rowToUpdate.textContent = newRate;
        }
    });
});
</script>
@endsection
