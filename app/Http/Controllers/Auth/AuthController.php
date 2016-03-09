<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Hash;
use Input;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
          'name' => 'required|between:4,50|regex:/(^[A-Za-z0-9 ]+$)+/',
          'email' => 'required|between:4,64|email',
          'password' => 'required|between:4,30',
        ]);
        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // get the error messages from the validator
          $messages = $validator->messages();

            return $messages;
        }
    }

    protected function create(array $data)
    {
        $rules = array(
            'name' => 'required|between:4,50|regex:/(^[A-Za-z0-9 ]+$)+/',
            'email' => 'required|between:4,64|email',
            'password' => 'required|between:4,30',
        );
        $validator = \Validator::make($data, $rules);
        if ($validator->fails()) {
            // get the error messages from the validator
          $messages = $validator->messages();

            return $messages;
        }
        $Users = User::where('email', '=', $data['email'])->first();
        if (!is_null($Users)) {
            \Session::flash('error', 'Your email address already exist if you have issue to login, you can simply reset your password.');

            return redirect('/');
            // return redirect('/test')->with('error', 'Your email address already exist if you have issue to login, you can simply reset your password.');
        } else {
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);
        }
        \Session::flash('success', 'Your account has been created. please go to your email and active your account.');

        return redirect('/');

        
    }

}