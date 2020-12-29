<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lop;
use App\Models\NhanXet;
use Illuminate\Http\Response;

class NhanXetController extends Controller
{
    public function show(Request $request)
    {
        $lop_id = request('id');
        $lop = Lop::find($lop_id);
        if($lop == null){
            return redirect()->route('nam-hoc.index');
        }
        $students = $lop->HocSinh;
        return view('nhan-xet.show', compact('students','lop'));
    }

    public function find(Request $request)
    {
        $data = NhanXet::where('hoc_sinh_id', request('hoc_sinh_id'))
        ->whereDate('created_at', request('search_time'))
        ->first();
        return response()->json($data, Response::HTTP_OK);
    }
}
