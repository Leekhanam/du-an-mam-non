<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DoiTuongChinhSachRepository;
use App\Http\Requests\DienUuTien\StoreDienUuTien;

class DienUuTienController extends Controller
{
    protected $DoiTuongChinhSachRepository;
    public function __construct(
        DoiTuongChinhSachRepository $DoiTuongChinhSachRepository

    ) {
       $this->DoiTuongChinhSachRepository = $DoiTuongChinhSachRepository;
    }

    public function index(){
        $data  = $this->DoiTuongChinhSachRepository->getAllDoiTuongChinhSach();
        return view('quan-ly-dien-uu-tien.index', compact('data'));
    }
    
    public function store(StoreDienUuTien $request){
        $request = $request->all();
        unset($request['_token']);
        $array = [
            'ten_chinh_sach' => $request['ten_chinh_sach'],
            'muc_mien_giam' => $request['muc_mien_giam']
        ];
        $this->DoiTuongChinhSachRepository->ThemChinhSach($array);
        return redirect()->route('quan-ly-dien-uu-tien-index')->with('ThongBaoDienUuTien', 'Hoàn thành');
    }

    public function XoaDienUuTien(Request $request){
        $request = $request->all();
        $this->DoiTuongChinhSachRepository->XoaMotChinhSach($request['id']);
    }

    public function XoaListDienUuTien(Request $request){
        $request = $request->all();
        foreach($request as $item){
            $this->DoiTuongChinhSachRepository->XoaMotChinhSach($item);
        }
    }

    public function GetMotDienUuTien(Request $request){
        $request = $request->all();
        $data = $this->DoiTuongChinhSachRepository->GetMotDienUuTien($request['id']);
        return $data;
    }
    public function EditDienUuTien($id, StoreDienUuTien $request){
        $request = $request->all();
        unset($request['_token']);
        $this->DoiTuongChinhSachRepository->ChinhSuaChinhSach($request, $id);
        return redirect()->route('quan-ly-dien-uu-tien-index')->with('ThongBaoSuaDienUuTien', 'Hoàn thành');
    }
}
