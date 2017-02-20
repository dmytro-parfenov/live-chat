<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SettingsRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminBaseController;

use App\Models\Settings;

class AdminSettingsController extends AdminBaseController
{
    public function index(){
        return redirect('/master/settings');
    }

    public function getIndex(){
        $settings = Settings::first();
        $title = 'Settings';
        return view('admin.settings', compact(['title','settings']));
    }

    public function postIndex( SettingsRequest $request ){

        Settings::first()->update( array_merge($request->except(['_token'])) );

        return redirect()->back()->with('success','Settings saved');
    }
}
