<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
Route::get('/', 'HomeController@index')->middleware('auth', 'web', 'checkNamHoc')->name('app');
Auth::routes();
Route::get('profile', 'Auth\AuthController@profile')->middleware('auth', 'web')->name('auth.profile');
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth', 'web', 'checkNamHoc');
Route::get('/logout','Auth\AuthController@getLogout')->name('get.logout');

Route::group(['middleware' => ['web','auth']], function () {
    Route::get('/trang-ca-nhan', 'AccountController@editProfile')->name('profile');
    Route::post('/upload-avatar','Auth\AuthController@uploadAvatar')->name('upload-avatar');
    Route::post('/chinh-sua-trang-ca-nhan', 'AccountController@updateProfile')->name('updateProfile');
    Route::get('/trang-ca-nhan/doi-mat-khau','AccountController@changePasswordForm')->name('doi-mat-khau');
    Route::post('/trang-ca-nhan/update-mat-khau','AccountController@changePassword')->name('update-mat-khau');

});
Route::post('/get_quan_huyen_theo_thanh_pho', 'QuanHuyenController@getQuanHuyenByMaTp')->name('get_quan_huyen_theo_thanh_pho');
Route::post('/get_xa_phuong_theo_thanh_pho', 'XaPhuongThiTranController@getXaPhuongThiTranByMaPh')->name('get_xa_phuong_theo_thi_tran');
Route::get('/quang_sac_sua', 'DangKiNhapHocController@basic_email');
Route::post('/get_quan_huyen_theo_thanh_pho', 'QuanHuyenController@getQuanHuyenByMaTp')->name('get_quan_huyen_theo_thanh_pho');
Route::post('/get_xa_phuong_theo_thanh_pho', 'XaPhuongThiTranController@getXaPhuongThiTranByMaPh')->name('get_xa_phuong_theo_thi_tran');

Route::prefix('/dang-ki-nhap-hoc')->group(function () {
    Route::get('/', 'DangKiNhapHocController@index')->name('dangki-nhap-hoc');
    Route::post('/submit-dang-ki-nhap-hoc', 'DangKiNhapHocController@store')->name('submit-dang-ki-nhap-hoc');
    Route::post('/submit-xac-nhan-ma-dang-ky', 'DangKiNhapHocController@XacNhanDangKy')->name('submit-xac-nhan-ma-dangki');
    Route::post('/validation-dang-ki-nhap-hoc', 'DangKiNhapHocController@validation')->name('validation-dang-ki-nhap-hoc');
});

// HIEUPT-13/10/2020-QUAN_LY_GIAO_TRINH

