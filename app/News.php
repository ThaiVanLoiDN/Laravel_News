<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    protected $table = "news";
   	protected $primaryKey = "id";
    public $timestamps = false;

    public function getList()
    {
    	return DB::table("news as n")->join('cats as c', 'n.cat_id', '=', 'c.id')->join('users as u', 'u.id', '=', 'n.created_by')->select('n.*', 'n.name as nname', 'c.name as cname', 'u.fullname as uname')->orderBy('n.id', 'desc')->paginate(getenv('ROW_ADMIN'));
    }

    public function getDetail($id)
    {
    	return DB::table("news as n")->join('cats as c', 'n.cat_id', '=', 'c.id')->join('users as u', 'u.id', '=', 'n.created_by')->where('n.id','=', $id)->where('n.is_active', '=', 1)->select('n.*', 'n.name as nname', 'c.name as cname', 'u.fullname as uname')->get();
    }
}
