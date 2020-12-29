<?php

namespace App\Repositories;

// use App\Repositories\BaseRepository;
use App\Repositories\BaseModelRepository;

use Illuminate\Support\Facades\DB;
use App\Models\DiemDanhDen;

class DiemDanhDenRepository extends BaseModelRepository {

    protected $model;
    public function __construct(
        DiemDanhDen $model
    ) {
        parent::__construct();
        $this->model = $model;
    }
    public function getTable()
    {
        return 'diem_danh_den';
    }

    public function getModel()
    {
        return DiemDanhDen::class;
    }

    public function getHocSinhTheoLop($id)
    {
        $data = DB::table('hoc_sinh')->where('lop_id', $id)->get();
        return $data;
    }
    public function getDiemDanh($id, $ngay_diem_danh, $hoc_sinh_id){
       
        $data = DB::select("SELECT diem_danh_den.*, hoc_sinh.ma_hoc_sinh, hoc_sinh.ten 
        FROM diem_danh_den 
        JOIN hoc_sinh ON diem_danh_den.hoc_sinh_id = hoc_sinh.id
        WHERE diem_danh_den.ngay_diem_danh_den = ?
        AND diem_danh_den.lop_id = ?
        AND diem_danh_den.hoc_sinh_id = ?",
        [$ngay_diem_danh, $id, $hoc_sinh_id]);
        return $data;
    }

    public function getNgayDiemDanhTheoThang($id, $time, $hoc_sinh_id, $start_date, $end_date)
    {
        $data = DB::select(
        "SELECT ngay_diem_danh_den 
        FROM diem_danh_den 
        WHERE MONTH(diem_danh_den.ngay_diem_danh_den) = ?
        AND diem_danh_den.ngay_diem_danh_den >= ?
        AND diem_danh_den.ngay_diem_danh_den <= ?
        AND diem_danh_den.lop_id = ?
        AND diem_danh_den.hoc_sinh_id = ?
         
        GROUP BY diem_danh_den.ngay_diem_danh_den",
        [$time, $start_date, $end_date, $id, $hoc_sinh_id]);
        return $data;
    }

    public function getDataDiemDanh($ngay_diem_danh_den, $hoc_sinh_id, $lop_id)
    {
        $data = $this->model
        ->where('ngay_diem_danh_den', $ngay_diem_danh_den)
        ->where('hoc_sinh_id', $hoc_sinh_id)
        ->where('lop_id', $lop_id)
        ->get();
        return $data;
    }

    public function soNgayAnCuaHocSinhTheoThang($hoc_sinh_id, $nam, $thang)
    {
        $data = $this->model
        ->whereYear('ngay_diem_danh_den', $nam)
        ->whereMonth('ngay_diem_danh_den', $thang)
        ->where('hoc_sinh_id', $hoc_sinh_id)
        ->where('type', 1)
        ->where('trang_thai', 1)
        ->where('phieu_an', 1)
        ->count();
        // dd($data);
        return $data;
    }


    public function soBuoiHocCuaHocSinhTheoThang($hoc_sinh_id, $nam, $thang)
    {
        $data = $this->model
        ->whereYear('ngay_diem_danh_den', $nam)
        ->whereMonth('ngay_diem_danh_den', $thang)
        ->where('hoc_sinh_id', $hoc_sinh_id)
        ->where('trang_thai', 1)
        ->count();
        return $data;
    }
    
}