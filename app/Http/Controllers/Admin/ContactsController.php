<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contacts;
use App\Mailsent;
use App\Http\Requests\ReplycontactRequest;
use Illuminate\Support\Facades\Auth;
use Mail;

class ContactsController extends Controller
{
    public function index()
    {
        $arContacts = Contacts::where('is_del', 0)->orderBy('id', 'desc')->paginate(10);
    	return view('admin.contacts.index', ['arContacts' => $arContacts]);
    }

    public function sent()
    {
        $arContacts = Mailsent::orderBy('id', 'desc')->paginate(10);
        return view('admin.contacts.sent', ['arContacts' => $arContacts]);
    }

    public function getAdd()
    {
        return view('admin.contacts.add');
    }

    public function postAdd(ReplycontactRequest $request)
    {
        if(Auth::user()->capbac == 1){
            $request->session()->flash('msg', 'Đã phản hồi liên hệ');
            return redirect()->route('admin.contacts.index');
        }

        $email = trim($request->email);
        $title = trim($request->title);
        $detail = trim($request->detail);

        $arSent = array(
            'title' => trim($request->title),
            'email' => trim($request->email),
            'detail' => trim($request->detail)
        );

        Mailsent::insert($arSent);

        $data = array(
            'email' => $email, 
            'title' => $title,
            'detail' => $detail,
        );

        Mail::send('emails.add', $data, function ($message) use ($email, $title)
         {
            $message->from('hoangvan252@gmail.com');
            $message->subject($title);
            $message->to($email);
        });

        $request->session()->flash('msg', 'Đã gửi thư');
        return redirect()->route('admin.contacts.sent');
    }

    public function imp()
    {
        $arContacts = Contacts::where('is_del', 0)->where('imp', 1)->orderBy('id', 'desc')->paginate(10);
        return view('admin.contacts.index', ['arContacts' => $arContacts]);
    }

    public function recyclebin()
    {
        $arContacts = Contacts::where('is_del', 1)->orderBy('id', 'desc')->paginate(15);
        return view('admin.contacts.recyclebin', ['arContacts' => $arContacts]);
    }

    public function readmail($id)
    {
        $arItems = Mailsent::where('id', $id)->get();
        if(count($arItems) == 0){
            return redirect()->route('admin.contacts.index');
        }
        return view('admin.contacts.readmail', ['arItems' => $arItems]);
    }

    public function read($id)
    {
        $arItems = Contacts::where('id', $id)->get();
        if(count($arItems) == 0){
            return redirect()->route('admin.contacts.index');
        }
        if(Auth::user()->capbac != 1){
            $objContacts = Contacts::find($id);
            $objContacts->readed = 1;
            $objContacts->update();
        }
    	return view('admin.contacts.read', ['arItems' => $arItems]);
    }

    public function unread($id)
    {
        $arItems = Contacts::where('id', $id)->get();
        if(count($arItems) == 0){
            return redirect()->route('admin.contacts.index');
        }
        if(Auth::user()->capbac != 1){
            $objContacts = Contacts::find($id);
            $objContacts->readed = 0;
            $objContacts->update();
        }
        if($arItems[0]['is_del'] == 1){
            return redirect()->route('admin.contacts.recyclebin');
        }else{
            return redirect()->route('admin.contacts.index');
        }
    }

    public function reply($id, ReplycontactRequest $request)
    {
        if(Auth::user()->capbac == 1){
            $request->session()->flash('msg', 'Đã phản hồi liên hệ');
            return redirect()->route('admin.contacts.index');
        }
        $arItems = Contacts::where('id', $id)->get();
        if(count($arItems) == 0){
            return redirect()->route('admin.contacts.index');
        }

        $email = trim($request->email);
        $title = trim($request->title);
        $detail = trim($request->detail);

        $arSent = array(
            'title' => $title,
            'email' => $email,
            'detail' => $detail
        );

        Mailsent::insert($arSent);

        $data = array(
            'email' => $email, 
            'title' => $title,
            'detail' => $detail,
        );

        Mail::send('emails.reply', $data, function ($message) use ($email)
         {
            $message->from('hoangvan252@gmail.com');
            $message->subject('Liên hệ từ '.getenv('APP_URL'));
            $message->to($email);
        });

        $request->session()->flash('msg', 'Đã phản hồi liên hệ');
        return redirect()->route('admin.contacts.sent');
    }

