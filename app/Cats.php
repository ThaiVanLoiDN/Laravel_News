<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cats extends Model
{
    protected $table = "cats";
   	protected $primaryKey = "id";
    public $timestamps = false;
}
