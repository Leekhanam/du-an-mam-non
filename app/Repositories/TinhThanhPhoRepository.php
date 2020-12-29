<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Models\TinhThanhPho;
class TinhThanhPhoRepository extends BaseRepository
{
    protected $model;
    public function __construct(
        TinhThanhPho $model
    ){
        parent::__construct();
        $this->model = $model;
    }

    public function getTable()
    {
        return 'devvn_tinhthanhpho';
    }

    public function getAllThanhPho(){
        return  $this->model->get();
    }

}