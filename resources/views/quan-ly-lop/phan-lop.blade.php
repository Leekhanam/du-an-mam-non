@extends('layouts.main')
@section('title', 'Quản lý phân lớp cho học sinh')
@section('style')
    <style>
        .m-table th,
        td {
            text-align: center;
        }

        .m-table ul li {
            list-style: none;
        }

        .js-example-basic-single {
            padding-right: 20px;
        }

        .select2-selection__arrow {
            margin-left: 30px;
        }

    </style>
    {{--
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    --}}
@endsection
@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-xl-12">
                <!--begin::Portlet-->
                <div class="m-portlet m-portlet--tab">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide">
                                    <i class="la la-gear"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    Bộ lọc
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--begin::Section-->
                        <div class="m-section">
                            <div class="m-section__content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group m-form__group row">
                                            <label class="col-lg-2 col-form-label">Mã số học sinh</label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control m-input m-input--square"
                                                    placeholder="Nhập mã số học sinh">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group m-form__group row">
                                            <label for="" class="col-lg-2 col-form-label">Tên học sinh</label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control m-input m-input--square"
                                                    placeholder="Nhập tên học sinh">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-6 ">
                                        <div class="form-group m-form__group row">
                                            <label for="" class="col-lg-2 col-form-label">Tuổi</label>
                                            <div class="col-lg-8">
                                                <select class="form-control" name="co_so_id" id="co_so_id">
                                                    <option value="">Chọn tuổi</option>
                                                    <option value="">2</option>
                                                    <option value="">3</option>
                                                    <option value="">4</option>
                                                    <option value="">5</option>
                                                </select>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group m-form__group row">
                                            <label for="" class="col-lg-2 col-form-label">Trạng thái</label>
                                            <div class="col-lg-8">
                                                <select class="form-control" name="co_so_id" id="co_so_id">
                                                    <option value="">Chọn</option>
                                                    <option value="">Đã có lớp</option>
                                                    <option value="">Chưa có lớp</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Section-->
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
        </div>
        <section class="action-nav d-flex align-items-center justify-content-between mt-4 mb-4">
            <div class="modal fade" id="m_select2_modal" role="dialog" aria-labelledby="" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">Phân lớp</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="la la-remove"></span>
                            </button>
                        </div>
                        <form class="m-form m-form--fit m-form--label-align-right">
                            <div class="modal-body">
                                <div class="form-group m-form__group row m--margin-top-20">
                                    <label class="col-form-label col-lg-3 col-sm-12">Khối</label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <select class="form-control"
                                        name="param">
                                        <optgroup label="Alaskan/Hawaiian Time Zone">
                                            <option value="AK">Chọn lớp</option>
                                            <option value="HI">Hawaii</option>
                                        </optgroup>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-form-label col-lg-3 col-sm-12">Lớp</label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <select class="form-control"
                                            name="param">
                                            <optgroup label="Alaskan/Hawaiian Time Zone">
                                                <option value="AK">Chọn lớp</option>
                                                <option value="HI">Hawaii</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row m--margin-bottom-20">
                                    <label class="col-form-label col-lg-3 col-sm-12">Ngày nhập học</label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <select class="form-control"
                                        name="param">
                                        <optgroup label="Alaskan/Hawaiian Time Zone">
                                            <option value="AK">Chọn lớp</option>
                                            <option value="HI">Hawaii</option>
                                        </optgroup>
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-brand m-btn" data-dismiss="modal">Hủy</button>
                                <button type="button" class="btn btn-secondary m-btn">Phân lớp</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <div class="modal fade" id="phan-lop-tung-hs" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Phân lớp</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="la la-remove"></span>
                        </button>
                    </div>
                    <form class="m-form m-form--fit m-form--label-align-right">
                        <div class="modal-body">
                            <div class="form-group m-form__group row m--margin-top-20">
                                <label class="col-form-label col-lg-3 col-sm-12">Khối</label>
                                <div class="col-lg-9 col-md-9 col-sm-12">
                                    <select class="form-control"
                                    name="param">
                                    <optgroup label="Alaskan/Hawaiian Time Zone">
                                        <option value="AK">Chọn lớp</option>
                                        <option value="HI">Hawaii</option>
                                    </optgroup>
                                </select>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-form-label col-lg-3 col-sm-12">Lớp</label>
                                <div class="col-lg-9 col-md-9 col-sm-12">
                                    <select class="form-control"
                                        name="param">
                                        <optgroup label="Alaskan/Hawaiian Time Zone">
                                            <option value="AK">Chọn lớp</option>
                                            <option value="HI">Hawaii</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group m-form__group row m--margin-bottom-20">
                                <label class="col-form-label col-lg-3 col-sm-12">Ngày nhập học</label>
                                <div class="col-lg-9 col-md-9 col-sm-12">
                                    <select class="form-control"
                                    name="param">
                                    <optgroup label="Alaskan/Hawaiian Time Zone">
                                        <option value="AK">Chọn lớp</option>
                                        <option value="HI">Hawaii</option>
                                    </optgroup>
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-brand m-btn" data-dismiss="modal">Hủy</button>
                            <button type="button" class="btn btn-secondary m-btn">Phân lớp</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="m-portlet">
            <div class="m-portlet__body table-responsive">
                <table class="table m-table m-table--head-bg-success">
                    <div class="col-12 form-group m-form__group d-flex justify-content-end">
                        <label class="col-lg-2 col-form-label">Kích thước:</label>
                        <div class="col-lg-2">
                            <select class="form-control" id="page-size">
                                <option value="10"> 10</option>
                                <option value="20"> 20</option>
                                <option value="50"> 50</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4 align-items-center" id="phan-lop" style="display: none">
                        <div class="col-xl-12">
                            <div class="m-form__group m-form__group--inline">
                                <div class="m-form__label m-form__label-no-wrap">
                                    <label class="m--font-bold m--font-danger-">Chọn
                                        <span id="m_datatable_selected_number">10</span> hồ sơ:</label>
                                </div>
                                <div class="m-form__control">
                                    <div class="btn-toolbar">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-accent btn-sm" data-toggle="modal" data-target="#m_select2_modal">
                                                Phân lớp
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="customCheck1"></th>
                            <th> Stt</th>
                            <th> Mã số học sinh</th>
                            <th> Tên học sinh</th>
                            <th> Ảnh học sinh</th>
                            <th> Tuổi</th>
                            <th> Giới tính</th>
                            <th> Trạng thái</th>
                            <th colspan="2">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hoc_sinh as $item)
                        <tr>
                            <td><input type="checkbox" id=""></td>
                            <th scope="row">1</th>
                        <td>{{$item->ma_hoc_sinh}}</td>
                            <td>{{$item->ten}}</td>
                            <td>Trần Thu Trang</td>
                            <td>
                                {{$item->tuoi}}
                            </td>
                            <td>{{ config('common.gioi_tinh')[$item->gioi_tinh] }}</td>
                             <td>Đã có lớp</td>
                            <td><button data-toggle="modal" data-target="#phan-lop-tung-hs" class="btn btn-primary mr-3">Phân lớp</button><a class="btn btn-success"
                                    href="{{ route('quan-ly-lop-show', ['id' => 1]) }}">Chi tiết</a></td>
                        </tr>
                        @endforeach
                       
                   

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    $('#customCheck1').click(() =>{
        $('#phan-lop').toggle(500)
    })
</script>
@endsection
