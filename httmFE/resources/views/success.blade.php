@extends('template.master')
{{-- Trang chủ GIao Ban --}}
@section('title', 'Kết quả')
@section('header-style')
<style>
    .tree_wrapper {
        overflow-y: scroll;
        height: 100vmin;
        padding-bottom: 150px;
    }
</style>
@endsection
@php
@endphp
@section('content')
<div id="mainWrap" class="mainWrap">
    <div class="mainSection">
        <div class="main">
            <div class="d-flex align-items-center">
                <div class="action_export ms-3" data-bs-toggle="tooltip" data-bs-placement="top" aria-label=""
                    data-bs-original-title="">
                    <button class="btn btn-danger d-block testCreateUser" id="homeButton" data-bs-toggle="modal"
                        data-bs-target="">Trang chủ</button>
                </div>
            </div>
            <div class="container-fluid">
                <div class="mainSection_heading">
                    <h5 class="mainSection_heading-title"> Retrain thành công </h5>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body position-relative body_content-wrapper" id="body_content-1" style="display:block">
                    <div class="col-md-12">
                        @include('template.footer.footer')
                    </div>
                </div>
                <script>
                    document.getElementById("homeButton").addEventListener("click", function () {
                        window.location.href = "/home";
                    });
                </script>
                @endsection
                @section('footer-script')
                @endsection