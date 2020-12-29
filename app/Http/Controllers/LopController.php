<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\KhoiRepository;
use App\Repositories\GiaoVienRepository;
use App\Repositories\LopRepository;
use App\Repositories\HocSinhRepository;
use App\Repositories\NamHocRepository;
use App\Http\Requests\Lop\Store;
use App\Http\Requests\Lop\Update;
use App\Repositories\QuanLyThangThuRepository;
use App\Repositories\QuanLyChiTietDotThuRepository;
use App\Repositories\DanhSachThuTienRepository;
class LopController extends Controller
{
    protected $KhoiRepository;
    protected $GiaoVienRepository;
    protected $LopRepository;
    protected $HocSinhRepository;
    protected $NamHocRepository;
    protected $QuanLyThangThuRepository;
    protected $QuanLyChiTietDotThuRepository;
    protected $DanhSachThuTienRepository;

    public function __construct(
        LopRepository $LopRepository,
        GiaoVienRepository $GiaoVienRepository,
        KhoiRepository $KhoiRepository,
        HocSinhRepository $HocSinhRepository,
        NamHocRepository $NamHocRepository,
        QuanLyThangThuRepository $QuanLyThangThuRepository,
        QuanLyChiTietDotThuRepository $QuanLyChiTietDotThuRepository,
        DanhSachThuTienRepository $DanhSachThuTienRepository
    ) {
        $this->LopRepository = $LopRepository;
        $this->GiaoVienRepository = $GiaoVienRepository;
        $this->KhoiRepository = $KhoiRepository;
        $this->HocSinhRepository = $HocSinhRepository;
        $this->NamHocRepository = $NamHocRepository;
        $this->QuanLyThangThuRepository = $QuanLyThangThuRepository;
        $this->QuanLyChiTietDotThuRepository = $QuanLyChiTietDotThuRepository;
        $this->DanhSachThuTienRepository = $DanhSachThuTienRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $params =  request()->all();
        $queryData['keyword'] = isset($params['keyword']) ? $params['keyword'] : null;
        $queryData['limit'] = isset($params['page_size']) ? $params['page_size'] : 10;
        $queryData['khoi'] = isset($params['khoi']) ? $params['khoi'] : null;
        $khoi = $this->KhoiRepository->getAll();
        $lop = $this->LopRepository->getAllPhanTrang($queryData);
        return view('quan-ly-lop.index', [
            'khoi' => $khoi,
            'lop' => $lop,
            'params' => $params,
            'limit' => $queryData['limit']
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $khoi = $this->KhoiRepository->getAll();
        $giao_vien = $this->GiaoVienRepository->getGIaoVienChuaCoLop();
        return view('quan-ly-lop.create', [
            'khoi' => $khoi,
            'giao_vien' => $giao_vien
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        $data = [
            "khoi_id" => $request->khoi_id,
            "ten_lop" => $request->ten_lop,
        ];
        $idLop = $this->LopRepository->addLop($data);
        if ($request->giao_vien_cn != null) {
            $giao_vien_cn = $request->giao_vien_cn;
            $this->GiaoVienRepository->phanLopGiaoVienCn($giao_vien_cn, $idLop->id);
        }
        if (isset($request->giao_vien_phu)) {
            foreach ($request->giao_vien_phu as $key => $value) {
                $this->GiaoVienRepository->phanLopGiaoVienPhu($value, $idLop->id);
            }
        }
        return $idLop;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $params = request()->all();
        $id_nam = $this->NamHocRepository->maxID();
        $queryData['gioi_tinh'] = isset($params['gioi_tinh']) ? $params['gioi_tinh'] : null;
        $lop = $this->LopRepository->find($id);
        $nam_hoc =  $this->KhoiRepository->getNamHoc($lop->khoi_id);
        $giao_vien = $this->GiaoVienRepository->getGVHienTai($id);
        if(count($giao_vien) == 0){
            $giao_vien = $this->GiaoVienRepository->getGVLichSuDay($id);
            
        }
        $hoc_sinh = $this->HocSinhRepository->getHocSinhHienTai($id);
        if(count($hoc_sinh) == 0){
            $hoc_sinh = $this->HocSinhRepository->getHocSinhLichSuHoc($id);
        }
        $so_tien_phai_dong = 0;
        $so_tien_da_dong = 0;
        
        $thang_thu_moi_nhat = $this->QuanLyThangThuRepository->getDotMoiNhatCuaNam($nam_hoc->id);
        if($thang_thu_moi_nhat){
            $dot_thu_tien = $this->QuanLyChiTietDotThuRepository->getDotThuTheoNamIDThangThu($thang_thu_moi_nhat->id);
            foreach($dot_thu_tien as $item){
                if($id_nam == $nam_hoc->id){
                    $ds_thu = $this->DanhSachThuTienRepository->getDanhSachHocSinhHienTaiThuTienTheoDot($item->id,$lop->id);
                    if(count($ds_thu) > 0){
                        foreach($ds_thu as $item2){
                            $so_tien_phai_dong += $item2->so_tien_phai_dong;
                            $so_tien_da_dong += $item2->so_tien_da_dong;
                        }
                        
                    }
                }
                else{
                    $ds_thu = $this->DanhSachThuTienRepository->getDanhSachLichSuHocSinhThuTienTheoDot($item->id, $lop->id);
                    if(count($ds_thu) > 0){
                        foreach($ds_thu as $item2){
                            $so_tien_phai_dong += $item2->so_tien_phai_dong;
                            $so_tien_da_dong += $item2->so_tien_da_dong;
                        }
                    }
                }
            }
            
        }
        $so_tien_con_phai_dong = $so_tien_phai_dong - $so_tien_da_dong;
        
        return view(
            'quan-ly-lop.show',
            [
                'giao_vien' => $giao_vien,
                'hoc_sinh' => $hoc_sinh,
                'lop' => $lop,
                'nam_hoc' => $nam_hoc,
                'thang_thu_moi_nhat' => $thang_thu_moi_nhat,
                'so_tien_con_phai_dong' => $so_tien_con_phai_dong,
                'so_tien_da_dong' => $so_tien_da_dong
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {   $id = $request->id;
        $lop = $this->LopRepository->find($id);

        $khoi = $this->KhoiRepository->getAllKhoi();
        $giao_vien = $this->GiaoVienRepository->getGIaoVienChuaCoLop();
        $giao_vien_phu = $lop->giao_vien_phu;
        $giao_vien_cn = $lop->giao_vien_chu_nhiem;

        // return view('quan-ly-lop.edit', [
        //     'khoi' => $khoi,
        //     'giao_vien' => $giao_vien,
        //     'lop' => $lop
        // ]);
        return [
            'giao_vien' => $giao_vien,
            'lop' => $lop,
            'giao_vien_phu' => $giao_vien_phu,
            'giao_vien_cn' => $giao_vien_cn,
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request)
    {
        $id = $request->lop_id;
        $lop = $this->LopRepository->find($id);
        $this->LopRepository->update($id, $request->all());
        foreach ($lop->GiaoVien as $key => $value) {
            $this->GiaoVienRepository->removeLopGiaoVien($value->id);
        }
        if ($request->giao_vien_cn != null) {
            $giao_vien_cn = $request->giao_vien_cn;
            $this->GiaoVienRepository->phanLopGiaoVienCn($giao_vien_cn, $lop->id);
        }
        if (isset($request->giao_vien_phu)) {
            foreach ($request->giao_vien_phu as $key => $value) {
                $this->GiaoVienRepository->phanLopGiaoVienPhu($value, $lop->id);
            }
        }
        return 'thành công';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $lop_id = $request->id;
        $this->LopRepository->delete($lop_id);
        return 'thành công';
    }

    public function phanLop()
    {
        $hoc_sinh = $this->HocSinhRepository->getHocSinh();
        // dd($hoc_sinh);
        return view('quan-ly-lop.phan-lop',
        ['hoc_sinh' => $hoc_sinh]
    );
    }
    public function xepLop()
    {
        $hoc_sinh = $this->HocSinhRepository->getHocSinh();
        // dd($hoc_sinh);
        return view('quan-ly-lop.xep-lop',
        ['hoc_sinh' => $hoc_sinh]
    );
    }

    public function showHsTheoLop(Request $request)
    {
        // return 1;
        $id = $request->id;
        $lop = $this->LopRepository->find($id);
        $namhoc = $this->NamHocRepository->find($request->nam_hoc);
        // $hoc_sinh_cua_lop = $namhoc->type == 1 ? $lop->HocSinh : $lop->LichSuHoc;
        if ($namhoc->type == 1) {
            $hoc_sinh_cua_lop = $lop->HocSinh;

        }else{
            $hoc_sinh_cua_lop =$lop->LichSuHoc->map(function($student){
                return $student->HocSinh;
            });
        }
        $ten_lop = $lop->ten_lop;
        $tong_so_hs = $lop->tong_so_hoc_sinh;
        return [
            'danh_sach_lop' => $lop->Khoi->LopHoc,
            'ten_lop' => $ten_lop,
            'hoc_sinh_cua_lop' => $hoc_sinh_cua_lop,
            'tong_so_hs' => $tong_so_hs,
            'type_namhoc' => $namhoc->type
        ];
    }

    public function xepLopTuDong(Request $request)
    {
        $lop = $this->LopRepository->find($request->id_lop);
        $do_tuoi = $lop->Khoi->do_tuoi;
        $sl_hs_nam = $request->sl_hs_nam;
        $sl_hs_nu = $request->sl_hs_nu;
        if($sl_hs_nam < 0 || $sl_hs_nu< 0){
            return response()->json([
                'message' => 'Số lượng học sinh bạn không hợp lệ',
            ], 400);
        }
        $id_nam_hoc = $this->NamHocRepository->maxID();
        $nam_hoc = $this->NamHocRepository->find($id_nam_hoc);
        
        $sl_hs_nam_con_lai = $this->HocSinhRepository->getHocSinhChuaCoLopTheoDoTuoi($do_tuoi,0,$nam_hoc);
        $sl_hs_nu_con_lai = $this->HocSinhRepository->getHocSinhChuaCoLopTheoDoTuoi($do_tuoi,1,$nam_hoc);
        if($sl_hs_nam > $sl_hs_nam_con_lai){
            return response()->json([
                'message' => 'so-luong-khong-du',
                'sl_hs_con_lai' => $sl_hs_nam_con_lai,
                'gioi_tinh' => 'Nam'
            ], 422);
        }

        if($sl_hs_nu > $sl_hs_nu_con_lai){
            return response()->json([
                'message' => 'so-luong-khong-du',
                'sl_hs_con_lai' => $sl_hs_nu_con_lai,
                'gioi_tinh' => 'Nữ'

            ], 422);
        }
       
        $this->HocSinhRepository->xepLopTuDong($request->id_lop,$do_tuoi,0,$sl_hs_nam,$nam_hoc);
        $this->HocSinhRepository->xepLopTuDong($request->id_lop,$do_tuoi,1,$sl_hs_nu,$nam_hoc);
return [                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
            'hs_cua_lop' => $lop->HocSinh,
            'sl_hs_cua_lop' => count($lop->HocSinh),
            'sl_hs_moi_tuyen_sinh' => $this->HocSinhRepository->getSlHocSinhType(0),
            'sl_hs_dang_hoc_chua_co_lop' => $this->HocSinhRepository->getSlHocSinhType(1)
        ];


    }

    public function getDataHocSinhChuaCoLop($type)
    {
        $id_nam_hoc = $this->NamHocRepository->maxID();
        $nam_hoc = $this->NamHocRepository->find($id_nam_hoc);
        return $this->HocSinhRepository->getDataHocSinhChuaCoLop($type,$nam_hoc);
    }

}
