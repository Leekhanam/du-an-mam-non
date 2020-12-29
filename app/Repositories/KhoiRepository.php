<?php

namespace App\Repositories;

use App\Models\Khoi;
use App\Repositories\BaseModelRepository;
use Illuminate\Support\Facades\DB;

class KhoiRepository extends BaseModelRepository
{
    protected $model;
    public function __construct(
        Khoi $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getModel()
    {
        return Khoi::class;
    }

    public function getAllKhoi()
    {
        return $this->model->orderBy('do_tuoi','asc')->get();
    }

    // public function getAll()
    // {
    //     $data = $this->table->get();
    //     return $data;
    // }
    public function LopHoc($khoi_id)
    {
        $data = DB::table('lop_hoc')

            ->where('khoi_id', $khoi_id)
            ->get();

        return $data;
    }
    public function HocSinh($lop_id)
    {
        $data = DB::table('hoc_sinh')
            ->where('lop_id', $lop_id)
            ->get();
        return $data;
    }

    public function post_create($arr)
    {
        return $this->model::create($arr)->id;
    }
    public function destroy($id)
    {
        return $this->model::where('id', $id)->delete();
    }

    public function store($arr, $id)
    {unset($arr['_token']);
        return $this->model::where('id', $id)->update($arr);
    }
    public function getNamHocTheoKhoi($khoi_id)
    {
        $data = DB::table('khoi')->join('nam_hoc', 'nam_hoc.id', '=', 'khoi.nam_hoc_id')
        ->select('nam_hoc.type')->where('khoi.id', $khoi_id)->first();
        return $data->type;
    }
    public function getKhoiTheoNamHoc($nam_hoc_id){
        $data = $this->model->where('nam_hoc_id', $nam_hoc_id)->get();
        return $data;
    }
    public function getNamHoc($khoi_id){
        $data = DB::table('nam_hoc')
        ->join('khoi', 'khoi.nam_hoc_id', '=', 'nam_hoc.id')
        ->select('nam_hoc.*')->where('khoi.id', $khoi_id)->first();
        return $data;

    }

    public function getArrayKhoi($khoi_id){
        $data = $this->model->where('id',$khoi_id)->get();
        return $data;

    }

}
