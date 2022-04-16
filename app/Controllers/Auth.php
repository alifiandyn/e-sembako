<?php

namespace App\Controllers;

use App\Models\AuthModel;
use CodeIgniter\Session\Session;

class Auth extends BaseController
{
    protected $authModel;

    public function __construct()
    {
        $this->authModel = new AuthModel();
    }
    public function index()
    {
        $data = [
            "title" => "Sign In",
            "validation" => \Config\Services::validation()
        ];
        return view('auth/signin', $data);
    }

    public function SignUp()
    {
        $data = [
            "title" => "Sign Up",
            "validation" => \Config\Services::validation()
        ];
        return view('auth/signup', $data);
    }

    public function SignoutProcess()
    {
        $signinData = ['UserID', 'Username', 'Email', 'RoleID'];
        session()->remove($signinData);
        // session()->destroy();  // Kalo pake destroy, setFlashdata nggak bakal jalan 
        session()->setFlashdata('message', 'Anda berhasil Sign Out!');
        return redirect()->to('/Auth/SignIn');
    }

    public function SigninProcess()
    {
        if (!$this->validate([
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]|max_length[20]'
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('Auth/SignIn')->withInput()->with('validation', $validation);
        } else {
            $getUser = $this->authModel->getWhere(['email' => $this->request->getPost('email')])->getResultArray();
            if (!$getUser) {
                session()->setFlashdata('message', 'Email ' . $this->request->getPost('email') . ' tidak terdaftar, silahkan Sign Up terlebih dahulu!');
                return redirect()->to('/Auth/SignIn');
            } else {
                if (password_verify($this->request->getPost('password'), $getUser[0]["Password"])) {
                    $data = [
                        'UserID' => $getUser[0]["UserID"],
                        'Username' => $getUser[0]["Username"],
                        'Email' => $getUser[0]["Email"],
                        'RoleID' => $getUser[0]["RoleID"],
                    ];
                    session()->set($data);
                    return redirect()->to('/');
                } else {
                    session()->setFlashdata('message', 'Password yang anda masukan salah, silahkan coba lagi!');
                    return redirect()->to('/Auth/SignIn');
                }
            }
        }
    }

    public function SignupProcess()
    {
        if (!$this->validate([
            'username' => 'required',
            'email' => 'required|is_unique[users.Email]|valid_email',
            'password' => 'required|min_length[8]|max_length[20]|matches[passwordValidation]',
            'passwordValidation' => 'required|matches[password]',
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('Auth/SignUp')->withInput()->with('validation', $validation);
        }

        if ($this->request->getPost('username') == null) {
            session()->setFlashdata('message', 'Harap masukan username anda!');
            return redirect()->to('/Auth/SignUp');
        } else {
            if ($this->request->getPost('email') == null) {
                session()->setFlashdata('message', 'Harap masukan email anda!');
                return redirect()->to('/Auth/SignUp');
            } else {
                if ($this->request->getPost('password') == null) {
                    session()->setFlashdata('message', 'Harap masukan password anda!');
                    return redirect()->to('/Auth/SignUp');
                } else {
                    if ($this->request->getPost('password') !== $this->request->getPost('passwordValidation')) {
                        session()->setFlashdata('message', 'Password yang anda masukan tidak sama!');
                        return redirect()->to('/Auth/SignUp');
                    } else {
                        $data = [
                            'username' => strtolower($this->request->getPost('username')),
                            'email' => strtolower($this->request->getPost('email')),
                            'password' => $this->request->getPost('password')
                        ];
                        $this->authModel->RegisterNewUser($data);
                        session()->setFlashdata('message', 'Registrasi akun anda berhasil, silahkan signin untuk melanjutkan!');
                        return redirect()->to('/Auth/SignUp');
                    }
                }
            }
        };
    }

    public function ForgotPassword()
    {
        $data = ["title" => "Forgot Password"];
        return view('auth/forgot_password', $data);
    }
}
