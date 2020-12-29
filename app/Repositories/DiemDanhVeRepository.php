<?php

namespace App\Repositories;

use App\Repositories\BaseModelRepository;
use Illuminate\Support\Facades\DB;
use App\Models\DiemDanhVe;

class DiemDanhVeRepository extends BaseModelRepository {

    protected $model;
    public function __construct(
        DiemDanhVe $model
    ) {
        parent::__construct();
        $this->model = $model;
    }
    public function getTable()
    {
        return 'diem_danh_ve';
    }

    public function getModel()
    {
        return DiemDanhVe::class;
    }
    
    public function soNgayVaoLopTraMuonTheoThang($hoc_sinh_id, $nam, $thang)
    {
        $data = $this->model
        ->whereYear('ngay_diem_danh_ve', $nam)
        ->whereMonth('ngay_diem_danh_ve', $thang)
        ->where('hoc_sinh_id', $hoc_sinh_id)
        ->where('trang_thai', 4)
        ->count();
        return $data;
    }

    public function thongKeSoLieu($params)
    {
        $data = $this->model->where('hoc_sinh_id', $params['hoc_sinh_id'])
                            ->whereYear('ngay_diem_danh_ve', '=', $params['year'])
                            ->whereMonth('ngay_diem_danh_ve', '=', $params['month'])
                            ->select('hoc_sinh_id', 'trang_thai')
                            ->get();
        $trang_thai_1 = $trang_thai_2 = $trang_thai_3 = $trang_thai_4 = 0; 
        foreach($data as $value){
            $trang_thai_1 += $value->trang_thai == 1 ? : 0; 
            $trang_thai_2 += $value->trang_thai == 2 ? : 0; 
            $trang_thai_3 += $value->trang_thai == 3 ? : 0; 
            $trang_thai_4 += $value->trang_thai == 4 ? : 0; 
        }
        return [
            'trang_thai_1' => $trang_thai_1,
            'trang_thai_2' => $trang_thai_2,
            'trang_thai_3' => $trang_thai_3,
            'trang_thai_4' => $trang_thai_4,
        ];
    }
}