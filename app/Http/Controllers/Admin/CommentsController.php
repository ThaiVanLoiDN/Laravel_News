<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Comments;

class CommentsController extends Controller
{
    public function index()
    {
        $objComments = new Comments;
        $arCommentAs = $objComments->getList();
    	return view('admin.comments.index', ['arCommentAs' => $arCommentAs]);
    }

    public function del($id, Request $request)
    {
        if(Auth::user()->capbac == 1){
            $request->session()->flash('msg', 'Đã xóa thành công');
            return redirect()->route('admin.comments.index');
        }

        $objComment = Comments::find($id);
        if($objComment != null){
            $objComment->delete();
        }
        
        $request->session()->flash('msg', 'Đã xóa bình luận');
        return redirect()->route('admin.comments.index');
    }

    public function getdelMore(Request $request)
    {
        return redirect()->route('admin.comments.index');   
    }

    public function delMore(Request $request)
    {
        if(Auth::user()->capbac == 1){
            $request->session()->flash('msg', 'Đã xóa thành công');
            return redirect()->route('admin.comments.index');
        }
        $arDel = array();
        $mang = $request->iddel;

        $objComment = Comments::find($mang);
        foreach ($objComment as $key => $objN) {
            $objN->delete();
            
        }

        $request->session()->flash('msg', 'Xóa thành công');

        return redirect()->route('admin.comments.index');
    }
    public function changeActive(Request $request)
    {
        $id = $request->aid;
        $gt = $request->agt;

        if(Auth::user()->capbac != 1){
            Comments::where('id', $id)->update(['is_active' => $request->agt]);
        }
        
        return view('admin.news.active', ['id' => $id, 'gt' => $gt]);
    }
}
