<?php

namespace App\Http\Controllers;

use App\Repositories\AccountRepository;
use App\User;
use Auth;
use Hash;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\TaiKhoan\AccountAdminRequest;
use App\Http\Requests\TaiKhoan\AccountTeacherRequest;
use App\Http\Requests\TaiKhoan\AccountStudentRequest;
use App\Http\Requests\DangKiNhapHoc\CreateNhapHoc;
use App\Http\Requests\Auth\EditTaiKhoanRequest;
use App\Models\GiaoVien;
use App\Models\HocSinh;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Repositories\GiaoVienRepository;
use App\Repositories\QuanHuyenRepository;
use App\Repositories\TinhThanhPhoRepository;
use App\Repositories\XaPhuongThiTranRepository;
use App\Repositories\HocSinhRepository; 
use App\Http\Requests\Account\RegisterSchoolRequest;
use App\Http\Requests\Account\UpdateTkHocSinh;

class AccountController extends Controller
{
    protected $AccountRepository;
    protected $HocSinhRepository;
    protected $GiaoVienRepository;
    protected $TinhThanhPhoRepository;
    protected $QuanHuyenRepository;
    protected $XaPhuongThiTranRepository;
  
    public function __construct(
        AccountRepository $AccountRepository,
        GiaoVienRepository $GiaoVienRepository,
        TinhThanhPhoRepository $TinhThanhPhoRepository,
        QuanHuyenRepository $QuanHuyenRepository,
        XaPhuongThiTranRepository $XaPhuongThiTranRepository,
        HocSinhRepository $HocSinhRepository
      
    ) {
        $this->AccountRepository = $AccountRepository;
        $this->GiaoVienRepository = $GiaoVienRepository;
        $this->TinhThanhPhoRepository = $TinhThanhPhoRepository;
        $this->QuanHuyenRepository = $QuanHuyenRepository;
        $this->XaPhuongThiTranRepository = $XaPhuongThiTranRepository;
        $this->HocSinhRepository = $HocSinhRepository;

    }

    public function index(Request $request)
    {
        $params = $request->all();
        $params['keyword'] = trim($request->has('keyword') ? $request->keyword : null);
        $params['active'] = $request->has('active') ? $request->active : null;
        if (!isset($params['page_size'])) {
            $params['page_size'] = config('common.paginate_size.default');
        }
        $route_name = Route::current()->action['as'];
        if ($route_name == "account.ds-hs") {
            $params['role'] = 3;
            $rederView = 'quan-ly-tai-khoan.ds-hoc-sinh';
        } elseif ($route_name == "account.ds-gv") {
            $params['role'] = 2;
            $rederView = 'quan-ly-tai-khoan.ds-giao-vien';
        } else {
            $params['role'] = 1;
            $rederView = 'quan-ly-tai-khoan.index';
        }

        $data = $this->AccountRepository->getAllSchool($params);
        $data->appends($request->all())->links();

        $all_account = $this->AccountRepository->getAccountHocSinh();

        return view($rederView, compact('data', 'params', 'route_name','all_account'));
    }

    public function editStatus(Request $request)
    {
        $user = User::find($request->id);
        $user->active = $user->active == 1 ? 2 : 1;
        $user->save();
        return response()->json($user, Response::HTTP_OK);
    }

    public function createTeacher()
    {
        return view('quan-ly-tai-khoan/create-teacher');

    }

    public function createSchool()
    {
        return view('quan-ly-tai-khoan/create-school');

    }

    public function storeSchool(RegisterSchoolRequest $request)
    {
        $request['role'] = 1;
        $data = $this->AccountRepository->storeAcount($request->all());
        return redirect()->back()->with('mess','Đăng ký tài khoản thành công !');
    }

    public function editProfile()
    {
         return view('auth.profile');
     }
 
    public function updateProfile(EditTaiKhoanRequest $request)
    {
         $user = Auth::user();
         $user->name   = $request->name;
         $user->email   = $request->email; 
         $user->update();
         return redirect()->back()->with("message","Cập nhật tài khoản thành công !");
    }
 
  public function changePasswordForm()
    {
       //  $user = User::find($id);
        return view('auth.change_password');
    }
  public function changePassword(Request $request)
  {
    if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
        return redirect()->back()
            ->with("error","Mật khẩu cũ không chính xác!Vui lòng kiểm tra lại."); 
    }

