<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\log_activity;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    protected function redirectTo(){
        if( Auth()->user()->role == 1){
            return route('HeadTeam.menu');
        
        } else if( Auth()->user()->role == 2){
            return route('OpratorTeam.profile');
        }
    }
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $req){
        $datanya = $req->all();

        $validator = Validator::make($req->all(),[
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator);
        }

        if( auth()->attempt(array('email'=>$datanya['email'], 'password'=>$req['password'])) ){
            if( auth()->user()->role == 1 ){
                //Insert Log Activiry before direct page
                $log = new log_activity();
                $log->username = auth()->user()->name;
                $log->category_activity = "Authentication";
                $log->the_activity = "Just logged in";
                $log->save();

                return redirect()->route('HeadTeam.menu');
            
            } elseif( auth()->user()->role == 2 ){
                //Insert Log Activiry before direct page
                $log = new log_activity();
                $log->username = auth()->user()->name;
                $log->category_activity = "Authentication";
                $log->the_activity = "Just logged in";
                $log->save();
                return redirect()->route('OpratorTeam.profile');
            }

        } else {
            return redirect()->route('login')->with('error', 'Email and Password are Wrong!');
        }
    }

}
