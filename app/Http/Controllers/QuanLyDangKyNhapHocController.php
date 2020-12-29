<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Repositories\TinhThanhPhoRepository;
use \App\Repositories\QuanHuyenRepository;
use \App\Repositories\XaPhuongThiTranRepository;
use \App\Repositories\DangKiNhapHocRepository;
use \App\Repositories\HocSinhRepository;
use \App\Repositories\AccountRepository;
use \App\Repositories\DoiTuongChinhSachRepository;
use \App\Repositories\ChinhSachCuaHocSinhRepository;
use App\Http\Requests\DangKiNhapHoc\CreateNhapHoc;
use App\Http\Requests\DangKiNhapHoc\EditNhapHoc;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

use Storage;
use Carbon\Carbon;
use Mail;
class QuanLyDangKyNhapHocController extends Controller
{
    protected $TinhThanhPho;
    protected $QuanHuyen;
    protected $XaPhuongThiTran;
    protected $DangKiNhapHoc;
    protected $HocSinh;
    protected $DoiTuongChinhSach;
    protected $Account;
    protected $ChinhSachCuaHocSinhRepository;
    public function __construct(
        TinhThanhPhoRepository $TinhThanhPho,
        DangKiNhapHocRepository $DangKiNhapHoc,
        QuanHuyenRepository $QuanHuyen,
        XaPhuongThiTranRepository $XaPhuongThiTran,
        HocSinhRepository $HocSinh,
        DoiTuongChinhSachRepository $DoiTuongChinhSach,
        AccountRepository $Account,
        ChinhSachCuaHocSinhRepository $ChinhSachCuaHocSinhRepository
    ){
        $this->TinhThanhPho = $TinhThanhPho;
        $this->QuanHuyen = $QuanHuyen;
        $this->XaPhuongThiTran = $XaPhuongThiTran;
        $this->DangKiNhapHoc = $DangKiNhapHoc;
        $this->HocSinh = $HocSinh;
        $this->DoiTuongChinhSach = $DoiTuongChinhSach;
        $this->Account = $Account;
        $this->ChinhSachCuaHocSinhRepository = $ChinhSachCuaHocSinhRepository;

    }

    public function index(Request $request){
        $doi_tuong_chinh_sach = $this->DoiTuongChinhSach->getAllDoiTuongChinhSach();  

        $params = request()->all();

        $params['limit'] = isset($params['page_size']) ? $params['page_size'] : 10;
        $limit = $params['limit'];
        $all_hs_dang_ki = $this->DangKiNhapHoc->getAllHocSinhDangKy($params);
        return view('quan-ly-dang-ki-nhap-hoc.index',compact('all_hs_dang_ki','limit','params','doi_tuong_chinh_sach'));
    }

    public function show($id){
        $hs_dk=  $this->DangKiNhapHoc->getOneHocSinhDangKy($id);
        $ho_khau_qh = $this->QuanHuyen->getOneQuanHuyen($hs_dk->ho_khau_thuong_tru_maqh);  
        $noi_o_qh = $this->QuanHuyen->getOneQuanHuyen($hs_dk->noi_o_hien_tai_maqh);  
        $ho_khau_xaid = $this->XaPhuongThiTran->getOneXaPhuong($hs_dk->ho_khau_thuong_tru_xaid);  
        $noi_o_xaid = $this->XaPhuongThiTran->getOneXaPhuong($hs_dk->noi_o_hien_tai_xaid);  
        $tp = $this->TinhThanhPho->getAllThanhPho();  
        $doi_tuong_chinh_sach = $this->DoiTuongChinhSach->getAllDoiTuongChinhSach();  
        $all_hs = $this->HocSinh->getAllHocSinh();
        $arr_doi_tuong_chinh_sach = json_decode($hs_dk->doi_tuong_chinh_sach_id);
        if($arr_doi_tuong_chinh_sach == null || $arr_doi_tuong_chinh_sach == 0){
            $arr_doi_tuong_chinh_sach=[];
        }


        return view('quan-ly-dang-ki-nhap-hoc.edit',compact('hs_dk','tp','ho_khau_qh','ho_khau_xaid','noi_o_qh','noi_o_xaid','doi_tuong_chinh_sach','all_hs','arr_doi_tuong_chinh_sach'));
    }

    public function capNhapId(Request $request){
        $id_user = $request->id_user;
        $id = $request->id;
        $data = $request->all();
        $hs_dk=  $this->DangKiNhapHoc->getOneHocSinhDangKy($id);
        $date_ngay_sinh = $request->ngay_sinh;  
        $data['ngay_sinh'] = date("Y-m-d", strtotime($date_ngay_sinh));  
        $this->HocSinh->createHocSinh($data);

    }



