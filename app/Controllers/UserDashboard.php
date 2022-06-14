<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DocumentsModel;
use App\Models\UsersModel;
use App\Models\CompanyModel;
use App\Models\User_typesModel;

class UserDashboard extends BaseController
{
    public function index()
    {  if($_SESSION['user_type']== 1 || $_SESSION['user_type']== 2 || $_SESSION['user_type']== 3){
            $userId = $_SESSION['id'];
            $company_get = new UsersModel;
            $companyId = $company_get->where('id',$_SESSION['id'])->first();

            $comId = $companyId['companyId'];

            $model_documents = new DocumentsModel;
            //$documentsData = $model_documents->where('userID',$userId)->where('companyID',$comId)->findAll();
            //$this->data['documentsData'] = count($documentsData);
            $model_documents->selectCount('docName');
            $query = $model_documents->where('userID', $userId); 
            $totalDoc = $query->get()->getResultArray();
            foreach($totalDoc as $val){
				 $documentsData =  $val['docName'];
			}
			$this->data['tatalDoc'] = $documentsData;

            
            $db = \Config\Database::connect(); 
            $id = $_SESSION['id'];
            $builder = $db->table('user_company');
            $builder1 = $builder->where('user_id',$id);
            $query = $builder1->get();
            $existData = count($query->getResult());
            $this->data['compTotal'] = $existData;

                
            $this->data['page_title'] = 'UserDashboard';
            $this->render_user_template('userDashboard', $this->data);
        }
        else{
            return redirect()->to('appAdmin');
        }
       
    }
}