Route::group(['middleware' => ['web','auth']], function () {
    Route::prefix('/quan-ly-giao-trinh')->group(function(){
        Route::get('/', 'QuanLyGiaoTrinhController@index')->name('quan-ly-giao-trinh-index');
        Route::post('phe-duyet-giao-trinh', 'QuanLyGiaoTrinhController@pheDuyetGiaoTrinh')->name('phe-duyet-giao-trinh');

    });

    Route::prefix('quan-ly-giao-vien')->group(function () {
        Route::get('/', 'QuanlyGiaoVienController@index')->name('quan-ly-giao-vien-index');
        Route::get('/create', 'QuanlyGiaoVienController@create')->name('quan-ly-giao-vien-create');
        Route::post('/store', 'QuanlyGiaoVienController@store')->name('quan-ly-giao-vien-store');
        Route::get('/edit/{id}', 'QuanlyGiaoVienController@edit')->name('quan-ly-giao-vien-edit');
        Route::post('/update/{id}', 'QuanlyGiaoVienController@update')->name('quan-ly-giao-vien-update');
        Route::post('/lop-theo-khoi', 'QuanlyGiaoVienController@getLopTheoKhoi')->name('quan-ly-giao-vien-get-lop-theo-khoi');
        Route::post('/destroy', 'QuanlyGiaoVienController@destroy')->name('quan-ly-giao-vien-destroy');
        Route::post('/giao-vien-chua-co-lop', 'QuanlyGiaoVienController@getAllGiaoVienChuaCoLop')->name('quan-ly-get-all-giao-vien-chua-lop');
        Route::get('/get-giao-vien-chua-co-lop', 'QuanlyGiaoVienController@getGiaoVienChuaCoLop')->name('quan-ly-giao-vien-chua-co-lop');
        Route::post('/get-giao-vien-nghi-day', 'QuanlyGiaoVienController@getGiaoVienNghiDay')->name('quan-ly-giao-vien-nghi-day');
        Route::post('/thoi-day-giao-vien', 'QuanlyGiaoVienController@ThoiDayGiaoVien')->name('quan-ly-giao-vien-thoi-day-cho-giao-vien');
        Route::post('/khoi-phuc-thoi-day', 'QuanlyGiaoVienController@KhoiPhucThoiDay')->name('quan-ly-giao-vien-khoi-phuc-thoi-day');
        Route::get('/phan-lop', 'QuanlyGiaoVienController@phanLopChoGiaoVien')->name('quan-ly-phan-lop-cho-giao-vien');
        Route::post('/store-phan-lop', 'QuanlyGiaoVienController@storePhanLopChoGiaoVien')->name('store-phan-lop-cho-giao-vien');

    });
    Route::prefix('quan-ly-hoc-sinh')->group(function () {
        Route::get('/thong-tin/{id}', 'QuanlyHocSinhController@index')->name('quan-ly-hoc-sinh-index');
        Route::get('/create', 'QuanlyHocSinhController@create')->name('quan-ly-hoc-sinh-create');
        Route::get('/edit/{id}', 'QuanlyHocSinhController@edit')->name('quan-ly-hoc-sinh-edit');
        Route::post('/update/{id}', 'QuanlyHocSinhController@update')->name('quan-ly-hoc-sinh-update');
        Route::post('/store', 'QuanlyHocSinhController@store')->name('quan-ly-hoc-sinh-store');

        Route::post('export-bieu-mau', 'QuanlyHocSinhController@exportBieuMau')->name('export-bieu-mau-nhap-hoc-sinh');
        Route::post('/get_lop_theo_khoi', 'QuanlyHocSinhController@getLopOfKhoi')->name('get-lop-theo-khoi');

        Route::post('import-bieu-mau-hoc-sinh', 'QuanlyHocSinhController@importFile')->name('import-bieu-mau-nhap-hoc-sinh');
        Route::post('error-import-bieu-mau-hoc-sinh', 'QuanlyHocSinhController@errorFileImport')->name('error-import-bieu-mau-nhap-hoc-sinh');

        //v2
        Route::post('/hoc-sinh-chua-co-lop', 'QuanlyHocSinhController@showHocSinhChuaCoLop')->name('quan-ly-hoc-sinh-chua-co-lop');
        Route::post('/chuyen-lop', 'QuanlyHocSinhController@chuyenLop')->name('quan-ly-hoc-sinh-chuyen-lop');
        Route::post('/thoi-hoc', 'QuanlyHocSinhController@thoiHoc')->name('quan-ly-hoc-sinh-thoi-hoc');
        Route::post('/get-thong-tin-hoc-sinh-thoi-hoc', 'QuanlyHocSinhController@getThongTinThoiHoc')->name('get-thong-tin-hoc-sinh-thoi-hoc');  
        Route::post('/xac-nhan-hoc-sinh-di-hoc-lai', 'QuanlyHocSinhController@xacNhanDiHocLai')->name('xac-nhan-hoc-sinh-di-hoc-lai');
        
        Route::post('/lich-su-cua-hoc-sinh', 'QuanlyHocSinhController@getLichSuHocSinh')->name('quan-li-lich-su-cua-hoc-sinh');
        Route::post('/hoc-phi-cua-hoc-sinh', 'QuanlyHocSinhController@getHocPhiHocSinh')->name('quan-ly-hoc-sinh-hoc-phi');

    });
});
Route::prefix('quan-ly-dang-ky-nhap-hoc-online')->group(function () {
    Route::get('/', 'QuanLyDangKyNhapHocController@index')->name('quan-ly-dang-ky-nhap-hoc.index');
    Route::get('/edit/{id}', 'QuanLyDangKyNhapHocController@show')->name('edit-hs-dang-ky-nhap-hoc');
    Route::post('/cap-nhap-id-user', 'QuanLyDangKyNhapHocController@capNhapId')->name('cap-nhap-id-user-for-hs');
    Route::post('/edit', 'QuanLyDangKyNhapHocController@PheDuyet')->name('submit-edit-hs-dang-ky-nhap-hoc');
    Route::post('/validation-edit-dang-ki-nhap-hoc', 'QuanLyDangKyNhapHocController@validation')->name('validation-edit-dang-ki-nhap-hoc');
    Route::post('/remove-don-dang-ki', 'QuanLyDangKyNhapHocController@delete')->name('remove-don-dang-ki');
    Route::get('/test-gui-sms', 'QuanLyDangKyNhapHocController@testAPI');

});

