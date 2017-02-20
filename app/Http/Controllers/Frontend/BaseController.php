<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Settings;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;

class BaseController extends Controller
{
    public function __construct(){

        $settings = Settings::first();

        view()->share(compact(['settings']));
    }

}