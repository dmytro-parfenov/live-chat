<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SettingsRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminBaseController;

use App\Models\Messages;

use Input;

class AdminMessagesController extends AdminBaseController
{
    public function getIndex(){
        $title = 'Messages';

        $messages = Messages::select('*');

        //get filters
        $search_value = Input::get('search_value');
        $filter_date = Input::get('filter_date');
        $order_by_value = Input::get('order_by_value');

        //set filters
        if ($search_value) {
            $messages = Messages::where(function ($q) use ($search_value) {
                $q->orWhere('user_name', 'like', '%' . $search_value . '%');
                $q->orWhere('message', 'like', '%' . $search_value . '%');
            });
        }

        if ($filter_date) {
            $messages = Messages::where(function ($q) use ($filter_date) {
                $q->orWhere('created_at', 'like', '%' . $filter_date . '%');
            });
        }

        if ($order_by_value) {
            $messages = $messages->orderBy('created_at', 'ASC');
        } else {
            $messages = $messages->orderBy('created_at', 'DESC');
        }

        $messages = $messages->get();

        return view('admin.messages', compact(['title','messages']));
    }

    public function postIndex( Request $request ){

        $messages_check = $request->get('messages_check');
        if( $messages_check ) {
            Messages::destroy($messages_check);
        }

        return redirect()->back();
    }
}
