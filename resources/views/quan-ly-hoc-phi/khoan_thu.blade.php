@extends('layouts.main') @section('title', "Quản lý khoản thu")
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<link href="{!!  asset('css_loading/css_loading.css') !!}" rel="stylesheet" type="text/css" />
<style>
    #table-khoan-thu tbody td,
    thead th {
        text-align: center
    }

    .dataTables_filter {
        display: none;
    }

    .chuc_nang i {
        cursor: pointer;
    }

    #table-khoan-thu tbody td>.fa-check {
        color: #77d777
    }

    #form-add-khoan-thu label span {
        color: red
    }

    #form-edit-khoan-thu label span {
        color: red
    }
</style>
@endsection
@section('content')
<div class="m-content">
    <!--Begin::Section-->
    <div class="row">
        <div class="col-xl-12">
            <div id="preload" class="preload-container text-center" style="display: none">
                <img id="gif-load" src="https://icon-library.com/images/loading-gif-icon/loading-gif-icon-17.jpg" alt="">
              </div>
            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Quản lý khoản thu
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">

                    <!--begin::Section-->
                    <div class="m-section">
                        <div class="d-flex justify-content-between">
                            <div class="form-group col-md-3">
                                <input type="email" class="form-control" id="searchAll" aria-describedby="emailHelp"
                                    placeholder="Tìm kiếm">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#them_khoan_thu">Thêm mới</button>
                                <button type="button" onclick="xoaListKhoanThu()" class="btn btn-danger">Xóa</button>
                            </div>
                        </div>

                        <table id="table-khoan-thu" class="table table-bordered m-table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" onclick="checkAll(this)" name="" id=""></th>
                                    <th>Tên khoản thu</th>
                                    <th>Mức thu</th>
                                    <th>Đơn vị tính</th>
                                    <th>Áp dụng miễn giảm</th>
                                    <th>Đang theo dõi</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($khoan_thu as $item)
                                <tr>
                                    <td scope="row">
                                        @if ($item->mac_dinh < 1)
                                        <input class="checkbox" type="checkbox" value="{{$item->id}}" name="" id="">
                                        @endif
                                    </td>
                                    <td>{{$item->ten_khoan_thu}}</td>
                                    <td>{{number_format($item->muc_thu)}}</td>
                                    <td>{{config('common.don_vi_tinh')[$item->don_vi_tinh]}}</td>
                                    <td>
                                        @if ($item->mien_giam>0)
                                        <i class="fa fa-check"></i>
                                        @endif

                                    </td>
            
                                    <td>
                                        @if ($item->theo_doi==1)
                                        <i class="fa fa-check"></i>
                                        @endif
                                    </td>
                                    <td class="chuc_nang">
                                        <i data-toggle="modal" data-target="#sua_khoan_thu{{$item->id}}"
                                            onclick="capNhatorCopy(1,{{$item->mac_dinh}})" class="flaticon-edit-1"></i>
                                            @if ($item->mac_dinh < 1)
                                        <i data-toggle="modal" data-target="#sua_khoan_thu{{$item->id}}"
                                            onclick="capNhatorCopy(2,{{$item->mac_dinh}})" class="flaticon-add"></i>
                                            @endif
                                            @if ($item->mac_dinh < 1)
                                            <i onclick="deleteKhoanThu({{$item->id}})" class="flaticon-delete"></i>
                                            @endif
                                

                                    </td>
                                </tr>
                                <div class="modal fade" id="sua_khoan_thu{{$item->id}}" role="dialog">
                                    <div class="modal-dialog modal-lg">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Khoản thu</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="m-form m-form--fit m-form--label-align-right "
                                                    id="form-sua-khoan-thu{{$item->id}}">
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            <input type="hidden" value="{{$item->id}}"
                                                                name="id_sua_khoan_thu">
                                                            <div class="m-portlet__body">
                                                                <div class="form-group m-form__group">
                                                                    <label for="exampleInputEmail1">Tên khoản thu
                                                                        <span>*</span></label>
                                                                    <input type="text" @if ($item->mac_dinh >= 1)
                                                                    disabled
                                                                    @else
                                                                    name="ten_khoan_thu"
                                                                    @endif

                                                                    value="{{$item->ten_khoan_thu}}"
                                                                    class="form-control m-input m-input--square"
                                                                    aria-describedby="emailHelp"
                                                                    placeholder="Tên khoản thu">
                                                                </div>
                                                                <div class="form-group m-form__group">
                                                                    <div class="row">
                                                                        <div class="col-md-8">
                                                                            <label for="exampleInputPassword1">Mức thu
                                                                                (VNĐ) <span>*</span></label>
                                                                            <input type="number" name="muc_thu"
                                                                                class="form-control m-input m-input--square"
                                                                                value="{{$item->muc_thu}}"
                                                                                placeholder="Mức thu">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="exampleInputPassword1">Đơn vị
                                                                                tính <span>*</span></label>
                                                                            <select style="width: 100%" 
                                                                            @if($item->mac_dinh >= 1)
                                                                                disabled
                                                                                @else
                                                                                name="don_vi_tinh"
                                                                                @endif

                                                                                class="form-control m-input" id="">
                                                                                @foreach (config('common.don_vi_tinh')
                                                                                as $key => $don_vi)
                                                                                <option
                                                                                    {{$key == $item->don_vi_tinh ?'selected':''}}
                                                                                    value="{{$key}}">{{$don_vi}}
                                                                                </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>


                                                                </div>

                                                                <div class="m-form__group form-group">
                                                                    <label for="" class="mb-4">Phạm vi thu</label>
                                                                    <div class="m-radio-inline">
                                                                        <label class="m-radio m-radio--state-success">
                                                                            <input type="radio" @if ($item->pham_vi_thu
                                                                            == 0)
                                                                            checked
                                                                            @endif
                                                                            name="pham_vi_thu" value="0"> Toàn trường
                                                                            <span></span>
                                                                            @if ($item->mac_dinh ==2 ||$item->mac_dinh ==4 || $item->mac_dinh ==0 )
                                                                        <label class="m-radio m-radio--state-success">
                                                                            <input type="radio" @if ($item->pham_vi_thu
                                                                            == 1)
                                                                            checked
                                                                            @endif
                                                                            name="pham_vi_thu" value="1"> Khối
                                                                            <span></span>
                                                                        </label>
                                                                        @endif
                                                                        @if ($item->mac_dinh < 1)
                                                                        <label class="m-radio m-radio--state-success">
                                                                            <input type="radio" @if ($item->pham_vi_thu
                                                                            == 2)
                                                                            checked
                                                                            @endif
                                                                            name="pham_vi_thu" value="2"> Lớp
                                                                            <span></span>
                                                                        </label>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="form-group m-form__group box_chon_khoi" 
                                                                @if($item->pham_vi_thu == 1)
                                                                    style="display: block"
                                                                    @else
                                                                    style="display: none"
                                                                    @endif
                                                                    >
                                                                    <label for="exampleSelect1">Chọn Khối
                                                                        <span>*</span></label>
                                                                    <select style="width: 100%" multiple="multiple"
                                                                        name="id_khoi_thu[]"
                                                                        class="form-control m-input m-select2 chon_khoi">
                                                                        @foreach ($khoi as $value_khoi)
                                                                        <option @if ($item->pham_vi_thu == 1)
                                                                            @foreach ($item->PhamViThu as $pham_vi_thu)
                                                                            @if ($pham_vi_thu->id_khoi_lop_thu ==
                                                                            $value_khoi->id)
                                                                            selected
                                                                            @endif
                                                                            @endforeach
                                                                            @endif
                                                                            value="{{$value_khoi->id}}">{{$value_khoi->ten_khoi}}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group m-form__group box_chon_lop"
                                                                 @if($item->pham_vi_thu == 2)
                                                                    style="display: block"
                                                                    @else
                                                                    style="display: none"
                                                                    @endif
                                                                    id="">
                                                                    <label for="exampleSelect1">Chọn Lớp
                                                                        <span>*</span></label>
                                                                    <select style="width: 100%" multiple="multiple"
                                                                        name="id_lop_thu[]"
                                                                        class="form-control m-input m-select2 chon_lop"
                                                                        id="">
                                                                        @foreach ($khoi as $value_khoi)
                                                                        <optgroup label="{{$value_khoi->ten_khoi}}">
                                                                            @foreach ($value_khoi->LopHoc as $lop_hoc)
                                                                            <option @if ($item->pham_vi_thu == 2)
                                                                                @foreach ($item->PhamViThu as
                                                                                $pham_vi_thu)
                                                                                @if ($pham_vi_thu->id_khoi_lop_thu ==
                                                                                $lop_hoc->id)
                                                                                selected
                                                                                @endif
                                                                                @endforeach
                                                                                @endif
                                                                                value="{{$lop_hoc->id}}">{{$lop_hoc->ten_lop}}
                                                                            </option>
                                                                            @endforeach
                                                                        </optgroup>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="m-form__group form-group">
                                                                <div class="m-checkbox-list">
                                                                    
                                                               

                                                                    <label class="m-checkbox m-checkbox--state-success">
                                                                        <input @if ($item->theo_doi == 1)
                                                                        checked
                                                                        @endif
                                                                        type="checkbox" value="1" name="theo_doi"> Theo
                                                                        dõi
                                                                        <span></span>
                                                                    </label>
                                                                    @if ($item->mac_dinh == 0)
                                                                    
                                                                    <label class="m-checkbox m-checkbox--state-success">
                                                                        <input type="checkbox" @if ($item->mien_giam >
                                                                        0)
                                                                        checked
                                                                        @endif
                                                                        value="1" onclick="showHideNhapPhanTram(this)" > Áp dụng miễn giảm
                                                                        <span></span>
                                                                    </label>
                                                                 
                                                                 <div class="mien_giam input-group"
                                                                 @if ($item->mien_giam <= 0)
                                                                 style="display: none"
                                                                 @endif
                                                                 >
                                                                <input value="{{$item->mien_giam}}" type="number" name="mien_giam" class="form-control">
                                                                    <div class="input-group-append">
                                                                      <span class="input-group-text">%</span>
                                                                    </div>
                                                                  </div>
                                                                  @endif
                                                                    
                                                                 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Đóng</button>
                                                <button type="button" id="" style="display: none"
                                                    onclick="updateKhoanThu('form-sua-khoan-thu{{$item->id}}')"
                                                    class="btn btn-primary cap_nhat_khoan_thu">Cập nhật</button>
                                                <button type="button" id="" style="display: none"
                                                    onclick="copyKhoanThu('form-sua-khoan-thu{{$item->id}}')"
                                                    class="btn btn-primary copy_khoan_thu">Copy khoản thu</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    <!--end::Section-->
                </div>
            </div>

            <!--end::Portlet-->
        </div>
    </div>
    <!--End::Section-->

    {{-- modal thêm mới khoản thu --}}
    <div class="modal fade" id="them_khoan_thu" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm mới khoản thu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="m-form m-form--fit m-form--label-align-right " id="form-add-khoan-thu">
                        <div class="row">
                            <div class="col-md-9">

                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group">
                                        <label for="exampleInputEmail1">Tên khoản thu <span>*</span></label>
                                        <input type="text" name="ten_khoan_thu"
                                            class="form-control m-input m-input--square" aria-describedby="emailHelp"
                                            placeholder="Tên khoản thu">
                                    </div>
                                    <div class="form-group m-form__group">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <label for="exampleInputPassword1">Mức thu (VNĐ) <span>*</span></label>
                                                <input type="number" name="muc_thu"
                                                    class="form-control m-input m-input--square" placeholder="Mức thu">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="exampleInputPassword1">Đơn vị tính <span>*</span></label>
                                                <select style="width: 100%" name="don_vi_tinh"
                                                    class="form-control m-input" id="">
                                                    @foreach (config('common.don_vi_tinh') as $key => $don_vi)
                                                    <option value="{{$key}}">{{$don_vi}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="m-form__group form-group">
                                        <label for="" class="mb-4">Phạm vi thu</label>
                                        <div class="m-radio-inline">
                                            <label class="m-radio m-radio--state-success">
                                                <input type="radio" checked name="pham_vi_thu" value="0"> Toàn trường
                                                <span></span>
                                            </label>
                                            <label class="m-radio m-radio--state-success">
                                                <input type="radio" name="pham_vi_thu" value="1"> Khối
                                                <span></span>
                                            </label>
                                            <label class="m-radio m-radio--state-success">
                                                <input type="radio" name="pham_vi_thu" value="2"> Lớp
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group box_chon_khoi" style="display: none" id="">
                                        <label for="exampleSelect1">Chọn Khối <span>*</span></label>
                                        <select style="width: 100%" multiple="multiple" name="id_khoi_thu[]"
                                            class="form-control m-input m-select2 chon_khoi" id="">
                                            @foreach ($khoi as $item)
                                            <option value="{{$item->id}}">{{$item->ten_khoi}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group m-form__group box_chon_lop" style="display: none" id="">
                                        <label for="exampleSelect1">Chọn Lớp <span>*</span></label>
                                        <select style="width: 100%" multiple="multiple" name="id_lop_thu[]"
                                            class="form-control m-input m-select2 chon_lop" id="">
                                            @foreach ($khoi as $item)
                                            <optgroup label="{{$item->ten_khoi}}">
                                                @foreach ($item->LopHoc as $lop_hoc)
                                                <option value="{{$lop_hoc->id}}">{{$lop_hoc->ten_lop}}</option>
                                                @endforeach
                                            </optgroup>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="m-form__group form-group">
                                    <div class="m-checkbox-list">

                                        <label class="m-checkbox m-checkbox--state-success">
                                            <input type="checkbox" value="1" name="theo_doi"> Theo dõi
                                            <span></span>
                                        </label>
                                        <label class="m-checkbox m-checkbox--state-success">
                                            <input type="checkbox" onclick="showHideNhapPhanTram(this)"> Áp dụng miễn giảm
                                            <span></span>
                                        </label>
                                        <div class="input-group mien_giam"  style="display: none">
                                            <input type="text" value="0" name="mien_giam" class=" form-control">
                                            <div class="input-group-append">
                                              <span class="input-group-text">%</span>
                                            </div>
                                          </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" onclick="addKhoanThu()" class="btn btn-primary">Thêm mới</button>
                </div>
            </div>

        </div>
    </div>
    {{-- end modal thêm khoản thu --}}
</div>




@endsection
@section('script')
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    var datatable;
    $(document).ready( function () {
        
        $('.chon_khoi').select2()
        $('.chon_lop').select2()                                            
        datatable = $('#table-khoan-thu').DataTable({
            "bPaginate": false,
            "ordering": false,
        });
        $('#searchAll').keyup(function(){
            datatable.search($(this).val()).draw() ;
        })


        $("input[name='pham_vi_thu']").click(function(){
            // alert($(element))
            if($(this).val()==0){
                $('.box_chon_khoi').hide(300)
                $('.box_chon_lop').hide(300)
            }
            if($(this).val() == 1){
                $('.box_chon_khoi').show(300)
                $('.box_chon_lop').hide(300)

            }else if($(this).val() == 2){
                $('.box_chon_lop').show(300)
                $('.box_chon_khoi').hide(300)
            }
        })

       
    } );

    const checkAll = (e) => {
        $(e).parents('table').find('.checkbox').not(e).prop('checked', e.checked);
    };

    const url_tao_khoan_thu = "{{route('quan-ly-khoan-thu-store')}}"
    const url_get_danh_sach_khoan_thu = "{{route('quan-ly-khoan-thu-get-data')}}"
    const url_update_khoan_thu = "{{route('quan-ly-khoan-thu-update')}}"
    const url_copy_khoan_thu = "{{route('quan-ly-khoan-thu-copy')}}"
    const url_delete_khoan_thu = "{{route('quan-ly-khoan-thu-delete',['id'])}}"
    const url_delete_list_khoan_thu_id = "{{route('quan-ly-khoan-thu-delete-list')}}"

    
    const addKhoanThu = () =>{
        $('#preload').css('display', 'block');
            let myForm = document.getElementById('form-add-khoan-thu');
            let formData = new FormData(myForm);
            axios.post(url_tao_khoan_thu,formData)
            .then(function (response) {
                $('#preload').css('display', 'none');
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Thêm mới khoản thu thành công!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(
                    ()=> location.reload()
                    )
                
            })
            .catch(function (error) {
        $('#preload').css('display', 'none');
                var list_loi = error.response.data.errors
                var html_loi = ''
                for (const key in list_loi) {
                    if (Object.hasOwnProperty.call(list_loi, key)) {
                        const element = list_loi[key];
                        html_loi+=element+', '
                    }
                }
                Swal.fire({
                    icon: 'error',
                    text: html_loi,
                }) 
            })
            .then(function () {
                // always executed
            });  
        };

        const updateKhoanThu = (id_element) =>{
            let myForm = document.getElementById(id_element);
            let formData = new FormData(myForm);
            axios.post(url_update_khoan_thu,formData)
            .then(function (response) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Cập nhật khoản thu thành công!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(()=> location.reload())
            })
            .catch(function (error) {
                var list_loi = error.response.data.errors
                var html_loi = ''
                for (const key in list_loi) {
                    if (Object.hasOwnProperty.call(list_loi, key)) {
                        const element = list_loi[key];
                        html_loi+=element+', '
                    }
                }
                Swal.fire({
                    icon: 'error',
                    text: html_loi,
                }) 
            })
            .then(function () {
                // always executed
            });  
        };


        const copyKhoanThu = (id_element) =>{
            let myForm = document.getElementById(id_element);
            let formData = new FormData(myForm);
            axios.post(url_copy_khoan_thu,formData)
            .then(function (response) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Thêm mới khoản thu thành công!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(
                    ()=> location.reload()
                    )
            })
            .catch(function (error) {
                var list_loi = error.response.data.errors
                var html_loi = ''
                for (const key in list_loi) {
                    if (Object.hasOwnProperty.call(list_loi, key)) {
                        const element = list_loi[key];
                        html_loi+=element+', '
                    }
                }
                Swal.fire({
                    icon: 'error',
                    text: html_loi,
                }) 
            })
            .then(function () {
                
            });  
            }


        const deleteKhoanThu = (id) =>{
            url_delete_khoan_thu_id = url_delete_khoan_thu.replace('id',id)
            Swal.fire({
            title: 'Bạn có chắc chắn muốn xóa?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xóa !'
            }).then((result) => {
            if (result.value) {
            axios.get(url_delete_khoan_thu_id)
            .then(function (response) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Xóa khoản thu thành công!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(()=> location.reload())
            })
            .catch(function (error) {
                console.log(error);
            })
            .then(function () {
                // always executed
            });  
             }
            })
        };

        const capNhatorCopy = (type) =>{
            if(type==1){ 
                $('.copy_khoan_thu').hide()
                $('.cap_nhat_khoan_thu').show()
            }else{
                $('.copy_khoan_thu').show()
                $('.cap_nhat_khoan_thu').hide()
            }
        };
        const xoaListKhoanThu = () =>{
            let element_xoa = document.querySelectorAll('.checkbox')
            let danh_sach_xoa =  []
            element_xoa.forEach(element => {
                if($(element).prop('checked')){
                    danh_sach_xoa.push($(element).val());
                }
            });
            Swal.fire({
            title: 'Bạn có chắc chắn muốn xóa?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xóa !'
            }).then((result) => {
            if (result.value) {
            axios.post(url_delete_list_khoan_thu_id,danh_sach_xoa)
            .then(function (response) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Xóa khoản thu thành công!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(()=> location.reload())
                
            })
            .catch(function (error) {
                console.log(error);
            })
            .then(function () {
                // always executed
            });  
               
            }
            })
        };
        const showHideNhapPhanTram = (element) =>{
            if($(element).prop('checked')){
                console.log($(element).parents('.m-checkbox-list').find('.mien_giam'))
                $(element).parents('.m-checkbox-list').find('.mien_giam input').val(0)
                $(element).parents('.m-checkbox-list').find('.mien_giam').show()
            }else{
                $(element).parents('.m-checkbox-list').find('.mien_giam input').val(0)
                $(element).parents('.m-checkbox-list').find('.mien_giam').hide()  
            }
        };
       
</script>
@endsection
