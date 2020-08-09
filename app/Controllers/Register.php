<?php

namespace App\Controllers;

use App\Models\UsersModel;

use Config\Services;

class Register extends BaseController
{
    public function __construct()
    {
        $this->users_model = new UsersModel();
    }
    public function index()
    {
        session();
        $data = [
            'title' => 'Register Page | PGN Trip',
            'status' => '0',
            'validation' => \Config\Services::validation()
        ];
        return view('pages/register_page', $data);
    }

    public function regisValidate()
    {
        $params = $this->request->getVar();
        $username = $params['username'];
        $password = $params['password'];

        $passHash = password_hash($password, PASSWORD_DEFAULT);
        $this->users_model->save([
            'username' => $username,
            'password' => $passHash,
            'role'  => '2'
        ]);

        $users = $this->users_model->getUser($username);
        $data_sess = array(
            'id' => $users['user_id'],
            'name' => $users['username'],
            'status' => 'login',
            'role' => $users['role']
        );

        Session()->set($data_sess);

        return redirect()->to('/dashboard');
    }

    //--------------------------------------------------------------------

}
