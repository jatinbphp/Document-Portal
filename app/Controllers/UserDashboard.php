<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UserDashboard extends BaseController
{
    public function index()
    {  

        $this->data['page_title'] = 'UserDashboard';
        $this->render_user_template('userDashboard', $this->data);
    }
}
