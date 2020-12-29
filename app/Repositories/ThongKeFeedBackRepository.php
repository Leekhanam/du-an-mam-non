<?php

namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseModelRepository;
use App\Models\ThongKeFeedBack;

class ThongKeFeedBackRepository extends BaseModelRepository{
    protected $model;
    public function __construct(
        ThongKeFeedBack $model
    ) {
        parent::__construct();
        $this->model = $model;
    }
    public function getModel()
    {
        return ThongKeFeedBack::class;
    }
    
    public function getTable()
    {
        return 'danh_gia_phu_huynh';
    }
    public function ShowFeedBackCuaLop($lop_id, $feedback_id)
    {
        $query = DB::table('danh_gia_phu_huynh')
        ->join('hoc_sinh', 'hoc_sinh.id', '=', 'danh_gia_phu_huynh.hoc_sinh_id')
        ->join('lop_hoc', 'lop_hoc.id', '=', 'danh_gia_phu_huynh.lop_id')
        ->select(
            'danh_gia_phu_huynh.*',
            'hoc_sinh.ma_hoc_sinh', 
            'hoc_sinh.ten', 
            'hoc_sinh.dien_thoai_dang_ki',
            'hoc_sinh.avatar',
            'lop_hoc.ten_lop'
            )
        ->where('danh_gia_phu_huynh.lop_id', $lop_id);
        if($feedback_id > 0){
            $query->where('danh_gia_phu_huynh.id', $feedback_id);
        }
        return $query->orderBy('danh_gia_phu_huynh.id', 'desc')->get();
    }

    public function ThayDoiTrangThaiFeedBack($id)
    {
        DB::table('danh_gia_phu_huynh')->where('id', $id)->update(['trang_thai' => 2]);
    }

    public function ThongKeFeedBackTheoLop($lop_id)
    {
        $data = $this->model->where('danh_gia_phu_huynh.lop_id', $lop_id)->where('danh_gia_phu_huynh.trang_thai', 1)->get();
        return $data;
    }
    public function ThayDoiTrangThaiTatCaFeedBackTheoLop($lop_id)
    {
        $data = DB::table('danh_gia_phu_huynh')->where('trang_thai', 1)->where('lop_id', $lop_id)->get();
        return $data;
    }
}