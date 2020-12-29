@extends('layouts.main')
@section('title', "Thông tin cá nhân")
@section('style')
<link rel="stylesheet" href="{{ asset('change_avatar/change_avatar.css')}}">
@endsection
@section('content')
<div class="m-content">
						<div class="row" style="height: 550px">
							<div class="col-xl-3 col-lg-4">
								<div class="m-portlet m-portlet--full-height  ">
									<div class="m-portlet__body">
										<div class="m-card-profile">
											<div class="m-card-profile__title m--hide">
												Trang cá nhân
											</div>
											<div class="m-card-profile__pic">
												<div class="image-input image-input-outline image-input-circle" id="kt_image_3">
													<div class="image-input-wrapper"
														style="background-image: url('{{ Auth::user()->avatar}}'), url('https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random')">
													</div>
													<label
														class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
														data-action="change" data-toggle="tooltip" title=""
														data-original-title="Change avatar">
														<i class="la la-pencil text-muted"></i>
														<input type="file" name="profile_avatar"
															accept="image/*" onchange="changeAvatar(this)">
														<input type="hidden" name="profile_avatar_remove">
													</label>
												</div>
											</div>
											<div class="m-card-profile__details">
												<span class="m-card-profile__name">@auth {{Auth::user()->name }} @endauth</span>
												<a href="" class="m-card-profile__email m-link">@auth {{Auth::user()->email }} @endauth</a>
											</div>
										</div>
										<ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
											<li class="m-nav__separator m-nav__separator--fit"></li>
											<li class="m-nav__section m--hide">
												<span class="m-nav__section-text">Section</span>
											</li>
											<li class="m-nav__item">
												<a href="#" class="m-nav__link">
													<i class="m-nav__link-icon flaticon-profile-1"></i>
													<span class="m-nav__link-title">
														<span class="m-nav__link-wrap">
															<span class="m-nav__link-text">Tài Khoản</span>
														</span>
													</span>
												</a>
											</li>
										</ul>
										<div class="m-portlet__body-separator"></div>
										
									</div>
								</div>
							</div>
							<div class="col-xl-9 col-lg-8">
								<div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-tools">
											<ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_user_profile_tab_1" role="tab">
														<i class="flaticon-share m--hide"></i>
														Cập nhật tài khoản
													</a>
												</li>
											
											
											</ul>
										</div>
									</div>
									<div class="tab-content">
										<div class="tab-pane active" id="m_user_profile_tab_1">
											<form class="m-form m-form--fit m-form--label-align-right" method="POST" action="{{route('updateProfile') }}"  enctype="multipart/form-data" >
												@csrf
												<div class="m-portlet__body">
													<div class="form-group m-form__group m--margin-top-10 m--hide">
														<div class="alert m-alert m-alert--default" role="alert">
															
														</div>
														@auth
													</div>
													<div class="form-group m-form__group row">
														<div class="col-10 ml-auto">
															<h3 class="m-form__section">Thông tin cá nhân</h3>
														</div>
													</div>
													<div class="form-group m-form__group row">
														<label for="example-text-input"  class="col-2 col-form-label">Họ tên</label>
														<div class="col-7">
															<input class="form-control m-input" type="text" name="name"   value="{{Auth::user()->name }}">
															@error('name')
															<small style="color:red">{{$message}}</small>
															@enderror
														</div>
													</div>
													<div class="form-group m-form__group row" >
														<label for="example-text-input" class="col-2 col-form-label" name="email">Email</label>
														<div class="col-7">
															<input class="form-control m-input " type="text" name="email"  value="{{Auth::user()->email }}">
															@error('email')
																<small style="color:red">{{$message}}</small>
															@enderror
														</div>
													</div>
												</div>
												<div class="m-portlet__foot m-portlet__foot--fit">
													<div class="m-form__actions">
														<div class="row">
															<div class="col-4">
															</div>
															<div class="col-7">
																<button type="submit" class="btn btn-success m-btn m-btn--air m-btn--custom">Cập nhật</button>&nbsp;&nbsp;
															</div>
														</div>
													</div>
												</div>
												@endauth
											</form>
										</div>
										<div class="tab-pane " id="m_user_profile_tab_2">
										</div>
										<div class="tab-pane " id="m_user_profile_tab_3">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
@endsection
@section('script')
<script src="{{ asset('change_avatar/scripts.bundle.js')}}"></script>
<script src="{{ asset('change_avatar/image-input.js')}}"></script>
<script>
	function showimages(element){
        var file = element.files[0];
        var reader = new FileReader();
        reader.onloadend = function() {
                $('#show_img').attr('src', reader.result);
            }
        reader.readAsDataURL(file);
	}

	function changeAvatar(file){
        let srcAvatar = URL.createObjectURL(file.files[0]);
		$(".error_avatar").attr("src", srcAvatar);
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
                let url = rs.data.display_url;
				axios.post("{{ route('upload-avatar')}}",{"avatar": url})
				.then(res => {
				})
            });
	}		
</script>
@if (session('message'))
<script>
    Swal.fire({
        position: "center",
        icon: "success",
        title: "Cập nhật tài khoản thành công !",
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif
@endsection
