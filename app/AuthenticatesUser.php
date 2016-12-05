<?php
/**
 * Created by PhpStorm.
 * User: sudip sarker
 * Date: 12/5/2016
 * Time: 5:11 AM
 */

namespace App;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;
class AuthenticatesUser
{

    use ValidatesRequests;

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function invite()
    {
        $this->validateRequest()
            ->createToken()
            ->send();
    }


    public function login(LoginToken $token)
    {
        Auth::login($token->user);
        $token->delete();
    }

    protected function validateRequest()
    {
        $this->validate($this->request, [
            'email' => 'required|email|exists:users'
        ]);
        return $this;
    }


    protected function createToken()
    {
        $user = User::byEmail($this->request->email);
        return LoginToken::generateFor($user);
    }

}