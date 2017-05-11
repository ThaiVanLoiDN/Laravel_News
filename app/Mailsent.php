<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mailsent extends Model
{
    protected $table = "mailsent";
   	protected $primaryKey = "id";
    public $timestamps = false;
}
