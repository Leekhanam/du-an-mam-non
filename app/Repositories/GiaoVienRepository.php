<?php

namespace App\Repositories;

use App\Models\GiaoVien;
use App\Repositories\BaseModelRepository;
use Illuminate\Support\Facades\DB;

class GiaoVienRepository extends BaseModelRepository
{
    protected $model;
    public function __construct(
        GiaoVien $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getTable()
    {
        return 'giao_vien';
    }
    public function getAll()
    {
        $data = $this->model
            ->get();
        return $data;
    }
    public function getAllGV_limit($params)
    {
        $data = $this->model;

        return $data->get();
    }
    public function getLopHoc($lop_id)
    {
        $data = DB::table('lop_hoc')
            ->join('khoi', 'khoi.id', '=', 'lop_hoc.khoi_id')
            ->select('lop_hoc.ten_lop', 'khoi.ten_khoi')
            ->where('lop_hoc.id', $lop_id)->first();
        return $data;
    }

    public function getModel()
    {
        return GiaoVien::class;
    }

    public function getGIaoVienChuaCoLop()
    {
        return $this->model->where('lop_id', 0)->get();
    }

    public function phanLopGiaoVienCn($id_gv, $id_lop)
    {
        return $this->model
            ->where('id', $id_gv)
            ->update(['lop_id' => $id_lop, 'type' => 1]);
    }

    public function phanLopGiaoVienPhu($id_gv, $id_lop)
    {
        return $this->model
            ->where('id', $id_gv)
            ->update(['lop_id' => $id_lop, 'type' => 2]);
    }

    public function store_gv($dataRequest)
    {
        return $this->model::insert($dataRequest);
    }
    public function removeLopGiaoVien($id_gv)
    {
        return $this->model
            ->where('id', $id_gv)
            ->update(['lop_id' => 0, 'type' => 0]);
    }

    public function xoaLopGiaoVien($id_lop)
    {
        return $this->model
            ->where('lop_id', $id_lop)
            ->update(['lop_id' => 0, 'type' => 0]);
    }

    public function getGiaoVienCuaLop($id_lop)
    {
        return $this->model
            ->where('lop_id', $id_lop)->OrderBy('type', 'asc')
            ->get();
    }

    public function getGV($id)
    {   
        $data = $this->model->where('id', $id)->first();
        return $data;
    }

    public function update_gv($id, $data)
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function destroy_gv($id)
    {
        return $this->table->where('id', $id)->delete();
    }

    public function getWhereAndWhere($whereField = [], $columns = ['*'])
    {
        $query = $this->model;
        if (count($whereField) > 0) {
            foreach ($whereField as $key => $val) {
                $query->where($key, $val);
            }
        }

        return $query->get($columns);
    }

    public function getGiaoVienInLichSuDay($id)
    {
        $query = DB::table('lich_su_day')
        ->join('giao_vien', 'giao_vien.id', '=', 'lich_su_day.giao_vien_id')
        ->select('giao_vien.*')
        ->where('lich_su_day.lop_id', $id)
        ->get();
        return $query;
    }

    public function getAllGvTheoUser(){
        $query = $this->model
        ->join('users', 'users.id', '=', 'giao_vien.user_id')
        ->select('giao_vien.*', 'users.active')
        ->where('users.active', 1)
        ->get();
        return $query;
    }
    public function getAllGvTheoUserChuaCoLop(){
        $query = $this->model
        ->join('users', 'users.id', '=', 'giao_vien.user_id')
        ->select('giao_vien.*', 'users.active')
        ->where('users.active', 1)
        ->where('giao_vien.lop_id', '<=', 0)
        ->get();
        return $query;
    }
    public function getAllGvTheoUserThoiDay(){
        $query = $this->model
        ->join('users', 'users.id', '=', 'giao_vien.user_id')
        ->select('giao_vien.*', 'users.active')
        ->where('users.active', 2)
        ->get();
       
        return $query;
    }

    public function ThoiDayGiaoVien($id){
        $query = DB::table('users')->where('id', $id)
        ->update(['active' => 2]);
    }
    public function getOneGiaoVien($id){
        $query = $this->model->where('id', $id)->first();
        return $query;
    }
    public function XoaBoLopGiaoVien($id){
        $this->model->where('id', $id)->update([
            'lop_id' => 0,
            'type' => 0
        ]);
    }
    public function PhucHoiTrangThai($id){
         DB::table('users')->where('id', $id)
        ->update(['active' => 1]);
    }

    public function LichSuDay($id){
        $query = DB::table('lop_hoc')
        ->join('lich_su_day', 'lich_su_day.lop_id', '=', 'lop_hoc.id')
        ->join('khoi', 'khoi.id', '=', 'lop_hoc.khoi_id')
        ->select('lop_hoc.ten_lop', 'lop_hoc.id as lop_id', 'khoi.ten_khoi', 'khoi.id as khoi_id', 'lich_su_day.id', 'lich_su_day.giao_vien_id')
        ->where('lich_su_day.giao_vien_id', $id)
        ->get();
        return $query;
    }

    public function LichDayHienTaiGV($id){
        $query = DB::table('lop_hoc')
        ->join('khoi', 'khoi.id', '=', 'lop_hoc.khoi_id')
        ->join('giao_vien', 'giao_vien.lop_id', '=', 'lop_hoc.id')
        ->select('lop_hoc.ten_lop', 'lop_hoc.id as lop_id', 'khoi.ten_khoi', 'khoi.id as khoi_id', 'giao_vien.id as giao_vien_id')
        ->where('giao_vien.id', $id)
        ->first();
        return $query;
    }
    
    public function getGVHienTai($lop_id){
        $query = $this->model->where('lop_id', $lop_id)->get();
        return $query;
    }
    public function getGVLichSuDay($lop_id){
        $query = DB::table('lich_su_day')
        ->join('giao_vien', 'giao_vien.id', '=', 'lich_su_day.giao_vien_id')
        ->select('giao_vien.*', 'lich_su_day.id as lich_su_day_id')
        ->where('lich_su_day.lop_id', $lop_id)->get();
        return $query;
        
    }
    public function getAllUserIdGiaoVien()
    {
        $listId_Gv = $this->model->select('user_id')->get();
        foreach ($listId_Gv as $key => $value) {
            $listId_Gv[$key] = $value->user_id;
        }
        return $listId_Gv;
    }

}
