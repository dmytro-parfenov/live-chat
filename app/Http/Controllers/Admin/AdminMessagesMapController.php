<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminBaseController;

use App\Models\Messages;

class AdminMessagesMapController extends AdminBaseController
{
    public function getIndex(){

        $title = 'Messages map';

        $coords = Messages::select('user_location_lat', 'user_location_lng')
            ->groupBy('user_location_lat')
            ->groupBy('user_location_lng')
            ->get();


        return view('admin.messages-map', compact(['title', 'coords']));
    }

    public function getCoords(){

        $coords = Messages::select('user_location_lat', 'user_location_lng')
            ->groupBy('user_location_lat')
            ->groupBy('user_location_lng')
            ->get();


        return $coords;
    }
}
