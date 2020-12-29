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
use DateTime;
use DatePeriod;
use DateInterval;
use Illuminate\Support\Facades\DB;
use App\Models\DonNghiHoc;
use App\Models\HocSinh;

class QuanLyDonNghiHocController extends Controller
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
        $dot_id_gan_nhat = 0;
        $getAllNamHoc = $this->NamHocRepository->getAllNamHoc();
        $khoi = $this->KhoiRepository->getAll();
        $namhoc = $this->NamHocRepository->find($id);
        $id_nam_hoc = $id;
        $EndDateNamHoc = $this->NamHocRepository->getEndDateNamHoc($id_nam_hoc);
        $thoi_gian_gan_nhat = $this->SucKhoeRepository->getDotMoiNhatTheoNam($EndDateNamHoc->end_date);
        if($thoi_gian_gan_nhat !== null){
            $dot_id_gan_nhat = $thoi_gian_gan_nhat->id;
        }
        
        $getAllDotKhamSucKhoe = $this->SucKhoeRepository->getAllDotKhamSucKhoe($EndDateNamHoc->end_date, $EndDateNamHoc->start_date);

        $array_thang = $this->NamHocRepository->getThangNamHoc(['start_date'=>$namhoc->start_date, 
                                                                'end_date'  =>$namhoc->end_date]);
        return view('quan-ly-don-nghi-hoc.index',  compact(
            'khoi',
            'namhoc', 
            'id_nam_hoc', 
            'getAllNamHoc', 
            'dot_id_gan_nhat',
            'getAllDotKhamSucKhoe',
            'nam_hoc_moi_nhat',
            'nam_hoc_hien_tai',
            'array_thang'
        ));
    } 

    public function showHsTheoLop(Request $request)
    {
        $lop_id = request('lop_id');
        $lop = $this->LopRepository->find($lop_id);
        $data = $lop->HocSinh;
        return response()->json($data, Response::HTTP_OK);
    }

    public function donNghiHocCuaHsTheoNam(Request $request)
    {
        if ($request->session()->has('id_nam_hoc')) {
            $id_nam_hoc = $request->session()->get('id_nam_hoc');
        } else {
            $id_nam_hoc = $this->NamHocRepository->maxID();
        }

        $nam_hoc = $this->NamHocRepository->find($id_nam_hoc);
        $date_from = Carbon::createFromFormat('d-m-Y', $nam_hoc->start_date);
        $date_to = Carbon::createFromFormat('d-m-Y', $nam_hoc->end_date);

        $hoc_sinh_id = $request->hoc_sinh_id;
        $hoc_sinh = $this->HocSinhRepository->find($hoc_sinh_id);
        dd($hoc_sinh->DonNghiHoc->whereBetween('ngay_bat_dau', [$date_from, $date_to]));
    }

    public function donNghiHocCuaHsTheoThang(Request $request) 
    {
        $hoc_sinh_id = $request->hoc_sinh_id;
        $month = Carbon::createFromFormat('d-m-Y', "01-". $request->thang)->month;
        $year = Carbon::createFromFormat('d-m-Y', "01-". $request->thang)->year;
        $data =  DonNghiHoc::where('hoc_sinh_id', $hoc_sinh_id)
                            ->whereYear('ngay_bat_dau', '=', $year)
                            ->whereMonth('ngay_bat_dau', '=', $month)
                            ->get();

        return response()->json($data, Response::HTTP_OK);
    }

    public function show($id)
    {
        $data = DonNghiHoc::find($id);
        if(!$data){
            return redirect()->route('quan-ly-don-nghi-hoc.index');
        }
        return view('quan-ly-don-nghi-hoc.show', compact('data'));
    }
}
