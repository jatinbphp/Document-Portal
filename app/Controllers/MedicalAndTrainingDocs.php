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
        
         //$userId = $_SESSION['id'];
         
      $db      = \Config\Database::connect();
	  $id = $_SESSION['user_type'];
	  //echo $id;
	  //exit;
	  $builder = $db->table('document_workfolw');
	  $builder->select('companyName, company_id')->distinct();
	  $builder->where('usertype_id', $id);
	  $builder->join('Company', 'Company.id = document_workfolw.company_id', 'left');
	  $query = $builder->get();
	  $queryResult = $query->getResult('array');
	  $this->data['companyName'] = $queryResult;

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
   
   
  
   
   
    
   /*
    public function fetch_company_data(){
        $db = \Config\Database::connect();      
        $global_tbluser_company = 'user_company';
        $global_tblWorkflow = 'document_workfolw';
        $global_tblcompany = 'Company';
        $id = $_SESSION['user_type'];
        
        // equal condition
        $whereEqual = array(); 
        
        // not equal condition
        $whereNotEqual = array();

        
        //$whereEqual[$global_tbluser_company.'.user_id'] = $id;
        
        $whereUser[$global_tblWorkflow.'.company_id']= $id;

        $notIn = array();     

        // select data
        
        //$selectColumn[$global_tbluser_company.'.*'] = $global_tbluser_company.'.*';
        //$selectColumn[$global_tblcompany.'.companyName'] = $global_tblcompany.'.companyName';
        
			$selectColumn[$global_tblWorkflow.'.*'] = $global_tblWorkflow.'.*';
			$selectColumn[$global_tblcompany.'.companyName'] =  $global_tblcompany.'.companyName';
        
        // order column
        //$orderColumn = array($global_tblcompany.".companyName" );
        
        $orderColumn = array();

        // search column
        //$searchColumn = array($global_tblcompany.".companyName");
        
        $searchColumn = array();

        // order by
        //$orderBy = array($global_tbluser_company.'.id' => "ASC");
        $orderBy = array();

        // join table
        //$joinTableArray = array(array("joinTable"=>$global_tblcompany, "joinField"=>"id", "relatedJoinTable"=>$global_tbluser_company, "relatedJoinField"=>"company_id","type"=>"left"));

			
		$joinTableArray = array(array("joinTable"=>$global_tblcompany, "joinField"=>"id", "relatedJoinTable"=>$global_tblWorkflow, "relatedJoinField"=>"company_id","type"=>"left"));	

        //$model_category= new UserCompanyModel;
        //$fetch_data = $model_category->make_datatables( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);
       
       
       
       $model_user= new WorkflowModel;
        $fetch_data = $model_user->make_datatables( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);
       
       
     
        $data = array();
        echo "<pre>";print_r($fetch_data);exit;
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
    */
    
    
    
    
		public function view($id=""){
			//echo $id;
			//exit;
			$userId = $_SESSION['id'];
			$db      = \Config\Database::connect();
			$builder = $db->table('Company');
			$builder->select('companyName');
			$builder->where('id', $id);
			$query = $builder->get();
			$queryResult = $query->getRow();
			$companyName = $queryResult->companyName;
			
			
			
			$this->data['companyName'] = $companyName;
            $this->data['page_title'] = 'Medical and Training Docs';
            
            $this->data['company_id'] = $id;
            $this->render_user_template('medicalAndTrainingDocs/view', $this->data);
		}
		
		
		
		
		
		
	public function fetch_technician_doc($id = null){
		

        $sesVal =  $_SERVER['HTTP_REFERER'];
       // echo $sesVal;
        //exit;
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
         
         // $wherarr = array(
         //    $global_tblWorkflow.'.company_id' =>$id,
         //    $global_tblWorkflow.'.usertype_id' =>3
         // ); 

         //$whereEqual = $wherarr;
	  	//$whereEqual=array($global_tblWorkflow.'.company_id'=>$id);
	  	
	  	// $whereEqual=array($global_tblWorkflow.'.usertype_id' => $_SESSION['user_type'], $global_tblWorkflow.'.company_id'=>$comp_id);
         $whereEqual=array($global_tblWorkflow.'.technician_id' => $_SESSION['id'], $global_tblWorkflow.'.company_id'=>$comp_id);
        
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
        $orderBy = array($global_tblWorkflow.'.order_update' => "ASC");

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
      
        //echo "<pre>";
        //print_r($fetch_data);
        //exit;
     	
        $data = array();
        foreach ($fetch_data as $key => $row) {

            $db      = \Config\Database::connect();
            $builder = $db->table('workflow_documents');
            $builder->select('documents');
            $builder->where('workflow_id', $row['id']);
            $queryResult = $builder->get()->getResult('array');
            $sub_array = array(); 
            
            if($_SESSION['user_type'] == 5){
				//echo "true";
				//exit;
             
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
            // $sub_array[] =  $actionLinkCommentbyceo;
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


		 	
		/*
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
          */
          if($row['is_active'] == 0){
             
            $sub_array[] = '<a  class="" style="margin: 0px 5px 5px 0px;padding: 4px 9px;font-size: 20px;"></a><i class="fa fa-file" style="color: grey;font-size: 20px; margin-left:8px"></i>';
          }
          else{
            $sub_array[] = '<a href = "' . base_url( 'workflow/download_documents/'.$row['id']). '" class="btn btn-primary" style="margin: 0px 5px 5px 0px;padding: 4px 9px;font-size: 10px;" target="_blank"><i class="fa fa-file"></i></a>
                  <a href = "#" onclick="return false" class="btn btn-primary modalButton" data-custom-value="'.$row['id'].'" style="margin: 0px 5px 5px 0px;padding: 4px 9px;font-size: 10px;" ><i class="fa fa-eye"></i></a>';
          }
          

          
           
        	//$sub_array[] = $row['dateAdded'];
         	// $actionLink = $model_user->getActionLinkNew('',$row['id'],'Workflow','',''); 
          //   $sub_array[] = $actionLink;
              $model_user= new WorkflowModel;
            $updateData = $model_user->where('id',$row['id'])->first();
            $expireDate = date('Y-m-d',strtotime($updateData['expire_date']));
            $currentDate = date('Y-m-d');
            //$currentDate = date('Y-m-d', strtotime('+1 days'));
           //  if($row['is_active'] == 1){
           //      $actionLink = $model_user->getActionLinkDataSubmit('',$row['id'],'','Workflow','');
                
           //      $sub_array[] = $actionLink;
           //  }
           // else if($updateData['id'] == $row['id'] && $updateData['is_update'] == 1 && $row['is_active'] == 2 ){
           //     $dd1 = "When Approved by Admin then will display file"; 
           //     $sub_array[] = $dd1;
           //  }
            
           //  else if($expireDate == $currentDate || $row['is_active'] == 3){
           //      $actionLink = $model_user->getActionLinkData('',$row['id'],'','Workflow','');
           //      $dd = "-"; 
           //      $sub_array[] = $dd;
           //    //$dd = "<span class= 'btn-info'></span>"; 
           //     //$sub_array[] =$actionLink;
           //  }
           //  elseif($row['is_active'] == 0){
           //     $actionLink = $model_user->getActionLinkDatapending('',$row['id'],'','Workflow','');
                
           //      $sub_array[] = $actionLink; 
           //  }
           //  else{
           //      $actionLink = $model_user->getActionLinkData('',$row['id'],'','Workflow','');
                
           //      $sub_array[] = $actionLink;
           //  }   
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
            "recordsTotal" => $model_user->get_all_data( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$whereUser),
            "recordsFiltered" => $model_user->get_filtered_data( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$whereUser),
            "data" => $data,
        );

        echo json_encode($output);
        
    }
    
    public function ajaxpopup(){
		$company = new CompanyModel;
		$this->data['company'] = $company->findall();
		$model_comments = new WorkflowModel;
		$this->data['comments'] = $model_comments->select('comments')->findAll();
		$this->data['page_title'] = 'Workflow';
			
		$id = $_POST['docValue'];
		$db = \Config\Database::connect(); 
		$builder = $db->table('workflow_documents');
		$builder1 = $builder->where('workflow_id',$id);
		$query = $builder1->get();
		$datadoc = $query->getResultArray();

		//$counter = 0;

		$response = "<table class='table'>";
		$response .= " <thead class='thead-dark'>";
		$response .= "<tr>";
		$response .= "<th scope='col' style='width: 10%'>#</th>";
		$response .= "<th scope='col' style='width: 70%'>Document Name</th>";
		$response .= "<th scope='col' style='width: 20%'>Action</th>";
		$response .= "</tr>";
		$response .= "</thead>";
		$response .= "<tbody>";
		
		
		
		
		foreach($datadoc as $key => $value){
			$response .= "<tr>";
			$response .= "<td>".++$key."</td>";
			$response .= "<td>".$value['documents']."</td>";
			$response .= "<td><a href = ".base_url( '/uploads/workflow/'.$value['documents'])." class='btn btn-primary' style='margin: 0px 5px 5px 0px;padding: 4px 9px;font-size: 14px;' target='_blank'><i class='fa fa-file'></i></a></td>";
			$response .= "</tr>";
		}

		$response .= "</tbody>";
		$response .= "</table>";

		echo $response;

		
	}   
}

