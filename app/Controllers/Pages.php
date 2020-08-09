<?php

namespace App\Controllers;

class Pages extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'Landing Page | PGN-Trip',
			'status' => '0'
		];
		return view('pages/landing_page', $data);
	}

	//--------------------------------------------------------------------

}
