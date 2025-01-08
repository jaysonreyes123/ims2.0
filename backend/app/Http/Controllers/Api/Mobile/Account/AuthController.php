<?php

namespace App\Http\Controllers\Api\Mobile\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //

    public function login(Request $request){
        $myfile = fopen("api-logs.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $request->email);
        fclose($myfile);
    }
}
