<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThongTinTruong;
use App\Http\Requests\ThongTinTruong\storeThongTinTruong;

class NhaTruongController extends Controller
{
    public function index()
    {
        $data =ThongTinTruong::all()->first();
        return view('nha-truong.index', compact('data'));
    }

    public function store(storeThongTinTruong $request)
    {
        $data = ThongTinTruong::all()->first();
        if(!$data){
            $data = ThongTinTruong::insert([
                'name' => $request->name,
                'address' => json_encode($request->address),
                'hotline' => $request->hotline,
                'email' => $request->email
            ]);
        }else {
            $data->name = $request->name;
            $data->address = json_encode($request->address);
            $data->hotline = $request->hotline;
            $data->email = $request->email;
            $data->save();
        }
        return redirect()->route('nha-truong.index');
    }
}
