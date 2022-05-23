<?php 

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\CrudModel;

class Crud extends BaseController
{
	public function index()
	{
        $db = \Config\Database::connect();	
  	 	$list_data= new CrudModel;

  	 	$this->data['ListData'] = $list_data->findall();
        return view('datalist', $this->data);
		
	}

    
	 public function create(){
        return view('adduser');
    }
     // add data
    public function store() {
        $store_data = new CrudModel;

        // $fileData ='';
        //     if($_FILES['filedata']['size']>0){
        //         $csv_file =  $_FILES['filedata']['tmp_name'];
        //         if (is_file($csv_file)) {
        //             $input = fopen($csv_file, 'a+');
        //             $row = fgetcsv($input, 1024, ','); // here you got the header

        //             $uploaddir = 'uploads/';

        //         $ext = pathinfo($_FILES['filedata']['name'], PATHINFO_EXTENSION);

        //         $filenm = time() .'_profile.'.$ext;
        //         $fileData = str_replace($row, '-', $filenm);
        //         $uploadfile = $uploaddir. $fileData;
        //              move_uploaded_file($_FILES['filedata']['tmp_name'], $uploadfile);
        //         }
        $data = [
            'fname' => $this->request->getVar('fname'),
             'lname' => $this->request->getVar('lname'),
            'email'  => $this->request->getVar('email'),
        ];

                
        $store_data->insert($data);
        return $this->response->redirect(site_url('/datalist'));
    
}

    // show single name
    public function singleUser($id = null){
        $get_user = new CrudModel;
        $data['user_obj'] = $get_user->where('id', $id)->first();
        return view('updateuser', $data);
    }

    // update name data
    public function updateuser($id = null){
         $Update_Model = new CrudModel();
        $data = [
            'fname' => $this->request->getVar('fname'),
            'lname' => $this->request->getVar('lname'),
            'email'  => $this->request->getVar('email'),
        ];
       
        $result =  $Update_Model->update($id,$data);

        return $this->response->redirect(site_url('/datalist'));
    }
 
    // delete name
    public function delete($id = null){
        $delete_data = new CrudModel;
        $data['user'] = $delete_data->where('id', $id)->delete($id);
        return $this->response->redirect(site_url('/datalist'));
    } 


	
	 
}
?>