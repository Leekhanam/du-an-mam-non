<?php

namespace App\Http\Controllers;
use App\Repositories\NamHocRepository;
use App\Repositories\QuanLyKhoanThuRepository;
use App\Repositories\QuanLyPhamViThuRepository;
use App\Http\Requests\KhoanThu\Store;
use App\Http\Requests\KhoanThu\Update;

use Illuminate\Http\Request;

class QuanLyKhoanThuController extends Controller
{
    protected $NamHocRepository;
    protected $QuanLyPhamViThuRepository;
    public function __construct(
        QuanLyPhamViThuRepository $QuanLyPhamViThuRepository,
        NamHocRepository $NamHocRepository,
        QuanLyKhoanThuRepository $QuanLyKhoanThuRepository
    )
    {
        $this->QuanLyPhamViThuRepository = $QuanLyPhamViThuRepository;
        $this->NamHocRepository = $NamHocRepository;
        $this->QuanLyKhoanThuRepository = $QuanLyKhoanThuRepository;
    }
    public function index()
    {
        $id = $this->NamHocRepository->maxID();
        $nam_hoc_moi = $this->NamHocRepository->find($id);
        $khoi = $nam_hoc_moi->Khoi;
        $khoan_thu = $this->QuanLyKhoanThuRepository->getAllKhoanThu();
        // dd($khoan_thu[0]->PhamViThu);
        return  view('quan-ly-hoc-phi.khoan_thu',compact('khoi','khoan_thu'));
    }
    
    public function Store(Store $request)
    {
        $data = $request->all();
        $pham_vi_thu = $request->pham_vi_thu;
        $data_pham_vi_thu=[];
        $id = $this->QuanLyKhoanThuRepository->create($data)->id;
        if($pham_vi_thu != 0){
            $id_khoi_lop_thu = $pham_vi_thu==1?$request->id_khoi_thu:$request->id_lop_thu;

            foreach ($id_khoi_lop_thu as $value) {
                array_push($data_pham_vi_thu,[
                    'id_khoan_thu' => $id,
                    'id_khoi_lop_thu' => $value,
                ]);
            }
            $this->QuanLyPhamViThuRepository->insert($data_pham_vi_thu);
        }
        
        return 'thành công';
    }

    public function getDataKhoanThu()
    {
       return $this->QuanLyKhoanThuRepository->getAll();
    }

    public function update(Update $request)
    {
        $data = $request->all();
        $pham_vi_thu = $request->pham_vi_thu;
        $data_pham_vi_thu=[];
        $id_sua_khoan_thu = $request->id_sua_khoan_thu;

        if($request->mien_giam==null){
            $data['mien_giam'] = 0;
        }

        if($request->xuat_hoa_don==null){
            $data['xuat_hoa_don'] = 0;
        }

        if($request->theo_doi==null){
            $data['theo_doi'] = 0;
        }

        $this->QuanLyKhoanThuRepository->update($id_sua_khoan_thu,$data);
        $this->QuanLyPhamViThuRepository->deletePhamViThu($id_sua_khoan_thu);

        if($pham_vi_thu != 0){
            $id_khoi_lop_thu = $pham_vi_thu==1?$request->id_khoi_thu:$request->id_lop_thu;

            foreach ($id_khoi_lop_thu as $value) {
                array_push($data_pham_vi_thu,[
                    'id_khoan_thu' => $id_sua_khoan_thu,
                    'id_khoi_lop_thu' => $value,
                ]);
            }
            $this->QuanLyPhamViThuRepository->insert($data_pham_vi_thu);
        }
        
        return 'thành công';
    }

    public function copy(Store $request)
    {
        $data = $request->all();
        $pham_vi_thu = $request->pham_vi_thu;
        $data_pham_vi_thu=[];
        $id = $this->QuanLyKhoanThuRepository->create($data)->id;
        if($pham_vi_thu != 0){
            $id_khoi_lop_thu = $pham_vi_thu==1?$request->id_khoi_thu:$request->id_lop_thu;

            foreach ($id_khoi_lop_thu as $value) {
                array_push($data_pham_vi_thu,[
                    'id_khoan_thu' => $id,
                    'id_khoi_lop_thu' => $value,
                ]);
            }
            $this->QuanLyPhamViThuRepository->insert($data_pham_vi_thu);
        }
        
        return 'thành công';
    }

    public function delete($id)
    {
        $this->QuanLyKhoanThuRepository->delete($id);
        return 'thành công';
    }

    public function deleteList(Request $request)
    {
        $this->QuanLyKhoanThuRepository->deleteList($request->all());
    }
    
}
