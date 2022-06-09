<?php 

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\AuthModel;

class Auth extends BaseController
{
	public function index()
	{	
       $data['message'] = 'Open the code';
		echo view('welcome_message',$data);
		
	}

   public function login()
   {
 		
 		 $request = service('request');        
        
        $model_auth = new AuthModel;
        $po_data = $model_auth->getPoData();

        $this->data['poname'] = $po_data->po_name;
        $this->data['admin-logo'] = $po_data->po_logo;
        $this->data['admin-logo'] = $po_data->po_logo_small;

		$data = [];
		helper(['form']); 

		if ($_POST) {

            // true case
           	$model_auth = new AuthModel;
            $email = $this->request->getVar('email');
            $pwd = $this->request->getVar('pwd');
           
            $login = $model_auth->where('email', $email)->where('pwd', md5($pwd))->first(); 
            if(!empty($login)) {
                if($login['userTypeID'] == 0){
                   $loginUserType = 0 ;
                }
                else{
                   $loginUserType = $model_auth->getUserType($login['userTypeID']); 
                }
                

              
                if(!empty($login) && $login['isActive'] == 0){
                    $session = session();
                    $session->setFlashdata("error", "Your account has been disabled. Please contact your administrator.");
                    return redirect()->to('appAdmin');
                }
 
                $logged_in_sess = [
                    'id' => $login['id'], 
                    'email'     => $login['email'],
                    'firstName'     => $login['firstName'],
                    'lastName'     => $login['lastName'],  
                    'user_type'     => $login['userTypeID'],
                    'lastLogin'     => $login['lastLogin'],
                    'loginUserType' => $loginUserType, 
                    'logged_in' => TRUE
                ];             
                

                // $data = array(
                //     'lastLogin' => date("Y-m-d h:i:s")
                // );

                // $model_users = new UsersModel;
                // $model_users->set($data);
                // $model_users->where('id', $login['id']);
                // $result =  $model_users->update();
                
                if($login['userTypeID'] == 1 ||$login['userTypeID'] == 2 || $login['userTypeID'] == 3){
                    $this->session->set($logged_in_sess); 
                $session = session();
                $session->setFlashdata("success", "Login successful!");
                 return redirect()->to('userdashboard'); 
               
                }
                else{
                $this->session->set($logged_in_sess); 
                $session = session();
                $session->setFlashdata("success", "Login successful!");
                 return redirect()->to('dashboard');  
                
                }
              
            }else {
                $session = session();
                $session->setFlashdata("error", "Username or Password not Match!");
                return redirect()->to('appAdmin');
            } 
        
        }

        return view('login',$this->data);
   }	

   public function logout()
   {
     $this->session->destroy();

     return redirect()->to('appAdmin');
   }

   
	
	 
}
