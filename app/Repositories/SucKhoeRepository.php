<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Models\SucKhoe;

class SucKhoeRepository extends BaseRepository {

    protected $model;
    public function __construct(
        SucKhoe $model
    ) {
        parent::__construct();
        $this->model = $model;
    }
    public function getTable()
    {
        return 'suc_khoe';
    }
    public function getDotMoiNhatTheoNam($EndDateNamHoc)
    {   
        $query = 
        DB::table('dot_kham_suc_khoe')->where('dot_kham_suc_khoe.thoi_gian', '<=', $EndDateNamHoc)
        ->orderBy('dot_kham_suc_khoe.thoi_gian', 'desc')->limit(1)->first();
        return $query;
    }
    public function getSucKhoeHocSinhTheoLop($lop_id, $dot_id_gan_nhat)
    {
        $query = $this->table
        ->join('hoc_sinh', 'hoc_sinh.id', '=' , 'suc_khoe.hoc_sinh_id')
        ->join('lop_hoc', 'lop_hoc.id', '=', 'suc_khoe.lop_id')
        ->select(
            'hoc_sinh.ma_hoc_sinh',
            'hoc_sinh.ten', 
            'hoc_sinh.gioi_tinh', 
            'hoc_sinh.ngay_sinh', 
            'lop_hoc.ten_lop',
            'suc_khoe.*'
            )
        ->where('suc_khoe.lop_id', $lop_id)->where('suc_khoe.dot_id', $dot_id_gan_nhat)->get();
        return $query;
    }

    public function postThemDotKhamSucKhoe($array)
    {
        DB::table('dot_kham_suc_khoe')->insert($array);
    }

    public function getAllDotKhamSucKhoe($endDate, $startDate)
    {
        $query = DB::table('dot_kham_suc_khoe')
        ->where('thoi_gian', '<=', $endDate)
        ->where('thoi_gian', '>=', $startDate)
        ->orderBy('dot_kham_suc_khoe.id', 'desc')
        ->get();
        return $query;
    }

    public function getChiTietSucKhoe($hoc_sinh_id){
        $query = $this->table
        ->join('hoc_sinh', 'hoc_sinh.id', '=', 'suc_khoe.hoc_sinh_id')
        ->join('dot_kham_suc_khoe', 'dot_kham_suc_khoe.id', '=', 'suc_khoe.dot_id')
        ->join('lop_hoc', 'lop_hoc.id', '=', 'suc_khoe.lop_id')
        ->select(
            'hoc_sinh.ma_hoc_sinh', 'hoc_sinh.ten',
            'lop_hoc.ten_lop',
            'dot_kham_suc_khoe.ten_dot', 'dot_kham_suc_khoe.thoi_gian',
            'suc_khoe.*'
        )
        ->where('suc_khoe.hoc_sinh_id', $hoc_sinh_id)
        ->orderBy('suc_khoe.id', 'desc')->get();
        return $query;
    }

    public function getDotSucKhoeMoiNhat(){
        $query = DB::table('dot_kham_suc_khoe')
        ->orderBy('dot_kham_suc_khoe.id', 'desc')
        ->limit(1)->first();
        return $query;
    }

    public function GetSucKhoeTheoDot($id){
        $query = $this->table->select('suc_khoe.lop_id')->where('suc_khoe.dot_id', $id);
        // ->groupBy('suc_khoe.lop_id');
        return $query->groupBy('lop_id')->get();
    }

    public function InsertSucKhoeHocSinh($array){
        $this->table->insert($array);
    }
    
    public function GetALLDotKhamSK(){
        $query = DB::table('dot_kham_suc_khoe')->orderBy('dot_kham_suc_khoe.id', 'desc')->limit(1)->first();
        return $query;
    }

    public function getAllSucKhoeHocSinhTheoDot($dot_id){
        $query = $this->table->where('dot_id', $dot_id)->get();
        return $query;
    }

    public function XoaDotSucKhoe($dot_id){
        return DB::table('dot_kham_suc_khoe')->where('id', $dot_id)->delete();
    }
}