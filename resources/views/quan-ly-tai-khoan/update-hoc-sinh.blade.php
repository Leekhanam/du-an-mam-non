@extends('layouts.main')
@section('title', "Update tài khoản học sinh")
@section('style')
<link href="{!!  asset('css_loading/css_loading.css') !!}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="m-content">
    <div class="row">
        <div class="col-xl-12">
            <div class="m-portlet m-portlet--full-height">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon">
                                <i class="la la-thumb-tack m--font-success"></i>
                            </span>
                            <h3 class="m-portlet__head-text m--font-success">
                                Cập nhật tài khoản học sinh
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                                <button id="showDsHocSinh" class="m-portlet__nav-link btn btn-secondary  m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill   m-dropdown__toggle">
                                    <i class="flaticon-customer"></i>
                                </button>
                                <div class="m-dropdown__wrapper" style="z-index: 101;">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 21px;"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav">
                                                    <li class="m-nav__section m-nav__section--first">
                                                        <span class="m-nav__section-text">Học sinh</span>
                                                    </li>
                                                    @forelse ($data->HocSinh as $item)
                                                        <li class="m-nav__item">
                                                            <a href="{{ route('quan-ly-hoc-sinh-edit',['id' => $item->id])}}" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-customer"></i>
                                                            <span class="m-nav__link-text">{{ $item->ma_hoc_sinh . " - " . $item->ten}}</span>
                                                            </a>
                                                        </li>
                                                    @empty
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-wizard m-wizard--2 m-wizard--success m-wizard--step-first" id="m_wizard">
                    <div class="m-wizard__form">
                        <div class="m-form m-form--label-align-left- m-form--state-" id="m_form">
                            <form method="post" action="" enctype="multipart/form-data">
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
                                                <br>
                                                <div class="m-form__section m-form__section--first">
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"><span
                                                                class="text-danger">*</span> Email: </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <div class="input-group m-input-group">
                                                                <div class="input-group-prepend"><span class="input-group-text">@</span></div>
                                                                <input type="text" class="form-control m-input" placeholder="Email" name="email"
                                                                value="{{ old('email') ? old('email') : $data->email}}">
                                                            </div>
                                                            @error('email')
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
                                                                <input type="text" name="phone_number"
                                                                    onkeypress="return isNumberKey(event)"
                                                                    class="form-control m-input"
                                                                    placeholder="Điền số điện thoại"
                                                                    value="{{ old('phone_number') ? old('phone_number') : $data->phone_number}}">
                                                            </div>
                                                            @error('phone_number')
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
                                                        <img onClick="showModal()" style="cursor: pointer"
                                                            src={{ $data->avatar == "" ? 'https://ui-avatars.com/api/?name=' . $data->name . '&background=random' : $data->avatar}}
                                                            class="rounded mx-auto d-block mb-2 img-thumbnail"
                                                            width="250px" height="255px" id="show_img">
                                                        <div class="col-xl-9 col-lg-9 mt-4">
                                                            <div class="input-group ml-5 ">

                                                                <div class="custom-file ml-5 col-12">
                                                                    <input type="file" accept="images/*" id="anh_gv"
                                                                        onClick="showModal()"
                                                                        onchange="changeAvatar(this)"
                                                                        style="display:none" />
                                                                        <input type="hidden" name="avatar" value={{ $data->avatar }}>

                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <div class="m-form__actions">
                                            <a href="{{route('account.ds-hs')}}"><button type="button"
                                                    class="btn btn-danger">Hủy</button></a>
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
        reader.onloadend = function () {
            $('#show_img').attr('src', reader.result);
        }
        reader.readAsDataURL(file);
    }

    $(document).ready(function () {
        $('.select2').select2();
    });

    function changeAvatar(file) {
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

    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

</script>
<script src="{!! asset('js/get_quan_huyen_xa.js') !!}"></script>>
@if(SESSION('message'))
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
