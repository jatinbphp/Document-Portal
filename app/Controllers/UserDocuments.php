<?php 
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\UserDocumentsModel;
use App\Models\UsersModel;
use App\Models\SubCategoryModel;
use App\Models\CategoryModel;
use App\Models\CompanyModel;
use App\Models\ReportingModel;
use App\Models\User_typesModel;
class UserDocuments extends BaseController{

	public function index(){

		$company = new CompanyModel;
		$this->data['company'] = $company->findall();
		$users = new UsersModel;
		$this->data['users'] = $users->where('userTypeID',2)->findall();

		$this->data['page_title'] = 'Documents';
		$this->render_user_template('Frontside/documents/index',$this->data);
	}

	public function add(){
		$documents = new UserDocumentsModel;

		$company_get = new UsersModel;
		$companyId = $company_get->where('id',$_SESSION['id'])->first();
		$comId = $companyId['companyId'];
		

		if($_POST){
			
			$request = service('request');
			$session = session();

			$docName = $request->getPost('docName');
			$categoryID = $request->getPost('categoryID');
			$subCategoryID = $request->getPost('subCategoryID'); 
			$isActive = $request->getPost('isActive');
			$userID = $_SESSION['id'];
			$companyID = $comId;
			$expireDate = $request->getPost('expireDate');

			$docFile ='';

			if($_FILES['docFile']['size']>0){

				$uploadDir = 'uploads/documents/'.$categoryID.'/'.$subCategoryID;
				$ext = pathinfo($_FILES['docFile']['name'],PATHINFO_EXTENSION);
				$filenm =time().'_profile.'.$ext;
				$docFile = str_replace(' ', '-', $filenm);
				$uploadedFile = $uploadDir.'/'.$docFile;

				move_uploaded_file($_FILES['docFile']['tmp_name'],$uploadedFile);

			}

			
			
			$data = array(

				'docName' =>$docName,
				'categoryID' => $categoryID,
				'subCategoryID' => $subCategoryID, 
				'userID' => $userID, 
				'companyID' => $companyID,
				'docFile' => $docFile,
				'expireDate' => $expireDate,
				'isActive' => isset($isActive) ? 1 : 0, 
				'is_user' => isset($isActive) ? 1 : 0,

				);
				
			$insertId = $documents->insert($data);

			$this->session->set($comId); 
			$session = session();
			if($insertId > 0){
				$session->setFlashdata('session', "Successfully added new Document");
				return redirect()->to('userDocuments');
			}
			else{
				$session->setFlashdata('session',"document not added Successfully");
				return redirect()->to('userDocuments');
			}
		}

        $users = new UsersModel;
        $this->data['users'] = $users->findall();

        $category = new CategoryModel;
        $this->data['category'] = $category->where('is_deleted',0)->findall();

        $subCategory = new SubCategoryModel;
        $this->data['subCategory'] = $subCategory->where('is_deleted',0)->findall();

        $company = new CompanyModel;
		$this->data['company'] = $company->findall();

		$this->data['page_title'] = 'Documents';
		$this->render_user_template('Frontside/documents/add',$this->data);
	}

	

