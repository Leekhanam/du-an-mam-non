@extends('layouts.main')
@section('title', "Thêm mới giáo viên")
@section('style')
<link href="{!!  asset('css_loading/css_loading.css') !!}" rel="stylesheet" type="text/css" />
<style>
    .error {
        color: red;
    }
</style>
@endsection
@section('content')
<div class="m-content">
    <div id="preload" class="preload-container text-center" style="display: none">
        <img id="gif-load" src="https://icon-library.com/images/loading-gif-icon/loading-gif-icon-17.jpg" alt="">
    </div>
    <form method="post" id="validate-form-add" action="{{route('quan-ly-giao-vien-store')}}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xl-12">
            <div class="m-portlet m-portlet--full-height">
                <div class="m-wizard m-wizard--2 m-wizard--success m-wizard--step-first" id="m_wizard">
                    <div class="m-wizard__form">
                        <div class="m-form m-form--label-align-left- m-form--state-" id="m_form">
                            <div class="m-portlet__body">
                                <div class=" m-wizard__form-step--current" id="m_wizard_form_step_1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="m-form__heading">
                                                <h3 class="m-form__heading-title" style="font-weight: bold">
                                                    Thông tin
                                                    <i data-toggle="m-tooltip" data-width="auto"
                                                        class="m-form__heading-help-icon flaticon-info" title=""
                                                        data-original-title="Thông tin giáo viên"></i>
                                                </h3>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="m-form__section m-form__section--first">
                                                <div class="form-group m-form__group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                            class="text-danger">*</span> Họ và tên: </label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <input type="text" name="ten" class="form-control m-input name-field"
                                                            placeholder="Điền họ và tên" value="{{ old('ten') }}">
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
                                                         placeholder="Email" value="{{ old('email') }}">
                                                            @error('email')
                                                            <div class="has-danger">
                                                                <div class="form-control-feedback">{{ $message }}</div>
                                                            </div>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                            class="text-danger">*</span>Ngày sinh:</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <input type="date" name="ngay_sinh" class="form-control m-input name-field"
                                                            placeholder="Điền ngày sinh"  value="{{ old('ngay_sinh') }}">
                                                            @error('ngay_sinh')
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
                                                                <input type="radio" @if(old('gioi_tinh') == $key) checked @endif name="gioi_tinh" value="{{ $key }}"> {{ $value }}
                                                                    <span></span>
                                                                </label>
                                                            @endforeach
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                            class="text-danger">*</span>Dân tộc</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                   
                                                            <select name="dan_toc" class="form-control m-input name-field select2" placeholder="Điền dân tộc">
                                                                @foreach (config('common.dan_toc') as $key => $value)
                                                                    <option value="{{ $key }}" {{ old('dan_toc') == $key ? 'selected' : ''}}>{{ $value }}</option>
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
                                                            <input type="text" name="dien_thoai" value="{{ old('dien_thoai') }}"
                                                                class="form-control m-input name-field"
                                                                onkeypress="return isNumberKey(event)"
                                                                placeholder="Điền số điện thoại">
                                                            
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
                                                    <img onClick="showModal()"
                                                        src="https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_960_720.png"
                                                        class="rounded mx-auto d-block mb-2" width="250px"
                                                        height="255px" id="show_img">
                                                    <div class="col-xl-9 col-lg-9 mt-4">
                                                        <div class="input-group ml-5 ">

                                                            <div class="custom-file ml-5 col-12">
                                                                <input type="file" accept="images/*"
                                                                    id="anh_gv" onClick="showModal()" onchange="changeAvatar(this)"
                                                                    style="display:none" />
                                                                    <input type="hidden" name="anh" value="">
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
                                                        data-original-title="CMND/Căn cước/Hộ chiếu giáo viên"></i>
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
                                                            <input type="text" name="so_cmtnd" class="form-control m-input" 
                                                            onkeypress="return isNumberKey(event)" value="{{ old('so_cmtnd') }}"
                                                            placeholder="Điền số chứng minh thư">
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
                                                        <input type="date" name="ngay_cap_cmtnd" value="{{ old('ngay_cap_cmtnd') }}" class="form-control m-input">
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
                                                                <option value="{{ $item->matp }}" {{old('noi_cap_cmtnd_matp') == $item->matp ? 'selected' : ''}}>{{$item->name}}</option>
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
                                                        data-original-title="Hộ khẩu thường trú giáo viên"></i>
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
                                                            <option value="" selected>Chọn</option>
                                                            @foreach ($thanhpho as $item)
                                                            <option value="{{$item->matp}}">{{$item->name}}</option>
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
                                                            <option value="" selected>Chọn</option>
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
                                                        <input type="text" name="ho_khau_thuong_tru_so_nha" class="form-control m-input name-field"
                                                            placeholder="Điền số nhà, đường">
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
                                        <div class="col-md-12">
                                            <div class="m-form__heading">
                                                <h3 class="m-form__heading-title" style="font-weight: bold">
                                                    Nơi ở hiện tại
                                                    <i data-toggle="m-tooltip" data-width="auto"
                                                        class="m-form__heading-help-icon flaticon-info" title=""
                                                        data-original-title="Nơi ở hiện tại giáo viên"></i>
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
                                                            <option value="{{$item->matp}}">{{$item->name}}</option>
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
                                                        <input type="text" name="noi_o_hien_tai_so_nha" class="form-control m-input name-field"
                                                            placeholder="Điền số nhà, đường">
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
                                                        data-original-title="Trình độ giáo viên"></i>
                                                </h3>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="m-form__section m-form__section--first">
                                                <div class="form-group m-form__group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                            class="text-danger">*</span>Trình độ</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <input type="text" name="trinh_do" class="form-control m-input name-field"
                                                            placeholder="Điền trình độ" value="{{ old('trinh_do') }}">
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
                                                        <input type="text" name="chuyen_mon" class="form-control m-input name-field"
                                                            placeholder="Điền chuyên môn" value="{{ old('chuyen_mon') }}">
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
                                                        <input type="text" name="noi_dao_tao" class="form-control m-input name-field"
                                                            placeholder="Điền nơi đào tạo" value="{{ old('noi_dao_tao') }}">
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
                                                        <input type="text" name="nam_tot_nghiep" class="form-control m-input name-field"
                                                        onkeypress="return isNumberKey(event)" maxlength="4" minlength="4"
                                                        placeholder="Điền năm tốt nghiệp" value="{{ old('nam_tot_nghiep') }}">
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
                                        <button type="submit" class="btn btn-success">Thêm mới</button>
                                    </div>
                                </div>



                            </div>


                            
                    </div>

                </div>
                </div>
                

            </div>
        </div>
        
    </div>
</form>
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
@endsection