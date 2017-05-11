<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = "giatri";
   	protected $primaryKey = "id";
    public $timestamps = false;
}
