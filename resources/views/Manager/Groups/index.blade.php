@extends('new.layouts.manager')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Группы</h1>
        <div class="header-actions">
            <div class="search-bar">
                <img src="{{ asset('new/images/manager/icon-search.svg') }}" alt="Search"/>
                <input type="text" placeholder="Поиск по названию группы">
            </div>
            <button class="add-group-btn" data-bs-toggle="modal" data-bs-target="#newGroupModal">
                <img src="{{ asset('new/images/manager/icon-add.svg') }}" alt="Add Group"/>
                <span>Новая группа</span>
            </button>
        </div>
    </div>

    <div class="groups-list">
        @if(isset($groupList) && $groupList->isNotEmpty())
            @foreach($groupList as $group)
                <div class="group-card" data-bs-toggle="modal" data-bs-target="#editGroupModal"
                     data-group-id="{{ is_object($group) ? $group->id : '' }}"
                     data-group-name="{{ is_object($group) ? $group->name : '' }}"
                     data-group-members="{{ (is_object($group) && $group->members) ? $group->members->toJson() : '[]' }}">
                    <div class="group-header">
                        <h3 class="group-title">{{ is_object($group) ? $group->name : '' }}</h3>
                        <div class="group-actions">
                            <button class="btn btn-icon">
                                <img src="{{ asset('new/images/manager/icon-folder.svg') }}" alt="Edit Group"/>
                            </button>
                        </div>
                    </div>
                    <div class="group-members">
                        <div class="members-avatars">
                            @if(is_object($group) && !empty($group->members))
                                @foreach($group->members->take(4) as $member)
                                    <div class="member-avatar">
                                        <img src="{{ $member->avatar ?? asset('images/user1.png') }}" alt="{{ $member->full_name }}" />
                                    </div>
                                @endforeach
                                @if($group->members->count() > 4)
                                    <div class="more-members">
                                        <span>+{{ $group->members->count() - 4 }}</span>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <span class="members-count">{{ (is_object($group) && !empty($group->members)) ? $group->members->count() : 0 }} исполнителей</span>
                    </div>
                </div>
            @endforeach
        @else
            <p>Нет созданных групп.</p>
        @endif
    </div>

    @if(isset($groupList) && $groupList->hasPages())
        {{ $groupList->links('components.manager-pagination') }}
    @endif

    <!-- New Group Modal -->
    <div class="modal fade" id="newGroupModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Новая группа</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="newGroupForm" action="{{ route('Manager.groups.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control" name="name" placeholder="Название группы" required>
                        </div>

                        <div class="mb-3 search-container">
                            <img src="{{ asset('new/images/manager/icon-search-gray.svg') }}" alt="Search"/>
                            <input type="text" class="form-control" id="addExecutor" placeholder="Добавить исполнителя">
                        </div>
                        <div id="new-group-members-list" class="members-list">
                            {{-- Dynamically added members will appear here --}}
                        </div>
                        <div class="modal-actions">
                            <button type="submit" class="btn btn-primary w-100">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Group Modal -->
    <div class="modal fade" id="editGroupModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGroupModalTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editGroupForm" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <input type="text" class="form-control" id="editGroupName" name="name" required>
                        </div>
                        <div class="mb-3 search-container">
                            <img src="{{ asset('new/images/manager/icon-search-gray.svg') }}" alt="Search"/>
                            <input type="text" class="form-control" id="editExecutorSearch" placeholder="Добавить исполнителя">
                        </div>
                        <div id="edit-group-members-list" class="members-list">
                            {{-- Existing and new members will appear here --}}
                        </div>
                        <div class="modal-actions">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                            <button type="button" class="btn btn-link delete-group-btn">Удалить группу</button>
                        </div>
                    </form>
                    <form id="deleteGroupForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // New Group Modal Logic
            const newGroupModal = document.getElementById('newGroupModal');
            const addExecutorInput = document.getElementById('addExecutor');
            const newGroupMembersList = document.getElementById('new-group-members-list');
            // Mock data for executors - in a real app, this would be an AJAX call
            const executors = [
                {id: 1, name: 'Никита Худяков', avatar: '{{ asset('images/user1.png') }}'},
                {id: 2, name: 'Игорь Фадеев', avatar: '{{ asset('images/user1.png') }}'},
                {id: 3, name: 'Руслан Тошаков', avatar: '{{ asset('images/user1.png') }}'},
                {id: 4, name: 'Ирена Понарошку', avatar: '{{ asset('images/user1.png') }}'},
            ];

            function renderMemberItem(member, listElement) {
                const memberItem = document.createElement('div');
                memberItem.classList.add('member-item');
                memberItem.innerHTML = `
                    <img src="${member.avatar}" alt="${member.name}" class="member-avatar">
                    <span class="member-name">${member.name}</span>
                    <input type="hidden" name="members[]" value="${member.id}">
                    <button type="button" class="btn-icon remove-member-btn">
                        <img src="{{ asset('new/images/manager/icon-trash.svg') }}" alt="Remove"/>
                    </button>
                `;
                listElement.appendChild(memberItem);
                memberItem.querySelector('.remove-member-btn').addEventListener('click', () => {
                    memberItem.remove();
                });
            }

            addExecutorInput.addEventListener('keydown', function(event) {
                if (event.key === 'Enter' && this.value.trim() !== '') {
                    event.preventDefault();
                    // Mock adding first user from list for demonstration
                    const foundExecutor = executors.find(e => e.name.toLowerCase().includes(this.value.toLowerCase()));
                    if(foundExecutor) {
                        renderMemberItem(foundExecutor, newGroupMembersList);
                        this.value = '';
                    } else {
                        alert('Исполнитель не найден');
                    }
                }
            });


            // Edit Group Modal Logic
            const editGroupModal = document.getElementById('editGroupModal');
            editGroupModal.addEventListener('show.bs.modal', function (event) {
                const card = event.relatedTarget;
                const groupId = card.getAttribute('data-group-id');
                const groupName = card.getAttribute('data-group-name');
                const groupMembers = JSON.parse(card.getAttribute('data-group-members'));

                const modalTitle = editGroupModal.querySelector('.modal-title');
                const form = editGroupModal.querySelector('#editGroupForm');
                const nameInput = editGroupModal.querySelector('#editGroupName');
                const membersList = editGroupModal.querySelector('#edit-group-members-list');
                const deleteForm = document.getElementById('deleteGroupForm');

                modalTitle.textContent = groupName;
                nameInput.value = groupName;
                form.action = `/manager/groups/${groupId}`;
                deleteForm.action = `/manager/groups/${groupId}`;

                membersList.innerHTML = '';
                groupMembers.forEach(member => {
                    renderMemberItem({
                        id: member.id,
                        name: member.full_name,
                        avatar: member.avatar || '{{ asset('images/user1.png') }}'
                    }, membersList);
                });
            });

            document.querySelector('.delete-group-btn').addEventListener('click', function() {
                if(confirm('Вы уверены, что хотите удалить эту группу?')) {
                    document.getElementById('deleteGroupForm').submit();
                }
            });
        });
    </script>
@endsection