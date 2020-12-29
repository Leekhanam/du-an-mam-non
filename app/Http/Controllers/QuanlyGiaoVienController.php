<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\GiaoVienRepository;
use App\Repositories\KhoiRepository;
use App\Repositories\LopHocRepository;
use App\Repositories\QuanHuyenRepository;
use App\Repositories\TinhThanhPhoRepository;
use App\Repositories\XaPhuongThiTranRepository;
use App\Http\Requests\ValidateCreateQuanLiGV;
use App\Repositories\AccountRepository;
use Storage;
use App\Http\Requests\GiaoVien\StoreGiaoVien;
use App\Repositories\NamHocRepository;
use App\Http\Requests\GiaoVien\UpdateGiaoVien;

use App\Http\Requests\GiaoVien\ValidateUpdateGV;
class QuanlyGiaoVienController extends Controller
{
    protected $KhoiRepository;
    protected $GiaoVienRepository;
    protected $LopHocRepository;
    protected $TinhThanhPhoRepository;
    protected $QuanHuyenRepository;
    protected $XaPhuongThiTranRepository;
    protected $AccountRepository;
    protected $NamHocRepository;
    public function __construct(
        GiaoVienRepository $GiaoVienRepository,
        KhoiRepository $KhoiRepository,
        LopHocRepository $LopHocRepository,
        TinhThanhPhoRepository $TinhThanhPhoRepository,
        QuanHuyenRepository $QuanHuyenRepository,
        XaPhuongThiTranRepository $XaPhuongThiTranRepository,
        AccountRepository $AccountRepository,
        NamHocRepository $NamHocRepository
    ) {
        $this->GiaoVienRepository = $GiaoVienRepository;
        $this->KhoiRepository = $KhoiRepository;
        $this->LopHocRepository = $LopHocRepository;
        $this->TinhThanhPhoRepository = $TinhThanhPhoRepository;
        $this->QuanHuyenRepository = $QuanHuyenRepository;
        $this->XaPhuongThiTranRepository = $XaPhuongThiTranRepository;
        $this->AccountRepository = $AccountRepository;
        $this->NamHocRepository = $NamHocRepository;
    }
    public function index()
    {

        $params = request()->all();
        
        $data = $this->GiaoVienRepository->getAllGvTheoUser();
        $countAllGV = count($data);
        $data2 = $this->GiaoVienRepository->getAllGvTheoUserChuaCoLop();
        $countAllGVChuaCoLop = count($data2);
        $data3 = $this->GiaoVienRepository->getAllGvTheoUserThoiDay();
        $countAllGvTheoUserThoiDay = count($data3);
        $khoi = $this->KhoiRepository->getAll();
        $lop = $this->LopHocRepository->getAll();
        foreach ($data as $key => $item) {
            $data2 = $this->GiaoVienRepository->getLopHoc($item->lop_id);

            if (isset($data2)) {
                $data[$key]->ten_lop = $data2->ten_lop;
                $data[$key]->ten_khoi = $data2->ten_khoi;
            } else {
                $data[$key]->ten_lop = "";
                $data[$key]->ten_khoi = "";
            }
        }
        
        return view('quan-ly-giao-vien.index', compact('data', 'khoi', 'lop', 'countAllGV', 'countAllGVChuaCoLop', 'countAllGvTheoUserThoiDay'));
    }

