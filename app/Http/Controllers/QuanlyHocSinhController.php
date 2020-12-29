<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use \App\Repositories\LopRepository;
use \App\Repositories\KhoiRepository;
use  App\Repositories\HocSinhRepository;
use \App\Repositories\GiaoVienRepository;
use App\Repositories\TinhThanhPhoRepository;
use App\Repositories\QuanHuyenRepository;
use App\Repositories\XaPhuongThiTranRepository;
use App\Repositories\DoiTuongChinhSachRepository;
use App\Repositories\AccountRepository;
use Storage;
use Illuminate\Support\Facades\DB;
use App\Repositories\NamHocRepository;
use Carbon\Carbon;
use App\Models\LichSuHoc;
use App\Models\ThoiHoc;
use App\Repositories\LopHocRepository;
use App\Repositories\ChinhSachCuaHocSinhRepository;
use App\Http\Requests\HocSinh\UpdateHocSinh;
use App\Repositories\ChiTietDotThuTienRepository;
use App\User;

class QuanlyHocSinhController extends Controller
{
    protected $LopRepository;
    protected $Khoi;
    protected $HocSinhRepository;
    protected $GiaoVien;
    protected $TinhThanhPhoRepository;
    protected $QuanHuyenRepository;
    protected $XaPhuongThiTranRepository;
    protected $DoiTuongChinhSachRepository;
    protected $NamHocRepository;
    protected $AccountRepository;
    protected $KhoiRepository;
    protected $LopHocRepository;
    protected $ChinhSachCuaHocSinh;
    protected $ChiTietDotThuTienRepository;
    public function __construct(
        LopRepository $LopRepository,
        KhoiRepository $Khoi,
        HocSinhRepository $HocSinhRepository,
        GiaoVienRepository $GiaoVien,
        TinhThanhPhoRepository $TinhThanhPhoRepository,
        QuanHuyenRepository  $QuanHuyenRepository,
        XaPhuongThiTranRepository  $XaPhuongThiTranRepository,
        DoiTuongChinhSachRepository $DoiTuongChinhSachRepository,
        NamHocRepository $NamHocRepository,
        AccountRepository $AccountRepository,
        KhoiRepository $KhoiRepository,
        LopHocRepository $LopHocRepository,
        ChinhSachCuaHocSinhRepository $ChinhSachCuaHocSinhRepository,
        ChiTietDotThuTienRepository $ChiTietDotThuTienRepository

    ) {
        $this->LopRepository = $LopRepository;
        $this->Khoi = $Khoi;
        $this->HocSinhRepository = $HocSinhRepository;
        $this->GiaoVien = $GiaoVien;
        $this->TinhThanhPhoRepository = $TinhThanhPhoRepository;
        $this->QuanHuyenRepository = $QuanHuyenRepository;
        $this->XaPhuongThiTranRepository = $XaPhuongThiTranRepository;
        $this->DoiTuongChinhSachRepository = $DoiTuongChinhSachRepository;
        $this->NamHocRepository = $NamHocRepository;
        $this->AccountRepository = $AccountRepository;
        $this->KhoiRepository = $KhoiRepository;
        $this->LopHocRepository = $LopHocRepository;
        $this->ChinhSachCuaHocSinhRepository = $ChinhSachCuaHocSinhRepository;
        $this->ChiTietDotThuTienRepository = $ChiTietDotThuTienRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $url = file_get_contents("https://raw.githubusercontent.com/duyet/vietnamese-namedb/master/uit_member.json");
        // $json = json_decode($url);
        // dd($json[100]->full_name);

        $params = request()->all();
        if (isset(request()->page_size)) {
            $limit = request()->page_size;
        } else {
            $limit = 20;
        }
        $khoi = $this->Khoi->getAllKhoi();
        $lop = $this->LopHoc->getAll();
        $hoc_sinh = $this->HocSinh->getAllHocSinh_table($params, $limit);

        foreach ($hoc_sinh as $key => $item) {
            $lophoc = $this->GiaoVien->getLopHoc($item->lop_id);
            if (isset($lophoc)) {
                $hoc_sinh[$key]->ten_lop = $lophoc->ten_lop;
                $hoc_sinh[$key]->ten_khoi = $lophoc->ten_khoi;
            } else {
                $hoc_sinh[$key]->ten_lop = "";
                $hoc_sinh[$key]->ten_khoi = "";
            }
        }

        return view('quan-ly-hoc-sinh.index', compact('khoi', 'hoc_sinh', 'limit', 'lop'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quan-ly-hoc-sinh.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        dd($this->LopHoc->getAllLopHoc());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $thanhpho = $this->TinhThanhPhoRepository->getAllThanhPho();
        $data = $this->HocSinhRepository->getOneHocSinh($id);
        $khoi = $this->KhoiRepository->getAllKhoi();
        $lop_hoc = $this->LopHocRepository->getAll();
        $data->khoi_hs_id = 0;
        if($data->lop_id > 0){
            $khoi_hs = $this->LopHocRepository->getOneKhoiTheoLop($data->lop_id);
        }
        
        
        if(isset($khoi_hs)){
            $data->khoi_hs_id = $khoi_hs->id;
        }
        
        
        $doi_tuong_chinh_sach = $this->DoiTuongChinhSachRepository->getAllDoiTuongChinhSach();
        $chinh_sach_hoc_sinh = $this->ChinhSachCuaHocSinhRepository->getChinhSachCuaHocSinh($id);
        $maqh_hs_hktt = $this->QuanHuyenRepository->getQuanHuyenByMaTp($data->ho_khau_thuong_tru_matp);
        $xaid_hs_hktt = $this->XaPhuongThiTranRepository->getXaPhuongThiTranByMaPh($data->ho_khau_thuong_tru_maqh);
        $maqh_hs_noht = $this->QuanHuyenRepository->getQuanHuyenByMaTp($data->noi_o_hien_tai_matp);
        $xaid_hs_noht = $this->XaPhuongThiTranRepository->getXaPhuongThiTranByMaPh($data->noi_o_hien_tai_maqh);
        
        return view('quan-ly-hoc-sinh.edit', compact(
            'data',
            'thanhpho',
            'maqh_hs_hktt',
            'xaid_hs_hktt',
            'maqh_hs_noht',
            'xaid_hs_noht',
            'doi_tuong_chinh_sach',
            'id',
            'khoi',
            'lop_hoc',
            'chinh_sach_hoc_sinh'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHocSinh $request, $id)
    {
        $dataRequest = $request->all();
        if($dataRequest['avatar'] == null){
            unset($dataRequest['avatar']);
        }
        $this->ChinhSachCuaHocSinhRepository->getDeleteChinhSachHocSinh($id);
        // dd($dataRequest);
        if(isset($dataRequest['dien_uu_tien'])){
            foreach($dataRequest['dien_uu_tien'] as $item){
                $arr = [
                    'id_chinh_sach' => $item,
                    'id_hoc_sinh' => $id
                ];
                $this->ChinhSachCuaHocSinhRepository->getInsertChiTietChinhSachHocSinh($arr);
                $this->HocSinhRepository->ThayDoiChinhSachHocSinh($id, 1);
            }
            unset($dataRequest['dien_uu_tien']);
        }
        else{
            $this->HocSinhRepository->ThayDoiChinhSachHocSinh($id, 0);
        }
        unset($dataRequest['_token']);
        
        $this->HocSinhRepository->updateHocSinh($id, $dataRequest);
        
        return redirect()->route('quan-ly-hoc-sinh-edit', ['id' => $id])->with('thongbaocapnhat', 'Thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function createSpreadSheet($fileRead, $duoiFile)
    {
        if ($duoiFile == 'xls') {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($fileRead);
        return $spreadsheet;
    }

    public function dataListValidation($spreadsheet, $mavalue, $o)
    {
        $validation = $spreadsheet->getActiveSheet()->getCell($o)
            ->getDataValidation();
        $validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
        $validation->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION);
        $validation->setAllowBlank(false);
        $validation->setShowInputMessage(true);
        $validation->setShowErrorMessage(true);
        $validation->setShowDropDown(true);
        $validation->setErrorTitle('Input error');
        $validation->setError('Value is not in list.');
        $validation->setPromptTitle('Pick from list');
        $validation->setPrompt('Please pick a value from the drop-down list.');
        $validation->setFormula1($mavalue);
    }

    public function exportBieuMau(Request $request)
    {
        $id_lop = $request->id_lop;
        $lop = $this->LopHoc->getOneLop($id_lop);
        $spreadsheet = IOFactory::load('excel/hoc-sinh.xlsx');
        $worksheet = $spreadsheet->getActiveSheet();

        $worksheet->setCellValue('A1', "Lớp: $lop->ten_lop - $id_lop");
        $worksheet->getStyle('F7')
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DATETIME);

        // for($i = 7 ; $i <50 ; $i++){
        // }
        $mavalueTP_noi_o = '=OFFSET(MA_TINH!$B$1, 1, 0, MATCH("ZZZZZZZZ", MA_TINH!$B:$B)-1)';
        $mavalueQH_noi_o = '=OFFSET(MA_HUYEN!$C$1,MATCH($H7,MA_HUYEN!$D$2:$D$714,0),,COUNTIF(MA_HUYEN!$D$2:$D$714,$H7))';
        $mavalueXP_noi_o = '=OFFSET(MA_PHUONGXA!$E$1,MATCH($I7,MA_PHUONGXA!$F$2:$F$11165,0),,COUNTIFS(MA_PHUONGXA!$G$2:$G$11165,$H7,MA_PHUONGXA!$F$2:$F$11165,$I7))';

        $mavalueTP_ho_khau = '=OFFSET(MA_TINH!$B$1, 1, 0, MATCH("ZZZZZZZZ", MA_TINH!$B:$B)-1)';
        $mavalueQH_ho_khau = '=OFFSET(MA_HUYEN!$C$1,MATCH($M7,MA_HUYEN!$D$2:$D$714,0),,COUNTIF(MA_HUYEN!$D$2:$D$714,$M7))';
        $mavalueXP_ho_khau = '=OFFSET(MA_PHUONGXA!$E$1,MATCH($N7,MA_PHUONGXA!$F$2:$F$11165,0),,COUNTIFS(MA_PHUONGXA!$G$2:$G$11165,$M7,MA_PHUONGXA!$F$2:$F$11165,$N7))';



        for ($i = 7; $i <= 56; $i++) {

            $this->dataListValidation($spreadsheet, $mavalueTP_noi_o, 'H' . $i);
            $this->dataListValidation($spreadsheet, $mavalueQH_noi_o, 'I' . $i);
            $this->dataListValidation($spreadsheet, $mavalueXP_noi_o, 'J' . $i);

            $this->dataListValidation($spreadsheet, $mavalueTP_ho_khau, 'M' . $i);
            $this->dataListValidation($spreadsheet, $mavalueQH_ho_khau, 'N' . $i);
            $this->dataListValidation($spreadsheet, $mavalueXP_ho_khau, 'O' . $i);
        }


        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="File-nhap-hoc-sinh.xlsx"');
        $writer->save("php://output");
    }


    public function getLopOfKhoi(Request $request)
    {
        $id = $request->id;
        return $this->LopHoc->getLopHocOfKhoi($id);
    }

    public function changedate_excel($date_seria)
    {
        $excel_date = $date_seria; //here is that value 41621 or 41631
        $unix_date = ($excel_date - 25569) * 86400;
        $excel_date = 25569 + ($unix_date / 86400);
        $unix_date = ($excel_date - 25569) * 86400;
        return gmdate("Y-m-d", $unix_date);
    }

    public function checkError($data)
    {
        $arrayKey =  ['B', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC'];
        $vitri = [];
        for ($i = 5; $i < count($data); $i++) {
            $key_aphabel = -1;
            $rowNumber = $i + 1;
            if ($data[$i][11] != " -  - ") {
                for ($j = 0; $j < count($arrayKey); $j++) {
                    $key_aphabel++;
                    if ($data[$i][$j] == null || $data[$i][$j] == "") {
                        array_push($vitri, $arrayKey[$j] . $i);
                    }
                }
            }
        }

        return $vitri;
    }

    public function importFile(Request $request)
    {
        $ngay_vao_truong = $request->ngay_vao_truong;
        $arrayKey =  ['B', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC'];
        $nameFile = $request->file->getClientOriginalName();
        $nameFileArr = explode('.', $nameFile);
        $duoiFile = end($nameFileArr);
        $fileRead = $_FILES['file']['tmp_name'];
        $spreadsheet = $this->createSpreadSheet($fileRead, $duoiFile);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $lop = explode(' - ', $data[0][0]);
        $lop_id = trim(array_pop($lop));
        // dd($data);
        $lopCheck = DB::table('lop_hoc')->find($lop_id);

        if ($lopCheck == null) {
            return response()->json(['messageError' => 'Lớp không tồn tại'], 200);
        }

        $vitri = $this->checkError($data);
        $arrayData = [];
        $insertData = [];
        if ($vitri == null || $vitri == '') {
            for ($i = 6; $i < count($data); $i++) {
                if ($data[$i][11] != " -  - " || $data[$i][16] != " -  - ") {
                    $ngay_sinh = $this->changedate_excel($data[$i][5]);
                    $ngay_sinh_cha = $this->changedate_excel($data[$i][21]);
                    $ngay_sinh_me = $this->changedate_excel($data[$i][25]);

                    $noi_o_string = $data[$i][11];
                    $ho_khau_string = $data[$i][16];
                    $noi_o = explode(" - ", $noi_o_string);
                    $ho_khau = explode(" - ", $ho_khau_string);
                    $arrayData = [
                        'ten' => $data[$i][1],
                        'ten_thuong_goi' => $data[$i][2],
                        'dan_toc' => $data[$i][3],
                        'gioi_tinh' => $data[$i][4],
                        'ngay_sinh' => $ngay_sinh,
                        'noi_sinh' => $data[$i][6],

                        'noi_o_hien_tai_matp' => $noi_o[0],
                        'noi_o_hien_tai_maqh' => $noi_o[1],
                        'noi_o_hien_tai_xaid' => $noi_o[2],
                        'noi_o_hien_tai_so_nha' => $data[$i][10],

                        'ho_khau_thuong_tru_matp' => $ho_khau[0],
                        'ho_khau_thuong_tru_maqh' => $ho_khau[1],
                        'ho_khau_thuong_tru_xaid' => $ho_khau[2],
                        'ho_khau_thuong_tru_so_nha' => $data[$i][15],

                        'doi_tuong_chinh_sach_id' => $data[$i][17],
                        'hoc_sinh_khuyet_tat' => $data[$i][18],
                        'dien_thoai_dang_ki' => $data[$i][19],

                        'ten_cha' => $data[$i][20],
                        'ngay_sinh_cha' => $ngay_sinh_cha,
                        'cmtnd_cha' => $data[$i][22],
                        'dien_thoai_cha' => $data[$i][23],

                        'ten_me' => $data[$i][24],
                        'ngay_sinh_me' => $ngay_sinh_me,
                        'cmtnd_me' => $data[$i][26],
                        'dien_thoai_me' => $data[$i][27],
                        'ngay_vao_truong' => $ngay_vao_truong,
                        'lop_id' => $lop_id
                    ];
                    array_push($insertData, $arrayData);
                }
            }
            // dd($insertData);
            $this->HocSinh->createHocSinh($insertData);
            return response()->json('ok', 200);
        } else {
            return response()->json(['messageError' => 'Lỗi rồi'], 200);
        }
    }


    public function errorFileImport(Request $request)
    {
        // $nameFile=$request->file_import->getClientOriginalName();
        // $nameFileArr=explode('.',$nameFile);
        // $duoiFile=end($nameFileArr);

        // $fileRead = $_FILES['file_import']['tmp_name'];
        // $pathLoad = Storage::putFile(
        //     'uploads/excels',
        //     $request->file('file_import')
        // );
        // $path = str_replace("/","\\",$pathLoad);
        // $fileReadStorage= storage_path('app\\'.$path);
        // // $fileReadStorage= storage_path('app/public/'.$pathLoad);

        // $spreadsheet = $this->createSpreadSheet($fileReadStorage,$duoiFile);
        // $data = $spreadsheet->getActiveSheet()->toArray();

        // // $truong = explode(' - ', $data[0][0]);
        // // $id_truong = trim(array_pop($truong));
        // // $arrayApha=['H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK'];
        // // $vitri=$this->checkError($data, $arrayApha, 8 , 7, 36);

        // $spreadsheet2 = IOFactory::load($fileReadStorage);
        // $worksheet = $spreadsheet2->getActiveSheet();
        // Storage::delete($path);
        // // $this->errorRebBackGroud($vitri,$worksheet);
        // $writer = IOFactory::createWriter($spreadsheet2, "Xlsx"); 
        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // header('Content-Disposition: attachment; filename="Error-file-nhap-so-lieu-tuyen-sinh.xlsx"');
        // $writer->save("php://output");
    }

    public function showHocSinhChuaCoLop(Request $request)
    {
        $lop_id = $request->id;
        $lop = $this->LopRepository->find($lop_id);
        $ten_lop = $lop->ten_lop;
        $tong_so_hs = $lop->tong_so_hoc_sinh;
        $hoc_sinh_nam_chua_co_lop = $this->HocSinhRepository->getAllHocSinhChuaCoLop(0);
        $hoc_sinh_nu_chua_co_lop = $this->HocSinhRepository->getAllHocSinhChuaCoLop(1);
        $do_tuoi = config('common.do_tuoi');
        unset($do_tuoi[0]);
        $id_nam_hoc = $this->NamHocRepository->maxID();
        $nam_hoc = $this->NamHocRepository->find($id_nam_hoc);
        // dd($id_nam_hoc);
        $data_hs_chua_co_lop = [];
        foreach ($do_tuoi as $key => $value) {
            $data_nu = $this->HocSinhRepository->getHocSinhChuaCoLopTheoDoTuoi($key, 1,$nam_hoc);
            $data_nam = $this->HocSinhRepository->getHocSinhChuaCoLopTheoDoTuoi($key, 0,$nam_hoc);
            $data_do_tuoi = [
                'do_tuoi' => $value,
                'nam' => $data_nam,
                'nu' => $data_nu,
            ];
            array_push($data_hs_chua_co_lop, $data_do_tuoi);
        }
        return [
            'ten_lop' => $ten_lop,
            'tong_so_hs' => $tong_so_hs,
            'hoc_sinh_nam_chua_co_lop' => $hoc_sinh_nam_chua_co_lop,
            'hoc_sinh_nu_chua_co_lop' => $hoc_sinh_nu_chua_co_lop,
            'data_hs_chua_co_lop' => $data_hs_chua_co_lop
        ];
    }

    public function chuyenLop(Request $request)
    {
        $lop_id = $request->lop_id;
        if($lop_id == 0){
            $lop_id =[];
        };
       
        $lop_id_chuyen = $request->lop_id_chuyen;
        $id_hs_chuyen_lop = $request->id_hs_chuyen_lop;
        $this->HocSinhRepository->chuyenLop($lop_id_chuyen, $id_hs_chuyen_lop);
        $lop_chuyen = $this->LopRepository->find($lop_id_chuyen);
        $lop_hien_tai = $this->LopRepository->find($lop_id);
        $sl_hs_cua_lop_chuyen_den = $lop_chuyen->tong_so_hoc_sinh;  
        if($lop_id == []){
            if ($request->trang_thai_hoc_sinh==1) {
                $sl_hs_cua_lop_hien_tai = $this->HocSinhRepository->getSlHocSinhType(1);
            }else{
                $sl_hs_cua_lop_hien_tai = $this->HocSinhRepository->getSlHocSinhType(0);
            }
            
        }else{
            $sl_hs_cua_lop_hien_tai = $lop_hien_tai->tong_so_hoc_sinh;
        };
        return [
            'sl_hs_cua_lop_chuyen_den' => $sl_hs_cua_lop_chuyen_den,
            'sl_hs_cua_lop_hien_tai' => $sl_hs_cua_lop_hien_tai,
        ];
    }

    public function thoiHoc(Request $request)
    {

        $id = $request->id;
        $ly_do_thoi_hoc = $request->ly_do_thoi_hoc;
        $hoc_sinh_cua_lop = $this->HocSinhRepository->find($id);

        $lich_su_hoc =
            [
                'hoc_sinh_id' => $hoc_sinh_cua_lop->id,
                'lop_id' => $hoc_sinh_cua_lop->lop_id,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];
        $thong_tin_thoi_hoc = [
            'hoc_sinh_id' => $hoc_sinh_cua_lop->id,
            'nam_hoc_id' => $hoc_sinh_cua_lop->Lop->Khoi->NamHoc->id,
            'ly_do_thoi_hoc' => $ly_do_thoi_hoc,

        ];
        LichSuHoc::create($lich_su_hoc);
        ThoiHoc::create($thong_tin_thoi_hoc);

        // $this->AccountRepository->KhoaTaiKhoan($hoc_sinh_cua_lop->User->id);
        $this->HocSinhRepository->update($id, ['lop_id' => 0, 'type' => 2]);
    }

    public function getThongTinThoiHoc(Request $request)
    {
        $id_hs = $request->id;
        $id_nam_hoc = $this->NamHocRepository->maxID();
        $hoc_sinh = $this->HocSinhRepository->find($id_hs);
        $ly_do_thoi_hoc = $hoc_sinh->ThoiHoc->ly_do_thoi_hoc;
        $nam_hoc = $this->NamHocRepository->find($id_nam_hoc);
        $tuoi_hoc_sinh = $this->HocSinhRepository->getTuoiHocSinh($id_hs,$nam_hoc);
        $khoiChoHocSinh = $nam_hoc->Khoi()->where('do_tuoi',$tuoi_hoc_sinh[0]->tuoi)->first();
        // dd($khoiChoHocSinh->LopHoc);
        return [
            'ly_do_thoi_hoc' => $ly_do_thoi_hoc,
            'lop_hoc' => $khoiChoHocSinh->LopHoc
            
        ];
        
    }

    public function xacNhanDiHocLai(Request $request)
    {
        $id_hs_nghi_hoc = $request->id_hs_nghi_hoc;
        $lop_chon_hoc_lai = $request->lop_chon_hoc_lai;
        $hoc_sinh = $this->HocSinhRepository->find($id_hs_nghi_hoc);
        $hoc_sinh->thoiHoc()->delete();

        $this->HocSinhRepository->update($id_hs_nghi_hoc, ['lop_id'=>$lop_chon_hoc_lai,'type'=>1]);
    }

    public function getLichSuHocSinh(Request $request){
        $request = $request->all();
        $hoc_sinh_id = $request['hoc_sinh_id'];
        $LopHocHienTai = $this->HocSinhRepository->getOneHocSinh($hoc_sinh_id);
        if($LopHocHienTai->lop_id > 0){
            $khoi_hs = $this->LopHocRepository->getOneKhoiTheoLop($LopHocHienTai->lop_id);
            $nam_hoc_ht = $this->KhoiRepository->getNamHoc($khoi_hs->id);
            $LopHocHienTai->ten_nam = $nam_hoc_ht->name;
            $LopHocHienTai->ten_lop = $khoi_hs->ten_lop;
        }
        $LichSuHocSinh = $this->HocSinhRepository->getLichSuCuaHocSinh($hoc_sinh_id);
        if(count($LichSuHocSinh)>0){
            foreach($LichSuHocSinh as $key => $item){
                
                $khoi_hs_ls = $this->LopHocRepository->getKhoiTheoLop($item->lich_su_lop_id);
                $nam_hoc_ht_ls = $this->NamHocRepository->getNamHocTheoKhoi($khoi_hs_ls->khoi_id);
                $LichSuHocSinh[$key]->ten_nam = $nam_hoc_ht_ls->name;
                $LichSuHocSinh[$key]->ten_lop_ls = $khoi_hs_ls->ten_lop;
            }
        }
        return [
            'LopHocHienTai' => $LopHocHienTai,
            'LichSuHocSinh' => $LichSuHocSinh
        ];
    }

    public function getHocPhiHocSinh(Request $request){
        $request = $request->all();
        $array_HocPhi = [];
        $id_nam_hoc = $this->NamHocRepository->maxID();
        $data = $this->ChiTietDotThuTienRepository->getAllChiTietDotThuHS($request['id']);
        $nam_hoc_all = $this->NamHocRepository->getAllNamHoc();
        if(count($data) > 0){
            foreach($nam_hoc_all as $item){
                $array_Nam = [];
                foreach($data as $item2){
                    if($item->id == $item2->id_nam_hoc){
                        array_push($array_Nam, $item2);
                    }
                }
                $arr = [
                    'ten_nam' => $item->name,
                    'nam_hoc' => $item->id,
                    'hoc_phi' => $array_Nam
                ];
                array_push($array_HocPhi, $arr);
            }
            
        }
        return [
            'id_nam_hoc' => $id_nam_hoc,
            'array_HocPhi' => $array_HocPhi
        ];
    }
}
