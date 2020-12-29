<!DOCTYPE html>

<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">

<!-- begin::Head -->

<head>
    <meta charset="utf-8" />
    <title>Đơn đăng ký nhập học</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <link rel="shortcut icon" type="image/x-icon"
        href="https://kidsonline.edu.vn/wp-content/themes/kids-online/assets/images/favicon.png" />
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
            },
            active: function () {
                sessionStorage.fonts = true;
            }
        });

    </script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .chu_dam {
            color: #000000 !important;
        }

    </style>

    <!--end::Web font -->

    <!--begin::Global Theme Styles -->
    <link href="{!! asset('assets/vendors/base/vendors.bundle.css') !!}" rel="stylesheet" type="text/css" />

    <!--RTL version:<link href="../../../assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
    <link href="{!! asset('assets/demo/base/style.bundle.css') !!}" rel="stylesheet" type="text/css" />

    <!--RTL version:<link href="../../../assets/demo/default/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

    <!--end::Global Theme Styles -->
    <link rel="shortcut icon" href="{!! asset('assets/demo/media/img/logo/favicon.ico') !!}" />

    <link href="{!!  asset('css_loading/css_loading.css') !!}" rel="stylesheet" type="text/css" />

</head>

<!-- end::Head -->

<!-- begin::Body -->

