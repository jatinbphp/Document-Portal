<?php 
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\DocumentsModel;
use App\Models\UsersModel;
use App\Models\SubCategoryModel;
use App\Models\CategoryModel;

class Documents extends BaseController{

	public function index(){
		$this->data['page_title'] = 'Documents';
		$this->render_template('documents/index',$this->data);
	}

	public function add(){
		$documents = new DocumentsModel;

		if($_POST){
			
			$request = service('request');
			$session = session();

			$docFile ='';

			if($_FILES['docFile']['size']>0){

				$uploadDir = 'uploads/documents';
				$ext = pathinfo($_FILES['docFile']['name'],PATHINFO_EXTENSION);
				$filenm =time().'_profile.'.$ext;
				$docFile = str_replace(' ', '-', $filenm);
				$uploadedFile = $uploadDir.'/'.$docFile;

				move_uploaded_file($_FILES['docFile']['tmp_name'],$uploadedFile);

			}

			$docName = $request->getPost('docName');
			$categoryID = $request->getPost('categoryID');
			$subCategoryID = $request->getPost('subCategoryID'); 
			$isActive = $request->getPost('isActive');
			$userID = $request->getPost('userID');
			$expireDate = $request->getPost('expireDate');
			
			$data = array(

				'docName' =>$docName,
				'categoryID' => $categoryID,
				'subCategoryID' => $subCategoryID, 
				'userID' => $userID, 
				'docFile' => $docFile,
				'expireDate' => $expireDate,
				'isActive' => isset($isActive) ? 1 : 0, 

				);
				
			$insertId = $documents->insert($data);

			if($insertId > 0){
				$session->setFlashdata('session', "Successfully added new Document");
				return redirect()->to('documents');
			}
			else{
				$session->setFlashdata('session',"document not added Successfully");
				return redirect()->to('documents');
			}
		}

        $users = new UsersModel;
        $this->data['users'] = $users->findall();

        $category = new CategoryModel;
        $this->data['category'] = $category->findall();

        $subCategory = new SubCategoryModel;
        $this->data['subCategory'] = $subCategory->findall();

		$this->data['page_title'] = 'Documents';
		$this->render_template('documents/add',$this->data);
	}

	

