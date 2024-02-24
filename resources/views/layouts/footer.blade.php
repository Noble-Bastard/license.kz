<footer class="footer mt-auto @yield('footer__background')">
    <div class="container">
        <div class="row mr-0 ml-0">
            <div class="col-xl-5  col-12 row mr-md-0 pl-md-0 order-3 order-xl-1 footer__logo__container">
                <div class="col-12 col-md-7 mt-4 mt-md-0 pt-3 pt-md-0">
                    <div class="footer_logo mt-1 mt-md-0">
                        <img src="{{asset('images/white-green-logo.png')}}">
                    </div>
                </div>
                <div class="col-md-5 col-10 mt-3 mt-md-0">
                    <span class="footer_dialogue">@lang('messages.all.footer-dialogue-text')</span>
                </div>
            </div>

            <div class="col-xl-3  col-7 order-1 order-xl-2 footer_social-media_container">
                <div class="footer_social-media text-xl-center text-left">
                    <a href="https://instagram.com/upperlicense?igshid=6p3og64hk5wh" class="footer_social_media-icon"><img src="{{asset('images/social_network/instagram.png')}}"></a>
                    <a href="https://t.me/joinchat/AAAAAE-dclw09LmhUPEw2w" class="footer_social_media-icon"><img src="{{asset('images/social_network/tele.png')}}"></a>
                    <a href="https://m.facebook.com/pages/category/Business-Consultant/Upperlicense-110297470775409/" class="footer_social_media-icon"><img src="{{asset('images/social_network/facebook_black.png')}}"></a>
                    <a href="https://kz.linkedin.com/company/upperlicense?trk=similar-pages_result-card_full-click" class="footer_social_media-icon"><img src="{{asset('images/social_network/linkedin.png')}}"></a>
                    <a href="https://www.youtube.com/channel/UCvnqkPSxZjcqQ8cuKOyQj4A" class="footer_social_media-icon"><img src="{{asset('images/social_network/youtube.png')}}"></a>
                </div>
            </div>

            <div class="col-xl-4 c col-5 order-2 order-xl-3 footer_contact">
                <div class="footer_info text-end">
                    <div><a href="tel:+77471350000" onclick="gtag('event', 'click', {'event_category': 'phone'});"><span class="footer_info_text">+7 747 135 0000</span><img src="{{asset('images/footer-phone-call.png')}}"></a></div>
                    <div><a href="mailto:info@license.kz"><span class="footer_info_text">info@license.kz</span><img src="{{asset('images/footer-email-icon.png')}}"></a></div>
                </div>
            </div>
        </div>
        <div class="row mr-0 ml-0">
            <div class="col-12 mt-3">
                <span class="footer_dialogue">
                    @lang('messages.all.footer-disclaimer')
                </span>
            </div>
        </div>
    </div>
</footer>