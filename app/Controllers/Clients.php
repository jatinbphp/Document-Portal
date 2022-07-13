<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientsModel;

class Clients extends BaseController
{
	public function index()
	{
		$model_Clients = new ClientsModel;
 		 
		$this->data['page_title'] = "Clients";
		$this->render_template('clients/index', $this->data);
	}


	public function add(){

		$model_Clients = new ClientsModel;
		if($_POST){
			
			$request = service('request');
			$session = session();

			$email = $request->getPost('email');
			$first_name = $request->getPost('first_name');
			$last_name = $request->getPost('last_name');
			$psw = $request->getPost('psw');
			$is_active = $request->getPost('is_active');
			
			$data = array(
				'email' => $email,
				'first_name' => $first_name,
				'last_name' => $last_name,
				'psw' => md5($psw),
				'is_active' => isset($is_active)?1:0,
			);

			$insertId =  $model_Clients->insert($data);
        	
        	if($insertId > 0){ 
	            $session->setFlashdata("success", "Clients added Successfully.");
	            return redirect()->to('Clients');
           	} else {
	        	$session->setFlashdata("error", "Clients not added Successfully.");
	            return redirect()->to('Clients');  
	        }     
		}

		$this->data['page_title'] = "Clients add";
		$this->render_template('clients/add',$this->data);
	}

	public function edit($id=''){
		$model_Clients= new ClientsModel;
		if($_POST){

			$request = service('request');
			$session = session();

			$email = $request->getPost('email');
			$first_name = $request->getPost('first_name');
			$last_name = $request->getPost('last_name');
			$psw = $request->getPost('psw');
			$is_active = $request->getPost('is_active');
		
			$data = array(
				'email' => $email,
				'first_name' => $first_name,
				'last_name' => $last_name,
				'is_active' => isset($is_active)?1:0,
			);

         	if(!empty($psw)){
				$passwordData = array(					
					'psw' => md5($psw),
				);

				$model_Clients->set($passwordData);
	        	$model_Clients->where('id', $id);
	        	$result =  $model_Clients->update();
			}
			$model_Clients->set($data);
        	$model_Clients->where('id', $id);
        	$result =  $model_Clients->update();
        	
        	if($result){ 
	            $session->setFlashdata("success", "Clients updated Successfully.");
	            return redirect()->to('Clients');
           	} else {
	        	$session->setFlashdata("error", "Clients not added Successfully.");
	            return redirect()->to('Clients');  
	        }     
		}

		$this->data['page_title'] = "Clients Edit";

		$ClientsData = $model_Clients->where('id', $id)->first(); 
		$this->data['clients_info'] = $ClientsData;
		$this->render_template('clients/edit',$this->data);
	}

	public function delete($id)
	{		
		$session = session();
		$model_Clients= new ClientsModel;
    	$model_Clients->where('id', $id);
		$temp =  $model_Clients->delete();
		if($temp){ 
       		$session->setFlashdata("success", "Clients deleted Successfully.");
        	return redirect()->to('Clients');
       } else {
        	$session->setFlashdata("error", "Clients not deleted Successfully.");
            return redirect()->to('Clients');  
        }  
        	 
	}

	public function fetch_Clients(){
		$db = \Config\Database::connect();		
  	 	$global_tblClients = 'Clients';
	  	
        // equal condition
        $whereEqual = array(); 
 		
        // not equal condition
        $whereNotEqual = array();

        $notIn = array();     

        // select data
        $selectColumn[$global_tblClients.'.*'] = $global_tblClients.'.*';
      	
        // order column
        $orderColumn = array($global_tblClients.".first_name",$global_tblClients.".email",$global_tblClients.".is_active" );

        // search column
        $searchColumn = array($global_tblClients.".first_name", $global_tblClients.".last_name",$global_tblClients.".email");

        // order by
        $orderBy = array($global_tblClients.'.id' => "ASC");

        // join table
        $joinTableArray = array();

     	$model_Clients= new ClientsModel;
        $fetch_data = $model_Clients->make_datatables( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);
       
     
        $data = array();
        foreach ($fetch_data as $key => $row) {
            $sub_array = array(); 

            $sub_array[] = $row['first_name']. " " . $row['last_name'];
			$sub_array[] = $row['email'];

			if($row['is_active'] == 1){
                $sub_array[] = '<span class="badge badge-success">Active</span>';
            }else{
                $sub_array[] = '<span class="badge badge-danger">InActive</span>';
            }  
		 	
         	$actionLink = $model_Clients->getActionLink('',$row['id'],'Clients','',1); 
            
            $sub_array[] = $actionLink;
            $data[] = $sub_array;
        } 

        $output = array(
            "draw" =>  $_POST["draw"] ,
            "recordsTotal" => $model_Clients->get_all_data( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "recordsFiltered" => $model_Clients->get_filtered_data( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "data" => $data,
        );

        echo json_encode($output);
        
    }
}