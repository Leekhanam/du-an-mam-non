
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
        <style>
            #partitioned {
            padding-left: 70px;
            letter-spacing: 45px;
            }
        </style>
		
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
								<img src="https://media.giphy.com/media/yN4psF1lMgoaePuOyF/giphy.gif" width="150" >
						</div>
						<div class="m-login__signin">
							<div class="m-login__head">
								<h3 class="m-login__title"></h3>
							</div>
                            <form class="m-login__form m-form">
                                @if (session('message'))
									<div class="m-alert m-alert--outline alert alert-danger alert-dismissible animated fadeIn" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
									<span>{{session('message')}}</span>		
									</div>
								@endif
                                <div class="input-group m-input-group m-input-group--pill m-input-icon m-input-icon--left m-input-icon--right" >
                                    <input class="form-control m-input m-input--pill m-input--air" type="text" placeholder="Email" name="email" required>
                                    <span class="m-input-icon__icon m-input-icon__icon--left"><span><i class="la la-user"></i></span></span>        
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air" onclick="validate()">Go!</button>
                                    </div>
								</div>
								<center>
									<span class="m-form__help">Mã xác nhận sẽ dc gửi tới số điện thoại của bạn</span>
								</center>
								<div class="m-login__form-action">
									<a href="{{ route('get.logout') }}" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom m-login__btn">Cancel</a>
								</div>
							</form>
						</div>
						<div class="m-login__forget-password">
							<div class="m-login__form m-form">
                                <div class="m-input-icon m-input-icon--left m-input-icon--right">
                                    <input onkeyup="checkOTP(event)" onkeypress="return isNumberKey(event)" type="text" id="partitioned" class="form-control m-input m-input--pill m-input--air" placeholder="MÃ OTP" maxlength="6">
                                    <span class="m-input-icon__icon m-input-icon__icon--left"><span><i class="la la-user"></i></span></span>
                                    <span style="cursor: pointer" onclick="start_timer()" class="m-input-icon__icon m-input-icon__icon--right"><span><i  class="flaticon-refresh"></i></span></span>
                                </div>
                                <center>
                                    <span class="m-form__help"></span>
									<h5 class="m--font-danger clock-timeout"></h5>
									<div class="progress" style="height: 5px; width: 60%">
										<div id="progressbar_timer" class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
                                </center>
								<div class="m-login__form-action">
									<button id="m_login_forget_password_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom m-login__btn">Cancel</button>
								</div>
							</div>
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
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
		<!--end::Global Theme Bundle -->

		<!--begin::Page Scripts -->
		<script src="{!! asset('assets/snippets/custom/pages/user/login.js') !!}" type="text/javascript"></script>
		<script>
			$(".alert").fadeTo(2000, 500).slideUp(500, function(){
    			$(".alert").slideUp(500);
			});
            function isNumberKey(evt){
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;
                return true;
            } 
            function validate(){
                if($('input[name=email]').val() == null || $('input[name=email]').val() == ""){
                    $('input[name=email]').addClass('is-invalid');
                }else{
                    $('input[name=email]').removeClass('is-invalid');
                    $('#m_login').addClass('m-login--forget-password');
					start_timer();
                }
            }
            var s = 0;
			var progressbar_width = 0;
            function start_timer(){
				if(s < 1 ){
					s = 120;
					progressbar_width = 0;
					timer();
				}
            }

            function timer(){
					sendOTP();
                    timeout = setInterval(function(){ 
							progressbar_width = progressbar_width + 0.5;
                            s--;
                            // let textSC = s.toString().length == 1 ? `(0${s.toString()}s)`: `(${s.toString()}s)`;
							$('#progressbar_timer').css('width', `${progressbar_width}%`);
                            // document.querySelector('.clock-timeout').innerHTML = textSC;
                            if(s == 0 ){
                                // document.querySelector('.clock-timeout').innerHTML = "...";
                                clearTimeout(timeout);
								resetOTP();	
                            }
                    }, 1000);
            }

			function sendOTP(){
				axios.post("{{ route('otp.send') }}",
                        {'email': $('input[name=email]').val()}
                )
			}

            function checkOTP(event) {
                if(event.target.value.length == 6 ){
                    axios.post("{{ route('otp.check') }}",
                        {
                            'email': $('input[name=email]').val(),
                            'ma_otp': event.target.value
                        }
                    ).then(res =>{
                        if(res.data.email != "" && res.data.token != ""){
                            $('#partitioned').removeClass('is-invalid');
                            let token = res.data.token;
                            let email = res.data.email;
                            const url = window.location.origin + `/password/reset/${token}?email=${email}`;
                            window.location.href = url;
                        }else{
                            $('#partitioned').addClass('is-invalid');
                        }
                    })
                }
            }
			function resetOTP() {
				axios.post("{{ route('otp.reset') }}",
                        {'email': $('input[name=email]').val()}
                )
			}
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
