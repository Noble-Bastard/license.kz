@extends('new.layouts.app')

@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-12">
                <div class="title-main">
                    @lang('messages.admin.article.article_editor')
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row pb-3">
                            <div class="col-12">
                                <a class="btn btn-success" href="{{route('admin.article.create')}}"><i class="fa fa-plus-square"></i> @lang('messages.all.add')</a>
                            </div>
                        </div>
                        <div>
                            <table id="article" class="table table-striped table-responsive-sm col-12">
                                <thead>
                                <tr>
                                    <th>@lang('messages.admin.article.type')</th>
                                    <th>@lang('messages.admin.article.content')</th>
                                    <th>@lang('messages.admin.article.order_num')</th>

                                    <th>@lang('messages.admin.countries.country')</th>
                                    <th>@lang('messages.all.actions')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($articleList as $article)
                                    <tr>
                                        <td class="text-center">{{$article->article_type }}</td>
                                        <td>
                                            {!! App\Data\Helper\Assistant::subStrCutByWord(str_replace(array("\n","\r"), '', strip_tags($article->content)), 300) !!}
                                            ...
                                        </td>
                                        <td class="text-center">{{$article->orderNum }}</td>
                                        <td>{{$article->country_name }}</td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-bars"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{route('admin.article.edit', ['id' => $article->id])}}">@lang('messages.all.edit')</a>
                                                    <a class="dropdown-item" href="{{route('admin.article.destroy', $article->id)}}" data-method="delete">@lang('messages.all.delete')</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row padding-t-15">
                                <div class="col">
                                    {{ $articleList->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        //activeTab('article-list');
    </script>
@endsection