<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('home');
    }

    public function setLanguage()
	{
		$lang = $this->request->uri->getSegments()[1];
		$this->session->set("lang", $lang);
		return redirect()->to(base_url());
	}
}
