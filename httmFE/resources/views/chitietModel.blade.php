@extends('template.master')
{{-- Trang chủ GIao Ban --}}
@section('title', 'Chi tiết Model')
@section('header-style')
<style>

</style>
@endsection

@section('content')
<div id="mainWrap" class="mainWrap">
    <div class="mainSection">
        <div class="main">
            <div class="container-fluid">
                <div class="mainSection_heading">
                    <h5 class="mainSection_heading-title"> Chi tiết Model </h5>
                </div>
                <div class="card mb-3">
                    <div class="card-body position-relative body_content-wrapper" id="body_content-1"
                        style="display:block">

                        <div class="col-md-12">
                            <div>
                                <div class="title_wrapper d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="action_export ms-3" data-bs-toggle="tooltip" data-bs-placement="top"
                                            aria-label="" data-bs-original-title="">
                                            <button class="btn btn-danger d-block testCreateUser" id="homeButton" data-bs-toggle="modal" data-bs-target="" >
                                                Trang chủ</button>
                                        </div>
                                    </div>
                                    <div class="action_wrapper">
                                        <button class="btn btn-danger d-block testCreateUser" id="backButton" data-bs-toggle="modal" data-bs-target="" >
                                                Quay lại</button>
                                    </div>
                                </div>
                            </div>
                            <div class=" table-responsive dataTables_wrapper">
                                <p class="mainSection_heading-title"> Danh sách mẫu </p>
                                <table id="dsToanCongTy" class="table table-responsive table-hover table-bordered">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="text-nowrap text-center" style="width: 3%">STT</th>
                                            <th class="text-nowrap text-center" style="width: 5%">Tên</th>
                                            <th class="text-nowrap text-center" style="width: 30%">Đường dẫn</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data->samples as $item)
                                        <tr>
                                            <td>
                                                <div class="overText" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-original-title="{{ $item->id }}">
                                                    {{ $item->id }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="overText" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-original-title="{{ $item->name }}">
                                                    {{ $item->name }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="overText" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-original-title="{{ $item->path }}">
                                                    {{ $item->path }}
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class=" table-responsive dataTables_wrapper">
                                <p class="mainSection_heading-title"> Đánh giá hiệu suất thuật toán </p>
                                <table id="dsToanCongTy" class="table table-responsive table-hover table-bordered">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="text-nowrap text-center" style="width: 3%">STT</th>
                                            <th class="text-nowrap text-center" style="width: 17%">Số lượng epoch</th>
                                            <th class="text-nowrap text-center" style="width: 20%">Độ chính xác TB hộp bao quanh đối tượng (box)</th>
                                            <th class="text-nowrap text-center" style="width: 20%">Độ chính xác TB các đối tượng (obj)</th>
                                            <th class="text-nowrap text-center" style="width: 20%">Độ chính xác TB các lớp (cls)</th>
                                            <th class="text-nowrap text-center" style="width: 20%">Độ chính xác TB của mô hình(total)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data->trainedModels as $item)
                                        <tr>
                                            <td>
                                                <div class="overText" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-original-title="{{ $item->id }}">
                                                    {{ $item->id }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="overText" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-original-title="{{ $item->epoch }}">
                                                    {{ $item->epoch }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="overText" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-original-title="{{ $item->box }}">
                                                    {{ $item->box }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="overText" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-original-title="{{ $item->obj }}">
                                                    {{ $item->obj }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="overText" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-original-title="{{ $item->cls }}">
                                                    {{ $item->cls }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="overText" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-original-title="{{ $item->total }}">
                                                    {{ $item->total }}
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @include('template.footer.footer')
                        </div>
                    </div>

                    <script>
                        document.getElementById("homeButton").addEventListener("click", function () {
                            window.location.href = "/home";
                        });
                        document.getElementById("backButton").addEventListener("click", function () {
                            window.location.href = "/quan-ly-model";
                        });
                    </script>
                    @endsection
                    @section('footer-script')
                    @endsection