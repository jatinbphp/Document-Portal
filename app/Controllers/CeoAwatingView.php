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

class CeoAwatingView extends BaseController
{
    public function index($id)
    {  
       
            $userId = $_SESSION['id'];
            $this->data['page_title'] = 'ceoview';
            
            $this->data['company_id'] = $id;
            $this->render_user_template('Ceo/awating_approval/view', $this->data);
       
    }

   
   public function fetch_awaiting_view($id = null){
   	   
    
        $db = \Config\Database::connect();		
  	 	$global_tblWorkflow = 'document_workfolw';
 	  	$global_tblusers_types = 'UserTypes';
	  	$global_tblcategory = 'category';
	  	$global_tblsubcategory = 'SubCategory';
	  	$global_tblcompany = 'Company';
	  	$global_tbluser_company = 'user_company';

        // equal condition
	  	 $whereEqual=array();
         $waiting = $_SESSION['id'];
         $wherarr1 = array(
         	$global_tblWorkflow.'.company_id' =>$id,
         	$global_tblWorkflow.'.awating_user_id' =>$waiting,
         ); 
	  	// $whereEqual=array($global_tblWorkflow.'.company_id'=>$id);
	  	 $whereEqual = $wherarr1;
        
        // not equal condition
        $whereNotEqual = array();
        $whereUser = array();
        $is_deleted = 1;
        
        $wherarr = array(
         	$global_tblWorkflow.'.is_deleted' =>$is_deleted,
         	
         ); 
        
        // $whereNotEqual=array($global_tblWorkflow.'.is_deleted'=>$is_deleted);
        $whereNotEqual=$wherarr;

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

            $actionLink = $model_user->actionLinkView('',$row['id'],'','','');
		 	$sub_array[] = $actionLink;

		  // if($row['is_active'] == 0){
    //         $actionLink = $model_user->getActionLinkOutstanding('',$row['id'],'Workflow','',''); 
    //         $sub_array[] = $actionLink;
    //       }elseif(($row['is_active'] == 1) && (empty($queryResult))){
    //         $actionLink = $model_user->getActionLinkOutstanding('',$row['id'],'Workflow','',''); 
    //         $sub_array[] = $actionLink;
    //         }else{
    //         $actionLink = $model_user->getActionLinkNew('',$row['id'],'Workflow','',''); 
    //         $sub_array[] = $actionLink;
    //       }
        	
              $model_user= new WorkflowModel;
            $updateData = $model_user->where('id',$row['id'])->first();
            $expireDate = date('Y-m-d',strtotime($updateData['expire_date']));
            $currentDate = date('Y-m-d');
            
            $data[] = $sub_array;	
            

        } 
        $output = array(
            "draw" =>  $_POST["draw"] ,
            "recordsTotal" => $model_user->get_all_data( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$whereUser),
            "recordsFiltered" => $model_user->get_filtered_data( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$whereUser),
            "data" => $data,
        );

        echo json_encode($output);
        
    }

    
    public function update(){
    	if($_POST){
			$model_workflow = new WorkflowModel;
			$request = service('request');
			$session = session();
			$comments = $request->getPost('comments');
			$sec_approval_status = $request->getPost('sec_approval_status');
			$id = $request->getPost('getId');
			$data = array(
				'ceo_comments' => $comments,
				'sec_approval_status' => $sec_approval_status,
			);

			$model_workflow->set($data);
	    	$model_workflow->where('id', $id);
	    	$result =  $model_workflow->update();

	    	$model_user = new UsersModel;
	        $email1 = $model_user->where('userTypeID',0)->where('super_admin',1)->first();
		        if(count($email1)>0){
		           $recieve_email = $email1['receive_email']; 
		        }else{
		           $recieve_email = 'amit.kk.php@gmail.com';
		        }

		        if($sec_approval_status == 1){
		        	$status = 'APPROVED';
		        }
		        elseif($sec_approval_status == 2){
		        	$status = 'REJECTED';
		        }
                else{
                    $status = '-';
                }
	        
	        $userFirstName = $email1['firstName'];
	        $userLastName = $email1['lastName'];
	        
	             $message = ' <b>Hello! <br> <br>
                         '.$userFirstName.' '.$userLastName.' </b>
                        <br><br><b>Comments-</b> '.$comments.'
                        <br><b>Status- </b> '.$status.' '; 

                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        $headers .= '<noreply@hseqss.co.za>';
                        
                        $to = $recieve_email;
                       
                        $subject = 'HSEQ Document';

                        mail($to,$subject,$message,$headers);
                        
                        // $email = \Config\Services::email();
                        // $email->setFrom('gert@gsdm.co.za', 'HSEQ User');
                        //  $email->setTo($recieve_email);
                        // $email->setSubject('HSEQ Document');
                        // $email->setMessage($message);
                        //  if ($email->send()) 
                        // {
                        //     echo 'Email successfully sent';
                        // } 
                        // else 
                        // {
                        //     $data = $email->printDebugger(['headers']);
                        //     print_r($data);
                        // }

	    	if($result ){ 
		            $session->setFlashdata("success", "Data updated Successfully.");
		            return redirect()->to($_SERVER['HTTP_REFERER']);
	           	} else {
		        	$session->setFlashdata("error", "Something went wrong.");
		            return redirect()->to($_SERVER['HTTP_REFERER']);  
		        }  
    	}
    }

    
    
}