    if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){
        return redirect()->back()
            ->with("error","Mật khẩu mới không được trùng với mật khẩu hiện tại của bạn.Vui lòng chọn một mật khẩu khác.");
    }

    $request->validate([
        'current_password' => ['required'],
        'new_password' => ['required','regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/','min:8'],
        'password_confirmation' => ['same:new_password'],
    ],
     [
        'current_password.required'=>'Bạn chưa nhập mật khẩu cũ',
        'new_password.required'=>'Bạn chưa nhập mật khẩu mới.',
        'password_confirmation.same'=>'Mật khẩu không khớp.',
        'new_password.regex'=>'Mật khẩu phải bao gồm các kí tự a-Z, 0-9 và kí tự đặc biệt!'  , 
        'new_password.min'=>'Mật khẩu tối thiểu 8 kí tự! '
       ]

);
    
    User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
    Auth::logout();
    return redirect()->route('login')->with("success_password","Đăng nhập lại để tiếp tục");
   
  }
 
  //sửa tk trường
  public function getEditAdmin($id){
    $user= User::find($id);
    return view('quan-ly-tai-khoan.edit-quan-tri',compact('user'));
  }
  public function editAdmin(AccountAdminRequest $request,$id){
    $user = User::find($id);
         $user->username = $request->username;
         $user->phone_number = $request->phone_number;
         $user->name   = $request->name;
         $user->email   = $request->email;        
         $user->avatar  = $request->avatar;
         $user->update();
         return redirect()->back()->with("message","Cập nhật tài khoản thành công !");
  }
