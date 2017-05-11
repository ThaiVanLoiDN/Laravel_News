<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\News;
use App\Cats;

class IndexController extends Controller
{
    public function index(){
    	$arCats = Cats::all()->toArray();

    	foreach ($arCats as $key => $arCat) {
    		$cid = $arCat['id'];

    		$arNews[$cid] = News::where('cat_id', $cid)->where('is_active', 1)->select('id as nid', 'name as nname', 'picture', 'preview')->take(5)->get()->toArray();

    	}

        return view('index.index', ['arCats' => $arCats, 'arNews' => $arNews]);
    }
}
