<?php
namespace App\Models;
use CodeIgniter\Model;

class InvoiceModel extends Model{

	protected $DBGroup = 'default';
	protected $table = 'billing_items';
	protected $primaryKey ='id';
	protected $allowedFields=['id','name','price','category_id','status'];


}

?>