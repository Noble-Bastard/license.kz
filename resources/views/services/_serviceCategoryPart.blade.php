<div class="row services-background">
    {{--        <div class="col-12">--}}
    {{--                <div class="title-main">--}}
    {{--                    @lang('messages.services.services')--}}

    {{--                </div>--}}
    {{--        </div>--}}
    <div class="col-12">
        <div class="row background-img-padding">
            @foreach($categoryList as $category)
                <div class="col-3 col-md-6 col-xl-4 mb-3 pr-xl-0 service-list">
                    <div class="serviceCategory hoverable">
                        <a class="" href="{{route('services.groupList', ['Id' => $category->id])}}">
                            <div class="centerImg">
                                <div class="col-md-2 col-12 pl-md-0 pr-md-3 mr-md-1 d-md-inline-block">
                                    <img src="data:image/svg+xml,%3Csvg%20xmlns=%22http://www.w3.org/2000/‌​svg%22/%3E"
                                         class="d-none d-md-block"
                                         style="content:url('{{asset('images/category_icon/category-'.$category->id.'.png')}}')">
                                    <img src="data:image/svg+xml,%3Csvg%20xmlns=%22http://www.w3.org/2000/‌​svg%22/%3E"
                                         class="d-block d-md-none w-90 mx-auto mb-2"
                                         style="content:url('{{asset('images/category_icon_mobile/category-'.$category->id.'.png')}}')">
                                </div>
                                {{(\Illuminate\Support\Facades\App::getLocale() == \App\Data\Helper\LocaleList::English ? $category->name_en : $category->name)}}
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>