    public function deltemp($id, Request $request)
    {
        if(Auth::user()->capbac == 1){
            $request->session()->flash('msg', 'Đã đưa vào thùng rác');
            return redirect()->route('admin.contacts.index');
        }
        $arItems = Contacts::where('id', $id)->get();
        if(count($arItems) == 0){
            return redirect()->route('admin.contacts.index');
        }
        $objContacts = Contacts::find($id);
        $objContacts->is_del = 1;
        $objContacts->update();
        
        $request->session()->flash('msg', 'Đã đưa vào thùng rác');
        return redirect()->route('admin.contacts.index');
    }

    public function undeltemp($id, Request $request)
    {
        if(Auth::user()->capbac == 1){
            $request->session()->flash('msg', 'Đã khôi phục');
            return redirect()->route('admin.contacts.index');
        }
        $arItems = Contacts::where('id', $id)->get();
        if(count($arItems) == 0){
            return redirect()->route('admin.contacts.index');
        }
        $objContacts = Contacts::find($id);
        $objContacts->is_del = 0;
        $objContacts->update();
        
        $request->session()->flash('msg', 'Đã khôi phục');
        return redirect()->route('admin.contacts.index');
    }


    public function del($id, Request $request)
    {
        if(Auth::user()->capbac == 1){
            $request->session()->flash('msg', 'Đã xóa vĩnh viễn');
            return redirect()->route('admin.contacts.index');
        }
        $arItems = Contacts::where('id', $id)->get();
        if(count($arItems) == 0){
            return redirect()->route('admin.contacts.index');
        }
        $objContacts = Contacts::find($id);
        $objContacts->delete();
        
        $request->session()->flash('msg', 'Đã xóa vĩnh viễn');
        return redirect()->route('admin.contacts.index');
    }

    public function delmail($id, Request $request)
    {
        if(Auth::user()->capbac == 1){
            $request->session()->flash('msg', 'Đã xóa');
            return redirect()->route('admin.contacts.sent');
        }
        $arItems = Mailsent::where('id', $id)->get();
        if(count($arItems) == 0){
            return redirect()->route('admin.contacts.sent');
        }
        $objContacts = Mailsent::find($id);
        $objContacts->delete();
        
        $request->session()->flash('msg', 'Đã xóa');
        return redirect()->route('admin.contacts.sent');
    }

    public function delMore(Request $request)
    {
        $arDel = array();
        $mang = $request->iddel;

        if($mang == null){
            $request->session()->flash('msgWarning', 'Vui lòng chọn ít nhất một thư để xóa');
            return redirect()->route('admin.contacts.index');
        }else{
            if(Auth::user()->capbac == 1){
                $request->session()->flash('msg', 'Đã đưa vào thùng rác');
                return redirect()->route('admin.contacts.index');
            }
            $objContacts = Contacts::find($mang);
            
            foreach ($objContacts as $key => $objC) {
                $objC->is_del = 1;
                $objC->update();
            }

            $request->session()->flash('msg', 'Đã đưa vào thùng rác');
            return redirect()->route('admin.contacts.index');
        }
    }

    public function delMoreMail(Request $request)
    {
        $arDel = array();
        $mang = $request->iddel;

        if($mang == null){
            $request->session()->flash('msgWarning', 'Vui lòng chọn ít nhất một thư để xóa');
            return redirect()->route('admin.contacts.index');
        }else{
            if(Auth::user()->capbac == 1){
                $request->session()->flash('msg', 'Đã xóa');
                return redirect()->route('admin.contacts.sent');
            }
            $objContacts = Mailsent::find($mang);
            
            foreach ($objContacts as $key => $objC) {
                $objC->delete();
            }

            $request->session()->flash('msg', 'Đã xóa');
            return redirect()->route('admin.contacts.sent');
        }
    }

    public function permanentlyDeleted(Request $request)
    {
        $arDel = array();
        $mang = $request->iddel;

        if($mang == null){
            $request->session()->flash('msgWarning', 'Vui lòng chọn ít nhất một thư để xóa');
            return redirect()->route('admin.contacts.index');
        }else{
            if(Auth::user()->capbac == 1){
                $request->session()->flash('msg', 'Đã xóa vĩnh viễn');
                return redirect()->route('admin.contacts.recyclebin');
            }
            $objContacts = Contacts::find($mang);
            
            foreach ($objContacts as $key => $objC) {
                $objC->delete();
            }

            $request->session()->flash('msg', 'Đã xóa vĩnh viễn');
            return redirect()->route('admin.contacts.recyclebin');
        }
    }

    public function changeImp(Request $request)
    {
        $id = $request->aid;
        $qt = $request->aqt;

        if(Auth::user()->capbac != 1){
            Contacts::where('id', $id)->update(['imp' => $qt]);
        }        
        
        return view('admin.contacts.imp', ['id' => $id, 'qt' => $qt]);
    }
}
