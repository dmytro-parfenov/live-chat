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

        $messages = $messages->latest()->take(20)->get()->reverse();

        return view('frontend.chat', compact(['messages', 'user_name', 'user_id']));
    }

    public function sendUserName(Request $request){

        $user_name = $request->get('user_name');

        if ($user_name !== '') {
            Cookie::queue('user_name', $user_name);
            Cookie::queue('user_id', time());

            $options = array(
                'encrypted' => true
            );
            $pusher = new Pusher(
                env('PUSHER_KEY'),
                env('PUSHER_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );
            $pusher->trigger('new-user-channel', 'new-user-event', $user_name);
        }

        return redirect('/');

    }

    public function sendMessage(Request $request){

        $message = $request->get('message');
        $user_name = Cookie::get('user_name');
        $user_id = Cookie::get('user_id');
        $user_location_lat = Cookie::get('user_location_lat');
        $user_location_lng = Cookie::get('user_location_lng');

        if ($message !== '' && !empty($user_name) && !empty($user_id)) {

            if ($user_location_lat && $user_location_lng) {
                $message = Message::create( ['user_id' => $user_id, 'user_name' => $user_name, 'message' => $message, 'user_location_lat' => $user_location_lat, 'user_location_lng' => $user_location_lng] );
            } else {
                $message = Message::create( ['user_id' => $user_id, 'user_name' => $user_name, 'message' => $message] );

            }
            $message->created_at = Carbon::now()->toDateTimeString();

            $options = array(
                'encrypted' => true
            );
            $pusher = new Pusher(
                env('PUSHER_KEY'),
                env('PUSHER_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );

            $html = view('frontend.includes.message', compact(['message']))->render();
            $message->html = $html;

            $pusher->trigger('new-message-channel', 'new-message-event', $message);

        }

    }

    public function sendLocation(Request $request){

        $user_location_lat = $request->get('user_location_lat');
        $user_location_lng = $request->get('user_location_lng');

        if ($user_location_lat && $user_location_lng){
            Cookie::queue('user_location_lat', $user_location_lat);
            Cookie::queue('user_location_lng', $user_location_lng);
        }

    }

    public function showMoreMessages(Request $request){

        $first_message = $request->get('first_message');
        if ($first_message) {
            $messages = Message::where('id','<',$first_message);
            $messages = $messages->latest()->take(20)->get()->reverse();
            if (count($messages) > 0) {
                $html = view('frontend.includes.message', compact(['messages']))->render();
                $data = json_encode(['html' => $html,'first_message' => $messages->first()->id]);
                return $data;
            }
        }

    }

}
