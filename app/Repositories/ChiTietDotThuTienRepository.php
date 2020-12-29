<?php

namespace App\Repositories;

use App\Repositories\BaseModelRepository;
use Illuminate\Support\Facades\DB;
use App\Models\ChiTietDotThuTien;

class ChiTietDotThuTienRepository extends BaseModelRepository {
    protected $model;
    public function __construct(
        ChiTietDotThuTien $model
    ) {
        parent::__construct();
        $this->model = $model;
    }
    public function getModel()
    {
        return ChiTietDotThuTien::class;
    }
    public function getAllChiTietDotThuHS($id){
        $query = $this->model
        ->join('danh_sach_thu_tien', 'danh_sach_thu_tien.id_chi_tiet_dot_thu', '=', 'chi_tiet_dot_thu.id')
        ->join('thang_thu_tien', 'thang_thu_tien.id', '=', 'chi_tiet_dot_thu.id_thang_thu_tien')
        ->select(
            'chi_tiet_dot_thu.ten_dot_thu',
            'thang_thu_tien.thang_thu',
            'thang_thu_tien.nam_thu',
            'thang_thu_tien.id_nam_hoc',
            'danh_sach_thu_tien.*'
        )
        ->where('danh_sach_thu_tien.id_hoc_sinh', $id)
        ->get();
        return $query;
    }
}