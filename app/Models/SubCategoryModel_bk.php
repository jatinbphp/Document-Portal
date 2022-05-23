<?php 
namespace App\Models;

use CodeIgniter\Model;

class SubCategoryModel extends Model
{
    protected $DBGroup              = 'default';
	protected $table                = 'SubCategory';
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
	protected $allowedFields = ['CategotyId','SubCatName','Status'];
}