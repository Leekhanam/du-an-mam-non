@extends('layouts.main') @section('title', "Quản lý đợt thu")
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<link href="{!!  asset('css_loading/css_loading.css') !!}" rel="stylesheet" type="text/css" />

<style>
    .m-widget4__item {
        cursor: pointer;
    }

    .title_lap_dot_thu {
        background-color: #38a738;
        padding: 10px 80px;
        cursor: pointer;
    }

    .title_lap_dot_thu>h3 {
        color: white !important
    }

    .bat_buoc {
        color: red
    }

    /* .danh_sach_khoan_thu {
        height: 400px !important;
        overflow: auto;
    } */

    .ten_khoi {
        color: rgb(25, 0, 255);
        font-weight: bold !important
    }

    thead th {
        font-weight: bold !important
    }
    
</style>
<link href="{!! asset('vendors/perfect-scrollbar/css/perfect-scrollbar.css') !!}" rel="stylesheet" type="text/css" />
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
                                Quản lý đợt thu
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">

                    <!--begin::Section-->
                    <div class="m-section">
                        <div class="row">
                            <div class="col-xl-3">

                                <!--begin:: Widgets/Download Files-->
                                <div class="m-portlet m-portlet--full-height ">
                                    <div class="m-portlet__head justify-content-center">
                                        <div class="m-portlet__head-caption">
                                            @if ($kiem_tra_nam_hoc_moi)
                                            <div class="m-portlet__head-title title_lap_dot_thu" data-toggle="modal"
                                            data-target="#modal_tao_dot_thu">
                                            <h3 class="m-portlet__head-text">
                                                Lập đợt thu
                                            </h3>
                                        </div>
                                            @endif
                                            
                                        </div>
                                    </div>
                                    <div class="m-portlet__body">

                                        <!--begin::m-widget4-->
                                        <div class="m-widget4">
                                            @if (count($dot_thu)>0)

                                            @foreach ($dot_thu as $key => $item)
                                            <a href="{{route('quan-ly-dot-thu-index',['id'=>$item->id])}}">
                                                <div class="m-widget4__item p-2"
                                                 {{-- @if ($key==0)
                                                    style="background-color: #d9edda" @endif> --}}
                                                    @if ($data_dot_thu->id==$item->id)
                                                    style="background-color: #d9edda" @endif>
                                                    <div class="m-widget4__img m-widget4__img--icon">
                                                        <i class="flaticon-event-calendar-symbol"></i>
                                                    </div>
                                                    <div class="m-widget4__info">
                                                        <span class="m-widget4__text">
                                                            Tháng {{$item->thang_thu}}/{{$item->nam_thu}}
                                                            ({{count($item->ChiTietDotThuTien)}} đợt)
                                                        </span>
                                                    </div>

                                                </div>
                                            </a>
                                            @endforeach                 
                                            @endif
                                        </div>

                                        <!--end::Widget 9-->
                                    </div>
                                </div>

                                <!--end:: Widgets/Download Files-->
                            </div>
                            {{-- @if (count($data_dot_thu)>0){ --}}

                            @if ($data_dot_thu!=null)
                            <div class="col-xl-9">
                                <div class="m-portlet">
                                    <div class="m-portlet__head d-flex justify-content-between">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title ">
                                                <div class="m-portlet__head-text">
                                                    Tháng {{$data_dot_thu->thang_thu}}/{{$data_dot_thu->nam_thu}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title ">
                                                <div class="m-portlet__head-text">
                                                    <a href="" target="_blank" type="button" id="xem-chi-tiet"
                                                        class="btn btn-success ">Xem chi tiết</a>

                                                    {{-- <button type="button" class="btn btn-light"><i
                                                            style="font-size: 22px" class="la la-print"></i></button> --}}
                                                    <div type="button" id="xem-chi-tiet" data-toggle="modal"
                                                        data-target="#thong_bao_theo_khoi"
                                                        class="btn btn-success ml-2 ">Gửi thông báo khối</div>
                                                    <button data-toggle="modal" data-target="#xoa_dot_thu" type="button" class="btn btn-light  ">
                                                        <i  class="flaticon-delete"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    {{-- modal gửi thông báo theo khối --}}
                                    <div class="modal fade" id="thong_bao_theo_khoi" role="dialog">
                                        <div class="modal-dialog modal-lg">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Gửi thông báo</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form action="" id="form_gui_thong_bao_theo_khoi" method="post">
                                                    <div class="modal-body">
                                                        <div class="form-group m-form__group">
                                                            <label for="exampleInputEmail1">Chọn khối <span
                                                                    class="bat_buoc">*</span></label>
                                                            <select name="id_khoi" class="form-control m-input m-input--square"
                                                                id="exampleSelect1">
                                                                @foreach ($nam_hoc_moi->Khoi as $item)
                                                                <option value="{{$item->id}}">{{$item->ten_khoi}}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group m-form__group">
                                                            <label for="exampleInputEmail1">Chọn đợt thu <span
                                                                    class="bat_buoc">*</span></label>
                                                            <select name="dot_thu" class="form-control m-input m-input--square"
                                                                id="exampleSelect1">
                                                                @if ($data_dot_thu!=null)
                                                                @foreach ($data_dot_thu->ChiTietDotThuTien as
                                                                $chi_tiet_dot)
                                                                <option value="{{$chi_tiet_dot->id}}">
                                                                    {{$chi_tiet_dot->ten_dot_thu}}</option>
                                                                @endforeach
                                                            </select>
                                                                @endif
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for="exampleInputEmail1">Thông báo thu tiền <span
                                                                        class="bat_buoc">*</span></label>
                                                                <select name="trang_thai_thong_bao" class="form-control m-input m-input--square"
                                                                    id="exampleSelect1">
                                                                    <option value="1">Thông báo thu tiền</option>
                                                                    <option value="2">Thông báo hủy thu tiền</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="exampleInputEmail1">Dư kiến thu từ ngày
                                                                    <span class="bat_buoc">*</span></label>
                                                                <input name="ngay_bat_dau" type="date" class="form-control m-input"
                                                                    id="exampleInputPassword1" placeholder="Password">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="exampleInputEmail1">Đến ngày <span
                                                                        class="bat_buoc">*</span></label>
                                                                <input name="ngay_ket_thuc" type="date" class="form-control m-input"
                                                                    id="exampleInputPassword1" placeholder="Password">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Đóng</button>
                                                        <button type="button" onclick="GuiThongBaoTheoKhoi()"
                                                            class="btn btn-primary">Gửi thông báo</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                    {{-- end thông báo theo khối--}}

                                    <!--begin::Section-->
                                    <div class="m-section__content">
                                        <div class="row">
                                            <div class="col-xl-4">

                                                <!--begin:: Widgets/Download Files-->
                                                <div class="m-portlet m-portlet--full-height ">
                                                    <div class="m-scrollable" data-scrollable="true" style="height: 400px">
                                                        <div class="m-portlet__body danh_sach_khoan_thu">

                                                            <!--begin::m-widget4-->

                                                            <div class="m-form__group form-group">
                                                                <label>Phạm vi</label>

                                                                <div class="m-radio-list">
                                                                    <label class="m-radio m-radio--state-success">
                                                                        <input type="radio" onclick="chiTietHocPhiKhoi(0)"
                                                                            checked name="example_2" value="0">
                                                                        Tất cả
                                                                        <span></span>
                                                                    </label>
                                                                    @foreach ($nam_hoc_moi->Khoi as $chi_tiet_khoi)
                                                                    <label class="m-radio m-radio--state-success">
                                                                        <input
                                                                            onclick="chiTietHocPhiKhoi({{$chi_tiet_khoi->id}})"
                                                                            type="radio" name="example_2"
                                                                            value="{{$chi_tiet_khoi->id}}">
                                                                        {{$chi_tiet_khoi->ten_khoi}}
                                                                        <span></span>
                                                                    </label>
                                                                    @endforeach

                                                                </div>
                                                            </div>

                                                            <div class="m-form__group form-group">
                                                                @if ($data_dot_thu!=null)
                                                                @foreach ($data_dot_thu->ChiTietDotThuTien as $chi_tiet_dot)
                                                                <label data-toggle="modal" data-target="#chi_tiet_dot{{$chi_tiet_dot->id}}" class="pt-3 pb-2 ">Khoản thu
                                                                    {{$chi_tiet_dot->ten_dot_thu}}<i style="cursor: pointer" class="flaticon-search ml-3"></i>  
                                                                    <div class="modal fade" id="chi_tiet_dot{{$chi_tiet_dot->id}}" role="dialog">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLabel">Khoản thu {{$chi_tiet_dot->ten_dot_thu}}</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">×</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <table class="table">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>Khối lớp</th>
                                                                                                <th>Số thu</th>
                                                                                                <th>Số đã thu</th>
                                                                                                <th>Số còn phải thu</th>
                                                                                                <th>Thông báo</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            @foreach ($chi_tiet_dot->tien_theo_tung_dot as $tien_theo_dot)
                    
                                                                                                <tr>
                                                                                                    <th scope="row">{{$tien_theo_dot['ten_khoi']}}</th>
                                                                                                    <td>{{number_format($tien_theo_dot['tong_tien_phai_dong'])}}</td>
                                                                                                    <td>{{number_format($tien_theo_dot['so_da_thu'])}}</td>
                                                                                                    <td>{{number_format($tien_theo_dot['con_phai_thu'])}}</td>
                                                                                                    <td>{{number_format($tien_theo_dot['so_luong_da_thong_bao'])}}/{{$tien_theo_dot['so_luong_chua_thong_bao']}}</td>
                                                                                          
                                                                                                </tr>
                                                                                            
                                                                                            @endforeach
                                                                                           
                                                                                
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-primary">Đóng</button>
                                                                                </div>
                                                                            </div>
                                                                   
                                                                          
                                                                        </div>
                                                                      </div>
                                                                </label>
                                                                <div class="m-checkbox-list">
                                                                    @foreach ($chi_tiet_dot->KhoanThu as
                                                                    $khoan_thu_chi_tiet)
                                                                    <div style="cursor: pointer" class="mb-3" data-toggle="modal" data-target="#sua_khoan_thu{{$khoan_thu_chi_tiet->id}}">
                                                                        
                                                                        <i style="cursor: pointer; color: rgb(11, 245, 69)" class="flaticon-questions-circular-button mr-3"></i>
                                                                        {{$khoan_thu_chi_tiet->ten_khoan_thu}} 
                                                                        <span></span>
                                                                        
                                                                    </div>

                                                                    <div class="modal fade" id="sua_khoan_thu{{$khoan_thu_chi_tiet->id}}" role="dialog">
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
                                                                                        id="form-sua-khoan-thu{{$khoan_thu_chi_tiet->id}}">
                                                                                        <div class="row">
                                                                                            <div class="col-md-9">
                                                                                                <input type="hidden" value="{{$khoan_thu_chi_tiet->id}}"
                                                                                                    name="id_sua_khoan_thu">
                                                                                                <div class="m-portlet__body">
                                                                                                    <div class="form-group m-form__group">
                                                                                                        <label for="exampleInputEmail1">Tên khoản thu
                                                                                                            <span>*</span></label>
                                                                                                        <input type="text" @if ($khoan_thu_chi_tiet->mac_dinh >= 1)
                                                                                                        disabled
                                                                                                        @else
                                                                                                        name="ten_khoan_thu"
                                                                                                        @endif
                                    
                                                                                                        value="{{$khoan_thu_chi_tiet->ten_khoan_thu}}"
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
                                                                                                                    value="{{$khoan_thu_chi_tiet->muc_thu}}"
                                                                                                                    placeholder="Mức thu">
                                                                                                            </div>
                                                                                                            <div class="col-md-4">
                                                                                                                <label for="exampleInputPassword1">Đơn vị
                                                                                                                    tính <span>*</span></label>
                                                                                                                <select style="width: 100%" 
                                                                                                                @if($khoan_thu_chi_tiet->mac_dinh >= 1)
                                                                                                                    disabled
                                                                                                                    @else
                                                                                                                    name="don_vi_tinh"
                                                                                                                    @endif
                                    
                                                                                                                    class="form-control m-input" id="">
                                                                                                                    @foreach (config('common.don_vi_tinh')
                                                                                                                    as $key => $don_vi)
                                                                                                                    <option
                                                                                                                        {{$key == $khoan_thu_chi_tiet->don_vi_tinh ?'selected':''}}
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
                                                                                                                <input type="radio" @if ($khoan_thu_chi_tiet->pham_vi_thu
                                                                                                                == 0)
                                                                                                                checked
                                                                                                                @endif
                                                                                                                name="pham_vi_thu" value="0"> Toàn trường
                                                                                                                <span></span>
                                                                                                                @if ($khoan_thu_chi_tiet->mac_dinh ==2 ||$khoan_thu_chi_tiet->mac_dinh ==4 || $khoan_thu_chi_tiet->mac_dinh ==0 )
                                                                                                            <label class="m-radio m-radio--state-success">
                                                                                                                <input type="radio" @if ($khoan_thu_chi_tiet->pham_vi_thu
                                                                                                                == 1)
                                                                                                                checked
                                                                                                                @endif
                                                                                                                name="pham_vi_thu" value="1"> Khối
                                                                                                                <span></span>
                                                                                                            </label>
                                                                                                            @endif
                                                                                                            @if ($khoan_thu_chi_tiet->mac_dinh < 1)
                                                                                                            <label class="m-radio m-radio--state-success">
                                                                                                                <input type="radio" @if ($khoan_thu_chi_tiet->pham_vi_thu
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
                                                                                                    @if($khoan_thu_chi_tiet->pham_vi_thu == 1)
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
                                                                                                            @foreach ($nam_hoc_moi->Khoi as $value_khoi)
                                                                                                            <option @if ($khoan_thu_chi_tiet->pham_vi_thu == 1)
                                                                                                                @foreach ($khoan_thu_chi_tiet->PhamViThu as $pham_vi_thu)
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
                                                                                                     @if($khoan_thu_chi_tiet->pham_vi_thu == 2)
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
                                                                                                            @foreach ($nam_hoc_moi->Khoi as $value_khoi)
                                                                                                            <optgroup label="{{$value_khoi->ten_khoi}}">
                                                                                                                @foreach ($value_khoi->LopHoc as $lop_hoc)
                                                                                                                <option @if ($khoan_thu_chi_tiet->pham_vi_thu == 2)
                                                                                                                    @foreach ($khoan_thu_chi_tiet->PhamViThu as
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
                                                                                                            <input @if ($khoan_thu_chi_tiet->theo_doi == 1)
                                                                                                            checked
                                                                                                            @endif
                                                                                                            type="checkbox" value="1" name="theo_doi"> Theo
                                                                                                            dõi
                                                                                                            <span></span>
                                                                                                        </label>
                                                                                                        @if ($khoan_thu_chi_tiet->mac_dinh !=2)
                                                                                                        
                                                                                                        <label class="m-checkbox m-checkbox--state-success">
                                                                                                            <input type="checkbox" @if ($khoan_thu_chi_tiet->mien_giam >
                                                                                                            0)
                                                                                                            checked
                                                                                                            @endif
                                                                                                            value="1"  > Áp dụng miễn giảm
                                                                                                            <span></span>
                                                                                                        </label>
                                                                                                     
                                                                                                     <div class="mien_giam input-group"
                                                                                                     @if ($khoan_thu_chi_tiet->mien_giam <= 0)
                                                                                                     style="display: none"
                                                                                                     @endif
                                                                                                     >
                                                                                                    <input value="{{$khoan_thu_chi_tiet->mien_giam}}" type="number" name="mien_giam" class="form-control">
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
                                                                            
                                                                                </div>
                                                                            </div>
                                    
                                                                        </div>
                                                                    </div>

                                                                    @endforeach
                                                                </div>
                                                                @endforeach
                                                                @endif

                                                            </div>



                                                            <!--end::Widget 9-->
                                                        </div>
                                                </div>
                                                </div>

                                                <!--end:: Widgets/Download Files-->
                                            </div>
                                            <div class="col-xl-8">
                                                <div class="m-portlet m-portlet--full-height ">
                                                    <div class="m-portlet__body">

                                                        <!--begin::m-widget4-->

                                                        <table
                                                            class="table table-striped m-table m-table--head-bg-success">
                                                            <thead>
                                                                <tr>
                                                                    <th>Khối lớp</th>
                                                                    <th>Số thu</th>
                                                                    <th>Số đã thu</th>
                                                                    <th>Số còn phải thu</th>
                                                                    <th>Thông báo</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="danh_sach_tien_theo_khoi">
                                                                @foreach ($danh_sach_thu_tien_theo_khoi as
                                                                $danh_sach_khoi_thu)
                                                                <tr>
                                                                    <th class="ten_khoi" scope="row">
                                                                        {{$danh_sach_khoi_thu->ten_khoi}}</th>
                                                                    <td>{{number_format($danh_sach_khoi_thu->tong_tien_phai_dong)}}
                                                                    </td>
                                                                    <td>{{number_format($danh_sach_khoi_thu->so_da_thu)}}
                                                                    </td>
                                                                    <td>{{number_format($danh_sach_khoi_thu->con_phai_thu)}}
                                                                    </td>
                                                                    <td>{{$danh_sach_khoi_thu->so_luong_da_thong_bao}}/{{$danh_sach_khoi_thu->so_luong_chua_thong_bao}}
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                                <tr class="bg-danger tfooter " style="font-weight: bold; color: white">
                                                                    <td scope="row">Tổng Số</td>
                                                                    <td>{{number_format($tong_tien_toan_bo['tong_tien_phai_dong'])}}
                                                                    </td>
                                                                    <td>{{number_format($tong_tien_toan_bo['so_da_thu'])}}
                                                                    </td>
                                                                    <td>{{number_format($tong_tien_toan_bo['con_phai_thu'])}}
                                                                    </td>
                                                                    <td>{{$tong_tien_toan_bo['so_luong_da_thong_bao']}}/{{$tong_tien_toan_bo['so_luong_chua_thong_bao']}}
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>



                                                        <!--end::Widget 9-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!--end::Section-->
                                    </div>
                                </div>
                            </div>
                            @endif
                            {{-- }
                                
                        @endif --}}
                        </div>
                    </div>

                    <!--end::Section-->
                </div>
            </div>

            <!--end::Portlet-->
        </div>
    </div>
    <!--End::Section-->
</div>

{{-- start modal tạo đợt mới --}}
<div class="modal fade" id="modal_tao_dot_thu" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Lập đợt thu
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-section">

                        <div class="form-group m-form__group">
                            <label for="">Tên đợt thu <span class="bat_buoc">*</span></label>
                            <input type="text" id="ten_dot_thu" class="form-control m-input m-input--square"
                                placeholder="Tên đợt thu">
                        </div>
                        <div class="form-group m-form__group">
                            <label for="exampleInputPassword1">
                                Chọn tháng
                                <span>*</span></label>
                            <select style="width: 100%" name="thoi_gian_thu" class="form-control m-input"
                                id="thoi_gian_thu">
                                @foreach ($thang_trong_nam as $thang_nam)
                                <option {{$thang_nam}} value="{{$thang_nam}}">{{$thang_nam}}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>
                    <!--begin::Section-->
                    <div class="m-section">
                        <span class="m-section__sub">
                            Danh sách các khoản cần thu <span class="bat_buoc">*</span>
                        </span>
                        <div class="m-section__content">
                            <table class="table table-striped m-table m-table--head-bg-brand">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" onclick="checkAll(this)" name="" id=""></th>
                                        <th>Khoản thu</th>
                                        <th>Số tiền (VNĐ)</th>
                                        <th>Đơn vị</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($khoan_thu as $item)
                                    <tr>
                                        <th scope="row"><input type="checkbox" class="checkbox" value="{{$item->id}}"
                                                name="" id=""></th>
                                        <td>{{$item->ten_khoan_thu}}</td>
                                        <td>{{number_format($item->muc_thu)}}</td>
                                        <td>{{config('common.don_vi_tinh')[$item->don_vi_tinh]}}</td>
                                    </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!--end::Section-->
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" onclick="lapDotThu()" class="btn btn-primary">Đồng ý</button>
                </div>

                <!--end::Form-->
            </div>
        </div>

    </div>
</div>
{{-- end modal tạo đợt mới --}}


 <!-- The Modal xóa đợt thu -->
 @if (count($dot_thu)>0)
 <div class="modal fade" id="xoa_dot_thu">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tháng {{$data_dot_thu->thang_thu}}/{{$data_dot_thu->nam_thu}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group m-form__group">
                    <label for="exampleSelect1">Chọn đợt cần xóa</label>
                <input type="hidden" name="thang_thu" id="thang_thu" value="{{$data_dot_thu->id}}">
                    <select class="form-control m-input m-input--square"  id="dot_thu_can_xoa">
                       @foreach ($data_dot_thu->ChiTietDotThuTien as $item)
                            <option value="{{$item->id}}">{{$item->ten_dot_thu}}</option>
                       @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button"  onclick="xoaDotThu()" class="btn btn-primary">Xóa đợt thu</button>
            </div>
        </div>
    </div>
  </div>

@endif

@endsection
@section('script')
<script src="{!! asset('vendors/perfect-scrollbar/dist/perfect-scrollbar.js') !!}" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    const url_tao_dot_thu = "{{route('quan-ly-dot-thu-store')}}";
    const url_tong_tien_thu_theo_khoi = "{{route('get-tong-tien-thu-theo-khoi')}}";
    var url_chi_tiet_dot_thu_theo_khoi_fake = "{{route('get-chi-tiet-dot-thu',['id','khoi'])}}";
    var url_gui_thong_bao_theo_khoi = "{{route('gui-thong-bao-theo-khoi')}}";
    var url_delete_dot_thu = "{{route('quan-ly-dot-thu-delete')}}";
 
    
    
    $(document).ready( function () {
        $('.chon_khoi').select2()
        $('.chon_lop').select2()      
        $("body").addClass('m-aside-left--minimize m-brand--minimize')
    });
    const checkAll = (e) => {
        $(e).parents('table').find('.checkbox').not(e).prop('checked', e.checked);
    };
    // location.replace(document.referrer);
    // window.location.reload(history.back());
    window.addEventListener( "pageshow", function ( event ) {
  var historyTraversal = event.persisted ||  ( typeof window.performance != "undefined" && window.performance.navigation.type === 2 );
    if ( historyTraversal ) {
        window.location.reload();
    }
    });
    const lapDotThu = () =>{
        $('#preload').css('display', 'block');
        let element_add = document.querySelectorAll('.checkbox')
            let danh_sach_khoan_thu_cua_dot =  []
            element_add.forEach(element => {
                if($(element).prop('checked')){
                    danh_sach_khoan_thu_cua_dot.push($(element).val());
                }
            });
        axios.post(url_tao_dot_thu,{
            'ten_dot_thu' : $('#ten_dot_thu').val(),
            'thoi_gian_thu' : $('#thoi_gian_thu').val(),
            'danh_sach_khoan_thu_cua_dot' : danh_sach_khoan_thu_cua_dot
        })
            .then(function (response) {
                $('#preload').css('display', 'none');
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Thêm mới đợt thu thành công!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(
                    ()=> location.href = "{{route('quan-ly-dot-thu-index',['id'=>0])}}"
                    )
            })
            .catch(function (error) {
                $('#preload').css('display', 'none');
                console.log(error.response.data.errors.ten_dot_thu[0])
                Swal.fire({
                    icon: 'error',
                    text: `${error.response.data.errors.ten_dot_thu[0]}`,
                }) 
            })
            .then(function () {
                // always executed
            });  
    };
    const chiTietHocPhiKhoi = (id)=>{
        $('#preload').css('display', 'block');
            axios.post(url_tong_tien_thu_theo_khoi,{
                'id_khoi': id,
                'id_dot_thu':{{$id}}
            })
            .then(function (response) {
                $('#preload').css('display', 'none');
                var html_data_show=''
                console.log(response.data)
                response.data.danh_sach_show.forEach(element => {
                    html_data_show += `
                    <tr>
                        <th class="ten_khoi" scope="row">${element.ten_khoi}</th>
                        <td>${element.tong_tien_phai_dong.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")}</td>
                        <td>${element.so_da_thu.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")}</td>
                        <td>${element.con_phai_thu.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")}</td>
                        <td>${element.so_luong_da_thong_bao}/${element.so_luong_chua_thong_bao}</td>
                    </tr>  
                    `
                });
                html_data_show+=`
                <tr  class="bg-danger" style="font-weight: bold; color: white">
                        <td scope="row">Tổng số</td>
                        <td>${response.data.tong_quat.tong_tien_phai_dong.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")}</td>
                        <td>${response.data.tong_quat.so_da_thu.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")}</td>
                        <td>${response.data.tong_quat.con_phai_thu.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")}</td>
                        <td>${response.data.tong_quat.so_luong_da_thong_bao}/${response.data.tong_quat.so_luong_chua_thong_bao}</td>
                </tr>  
                `

                $('.danh_sach_tien_theo_khoi').html(html_data_show)
                var url_chi_tiet_dot_thu_theo_khoi = url_chi_tiet_dot_thu_theo_khoi_fake.replace('id',{{$id}}).replace('khoi',id);
                $('#xem-chi-tiet').attr('href',url_chi_tiet_dot_thu_theo_khoi)
            })
            .catch(function (error) {
                console.log(error);
            })
            .then(function () {
                // always executed
            }); 
    };

    const GuiThongBaoTheoKhoi = () =>{
        $('#preload').css('display', 'block');
        let myForm = document.getElementById('form_gui_thong_bao_theo_khoi');
        let formData = new FormData(myForm);
        axios.post(url_gui_thong_bao_theo_khoi,formData)
            .then(function (response) {
                $('#preload').css('display', 'none');
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Gửi thông báo thành công!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(
                    ()=> location.href = "{{route('quan-ly-dot-thu-index',['id'=>0])}}"
                    )
            })
            .catch(function (error) {
                $('#preload').css('display', 'none');

                Swal.fire({
                    icon: 'error',
                    text: `Thời gian không hợp lệ`,
                }) 
            })
            .then(function () {
                // always executed
            });  
    };

    const xoaDotThu = () =>{
        Swal.fire({
            title: 'Bạn có chắc chắn muốn xóa đợt thu này?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xóa !'
            }).then((result) => {
                if(result.isConfirmed){
                    axios.post(url_delete_dot_thu,{
                    'id_chi_tiet_dot_thu' : $('#dot_thu_can_xoa').val(),
                    'id_dot_thu' : $('#thang_thu').val(),
                })
                .then(function (response) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Xóa đợt thu thành công!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(
                        ()=> location.href = "{{route('quan-ly-dot-thu-index',['id'=>0])}}"
                        )
                })
                .catch(function (error) {
                    Swal.fire({
                    icon: 'error',
                    text: `Đã có học sinh đóng tiền trong đợt không thể xóa !`,
                }) 
                })
                .then(function () {
                    // always executed
                });  
                }
              
            })
    };
       
</script>
@endsection