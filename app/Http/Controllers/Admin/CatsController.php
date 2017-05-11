<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cats;
use App\News;
use Illuminate\Support\Facades\DB; 
use App\Http\Requests\CatsRequest;
use Illuminate\Support\Facades\Auth;

class CatsController extends Controller
{
    public function index()
    {
        $arCats = Cats::all();
        $arCatParents = Cats::where('parent_id', 0)->get();
        $objNews = new News;
        $arNewses = $objNews->getList();

        $arDemBaiViet = DB::table('news as n')
        ->join('cats as c', 'c.id', '=', 'n.cat_id')
        ->groupBy('cname')
        ->select('c.name as cname',DB::raw('count(*) as soluong'))
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

        return view('admin.cats.index', ['arCats' => $arCats, 'arNewses' => $arNewses, 'arDemBaiViet' => $arDemBaiViet, 'arCatParents' => $arCatParents]);
    }
    public function getAdd()
    {
        $arCats = Cats::where('parent_id', 0)->get();
        $objNews = new News;
        $arNewses = $objNews->getList();

        $arDemBaiViet = DB::table('news as n')
        ->join('cats as c', 'c.id', '=', 'n.cat_id')
        ->groupBy('cname')
        ->select('c.name as cname',DB::raw('count(*) as soluong'))
        ->orderBy('soluong', 'desc')
        ->get()->toArray(); 

        foreach ($arDemBaiViet as $key => $arDemBV) {

            switch ($key % 16) {
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
                $arDemBaiViet[$key]['color'] = 'light-blue';
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
                case 15:
                $arDemBaiViet[$key]['color'] = 'maroon';
                break;
                
                default:
                    # code...
                break;
            }

        }

        return view('admin.cats.add', ['arCats' => $arCats, 'arNewses' => $arNewses, 'arDemBaiViet' => $arDemBaiViet]);
    }

    public function postAdd(CatsRequest $request)
    {
        if(Auth::user()->capbac == 1){
            $request->session()->flash('msg', 'Đã thêm thành công');
            return redirect()->route('admin.cats.index');
        }
        $arCat = array(
            'name' => e(trim($request->name)),
            'parent_id' => e(trim($request->parent_id))
        );

        Cats::insert($arCat);

        $request->session()->flash('msg', 'Thêm thành công');

        return redirect()->route('admin.cats.index');
    }

    public function del($id, Request $request)
    {
        if(Auth::user()->capbac == 1){
            $request->session()->flash('msg', 'Đã xóa thành công');
            return redirect()->route('admin.cats.index');
        }
        if($id == 0){
            $request->session()->flash('msgWarning', 'Không thể xóa chuyên mục này');
            return redirect()->route('admin.cats.index');
        }
        $objNews = News::where('cat_id', $id)->update(['cat_id' => 0]);

        $objCon = Cats::where('parent_id', $id)->update(['parent_id' => 0]);

        $objCat = Cats::find($id);
        if($objCat != null){
            $objCat->delete();
        }

    	
        $request->session()->flash('msg', 'Đã xóa chuyên mục');
        return redirect()->route('admin.cats.index');
    }
    public function getEdit($id, Request $request)
    {
        if($id == 0){
            $request->session()->flash('msgWarning', 'Không thể sửa chuyên mục này');
            return redirect()->route('admin.cats.index');
        }
        $arCats = Cats::where('parent_id', 0)->get();
        $arItems = Cats::find($id);
        if($arItems == null){
            $request->session()->flash('msgWarning', 'Không thể sửa chuyên mục này');
            return redirect()->route('admin.cats.index');  
        }
        return view('admin.cats.edit', ['arCats' => $arCats, 'arItems' => $arItems]);
    }

    public function postEdit($id, CatsRequest $request)
    {
        if(Auth::user()->capbac == 1){
            $request->session()->flash('msg', 'Đã sửa thành công');
            return redirect()->route('admin.cats.index');
        }
        if($id == 0){
            $request->session()->flash('msgWarning', 'Không thể sửa chuyên mục này');
            return redirect()->route('admin.cats.index');
        }

        $arItems = Cats::find($id);
        if($arItems == null){
            $request->session()->flash('msgWarning', 'Không thể sửa chuyên mục này');
            return redirect()->route('admin.cats.index');  
        }

        $arItems->name = e(trim($request->name));
        $arItems->parent_id = e(trim($request->parent_id));
        $arItems->update();
        $request->session()->flash('msg', 'Sửa thành công');
        return redirect()->route('admin.cats.index');   
    }
}
