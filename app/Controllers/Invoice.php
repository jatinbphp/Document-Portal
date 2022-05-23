<?php

namespace App\Controllers;
use App\Controllers\BaseController;

use App\Models\InvoiceModel;
use App\Models\OrderModel;
use App\Models\OrderItemsModel;
class Invoice extends BaseController{

	public function index(){


		$this->data['page_title'] = 'Invoice';
		$this->render_template('invoice/index',$this->data);
	}

	public function add(){
		 $item_list = new InvoiceModel;
         $order_item =new OrderModel;

            $request = service('request');
            $session = session();
            //echo "<pre>";print_r($_POST);exit;
            $user = $_SESSION['firstName']." ".$_SESSION['lastName'];
            if($_POST){
                $gross_amount = $request->getPost('subTotal');
                $tax_amount = $request->getPost('taxAmount');
                $net_amount = $request->getPost('totalAftertax');

                $data = array(

                    'gross_amount' =>$gross_amount,
                    'tax_amount' => $tax_amount,
                    'net_amount' => $net_amount, 
                    'created_by' => $user,

                    );
                 $insertId = $order_item->insert($data);
                if($insertId){
                          
                        
                        $order_items = new OrderItemsModel;
                        $order_id = $insertId;
                        $item_id = $request->getPost('items[0]');
                        $quantity = $request->getPost('quantity[0]');
                        $rate = $request->getPost('price[0]');
                        $amount = $request->getPost('total[0]');
                        $subTotal = $request->getPost('totalAftertax');

                         $data1 = array(

                            'order_id' =>$order_id,
                            'item_id' => $item_id,
                            'quantity' => $quantity, 
                            'rate' => $rate,
                            'amount' => $amount,
                            'subTotal' => $subTotal,

                            );
                         //echo "<pre>";print_r($data1);exit;
                         $insertId1 = $order_items->insert($data1);
                     
                        if($insertId1 > 0){
                            $session->setFlashdata('session', "Successfully added new Order");
                            return redirect()->to('invoice');
                        }
                        else{
                            $session->setFlashdata('session',"Order not added Successfully");
                            return redirect()->to('invoice');
                        }
                }
            }



         $this->data['ItemData'] = $item_list->findall();
		$this->data['page_title'] = 'Invoice Add';
		$this->render_template('invoice/add',$this->data);

	}

