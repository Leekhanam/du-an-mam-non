@extends('layouts.main')
@section('title', 'Thêm mới học sinh')
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
                                    Thêm mới học sinh
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-section">
                            <div class="m-section__content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group m-form__group row">
                                            <label class="col-lg-2 col-form-label">Khối</label>
                                            <div class="col-lg-8">
                                                <select class="form-control" name="loai_hinh" id="loai_hinh">
                                                    <option value="0" selected>Chọn khối</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group m-form__group row">
                                            <label for="" class="col-lg-2 col-form-label">Lớp</label>
                                            <div class="col-lg-8">
                                                <select class="form-control" name="co_so_id" id="co_so_id">
                                                    <option value="">Chọn lớp</option>
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
        <div class="row">
            <div class="col-xl-12">
                <div class="m-portlet m-portlet--full-height">


                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Thông tin học sinh
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
                    <div class="m-wizard m-wizard--2 m-wizard--success m-wizard--step-first" id="m_wizard">
                        <div class="m-portlet__padding-x">
                        </div>
                        <div class="m-wizard__head m-portlet__padding-x">
                            <div class="m-wizard__progress">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                        aria-valuemax="100" style="width: 0%;"></div>
                                </div>
                            </div>
                            <div class="m-wizard__nav">
                                <div class="m-wizard__steps">
                                    <div class="m-wizard__step m-wizard__step--current"
                                        m-wizard-target="m_wizard_form_step_1">
                                        <a href="#" class="m-wizard__step-number">
                                            <span><i class="fa  flaticon-placeholder"></i></span>
                                        </a>
                                        <div class="m-wizard__step-info">
                                            <div class="m-wizard__step-title">
                                                1. Thông tin cơ bản học sinh
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-wizard__step" m-wizard-target="m_wizard_form_step_2">
                                        <a href="#" class="m-wizard__step-number">
                                            <span><i class="fa  flaticon-layers"></i></span>
                                        </a>
                                        <div class="m-wizard__step-info">
                                            <div class="m-wizard__step-title">
                                                2. Thông tin người giám hộ
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-wizard__form">
                            <form class="m-form m-form--label-align-left- m-form--state-" id="m_form"
                                action="{{ route('quan-ly-hoc-sinh-store') }}" method="POST">
                                <div class="m-portlet__body">
                                    @csrf
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
                                                                class="text-danger">*</span> Họ và tên: </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="ten" class="form-control m-input"
                                                                placeholder="" value="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Ngày sinh:</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="ngay_sinh" class="form-control m-input"
                                                                placeholder="" value="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Dân tộc</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="dan_toc" class="form-control m-input"
                                                                placeholder="" value="">
                                                        </div>
                                                    </div>

                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span> Nơi sinh:</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <div class="input-group">
                                                                <input type="text" name="noi_sinh"
                                                                    class="form-control m-input" placeholder="" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="m-form__section m-form__section--first">

                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Giới tính</label>
                                                        <div class="col-xl-3 col-lg-9">
                                                            <div class="m-radio-inline">
                                                                <label class="m-radio">
                                                                    <input type="radio" name="gioi_tinh" value="1"> Nam
                                                                    <span></span>
                                                                </label>
                                                                <label class="m-radio">
                                                                    <input type="radio" checked name="gioi_tinh" value="2">
                                                                    Nữ
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Học sinh khuyết tật</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <div class="m-radio-inline">
                                                                <label class="m-radio">
                                                                    <input type="radio" name="hoc_sinh_khuyet_tat"
                                                                        value="1"> Có
                                                                    <span></span>
                                                                </label>
                                                                <label class="m-radio">
                                                                    <input type="radio" checked name="hoc_sinh_khuyet_tat"
                                                                        value="2">
                                                                    Khống
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Đối tượng chính sách</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="doi_tuong_chinh_sach"
                                                                class="form-control m-input" placeholder="" value="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Ngày vào trường</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <div class="input-group date">
                                                                <input type="text" class="form-control m-input" readonly=""
                                                                    placeholder="Select date" id="m_datepicker_2">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">
                                                                        <i class="la la-calendar-check-o"></i>
                                                                    </span>
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
                                                            <input type="text" name="ho_khau_thuong_tru_matp"
                                                                class="form-control m-input" placeholder="" value="">

                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Quận/Huyện</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="ho_khau_thuong_tru_maqh"
                                                                class="form-control m-input" placeholder="" value="">

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
                                                            <input type="text" name="ho_khau_thuong_tru_xaid"
                                                                class="form-control m-input" placeholder="" value="">

                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Số nhà, đường </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="ho_khau_thuong_tru_so_nha"
                                                                class="form-control m-input" placeholder="" value="">

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
                                                                class="text-danger">*</span>Tỉnh/Thành phố</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="noi_o_hien_tai_matp"
                                                                class="form-control m-input" placeholder="" value="">

                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Quận/Huyện</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="noi_o_hien_tai_maqh"
                                                                class="form-control m-input" placeholder="" value="">

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
                                                            <input type="text" name="noi_o_hien_tai_xaid"
                                                                class="form-control m-input" placeholder="" value="">

                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Số nhà, đường </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="noi_o_hien_tai_so_nha"
                                                                class="form-control m-input" placeholder="" value="">

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                            </div>
                                        </div>
                                    </div>




                                    <div class="m-wizard__form-step" id="m_wizard_form_step_2">
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

                                            <div class="col-xl-6">
                                                <div class="m-form__section m-form__section--first">
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span> Họ và tên: </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="ten_cha" class="form-control m-input"
                                                                placeholder="" value="">

                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Năm sinh:</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="ngay_sinh_cha"
                                                                class="form-control m-input" placeholder="" value="">

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="m-form__section m-form__section--first">

                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Số điện thoại</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend"><span
                                                                        class="input-group-text"><i
                                                                            class="la la-phone"></i></span></div>
                                                                <input type="text" name="dien_thoai_cha"
                                                                    class="form-control m-input" placeholder="" value="">
                                                            </div>


                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Số CMND</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="cmtnd_cha" class="form-control m-input"
                                                                placeholder="" value="">

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
                                                        Thông tin mẹ:
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
                                                                class="text-danger">*</span> Họ và tên: </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="ten_me" class="form-control m-input"
                                                                placeholder="" value="">

                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Năm sinh:</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="ngay_sinh_me"
                                                                class="form-control m-input" placeholder="" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="m-form__section m-form__section--first">

                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Số điện thoại</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend"><span
                                                                        class="input-group-text"><i
                                                                            class="la la-phone"></i></span></div>
                                                                <input type="text" name="dien_thoai_me"
                                                                    class="form-control m-input" placeholder="" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span>Số CMND</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="cmtnd_me" class="form-control m-input"
                                                                placeholder="" value="">
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
                                                            <input type="text" name="dien_thoai_dang_ky" class="form-control m-input"
                                                                placeholder="" value="">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="m-form__section m-form__section--first">
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Email</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="email_dang_ky" class="form-control m-input"
                                                                placeholder="" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-portlet__foot m-portlet__foot--fit m--margin-top-40">
                                    <div class="m-form__actions">
                                        <div class="row">
                                            <div class="col-lg-2"></div>
                                            <div class="col-lg-4 m--align-left">
                                                <a href="#" class="btn btn-secondary m-btn m-btn--custom m-btn--icon"
                                                    data-wizard-action="prev">
                                                    <span>
                                                        <i class="la la-arrow-left"></i>&nbsp;&nbsp;
                                                        <span>Quay lại</span>
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="col-lg-4 m--align-right">
                                                <button type="submit"
                                                    class="btn btn-primary m-btn m-btn--custom m-btn--icon"
                                                    data-wizard-action="submit">
                                                    <span>
                                                        <i class="la la-check"></i>&nbsp;&nbsp;
                                                        <span>Đăng ký</span>
                                                    </span>
                                                </button>
                                                <a href="#" class="btn btn-warning m-btn m-btn--custom m-btn--icon"
                                                    data-wizard-action="next">
                                                    <span>
                                                        <span> Tiếp Tục</span>&nbsp;&nbsp;
                                                        <i class="la la-arrow-right"></i>
                                                    </span>
                                                </a>
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
    <script src="{!!  asset('assets/demo/custom/crud/forms/widgets/bootstrap-datepicker.js') !!}"></script>
@endsection
