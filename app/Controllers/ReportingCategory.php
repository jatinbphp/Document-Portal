<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ReportingCategoryModel;

class ReportingCategory extends BaseController
{	

	public function index(){
		$db      = \Config\Database::connect();
		$builder = $db->table('category');
		$builder->select('id, categoryName');
		$query = $builder->get();
		$id = array();
		$category= array();
		foreach($query->getResult('array') as $results){
			$id[] = $results['id'];
			$category[] = $results['categoryName'];
			
		}
		$cat = array_combine($id, $category);
		
		$builder = $db->table('SubCategory');
		$builder->select('CategoryId, SubCatName');
		$query = $builder->get();
		$foreignId = array();
		$subcategory = array();
		foreach($query->getResult('array') as $results){
			$foreignId[] = $results['CategoryId'];
			$subcategory[] = $results['SubCatName'];
		}
		$sub = array_combine($subcategory, $foreignId);
		
		
		
		//echo "<pre>";
		//print_r($cat);
		
		//echo "<pre>";
		//print_r($arr);
		
		
		//print_r($category);
		//print_r($id);
		//echo("----");
		//print_r($foreignId);
		
		//$this->data['val'] = $arr2;
		//$this->data['subcategory'] = $subcategory;
		//$this->data['primaryId'] = $id;
		//$this->data['foreignId'] = $foreignId;
		
		
		$this->data['category'] = $cat;
		$this->data['subcategory'] = $sub;
		$this->render_template('reporting_category/index', $this->data);
		
		
	}
	
			
}

