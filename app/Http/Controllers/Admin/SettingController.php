<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Setting;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index()
    {
    	$tenwebsite = Setting::find(1)->toArray()['giatri'];
    	$slogan = Setting::find(2)->toArray()['giatri'];
    	$lienhe = Setting::find(3)->toArray()['giatri'];
    	$facebook = Setting::find(4)->toArray()['giatri'];
    	$twitter = Setting::find(5)->toArray()['giatri'];
    	$flickr = Setting::find(6)->toArray()['giatri'];
    	$pinterest = Setting::find(7)->toArray()['giatri'];
    	$googleplus = Setting::find(8)->toArray()['giatri'];
    	$vimeo = Setting::find(9)->toArray()['giatri'];
    	$youtube = Setting::find(10)->toArray()['giatri'];
    	$mail = Setting::find(11)->toArray()['giatri'];
    	
    	$arSetting['tenwebsite'] = $tenwebsite;
    	$arSetting['slogan'] = $slogan;
    	$arSetting['lienhe'] = $lienhe;
    	$arSetting['facebook'] = $facebook;
    	$arSetting['twitter'] = $twitter;
    	$arSetting['flickr'] = $flickr;
    	$arSetting['pinterest'] = $pinterest;
    	$arSetting['googleplus'] = $googleplus;
    	$arSetting['vimeo'] = $vimeo;
    	$arSetting['youtube'] = $youtube;
    	$arSetting['mail'] = $mail;

    	return view('admin.setting.index', ['arSetting' => $arSetting]);
    }

    public function postAdd(Request $request)
    {
        if(Auth::user()->capbac == 1){
            $request->session()->flash('msg', 'Đã lưu thành công');
            return redirect()->route('admin.setting.index');
        }
        $picture = "";        

        /*Thêm ảnh*/
        $picNameNew = $request->picture;


        if($request->picture != "")
        {
            $objNews = Setting::find(14);
            $picNameOld = $objNews['giatri'];
            $kq = Storage::delete('files/'.$picNameOld);

            $path = $request->file('picture')->store('files');
            $tmp = explode('/', $path);
            $picture = end($tmp);

            Setting::where('id', 14)->update(['giatri' => $picture]);
        }
        /*Kết thúc thêm ảnh*/
    	Setting::where('id', 1)->update(['giatri' => $request->tenwebsite]);
    	Setting::where('id', 2)->update(['giatri' => $request->slogan]);
    	Setting::where('id', 3)->update(['giatri' => $request->lienhe]);
    	Setting::where('id', 4)->update(['giatri' => $request->facebook]);
    	Setting::where('id', 5)->update(['giatri' => $request->twitter]);
    	Setting::where('id', 6)->update(['giatri' => $request->flickr]);
    	Setting::where('id', 7)->update(['giatri' => $request->pinterest]);
    	Setting::where('id', 8)->update(['giatri' => $request->googleplus]);
    	Setting::where('id', 9)->update(['giatri' => $request->vimeo]);
    	Setting::where('id', 10)->update(['giatri' => $request->youtube]);
        Setting::where('id', 11)->update(['giatri' => $request->mail]);
        Setting::where('id', 12)->update(['giatri' => $request->kinhdo]);
    	Setting::where('id', 13)->update(['giatri' => $request->vido]);

    	$request->session()->flash('msg', 'Đã lưu thành công');
    	return redirect()->route('admin.setting.index');
    }
}
