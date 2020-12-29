<?php

namespace App\Repositories;

use App\Models\Notification;
use App\Repositories\BaseModelRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
class NotificationRepository extends BaseModelRepository
{
    protected $model;
    public function __construct(
        Notification $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getModel()
    {
        return Notification::class;
    }

    public function createNotifications($title = '', $content = '', $route = '', $user_id = '', $role = 1, $auth_id = '')
    {
        $data = Notification::create([
            'title'         => $title,
            'content'       => $content,
            'route'         => $route,
            'user_id'       => $user_id,
            'role'          => $role,
            'auth_id'       => $auth_id,
            'type'          => 1,
            'bell'          => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        return $data;
    }

    public function notificationApp($data = [])
    {
        foreach ($data as $key => $value) {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'key='.config('common.key_firebase')
            ])->post('https://fcm.googleapis.com/fcm/send', [
                    "to" => $value['device'],
                    "notification" => [
                      "title"=> $value['title'],
                      "body"=> $value['content']
                    ],
                    "data"=> [
                      "story_id"=> "story_12345",
                      "route" => $value['route'],
                      'type'=>"add_donho"
                    ],
                ],
            );
        }
    }

}
