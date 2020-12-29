@extends('layouts.main')
@section('title', "Thêm Quản trị nhà trường")
@section('style')
<style>
    .error{
        color: red;
        padding-left: 13rem;
    }
</style>
@endsection
@section('content')
<div class="m-content">
    <div class="row">
        <div class="col-md-12">

            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Thêm Quản trị nhà trường
                            </h3>
                        </div>
                    </div>
                </div>

                <!--begin::Form-->
            <form class="m-form m-form--fit m-form--label-align-right" id="form-dang-ky" method="POST" action="{{ route('account.store-school') }}">
                    @csrf
                    <div class="m-portlet__body" style="min-height: 30vw;">
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12"></label>
                            <div class="m-input-icon m-input-icon--left m-input-icon--right col-lg-5 col-md-9 col-sm-12">
                            <input type="text" class="form-control m-input m-input--pill m-input--air @error('name') is-invalid @enderror" placeholder="Họ và Tên" name="name" value="{{ old('name') }}">
                                <span class="m-input-icon__icon m-input-icon__icon--left"><span><i class="la la-user @error('name') text-danger @enderror"></i></span></span>
                                <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-info-circle @error('name') text-danger @enderror"></i></span></span>
                            </div>
                        </div>
                        
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12"></label>
                            <div class="m-input-icon m-input-icon--left m-input-icon--right col-lg-5 col-md-9 col-sm-12">
                                <input type="text" class="form-control m-input m-input--pill m-input--air @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}">
                                <span class="m-input-icon__icon m-input-icon__icon--left"><span><i class="fa fa-at @error('email') text-danger @enderror"></i></span></span>
                                <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-info-circle @error('email') text-danger @enderror"></i></span></span>
                            </div>
                            
                        </div>

                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12"></label>
                            <div class="m-input-icon m-input-icon--left m-input-icon--right col-lg-5 col-md-9 col-sm-12">
                                <input type="text" class="form-control m-input m-input--pill m-input--air @error('phone_number') is-invalid @enderror" placeholder="Số điện thoại" name="phone_number" value="{{ old('phone_number') }}">
                                <span class="m-input-icon__icon m-input-icon__icon--left"><span><i class="fa fa-phone @error('phone_number') text-danger @enderror"></i></span></span>
                                <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-info-circle @error('phone_number') text-danger @enderror"></i></span></span>
                            </div>
                            
                        </div>

                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-4 col-sm-12"></label>
                        <div class="m-form__actions col-lg-5 col-md-9 col-sm-12">
                            <button type="submit" class="btn btn-primary">Đăng ký</button>
                            <a href="{{ route('account.index') }}"  class="btn btn-secondary">Hủy</a>
                        </div>
                            
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit row">
                        <label class="col-form-label col-lg-4 col-sm-12"></label>
                        <div class="m-form__actions col-lg-5 col-md-9 col-sm-12">
                        </div>
                    </div>
                </form>

                <!--end::Form-->
            </div>

            <!--end::Portlet-->

        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.6.1/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.6.1/sweetalert2.min.js"></script>
@section('script')
@if ($errors->has('name'))
    <script>
        $('input[name="name"]').focus();
    </script>
@else
    @if ($errors->has('email'))
        <script>
            $('input[name="name"]').focus();
        </script>
    @else
        <script>
            $('input[name="phone_number"]').focus();
        </script>
    @endif
@endif
@endsection
@if (session('mess'))
	<script>
		Swal.fire({
			position: 'top-center',
			icon: 'success',
			title: 'Đăng ký tài khoản thành công !',
			text: 'Vui lòng kiểm tra email để thay đổi mật khẩu',
			timer: 5000
		})
	</script>
@endif
@endsection
