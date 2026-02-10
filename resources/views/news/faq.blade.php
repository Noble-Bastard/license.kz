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
                                   placeholder="@lang('messages.pages.news.faq.search_articles')"
                                   value="{{$filter->search}}"/>
                        </form>
                    </div>
                    <div class="col-12 col-md-9 text-center text-md-left mt-4 pt-3">
                        {!! $description !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="container mb-5">
            <div class="row">
                <div class="col-12">
                    <div class="accordion pr-0" id="accordionFaq">
                        @foreach($faqList as $faq)
                            <div class="card">
                                <div class="card-header" id="heading{{$loop->index}}">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left" type="button"
                                                data-toggle="collapse" data-target="#collapse{{$loop->index}}" aria-expanded="false"
                                                aria-controls="collapse{{$loop->index}}">
                                            <div style="font-size: 18px">
                                            {{$faq->question}} <i class="fas fa-angle-down rotate-icon float-right"></i>
                                            </div>
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapse{{$loop->index}}" class="collapse" aria-labelledby="heading{{$loop->index}}"
                                     data-parent="#accordionFaq">
                                    <div class="card-body">
                                        {{$faq->answer}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-success new_question">@lang('messages.pages.news.faq.new_question.title')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalNewQuestion" tabindex="-1" role="dialog"
         aria-labelledby="modalNewQuestionLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" id="formFaqNewQuestion"
                  action="{{route('news.faq.new')}}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"
                            id="modalDownloadCommercialOfferLabel">{{trans('messages.pages.news.faq.new_question.title')}}</h5>
                      <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn-close"></button>
                    </div>
                    <div class="modal-body">
                        @if(\Illuminate\Support\Facades\Auth::guest())
                            <input class="form-control mb-2" type="email"
                                   id="faqEmail"
                                   placeholder="{{trans('messages.pages.news.faq.new_question.email')}}"
                                   required value=""/>
                            <input class="form-control mb-2" type="tel"
                                   id="faqPhone"
                                   placeholder="{{trans('messages.pages.news.faq.new_question.phone')}}"
                                   required value=""/>
                            <input class="form-control mb-2" type="text" id="faqName"
                                   placeholder="{{trans('messages.pages.news.faq.new_question.name')}}"
                                   value=""/>
                        @else
                            <input class="form-control mb-2" type="email"
                                   id="faqEmail"
                                   placeholder="{{trans('messages.pages.news.faq.new_question.email')}}"
                                   required
                                   value="{{\Illuminate\Support\Facades\Auth::user()->email}}"/>
                            <input class="form-control mb-2" type="tel"
                                   id="faqPhone"
                                   placeholder="{{trans('messages.pages.news.faq.new_question.phone')}}"
                                   required
                                   value="{{\Illuminate\Support\Facades\Auth::user()->profile->phone}}"/>
                            <input class="form-control mb-2" type="text"
                                   id="faqName"
                                   placeholder="{{trans('messages.pages.news.faq.new_question.name')}}"
                                   value="{{\Illuminate\Support\Facades\Auth::user()->name}}"/>
                        @endif
                        <textarea class="form-control mb-2" type="text"
                               id="faqQuestion"
                              required
                               placeholder="{{trans('messages.pages.news.faq.new_question.question')}}"></textarea>
                        <div class="form-check pl-0 mt-2">
                            <input type="checkbox" class="form-check-input" checked id="offerCheck_commercial_offer">
                            <label class="form-check-label" for="offerCheck_commercial_offer">
                                @lang('messages.pages.setPaymentType.i_accept_the_terms_of_the_public_offer_1')
                                <a href="{{route("offer")}}" target="_blank">
                                    @lang('messages.pages.setPaymentType.i_accept_the_terms_of_the_public_offer_2')
                                </a>
                                <span
                                        class="text-danger">*</span>
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-danger"
                                    data-bs-dismiss="modal">{{trans('messages.all.cancel')}}</button>
                        <button type="submit"
                                class="btn btn-success formFaqNewQuestion_submit">{{trans('messages.all.send')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalSendEmailConfirm" tabindex="-1" role="dialog"
         aria-labelledby="modalSendEmailConfirmLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    {{trans('messages.pages.news.faq.new_question.confirm')}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success"
                            data-bs-dismiss="modal">{{trans('messages.all.close')}}</button>
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

            window.location = '{{route('news.faq.list')}}' + filterStr
        }

        $('.new_question').click(function (event) {
            event.preventDefault();

            $('#modalNewQuestion').modal('show');
        })

        $("#formFaqNewQuestion").submit(function (event) {
            $('.formFaqNewQuestion_submit').attr('disabled', true);

            $.ajax({
                type: 'POST',
                url: '{{route('news.faq.new')}}',
                data: {
                    '_token': "{{ csrf_token() }}",
                    'email': $('#faqEmail').val(),
                    'phone': $('#faqPhone').val(),
                    'name': $('#faqName').val(),
                    'question': $('#faqQuestion').val(),
                },
                success: function (data) {
                    gtag('event', 'send', {'event_category': 'question'});

                    $('.formFaqNewQuestion_submit').attr('disabled', false);

                    $('#modalNewQuestion').modal('hide');
                    $('#modalSendEmailConfirm').modal('show');
                }
            });

            event.preventDefault();
        });
    </script>
@endsection
