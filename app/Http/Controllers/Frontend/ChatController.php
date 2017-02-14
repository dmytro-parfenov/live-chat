<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Frontend\BaseController;
use App\Models\Message;

use Pusher;
use Cookie;

class ChatController extends BaseController{

    public function index(){

        $user_name = Cookie::get('user_name');
        $user_id = Cookie::get('user_id');

        $messages = Message::all();

        $online_users = 1;

        return view('frontend.chat', compact(['messages', 'user_name', 'user_id', 'online_users']));
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

            $message = Message::create( ['user_id' => $user_id, 'user_name' => $user_name, 'message' => $message] );
            $message->created_at = Carbon::now()->toDateTimeString();

            $options = array(
                'encrypted' => true
            );
            $pusher = new Pusher(
                '5ccc3f2a7680d594a7dc',
                '06268cdae70c1f039eb5',
                '301741',
                $options
            );

            $html = view('frontend.includes.message', compact(['message']))->render();
            $message->html = $html;

            $pusher->trigger('new-message-channel', 'new-message-event', $message);

        }

    }

    public function getCookieUserId(){

        $user_id_login = Cookie::get('user_id');

        return $user_id_login;

    }

}
