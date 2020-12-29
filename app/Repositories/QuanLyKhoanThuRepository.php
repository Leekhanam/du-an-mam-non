<?php

namespace App\Repositories;

use App\Repositories\BaseModelRepository;
use Illuminate\Support\Facades\DB;
use App\Models\KhoanThu;

class QuanLyKhoanThuRepository extends BaseModelRepository {

    protected $model;
    public function __construct(
        KhoanThu $model
    ) {
        parent::__construct();
        $this->model = $model;
    }
    public function getModel()
    {
        return KhoanThu::class;
    }

    public function deleteList($array)
    {
        $this->model->destroy($array);
    }

    public function getKhoanThuTheoDoi()
    {
       return $this->model->where('theo_doi',1)->where('id_dot_thu_tien',0)->get();
    }

    public function getAllKhoanThu()
    {
       return $this->model->where('id_dot_thu_tien',0)->orderBy('mac_dinh','desc')->get();
    }

    public function capNhatKhoanThuCuaDot($data,$id_dot_thu_tien)
    {
        return $this->model->whereIn('id',$data)->update(['id_dot_thu_tien'=>$id_dot_thu_tien]);
    }

    public function getKhoanThuTheoChiTietDot($id_dot_thu_tien)
    {
        return $this->model->where('id_dot_thu_tien',$id_dot_thu_tien)->orderBy('id','desc')->get();
    }



    

    
}