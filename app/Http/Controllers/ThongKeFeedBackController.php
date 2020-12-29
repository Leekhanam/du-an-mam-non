<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Repositories\LopHocRepository;
use \App\Repositories\KhoiRepository;
use \App\Repositories\GiaoVienRepository;
use App\Repositories\NamHocRepository;
use App\Repositories\ThongKeFeedBackRepository;
use Carbon\Carbon;

class ThongKeFeedBackController extends Controller
{   
    protected $LopHocRepository;
    protected $KhoiRepository;
    protected $GiaoVienRepository;
    protected $NamHocRepository;
    protected $ThongKeFeedBackRepository;

    public function __construct(
        
        LopHocRepository $LopHocRepository,
        KhoiRepository $KhoiRepository,
        GiaoVienRepository $GiaoVienRepository,
        NamHocRepository $NamHocRepository,
        ThongKeFeedBackRepository $ThongKeFeedBackRepository

    ) {
       
       $this->LopHocRepository = $LopHocRepository;
       $this->KhoiRepository = $KhoiRepository;
       $this->GiaoVienRepository = $GiaoVienRepository;
       $this->NamHocRepository = $NamHocRepository;
       $this->ThongKeFeedBackRepository = $ThongKeFeedBackRepository;
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
        $id_nam_hoc = $id;
        $namhoc->khoi = $namhoc->Khoi;
        foreach($namhoc->khoi as $key => $item){
            $countTongFeedBack = 0;
            $LopHoc = $item->LopHoc;
        
            $item->lophoc= $LopHoc;
            foreach($item->lophoc as $key2 => $item2)
            {   
                $data = $this->ThongKeFeedBackRepository->ThongKeFeedBackTheoLop($item2->id);   
                $countFeedBack = count($data);
               
                $LopHoc[$key2]->count = $countFeedBack;
                $countTongFeedBack+=$countFeedBack;
                
            }
            
            $namhoc->khoi[$key]->countTongFeedBack = $countTongFeedBack;
            
        }
       
        return view('quan-ly-feed-back.index', compact('khoi', 'giao_vien', 'namhoc', 'id_nam_hoc', 'getAllNamHoc'));
    }

    public function ShowFeedBackCuaLop(Request $request)
    {
        $request = $request->all();
        $feedback_id = 0;
        if(isset($request['feedback_id'])){
            $feedback_id = $request['feedback_id'];
        }
        $lop_id = $request['lop_id'];
        $dataFeedBack = $this->ThongKeFeedBackRepository->ShowFeedBackCuaLop($lop_id, $feedback_id);
        $lophoc = $this->LopHocRepository->getKhoiTheoLop($lop_id);
        $trangthai_namhoc = $this->KhoiRepository->getNamHocTheoKhoi($lophoc->khoi_id);
        if($trangthai_namhoc == 1){
            $dataGiaoVien = $this->GiaoVienRepository->getGiaoVienCuaLop($lop_id);
        }
        else{
            $dataGiaoVien = $this->GiaoVienRepository->getGiaoVienInLichSuDay($lop_id);
        }
        
        return 
        [
            'dataGiaoVien' => $dataGiaoVien,
            'dataFeedBack' => $dataFeedBack
        ];
    }
    public function ThayDoiTrangThaiFeedBack(Request $request)
    {
        $request = $request->all();
        $feedback_id = $request['id'];
        $this->ThongKeFeedBackRepository->ThayDoiTrangThaiFeedBack($feedback_id);
    }
    public function FeedBackChuaXemCuaLop(Request $request)
    {
        $request = $request->all();
        $lop_id = $request['lop_id'];
        $data = $this->ThongKeFeedBackRepository->ThayDoiTrangThaiTatCaFeedBackTheoLop($lop_id);
        foreach($data as $item){
            $this->ThongKeFeedBackRepository->ThayDoiTrangThaiFeedBack($item->id);
        }
        return $data;
    }
    public function GetGiaoVienFeedBack(Request $request)
    {
        $request = $request->all();
        dd($request['lop_id']);
        $khoi_id = $this->LopHocRepository->getKhoiTheoLop($request['lop_id']);
        dd($khoi_id);
    }
}
