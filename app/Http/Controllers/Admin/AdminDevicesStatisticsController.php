<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminBaseController;

use App\Models\Devices;

class AdminDevicesStatisticsController extends AdminBaseController
{
    public function getIndex(){
        $title = 'Devices statistics';
        return view('admin.devices-statistics', compact(['title']));
    }

    public function getValues(){

        $devices_type = Devices::select('device_type')
            ->groupBy('device_type')
            ->get();
        if (count($devices_type) > 0) {
            foreach ($devices_type as $device_type) {
                $device_type->count = Devices::whereDeviceType($device_type->device_type)->count();
            }
        }
        $devices_os = Devices::select('device_os')
            ->groupBy('device_os')
            ->get();
        if (count($devices_os) > 0) {
            foreach ($devices_os as $device_os) {
                $device_os->count = Devices::whereDeviceOs($device_os->device_os)->count();
            }
        }

        $data = [$devices_type, $devices_os];

        return $data;
    }

}
