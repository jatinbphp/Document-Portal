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

class SubadminWorkflowView extends BaseController
{
    public function index()
    {  
        $userId = $_SESSION['id'];

      

        $this->data['page_title'] = 'SubadminWorkflow';
        $this->render_user_template('subadminworkflow/view', $this->data);
    }

   
   public function fetch_workflow_view($id = ''){
    
        $db = \Config\Database::connect();      
        $global_tblWorkflow = 'document_workfolw';
        $global_tblusers_types = 'UserTypes';
        $global_tblcategory = 'category';
        $global_tblsubcategory = 'SubCategory';
        $global_tblcompany = 'Company';
        $global_tbluser_company = 'user_company';

        // equal condition
         $whereEqual=array();

         $whereEqual[$global_tblWorkflow.'company_id'] = $id;
        // not equal condition
        $whereNotEqual = array();

        $notIn = array();     

        // select data
        $selectColumn[$global_tblWorkflow.'.*'] = $global_tblWorkflow.'.*';
        $selectColumn[$global_tblusers_types.'.userTypeName'] =  $global_tblusers_types.'.userTypeName';
        $selectColumn[$global_tblcategory.'.categoryName'] =  $global_tblcategory.'.categoryName';
        $selectColumn[$global_tblsubcategory.'.SubCatName'] =  $global_tblsubcategory.'.SubCatName';
        $selectColumn[$global_tblcompany.'.companyName'] =  $global_tblcompany.'.companyName';
       // $selectColumn[$global_tbluser_company.'.comName'] =  $global_tbluser_company.'.comName';
        
        // order column
        $orderColumn = array('', $global_tblWorkflow.".document_name", $global_tblusers_types.".userTypeName", $global_tblcategory.".categoryName", $global_tblsubcategory.".SubCatName", $global_tblcompany.".companyName",$global_tblWorkflow.".document_files");

        // search column
        $searchColumn = array($global_tblWorkflow.".document_name",$global_tblusers_types.".userTypeName",$global_tblcategory.".categoryName",$global_tblsubcategory.".SubCatName",$global_tblWorkflow.".document_files",$global_tblcompany.".companyName");

        // order by
        $orderBy = array($global_tblWorkflow.'.id' => "DESC");

        // join table
        $joinTableArray = array();
        $joinTableArray = array(array("joinTable"=>$global_tblusers_types, "joinField"=>"id", "relatedJoinTable"=>$global_tblWorkflow, "relatedJoinField"=>"usertype_id","type"=>"left"),
            array("joinTable"=>$global_tblcategory, "joinField"=>"id", "relatedJoinTable"=>$global_tblWorkflow, "relatedJoinField"=>"category_id","type"=>"left"),

            array("joinTable"=>$global_tblsubcategory, "joinField"=>"id", "relatedJoinTable"=>$global_tblWorkflow, "relatedJoinField"=>"subcategory_id","type"=>"left"),
            
            array("joinTable"=>$global_tblcompany, "joinField"=>"id", "relatedJoinTable"=>$global_tblWorkflow, "relatedJoinField"=>"company_id","type"=>"left"),

            //array("joinTable"=>$global_tbluser_company, "joinField"=>"id", "relatedJoinTable"=>$global_tblWorkflow, "relatedJoinField"=>"company_id","type"=>"left")

       );


        $model_user= new WorkflowModel;
        $fetch_data = $model_user->make_datatables( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);
      
        
        $data = array();
       
        foreach ($fetch_data as $key => $row) {
            $sub_array = array(); 
            
            if($_SESSION['user_type'] == 3){
             
            $sub_array[] = $row['document_name'];
            $sub_array[] = $row['userTypeName']; 
            $sub_array[] = $row['categoryName']; 
            $sub_array[] = $row['SubCatName']; 
            //$actionLinkCompany  = $model_user->getActionLinkComapany('',$row['id'],'','Workflow','');
            $sub_array[] = $row['companyName'];

            //$sub_array[] = $row['document_files'];
          

            $sub_array[] = $row['comments']; 
            $sub_array[] = $row['start_date']; 
            $sub_array[] = $row['expire_date']; 


            

            
            //$sub_array[] = $row['dateAdded'];
            //$actionLink = $model_user->getActionLink('',$row['id'],'Workflow','',$row['userTypeID']); 
            
            $actionLink = $model_user->getActionLinkData('',$row['id'],'','Workflow','');
            
            $sub_array[] = $actionLink;
            $data[] = $sub_array;   
            }
            else{
                
            // $imgSrc = base_url('assets/images/download1.png');
            //   $sub_array[] = '<a href = "' . base_url( '/workflow/view_documents/'.$row['id']). '" target="_blank"><button class = "btn btn-primary">View Documents</button></a>';
            $sub_array[] = $row['document_name'];
            $sub_array[] = $row['userTypeName']; 
            $sub_array[] = $row['categoryName']; 
            $sub_array[] = $row['SubCatName']; 
            //$actionLinkCompany  = $model_user->getActionLinkComapany('',$row['id'],'','Workflow','');
            $sub_array[] = $row['companyName'];

            //$sub_array[] = $row['document_files'];
          

            $sub_array[] = $row['comments']; 
            $sub_array[] = $row['start_date']; 
            $sub_array[] = $row['expire_date']; 
            if($row['is_active'] == 1){
                $sub_array[] = '<span class="badge badge-success">Active</span>';
            }else{
                $sub_array[] = '<span class="badge badge-danger">InActive</span>';
            } 
            

            
            //$sub_array[] = $row['dateAdded'];
            //$actionLink = $model_user->getActionLink('',$row['id'],'Workflow','',$row['userTypeID']); 
            
            $actionLink = $model_user->getActionLink('',$row['id'],'','Workflow','');
            
            $sub_array[] = $actionLink;
            $data[] = $sub_array;
        }

        } 
        $output = array(
            "draw" =>  $_POST["draw"] ,
            "recordsTotal" => $model_user->get_all_data( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "recordsFiltered" => $model_user->get_filtered_data( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "data" => $data,
        );

        echo json_encode($output);
        
    }
    
}