// thanhnv 9/16/2020

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::prefix('quan-ly-khoi')->group(function () {
        Route::get('/', 'KhoiController@index')->name('quan-ly-khoi-index');
        Route::post('/post_create', 'KhoiController@post_create')->name('quan-ly-khoi-post_create');
        Route::post('/destroy', 'KhoiController@destroy')->name('quan-ly-khoi-destroy');
        Route::post('/store/{id}', 'KhoiController@store')->name('quan-ly-khoi-store');
        Route::post('/show', 'KhoiController@show')->name('quan-ly-khoi-show');
        Route::post('/update', 'KhoiController@update')->name('quan-ly-khoi-update');
    });

    Route::prefix('quan-ly-lop')->group(function () {
        Route::get('/', 'LopController@index')->name('quan-ly-lop-index');
        Route::get('/create', 'LopController@create')->name('quan-ly-lop-create');
        Route::get('/show/{id}', 'LopController@show')->name('quan-ly-lop-show');
        Route::get('/phan-lop', 'LopController@phanLop')->name('quan-ly-lop-phan-lop');
        Route::get('/xep-lop', 'LopController@xepLop')->name('quan-ly-lop-xep-lop');

        //Lớp v2

        Route::post('/edit', 'LopController@edit')->name('quan-ly-lop-edit');
        Route::post('/store', 'LopController@store')->name('quan-ly-lop-phan-store');
        Route::post('/update', 'LopController@update')->name('quan-ly-lop-update');
        Route::post('/destroy', 'LopController@destroy')->name('quan-ly-lop-destroy');

        Route::post('/show-data-hoc-sinh-theo-lop', 'LopController@showHsTheoLop')->name('quan-ly-lop-show-data-hoc-sinh');
        Route::get('/show-data-hoc-sinh-chua-co-lop/{type}', 'LopController@getDataHocSinhChuaCoLop')->name('quan-ly-lop-show-data-hoc-sinh-type');

        Route::post('/xep-lop-tu-dong', 'LopController@xepLopTuDong')->name('quan-ly-lop-xep-lop-tu-dong');

    });
});
Route::group(['middleware' => ['web', 'auth', 'checkNamHoc']], function () {
    Route::prefix('nam-hoc')->group(function () {
        Route::get('/', 'NamHocController@index')->name('nam-hoc.index');
        Route::post('/create', 'NamHocController@store')->name('nam-hoc.store');
        Route::get('/chi-tiet-nam-hoc/{id}', 'QuanLyTrongNamController@index')->name('nam-hoc-chi-tiet')->middleware('TrangThaiQuanLyNamHoc');
        Route::post('/dong-nam-hoc', 'NamHocController@lock')->name('nam-hoc.lock');
        Route::get('/chuyen-du-lieu-nam-hoc/{id}', 'QuanLyTrongNamController@getchuyenDuLieuNamHoc')->name('get-chuyen-du-lieu-nam-hoc')->middleware('CheckTrangThaiBackUp');
        Route::post('/chuyen-du-lieu-nam-hoc', 'QuanLyTrongNamController@postchuyenDuLieuNamHoc')->name('post-chuyen-du-lieu-nam-hoc');
        Route::post('/get-du-lieu-khoi-lop-nam-moi', 'QuanLyTrongNamController@getDuLieuKhoiLopNamMoi')->name('get-du-lieu-khoi-lop-nam-moi');
        Route::get('/get-du-lieu-len-lop/{id}', 'QuanLyTrongNamController@duLieuLenLop')->name('get-du-lieu-len_lop');
        Route::post('/len-lop-cho-hoc-sinh', 'QuanLyTrongNamController@leLopChoHocSinh')->name('len-lop-cho-hoc-sinh');
        Route::get('/du-lieu-nam-hoc-moi-len-lop', 'QuanLyTrongNamController@getDuLieuNamHocMoiLenLop')->name('du-lieu-nam-hoc-moi-len-lop');
        Route::get('/get_hoc_sinh_tot_nghiep_theo_nam/{id}', 'QuanLyTrongNamController@hocSinhTotNghiepTheoNam')->name('hoc_sinh_tot_nghiep_theo_nam');
        Route::post('/kiem_tra_ton_tai_thong_tin_nam_hoc', 'QuanLyTrongNamController@kiemTraTonTaiDuLieuNamHoc')->name('kiem_tra_ton_tai_thong_tin_nam_hoc');
        Route::post('/xoa_toan_bo_du_lieu_nam_hoc_hien_tai', 'QuanLyTrongNamController@xoaToanBoDuLieuCuaNamHocHienTai')->name('xoa_toan_bo_du_lieu_nam_hoc_hien_tai');
        
        Route::post('/thay_doi_session_nam_hoc', 'QuanLyTrongNamController@changeSessionNamHoc')->name('thay-doi-session-nam-hoc');
        Route::post('/check-date-tao-nam-hoc', 'NamHocController@checkDateTaoNamHoc')->name('check-date-tao-nam-hoc');
        

        
    });
    Route::prefix('thong-bao')->group(function () {
        Route::get('/', 'ThongBaoController@index')->name('thong-bao.index');
        Route::get('/toan-truong', 'ThongBaoController@uiThongBaoToanTruong')->name('thong-bao.ui-tt');
        Route::get('/giao-vien', 'ThongBaoController@uiThongBaoGiaoVien')->name('thong-bao.ui-gv');
        Route::get('/hoc-sinh', 'ThongBaoController@uiThongBaoHocSinh')->name('thong-bao.ui-hs');
        Route::get('/{id}', 'ThongBaoController@showThongBao')->name('thong-bao.show')->where('id', '[0-9]+');;
        Route::post('sendto-toan-truong', 'ThongBaoController@guiToanTruong')->name('sendto_toantruong');
        Route::post('sendto-giao-vien', 'ThongBaoController@guiGiaoVien')->name('sendto_giaovien');
        Route::post('sendto-hoc-sinh', 'ThongBaoController@guiHocSinh')->name('sendto_hocsinh');
        Route::get('soan-thong-bao', 'ThongBaoController@create')->name('thong-bao.create');
    });

    Route::post('changeType', 'NotificationController@changeType')->name('notification.changeType');
    Route::get('nhan-xet/{id}', 'NhanXetController@show')->name('nhanxet.show');
    Route::post('find', 'NhanXetController@find')->name('nhanxet.find');

    Route::get('quan-ly-don-nghi-hoc', 'QuanLyDonNghiHocController@index')->name('quan-ly-don-nghi-hoc.index');
    Route::post('show-hs-theo-lop', 'QuanLyDonNghiHocController@showHsTheoLop')->name('show-hs-theo-lop');
    Route::post('don-nghi-hoc-theo-thang', 'QuanLyDonNghiHocController@donNghiHocCuaHsTheoThang')->name('don-nghi-hoc-theo-thang');
    Route::get('chi-tiet-don-nghi-hoc/{id}', 'QuanLyDonNghiHocController@show')->name('don-nghi-hoc.show');

    Route::get('quan-ly-don-dan-thuoc', 'QuanLyDonDanThuocController@index')->name('quan-ly-don-dan-thuoc.index');
    Route::post('don-dan-thuoc-theo-thang', 'QuanLyDonDanThuocController@donDanThuocCuaHsTheoThang')->name('don-dan-thuoc-theo-thang');
    Route::get('chi-tiet-don-dan-thuoc/{id}', 'QuanLyDonDanThuocController@show')->name('don-dan-thuoc.show');
});

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::prefix('quan-ly-diem-danh-den')->group(function () {
        Route::get('/', 'QuanLyDiemDanhDenController@index')->name('quan-ly-diem-danh-den-index');
        Route::post('/lay-theo-lop', 'QuanLyDiemDanhDenController@getDiemDanhDen')->name('quan-ly-diem-danh-den-theo-lop');
        Route::post('/thong-ke-diem-danh', 'QuanLyDiemDanhDenController@ThongKeDiemDanh')->name('quan-ly-thong-ke-diem-danh');

        Route::post('/bo-sung-diem-danh-den', 'QuanLyDiemDanhDenController@boSungDiemDanhDen')->name('boSungDiemDanhDen');
    });

    Route::prefix('quan-ly-diem-danh-ve')->group(function () {
        Route::get('/', 'QuanLyDiemDanhVeController@index')->name('quan-ly-diem-danh-ve.index');
        Route::post('/lay-theo-lop', 'QuanLyDiemDanhVeController@getDiemDanhVeTheoLop')->name('quan-ly-diem-danh-ve-theo-lop');
        Route::post('/thong-tin-nguoi-don-ho', 'QuanLyDiemDanhVeController@infoNguoiDonHo')->name('infoNguoiDonHo');
        Route::post('/thong-ke-so-lieu', 'QuanLyDiemDanhVeController@thongKeSoLieu')->name('thongKeSoLieu');

        Route::post('/danh-sach-hoc-sinh-theo-lop', 'QuanLyDiemDanhVeController@danhSachHocSinhTheoLop')->name('danhSachHocSinhTheoLop');
        Route::post('/bo-sung-diem-danh-ve', 'QuanLyDiemDanhVeController@boSungDiemDanhVe')->name('boSungDiemDanhVe');
    });

    Route::prefix('quan-ly-feed-back')->group(function () {
        Route::get('/', 'ThongKeFeedBackController@index')->name('quan-ly-feed-back-index');
        Route::post('/show-feedback-cua-lop', 'ThongKeFeedBackController@ShowFeedBackCuaLop')->name('quan-ly-feed-back-show-feedback-cua-lop');
        Route::post('/thay-doi-trang-thai-feedback', 'ThongKeFeedBackController@ThayDoiTrangThaiFeedBack')->name('quan-ly-feed-back-thay-doi-trang-thai');
        Route::post('/da-xem-tat-ca', 'ThongKeFeedBackController@FeedBackChuaXemCuaLop')->name('quan-ly-feed-back-da-xem-tat-ca');
        Route::post('/get-giao-vien-feed-back', 'ThongKeFeedBackController@GetGiaoVienFeedBack')->name('quan-ly-feed-back-get-giao-vien');
    });

    Route::prefix('quan-ly-suc-khoe')->group(function(){
        Route::get('/', 'QuanlySucKhoeController@index')->name('quan-ly-suc-khoe-index');
        Route::post('/show-suc-khoe-hoc-sinh', 'QuanlySucKhoeController@showQuanLySucKhoe')->name('quan-ly-suc-khoe-show-sk-hs');
        Route::post('/them-dot-kham-suc-khoe', 'QuanlySucKhoeController@themDotKhamSucKhoe')->name('quan-ly-suc-khoe-them-dot-kham');
        Route::post('/show-chi-tiet-suc-khoe-hoc-sinh', 'QuanlySucKhoeController@showChiTietSucKhoe')->name('quan-ly-suc-khoe-show-chi-tiet');
        Route::post('/kiem-tra-dot-moi-nhat', 'QuanlySucKhoeController@kiemtraDotMoiNhat')->name('quan-ly-suc-khoe-kiem-tra-dot-moi-nhat');
        Route::post('/show-xoa-dot', 'QuanlySucKhoeController@showXoaDot')->name('quan-ly-suc-khoe-show-xoa-dot');
        Route::post('/xoa-dot', 'QuanlySucKhoeController@xoaDot')->name('quan-ly-suc-khoe-xoa-dot');
    });

    Route::prefix('quan-ly-khoan-thu')->group(function(){
        Route::get('/', 'QuanLyKhoanThuController@index')->name('quan-ly-khoan-thu-index');
        Route::get('get-data-khoan-thu', 'QuanLyKhoanThuController@getDataKhoanThu')->name('quan-ly-khoan-thu-get-data');
        Route::post('tao_khoan_thu', 'QuanLyKhoanThuController@store')->name('quan-ly-khoan-thu-store');
        Route::post('update_khoan_thu', 'QuanLyKhoanThuController@update')->name('quan-ly-khoan-thu-update');
        Route::post('copy_khoan_thu', 'QuanLyKhoanThuController@copy')->name('quan-ly-khoan-thu-copy');
        Route::get('delete_khoan_thu/{id}', 'QuanLyKhoanThuController@delete')->name('quan-ly-khoan-thu-delete'); 
        Route::post('delete-list-khoan-thu', 'QuanLyKhoanThuController@deleteList')->name('quan-ly-khoan-thu-delete-list');
    });

    Route::prefix('quan-ly-dot-thu')->group(function(){
        Route::get('/{id}', 'QuanLyThangThuController@index')->name('quan-ly-dot-thu-index');
        // Route::get('get-data-dot-thu', 'QuanLyThangThuController@getDataKhoanThu')->name('quan-ly-dot-thu-get-data');
        Route::post('tao_dot_thu', 'QuanLyThangThuController@store')->name('quan-ly-dot-thu-store');
        Route::post('xoa_dot_thu', 'QuanLyThangThuController@delete')->name('quan-ly-dot-thu-delete');


        Route::post('get-tong-tien-thu-theo-khoi', 'QuanLyThangThuController@getKhoanThuTheoKhoi')->name('get-tong-tien-thu-theo-khoi');
        Route::get('chi_tiet_dot_thu/{id}/{khoi}', 'QuanLyThangThuController@chiTietDotThu')->name('get-chi-tiet-dot-thu');
        Route::post('chi_tiet_dot_thu_theo_lop', 'QuanLyThangThuController@chiTietDotThuTheoLop')->name('get-chi-tiet-dot-thu-theo-lop');
        Route::post('gui_thong_bao_theo_khoi', 'QuanLyThangThuController@guiThongBaoTheoKhoi')->name('gui-thong-bao-theo-khoi');
        Route::post('gui_thong_bao_theo_lop', 'QuanLyThangThuController@guiThongBaoTheoLop')->name('gui-thong-bao-theo-lop');
        Route::post('dong_hoc_phi_theo_lop', 'QuanLyThangThuController@dongHocPhiTheoLop')->name('dong-hoc-phi-theo-lop');

        Route::get('xuat_hoa_don_pdf/{id}/{id_chi_tiet_dot}', 'QuanLyThangThuController@xuatHoaDonPdF')->name('xuat-hoa-don-pdf');
        Route::get('huy_thu_tien/{id}/{id_chi_tiet_dot}', 'QuanLyThangThuController@huyThuTien')->name('huy-thu-tien');



        // Route::post('update_dot_thu', 'QuanLyThangThuController@update')->name('quan-ly-dot-thu-update');
        // Route::post('copy_dot_thu', 'QuanLyThangThuController@copy')->name('quan-ly-dot-thu-copy');
        // Route::get('delete_dot_thu/{id}', 'QuanLyThangThuController@delete')->name('quan-ly-dot-thu-delete'); 
        // Route::post('delete-list-dot-thu', 'QuanLyThangThuController@deleteList')->name('quan-ly-dot-thu-delete-list');
    });

    Route::get('thong-tin-nha-truong', 'NhaTruongController@index')->name('nha-truong.index');
    Route::post('them-thong-tin-nha-truong', 'NhaTruongController@store')->name('nha-truong.store');
});

