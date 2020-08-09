<?php

namespace App\Controllers;

class Dashboard extends BaseController
{

	public function index()
	{
		Session();
		if (session()->get('status') != "login") {
			return redirect()->to('/login');
		}
		$role = session()->get('role');
		$data = [
			'title' => 'Dashboard Page | PGN Trip',
			'validation' => \Config\Services::validation(),
			'status' => $role
		];

		if ($role == '1') {
			return view('pages/admin/dashboard_page', $data);
		} else {
			return view('pages/client/dashboard_page', $data);
		}
	}

	//--------------------------------------------------------------------

}
