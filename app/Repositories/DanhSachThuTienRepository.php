<?php

namespace App\Repositories;

use App\Repositories\BaseModelRepository;
use Illuminate\Support\Facades\DB;
use App\Models\DanhSachThuTien;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class DanhSachThuTienRepository extends BaseModelRepository
{

    protected $model;
    public function __construct(
        DanhSachThuTien $model
    ) {
        parent::__construct();
        $this->model = $model;
    }
    public function getModel()
    {
        return DanhSachThuTien::class;
    }

    public function deleteList($array)
    {
        $this->model->destroy($array);
    }

    public function tongTienPhaiDong($id_chi_tiet_dot_thu, $khoi_id)
    {
        // dd($id_chi_tiet_dot_thu,$khoi_id);
        return $this->model->where('id_chi_tiet_dot_thu', $id_chi_tiet_dot_thu)->where('khoi_id', $khoi_id)->sum('so_tien_phai_dong');
    }

    public function tongTienDaThu($id_chi_tiet_dot_thu, $khoi_id)
    {
        return $this->model->where('id_chi_tiet_dot_thu', $id_chi_tiet_dot_thu)->where('khoi_id', $khoi_id)->where('trang_thai', 1)->sum('so_tien_da_dong');
    }

    public function soLuongDaThongBao($id_chi_tiet_dot_thu, $khoi_id)
    {
        return $this->model->where('id_chi_tiet_dot_thu', $id_chi_tiet_dot_thu)->where('khoi_id', $khoi_id)->where('thong_bao', 1)->count();
    }

    public function tongSoLuongCanThongBao($id_chi_tiet_dot_thu, $khoi_id)
    {

        return $this->model->where('id_chi_tiet_dot_thu', $id_chi_tiet_dot_thu)->where('khoi_id', $khoi_id)->count();
    }

    public function DotThuTheoLop($id_dot_chi_tiet_thu_tien, $lop_id)
    {
        return $this->model->where('id_chi_tiet_dot_thu', $id_dot_chi_tiet_thu_tien)->where('lop_id', $lop_id)->get();
    }

    public function danhSachHocSinhKhoiDot($id_chi_tiet_dot_thu, $khoi_id)
    {

        return $this->model->where('id_chi_tiet_dot_thu', $id_chi_tiet_dot_thu)->where('khoi_id', $khoi_id)->where('trang_thai', 0)->get();
    }

    public function updateThongBaoHocSinhKhoiDot($request)
    {
        // dd($request);
        return $this->model->where('id_chi_tiet_dot_thu', $request['dot_thu'])->where('khoi_id', $request['id_khoi'])
            ->update([
                'ngay_bat_dau_thu' => $request['ngay_bat_dau'],
                'ngay_ket_thuc_thu' => $request['ngay_ket_thuc'],
                'thong_bao' => $request['trang_thai_thong_bao']
            ]);
    }

    public function getDanhSachHocSinhtThongBaoTheoLop($danhsach, $lop_id, $dot_id)
    {
        if ($danhsach[0] == 0) {
            return $this->model->where('id_chi_tiet_dot_thu', $dot_id)->where('lop_id', $lop_id)->where('trang_thai', 0)->get();
        } else {
            return $this->model->where('id_chi_tiet_dot_thu', $dot_id)->whereIn('id_hoc_sinh', $danhsach)->where('trang_thai', 0)->get();
        }
    }

    public function updateThongBaoHocSinhLopDot($request)
    {
        if ($request['danh_sach_hoc_sinh'][0] == 0) {
            return $this->model->where('id_chi_tiet_dot_thu', $request['id_dot_chon'])->where('lop_id', $request['id_lop_chon'])
                ->update([
                    'ngay_bat_dau_thu' => $request['ngay_bat_dau'],
                    'ngay_ket_thuc_thu' => $request['ngay_ket_thuc'],
                    'thong_bao' => $request['trang_thai_thong_bao']
                ]);
        } else {

            return $this->model->where('id_chi_tiet_dot_thu', $request['id_dot_chon'])->whereIn('id_hoc_sinh', $request['danh_sach_hoc_sinh'])
                ->update([
                    'ngay_bat_dau_thu' => $request['ngay_bat_dau'],
                    'ngay_ket_thuc_thu' => $request['ngay_ket_thuc'],
                    'thong_bao' => $request['trang_thai_thong_bao']
                ]);
        }
    }

    public function getIdDanhSachThuTien($id_dot)
    {
        return  $this->model->where('id_chi_tiet_dot_thu',$id_dot)->select('id')->get();
    }

    public function deleteTheoIdDot($id_dot)
    {
        return  $this->model->where('id_chi_tiet_dot_thu',$id_dot)->delete();
    }

    public function deleteDanhSachThuTien($danh_sach)
    {
        return  $this->model->whereIn('id_danh_sach_thu_tien',$danh_sach)->delete();
    }

    public function getHocSinhThuTien($id_dot_chi_tiet_thu_tien, $hoc_sinh_id)
    {
        // dd($id_dot_chi_tiet_thu_tien, $hoc_sinh_id);
        return $this->model->where('id_chi_tiet_dot_thu', $id_dot_chi_tiet_thu_tien)->where('id_hoc_sinh', $hoc_sinh_id)->first();
    }

    public function DongHocPhiTheoLop($id_hoc_sinh,$id_dot_thu)
    {
        $so_tien = $this->model->where('id_hoc_sinh',$id_hoc_sinh)->where('id_chi_tiet_dot_thu',$id_dot_thu)->select('so_tien_phai_dong')->first();
        return  $this->model->where('id_hoc_sinh',$id_hoc_sinh)->where('id_chi_tiet_dot_thu',$id_dot_thu)
        ->update(
            [
            'trang_thai'=>1,
            'so_tien_da_dong'=>$so_tien['so_tien_phai_dong'],
            'id_nguoi_thu_tien'=>Auth::id(),
            'thoi_gian_thu_tien'=>Carbon::now(),
        ]);

    }

    public function huyThuTien($id_hoc_sinh,$id_dot_thu)
    {
        return  $this->model->where('id_hoc_sinh',$id_hoc_sinh)->where('id_chi_tiet_dot_thu',$id_dot_thu)
        ->update(['trang_thai'=>0,'so_tien_da_dong'=>0]);
    }

    public function getTrangThaiDongTienCuaLop($id,$lop_id)
    {
        $tong_hoc_sinh_phai_dong =  $this->model->where('id_chi_tiet_dot_thu',$id)->where('lop_id',$lop_id)->count();
        $tong_hoc_sinh_da_dong =  $this->model->where('id_chi_tiet_dot_thu',$id)->where('lop_id',$lop_id)->where('trang_thai',1)->count();

        if($tong_hoc_sinh_phai_dong == $tong_hoc_sinh_da_dong){
            return [
                'trang_thai' =>1,
                'so_luong' =>$tong_hoc_sinh_da_dong .'/'.$tong_hoc_sinh_phai_dong
            ];
        }else{
            return [
                'trang_thai' =>0,
                'so_luong' =>$tong_hoc_sinh_da_dong .'/'.$tong_hoc_sinh_phai_dong
            ];
        }
        // dd($tong_hoc_sinh_phai_dong);
        
    }

    public function getDanhSachHocSinhHienTaiThuTienTheoDot($dot_id, $lop_id)
    {
        $query = $this->model->join('hoc_sinh', 'hoc_sinh.id','=','danh_sach_thu_tien.id_hoc_sinh')
        ->select('danh_sach_thu_tien.so_tien_phai_dong', 'danh_sach_thu_tien.so_tien_da_dong')
        ->where('hoc_sinh.lop_id', $lop_id)
        ->where('danh_sach_thu_tien.id_chi_tiet_dot_thu', $dot_id)
        ->get();
        return $query;
    }

    public function getDanhSachLichSuHocSinhThuTienTheoDot($dot_id, $lop_id)
    {
        $query = $this->model->join('lich_su_hoc', 'lich_su_hoc.hoc_sinh_id','=','danh_sach_thu_tien.id_hoc_sinh')
        ->select('danh_sach_thu_tien.so_tien_phai_dong', 'danh_sach_thu_tien.so_tien_da_dong')
        ->where('lich_su_hoc.lop_id', $lop_id)
        ->where('danh_sach_thu_tien.id_chi_tiet_dot_thu', $dot_id)
        ->get();
        return $query;
    }

    public function getDanhSachThuTienTheoDot($dot_id)
    {
        $query = $this->model->where('id_chi_tiet_dot_thu', $dot_id)->get();
        return $query;
    }

    public function soLuongHocSinhDongTienTrongDot($dot_id)
    {
        return $this->model->where('id_chi_tiet_dot_thu', $dot_id)->where('trang_thai',1)->count();
    }
}
