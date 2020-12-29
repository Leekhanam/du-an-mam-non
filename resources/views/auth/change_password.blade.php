@extends('layouts.main')
@section('title', "Thông tin cá nhân")
@section('content')
<div class="m-content">
						<div class="row">
							<div class="col-xl-3 col-lg-4">
								<div class="m-portlet m-portlet--full-height  ">
									<div class="m-portlet__body">
										<div class="m-card-profile">
											<div class="m-card-profile__title m--hide">
												Your Profile
											</div>
											<div class="m-card-profile__pic">
												<div class="m-card-profile__pic-wrapper">
													<img src="../upload/{{Auth::user()->avatar}}" alt="" />
												</div>
											</div>
											<div class="m-card-profile__details">
												<span class="m-card-profile__name">{{Auth::user()->name }}</span>
												<a href="" class="m-card-profile__email m-link">{{Auth::user()->email}}</a>
											</div>
										</div>
										<ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
											<li class="m-nav__separator m-nav__separator--fit"></li>
											<li class="m-nav__section m--hide">
												<span class="m-nav__section-text">Section</span>
											</li>
											<li class="m-nav__item">
												<a href="{{ route('profile') }}" class="m-nav__link">
													<i class="m-nav__link-icon flaticon-profile-1"></i>
													<span class="m-nav__link-title">
														<span class="m-nav__link-wrap">
															<span class="m-nav__link-text">Trang cá nhân</span>
															<span class="m-nav__link-badge"><span class="m-badge m-badge--success">2</span></span>
														</span>
													</span>
												</a>
											</li>
										
										
											<li class="m-nav__item">
												<a href="../header/profile&amp;demo=default.html" class="m-nav__link">
													<i class="m-nav__link-icon flaticon-lifebuoy"></i>
													<span class="m-nav__link-text">Hỗ trợ</span>
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
<!-- 										
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_3" role="tab">
														Messages
													</a>
												</li> -->
												
											</ul>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="m-portlet__nav">
												<li class="m-portlet__nav-item m-portlet__nav-item--last">
													<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
														<a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
															<i class="la la-gear"></i>
														</a>
														<div class="m-dropdown__wrapper">
															<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
															<div class="m-dropdown__inner">
																<div class="m-dropdown__body">
																	<div class="m-dropdown__content">
																		<ul class="m-nav">
																			<li class="m-nav__section m-nav__section--first">
																				<span class="m-nav__section-text">Quick Actions</span>
																			</li>
																			<li class="m-nav__item">
																				<a href="" class="m-nav__link">
																					<i class="m-nav__link-icon flaticon-share"></i>
																					<span class="m-nav__link-text">Đổi mật khẩu</span>
																				</a>
																			</li>
																		
																			<li class="m-nav__section">
																				<span class="m-nav__section-text">Useful Links</span>
																			</li>
																			<li class="m-nav__item">
																				<a href="" class="m-nav__link">
																					<i class="m-nav__link-icon flaticon-info"></i>
																					<span class="m-nav__link-text">FAQ</span>
																				</a>
																			</li>
																			<li class="m-nav__item">
																				<a href="" class="m-nav__link">
																					<i class="m-nav__link-icon flaticon-lifebuoy"></i>
																					<span class="m-nav__link-text">Support</span>
																				</a>
																			</li>
																			<li class="m-nav__separator m-nav__separator--fit m--hide">
																			</li>
																			<li class="m-nav__item m--hide">
																				<a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">Submit</a>
																			</li>
																		</ul>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</li>
											</ul>
										</div>
									</div>

											<div class="tab-pane " id="m_user_profile_tab_2">
											<form class="m-form m-form--fit m-form--label-align-right" method="post" 
												action="{{route('update-mat-khau')}}">
												@csrf
													<div class="m-portlet__body">
														<div class="form-group m-form__group m--margin-top-10 m--hide">
															<div class="alert m-alert m-alert--default" role="alert">
																
															</div>
														</div>

											@if (session('error'))
												<div class="alert alert-danger"  role="alert">
													{{session('error')}}
												</div>
											@endif

											@if(session()->get('message'))
											<script >
															swal({
																title: "Mật khẩu đã được thay đổi!",
																text: "Vui lòng đăng nhập lại để tiếp tục!",
																type: "success",
																button: "OK!" ,
																icon: "success",
																reverseButtons: !0
															});
														
												</script>
											@endif
																<div class="form-group m-form__group row">
															<div class="col-10 ml-auto">
																<h3 class="m-form__section">Đổi mật khẩu</h3>
															</div>
														</div>
														@auth 
														<div class="form-group m-form__group row">
															<label for="example-text-input" class="col-2 col-form-label">Mật khẩu cũ</label>
															<div class="col-7">
																<input class="form-control m-input" type="password" name="current_password"  value="">
															</div>
														</div>
														<div class="form-group m-form__group row">
															
															<label for="example-text-input" class="col-2 col-form-label" >Mật khẩu mới</label>
															<div class="col-7">
															@error('new_password')
																<small style="color:red">{{$message}}</small>
																@enderror
																<input class="form-control m-input " type="password" name="new_password" value="">
															</div>
															
														</div>
														<div class="form-group m-form__group row">
															<label for="example-text-input" class="col-2 col-form-label" >Nhập lại mật khẩu mới</label>
															<div class="col-7">
															@error('password_confirmation')
																<small style="color:red">{{$message}}</small>
																@enderror
																<input class="form-control m-input " type="password" name="password_confirmation" value="">
															</div>
															
														</div>
														
													</div>
													<div class="m-portlet__foot m-portlet__foot--fit">
														<div class="m-form__actions">
															<div class="row">
																<div class="col-2">
																</div>
																<div class="col-7">
																	<button type="submit" id="btnresult" onclick="changePassword()"  class="btn btn-accent m-btn m-btn--air m-btn--custom">Cập nhật</button>&nbsp;&nbsp;
																	<button  class="btn btn-secondary m-btn m-btn--air m-btn--custom">Cancel</button>
																</div>
															</div>
														</div>
													</div>
													@endauth 
												</form>
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
