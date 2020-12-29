<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DiemDanhVeRepository;
use \App\Repositories\KhoiRepository;
use \App\Repositories\GiaoVienRepository;
use App\Repositories\NamHocRepository;
use App\Repositories\HocSinhRepository;
use Carbon\Carbon;
use App\Models\NguoiDonHo;
use App\Models\Lop;
use App\Models\HocSinh;
use App\Models\DiemDanhVe;
use App\Http\Requests\BoSungDiemDanh;

class QuanLyDiemDanhVeController extends Controller
{
    protected $DiemDanhVeRepository;
    protected $HocSinhRepository;

    public function __construct(
        DiemDanhVeRepository $DiemDanhVeRepository,
        HocSinhRepository $HocSinhRepository,
        KhoiRepository $KhoiRepository,
        GiaoVienRepository $GiaoVienRepository,
        NamHocRepository $NamHocRepository

    ) {
       $this->DiemDanhVeRepository = $DiemDanhVeRepository;
       $this->HocSinhRepository = $HocSinhRepository;
       $this->KhoiRepository = $KhoiRepository;
       $this->GiaoVienRepository = $GiaoVienRepository;
       $this->NamHocRepository = $NamHocRepository;
    }

    public function index(Request $request)
    {   
        if ($request->session()->has('id_nam_hoc')) {
            $id = $request->session()->get('id_nam_hoc');
        } else {
            $id = $this->NamHocRepository->maxID();
        }
        $getAllNamHoc = $this->NamHocRepository->getAllNamHoc();
        $khoi = $this->KhoiRepository->getAll();
        $giao_vien = $this->GiaoVienRepository->getGIaoVienChuaCoLop();
        $namhoc = $this->NamHocRepository->find($id);
        $thang_trong_nam = $this->NamHocRepository->getThangNamHoc(['start_date' => $namhoc->start_date, 'end_date' => $namhoc->end_date]);
        $id_nam_hoc = $id;
        return view('quan-ly-diem-danh-ve.index', compact('khoi', 'giao_vien', 'namhoc', 'id_nam_hoc', 'getAllNamHoc' , 'thang_trong_nam'));
    }

    public function getDiemDanhVeTheoLop(Request $request)
    {
        if ($request->session()->has('id_nam_hoc')) {
            $id = $request->session()->get('id_nam_hoc');
        } else {
            $id = $this->NamHocRepository->maxID();
        }

        $month = Carbon::createFromFormat('d-m-Y', "01-".$request->time)->month;
        $year = Carbon::createFromFormat('d-m-Y', "01-".$request->time)->year;
        $hoc_sinh_theo_lop = $this->HocSinhRepository->getHocSinhCuaLop($request->id, []);
        foreach($hoc_sinh_theo_lop as $key => $hoc_sinh){
            $data_diem_danh_ve_thang = $hoc_sinh->DiemDanhVe()
                                                ->whereYear('ngay_diem_danh_ve', '=', $year)
                                                ->whereMonth('ngay_diem_danh_ve', '=', $month)
                                                ->orderBy('ngay_diem_danh_ve', 'ASC')
                                                ->get();
            $hoc_sinh_theo_lop[$key]['diem_danh_ve'] = $data_diem_danh_ve_thang ;
        }
        return $hoc_sinh_theo_lop;
    }

    public function infoNguoiDonHo(Request $request)
    {
        $data = NguoiDonHo::find($request->id);
        return $data;
    }

    public function thongKeSoLieu(Request $request)
    {
        if ($request->session()->has('id_nam_hoc')) {
            $id = $request->session()->get('id_nam_hoc');
        } else {
            $id = $this->NamHocRepository->maxID();
        }
        $month = Carbon::createFromFormat('d-m-Y', "01-".$request->time)->month;
        $year = Carbon::createFromFormat('d-m-Y', "01-".$request->time)->year;
        $data = $this->DiemDanhVeRepository->thongKeSoLieu(['hoc_sinh_id' => $request->hoc_sinh_id,
                                                            'month'       => $month,
                                                            'year'        => $year
                                                           ]);
        return $data;                                           
    }

    public function danhSachHocSinhTheoLop(Request $request)
    {
        $data = Lop::find($request->lop_id);
        return $data->HocSinh;
    }

    public function boSungDiemDanhVe(BoSungDiemDanh $request)
    {
        $countDelete = DiemDanhVe::where('ngay_diem_danh_ve', $request->ngay_diem_danh)
                ->where('lop_id', $request->lop_id)
                ->delete();
        $kq =  DiemDanhVe::insert($request->data);
        return 'Đã xóa ' . $countDelete . ' Và BỔ SUNG THÀNH CÔNG';
    }
}
