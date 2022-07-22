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

class CeoComplianceReportView extends BaseController
{
    public function index($id)
    {  
       
            $userId = $_SESSION['id'];
            $this->data['page_title'] = 'ceoreportview';
            
            $this->data['company_id'] = $id;
            $this->render_user_template('Ceo/compliance_report/view', $this->data);
       
    }

   
   public function fetch_compliance_report_view($id = null){
    
        $db = \Config\Database::connect();		
  	 	$global_tblWorkflow = 'document_workfolw';
 	  	$global_tblusers_types = 'UserTypes';
	  	$global_tblcategory = 'category';
	  	$global_tblsubcategory = 'SubCategory';
	  	$global_tblcompany = 'Company';
	  	$global_tbluser_company = 'user_company';
	  	$global_tblusers = 'Users';

        // equal condition
	  	 $whereEqual=array();
         $technician_id = $_SESSION['id'];
         $wherarr1 = array(
         	//$global_tblWorkflow.'.company_id' =>$id,
         	$global_tbluser_company.'.company_id' =>$id,
         	$global_tblusers.'.userTypeID' =>5,
         ); 
	  	// $whereEqual=array($global_tblWorkflow.'.company_id'=>$id);
	  	 $whereEqual = $wherarr1;
        
        // not equal condition
        $whereNotEqual = array();
        $whereUser = array();
       

        $notIn = array();     

        // select data
        $selectColumn[$global_tbluser_company.'.*'] = $global_tbluser_company.'.*';
        $selectColumn[$global_tblusers.'.firstName'] =  $global_tblusers.'.firstName';
        $selectColumn[$global_tblusers.'.lastName'] =  $global_tblusers.'.lastName';
        
        // $selectColumn[$global_tblWorkflow.'.*'] = $global_tblWorkflow.'.*';
        // $selectColumn[$global_tblusers_types.'.userTypeName'] =  $global_tblusers_types.'.userTypeName';
        // $selectColumn[$global_tblcategory.'.categoryName'] =  $global_tblcategory.'.categoryName';
        // $selectColumn[$global_tblsubcategory.'.SubCatName'] =  $global_tblsubcategory.'.SubCatName';
        // $selectColumn[$global_tblcompany.'.companyName'] =  $global_tblcompany.'.companyName';
       // $selectColumn[$global_tbluser_company.'.comName'] =  $global_tbluser_company.'.comName';
      	
        // order column
          $orderColumn = array($global_tblusers.".firstName", $global_tblusers.".lastName");

        // search column
        $searchColumn = array($global_tblusers.".firstName", $global_tblusers.".lastName");

        // order by
        $orderBy = array();

        // join table
        $joinTableArray = array();
       	$joinTableArray = array(array("joinTable"=>$global_tblusers, "joinField"=>"id", "relatedJoinTable"=>$global_tbluser_company, "relatedJoinField"=>"user_id","type"=>"left")
       );


     	$model_user= new UserCompanyModel;
        $fetch_data = $model_user->make_datatables( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$whereUser);
      
     	
        $data = array();
      
       
        foreach ($fetch_data as $key => $row) {
            $sub_array = array(); 
           
             $url = base_url('/CeoComplianceReportView/Compliance_report/'.$id.'/'. $row['user_id']);
            $list = "<a href = '".$url."'.>".$row['firstName'] .' '. $row['lastName']."</a>";
            $sub_array[] =$list ;  
            
           // $actionLink = $model_category->getActionLink('',$row['id'],'Category','',1); 
            
           // $sub_array[] = $actionLink;
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

    public function Compliance_report($com_id = '',$tech_id = ''){

        $company = new CompanyModel;
        $this->data['company'] = $company->where('id',$com_id)->findall();
        $users = new UsersModel;
        $this->data['users'] = $users->findall();

        $category = new CategoryModel;
        $this->data['category'] = $category->where('is_deleted',0)->findall();

        $subCategory = new SubCategoryModel;
        $this->data['subCategory'] = $subCategory->where('is_deleted',0)->findall();
        $documents = new WorkflowModel;
         //$where =  "(is_active = 1 OR is_active = 3 OR is_active = 4)";
        $this->data['Documentfiles'] = $documents->where('company_id', $com_id)->where('technician_id',$tech_id)->findAll();

        $this->data['page_title'] = 'Compliance Report';
        $this->render_user_template('Ceo/compliance_report/report_list',$this->data);

    }
    
}