    public function create()
    {
        $khoi = $this->KhoiRepository->getAll();
        $lop = $this->LopHocRepository->getAll();
        $thanhpho = $this->TinhThanhPhoRepository->getAllThanhPho();
        return view('quan-ly-giao-vien.create', compact('khoi', 'lop', 'thanhpho'));
    }
    public function store(StoreGiaoVien $request)
    {
        $request['role'] = 2;
        $request['name'] = $request['ten'];
        $request['phone_number'] = $request['dien_thoai'];
        $user = $this->AccountRepository->storeAcountGV($request->all());
        $dataRequest = $request->all();
        $dataRequest['user_id'] = $user->id;
        unset($dataRequest['phone_number']);
        unset($dataRequest['role']);
        unset($dataRequest['name']);
        unset($dataRequest['_token']);
        unset($dataRequest['khoi']);
        $dataRequest['ma_gv'] = 'GV' . 
        random_int(0,9).random_int(0,9).random_int(0,9).
        random_int(0,9).random_int(0,9).random_int(0,9);
        $this->GiaoVienRepository->store_gv($dataRequest);
        return redirect()->route('quan-ly-giao-vien-index')->with('thong_bao', 'Hoàn thành');
    }
    public function getLopTheoKhoi(Request $request)
    {
        $data = [];
        $id = $request->id;
        if ($id == 0) {
            $data = $this->LopHocRepository->getAll();
        } else {
            $data = $this->LopHocRepository->getLopHocOfKhoi($id);
        }

        return $data;
    }
    public function edit($id)
    {   
        $data = $this->GiaoVienRepository->getGV($id);
        $khoi = $this->KhoiRepository->getAllKhoi();
        $lop_hoc = $this->LopHocRepository->getAll();
        $khoi_gv = $this->LopHocRepository->getOneKhoiTheoLop($data->lop_id);
        if($khoi_gv){
            $data->khoi_gv_id = $khoi_gv->id;
        }
        else{
            $data->khoi_gv_id = 0;
        }
        
        $thanhpho = $this->TinhThanhPhoRepository->getAllThanhPho();
        $maqh_gv_hktt = $this->QuanHuyenRepository->getQuanHuyenByMaTp($data->ho_khau_thuong_tru_matp);
        $xaid_gv_hktt = $this->XaPhuongThiTranRepository->getXaPhuongThiTranByMaPh($data->ho_khau_thuong_tru_maqh);
        $maqh_gv_noht = $this->QuanHuyenRepository->getQuanHuyenByMaTp($data->noi_o_hien_tai_matp);
        $xaid_gv_noht = $this->XaPhuongThiTranRepository->getXaPhuongThiTranByMaPh($data->noi_o_hien_tai_maqh);
        //Lịch sử dạy
        $LichSuDay = $this->GiaoVienRepository->LichSuDay($id);
        $LichDayHienTaiGV = $this->GiaoVienRepository->LichDayHienTaiGV($id);
        
        if($LichDayHienTaiGV)
        {
            $nam_hoc_ht = $this->KhoiRepository->getNamHoc($LichDayHienTaiGV->khoi_id);
            $LichDayHienTaiGV->ten_nam = $nam_hoc_ht->name;
        } 
        
        if(count($LichSuDay) >0 || $LichSuDay){
            foreach($LichSuDay as $key => $item){
                $nam_hoc = $this->KhoiRepository->getNamHoc($item->khoi_id);
                $LichSuDay[$key]->ten_nam = $nam_hoc->name;
            }
           
        }
        
        return view('quan-ly-giao-vien.edit', compact(
            'data',
            'khoi',
            'lop_hoc',
            'thanhpho',
            'maqh_gv_hktt',
            'xaid_gv_hktt',
            'maqh_gv_noht', 
            'xaid_gv_noht',
            'LichSuDay' ,
            'LichDayHienTaiGV'
        ));
    }
    public function update(UpdateGiaoVien $request, $id)
    {   
        $dataRequest = $request->all();
        unset($dataRequest['_token']);
        $user_id = $this->GiaoVienRepository->find($id)->user_id;
        $data_update_account = [
            'name' => $dataRequest['ten'],
            'avatar' => $dataRequest['anh'],
            'email' => $dataRequest['email'],
            'phone_number' => $dataRequest['dien_thoai']
        ];
        $this->AccountRepository->updateAccountGiaoVien($user_id, $data_update_account);
        $this->GiaoVienRepository->update_gv($id, $dataRequest);
        return redirect()->route('quan-ly-giao-vien-edit', ['id' => $id])->with('thong_bao', 'Hoàn thành');
    }

    public function destroy(Request $request)
    {
        $data = $request->all();
        $this->GiaoVienRepository->destroy_gv($data['id']);
        return redirect()->route('quan-ly-giao-vien-index')->with('thong_bao', 'Hoàn thành');
    }

    public function getGiaoVienChuaCoLop()
    {
        return $this->GiaoVienRepository->getGIaoVienChuaCoLop();
    }

