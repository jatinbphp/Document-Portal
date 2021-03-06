<?php 
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\DocumentsModel;
use App\Models\UsersModel;
use App\Models\SubCategoryModel;
use App\Models\CategoryModel;
use App\Models\CompanyModel;
use App\Models\ReportingModel;
use App\Models\User_typesModel;
class DocumentEdit extends BaseController{

	public function index(){

		$company = new CompanyModel;
		$this->data['company'] = $company->findall();
		$users = new UsersModel;
		$this->data['users'] = $users->findall();

		$this->data['page_title'] = 'Edited Documents Log';
		$this->render_template('reporting/document_edit/index',$this->data);
	}

		public function fetch_edited_documents(){

		$db = \Config\Database::connect();		
  	 	$global_tblDocuments = 'DocumentsManage';
 	  	$global_tblusers = 'Users';
	  	$global_tblcategory = 'category';
	  	$global_tblsubcategory = 'SubCategory';
	  	$global_tblcompany = 'Company';

        // equal condition
	  	 $whereEqual=array();
         $orwhere =array();
         $whereIn = array();
         $whereUser = array();
	  	 
	  	 if(isset($_POST['company_id']) && $_POST['company_id'] != '' ){
			
 			  $whereEqual[$global_tblDocuments.'.companyID']= trim($_POST['company_id']);
 		}
 		if(isset($_POST['user_id']) && $_POST['user_id'] != '' ){
			
 			  $whereEqual[$global_tblDocuments.'.userID']= trim($_POST['user_id']);
 		}


        // not equal condition
        $whereNotEqual = array();
        $whereNotEqual[$global_tblDocuments.'.edited_date'] = 0; //Where edited date is not null


        $notIn = array();     

        // select data
        $selectColumn[$global_tblDocuments.'.*'] = $global_tblDocuments.'.*';
        $selectColumn[$global_tblusers.'.firstName'] =  $global_tblusers.'.firstName';
        $selectColumn[$global_tblusers.'.lastName'] =  $global_tblusers.'.lastName';
        $selectColumn[$global_tblcategory.'.categoryName'] =  $global_tblcategory.'.categoryName';
        $selectColumn[$global_tblsubcategory.'.SubCatName'] =  $global_tblsubcategory.'.SubCatName';
        $selectColumn[$global_tblcompany.'.companyName'] =  $global_tblcompany.'.companyName';
      	
        // order column
        $orderColumn = array('', $global_tblDocuments.".firstName", $global_tblDocuments.".email", $global_tblDocuments.".isActive", $global_tblusers.".firstName", $global_tblDocuments.".isActive");

        // search column
        $searchColumn = array($global_tblDocuments.".docName",$global_tblusers.".firstName",$global_tblusers.".lastName",$global_tblcompany.".companyName",$global_tblDocuments.".isActive");

        // order by
        $orderBy = array($global_tblDocuments.'.id' => "DESC");

        // join table
        $joinTableArray = array();
       	$joinTableArray = array(array("joinTable"=>$global_tblusers, "joinField"=>"id", "relatedJoinTable"=>$global_tblDocuments, "relatedJoinField"=>"userID","type"=>"left"),
       		array("joinTable"=>$global_tblcategory, "joinField"=>"id", "relatedJoinTable"=>$global_tblDocuments, "relatedJoinField"=>"categoryID","type"=>"left"),

       		array("joinTable"=>$global_tblsubcategory, "joinField"=>"id", "relatedJoinTable"=>$global_tblDocuments, "relatedJoinField"=>"subCategoryID","type"=>"left"),

       		array("joinTable"=>$global_tblcompany, "joinField"=>"id", "relatedJoinTable"=>$global_tblDocuments, "relatedJoinField"=>"companyID","type"=>"left")

       );
       
     	$model_user= new DocumentsModel;
        $fetch_data = $model_user->make_datatables( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$orwhere,$whereIn,$whereUser);
        $data = array();
        foreach ($fetch_data as $key => $row) {
            $sub_array = array(); 
            $imgSrc = base_url('assets/images/download1.png');
            $id = $row['id'];
            // $sub_array[] = '<a href = "' . base_url( '/uploads/documents/'.$row['categoryID'].'/'.$row['subCategoryID'].'/'.$row['docFile']). '" target="_blank"><img src="'.$imgSrc.'" style="width: 40px; height: 40px"></a>';
            $sub_array[] = '<a href = "' . base_url( '/uploads/documents/'.$row['categoryID'].'/'.$row['subCategoryID'].'/'.$row['docFile']). '" target="_blank"><i class="fa fa-file" style="font-size:36px;"></i></a>';
            $sub_array[] = $row['docName'];  
			$sub_array[] = $row['firstName']." ".$row['lastName'];  
			//$sub_array[] = $row['categoryName']; 
			//$sub_array[] = $row['SubCatName']; 
			//$sub_array[] = $row['companyName']; 
            $edited_date= date("Y-m-d",strtotime($row['edited_date']));
			$sub_array[] = $edited_date; 

		 	if($row['isActive'] == 1){
                //$sub_array[] = '<span class="badge badge-success">Active</span>';
            }else{
                //$sub_array[] = '<span class="badge badge-danger">InActive</span>';
            }  

		    
        	//$sub_array[] = $row['dateAdded'];
         	//$actionLink = $model_user->getActionLink('',$row['id'],'Documents','',$row['userTypeID']); 
            $actionLink = $model_user->getActionLink('',$row['id'],'','Documents','');
            $sub_array[] = $actionLink;
            $data[] = $sub_array;

        } 
        $output = array(
            "draw" =>  $_POST["draw"] ,
            "recordsTotal" => $model_user->get_all_data( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$orwhere,$whereIn,$whereUser),
            "recordsFiltered" => $model_user->get_filtered_data( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$orwhere,$whereIn,$whereUser),
            "data" => $data,
        );

        echo json_encode($output);
        
    }
}
?>