		public function fetch_documents(){

		$db = \Config\Database::connect();		
  	 	$global_tblDocuments = 'DocumentsManage';
 	  	$global_tblusers = 'Users';
	  	$global_tblcategory = 'category';
	  	$global_tblsubcategory = 'SubCategory';
        // equal condition
        $whereEqual = array(); 
 		
        // not equal condition
        $whereNotEqual = array();

        $notIn = array();     

        // select data
        $selectColumn[$global_tblDocuments.'.*'] = $global_tblDocuments.'.*';
        $selectColumn[$global_tblusers.'.firstName'] =  $global_tblusers.'.firstName';
        $selectColumn[$global_tblusers.'.lastName'] =  $global_tblusers.'.lastName';
        $selectColumn[$global_tblcategory.'.categoryName'] =  $global_tblcategory.'.categoryName';
        $selectColumn[$global_tblsubcategory.'.SubCatName'] =  $global_tblsubcategory.'.SubCatName';
      	
        // order column
        $orderColumn = array('', $global_tblDocuments.".firstName", $global_tblDocuments.".email", $global_tblDocuments.".isActive", $global_tblusers.".firstName", $global_tblDocuments.".isActive");

        // search column
        $searchColumn = array($global_tblDocuments.".docName",$global_tblusers.".firstName",$global_tblDocuments.".isActive");

        // order by
        $orderBy = array($global_tblDocuments.'.id' => "DESC");

        // join table
        $joinTableArray = array();
       	$joinTableArray = array(array("joinTable"=>$global_tblusers, "joinField"=>"id", "relatedJoinTable"=>$global_tblDocuments, "relatedJoinField"=>"userID","type"=>"left"),
       		array("joinTable"=>$global_tblcategory, "joinField"=>"id", "relatedJoinTable"=>$global_tblDocuments, "relatedJoinField"=>"categoryID","type"=>"left"),

       		array("joinTable"=>$global_tblsubcategory, "joinField"=>"id", "relatedJoinTable"=>$global_tblDocuments, "relatedJoinField"=>"subCategoryID","type"=>"left")

       );


     	$model_user= new DocumentsModel;
        $fetch_data = $model_user->make_datatables( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);
       
     	//echo "<pre>";print_r($fetch_data);exit;
        $data = array();
        foreach ($fetch_data as $key => $row) {
            $sub_array = array(); 
            
            $imgSrc = base_url('assets/images/download1.png');
            $id = $row['id'];
            
            $sub_array[] = '<a href = "' . base_url( '/uploads/documents/'.$row['docFile']). '" target="_blank"><img src="'.$imgSrc.'"></a>';
            $sub_array[] = $row['docName'];  
			$sub_array[] = $row['firstName']." ".$row['lastName'];  
			$sub_array[] = $row['categoryName']; 
			$sub_array[] = $row['SubCatName'];  
			$sub_array[] = $row['expireDate']; 

		 	if($row['isActive'] == 1){
                $sub_array[] = '<span class="badge badge-success">Active</span>';
            }else{
                $sub_array[] = '<span class="badge badge-danger">InActive</span>';
            }  

		    
        	//$sub_array[] = $row['dateAdded'];
         	//$actionLink = $model_user->getActionLink('',$row['id'],'Documents','',$row['userTypeID']); 
            $actionLink = $model_user->getActionLink('',$row['id'],'','Documents','');
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

    public function delete($id) {		

		$session = session();
		$model_documents= new DocumentsModel;
    	$model_documents->where('id', $id);
		$temp =  $model_documents->delete();
		if($temp){ 
       		$session->setFlashdata("success", "Document deleted Successfully.");
        	return redirect()->to('documents');
       } else {
        	$session->setFlashdata("error", "Document not deleted Successfully.");
            return redirect()->to('documents');  
        }  
        	 
	}

		public function edit($id=''){
		$model_documents = new DocumentsModel;
		//echo "<pe>";print_r($_POST);exit;
		if($_POST){

			$request = service('request');
			$session = session();

			$docFile = '';
            if ($_FILES['docFile']['size']>0) {

                $uploaddir = 'uploads/documents/';

                $ext = pathinfo($_FILES['docFile']['name'], PATHINFO_EXTENSION);

                $filenm = time().'_profile.'.$ext;
                $docFile = str_replace(' ', '-', $filenm);
                $uploadfile = $uploaddir .'/'. $docFile;

                move_uploaded_file($_FILES['docFile']['tmp_name'], $uploadfile);

            } else {
            	$docFile = $request->getPost('hidden_profilePic');
            }

			$docName = $request->getPost('docName');
			$categoryID = $request->getPost('categoryID');
			$subCategoryID = $request->getPost('subCategoryID'); 
			$isActive = $request->getPost('isActive');
			$userID = $request->getPost('userID');
			$expireDate = $request->getPost('expireDate');
			$data = array(

				'docName' =>$docName,
				'categoryID' => $categoryID,
				'subCategoryID' => $subCategoryID, 
				'userID' => $userID, 
				'docFile' => $docFile,
				'expireDate' => $expireDate,
				'isActive' => isset($isActive) ? 1 : 0, 

				);
			$model_documents->set($data);
        	$model_documents->where('id', $id);
        	$result =  $model_documents->update();
        	
        	if($result){ 
	            $session->setFlashdata("success", "Document updated Successfully.");
	            return redirect()->to('documents');
           	} else {
	        	$session->setFlashdata("error", "Document not updated Successfully.");
	            return redirect()->to('documents');  
	        }     
		}

		$this->data['page_title'] = "Document Edit";

		$users = new UsersModel;
        $this->data['users'] = $users->findall();

        $category = new CategoryModel;
        $this->data['category'] = $category->findall();

        $subCategory = new SubCategoryModel;
        $this->data['subCategory'] = $subCategory->findall();

        $this->data['docData'] = $model_documents->where('id',$id)->first();


		$this->render_template('documents/edit',$this->data);
	}

  	public function deleteImg(){
  	$session = session();
		$model_documents= new DocumentsModel;
    	
    	$updateData = array(					
			'docFile' => '',
		);
		$model_documents->set($updateData);
    	$model_documents->where('id', $user_id);
    	$result =  $model_documents->update();

    	unlink('uploads/documents/'.$image_name);

		if($result){ 
       		$session->setFlashdata("success", "Document  deleted Successfully.");
        	return redirect()->to('documents/edit/'.$user_id);
       	} else {
        	$session->setFlashdata("error", "Document Image not deleted Successfully.");
            return redirect()->to('documents/edit/'.$user_id);  
        }  	 
  	}

  	public function getSubCat(){
	  	$id = $_POST['dataid'];

	  	$model_subCat = new SubCategoryModel;
		$subCat = $model_subCat->where('CategoryId',$id)->findall();
		echo json_encode($subCat);
  	}
}
?>