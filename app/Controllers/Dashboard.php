<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DocumentsModel;
use App\Models\UsersModel;
use App\Models\CompanyModel;

class Dashboard extends BaseController
{
	public function index()
	{  
		$model_company = new CompanyModel;
		$companyData = $model_company->findAll();
		$this->data['companyData'] = count($companyData);

		$model_users = new UsersModel;
		$usersData = $model_users->where('isActive',1)->findAll();
		$this->data['usersData'] = count($usersData);

		$model_documents = new DocumentsModel;
		$documentsData = $model_documents->where('isActive',1)->findAll();
		$this->data['documentsData'] = count($documentsData);

     	$this->data['page_title'] = 'Dashboard';
	   	$this->render_template('dashboard', $this->data);
	}
}
