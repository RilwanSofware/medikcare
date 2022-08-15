<!-- Start Footer Area -->
<footer class="footer-area pt-100">
    <div class="container">
        <div class="row justify-content-lg-center">
            <div class="col-lg-3 col-md-6">
                <div class="single-footer-widget">
                    <div class="widget-logo">
                        <a href="{{ route('front') }}"><img src="{{ getLogoUrl() }}" alt="image"></a>
                    </div>

                    <p>{!! getSettingValue('about_us') !!}</p>

                </div>
            </div>
            <div class="col-lg-3 col-sm-6 d-lg-block d-sm-none d-block">
                <div class="single-footer-widget ps-5">
                    <h3>{{ __('messages.web_menu.useful_link') }}</h3>

                    <ul class="quick-links">
                        <li>
                            <a href="{{ url('/') }}">{{ __('messages.web_home.home') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('our-services') }}">{{ __('messages.web_home.services') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('our-doctors') }}">{{ __('messages.web_home.doctors') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('aboutUs') }}">{{ __('messages.web_menu.about') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}">{{ __('messages.web_home.contact') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-footer-widget ps-3">
                    <h3>{{ __('messages.web_menu.contact_information') }}</h3>

                    <ul class="footer-information">
                        <li>
                            <i class="ri-phone-fill"></i>
                            <h4>
                                <a href="tel:{{ getSettingValue('hospital_phone') }}">{{ getSettingValue('hospital_phone') }}</a>
                            </h4>
                            <span>{{ __('messages.web_contact.call_today') }}</span>
                        </li>

                        <li>
                            <i class="ri-time-line"></i>
                            <h4>{{ getSettingValue('hospital_from_time') }}</h4>
                            <span>{{ __('messages.web_contact.open_hours') }}</span>
                        </li>

                        <li>
                            <i class="ri-map-pin-line"></i>
                            <h4>{{ getSettingValue('hospital_address') }}</h4>
                            <span>{{ __('messages.web_contact.our_location') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 d-lg-none d-sm-block d-none">
                <div class="single-footer-widget ps-5">
                    <h3>{{ __('messages.web_menu.useful_link') }}</h3>

                    <ul class="quick-links">
                        <li>
                            <a href="{{ url('/') }}">{{ __('messages.web_home.home') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('our-services') }}">{{ __('messages.web_home.services') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('our-doctors') }}">{{ __('messages.web_home.doctors') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('aboutUs') }}l">{{ __('messages.web_menu.about') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}">{{ __('messages.web_home.contact') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="copyright-area">
        <div class="container">
            <div class="copyright-area-content">
                <p>
                    {{ __('messages.web_menu.copyright') }}
                    © {{ date('Y') }} {{ __('messages.web_menu.all_rights_reserved_by') }}
                    <a href="{{config('app.url')}}"> {{ getAppName() }}</a>
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer Area -->
