<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Storage;
use App\News;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserEditRequest;

class UsersController extends Controller
{
    public function index()
    {
    	$arUsers = User::all();
    	return view('admin.users.index', ['arUsers' => $arUsers]);
    }

    public function getAdd()
    {
    	return view('admin.users.add');
    }

    public function postAdd(UserRequest $request)
    {
        if(Auth::user()->capbac == 1){
            $request->session()->flash('msg', 'Đã thêm thành công');
            return redirect()->route('admin.users.index');
        }
        $arCheckUsername = User::where('username', trim($request->username))->get();
        if(count($arCheckUsername) != 0){
            $request->session()->flash('msgWarning', 'Đã trùng username, vui lòng chọn username khác');
            return redirect()->route('admin.users.index');
        }
        $arCheckEmail = User::where('email', trim($request->email))->get();
        if(count($arCheckEmail) != 0){
            $request->session()->flash('msgWarning', 'Đã trùng email, vui lòng chọn email khác');
            return redirect()->route('admin.users.index');
        }

        $capbac = e(trim($request->capbac));
        if(($capbac - 4) * ($capbac - 3) * ($capbac - 2) * ($capbac - 1) * $capbac != 0){
            $request->session()->flash('msgWarning', 'Không thể thêm quản trị viên');
            return redirect()->route('admin.users.index');
        }
        
    	$picture = $request->picture;

        if($request->picture != "")
        {
            $path = $request->file('picture')->store('files');
            $tmp = explode('/', $path);
            $picture = end($tmp);
        }

        $arUser = array(
            'username' => trim($request->username), 
            'fullname' => trim($request->fullname), 
            'capbac' => e(trim($request->capbac)),
            'email' => trim($request->email), 
            'password' => bcrypt(trim($request->password)), 
            'picture' => $picture, 
        );

        User::insert($arUser);

        $request->session()->flash('msg', 'Đã thêm thành công');
    	return redirect()->route('admin.users.index');
    }

    public function del($id, Request $request)
    {
        $arUser = User::find($id);
        if(count($arUser) == 0){
            $request->session()->flash('msgWarning', 'Quản trị viên không tồn tại');
            return redirect()->route('admin.users.index');
        }
        if(Auth::user()->capbac == 1){
            $request->session()->flash('msg', 'Đã xóa thành công');
            return redirect()->route('admin.users.index');
        }
        if($id == 1){
            $request->session()->flash('msgWarning', 'Không thể xóa');
            return redirect()->route('admin.users.index');
        }
        $objNews = News::where('created_by', $id)->get();

        if($objNews != null){
	        foreach ($objNews as $key => $objN) {
	            $picName = $objN['picture'];

	            if($picName != ""){
	                $kq = Storage::delete('files/'.$picName);
	            }
	            $objN->delete();
	            
	        }
    	}

        $objUser = User::find($id);

        if($objUser != null){
        	$picName = $objUser['picture'];

	        if($picName != "")
	        {
	            $kq = Storage::delete('files/'.$picName);
	        }

            $objUser->delete();
        }
    	
        $request->session()->flash('msg', 'Đã xóa quản trị viên');
        return redirect()->route('admin.users.index');
    }

    public function getEdit($id, Request $request)
    {
        $arUser = User::find($id);
        if(count($arUser) == 0){
            $request->session()->flash('msgWarning', 'Quản trị viên không tồn tại');
            return redirect()->route('admin.users.index');
        }
        if(Auth::id() != $id && (Auth::user()->capbac != 4) && (Auth::user()->capbac != 1)){
            $request->session()->flash('msgWarning', 'Bạn không được chỉnh sửa');
            return redirect()->route('admin.users.index');
        }
        $arUser = User::find($id)->toArray();
        return view('admin.users.edit', ['arUser' => $arUser]);
    }

    public function postEdit($id, UserEditRequest $request)
    {
        $arUser = User::find($id);
        if(count($arUser) == 0){
            $request->session()->flash('msgWarning', 'Quản trị viên không tồn tại');
            return redirect()->route('admin.users.index');
        }
        if(Auth::user()->capbac == 1){
            $request->session()->flash('msg', 'Đã sửa thành công');
            return redirect()->route('admin.users.index');
        }
        if(Auth::id() != $id && (Auth::user()->capbac != 4) && (Auth::user()->capbac != 1)){
            $request->session()->flash('msgWarning', 'Bạn không được chỉnh sửa');
            return redirect()->route('admin.users.index');
        }
        $arCheckUsername = User::where('username', trim($request->username))->where('id', '!=', $id)->get();
        if(count($arCheckUsername) != 0){
            $request->session()->flash('msgWarning', 'Đã trùng username, vui lòng chọn username khác');
            return redirect()->route('admin.users.index');
        }
        $arCheckEmail = User::where('email', trim($request->email))->where('id', '!=', $id)->get();
        if(count($arCheckEmail) != 0){
            $request->session()->flash('msgWarning', 'Đã trùng email, vui lòng chọn email khác');
            return redirect()->route('admin.users.index');
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

        $arUsers = User::find($id);
        $arUsers->username = e(trim($request->username));
        $arUsers->fullname = e(trim($request->fullname));
        $arUsers->email = e(trim($request->email));
        $arUsers->capbac = e(trim($request->capbac));
        if (trim($request->password) != '') {
    	   $arUsers->password = bcrypt(trim($request->password));
        }

        $capbac = e(trim($request->capbac));
        if(($capbac - 4) * ($capbac - 3) * ($capbac - 2) * ($capbac - 1) * $capbac != 0){
            $request->session()->flash('msgWarning', 'Không thể thêm quản trị viên');
            return redirect()->route('admin.users.index');
        }

    	$arUsers->update();

        $delete_picture = $request->delete_picture;
        if($picNameNew != "")
        {
            $arUsers->picture = $picture;
            
            $objUser = User::find($id);
            $picNameOld = $objUser['picture'];
            if($picNameOld != ""){
                $kq = Storage::delete('files/'.$picNameOld);
            }
        }
        elseif($delete_picture)
        {
            $arUsers->picture = "";

            $objUser = User::find($id);
            $picNameOld = $objUser['picture'];
            $kq = Storage::delete('files/'.$picNameOld);
        }

        $arUsers->update();

        $request->session()->flash('msg', 'Sửa thành công');
        return redirect()->route('admin.users.index');
    }
}
