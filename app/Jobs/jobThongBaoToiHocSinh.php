<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Log;
use App\Models\Notification;
use App\Models\ThongBao;

class jobThongBaoToiHocSinh implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $data_save_notifi;
    protected $data_save_thong_bao;
    protected $data_send_device;
    protected $content;
    protected $NotificationRepository;

    public function __construct(
        $data_save_notifi, 
        $data_save_thong_bao, 
        $data_send_device, 
        $content, 
        $NotificationRepository)
    {
        $this->data_send_device = $data_send_device;
        $this->data_save_thong_bao = $data_save_thong_bao;
        $this->data_save_notifi = $data_save_notifi;
        $this->content = $content;
        $this->NotificationRepository = $NotificationRepository;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // return [
        //     $this->data_save_notifi,
        //     $this->data_save_thong_bao,
        //     $this->data_send_device
        // ];
        
        foreach ($this->data_save_notifi as  $noti_read_tiem) {
            Notification::create($noti_read_tiem);
        }
        foreach ($this->data_save_thong_bao as  $thong_bao) {
            ThongBao::create($thong_bao);
        }
        $this->NotificationRepository->notificationApp($this->data_send_device);
    }
}
