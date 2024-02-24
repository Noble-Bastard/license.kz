@extends('new.layouts.app')

@section('content')
    {{--    {{dd($news)}}--}}
    <div class="full-news">
        <div class="container ">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="row full-news__header">
                        {{--                        <div class="col-12 mb-3">--}}
                        {{--                            <span class="full-news__header__sub-header">Видео от гос.органов</span>--}}
                        {{--                        </div>--}}
                        <div class="col-lg-9 col-12">
                            <div class="title-main text-left">
                                {{$news->header}}
                            </div>
                        </div>
                        <div class="col-lg-3 col-12 text-end">
                            <div class="full-news__header__date">
                                <span class="secondary-txt">
                                    {{\App\Data\Helper\Assistant::formatDate($news->create_date)}}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="full-news__information-block mt-1 ">
                        <div class="full-news__information-block__summary mb-4">
                            {{$news->lead}}
                        </div>
                        <div class="row mt-4 ">
                            <div class="col-5 pt-2 ">
                                <div class="full-news__information-block__number-of-comments mr-3 d-inline-block secondary-txt">
                                    <i class="fas fa-comment-dots"></i> <span
                                            class="pl-2">{{sizeof($news->comments)}}</span></div>
                                <div class="full-news__information-block__number-of-view ml-4 d-inline-block secondary-txt">
                                    <i
                                            class="far fa-eye"></i> <span class="pl-2">{{$news->news_view_count}}</span>
                                </div>
                            </div>
                            <div class="col-7 text-end">
                                <div class="full-news__information-block__social-network-links">
                                    <span class="mr-3 secondary-txt d-none d-lg-inline-block">@lang('messages.pages.news.share_via'):</span>
                                    <a class="ml-1 mr-1"
                                       href="https://www.facebook.com/sharer/sharer.php?u={{route('news.get', ['id' => $news->id])}}&amp;src=sdkpreparse">
                                        <img
                                                src="{{asset('images/share_icons/square-facebook-icon.png')}}">
                                    </a>
                                    <a class="ml-1 mr-1"
                                       href="whatsapp://send?text={{route('news.get', ['id' => $news->id])}}">
                                        <img
                                                src="{{asset('images/share_icons/square-whatsapp-icon.png')}}">
                                    </a>
                                    <a class="ml-1 mr-1"
                                       href="https://www.linkedin.com/sharing/share-offsite/?url={{route('news.get', ['id' => $news->id])}}">
                                        <img
                                                src="{{asset('images/share_icons/square-lin-icon.png')}}">
                                    </a>
                                    <a class="ml-1 mr-1"
                                       href="tg://msg?text={{route('news.get', ['id' => $news->id])}}">
                                        <img
                                                src="{{asset('images/share_icons/square-tg-icon.png')}}">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="full-news__content mt-4 pt-3">
                        {!! $news->content !!}
                    </div>
                </div>
                <div class="col-lg-4 col-12 d-flex align-content-start flex-wrap">
                    <div class="card w-100 text-center subscribe-card pt-4 pb-3">
                        <div class="card-body">
                            <h5 class="card-title">@lang('messages.pages.news.more_useful')</h5>
                            <span class="card-text secondary-txt">@lang('messages.pages.news.would_you_like_to_receive_more_useful')</span>
                            <form class="subscribe-card__form w-90 mx-auto  pt-2">
                                <input class="form-control w-100 mb-3" type="text" id="subscribe_name" name="name"
                                       placeholder="@lang('messages.admin.employee.first_name')">
                                <input class="form-control w-100 mb-3" type="text" id="subscribe_email" name="e-mail"
                                       placeholder="@lang('messages.admin.employee.email')">
                                <button type="button" id="subscribe_btn"
                                        class="w-100 btn btn-success pt-3 pb-3">@lang('messages.pages.news.subscribe')</button>
                            </form>
                            <div class="subscribe-card__follow-us-block">
                                @lang('messages.pages.news.follow_us_in_social_networks')
                                <div class="subscribe-card__follow-us-block__icons">
                                    <a href="https://instagram.com/upperlicense?igshid=6p3og64hk5wh"
                                       class="ml-1 mr-1"><img
                                                src="{{asset('images/social_network/instagram.png')}}"></a>
                                    <a href="https://t.me/joinchat/AAAAAE-dclw09LmhUPEw2w" class="ml-1 mr-1"><img
                                                src="{{asset('images/social_network/tele.png')}}"></a>
                                    <a href="https://m.facebook.com/pages/category/Business-Consultant/Upperlicense-110297470775409/"
                                       class="ml-1 mr-1"><img
                                                src="{{asset('images/social_network/facebook_black.png')}}"></a>
                                    <a href="https://kz.linkedin.com/company/upperlicense?trk=similar-pages_result-card_full-click"
                                       class="ml-1 mr-1"><img src="{{asset('images/social_network/linkedin.png')}}"></a>
                                    <a href="https://www.youtube.com/channel/UCvnqkPSxZjcqQ8cuKOyQj4A"
                                       class="ml-1 mr-1"><img src="{{asset('images/social_network/youtube.png')}}"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-5 mb-5">
                    <div class="full-news__comments">
                        <div class="full-news__tag-list mb-5">
                            @include('news._tags', ['class' => 'full-news__tag'])
                        </div>

                        <div class="full-news__comments__info border-bottom pb-4 mb-5">
                            <div class="row">
                                <div class="col-5 pt-2">
                                    <div class="d-inline-block likesBtn">
                                        <span class="heart {{$news->newsLike->count() > 0 ? "text-red" : ""}}">
                                            <i class="fas fa-heart"></i>
                                        </span>
                                        <span class="pl-2 cnt">{{$news->news_like_count}}</span>
                                    </div>
{{--                                    <div class="d-inline-block ml-5">--}}
{{--                                        <b>@lang('messages.news.comments')<span--}}
{{--                                                    class="ml-3 number-of-comments">{{sizeof($news->comments)}}</span></b>--}}
{{--                                    </div>--}}
                                </div>
                                <div class="col-7 ml-auto text-end">
                                    <div class="full-news__information-block__social-network-links">
                                        <span class="mr-4 d-none d-lg-inline-block">@lang('messages.pages.news.share_via'):</span>
                                        <a class="ml-1 mr-1"
                                           href="https://www.facebook.com/sharer/sharer.php?u={{route('news.get', ['id' => $news->id])}}&amp;src=sdkpreparse">
                                            <img
                                                    src="{{asset('images/share_icons/square-facebook-icon.png')}}">
                                        </a>
                                        <a class="ml-1 mr-1"
                                           href="whatsapp://send?text={{route('news.get', ['id' => $news->id])}}">
                                            <img
                                                    src="{{asset('images/share_icons/square-whatsapp-icon.png')}}">
                                        </a>
                                        <a class="ml-1 mr-1"
                                           href="https://www.linkedin.com/sharing/share-offsite/?url={{route('news.get', ['id' => $news->id])}}">
                                            <img
                                                    src="{{asset('images/share_icons/square-lin-icon.png')}}">
                                        </a>
                                        <a class="ml-1 mr-1"
                                           href="tg://msg?text={{route('news.get', ['id' => $news->id])}}">
                                            <img
                                                    src="{{asset('images/share_icons/square-tg-icon.png')}}">
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
{{--                        <div class="pr-4 pl-4">--}}
{{--                            @include('news._newsCommentList', ['commentList' => $news->comments, 'currentId' => null, 'currentLevel' => 0])--}}
{{--                            @if(Auth::check())--}}
{{--                                {!! Form::open(['url' => route('news.newsCommentStore'), 'method' => 'post', 'class' => 'form-horizontal', 'id'=>'news_comment_form']) !!}--}}
{{--                                <div class="row news-comments ">--}}
{{--                                    <div class="col-1 text-center">--}}
{{--                                        <img src="{{asset('images/avatarMini.png')}}" class="img-fluid">--}}
{{--                                    </div>--}}
{{--                                    <div class="col-11">--}}

