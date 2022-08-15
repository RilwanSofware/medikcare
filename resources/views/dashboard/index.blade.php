@extends('layouts.app')
@section('title')
    {{ __('messages.dashboard.dashboard') }}
@endsection
@section('page_css')
{{--        <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.css') }}">--}}
{{--        <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}">--}}
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/detail-header.css') }}">
@endsection
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="row g-5 gx-xxl-8 justify-content-center">

                @if($modules['Doctors'] == true)
                    {{-- Doctors Widget --}}
                    <div class="col-xl-3 col-md-6">
                        <a href="{{ route('doctors.index') }}"
                           class="card bg-secondary hoverable card-xl-stretch mb-xl-8">
                            <div class="card-body card-5">
                                <span class="rotate"><i class="fas fa-user-md fa-4x display-4 card-icon text-dark"></i></span>
                                <div
                                    class="text-inverse-secondary fw-bolder card-count fs-2 mb-2 mt-5 amount-position">{{ $data['doctors'] }}</div>
                                <div
                                    class="fw-bold text-inverse-secondary fs-7">{{ __('messages.dashboard.doctors') }}</div>
                            </div>
                        </a>
                    </div>
                @endif
                @if($modules['Patients'] == true)
                    {{-- Patients Widget --}}
                    <div class="col-xl-3 col-md-6">
                        <a href="{{ route('patients.index') }}"
                           class="card bg-danger hoverable card-xl-stretch mb-xl-8">
                            <div class="card-body card-6">
                                <span class="rotate"><i
                                        class="fas fa-user fa-4x display-4 card-icon text-white"></i></span>
                                <div
                                    class="text-inverse-danger fw-bolder card-count fs-2 mb-2 mt-5 amount-position">{{ $data['patients'] }}</div>
                                <div
                                    class="fw-bold text-inverse-danger fs-7">{{ __('messages.dashboard.patients') }}</div>
                            </div>
                        </a>
                    </div>
                @endif

            </div>
            <div class="row">
                <div class="col-xxl-7 col-xl-7">
                    <div class="card card-xxl-stretch mb-5 mb-xxl-8">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">{{ __('messages.enquiries') }}</span>
                            </h3>
                        </div>
                        <div class="card-body py-3">
                            <div class="table-responsive">
                                @if(count($data['enquiries']) > 0)
                                    <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                        <thead>
                                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="min-w-150px text-muted mt-1 fw-bold fs-7">{{ __('messages.enquiry.name') }}</th>
                                            <th class="min-w-150px text-muted mt-1 fw-bold fs-7">{{ __('messages.enquiry.email') }}</th>
                                            <th class="min-w-50px text-center text-muted mt-1 fw-bold fs-7">{{ __('messages.common.created_on') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody class="text-gray-600 fw-bold">
                                        @foreach($data['enquiries'] as $enquiry)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('enquiry.show' , $enquiry->id) }}"
                                                       class="text-primary-800 mb-1 fs-6">{{ $enquiry->full_name }}</a>
                                                </td>
                                                <td class="text-start">
                                                        <span
                                                            class="text-muted fw-bold d-block">{{ $enquiry->email }}</span>
                                                </td>
                                                <td class="text-center text-muted fw-bold">
                                                        <span class="badge badge-light-info">
                                                        {{ date('jS M,Y', strtotime($enquiry->created_at)) }}
                                                        </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <h2 class="text-center">No Enquiries yet..</h2>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-5 col-xl-5">
                    <div class="card card-xxl-stretch mb-5 mb-xxl-8">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                    <span
                                        class="card-label fw-bolder fs-3 mb-1">{{ __('messages.dashboard.notice_boards') }}</span>
                            </h3>
                        </div>
                        <div class="card-body py-3">
                            <div class="table-responsive">
                                @if(count($data['noticeBoards']) > 0)
                                <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                    <thead>
                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="min-w-150px text-muted mt-1 fw-bold fs-7">{{ __('messages.dashboard.title') }}</th>
                                        <th class="min-w-50px text-center text-muted mt-1 fw-bold fs-7">{{ __('messages.common.created_on') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-gray-600 fw-bold">
                                    @foreach($data['noticeBoards'] as $noticeBoard)
                                        <tr>
                                            <td>
                                                <a href="javascript:void(0)" data-id="{{$noticeBoard->id}}"
                                                   class="text-primary-800 mb-1 fs-6 view-btn">{{ Str::limit($noticeBoard->title, 32,'...') }}</a>
                                            </td>
                                            <td class="text-center text-muted fw-bold">
                                                    <span class="badge badge-light-info">
                                                        {{ date('jS M,Y', strtotime($noticeBoard->created_at)) }}
                                                    </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @else
                                    <h2 class="text-center">No Notice Boards yet..</h2>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Income & Expense Chart--}}
            {{--            <div class="row">--}}
            {{--                <div class="col-lg-12">--}}
            {{--                    <div class="card">--}}
            {{--                        <div class="card-body">--}}
            {{--                            <div class="row justify-content-between">--}}
            {{--                                <div class="col-sm-6 col-md-6 col-lg-6 pt-2">--}}
            {{--                                    <h5>{{ __('messages.dashboard.income_and_expense_report') }}</h5>--}}
            {{--                                </div>--}}
            {{--                                <div class="col-md-3">--}}
            {{--                                    <div id="time_range" class="time_range d-flex">--}}
            {{--                                        <i class="far fa-calendar-alt"--}}
            {{--                                           aria-hidden="true"></i>&nbsp;&nbsp;<span></span>--}}
            {{--                                        <b class="caret"></b>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="table-responsive-sm">--}}
            {{--                                <div class="pt-2">--}}
            {{--                                    <canvas id="daily-work-report" class="mh-400px"></canvas>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>
        @include('notice_boards.show_modal')
    </div>
@endsection
@section('page_scripts')
    {{--    <script src="{{ asset('assets/js/chart.min.js') }}"></script>--}}
    {{--    <script src="{{ asset('assets/js/daterangepicker.js') }}"></script>--}}
@endsection
@section('scripts')
    <script>
        let incomeExpenseReportUrl = "{{route('income-expense-report')}}";
        let currentCurrencyName = "{{ getCurrencySymbol()}}";
        let curencies = JSON.parse('@json($data['currency'])');
        let income_and_expense_reports = "{{ __('messages.dashboard.income_and_expense_reports') }}";
        let defaultAvatarImageUrl = "{{ asset('assets/img/avatar.png') }}";
        let noticeBoardUrl = "{{url('notice-boards')}}";
    </script>
    <script src="{{mix('assets/js/dashboard/dashboard.js')}}"></script>
    <script src="{{mix('assets/js/custom/input_price_format.js')}}"></script>
@endsection
