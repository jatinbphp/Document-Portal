<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomersModel;
use App\Models\User_typesModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Customers extends BaseController
{	

	public function index(){ 
		$this->data['page_title'] = "Customers";
		$this->render_template('customers/index', $this->data);
	}

	public function add(){
		$model_users = new CustomersModel;
		if($_POST){
			$request = service('request');
			$session = session();
			
			$email = $request->getPost('email'); 
			$dateadd = $request->getPost('dateadd');
			$firstName = $request->getPost('firstName');
			$lastName = $request->getPost('lastName');
			$billadd = $request->getPost('billadd');
			$shipadd = $request->getPost('shipadd');
			$lsorder = $request->getPost('lsorder');
			$totalsp = $request->getPost('totalsp');
			$avgorder = $request->getPost('avgorder');

			$data = array(
				'email' => $email, 
				'dateadd' => $dateadd,
				'firstName' => $firstName,
				'lastName' => $lastName,
				'billadd' => $billadd,
				'shipadd' => $shipadd,
				'lsorder' => $lsorder,
				'totalsp' => $totalsp,
				'avgorder' => $avgorder,
				 
			);
			$insertId =  $model_users->insert($data);
        	
        	if($insertId > 0){ 
	            $session->setFlashdata("success", "User added Successfully.");
	            return redirect()->to('customers');
           	} else {
	        	$session->setFlashdata("error", "User not added Successfully.");
	            return redirect()->to('customers');  
	        }     
		}
		$this->data['page_title'] = "Customer add";
		$this->render_template('customers/add',$this->data);
	}
	public function importData(){

		$this->data['page_title'] = "Customer importdata";
		$this->render_template('customers/importdata',$this->data);
	
	}

	public function filedataAdd(){

		$session = session();

        $allowed = array('xlsx');
        $filename = $_FILES['customerFile']['name'];
         
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!in_array($ext, $allowed)) {
        	$session->setFlashdata("error", "Only Excel file allowed.");
            return redirect()->to('customers/importdata');   
    	}

        if($ext == 'xlsx'){ 
        	
 				  $fp = $_FILES['customerFile']['tmp_name'];

            	$inputFileName = $fp;
				try {  
					ini_set('memory_limit', '-1');
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
					$reader->setReadDataOnly(true);
					$spreadsheet = $reader->load($inputFileName); 
					$sheetData = $spreadsheet->getActiveSheet()->toArray();
					//echo "<pre>";print_r($sheetData);exit;


				foreach ($sheetData  as $key => $value) {
					$daaa = substr($value[0],0,9);
					$daa1 = substr($value[1],0,9);
					if($daaa == "Full Name"){} 
					else{

					if($key > 0 ){
						$model_filedata = new CustomersModel;

						$fileuploadData = $usersData = $model_filedata->where('email', $value[1])->first(); 

						if(empty($fileuploadData)){

							$model_filedata = new CustomersModel; 
							$names = explode(" ", $value[0]);
							$lastname = $value[0];
							$data = array(
								'email' =>$value[1],
								'dateadd' => $value[2],
								'firstName' => $names[0], 
								'lastName' => $names[1],
								'billadd' => $value[3],
								'shipadd' => $value[4],
								'lsorder' => $value[5],
								'totalsp' => $value[6],
								'avgorder' => $value[7]
							);
							$FileID =  $model_filedata->insert($data); 
							$profilePic = '';
				            if ($_FILES['customerFile']['size']>0) {

				                $uploaddir = 'uploads/filedata/';

				                $ext = pathinfo($_FILES['customerFile']['name'], PATHINFO_EXTENSION);

				                $filenm = time() .'_profile.'.$ext;
				                $profilePic = str_replace(' ', '-', $filenm);
				                $uploadfile = $uploaddir .'/'. $profilePic;

				                move_uploaded_file($_FILES['customerFile']['tmp_name'], $uploadfile);

				            }
							
						}
								 			
					
					}
					}
				}
				$session->setFlashdata("success", "File Uploaded Successfully.");
			    			return redirect()->to('customers');

	            } catch (Exception $e) {
	                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
	                        . '": ' . $e->getMessage());
	            } 
        	}
	        else{
	        	 die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
		                        . '": ' . $e->getMessage());
	        }

	}

	public function edit($id=''){

		$model_users = new CustomersModel;

		if($_POST){

			$request = service('request');
			$session = session();

			

			$firstName = $request->getPost('firstName');
			$lastName = $request->getPost('lastName');
			$email = $request->getPost('email'); 
			$dateadd = $request->getPost('dateadd');
			$billadd = $request->getPost('billadd');
			$shipadd = $request->getPost('shipadd');
			$lsorder = $request->getPost('lsorder');
			$totalsp = $request->getPost('totalsp');
			$avgorder = $request->getPost('avgorder');

			

			$data = array(
				'firstName' => $firstName,
				'lastName' => $lastName,
				'email' => $email, 
				'dateadd' => $dateadd,
				'billadd' => $billadd,
				'shipadd' => $shipadd,
				'lsorder' => $lsorder,
				'totalsp' => $totalsp,
				'avgorder' => $avgorder,
				 
			);

			$model_users->set($data);
        	$model_users->where('id', $id);
        	$result =  $model_users->update();
        	
        	if($result){ 
	            $session->setFlashdata("success", "Customer updated Successfully.");
	            return redirect()->to('customers');
           	} else {
	        	$session->setFlashdata("error", "Customer not updated Successfully.");
	            return redirect()->to('customers');  
	        }     
		}

		$this->data['page_title'] = "Customer Edit";
		$usersData = $model_users->where('id', $id)->first(); 
		$this->data['user_info'] = $usersData;
		$this->render_template('customers/edit',$this->data);
	}


	public function delete($id) {		

		$session = session();
		$model_users= new CustomersModel;
    	$model_users->where('id', $id);
		$temp =  $model_users->delete();
		if($temp){ 
       		$session->setFlashdata("success", "Customer deleted Successfully.");
        	return redirect()->to('customers');
       } else {
        	$session->setFlashdata("error", "customer not deleted Successfully.");
            return redirect()->to('customers');  
        }  
        	 
	}

	public function checkEmailExists()
	{
		$request = service('request');
		
		$email = $request->getPost('email');

		$model_user = new CustomersModel;

		$emailExist = $model_user->where('Email',$email)->first();

		$exist = 0;
		if (!empty($emailExist)) {
			$exist = false;
		}else{
			$exist = true;
		}

		echo json_encode($exist);
	}

	public function checkUsernameExists()
	{
		$request = service('request');
		
		$username = $request->getPost('username');

		$model_user = new CustomersModel;

		$usernameExist = $model_user->where('UserName',$username)->first();

		$exist = 0;
		if (!empty($usernameExist)) {
			$exist = false;
		}else{
			$exist = true;
		}

		echo json_encode($exist);
	}


	public function checkEditEmailExists()
	{
		$request = service('request');
		
		$email = $request->getPost('email');
		$old_email = $request->getPost('old_email');

		if($email != '' && $old_email != ''){  
			$model_user = new CustomersModel;

			$emailExist = $model_user->where('Email',$email)->first();

			$exist = '';
            if(!empty($emailExist) || $old_email == $email){
            	if($old_email == $email){
            		$exist = true;
            	}else{
           	 		$exist = false;
            	}
            }elseif($old_email == $email){
            	$exist = true;
            } else {
                $exist = true;
            }

			echo json_encode($exist);
		}
	}

	public function checkEditUsernameExists()
	{
		$request = service('request');
		
		$username = $request->getPost('username');
		$old_username = $request->getPost('old_username');

		if($username != '' && $old_username != ''){  
			$model_user = new CustomersModel;

			$usernameExist = $model_user->where('UserName',$username)->first();

			$exist = '';
            if(!empty($usernameExist) || $old_username == $username){
            	if($old_username == $username){
            		$exist = true;
            	}else{
           	 		$exist = false;
            	}
            }elseif($old_username == $username){
            	$exist = true;
            } else {
                $exist = true;
            }

			echo json_encode($exist);
		}
	}

	public function fetch_customers(){

		$db = \Config\Database::connect();		
  	 	$global_tblCustomers = 'Customers';
	  	
        // equal condition
        $whereEqual = array(); 
 		
        // not equal condition
        $whereNotEqual = array();

        $notIn = array();     

        // select data
        //$selectColumn[$global_tblCustomers.'.*'] = '*';
        $selectColumn[$global_tblCustomers.'.*'] = $global_tblCustomers.'.*';
      	
        // order column
        $orderColumn = array($global_tblCustomers.".firstName", $global_tblCustomers.".email", 
        	$global_tblCustomers.".dateadd",'','', $global_tblCustomers.".lsorder",$global_tblCustomers.".totalsp",$global_tblCustomers.".avgorder");

        // search column
        $searchColumn = array($global_tblCustomers.".firstName", $global_tblCustomers.".lastName", $global_tblCustomers.".email");

        // order by
        $orderBy = array($global_tblCustomers.'.id' => "DESC");

        // join table
        $joinTableArray = array();


     	$model_user= new CustomersModel;
        $fetch_data = $model_user->make_datatables( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);
       
     
        $data = array();
        foreach ($fetch_data as $key => $row) {
            $sub_array = array(); 
            
			$sub_array[] = $row['firstName']." ".$row['lastName'];  
			$sub_array[] = $row['email']; 
			$sub_array[] = $row['dateadd'];
			$sub_array[] = $row['billadd'];
			$sub_array[] = $row['shipadd'];
			$sub_array[] = $row['lsorder'];
			$sub_array[] = $row['totalsp'];
			$sub_array[] = $row['avgorder'];
         	$actionLink = $model_user->getActionLink('',$row['id'],'Customers',''); 
            
            $sub_array[] = $actionLink;
            $data[] = $sub_array;
            $imgSrc = '';
            if (!empty($row['filedata'])){
                $imgSrc = base_url('uploads/customers/'.$row['filedata']);
            } else {
                //$imgSrc = base_url('assets/images/user.svg');
            }
            $sub_array[] = $imgSrc;
        } 

        $output = array(
            "draw" =>  $_POST["draw"] ,
            "recordsTotal" => $model_user->get_all_data( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "recordsFiltered" => $model_user->get_filtered_data( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "data" => $data,
        );

        echo json_encode($output);
        
    }

	public function deleteImg($image_name, $user_id) {		

		$session = session();
		$model_users= new CustomersModel;
    	
    	$updateData = array(					
			'profilePic' => '',
		);
		$model_users->set($updateData);
    	$model_users->where('id', $user_id);
    	$result =  $model_users->update();

    	unlink('uploads/customers/'.$image_name);

		if($result){ 
       		$session->setFlashdata("success", "Customer Image deleted Successfully.");
        	return redirect()->to('customers/edit/'.$user_id);
       	} else {
        	$session->setFlashdata("error", "Customer Image not deleted Successfully.");
            return redirect()->to('customers/edit/'.$user_id);  
        }  	 
	}

	public function exportCustomers(){

		$customers_model = new CustomersModel; 	

		$getResult = $customers_model->getCustomersRecord();

		$spreadsheet = new Spreadsheet();

      	$objPHPExcel = $spreadsheet->getActiveSheet();
        // $objPHPExcel->setActiveSheetIndex(0);           
        
        $objPHPExcel->getStyle('A1')->applyFromArray
        (
            array ('font' => array('size' => 11,'bold' => true,'color' => array('rgb' => '000000')))
        );//report orders styling

        $styleArray2 = array(                   
            'font'  => array(
                'bold'  => true,
                'size'  => 14
            )
        );

        $styleArray3 = array(                   
            'font'  => array(
                'bold'  => true,
                'size'  => 11
            )
        );
        
        // font bold & line height big
        $variable1 = array(1);
        foreach ($variable1 as $key1 => $value1) {
            $objPHPExcel->getRowDimension($value1)->setRowHeight(20);
            $objPHPExcel->getStyle('A'.$value1.':H'.$value1)->applyFromArray($styleArray2);    
        }


        $objPHPExcel->SetCellValue('A1', "Full Name");
        $objPHPExcel->SetCellValue('B1', "Email");
        $objPHPExcel->SetCellValue('C1', "BirthDate(yy-mm-dd)");
        $objPHPExcel->SetCellValue('D1', "Billing Address");
        $objPHPExcel->SetCellValue('E1', "Shipping Address");
        $objPHPExcel->SetCellValue('F1', "Last Order");
        $objPHPExcel->SetCellValue('G1', "Total Spent");
        $objPHPExcel->SetCellValue('H1', "Average order Value");

     	$rowId = 2;
        foreach ($getResult as $row) {
        	//$fullName = implode($row['firstName']," ",$row['lastName']);
        	$fullName = $row['firstName'] . ' ' . $row['lastName'];
            $objPHPExcel->SetCellValue('A'.$rowId, $fullName);
            $objPHPExcel->SetCellValue('B'.$rowId, $row['email']);
            $objPHPExcel->SetCellValue('C'.$rowId, $row['dateadd']);
            $objPHPExcel->SetCellValue('D'.$rowId, $row['billadd']);
            $objPHPExcel->SetCellValue('E'.$rowId, $row['shipadd']);
            $objPHPExcel->SetCellValue('F'.$rowId, $row['lsorder']);
            $objPHPExcel->SetCellValue('G'.$rowId, $row['totalsp']);
            $objPHPExcel->SetCellValue('H'.$rowId, $row['avgorder']);

         //    if(!empty($row['productImage'])){
	        //     $objPHPExcel->SetCellValue('E' . $rowId,base_url('uploads/products').'/'.$row['productImage']);
	        //     $objPHPExcel->getCell('E' . $rowId)->getHyperlink()->setUrl(base_url('uploads/products').'/'.$row['productImage']);
	        // }

            $rowId++;
        }

        $objPHPExcel->getColumnDimension('A')->setWidth(30);
        $objPHPExcel->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getColumnDimension('C')->setWidth(30);
        $objPHPExcel->getColumnDimension('D')->setWidth(30);
        $objPHPExcel->getColumnDimension('E')->setWidth(30);
        $objPHPExcel->getColumnDimension('F')->setWidth(30);
        $objPHPExcel->getColumnDimension('G')->setWidth(30);
        $objPHPExcel->getColumnDimension('H')->setWidth(30);

        $objWriter = new Xlsx($spreadsheet);           
        
        $fileName = "Export-All-customers.xlsx";
        
        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment;filename="'.$fileName.'"');
        header('Cache-Control: max-age=0');
      
        $objWriter->save('uploads/product_report/' . $fileName);
       
        $xls_url = '/uploads/product_report/' . $fileName;
        echo $xls_url;

	}
}