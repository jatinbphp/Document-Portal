<?php 
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\DocumentsModel;
use App\Models\UsersModel;
use App\Models\SubCategoryModel;
use App\Models\CategoryModel;
use App\Models\CompanyModel;
use App\Models\ReportingModel;
use App\Models\User_typesModel;
use App\Models\UserCompanyModel;
class Documents extends BaseController{

	public function index(){

		$company = new CompanyModel;
		$this->data['company'] = $company->findall();
		$users = new UsersModel;
		$this->data['users'] = $users->findall();

		$this->data['page_title'] = 'Documents';
		$this->render_template('documents/index',$this->data);
	}

	public function add(){
		$documents = new DocumentsModel;

		if($_POST){
			
			$request = service('request');
			$session = session();

			$docName = $request->getPost('docName');
			$categoryID = $request->getPost('categoryID');
			$subCategoryID = $request->getPost('subCategoryID'); 
			$isActive = $request->getPost('isActive');
			$userID = $request->getPost('userID');
			$companyID = $request->getPost('companyID');
			$expireDate = $request->getPost('expireDate');
			$docFile ='';
			if($_FILES['docFile']['size']  > 20000000){
				$session->setFlashdata("error", "Maximum file size to upload is 20MB");
				return redirect()->to($_SERVER['HTTP_REFERER']);

			}else{

					if($_FILES['docFile']['size']>0){

						$uploadDir = 'uploads/documents/'.$categoryID.'/'.$subCategoryID;
						$ext = pathinfo($_FILES['docFile']['name'],PATHINFO_EXTENSION);
						$ext1 = strtolower($ext);
						if(($ext1 == 'xlsx') || ($ext1 == 'pdf') || ($ext1 == 'docx') || ($ext1 == 'csv') || ($ext1 == 'xls') || ($ext1 == 'doc')){

							$x = substr($_FILES['docFile']['name'], 0, strrpos($_FILES['docFile']['name'], '.'));
							$filenm = $x.'_'.time().'.'.$ext;
							
							$docFile = str_replace(' ', '_', $filenm);
							//$filenm =time().'_profile.'.$ext;
								//$docFile = str_replace(' ', '-', $filenm);
								$uploadedFile = $uploadDir.'/'.$docFile;

								move_uploaded_file($_FILES['docFile']['tmp_name'],$uploadedFile);
							

							
							
							$data = array(

								'docName' =>$docName,
								'categoryID' => $categoryID,
								'subCategoryID' => $subCategoryID, 
								'userID' => $userID, 
								'companyID' => $companyID,
								'docFile' => $docFile,
								'expireDate' => $expireDate,
								'isActive' => isset($isActive) ? 1 : 0, 

								);
								$insertId = $documents->insert($data);
								if($insertId > 0){
									$session->setFlashdata('session', "Successfully added new Document");
									return redirect()->to('documents');
								}else{
									$session->setFlashdata('session',"document not added Successfully");
									return redirect()->to('documents');
									}

						}else{
							$session->setFlashdata("error", "Document accept only .xlsx /.csv /.pdf /.docx /.xls /.doc files");
							return redirect()->to($_SERVER['HTTP_REFERER']);
						}
					}
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
		$this->render_template('documents/add',$this->data);
	}

	

	public function fetch_documents(){

		$db = \Config\Database::connect();		
  	 	$global_tblDocuments = 'DocumentsManage';
 	  	$global_tblusers = 'Users';
	  	$global_tblcategory = 'category';
	  	$global_tblsubcategory = 'SubCategory';
	  	$global_tblcompany = 'Company';

        // equal condition
	  	 $whereEqual=array();
	  	 if(isset($_POST['company_id']) && $_POST['company_id'] != '' ){
			
 			  $whereEqual[$global_tblDocuments.'.companyID']= trim($_POST['company_id']);
 		}
 		if(isset($_POST['user_id']) && $_POST['user_id'] != '' ){
			
 			  $whereEqual[$global_tblDocuments.'.userID']= trim($_POST['user_id']);
 		}

 		$whereIn = array(); 
        // not equal condition
        $whereNotEqual = array();

        $notIn = array();  
        $orwhere=array();  
        $whereUser = array(); 

        // select data
        $selectColumn[$global_tblDocuments.'.*'] = $global_tblDocuments.'.*';
        $selectColumn[$global_tblusers.'.firstName'] =  $global_tblusers.'.firstName';
        $selectColumn[$global_tblusers.'.lastName'] =  $global_tblusers.'.lastName';
        $selectColumn[$global_tblcategory.'.categoryName'] =  $global_tblcategory.'.categoryName';
        $selectColumn[$global_tblsubcategory.'.SubCatName'] =  $global_tblsubcategory.'.SubCatName';
        $selectColumn[$global_tblcompany.'.companyName'] =  $global_tblcompany.'.companyName';
      	
        // order column
       $orderColumn = array('',$global_tblDocuments.".docName", $global_tblcategory.'.categoryName',$global_tblsubcategory.'.SubCatName', $global_tblDocuments.".expireDate",'');

        // search column
        $searchColumn = array($global_tblDocuments.".docName",$global_tblusers.".firstName",$global_tblusers.".lastName",$global_tblcompany.".companyName",$global_tblDocuments.".isActive");

        // order by
        $orderBy = array($global_tblDocuments.'.id' => "DESC");

        // join table
        $joinTableArray = array();
       	$joinTableArray = array(array("joinTable"=>$global_tblusers, "joinField"=>"id", "relatedJoinTable"=>$global_tblDocuments, "relatedJoinField"=>"userID","type"=>"left"),
       		array("joinTable"=>$global_tblcategory, "joinField"=>"id", "relatedJoinTable"=>$global_tblDocuments, "relatedJoinField"=>"categoryID","type"=>"left"),

       		array("joinTable"=>$global_tblsubcategory, "joinField"=>"id", "relatedJoinTable"=>$global_tblDocuments, "relatedJoinField"=>"subCategoryID","type"=>"left"),

       		array("joinTable"=>$global_tblcompany, "joinField"=>"id", "relatedJoinTable"=>$global_tblDocuments, "relatedJoinField"=>"companyID","type"=>"left")

       );


     	$model_user= new DocumentsModel;
        $fetch_data = $model_user->make_datatables( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$orwhere,$whereIn,$whereUser);
      
     	
        $data = array();
        foreach ($fetch_data as $key => $row) {
            $sub_array = array(); 
            
            //$imgSrc = base_url('assets/images/download1.png');
            $id = $row['id'];
            
            if($row['docFile'] == ''){
            	$sub_array[] = '<div onclick="myFunction()"> <i class="fa fa-file" style="color: grey;font-size:36px;"></i></div>';

            }else{
            	 $sub_array[] = '<a href = "' . base_url( '/uploads/documents/'.$row['categoryID'].'/'.$row['subCategoryID'].'/'.$row['docFile']). '" target="_blank"><i class="fa fa-file" style="font-size:36px;"></i></a>';
            }

           
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
            "recordsTotal" => $model_user->get_all_data( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$orwhere,$whereIn,$whereUser),
            "recordsFiltered" => $model_user->get_filtered_data( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$orwhere,$whereIn,$whereUser),
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
	$docDAta = $model_documents->where('id',$id)->first();
	$docfileData = $docDAta['docFile'];
		if($_POST){

			$request = service('request');
			$session = session();
			
			$categoryID = $_POST['categoryID'];
			$subCategoryID = $_POST['subCategoryID'];
			$docFile = '';
			$ext1 = pathinfo($_FILES['docFile']['name'], PATHINFO_EXTENSION);
			$extconvert = strtolower($ext1);
			//echo $extconvert;exit;
			if($_FILES['docFile']['size'] == 0 && $_FILES['docFile']['error'] == 1){
				$session->setFlashdata("error", "Maximum file size to upload is 20MB");
				return redirect()->to($_SERVER['HTTP_REFERER']);

			}
			else{
		        if ($_FILES['docFile']['size']>0) {

		            $uploaddir = 'uploads/documents/'.$categoryID.'/'.$subCategoryID;

		            $ext = pathinfo($_FILES['docFile']['name'], PATHINFO_EXTENSION);
		            $extconvert = strtolower($ext);
		            if(($extconvert == 'xlsx') || ($extconvert == 'pdf') || ($extconvert == 'docx') || ($extconvert == 'csv') || ($extconvert == 'xls') || ($extconvert == 'doc')){

					$x = substr($_FILES['docFile']['name'], 0, strrpos($_FILES['docFile']['name'], '.'));

					//$filenm = $x.'_'.$i.'_'.time().'.'.$ext;
					$filenm = $x.'_'.time().'.'.$ext;
					
					$docFile = str_replace(' ', '_', $filenm);
		            //$filenm = time().'_profile.'.$ext;
		           // $docFile = str_replace(' ', '-', $filenm);
		          
		            $uploadfile = $uploaddir .'/'. $docFile;

		            move_uploaded_file($_FILES['docFile']['tmp_name'], $uploadfile);
		        }
		        else{
		        	$session->setFlashdata("error", "Document accept only .xlsx /.csv /.pdf /.docx /.xls /.doc files");
					return redirect()->to($_SERVER['HTTP_REFERER']);

		        }

		        } else {
		        	$docFile = $request->getPost('hidden_profilePic');
		        }


				$docName = $request->getPost('docName');
				$categoryID = $request->getPost('categoryID');
				$subCategoryID = $request->getPost('subCategoryID'); 
				$isActive = $request->getPost('isActive');
				$userID = $request->getPost('userID');
				$companyID = $request->getPost('companyID');
				$expireDate = $request->getPost('expireDate');
				$edited_date = date('Y-d-m H:m:s');
				$data = array(

					'docName' =>$docName,
					'categoryID' => $categoryID,
					'subCategoryID' => $subCategoryID, 
					'userID' => $userID, 
					'companyID' => $companyID, 
					'docFile' => isset($docFile)?$docFile:$docfileData,
					'expireDate' => $expireDate,
					'edited_date' => $edited_date,
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

  	public function getUser(){
  		$id = $_POST['compid'];

  		//$model_comp = new UserCompanyModel;
  		//$comid = $model_comp->where('company_id',$id)->findall();
  		$db = \Config\Database::connect();
  		$builder = $db->table('user_company');
		$builder->select('*','Users.firstName as firstName','Users.lastName as lastName');
		$builder->join('Users','Users.id = user_company.user_id','left');
		$builder->where('company_id',$id);
		$query = $builder->get();
		$result = $query->getResultArray();
		echo json_encode($result);

        
  		
	  	}

	// public function fetch_company_data(){
	// 	$db = \Config\Database::connect();		
 //  	 	$global_tblUsers = 'Users';
 // 	  	$global_tbluser_type = 'UserTypes';
	//   	$global_tblcompany = 'Company';
 //        // equal condition
        
 //        //echo "<pre>";print_r($_POST);exit;
	// 	$whereEqual = array();
	// 	if(isset($_POST['comapny_id']) && $_POST['comapny_id'] != '' ){
			
 // 			  $whereEqual[$global_tblUsers.'.companyId']= trim($_POST['comapny_id']);
 // 		}

 // 		if(isset($_POST['user_id']) && $_POST['user_id'] != '' ){
			
 // 			  $whereEqual[$global_tblUsers.'.id']= trim($_POST['user_id']);
 // 		}
 //        //$whereEqual = array($global_tblUsers.".companyId" => $_POST['comapny_id']); 
       
 //        // not equal condition
 //        $whereNotEqual = array();

 //        $notIn = array();     

 //        // select data
 //        $selectColumn[$global_tblUsers.'.*'] = $global_tblUsers.'.*';
 //        $selectColumn[$global_tbluser_type.'.userTypeName'] =  $global_tbluser_type.'.userTypeName';
 //        $selectColumn[$global_tblcompany.'.companyName'] =  $global_tblcompany.'.companyName';
      	
 //        // order column
 //        $orderColumn = array('', $global_tblUsers.".firstName", $global_tblUsers.".email", $global_tblUsers.".isActive", $global_tbluser_type.".userTypeName", $global_tblUsers.".dateAdded");

 //        // search column
 //        $searchColumn = array($global_tblUsers.".firstName", $global_tblUsers.".lastName", $global_tblUsers.".email");

 //        // order by
 //        $orderBy = array($global_tblUsers.'.id' => "DESC");

 //        // join table
 //        $joinTableArray = array();
 //       	$joinTableArray = array(array("joinTable"=>$global_tbluser_type, "joinField"=>"id", "relatedJoinTable"=>$global_tblUsers, "relatedJoinField"=>"userTypeID","type"=>"left"),
 //       		array("joinTable"=>$global_tblcompany, "joinField"=>"id", "relatedJoinTable"=>$global_tblUsers, "relatedJoinField"=>"companyId","type"=>"left")
 //       );

			
 //     	$model_user= new ReportingModel;
 //        $fetch_data = $model_user->make_datatables( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);
       
     	
 //        $data = array();
 //        foreach ($fetch_data as $key => $row) {
 //            $sub_array = array(); 

 //            $imgSrc = '';
 //            if (!empty($row['profilePic'])){
 //                $imgSrc = base_url('uploads/users/'.$row['profilePic']);
 //            } else {
 //                $imgSrc = base_url('assets/images/user.svg');
 //            }

 //            $sub_array[] = '<div class="user-img"><img src="'.$imgSrc.'"></div>';
	// 		$sub_array[] = $row['firstName']." ".$row['lastName'];  
	// 		$sub_array[] = $row['email'];  
	// 	 	if($row['isActive'] == 1){
 //                $sub_array[] = '<span class="badge badge-success">Active</span>';
 //            }else{
 //                $sub_array[] = '<span class="badge badge-danger">InActive</span>';
 //            }  

	// 	    $sub_array[] = $row['companyName'];
 //        	$sub_array[] = $row['dateAdded'];
 //         	//$actionLink = $model_user->getActionLink('',$row['id'],'Users','',$row['userTypeID']); 
 //            $actionLink = $model_user->getActionLink('',$row['id'],$row['userTypeID'],'Users','');
 //            //~ $sub_array[] = $actionLink;
 //            $data[] = $sub_array;
 //        } 

 //        $output = array(
 //            "draw" =>  $_POST["draw"] ,
 //            "recordsTotal" => $model_user->get_all_data( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
 //            "recordsFiltered" => $model_user->get_filtered_data( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
 //            "data" => $data,
 //        );

 //        echo json_encode($output);
        
 //    }
}
?>
