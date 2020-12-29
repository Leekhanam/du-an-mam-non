<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class jobThongBaoToiGiaoVien implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $users_id;
    protected $dataCreate;
    protected $NotificationRepository;
    protected $ThongBaoRepository;

    public function __construct(
        $users_id, 
        $dataCreate,
        $NotificationRepository,
        $ThongBaoRepository
        )
    {
        $this->users_id = $users_id;
        $this->dataCreate = $dataCreate;
        $this->NotificationRepository = $NotificationRepository;
        $this->ThongBaoRepository = $ThongBaoRepository;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->users_id as $user_id) {
            $this->NotificationRepository->createNotifications($this->dataCreate['title'],
                                                               $this->dataCreate['content'],
                                                               $this->dataCreate['route'],
                                                               $user_id, 
                                                               config('common.notification_role.giao_vien'),
                                                               $this->dataCreate['auth_id']);

            $this->ThongBaoRepository->create([
                'thongbao_id' => $this->dataCreate['thongbao_id'],
                'user_id' => $user_id,
            ]);
        };
        return;
    }
}
