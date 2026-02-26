@extends('new.layouts.app')

@section('title', 'Управление новостями')

@section('content')
    <div class="container py-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="h3 fw-bold">@lang('messages.admin.news.newses')</h1>
                <p class="text-muted mb-0">
                    Управляйте новостями и публикациями
                </p>
            </div>
            <div>
                <a href="{{ route('admin.news.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-1"></i> @lang('messages.all.add')
                </a>
            </div>
        </div>

        <!-- News Table -->
        <div class="card shadow-sm mb-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>@lang('messages.admin.news.header')</th>
                                <th>@lang('messages.admin.news.news')</th>
                                <th>@lang('messages.admin.news.news_is_actual')</th>
                                <th>@lang('messages.all.order_num')</th>
                                <th>@lang('messages.admin.countries.country')</th>
                                <th>@lang('messages.all.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($newsList as $news)
                                <tr>
                                    <td>
                                        <div class="fw-medium">{{ $news->header }}</div>
                                    </td>
                                    <td>
                                        <p class="text-muted small mb-0" style="max-width: 300px;">
                                            {!! App\Data\Helper\Assistant::subStrCutByWord(str_replace(array("\n","\r"), '', strip_tags($news->content)), 200) !!}...
                                        </p>
                                    </td>
                                    <td>
                                        @if($news->is_actual == 1)
                                            <span class="badge bg-success">@lang('messages.all.yes')</span>
                                        @else
                                            <span class="badge bg-danger">@lang('messages.all.no')</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $news->orderNum }}</span>
                                    </td>
                                    <td>
                                        <span class="text-muted small">{{ $news->country_name }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-sm btn-outline-primary" title="Изменить фото"
                                                    onclick="changePreviewPhoto({{ $news->id }})">
                                                <i class="fas fa-image"></i>
                                            </button>
                                            <a href="{{ route('admin.news.edit', ['id' => $news->id]) }}" 
                                               class="btn btn-sm btn-outline-warning" title="Редактировать">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.news.commentList', ['id' => $news->id]) }}" 
                                               class="btn btn-sm btn-outline-success" title="Комментарии">
                                                <i class="fas fa-comments"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger" title="Удалить"
                                                    onclick="deleteNews({{ $news->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-newspaper fa-3x mb-3 d-block"></i>
                                            <p class="fw-medium fs-5">Новости не найдены</p>
                                            <p>Создайте первую новость для начала работы</p>
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
        @if($newsList->hasPages())
            <div class="d-flex justify-content-center">
                {{ $newsList->links() }}
            </div>
        @endif
    </div>

    <!-- Change Preview Photo Modal -->
    <div class="modal fade" id="previewPhotoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('messages.all.previewPhoto')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="previewPhotoForm" method="post" action="{{ route('admin.news.previewPhoto') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="newsId" id="selectedNewsId">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="previewPhoto" class="form-label">@lang('messages.all.previewPhoto')</label>
                            <input type="file" class="form-control" id="previewPhoto" name="previewPhoto" required>
                            <div class="form-text">Поддерживаются форматы: JPG, PNG, GIF. Максимальный размер: 5MB</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-success">@lang('messages.all.set')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    function changePreviewPhoto(newsId) {
        document.getElementById('selectedNewsId').value = newsId;
        var modal = new bootstrap.Modal(document.getElementById('previewPhotoModal'));
        modal.show();
    }

    function deleteNews(newsId) {
        if (!confirm('Вы уверены, что хотите удалить эту новость?')) {
            return;
        }

        fetch('/admin/news/' + newsId, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            }
        })
        .then(function(response) {
            if (response.ok) {
                alert('Новость удалена');
                window.location.reload();
            } else {
                throw new Error('Ошибка сервера');
            }
        })
        .catch(function(error) {
            alert('Не удалось удалить новость');
        });
    }
</script>
@endsection
