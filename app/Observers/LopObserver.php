<?php

namespace App\Observers;

use App\Models\Lop;

class LopObserver
{
    /**
     * Handle the lop "created" event.
     *
     * @param  \App\Lop  $lop
     * @return void
     */
    public function created(Lop $lop)
    {
        //
    }

    /**
     * Handle the lop "updated" event.
     *
     * @param  \App\Lop  $lop
     * @return void
     */
    public function updated(Lop $lop)
    {
        //
    }

    /**
     * Handle the lop "deleted" event.
     *
     * @param  \App\Lop  $lop
     * @return void
     */
    public function deleted(Lop $lop)
    {
        $lop->GiaoVien()->update(['lop_id'=> 0,'type' => 0]);
        $lop->HocSinh()->update(['lop_id' => 0,'type'=>1 ]);
    }

    /**
     * Handle the lop "restored" event.
     *
     * @param  \App\Lop  $lop
     * @return void
     */
    public function restored(Lop $lop)
    {
        //
    }

    /**
     * Handle the lop "force deleted" event.
     *
     * @param  \App\Lop  $lop
     * @return void
     */
    public function forceDeleted(Lop $lop)
    {
        //
    }
}
