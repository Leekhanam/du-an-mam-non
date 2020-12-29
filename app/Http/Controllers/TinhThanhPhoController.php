<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Repositories\TinhThanhPhoRepository;

class TinhThanhPhoController extends Controller
{
    protected $TinhThanhPho;
    public function __construct(
        TinhThanhPhoRepository $TinhThanhPho
    ){
        $this->TinhThanhPho = $TinhThanhPho;
    }

    public function getAllThanhPho()
    {
        $thanh_pho = $this->TinhThanhPho->TinhThanhPho();  
        return $thanh_pho;
    }
}
