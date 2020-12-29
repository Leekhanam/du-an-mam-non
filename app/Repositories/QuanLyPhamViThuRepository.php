<?php

namespace App\Repositories;

use App\Repositories\BaseModelRepository;
use Illuminate\Support\Facades\DB;
use App\Models\PhamViThu;

class QuanLyPhamViThuRepository extends BaseModelRepository {

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

    public function deletePhamViThu($id)
    {
        return $this->model->where('id_khoan_thu',$id)->delete();
    }


    
}