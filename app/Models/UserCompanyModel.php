<?php
namespace App\Models;
use CodeIgniter\Model;
class UserCompanyModel extends Model{
	protected $DBGroup              = 'default';
	protected $table                = 'user_company';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true; 
 
	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;
	protected $allowedFields = [ 'user_id','company_id'];
}

