<footer class="site-footer">
    <div class="site-footer__inner">
        <!-- Three-column layout -->
        <div class="footer-columns">
            <!-- Left column - Logo and disclaimer -->
            <div class="footer-column footer-column--left">
                <div class="footer-logo-section">
                    <a href="/" class="footer-logo">
                        <img src="{{asset('/new/images/icons/Frame7.png')}}" alt="UPPERLICENSE logo"/>
                    </a>
                </div>
                <div class="footer-disclaimer-text">
                    <p>UPPERLICENSE не является государственным органом и не представляет какой-либо официальный орган. Все названия продуктов, логотипы и бренды являются собственностью их владельцев. Все названия компаний, органов власти, реестра, продуктов и услуг, используемые на этом веб-сайте, используются только в целях идентификации. Использование этих названий, логотипов и брендов не означает одобрения.</p>
                </div>
            </div>

            <!-- Center column - Contact and Menu -->
            <div class="footer-column footer-column--center">
                <!-- Contact Center section -->
                <div class="footer-section">
                    <h3 class="footer-caption">Контактный центр</h3>
                    <a href="tel:+77471350000" class="footer-contact-large">+7 (747) 135-0000</a>
                </div>
                
                <!-- Menu section -->
                <div class="footer-section">
                    <h3 class="footer-caption">Меню</h3>
                    <ul class="footer-menu">
                        <li><a href="{{route('about')}}" class="footer-menu-link">О компании</a></li>
                        <li><a href="#" class="footer-menu-link">Регистрация компании</a></li>
                        <li><a href="#" class="footer-menu-link">Лицензирование</a></li>
                        <li><a href="#" class="footer-menu-link">Открытие счетов</a></li>
                        <li><a href="{{route('news.list')}}" class="footer-menu-link">Блог</a></li>
                    </ul>
                </div>
            </div>

            <!-- Right column - Email and Social -->
            <div class="footer-column footer-column--right">
                <!-- Email section -->
                <div class="footer-section">
                    <h3 class="footer-caption">Напишите на почту</h3>
                    <a href="mailto:info@license.kz" class="footer-contact-large">info@license.kz</a>
                </div>
                
                <!-- Social Media section -->
                <div class="footer-section">
                    <h3 class="footer-caption">Мы в социальных сетях</h3>
                    <div class="footer-social-icons">
                        <a href="#" class="footer-social-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" fill="#191E1D"/>
                            </svg>
                        </a>
                        <a href="#" class="footer-social-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" fill="#191E1D"/>
                            </svg>
                        </a>
                        <a href="#" class="footer-social-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" fill="#191E1D"/>
                            </svg>
                        </a>
                        <a href="#" class="footer-social-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" fill="#191E1D"/>
                            </svg>
                        </a>
                        <a href="#" class="footer-social-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.820 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z" fill="#191E1D"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sticky footer legal section -->
        <div class="footer-legal">
            
            <div class="footer-legal__bar">
                <span class="footer-copyright">©2023 UPPERLICENSE</span>
                <a href="#" class="footer-privacy">Политика конфиденциальности</a>
            </div>
        </div>
    </div>
</footer>

<style>
/* Site Footer Styles */
.site-footer {
    background: #FFFFFF;
    border-top: 1px solid #E8E8E8;
    font-family: 'Manrope', sans-serif;
}

.site-footer__inner {
    max-width: 1320px;
    margin: 0 auto;
    padding: 30px 40px 20px;
    min-height: 300px;
    display: flex;
    flex-direction: column;
}

.footer-columns {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 30px;
    flex: 1;
}

.footer-column {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.footer-column--left {
    gap: 20px;
}

.footer-logo-section {
    margin-bottom: 10px;
}

.footer-logo img {
    height: 80px;
}

.footer-disclaimer-text p {
    font-size: 10px;
    color: #191E1D;
    opacity: 0.4;
    line-height: 1.5;
    margin: 0;
    font-family: 'Manrope', sans-serif;
}

.footer-section {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.footer-caption {
    font-size: 14px;
    font-weight: 400;
    color: #999999;
    margin: 0;
    font-family: 'Manrope', sans-serif;
}

.footer-contact-large {
    font-size: 28px;
    font-weight: 700;
    color: #191E1D;
    text-decoration: none;
    font-family: 'Manrope', sans-serif;
    line-height: 1.2;
}

.footer-contact-large:hover {
    color: #191E1D;
    text-decoration: none;
}

.footer-menu {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.footer-menu-link {
    font-size: 14px;
    color: #191E1D;
    text-decoration: none;
    font-family: 'Manrope', sans-serif;
    line-height: 1.4;
}

.footer-menu-link:hover {
    color: #191E1D;
    text-decoration: none;
}

.footer-social-icons {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.footer-social-icon {
    width: 40px;
    height: 40px;
    border: 1px solid #E8E8E8;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: border-color 0.3s ease;
}

.footer-social-icon:hover {
    border-color: #191E1D;
}

.footer-legal {
    margin-top: auto;
    display: flex;
    flex-direction: column;
    gap: 15px;
    padding-top: 15px;
}

.footer-disclaimer p {
    font-size: 10px;
    color: #191E1D;
    opacity: 0.4;
    line-height: 1.5;
    margin: 0;
    font-family: 'Manrope', sans-serif;
}

.footer-legal__bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid #E8E8E8;
    padding-top: 15px;
}

.footer-copyright,
.footer-privacy {
    font-size: 12px;
    color: #191E1D;
    opacity: 0.4;
    font-family: 'Manrope', sans-serif;
}

.footer-privacy {
    text-decoration: none;
}

.footer-privacy:hover {
    color: #191E1D;
    opacity: 0.6;
    text-decoration: none;
}

/* Mobile responsiveness */
@media (max-width: 991.98px) {
    .footer-columns {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .site-footer__inner {
        padding: 30px 20px;
    }
    
    .footer-contact-large {
        font-size: 24px;
    }
    
    .footer-column--left {
        order: -1;
    }
    
    .footer-legal__bar {
        flex-direction: column;
        gap: 10px;
        text-align: center;
    }
}
</style>

@section('footer-js')
    <script>
        $(".language-footer-links li ul").hide();
        $(".language-footer-icons, .language-footer-links").hover(
            function () {
                $(".arrow-down").stop().toggle();
                $(".arrow-up").stop().toggle();
                $(".language-footer-links li ul").stop().fadeToggle(300);
            }
        );

    </script>
@endsection
