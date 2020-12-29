@extends('layouts.main')
@section('title', "Quản lý học sinh")
@section('style')
<link href="{!!  asset('css_loading/css_loading.css') !!}" rel="stylesheet" type="text/css" />
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
                <div id="preload" class="preload-container text-center" style="display: none">
                    <img id="gif-load" src="{!! asset('images/loading2.gif') !!}" alt="">
                </div>
                <div class="m-portlet__body">
                    <!--begin::Section-->
                    <div class="m-section">
                        <div class="m-section__content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">Khối</label>
                                        <div class="col-lg-8">
                                            <select class="form-control select2" name="khoi" id="id_khoi">
                                                <option value="0" selected>Chọn khối</option>
                                                @foreach ($khoi as $item)
                                                <option value="{{$item->id}}">{{$item->ten_khoi}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <div class="form-group m-form__group row">
                                        <label for="" class="col-lg-2 col-form-label">Lớp</label>
                                        <div class="col-lg-8">
                                            <select class="form-control select2" name="lop" id="id_lop">
                                                <option value="0" selected>Chọn lớp</option>
                                                @foreach ($lop as $item)
                                                <option value="{{$item->id}}">{{$item->ten_lop}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">Tên học sinh</label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control m-input m-input--square" id="exampleInputPassword1" placeholder="Tên học sinh">
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
    
    <div class="m-portlet">
        <div class="m-portlet__body table-responsive">
            <table class="table m-table m-table--head-bg-success">
            <div class="col-12 form-group m-form__group d-flex justify-content-end">
                    <label class="col-lg-2 col-form-label">Kích thước:</label>
                    <div class="col-lg-2">
                        <select class="form-control" id="page-size">          
                            <option  value="10"> 10</option>
                            <option  value="20"> 20</option>
                            <option  value="50"> 50</option>
                        </select>
                    </div>
                </div>
                <thead>
                    <tr>
                        <th>Stt</th>
                        <th>Mã học sinh</th>
                        <th>Họ tên</th>
                        <th>Ảnh</th>
                        <th>Ngày sinh</th>
                        <th>Giới tính</th>
                        <th>Khối</th>
                        <th>Lớp</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = !isset($_GET['page']) ? 1 : ($limit * ($_GET['page']-1) + 1);
                    @endphp
                    @foreach ($hoc_sinh as $item)
                    <tr>
                        <th scope="row">{{$i++}}</th>
                        <td>{{$item->ma_hoc_sinh}}</td>
                        <td>{{$item->ten}}</td>
                        @if ($item->avatar == "")
                        <td><img src="https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_960_720.png"
                                height="100px" width="85px" alt=""></td>
                        @else
                        <td><img src="{{ $item->avatar}}" height="100px" width="75px" alt=""></td>
                        @endif
                        <td>{{date("d/m/Y", strtotime($item->ngay_sinh))}}</td>
                        <td>{{($item->gioi_tinh == 1) ? 'Nam' : 'Nữ' }}</td>
                        <td>{{$item->ten_khoi}}</td>
                        <td>{{$item->ten_lop}}</td>
                        <td>
                            <a href="{{route('quan-ly-hoc-sinh-edit',['id'=>$item->id])}}">
                            <button type="button" class="btn btn-primary">Chi tiết</button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                   

                </tbody>
            </table>
            <div class="m-portlet__foot d-flex justify-content-end">
                {{ $hoc_sinh->links() }}
            </div>
        </div>
    </div>
</div>



{{-- thanhnv form import export --}}

    @include('layouts.formExcel.from')

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{!! asset('excel-js/js-form.js') !!}"></script>


<script>
    var routeImport = "{{route('import-bieu-mau-nhap-hoc-sinh')}}";
</script>

<script type="text/javascript">
    var url_get_lop_of_khoi= "{{route('get-lop-theo-khoi')}}"
    
    $("#id_khoi").change(function() {
        $('#preload').css('display','block')
        axios.post(url_get_lop_of_khoi, {
            id:  $("#id_khoi").val(),
        })
        .then(function (response) {
            var htmldata = '<option value="">Chọn lớp</option>'
                response.data.forEach(element => {
                htmldata+=`<option value="${element.id}">${element.ten_lop}</option>`
            });
            $('#preload').css('display','none')
            $('#id_lop').html(htmldata);
        })
        .catch(function (error) {
            console.log(error);
        });
    });

    $("#id_khoi_import").change(function() {
        axios.post(url_get_lop_of_khoi, {
            id:  $("#id_khoi_import").val(),
        })
        .then(function (response) {
            var htmldata = '<option value="">Chọn lớp</option>'
                response.data.forEach(element => {
                htmldata+=`<option value="${element.id}">${element.ten_lop}</option>`
            });
            $('#id_lop_import').html(htmldata);
        })
        .catch(function (error) {
            console.log(error);
        });
    });
    

    </script>
    
@endsection
