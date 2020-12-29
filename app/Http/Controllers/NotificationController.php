<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function changeType(Request $request)
    {
        $data = Notification::find($request->id);
        $data->type = $request->type;
        $data->save();
        return $data;
    }
}
