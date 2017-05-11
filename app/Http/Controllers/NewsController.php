<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\News;
use App\Comments;
use App\Cats;
use Mail;

class NewsController extends Controller
{
	public function cat($slug, $id)
	{
        $arKT = Cats::find($id);
        if(count($arKT) == 0){
            return redirect()->route('public.index.index');
        }
        $name = Cats::where('id', $id)->get();
        $arNews = News::where('cat_id', $id)->orderBy('id', 'desc')->paginate(12);
		return view('post.cat', ['arNews' => $arNews, 'name' => $name, 'id_cm' => $id]);	
	}
	
    public function detail($slug, $id)
    {
    	$objNews = new News;
    	$arNews = $objNews->getDetail($id);

    	if(count($arNews) == 0){
    		return redirect()->route('public.index.index');
    	}else{
            $title = $arNews['0']['name'];
            $motaSeo = $arNews['0']['preview'];


            $blogKey = 'blog_' . $id;

            if (!Session::has($blogKey)) {
                News::where('id', $id)->increment('luocdoc');
                Session::put($blogKey, 1);
            }
        }
        $cat_id = $arNews[0]['cat_id'];

        $arNewsOther = News::where('cat_id', $cat_id)->where('id', '!=', $id)->orderBy('id', 'desc')->take(3)->get();

        $arCommentPosts = Comments::where('news_id', $id)->where('is_active', 1)->get()->toArray();

    	return view('post.detail', ['arNews' => $arNews, 'id_cm' => $cat_id, 'title' => $title, 'motaSeo' => $motaSeo, 'arNewsOther' => $arNewsOther, 'arCommentPosts' => $arCommentPosts]);	
    }

    public function getComment($id, Request $request)
    {
        return redirect()->route('public.index.index');
    }

    public function comment($id, Request $request)
    {
        $objNews = new News;
        $arNews = $objNews->getDetail($id);

        if(count($arNews) == 0){
            return redirect()->route('public.index.index');
        }

        $hoten = trim($request->ahoten);
        $email = trim($request->aemail);
        $content = trim($request->acontent);

        if($hoten == '' || $email == '' || $content == ''){
            return '<div class="alert alert-warning"><p><strong>Vui lòng điền đầy đủ các trường.</strong></p></div>';
        }

        if(mb_strlen ($hoten) < 5){
            return '<div class="alert alert-warning"><p><strong>Vui lòng nhập họ tên tối thiểu 5 kí tự</strong></p></div>';
        }
        if(mb_strlen ($email) < 5){
            return '<div class="alert alert-warning"><p><strong>Vui lòng nhập email tối thiểu 5 kí tự</strong></p></div>';
        }
        if(mb_strlen ($content) < 5){
            return '<div class="alert alert-warning"><p><strong>Vui lòng nhập nội dung bình luận tối thiểu 5 kí tự</strong></p></div>';
        }

        if(mb_strlen ($hoten) > 40){
            return '<div class="alert alert-warning"><p><strong>Vui lòng nhập họ tên tối đa 40 kí tự</strong></p></div>';
        }
        if(mb_strlen ($email) > 40){
            return '<div class="alert alert-warning"><p><strong>Vui lòng nhập email tối đa 40 kí tự</strong></p></div>';
        }
        if(mb_strlen ($content) > 200){
            return '<div class="alert alert-warning"><p><strong>Vui lòng nhập nội dung bình luận tối đa 200 kí tự</strong></p></div>';
        }

        $arBinhLuan = array(
            'hoten' => $hoten,
            'email' => $email,
            'content' => $content,
            'news_id' => $id,
        );

        Comments::insert($arBinhLuan);

        /*Gửi mail đến webmate*/
        $data = array(
            'hoten' => $hoten,
            'email' => $email,
            'content' => $content, 
        );

        Mail::send('emails.comment', $data, function ($message) use ($email)
         {
            $message->from('hoangvan252@gmail.com');
            $message->subject('Binh luận từ '.getenv('APP_URL'));
            $message->to('thaivanloidn@gmail.com');
        });

        return '<div class="alert alert-success"><p><strong>Cảm ơn bạn đã bình luận. Chúng tôi sẽ xem xét bình luận của bạn</strong></p></div><script type="text/javascript">$("#comment").trigger("reset");</script>';
    }

    public function reply($id, Request $request)
    {
        $objNews = new News;
        $arNews = $objNews->getDetail($id);

        if(count($arNews) == 0){
            return redirect()->route('public.index.index');
        }

        $hoten = trim($request->ahoten);
        $email = trim($request->aemail);
        $content = trim($request->acontent);
        $id_cmt = trim($request->aid_cmt);

        $arKT = Comments::where('id', $id_cmt)->where('news_id', $id)->get();
        if(count($arKT) == 0){
            return '<div class="alert alert-warning"><p><strong>Bình luận không tồn tại</strong></p></div>';
        }

        if($hoten == '' || $email == '' || $content == ''){
            return '<div class="alert alert-warning"><p><strong>Vui lòng điền đầy đủ các trường.</strong></p></div>';
        }

        if(mb_strlen ($hoten) < 5){
            return '<div class="alert alert-warning"><p><strong>Vui lòng nhập họ tên tối thiểu 5 kí tự</strong></p></div>';
        }
        if(mb_strlen ($email) < 5){
            return '<div class="alert alert-warning"><p><strong>Vui lòng nhập email tối thiểu 5 kí tự</strong></p></div>';
        }
        if(mb_strlen ($content) < 5){
            return '<div class="alert alert-warning"><p><strong>Vui lòng nhập nội dung bình luận tối thiểu 5 kí tự</strong></p></div>';
        }

        if(mb_strlen ($hoten) > 40){
            return '<div class="alert alert-warning"><p><strong>Vui lòng nhập họ tên tối đa 40 kí tự</strong></p></div>';
        }
        if(mb_strlen ($email) > 40){
            return '<div class="alert alert-warning"><p><strong>Vui lòng nhập email tối đa 40 kí tự</strong></p></div>';
        }
        if(mb_strlen ($content) > 200){
            return '<div class="alert alert-warning"><p><strong>Vui lòng nhập nội dung bình luận tối đa 200 kí tự</strong></p></div>';
        }

        $arBinhLuan = array(
            'hoten' => $hoten,
            'email' => $email,
            'content' => $content,
            'news_id' => $id,
            'parent_id' => $id_cmt,
        );

        Comments::insert($arBinhLuan);

        /*Gửi mail đến webmate*/
        $data = array(
            'hoten' => $hoten,
            'email' => $email,
            'content' => $content, 
        );

        Mail::send('emails.comment', $data, function ($message) use ($email)
         {
            $message->from('hoangvan252@gmail.com');
            $message->subject('Binh luận từ '.getenv('APP_URL'));
            $message->to('thaivanloidn@gmail.com');
        });

        return '<div class="alert alert-success"><p><strong>Cảm ơn bạn đã phản hồi. Chúng tôi sẽ xem xét phản hồi của bạn</strong></p></div><script type="text/javascript">$(".form-'.$id_cmt.'").trigger("reset");</script>';
    }
}
