<?php

namespace App\Http\Controllers\Auth;


use App\AuthenticatesUser;
use App\Http\Controllers\Controller;
use App\LoginToken;

class AuthController extends Controller
{

    protected $auth;

    public function __construct(AuthenticatesUser $auth)
    {
        $this->auth = $auth;
    }

    public function login(){

        return view('login');

    }

    public function postLogin(AuthenticatesUser $auth){
        // Validate the request
        //Create a token
        //Send it to them .

        $auth->invite();

        return 'Sweet - go check that email , yo .';
    }

    public function authenticate(LoginToken $token)
    {
        $this->auth->login($token);
        return redirect('dashboard');
    }

    public function logout()
    {

        auth()->logout();
        return redirect('/');
    }

}
