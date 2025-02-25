<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use App\Http\Traits\HttpResponses;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
    use HttpResponses;
    public function notification(){
        $notification_model = Notification::with('module_')->orderByDesc('created_at')->limit(10)->get();
        return NotificationResource::collection($notification_model);
    }
    public function read($id){
        Notification::where('id',$id)->update(['status' => 0]);
        return $this->success($this->notification());
    }
}
