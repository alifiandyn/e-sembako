<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthAdmin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('RoleID')) {
            session()->setFlashdata('message', 'Anda belum login, silahkan login untuk melanjutkan!');
            return redirect()->to('/Auth/SignIn');
        } elseif (session()->get('RoleID') != 1) {
            session()->setFlashdata('message', 'Anda tidak diizinkan masuk ke halaman admin!');
            return redirect()->to('/');
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
