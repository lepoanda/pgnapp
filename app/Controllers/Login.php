<?php

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\Session\Session;
use Config\Services;

class Login extends BaseController
{
    public function __construct()
    {
        $this->users_model = new UsersModel();
    }
    public function index()
    {
        Session();
        $data = [
            'title' => 'Login Page | PGN Trip',
            'status' => '0',
            'validation' => \Config\Services::validation()
        ];
        return view('pages/login_page', $data);
    }

    public function loginValidate()
    {
        $params = $this->request->getVar();
        $username = $params['username'];
        $password = $params['password'];

        $users = $this->users_model->getUser($username);
        $passVerify = password_verify($password, $users['password']);
        if ($passVerify) {
            return $this->accessUsers($users);
        } else {
            Session()->setFlashdata('msg', 'login gagal...');
            return redirect()->to('/login');
        }

        // if (!$this->validate([

        // ])) {
        //     session()->setFlashdata('msg', 'username harus di isi ya..');
        //     return redirect()->to('/login');
        // } elseif (!$password) {
        //     session()->setFlashdata('msg', 'Password harus di isi ya..');
        //     return redirect()->to('/login');
        // } else {
        //     $users = $this->users_model->getUser($username);
        //     $passVerify = password_verify($password, $users['password']);
        //     if ($passVerify) {
        //         session()->setFlashdata('msg', 'Login Success...');
        //         return $this->accessUsers($users);
        //     } else {
        //         session()->setFlashdata('msg', 'Login Failed...');
        //         return redirect()->to('/login');
        //     }
        // }
    }

    public function accessUsers($params)
    {
        $data_sess = array(
            'id' => $params['user_id'],
            'name' => $params['username'],
            'status' => 'login',
            'role' => $params['role']
        );

        Session()->set($data_sess);
        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        Session()->destroy();
        return redirect()->to('/pages');
    }
    //--------------------------------------------------------------------

}
