@extends('new.layouts.app')

@section('title')
    Поиск ТНВЭД
@endsection

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
                                   placeholder="@lang('messages.pages.oked.search')"
                                   value="{{$filter->search}}"/>
                        </form>
                    </div>
                    <div class="col-12 col-md-9 text-center text-md-left mt-4 pt-3">
                        {!! $description !!}
                        <div class="news-page__subheader">@lang('messages.pages.oked.fields.note1')</div>
                        <div class="news-page__subheader">@lang('messages.pages.oked.fields.note2')</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mb-5">
            <div class="row">
                <div class="col-12">
                    @if($okedList)
                        <div class="accordion pr-0" id="accordionFaq">
                            <table class="table">
                                <thead>
                                <tr>
                                    <td class="col-4">@lang('messages.pages.oked.fields.code')</td>
                                    <td class="col-8">@lang('messages.pages.oked.fields.description')</td>
                                    <td class="col-8">@lang('messages.pages.oked.fields.note')</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($okedList as $oked)
                                    <tr>
                                        <td>{{$oked->code}}</td>
                                        <td>{{$oked->description}}</td>
                                        <td>{{$oked->note}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <h5 class="text-center">@lang('messages.pages.oked.please_search')</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let filter = {
            search: '{{$filter->search}}',
        }

        let wto;
        $('.search').keyup(function () {
            clearTimeout(wto);
            wto = setTimeout(function () {
                filter.search = $('.search').val()
                showWithFilter()
            }, 500);
        });

        function showWithFilter() {
            let filterStr = ''

            if (filter.search) {
                if (filterStr) {
                    filterStr += '&'
                }
                filterStr += 'search=' + filter.search
            }


            if (filterStr) {
                filterStr = '?' + filterStr
            }

            window.location = '{{route('oked.index')}}' + filterStr
        }
    </script>
@endsection