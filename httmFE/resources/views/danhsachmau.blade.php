@extends('template.master')
{{-- Trang chủ GIao Ban --}}
@section('title', 'Danh sách mẫu')
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
    set_time_limit(0);
@endphp
@section('content') <div id="mainWrap" class="mainWrap">
    <div class="mainSection">
        <div class="main">
            <div class="container-fluid">
                <div class="mainSection_heading">
                    <h5 class="mainSection_heading-title"> Danh sách mẫu </h5>
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
                                            <button class="btn btn-danger d-block testCreateUser" id="backButton" data-bs-toggle="modal" data-bs-target="" >
                                                Quay lại</button>
                                        </div>
                                    </div>
                                    <div class="action_wrapper">
                                        <!-- <div class="action_export ms-3" data-bs-toggle="tooltip" data-bs-placement="top"
                                            aria-label="Thêm thành viên" data-bs-original-title="Thêm thành viên">
                                            <button class="btn btn-danger d-block testCreateUser" data-bs-toggle="modal"
                                                data-bs-target="#train">Train</button>
                                        </div> -->
                                        <div class="action_export ms-3" data-bs-toggle="tooltip" data-bs-placement="top"
                                            aria-label="Thêm thành viên" data-bs-original-title="Thêm thành viên">
                                            <button class="btn btn-danger d-block testCreateUser" id="retrainButton" data-bs-toggle="modal" data-bs-target="#retrain">
                                                Re-Train</button>
                                        </div>
                                        <!-- <div class="action_export ms-3" data-bs-toggle="tooltip" data-bs-placement="top"
                                            aria-label="Thêm thành viên" data-bs-original-title="Thêm thành viên">
                                            <button class="btn btn-danger d-block testCreateUser" data-bs-toggle="modal" data-bs-target="#themThanhVien">Thêm
                                                mẫu</button>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class=" table-responsive dataTables_wrapper">
                                <table id="dsToanCongTy" class="table table-responsive table-hover table-bordered">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="text-nowrap text-center" style="width: 3%"> </th>
                                            <th class="text-nowrap text-center" style="width: 3%">STT</th>
                                            <th class="text-nowrap text-center" style="width: 5%">Tên</th>
                                            <th class="text-nowrap text-center" style="width: 30%">Đường dẫn</th>
                                            <!-- <th class="text-nowrap" style="width: 3%">Hành động</th> -->
                                        </tr>
                                    </thead>
                                    <tbody> @foreach ($data->content as $item) <tr>
                                            <td style="text-align: center;"> <input class="form-check-input"
                                                    type="checkbox" id="gridCheck" data-id="{{ $item->sample->id }}">
                                            </td>
                                            <td>
                                                <div class="overText" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-original-title="{{ $item->sample->id }}">
                                                    {{ $item->sample->id }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="overText" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-original-title="{{$item->sample->name }}"> {{ $item->sample->name }} </div>
                                            </td>
                                            <td>
                                                <div class="overText" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-original-title="{{$item->sample->path }}"> {{ $item->sample->path }}</div>
                                            </td>
                                            <!-- <td>
                                                <div class="table_actions d-flex justify-content-center">
                                                    <div class="btn test_edit-{{ $item->sample->id }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#suaThanhVien{{ $item->sample->id }}">
                                                        <img style="width:16px;height:16px"
                                                            src="{{ asset('assets/img/edit.svg') }}" />
                                                    </div>
                                                    <div class="btn test_remove-{{ $item->sample->id }}"
                                                        data-bs-toggle="modal" data-bs-target="#xoaThanhVien{{$item->sample->id }}"> <img style="width:16px;height:16px" src="{{ asset('assets/img/trash.svg') }}" />
                                                    </div>
                                                </div>
                                            </td> -->
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> @include('template.footer.footer')
                        </div>
                    </div>
                    <div class="modal fade" id="themThanhVien" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <h5 class="modal-title w-100" id="exampleModalLabel">Thêm mẫu</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('train') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="create_user-wrapper">
                                            <div class="row align-items-center">
                                                <div class="col-sm-12">
                                                    <div class="image-upload">
                                                        <input type="file" name="fileInput" id="fileInput">
                                                        <label for="fileInput" class="upload-field" id="file-label">
                                                            <div class="file-thumbnail">
                                                                <img id="create_image-preview"
                                                                    src="{{ asset('assets/img/preview-image.svg') }}"
                                                                    alt="">
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-danger test_cancel"
                                            data-bs-dismiss="modal">Hủy</button>
                                        <button type="submit" class="btn btn-danger test_save">Lưu</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="retrain" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form method="POST" enctype="multipart/form-data" action="{{ route('retrain') }}">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12 col-md-12 mb-3">
                                                <div class="text-title m-0 fs-5">Chọn Model Retrain</div>
                                            </div>
                                            <div data-bs-toggle="tooltip" data-bs-placement="top" title="Chọn Model Retrain*">
                                                <select class="select" data-dropup-auto="false" data-size="255" required
                                                    title="Chọn Model Retrain*" name="weight">
                                                    <option value="">pretrain/yolov7</option>
                                                </select>
                                                <input type="hidden" name="selectedIds" id="selectedIdsInput" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-danger test_cancel"
                                            data-bs-dismiss="modal">Hủy</button>
                                        <button type="submit" class="btn btn-danger test_save">Lưu</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    @foreach ($data->content as $value)
                    <div class="modal fade" id="suaThanhVien{{ $value->sample->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <h5 class="modal-title w-100" id="exampleModalLabel">Sửa mẫu</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('update', $value->sample->id ) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="create_user-wrapper">
                                            <div class="row align-items-center">
                                                <div class="col-sm-12">
                                                    <div class="image-upload">
                                                        <input type="file" name="fileInput" id="fileInput">
                                                        <label for="fileInput" class="upload-field" id="file-label">
                                                            <div class="file-thumbnail">
                                                                <img id="create_image-preview"
                                                                    src="{{ asset('assets/img/preview-image.svg') }}"
                                                                    alt="">
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-danger test_cancel"
                                            data-bs-dismiss="modal">Hủy</button>
                                        <button type="submit" class="btn btn-danger test_save">Lưu</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="xoaThanhVien{{ $value->sample->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-danger" id="exampleModalLabel">XOÁ MẪU</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Bạn có thực sự muốn xoá mẫu này không?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-danger"
                                        data-bs-dismiss="modal">Hủy</button>
                                    <form action="{{ route('delete', $value->sample->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            // Lắng nghe sự kiện click vào nút "Re-Train"
                            var retrainButton = document.getElementById('retrainButton');
                            if (retrainButton) {
                                retrainButton.addEventListener('click', function () {
                                    // Thu thập các giá trị của checkbox được chọn
                                    var selectedIds = [];
                                    var checkboxes = document.querySelectorAll('input.form-check-input:checked');
                                    checkboxes.forEach(function (checkbox) {
                                        selectedIds.push(checkbox.dataset.id);
                                    });

                                    // Đặt giá trị vào input trong modal
                                    var selectedIdsInput = document.getElementById('selectedIdsInput');
                                    if (selectedIdsInput) {
                                        selectedIdsInput.value = selectedIds.join(',');
                                    }

                                    fetch('http://127.0.0.1:8080/listweight')
                                        .then(response => response.json())
                                        .then(data => {
                                            // Cập nhật select box với dữ liệu từ API
                                            var selectBox = document.querySelector('.select');
                                            if (selectBox) {
                                                // Xóa tất cả các option hiện tại
                                                selectBox.innerHTML = '';

                                                // Thêm option mới từ dữ liệu API
                                                data.forEach(function (item) {
                                                    var option = document.createElement('option');
                                                    option.value = item;
                                                    option.text = item;
                                                    selectBox.appendChild(option);
                                                });
                                            }
                                        })
                                        .catch(error => console.error('Error:', error));

                                    // Hiển thị modal
                                    var retrainModal = document.getElementById('retrain');
                                    if (retrainModal) {
                                        retrainModal.classList.add('show');
                                    }
                                });
                            }
                        });

                        document.getElementById("backButton").addEventListener("click", function () {
                            window.location.href = "/home";
                        });
                    </script>
                    @endsection
                    @section('footer-script')
                    @endsection