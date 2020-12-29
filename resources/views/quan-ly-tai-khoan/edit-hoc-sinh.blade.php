@extends('layouts.main')
@section('title',"Thông tin cá nhân")
@section('content')
<div class="m-content">
						<div class="row">
							<div class="col-xl-12 col-lg-9">
								<div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-tools">
											<ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_user_profile_tab_1" role="tab">
														<i class="flaticon-share m--hide"></i>
														Cập nhật hồ sơ
													</a>
												</li>
											</ul>
										</div>
									</div>
	<div class="tab-content">
	  <div class="tab-pane active" id="m_user_profile_tab_1">											
         <div class="col-md-12">
			<form class="m-form m-form--fit m-form--label-align-right" method="POST" id=""
             action="{{route('update-hoc-sinh', ['id' =>$hoc_sinh->id])}}" enctype="multipart/form-data" >
								@csrf
					<div class="m-portlet__body">
						@auth
				
					   <div class="m-wizard__form-step m-wizard__form-step--current" id="m_wizard_form_step_1">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="m-form__heading">
                                                    <h3 class="m-form__heading-title">
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
                                                                class="text-danger"></span> Mã Học Sinh: </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="" class="form-control m-input"
                                                                placeholder="" value="{{$hoc_sinh->ma_hoc_sinh}}" readonly>
                                                        </div>
                                                    </div>
													<div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger"></span> Họ và tên: </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                        @error('ten')
															<small style="color:red">{{$message}}</small>
															@enderror
                                                            <input type="text" name="ten" class="form-control m-input"
                                                                placeholder="" value="{{$hoc_sinh->ten}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger"></span> Tên thường gọi: </label>
                                                               
                                                        <div class="col-xl-9 col-lg-9">
                                                        @error('ten_thuong_goi')
															<small style="color:red">{{$message}}</small>
															@enderror
                                                            <input type="text" name="ten_thuong_goi" class="form-control m-input"
                                                                placeholder="" value="{{$hoc_sinh->ten_thuong_goi}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger"></span>Ngày sinh:</label>
                                                                @error('ngay_sinh')
															<small style="color:red">{{$message}}</small>
															@enderror
                                                        <div class="col-xl-9 col-lg-9">
                                                       
                                                            <input type="date" name="ngay_sinh" class="form-control m-input"
                                                                placeholder="" value="{{$hoc_sinh->ngay_sinh}}">
                                                        </div>
                                                    </div>
                                                   
                                                   
                                                   
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="m-form__section m-form__section--first">
												<div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger"></span>Giới tính</label>
                                                        <div class="col-xl-3 col-lg-9">
                                                            <div class="m-radio-inline">
                                                            @if($hoc_sinh->gioi_tinh === 1)
                                                            
                                                            <label class="m-radio">
                                                                    <input type="radio"  name="gioi_tinh" value="1" checked> Nam
                                                                    <span></span>
                                                                </label>
                                                                <label class="m-radio">
                                                                    <input type="radio"  name="gioi_tinh" value="0" >Nữ
                                                                    <span></span>
                                                                </label>
                                                            @else
                                                            <label class="m-radio">
                                                                    <input type="radio"  name="gioi_tinh" value="1" > Nam
                                                                    <span></span>
                                                                </label>
                                                                <label class="m-radio">
                                                                    <input type="radio"  name="gioi_tinh" value="0" checked >Nữ
                                                                    <span></span>
                                                                </label>
                                                            @endif
                                                            </div>
                                                        </div>
                                                    </div>
											

												
                                                   
													<div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger"></span> Email:</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                        @error('email_dang_ky')
                                                            <small style="color:red">{{$message}}</small>
                                                               @enderror
                                                            <div class="input-group">
                                                                <input type="text" name="email_dang_ky"
                                                                    class="form-control m-input" placeholder="" value="{{$hoc_sinh->email_dang_ky}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger"></span> Điện thoại:</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                        @error('dien_thoai_dang_ki')
															<small style="color:red">{{$message}}</small>
															@enderror
                                                            <div class="input-group">
                                                           
                                                                <input type="text" name="dien_thoai_dang_ki"
                                                                    class="form-control m-input" placeholder="" value="{{$hoc_sinh->dien_thoai_dang_ki}}"  onkeypress="return isNumber(event)">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Dân tộc</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                    @error('dan_toc')
															<small style="color:red">{{$message}}</small>
															@enderror
                                                            <select name="dan_toc" class="form-control m-input name-field select2" placeholder="Điền dân tộc">
                                                                @foreach (config('common.dan_toc') as $key => $value)
                                                                    <option {{ ($hoc_sinh->dan_toc == $key )? 'selected' : ''}} value="{{ $key}}" >{{ $value }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('dan_toc')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                    </div>
                                                </div>
													</div>
                                              
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="m-form__section m-form__section--first">
												<div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger"></span>Nơi sinh:</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                        @error('noi_sinh')
                                                            <small style="color:red">{{$message}}</small>
                                                                  @enderror
                                                            <div class="input-group">
                                                                <input type="text" name="noi_sinh"
                                                                    class="form-control m-input" placeholder="" value="{{$hoc_sinh->noi_sinh}}">
                                                            </div>
                                                        </div>
                                                    </div>
													<div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger"></span>Đối tượng chính sách:</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                        @error('doi_tuong_chinh_sach_id')
                                                            <small style="color:red">{{$message}}</small>
                                                                  @enderror
                                                            <div class="input-group">
                                                            
                                                                <input type="text" name="doi_tuong_chinh_sach_id"
                                                                    class="form-control m-input" placeholder="" value="{{$hoc_sinh->doi_tuong_chinh_sach_id}}">
                                                            </div>
                                                        </div>
                                                    </div>
													<div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger"></span>Học sinh khuyết tật</label>
                                                        <div class="col-xl-3 col-lg-9">
                                                            <div class="m-radio-inline">
                                                            @if($hoc_sinh->hoc_sinh_khuyet_tat === 1)
                                                            
                                                            <label class="m-radio">
                                                                    <input type="radio"  name="hoc_sinh_khuyet_tat" value="1" checked> Có
                                                                    <span></span>
                                                                </label>
                                                                <label class="m-radio">
                                                                    <input type="radio"  name="hoc_sinh_khuyet_tat" value="0" > Không
                                                                    <span></span>
                                                                </label>
                                                            @else
                                                            <label class="m-radio">
                                                                    <input type="radio"  name="hoc_sinh_khuyet_tat" value="1" > Có
                                                                    <span></span>
                                                                </label>
                                                                <label class="m-radio">
                                                                    <input type="radio"  name="hoc_sinh_khuyet_tat" value="0" checked >Không
                                                                    <span></span>
                                                                </label>
                                                            @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger"></span>Ngày vào trường:</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <div class="input-group">
                                                            @error('ngay_vao_truong')
                                                            <small style="color:red">{{$message}}</small>
                                                        @enderror
                                                                <input type="date" name="ngay_vao_truong"
                                                                    class="form-control m-input" placeholder="" value="{{$hoc_sinh->ngay_vao_truong}}">
                                                            </div>
                                                        </div>
                                                    </div>                                                          z
                                                </div>
                                                 <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                            </div> 
													 <div class="col-xl-6">
                                                      <div class="m-form__section m-form__section--first">
                                                       </div>
													<div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger"></span> Ảnh:</label>
                                                                <img onClick="showModal()"
                                                                    src= "{{  $hoc_sinh->avatar == '' ? 'https://ui-avatars.com/api/?name=' . $hoc_sinh->ten . '&background=random' : $hoc_sinh->avatar }}"
                                                                    class="rounded mx-auto d-block mb-2" width="40%"
                                                                id="show_img">
                                                    <div class="col-xl-9 col-lg-9 mt-4">
                                                        <div class="input-group ml-5 ">
                                                            <div class="custom-file ml-5 col-12">
                                                                <input type="file"  accept="image/*"
                                                                id="anh_gv" onClick="showModal()" onchange="changeAvatar(this)"
                                                                    style="display:none" />
                                                                <input type="hidden" name="avatar">
                                                            </div>
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
                                                        Thông tin phụ huynh
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
                                                                class="text-danger"></span> Họ và tên cha: </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                        @error('ten_cha')
                                                            <small style="color:red">{{$message}}</small>
                                                        @enderror
                                                            <input type="text" name="ten_cha" class="form-control m-input"
                                                                placeholder="" value="{{$hoc_sinh->ten_cha}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger"></span>Ngày sinh:</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="date" name="ngay_sinh_cha" class="form-control m-input"
                                                                placeholder="" value="{{$hoc_sinh->ngay_sinh_cha}}">
                                                        </div>
                                                    </div>
													<div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger"></span> Số CMND/CCCD: </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                        @error('cmtnd_cha')
                                                            <small style="color:red">{{$message}}</small>
                                                        @enderror
                                                            <input type="text" name="cmtnd_cha" class="form-control m-input"
                                                                placeholder="" value="{{$hoc_sinh->cmtnd_cha}}" onkeypress="return isNumber(event)">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger"></span> Điện thoại: </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                        @error('dien_thoai_cha')
                                                            <small style="color:red">{{$message}}</small>
                                                        @enderror
                                                            <input type="text" name="dien_thoai_cha" class="form-control m-input"
                                                                placeholder="" value="{{$hoc_sinh->dien_thoai_cha}}"  onkeypress="return isNumber(event)">
                                                        </div>
                                                    </div>
                                                             
                                                   
                                                   
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="m-form__section m-form__section--first">
												<div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger"></span> Họ và tên mẹ:</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <div class="input-group">
                                                            @error('ten_me')
                                                            <small style="color:red">{{$message}}</small>
                                                               @enderror
                                                                <input type="text" name="ten_me"
                                                                    class="form-control m-input" placeholder="" value="{{$hoc_sinh->ten_me}}">
                                                            </div>
                                                        </div>
                                                    </div>
													<div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger"></span> Ngày sinh:</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <div class="input-group">
                                                           
                                                                <input type="date" name="ngay_sinh_me"
                                                                    class="form-control m-input" placeholder="" value="{{$hoc_sinh->ngay_sinh_me}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger"></span> Số CMND/CCCD: </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                        @error('cmtnd_me')
                                                            <small style="color:red">{{$message}}</small>
                                                        @enderror
                                                            <input type="text" name="cmtnd_me" class="form-control m-input"
                                                                placeholder="" onkeypress="return isNumber(event)" value="{{$hoc_sinh->cmtnd_me}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger"></span> Điện thoại: </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                        @error('dien_thoai_me')
                                                            <small style="color:red">{{$message}}</small>
                                                        @enderror
                                                            <input type="text" name="dien_thoai_me" class="form-control m-input"
                                                                placeholder="" value="{{$hoc_sinh->dien_thoai_me}}"  onkeypress="return isNumber(event)">
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
                                                                class="text-danger"></span>Tỉnh/Thành phố</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                        @error('ho_khau_thuong_tru_matp')
															<small style="color:red">{{$message}}</small>
															@enderror
                                                        <select class="form-control select2"
                                                            name="ho_khau_thuong_tru_matp" id="ho_khau_thuong_tru_matp">
                                                            <option value="">Chọn</option>
                                                            @foreach ($thanh_pho as $item)
                                                            <option {{($hoc_sinh->ho_khau_thuong_tru_matp == $item->matp) ? "selected" : ""}}
                                                             value="{{$item->matp}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger"></span>Quận/Huyện</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                        @error('ho_khau_thuong_tru_maqh')
															<small style="color:red">{{$message}}</small>
															@enderror
                                                        <select class="form-control select2"
                                                            name="ho_khau_thuong_tru_maqh" id="ho_khau_thuong_tru_maqh">
                                                            <option value="">Chọn</option>
                                                            @foreach ($maqh_gv_hktt as $item)
                                                            <option {{($hoc_sinh->ho_khau_thuong_tru_maqh == $item->maqh) ? "selected" : "1"}}
                                                            value="{{$item->maqh}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="m-form__section m-form__section--first">
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger"></span>Phường/Xã/Thị trấn:</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                        @error('ho_khau_thuong_tru_xaid')
															<small style="color:red">{{$message}}</small>
															@enderror
                                                        <select class="form-control select2"
                                                            name="ho_khau_thuong_tru_xaid" id="ho_khau_thuong_tru_xaid">
                                                            <option value="" selected>Chọn</option>
                                                            @foreach ($xaid_gv_hktt as $item)
                                                            <option {{($hoc_sinh->ho_khau_thuong_tru_xaid == $item->xaid) ? "selected" : ""}}
                                                            value="{{$item->xaid}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger"></span>Số nhà, đường </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                        @error('ho_khau_thuong_tru_so_nha')
															<small style="color:red">{{$message}}</small>
															@enderror
                                                            <input type="text" name="ho_khau_thuong_tru_so_nha"
                                                                class="form-control m-input" placeholder="" value="{{$hoc_sinh->ho_khau_thuong_tru_so_nha}}">

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
                                                                class="text-danger"></span>Tỉnh/Thành phố</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                        @error('noi_o_hien_tai_matp')
															<small style="color:red">{{$message}}</small>
															@enderror
                                                        <select class="form-control select2" name="noi_o_hien_tai_matp"
                                                            id="noi_o_hien_tai_matp">
                                                            <option value="" selected>Chọn</option>
                                                            @foreach ($thanh_pho as $item)
                                                            <option {{($hoc_sinh->noi_o_hien_tai_matp == $item->matp) ? "selected" : ""}}
                                                                value="{{$item->matp}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </select>

                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger"></span>Quận/Huyện</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                        @error('noi_o_hien_tai_maqh')
															<small style="color:red">{{$message}}</small>
															@enderror
                                                        <select class="form-control select2"
                                                            name="noi_o_hien_tai_maqh" id="noi_o_hien_tai_maqh">
                                                            <option value="" selected>Chọn</option>
                                                            @foreach ($maqh_gv_noht as $item)
                                                            <option {{($hoc_sinh->noi_o_hien_tai_maqh == $item->maqh) ? "selected" : ""}}
                                                            value="{{$item->maqh}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </select>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="m-form__section m-form__section--first">
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger"></span>Phường/Xã/Thị trấn:</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                        @error('noi_o_hien_tai_xaid')
															<small style="color:red">{{$message}}</small>
															@enderror
                                                        <select class="form-control select2"
                                                            name="noi_o_hien_tai_xaid" id="noi_o_hien_tai_xaid">
                                                            <option value="" selected>Chọn</option>
                                                            @foreach ($xaid_gv_noht as $item)
                                                            <option {{($hoc_sinh->noi_o_hien_tai_xaid == $item->xaid) ? "selected" : ""}}
                                                            value="{{$item->xaid}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger"></span>Số nhà, đường </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                        @error('noi_o_hien_tai_so_nha')
															<small style="color:red">{{$message}}</small>
															@enderror
                                                            <input type="text" name="noi_o_hien_tai_so_nha"
                                                                class="form-control m-input" placeholder="" value="{{$hoc_sinh->noi_o_hien_tai_so_nha}}">

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                            </div>
                                      	  </div>
                              	      </div>					
									</div>
								</div>
								<div class="m-portlet__foot m-portlet__foot--fit">
													<div class="m-form__actions">
														<div class="row">
															<div class="col-2">
															</div>
															<div class="col-7">
																<button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom">Cập nhật</button>&nbsp;&nbsp;
																<a href="{{route('account.ds-hs')}}">Quay lại</a>
															</div>
														</div>
													</div>
												</div>
                                            @endauth
                                            </form>
                                        </div> 
                                    </div>
                            </div>
										<div class="tab-pane " id="m_user_profile_tab_2">
										</div>
										<div class="tab-pane " id="m_user_profile_tab_3">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		
		
@endsection
@section('script')

@if (session('message'))
<script>
    Swal.fire({
        position: "center",
        icon: "success",
        title: "Cập nhật tài khoản thành công !",
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif


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
function isNumber(evt)
  {
     var charCode = (evt.which) ? evt.which : event.keyCode
     if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

     return true;
  }	
var url_get_maqh_by_matp = "{{route('get_quan_huyen_theo_thanh_pho')}}";
var url_get_xaid_by_maqh = "{{route('get_xa_phuong_theo_thi_tran')}}";
function changeAvatar(file){
    var fileShow = file.files[0];
    var reader = new FileReader();
    reader.onloadend = function() {
        $('#show_img').attr('src', reader.result);
    }
    reader.readAsDataURL(fileShow);

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
                let url;
                url = rs.data.display_url;
				$('[name="avatar"]').val(url);
            });
	}
</script>
<script src="{!! asset('js/get_quan_huyen_xa.js') !!}"></script>
@if(SESSION('message'))
<script>
    Swal.fire({
    position: 'top-center',
    icon: 'success',
    title: 'Cập nhật tài khoản thành công!',
    showConfirmButton: false,
    timer: 1500
    })
</script>
@endif
@endsection