<?php

namespace App\Repositories;

use App\Models\LichSuHoc;
use App\Models\NamHoc;
use App\Repositories\BaseModelRepository;
use Carbon\Carbon;
use DateTime;
use DatePeriod;
use DateInterval;

class NamHocRepository extends BaseModelRepository
{
    protected $model;
    public function __construct(
        NamHoc $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getModel()
    {
        return NamHoc::class;
    }

    public function getAllNamHoc()
    {
        return $this->model::orderBy('start_date', 'desc')->get();
    }

    public function layNamHocHienTai()
    {
        return $this->model::where('type', 1)->first();
    }
    public function getNamHocCu()
    {
        return $this->model->OrderBy('id', 'desc')->offset(1)->limit(1)->get();
    }

    public function maxID()
    {
        return $this->model->max('id');
    }
    public function checkNew()
    {
        $data = $this->model::where('type', 1)->get();
        return count($data) > 0 ? 0 : 1;
    }

    public function getSlHocSinhTotNgiepTheoNam($id_nam_hoc)
    {
        $data_nam_hoc = $this->model->where('id', $id_nam_hoc)->first();
        $hoc_sinh_tn = 0;
        $khoi = $data_nam_hoc->Khoi()->where('do_tuoi', 5)->get();
        foreach ($khoi as $key => $value) {
            foreach ($value->LopHoc as $key => $lop_hoc) {
                $hocsinh = $lop_hoc->HocSinh()->where('type',3)->count();
                    $hoc_sinh_tn += $hocsinh;                
            }
        }
        return $hoc_sinh_tn;
    }

    public function hocSinhTotNghiepTheoNam($id_nam_hoc)
    {
        
        $data_nam_hoc = $this->model->where('id', $id_nam_hoc)->first();
        $khoi = $data_nam_hoc->Khoi()->where('do_tuoi', 5)->get();
        $data_hoc_sinh = [];
        foreach ($khoi as $key => $value) {
            foreach ($value->LopHoc as $key => $lop_hoc) {
                foreach ($lop_hoc->LichSuHoc as $key => $hoc_sinh) {
                    if($hoc_sinh->HocSinh->type ==3)
                    {
                        array_push($data_hoc_sinh, $hoc_sinh->HocSinh);
                    }
                   
                }
            }
        }

        return $data_hoc_sinh;
    }
    public function lock()
    {
        $data =  $this->model::where('type', 1)->update(['type' => 2]);
        return $data;
    }

    public function getEndDateNamHoc($id_nam_hoc)
    {
        return  $this->model->where('id', $id_nam_hoc)->first();
    }

    public function getNamHocTheoKhoi($khoi_id){
        $data = $this->model
        ->join('khoi', 'khoi.nam_hoc_id', '=', 'nam_hoc.id')
        ->select('nam_hoc.*')->where('khoi.id', $khoi_id)->first();
        return $data;
    }

    public function getThangNamHoc($params = [])
    {
        $start    = new DateTime($params['start_date']);
        $start->modify('first day of this month');
        $end      = new DateTime($params['end_date']);
        $end->modify('first day of next month');
        $interval = DateInterval::createFromDateString('1 month');
        $period   = new DatePeriod($start, $interval, $end);

        $array_months = [];
        foreach ($period as $dt) {
            array_push($array_months, $dt->format("m-Y"));
        }
        return $array_months;
    }

    public function getNamHoc()
    {
        return $this->model->get();
    }
}