Route::view('OTP', 'auth.passwords.forgot_OTP')->name('otp.forget_password');
Route::post('send-otp', "Auth\SendOTPController@send")->name('otp.send');
Route::post('check-otp', "Auth\SendOTPController@checkOTP")->name('otp.check');
Route::post('reset-otp', "Auth\SendOTPController@resetOTP")->name('otp.reset');
Route::get('khoi-tao-nam-hoc', 'NamHocController@khoiTaoNamHoc')->name('nam-hoc.khoi-tao')->middleware('auth', 'web');
Route::post('khoi-tao-nam-hoc', 'NamHocController@storekhoiTaoNamHoc')->name('nam-hoc.khoi-tao-dau-tien')->middleware('auth', 'web');

Route::prefix('quan-ly-dien-uu-tien')->group(function(){
    Route::get('/', 'DienUuTienController@index')->name('quan-ly-dien-uu-tien-index');
    Route::post('/store', 'DienUuTienController@store')->name('quan-ly-dien-uu-tien-store');
    Route::post('/edit/{id}', 'DienUuTienController@EditDienUuTien')->name('quan-ly-dien-uu-tien-edit');
    Route::post('/delete-dien-uu-tien', 'DienUuTienController@XoaDienUuTien')->name('quan-ly-dien-uu-tien-delete');
    Route::post('/get-mot-dien-uu-tien', 'DienUuTienController@GetMotDienUuTien')->name('quan-ly-dien-uu-tien-get-mot');
    Route::post('/delete-list-dien-uu-tien', 'DienUuTienController@XoaListDienUuTien')->name('quan-ly-dien-uu-tien-delete-list');
    
});

Route::get('mat-khau-reset', "Auth\QuenMatKhauController@showResetForm")->name('mat-khau.reset');
Route::post('mat-khau-update', "Auth\QuenMatKhauController@reset")->name('mat-khau.update');


