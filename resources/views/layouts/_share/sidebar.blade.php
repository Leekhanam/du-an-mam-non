<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
				<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">

					<!-- BEGIN: Aside Menu -->
					<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
						<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow p-0" id="ul-home">
							<li class="m-menu__item  m-menu__item--active" aria-haspopup="true"><a href="{{ route('app')}}" class="m-menu__link "><i class="m-menu__link-icon flaticon-home-2"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Trang chủ</span>
											<span class="m-menu__link-badge"></span> </span></span></a></li>
							<li class="m-menu__section ">
								<h4 class="m-menu__section-text">Danh mục</h4>
								<i class="m-menu__section-icon flaticon-more-v2"></i>
							</li>
						</ul>
						<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow p-0" id="sortable">
							<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-bell-1"></i><span class="m-menu__link-text">Thông báo</span><i
									 class="m-menu__ver-arrow la la-angle-right"></i></a>
								<div class="m-menu__submenu "><span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
										<li class="m-menu__item " aria-haspopup="true"><a href="{{ route('thong-bao.index') }}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Thông báo</span></a></li>
									</ul>
								</div>
							</li>
							<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-users"></i><span class="m-menu__link-text">Tài khoản</span><i
									 class="m-menu__ver-arrow la la-angle-right"></i></a>
								<div class="m-menu__submenu "><span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
										
										<li class="m-menu__item " aria-haspopup="true"><a href="{{ route('account.index') }}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Danh sách tài khoản</span></a></li>
										
									</ul>
								</div>
							</li>
							
					   <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-list"></i><span class="m-menu__link-text">Công việc hằng ngày</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
						<div class="m-menu__submenu " m-hidden-height="160" style=""><span class="m-menu__arrow"></span>
							<ul class="m-menu__subnav">
								<li class="m-menu__item m-menu__item--submenu m-menu__item--open m-menu__item--hover" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Điểm danh</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
									<div class="m-menu__submenu " m-hidden-height="160" style=""><span class="m-menu__arrow"></span>
										<ul class="m-menu__subnav">
											<li class="m-menu__item " aria-haspopup="true"><a href="{{route('quan-ly-diem-danh-den-index')}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Điểm danh đến
														</span></a></li>
											<li class="m-menu__item " aria-haspopup="true"><a href="{{route('quan-ly-diem-danh-ve.index')}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Điểm danh về
														</span></a></li>

										</ul>
									</div>
								</li>
								<li class="m-menu__item " aria-haspopup="true"><a href="{{ route('quan-ly-don-nghi-hoc.index') }}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Đơn nghỉ học</span></a></li>
								<li class="m-menu__item " aria-haspopup="true"><a href="{{ route('quan-ly-don-dan-thuoc.index') }}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Đơn dặn thuốc</span></a></li>
								
							</ul>
						</div>
					</li>

							
							
							<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-interface-10"></i><span class="m-menu__link-text">Đơn đăng ký nhập học</span><i
									 class="m-menu__ver-arrow la la-angle-right"></i></a>
								<div class="m-menu__submenu "><span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
										<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__link-text">Base</span></span></li>
										<li class="m-menu__item " aria-haspopup="true"><a href="{{ route('quan-ly-dang-ky-nhap-hoc.index') }}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Danh sách đơn</span></a></li>
									</ul>
								</div>
							</li>

							<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-customer"></i><span class="m-menu__link-text">Quản lý giáo viên</span><i
									 class="m-menu__ver-arrow la la-angle-right"></i></a>
								<div class="m-menu__submenu "><span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
										<li class="m-menu__item " aria-haspopup="true"><a href="{{ route('quan-ly-giao-vien-index') }}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Danh sách giáo viên</span></a></li>
										<li class="m-menu__item " aria-haspopup="true"><a href="{{ route('quan-ly-giao-vien-create') }}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Thêm mới giáo viên</span></a></li>
										<li class="m-menu__item " aria-haspopup="true"><a href="{{ route('quan-ly-phan-lop-cho-giao-vien') }}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Phân lớp cho giáo viên</span></a></li>
									</ul>
								</div>
							</li>
					
							<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-technology-1"></i><span class="m-menu__link-text">Quản lý sức khỏe</span><i
								class="m-menu__ver-arrow la la-angle-right"></i></a>
						   		<div class="m-menu__submenu "><span class="m-menu__arrow"></span>
							   		<ul class="m-menu__subnav">
								   		<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__link-text">item</span></span></li>
									   <li class="m-menu__item " aria-haspopup="true"><a href="{{route('quan-ly-suc-khoe-index')}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Sức khỏe</span></a></li>
							   
							   		</ul>
						   		</div>
					   		</li>
							<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-folder-1"></i><span class="m-menu__link-text">Quản lý giáo trình</span><i
									 class="m-menu__ver-arrow la la-angle-right"></i></a>
								<div class="m-menu__submenu "><span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
										<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__link-text">item</span></span></li>
									<li class="m-menu__item " aria-haspopup="true"><a href="{{route('quan-ly-giao-trinh-index')}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Giáo trình dạy của giáo viên</span></a></li>
									
									</ul>
								</div>
							</li>
							<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-web"></i><span class="m-menu__link-text">Quản lý diện ưu tiên</span><i
								class="m-menu__ver-arrow la la-angle-right"></i></a>
						   <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
							   <ul class="m-menu__subnav">
								   <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__link-text">item</span></span></li>
							   <li class="m-menu__item " aria-haspopup="true"><a href="{{route('quan-ly-dien-uu-tien-index')}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Diện ưu tiên</span></a></li>
							   
							   </ul>
						   </div>
					   </li>
							<li  class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-network"></i><span class="m-menu__link-text">Hệ thống</span><i
									 class="m-menu__ver-arrow la la-angle-right"></i></a>
								<div class="m-menu__submenu "><span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
										<li class="m-menu__item " aria-haspopup="true"><a href="{{ route('nam-hoc.index') }}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Năm Học</span></a></li>
								
									</ul>
								</div>
							</li>

							<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-coins"></i><span class="m-menu__link-text">Quản lý học phí</span><i
								class="m-menu__ver-arrow la la-angle-right"></i></a>
						   <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
							   <ul class="m-menu__subnav">
								   <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('quan-ly-khoan-thu-index') }}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Quản lý khoản thu</span></a></li>
								   <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('quan-ly-dot-thu-index',['id'=>0]) }}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Quản lý đợt thu</span></a></li>
						   
							   </ul>
						   </div>
					   </li>
							
					   <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-like"></i><span class="m-menu__link-text">Quản lý feedback</span><i
						class="m-menu__ver-arrow la la-angle-right"></i></a>
				   <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
					   <ul class="m-menu__subnav">
						   <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__link-text">item</span></span></li>
					   <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('quan-ly-feed-back-index') }}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Thống kê feedback của phụ huynh  </span></a></li>
				   
					   </ul>
				   </div>
			   </li>
							
					
						
							<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
								<a href="{{ route('nha-truong.index')}}" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon flaticon-settings-1"></i>
									<span class="m-menu__link-text">Cài đặt</span>
								</a>
							</li>
							
						</ul>
					</div>

					<!-- END: Aside Menu -->
				</div>