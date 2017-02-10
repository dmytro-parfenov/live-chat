<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Frontend\BaseController;
use App\Models\Message;

use Session;
use Cookie;

class ChatController extends BaseController{

    public function index(){

        $user_name = Cookie::get('user_name');
        $user_id = Cookie::get('user_id');

        $messages = Message::all();

        if (count($messages) > 0) {
            Session::put('last_message_id', $messages->last()->id);
        }

        return view('frontend.chat', compact(['messages', 'user_name', 'user_id']));
    }

    public function sendUserName(Request $request){

        $user_name = $request->get('user_name');

        if ($user_name !== '') {
            Cookie::queue('user_name', $user_name);
            Cookie::queue('user_id', time());
        }

        return redirect('/');

    }

    public function sendMessage(Request $request){

        $message = $request->get('message');
        $user_name = Cookie::get('user_name');
        $user_id = Cookie::get('user_id');

        if ($message !== '' && !empty($user_name) && !empty($user_id)) {
            Message::create( ['user_id' => $user_id, 'user_name' => $user_name, 'message' => $message] );
            return 1;
        }

    }

    public function subscribeMessage(Request $request)
    {

        if (Session::has('last_message_id')) {
            $last_message_id = Session::get('last_message_id');

            $messages = Message::where('id', '>', $last_message_id)->get();

            if (count($messages) > 0) {
                Session::put('last_message_id', $messages->last()->id);
                $html = view('frontend.includes.messages', compact(['messages']))->render();
                $user_id = Cookie::get('user_id');
                return ['html' => $html, 'messages' => $messages, 'user_id' => $user_id];
            }
        }

    }

}
