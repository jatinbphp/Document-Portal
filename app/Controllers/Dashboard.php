<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
	public function index()
	{  
     	$this->data['page_title'] = 'Dashboard';
	   	$this->render_template('dashboard', $this->data);
	}
}
