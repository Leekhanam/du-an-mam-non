<?php

namespace App\Repositories;

use App\Repositories\BaseModelRepository;
use Illuminate\Support\Facades\DB;
use App\Models\HocSinh;
use App\Models\NamHoc;
use Carbon\Carbon;

class HocSinhRepository extends BaseModelRepository
{
    protected $model;
    public function __construct(
        HocSinh $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getModel()
    {
        return HocSinh::class;
    }

    public function getAllHocSinh(){
  		return  $this->model->all();
    }

    public function getMaxId(){
  		return  $this->model->max('id');
    }

    public function createHocSinh($arrayData)
    {
        return $this->model->create($arrayData);
    }

    public function updateHocSinh($key, $arrayData)
    {
        return $this->model->where('id', $key)->update($arrayData);
    }

    public function getOneHocSinh($id)
    {
        return  $this->model->where('id', '=', $id)->first();
    }

    public function getHocSinhByIdTk($id)
    {
        return  $this->model->where('user_id', '=', $id)->get();
    }

    public function xoaLopHocSinh($lop_id)
    {
        return  $this->model->where('lop_id', $lop_id)->update(['lop_id' => 0]);
    }

    public function getHocSinhCuaLop($lop_id,$params)
    {
        $queryBulder = $this->model::query();
        $queryBulder->where('lop_id', '=', $lop_id);
        if (isset($params['gioi_tinh']) && $params['gioi_tinh'] != null) {
            $queryBulder->where('gioi_tinh', '=', $params['gioi_tinh']);
        }
        return $queryBulder->OrderBy('created_at','desc')->get();
    }

    public function getHocSinh()
    {
        return  $this->model->select('ten','ma_hoc_sinh','gioi_tinh','avatar','tuoi','lop_id')->paginate(10);
    }
    public function getAllHocSinh_table($params, $limit)
    {
        $data = $this->table;
        return $data->paginate($limit);
    }

    public function getAllHocSinhChuaCoLop($gioi_tinh){
        return  $this->model->where('lop_id',0)->where('type','<',2)->where('gioi_tinh',$gioi_tinh)->count();
    }

    public function getSlHocSinhType($type){
        return  $this->model->where('lop_id',0)->where('type',$type)->count();
    }


    public function getDataHocSinhChuaCoLop($type,$nam_hoc){

        return  $this->model->select('*')->selectRaw('(YEAR(?) - YEAR(ngay_sinh)) as age',[$nam_hoc->start_date])->where('lop_id',0)->where('type',$type)->get();
    }

    public function xepLopTuDong($id_lop,$do_tuoi,$gioi_tinh,$sl_hs,$nam_hoc)
    {
        return $this->model
        ->whereRaw('(YEAR(?) - YEAR(ngay_sinh))= ? ',[$nam_hoc->start_date,$do_tuoi])
        ->where("lop_id",0)->where('gioi_tinh',$gioi_tinh)
        ->orderBy('created_at')
        ->limit($sl_hs)
        ->update(["lop_id" => $id_lop]);
    }

    public function getHocSinhChuaCoLopTheoDoTuoi($tuoi,$gioi_tinh,$nam_hoc)
    {
        // $startdate = new Carbon( $nam_hoc->start_date );
        // // dd(Carbon::now()->year);
        // if($startdate->year == Carbon::now()->year){
        //     if(Carbon::parse($nam_hoc->start_date)->gt(Carbon::now())){
        //         $tuoi = $tuoi - 1;
        //     }
        // }
        // dd(Carbon::createFromFormat('Y-m-d H:i:s', $$nam_hoc->start_date)->year);
       
        return $this->model
        ->whereRaw('(YEAR(?) - YEAR(ngay_sinh))= ? ',[$nam_hoc->start_date,$tuoi])
        ->where('gioi_tinh',$gioi_tinh)
        ->where("lop_id",0)
        ->where("type",'<',2)
        ->count();
    }

    public function chuyenLop($lop_id,$id_hs_chuyen_lop)
    {
       return $this->model->whereIn('id',$id_hs_chuyen_lop)->update(['lop_id'=>$lop_id,'type'=>1]);
    }

    public function updateHocSinhTn($id_lop,$data)
    {
        return $this->model->where('lop_id',$id_lop)->update($data);
    }

    public function getTuoiHocSinh($id_hs,$nam_hoc)
    {
        return $this->model->selectRaw('(YEAR(?) - YEAR(ngay_sinh)) as tuoi',[$nam_hoc->start_date])->where('id',$id_hs)->get();
    }

    public function getHocSinhLichSuHoc($lop_id){
        $query = $this->model
        ->join('lich_su_hoc', 'lich_su_hoc.hoc_sinh_id', '=', 'hoc_sinh.id')
        ->select('hoc_sinh.*')->where('lich_su_hoc.lop_id', $lop_id)->get();
        return $query;
    }

    public function getHocSinhHienTai($lop_id){
        $query = $this->model->where('lop_id', $lop_id)->get();
        return $query;

    }
    public function getAllHocSinhTrongNamHocHienTai()
    {
        $data = [];
        $listKhoi = NamHoc::where('type', 1)->first();
        if(!$listKhoi){
            return $data;
        }
        $listKhoi = $listKhoi->Khoi;
        foreach($listKhoi as $khoi){
            foreach($khoi->LopHoc as $lop_hoc){
                foreach($lop_hoc->HocSinh as $hoc_sinh){
                    array_push($data, $hoc_sinh);
                }
            }
        }
        return $data;
    }
    
    public function getLichSuCuaHocSinh($hoc_sinh_id){
        $query = $this->model
        ->join('lich_su_hoc', 'lich_su_hoc.hoc_sinh_id', '=', 'hoc_sinh.id')
        ->join('lop_hoc', 'lop_hoc.id', '=', 'hoc_sinh.lop_id')
        ->select('hoc_sinh.*', 'lop_hoc.ten_lop', 'lich_su_hoc.lop_id as lich_su_lop_id')->where('lich_su_hoc.hoc_sinh_id', $hoc_sinh_id)
        ->get();
        return $query;
    }

    public function getHocSinhTheoNgayVaoTruong($start_date, $end_date){
        $query = $this->model
        ->where('hoc_sinh.ngay_vao_truong', '<=', $end_date)
        ->where('hoc_sinh.ngay_vao_truong', '>=', $start_date);
        return $query->get();
    }

    public function ThayDoiChinhSachHocSinh($id, $type){
        return $this->model->where('hoc_sinh.id', $id)->update(['doi_tuong_chinh_sach' => $type]);
    }
}
