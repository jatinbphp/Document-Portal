<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ReportingCategoryModel;

class ReportingCategory extends BaseController
{	

	public function index(){
		 
		$this->data['category'] = $result;
		$this->render_template('reporting_category/index', $this->data);
		
	}
			
}
