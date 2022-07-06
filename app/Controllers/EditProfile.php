<?php 
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\User_typesModel;
use App\Models\CompanyModel;
use App\Models\UserCompanyModel;

class EditProfile extends BaseController{
	public function index(){
		$model_users = new UsersModel;
		$id= $_SESSION['id'];
		$usersData = $model_users->where('id', $id)->first(); 
		$this->data['user_info'] = $usersData;

		$this->data['page_title'] = 'EditProfile';
		$this->render_template('users/edit_profile',$this->data);
	}

	public function edit(){
		$request = service('request');
		$session = session(); 
		$model_users = new UsersModel;
		$id= $_SESSION['id'];
		$usersData = $model_users->where('id', $id)->first();


		if($_POST){

			$firstName = $request->getPost('firstName');
			$lastName = $request->getPost('lastName');
			$email = $request->getPost('email');
			$pwd = $request->getPost('pwd');
			$receive_email = $request->getPost('receive_email');

			if(!empty($pwd)){
				$passwordData = array(					
					'pwd' => md5($pwd),
				);

				$model_users->set($passwordData);
	        	$model_users->where('id', $id);
	        	$result =  $model_users->update();
			}
			else{
				$passwordData = array(					
					'pwd' => $usersData['pwd'],
				);

				$model_users->set($passwordData);
	        	$model_users->where('id', $id);
	        	$result =  $model_users->update();
			}


			$data = array(
							'firstName' =>$firstName,
							'lastName' => $lastName,
							'email' => $email,
							'receive_email'=>$receive_email,
							
						);

			$model_users->set($data);
			$model_users->where('id', $id);
			$result =  $model_users->update();

			if($result ){ 

        		
	            $session->setFlashdata("success", "User profile updated Successfully.");
	            return redirect()->to('edit_profile');
           	} else {
	        	$session->setFlashdata("error", "User Profile not updated Successfully.");
	            return redirect()->to('edit_profile');  
	        } 
		}
		
	}


	public function checkEditEmailExistsProfile()
	{
		$request = service('request');
		
		$email = $request->getPost('email');
		$old_email = $request->getPost('old_email');

		if($email != '' && $old_email != ''){  
			$model_user = new UsersModel;

			$emailExist = $model_user->where('Email',$email)->first();

			$exist = '';
            if(!empty($emailExist) || $old_email == $email){
            	if($old_email == $email){
            		$exist = true;
            	}else{
           	 		$exist = false;
            	}
            }elseif($old_email == $email){
            	$exist = true;
            } else {
                $exist = true;
            }

			echo json_encode($exist);
		}
	}


	public function updatePass(){
		$id = $_SESSION['id'];
	  if($_POST){
	  	$request = service('request');
		$session = session(); 
		$model_users = new UsersModel;

		$pwd = $request->getPost('pwd');

			if(!empty($pwd)){
				$passwordData = array(					
					'pwd' => md5($pwd),
				);

				$model_users->set($passwordData);
	        	$model_users->where('id', $id);
	        	$result =  $model_users->update();
	        	if($result){
	        		$session->setFlashdata("success", "User Password updated Successfully.");
	        		$this->session->destroy();
     				return redirect()->to('appAdmin');
	           	} else {
		        	$session->setFlashdata("error", "User Password not updated Successfully.");
		            return redirect()->to('change_password'); 
		        	}
			}


	  }
	$this->data['page_title'] = 'Change Password';
	$this->render_user_template('users/change_password',$this->data);
	}
}
?>