//sửa tk giáo viên
  public function getEditTeacher($id)
  { 
      $giao_vien=User::find($id)->GiaoVien;
      $thanh_pho = $this->TinhThanhPhoRepository->getAllThanhPho();
      $maqh_gv_hktt = $this->QuanHuyenRepository->getAllQuanHuyen();
      $xaid_gv_hktt = $this->XaPhuongThiTranRepository->getAllXaPhuongThiTran();
      $maqh_gv_noht = $this->QuanHuyenRepository->getQuanHuyenByMaTp($giao_vien->noi_o_hien_tai_matp);
      $xaid_gv_noht = $this->XaPhuongThiTranRepository->getXaPhuongThiTranByMaPh($giao_vien->noi_o_hien_tai_maqh);

    return view('quan-ly-tai-khoan.edit-giao-vien',compact('giao_vien' ,
                                                            'thanh_pho',
                                                            'maqh_gv_hktt', 
                                                            'xaid_gv_hktt',
                                                            'maqh_gv_noht', 
                                                            'xaid_gv_noht' ));
  }
  public function editTeacher(AccountTeacherRequest $request,$id)
  {
         $giao_vien=GiaoVien::find($id);
            $giao_vien->ma_gv = $request->ma_gv;
            $giao_vien->ten = $request->ten;
            $giao_vien->gioi_tinh = $request->gioi_tinh;
            $giao_vien->email = $request->email;
            $giao_vien->dien_thoai = $request->dien_thoai;
            $giao_vien->ngay_sinh = $request->ngay_sinh;
            $giao_vien->dan_toc = $request->dan_toc;
            $giao_vien->trinh_do = $request->trinh_do;
            $giao_vien->chuyen_mon = $request->chuyen_mon;
            $giao_vien->noi_dao_tao = $request->noi_dao_tao;
            $giao_vien->nam_tot_nghiep = $request->nam_tot_nghiep;
            $giao_vien->ho_khau_thuong_tru_matp = $request->ho_khau_thuong_tru_matp;
            $giao_vien->ho_khau_thuong_tru_maqh = $request->ho_khau_thuong_tru_maqh;
            $giao_vien->ho_khau_thuong_tru_xaid = $request->ho_khau_thuong_tru_xaid;
            $giao_vien->ho_khau_thuong_tru_so_nha = $request->ho_khau_thuong_tru_so_nha;
            $giao_vien->noi_o_hien_tai_matp = $request->noi_o_hien_tai_matp;
            $giao_vien->noi_o_hien_tai_maqh = $request->noi_o_hien_tai_maqh;
            $giao_vien->noi_o_hien_tai_xaid = $request->noi_o_hien_tai_xaid;
            $giao_vien->noi_o_hien_tai_so_nha = $request->noi_o_hien_tai_so_nha;
            $giao_vien->anh =$request->anh;
   

            $user_id = $giao_vien->user_id;
            $data_update_account = [
                'name' => $request->ten,
                'avatar' => $request->anh,
                'email' => $request->email,
                'phone_number' => $request->dien_thoai
            ];
            $this->AccountRepository->updateAccountGiaoVien($user_id, $data_update_account);
            $giao_vien->update();
          return redirect()->back()->with("message","Cập nhật tài khoản thành công !");
  }
  public function getEditHocSinh($id)
  { 
      $hoc_sinh=HocSinh::find($id);
      $thanh_pho = $this->TinhThanhPhoRepository->getAllThanhPho();
      $maqh_gv_hktt = $this->QuanHuyenRepository->getAllQuanHuyen();
      $xaid_gv_hktt = $this->XaPhuongThiTranRepository->getAllXaPhuongThiTran();
      $maqh_gv_noht = $this->QuanHuyenRepository->getQuanHuyenByMaTp($hoc_sinh->noi_o_hien_tai_matp);
      $xaid_gv_noht = $this->XaPhuongThiTranRepository->getXaPhuongThiTranByMaPh($hoc_sinh->noi_o_hien_tai_maqh);

    return view('quan-ly-tai-khoan.edit-hoc-sinh',compact('hoc_sinh' ,
                                                            'thanh_pho',
                                                            'maqh_gv_hktt', 
                                                            'xaid_gv_hktt',
                                                            'maqh_gv_noht', 
                                                            'xaid_gv_noht' ));
  }
  public function editHocSinh(AccountStudentRequest $request,$id)
  {
        $hoc_sinh=HocSinh::find($id);
        $hoc_sinh->ten = $request->ten;
        $hoc_sinh->gioi_tinh = $request->gioi_tinh;
        $hoc_sinh->ten_thuong_goi = $request->ten_thuong_goi;
        $hoc_sinh->noi_sinh = $request->noi_sinh;
        $hoc_sinh->email_dang_ky = $request->email_dang_ky;
        $hoc_sinh->dien_thoai_dang_ki = $request->dien_thoai_dang_ki;
        $hoc_sinh->ngay_sinh = $request->ngay_sinh;
        $hoc_sinh->ngay_vao_truong = $request->ngay_vao_truong;
        $hoc_sinh->doi_tuong_chinh_sach_id = $request->doi_tuong_chinh_sach_id;
        $hoc_sinh->hoc_sinh_khuyet_tat = $request->hoc_sinh_khuyet_tat;
        $hoc_sinh->ten_cha = $request->ten_cha;
        $hoc_sinh->ngay_sinh_cha = $request->ngay_sinh_cha;
        $hoc_sinh->cmtnd_cha = $request->cmtnd_cha;
        $hoc_sinh->dien_thoai_cha = $request->dien_thoai_cha;
        $hoc_sinh->ten_me = $request->ten_me;
        $hoc_sinh->ngay_sinh_me = $request->ngay_sinh_me;
        $hoc_sinh->cmtnd_me = $request->cmtnd_me;
        $hoc_sinh->dien_thoai_me = $request->dien_thoai_me;
        $hoc_sinh->ho_khau_thuong_tru_matp = $request->ho_khau_thuong_tru_matp;
        $hoc_sinh->ho_khau_thuong_tru_maqh = $request->ho_khau_thuong_tru_maqh;
        $hoc_sinh->ho_khau_thuong_tru_xaid = $request->ho_khau_thuong_tru_xaid;
        $hoc_sinh->ho_khau_thuong_tru_so_nha = $request->ho_khau_thuong_tru_so_nha;
        $hoc_sinh->noi_o_hien_tai_matp = $request->noi_o_hien_tai_matp;
        $hoc_sinh->noi_o_hien_tai_maqh = $request->noi_o_hien_tai_maqh;
        $hoc_sinh->noi_o_hien_tai_xaid = $request->noi_o_hien_tai_xaid;
        $hoc_sinh->noi_o_hien_tai_so_nha = $request->noi_o_hien_tai_so_nha;
        $hoc_sinh->avatar = $request->avatar;
        $hoc_sinh->update();

        return redirect()->back()->with("message","Cập nhật tài khoản thành công !");
  }
    public function gopTaiKhoan(Request $request){
        $array_id_tk = $request->array_account;
        $id_chinh = $request->id_tk_chinh;
        $arr = [];
        $arr2 = [];
        foreach($array_id_tk as $val){
            if($val !== $id_chinh){
                array_push($arr,$val);
                $hs_tk_gop =  $this->HocSinhRepository->getHocSinhByIdTk($val);
                foreach($hs_tk_gop as $hs){
                array_push($arr2,$hs->id);
                $this->HocSinhRepository->updateHocSinh($hs->id,['user_id' => $id_chinh]);
                    }
                $this->AccountRepository->update($val,['active' => 0]);
            }
        }
        return 'ok';
    }
    public function listHocSinh($id){
        $data=User::find($id)->HocSinh;
        return view('quan-ly-tai-khoan.ds-hoc-sinh-gop-tk',compact('data'));
    }

    public function editTkHocSinh($id)
    {
        $data = User::where('id', $id)
                    ->where('active', '!=', 0)
                    ->first();
        if(!$data){
            return redirect()->route('account.ds-hs');
        }

        return view('quan-ly-tai-khoan.update-hoc-sinh', compact('data'));
    }

    public function updateTkHocSinh(UpdateTkHocSinh $request, $id)
    {
        $data = User::find($id);
        if(!$data){
            return redirect()->route('account.ds-hs');
        }
        $data->email = $request->email;
        $data->phone_number = $request->phone_number;
        $data->avatar = $request->avatar;
        $data->save();
        return redirect()->back()->with("message","Cập nhật tài khoản thành công !");
    }
}
