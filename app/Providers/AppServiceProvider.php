<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB; 
use App\News;
use App\Giatri;
use App\Contacts;
use App\Comments;
use Illuminate\Support\Facades\Auth;
use App\Cats;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $arNewPostes = News::where('is_active', 1)->orderBy('id', 'desc')->take(5)->get();
        $arHotPostes = News::where('is_active', 1)->orderBy('luocdoc', 'desc')->take(4)->get();
        $arSlidePostes = News::where('is_slide', 1)->where('is_active', 1)->orderBy('id', 'desc')->take(5)->get();
        $arGiaTri = Giatri::all();
        $arMangXaHoi = Giatri::where('id', '<=', 11)->where('id', '>=', 4)->where('giatri', '!=', '')->get();
        $count_inbox = Contacts::where('readed', 0)->where('is_del', 0)->count();
        $arInbox = Contacts::where('readed', 0)->where('is_del', 0)->take(7)->get();

        $objComments = new Comments;
        $arComments = $objComments->getListFive();

        $arMenu = Cats::where('id', '!=', 0)->get()->toArray();
        foreach ($arMenu as $key => $arMenuBv) {
            $arMenu[$key]['parent_cate'] = 'Khongbiet';

            if($arMenuBv['parent_id'] != 0){
                $arMenu[$key]['parent_cate'] = 'con';
            }else{
                $arTry = Cats::where('parent_id', $arMenuBv['id'])->get();
                if(count($arTry) == 0){
                    $arMenu[$key]['parent_cate'] = 'khongcon';
                }else{
                    $arMenu[$key]['parent_cate'] = 'cocon';
                }
            }
        }
        
        View::share('publicUrl', getenv('PUBLIC_TEMPLATE_URL'));
        View::share('adminUrl', getenv('ADMIN_TEMPLATE_URL'));
        View::share('imageUrl', getenv('IMAGE_URL'));
        View::share('photoUrl', getenv('IMAGE_URL'));
        View::share('diachiWebsite', getenv('APP_URL'));

        View::share('nameWebsite', $arGiaTri[0]['giatri']);
        View::share('sloganWebsite', $arGiaTri[1]['giatri']);
        View::share('thongtinlienhe', $arGiaTri[2]['giatri']);
        View::share('kinhdo', $arGiaTri[11]['giatri']);
        View::share('vido', $arGiaTri[12]['giatri']);
        View::share('logo', $arGiaTri[13]['giatri']);
        View::share('arMangXaHoi', $arMangXaHoi);

        View::share('arNewPostes', $arNewPostes);
        View::share('arHotPostes', $arHotPostes);
        View::share('arSlidePostes', $arSlidePostes);
        View::share('arGiaTri', $arGiaTri);

        View::share('count_inbox', $count_inbox);
        View::share('arInbox', $arInbox);
        View::share('arComments', $arComments);
        View::share('arMenu', $arMenu);        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}