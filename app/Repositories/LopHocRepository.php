<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Models\Lop;
class LopHocRepository extends BaseRepository
{
    protected $model;
    public function __construct(
        Lop $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getTable()
    {
        return 'lop_hoc';
    }

    public function getAllLopHoc(){
        dd($this->model->get());
  		return  $this->model->get();
    }

    public function getLopHocOfKhoi($id){
	  	return  $this->model->where('khoi_id','=',$id)->get();
    }

    public function getOneLop($id){
	  	return  $this->model->where('id','=',$id)->first();
    }

    public function getOneKhoiTheoLop($lop_id)
    {
        $data = $this->table
        ->join('khoi', 'khoi.id', '=', 'lop_hoc.khoi_id')
        ->select('khoi.ten_khoi', 'khoi.id', 'lop_hoc.ten_lop')
        ->where('lop_hoc.id', $lop_id);
        return $data->first();
    }
    public function getKhoiTheoLop($lop_id)
    {
        $data = $this->model
        ->where('lop_hoc.id', $lop_id)->first();
        return $data;
    }
    public function getLopHoc(){
        $data = $this->table->get();
        return $data;
    }
    
    


    
  
}