<?php

namespace App\Repositories;

use App\Models\HoatDong;
use App\Repositories\BaseModelRepository;


class HoatDongRepository extends BaseModelRepository
{
    protected $model;
    public function __construct(
        HoatDong $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getModel()
    {
        return HoatDong::class;
    }

    public function getTable()
    {
        return 'hoat_dong';
    }
    public function getHoatDongByIdLop($lop_id){
        return $this->model->where('lop_id',$lop_id)->get();
    }
    public function getNamOfHoatDongInLop($lop_id){
        return $this->model->where('lop_id',$lop_id)->select('nam')->groupBy('nam')->get();
    }

    public function showGiaoTrinhTheoLop($tuan,$id_lop,$id_nam_hoc)
    {
        return $this->model->where('lop_id',$id_lop)->where('tuan',$tuan)->where('id_nam_hoc',$id_nam_hoc)->first();
    }

    public function getTuanMoiNhatHT($nam_id)
    {
        return $this->model->where('id_nam_hoc', $nam_id)->max('tuan');
    }

    public function getDanhHoatDong($nam_id, $tuan){
        return $this->model->where('id_nam_hoc', $nam_id)->where('tuan', $tuan)->get();
    }
}
