<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index()
    {
        $data = ["title"=>"Sign In"];
        return view('auth/signin',$data);
    }

    public function SignUp()
    {
        $data = ["title"=>"Sign Up"];
        return view('auth/signup',$data);
    }

    public function ForgotPassword()
    {
        $data = ["title"=>"Forgot Password"];
        return view('auth/forgot_password',$data);
    }
}
