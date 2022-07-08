<?php 
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\User_typesModel;
use App\Models\CompanyModel;
use App\Models\UserCompanyModel;
class Manager extends BaseController{

	public function index(){
		echo "Welcome to manager";exit;
	}
}