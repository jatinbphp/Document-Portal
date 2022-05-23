<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SubCategoryModel;
use App\Models\CategoryModel;


class SubCategory extends BaseController
{	

	public function index(){
		$model_subcompany = new SubCategoryModel;
 		 
		$this->data['page_title'] = "SubCategory"; 
		
		$this->render_template('sub_category/index', $this->data);
	}
	
	public function add(){
		
		$model_category = new CategoryModel;
		$this->data['page_title'] = "Sub_Category";
		$this->data['subcategory'] = $model_category->findall();
		$this->render_template('sub_category/add',$this->data);
		
		//$this->render_template('category/add');
	}
	
	public function create(){
		
		$subcategory = new SubCategoryModel();
	
			$request = service('request');
			$session = session();

			$categoryName = $request->getPost('subCategory');
			$SubCatName = $request->getPost('SubCatName');
			
		
			$data = array(
				'CategoryId' => $categoryName,
				'SubCatName' => $SubCatName,
				'dateAdded' => date('Y-m-d h:i:s'),
			);

			$insertId =  $subcategory->insert($data);
        	
        	if($insertId > 0){ 
	            $session->setFlashdata("success", "Sub Category added Successfully.");
	            return redirect()->to('subcategory');
           	} else {
	        	$session->setFlashdata("error", "Sub Category not added Successfully.");
	            return redirect()->to('subcategory');  
	        } 
		
	}
	
	
	
	public function edit($id=''){
		$model_subcategory= new SubCategoryModel;
		
		$this->data['page_title'] = "SubCategory Edit";
		$subCategoryData = $model_subcategory->where('id', $id)->first(); 
		$this->data['subcategory'] = $subCategoryData;
		$category =  new CategoryModel;
		$this->data['category'] = $category->findall();
		$this->render_template('sub_category/edit',$this->data);
	}
	
	public function update($id=''){
		$model_subcategory= new SubCategoryModel;
			
			$request = service('request');
			$session = session();

			$categoryName = $request->getPost('categoryName');
			$SubCatName = $request->getPost('SubCatName');
		
			$data = array(
				'CategoryId' => $categoryName,
				'SubCatName' => $SubCatName,
				'dateAdded' => date('Y-m-d h:i:s'),
			);

			$model_subcategory->set($data);
        	$model_subcategory->where('id', $id);
        	$result =  $model_subcategory->update();
        	
        	if($result){ 
	            $session->setFlashdata("success", "Sub Category updated Successfully.");
	            return redirect()->to('subcategory');
           	} else {
	        	$session->setFlashdata("error", "Sub Category not Updated Successfully.");
	            return redirect()->to('subcategory');  
	        }     
		
	}
	
	
	public function delete($id)
	{		
		$session = session();
		$model_subcategory= new SubCategoryModel;
    	$model_subcategory->where('id', $id);
		$temp =  $model_subcategory->delete();
		if($temp){ 
       		$session->setFlashdata("success", "Sub Category deleted Successfully.");
        	return redirect()->to('subcategory');
       } else {
        	$session->setFlashdata("error", "Sub Category not deleted Successfully.");
            return redirect()->to('subcategory');  
        }  
        	 
	}
	
	
	
	public function fetch_category(){
		
		$db = \Config\Database::connect();		
  	 	$global_tblCategory = 'SubCategory';
	  	
        // equal condition
        $whereEqual = array(); 
 		
        // not equal condition
        $whereNotEqual = array();

        $notIn = array();     

        // select data
        $selectColumn[$global_tblCategory.'.*'] = $global_tblCategory.'.*';
        $selectColumn['category.categoryName'] = 'category.categoryName';
      	
        // order column
        $orderColumn = array($global_tblCategory.".SubCatName" );

        // search column
        $searchColumn = array($global_tblCategory.".SubCatName");

        // order by
        $orderBy = array($global_tblCategory.'.id' => "ASC");

        // join table
        $joinTableArray = array();
        $joinTableArray = array(array("joinTable"=>"category", "joinField"=>"id", "relatedJoinTable"=>$global_tblCategory, "relatedJoinField"=>"CategoryId","type"=>"left"));

     	$model_category= new SubCategoryModel;
        $fetch_data = $model_category->make_datatables( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);
       
     
        $data = array();
        foreach ($fetch_data as $key => $row) {
            $sub_array = array(); 

			$sub_array[] = $row['categoryName'];  
			$sub_array[] = $row['SubCatName'];  
		 	
         	$actionLink = $model_category->getActionLink('',$row['id'],'SubCategory','',1); 
            
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
