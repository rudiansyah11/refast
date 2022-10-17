<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\log_activity;

use Validator;
use Auth;


class logoutController extends Controller
{
    public function logout(Request $request) {
        //Insert Log Activiry before direct page
        $log = new log_activity();
        $log->username = auth()->user()->name;
        $log->category_activity = "Authentication";
        $log->the_activity = "Just exited the app";
        $log->save();

        Auth::logout();
        return redirect()->route('login');
    }
}
