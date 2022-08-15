@extends('web.layouts.front')
@section('title')
    {{ __('messages.appointments') }}
@endsection
@section('page_css')
    <link href="{{ mix('assets/css/custom.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ mix('assets/css/selectize-input.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')

    <!-- Start Page Banner Area -->
    <div class="page-banner-area">
        <div class="container">
            <div class="page-banner-content" data-speed="0.06" data-revert="true">
                <h2 data-aos="fade-right" data-aos-delay="30"
                    data-aos-duration="300">{{ __('messages.web_home.make_appointment') }}</h2>

                <ul data-aos="fade-right" data-aos-delay="70" data-aos-duration="700">
                    <li>
                        <a href="{{ route('front') }}">{{ __('messages.web_home.home') }}</a>
                    </li>
                    <li>{{ __('messages.web_home.make_appointment') }}</li>
                </ul>
            </div>

            <div class="page-banner-image" data-speed="0.08" data-revert="true">
                <img src="{{ asset('web_front/images/page-banner/banner-4.png') }}" data-aos="fade-left"
                     data-aos-delay="80" data-aos-duration="800" alt="image">
            </div>
        </div>
    </div>
    <!-- End Page Banner Area -->

    <!-- Start Appointment Form Area -->
    <div class="appointment-form-area ptb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12">
                    <div class="appointment-form-wrap" data-speed="0.05" data-revert="true">
                        <div class="wrap-title">
                            <h3>{{ __('messages.web_appointment.make_an_appointment') }}</h3>
                        </div>
                        {{ Form::open(['id' => 'appointmentForm']) }}
                        @include('web.home.appointment_fields')
                        {{ Form::close() }}
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 pt-100">
                    <div class="appointment-form-content top-zero">
                        <h3>{{ getFrontSettingValue(\App\Models\FrontSetting::APPOINTMENT,'appointment_title') }}</h3>
                        <p>{!! getFrontSettingValue(\App\Models\FrontSetting::APPOINTMENT,'appointment_description') !!}</p>

                        <div class="appointment-information">
                            <div class="icon">
                                <i class="ri-phone-fill"></i>
                            </div>
                            <h3>
                                <a href="tel:{{ getSettingValue('hospital_phone') }}">{{ getSettingValue('hospital_phone') }}</a>
                            </h3>
                            <span>{{ __('messages.web_appointment.call_now_and_get_a_free_consulting') }}</span>
                        </div>

                        <div class="appointment-social-information">
                            <span>
                                <a href="mailto:{{ getSettingValue('hospital_email') }}">{{getSettingValue('hospital_email') }}</a>
                            </span>
                            <ul class="social">
                                @if(getSettingValue('facebook_url') != '' && !empty(getSettingValue('facebook_url')))
                                    <li>
                                        <a href="{{ getSettingValue('facebook_url') }}" target="_blank">
                                            <i class="ri-facebook-fill"></i>
                                        </a>
                                    </li>
                                @endif
                                @if(getSettingValue('twitter_url') != '' && !empty(getSettingValue('twitter_url')))
                                    <li>
                                        <a href="{{ getSettingValue('twitter_url') }}" target="_blank">
                                            <i class="ri-twitter-fill"></i>
                                        </a>
                                    </li>
                                @endif
                                @if(getSettingValue('instagram_url') != '' && !empty(getSettingValue('instagram_url')))
                                    <li>
                                        <a href="{{ getSettingValue('instagram_url') }}" target="_blank">
                                            <i class="ri-instagram-line"></i>
                                        </a>
                                    </li>
                                @endif
                                @if(getSettingValue('linkedIn_url') != '' && !empty(getSettingValue('linkedIn_url')))
                                    <li>
                                        <a href="{{ getSettingValue('linkedIn_url') }}" target="_blank">
                                            <i class="ri-linkedin-line"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('appointments.templates.appointment_slot')
    </div>
    <!-- End Appointment Form Area -->
@endsection
@section('page_scripts')
    <script>
        let doctorDepartmentUrl = "{{ route('appointment.doctor.list') }}";
        let doctorUrl = "{{ route('appointment.doctors.list') }}";
        let appointmentSaveUrl = "{{ route('web.appointments.store') }}";
        let doctorScheduleList = "{{ url('appointment-doctor-schedule-list') }}";
        let isEdit = false;
        let isCreate = true;
        let getBookingSlot = "{{ route('appointment.get.booking.slot') }}";
    </script>
    <script src="{{ mix('assets/js/custom/custom.js') }}"></script>
    <script src="{{mix('assets/js/web/appointment.js')}}"></script>
@endsection
