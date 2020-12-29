<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Repositories\XaPhuongThiTranRepository;

class XaPhuongThiTranController extends Controller
{
    protected $XaPhuongThiTran;
    public function __construct(
        XaPhuongThiTranRepository $XaPhuongThiTran
    ){
        $this->XaPhuongThiTran = $XaPhuongThiTran;
    }

    public function getXaPhuongThiTranByMaPh(Request $request)
    {
        $maqh = $request->maqh;
        $quan_huyen = $this->XaPhuongThiTran->getXaPhuongThiTranByMaPh($maqh);  
        return $quan_huyen;
    }

    
}
