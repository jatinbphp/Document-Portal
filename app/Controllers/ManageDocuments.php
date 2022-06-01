<?php 
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ManageDocumentsModel;
use App\Models\UsersModel;
use App\Models\SubCategoryModel;
use App\Models\CategoryModel;
use App\Models\CompanyModel;
use App\Models\ReportingModel;
use App\Models\User_typesModel;
class ManageDocuments extends BaseController{

	public function index(){

		$company = new CompanyModel;
		$this->data['company'] = $company->findall();
		$users = new UsersModel;
		$this->data['users'] = $users->findall();

		$category = new CategoryModel;
		$this->data['category'] = $category->where('is_deleted',0)->findall();

		$subCategory = new SubCategoryModel;
		$this->data['subCategory'] = $subCategory->where('is_deleted',0)->findall();

		$documents = new ManageDocumentsModel;
		$this->data['Documentfiles'] = $documents->findAll();

		$this->data['page_title'] = 'Documents';
		$this->render_template('managedocuments/index',$this->data);
	}

}
?>