    public function delete(Request $request){
        $id_don = $request->id;
        $this->DangKiNhapHoc->delete($id_don);
    }
    public function validation(EditNhapHoc $request)
    {
        return "ok";
        // $data = $request->all();
        // dd($data);
    }

    public function PheDuyet(EditNhapHoc $request){
        $data = $request->all();
        // dd($data);
        $id =  $data['id_don_dk'];
        $hs_dk=  $this->DangKiNhapHoc->getOneHocSinhDangKy($id);
        $date_ngay_sinh = $request->ngay_sinh;  
        $data['ngay_sinh'] = date("Y-m-d", strtotime($date_ngay_sinh));  

        $nam_sinh_hs = date('Y', strtotime($data['ngay_sinh']));
        $nam_hien_tai = date("Y");

        $arr_chinh_sach =[];
        if(!isset($data['doi_tuong_chinh_sach_id'])){
            $data['doi_tuong_chinh_sach'] = 0;
        }else{
            $arr_chinh_sach = $data['doi_tuong_chinh_sach_id'];
            $data['doi_tuong_chinh_sach'] = 1;
        }
        // $avatar =$request->file("avatar");
        // if($avatar != null){
        //     $pathLoad = $avatar->store('uploads/avatar');
        //     $data['avatar']=$pathLoad;
        // }else{
        //     $data['avatar']=$hs_dk->avatar;
        // }

        unset($data['_token']);
        unset($data['id_don_dk']);
        unset($data['status']); 
        $max_id = $this->HocSinh->getMaxId();

        $now = Carbon::now();
        $data['ma_hoc_sinh'] = 'ph'.($max_id+1).substr($now->year,2);   
        $id_hs_create = 0;
        if(isset($data['user_id'])){
            $id_hs_create = $this->HocSinh->createHocSinh($data)->id;
        }else{
            $arrTen = explode(" ",$data['ten']);
            $tenKyTu = '';
            for($i = 0 ; $i < count($arrTen); $i++){
                if($i == (count($arrTen) - 1)){
                    $tenKyTu = boDauChuTiengViet($arrTen[$i]).$tenKyTu;
                }else{
                    $tenKyTu = $tenKyTu.substr(boDauChuTiengViet($arrTen[$i]),0,1);
                }
            }
            $boVietHoa = strtolower($tenKyTu);
            $username =    $boVietHoa . $data['ma_hoc_sinh'] ;
            $user_id  = $this->Account->create([
                'name' => $data['ten'],
                'role' => 3,
                'username' => $username,
                'password' => password_hash('12345',PASSWORD_DEFAULT),
                'email' => $data['email_dang_ky'],
                'phone_number' => $data['dien_thoai_dang_ki'],
            ])->id ;
            $data['user_id'] = $user_id;

            $id_hs_create = $this->HocSinh->createHocSinh($data)->id;


            $emailNguoiGui = $data['email_dang_ky'];
            $data_email = array('name'=> $data['ten'],'content'=> '
            Thông tin tài khoản của bạn 
            Tài khoản : ' .$username. ' Mật khẩu: ' . '12345');
            Mail::send('mail', $data_email, function($message) use ($emailNguoiGui) {
                $message->to($emailNguoiGui, 'Tutorials Point')->subject('Thông tin tài khoản App CoolKids');
                $message->from('giacmonghoanmyy@gmail.com','KidsGraden');
            });

            $HostDomain = config('common.HostDomain_servesms');
            $key        = config('common.key_servesms');
            $devices    = config('common.devices_servesms');
            $number     = $data['dien_thoai_dang_ki'];
            $Api_SMS    = $HostDomain .'key=' . $key .'&number='.$number.'&message= Thông tin tài khoản cool kid : Tài khoản: '.$username.' Mật khẩu: 12345'
            .'&devices=' . $devices;
             $response   = Http::get($Api_SMS);

        }

        if(count($arr_chinh_sach) !== 0){
            foreach($arr_chinh_sach as $id_cs){
                $this->ChinhSachCuaHocSinhRepository->create([
                        'id_chinh_sach' => $id_cs,
                        'id_hoc_sinh' => $id_hs_create,
                    ]);
            }
        }

        $this->DangKiNhapHoc->updateHocSinhDangKy($id,['status'=>3]);

        return redirect()->route('quan-ly-dang-ky-nhap-hoc.index')->with('status', 'Đã chuyển bé '.$data['ten'].' danh sách học sinh của trường');
    }

    
    
  
}
