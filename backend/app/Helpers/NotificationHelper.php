<?php
namespace App\Helpers;

use App\Models\Notification;

class NotificationHelper{
    public static function notification($module,$itemid){
        $notification_model = new Notification();
        $notification_model->module = $module;
        $notification_model->module_item_id = $itemid;
        $notification_model->save();
    }
}