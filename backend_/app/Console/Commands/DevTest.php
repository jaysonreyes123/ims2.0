<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendGmail;
use App\Models\IncidentModel;
use App\Models\Recipient;
use Illuminate\Support\Facades\Http;

class DevTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev-test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //$email = "mark.santos@microbizone.com"; 
        //Mail::to($email)->send(new SendGmail("test subject", "test message"));
        //$this->info('Email sent successfully!');

	 $model = new IncidentModel();       
         $model->sensor_id = 1;                     
         $model->warning_id = 21;
         $model->value = 9.9;
         $model->status = 1;
         $model->save();

	//$response = Http::get('http://172.46.16.117/cgi/WebCGI?1500101=account=apiuser&password=apipass&port=1&destination=09998792184&content=testmessage');

	//dd($response->status());
	
    }

}
