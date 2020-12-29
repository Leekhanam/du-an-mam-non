<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Repositories\SucKhoeRepository;
use \App\Repositories\LopRepository;
use \App\Repositories\KhoiRepository;
use \App\Repositories\GiaoVienRepository;
use App\Repositories\NamHocRepository;
use Carbon\Carbon;
use App\Repositories\HocSinhRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\DonDanThuoc;
use App\Models\ChiTietDonThuoc;
use App\Models\DonNghiHoc;
use App\Models\HocSinh;

class QuanLyDonDanThuocController extends Controller
{
    protected $SucKhoeRepository;
    public function __construct(
        SucKhoeRepository $SucKhoeRepository,
        LopRepository $LopRepository,
        KhoiRepository $KhoiRepository,
        GiaoVienRepository $GiaoVienRepository,
        NamHocRepository $NamHocRepository,
        HocSinhRepository $HocSinhRepository

    ) {
       $this->SucKhoeRepository = $SucKhoeRepository;
       $this->LopRepository = $LopRepository;
       $this->KhoiRepository = $KhoiRepository;
       $this->GiaoVienRepository = $GiaoVienRepository;
       $this->NamHocRepository = $NamHocRepository;
       $this->HocSinhRepository = $HocSinhRepository;
    }

    public function index(Request $request)
    {
        if ($request->session()->has('id_nam_hoc')) {
            $id = $request->session()->get('id_nam_hoc');
        } else {
            $id = $this->NamHocRepository->maxID();
        }
        $nam_hoc_moi_nhat = $this->NamHocRepository->maxID();
        $nam_hoc_hien_tai = $id;
        $getAllNamHoc = $this->NamHocRepository->getAllNamHoc();
        $khoi = $this->KhoiRepository->getAll();
        $namhoc = $this->NamHocRepository->find($id);
        $id_nam_hoc = $id;
        $array_thang = $this->NamHocRepository->getThangNamHoc(['start_date'=>$namhoc->start_date, 
                                                                'end_date'  =>$namhoc->end_date]);
        return view('quan-ly-don-dan-thuoc.index',  compact(
            'khoi',
            'namhoc', 
            'id_nam_hoc', 
            'getAllNamHoc', 
            'nam_hoc_moi_nhat',
            'nam_hoc_hien_tai',
            'array_thang'
        ));
    }

    public function donDanThuocCuaHsTheoThang(Request $request)
    {
        $hoc_sinh_id = $request->hoc_sinh_id;
        $month = Carbon::createFromFormat('d-m-Y', "01-". $request->thang)->month;
        $year = Carbon::createFromFormat('d-m-Y', "01-". $request->thang)->year;
     
        $data =  DonDanThuoc::where('hoc_sinh_id', $hoc_sinh_id)
                            ->whereYear('ngay_bat_dau', '=', $year)
                            ->whereMonth('ngay_bat_dau', '=', $month)
                            ->get();
        return response()->json($data, Response::HTTP_OK);
    }

    public function show($id)
    {
        $data = DonDanThuoc::find($id);
        if(!$data){
            return redirect()->route('quan-ly-don-dan-thuoc.index');
        }
        return view('quan-ly-don-dan-thuoc.show',compact('data'));
    }
}
