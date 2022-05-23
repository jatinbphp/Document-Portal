<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User_typesModel;

class User_types extends BaseController
{
	public function index()
	{
		$model_user_types = new User_typesModel;
 		 
		$this->data['page_title'] = "User Types";
		$this->render_template('user_types/index', $this->data);
	}


	public function add(){

		$model_user_types = new User_typesModel;
		if($_POST){
			$request = service('request');
			$session = session();

			$userTypeName = $request->getPost('userTypeName');
			
			$data = array(
				'userTypeName' => $userTypeName,
			);

			$insertId =  $model_user_types->insert($data);
        	
        	if($insertId > 0){ 
	            $session->setFlashdata("success", "User Types added Successfully.");
	            return redirect()->to('user_types');
           	} else {
	        	$session->setFlashdata("error", "User Types not added Successfully.");
	            return redirect()->to('user_types');  
	        }     
		}

		$this->data['page_title'] = "User Types add";
		$this->render_template('user_types/add',$this->data);
	}

	public function edit($id=''){
		$model_user_types= new User_typesModel;
		if($_POST){

			$request = service('request');
			$session = session();

			$userTypeName = $request->getPost('userTypeName');
		
			$data = array(
				'userTypeName' => $userTypeName,
			);

			$model_user_types->set($data);
        	$model_user_types->where('id', $id);
        	$result =  $model_user_types->update();
        	
        	if($result){ 
	            $session->setFlashdata("success", "User Types updated Successfully.");
	            return redirect()->to('user_types');
           	} else {
	        	$session->setFlashdata("error", "User Types not added Successfully.");
	            return redirect()->to('user_types');  
	        }     
		}

		$this->data['page_title'] = "User Types Edit";

		$user_typesData = $model_user_types->where('id', $id)->first(); 
		$this->data['user_types_info'] = $user_typesData;
		$this->render_template('user_types/edit',$this->data);
	}

	public function delete($id)
	{		
		$session = session();
		$model_user_types= new User_typesModel;
    	$model_user_types->where('id', $id);
		$temp =  $model_user_types->delete();
		if($temp){ 
       		$session->setFlashdata("success", "User Types deleted Successfully.");
        	return redirect()->to('user_types');
       } else {
        	$session->setFlashdata("error", "User Types not deleted Successfully.");
            return redirect()->to('user_types');  
        }  
        	 
	}

	public function fetch_user_types(){
		$db = \Config\Database::connect();		
  	 	$global_tblUserTypes = 'UserTypes';
	  	
        // equal condition
        $whereEqual = array(); 
 		
        // not equal condition
        $whereNotEqual = array();

        $notIn = array();     

        // select data
        $selectColumn[$global_tblUserTypes.'.*'] = $global_tblUserTypes.'.*';
      	
        // order column
        $orderColumn = array($global_tblUserTypes.".userTypeName" );

        // search column
        $searchColumn = array($global_tblUserTypes.".userTypeName");

        // order by
        $orderBy = array($global_tblUserTypes.'.id' => "ASC");

        // join table
        $joinTableArray = array();

     	$model_user_types= new User_typesModel;
        $fetch_data = $model_user_types->make_datatables( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);
       
     
        $data = array();
        foreach ($fetch_data as $key => $row) {
            $sub_array = array(); 

			$sub_array[] = $row['userTypeName'];  
		 	
         	$actionLink = $model_user_types->getActionLink('',$row['id'],'UserTypes','',1); 
            
            $sub_array[] = $actionLink;
            $data[] = $sub_array;
        } 

        $output = array(
            "draw" =>  $_POST["draw"] ,
            "recordsTotal" => $model_user_types->get_all_data( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "recordsFiltered" => $model_user_types->get_filtered_data( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "data" => $data,
        );

        echo json_encode($output);
        
    }
}