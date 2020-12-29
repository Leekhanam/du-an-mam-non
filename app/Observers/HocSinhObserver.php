<?php

namespace App\Observers;

use App\Models\HocSinh;
use App\User;

class HocSinhObserver
{
   
    public function created(HocSinh $HocSinh)
    {
    
    }

 
    public function updated(HocSinh $HocSinh)
    {
        //
    }


    public function deleted(HocSinh $HocSinh)
    {

    }

  
    public function restored(HocSinh $HocSinh)
    {
        //
    }


    public function forceDeleted(HocSinh $HocSinh)
    {
        //
    }
}
