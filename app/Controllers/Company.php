<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CompanyModel;
use App\Models\ClientsModel;

class Company extends BaseController
{
	public function index()
	{
		$model_company = new CompanyModel;
 		 
		$this->data['page_title'] = "Company";
		$this->render_template('company/index', $this->data);
	}


	public function add(){

		$model_company = new CompanyModel;
		if($_POST){
			$request = service('request');
			$session = session();

			$companyName = $request->getPost('companyName');
			
			$data = array(
				'companyName' => $companyName,
			);

			$insertId =  $model_company->insert($data);
        	
        	if($insertId > 0){ 
	            $session->setFlashdata("success", "User Types added Successfully.");
	            return redirect()->to('company');
           	} else {
	        	$session->setFlashdata("error", "User Types not added Successfully.");
	            return redirect()->to('company');  
	        }     
		}

		$this->data['page_title'] = "Company add";
		$this->render_template('company/add',$this->data);
	}

	public function edit($id=''){
		$model_company= new CompanyModel;
		if($_POST){

			$request = service('request');
			$session = session();

			$companyName = $request->getPost('companyName');
			$client_id = $request->getPost('client_id');
		
			$data = array(
				'companyName' => $companyName,
				'client_id' => $client_id,
			);

			$model_company->set($data);
        	$model_company->where('id', $id);
        	$result =  $model_company->update();
        	
        	if($result){ 
	            $session->setFlashdata("success", "Company updated Successfully.");
	            return redirect()->to('company');
           	} else {
	        	$session->setFlashdata("error", "Company not added Successfully.");
	            return redirect()->to('company');  
	        }     
		}

		$this->data['page_title'] = "Company Edit";

		$model_clients = new ClientsModel;
		$clientData = $model_clients->findAll();
		$this->data['clients'] = $clientData;

		$companyData = $model_company->where('id', $id)->first(); 
		$this->data['company_info'] = $companyData;
		$this->render_template('company/edit',$this->data);
	}

	public function delete($id)
	{		
		$session = session();
		$model_company= new CompanyModel;
    	$model_company->where('id', $id);
		$temp =  $model_company->delete();
		if($temp){ 
       		$session->setFlashdata("success", "Company deleted Successfully.");
        	return redirect()->to('company');
       } else {
        	$session->setFlashdata("error", "Company not deleted Successfully.");
            return redirect()->to('company');  
        }  
        	 
	}

	public function fetch_company(){
		$db = \Config\Database::connect();		
  	 	$global_tblCompany = 'Company';
	  	
        // equal condition
        $whereEqual = array(); 
 		
        // not equal condition
        $whereNotEqual = array();

        $notIn = array();     

        // select data
        $selectColumn[$global_tblCompany.'.*'] = $global_tblCompany.'.*';
      	
        // order column
        $orderColumn = array($global_tblCompany.".companyName" );

        // search column
        $searchColumn = array($global_tblCompany.".companyName");

        // order by
        $orderBy = array($global_tblCompany.'.id' => "ASC");

        // join table
        $joinTableArray = array();

     	$model_company= new CompanyModel;
        $fetch_data = $model_company->make_datatables( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);
       
     
        $data = array();
        foreach ($fetch_data as $key => $row) {
            $sub_array = array(); 

			$sub_array[] = $row['companyName'];  
		 	
         	$actionLink = $model_company->getActionLink('',$row['id'],'Company','',1); 
            
            $sub_array[] = $actionLink;
            $data[] = $sub_array;
        } 

        $output = array(
            "draw" =>  $_POST["draw"] ,
            "recordsTotal" => $model_company->get_all_data( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "recordsFiltered" => $model_company->get_filtered_data( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "data" => $data,
        );

        echo json_encode($output);
        
    }
}