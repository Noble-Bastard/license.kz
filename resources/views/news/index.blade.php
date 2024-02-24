@extends('new.layouts.app')

@section('content')
    <div class="news-page">
        <div class="news-page__header">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h2>{{$header}}</h2>
                    </div>
                    <div class="col-12 col-md-6 mt-3 mt-md-0">
                        <form class="news-page__header__form">
                            <input class="news-page__header__form__input search w-100 ui-autocomplete-left-input"
                                   placeholder="@lang('messages.pages.news.search_articles')" value="{{$filter->search}}"/>
                        </form>
                    </div>
                    <div class="col-12 col-md-9 text-center text-md-left mt-4 pt-3">
                        {!! $description !!}
                    </div>
                    <div class="col-12 mt-5 pt-4 mb-4 pb-3">
                        <div class="news-page__header__tags hide" id="newsTagsList">
                            <div class="col-3 float-right text-end">
                                <button class="btn-like-href" id="hideOrShowAllNewsTags">
                                    <span id="hideAllNewsTagsButton" class="d-none">
                                        <span class="pr-1">@lang('messages.pages.news.hide_all')</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             class="bi bi-chevron-up" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                                        </svg>
                                    </span>
                                    <span id="showAllNewsTagsButton">
                                        <span class="pr-1">@lang('messages.pages.news.show_all')</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                          <path fill-rule="evenodd"
                                                d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                    </span>
                                </button>
                            </div>

                            @foreach($tagsList as $tag)
                                <a href="#" data-tag="{{$tag->name}}"
                                   class="news-page__header__tags__tag {{in_array($tag->name, $filter->tags) ? 'active' : ''}}">#{{$tag->name}}</a>
                            @endforeach
                        </div>
                    </div>
                    <hr class="w-100">
                    <div class="col-12 mt-4 news-page__header__filters">
                        <div class="row">
                            <div class="col-12 col-md-4 pr-0">

                                <div>
                                    <span class="pr-3">@lang('messages.pages.news.sort_by_date'):</span>
                                    @if($filter->sort === 'asc')
                                    <a href="#"
                                       class="btn-like-href w-auto sort_by_date" data-sort="desc">@lang('messages.pages.news.new_at_first')</a>
                                    @else
                                        <a href="#"
                                           class="btn-like-href w-auto active sort_by_date" data-sort="asc">@lang('messages.pages.news.old_at_first')</a>
                                    @endif
                                </div>

                            </div>
                            <div class="col-12 col-md-8 pr-0"><span class="pr-3">@lang('messages.pages.news.sort_by_date'):</span>
                                <label for="newsFilterDateFrom">@lang('messages.pages.news.from')</label>

                                <input type="date" id="newsFilterDateFrom" name="trip-start"
                                       value="{{$filter->startDate}}">
                                <span class="pl-2 pr-2">-</span>
                                <label for="newsFilterDateFrom">@lang('messages.pages.news.to')</label>

                                <input type="date" id="newsFilterDateTo" name="trip-end" value="{{$filter->endDate}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="news-page__header__selected-tags">

                            <button class="news-page__header__selected-tags__clear-filters float-right btn-like-href">
                                @lang('messages.pages.news.clear_all_filters')<i
                                        class="fas fa-times-circle"></i>
                            </button>
                            @foreach($filter->tags as $filterTag)
                                <div class="news-page__header__selected-tags__tag d-inline-block">
                                    #{{$filterTag}}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mb-5">
            <div class="row">


{{--                @foreach($newsList as $news)--}}
{{--                    <div class="col-12 col-md-6 col-lg-4 mb-5">--}}
{{--                        @include('news._shortNews', ['news' => $news, 'route' => $route])--}}
{{--                    </div>--}}
{{--                @endforeach--}}

                    @foreach($newsList as $news)
                        @if($loop->index == 0)
                            <div class="col-12">
                                @include('news._shortNews', ['news' => $news, 'extendContent' => true])
                            </div>
                        @else
                            <div class="col-12 col-sm-6">
                                @include('news._shortNews', ['news' => $news, 'extendContent' => false])
                            </div>
                        @endif
                    @endforeach


                <div class="col-12">
                    <div class="d-flex justify-content-center">
                        {{$newsList->appends(request()->except('page'))->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let filter = {
            tags: {!!json_encode($filter->tags)!!},
            search: '{{$filter->search}}',
            startDate: '{{$filter->startDate}}',
            endDate: '{{$filter->endDate}}',
            sort: 'desc'
        }
        $("#hideOrShowAllNewsTags").click(function () {
            let newsTagsZone = $("#newsTagsList");
            if (newsTagsZone.hasClass("hide")) {
                newsTagsZone.removeClass("hide");
                $("#hideAllNewsTagsButton").removeClass("d-none");
                $("#showAllNewsTagsButton").addClass("d-none");
            } else {
                newsTagsZone.addClass("hide");
                $("#hideAllNewsTagsButton").addClass("d-none");
                $("#showAllNewsTagsButton").removeClass("d-none");
            }
        });

        $('#newsFilterDateFrom').change(function () {
            filter.startDate = $(this).val()
        })

        $('#newsFilterDateTo').change(function () {
            filter.endDate = $(this).val()
            showWithFilter()
        })

        $('.sort_by_date').click(function () {
            filter.sort = $(this).data('sort')
            showWithFilter()
        })

        let wto;
        $('.search').keyup(function() {
            clearTimeout(wto);
            wto = setTimeout(function() {
                filter.search = $('.search').val()
                showWithFilter()
            }, 500);
        });

        $('.news-page__header__tags__tag').on('click', function () {
            let tagIndex = filter.tags.findIndex(item => item === $(this).data('tag')+'')
            if (tagIndex === -1) {
                filter.tags.push($(this).data('tag'))
            } else {
                filter.tags.splice(tagIndex, 1)
            }

            showWithFilter()
        });

        $('.news-page__header__selected-tags__clear-filters').click(function () {
            filter = {
                tags: [],
                search: null,
                startDate: null,
                endDate: null,
                sort: 'desc'
            }

            showWithFilter()
        })

        function showWithFilter() {
            let filterStr = ''
            filterStr += filter.tags.map(function (el, idx) {
                return 'tags[]=' + el;
            }).join('&');

            if (filter.startDate) {
                if (filterStr) {
                    filterStr += '&'
                }
                filterStr += 'startDate=' + filter.startDate
            }
            if (filter.endDate) {
                if (filterStr) {
                    filterStr += '&'
                }

                filterStr += 'endDate=' + filter.endDate
            }

            if (filterStr) {
                filterStr += '&'
            }

            filterStr += 'sort=' + filter.sort

            if (filter.search) {
                if (filterStr) {
                    filterStr += '&'
                }
                filterStr += 'search=' + filter.search
            }


            if (filterStr) {
                filterStr = '?' + filterStr
            }

            window.location = '{{$route}}' + filterStr
        }
    </script>
@endsection