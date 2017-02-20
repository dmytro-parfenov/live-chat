<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SettingsRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminBaseController;

use App\Models\Messages;

class AdminMessagesController extends AdminBaseController
{
    public function getIndex(){
        $title = 'Messages';
        $messages = Messages::get();
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
