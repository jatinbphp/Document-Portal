<?php 
namespace App\Models;
use CodeIgniter\Model;

class CrudModel extends Model
{
	protected $DBGroup = 'default';
    protected $table = 'adduser';
    protected $primaryKey = 'id';

    
    protected $allowedFields = ['fname','lname', 'email','id',];
}
?>