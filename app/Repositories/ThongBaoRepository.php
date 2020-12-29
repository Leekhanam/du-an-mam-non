<?php

namespace App\Repositories;
use App\Repositories\BaseModelRepository;
use App\Models\ThongBao;

class ThongBaoRepository extends BaseModelRepository
{
    protected $model;
    public function __construct(
        ThongBao $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getModel()
    {
        return ThongBao::class;
    }

}
