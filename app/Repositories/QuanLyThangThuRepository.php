<?php

namespace App\Repositories;

use App\Repositories\BaseModelRepository;
use Illuminate\Support\Facades\DB;
use App\Models\ThangThuTien;

class QuanLyThangThuRepository extends BaseModelRepository {

    protected $model;
    public function __construct(
        ThangThuTien $model
    ) {
        parent::__construct();
        $this->model = $model;
    }
    public function getModel()
    {
        return ThangThuTien::class;
    }

    public function deleteList($array)
    {
        $this->model->destroy($array);
    }

    public function kiemTraTonTaiDotThu($year , $month)
    {
       return $this->model->where('nam_thu',$year)->where('thang_thu',$month)->first();
    }

    public function getDotMoiNhatCuaNam($id_nam){
        return $this->model->where('id_nam_hoc', $id_nam)->orderBy('id', 'desc')->limit(1)->first();
    }


    

    
}