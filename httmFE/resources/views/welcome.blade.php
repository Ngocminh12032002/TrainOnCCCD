@extends('template.master')
{{-- Trang chủ GIao Ban --}}
@section('title', 'Màn hình chính')
@section('header-style')
<style>
.tree_wrapper {
overflow-y: scroll;
height: 100vmin;
padding-bottom: 150px;
}
</style> @endsection @php @endphp @section('content') <div id="mainWrap" class="mainWrap"> <div class="mainSection">
<div class="main">
    <div class="container-fluid">
        <div class="mainSection_heading">
            <h5 class="mainSection_heading-title">
                Màn hình chính
            </h5>
        </div>
        <div class="card mb-3">
            <div class="card-body position-relative body_content-wrapper" id="body_content-1" style="display:block">
                <div class='row'>
                    <div class="col-md-12">
                        <div>
                            <div class="title_wrapper d-flex align-items-center justify-content-between mb-3">
                                <div class="ms-6" data-bs-toggle="tooltip" data-bs-placement="top"
                                    aria-label="Quản lý Model" data-bs-original-title="Quản lý Model" style="margin: 0 auto;">
                                    <button class="btn btn-danger d-block testCreateUser" data-bs-toggle="modal"
                                        id="qlyModel" data-bs-target="#themThanhVien">Quản lý Model</button>
                                </div>
                            </div>
                            <div class="title_wrapper d-flex align-items-center justify-content-between mb-3">
                                <div class="ms-6" data-bs-toggle="tooltip" data-bs-placement="top"
                                    aria-label="Quản lý mẫu" data-bs-original-title="Retrain"
                                    style="margin: 0 auto;">
                                    <button class="btn btn-danger d-block testCreateUser" id="qlyMau"
                                        data-bs-toggle="modal">Retrain</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.7.1.js"
                integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
            <script>
                $(document).ready(function () {
                    $('#qlyModel').click(function () {
                        window.location.href = '/quan-ly-model';
                    });
                });
            </script>
            <script>
                $(document).ready(function () {
                    $('#qlyMau').click(function () {
                        window.location.href = '/danh-sach-mau';
                    });
                });
            </script>
            @endsection