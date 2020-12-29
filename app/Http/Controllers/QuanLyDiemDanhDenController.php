<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DiemDanhDenRepository;
use \App\Repositories\LopHocRepository;
use \App\Repositories\KhoiRepository;
use \App\Repositories\GiaoVienRepository;
use App\Repositories\NamHocRepository;
use Carbon\Carbon;
use App\Models\DiemDanhDen;
use App\Http\Requests\BoSungDiemDanh;

class QuanLyDiemDanhDenController extends Controller
{
    protected $DiemDanhDenRepository;

    public function __construct(
        DiemDanhDenRepository $DiemDanhDenRepository,
        LopHocRepository $LopHocRepository,
        KhoiRepository $KhoiRepository,
        GiaoVienRepository $GiaoVienRepository,
        NamHocRepository $NamHocRepository

    ) {
       $this->DiemDanhDenRepository = $DiemDanhDenRepository;
       $this->LopHocRepository = $LopHocRepository;
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
        // dd($thang_trong_nam);
        $id_nam_hoc = $id;
        return view('quan-ly-diem-danh-den.index', compact('khoi', 'giao_vien', 'namhoc', 'id_nam_hoc', 'getAllNamHoc' , 'thang_trong_nam'));
    }
    public function getDiemDanhDen(Request $request)
    {   
        $check = 0;
        if ($request->session()->has('id_nam_hoc')) {
            $id_nam = $request->session()->get('id_nam_hoc');
            $id_nam_nhat = $this->NamHocRepository->maxID();
            if($id_nam == $id_nam_nhat){
                $check = 1;
            }
             
            
        } else {
            $id_nam = $this->NamHocRepository->maxID();
            
            $check = 1;
        }
        
        $namhoc = $this->NamHocRepository->find($id_nam);
        
        $request = $request->all();
        $id = $request['id'];
        $time = $request['time'];
       
        if($time == 0 && $check > 0){
            $TimeNow = Carbon::now();
            $time =  $TimeNow->month;
    
        }
        if($time == 0 && $check == 0){
            $thang_trong_nam = $this->NamHocRepository->getThangNamHoc(['start_date' => $namhoc->start_date, 'end_date' => $namhoc->end_date]);
            $time = intval(substr($thang_trong_nam[0], 0, 2));
        }
        
        $hocsinh = $this->DiemDanhDenRepository->getHocSinhTheoLop($id);
        foreach($hocsinh as $key => $item){
            $N = $S = $C = $NH = $A = 0;
            $NgayDiemDanh = $this->DiemDanhDenRepository->getNgayDiemDanhTheoThang($id, $time, $item->id, $namhoc->start_date, $namhoc->end_date);
            $array_diemdanh = [];
            foreach($NgayDiemDanh as $item2){
                $diemdanh = $this->DiemDanhDenRepository->getDiemDanh($id,$item2->ngay_diem_danh_den, $item->id);
                $trang_thai = "";
                $an_com = "";
                
                
                if($diemdanh){
                    //Điểm danh 1 buổi 
                    if(count($diemdanh) == 1){
                        switch ($diemdanh[0]->type) {
                            //Sáng
                            case 1:
                                if ($diemdanh[0]->trang_thai == 1) {
                                    $trang_thai = "S";
                                    $S++;
                                }
                                if($diemdanh[0]->phieu_an == 1){
                                    $an_com = "A";
                                    $A++;
                                }
                                if($diemdanh[0]->trang_thai !== 1)
                                {
                                    $trang_thai = "NH";
                                    $NH++;
                                }
                                break;

                            //Chiều
                            case 2:
                                if ($diemdanh[0]->trang_thai == 1) {
                                    $trang_thai = "C";
                                    $C++;
                                }
                                else{
                                    $trang_thai = "NH";
                                    $NH++;
                                }
                                break;
                            
                        }
                    }
                    //Điểm danh đủ buổi 
                    if(count($diemdanh) == 2){
                        switch ($diemdanh[0]->type) {
                            case 1:
                                if ($diemdanh[0]->trang_thai == 1 && $diemdanh[1]->trang_thai == 1) {
                                    $trang_thai = "N";
                                    $N++;
                                }
                                
                                if($diemdanh[0]->trang_thai == 1 && ($diemdanh[1]->trang_thai == 2 || $diemdanh[1]->trang_thai == 3)){
                                    $trang_thai = "S";
                                    $S++;
                                }
                                if($diemdanh[0]->phieu_an == 1){
                                    $an_com = "A";
                                    $A++;
                                }
                                if($diemdanh[1]->trang_thai == 1 && ($diemdanh[0]->trang_thai == 2 || $diemdanh[0]->trang_thai == 3)){
                                    $trang_thai = "C";
                                    $C++;
                                }
                                if($diemdanh[0]->trang_thai !== 1 && $diemdanh[1]->trang_thai !== 1){
                                    $trang_thai = "NH";
                                    $NH++;
                                }
                                break;
                            
                            case 2:
                                if ($diemdanh[1]->trang_thai == 1 && $diemdanh[0]->trang_thai == 1) {
                                    $trang_thai = "N";
                                    $N++;
                                }
                                if($diemdanh[1]->trang_thai == 1 && ($diemdanh[0]->trang_thai == 2 || $diemdanh[0]->trang_thai == 3)){
                                    $trang_thai = "S";
                                    $S++;
                                }
                                if($diemdanh[1]->phieu_an == 1){
                                    $an_com = "A";
                                    $A++;
                                }
                                if($diemdanh[0]->trang_thai == 1 && ($diemdanh[1]->trang_thai == 2 || $diemdanh[1]->trang_thai == 3)){
                                    $trang_thai = "C";
                                    $C++;
                                }
                                if($diemdanh[1]->trang_thai !== 1 && $diemdanh[0]->trang_thai !== 1){
                                    $trang_thai = "NH";
                                    $NH++;
                                }
                                break;
                        }
                    }
                    
                    $array = 
                    [
                        'trang_thai_diem_danh' => $trang_thai,
                        'an_com' => $an_com,
                        'ngay_diem_danh_den' => $diemdanh[0]->ngay_diem_danh_den
                    ];
                    $day = new Carbon($diemdanh[0]->ngay_diem_danh_den);
                    $array_diemdanh[$day->day] = $array;
                }
               
            }
            // dd($array_diemdanh);
            $hocsinh[$key]->trang_thai_diem_danh = $array_diemdanh;
            $hocsinh[$key]->sang = $S;
            $hocsinh[$key]->chieu = $C;
            $hocsinh[$key]->ca_ngay = $N;
            $hocsinh[$key]->nghi_hoc = $NH;
            $hocsinh[$key]->an_com = $A;
        }
        return [
            'thang_hien_tai' => $time,
            'hocsinh' => $hocsinh
        ];
        
        
    }

    public function boSungDiemDanhDen(BoSungDiemDanh $request)
    {
        $countDelete = DiemDanhDen::where('ngay_diem_danh_den', $request->ngay_diem_danh)
                ->where('lop_id', $request->lop_id)
                ->where('type', $request->type)
                ->delete();
        $kq =  DiemDanhDen::insert($request->data);
        return 'Đã xóa ' . $countDelete . ' Và BỔ SUNG THÀNH CÔNG';
    }
    
}
