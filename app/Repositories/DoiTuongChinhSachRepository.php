<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Models\DoiTuongChinhSach;
class DoiTuongChinhSachRepository extends BaseRepository
{
    protected $model;
    public function __construct(
        DoiTuongChinhSach $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getTable()
    {
        return 'doi_tuong_chinh_sach';
    }

    public function getAllDoiTuongChinhSach(){
  		return  $this->model->get();
    }

    public function getOne($id){
  		return  $this->model->where('id',$id)->get();
    }

    public function ThemChinhSach($array){
        return $this->model->insert($array);
    }

    public function XoaMotChinhSach($id){
        return $this->model->where('id', $id)->delete();
    }
    
    public function GetMotDienUuTien($id){
        return $this->model->find($id);
    }
    public function ChinhSuaChinhSach($array, $id){
        return $this->model->where('id', $id)->update($array);
    }
  
}