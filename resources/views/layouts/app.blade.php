<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title') | {{getAppName()}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="icon" href="{{ getSettingValue('favicon') }}" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>

    <link href="{{ asset('backend/css/vendor.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend/css/datatables.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend/css/fonts.css') }}" rel="stylesheet" type="text/css"/>
    @yield('page_css')
    <link href="{{ asset('backend/css/3rd-party.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend/css/3rd-party-custom.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ mix('assets/css/custom.css') }}" rel="stylesheet" type="text/css"/>
    @yield('css')
</head>
<body id="kt_body"
      class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed"
      style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px"
      data-new-gr-c-s-check-loaded="14.1025.0" data-gr-ext-installed="">
<div class="d-flex flex-column flex-root">
    <div class="page d-flex flex-row flex-column-fluid">
        @include('user_profile.edit_profile_modal')
        @include('user_profile.change_password_modal')
        <div class="infy-loader" id="overlay-screen-lock">
            @include('loader')
        </div>
        @include('layouts.sidebar')
        <div class="wrapper d-flex flex-column flex-row-fluid detail-kt-wrapper" id="kt_wrapper">
            @include('layouts.header')
            <div class="content d-flex flex-column flex-column-fluid content-padding-top" id="kt_content">
                @yield('header_toolbar')
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <div id="kt_content_container" class="container">
                        @yield('content')
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>

@routes
<script src="{{ asset('backend/js/vendor.js') }}"></script>
<script src="{{ asset('backend/js/datatables.js') }}"></script>
<script src="{{ asset('backend/js/3rd-party-custom.js') }}"></script>
<script src="{{ mix('assets/js/custom/custom.js') }}"></script>
<script src="{{ mix('assets/js/custom/helpers.js') }}"></script>

@yield('page_scripts')
<script>
    let defaultImage = "{{asset('assets/img/avatar.png') }}";
    const defaultImageUrl = '';
    (function ($) {
        $.fn.button = function (action) {
            if (action === 'loading' && this.data('loading-text')) {
                this.data('original-text', this.html()).html(this.data('loading-text')).prop('disabled', true);
            }
            if (action === 'reset' && this.data('original-text')) {
                this.html(this.data('original-text')).prop('disabled', false);
            }
        };
        $('#overlay-screen-lock').hide();
    }(jQuery));
    $(document).ready(function () {
        $('.alert').delay(5000).slideUp(300);
    });

    $(document).ready(function () {
        $('#kt_aside').removeClass('aside-hoverable');
    });

    $('.alert').delay(5000).slideUp(300, function () {
        $('.alert').attr('style', 'display:none');
    });

</script>
@yield('scripts')
<script>
    let profileUrl = "{{ url('profile') }}";
    let profileUpdateUrl = "{{ url('profile-update') }}";
    let changePasswordUrl = "{{ url('change-password') }}";
    let loggedInUserId = "{{ getLoggedInUserId() }}";
    let updateLanguageURL = "{{ url('update-language')}}";
    let currentCurrency = "{{ getCurrencySymbol()}}";
    let pdfDocumentImageUrl = "{{ url('assets/img/pdf.png') }}";
    let docxDocumentImageUrl = "{{ url('assets/img/doc.png') }}";
    let ajaxCallIsRunning = false;
    let userCurrentLanguage = "{{ getLoggedInUser()->language }}";
</script>
<script src="{{ mix('assets/js/user_profile/user_profile.js') }}"></script>
<script src="{{ mix('assets/js/sidebar_menu_search/sidebar_menu_search.js') }}"></script>
</body>
</html>
