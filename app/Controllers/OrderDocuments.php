<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\WorkflowModel;
use App\Models\UsersModel;
use App\Models\SubCategoryModel;
use App\Models\CategoryModel;
use App\Models\CompanyModel;
use App\Models\ReportingModel;
use App\Models\User_typesModel;
use ZipArchive;
class OrderDocuments extends BaseController{

	public function index(){
		$company = new CompanyModel;
		$this->data['company'] = $company->findall();

		$this->data['page_title'] = 'OrderDocuments';
		$this->render_template('orderdocuments/index',$this->data);
	}

	public function fetch_data(){
		$model_user= new WorkflowModel;
		

		$db = \Config\Database::connect();		
  	 	$global_tblWorkflow = 'document_workfolw';
 	  	$global_tblusers_types = 'UserTypes';
	  	$global_tblcategory = 'category';
	  	$global_tblsubcategory = 'SubCategory';
	  	$global_tblcompany = 'Company';
	  	$global_tbluser_company = 'user_company';
	  	
	  	$global_tblworkflow_documents = 'workflow_documents';
	  	

        // equal condition
	  	 $whereEqual=array();
	  	 $is_deleted = 0;
         $whereEqual=array($global_tblWorkflow.'.is_deleted'=>$is_deleted);
         if(isset($_POST['company_id']) && $_POST['company_id'] != '' ){
			
 			  $whereEqual[$global_tblWorkflow.'.company_id']= trim($_POST['company_id']);
 		}
        // not equal condition
        $whereNotEqual = array();

        $notIn = array();     

        // select data
        $selectColumn[$global_tblWorkflow.'.*'] = $global_tblWorkflow.'.*';
        $selectColumn[$global_tblusers_types.'.userTypeName'] =  $global_tblusers_types.'.userTypeName';
        $selectColumn[$global_tblcategory.'.categoryName'] =  $global_tblcategory.'.categoryName';
        $selectColumn[$global_tblsubcategory.'.SubCatName'] =  $global_tblsubcategory.'.SubCatName';
        $selectColumn[$global_tblcompany.'.companyName'] =  $global_tblcompany.'.companyName';
        
        
      	
        // order column
        $orderColumn = array('', $global_tblWorkflow.".document_name", $global_tblusers_types.".userTypeName", $global_tblcategory.".categoryName", $global_tblsubcategory.".SubCatName", $global_tblcompany.".companyName",$global_tblWorkflow.".comments",$global_tblWorkflow.".start_date",$global_tblWorkflow.".expire_date",$global_tblWorkflow.".is_active",'','');

        // search column
        $searchColumn = array($global_tblWorkflow.".document_name",$global_tblusers_types.".userTypeName",$global_tblcategory.".categoryName",$global_tblsubcategory.".SubCatName",$global_tblWorkflow.".document_files",$global_tblcompany.".companyName");

        // order by
         $orderBy = array();
        $orderBy = array($global_tblWorkflow.'.id' => "DESC");

        // join table
        $joinTableArray = array();
       	$joinTableArray = array(array("joinTable"=>$global_tblusers_types, "joinField"=>"id", "relatedJoinTable"=>$global_tblWorkflow, "relatedJoinField"=>"usertype_id","type"=>"left"),
       		array("joinTable"=>$global_tblcategory, "joinField"=>"id", "relatedJoinTable"=>$global_tblWorkflow, "relatedJoinField"=>"category_id","type"=>"left"),

       		array("joinTable"=>$global_tblsubcategory, "joinField"=>"id", "relatedJoinTable"=>$global_tblWorkflow, "relatedJoinField"=>"subcategory_id","type"=>"left"),
       		
       		array("joinTable"=>$global_tblcompany, "joinField"=>"id", "relatedJoinTable"=>$global_tblWorkflow, "relatedJoinField"=>"company_id","type"=>"left"),
       );


     	$model_user= new WorkflowModel;
        $fetch_data = $model_user->make_datatables( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);
      
     	
        $data = array();
        
        foreach ($fetch_data as $key => $row) {
			
			
            $sub_array = array(); 
            
            
             $actionLinkSeq = $model_user->actionLinkSeq('',$row['id'],'',$row['update_seq'],''); 
            
             $sub_array[] = $row['document_name'];
            
            $sub_array[] = $row['userTypeName']; 
            $sub_array[] = $row['categoryName']; 
			$sub_array[] = $row['SubCatName']; 
			$sub_array[] = $row['companyName'];
          
			$actionLinkComment = $model_user->actionLinkComment('',$row['id'],'',$row['comments'],'');
			$sub_array[] = $actionLinkComment;
			$sub_array[] = $row['start_date'];
			$sub_array[] = $row['expire_date'];
			if($row['is_active'] == 1){
                $sub_array[] = '<span class="badge badge-success">APPROVED</span>';
            }elseif($row['is_active'] == 2){
            	$sub_array[] = '<span class="badge badge-primary">SUBMITED</span>';
            }elseif($row['is_active'] == 3){
            	$sub_array[] = '<span class="badge badge-danger">EXPIRED</span>';
            }
            elseif($row['is_active'] == 4){
            	$sub_array[] = '<span class="badge badge-danger">REJECTED</span>';
            }
            
            else{
                $sub_array[] = '<span class="badge badge-danger">OUTSTANDING</span>';
            } 
		 
         	
            $actionLink = $model_user->getActionLink('',$row['id'],'','Workflow','');
            
            $sub_array[] = $actionLink;
            $actionLinkFile = '-';
            if($row['is_update'] == 1){
           
        	
        	$sub_array[] = '<a href = "' . base_url( '/workflow/download_documents/'.$row['id']). '" class="btn btn-primary" style="margin: 0px 5px 5px 0px;padding: 4px 9px;font-size: 14px;" target="_blank"><i class="fa fa-file"></i></a>';	//for workflow id
        	
        		
            }else{
            	$sub_array[] = $actionLinkFile;
            }
            $input = '<input type="text" id="OrderData" name="OrderData>"';
           $sub_array[] = $input;
        	
            $data[] = $sub_array;

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
?>