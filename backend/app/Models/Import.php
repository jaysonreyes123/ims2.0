<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    //
    public function set_table($table){
        $this->setTable($table);
    }
    
}
