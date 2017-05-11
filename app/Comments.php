<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comments extends Model
{
    protected $table = "comments";
   	protected $primaryKey = "id";
    public $timestamps = true;

    public function getList()
    {
    	return DB::table("comments as c")->join('news as n', 'c.news_id', '=', 'n.id')->select('c.*', 'n.name as nname', 'n.id as nid')->orderBy('c.id', 'desc')->paginate(getenv('ROW_ADMIN'));
    }

    public function getListFive()
    {
    	return DB::table("comments as c")->join('news as n', 'c.news_id', '=', 'n.id')->where('c.is_active', 1)->select('c.*', 'n.name as nname', 'n.id as nid', 'n.picture')->orderBy('c.id', 'desc')->take(5)->get();
    }
}
