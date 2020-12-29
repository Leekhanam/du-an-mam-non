<?php

namespace App\Http\Controllers;

use App\Jobs\jobThongBaoToiGiaoVien;
use App\Jobs\jobThongBaoToiHocSinh;
use App\Repositories\GiaoVienRepository;
use App\Repositories\NamHocRepository;
use App\Repositories\HocSinhRepository;
use App\Repositories\NoiDungThongBaoRepository;
use App\Repositories\NotificationRepository;
use App\Repositories\ThongBaoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ThongBaoController extends Controller
{
    protected $HocSinhRepository;
    protected $GiaoVienRepository;
    protected $NamHocRepository;
    protected $ThongBaoRepository;
    protected $NoiDungThongBaoRepository;
    protected $NotificationRepository;

    public function __construct(
        HocSinhRepository $HocSinhRepository,
        GiaoVienRepository $GiaoVienRepository,
        NamHocRepository $NamHocRepository,
        ThongBaoRepository $ThongBaoRepository,
        NoiDungThongBaoRepository $NoiDungThongBaoRepository,
        NotificationRepository $NotificationRepository

    ) {
        $this->HocSinhRepository = $HocSinhRepository;
        $this->GiaoVienRepository = $GiaoVienRepository;
        $this->NamHocRepository = $NamHocRepository;
        $this->ThongBaoRepository = $ThongBaoRepository;
        $this->NoiDungThongBaoRepository = $NoiDungThongBaoRepository;
        $this->NotificationRepository = $NotificationRepository;
    }

    public function index()
    {
        $data = $this->NoiDungThongBaoRepository->getNoiDungThongBao();
        return view('thong-bao.index', compact('data'));
    }

    public function showThongBao($id)
    {
        $data = $this->NoiDungThongBaoRepository->findById($id);
        if ($data) {
            return view('thong-bao.chitiet', compact('data'));
        } else {
            return redirect()->route('thong-bao.index');
        }
    }

    public function uiThongBaoToanTruong()
    {
        $listId_Gv = $this->GiaoVienRepository->getAllUserIdGiaoVien();
        return view('thong-bao.toantruong', compact('listId_Gv'));
    }

    public function uiThongBaoGiaoVien()
    {
        $data = $this->GiaoVienRepository->getAll();
        return view('thong-bao.giaovien', compact('data'));
    }
    
    public function uiThongBaoHocSinh()
    {
        $data = $this->NamHocRepository->layNamHocHienTai();
        return view('thong-bao.hocsinh', compact('data'));
    }

    /* Gửi thông báo tới toàn bộ Nhà trường
     * @author: phucnv
     * @created_at 10/11/2020
     */
    public function guiToanTruong(Request $request)
    {
        $listId_Gv = json_decode($request->listId_Gv);
        $listHocSinh = $this->HocSinhRepository->getAllHocSinhTrongNamHocHienTai();

        $list_id_hoc_sinh = [];
        $list_device = [];
        foreach($listHocSinh as $hoc_sinh){
            array_push($list_id_hoc_sinh, $hoc_sinh->id);
            array_push($list_device, !empty($hoc_sinh->User->device) ? $hoc_sinh->User->device : 'gg');
        }

        $content = [
            "title"   => $request->title,
            "content" => $request->content,
            "auth_id" => Auth::id(),
            "type"    => 1
        ];

        $dataCreate = [
            'title'     => $request->title,
            'content'   => $request->content,
            'auth_id'   => Auth::id(),
            'type'      => config('common.noi_dung_thong_bao_type.toan_truong')
        ];
        $id_noi_dung_thong_bao = $this->NoiDungThongBaoRepository->create($dataCreate)->id;

        $list_id_hoc_sinh_save_noti=[];
        foreach ($list_id_hoc_sinh as $key => $value){
            $user_id =['user_id' => $value,
                    'id_hs' => $value, 
                    "route"   => json_encode([
                        'name_route' => 'ShowThongBao',
                        'id_hs' => $value,
                        'id' => $id_noi_dung_thong_bao
                    ]),
                    'role'    => config('common.notification_role.hoc_sinh')
            ];
            $data_notifi = collect([$user_id,$content]);
            $data_save_notifi = $data_notifi->collapse();
            $list_id_hoc_sinh_save_noti[$key] = $data_save_notifi->toArray();
        }
        foreach ($list_device as $key => $value){
            $content['device'] = $value;
            $content['route'] = [
                'name_route' => 'ShowThongBao',
                'id' => $id_noi_dung_thong_bao,
                'id_hs' => $list_id_hoc_sinh[$key],
            ];
            $data_device = collect([$content]);
            $data_send_device = $data_device->collapse();
            $list_device[$key] = $data_send_device;
        }

        $link = [
            'route_name' => 'thong-bao.show',
            'params'     => ['id' => $id_noi_dung_thong_bao],
        ];
        $route = json_encode($link);
        $dataCreate['route'] = $route;
        $dataCreate['thongbao_id'] = $id_noi_dung_thong_bao;

        $list_id_hoc_sinh_save_thong_bao = [];
        foreach ($list_id_hoc_sinh as $key => $value) {
            $user_id = ['user_id'     =>  $value,
                        'thongbao_id' =>  $id_noi_dung_thong_bao
            ];
            array_push($list_id_hoc_sinh_save_thong_bao, $user_id);
        }

        jobThongBaoToiGiaoVien::dispatch($listId_Gv, $dataCreate, $this->NotificationRepository, $this->ThongBaoRepository);
        jobThongBaoToiHocSinh::dispatch($list_id_hoc_sinh_save_noti, $list_id_hoc_sinh_save_thong_bao, $list_device, $content, $this->NotificationRepository);
        return response()->json([
            'status'    => 'Gửi thông báo thành công',
            'code'      => 200,
        ], 200);
    }

    /* Gửi thông báo tới Giáo Viên tùy chọn
     * @author: phucnv
     * @created_at 10/11/2020
     */
    public function guiGiaoVien(Request $request)
    {
        $users_id = $request->user_id;
        $dataCreate = [
            'title'     => $request->title,
            'content'   => $request->content,
            'auth_id'   => Auth::id(),
            'type'      => $request->type
        ];
        $thongbao_id = $this->NoiDungThongBaoRepository->create($dataCreate)->id;

        $link = [
            'route_name' => 'thong-bao.show',
            'params'     => ['id' => $thongbao_id],
        ];
        $route = json_encode($link);
        $dataCreate['route'] = $route;
        $dataCreate['thongbao_id'] = $thongbao_id;

        jobThongBaoToiGiaoVien::dispatch($users_id, $dataCreate, $this->NotificationRepository, $this->ThongBaoRepository);

        return response()->json([
            'status'    => 'Gửi thông báo thành công',
            'code'      => 200,
        ], 200);
    }

    /* Gửi thông báo tới Học Sinh tùy chọn
     * @author: phucnv
     * @created_at 10/11/2020
     */
    public function guiHocSinh(Request $request)
    {
        $listId_Gv = [];
        $list_id_hoc_sinh = $request->user_id;
        $list_device = $request->device;
        if ($request->isCheck) {
            foreach ($request->lop_id as $val) {
                $data_giao_vien = DB::table('giao_vien')->select('user_id')->where('lop_id', $val)->get();
                if (count($data_giao_vien) > 0) {
                    foreach ($data_giao_vien as $item) {
                        array_push($listId_Gv, $item->user_id);
                    }
                }
            }
        }

        $content = [
            "title"   => $request->title,
            "content" => $request->content,
            "auth_id" => Auth::id(),
            "type"    => 1,
        ];

        $dataCreate = [
            'title'     => $request->title,
            'content'   => $request->content,
            'auth_id'   => Auth::id(),
            'type'      => config('common.noi_dung_thong_bao_type.hoc_sinh')
        ];
        $id_noi_dung_thong_bao = $this->NoiDungThongBaoRepository->create($dataCreate)->id;

        $list_id_hoc_sinh_save_noti = [];
        foreach ($list_id_hoc_sinh as $key => $value){
            $user_id =['user_id' => $value, 
                    'id_hs' => $value, 
                    "route"   => json_encode([
                        'name_route' => 'ShowThongBao',
                        'id_hs' => $value,
                        'id' => $id_noi_dung_thong_bao
                    ]),
                    'role'    => config('common.notification_role.hoc_sinh')
            ];
            $data_notifi = collect([$user_id,$content]);
            $data_save_notifi = $data_notifi->collapse();
            $list_id_hoc_sinh_save_noti[$key] = $data_save_notifi->toArray();
        }
        foreach ($list_device as $key => $value){
            $content['device'] = $value;
            $content['route'] = [
                'name_route' => 'ShowThongBao',
                'id' => $id_noi_dung_thong_bao,
                'id_hs' => $list_id_hoc_sinh[$key],
            ];

            $data_device = collect([$content]);
            $data_send_device = $data_device->collapse();
            $list_device[$key] = $data_send_device;
        }

        $link = [
            'route_name' => 'thong-bao.show',
            'params'     => ['id' => $id_noi_dung_thong_bao],
        ];
        $route = json_encode($link);
        $dataCreate['route'] = $route;
        $dataCreate['thongbao_id'] = $id_noi_dung_thong_bao;

        $list_id_hoc_sinh_save_thong_bao = [];
        foreach ($list_id_hoc_sinh as $key => $value) {
            $user_id = ['user_id'     =>  $value,
                        'thongbao_id' =>  $id_noi_dung_thong_bao
            ];
            array_push($list_id_hoc_sinh_save_thong_bao, $user_id);
        }

        jobThongBaoToiHocSinh::dispatch($list_id_hoc_sinh_save_noti, $list_id_hoc_sinh_save_thong_bao, $list_device, $content, $this->NotificationRepository);
        jobThongBaoToiGiaoVien::dispatch($listId_Gv, $dataCreate, $this->NotificationRepository, $this->ThongBaoRepository);
        return response()->json([
            'status'    => 'Gửi thông báo thành công',
            'code'      => 200,
        ], 200);

    }

    public function create()
    {
        $listId_Gv = $this->GiaoVienRepository->getAllUserIdGiaoVien();
        $gv = $this->GiaoVienRepository->getAll();
        $data = $this->NamHocRepository->layNamHocHienTai();
        return view('thong-bao.create', compact('listId_Gv', 'gv', 'data'));
    }

}
