@extends('new.layouts.manager')

@section('content')
    <!-- Service Header -->
    <div class="service-detail-header">
        <div class="service-info">
            <h1 class="service-id">УСЛ-000319</h1>
            <div class="service-meta">
                <span class="creation-date">Создана 13.08.2024</span>
                <div class="status-badge">
                    <span class="status-dot in-progress"></span>
                    <span class="status-text">В работе</span>
                </div>
            </div>
        </div>
        
        <div class="service-actions">
            <button class="close-btn">
                <i class="bi bi-x"></i>
            </button>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="service-tabs">
        <button class="tab-btn active">Задачи</button>
        <button class="tab-btn">Сообщения с клиентом</button>
        <button class="add-task-btn">
            <i class="bi bi-plus"></i>
        </button>
    </div>

    <!-- Task Description -->
    <div class="task-description-card">
        <h2 class="task-title">Получение Индивидуального Идентификационного Номера (ИИН) и Электронно-цифровой подписи (ЭЦП) на директора юридического лица учредителя страны-участника ЕВРАЗЭС</h2>
        
        <div class="task-meta">
            <div class="meta-item">
                <span class="status-dot in-progress"></span>
                <span>В работе</span>
            </div>
            <div class="meta-item">
                <i class="bi bi-calendar"></i>
                <span>1 день</span>
            </div>
            <div class="meta-item">
                <i class="bi bi-clock"></i>
                <span>3 часа</span>
            </div>
        </div>
        
        <div class="assignee-info">
            <img src="{{ asset('images/user1.png') }}" alt="Assignee" class="assignee-avatar" />
            <span class="assignee-name">Иван Иванов</span>
        </div>
    </div>

    <!-- Documents Section -->
    <div class="documents-section">
        <h3 class="section-title">Документы</h3>
        <div class="documents-grid">
            <div class="document-card">
                <div class="document-icon excel">
                    <i class="bi bi-file-earmark-excel"></i>
                </div>
                <div class="document-info">
                    <div class="document-name">Agreement.docx</div>
                    <div class="document-category">Трудовые договора</div>
                </div>
            </div>
            
            <div class="document-card">
                <div class="document-icon excel">
                    <i class="bi bi-file-earmark-excel"></i>
                </div>
                <div class="document-info">
                    <div class="document-name">Agreement.docx</div>
                    <div class="document-category">Трудовые договора</div>
                </div>
            </div>
            
            <div class="document-card">
                <div class="document-icon excel">
                    <i class="bi bi-file-earmark-excel"></i>
                </div>
                <div class="document-info">
                    <div class="document-name">Agreement.docx</div>
                    <div class="document-category">Трудовые договора</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Comments Section -->
    <div class="comments-section">
        <div class="section-header">
            <h3 class="section-title">Комментарии</h3>
            <button class="collapse-btn">
                <i class="bi bi-chevron-up"></i>
            </button>
        </div>
        
        <div class="comments-list">
            <div class="comment-item">
                <div class="comment-avatar">
                    <img src="{{ asset('images/user1.png') }}" alt="User" />
                </div>
                <div class="comment-content">
                    <div class="comment-header">
                        <span class="comment-author">Константин Константинопольский</span>
                        <span class="comment-date">13.08.2024 18:58</span>
                    </div>
                    <div class="comment-text">Хорошо!</div>
                </div>
            </div>
            
            <div class="comment-item">
                <div class="comment-avatar">
                    <img src="{{ asset('images/user1.png') }}" alt="User" />
                </div>
                <div class="comment-content">
                    <div class="comment-header">
                        <span class="comment-author">Иван Иванов</span>
                        <span class="comment-date">13.08.2024 18:58</span>
                    </div>
                    <div class="comment-text">Это нужно сделать завтра</div>
                </div>
            </div>
        </div>
        
        <div class="comment-input">
            <input type="text" placeholder="Сообщение" class="form-control" />
            <button class="send-btn">
                <i class="bi bi-send"></i>
            </button>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            // Tab switching
            $('.tab-btn').click(function() {
                $('.tab-btn').removeClass('active');
                $(this).addClass('active');
            });
            
            // Collapse comments
            $('.collapse-btn').click(function() {
                const icon = $(this).find('i');
                if (icon.hasClass('bi-chevron-up')) {
                    icon.removeClass('bi-chevron-up').addClass('bi-chevron-down');
                    $('.comments-list, .comment-input').slideUp();
                } else {
                    icon.removeClass('bi-chevron-down').addClass('bi-chevron-up');
                    $('.comments-list, .comment-input').slideDown();
                }
            });
            
            // Send comment
            $('.send-btn').click(function() {
                const input = $('.comment-input input');
                const message = input.val().trim();
                if (message) {
                    // Add your comment sending logic here
                    console.log('Sending comment:', message);
                    input.val('');
                }
            });
        });
    </script>
@endsection
