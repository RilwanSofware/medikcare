@extends('layouts.auth_app')

@section('title')
    Register
@endsection

@section('content')
    @include('flash::message')
    <!--begin::Authentication - Sign-up -->
    @php
        $style = 'style=background-image:url('.asset('assets/img/progress-hd.png').')';
    @endphp
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" {{ $style }}>
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <a href="{{ route('front') }}" class="mb-12">
                <img alt="Logo" src="{{ getSettingValue('favicon') }}" class="h-45px"/>
            </a>
            <div class="w-lg-600px bg-white rounded shadow-sm p-10 p-lg-15 mx-auto">
                <form method="post" action="{{ url('/register') }}" class="form w-100 form-submit" id="kt_sign_up_form">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mb-10 text-center">
                        <h1 class="text-dark mb-3">Patient Registration</h1>
                        <div class="text-gray-400 fw-bold fs-4">Already have an account?
                            <a href="{{ route('login') }}" class="link-primary fw-bolder">Sign in here</a></div>
                    </div>
                    <div class="d-flex align-items-center mb-10">
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                        <span class="fw-bold text-gray-400 fs-7 mx-2">OR</span>
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                    </div>
                    <div class="row fv-row mb-7">
                        <div class="col-xl-6">
                            <label class="form-label fw-bolder text-dark fs-6">First Name:
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-lg form-control-solid"
                                   name="first_name" value="{{ old('first_name') }}"
                                   onkeypress='if (/\s/g.test(this.value)) this.value = this.value.replace(/\s/g,"")'
                                   placeholder="" required>
                        </div>
                        <div class="col-xl-6">
                            <label class="form-label fw-bolder text-dark fs-6">Last Name:
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-lg form-control-solid"
                                   name="last_name" value="{{ old('last_name') }}"
                                   onkeypress='if (/\s/g.test(this.value)) this.value = this.value.replace(/\s/g,"")'
                                   placeholder="" required>
                        </div>
                    </div>
                    <div class="row fv-row mb-7">
                        <div class="col-xl-6">
                            <label class="form-label fw-bolder text-dark fs-6">Email:
                                <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control form-control-lg form-control-solid"
                                   name="email" value="{{ old('email') }}" placeholder="" required>
                        </div>
                        <div class="col-xl-6">
                            <label class="form-label fw-bolder text-dark fs-6">Phone Number:
                                <span class="text-danger">*</span>
                            </label>
                            <input type="phone" class="form-control form-control-lg form-control-solid"
                                   name="phone" value="{{ old('phone') }}" placeholder=""
                                   minlength="10"
                                   maxlength="10"
                                   onkeyup='if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")'
                                   onkeypress='if (/\s/g.test(this.value)) this.value = this.value.replace(/\s/g,"")'
                                   required>
                        </div>
                    </div>
                    <div class="row mb-7 fv-row">
                        <div class="col-xl-6">
                            <label class="form-label fw-bolder text-dark fs-6">Password:
                                <span class="text-danger">*</span>
                            </label>
                            <div class="position-relative">
                                <input type="password"
                                       class="form-control form-control-lg form-control-solid"
                                       onkeypress='if (/\s/g.test(this.value)) this.value = this.value.replace(/\s/g,"")'
                                       name="password" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <label class="form-label fw-bolder text-dark fs-6">Confirm Password:
                                <span class="text-danger">*</span>
                            </label>
                            <input type="password" name="password_confirmation"
                                   class="form-control form-control-lg form-control-solid"
                                   onkeypress='if (/\s/g.test(this.value)) this.value = this.value.replace(/\s/g,"")'
                                   placeholder="" required>
                        </div>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="form-label fw-bolder text-dark fs-6">Gender:
                            <span class="text-danger">*</span>
                        </label>
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="radio" name="gender" value="0" checked id="male"/>
                            <label class="form-check-label" for="male">
                                Male
                            </label> &nbsp;&nbsp;&nbsp;
                            <input class="form-check-input" type="radio" name="gender" value="1" id="female"/>
                            <label class="form-check-label" for="female">
                                Female
                            </label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" id="kt_sign_up_submit" class="btn btn-lg btn-primary indicator">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Authentication - Sign-up-->
@endsection
