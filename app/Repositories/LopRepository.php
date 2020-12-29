<?php

namespace App\Repositories;

use App\Repositories\BaseModelRepository;
use App\Models\Lop;

class LopRepository extends BaseModelRepository
{
  protected $model;
  public function __construct(
    Lop $model
  ) {
    parent::__construct();
    $this->model = $model;
  }

  public function getModel()
  {
    return Lop::class;
  }

  public function addLop($data)
  {
    return  $this->model::create($data);
  }

  public function getAllPhanTrang($params)
  {
    $queryBulder = $this->model::query();

    if (isset($params['khoi']) && $params['khoi'] != null) {
      $queryBulder->where('khoi_id', '=', $params['khoi']);
    }
    if (isset($params['keyword']) && $params['keyword'] != null) {
      $queryBulder->where('ten_lop', 'like', '%' . $params['keyword'] . '%');
    }
    if (isset($params['keyword']) && $params['keyword'] != null) {
      $queryBulder->where('ten_lop', 'like', '%' . $params['keyword'] . '%');
    }
    if (isset($params['keyword']) && $params['keyword'] != null) {
      $queryBulder->where('ten_lop', 'like', '%' . $params['keyword'] . '%');
    }
    return $queryBulder->OrderBy('created_at', 'desc')->paginate($params['limit']);
  }
}
