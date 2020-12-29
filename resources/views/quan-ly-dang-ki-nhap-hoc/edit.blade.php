@extends('layouts.main')
@section('title', 'Thêm mới học sinh')
		<link href="{!!  asset('css_loading/css_loading.css') !!}" rel="stylesheet" type="text/css" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

@section('style')
<style>
    .modal-lg {
      max-width: 1100px;
    }
    #table-hoc-sinh_filter{
        display: none;
    }
    #table-hoc-sinh_length{
        padding-left: 29px !important
    }
    #table-hoc-sinh_info{
        padding-left: 29px !important
    }

</style>

@endsection
@section('content')
    <div class="m-content">

        		
		<div id="preload" class="preload-container text-center" style="display: none">
			<img id="gif-load" src="https://icon-library.com/images/loading-gif-icon/loading-gif-icon-17.jpg" alt="">
          </div>
          

        <div class="row">
            <div class="col-xl-12">
                <div class="m-portlet m-portlet--full-height">

                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Thông tin học sinh đăng kí nhập học
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item">
                                    <a href="#" data-toggle="m-tooltip"
                                        class="m-portlet__nav-link m-portlet__nav-link--icon" data-direction="left"
                                        data-width="auto" title="" data-original-title="Get help with filling up this form">
                                        <i class="flaticon-info m--icon-font-size-lg3"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="" id="m_wizard">
                        <div class="m-wizard__form">
                            <form class="m-form m-form--label-align-left- m-form--state-" id="m_form"
                                action="{{ route('submit-edit-hs-dang-ky-nhap-hoc') }}" method="POST" enctype="multipart/form-data">
                                <div class="m-portlet__body">
                                    @csrf
                                    <div class=" m-wizard__form-step--current" id="m_wizard_form_step_1">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-5">
                                                    <div class="m-form__heading">
                                                        <h3 class="m-form__heading-title">
                                                            Thông tin
                                                            <i data-toggle="m-tooltip" data-width="auto"
                                                                class="m-form__heading-help-icon flaticon-info" title=""
                                                                data-original-title="Some help text goes here"></i>
                                                                Mã đơn đăng ký: <b>{{$hs_dk->ma_don}}</b>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-xl-6">
                                                <div class="m-form__section m-form__section--first">
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span> Họ và tên: </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="ten" class="form-control m-input"
                                                                placeholder="" value="{{$hs_dk->ten}}">
                                                                <p class="text-danger text-small error" id="ten_error"></p> 

                                                        </div>

                                                        {{-- @error('ten')
                                                                                  <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror --}}

                                                    </div>

                                        

                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Ngày sinh:</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <div class="input-group date">
                                                        
                                                                <input class="form-control form-control-sm m-input" value="{{$hs_dk->ngay_sinh}}" type="date" name="ngay_sinh"
                                                                placeholder="Chọn ngày">

                                                                {{-- <div class="input-group-append">
                                                                    <span class="input-group-text">
                                                                        <i class="la la-calendar-check-o"></i>
                                                                    </span>
                                                                </div> --}}
															</div>
                                               
                                                          
                                                        </div>
                                                        {{-- @error('ngay_sinh')
                                                                                  <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror --}}
                                                     <p class="text-danger text-small error" id="ngay_sinh_error"></p> 

                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Dân tộc</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                
                                                                <select name="dan_toc" id="" class="form-control form-control-sm m-input">
                                                                    @foreach (config('common.dan_toc') as $key => $value)
                                                                        <option
                                                                        {{($hs_dk->dan_toc == $value) ? "selected" : ""}}
                                                                         value="{{ $key }}"
                                                                          class="get-dan_toc_{{ $key }}">{{ $value }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                        
                                                        </div>

                                                        {{-- @error('dan_toc')
                                                                                  <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror --}}
                                                         <p class="text-danger text-small error" id="dan_toc_error"></p> 

                                                    </div>

                                                    <input type="text" hidden name="id_don_dk" id="id_don_dk" value="{{$hs_dk->id}}">


                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Đối tượng chính sách</label>
                                                        <div class="col-xl-9 col-lg-9">

                                                      <select class="form-control form-control-sm select2" multiple="multiple"
                                                            name="doi_tuong_chinh_sach_id[]" id="doi_tuong_chinh_sach_id">
                                                            @foreach ($doi_tuong_chinh_sach as $item)
                                                                <option 
                                                             
                                                                    @foreach ($arr_doi_tuong_chinh_sach as $dd)
                                                                     {{($item->id == $dd) ? "selected" : ""}}
                                                                    @endforeach
                                                                    value="{{ $item->id }}" data-loai="L-{{ $item->id }}">
                                                                    L-{{ $item->id }} {{ $item->ten_chinh_sach }}
                                                                </option>
                                                             @endforeach
                                                        </select>
                                                        
                                                        
                                                        </div>
                                                    </div>

                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Học sinh khuyết tật</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <div class="m-radio-inline">
                                                                <label class="m-radio">
                                                                    <input type="radio"
                                                                    @if($hs_dk->hoc_sinh_khuyet_tat == '1') checked @endif
                                                                     name="hoc_sinh_khuyet_tat"
                                                                        value="1"> Có
                                                                    <span></span>
                                                                </label>
                                                                <label class="m-radio">
                                                                    <input type="radio"
                                                                    @if($hs_dk->hoc_sinh_khuyet_tat == '0') checked @endif
                                                                      name="hoc_sinh_khuyet_tat"
                                                                      value="0">
                                                                    Không
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                            </div>
                                            <div class="col-xl-6 ">

                                               <div class="form-group m-form__group row offset-1">
                                                    <img id="showimg"  src="{{$hs_dk->avatar}}"  width="290" />
                                               </div>

                                               <div class="form-group m-form__group row offset-1">
                                                    <label class="col-lg-2 col-form-label">Ảnh bé:</label>
                                                    <div class="col-md-5">

                                                        <div class="custom-file">
                                                            <input type="file" 
                                                                class="custom-file-input"
                                                                onchange="showimages(this)"
                                                                id="customFileAvatar">
                                                             <input type="text" hidden name="avatar" value="{{$hs_dk->avatar}}">

                                                            <label class="custom-file-label"
                                                                for="customFileGiayPhep">Choose file</label>
                                                        </div>
                                                        <p class="text-danger text-small" id="avatar_error" class="error"></p>
                                                    </div>
												</div>

                                               {{-- <div class="form-group m-form__group row  offset-1">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Trạng thái</label>
                                                        <div class="col-xl-4 col-lg-10">
                                                            <select class="form-control" id="status" name="status">
                                                                <option @if($hs_dk->status == 2) selected @endif  value="2"  > Chưa xem</option>
                                                                <option  @if($hs_dk->status == 3) selected @endif value="3"  > Đang xem</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-2 m--align-right">
                                                            <button type="button" onclick="capNhapTrangThai()" class="btn btn-info">
                                                                <span>
                                                                    <span>Cập nhập</span>
                                                                </span>
                                                            </button>
                                                          </div> 
                                               </div> --}}
 
                                            
                                                <div class="m-form__section m-form__section--first">
                                                    <div class="form-group m-form__group row  offset-1">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Giới tính</label>
                                                        <div class="col-xl-3 col-lg-9">
                                                            <div class="m-radio-inline">
                                                                @foreach (config('common.gioi_tinh') as $key => $value)
                                                                <label class="m-radio m-radio--solid">
                                                                    <input type="radio" name="gioi_tinh"
                                                                     {{ $key == $hs_dk->gioi_tinh ? 'checked' : ''}}
                                                                     value="{{ $key }}">
                                                                    {{ $value }}
                                                                    <span></span>
                                                                </label>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                               
                                                </div>
                                                <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="m-form__heading">
                                                    <h3 class="m-form__heading-title">
                                                        Hộ khẩu thường chú
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
                                                        <select class="form-control" name="ho_khau_thuong_tru_matp" id="ho_khau_thuong_tru_matp">
															<option value="" selected>Chọn</option>
															@foreach ($tp as $item)
                                                            <option @if($item->matp == $hs_dk->ho_khau_thuong_tru_matp) selected @endif
                                                                 value="{{ $item->matp }}">{{ $item->name }}</option>
															@endforeach
														</select>
                                                        </div>

                                                        {{-- @error('ho_khau_thuong_tru_matp')
                                                                                  <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror --}}
											        	 <p class="text-danger text-small error" id="ho_khau_thuong_tru_matp_error"></p> 

                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Quận/Huyện</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                        <select class="form-control" name="ho_khau_thuong_tru_maqh" id="ho_khau_thuong_tru_maqh">
															<option value="{{$ho_khau_qh->maqh}}" selected>{{$ho_khau_qh->name}}</option>
                                                        </select>
                                                        
                                                        </div>

                                                        {{-- @error('ho_khau_thuong_tru_maqh')
                                                                                  <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror --}}
												 <p class="text-danger text-small error" id="ho_khau_thuong_tru_maqh_error"></p> 

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="m-form__section m-form__section--first">
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Phường/Xã/Thị trấn:</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <select class="form-control" name="ho_khau_thuong_tru_xaid" id="ho_khau_thuong_tru_xaid">
                                                                        <option value="{{$ho_khau_xaid->xaid}}" selected>{{$ho_khau_xaid->name}}</option>
                                                            </select>
                                                        </div>

                                                        {{-- @error('ho_khau_thuong_tru_xaid')
                                                                                  <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror --}}
											        	 <p class="text-danger text-small error" id="ho_khau_thuong_tru_xaid_error"></p>

                                                    </div>

                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Số nhà, đường </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text"
                                                            value="{{$hs_dk->ho_khau_thuong_tru_so_nha}}" name="ho_khau_thuong_tru_so_nha"
                                                                class="form-control m-input" placeholder="" value="">

                                                                {{-- @error('ho_khau_thuong_tru_so_nha')
                                                                                  <div class="alert alert-danger">{{ $message }}</div>
                                                                 @enderror --}}
                                                        </div>
										        		 <p class="text-danger text-small error" id="ho_khau_thuong_tru_so_nha_error"></p> 

                                                    </div>

                                                </div>
                                                <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="m-form__heading">
                                                    <h3 class="m-form__heading-title">
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
                                                         <select class="form-control" name="noi_o_hien_tai_matp" id="noi_o_hien_tai_matp">
															<option value="" selected>Chọn</option>
															@foreach ($tp as $item)
                                                            <option @if($item->matp == $hs_dk->noi_o_hien_tai_matp) selected @endif
                                                                 value="{{ $item->matp }}">{{ $item->name }}</option>
															@endforeach
														</select>

                                                        {{-- @error('noi_o_hien_tai_matp')
                                                                                  <div class="alert alert-danger">{{ $message }}</div>
                                                          @enderror --}}
												         <p class="text-danger text-small error" id="noi_o_hien_tai_matp_error"></p> 

                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Quận/Huyện</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                             <select class="form-control" name="noi_o_hien_tai_maqh" id="noi_o_hien_tai_maqh">
                                                                        <option value="{{$noi_o_qh->maqh}}" selected>{{$noi_o_qh->name}}</option>
                                                            </select>

                                                            {{-- @error('noi_o_hien_tai_maqh')
                                                                                   <div class="alert alert-danger">{{ $message }}</div>
                                                          @enderror --}}


											        	<p class="text-danger text-small error" id="noi_o_hien_tai_maqh_error"></p> 

                                                        </div>
                                                           <div class="m-separator m-separator--dashed m-separator--lg"></div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="m-form__section m-form__section--first">
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Phường/Xã/Thị trấn:</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <select class="form-control" name="noi_o_hien_tai_xaid" id="noi_o_hien_tai_xaid">
                                                                        <option value="{{$noi_o_xaid->xaid}}" selected>{{$noi_o_xaid->name}}</option>
                                                            </select>


                                                            {{-- @error('noi_o_hien_tai_xaid')
                                                                                   <div class="alert alert-danger">{{ $message }}</div>
                                                              @enderror --}}


											                	 <p class="text-danger text-small error" id="noi_o_hien_tai_xaid_error"></p>

                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Số nhà, đường </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text"
                                                            value="{{$hs_dk->noi_o_hien_tai_so_nha}}" name="noi_o_hien_tai_so_nha"
                                                                class="form-control m-input" placeholder="" value="">


                                                                {{-- @error('noi_o_hien_tai_so_nha')
                                                                                   <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror --}}

                                                          <p class="text-danger text-small error" id="noi_o_hien_tai_so_nha_error"></p> 

                                                        </div>
                                                    </div>

                                                <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="m-form__heading">
                                                    <h3 class="m-form__heading-title">
                                                        Thông tin cha:
                                                        <i data-toggle="m-tooltip" data-width="auto"
                                                            class="m-form__heading-help-icon flaticon-info" title=""
                                                            data-original-title="Some help text goes here"></i>
                                                    </h3>
                                                </div>
                                            </div>

												<div class="col-lg-4">
													<label>Họ tên (Cha) : </label>
													<div class="input-group m-input-group m-input-group--square">
														<div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
														<input type="text" name="ten_cha" 
                                                        value="{{$hs_dk->ten_cha}}"
                                                        class="form-control m-input" placeholder="">


                                                        {{-- @error('ten_cha')
                                                                                   <div class="alert alert-danger">{{ $message }}</div>
                                                         @enderror --}}
														   
                                                    </div>
												      <p class="text-danger text-small error" id="ten_cha_error"></p> 
                                                    
                                                    <div class="m-separator m-separator--dashed m-separator--lg"></div>

												</div>
                                          
												<div class="col-lg-4">
                                                    <label class="">Số điện thoại (Cha) : </label>
                                            
													<input type="number" class="form-control m-input"  name="dien_thoai_cha" 
                                                    value="{{$hs_dk->dien_thoai_cha}}"
                                                    placeholder="SĐT cha">
												
                                                        {{-- @error('dien_thoai_cha')
                                                                         <div class="alert alert-danger" id="test_caase">{{ $message }}</div>
                                                         @enderror --}}
											    	<p class="text-danger text-small error" id="dien_thoai_cha_error"></p>
													   
                                                     <div class="m-separator m-separator--dashed m-separator--lg"></div>

												</div>
												<div class="col-lg-4">
													<label>Số chứng minh nhân dân (Cha) : </label>
													<input type="number" class="form-control m-input" name="cmtnd_cha"
                                                    value="{{$hs_dk->cmtnd_cha}}"
                                                     placeholder="Số chứng minh cha">
													   
                                                         {{-- @error('cmtnd_cha')
                                                                                   <div class="alert alert-danger">{{ $message }}</div>
                                                         @enderror --}}
                                                     <p class="text-danger text-small error" id="cmtnd_cha_error"></p> 

                                                     <div class="m-separator m-separator--dashed m-separator--lg"></div>

												</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="m-form__heading">
                                                    <h3 class="m-form__heading-title">
                                                        Thông tin mẹ:
                                                        <i data-toggle="m-tooltip" data-width="auto"
                                                            class="m-form__heading-help-icon flaticon-info" title=""
                                                            data-original-title="Some help text goes here"></i>
                                                    </h3>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
													<label>Họ tên (Mẹ) : </label>
													<div class="input-group m-input-group m-input-group--square">
														<div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
														<input type="text" name="ten_me" 
                                                         value="{{$hs_dk->ten_me}}"
                                                        class="form-control m-input" placeholder="">
													</div>

                                                         {{-- @error('ten_me')
                                                                                   <div class="alert alert-danger">{{ $message }}</div>
                                                         @enderror --}}
												<p class="text-danger text-small error" id="ten_me_error"></p> 

                                                    <div class="m-separator m-separator--dashed m-separator--lg"></div>

												</div>
												<div class="col-lg-4">
													<label class="">Số điện thoại (Mẹ) : </label>
													<input type="number" class="form-control m-input"
                                                    name="dien_thoai_me" 
                                                    value="{{$hs_dk->dien_thoai_me}}"
                                                    placeholder="SĐT mẹ">


                                                    {{-- @error('dien_thoai_me')
                                                                                   <div class="alert alert-danger">{{ $message }}</div>
                                                         @enderror --}}
											             <p class="text-danger text-small error" id="dien_thoai_me_error"></p> 

                                                    <div class="m-separator m-separator--dashed m-separator--lg"></div>

												</div>
												<div class="col-lg-4">
													<label>Số chứng minh nhân dân (Mẹ) : </label>
													<input type="number" class="form-control m-input" name="cmtnd_me" 
                                                    value="{{$hs_dk->cmtnd_me}}"
                                                    placeholder="Số chứng minh mẹ">

                                                    {{-- @error('cmtnd_me')
                                                                                   <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror --}}
												    <p class="text-danger text-small error" id="cmtnd_me_error"></p> 

                                                     <div class="m-separator m-separator--dashed m-separator--lg"></div>
												</div>
                                                
                                        </div>


                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="m-form__heading">
                                                    <h3 class="m-form__heading-title">
                                                        Thông tin người giám hộ :
                                                        <i data-toggle="m-tooltip" data-width="auto"
                                                            class="m-form__heading-help-icon flaticon-info" title=""
                                                            data-original-title="Some help text goes here"></i>
                                                    </h3>
                                                </div>
                                            </div>

												<div class="col-lg-4">
													<label>Họ tên người giám hộ : </label>
													<div class="input-group m-input-group m-input-group--square">
														<div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
														<input type="text" name="ten_nguoi_giam_ho" 
                                                        value="{{$hs_dk->ten_nguoi_giam_ho}}"
                                                        class="form-control m-input" placeholder="Họ tên người giám hộ">


                                                        {{-- @error('ten_nguoi_giam_ho')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                         @enderror --}}

                                                    </div>
										        		<p class="text-danger text-small error" id="ten_nguoi_giam_ho_error"></p> 
                                                    
                                                    <div class="m-separator m-separator--dashed m-separator--lg"></div>

												</div>

												<div class="col-lg-4">
													<label class="">Số điện thoại người giám hộ : </label>
													<input type="number" class="form-control m-input"  name="dien_thoai_nguoi_giam_ho" 
                                                    value="{{$hs_dk->dien_thoai_nguoi_giam_ho}}"
                                                    placeholder="SĐT người giám hộ">
												
                                                    {{-- @error('dien_thoai_nguoi_giam_ho')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror --}}

												         <p class="text-danger text-small error" id="dien_thoai_nguoi_giam_ho_error"></p> 
													   
                                                     <div class="m-separator m-separator--dashed m-separator--lg"></div>

													<!-- <span class="m-form__help">Please enter your email</span> -->
												</div>
												<div class="col-lg-4">
													<label>Số chứng minh nhân dân người giám hộ : </label>
													<input type="number" class="form-control m-input" name="cmtnd_nguoi_giam_ho"
                                                        value="{{$hs_dk->cmtnd_nguoi_giam_ho}}"
                                                          placeholder="Số chứng người giám hộ">
                                                       
                                                         {{-- @error('cmtnd_nguoi_giam_ho')
                                                         <div class="alert alert-danger">{{ $message }}</div>
                                                         @enderror --}}
                                                         <p class="text-danger text-small error" id="cmtnd_nguoi_giam_ho_error"></p> 

                                                     <div class="m-separator m-separator--dashed m-separator--lg"></div>
													<!-- <span class="m-form__help">Please enter your username</span> -->
												</div>
                                        </div>

                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="m-form__heading">
                                                    <h3 class="m-form__heading-title">
                                                        Thông tin liên lạc:
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
                                                                class="text-danger">*</span> Số điện thoại đăng ký: </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="dien_thoai_dang_ki" 
                                                            class="form-control m-input"
                                                              value="{{$hs_dk->dien_thoai_dang_ki}}"
                                                               placeholder="">
                                                               {{-- @error('dien_thoai_dang_ki')
                                                               <div class="alert alert-danger">{{ $message }}</div>
                                                               @enderror --}}
                                                              
								                			<p class="text-danger text-small error" id="dien_thoai_dang_ki_error"></p> 

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="m-form__section m-form__section--first">
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Email đăng kí:</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="email_dang_ky" class="form-control m-input"
                                                                    value="{{$hs_dk->email_dang_ky}}"
                                                                placeholder="" >
{{-- 
                                                                @error('email_dang_ky')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror --}}
                                                           
											                	<p class="text-danger text-small error" id="email_dang_ky_error"></p>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="m-portlet__foot m-portlet__foot--fit m--margin-top-40">
                                            <div class="m-form__actions">
                                                <div class="row">
                                                    <div class="col-lg-8"></div>
                                                  
                                                    <div class="col-lg-2 m--align-right">
                                                        <button type="button" class="btn btn-danger" onclick="removeDon()">
                                                            <span>
                                                                <span style="font-size:15">Hủy đơn</span>
                                                            </span>
                                                          </button>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <button type="button" class="btn btn-success" onclick="validate()" >
                                                            <span>
                                                                <i class="la la-check"></i>&nbsp;&nbsp;
                                                                <span>Phê Duyệt</span>
                                                            </span>
                                                        </button>
                                                    </div> 
                                                  

                                                      


                                                    
                                                    <div class="col-lg-2"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            </form>



   <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="width: 3000px !importen;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tạo tài khoản học sinh</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div>
                    <div class="form-check form-check-inline text-center">
                        <input class="form-check-input" type="radio" checked onclick="selectWayCreate(1)" name="inlineRadioOptions" id="inlineRadio1" value="option1" />
                        <label class="form-check-label" for="inlineRadio1">Tạo tài khoản</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" onclick="selectWayCreate(2)" name="inlineRadioOptions" id="inlineRadio2" value="option2" />
                        <label class="form-check-label" for="inlineRadio2">Dùng chung tài khoản</label>
                    </div>
                </div>
            </div>
            <div id="viewChungTaiKhoan" style="display: none;">
                <table id="table-hoc-sinh" class="table table-striped table-bordered m-table thong-tin-hoc-sinh-cua-lop">
                    <thead>
                        <tr>
                            <th style="width: 4%;"></th>
                            <th style="width: 8%;">Mã học sinh</th>
                            <th style="width: 16%;">Họ tên</th>
                            <th style="width: 13%;">Ảnh</th>
                            <th style="width: 13%;">SĐT đăng kí</th>
                            <th style="width: 16%;">Tên đăng nhập</th>
                            <th style="width: 16%;">Tên cha</th>
                            <th style="width: 16%;">Tên mẹ</th>
                        </tr>
                    </thead>
                    <thead class="filter">
                        <tr>
                            <td scope="row"><input class="form-control search m-input" type="hidden" /></td>
                            <td scope="row"><input class="form-control search m-input search-mahs" type="text" /></td>
                            <td scope="row"><input class="form-control search m-input search-ten" type="text" /></td>
                            <td scope="row"></td>
                            <td scope="row"><input class="form-control search m-input search-dien_thoai_dang_ki" type="text" /></td>
                            <td scope="row"><input class="form-control search m-input search-username" type="text" /></td>
                            <td scope="row"><input class="form-control search m-input search-ten_cha" type="text" /></td>
                            <td scope="row"><input class="form-control search m-input search-ten_me" type="text" /></td>
                        </tr>
                    </thead>
                    <tbody id="show-data-hoc-sinh">
                        @foreach($all_hs as $hs)
                        <tr>
                            <td><a href="#" onclick='submitGhepTaiKhoan("{{$hs->user_id}}")' />Chọn</td>
                            <td>{{$hs->ma_hoc_sinh}}</td>
                            <td>{{$hs->ten}}</td>
                            <td>{{$hs->ten}}</td>
                            <td>{{$hs->dien_thoai_dang_ki}}</td>
                            <td>{{$hs->dien_thoai_dang_ki}}</td>
                            <td>{{$hs->ten_cha}}</td>
                            <td>{{$hs->ten_me}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-right modal-footer" id="showButtonTuTao">
                <button type="button" onclick="submitDuyet()" class="btn btn-primary">Lưu</button>
            </div>
         
        </div>
    </div>
</div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

@endsection

@section('script')

<script>
  var dtable;
  $(document).ready( function () {
         dtable = $('#table-hoc-sinh').DataTable( {
        // 'paging': false,
            
        "aoColumnDefs": [
             { "bSortable": false, "aTargets": [ 0,1,2,3,4,5,6,7 ] }, 
         ],
        //  "info": false
        //  searching: false,
                "language": {
                        "lengthMenu": '  Hiển thị <select>'+
                        '<option value="10">10</option>'+
                        '<option value="20">20</option>'+
                        '<option value="30">30</option>'+
                        '<option value="40">40</option>'+
                        '<option value="50">50</option>'+
                        '<option value="-1">All</option>'+
                        '</select> dòng',
                        "info": "  Trang _PAGE_ ",
                        "paginate": {
                            "previous": "Quay lại",
                            "next": "Tiếp"
                            }
                    },
         }
    );
        $('.search-mahs').on('keyup change', function() {
        dtable
        .column(1).search(this.value)
        .draw();
        });
    
        $('.search-ten').on('keyup change', function() {
        dtable
        .column(2).search(this.value)
        .draw();
        });
        
     
        $('.search-dien_thoai_dang_ki').on('keyup change', function() {
        dtable
        .column(4).search(this.value)
        .draw();
        });

        $('.search-ten_dang_nhap').on('change', function() {
        dtable
        .column(5).search(this.value)
        .draw();    
        });


        $('.search-ten_cha').on('keyup change', function() {
        dtable
        .column(6).search(this.value)
        .draw();
        });

        $('.search-ten_me').on('keyup change', function() {
        dtable
        .column(7).search(this.value)
        .draw();
        });

    });


</script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="{!!  asset('assets/demo/custom/crud/forms/widgets/bootstrap-datepicker.js') !!}"></script>
    <script>
        $(".select2").select2();

     var url_quan_huyen_theo_thanh_pho= "{{route('get_quan_huyen_theo_thanh_pho')}}";
	 var url_phuong_xa_theo_quan_huyen= "{{route('get_xa_phuong_theo_thi_tran')}}";
	 var url_submit_edit= "{{route('submit-edit-hs-dang-ky-nhap-hoc')}}";
	 var url_cap_nhap_id_user= "{{route('cap-nhap-id-user-for-hs')}}";

	 var url_index_ql_dang_ki= "{{route('quan-ly-dang-ky-nhap-hoc.index')}}";

	 var url_validate= "{{route('validation-edit-dang-ki-nhap-hoc')}}";

	 var url_remove_don_dk= "{{route('remove-don-dang-ki')}}";

        function validate(){

            var file = $("#customFileAvatar")[0].files[0];
            if(file !== undefined){
                uploadAvatar();
             }
            $('#preload').css('display','block');
                let myForm = document.getElementById('m_form');
                var formData = new FormData(myForm)
                axios.post(url_validate ,formData)
                .then(function (response) {
                   $('#preload').css('display','none');
                   $('#exampleModalCenter').modal('show')
                })
                .catch(function (error) {
                    $('#preload').css('display','none');
                    $('.error').text(' ')
                    for (const key in error.response.data.errors) {
                                $('#'+key+'_error').html(error.response.data.errors[key]);
                        }
                })
        }



        function uploadAvatar() {
            var file = $("#customFileAvatar")[0].files[0];
            var form = new FormData();
            form.append("image", file);
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
                $('[name="avatar"]').val(url);
            });
    }

    function  selectWayCreate(value){
            if(value == 1){ 
                $('#viewChungTaiKhoan').css('display','none')
                $('#showButtonTuTao').css('display','inline-block')
            }
            else{ $('#viewChungTaiKhoan').css('display','block')
                 $('#showButtonTuTao').css('display','none')
            }
    }

     function showimages(element) {
           		 var file = element.files[0];
                var reader = new FileReader();
                reader.onloadend = function() {
                    $('#showimg').attr('src', reader.result);
                }
                reader.readAsDataURL(file);
     }

    //  let capNhapTrangThai = () => {
	// 		axios.post(url_submit_edit, {
    //             status : $('#status').val(),
    //             id_hs_dk : $('#id_hs_dk').val()
    //          }
    //         )
	// 		.then(function (response) {
	// 			console.log(response.data);
    //             alert('Cap nhạp thanh cong')
	// 		})
	// 		.catch(function (error) {
	// 			console.log(error);
	// 		})
	// 	}

        let removeDon = () => {
            Swal.fire({
                title: 'Bạn có chắc muốn hủy đơn này ?',
                // text: "Xóa đơn !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                ButtonColor: '#d33',
                confirmButtonText: 'Xóa đơn!',
                // cancelButtonText: 'Hủy',
                }).then((result) => {
                if (result.value) {
                    let id_don_dk = $('#id_don_dk').val();
                    $('#preload').css('display','block');
                    let myForm = document.getElementById('m_form');
                    var formData = new FormData(myForm);
                    formData.append('id', id_don_dk);
                    axios.post(url_remove_don_dk,formData)
                    .then(function (response) {
                     $('#preload').css('display','none');
                      Swal.fire({
                            position: 'center',
                            icon: 'warning',
                            title: 'Đã xóa đơn đăng kí',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        window.location.href = url_index_ql_dang_ki;
                    })
                    .catch(function (error) {
                        $('#preload').css('display','none');
                        console.log(error);
                    })
               }

        })
		}

     let submitDuyet = () => {
             $('#preload').css('display','block');
			let myForm = document.getElementById('m_form');
			var formData = new FormData(myForm)
			axios.post(url_submit_edit ,formData)
			.then(function (response) {
			 console.log(response.data);
               Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Tạo tài khoản thành công',
                            showConfirmButton: false,
                            timer: 1500
                });
                window.location.href = url_index_ql_dang_ki;
			})
			.catch(function (error) {
                $('#preload').css('display','none');
				$('.error').text(' ')
				 for (const key in error.response.data.errors) {
                            $('#'+key+'_error').html(error.response.data.errors[key]);
                   }
			})
		}

        let submitGhepTaiKhoan = (id_tk) => {
            Swal.fire({
                title: 'Bạn muốn dùng chung tài khoản với học sinh này ?',
                text: "Hãy chắc chắn phụ huynh muốn dùng chung tài khoản với học sinh này!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                ButtonColor: '#d33',
                confirmButtonText: 'Dùng chung!',
                }).then((result) => {
                if (result.value) {
                    $('#preload').css('display','block');
                    let myForm = document.getElementById('m_form');
                    var formData = new FormData(myForm);
                    formData.append('user_id', id_tk);
                    axios.post(url_submit_edit,formData)
                    .then(function (response) {
                    console.log(response.data);
                    Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Ghép tài khoản thành công',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        window.location.href = url_index_ql_dang_ki;
                    })
                    .catch(function (error) {
                        $('#preload').css('display','none');
                        console.log(error);
                    })
               }

        })
        }


      $("#ho_khau_thuong_tru_matp").change(function() {
				axios.post(url_quan_huyen_theo_thanh_pho, {
							matp:  $("#ho_khau_thuong_tru_matp").val(),
				})
				.then(function (response) {
					var htmldata = '<option value="" selected  >Chọn</option>'
						response.data.forEach(element => {
						htmldata+=`<option value="${element.maqh}" >${element.name}</option>`
					});

					$('#ho_khau_thuong_tru_maqh').html(htmldata);
					$('#ho_khau_thuong_tru_xaid').html('');
				})
				.catch(function (error) {
					console.log(error);
				});
			});


			$("#ho_khau_thuong_tru_maqh").change(function() {
				axios.post(url_phuong_xa_theo_quan_huyen, {
					maqh:  $("#ho_khau_thuong_tru_maqh").val(),
				})
				.then(function (response) {
					var htmldata = '<option value="" selected  >Chọn</option>'
						response.data.forEach(element => {
						htmldata+=`<option value="${element.xaid}" >${element.name}</option>`
					});

					$('#ho_khau_thuong_tru_xaid').html(htmldata);
				})
				.catch(function (error) {
					console.log(error);
				});
			});



			$("#noi_o_hien_tai_matp").change(function() {
				axios.post(url_quan_huyen_theo_thanh_pho, {
							matp:  $("#noi_o_hien_tai_matp").val(),
				})
				.then(function (response) {
					var htmldata = '<option value="" selected  >Chọn</option>'
						response.data.forEach(element => {
						htmldata+=`<option value="${element.maqh}" >${element.name}</option>`
					});

					$('#noi_o_hien_tai_maqh').html(htmldata);
					$('#noi_o_hien_tai_xaid').html('');
				})
				.catch(function (error) {
					console.log(error);
				});
			});


			$("#noi_o_hien_tai_maqh").change(function() {
				axios.post(url_phuong_xa_theo_quan_huyen, {
					maqh:  $("#noi_o_hien_tai_maqh").val(),
				})
				.then(function (response) {
					var htmldata = '<option value="" selected  >Chọn</option>'
						response.data.forEach(element => {
						htmldata+=`<option value="${element.xaid}" >${element.name}</option>`
					});

					$('#noi_o_hien_tai_xaid').html(htmldata);
				})
				.catch(function (error) {
					console.log(error);
				});
			});

            </script>
@endsection
