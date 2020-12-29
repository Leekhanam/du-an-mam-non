<?php

namespace App\Repositories;

use App\Repositories\BaseModelRepository;
use Illuminate\Support\Facades\DB;
use App\Models\HocSinhDangKyNhapHoc;
class DangKiNhapHocRepository extends BaseModelRepository
{
    protected $model;
    public function __construct(
        HocSinhDangKyNhapHoc $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getModel()
    {
        return HocSinhDangKyNhapHoc::class;
    }

    public function getTable()
    {
        return 'hoc_sinh_dang_ky_nhap_hoc';
    }

    

    public function getOneHocSinhDangKy($id){
        return $this->model->where('id',$id)->first();
    }

    public function getOneHocSinhDangKyByMaDon($ma_don){
        return $this->model->where('ma_don',$ma_don)->first();
    }

    public function createHocSinhDangKy($arrayData){
        return $this->model->insertGetId($arrayData);
    }
    

    public function updateHocSinhDangKy($key,$arrayData){
		return $this->model->where('id',$key)->update($arrayData);
	}


    public function getAllHocSinhDangKy($params){
        $query = $this->model->where('status',2);

          if (isset($params['ma_don']) && !empty($params['ma_don'])) {
            $query->where('ma_don', $params['ma_don']);
         }
         if (isset($params['sdt_dk_sreach']) && !empty($params['sdt_dk_sreach'])) {
            $query->where('dien_thoai_dang_ki', $params['sdt_dk_sreach']);
         }
         if (isset($params['ten_sreach']) && !empty($params['ten_sreach'])) {
           $query->where('ten', 'LIKE', '%' . $params['ten_sreach']. '%');
         }

         if (isset($params['status_view']) && !empty($params['status_view'])) {
            $query->where('status', '=',$params['status_view']);
          }

         return $query->paginate($params['limit']);
    }

    public function delete($id){
        return $this->model->where('id',$id)->delete();
    }

    // public function sreachHocSinhDangKy($params){
    //    $query =  $this->model->where('status',2);

    //    if (isset($params['sdt_dk_sreach']) && !empty($params['sdt_dk_sreach'])) {
    //       $query->where('dien_thoai_dang_ki', $params['sdt_dk_sreach']);
    //    }
    //    if (isset($params['ten_sreach']) && !empty($params['ten_sreach'])) {
    //      $query->where('ten', 'LIKE', '%' . $params['ten_sreach']. '%');
    //    }

    //    return $query->get();
    // }

    
  
}