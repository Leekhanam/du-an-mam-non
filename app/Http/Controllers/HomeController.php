<?php

namespace App\Http\Controllers;

use App\Models\NoiDungThongBao;
use Illuminate\Http\Request;
use App\Repositories\LopRepository;
use App\Repositories\HocSinhRepository;
use App\Repositories\NamHocRepository;
use App\Repositories\GiaoVienRepository;
use App\Repositories\KhoiRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Repositories\QuanLyThangThuRepository;
use App\Repositories\QuanLyChiTietDotThuRepository;
use App\Repositories\DanhSachThuTienRepository;
use App\Repositories\HoatDongRepository;
class HomeController extends Controller
{   
    protected $GiaoVienRepository;
    protected $LopRepository;
    protected $HocSinhRepository;
    protected $NamHocRepository;
    protected $KhoiRepository;
    protected $QuanLyThangThuRepository;
    protected $QuanLyChiTietDotThuRepository;
    protected $DanhSachThuTienRepository;
    protected $HoatDongRepository;

    public function __construct(
        LopRepository $LopRepository,
        GiaoVienRepository $GiaoVienRepository,
        KhoiRepository $KhoiRepository,
        HocSinhRepository $HocSinhRepository,
        NamHocRepository $NamHocRepository,
        QuanLyThangThuRepository $QuanLyThangThuRepository,
        QuanLyChiTietDotThuRepository $QuanLyChiTietDotThuRepository,
        DanhSachThuTienRepository $DanhSachThuTienRepository,
        HoatDongRepository $HoatDongRepository
    ) {
        $this->LopRepository = $LopRepository;
        $this->GiaoVienRepository = $GiaoVienRepository;
        $this->KhoiRepository = $KhoiRepository;
        $this->HocSinhRepository = $HocSinhRepository;
        $this->NamHocRepository = $NamHocRepository;
        $this->QuanLyThangThuRepository = $QuanLyThangThuRepository;
        $this->QuanLyChiTietDotThuRepository = $QuanLyChiTietDotThuRepository;
        $this->DanhSachThuTienRepository = $DanhSachThuTienRepository;
        $this->HoatDongRepository = $HoatDongRepository;
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $id = $this->NamHocRepository->maxID();
        $namhoc = $this->NamHocRepository->find($id);
        $getAllNamHoc = $this->NamHocRepository->getNamHoc();
        $array_nam = [];
        $array_hoc_sinh = [];
        if(count($getAllNamHoc) > 0 ){
            foreach($getAllNamHoc as $namhoc){
                array_push($array_nam, $namhoc->name);
                $hoc_sinh_theo_ngay_vao_truong = $this->HocSinhRepository->getHocSinhTheoNgayVaoTruong($namhoc->start_date, $namhoc->end_date);
                // /dd($hoc_sinh_theo_ngay_vao_truong);
                $arr_hs = [];
                $nam = 0;
                $nu = 0;
                if(count($hoc_sinh_theo_ngay_vao_truong) > 0){
                    foreach($hoc_sinh_theo_ngay_vao_truong as $item_HS){
                        if($item_HS->gioi_tinh == 0){
                            $nam = $nam+1;
                        }
                        if($item_HS->gioi_tinh == 1){
                            $nu = $nu+1;
                        }
                    }
                    $arr_hs[0] = $nam;
                    $arr_hs[1] = $nu;
                    
                    array_push($array_hoc_sinh, $arr_hs);
                    
                }
                else{
                    $arr_hs[0] = $nam;
                    $arr_hs[1] = $nu;
                    array_push($array_hoc_sinh, $arr_hs);
                }
            }
        }
        
        $so_tien_phai_dong = 0;
        $so_tien_da_dong = 0;
        
        $thang_thu_moi_nhat = $this->QuanLyThangThuRepository->getDotMoiNhatCuaNam($id);
        if($thang_thu_moi_nhat){
            $dot_thu_tien = $this->QuanLyChiTietDotThuRepository->getDotThuTheoNamIDThangThu($thang_thu_moi_nhat->id);
            foreach($dot_thu_tien as $item){
               $DsThuTien = $this->DanhSachThuTienRepository->getDanhSachThuTienTheoDot($item->id);
               if(count($DsThuTien) > 0){
                    foreach($DsThuTien as $item2){
                        $so_tien_phai_dong += $item2->so_tien_phai_dong;
                        $so_tien_da_dong += $item2->so_tien_da_dong;
                    }
               }
            }
        }
        $so_tien_con_phai_dong = $so_tien_phai_dong - $so_tien_da_dong;

        //Tin tức
        $user_auth = User::where('role', 1)->get();
        foreach($user_auth as $key => $item3){
            $user_auth[$key] = $item3->id;
        }
        $noi_dung_thong_bao = NoiDungThongBao::whereIn('auth_id', $user_auth->toArray())->orderBy('id', 'desc')->limit(15)->get();
       
        //Giáo trình giáo viên
        $nam_hoc_moi = $this->NamHocRepository->find($id);
        $date_start = Carbon::createFromFormat('Y-m-d', $nam_hoc_moi->start_date);
        $tong_tuan_cua_nam_hoc =($date_start->weeksInYear());
        $date = Carbon::now();
        $year_start_nam_hoc = $date_start->year;
        $numberNextWeek = $date->weekOfYear -$date_start->weekOfYear ;
        if ($numberNextWeek+$date_start->weekOfYear >= $tong_tuan_cua_nam_hoc) {
           $week =  $numberNextWeek+$date_start->weekOfYear - $tong_tuan_cua_nam_hoc -1;
        }else{
            $week = $numberNextWeek;
        }   
        $date->setISODate($date->year,$date->weekOfYear+1);
        $start_day_week = $date->startOfWeek()->format('d-m-Y');
        $end_day_week = $date->endOfWeek()->format('d-m-Y');
        $tuan_moi_nhat = [$numberNextWeek+1,$start_day_week,$end_day_week];
        $danh_sach_hoat_dong = $this->HoatDongRepository->getDanhHoatDong($id, $tuan_moi_nhat[0]);
        // dd($danh_sach_hoat_dong);
        $array_danh_sach = [];
        
            foreach($namhoc->Khoi as $khoi){
                foreach($khoi->LopHoc as $lop){
                    foreach($danh_sach_hoat_dong as $ds_giao_trinh){
                    if($ds_giao_trinh->lop_id == $lop->id){
                        // array_push($array_danh_sach, $ds_giao_trinh);
                        $arr = [
                            'ten_lop' => $lop->ten_lop,
                            'lop_id' => $lop->id,
                            'trang_thai' => 1,
                            'type' => $ds_giao_trinh->type
                        ];
                        array_push($array_danh_sach, $arr);
                    }
                    else{
                        $arr = 
                        [
                            'ten_lop' => $lop->ten_lop,
                            'lop_id' => $lop->id,
                            'trang_thai' => 0,
                            'type' => 4
                        ];
                    array_push($array_danh_sach, $arr);
                    }
                }
                if(count($danh_sach_hoat_dong) == 0){
                    $arr = 
                    [
                        'ten_lop' => $lop->ten_lop,
                        'lop_id' => $lop->id,
                        'trang_thai' => 0,
                        'type' => 4
                    ];
                    array_push($array_danh_sach, $arr);
                }
                
                
            }
        }

        return view('index', compact(
            'array_nam',
            'array_hoc_sinh', 
            'namhoc', 
            'so_tien_con_phai_dong',
            'so_tien_da_dong',
            'so_tien_phai_dong',
            'noi_dung_thong_bao',
            'array_danh_sach',
            'tuan_moi_nhat',
            'thang_thu_moi_nhat'
        ));
    }
}
