<?php

namespace App\Observers;

use App\Models\IncidentModel;
use App\Models\NotificationSetting;
use App\Models\Recipient;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendGmail;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class IncidentModelObserver
{
    /**
     * Handle the IncidentModel "created" event.
     */
    public function created(IncidentModel $incidentModel): void
    {
        $sensor_id = $incidentModel->sensor_id;
        $notificationContents = NotificationSetting::where('sensor_id', $sensor_id)->get();

        foreach($notificationContents as $notification){
            //parse message body
            $parse_message = explode("$",$notification->body);
            $search = [];
            $replace = [];
            foreach($parse_message as $message){
                $parse_ = explode("-",$message);
                //check to determine if the message is variable
                if(count($parse_) == 2){
                    $table = $parse_[0];
                   
                    //check if the table is existing
                    if(Schema::hasTable($table)){
                       
                        $search[] = "$".$message."$";
                        $id = 0;
                        $column = $parse_[1];
                        
                        if($table == "stations"){
                            $id = $notification->sensors->station_id;
                        }
                        else if($table == "sensor_types"){
                            $id = $notification->sensors->sensor_type;
                            //change the column to description if the column selected is type
                            if($column == "type"){
                                $column = "description";
                            }
                        }
                        else if($table == "warnings"){
                            $id = $incidentModel->warnings->id;
                        }
                        $sql = DB::table($table)->select($column)->where("id",$id)->first();
                        $replace[] = $sql->$column;
                    }
                }
            }
            $body_message = str_replace($search,$replace,$notification->body);
            $recipients = Recipient::whereIn('id', $notification->recipient)->get();
            foreach($recipients as $recipient){
                if($recipient->emails){
                    Mail::to($this->stringToArray($recipient->emails))->send(new SendGmail($notification->name, $body_message));
                }

                if($recipient->mobile_nos){
                    foreach($this->stringToArray($recipient->mobile_nos) as $mobile){
                        try{
                            $url = "http://172.46.16.117/cgi/WebCGI?1500101=account=apiuser&password=apipass&port=1&destination=".$mobile."&content=" . $body_message;
                            Http::get($url);
                        } catch (RequestException $e) {}
                        $cnt = count($this->stringToArray($recipient->mobile_nos));
                        if($cnt > 1) { sleep(11); }
                    }
                }
            }
        }
    }

    public function stringToArray($string) {
    	$jsonString = str_replace("'", '"', $string);
    	$array = json_decode($jsonString, true);
    	return $array;
    }


    /**
     * Handle the IncidentModel "updated" event.
     */
    public function updated(IncidentModel $incidentModel): void
    {
        //
    }

    /**
     * Handle the IncidentModel "deleted" event.
     */
    public function deleted(IncidentModel $incidentModel): void
    {
        //
    }

    /**
     * Handle the IncidentModel "restored" event.
     */
    public function restored(IncidentModel $incidentModel): void
    {
        //
    }

    /**
     * Handle the IncidentModel "force deleted" event.
     */
    public function forceDeleted(IncidentModel $incidentModel): void
    {
        //
    }
}
