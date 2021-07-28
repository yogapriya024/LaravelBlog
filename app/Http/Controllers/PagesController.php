<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use Mail;
use Session;
class PagesController extends Controller
{
   public function getContact(){
    
        return view('pages.contact');
  
   }
   public function postContact(request $request){
$this->validate($request,[
    'email'=>'required|email',
    'subject' => 'min:3',
    'message'=>'min:15']);
$data = array(
    "email"=>$request->email,
    "subject"=>$request->subject,
    "bodyMessage"=>$request->message
   
);
Mail::send('emails.contact',$data,function($message) use ($data){
$message->from($data['email']);
$message->to('yogapriya@integrass.com');
$message->subject($data['subject']);

});
Session::flash('success','Your Email was Sent!');

return redirect()->route('pages.welcome');
   }

}
