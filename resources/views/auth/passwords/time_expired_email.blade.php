<!DOCTYPE html>
<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>Error Email</title>
		<meta name="description" content="Bootstrap alert examples">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

		<!--begin::Global Theme Styles -->
        <link href="{{ asset('css/all.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
	</head>
	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
		<!-- begin:: Page -->
					<!-- END: Subheader -->
					<div class="m-content">
						<div class="row">
							<div class="col-xl-12">
								<!--begin::Portlet-->
								<div class="m-portlet">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Email đã hết hạn
												</h3>
											</div>
										</div>
									</div>
									<div class="m-portlet__body">
										<div class="m-alert m-alert--icon alert alert-danger" role="alert">
											<div class="m-alert__icon">
												<i class="fas fa-exclamation-triangle" style="font-size: 48px;"></i>
											</div>
											<div class="m-alert__text">
												<strong>Xin lỗi!</strong> Email xác thực này đã hết hạn vui lòng gửi Email khác
											</div>
											<div class="m-alert__actions" style="width: 220px;">
												<a href="{{ route('login') }}" class="btn btn-outline-light btn-sm m-btn m-btn--hover-brand" data-dismiss="alert1" aria-label="Close">Quay lại
                                                </a>
											</div>
										</div>
									</div>
								</div>

								<!--end::Portlet-->
							</div>
						
						</div>
					</div>

			<!-- end:: Body -->
		</div>
		<script src="{{ asset('js/all.js') }}" type="text/javascript"></script>

		<!--end::Global Theme Bundle -->
	</body>

	<!-- end::Body -->
</html>