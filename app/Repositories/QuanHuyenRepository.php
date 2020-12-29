<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Models\QuanHuyen;
class QuanHuyenRepository extends BaseRepository
{
    protected $model;
    public function __construct(
        QuanHuyen $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getTable()
    {
        return 'devvn_quanhuyen';
    }

    public function getQuanHuyenByMaTp($matp){
        
        return  $this->model->where('matp','=',$matp)->get();
        
    }

    public function getOneQuanHuyen($maqh){
        return  $this->model->where('maqh','=',$maqh)->first();
    }
    public function getAllQuanHuyen()
    {
        return $this->model->get();
    }

}