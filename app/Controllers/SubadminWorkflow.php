<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserCompanyModel;
use App\Models\WorkflowModel;
use App\Models\UsersModel;
use App\Models\SubCategoryModel;
use App\Models\CategoryModel;
use App\Models\CompanyModel;
use App\Models\ReportingModel;
use App\Models\User_typesModel;

class SubadminWorkflow extends BaseController
{
    public function index()
    {  
        
         $userId = $_SESSION['id'];

        $this->data['page_title'] = 'SubadminWorkflow';
        $this->render_user_template('subadminworkflow/index', $this->data);
        
    }

   
    public function fetch_company_data(){
        $db = \Config\Database::connect();      
        $global_tbluser_company = 'user_company';
        $global_tblcompany = 'Company';
        $id = $_SESSION['id'];
        
        // equal condition
        $whereEqual = array(); 
        
        // not equal condition
        $whereNotEqual = array();

        
        $whereEqual[$global_tbluser_company.'.user_id'] = $id;

        $notIn = array();     

        // select data
        $selectColumn[$global_tbluser_company.'.*'] = $global_tbluser_company.'.*';
        $selectColumn[$global_tblcompany.'.companyName'] = $global_tblcompany.'.companyName';
        
        // order column
        $orderColumn = array($global_tblcompany.".companyName" );

        // search column
        $searchColumn = array($global_tblcompany.".companyName");

        // order by
        $orderBy = array($global_tbluser_company.'.id' => "ASC");

        // join table
        $joinTableArray = array(array("joinTable"=>$global_tblcompany, "joinField"=>"id", "relatedJoinTable"=>$global_tbluser_company, "relatedJoinField"=>"company_id","type"=>"left"));

        $model_category= new UserCompanyModel;
        $fetch_data = $model_category->make_datatables( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);
       
     
        $data = array();
        //echo "<pre>";print_r($fetch_data);exit;
        foreach ($fetch_data as $key => $row) {
            $sub_array = array(); 
            
            $url = base_url('/SubadminWorkflowView/index/'.$row['company_id']);
            $company = "<a href = '".$url."'.>".$row['companyName']."</a>";
            $sub_array[] = $company;  
            
           // $actionLink = $model_category->getActionLink('',$row['id'],'Category','',1); 
            
           // $sub_array[] = $actionLink;
            $data[] = $sub_array;
        } 

        $output = array(
            "draw" =>  $_POST["draw"] ,
            "recordsTotal" => $model_category->get_all_data( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "recordsFiltered" => $model_category->get_filtered_data( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "data" => $data,
        );

        echo json_encode($output);
    }
    
}
