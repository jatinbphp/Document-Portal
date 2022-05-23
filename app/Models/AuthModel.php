<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'Users';
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
	protected $allowedFields = ['email', 'pwd', 'userTypeID', 'firstName', 'lastName', 'profilePic',  'isActive'];
  	protected $beforeInsert = ['beforeInsert'];
  	protected $beforeUpdate = ['beforeUpdate'];
	 
    function get_single_record($tablename){

    	$query = $this->db->query('SELECT * FROM  '.$tablename.' LIMIT 1');
		$row   = $query->getRowArray(); 
    	return $row;
    }

   	function getUserType($user_type){
   		$db      = \Config\Database::connect();
		$query = $db->query("SELECT * FROM UserTypes WHERE id = '".$user_type."'");
		$row = $query->getRow()->userTypeName; 
		return  $row;
    }
    function getPoData($poId = null) 
	{
		if($poId) {
			$sql = "SELECT * FROM project_options WHERE id = ?";
			$query = $this->db->get($sql, array($poId));
			return $query;
		}

		$db      = \Config\Database::connect();
		$query = $db->query("SELECT * FROM project_options LIMIT 1;");
		$row = $query->getRow(); 
		return  $row;
		 
	}
}