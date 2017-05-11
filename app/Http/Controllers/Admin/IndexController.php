<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cats;
use App\News;
use App\User;
use App\Contacts;
use App\Comments;
use Illuminate\Support\Facades\DB; 
use App\Http\Requests\CatsRequest;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        $soBai = News::count();
        $soCmt = Comments::count();
        $soNguoi = User::count();
        $soMail = Contacts::where('is_del', 0)->count();
        $arThongKe = array(
            'soBai' => $soBai, 
            'soNguoi' => $soNguoi, 
            'soMail' => $soMail, 
            'soCmt' => $soCmt, 
        );

    	$arDemBaiViet = DB::table('news as n')
        ->join('cats as c', 'c.id', '=', 'n.cat_id')
        ->groupBy('cname')
        ->select('c.name as cname',DB::raw('count(*) as soluong'))
        ->orderBy('soluong', 'desc')
        ->get()->toArray(); 

        $arDemPostUser = DB::table('news as n')
        ->join('users as u', 'u.id', '=', 'n.created_by')
        ->groupBy('uname')
        ->select('u.fullname as uname',DB::raw('count(*) as soluong'))
        ->orderBy('soluong', 'desc')
        ->get()->toArray(); 

        foreach ($arDemBaiViet as $key => $arDemBV) {

            switch ($key % 15) {
                case 0:
                $arDemBaiViet[$key]['color'] = 'red';
                break;
                case 1:
                $arDemBaiViet[$key]['color'] = 'green';
                break;
                case 2:
                $arDemBaiViet[$key]['color'] = 'yellow';
                break;
                case 3:
                $arDemBaiViet[$key]['color'] = 'aqua';
                break;
                case 4:
                $arDemBaiViet[$key]['color'] = 'maroon';
                break;
                case 5:
                $arDemBaiViet[$key]['color'] = 'gray';
                break;
                case 6:
                $arDemBaiViet[$key]['color'] = 'blue';
                break;
                case 7:
                $arDemBaiViet[$key]['color'] = 'black';
                break;
                case 8:
                $arDemBaiViet[$key]['color'] = 'navy';
                break;
                case 9:
                $arDemBaiViet[$key]['color'] = 'teal';
                break;
                case 10:
                $arDemBaiViet[$key]['color'] = 'olive';
                break;
                case 11:
                $arDemBaiViet[$key]['color'] = 'lime';
                break;
                case 12:
                $arDemBaiViet[$key]['color'] = 'orange';
                break;
                case 13:
                $arDemBaiViet[$key]['color'] = 'fuchsia';
                break;
                case 14:
                $arDemBaiViet[$key]['color'] = 'purple';
                break;
                
                default:
                    # code...
                break;
            }

        }
    	return view('admin.index.index', ['arThongKe' => $arThongKe, 'arDemBaiViet' => $arDemBaiViet, 'arDemPostUser' => $arDemPostUser]);
    }
}
