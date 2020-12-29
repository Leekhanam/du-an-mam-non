<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class jobSmS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $params;

    public function __construct( $params )
    {
        $this->params = $params;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $HostDomain = config('common.HostDomain_servesms');
        $key        = config('common.key_servesms');
        $devices    = config('common.devices_servesms');
        $Api_SMS    = $HostDomain .'key=' . $key .'&number=' . $this->params['number'] .
        '&message=T%E1%BA%A1o+t%C3%A0i+kho%E1%BA%A3n+th%C3%A0nh+c%C3%B4ng%21%0D%0AEmail%3A+' . $this->params['email'] . 
        '%0D%0APassword%3A+'. $this->params['password'] .'%0D%0AVui+l%C3%B2ng+thay+%C4%91%E1%BB%95i+m%E1%BA%ADt+kh%E1%BA%A9u&amp;&devices=' . $devices;
        $response   = Http::get($Api_SMS);
        $result     = $response->json();
        return $result;
    }
}
