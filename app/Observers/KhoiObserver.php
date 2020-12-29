<?php

namespace App\Observers;

use App\Models\Khoi;
use App\Models\HocSinh;

class KhoiObserver
{
    /**
     * Handle the khoi "created" event.
     *
     * @param  \App\Khoi  $khoi
     * @return void
     */
    public function created(Khoi $khoi)
    {
        //
    }

    /**
     * Handle the khoi "updated" event.
     *
     * @param  \App\Khoi  $khoi
     * @return void
     */
    public function updated(Khoi $khoi)
    {
        //
    }

    /**
     * Handle the khoi "deleted" event.
     *
     * @param  \App\Khoi  $khoi
     * @return void
     */
    public function deleted(Khoi $khoi)
    {
       $lop_hoc = $khoi->LopHoc;
       foreach ($lop_hoc as $key => $item) {
        HocSinh::where('lop_id',$item->id)->update(['lop_id'=>0,'type'=>1]);
        HocSinh::where('lop_id',$item->id)->update(['lop_id'=>0,'type'=>0]);
       }
        $khoi->LopHoc()->delete();
    }

    /**
     * Handle the khoi "restored" event.
     *
     * @param  \App\Khoi  $khoi
     * @return void
     */
    public function restored(Khoi $khoi)
    {
        //
    }

    /**
     * Handle the khoi "force deleted" event.
     *
     * @param  \App\Khoi  $khoi
     * @return void
     */
    public function forceDeleted(Khoi $khoi)
    {
        //
    }
}
