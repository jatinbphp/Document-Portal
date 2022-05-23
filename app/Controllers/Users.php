<?php 
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\User_typesModel;
use App\Models\CompanyModel;

class Users extends BaseController{

	public function index(){
		$this->data['page_title'] = 'Users';
		$this->render_template('users/index',$this->data);
	}

	public function add(){
		$users = new UsersModel;

		if($_POST){
			
			$request = service('request');
			$session = session();

			$profilePic ='';

			if($_FILES['profilePic']['size']>0){

				$uploadDir = 'uploads/users';
				$ext = pathinfo($_FILES['profilePic']['name'],PATHINFO_EXTENSION);
				$filenm =time().'_profile'.$ext;
				$profilePic = str_replace(' ', '-', $filenm);
				$uploadedFile = $uploadDir.'/'.$profilePic;

				move_uploaded_file($_FILES['profilePic']['tmp_name'],$uploadedFile);

			}

			$firstName = $request->getPost('firstName');
			$lastName = $request->getPost('lastName');
			$email = $request->getPost('email'); 
			$pwd = $request->getPost('pwd');
			$isActive = $request->getPost('isActive');
			$userTypeID = $request->getPost('userTypeID');
			$companyId = $request->getPost('companyId');
			$data = array(

				'firstName' =>$firstName,
				'lastName' => $lastName,
				'email' => $email, 
				'userTypeID' => $userTypeID, 
				'companyId' => $companyId, 
				'profilePic' => $profilePic,
				'pwd' => md5($pwd),
				'isActive' => isset($isActive) ? 1 : 0, 

				);

			$insertId = $users->insert($data);

			if($insertId > 0){
				$session->setFlashdata('session', "Successfully added new User");
				return redirect()->to('users');
			}
			else{
				$session->setFlashdata('session',"user not added Successfully");
				return redirect()->to('users');
			}
		}

        $user_types = new User_typesModel;
        $this->data['user_types'] = $user_types->findall();

        $company_model = new CompanyModel;
        $this->data['company'] = $company_model->findall();

		$this->data['page_title'] = 'Users';
		$this->render_template('users/add',$this->data);
	}

	public function checkEmailExists(){
		$request = service('request');
		$email = $request->getPost('email');

		 $email_data = new UsersModel;
         $emailExist = $email_data->where('email',$email)->first();
         if(!empty($emailExist))
         {
         	$exist = false;
         }
         else{
         	$exist = true;
         }
         return json_encode($exist);
	}

		public function fetch_users(){

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
        $searchColumn = array($global_tblUsers.".firstName", $global_tblUsers.".lastName", $global_tblUsers.".email");

        // order by
        $orderBy = array($global_tblUsers.'.id' => "DESC");

        // join table
        $joinTableArray = array();
       	$joinTableArray = array(array("joinTable"=>$global_tbluser_type, "joinField"=>"id", "relatedJoinTable"=>$global_tblUsers, "relatedJoinField"=>"userTypeID","type"=>"left"),
       		array("joinTable"=>$global_tblcompany, "joinField"=>"id", "relatedJoinTable"=>$global_tblUsers, "relatedJoinField"=>"companyId","type"=>"left")
       );


     	$model_user= new UsersModel;
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
            $sub_array[] = $actionLink;
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

    public function delete($id) {		

		$session = session();
		$model_users= new UsersModel;
    	$model_users->where('id', $id);
		$temp =  $model_users->delete();
		if($temp){ 
       		$session->setFlashdata("success", "User deleted Successfully.");
        	return redirect()->to('users');
       } else {
        	$session->setFlashdata("error", "User not deleted Successfully.");
            return redirect()->to('users');  
        }  
        	 
	}

		public function edit($id=''){

		$model_users = new UsersModel;

		if($_POST){

			$request = service('request');
			$session = session();

			$profilePic = '';
            if ($_FILES['profilePic']['size']>0) {

                $uploaddir = 'uploads/users/';

                $ext = pathinfo($_FILES['profilePic']['name'], PATHINFO_EXTENSION);

                $filenm = time().'_profile.'.$ext;
                $profilePic = str_replace(' ', '-', $filenm);
                $uploadfile = $uploaddir .'/'. $profilePic;

                move_uploaded_file($_FILES['profilePic']['tmp_name'], $uploadfile);

            } else {
            	$profilePic = $request->getPost('hidden_profilePic');
            }

			$firstName = $request->getPost('firstName');
			$lastName = $request->getPost('lastName');
			$email = $request->getPost('email');
			$pwd = $request->getPost('pwd');
			$isActive = $request->getPost('isActive');
			$userTypeID = $request->getPost('userTypeID');
			$companyId = $request->getPost('companyId');

			if(!empty($pwd)){
				$passwordData = array(					
					'pwd' => md5($pwd),
				);

				$model_users->set($passwordData);
	        	$model_users->where('id', $id);
	        	$result =  $model_users->update();
			}

			$data = array(
				'firstName' => $firstName,
				'lastName' => $lastName,
				'email' => $email, 
				'pwd' => md5($pwd),
				'userTypeID' => $userTypeID,
				'companyId' => $companyId,
				'profilePic' => $profilePic,
				'isActive' => isset($isActive) ? 1 : 0, 
			);

			$model_users->set($data);
        	$model_users->where('id', $id);
        	$result =  $model_users->update();
        	
        	if($result){ 
	            $session->setFlashdata("success", "User updated Successfully.");
	            return redirect()->to('users');
           	} else {
	        	$session->setFlashdata("error", "User not updated Successfully.");
	            return redirect()->to('users');  
	        }     
		}

		$this->data['page_title'] = "User Edit";

		$model_user_types = new User_typesModel;
		$user_types = $model_user_types->findAll();
		$this->data['user_types'] = $user_types;

		$usersData = $model_users->where('id', $id)->first(); 
		$this->data['user_info'] = $usersData;

		$company_model = new CompanyModel;
        $this->data['company'] = $company_model->findall();

		$this->render_template('users/edit',$this->data);
	}

  public function deleteImg(){
  	$session = session();
		$model_users= new UsersModel;
    	
    	$updateData = array(					
			'profilePic' => '',
		);
		$model_users->set($updateData);
    	$model_users->where('id', $user_id);
    	$result =  $model_users->update();

    	unlink('uploads/users/'.$image_name);

		if($result){ 
       		$session->setFlashdata("success", "User Image deleted Successfully.");
        	return redirect()->to('users/edit/'.$user_id);
       	} else {
        	$session->setFlashdata("error", "User Image not deleted Successfully.");
            return redirect()->to('users/edit/'.$user_id);  
        }  	 
  }

}
?>