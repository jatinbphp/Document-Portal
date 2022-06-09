<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\CompanyModel;

class SubadminWorkflow extends BaseController
{
    public function index()
    {  
        $userId = $_SESSION['id'];

      

        $this->data['page_title'] = 'SubadminWorkflow';
        $this->render_user_template('subadminworkflow/index', $this->data);
    }
}
