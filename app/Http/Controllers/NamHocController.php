<?php

namespace App\Http\Controllers;

use App\Repositories\NamHocRepository;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\NamHoc;
use DateTime;
use App\Rules\CheckEndDateRule;

class NamHocController extends Controller
{
    public $NamHocRepository;
    public function __construct(NamHocRepository $NamHocRepository)
    {
        $this->NamHocRepository = $NamHocRepository;
    }

    public function index()
    {
        $checkNew = $this->NamHocRepository->checkNew();
        $data = $this->NamHocRepository->getAllNamHoc();
        return view('nam-hoc.index', compact('data', 'checkNew'));
    }

    public function store(Request $request)
    {
        $nam_hoc_last = NamHoc::latest()->first();
        $end_date_last_year = Carbon::createFromFormat('Y-m-d', $nam_hoc_last->end_date);

        $thoi_gian = $this->validateDate($request->start_date) ? $request->start_date : Carbon::now()->toDateString();
        $start_date =  Carbon::createFromFormat('Y-m-d', $thoi_gian)->addMonths(8)->toDateString();
        unset($request['_token']);
        $validator = $request->validate([
            'start_date' => 'required|date|before:end_date|after:'. $end_date_last_year,
            'end_date' => 'required|date|after:'. $start_date,
        ], [
            'required' => 'Hãy nhập thời gian',
            'start_date.before' => 'Thời gian bắt đầu phải nhỏ hơn thời gian kết thúc',
            'start_date.after' => 'Thời gian bắt đầu năm học phải lớn hơn thời gian kết thúc năm học trước',
            'end_date.after' => 'Hãy nhập thời gian kết thúc năm học theo đúng quy định',
        ]);
        $array_input = [
            'name' => Carbon::parse($request->start_date)->year . ' - ' . Carbon::parse($request->end_date)->year,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ];
        $result =  $this->NamHocRepository->lock();
        $data = $this->NamHocRepository->create($array_input);
        $message = !$data ? ['error' => 'Thêm thất bại'] : ['success' => 'Thêm thành công'];
        return redirect()->route('nam-hoc.index')->withInput()->with($message);

    }
    public function chiTietNamHoc()
    {
        return view('nam-hoc.chi_tiet_nam_hoc');
    }

    public function lock(){
       $result =  $this->NamHocRepository->lock();
       return ['mess' => 'success','code' => 200];
    }

    public function khoiTaoNamHoc()
    {
        $count_nam_hoc = NamHoc::count();
        if ($count_nam_hoc) {
            return redirect()->route('home');
        }

        return view('nam-hoc.khoi-tao-nam-hoc');
    }

    function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    public function storekhoiTaoNamHoc(Request $request)
    {
        $thoi_gian = $this->validateDate($request->start_date) ? $request->start_date : Carbon::now()->toDateString();
        $start_date =  Carbon::createFromFormat('Y-m-d', $thoi_gian)->addMonths(8)->toDateString();
        unset($request['_token']);
        $validator = $request->validate([
            'start_date' => 'required|date|before:end_date',
            'end_date' => [
                'required',
                'date',
                'after:'. $start_date,
                new CheckEndDateRule($start_date)
            ]
        ], [
            'required' => 'Hãy nhập thời gian',
            'date' => 'Vui lòng nhập đúng định dạng thời gian',
            'start_date.before' => 'Thời gian bắt đầu phải nhỏ hơn thời gian kết thúc',
            'end_date.after' => 'Hãy nhập thời gian kết thúc năm học theo đúng quy định',
        ]);
        $array_input = [
            'name' => Carbon::parse($request->start_date)->year . ' - ' . Carbon::parse($request->end_date)->year,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'backup' => 1
        ];
        $data = $this->NamHocRepository->create($array_input);
        if(!$data){
            return redirect()->back()->withInput()->with(['error' => 'Thêm thất bại']);
        }
        return redirect()->route('nam-hoc.index')->withInput()->with(['success' => 'Thêm thành công']);
    }

    public function checkDateTaoNamHoc(Request $request)
    {
        $nam_hoc_last = NamHoc::latest()->first();
        $end_date_last_year = Carbon::createFromFormat('Y-m-d', $nam_hoc_last->end_date);
        $end_date_last_year_time = strtotime($end_date_last_year);
        
        $start_date = Carbon::createFromFormat('Y-m-d', $request->start_date);
        $start_date_time = strtotime($start_date);
        echo $end_date_last_year_time < $start_date_time ? "true" : "false";
    }
}
