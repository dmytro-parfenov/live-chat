<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Devices;
use App\Models\Settings;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Cookie;

class BaseController extends Controller
{
    public function __construct(){

        $settings = Settings::first();

        view()->share(compact(['settings']));
    }

    public function sendLocation(Request $request){

        $user_location_lat = $request->get('user_location_lat');
        $user_location_lng = $request->get('user_location_lng');

        if ($user_location_lat && $user_location_lng){
            Cookie::queue('user_location_lat', $user_location_lat);
            Cookie::queue('user_location_lng', $user_location_lng);
        }

    }

    public function sendDeviceInfo(Request $request){

        $user_id_device = Cookie::get('user_id_device');
        $device_type = $request->get('device_type');
        $device_os = $request->get('device_os');

        if ($device_type !== '' && $device_os !== '') {
            if (!empty($user_id_device)) {
                    if (count(Devices::whereUserIdDevice($user_id_device)->get()) <= 0) {
                        Devices::create( ['user_id_device' => $user_id_device, 'device_type' => $device_type, 'device_os' => $device_os] );
                    }
            } else {
                $user_id_device = time();
                Cookie::queue('user_id_device', $user_id_device);
                Devices::create( ['user_id_device' => $user_id_device, 'device_type' => $device_type, 'device_os' => $device_os] );
            }
        }

    }

}