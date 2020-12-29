@extends('layouts.main')
@section('title', "Chi tiết giáo viên")
@section('style')
<link href="{!!  asset('css_loading/css_loading.css') !!}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="m-content">
    <div class="row">
        <div class="col-xl-12">
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Chi tiết giáo viên: {{$data->ten}}
                            </h3>
                        </div>
                    </div>
                </div>
                <div id="preload" class="preload-container text-center" style="display: none">
                    <img id="gif-load" src="{!! asset('images/loading2.gif') !!}" alt="">
                </div>
                
                <div class="m-portlet__body">
                    <div class="m-section">
                        <div class="m-section__content">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-2 col-form-label">Khối</label>
                                        <div class="col-lg-8">
                                            <select class="form-control select2" disabled>
                                                <option value="">Không có</option>
                                                @foreach ($khoi as $item1)
                                                <option @if (isset($data->khoi_gv_id))
                                                    {{($item1->id == $data->khoi_gv_id  ) ? 'selected' : ''}}
                                                @endif 
                                                 value={{$item1->id}}>{{$item1->ten_khoi}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 ">
                                    <div class="form-group m-form__group row">
                                        <label for="" class="col-lg-2 col-form-label">Lớp</label>
                                        <div class="col-lg-8">
                                            <select class="form-control select2" disabled>
                                                <option value="" selected>Không có</option>
                                                @foreach ($lop_hoc as $item2)
                                               <option {{($item2->id == $data->lop_id  ) ? 'selected' : ''}}
                                                value="{{$item2->id}}">{{$item2->ten_lop}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group m-form__group row">
                                        <label for="" class="col-lg-2 col-form-label">Chức vụ</label>
                                        <div class="col-lg-8">
                                            <select class="form-control select2" name="lop_id" id="lop" disabled>
                                                <option value="">Không có</option>
                                                <option {{($data->type == 1) ? 'selected' : ''}} value = "1" >Giáo viên chính</option>
                                                <option {{($data->type == 2) ? 'selected' : ''}} value = "2">Giáo viên phụ</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                @if(count($LichSuDay) > 0 || $LichDayHienTaiGV)
                                <div class="col-md-12 mt-4">
                                    <h5><b>Lịch sử dạy</b></h5>
                                </div>
                                <div class="col-md-12">
                                    <div class="m-section">
                                        <div class="m-section__content">
                                            <table class="table">
                                                <thead class="thead-default" align="center">
                                                    <tr>
                                                        <th>STT</th>
                                                        <th>Năm học</th>
                                                        <th>Khối</th>
                                                        <th>Lớp</th>
                                                        <th>Chi tiết lớp</th>
                                                    </tr>
                                                </thead>
                                                <tbody align="center">
                                                    @php
                                                    $i = 1;
                                                    @endphp
                                                    @if($LichDayHienTaiGV)
                                                    <tr>
                                                        <th scope="row">{{$i++}}</th>
                                                        <td>{{$LichDayHienTaiGV->ten_nam}} (Hiện tại)</td>
                                                        <td>{{$LichDayHienTaiGV->ten_khoi}}</td>
                                                        <td>{{$LichDayHienTaiGV->ten_lop}}</td>
                                                        <td><a href="{{ route('quan-ly-lop-show',['id'=>$LichDayHienTaiGV->lop_id]) }}" class="btn btn-outline-dark m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--air">
                                                            <i class="fa fa-pen-alt"></i>
                                                        </a></td>
                                                    </tr>
                                                    @endif
                                                    @foreach($LichSuDay as $item)
                                                    <tr>
                                                        <th scope="row">{{$i++}}</th>
                                                        <td>{{$item->ten_nam}}</td>
                                                        <td>{{$item->ten_khoi}}</td>
                                                        <td>{{$item->ten_lop}}</td>
                                                        <td><a href="{{ route('quan-ly-lop-show',['id'=>$item->lop_id]) }}" class="btn btn-outline-dark m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--air">
                                                            <i class="fa fa-pen-alt"></i>
                                                        </a></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="m-portlet m-portlet--full-height">
                <div class="m-wizard m-wizard--2 m-wizard--success m-wizard--step-first" id="m_wizard">
                    <div class="m-wizard__form">

                        <div class="m-form m-form--label-align-left- m-form--state-" id="m_form"
                            >

                            <form method="post" action="{{route('quan-ly-giao-vien-update', ['id' => $data->id])}}" enctype="multipart/form-data">
                                @csrf
                            <div class="m-portlet__body">


                                <div class="m-wizard__form-step--current" id="m_wizard_form_step_1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="m-form__heading">
                                                <h3 class="m-form__heading-title" style="font-weight: bold">
                                                    Thông tin
                                                    <i data-toggle="m-tooltip" data-width="auto"
                                                        class="m-form__heading-help-icon flaticon-info" title=""
                                                        data-original-title="Some help text goes here"></i>
                                                </h3>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="m-form__section m-form__section--first">
                                                <div class="form-group m-form__group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                            class="text-danger"></span> Mã giáo viên: </label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <input type="text"  class="form-control m-input"
                                                         value="{{$data->ma_gv}}" disabled>
                                                        
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                            class="text-danger"></span> Họ và tên: </label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <input type="text" class="form-control m-input" name="ten"
                                                        placeholder="Điền họ và tên" value="{{ old('ten') ? old('ten') : $data->ten}}">
                                                        @error('ten')
                                                            <div class="has-danger">
                                                                <div class="form-control-feedback">{{ $message }}</div>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                            class="text-danger">*</span> Email: </label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <input type="text" name="email" class="form-control m-input name-field"
                                                            placeholder="Email" value="{{ old('email') ? old('email') : $data->email}}">
                                                        @error('email')
                                                            <div class="has-danger">
                                                                <div class="form-control-feedback">{{ $message }}</div>
                                                            </div>
                                                        @enderror   
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                            class="text-danger"></span>Ngày sinh:</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <input type="date" class="form-control m-input" name="ngay_sinh"
                                                        placeholder="Điền ngày sinh" value="{{ old('ngay_sinh') ? old('ngay_sinh') : $data->ngay_sinh}}">
                                                        @error('date')
                                                            <div class="has-danger">
                                                                <div class="form-control-feedback">{{ $message }}</div>
                                                            </div>
                                                        @enderror              
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                            class="text-danger">*</span>Giới tính</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <div class="m-radio-inline">
                                                            @foreach (config('common.gioi_tinh') as $key => $value)
                                                            <label class="m-radio">
                                                            <input type="radio" {{($data->gioi_tinh == $key  ) ? 'checked' : ''}} 
                                                                name="gioi_tinh" value="{{ $key }}"> {{ $value }}
                                                                <span></span>
                                                            </label>   
                                                            @endforeach
                                                        </div>
                                                        @error('gioi_tinh')
                                                            <div class="has-danger">
                                                                <div class="form-control-feedback">{{ $message }}</div>
                                                            </div>
                                                        @enderror  
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                            class="text-danger">*</span>Dân tộc</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        {{-- <input type="text" name="dan_toc" class="form-control m-input"
                                                        placeholder="Điền dân tộc" value="{{$data->dan_toc}}"> --}}
                                                        <select name="dan_toc" class="form-control m-input name-field select2" placeholder="Điền dân tộc">
                                                            @foreach (config('common.dan_toc') as $key => $value)
                                                                <option value="{{ $key }}"
                                                                        {{ old('dan_toc') ? 
                                                                        (old('dan_toc') == $key ? 'selected' : '') : 
                                                                        ($data->dan_toc == $key ? 'selected' : '')}}
                                                                >{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('dan_toc')
                                                            <div class="has-danger">
                                                                <div class="form-control-feedback">{{ $message }}</div>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                            class="text-danger">*</span> Số điện thoại:</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"><span
                                                                    class="input-group-text"><i
                                                                        class="la la-phone"></i></span></div>
                                                            <input type="text" name="dien_thoai" onkeypress="return isNumberKey(event)"
                                                                class="form-control m-input"
                                                                placeholder="Điền số điện thoại" value="{{ old('dien_thoai') ? old('dien_thoai') : $data->dien_thoai}}">
                                                        </div>
                                                        @error('dien_thoai')
                                                            <div class="has-danger">
                                                                <div class="form-control-feedback">{{ $message }}</div>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class=""></div>
                                            </div>

                                        </div>
                                        <div class="col-xl-6">
                                            <div class="m-form__section m-form__section--first">


                                                <div class="form-group m-form__group row">
                                                    <img onClick="showModal()" style="cursor: pointer"
                                                        src= {{ $data->anh == "" ? 'https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_960_720.png' : $data->anh}}
                                                        class="rounded mx-auto d-block mb-2 img-thumbnail" width="250px"
                                                        height="255px" id="show_img">
                                                    <div class="col-xl-9 col-lg-9 mt-4">
                                                        <div class="input-group ml-5 ">

                                                            <div class="custom-file ml-5 col-12">
                                                                <input type="file" accept="images/*" 
                                                                id="anh_gv" onClick="showModal()"onchange="changeAvatar(this)"
                                                                    style="display:none" />
                                                                <input type="hidden" name="anh" value="{{ $data->anh }}">

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                            <div class=""></div>
                                            <div class=""></div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mt-4">
                                            <div class="m-form__heading">
                                                <h3 class="m-form__heading-title" style="font-weight: bold">
                                                    CMND/Căn cước/Hộ chiếu
                                                    <i data-toggle="m-tooltip" data-width="auto"
                                                        class="m-form__heading-help-icon flaticon-info" title=""
                                                        data-original-title="Some help text goes here"></i>
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="m-form__section m-form__section--first">
                                                <div class="form-group m-form__group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">
                                                    <span class="text-danger">*</span>Số</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <div class="input-group">
                                                            <input type="text" name="so_cmtnd" onkeypress="return isNumberKey(event)"
                                                            class="form-control m-input" placeholder="Điền số chứng minh thư" 
                                                            value="{{ old('so_cmtnd') ? old('so_cmtnd') : $data->so_cmtnd}}">
                                                        </div>
                                                        @error('so_cmtnd')
                                                            <div class="has-danger">
                                                                <div class="form-control-feedback">{{ $message }}</div>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group m-form__group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">
                                                    <span class="text-danger">*</span>Ngày cấp</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <div class="input-group">
                                                        <input type="date" name="ngay_cap_cmtnd" class="form-control m-input" 
                                                        value="{{ old('ngay_cap_cmtnd') ? old('ngay_cap_cmtnd') : $data->ngay_cap_cmtnd}}">
                                                        </div>
                                                        @error('ngay_cap_cmtnd')
                                                            <div class="has-danger">
                                                                <div class="form-control-feedback">{{ $message }}</div>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="m-form__section m-form__section--first">
                                                <div class="form-group m-form__group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">
                                                    <span class="text-danger">*</span>Nơi cấp</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <select class="form-control select2"
                                                            name="noi_cap_cmtnd_matp" id="noi_cap_cmtnd_matp">
                                                            <option value="">Chọn</option>
                                                            @foreach ($thanhpho as $item)
                                                            <option
                                                                {{ old('noi_cap_cmtnd_matp') ? 
                                                                (old('noi_cap_cmtnd_matp') == $item->matp ? 'selected' : '') : 
                                                                ($data->noi_cap_cmtnd_matp == $item->matp ? 'selected' : '')}}
                                                            value="{{$item->matp}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('noi_cap_cmtnd_matp')
                                                            <div class="has-danger">
                                                                <div class="form-control-feedback">{{ $message }}</div>
                                                            </div>
                                                        @enderror
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mt-5">
                                            <div class="m-form__heading">
                                                <h3 class="m-form__heading-title" style="font-weight: bold">
                                                    Hộ khẩu thường trú
                                                    <i data-toggle="m-tooltip" data-width="auto"
                                                        class="m-form__heading-help-icon flaticon-info" title=""
                                                        data-original-title="Some help text goes here"></i>
                                                </h3>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="m-form__section m-form__section--first">
                                                <div class="form-group m-form__group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                            class="text-danger">*</span>Tỉnh/Thành phố</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <select class="form-control select2"
                                                            name="ho_khau_thuong_tru_matp" id="ho_khau_thuong_tru_matp">
                                                            <option value="">Chọn</option>
                                                            @foreach ($thanhpho as $item)
                                                            <option {{($data->ho_khau_thuong_tru_matp == $item->matp) ? "selected" : ""}}
                                                             value="{{$item->matp}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('ho_khau_thuong_tru_matp')
                                                            <div class="has-danger">
                                                                <div class="form-control-feedback">{{ $message }}</div>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                            class="text-danger">*</span>Quận/Huyện</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <select class="form-control select2"
                                                            name="ho_khau_thuong_tru_maqh" id="ho_khau_thuong_tru_maqh">
                                                            <option value="">Chọn</option>
                                                            @foreach ($maqh_gv_hktt as $item)
                                                            <option {{($data->ho_khau_thuong_tru_maqh == $item->maqh) ? "selected" : ""}}
                                                            value="{{$item->maqh}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('ho_khau_thuong_tru_maqh')
                                                            <div class="has-danger">
                                                                <div class="form-control-feedback">{{ $message }}</div>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">

                                            <div class="m-form__section m-form__section--first">
                                                <div class="form-group m-form__group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                            class="text-danger">*</span>Phường/Xã/Thị trấn:</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <select class="form-control select2"
                                                            name="ho_khau_thuong_tru_xaid" id="ho_khau_thuong_tru_xaid">
                                                            <option value="" selected>Chọn</option>
                                                            @foreach ($xaid_gv_hktt as $item)
                                                            <option {{($data->ho_khau_thuong_tru_xaid == $item->xaid) ? "selected" : ""}}
                                                            value="{{$item->xaid}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('ho_khau_thuong_tru_xaid')
                                                            <div class="has-danger">
                                                                <div class="form-control-feedback">{{ $message }}</div>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                            class="text-danger">*</span>Số nhà, đường </label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <input type="text" name="ho_khau_thuong_tru_so_nha" class="form-control m-input"
                                                        placeholder="Điền số nhà, đường" value="{{$data->ho_khau_thuong_tru_so_nha}}">
                                                        @error('ho_khau_thuong_tru_so_nha')
                                                            <div class="has-danger">
                                                                <div class="form-control-feedback">{{ $message }}</div>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>
                                            <div class=""></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mt-2">
                                            <div class="m-form__heading">
                                                <h3 class="m-form__heading-title" style="font-weight: bold">
                                                    Nơi ở hiện tại
                                                    <i data-toggle="m-tooltip" data-width="auto"
                                                        class="m-form__heading-help-icon flaticon-info" title=""
                                                        data-original-title="Some help text goes here"></i>
                                                </h3>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="m-form__section m-form__section--first">
                                                <div class="form-group m-form__group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                            class="text-danger">*</span>Tỉnh/Thành phố</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <select class="form-control select2" name="noi_o_hien_tai_matp"
                                                            id="noi_o_hien_tai_matp">
                                                            <option value="" selected>Chọn</option>
                                                            @foreach ($thanhpho as $item)
                                                            <option {{($data->noi_o_hien_tai_matp == $item->matp) ? "selected" : ""}}
                                                                value="{{$item->matp}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('noi_o_hien_tai_matp')
                                                            <div class="has-danger">
                                                                <div class="form-control-feedback">{{ $message }}</div>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                            class="text-danger">*</span>Quận/Huyện</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <select class="form-control select2"
                                                            name="noi_o_hien_tai_maqh" id="noi_o_hien_tai_maqh">
                                                            <option value="" selected>Chọn</option>
                                                            @foreach ($maqh_gv_noht as $item)
                                                            <option {{($data->noi_o_hien_tai_maqh == $item->maqh) ? "selected" : ""}}
                                                            value="{{$item->maqh}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('noi_o_hien_tai_maqh')
                                                            <div class="has-danger">
                                                                <div class="form-control-feedback">{{ $message }}</div>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">

                                            <div class="m-form__section m-form__section--first">
                                                <div class="form-group m-form__group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                            class="text-danger">*</span>Phường/Xã/Thị trấn:</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <select class="form-control select2"
                                                            name="noi_o_hien_tai_xaid" id="noi_o_hien_tai_xaid">
                                                            <option value="" selected>Chọn</option>
                                                            @foreach ($xaid_gv_noht as $item)
                                                            <option {{($data->noi_o_hien_tai_xaid == $item->xaid) ? "selected" : ""}}
                                                            value="{{$item->xaid}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('noi_o_hien_tai_xaid')
                                                            <div class="has-danger">
                                                                <div class="form-control-feedback">{{ $message }}</div>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                            class="text-danger">*</span>Số nhà, đường </label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <input type="text" name="noi_o_hien_tai_so_nha" class="form-control m-input"
                                                            placeholder="Điền số nhà, đường" value="{{$data->noi_o_hien_tai_so_nha}}">
                                                        @error('noi_o_hien_tai_so_nha')
                                                            <div class="has-danger">
                                                                <div class="form-control-feedback">{{ $message }}</div>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>
                                            <div class=""></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="m-form__heading">
                                                <h3 class="m-form__heading-title" style="font-weight: bold">
                                                    Trình độ
                                                    <i data-toggle="m-tooltip" data-width="auto"
                                                        class="m-form__heading-help-icon flaticon-info" title=""
                                                        data-original-title="Some help text goes here"></i>
                                                </h3>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="m-form__section m-form__section--first">
                                                <div class="form-group m-form__group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                            class="text-danger">*</span>Trình độ</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <input type="text" name="trinh_do"  class="form-control m-input"
                                                        value="{{ old('trinh_do') ? old('trinh_do') : $data->trinh_do}}"
                                                        placeholder="Điền trình độ">
                                                        @error('trinh_do')
                                                            <div class="has-danger">
                                                                <div class="form-control-feedback">{{ $message }}</div>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                            class="text-danger">*</span>Chuyên môn</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <input type="text" name="chuyen_mon"  class="form-control m-input"
                                                        value="{{ old('chuyen_mon') ? old('chuyen_mon') : $data->chuyen_mon}}"
                                                        placeholder="Điền chuyên môn">
                                                        @error('chuyen_mon')
                                                            <div class="has-danger">
                                                                <div class="form-control-feedback">{{ $message }}</div>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="m-form__section m-form__section--first">
                                                <div class="form-group m-form__group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                            class="text-danger">*</span>Nơi đào tạo</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <input type="text" name="noi_dao_tao" class="form-control m-input"
                                                        value="{{ old('noi_dao_tao') ? old('noi_dao_tao') : $data->noi_dao_tao}}"
                                                        placeholder="Điền nơi đào tạo">
                                                        @error('noi_dao_tao')
                                                            <div class="has-danger">
                                                                <div class="form-control-feedback">{{ $message }}</div>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                            class="text-danger">*</span>Năm tốt nghiệp </label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <input type="text" onkeypress="return isNumberKey(event)" name="nam_tot_nghiep" class="form-control m-input" maxlength="4" minlength="4"
                                                        value="{{ old('nam_tot_nghiep') ? old('nam_tot_nghiep') : $data->nam_tot_nghiep}}"
                                                        placeholder="Điền năm tốt nghiệp">
                                                        @error('nam_tot_nghiep')
                                                            <div class="has-danger">
                                                                <div class="form-control-feedback">{{ $message }}</div>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>
                                            <div class=""></div>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="col-md-12 d-flex justify-content-end">
                                    <div class="m-form__actions">
                                    <a href="{{route('quan-ly-giao-vien-index')}}"><button type="button" class="btn btn-danger">Hủy</button></a>
                                        <button type="submit" class="btn btn-success">Cập nhật</button>
                                    </div>
                                </div>



                            </div>
                        </form>


                            
                    </div>

                </div>
                </div>
                

            </div>
        </div>
        
    </div>
</div>

@endsection
@section('script')
<script>
    function showimages(element) {
        var file = element.files[0];
        var reader = new FileReader();
        reader.onloadend = function() {
            $('#show_img').attr('src', reader.result);
        }
        reader.readAsDataURL(file);
    }

    $(document).ready(function() {
        $('.select2').select2();
    });

    var url_get_lop_theo_khoi = "{{route('quan-ly-giao-vien-get-lop-theo-khoi')}}";
    var url_get_maqh_by_matp = "{{route('get_quan_huyen_theo_thanh_pho')}}";
    var url_get_xaid_by_maqh = "{{route('get_xa_phuong_theo_thi_tran')}}";

    function changeAvatar(file){
        let srcAvatar = URL.createObjectURL(file.files[0]);
		$("#show_img").attr("src", srcAvatar);
		var form = new FormData();
            form.append("image", file.files[0]);
            $.ajax({
                "url": "https://api.imgbb.com/1/upload?key=87b235f7be4c2a2271db6c21bbf93bda",
                "method": "POST",
                "timeout": 0,
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": form
            }).done(function (response) {
                let rs = JSON.parse(response);
                let url = '';
                url = rs.data.display_url;
				$('[name="anh"]').val(url);
            });
    }

    function isNumberKey(evt){
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;
                return true;
    } 
</script>
<script src="{!! asset('js/get_quan_huyen_xa.js') !!}"></script>
@if(SESSION('thong_bao'))
<script>
    Swal.fire({
    position: 'top-center',
    icon: 'success',
    title: 'Cập nhật thành công',
    showConfirmButton: false,
    timer: 1500
    })
</script>
@endif
@endsection