    public function phanLopChoGiaoVien(Request $request)
    {
        $id_nam_hien_tai = $this->NamHocRepository->maxID();
        if ($request->session()->has('id_nam_hoc')) {
            $id = $request->session()->get('id_nam_hoc');
        } else {
            $id = $this->NamHocRepository->maxID();
        }
        // dd($id);
        $nam_hoc_moi = $this->NamHocRepository->find($id);
        $khoi = $nam_hoc_moi->Khoi;

        // dd($khoi);

        $lop = [];
        foreach ($khoi as $key => $value) {
            array_push($lop, $value->LopHoc);
        }
        // dd($lop);
        $collection = collect($lop);
        $data_lop = $collection->collapse();
        $data_lop->all();
        if ($request->session()->has('id_nam_hoc') && $request->session()->get('id_nam_hoc') != $id_nam_hien_tai) {
            $giao_vien = [];
            foreach ($data_lop as $key => $value) {
                array_push($giao_vien, $value->LichSuDay);
            }
            $collection = collect($giao_vien);
            $data_giao_vien = $collection->collapse();
            $data_giao_vien->all();
            $data_giao_vien->map(function ($giaovien) {
                $giaovien->ten = $giaovien->GiaoVien->ten;
                $giaovien->ma_gv = $giaovien->GiaoVien->ma_gv;
                return $giaovien;
            });
        } else {
            $data_giao_vien = $this->GiaoVienRepository->getAllGvTheoUser();
        }
        // dd($data_lop,$data_giao_vien);
        return view('quan-ly-giao-vien.phan_lop', compact('data_lop', 'data_giao_vien','id_nam_hien_tai'));
    }

    public function storePhanLopChoGiaoVien(Request $request)
    {
        $data_phan_lop = $request->all();
        foreach ($data_phan_lop as $key => $value) {
            $this->GiaoVienRepository->update($value['id'], ['lop_id' => $value['lop_id'], 'type' => $value['type']]);
        }
        return 'thành công';
    }

    public function getAllGiaoVienChuaCoLop(){
        $data = $this->GiaoVienRepository->getAllGvTheoUserChuaCoLop();
        foreach ($data as $key => $item) {
            $data2 = $this->GiaoVienRepository->getLopHoc($item->lop_id);
            $data[$key]->ngay_sinh = date("d/m/Y", strtotime($item->ngay_sinh));
            if (isset($data2)) {
                $data[$key]->ten_lop = $data2->ten_lop;
                $data[$key]->ten_khoi = $data2->ten_khoi;
            } else {
                $data[$key]->ten_lop = "";
                $data[$key]->ten_khoi = "";
            }
            if($item->anh == ""){
                $data[$key]->anh = "https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_960_720.png";
            }
            else{
                $data[$key]->anh = $item->anh;
            }
        }
        
        return $data;
    }

    public function getGiaoVienNghiDay(){
        $data = $this->GiaoVienRepository->getAllGvTheoUserThoiDay();
        foreach ($data as $key => $item) {
            $data[$key]->ngay_sinh = date("d/m/Y", strtotime($item->ngay_sinh));
            $data[$key]->thoi_gian = date("d/m/Y", strtotime($item->thoi_gian));
            if($item->anh == ""){
                $data[$key]->anh = "https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_960_720.png";
            }
            else{
                $data[$key]->anh = $item->anh;
            }
        }
        return $data;
    }

    public function ThoiDayGiaoVien(Request $request){
        $request = $request->all();
        $gv_id = $request['gv_id'];
        $this->GiaoVienRepository->XoaBoLopGiaoVien($gv_id);
        $giao_vien = $this->GiaoVienRepository->getOneGiaoVien($gv_id);
        $user_id = $giao_vien->user_id;
        $this->GiaoVienRepository->ThoiDayGiaoVien($user_id);
    }
    
    public function KhoiPhucThoiDay(Request $request){
        $request = $request->all();
        $gv_id = $request['id'];
        $giao_vien = $this->GiaoVienRepository->getOneGiaoVien($gv_id);
        $user_id = $giao_vien->user_id;
        $this->GiaoVienRepository->PhucHoiTrangThai($user_id);
        
    }
}
