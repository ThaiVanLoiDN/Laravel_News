<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Contacts;
use Mail;

class ContactController extends Controller
{
    public function index()
    {
    	return view('contact.index');
    }

    public function postContact(ContactRequest $request)
    {
        $email = trim($request->email);
        $fullname = trim($request->fullname);
        $title = trim($request->title);
        $detail = trim($request->detail);

        /*Gửi mail đến webmate*/
        $data = array(
            'fullname' => $fullname,
            'email' => $email,
            'detail' => $detail, 
            'title' => $title,
        );

        Mail::send('emails.newmail', $data, function ($message) use ($email)
         {
            $message->from('hoangvan252@gmail.com');
            $message->subject('Liên hệ từ '.getenv('APP_URL'));
            $message->to('thaivanloidn@gmail.com');
        });

        /*Gửi mail đến người liên hệ*/

        $data = array(
            'email' => $email, 
            'title' => $title
        );

        Mail::send('emails.contact', $data, function ($message) use ($email)
         {
            $message->from('hoangvan252@gmail.com');
            $message->subject('Liên hệ từ '.getenv('APP_URL'));
            $message->to($email);
        });

        /*Insert vào database*/

        $arContact = array(
            'fullname' => $fullname,
            'email' => $email,
            'detail' => $detail, 
            'title' => $title,
        );
        Contacts::insert($arContact);

        $request->session()->flash('msg', 'Cảm ơn bạn đã gửi liên hệ. Chúng tôi sẽ phản hồi qua email của bạn trong thời gian ngắn nhất có thể');
        return redirect()->route('public.contact.index');
    }
    
}
