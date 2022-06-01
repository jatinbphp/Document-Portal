<?php 
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ReportingModel;
use App\Models\User_typesModel;
use App\Models\CompanyModel;

class Reporting extends BaseController{

	public function index(){
		$company = new CompanyModel;
		$this->data['company'] = $company->findall();
		$this->data['page_title'] = 'Reporting';
		$this->render_template('reporting/general_report/index',$this->data);
	}
	
	public function export(){
		$db      = \Config\Database::connect();	
		$builder = $db->table('Users');
		$builder->select('firstName,lastName,companyName,email,dateAdded');
		$builder->join('Company', 'Company.id = Users.companyId', 'left');
		$query = $builder->get();
		foreach($query->getResult('array') as $result){
			$data[] = $result;
		}
		$fileName = "Report-".date('d-m-Y').".xls";
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$fileName);
		$heading = false;
		if(!empty($data)){
			foreach($data as $userData){
				if(!$heading){
					echo implode("\t", array_keys($userData)) . "\n";
					$heading = true;
				}
				echo implode("\t", array_values($userData)) . "\n";
			}
		}	
	}
	
	public function getData() {
		$companyName = $this->request->getPost('myData');
		echo $companyName;
		
		//echo $_POST['myData'];
		//echo "true";
		//echo "true";
		//exit;
		//$companyName = $this->input->post('companyName');
		
		
		
		
		$db = \Config\Database::connect();		
  	 	$global_tblUsers = 'Users';
 	  	$global_tbluser_type = 'UserTypes';
	  	$global_tblcompany = 'Company';
        // equal condition
        $whereEqual = array(); 
 		
        // not equal condition
        $whereNotEqual = array();

        $notIn = array();     

        // select data
        $selectColumn[$global_tblUsers.'.*'] = $global_tblUsers.'.*';
        $selectColumn[$global_tbluser_type.'.userTypeName'] =  $global_tbluser_type.'.userTypeName';
        $selectColumn[$global_tblcompany.'.companyName'] =  $global_tblcompany.'.companyName';
      	
        // order column
        $orderColumn = array('', $global_tblUsers.".firstName", $global_tblUsers.".email", $global_tblUsers.".isActive", $global_tbluser_type.".userTypeName", $global_tblUsers.".dateAdded");

        // search column
        
        //$searchColumn = array($global_tblUsers.".firstName", $global_tblUsers.".lastName", $global_tblUsers.".email");
        $searchColumn = array($global_tblUsers.".companyId");

        // order by
        $orderBy = array($global_tblUsers.'.id' => "DESC");

        // join table
        $joinTableArray = array();
       	$joinTableArray = array(array("joinTable"=>$global_tbluser_type, "joinField"=>"id", "relatedJoinTable"=>$global_tblUsers, "relatedJoinField"=>"userTypeID","type"=>"left"),
       		array("joinTable"=>$global_tblcompany, "joinField"=>"id", "relatedJoinTable"=>$global_tblUsers, "relatedJoinField"=>"companyId","type"=>"left")
       );

			
     	$model_user= new ReportingModel;
        $fetch_data = $model_user->make_datatables( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);
       
     	
        $data = array();
        foreach ($fetch_data as $key => $row) {
            $sub_array = array(); 

            $imgSrc = '';
            if (!empty($row['profilePic'])){
                $imgSrc = base_url('uploads/users/'.$row['profilePic']);
            } else {
                $imgSrc = base_url('assets/images/user.svg');
            }

            $sub_array[] = '<div class="user-img"><img src="'.$imgSrc.'"></div>';
			$sub_array[] = $row['firstName']." ".$row['lastName'];  
			$sub_array[] = $row['email'];  
		 	if($row['isActive'] == 1){
                $sub_array[] = '<span class="badge badge-success">Active</span>';
            }else{
                $sub_array[] = '<span class="badge badge-danger">InActive</span>';
            }  

		    $sub_array[] = $row['companyName'];
        	$sub_array[] = $row['dateAdded'];
         	//$actionLink = $model_user->getActionLink('',$row['id'],'Users','',$row['userTypeID']); 
            $actionLink = $model_user->getActionLink('',$row['id'],$row['userTypeID'],'Users','');
            //~ $sub_array[] = $actionLink;
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

	


		public function fetch_users_data(){
	
		$db = \Config\Database::connect();		
  	 	$global_tblUsers = 'Users';
 	  	$global_tbluser_type = 'UserTypes';
	  	$global_tblcompany = 'Company';
        // equal condition
        
        
		$whereEqual = array();
		
		
		if(isset($_POST['comapny_id']) && $_POST['comapny_id'] != '' ){
			
 			 $whereEqual[$global_tblUsers.'.companyId'] = $_POST['comapny_id'];
 		}
        //$whereEqual = array($global_tblUsers.".companyId" => $_POST['comapny_id']); 
       
        // not equal condition
        $whereNotEqual = array();

        $notIn = array();     

        // select data
        $selectColumn[$global_tblUsers.'.*'] = $global_tblUsers.'.*';
        $selectColumn[$global_tbluser_type.'.userTypeName'] =  $global_tbluser_type.'.userTypeName';
        $selectColumn[$global_tblcompany.'.companyName'] =  $global_tblcompany.'.companyName';
      	
        // order column
        $orderColumn = array('', $global_tblUsers.".firstName", $global_tblUsers.".email", $global_tblUsers.".isActive", $global_tbluser_type.".userTypeName", $global_tblUsers.".dateAdded");

        // search column
        $searchColumn = array($global_tblUsers.".firstName", $global_tblUsers.".lastName", $global_tblUsers.".email");

        // order by
        $orderBy = array($global_tblUsers.'.id' => "DESC");

        // join table
        $joinTableArray = array();
       	$joinTableArray = array(array("joinTable"=>$global_tbluser_type, "joinField"=>"id", "relatedJoinTable"=>$global_tblUsers, "relatedJoinField"=>"userTypeID","type"=>"left"),
       		array("joinTable"=>$global_tblcompany, "joinField"=>"id", "relatedJoinTable"=>$global_tblUsers, "relatedJoinField"=>"companyId","type"=>"left")
       );

			
     	$model_user= new ReportingModel;
        $fetch_data = $model_user->make_datatables( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);
       
     	
        $data = array();
        foreach ($fetch_data as $key => $row) {
            $sub_array = array(); 

            $imgSrc = '';
            if (!empty($row['profilePic'])){
                $imgSrc = base_url('uploads/users/'.$row['profilePic']);
            } else {
                $imgSrc = base_url('assets/images/user.svg');
            }

            $sub_array[] = '<div class="user-img"><img src="'.$imgSrc.'"></div>';
			$sub_array[] = $row['firstName']." ".$row['lastName'];  
			$sub_array[] = $row['email'];  
		 	if($row['isActive'] == 1){
                $sub_array[] = '<span class="badge badge-success">Active</span>';
            }else{
                $sub_array[] = '<span class="badge badge-danger">InActive</span>';
            }  

		    $sub_array[] = $row['companyName'];
        	$sub_array[] = $row['dateAdded'];
         	//$actionLink = $model_user->getActionLink('',$row['id'],'Users','',$row['userTypeID']); 
            $actionLink = $model_user->getActionLink('',$row['id'],$row['userTypeID'],'Users','');
            //$sub_array[] = $actionLink;
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
