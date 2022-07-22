<?php 
namespace App\Controllers;
use App\Controllers\BaseController;
//use App\Models\WorkflowModel;
use App\Models\ExpiredDocumentsModel;
use App\Models\UsersModel;
use App\Models\SubCategoryModel;
use App\Models\CategoryModel;
use App\Models\CompanyModel;
use App\Models\ReportingModel;
use App\Models\User_typesModel;
use Datetime;
class ExpiredDocuments extends BaseController{

	public function index(){
		
		$company = new CompanyModel;
        $this->data['company'] = $company->findall();

		$this->data['page_title'] = 'Expired Documents';
        $this->render_template('reporting/expired_documents/index',$this->data);
	}
	
	public function fetch_expired_documents(){
		 //echo $_POST['company_id'];
		 //exit;
		$db = \Config\Database::connect();		
  	 	$global_tblWorkflow = 'document_workfolw';
 	  	$global_tblusers_types = 'UserTypes';
	  	$global_tblcategory = 'category';
	  	$global_tblsubcategory = 'SubCategory';
	  	$global_tblcompany = 'Company';
	  	
	  	$currentDate = new DateTime();
        $currentDate =  $currentDate->format('Y-m-d');
        
        // equal condition
	  	 $whereEqual=array();
         
	  	 
	  	 //$whereEqual[$global_tblWorkflow.'.expire_date'] = trim($currentDate);
	  	
	  	  if(isset($_POST['company_id']) && $_POST['company_id'] != '' ){
			
 			  //$whereEqual[$global_tblWorkflow.'.company_id']= trim($_POST['company_id']);
              $whereEqual=array($global_tblWorkflow.'.is_active'=>3,$global_tblWorkflow.'.company_id'=>trim($_POST['company_id']));
              
 		}
        else{
            $whereEqual=array($global_tblWorkflow.'.is_active'=>3);
        }
	  	 
        // not equal condition
        $whereNotEqual = array();
        
        $whereNotEqual[$global_tblWorkflow.'.expire_date'] = trim($currentDate); //fetching expired documents based on current date

        $notIn = array();     

        // select data
        $selectColumn[$global_tblWorkflow.'.*'] = $global_tblWorkflow.'.*';
        $selectColumn[$global_tblusers_types.'.userTypeName'] =  $global_tblusers_types.'.userTypeName';
        $selectColumn[$global_tblcategory.'.categoryName'] =  $global_tblcategory.'.categoryName';
        $selectColumn[$global_tblsubcategory.'.SubCatName'] =  $global_tblsubcategory.'.SubCatName';
        $selectColumn[$global_tblcompany.'.companyName'] =  $global_tblcompany.'.companyName';
      	
        // order column
        $orderColumn = array('', $global_tblWorkflow.".document_name", $global_tblusers_types.".userTypeName", $global_tblcategory.".categoryName", $global_tblsubcategory.".SubCatName", $global_tblcompany.".companyName",$global_tblWorkflow.".comments",$global_tblWorkflow.".expire_date",'','');

        // search column
        $searchColumn = array($global_tblWorkflow.".document_name",$global_tblusers_types.".userTypeName",$global_tblcategory.".categoryName",$global_tblsubcategory.".SubCatName",$global_tblWorkflow.".document_files",$global_tblcompany.".companyName");

        // order by
        $orderBy = array($global_tblWorkflow.'.order_update' => "ASC");

        // join table
        $joinTableArray = array();
       	$joinTableArray = array(array("joinTable"=>$global_tblusers_types, "joinField"=>"id", "relatedJoinTable"=>$global_tblWorkflow, "relatedJoinField"=>"usertype_id","type"=>"left"),
       		array("joinTable"=>$global_tblcategory, "joinField"=>"id", "relatedJoinTable"=>$global_tblWorkflow, "relatedJoinField"=>"category_id","type"=>"left"),

       		array("joinTable"=>$global_tblsubcategory, "joinField"=>"id", "relatedJoinTable"=>$global_tblWorkflow, "relatedJoinField"=>"subcategory_id","type"=>"left"),
       		
       		array("joinTable"=>$global_tblcompany, "joinField"=>"id", "relatedJoinTable"=>$global_tblWorkflow, "relatedJoinField"=>"company_id","type"=>"left")

       );


     	$model_user= new ExpiredDocumentsModel;
        $fetch_data = $model_user->make_datatables( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);
      
     	
        $data = array();
        
        foreach ($fetch_data as $key => $row) {
            $sub_array = array(); 
            
            $imgSrc = base_url('assets/images/download1.png');
            
            $sub_array[] = $row['document_name'];
            $sub_array[] = $row['userTypeName']; 
            $sub_array[] = $row['categoryName']; 
			$sub_array[] = $row['SubCatName']; 
			$sub_array[] = $row['companyName'];
            $actionLinkComment = $model_user->actionLinkComment('',$row['id'],'',$row['comments'],'');
            $sub_array[] = $actionLinkComment;
			//$sub_array[] = $row['comments']; 
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

		 	// $sub_array[] = '<a href = "' . base_url( '/workflow/view_documents/'.$row['id']). '" target="_blank"><button class = "fa fa-file" style="font-size: 24px;"></button></a>';

		    
        	//$sub_array[] = $row['dateAdded'];
         	//$actionLink = $model_user->getActionLink('',$row['id'],'Workflow','',$row['userTypeID']); 
         	
            // $actionLink = $model_user->getActionLink('',$row['id'],'','Workflow','');
            
            // $sub_array[] = $actionLink;
            $sub_array[] = '<a href = "' . base_url( '/workflow/download_documents/'.$row['id']). '" class="btn btn-primary" style="margin: 0px 5px 5px 0px;padding: 4px 9px;font-size: 14px;" target="_blank"><i class="fa fa-file"></i></a>';

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

  	public function getSubCat(){
	  	$id = $_POST['dataid'];
	  	$model_subCat = new SubCategoryModel;
		$subCat = $model_subCat->where('CategoryId',$id)->findall();
		echo json_encode($subCat);
  	}


	public function view_documents($id = ''){
		$model_workflow = new WorkflowModel;
        $name = $model_workflow->select('document_name')->where('id',$id)->first();
        $this->data['name'] = $name['document_name'];
        

		$db = \Config\Database::connect(); 

    	$builder = $db->table('workflow_documents');
    	$builder1 = $builder->where('workflow_id',$id);
    	$query = $builder1->get();
    	$datadoc = $query->getResultArray();
    	$this->data['documents'] = $datadoc;

    	$this->render_template('workflow/views',$this->data);
    	//return view('workflow/views',$this->data);
	}

   
}
?>
