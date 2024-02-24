<form method="post" id="formDownloadCommercialOffer"
      action="{{route('services.sendCommercialOffer')}}">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"
                id="modalDownloadCommercialOfferLabel">{{trans('messages.services.commercialOffer.title')}}</h5>
          <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn-close"></button>
        </div>
        <div class="modal-body">

            @if(\Illuminate\Support\Facades\Auth::guest())
                <label>{{trans('messages.services.commercialOffer.non_auth_label')}}</label>
                <input class="form-control mb-2" type="email"
                       id="commercialOfferEmail"
                       placeholder="{{trans('messages.services.commercialOffer.email')}}"
                       required value=""/>
                <input class="form-control mb-2" type="tel"
                       id="commercialOfferPhone"
                       placeholder="{{trans('messages.services.commercialOffer.phone')}}"
                       required value=""/>
                <input class="form-control" type="text" id="commercialOfferName"
                       placeholder="{{trans('messages.services.commercialOffer.name')}}"
                       value=""/>
            @else
                <label>{{trans('messages.services.commercialOffer.auth_label')}}</label>
                <input class="form-control mb-2" type="email"
                       id="commercialOfferEmail"
                       placeholder="{{trans('messages.services.commercialOffer.email')}}"
                       required
                       value="{{\Illuminate\Support\Facades\Auth::user()->email}}"/>
                <input class="form-control mb-2" type="tel"
                       id="commercialOfferPhone"
                       placeholder="{{trans('messages.services.commercialOffer.phone')}}"
                       required
                       value="{{\Illuminate\Support\Facades\Auth::user()->profile->phone}}"/>
                <input class="form-control mb-2" type="text"
                       id="commercialOfferName"
                       placeholder="{{trans('messages.services.commercialOffer.name')}}"
                       value="{{\Illuminate\Support\Facades\Auth::user()->name}}"/>
            @endif
            <div class="form-check pl-0 mt-2">
                <input type="checkbox" class="form-check-input" checked id="offerCheck_commercial_offer">
                <label class="form-check-label" for="offerCheck_commercial_offer">
                    @lang('messages.pages.setPaymentType.i_accept_the_terms_of_the_public_offer_1')
                    <a href="{{route("offer")}}" target="_blank">
                        @lang('messages.pages.setPaymentType.i_accept_the_terms_of_the_public_offer_2')
                    </a>
                    {{--                                                @lang('messages.pages.setPaymentType.i_accept_the_terms_of_the_public_offer_3')--}}
                    <span
                            class="text-danger">*</span>
                </label>
            </div>
        </div>
        <div class="modal-footer">
            @if($isModal)
                <button type="button" class="btn btn-danger"
                        data-bs-dismiss="modal">{{trans('messages.all.cancel')}}</button>
            @endif
            <button type="submit"
                    class="btn btn-success formDownloadCommercialOffer_submit">{{trans('messages.all.send')}}</button>
        </div>
    </div>
</form>
