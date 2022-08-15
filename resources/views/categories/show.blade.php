@extends('layouts.app')
@section('title')
    {{ __('messages.medicine.medicine_category')}}
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/detail-header.css') }}">
@endsection
@section('content')
    <div class="d-flex flex-column flex-lg-row">
        <div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
            <div class="row">
                <div class="col-12">
                    @include('flash::message')
                </div>
            </div>
            <div class="p-12">
                @include('categories.show_fields')
            </div>
        </div>
    </div>
    @include('categories.edit_modal')
@endsection
@section('page_scripts')
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/category/medicines_list.js') }}"></script>
@endsection
@section('scripts')
    <script>
        let categoriesUrl = "{{ url('categories') }}";
    </script>
    <script src="{{ mix('assets/js/category/category-details-edit.js') }}"></script>
@endsection
