@extends('template.master')

@section('title', 'Quản lý model ')
@section('content')
<div id="mainWrap" class="mainWrap">
    <div class="mainSection">
        <div class="main">
            <div class="mainSection_heading">
                <h5 class="mainSection_heading-title"> Danh sách Model </h5>
            </div>
            <div class="col-md-12">
                <div class="title_wrapper d-flex align-items-center justify-content-between mb-3">
                    <div class="d-flex align-items-center">
                        <div class="action_export ms-3" data-bs-toggle="tooltip" data-bs-placement="top" aria-label=""
                            data-bs-original-title="">
                            <button class="btn btn-danger d-block testCreateUser" id="backButton" data-bs-toggle="modal"
                                data-bs-target="">
                                Quay lại</button>
                        </div>
                    </div>
                    <div class="action_wrapper">
                        <div class="action_export ms-3" data-bs-toggle="tooltip" data-bs-placement="top"
                            aria-label="Thêm" data-bs-original-title="Thêm">
                            <button class="btn btn-danger d-block testCreateUser" id="addButton" data-bs-toggle="modal"
                                data-bs-target="">
                                Thêm</button>
                        </div>
                    </div>
                </div>
                <div class=" table-responsive dataTables_wrapper">
                    <table id="dsToanCongTy" class="table table-responsive table-hover table-bordered">
                        <thead>
                            <tr class="bg-light">
                                <th class="text-nowrap text-center" style="width: 3%">STT</th>
                                <th class="text-nowrap text-center" style="width: 5%">Tên</th>
                                <th class="text-nowrap text-center" style="width: 30%">Đường dẫn</th>
                                <th class="text-nowrap" style="width: 3%">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->content as $item)
                            <tr>
                                <td>
                                    <div class="overText" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-original-title="{{ $item->id }}">
                                        {{ $item->id }}
                                    </div>
                                </td>
                                <td>
                                    <div class="overText" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-original-title="{{$item->name }}"> {{ $item->name }} </div>
                                </td>
                                <td>
                                    <div class="overText" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-original-title="{{$item->path }}"> {{ $item->path }}</div>
                                </td>
                                <td>
                                    <div class="table_actions d-flex justify-content-center">
                                        <div class="btn test_edit-{{ $item->id }}" data-bs-toggle="modal"
                                            data-bs-target="#suaThanhVien{{ $item->id }}">
                                            <img style="width:16px;height:16px"
                                                src="{{ asset('assets/img/edit.svg') }}" />
                                        </div>
                                        <div class="btn test_remove-{{ $item->id }}" data-bs-toggle="modal"
                                            data-bs-target="#xoaThanhVien{{$item->id }}"> <img
                                                style="width:16px;height:16px"
                                                src="{{ asset('assets/img/trash.svg') }}" />
                                        </div>
                                        <div class="btn chitietModel-{{ $item->id }}" data-bs-toggle="modal"
                                            data-bs-target=""> <img style="width:16px;height:16px"
                                                onclick="chitietModel('{{ $item->id }}')"
                                                src="{{ asset('assets/img/file.svg') }}" />
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('template.footer.footer')
    @foreach ($data->content as $value)
    <div class="modal fade" id="suaThanhVien{{ $value->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title w-100" id="exampleModalLabel">Sửa mẫu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('updateModel', $value->id ) }}" method="POST" id="myForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 col-md-12 mb-3">
                                <label for="nameEdit">Tên: </label>
                                <input type="text" id="nameEdit" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $value->name }}" placeholder="{{ $value->name }}" name="nameEdit"
                                    value="" class="form-control">
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

    <div class="modal fade" id="xoaThanhVien{{ $value->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="exampleModalLabel">XOÁ MODEL</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bạn có thực sự muốn xoá model này không?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Hủy</button>
                    <form action="{{ route('deleteModel', $value->id) }}" method="POST">
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
        document.getElementById("backButton").addEventListener("click", function () {
            window.location.href = "/home";
        });
        document.getElementById("addButton").addEventListener("click", function () {
            window.location.href = "/danh-sach-mau";
        });

        function chitietModel(itemId) {
            window.location.href = "/chi-tiet-model/" + itemId;
        }

    </script>
    @endsection