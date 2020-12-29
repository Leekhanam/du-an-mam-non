<!DOCTYPE html>
<html lang="en">

	<!-- begin::Head -->
	<head>
		@routes()
		<meta charset="utf-8" />
		<title>
			@yield('title')
		</title>
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
		<link rel="shortcut icon" type="image/x-icon" href="https://kidsonline.edu.vn/wp-content/themes/kids-online/assets/images/favicon.png" />
		{{--  style style  --}}
		@include('layouts._share.style')
		{{--  endstyle style  --}}
		@yield('style')
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
		<div id="progressbar"  style="width: 0%"></div>
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">

			<!-- BEGIN: Header -->
			@include('layouts._share.header')

			<!-- END: Header -->

			<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

				<!-- BEGIN: Left Sidebar -->
				@include('layouts._share.sidebar')

				<!-- END: Left Sidebar -->
				<div class="m-grid__item m-grid__item--fluid m-wrapper" id="pjax-container">

					<!--start content -->
					@yield('content')
					<!--end content -->		
					
				</div>
			</div>

			<!-- end:: Body -->

			<!-- begin::Footer -->
			@include('layouts._share.footer')

			<!-- end::Footer -->
		</div>

		<!-- end:: Page -->

		<!-- begin::Quick Sidebar -->
		<!-- @include('layouts._share.quick_sidebar') -->
		<!-- end::Quick Sidebar -->

		<!-- begin::Scroll Top -->
		<div id="m_scroll_top" class="m-scroll-top">
			<i class="la la-arrow-up"></i>
		</div>

		<!-- end::Scroll Top -->

		<!-- begin::Quick Nav -->
		@include('layouts._share.quick_nav')
		<!-- begin::Quick Nav -->

		  {{--  script  --}}
		  @include('layouts._share.script')
		  {{--  endscript  --}}
		  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
		  @yield('script')
		<!--end::Page Scripts -->
		  @include('layouts._share.notify')
		  
		  <!-- <script type="text/javascript" src="{{ asset('pjax/jquery.pjax.js') }}"></script> -->
		  <!-- <script type="text/javascript" src="{{ asset('pjax/setup-pjax.js') }}"></script> -->
		 {{-- <script type="text/javascript" src="{{ asset('js/hieu_ung.min.js') }}"></script>  --}}
	</body>

	<!-- end::Body -->
</html>