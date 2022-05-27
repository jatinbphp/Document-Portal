<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

class Category extends BaseController
{	

	public function index(){
		$model_company = new CategoryModel;
 		 
		$this->data['page_title'] = "Category"; 
		
		$this->render_template('category/index', $this->data);
	}
	
	public function add(){
		
		$model_category = new CategoryModel;
		if($_POST){
			$request = service('request');
			$session = session();


			$categoryName = $request->getPost('categoryName');
			
			$data = array(
				'categoryName' => $categoryName,
			);

			$insertId =  $model_category->insert($data);

			
			if (! is_dir ( 'uploads/documents/'.$insertId )) {
        		mkdir ( 'uploads/documents/'.$insertId, 0777, true );
    		}

        	if($insertId > 0){ 
	            $session->setFlashdata("success", "Category added Successfully.");
	            return redirect()->to('category');
           	} else {
	        	$session->setFlashdata("error", "Category not added Successfully.");
	            return redirect()->to('category');  
	        }     
		}

		$this->data['page_title'] = "Cotegory add";
		$this->render_template('category/add',$this->data);
		
	}
	

	public function edit($id=''){
		$model_category= new CategoryModel;
		if($_POST){

			$request = service('request');
			$session = session();

			$categoryName = $request->getPost('categoryName');
		
			$data = array(
				'categoryName' => $categoryName,
			);

			$model_category->set($data);
        	$model_category->where('id', $id);
        	$result =  $model_category->update();
        	
        	if($result){ 
	            $session->setFlashdata("success", "Category updated Successfully.");
	            return redirect()->to('category');
           	} else {
	        	$session->setFlashdata("error", "Category not added Successfully.");
	            return redirect()->to('category');  
	        }     
		}

		$this->data['page_title'] = "Category Edit";

		$categoryData = $model_category->where('id', $id)->first(); 
		$this->data['category'] = $categoryData;
		$this->render_template('category/edit',$this->data);
	}
	
	public function delete($id)
	{		
		$session = session();
		$model_category= new CategoryModel;
		$deletedata = 1;
		$data= array(
             'is_deleted' => $deletedata,
			);
        	$model_category->set($data);
    		$model_category->where('id', $id);
			$temp =  $model_category->update();

		if($temp){ 
       		$session->setFlashdata("success", "Category deleted Successfully.");
        	return redirect()->to('category');
       } else {
        	$session->setFlashdata("error", "Category not deleted Successfully.");
            return redirect()->to('category');  
        }  
        	 
	}
	
	
	public function fetch_category(){
		$db = \Config\Database::connect();		
  	 	$global_tblCategory = 'category';
	  	
        // equal condition
        $whereEqual = array(); 
 		
        // not equal condition
        $whereNotEqual = array();

        $is_deleted = 0;
	  	$whereEqual[$global_tblCategory.'.is_deleted'] = $is_deleted;

        $notIn = array();     

        // select data
        $selectColumn[$global_tblCategory.'.*'] = $global_tblCategory.'.*';
      	
        // order column
        $orderColumn = array($global_tblCategory.".categoryName" );

        // search column
        $searchColumn = array($global_tblCategory.".categoryName");

        // order by
        $orderBy = array($global_tblCategory.'.id' => "ASC");

        // join table
        $joinTableArray = array();

     	$model_category= new CategoryModel;
        $fetch_data = $model_category->make_datatables( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);
       
     
        $data = array();
        foreach ($fetch_data as $key => $row) {
            $sub_array = array(); 

			$sub_array[] = $row['categoryName'];  
		 	
         	$actionLink = $model_category->getActionLink('',$row['id'],'Category','',1); 
            
            $sub_array[] = $actionLink;
            $data[] = $sub_array;
        } 

        $output = array(
            "draw" =>  $_POST["draw"] ,
            "recordsTotal" => $model_category->get_all_data( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "recordsFiltered" => $model_category->get_filtered_data( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
