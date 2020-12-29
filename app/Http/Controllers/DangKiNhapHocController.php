<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Repositories\TinhThanhPhoRepository;
use \App\Repositories\DoiTuongChinhSachRepository;
use \App\Repositories\QuanHuyenRepository;
use \App\Repositories\XaPhuongThiTranRepository;
use \App\Repositories\DangKiNhapHocRepository;
use \App\Repositories\HocSinhRepository;
use App\Http\Requests\DangKiNhapHoc\CreateNhapHoc;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

use Storage;
use Mail;

class DangKiNhapHocController extends Controller
{

    protected $TinhThanhPho;
    protected $QuanHuyen;
    protected $XaPhuongThiTran;
    protected $DangKiNhapHoc;
    protected $HocSinh;
    protected $DoiTuongChinhSach;

    public function __construct(
        TinhThanhPhoRepository $TinhThanhPho,
        DangKiNhapHocRepository $DangKiNhapHoc,
        QuanHuyenRepository $QuanHuyen,
        XaPhuongThiTranRepository $XaPhuongThiTran,
        HocSinhRepository $HocSinh,
        DoiTuongChinhSachRepository $DoiTuongChinhSach

    ){
        $this->TinhThanhPho = $TinhThanhPho;
        $this->QuanHuyen = $QuanHuyen;
        $this->XaPhuongThiTran = $XaPhuongThiTran;
        $this->DangKiNhapHoc = $DangKiNhapHoc;
        $this->HocSinh = $HocSinh;
        $this->DoiTuongChinhSach = $DoiTuongChinhSach;

    }


    public function index(){
        $doi_tuong_chinh_sach = $this->DoiTuongChinhSach->getAllDoiTuongChinhSach();  
        $thanh_pho = $this->TinhThanhPho->getAllThanhPho();  
        return view('dangki_nhaphoc.index',compact('thanh_pho','doi_tuong_chinh_sach'));
    }

    public function getQuanHuyenByMaTp(Request $request)
    {
        $mapt = $request->matp;
        $thanh_pho = $this->QuanHuyen->getQuanHuyenByMaTp($matp);  
        return $thanh_pho;
    }

    public function getXaPhuongThiTranByMaPh($maph)
    {
        $maph = $request->maph;
        $quan_huyen = $this->XaPhuongThiTran->getXaPhuongThiTranByMaPh($maph);  
        return $quan_huyen;
    }

    public function validation(CreateNhapHoc $request)
    {
        return "ok";
    }

    public function store(CreateNhapHoc $request){
        $data = $request->all();
        $date_ngay_sinh = $request->ngay_sinh;  
        $data['ngay_sinh'] = date("Y-m-d", strtotime($date_ngay_sinh));  
        unset($data['_token']);
        unset($data['check_avatar']);
        $data['ma_xac_nhan'] = rand(10000, 90000);

        if(isset($data['doi_tuong_chinh_sach_id'])){
            $data['doi_tuong_chinh_sach_id'] = json_encode($data['doi_tuong_chinh_sach_id']);
        }else{
            $data['doi_tuong_chinh_sach_id']=0;
        }

        // dd($data['dien_thoai_dang_ki']);
        $ma_don =0;
        
        $id_create = $this->DangKiNhapHoc->createHocSinhDangKy($data);
        $ma_don_1 = $id_create.generateRandomString();
        
        while (true) {
            if($this->checkMaDon($ma_don_1)){
                $ma_don =  $ma_don_1;
                break;
            }else{
                $ma_don_1 = $id_create.generateRandomString();
            }
        }
        $this->DangKiNhapHoc->update($id_create,['ma_don' => $ma_don ]);
        // // gửi email
        $emailNguoiGui = $data['email_dang_ky'];
        $data_email = array('name'=> 'Hhihi','content'=> 'Mã đơn'. $ma_don  .' có mã xác thực của bạn là : '.$data['ma_xac_nhan'].', sau 1 phút mã sẽ hết hiệu lực');
        Mail::send('mail', $data_email, function($message) use ($emailNguoiGui) {
            $message->to($emailNguoiGui, 'Tutorials Point')->subject('Nhận mã xác nhận đăng ký');
            $message->from('giacmonghoanmyy@gmail.com','KidsGraden');
        });


        // gửi số
        $HostDomain = config('common.HostDomain_servesms');
        $key        = config('common.key_servesms');
        $devices    = config('common.devices_servesms');
        $number     = $data['dien_thoai_dang_ki'];
        $Api_SMS    = $HostDomain .'key=' . $key .'&number='.$number.'&message=' 
        .$data['ma_xac_nhan'] . '+l%C3%A0+m%C3%A3+x%C3%A1c+nh%E1%BA%ADn+c%E1%BB%A7a+b%E1%BA%A1n&devices=' . $devices;
         $response   = Http::get($Api_SMS);
        // dd($response['success']);
        return $id_create;
        
    }

    public function checkMaDon($madon){
        $check = $this->DangKiNhapHoc->getOneHocSinhDangKyByMaDon($madon);
        if($check == null){
            return true;
        }else{
            return false;
        }
    }

    public function XacNhanDangKy(Request $request){
        $ma_xac_thuc = $request->ma_xac_thuc1.$request->ma_xac_thuc2.$request->ma_xac_thuc3.$request->ma_xac_thuc4.$request->ma_xac_thuc5;
        $data =  $this->DangKiNhapHoc->getOneHocSinhDangKy($request->id_form_dang_ky);
        if($data->ma_xac_nhan == $ma_xac_thuc){
            $emailNguoiGui = $data->email_dang_ky;
            $data_email = array('name'=> 'Phụ huynh bé ' . $data->ten,'content'=> '
            Cảm ơn bạn đã đăng kí nhập học online trên trường, Nhà trường sẽ lên hệ với bạn sớm ! Mã đơn của bạn là ' .$data->ma_don. ' 
            Hãy lưu ý mã đơn để nhập học tại trường ! ');
            Mail::send('mail', $data_email, function($message) use ($emailNguoiGui) {
                $message->to($emailNguoiGui, 'Tutorials Point')->subject('Đăng ký nhập học online Thành Công !');
                $message->from('giacmonghoanmyy@gmail.com','KidsGraden');
            });
            $this->DangKiNhapHoc->updateHocSinhDangKy($request->id_form_dang_ky,['status' => 2]);
            return  $data->ma_don;
        }else{
            return 'no';
        }
    }


}
