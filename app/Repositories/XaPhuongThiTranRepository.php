<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Models\XaPhuongThiTran;
class XaPhuongThiTranRepository extends BaseRepository
{
    protected $model;
    public function __construct(
        XaPhuongThiTran $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getTable()
    {
        return 'devvn_xaphuongthitran';
    }

    public function getXaPhuongThiTranByMaPh($maqh){
        return  $this->model->where('maqh','=',$maqh)->get();
    }

    public function getOneXaPhuong($xaid){
        return  $this->model->where('xaid','=',$xaid)->first();
    }

    public function getAllXaPhuongThiTran(){
        return $this->model->get();
    }

}