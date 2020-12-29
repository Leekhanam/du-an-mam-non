
<!DOCTYPE html>
<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>Đăng nhập</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
			WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>

		<!--end::Web font -->

		<!--begin::Global Theme Styles -->
		<link href="{!! asset('assets/vendors/base/vendors.bundle.css') !!}" rel="stylesheet" type="text/css" />

		<!--RTL version:<link href="../../../assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
		<link href="{!! asset('assets/demo/base/style.bundle.css') !!}" rel="stylesheet" type="text/css" />

		<!--RTL version:<link href="../../../assets/demo/default/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

		<!--end::Global Theme Styles -->
		<link rel="shortcut icon" href="{!! asset('assets/demo/media/img/logo/favicon.ico') !!}" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.min.css">
		
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2 
			@if (session('error_email'))m-login--forget-password @endif" id="m_login" style="background-image: url(../../../assets/app/media/img//bg/bg-3.jpg);">
				<div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
					<div class="m-login__container">
						<div class="m-login__logo">
							<a href="#">
								<img src="{!! asset('images/coolkids.png') !!}" width="300" >
							</a>
						</div>
						<div class="m-login__signin">
							<div class="m-login__head">
								<h3 class="m-login__title"></h3>
							</div>
                            <form class="m-login__form m-form" action="{{ route('login') }}" method="POST">
                                @if (session('message'))
									<div class="m-alert m-alert--outline alert alert-danger alert-dismissible animated fadeIn" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
									<span>{{session('message')}}</span>		
									</div>
								@endif
                                @csrf
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="text" placeholder="Tài khoản" name="username" autocomplete="off">
								</div>
								<div class="form-group m-form__group">
									<input class="form-control m-input m-login__form-input--last" type="password" placeholder="Mật khẩu" name="password">
								</div>
								<div class="row m-login__form-sub">
									<div class="col m--align-left m-login__form-left">
										<label class="m-checkbox  m-checkbox--focus">
											<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Lưu tài khoản
											<span></span>
										</label>
									</div>
									<div class="col m--align-right m-login__form-right">
										@if (Route::has('password.request'))
                                                <a  href="{{ route('password.request') }}" id="m_login_forget_password" class="m-link">
                                                    {{ __('Quên mật khẩu?') }}
                                                </a>
                                        @endif
									</div>
								</div>
								<div class="m-login__form-action">
									<button type="submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">ĐĂNG NHẬP</button>
								</div>
							</form>
						</div>
						<div class="m-login__forget-password">
							<div class="m-login__head">
								<h3 class="m-login__title">Quên mật khẩu ?</h3>
								<div class="m-login__desc">Vui lòng nhập email để lấy lại mật khẩu:</div>
							</div>
							<form class="m-login__form m-form" action="{{ route('password.email') }}" method="POST">
								@csrf
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="text" placeholder="Email" name="email" id="m_email" autocomplete="off">
									<div class="col m--align-right m-login__form-right">
                                                <a  href="{{ route('otp.forget_password') }}" class="m-link">
                                                    <i>{{ __('Thử cách khác') }}</i>
                                                </a>
									</div>
								</div>
								<div class="m-login__form-action">
									<button type="submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primaryr">Gửi</button>&nbsp;&nbsp;
									<button id="m_login_forget_password_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom m-login__btn">Cancel</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- end:: Page -->

		<!--begin::Global Theme Bundle -->
		<script src="{!! asset('assets/vendors/base/vendors.bundle.js') !!}" type="text/javascript"></script>
		<script src="{!! asset('assets/demo/base/scripts.bundle.js') !!}" type="text/javascript"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.min.js"></script>
		<!--end::Global Theme Bundle -->

		<!--begin::Page Scripts -->
		<script src="{!! asset('assets/snippets/custom/pages/user/login.js') !!}" type="text/javascript"></script>
		<script>
			$(".alert").fadeTo(2000, 500).slideUp(500, function(){
    			$(".alert").slideUp(500);
			});
		</script>
		<!--end::Page Scripts -->
	</body>

	<!-- end::Body -->
</html>
@if (session('error_email'))
	<script>
		Swal.fire({
			position: 'top-center',
			icon: 'warning',
			title: 'Địa chỉ email không tồn tại',
			timer: 5000
		})
	</script>
@endif
@if (session('success_email'))
	<script>
		Swal.fire({
			position: 'top-center',
			icon: 'success',
			title: 'Gửi Email thành công !',
			text: 'Vui lòng kiểm tra email để thay đổi mật khẩu',
			timer: 5000
		})
	</script>
@endif
@if (session('success_password'))
	<script>
		Swal.fire({
			position: 'top-center',
			icon: 'success',
			title: 'Đổi mật khẩu thành công !',
			text: 'Vui lòng đăng nhập lại',
			timer: 3000
		})
	</script>
@endif
