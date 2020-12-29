
<!DOCTYPE html>

<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>Reset pass</title>
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
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url(../../../assets/app/media/img//bg/bg-3.jpg);">
				<div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
					<div class="m-login__container">
						<div class="m-login__logo">
							<a href="#">
								<img src="{!! asset('images/coolkids.png') !!}">
							</a>
						</div>
						<div class="m-login__signin">
							<div class="m-login__head">
								<h3 class="m-login__title">Reset Password</h3>
							</div>
                            <form class="m-login__form m-form" method="POST" action="{{ route('mat-khau.update') }}">
                                @csrf
								<input type="hidden" name="token" value="{{ $token }}">
                                @if (session('message'))
                                <div class="m-alert m-alert--outline alert alert-danger alert-dismissible animated fadeIn" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                <span>{{session('message')}}</span>		
                                </div>
						        @endif
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off" value="{{ $email ?? old('email') }}" readonly>
									@error('email')
                                    <span class="invalid-feedback pl-5" role="alert">
                                        <strong>{{ $message }}</strong>
									</span>
                                     @enderror
                        
								</div>
								<div class="form-group m-form__group">
                                    <input id="password" type="password" class="form-control m-input m-login__form-input--last @error('password') is-invalid @enderror"
                                     name="password"  autocomplete="new-password" placeholder="Password">
                               
									@error('password')
                                        <span class="invalid-feedback pl-5" role="alert">
                                            <strong>{{ $message }}</strong>
										</span>
                                    @enderror
								</div>
                                <div class="form-group m-form__group">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password"  autocomplete="new-password">
									@error('password_confirmation')
                                        <span class="invalid-feedback pl-5" role="alert">
                                            <strong>{{ $message }}</strong>
										</span>
                                    @enderror
								</div>
				
								<div class="m-login__form-action">
									<button type="submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">Reset Password</button>
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

		<!--end::Global Theme Bundle -->

		<!--begin::Page Scripts -->
		<script src="{!! asset('assets/snippets/custom/pages/user/login.js') !!}" type="text/javascript"></script>

		<!--end::Page Scripts -->
	</body>

	<!-- end::Body -->
</html>