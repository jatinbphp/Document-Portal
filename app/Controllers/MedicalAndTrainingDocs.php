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
use App\Models\ManageDocumentsModel;

class MedicalAndTrainingDocs extends BaseController
{
    public function index()
    {  
        $userId = $_SESSION['id'];
        $this->data['page_title'] = 'Medical and Training Docs';
        $this->render_user_template('medicalAndTrainingDocs/index', $this->data);
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
            
            $url = base_url('/MedicalAndTrainingDocs/view/'.$row['company_id']);
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
    
    
	public function view($id=""){
		$userId = $_SESSION['id'];
		$this->data['page_title'] = 'Medical and Training Docs';
		$this->data['company_id'] = $id;
		$this->render_user_template('medicalAndTrainingDocs/view', $this->data);
	}
		
	public function fetch_technician_doc($id = null){
        $sesVal =  $_SERVER['HTTP_REFERER'];
        $ses_id = explode("/",$sesVal);
        $comp_id = end($ses_id);
        $session = session();
        $logged_in_sess = [
            'company_id' => $comp_id                   
        ]; 
        $this->session->set($logged_in_sess);    
        $db = \Config\Database::connect();		
  	 	$global_tblWorkflow = 'document_workfolw';
 	  	$global_tblusers_types = 'UserTypes';
	  	$global_tblcategory = 'category';
	  	$global_tblsubcategory = 'SubCategory';
	  	$global_tblcompany = 'Company';
	  	$global_tbluser_company = 'user_company';

        // equal condition
	  	 $whereEqual=array();
         $whereUser = array();
         
         //$whereEqual = $wherarr;
	  	$whereEqual=array($global_tblWorkflow.'.company_id'=>$id);
	  	
	  	$whereEqual=array($global_tblWorkflow.'.usertype_id' => $_SESSION['user_type']);
        
        // not equal condition
        $whereNotEqual = array();
        $is_deleted = 1;
        $whereNotEqual=array($global_tblWorkflow.'.is_deleted'=>$is_deleted);

        $notIn = array();     

        // select data
        $selectColumn[$global_tblWorkflow.'.*'] = $global_tblWorkflow.'.*';
        $selectColumn[$global_tblusers_types.'.userTypeName'] =  $global_tblusers_types.'.userTypeName';
        $selectColumn[$global_tblcategory.'.categoryName'] =  $global_tblcategory.'.categoryName';
        $selectColumn[$global_tblsubcategory.'.SubCatName'] =  $global_tblsubcategory.'.SubCatName';
        $selectColumn[$global_tblcompany.'.companyName'] =  $global_tblcompany.'.companyName';
       // $selectColumn[$global_tbluser_company.'.comName'] =  $global_tbluser_company.'.comName';
      	
        // order column
          $orderColumn = array($global_tblWorkflow.".document_name", $global_tblusers_types.".userTypeName", $global_tblcategory.".categoryName", $global_tblsubcategory.".SubCatName",$global_tblcompany.".companyName",$global_tblWorkflow.".comments",$global_tblWorkflow.".start_date",$global_tblWorkflow.".expire_date",'','','');

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
        $fetch_data = $model_user->make_datatables( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$whereUser);
      	
        $data = array();
        foreach ($fetch_data as $key => $row) {

            $db      = \Config\Database::connect();
            $builder = $db->table('workflow_documents');
            $builder->select('documents');
            $builder->where('workflow_id', $row['id']);
            $queryResult = $builder->get()->getResult('array');
            $sub_array = array(); 
            
            if($_SESSION['user_type'] == 5){
				
            $sub_array[] = $row['document_name'];
            $sub_array[] = $row['userTypeName']; 
            $sub_array[] = $row['categoryName']; 
			$sub_array[] = $row['SubCatName']; 
			//$actionLinkCompany  = $model_user->getActionLinkComapany('',$row['id'],'','Workflow','');
			$sub_array[] = $row['companyName'];

			//$sub_array[] = $row['document_files'];

			$actionLinkComment = $model_user->actionLinkComment('',$row['id'],'',$row['comments'],'');
			$sub_array[] = $actionLinkComment;
			$actionLinkCommentbyceo = $model_user->actionLinkCommentCeo('',$row['id'],'',$row['ceo_comments'],'');
			$sub_array[] =  $actionLinkCommentbyceo;
			//$sub_array[] = $row['comments']; 
			$sub_array[] = $row['start_date']; 
			$sub_array[] = $row['expire_date'];
           
            if($row['is_active'] == 1){
                $sub_array[] = '<span class="badge badge-success">APPROVED</span>';
            }else if($row['is_active'] == 2){
                $sub_array[] = '<span class="badge badge-primary">SUBMITED</span>';
            }
            else if($row['is_active'] == 3){
                $sub_array[] = '<span class="badge badge-danger">Expired</span>';
            }
            else if($row['is_active'] == 4){
                $sub_array[] = '<span class="badge badge-danger">REJECTED</span>';
            }
            else{
                $sub_array[] = '<span class="badge badge-danger">OUTSTANDING</span>';
            } 
		 	
		  if($row['is_active'] == 0){
            $actionLink = $model_user->getActionLinkOutstanding('',$row['id'],'Workflow','',''); 
            $sub_array[] = $actionLink;
          }elseif(($row['is_active'] == 1) && (empty($queryResult))){
            $actionLink = $model_user->getActionLinkOutstanding('',$row['id'],'Workflow','',''); 
            $sub_array[] = $actionLink;
            }else{
            $actionLink = $model_user->getActionLinkNew('',$row['id'],'Workflow','',''); 
            $sub_array[] = $actionLink;
          }
   
            $model_user= new WorkflowModel;
            $updateData = $model_user->where('id',$row['id'])->first();
            $expireDate = date('Y-m-d',strtotime($updateData['expire_date']));
            $currentDate = date('Y-m-d');
           
            $data[] = $sub_array;	
            }

        } 
        $output = array(
            "draw" =>  $_POST["draw"] ,
            "recordsTotal" => $model_user->get_all_data( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$whereUser),
            "recordsFiltered" => $model_user->get_filtered_data( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$whereUser),
            "data" => $data,
        );

        echo json_encode($output);
        
    }    
}
