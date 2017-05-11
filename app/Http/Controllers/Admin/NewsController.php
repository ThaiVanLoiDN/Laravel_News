<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Cats;
use App\News;
use File;

class NewsController extends Controller
{
    public function index()
    {
        $arCats = Cats::all();
        $objNews = new News;
        $arNewses = $objNews->getList();

        $nameSeach = '';
        $active = '';
        $chuyenMuc = '';

        return view('admin.news.index', ['arCats' => $arCats, 'arNewses' => $arNewses, 'nameSeach' => $nameSeach, 'active' => $active, 'chuyenMuc' => $chuyenMuc]);
    }

    public function search(Request $request)
    {
        $arCats = Cats::all();

        $arTemp = DB::table("news as n")->join('cats as c', 'n.cat_id', '=', 'c.id')->join('users as u', 'u.id', '=', 'n.created_by');

        $nameSeach = $request->name;
        $active = $request->active;
        $chuyenMuc = $request->cat_id;

        if($active != ''){
            $arTemp = $arTemp->where('is_active', $active);
        }
        if($nameSeach != ""){
            $arTemp = $arTemp->where('n.name','like', "%{$nameSeach}%");
        }
        if($chuyenMuc != ''){
            $arTemp = $arTemp->where('cat_id', $chuyenMuc);
        }

        $arTemp = $arTemp->select('n.*', 'n.name as nname', 'c.name as cname', 'u.fullname as uname');
        $arTemp = $arTemp->orderBy('n.id', 'desc')->paginate(getenv('ROW_ADMIN'));

        $arNewses = $arTemp;
        return view('admin.news.search', ['arCats' => $arCats, 'arNewses' => $arNewses, 'nameSeach' => $nameSeach, 'active' => $active, 'chuyenMuc' => $chuyenMuc]);
    }

    public function getAdd()
    {
        $arCats = Cats::all();
        return view('admin.news.add', ['arCats' => $arCats]);
    }

    public function postAdd(NewsRequest $request)
    {
        if(Auth::user()->capbac == 1){
            $request->session()->flash('msg', 'Đã thêm thành công');
            return redirect()->route('admin.news.index');
        }
        $picture = $request->picture;

        if($request->picture != "")
        {
            $path = $request->file('picture')->store('files');
            $tmp = explode('/', $path);
            $picture = end($tmp);
        }

        $arNews = array(
            'name' => trim($request->name), 
            'preview' => trim($request->preview), 
            'detail' => trim($request->detail), 
            'created_by' => Auth::id(),
            'picture' => $picture, 
            'cat_id' => e(trim($request->cat_id)), 
            'is_slide' => (e(trim($request->is_slide)))?'1':'0', 
            'is_active' => (e(trim($request->is_active)))?'1':'0', 
            );

        $cat_id = e(trim($request->cat_id));
        $arCats = Cats::where('id', $cat_id)->get();
        if(!count($arCats)){
            $request->session()->flash('msgWarning', 'Không thể thêm');
            return redirect()->route('admin.news.index');
        }

        News::insert($arNews);

        $request->session()->flash('msg', 'Đã thêm thành công');
        return redirect()->route('admin.news.index');
    }

    public function getEdit($id, Request $request)
    {
        $arCats = Cats::all();
        $arNews = News::find($id);
        if(count($arNews) == 0){
            $request->session()->flash('msgWarning', 'Bài đăng không tồn tại');
            return redirect()->route('admin.news.index');
        }

        return view('admin.news.edit', ['arCats' => $arCats, 'arNews' => $arNews]);
    }

    public function postEdit($id, NewsRequest $request)
    {
        if(Auth::user()->capbac == 1){
            $request->session()->flash('msg', 'Đã sửa thành công');
            return redirect()->route('admin.news.index');
        }
        $picture = "";        

        /*Thêm ảnh*/
        $picNameNew = $request->picture;

        if($request->picture != "")
        {
            $path = $request->file('picture')->store('files');
            $tmp = explode('/', $path);
            $picNameNew = end($tmp);
            $picture = $picNameNew;
        }
        /*Kết thúc thêm ảnh*/

        $arNews = News::find($id);
        $arNews->name = trim($request->name);
        $arNews->preview = trim($request->preview);
        $arNews->detail = trim($request->detail);
        $arNews->cat_id = e(trim($request->cat_id));
        $arNews->updated_at = date('Y-m-d H:i:s');
        $arNews->is_slide = (e(trim($request->is_slide)))?'1':'0';
        $arNews->is_active = (e(trim($request->is_active)))?'1':'0';

        $cat_id = e(trim($request->cat_id));
        $arCats = Cats::where('id', $cat_id)->get();
        if(!count($arCats)){
            $request->session()->flash('msgWarning', 'Không thể thêm');
            return redirect()->route('admin.news.index');
        }

        $delete_picture = $request->delete_picture;
        if($picNameNew != "")
        {
            $arNews->picture = $picture;
            
            $objNews = News::find($id);
            $picNameOld = $objNews['picture'];
            if($picNameOld != ""){
                $kq = Storage::delete('files/'.$picNameOld);
            }
        }
        elseif($delete_picture)
        {
            $arNews->picture = "";

            $objNews = News::find($id);
            $picNameOld = $objNews['picture'];
            $kq = Storage::delete('files/'.$picNameOld);
        }

        $arNews->update();

        $request->session()->flash('msg', 'Sửa thành công');
        return redirect()->route('admin.news.index');
    }

    public function del($id, Request $request)
    {
        if(Auth::user()->capbac == 1){
            $request->session()->flash('msg', 'Đã xóa thành công');
            return redirect()->route('admin.news.index');
        }
        $objNews = News::find($id);
        if(count($objNews) == 0){
            $request->session()->flash('msgWarning', 'Bài đăng không tồn tại');
            return redirect()->route('admin.news.index');
        }

        $picName = $objNews['picture'];

        if($picName != "")
        {
            $kq = Storage::delete('files/'.$picName);
        }

        $objNews->delete();

        $request->session()->flash('msg', 'Xóa thành công');

        return redirect()->route('admin.news.index');
    }

    public function delMore(Request $request)
    {
        if(Auth::user()->capbac == 1){
            $request->session()->flash('msg', 'Đã xóa thành công');
            return redirect()->route('admin.news.index');
        }
        $arDel = array();
        $mang = $request->iddel;

        $objNews = News::find($mang);
        foreach ($objNews as $key => $objN) {
            $picName = $objN['picture'];

            if($picName != ""){
                $kq = Storage::delete('files/'.$picName);
            }
            $objN->delete();
            
        }

        $request->session()->flash('msg', 'Xóa thành công');

        return redirect()->route('admin.news.index');
    }

    public function changeActive(Request $request)
    {
        $id = $request->aid;
        $gt = $request->agt;

        if(Auth::user()->capbac == 4){
            News::where('id', $id)->update(['is_active' => $request->agt]);
        }
        
        return view('admin.news.active', ['id' => $id, 'gt' => $gt]);
    }
    public function changeSlide(Request $request)
    {
        $id = $request->aid;
        $sl = $request->asl;

        if(Auth::user()->capbac == 4){
            News::where('id', $id)->update(['is_slide' => $request->asl]);
        }
        
        return view('admin.news.slide', ['id' => $id, 'sl' => $sl]);
    }
}