    public function fetch_invoice(){

        $db = \Config\Database::connect();      
        $global_tblInvoice = 'billing_order';
        
        // equal condition
        $whereEqual = array(); 
        
        // not equal condition
        $whereNotEqual = array();

        $notIn = array();     

        // select data
        $selectColumn[$global_tblInvoice.'.*'] = $global_tblInvoice.'.*';
        
        // order column
        $orderColumn = array($global_tblInvoice.".id", $global_tblInvoice.".gross_amount", $global_tblInvoice.".tax_amount", $global_tblInvoice.".net_amount", $global_tblInvoice.".created_by", $global_tblInvoice.".created");

        // search column
        $searchColumn = array($global_tblInvoice.".firstName", $global_tblInvoice.".lastName", $global_tblInvoice.".email");

        // order by
        $orderBy = array($global_tblInvoice.'.id' => "DESC");

        // join table
        $joinTableArray = array();
        // $joinTableArray = array(array("joinTable"=>$global_tbluser_type, "joinField"=>"id", "relatedJoinTable"=>$global_tblInvoice, "relatedJoinField"=>"userTypeID","type"=>"left"));


        $model_user= new OrderModel;
        $fetch_data = $model_user->make_datatables( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);
       
        //echo "<pre>";print_r($fetch_data);exit;
        $data = array();
        foreach ($fetch_data as $key => $row) {
            $sub_array = array(); 

            

            $sub_array[] = $row['id'];
            $sub_array[] = $row['gross_amount'];  
            $sub_array[] = $row['tax_amount'];  
            
            $sub_array[] = $row['net_amount'];
            $sub_array[] = $row['created_by'];
            $sub_array[] = $row['created'];
            $actionLink = $model_user->getActionLink('',$row['id'],'Invoice','',''); 
            
            $sub_array[] = $actionLink;
            $data[] = $sub_array;
        } 

        $output = array(
            "draw" =>  $_POST["draw"] ,
            "recordsTotal" => $model_user->get_all_data( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "recordsFiltered" => $model_user->get_filtered_data( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "data" => $data,
        );

        echo json_encode($output);
        
    }
    public function edit($id = ''){
        $item_list = new InvoiceModel;
        $order_item =new OrderModel;

            $request = service('request');
            $session = session();
            //echo "<pre>";print_r($_POST);exit;
            $user = $_SESSION['firstName']." ".$_SESSION['lastName'];
            if($_POST){
                //$id= $ $request->getPost('id');
                $gross_amount = $request->getPost('subTotal');
                $tax_amount = $request->getPost('taxAmount');
                $net_amount = $request->getPost('totalAftertax');

                $data = array(

                    'gross_amount' =>$gross_amount,
                    'tax_amount' => $tax_amount,
                    'net_amount' => $net_amount, 
                    'created_by' => $user,

                    );
                 //$insertId = $order_item->insert($data);
                            $order_item->set($data);
                            $order_item->where('id', $id);
                            $insertId =  $order_item->update();
                if($insertId){
                            

                        $order_items = new OrderItemsModel;
                        $order_id = $insertId;
                        $item_id = $request->getPost('items[0]');
                        $quantity = $request->getPost('quantity[0]');
                        $rate = $request->getPost('price[0]');
                        $amount = $request->getPost('total[0]');
                        $subTotal = $request->getPost('totalAftertax');

                         $data1 = array(

                            'order_id' =>$order_id,
                            'item_id' => $item_id,
                            'quantity' => $quantity, 
                            'rate' => $rate,
                            'amount' => $amount,
                            'subTotal' => $subTotal,

                            );
                         //echo "<pre>";print_r($data1);exit;
                         //$insertId1 = $order_items->insert($data1);
                            $order_items->set($data1);
                            $order_items->where('id', $id);
                            $result1 =  $order_items->update();
                        if($result1 > 0){
                            $session->setFlashdata('session', "Successfully Updated new Order");
                            return redirect()->to('invoice');
                        }
                        else{
                            $session->setFlashdata('session',"Order not Updated Successfully");
                            return redirect()->to('invoice');
                        }
                }
            }

        $this->data['ItemData'] = $item_list->findall();
        $this->data['page_title'] = 'Invoice Add';
        $this->render_template('invoice/edit',$this->data);

    }

    public function delete($id) {       

        $session = session();
        $model_Invoice= new OrderModel;
        $model_Invoice->where('id', $id);
        $temp =  $model_Invoice->delete();
        if($temp){ 
            $session->setFlashdata("success", "Invoice deleted Successfully.");
            return redirect()->to('invoice');
       } else {
            $session->setFlashdata("error", "Invoice not deleted Successfully.");
            return redirect()->to('invoice');  
        }  
             


    }
	public function loadItemPrice(){
        $id = $this->request->getVar('itemId');
       $price_data = new InvoiceModel;
        $priceData = $price_data->where('id',$id)->first();
        echo $priceData['price'];
    }
    public function getTaxRate(){   
        $item_data = new TaxModel;
        $data = $item_data->findall();
           
        foreach ($data as $taxItems) {               
            $rows = array();    
            $taxItems['id'] = $taxItems['id'];             
            $taxItems['tax_name'] = $taxItems['tax_name'];
            $taxItems['percentage'] = $taxItems['percentage'];                             
            $records[] = $rows;
        }       
        $output = array(            
            "data"  =>  $records
        );
        echo json_encode($output);      
    }

    public function loadItems123(){
         $item_dataList = new InvoiceModel;
        $dataaa = $item_dataList->findall();
         foreach ($dataaa as $taxItems) { 
            $taxItemsArr['id'] = $taxItems['id'];             
            $taxItemsArr['name'] = $taxItems['name'];                            
            $records[] = $taxItemsArr;
        }   
        $output = array(            
            "databill"  =>  $records
        );
        echo json_encode($output);
    }

    function loadItems(){       
      $item_dataList = new InvoiceModel;
        $dataaa = $item_dataList->findall();             
        $html = '<option value="">--Select--</option>';     
        foreach ($dataaa as $taxItems) {                
            $html .= "<option value='".$taxItems['id']."'>".$taxItems['name']."</option>";
        }
        echo $html;             
    }   
}

	?>