		public function fetch_documents(){

		$db = \Config\Database::connect();		
  	 	$global_tblDocuments = 'DocumentsManage';
 	  	$global_tblusers = 'Users';
	  	$global_tblcategory = 'category';
	  	$global_tblsubcategory = 'SubCategory';
	  	$global_tblcompany = 'Company';

	  	$company_get = new UsersModel;
		$companyId = $company_get->where('id',$_SESSION['id'])->first();
		$comId = $companyId['companyId'];

        // equal condition
	  	 $whereEqual=array();

	  	 
	  	 $whereEqual[$global_tblDocuments.'.userID']= trim($_SESSION['id']); 
	  	 $whereEqual[$global_tblDocuments.'.companyID']= trim($comId);


        // not equal condition
        $whereNotEqual = array();

        $notIn = array();     

        // select data
        $selectColumn[$global_tblDocuments.'.*'] = $global_tblDocuments.'.*';
        $selectColumn[$global_tblusers.'.firstName'] =  $global_tblusers.'.firstName';
        $selectColumn[$global_tblusers.'.lastName'] =  $global_tblusers.'.lastName';
        $selectColumn[$global_tblcategory.'.categoryName'] =  $global_tblcategory.'.categoryName';
        $selectColumn[$global_tblsubcategory.'.SubCatName'] =  $global_tblsubcategory.'.SubCatName';
        $selectColumn[$global_tblcompany.'.companyName'] =  $global_tblcompany.'.companyName';
      	
        // order column
        $orderColumn = array('', $global_tblDocuments.".firstName", $global_tblDocuments.".email", $global_tblDocuments.".isActive", $global_tblusers.".firstName", $global_tblDocuments.".isActive");

        // search column
        $searchColumn = array($global_tblDocuments.".docName",$global_tblusers.".firstName",$global_tblusers.".lastName",$global_tblDocuments.".isActive");

        // order by
        $orderBy = array($global_tblDocuments.'.id' => "DESC");

        // join table
        $joinTableArray = array();
       	$joinTableArray = array(array("joinTable"=>$global_tblusers, "joinField"=>"id", "relatedJoinTable"=>$global_tblDocuments, "relatedJoinField"=>"userID","type"=>"left"),
       		array("joinTable"=>$global_tblcategory, "joinField"=>"id", "relatedJoinTable"=>$global_tblDocuments, "relatedJoinField"=>"categoryID","type"=>"left"),

       		array("joinTable"=>$global_tblsubcategory, "joinField"=>"id", "relatedJoinTable"=>$global_tblDocuments, "relatedJoinField"=>"subCategoryID","type"=>"left"),

       		array("joinTable"=>$global_tblcompany, "joinField"=>"id", "relatedJoinTable"=>$global_tblDocuments, "relatedJoinField"=>"companyID","type"=>"left")

       );


     	$model_user= new UserDocumentsModel;
        $fetch_data = $model_user->make_datatables( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);
       
     	
        $data = array();
        foreach ($fetch_data as $key => $row) {
            $sub_array = array(); 
            
            $imgSrc = base_url('assets/images/download1.png');
            $id = $row['id'];
            
            $sub_array[] = '<a href = "' . base_url( '/uploads/documents/'.$row['categoryID'].'/'.$row['subCategoryID'].'/'.$row['docFile']). '" target="_blank"><img src="'.$imgSrc.'"></a>';
            $sub_array[] = $row['docName'];  
			$sub_array[] = $row['firstName']." ".$row['lastName'];  
			$sub_array[] = $row['categoryName']; 
			$sub_array[] = $row['SubCatName']; 
			$sub_array[] = $row['companyName'];  
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
		$model_documents= new UserDocumentsModel;
    	$model_documents->where('id', $id);
		$temp =  $model_documents->delete();
		if($temp){ 
       		$session->setFlashdata("success", "Document deleted Successfully.");
        	return redirect()->to('userDocuments');
       } else {
        	$session->setFlashdata("error", "Document not deleted Successfully.");
            return redirect()->to('userDocuments');  
        }  
        	 
	}

		public function edit($id=''){
		$model_documents = new UserDocumentsModel;

		$company_get = new UsersModel;
		$companyId = $company_get->where('id',$_SESSION['id'])->first();
		$comId = $companyId['companyId'];

		if($_POST){

			$request = service('request');
			$session = session();

			$docName = $request->getPost('docName');
			$categoryID = $request->getPost('categoryID');
			$subCategoryID = $request->getPost('subCategoryID'); 
			$isActive = $request->getPost('isActive');
			$userID = $_SESSION['id'];
			$companyID = $comId;
			$expireDate = $request->getPost('expireDate');

			$docFile = '';
            if ($_FILES['docFile']['size']>0) {

                $uploaddir = 'uploads/documents/'.$categoryID.'/'.$subCategoryID;

                $ext = pathinfo($_FILES['docFile']['name'], PATHINFO_EXTENSION);

                $filenm = time().'_profile.'.$ext;
                $docFile = str_replace(' ', '-', $filenm);
                $uploadfile = $uploaddir .'/'. $docFile;

                move_uploaded_file($_FILES['docFile']['tmp_name'], $uploadfile);

            } else {
            	$docFile = $request->getPost('hidden_profilePic');
            }

			
			$data = array(

				'docName' =>$docName,
				'categoryID' => $categoryID,
				'subCategoryID' => $subCategoryID, 
				'userID' => $userID, 
				'companyID' => $companyID, 
				'docFile' => $docFile,
				'expireDate' => $expireDate,
				'isActive' => isset($isActive) ? 1 : 0,
				'is_user' => isset($isActive) ? 1 : 0,  


				);
			$model_documents->set($data);
        	$model_documents->where('id', $id);
        	$result =  $model_documents->update();
        	
        	if($result){ 
	            $session->setFlashdata("success", "Document updated Successfully.");
	            return redirect()->to('userDocuments');
           	} else {
	        	$session->setFlashdata("error", "Document not updated Successfully.");
	            return redirect()->to('userDocuments');  
	        }     
		}

		$this->data['page_title'] = "Document Edit";

		$users = new UsersModel;
        $this->data['users'] = $users->findall();

        $category = new CategoryModel;
        $this->data['category'] = $category->where('is_deleted',0)->findall();

        $subCategory = new SubCategoryModel;
        $this->data['subCategory'] = $subCategory->where('is_deleted',0)->findall();

        $company = new CompanyModel;
		$this->data['company'] = $company->findall();

        $this->data['docData'] = $model_documents->where('id',$id)->first();

		$this->render_user_template('Frontside/documents/edit',$this->data);
	}

  	public function deleteImg(){
  	$session = session();
		$model_documents= new UserDocumentsModel;
    	
    	$updateData = array(					
			'docFile' => '',
		);
		$model_documents->set($updateData);
    	$model_documents->where('id', $user_id);
    	$result =  $model_documents->update();

    	unlink('uploads/documents/'.$image_name);

		if($result){ 
       		$session->setFlashdata("success", "Document  deleted Successfully.");
        	return redirect()->to('Frontside/documents/edit/'.$user_id);
       	} else {
        	$session->setFlashdata("error", "Document Image not deleted Successfully.");
            return redirect()->to('Frontside/documents/edit/'.$user_id);  
        }  	 
  	}

  	public function getSubCat(){
	  	$id = $_POST['dataid'];

	  	$model_subCat = new SubCategoryModel;
		$subCat = $model_subCat->where('CategoryId',$id)->findall();
		echo json_encode($subCat);
  	}

public function fetch_company_data(){
		$db = \Config\Database::connect();		
  	 	$global_tblUsers = 'Users';
 	  	$global_tbluser_type = 'UserTypes';
	  	$global_tblcompany = 'Company';
        // equal condition
        
        //echo "<pre>";print_r($_POST);exit;
		$whereEqual = array();
		if(isset($_POST['comapny_id']) && $_POST['comapny_id'] != '' ){
			
 			  $whereEqual[$global_tblUsers.'.companyId']= trim($_POST['comapny_id']);
 		}

 		if(isset($_POST['user_id']) && $_POST['user_id'] != '' ){
			
 			  $whereEqual[$global_tblUsers.'.id']= trim($_POST['user_id']);
 		}
        //$whereEqual = array($global_tblUsers.".companyId" => $_POST['comapny_id']); 
       
        // not equal condition
        $whereNotEqual = array();

        $notIn = array();     

        // select data
        $selectColumn[$global_tblUsers.'.*'] = $global_tblUsers.'.*';
        $selectColumn[$global_tbluser_type.'.userTypeName'] =  $global_tbluser_type.'.userTypeName';
        $selectColumn[$global_tblcompany.'.companyName'] =  $global_tblcompany.'.companyName';
      	
        // order column
        $orderColumn = array('', $global_tblUsers.".firstName", $global_tblUsers.".email", $global_tblUsers.".isActive", $global_tbluser_type.".userTypeName", $global_tblUsers.".dateAdded");

        // search column
        $searchColumn = array($global_tblUsers.".firstName", $global_tblUsers.".lastName", $global_tblUsers.".email");

        // order by
        $orderBy = array($global_tblUsers.'.id' => "DESC");

        // join table
        $joinTableArray = array();
       	$joinTableArray = array(array("joinTable"=>$global_tbluser_type, "joinField"=>"id", "relatedJoinTable"=>$global_tblUsers, "relatedJoinField"=>"userTypeID","type"=>"left"),
       		array("joinTable"=>$global_tblcompany, "joinField"=>"id", "relatedJoinTable"=>$global_tblUsers, "relatedJoinField"=>"companyId","type"=>"left")
       );

			
     	$model_user= new ReportingModel;
        $fetch_data = $model_user->make_datatables( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);
       
     	
        $data = array();
        foreach ($fetch_data as $key => $row) {
            $sub_array = array(); 

            $imgSrc = '';
            if (!empty($row['profilePic'])){
                $imgSrc = base_url('uploads/users/'.$row['profilePic']);
            } else {
                $imgSrc = base_url('assets/images/user.svg');
            }

            $sub_array[] = '<div class="user-img"><img src="'.$imgSrc.'"></div>';
			$sub_array[] = $row['firstName']." ".$row['lastName'];  
			$sub_array[] = $row['email'];  
		 	if($row['isActive'] == 1){
                $sub_array[] = '<span class="badge badge-success">Active</span>';
            }else{
                $sub_array[] = '<span class="badge badge-danger">InActive</span>';
            }  

		    $sub_array[] = $row['companyName'];
        	$sub_array[] = $row['dateAdded'];
         	//$actionLink = $model_user->getActionLink('',$row['id'],'Users','',$row['userTypeID']); 
            $actionLink = $model_user->getActionLink('',$row['id'],$row['userTypeID'],'Users','');
            //~ $sub_array[] = $actionLink;
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
}
?>
