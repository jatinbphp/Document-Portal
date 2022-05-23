<?php
namespace App\Models;
use CodeIgniter\Model;

class OrderItemsModel extends Model{

	protected $DBGroup = 'default';
	protected $table = 'billing_order_item';
	protected $primaryKey ='id';
	protected $allowedFields=['id','order_id','item_id','quantity','rate','amount','subTotal'];


}

?>