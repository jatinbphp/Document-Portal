<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DocumentsModel;
use App\Models\UsersModel;
use App\Models\CompanyModel;
use App\Models\User_typesModel;
use App\Models\WorkflowModel;
use App\Models\UserCompanyModel;

class UserDashboard extends BaseController
{
    public function index()
    {  if($_SESSION['user_type']== 1 || $_SESSION['user_type']== 2 || $_SESSION['user_type']== 3){
            $userId = $_SESSION['id'];
            $company_get = new UsersModel;
            $companyId = $company_get->where('id',$_SESSION['id'])->first();

            $comId = $companyId['companyId'];

            $model_documents = new DocumentsModel;

            $company_model = new UserCompanyModel;
            $data = $company_model->select('company_id')->where('user_id',$_SESSION['id'])->findAll();

            foreach($data as $comval){
                $comID[] = $comval['company_id'];
            }
            $myArr = implode(",",$comID);
            $mystr = $myArr.",0";
           $array  =  explode(",", $mystr);

              $db = \Config\Database::connect();
            
            // $heroesCount = $db->table('DocumentsManage')->countAll();
            // echo $db->getLastQuery();exit;
            //$documentsData = $model_documents->where('userID',$userId)->where('companyID',$comId)->findAll();
            //$this->data['documentsData'] = count($documentsData);
           

          
           $str1 = 'companyID=';
            $str2= implode('companyID=',$array);
            
            $str1 .= $str2;
            $str = $str1;
            $arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$str);
            $str3= implode(' OR ',$arr);                                                               
            
            
            $where =  "(userID='".$userId."' OR userID=0)";
            $whereCompany =  "(".$str3.")";
            $model_documents->selectCount('docName');

             
            $query = $model_documents->Where($where);
            $query = $model_documents->Where($whereCompany);
            $query = $model_documents->where('isActive', 1);

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
            
            
            $userType_id = $_SESSION['user_type'];
            $workflow = $db->table('document_workfolw');
            $workflow1= $workflow->where('usertype_id', $userType_id);
            $query = $workflow1->get();
            $queryResults = count($query->getResult());
            $this->data['workflowTotal'] = $queryResults;

            
           // $buildersql = $this->db->table("user_company");
            $buildersql = $db->table('user_company');
            $buildersql1 =$buildersql->select('user_company.*, Company.companyName as companyName');
            $buildersql2 = $buildersql1->join('Company', 'user_company.company_id = Company.id');
            $buildersql3 =$buildersql2->where('user_id',$id);
            $this->data['totalcompany'] = $buildersql3->get()->getResultArray();
           
           
                   
            $this->data['page_title'] = 'UserDashboard';
            $this->render_user_template('userDashboard', $this->data);
        }
        else{
            return redirect()->to('appAdmin');
        }
       
    }
}
