<?php

namespace App\Repositories;

use App\Repositories\BaseModelRepository;
use Illuminate\Support\Facades\DB;
use App\Models\PhamViThu;

class PhamViThuRepository extends BaseModelRepository {

    protected $model;
    public function __construct(
        PhamViThu $model
    ) {
        parent::__construct();
        $this->model = $model;
    }
    public function getModel()
    {
        return PhamViThu::class;
    }

    public function getAllPhamViThu($id)
    {
        return $this->model->where('id_khoan_thu',$id)->select('id_khoi_lop_thu')->get();
    }

    public function getAllPhamViThuBackUp($id)
    {
        return $this->model->where('id_khoan_thu',$id)->get();
    }




    

    
}