{{--                                        <span class="user-name">--}}
{{--                                            <b>{{\Illuminate\Support\Facades\Auth::user()->profile->full_name}}</b>--}}
{{--                                        </span>--}}
{{--                                        <input type="hidden" name="news_id" value="{{$news->id}}"/>--}}
{{--                                        <input type="hidden" name="comment_id" id="comment_id" value=""/>--}}
{{--                                        <textarea class="form-control pl-4 pt-3 mt-4" id="comment_text"--}}
{{--                                                  name="comment_text"--}}
{{--                                                  placeholder="{{trans('messages.news.enter_text_placeholder')}}"--}}
{{--                                                  rows="5"></textarea>--}}
{{--                                        <div class="mt-3">--}}
{{--                                            <span style="display: none">--}}
{{--                                                {{trans('messages.news.replay_to')}}: <small--}}
{{--                                                        id="replay_comment_text"></small> <btn--}}
{{--                                                        class="btn btn-sm btn-danger float-right cancelReplay">{{trans('messages.all.cancel')}}</btn>--}}
{{--                                            </span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-12 mt-3 d-flex justify-content-end">--}}
{{--                                        <button type="submit" class="btn btn-success pl-5 pr-5">--}}
{{--                                            @lang('messages.executor.send')--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                {!! Form::close() !!}--}}
{{--                            @endif--}}
{{--                        </div>--}}
                    </div>


                </div>
            </div>
        </div>
        {{--        <div class="full-news__near-footer">--}}
        {{--            <div class="container z-index-primary full-news__near-footer__container">--}}
        {{--                <div class="row">--}}
        {{--                    <div class="col-5 pr-0">--}}
        {{--                        <h1><b>@lang('messages.pages.news.we_will_help_you_with_obtaining_license')</b></h1>--}}
        {{--                        <div class="full-news__near-footer__sub-header">--}}
        {{--                            @lang('messages.pages.news.we_will_advise_and_answer_any_questions')--}}
        {{--                        </div>--}}
        {{--                        <div class="row mt-5">--}}
        {{--                            <div class="col-6 mt-2 pr-2">--}}
        {{--                                <input class="form-control w-100" type="text" name="name"--}}
        {{--                                       placeholder="@lang('messages.admin.employee.first_name')">--}}
        {{--                            </div>--}}
        {{--                            <div class="col-6 mt-2 pl-2">--}}
        {{--                                <input class="form-control w-100" type="text" name="e-mail"--}}
        {{--                                       placeholder="@lang('messages.admin.employee.email')">--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                    <div class="col-7 pl-5">--}}
        {{--                        <div class="full-news__near-footer__textarea-container">--}}
        {{--                            <textarea class="form-control w-100 mb-1" rows="5"--}}
        {{--                                      placeholder="@lang('messages.pages.news.write_your_question_in_the_form_below_and_get_free_consultation_from_our_specialists')"></textarea>--}}
        {{--                        </div>--}}
        {{--                        <button class="btn btn-success mt-5 pl-5 pr-5">@lang('messages.layouts.order_call')</button>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--            <img class="about-us__near-footer__background"--}}
        {{--                 src="{{asset('/images/about-us_background/bg-near-footer.png')}}">--}}
        {{--        </div>--}}
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            $('.replay-comment').click(function () {
                $('#comment_id').val($(this).data('comment-id'));
                $('#replay_comment_text').html($(this).data('comment-text')).parent().show();
                $('#comment_text').focus();
            });

            $('.cancelReplay').click(function () {
                $('#comment_id').val('');
                $('#replay_comment_text').parent().hide();
            });

            $('.likesBtn').click(function () {
                $.ajax({
                    type: 'POST',
                    url: '/news/{{$news->id}}/{{$news->newsLike->count() > 0 ? 'unlike' : 'like'}}',
                    data: {
                        _token: '{!! csrf_token() !!}'
                    },
                    success: function (data) {
                        if ($('.likesBtn .heart').hasClass('text-red')) {
                            $('.likesBtn .cnt').html($('.likesBtn .cnt').html() * 1 - 1);
                        } else {
                            $('.likesBtn .cnt').html($('.likesBtn .cnt').html() * 1 + 1);
                        }

                        $('.likesBtn .heart').toggleClass('text-red')
                    }
                });
            });

            $('#subscribe_btn').click(function () {
                $.ajax({
                    type: 'POST',
                    url: '{{route('news.subscribe')}}',
                    data: {
                        _token: '{!! csrf_token() !!}',
                        name: $('#subscribe_name').val(),
                        email: $('#subscribe_email').val(),
                    },
                    success: function (data) {
                        alert('Подписка оформлена')
                        $('#subscribe_name').val('')
                        $('#subscribe_email').val('')
                    }
                });
            });
        });
    </script>
@endsection
