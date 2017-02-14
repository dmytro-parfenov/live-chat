<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Frontend\BaseController;
use App\Models\Message;

use Pusher;
use Cookie;
use Input;

class ChatController extends BaseController{

    public function index(){

        $user_name = Cookie::get('user_name');
        $user_id = Cookie::get('user_id');


        $search_value = Input::get('search_value');

        if ($search_value) {
            $messages = Message::where(function ($q) use ($search_value) {
                $q->where('user_name', 'like', '%' . $search_value . '%');
                $q->orWhere('message', 'like', '%' . $search_value . '%');
                $q->orWhere('created_at', 'like', '%' . $search_value . '%');
            });
        } else {
            $messages = Message::select('*');
        }

        $messages = $messages->orderBy('created_at', 'ASC')->get();

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
