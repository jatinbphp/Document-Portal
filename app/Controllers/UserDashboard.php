<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DocumentsModel;
use App\Models\UsersModel;
use App\Models\CompanyModel;

class UserDashboard extends BaseController
{
    public function index()
    {  
        $userId = $_SESSION['id'];

        $company_get = new UsersModel;
        $companyId = $company_get->where('id',$_SESSION['id'])->first();
        $comId = $companyId['companyId'];

        $model_documents = new DocumentsModel;
        $documentsData = $model_documents->where('userID',$userId)->where('companyID',$comId)->findAll();
        $this->data['documentsData'] = count($documentsData);

        $this->data['page_title'] = 'UserDashboard';
        $this->render_user_template('userDashboard', $this->data);
    }
}