<body
    style='font-family: "Times New Roman", Times, serif;'
    class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

    <div id="preload" class="preload-container text-center" style="display: none">
        <img id="gif-load" src="https://icon-library.com/images/loading-gif-icon/loading-gif-icon-17.jpg" alt="">
    </div>

    <!-- begin:: Page -->
    <br>
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2"
            id="m_login" style="background-image: url(../../../assets/app/media/img//bg/bg-3.jpg);">
            <div class="col-md-8 offset-2">

                <div class="m-portlet" style="border-radius: 5px !important ;background-color: #f8f9e9;">
                    <div class="pt-5">
                        <center>
                            <h1>ĐƠN ĐĂNG KÝ NHẬP HỌC</h1>
                        </center>
                    </div>
                    <button id="foo" hidden type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#exampleModal" data-backdrop='static' data-keyboard='false'>
                    </button>

                    <button id="foo2" hidden type="button" class="btn btn-warning" data-toggle="modal" data-target="#m_modal_4"
                        data-backdrop='static' data-keyboard='false'>Thank You</button>


                    <!--begin::Form-->
                    <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed"
                        enctype="multipart/form-data" id="myForm">
                        @csrf

                        <div class="m-portlet__body">

                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <span class="m-portlet__head-icon">
                                            <i class="flaticon-customer"></i>
                                        </span>
                                        <h3 class="m-portlet__head-text">
                                            Thông tin bé
                                        </h3>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group m-form__group row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <label for="">Họ và tên bé:<span class="text-danger">*</span></label>
                                    <input type="text" name="ten" class="form-control form-control-sm m-input"
                                        placeholder="Họ tên bé">
                                    <p class="text-danger text-small error" id="ten_error"></p>
                                </div>

                                <div class="col-sm-12 col-md-3 col-lg-3">
                                    <label for="">Giới tính:<span class="text-danger">*</span></label>
                                    <div class="m-radio-inline">
                                        @foreach (config('common.gioi_tinh') as $key => $value)
                                        <label class="m-radio m-radio--solid">
                                            <input type="radio" name="gioi_tinh" {{ $key == 0 ? 'checked' : ''}}
                                                value="{{ $key }}">
                                            {{ $value }}
                                            <span></span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3 col-lg-3">
                                    <label>Học sinh khuyết tật:</label>
                                    <div>
                                        <label class="m-radio">
                                            <input type="checkbox" name="hoc_sinh_khuyet_tat" value="1">
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">

                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <label for="">Ngày sinh:<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input class="form-control form-control-sm m-input" type="date" name="ngay_sinh"
                                            placeholder="Chọn ngày">
                                    </div>
                                    <p class="text-danger text-small error" id="ngay_sinh_error"></p>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <label for="">Dân tộc:<span class="text-danger">*</span></label>
                                    <div class="m-input-icon m-input-icon--right">
                                        <select name="dan_toc" id="" class="form-control form-control-sm m-input">
                                            @foreach (config('common.dan_toc') as $key => $value)
                                            <option value="{{ $key }}" class="get-dan_toc_{{ $key }}">{{ $value }}
                                            </option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <p class="text-danger text-small error" id="dan_toc_error"></p>
                                </div>
                            </div>



                            <div class="form-group m-form__group row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <label for="">Đối tượng chính sách:</label>
                                    <div class="m-input-icon m-input-icon--right">
                                        <select class="form-control form-control-sm  select2" multiple="multiple"
                                            name="doi_tuong_chinh_sach_id[]" id="doi_tuong_chinh_sach_id">
                                            @foreach ($doi_tuong_chinh_sach as $item)
                                            <option value="{{ $item->id }}" data-loai="L-{{ $item->id }}">
                                                L-{{ $item->id }} {{ $item->ten_chinh_sach }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="col-sm-12 col-md-3 col-lg-3">
                                    <label for="">Ảnh bé:</label>
                                    <div class="custom-file">
                                        <input type="file" accept=".jpg, .pepg, .png"
                                            class="custom-file-input form-control " onchange="showimages(this)"
                                            id="customFileAvatar">
                                        <input type="text" hidden name="avatar">
                                        <input type="text" hidden name="check_avatar">
                                        <label class="custom-file-label" for="customFileAvatar">Chọn ảnh bé</label>

                                    </div>
                                    <p class="text-danger text-small error" id="check_avatar_error"></p>

                                </div>
                                <div class="col-sm-12 col-md-3 col-lg-3">
                                    <div class="anh-giay-phep img-thumbnail">
                                        <img src="https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_960_720.png"
                                            id="showimg" width="200">
                                    </div>
                                </div>

                            </div>

                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <span class="m-portlet__head-icon">
                                            <i class="flaticon-placeholder-1"></i>
                                        </span>
                                        <h3 class="m-portlet__head-text">
                                            Hộ khẩu thường trú
                                        </h3>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <div class="col-lg-6">
                                    <label class="">Tỉnh/Thành phố:<span class="text-danger">*</span></label>
                                    <div class="m-input-icon m-input-icon--right">
                                        <select class="form-control form-control-sm" name="ho_khau_thuong_tru_matp"
                                            id="ho_khau_thuong_tru_matp">
                                            <option value="" selected>Chọn</option>
                                            @foreach ($thanh_pho as $item)
                                            <option value="{{$item->matp}}" class="get-data_hk_tp_{{$item->matp}}">
                                                {{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <p class="text-danger text-small error" id="ho_khau_thuong_tru_matp_error"></p>

                                        <!-- @error('ho_khau_thuong_tru_matp')
                                  						    <div class="text-danger">{{$message}}</div>
                              					 		@enderror -->
                                    </div>
                                    <!-- <span class="m-form__help">Please enter your address</span> -->
                                </div>
                                <div class="col-lg-6">
                                    <label>Quận/Huyện:<span class="text-danger">*</span></label>
                                    <div class="m-input-icon m-input-icon--right">
                                        <select class="form-control form-control-sm" name="ho_khau_thuong_tru_maqh"
                                            id="ho_khau_thuong_tru_maqh">

                                        </select>
                                        <p class="text-danger text-small error" id="ho_khau_thuong_tru_maqh_error"></p>

                                        <!-- @error('ho_khau_thuong_tru_maqh')
                                  						    <div class="text-danger">{{$message}}</div>
                              					 		@enderror -->
                                    </div>
                                    <!-- <span class="m-form__help">Please enter your postcode</span> -->
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <div class="col-lg-6">
                                    <label>Phường/Xã:<span class="text-danger">*</span></label>
                                    <div class="m-input-icon m-input-icon--right">
                                        <select class="form-control form-control-sm" name="ho_khau_thuong_tru_xaid"
                                            id="ho_khau_thuong_tru_xaid">

                                        </select>

                                        <!-- @error('ho_khau_thuong_tru_xaid')
                                  						    <div class="text-danger">{{$message}}</div>
														   @enderror -->
                                        <p class="text-danger text-small error" id="ho_khau_thuong_tru_xaid_error"></p>

                                    </div>
                                    <!-- <span class="m-form__help">Please enter your address</span> -->
                                </div>
                                <div class="col-lg-6">
                                    <label>Số nhà:</label>
                                    <div class="m-input-icon m-input-icon--right">
                                        <input type="text" class="form-control form-control-sm m-input"
                                            name="ho_khau_thuong_tru_so_nha" placeholder="Nhập số nhà">

                                        <!-- @error('ho_khau_thuong_tru_so_nha')
                                  						    <div class="text-danger">{{$message}}</div>
														   @enderror -->
                                        <p class="text-danger text-small error" id="ho_khau_thuong_tru_so_nha_error">
                                        </p>

                                    </div>
                                    <!-- <span class="m-form__help">Please enter your postcode</span> -->
                                </div>
                            </div>



                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <span class="m-portlet__head-icon">
                                            <i class="flaticon-placeholder-1"></i>
                                        </span>
                                        <h3 class="m-portlet__head-text">
                                            Nơi ở hiện nay
                                        </h3>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <div class="col-lg-6">
                                    <label>Tỉnh/Thành phố:<span class="text-danger">*</span></label>
                                    <div class="m-input-icon m-input-icon--right">
                                        <!-- <input type="text" class="form-control form-control-sm m-input" name="noi_o_hien_tai_matp" placeholder="Enter your address"> -->
                                        <select class="form-control form-control-sm" name="noi_o_hien_tai_matp"
                                            id="noi_o_hien_tai_matp">
                                            <option value="" selected>Chọn</option>
                                            @foreach ($thanh_pho as $item)
                                            <option value="{{$item->matp}}" class="get-data_ht_tp_{{$item->matp}}">
                                                {{$item->name}}</option>
                                            @endforeach
                                        </select>

                                        <!-- @error('noi_o_hien_tai_matp')
                                  						    <div class="text-danger">{{$message}}</div>
														   @enderror -->
                                        <p class="text-danger text-small error" id="noi_o_hien_tai_matp_error"></p>

                                    </div>
                                    <!-- <span class="m-form__help">Please enter your address</span> -->
                                </div>
                                <div class="col-lg-6">
                                    <label>Quận/Huyện:<span class="text-danger">*</span></label>
                                    <div class="m-input-icon m-input-icon--right">
                                        <select class="form-control form-control-sm" name="noi_o_hien_tai_maqh"
                                            id="noi_o_hien_tai_maqh">
                                        </select>
                                        <p class="text-danger text-small error" id="noi_o_hien_tai_maqh_error"></p>
                                    </div>
                                    <!-- <span class="m-form__help">Please enter your postcode</span> -->
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <div class="col-lg-6">
                                    <label>Phường/Xã:<span class="text-danger">*</span></label>
                                    <div class="m-input-icon m-input-icon--right">
                                        <select class="form-control form-control-sm" name="noi_o_hien_tai_xaid"
                                            id="noi_o_hien_tai_xaid">

                                        </select>
                                        <p class="text-danger text-small error" id="noi_o_hien_tai_xaid_error"></p>

                                    </div>
                                    <!-- <span class="m-form__help">Please enter your address</span> -->
                                </div>
                                <div class="col-lg-6">
                                    <label>Số nhà:</label>
                                    <div class="m-input-icon m-input-icon--right">
                                        <input type="text" class="form-control form-control-sm m-input"
                                            name="noi_o_hien_tai_so_nha" placeholder="Nhập chi tiết địa chỉ nhà"
                                            id="noi_o_hien_tai_so_nha">

                                        <p class="text-danger text-small error" id="noi_o_hien_tai_so_nha_error"></p>

                                    </div>
                                    <!-- <span class="m-form__help">Please enter your postcode</span> -->
                                </div>
                            </div>


                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <span class="m-portlet__head-icon">
                                            <i class="flaticon-network"></i>
                                        </span>
                                        <h3 class="m-portlet__head-text">
                                            Thông tin phụ huynh
                                        </h3>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group m-form__group row">
                                <div class="col-lg-4">
                                    <div class="input-group m-input-group m-input-group--square">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="la la-user"></i></span>
                                        </div>
                                        <input type="text" name="ten_cha" class="form-control form-control-sm m-input"
                                            placeholder="Họ tên (Cha)">
                                    </div>
                                    <p class="text-danger text-small error" id="ten_cha_error"></p>
                                </div>
                                <div class="col-lg-4">
                                    <input type="number" class="form-control form-control-sm m-input"
                                        name="dien_thoai_cha" placeholder="Số điện thoại (Cha)">
                                    <p class="text-danger text-small error" id="dien_thoai_cha_error"></p>
                                </div>
                                <div class="col-lg-4">
                                    <input type="number" class="form-control form-control-sm m-input" name="cmtnd_cha"
                                        placeholder="Số chứng minh nhân dân (Cha)">
                                    <p class="text-danger text-small error" id="cmtnd_cha_error"></p>
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <div class="col-lg-4">
                                    <div class="input-group m-input-group m-input-group--square">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="la la-user"></i></span>
                                        </div>
                                        <input type="text" name="ten_me" class="form-control form-control-sm m-input"
                                            placeholder="Họ tên (Mẹ)">
                                    </div>
                                    <p class="text-danger text-small error" id="ten_me_error"></p>
                                </div>
                                <div class="col-lg-4">
                                    <input type="number" class="form-control form-control-sm m-input"
                                        name="dien_thoai_me" placeholder="Số điện thoại (Mẹ)">
                                    <p class="text-danger text-small error" id="dien_thoai_me_error"></p>
                                </div>
                                <div class="col-lg-4">
                                    <input type="number" class="form-control form-control-sm m-input" name="cmtnd_me"
                                        placeholder="Số chứng minh nhân dân (Mẹ)">
                                    <p class="text-danger text-small error" id="cmtnd_me_error"></p>
                                </div>
                            </div>



                            <div class="form-group m-form__group row">
                                <div class="col-lg-4">
                                    <div class="input-group m-input-group m-input-group--square">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="la la-user"></i></span>
                                        </div>
                                        <input type="text" name="ten_nguoi_giam_ho"
                                            class="form-control form-control-sm m-input"
                                            placeholder="Họ tên (Người giám hộ)">
                                    </div>
                                    <p class="text-danger text-small error" id="ten_nguoi_giam_ho_error"></p>
                                </div>
                                <div class="col-lg-4">
                                    <input type="number" class="form-control form-control-sm m-input"
                                        name="dien_thoai_nguoi_giam_ho" placeholder="Số điện thoại (Người giám hộ)">
                                    <p class="text-danger text-small error" id="dien_thoai_nguoi_giam_ho_error"></p>
                                </div>
                                <div class="col-lg-4">
                                    <input type="number" class="form-control form-control-sm m-input"
                                        name="cmtnd_nguoi_giam_ho" placeholder="Số chứng minh nhân dân (Người giám hộ)">
                                    <p class="text-danger text-small error" id="cmtnd_nguoi_giam_ho_error"></p>
                                </div>
                            </div>

                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <span class="m-portlet__head-icon">
                                            <i class="la la-gear"></i>
                                        </span>
                                        <h3 class="m-portlet__head-text">
                                            Thông tin đăng kí tài khoản
                                        </h3>
                                    </div>

                                </div>

                            </div>

                            <div class="row">
                                <div class="col-sm-12 pl-5">
                                    <p><em>Thông tin giúp nhà trường cấp tài khoản cho phụ huynh</em></p>
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <div class="col-lg-6">
                                    <div class="input-group m-input-group m-input-group--square">
                                        <input type="text" class="form-control form-control-sm m-input"
                                            name="dien_thoai_dang_ki" placeholder="Số điện thoại">
                                    </div>
                                    <p class="text-danger text-small error" id="dien_thoai_dang_ki_error"></p>
                                </div>
                                <div class="col-lg-6">
                                    <input type="email" class="form-control form-control-sm m-input"
                                        name="email_dang_ky" placeholder="Email">
                                    <p class="text-danger text-small error" id="email_dang_ky_error"></p>
                                </div>
                            </div>


                            <div class="form-group m-form__group row">
                                <div class="col-12">
                                    <center>
                                        <button type="button" class="btn btn-warning" onclick="checkValidation()">TẠO ĐƠN</button>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!--end::Form-->
                </div>


            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nhập mã xác thực</h5>
                    <button type="button" hidden id="closeModel" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <p class="ml-3 mt-2"> Hệ thống đã gửi mã xác thực vào email của bạn !</p>

                <div class="modal-body">
                    <form action="" id="formMaXacNhan">
                        <div class="row">
                            @csrf
                            <div class="col-md-2 offset-1 ">
                                <input class="form-control" maxlength='1' type="text" name="ma_xac_thuc1">
                            </div>
                            <div class="col-md-2 ">
                                <input class="form-control" maxlength='1' type="text" name="ma_xac_thuc2">
                            </div>
                            <div class="col-md-2">
                                <input class="form-control" maxlength='1' type="text" name="ma_xac_thuc3">
                            </div>
                            <div class="col-md-2">
                                <input class="form-control" maxlength='1' type="text" name="ma_xac_thuc4">
                            </div>
                            <div class="col-md-2">
                                <input class="form-control" maxlength='1' type="text" name="ma_xac_thuc5">
                            </div>

                            <input type="number" name="id_form_dang_ky" id="id_form_dang_ky" hidden>
                        </div>
                </div>
                <div class="modal-footer">
                    <p class="text-danger text-small" id="sai_ma"></p>
                    <button type="button" onclick="submitMaXacNhan()" class="btn btn-primary text-center">Xác
                        nhận</button>
                </div>
                </form>

            </div>
        </div>
    </div>




    <div class="modal fade" style="height:500px" id="m_modal_4" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="loadTrang()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h1>THANK YOU</h1>
                    <img width="100" src="https://www.iconfinder.com/data/icons/color-bold-style/21/34-512.png" />
                    <p>Cảm ơn bạn đăng tin tưởng và đăng ký cho bé nhập học</p>
                    <p>Chúng tôi sẽ sớm liên lạc lại với bạn</p>
                    <p>Cảm ơn !</p>

                    <p style=" font-size:16px "><span style="color:red">Lưu ý (*)</span> : Mã đơn đăng kí của bạn là: <span style="color:red" id="show_ma_don">  </span></p>
                </div>

            </div>
        </div>
    </div>

    <!--begin::Modal-->
    <div class="modal fade" id="m_modal_5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style='font-family: "Times New Roman", Times, serif;'>
            <div class="modal-content">
                <div class="modal-body">
                    <div class="m-portlet__body">
                        <div class="m-section">
                            <div class="m-section__content">
                                <div class="row pt-5">
                                    <div class="col-12">

                                        <center>
                                            <h3 class="chu_dam">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</h3>
                                            <h3 class="chu_dam">Độc lập - Tự do - Hạnh phúc</h3>
                                            <p class="chu_dam">----------oo0oo--------</p>
                                            <br>
                                            <h3 class="chu_dam">ĐƠN XIN NHẬP HỌC</h3>

                                        </center>
                                        <div style="padding-left: 10%">
                                            <h6><i>Kính gửi: </i><b class="chu_dam">Ban tuyển sinh Trường mầm non
                                                    CoolKids</b></h6>
                                        </div>
                                        <br>
                                        <div style="padding-left: 10%">

                                            <table>
                                                <tr>
                                                <tr>Họ và tên học sinh: <b class="chu_dam view-ten"></b></tr>
                                                <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Giới tính: <b class="chu_dam view-gioi_tinh"></b></td>
                                                    <td>Dân tộc: <b class="chu_dam view-dan_toc"></b></td>
                                                </tr>
                                                <tr>
                                                    <td>Đối tượng chính sách:</td>
                                                    <td><b class="chu_dan view-doi_tuong_chinh_sach_id"></b></td>
                                                </tr>
                                                <tr>
                                                    <td>Ngày sinh: <b class="chu_dam view-ngay_sinh"></b></td>
                                                    <td>Nơi sinh(Tỉnh, thành phố): <b class="chu_dam view-noi_sinh"></b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Học sinh khuất tật: <b
                                                            class="chu_dam view-hoc_sinh_khuat_tat"></b></td>
                                                </tr>
                                                <tr>
                                                    <td style="visibility: hidden" class="pt-3">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Hộ khẩu thường trú: Tỉnh(Thành phố):</td>
                                                    <td><b class="chu_dam view_ho_khau_thuong_tru_matp"><b></td>
                                                </tr>
                                                <tr>
                                                    <td>Huyện(Quận): <b
                                                            class="chu_dam view-ho_khau_thuong_tru_maqh"></b></td>
                                                    <td>Xã(Phường/Thị Trấn): <b
                                                            class="chu_dam view-ho_khau_thuong_tru_xaid"></b></td>
                                                </tr>
                                                <tr>
                                                    <td>Thôn(Phố/Số): <b
                                                            class="chu_dam view-ho_khau_thuong_tru_so_nha"></b></td>
                                                </tr>
                                                <tr>
                                                    <td style="visibility: hidden" class="pt-3">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Hiện đang cư chú tại: Tỉnh(Thành phố): </td>
                                                    <td><b class="chu_dam view-noi_o_hien_tai_matp"></b></td>
                                                </tr>
                                                <tr>
                                                    <td>Huyện(Quận): <b class="chu_dam view-noi_o_hien_tai_maqh"></b>
                                                    </td>
                                                    <td>Xã(Phường/Thị Trấn): <b
                                                            class="chu_dam view-noi_o_hien_tai_xaid"></b></td>
                                                </tr>
                                                <tr>
                                                    <td>Thôn(Phố/Số): <b class="chu_dam view-noi_o_hien_tai_so_nha"></b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Nguyện vọng vào học tại:</td>
                                                    <td><b class="chu_dam">Trường mầm non CoolKids</b></td>
                                                </tr>

                                                <tr>
                                                    <td style="visibility: hidden" class="pt-3">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Họ và tên cha: <b class="chu_dam view-ten_cha"></b></td>
                                                    <td>Số chứng minh thư nhân dân: <b
                                                            class="chu_dam view-cmtnd_cha"></b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Họ và tên mẹ: <b class="chu_dam view-ten_me"></b></td>
                                                    <td>Số chứng minh thư nhân dân: <b
                                                            class="chu_dam view-cmtnd_me"></b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Họ và tên người giám hộ(<i>nếu có</i> ): <b
                                                            class="chu_dam view-ten_nguoi_giam_ho"></b></td>
                                                    <td>Số chứng minh thư nhân dân: <b
                                                            class="chu_dam view-cmtnd_nguoi_giam_ho"></b>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="visibility: hidden">
                                                        <hr>
                                                    </td>
                                                    <td style="visibility: hidden">
                                                        <hr>
                                                    </td>
                                                </tr>
                                            </table>


                                        </div>
                                        <div style="padding-left: 10%">
                                            Tôi xin cam đoan về những thông tin khai trong tờ đơn này là đúng sự thật và
                                            chấp hành đầy đủ mọi nội quy, quy định của Ngành và Nhà Trường.
                                        </div>
                                        <br>
                                        <div>
                                            <center><button class="btn" onclick="createDangKi()">ĐĂNG KÝ</button>
                                            </center>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--end::Section-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--end::Modal-->

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script>
        var url_quan_huyen_theo_thanh_pho = "{{route('get_quan_huyen_theo_thanh_pho')}}";
        var url_phuong_xa_theo_quan_huyen = "{{route('get_xa_phuong_theo_thi_tran')}}";
        var url_submit_dangki = "{{ route('submit-dang-ki-nhap-hoc') }}";
        var url_xac_nhan_ma_dangki = "{{ route('submit-xac-nhan-ma-dangki') }}";



        let nodeList = document.querySelectorAll(".m-input");
        const listField = [];
        nodeList.forEach((element) => {
            listField.push(element.getAttribute("name"));
        });


        function showimages(element) {
            var file = element.files[0];
            var reader = new FileReader();
            reader.onloadend = function () {
                $('#showimg').attr('src', reader.result);
            }
            reader.readAsDataURL(file);

            $('[name="check_avatar"]').val('have');

        }

        $("#ho_khau_thuong_tru_matp").change(function () {
            axios.post(url_quan_huyen_theo_thanh_pho, {
                    matp: $("#ho_khau_thuong_tru_matp").val(),
                })
                .then(function (response) {
                    var htmldata = '<option value="" selected  >Chọn</option>'
                    response.data.forEach(element => {
                        htmldata +=
                            `<option value="${element.maqh}" data="${element.name}">${element.name}</option>`
                    });

                    $('#ho_khau_thuong_tru_maqh').html(htmldata);
                })
                .catch(function (error) {
                    console.log(error);
                });
        });


        $("#ho_khau_thuong_tru_maqh").change(function () {
            axios.post(url_phuong_xa_theo_quan_huyen, {
                    maqh: $("#ho_khau_thuong_tru_maqh").val(),
                })
                .then(function (response) {
                    var htmldata = '<option value="" selected  >Chọn</option>'
                    response.data.forEach(element => {
                        htmldata +=
                            `<option value="${element.xaid}" data="${element.name}">${element.name}</option>`
                    });

                    $('#ho_khau_thuong_tru_xaid').html(htmldata);
                })
                .catch(function (error) {
                    console.log(error);
                });
        });



        $("#noi_o_hien_tai_matp").change(function () {
            axios.post(url_quan_huyen_theo_thanh_pho, {
                    matp: $("#noi_o_hien_tai_matp").val(),
                })
                .then(function (response) {
                    var htmldata = '<option value="" selected  >Chọn</option>'
                    response.data.forEach(element => {
                        htmldata +=
                            `<option value="${element.maqh}" data="${element.name}">${element.name}</option>`
                    });

                    $('#noi_o_hien_tai_maqh').html(htmldata);
                })
                .catch(function (error) {
                    console.log(error);
                });
        });


        $("#noi_o_hien_tai_maqh").change(function () {
            axios.post(url_phuong_xa_theo_quan_huyen, {
                    maqh: $("#noi_o_hien_tai_maqh").val(),
                })
                .then(function (response) {
                    var htmldata = '<option value="" selected  >Chọn</option>'
                    response.data.forEach(element => {
                        htmldata +=
                            `<option value="${element.xaid}" data="${element.name}">${element.name}</option>`
                    });

                    $('#noi_o_hien_tai_xaid').html(htmldata);
                })
                .catch(function (error) {
                    console.log(error);
                });
        });


        let createDangKi = () => {
            $('#preload').css('display', 'block');
            let myForm = document.getElementById('myForm');
            var formData = new FormData(myForm)
            axios.post(url_submit_dangki, formData)
                .then(function (response) {
                    console.log(response.data);
                    $('#preload').css('display', 'none');
                    $("#id_form_dang_ky").val(response.data);
                    $("#m_modal_5").modal("hide");
                    $("#foo").trigger("click");
                })
                .catch(function (error) {
                    $('#preload').css('display', 'none');
                    $('.error').text(' ')
                    for (const key in error.response.data.errors) {
                        $('#' + key + '_error').html(error.response.data.errors[key]);
                    }
                })
        }

        function submitMaXacNhan() {
            $('#preload').css('display', 'block');
            let myForm = document.getElementById('formMaXacNhan');
            var formData = new FormData(myForm)
            axios.post(url_xac_nhan_ma_dangki, formData)
                .then(function (response) {
                    let ketqua = response.data;
                    if (response.data == 'no') {
                        $('#preload').css('display', 'none');
                        console.log(response.data);
                        $('[name="ma_xac_thuc1"]').addClass('is-invalid');
                        $('[name="ma_xac_thuc2"]').addClass('is-invalid');
                        $('[name="ma_xac_thuc3"]').addClass('is-invalid');
                        $('[name="ma_xac_thuc4"]').addClass('is-invalid');
                        $('[name="ma_xac_thuc5"]').addClass('is-invalid');
                    } else {
                        $('#preload').css('display', 'none');
                        $("#closeModel").trigger("click");
                        $("#show_ma_don").text(ketqua);
                        $("#foo2").trigger("click");
                    }

                })
                .catch(function (error) {
                    $('#preload').css('display', 'none');
                    $('[name="ma_xac_thuc1"]').addClass('is-invalid');
                    $('[name="ma_xac_thuc2"]').addClass('is-invalid');
                    $('[name="ma_xac_thuc3"]').addClass('is-invalid');
                    $('[name="ma_xac_thuc4"]').addClass('is-invalid');
                    $('[name="ma_xac_thuc5"]').addClass('is-invalid');
                })
        }
        $(".select2").select2();

        function loadTrang() {
            location.reload()
        }

        function viewDon() {
            // View Thông tin người thân
            $('.view-ten_cha').html($('[name="ten_cha"]').val());
            $('.view-ten_me').html($('[name="ten_me"]').val());
            $('.view-ten_nguoi_giam_ho').html($('[name="ten_nguoi_giam_ho"]').val());
            $('.view-cmtnd_cha').html($('[name="cmtnd_cha"]').val());
            $('.view-cmtnd_me').html($('[name="cmtnd_me"]').val());
            $('.view-cmtnd_nguoi_giam_ho').html($('[name="cmtnd_nguoi_giam_ho"]').val());
            // EndView Thông tin người thân

            // View Thông tin học sinh
            $('.view-ten').html($('[name="ten"]').val());

            let gioi_tinh = 'Nam';
            var checked_gender = document.querySelector('input[name="gioi_tinh"]:checked');
            if (checked_gender != null) {
                gioi_tinh = checked_gender.value == 1 ? 'Nữ' : 'Nam';
            }
            $('.view-gioi_tinh').html(gioi_tinh);

            let dan_toc = document.querySelector(`.get-dan_toc_` + $('[name="dan_toc"]').val()).innerText;
            $('.view-dan_toc').html(dan_toc);

            let hoc_sinh_khuyet_tat = 'Không';
            let val_hoc_sinh_khuyet_tat = $('[name="hoc_sinh_khuyet_tat"]:checked').val()
            if (val_hoc_sinh_khuyet_tat != null) {
                hoc_sinh_khuyet_tat = val_hoc_sinh_khuyet_tat == 1 ? 'Có' : 'Không';
            }
            $('.view-hoc_sinh_khuat_tat').html(hoc_sinh_khuyet_tat);


            var val_doi_tuong_chinh_sach_id = '';
            $("#doi_tuong_chinh_sach_id option:selected").each(function () {
                var $this = $(this);
                if ($this.length) {
                    var selText = $this.attr('data-loai');
                    val_doi_tuong_chinh_sach_id += selText + ',';
                }
            });
            $('.view-doi_tuong_chinh_sach_id').html(val_doi_tuong_chinh_sach_id);

            $('.view-ngay_sinh').html($('[name="ngay_sinh"]').val());
            // EndView Thông tin học sinh

            // View Hộ khẩu thường trú
            let ho_khau_thuong_tru_matp = document.querySelector(".get-data_hk_tp_" + $(
                '[name="ho_khau_thuong_tru_matp"]').val()).innerText;
            $('.view_ho_khau_thuong_tru_matp').html(ho_khau_thuong_tru_matp);
            $('.view-noi_sinh').html(ho_khau_thuong_tru_matp);

            var ho_khau_thuong_tru_maqh = '';
            $("#ho_khau_thuong_tru_maqh option:selected").each(function () {
                var $this = $(this);
                if ($this.length) {
                    var selText = $this.attr('data');
                    ho_khau_thuong_tru_maqh = selText;
                }
            });
            $('.view-ho_khau_thuong_tru_maqh').html(ho_khau_thuong_tru_maqh);

            var ho_khau_thuong_tru_xaid = '';
            $("#ho_khau_thuong_tru_xaid option:selected").each(function () {
                var $this = $(this);
                if ($this.length) {
                    var selText = $this.attr('data');
                    ho_khau_thuong_tru_xaid = selText;
                }
            });
            $('.view-ho_khau_thuong_tru_xaid').html(ho_khau_thuong_tru_xaid);

            $('.view-ho_khau_thuong_tru_so_nha').html($('[name="ho_khau_thuong_tru_so_nha"]').val());
            // EndView Hộ khẩu thường trú

            // View Nơi ở hiện nay
            let noi_o_hien_tai_matp = document.querySelector(".get-data_ht_tp_" + $('[name="noi_o_hien_tai_matp"]')
                .val()).innerText;
            $('.view-noi_o_hien_tai_matp').html(noi_o_hien_tai_matp);

            var noi_o_hien_tai_maqh = '';
            $("#noi_o_hien_tai_maqh option:selected").each(function () {
                var $this = $(this);
                if ($this.length) {
                    var selText = $this.attr('data');
                    noi_o_hien_tai_maqh = selText;
                }
            });
            $('.view-noi_o_hien_tai_maqh').html(noi_o_hien_tai_maqh);

            var noi_o_hien_tai_xaid = '';
            $("#noi_o_hien_tai_xaid option:selected").each(function () {
                var $this = $(this);
                if ($this.length) {
                    var selText = $this.attr('data');
                    noi_o_hien_tai_xaid = selText;
                }
            });
            $('.view-noi_o_hien_tai_xaid').html(noi_o_hien_tai_xaid);

            $('.view-noi_o_hien_tai_so_nha').html($('[name="noi_o_hien_tai_so_nha"]').val());
            // EndView Nơi ở hiện nay
        }


        $('[name="ma_xac_thuc1"]').keypress(function () {
            let $this = $(this);
            setTimeout(function () {
                if ($this.val().length == 1) {
                    $this.blur();
                    $('[name="ma_xac_thuc2"]').focus();
                    $('[name="ma_xac_thuc2"]').select();
                }
            }, 200)

        });
        $('[name="ma_xac_thuc2"]').keypress(function () {
            let $this = $(this);
            setTimeout(function () {
                if ($this.val().length == 1) {
                    $this.blur();
                    $('[name="ma_xac_thuc3"]').focus();
                    $('[name="ma_xac_thuc3"]').select();
                }
            }, 200)
        });
        $('[name="ma_xac_thuc3"]').keypress(function () {
            let $this = $(this);
            setTimeout(function () {
                if ($this.val().length == 1) {
                    $this.blur();
                    $('[name="ma_xac_thuc4"]').focus();
                    $('[name="ma_xac_thuc4"]').select();
                }
            }, 200)
        });
        $('[name="ma_xac_thuc4"]').keypress(function () {
            let $this = $(this);
            setTimeout(function () {
                if ($this.val().length == 1) {
                    $this.blur();
                    $('[name="ma_xac_thuc5"]').focus();
                    $('[name="ma_xac_thuc5"]').select();
                }
            }, 200)
        });
        $('[name="ma_xac_thuc5"]').keypress(function () {
            let $this = $(this);
            setTimeout(function () {
                if ($this.val().length == 1) {
                    $this.blur();
                }
            }, 200)
        });

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
                console.log(url)
            });
        }

        function checkValidation() {
            $('#preload').css('display', 'block');
            let myForm = document.getElementById('myForm');
            var formData = new FormData(myForm)
            axios.post("{{ route('validation-dang-ki-nhap-hoc')}}", formData)
                .then(function (response) {
                    $('#preload').css('display', 'none');
                    if(response.status < 300 && response.data == "ok"){
                        viewDon();
                        $("#m_modal_5").modal("show");
                        uploadAvatar();
                    }
                })
                .catch(function (error) {
                    $('#preload').css('display', 'none');
                    $('.error').text(' ')
                    for (const key in error.response.data.errors) {
                        $('#' + key + '_error').html(error.response.data.errors[key]);
                    }
                })

        }

    </script>
    <!-- end:: Page -->

    <!--begin::Global Theme Bundle -->
    <script src="{!! asset('assets/vendors/base/vendors.bundle.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('assets/demo/base/scripts.bundle.js') !!}" type="text/javascript"></script>

    <!--end::Global Theme Bundle -->

    <!--begin::Page Scripts -->
    <script src="../../../assets/demo/custom/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript">
    </script>

    <script src="{!! asset('assets/snippets/custom/pages/user/login.js') !!}" type="text/javascript"></script>

    <!--end::Page Scripts -->
</body>

<!-- end::Body -->

</html>
