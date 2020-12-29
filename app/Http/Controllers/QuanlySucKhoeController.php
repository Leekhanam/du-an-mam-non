<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Repositories\SucKhoeRepository;
use \App\Repositories\LopHocRepository;
use \App\Repositories\KhoiRepository;
use \App\Repositories\GiaoVienRepository;
use App\Repositories\NamHocRepository;
use Carbon\Carbon;
use  App\Repositories\HocSinhRepository;

class QuanlySucKhoeController extends Controller
{
    protected $SucKhoeRepository;
    public function __construct(
        SucKhoeRepository $SucKhoeRepository,
        LopHocRepository $LopHocRepository,
        KhoiRepository $KhoiRepository,
        GiaoVienRepository $GiaoVienRepository,
        NamHocRepository $NamHocRepository,
        HocSinhRepository $HocSinhRepository

    ) {
       $this->SucKhoeRepository = $SucKhoeRepository;
       $this->LopHocRepository = $LopHocRepository;
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
        // dd(count($getAllDotKhamSucKhoe));
        return view('quan-ly-suc-khoe.index', compact(
            'khoi',
            'namhoc', 
            'id_nam_hoc', 
            'getAllNamHoc', 
            'dot_id_gan_nhat',
            'getAllDotKhamSucKhoe',
            'nam_hoc_moi_nhat',
            'nam_hoc_hien_tai'
        ));
    }

    public function showQuanLySucKhoe(Request $request){
        $request = $request->all();
        $lop_id = $request['lop_id'];
        $dot_id_gan_nhat = $request['dot_id_gan_nhat'];
        $getSucKhoHocSinhTheoLop = $this->SucKhoeRepository->getSucKhoeHocSinhTheoLop($lop_id, $dot_id_gan_nhat);
        return $getSucKhoHocSinhTheoLop;
        
    }

    public function themDotKhamSucKhoe(Request $request){
        $request = $request->all();
        unset($request['_token']);
        $thoi_gian = $request['thoi_gian'];
        $get_nam_hoc_hien_tai = $this->NamHocRepository->layNamHocHienTai();
        $data = 0;
        if($thoi_gian < $get_nam_hoc_hien_tai->end_date && $thoi_gian > $get_nam_hoc_hien_tai->start_date && isset($request['ten_dot'])){
            $ten_dot = $request['ten_dot'];
            $array = [
                'ten_dot' => $ten_dot,
                'thoi_gian' => $thoi_gian
            ];
            

            //Thêm sức khỏe các lớp giáo viên chưa thêm
            $dot_moi_nhat = $this->SucKhoeRepository->getDotSucKhoeMoiNhat();
        if($dot_moi_nhat && $thoi_gian > $dot_moi_nhat->thoi_gian){
            $data1 = [];
            $data2 = [];
            $id = $this->NamHocRepository->maxID();
            $dot_id = $dot_moi_nhat->id;
            
            $suc_khoe_theo_dot = $this->SucKhoeRepository->GetSucKhoeTheoDot($dot_id);
            foreach($suc_khoe_theo_dot as $value){
                array_push($data1, $value->lop_id);
            }
            $namhoc = $this->NamHocRepository->find($id);
            foreach($namhoc->khoi as $item){
                foreach($item->LopHoc as $item2){
                    if(in_array($item2->id, $data1) == false){
                        array_push($data2, $item2);
                    }
                }
            }
            //Endd
            foreach($data2 as $value2){
                $hoc_sinh_theo_lop = $this->HocSinhRepository->getHocSinhHienTai($value2->id);
                foreach($hoc_sinh_theo_lop as $hoc_sinh_theo_lop_value){
                    $array_sk = [
                        'dot_id' => $dot_id,
                        'lop_id' => $value2->id,
                        'hoc_sinh_id' => $hoc_sinh_theo_lop_value->id,
                        'chieu_cao' => 0,
                        'can_nang' => 0
                    ];
                    $this->SucKhoeRepository->InsertSucKhoeHocSinh($array_sk);
                }
            }
            $this->SucKhoeRepository->postThemDotKhamSucKhoe($array);
            // $data = redirect()->route('quan-ly-suc-khoe-index')->with('ThongBaoThemDot', 'Hoàn Thành');
            $data = "Hoàn Thành";
        }
        else if($dot_moi_nhat && $thoi_gian <= $dot_moi_nhat->thoi_gian){
            
            $data = "Lỗi Ngày";
        }
        else if(!$dot_moi_nhat){
            $this->SucKhoeRepository->postThemDotKhamSucKhoe($array);
            $data = "Hoàn Thành";
        }
            
        }
        else{
           // $data = redirect()->route('quan-ly-suc-khoe-index')->with('ThongBaoThemDotLoi', 'Lỗi thêm đợt');
           $data = "Lỗi";
        }
        return $data;
    } 
    
    public function showChiTietSucKhoe(Request $request){
        $request = $request->all();
        $hoc_sinh_id = $request['hoc_sinh_id'];
        $data = $this->SucKhoeRepository->getChiTietSucKhoe($hoc_sinh_id);
        return $data;
    }
    public function kiemtraDotMoiNhat(){
        $data = [];
        $data2 = [];
        $dot_moi_nhat = $this->SucKhoeRepository->getDotSucKhoeMoiNhat();
        if($dot_moi_nhat){
            $id = $this->NamHocRepository->maxID();
            $dot_id = $dot_moi_nhat->id;
            $suc_khoe_theo_dot = $this->SucKhoeRepository->GetSucKhoeTheoDot($dot_id);
            foreach($suc_khoe_theo_dot as $value){
                array_push($data, $value->lop_id);
            }
            $namhoc = $this->NamHocRepository->find($id);
            foreach($namhoc->khoi as $item){
                foreach($item->LopHoc as $item2){
                    if(in_array($item2->id, $data) == false){
                        array_push($data2, $item2);
                    }
                }
            }
           
            
        }
        return compact('data', 'data2');
        
        
    }

    function showXoaDot(){
        $dot_suc_khoe = $this->SucKhoeRepository->GetALLDotKhamSK();
        $arr = [];
       
            $dataSucKhoe = $this->SucKhoeRepository->getAllSucKhoeHocSinhTheoDot($dot_suc_khoe->id);
            
            if(count($dataSucKhoe) == 0){
                array_push($arr, $dot_suc_khoe);
            }
        
        return $arr;
    }

    function xoaDot(Request $request){
        $request = $request->all();
        $id = $request['id'];
        return $this->SucKhoeRepository->XoaDotSucKhoe($id);
    }
}
