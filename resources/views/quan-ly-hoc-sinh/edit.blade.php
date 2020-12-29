@extends('layouts.main')
@section('title', 'Chi tiết học sinh')
@section('content')
    <div class="m-content">
        @if(SESSION('thongbaocapnhat'))
        <div class="m-alert m-alert--outline m-alert--square m-alert--outline-2x alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            </button>
            <strong>Thành công!</strong> Cập nhật thông tin học sinh thành công.
        </div>
        @endif
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
                                    Chi tiết học sinh : {{$data->ten}}
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
                                                    <option @if (isset($data->khoi_hs_id))
                                                        {{($item1->id == $data->khoi_hs_id  ) ? 'selected' : ''}}
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
                                    
                                </div>
    
                            </div>
                        </div>
    
    
                    </div>
                </div>
            </div>
        </div>
        <div id="row">
        {{-- MOAL --}}
        
        <div class=" d-flex flex-row-reverse bd-highlight mb-4 ">
            <a href="#" onclick="ShowChiTietSucKhoe({{$id}})" class="btn btn-secondary m-btn m-btn--icon" data-toggle="modal" data-target="#modal_suc_khoe">
                <span>
                    <i class="fa fa-notes-medical"></i>
                    <span>Sức khỏe</span>
                </span>
            </a>
            <a href="#" onclick="ShowLichSuHocSinh({{$id}})" class="btn btn-secondary m-btn m-btn--icon" data-toggle="modal" data-target="#modal_lich_su_hoc">
                <span>
                    <i class="fa fa-pencil-alt"></i>
                    <span>Lịch sử học</span>
                </span>
            </a>
            <a href="#" onclick="ShowHocPhi({{$id}})" class="btn btn-secondary m-btn m-btn--icon" data-toggle="modal" data-target="#modal_hoc_phi">
                <span>
                    <i class="fa fa-money-check-alt"></i>
                    <span>Học phí</span>
                </span>
            </a>
            
        </div>
        
        {{-- END_MOAL --}}
        {{-- Show Học Phí --}}
        <div class="modal fade show" id="modal_hoc_phi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none; padding-right: 17px;">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Học phí</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                    <div class="m-portlet__body" id="showHocPhiHS">
                        {{-- <ul class="nav nav-pills nav-fill" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" data-toggle="tab" href="#m_tabs_5_1">Năm 2020 - 2021 (Hiện tại)</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#m_tabs_5_2">Link</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#m_tabs_5_3">Link</a>
                            </li>
                            
                        </ul> --}}
                        {{-- <div class="tab-content">
                            <div class="tab-pane active show" id="m_tabs_5_1" role="tabpanel">
                                <table class="table table-bordered m-table">
                                    <thead align="center">
                                        <tr>
                                            <th>Số thứ tự</th>
                                            <th>Đợt</th>
                                            <th>Lớp</th>
                                            <th>Chức năng</th>
                                        </tr>
                                    </thead>
                                    <tbody align="center">
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="m_tabs_5_2" role="tabpanel">
                                It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more
                                recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                            </div>
                            <div class="tab-pane" id="m_tabs_5_3" role="tabpanel">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type
                                specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged
                            </div>
                            <div class="tab-pane" id="m_tabs_5_4" role="tabpanel">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type
                                specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                                industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                            </div>
                        </div> --}}
                    </div>
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                  
                </div>
              </div>
            </div>
          </div>
        {{-- End Show Học Phí --}}
        {{-- Show Lịch Sử Học --}}
        <div class="modal fade show" id="modal_lich_su_hoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none; padding-right: 17px;">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Lịch sử học</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-row" id="showLichSuHocCuaHocSinh">
                    Đang lấy dữ liệu....
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                  
                </div>
              </div>
            </div>
          </div>
        {{-- End Show Lịch Sử Học --}}
        {{-- Show Sức khỏe --}}
        <div class="modal fade show" id="modal_suc_khoe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none; padding-right: 17px;">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Sức khỏe</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-row" id="showChiTietSucKhoeCuaHocSinh">
                    Đang lấy dữ liệu....
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                  
                </div>
              </div>
            </div>
          </div>
        {{-- End Show Sức khỏe --}}
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="m-portlet m-portlet--full-height">
                    <div class="" id="m_wizard">
                        <div class="m-wizard__form">
                            <form class="m-form m-form--label-align-left- m-form--state-"
                            action="{{route('quan-ly-hoc-sinh-update', ['id' => $data->id])}}" method="POST" enctype="multipart/form-data">
                                <div class="m-portlet__body">
                                    @csrf
                                    <div class="m-wizard__form-step m-wizard__form-step--current" id="m_wizard_form_step_1">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-5">
                                                    <div class="m-form__heading">
                                                        <h3 class="m-form__heading-title" style="font-weight: bold">
                                                            Thông tin
                                                            <i data-toggle="m-tooltip" data-width="auto"
                                                                class="m-form__heading-help-icon flaticon-info" title=""
                                                                data-original-title="Some help text goes here"></i>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-xl-6">
                                                <div class="m-form__section m-form__section--first">
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span> Mã học sinh </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" class="form-control m-input"
                                                            placeholder="" value="{{$data->ma_hoc_sinh}}" disabled>
                                                        </div>

                                                    </div>

                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span> Họ và tên </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="ten"  class="form-control m-input"
                                                            placeholder="Điên họ và tên" value="{{$data->ten}}">

                                                            @error('ten')
                                                                  <p class="text-danger text-small error">{{ $message }}</p>
                                                            @enderror
                                                        </div>


                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger"></span> Tên hay gọi </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="ten_thuong_goi" class="form-control m-input"
                                                        placeholder="Điền tên hay gọi (nếu có)" value="{{$data->ten_thuong_goi}}">
                                                            
                                                            @error('ten_thuong_goi')
                                                                <p class="text-danger text-small error">{{ $message }}</p>
                                                            @enderror    
                                                        </div>

                                                       

                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span> Ngày sinh </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="date"  name="ngay_sinh" class="form-control m-input"
                                                         value="{{$data->ngay_sinh}}">
                                                            @error('ngay_sinh')
                                                                <p class="text-danger text-small error">{{ $message }}</p>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Dân tộc</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                        <select name="dan_toc" class="form-control m-input name-field select2" placeholder="Điền dân tộc">
                                                            @foreach (config('common.dan_toc') as $key => $value)
                                                                <option value="{{ $key }}" {{ $data->dan_toc == $key ? 'selected' : ''}}>{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                            @error('dan_toc')
                                                                    <p class="text-danger text-small error">{{ $message }}</p>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Giới tính</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <div class="m-radio-inline">
                                                                @foreach (config('common.gioi_tinh') as $key => $item)
                                                                    <label class="m-radio">
                                                                        <input type="radio" name="gioi_tinh"
                                                                            value={{$key}} {{($data->gioi_tinh == $key) ? 'checked' : ''}}> {{ $item }}
                                                                        <span></span>
                                                                    </label>
                                                                @endforeach
                                                            </div>
                                                            @error('gioi_tinh')
                                                                <p class="text-danger text-small error">{{ $message }}</p>
                                                             @enderror
                                                        </div>
                                                    </div>
                                                   


                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Đối tượng chính sách</label>
                                                        <div class="col-xl-9 col-lg-9">

                                                        <select class="form-control select2" multiple="multiple" name="dien_uu_tien[]" id="doi_tuong_chinh_sach_id">
                                                            
                                                            @foreach ($doi_tuong_chinh_sach as $item)
                                                            <option 
                                                            @if($chinh_sach_hoc_sinh)
                                                            @foreach ($chinh_sach_hoc_sinh as $item2)
                                                                @if ($item2->id_chinh_sach == $item->id)
                                                                    {{"selected"}}
                                                                @endif 
                                                            @endforeach
                                                            @endif
                                                            value="{{ $item->id }}">{{ $item->ten_chinh_sach }}
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
                                                                    
                                                                     name="hoc_sinh_khuyet_tat"
                                                                        value="1" {{($data->hoc_sinh_khuyet_tat == 1) ? 'checked' : ''}}> Có
                                                                    <span></span>
                                                                </label>
                                                                <label class="m-radio">
                                                                    <input type="radio"
                                                                   
                                                                      name="hoc_sinh_khuyet_tat"
                                                                      value="0" {{($data->hoc_sinh_khuyet_tat == 0) ? 'checked' : ''}}>
                                                                    Không
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="m-form__section m-form__section--first">
    
    
                                                    <div class="form-group m-form__group row">
                                                        <img onClick="showModal()"
                                                            src= {{($data->avatar == "") ? 'https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_960_720.png' :  $data->avatar }}
                                                            class="rounded mx-auto d-block mb-2" width="250px"
                                                            height="255px" id="show_img">
                                                        <div class="col-xl-9 col-lg-9 mt-4">
                                                            <div class="input-group ml-5 ">
    
                                                                <div class="custom-file ml-5 col-12">
                                                                    <input type="file" accept="images/*"
                                                                    id="anh_gv" onClick="showModal()"onchange="changeAvatar(this)"
                                                                        style="display:none" />
                                                                        <input type="hidden" name="avatar">
    
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
                                            <div class="col-md-12">
                                                <div class="m-form__heading">
                                                    <h3 class="m-form__heading-title" style="font-weight: bold">
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
                                                        <select class="form-control select2"  name="ho_khau_thuong_tru_matp" id="ho_khau_thuong_tru_matp">
                                                            <option value="">Chọn</option>
                                                            @foreach ($thanhpho as $item)
                                                            <option {{($data->ho_khau_thuong_tru_matp == $item->matp) ? "selected" : ""}}
                                                             value="{{$item->matp}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                            @error('ho_khau_thuong_tru_matp')
                                                                    <p class="text-danger text-small error">{{ $message }}</p>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Quận/Huyện</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                        <select class="form-control select2"  name="ho_khau_thuong_tru_maqh" id="ho_khau_thuong_tru_maqh">
															<option value="">Chọn</option>
                                                            @foreach ($maqh_hs_hktt as $item)
                                                            <option {{($data->ho_khau_thuong_tru_maqh == $item->maqh) ? "selected" : ""}}
                                                            value="{{$item->maqh}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                            @error('ho_khau_thuong_tru_maqh')
                                                                    <p class="text-danger text-small error">{{ $message }}</p>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="m-form__section m-form__section--first">
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Phường/Xã/Thị trấn</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <select class="form-control select2"  name="ho_khau_thuong_tru_xaid" id="ho_khau_thuong_tru_xaid">
                                                                <option value="">Chọn</option>
                                                                @foreach ($xaid_hs_hktt as $item)
                                                                <option {{($data->ho_khau_thuong_tru_xaid == $item->xaid) ? "selected" : ""}}
                                                                value="{{$item->xaid}}">{{$item->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('ho_khau_thuong_tru_xaid')
                                                                  <p class="text-danger text-small error">{{ $message }}</p>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Số nhà, đường </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text"
                                                             name="ho_khau_thuong_tru_so_nha"
                                                                class="form-control m-input"  placeholder="Điền số nhà, đường" value="{{$data->ho_khau_thuong_tru_so_nha}}">

                                                                @error('ho_khau_thuong_tru_so_nha')
                                                                  <p class="text-danger text-small error">{{ $message }}</p>
                                                                @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
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
                                                            <select class="form-control select2"  name="noi_o_hien_tai_matp"
                                                            id="noi_o_hien_tai_matp">
                                                            <option value="" selected>Chọn</option>
                                                            @foreach ($thanhpho as $item)
                                                            <option {{($data->noi_o_hien_tai_matp == $item->matp) ? "selected" : ""}}
                                                                value="{{$item->matp}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </select>

                                                            @error('noi_o_hien_tai_matp')
                                                                  <p class="text-danger text-small error">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Quận/Huyện</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <select class="form-control select2"
                                                            name="noi_o_hien_tai_maqh"  id="noi_o_hien_tai_maqh">
                                                            <option value="" selected>Chọn</option>
                                                            @foreach ($maqh_hs_noht as $item)
                                                            <option {{($data->noi_o_hien_tai_maqh == $item->maqh) ? "selected" : ""}}
                                                            value="{{$item->maqh}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </select>

                                                            @error('noi_o_hien_tai_maqh')
                                                                   <p class="text-danger text-small error">{{ $message }}</p>
                                                            @enderror

                                                        </div>
                                                     <div class="m-separator m-separator--dashed m-separator--lg"></div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="m-form__section m-form__section--first">
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Phường/Xã/Thị trấn</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <select class="form-control select2"
                                                            name="noi_o_hien_tai_xaid"  id="noi_o_hien_tai_xaid">
                                                            <option value="" selected>Chọn</option>
                                                            @foreach ($xaid_hs_noht as $item)
                                                            <option {{($data->noi_o_hien_tai_xaid == $item->xaid) ? "selected" : ""}}
                                                            value="{{$item->xaid}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </select>

                                                            @error('noi_o_hien_tai_xaid')
                                                                   <p class="text-danger text-small error">{{ $message }}</p>
                                                            @enderror

                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Số nhà, đường </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text"
                                                             name="noi_o_hien_tai_so_nha"
                                                                class="form-control m-input"  placeholder="Điền số nhà, đường" value="{{$data->noi_o_hien_tai_so_nha}}">

                                                                @error('noi_o_hien_tai_so_nha')
                                                                   <p class="text-danger text-small error">{{ $message }}</p>
                                                                @enderror
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
                                                    <h3 class="m-form__heading-title" style="font-weight: bold">
                                                        Thông tin cha
                                                        <i data-toggle="m-tooltip" data-width="auto"
                                                            class="m-form__heading-help-icon flaticon-info" title=""
                                                            data-original-title="Some help text goes here"></i>
                                                    </h3>
                                                </div>
                                            </div>

												<div class="col-lg-4">
													<label>Họ tên (Cha)  </label>
													<div class="input-group m-input-group m-input-group--square">
														<div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
														<input type="text"  name="ten_cha" 
                                                        value="{{$data->ten_cha}}"
                                                        class="form-control m-input"  placeholder="Điền họ tên cha">
                                                    </div>
                                                        @error('ten_cha')
                                                            <p class="text-danger text-small error">{{ $message }}</p>
                                                        @enderror
                                                    <div class="m-separator m-separator--dashed m-separator--lg"></div>

												</div>

												<div class="col-lg-4">
													<label class="">Số điện thoại (Cha)  </label>
													<input type="text"  class="form-control m-input"  name="dien_thoai_cha" 
                                                    value="{{$data->dien_thoai_cha}}" onkeypress="return isNumberKey(event)"
                                                    placeholder="SĐT cha">
												
                                                        @error('dien_thoai_cha')
                                                                    <p class="text-danger text-small error">{{ $message }}</p>
                                                        @enderror
                                                    <div class="m-separator m-separator--dashed m-separator--lg"></div>

												</div>
												<div class="col-lg-4">
													<label>Số chứng minh nhân dân (Cha)  </label>
													<input type="text" class="form-control m-input"  name="cmtnd_cha"
                                                    value="{{$data->cmtnd_cha}}" onkeypress="return isNumberKey(event)"
                                                     placeholder="Số chứng minh nhân dân cha">
													   
                                                    @error('cmtnd_cha')
                                                        <p class="text-danger text-small error">{{ $message }}</p>
                                                    @enderror

                                                    <div class="m-separator m-separator--dashed m-separator--lg"></div>

												</div>

                                         
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="m-form__heading">
                                                    <h3 class="m-form__heading-title" style="font-weight: bold">
                                                        Thông tin mẹ
                                                        <i data-toggle="m-tooltip" data-width="auto"
                                                            class="m-form__heading-help-icon flaticon-info" title=""
                                                            data-original-title="Some help text goes here"></i>
                                                    </h3>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
													<label>Họ tên (Mẹ)  </label>
													<div class="input-group m-input-group m-input-group--square">
														<div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
														<input type="text" name="ten_me"  
                                                        value="{{$data->ten_me}}"
                                                        class="form-control m-input" placeholder="Điền họ tên mẹ">
													</div>

                                                        @error('ten_me')
                                                            <p class="text-danger text-small error">{{ $message }}</p>
                                                        @enderror

                                                    <div class="m-separator m-separator--dashed m-separator--lg"></div>

												</div>
												<div class="col-lg-4">
													<label class="">Số điện thoại (Mẹ)  </label>
													<input type="text" class="form-control m-input"
                                                    name="dien_thoai_me" 
                                                    value="{{$data->dien_thoai_me}}" onkeypress="return isNumberKey(event)"
                                                    placeholder="SĐT mẹ">

                                                    @error('dien_thoai_me')
                                                        <p class="text-danger text-small error">{{ $message }}</p>
                                                    @enderror

                                                    <div class="m-separator m-separator--dashed m-separator--lg"></div>

												</div>
												<div class="col-lg-4">
													<label>Số chứng minh nhân dân (Mẹ)  </label>
													<input type="text" class="form-control m-input"  name="cmtnd_me" 
                                                    value="{{$data->cmtnd_me}}" onkeypress="return isNumberKey(event)"
                                                    placeholder="Số chứng minh thư nhân dân mẹ">
														   

                                                    @error('cmtnd_me')
                                                        <p class="text-danger text-small error">{{ $message }}</p>
                                                    @enderror

                                                     <div class="m-separator m-separator--dashed m-separator--lg"></div>

												</div>
                                                
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="m-form__heading">
                                                    <h3 class="m-form__heading-title" style="font-weight: bold">
                                                        Thông tin người giám hộ
                                                        <i data-toggle="m-tooltip" data-width="auto"
                                                            class="m-form__heading-help-icon flaticon-info" title=""
                                                            data-original-title="Some help text goes here"></i>
                                                    </h3>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
													<label>Họ tên (Người giám hộ)  </label>
													<div class="input-group m-input-group m-input-group--square">
														<div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
														<input type="text" name="ten_nguoi_giam_ho" 
                                                        value="{{$data->ten_nguoi_giam_ho}}"
                                                        class="form-control m-input" placeholder="Điền họ tên Người giám hộ">
													</div>

                                                    @error('ten_nguoi_giam_ho')
                                                            <p class="text-danger text-small error">{{ $message }}</p>
                                                    @enderror
                                                    <div class="m-separator m-separator--dashed m-separator--lg"></div>

												</div>
												<div class="col-lg-4">
													<label class="">Số điện thoại (Người giám hộ)  </label>
													<input type="text" class="form-control m-input"
                                                    name="dien_thoai_nguoi_giam_ho" 
                                                    value="{{$data->dien_thoai_nguoi_giam_ho}}" onkeypress="return isNumberKey(event)"
                                                    placeholder="SĐT Người giám hộ">


                                                    @error('dien_thoai_nguoi_giam_ho')
                                                        <p class="text-danger text-small error">{{ $message }}</p>
                                                    @enderror

                                                    <div class="m-separator m-separator--dashed m-separator--lg"></div>
												</div>
												<div class="col-lg-4">
													<label>Số chứng minh nhân dân (Người giám hộ)  </label>
													<input type="text" class="form-control m-input" name="cmtnd_nguoi_giam_ho" 
                                                    value="{{$data->cmtnd_nguoi_giam_ho}}" onkeypress="return isNumberKey(event)"
                                                    placeholder="Số chứng minh thư nhân dân Người giám hộ">

                                                    @error('cmtnd_nguoi_giam_ho')
                                                        <p class="text-danger text-small error">{{ $message }}</p>
                                                    @enderror
                                                     <div class="m-separator m-separator--dashed m-separator--lg"></div>

												</div>
                                                
                                        </div>

                                        
                                    </div>

                                <div class="m-portlet__foot m-portlet__foot--fit m--margin-top-40">
                                    <div class="m-form__actions">
                                        <div class="row">
                                            <div class="col-lg-8"></div>
                                            <div class="col-lg-1">
                                                <a href="{{route('quan-ly-lop-show', ['id' => $data->lop_id])}}"><div class="btn btn-danger">
                                                    <span>
                                                        <span>Quay lại</span>
                                                    </span>
                                                </div></a>
                                            
                                            </div>
                                            <div class="col-lg-2 m--align-right">
                                                
                                                <button type="submit" class="btn btn-success">
                                                    Cập nhật
                                                </button>
                                            
                                            </div>
                                            
                                            <div class="col-lg-2"></div>
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
  

@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="path/to/chartjs/dist/Chart.js"></script>
    <script src="{!!  asset('assets/demo/custom/crud/forms/widgets/bootstrap-datepicker.js') !!}"></script>
    <script>
    function showimages(element) {
           		 var file = element.files[0];
                var reader = new FileReader();
                reader.onloadend = function() {
                    $('#show_img').attr('src', reader.result);
                }
                reader.readAsDataURL(file);
    }
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
				$('[name="avatar"]').val(url);
            });
    }

    function isNumberKey(evt){
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;
                return true;
    }

    $(document).ready(function() {
        $('.select2').select2();
    });
    var url_get_lop_theo_khoi = "{{route('quan-ly-giao-vien-get-lop-theo-khoi')}}";
    var url_get_maqh_by_matp = "{{route('get_quan_huyen_theo_thanh_pho')}}";
    var url_get_xaid_by_maqh = "{{route('get_xa_phuong_theo_thi_tran')}}";
    var url_ShowChiTietSucKhoe = "{{route('quan-ly-suc-khoe-show-chi-tiet')}}"
    var url_show_lop = "{{route('quan-ly-lop-show', ['id'])}}"
    var url_lich_su_cua_hoc_sinh = "{{route('quan-li-lich-su-cua-hoc-sinh')}}"
    function ShowChiTietSucKhoe(hoc_sinh_id){
      $('#preload').css('display', 'block');
      axios.post(url_ShowChiTietSucKhoe , {
        hoc_sinh_id:hoc_sinh_id
      }).then(function(response){
    if(response.data.length > 0){

        
        var i = 1;
        var html_modal = 
        `
        <div class="col-md-12 mb-3">
          <label for="validationTooltip01"><b>Học sinh:</b> ${response.data[0].ten}</label>
        </div>
        <div class="col-md-12 mb-3">
          <label for="validationTooltip01"><b>Mã học sinh:</b> ${response.data[0].ma_hoc_sinh}</label>
        </div>
        <div class="col-md-12 mb-3">
          <div class="row">
							<div class="col-lg-6">

								<!--begin::Portlet-->
								<div class="m-portlet m-portlet--tab">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
												<h3 class="m-portlet__head-text">
													Biểu đồ chiều cao (cm)
												</h3>
											</div>
										</div>
									</div>
									<div class="m-portlet__body">
										<canvas id="myChart" width="200" height="200"></canvas>
									</div>
								</div>

								<!--end::Portlet-->
							</div>
							<div class="col-lg-6">

								<!--begin::Portlet-->
								<div class="m-portlet m-portlet--tab">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
												<h3 class="m-portlet__head-text">
													Biểu đồ cân nặng (kg)
												</h3>
											</div>
										</div>
									</div>
									<div class="m-portlet__body">
                    <canvas id="myChart2" width="200" height="200"></canvas>
										
									</div>
								</div>

								<!--end::Portlet-->
							</div>
						</div>
        
        </div>
        <div class="col-md-12 mb-3">
          <table class="table m-table m-table--head-bg-success table-bordered">
          <thead align="center">
               <tr>
                   <th>Số thứ tự</th>
                   <th>Đợt</th>
                   <th>Thời gian</th>
                   <th>Lớp</th>
                   <th>Chiều cao (cm)</th>
                   <th>Cân nặng (kg)</th>
               </tr>
          </thead>
          <tbody align="center">
        `
        var labels_chart = []
        var data_chart = []
        var data_chart2 = []
        var backgroundColor_ChieuCao = []
        var backgroundColor_CanNang = []
        response.data.forEach(element => {
          var date = new Date(element.thoi_gian),
            yr = date.getFullYear(),
            month = Number(date.getMonth() < 10 ? '0' + date.getMonth() : date.getMonth()),
            day = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate(),
            newDate = day + '-' + (month+1) + '-' + yr;

          if(element.chieu_cao == 0){
            element.chieu_cao = `<span class="m-badge m-badge--danger m-badge--wide m-badge--rounded">Không có dữ liệu</span>`
          }
          if(element.can_nang == 0){
            element.can_nang = `<span class="m-badge m-badge--danger m-badge--wide m-badge--rounded">Không có dữ liệu</span>`
          }
          var url_show_lop_new = url_show_lop.replace('id', element.lop_id)
          html_modal += 
          `
          <tr>
               <th scope="row">${i++}</th>
               <td>${element.ten_dot}</td>
               <td>${newDate}</td>
               <td><a target="_blank" href="${url_show_lop_new}"><b>${element.ten_lop}</b></a></td>
               <td>${element.chieu_cao}</td>
               <td>${element.can_nang}</td>
          </tr>
           
           
          `
          //Chart
          labels_chart.unshift(element.ten_dot)
          data_chart.unshift(element.chieu_cao)
          data_chart2.unshift(element.can_nang)
          backgroundColor_ChieuCao.unshift('rgba(255, 99, 132, 0.2)')
          backgroundColor_CanNang.unshift('rgba(75, 192, 192, 0.2)')
        })
        html_modal += 
        `
        </tbody></table></div>
        `
        $('#showChiTietSucKhoeCuaHocSinh').html(html_modal);
        var ctx = document.getElementById('myChart');
        var ctx2 = document.getElementById('myChart2');
        //Chiều cao
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels_chart,
                datasets: [{
                    label: 'Chiều cao',
                    data: data_chart,
                    backgroundColor: backgroundColor_ChieuCao,
                    borderColor: backgroundColor_ChieuCao,
                    borderWidth: 1
                }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        //Cân nặng
        var myChart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: labels_chart,
                datasets: [{
                    label: 'Cân nặng',
                    data: data_chart2,
                    backgroundColor: backgroundColor_CanNang,
                    borderColor: backgroundColor_CanNang,
                    borderWidth: 1
                }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        $('#preload').css('display', 'none');
        $('#modal_suc_khoe').modal('show');
    }
    else{
        var html_modal = `<i><b style="color:red">Không tìm thấy dữ liệu nào của học sinh này</b></i>`
        $('#showChiTietSucKhoeCuaHocSinh').html(html_modal);
        $('#preload').css('display', 'none');
        $('#modal_suc_khoe').modal('show');
    }
      })
    
    }

    function ShowLichSuHocSinh(hoc_sinh_id){
        axios.post(url_lich_su_cua_hoc_sinh, {hoc_sinh_id: hoc_sinh_id})
        .then(function(response){
            if(response.data.LichSuHocSinh.length == 0 && response.data.LopHocHienTai.lop_id == 0){
                var html_modal = `Không có dữ liệu`
                $('#showLichSuHocCuaHocSinh').html(html_modal);
                $('#preload').css('display', 'none');
                $('#modal_lich_su_hoc').modal('show');
            }
            else{
                var i = 1
                var html_modal = 
                `
                <div class="col-md-12 mb-3">
                <table class="table m-table m-table--head-bg-success table-bordered">
                <thead align="center">
                    <tr>
                        <th>Số thứ tự</th>
                        <th>Năm</th>
                        <th>Lớp</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody align="center">
                `
                if(response.data.LopHocHienTai.lop_id > 0){
                    var dataHT = response.data.LopHocHienTai
                    var url_show_lop_new = url_show_lop.replace('id', dataHT.lop_id)
                    html_modal+=
                    `
                    <tr>
                        <th scope="row">${i++}</th>
                        <td>${dataHT.ten_nam}</td>
                        <td>${dataHT.ten_lop} (đang học)</td>
                        <td>
                        <a href="${url_show_lop_new}">
                        <button type="button" class="btn btn-outline-success btn-sm m-btn m-btn--custom">Chi tiết</button>
                        </a>
                        </td>
                       
                    </tr>
                    `
                }
                response.data.LichSuHocSinh.forEach(element => {
                    var url_show_lop_new_2 = url_show_lop.replace('id', element.lich_su_lop_id)
                    html_modal+=
                    `
                    <tr>
                        <th scope="row">${i++}</th>
                        <td>${element.ten_nam}</td>
                        <td>${element.ten_lop_ls}</td>
                        <td>
                        <a href="${url_show_lop_new_2}">
                            <button type="button" class="btn btn-outline-success btn-sm m-btn m-btn--custom">Chi tiết</button>
                        </a>
                        </td>
                       
                    </tr>
                    ` 
                })
                html_modal += 
                `
                </tbody></table></div>
                `
                $('#showLichSuHocCuaHocSinh').html(html_modal);
                $('#preload').css('display', 'none');
                $('#modal_lich_su_hoc').modal('show');
            }
        })
    }

    function isNumberKey(evt){
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;
                return true;
    }
    var url_HocPhiHocSinh = "{{route('quan-ly-hoc-sinh-hoc-phi')}}"
    function ShowHocPhi(id){
        axios.post(url_HocPhiHocSinh, {id:id})
        .then(function(response){
            var data = response.data
            console.log(data.array_HocPhi)
            //if
            if(data.array_HocPhi.length > 0){
                var id_nam_hoc = data.id_nam_hoc
                var html = `<ul class="nav nav-pills nav-fill" role="tablist">`
                data.array_HocPhi.forEach(element => {
                    var active = ""
                    if(element.nam_hoc == id_nam_hoc){
                        active = `active show`
                    }
                    html+=
                    `
                    <li class="nav-item">
                                <a class="nav-link ${active}" data-toggle="tab" href="#m_tabs_5_${element.nam_hoc}">${element.ten_nam}</a>
                    </li>
                    `
                })
                html+= `</ul> <div class="tab-content">`
                data.array_HocPhi.forEach(element => {
                    var active_2 = ""
                    if(element.nam_hoc == id_nam_hoc){
                        active_2 = `active show`
                    }
                    var i = 1
                    html+=
                    `
                    <div class="tab-pane ${active_2}" id="m_tabs_5_${element.nam_hoc}" role="tabpanel">
                        <table class="table table-bordered table-hover">
                            <thead align="center">
                                <tr>
                                    <th>Stt</th>
                                    <th width="100px">Tháng - năm</th>
                                    <th>Đợt</th>
                                    <th>Tổng tiền phải thu</th>
                                    <th>Số tiền đã đóng</th>
                                    <th>Đóng tiền</th>
                                    <th>Thông báo</th>
                                </tr>
                            </thead>
                        <tbody align="center">
                    `
                    element.hoc_phi.forEach(el => {
                        var trang_thai = `<i style="color:red" class="flaticon-circle"></i>`
                        var thong_bao = `<i style="color:red" class="flaticon-circle"></i>`
                        if(el.trang_thai == 1){
                            trang_thai = `<i style="color:green" class="fa fa-check"></i>`
                        }
                        if(el.thong_bao == 1){
                            thong_bao = `<i style="color:green" class="fa fa-check"></i>`
                        }
                        if(el.so_tien_phai_dong > 0){
                            html+= 
                            `
                            <tr>
                            <td>${i++}</td>
                            <td>${el.thang_thu} - ${el.nam_thu}</td>
                            <td>${el.ten_dot_thu}</td>
                            <td style="color:red"><b>${el.so_tien_phai_dong.toLocaleString('vi-VN')}</b></td>
                            <td style="color:green"><b>${el.so_tien_da_dong.toLocaleString('vi-VN')}</b></td>
                            <td>${trang_thai}</td>
                            <td>${thong_bao}</td>
                            </tr>
                            `
                        }
                        
                    })
                    html+= `</tbody></table></div>`
                })
                html+= `</div>`
                $('#showHocPhiHS').html(html)
            }
            //endif
        })
    }

    </script>
    <script src="{!! asset('js/get_quan_huyen_xa.js') !!}"></script>
@endsection
