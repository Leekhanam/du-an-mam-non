<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Repositories\QuanHuyenRepository;

class QuanHuyenController extends Controller
{
    protected $QuanHuyen;
    public function __construct(
        QuanHuyenRepository $QuanHuyen
    ){
        $this->QuanHuyen = $QuanHuyen;
    }

    public function getQuanHuyenByMaTp(Request $request)
    {
        $matp = $request->matp;
        return  $this->QuanHuyen->getQuanHuyenByMaTp($matp);  
       
    }
}
