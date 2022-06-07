<?php 
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\WorkflowModel;
use App\Models\UsersModel;
use App\Models\SubCategoryModel;
use App\Models\CategoryModel;
use App\Models\CompanyModel;
use App\Models\ReportingModel;
use App\Models\User_typesModel;
class Workflow extends BaseController{

	public function index(){

		$this->data['page_title'] = 'Workflow';
		$this->render_template('workflow/index',$this->data);
	}

	public function add(){
		$workflow = new WorkflowModel;

		if($_POST){
			
			$request = service('request');
			$session = session();

			$document_name = $request->getPost('document_name');
			$usertype_id = $request->getPost('usertype_id');
			$category_id = $request->getPost('category_id'); 
			$subcategory_id = $request->getPost('subcategory_id');
			$document_files = $request->getPost('document_files');
			$comments = $request->getPost('comments');
			// $document_files ='';

			// if($_FILES['document_files']['size']>0){

			// 	$uploadDir = 'uploads/workflow/';
			// 	$ext = pathinfo($_FILES['document_files']['name'],PATHINFO_EXTENSION);
			// 	$filenm =time().'_profile.'.$ext;
			// 	$document_files = str_replace(' ', '-', $filenm);
			// 	$uploadedFile = $uploadDir.'/'.$document_files;

			// 	move_uploaded_file($_FILES['document_files']['tmp_name'],$uploadedFile);

			// }

			
			
			$data = array(

				'document_name' =>$document_name,
				'usertype_id' => $usertype_id, 
				'category_id' => $category_id, 
				'subcategory_id' => $subcategory_id,
				//'document_files' => $document_files,
				'comments' => $comments, 

				);
				$insertId = $workflow->insert($data);
				if($insertId > 0){

					$additional_img_array = array();
		            foreach ($_FILES['file']['name'] as $num_key => $dummy) {
		                foreach ($_FILES['file'] as $txt_key => $dummy) {
		                    $additional_img_array[$num_key][$txt_key] = $_FILES['file'][$txt_key][$num_key];
		                }
		            }


		            if(!empty($additional_img_array)){

		                foreach ($additional_img_array as $key => $value) {

		                    $filename = "";
		                    if(!empty($value['name'])) {
		                           
		                       	$uploaddir = 'uploads/workflow/';

				                $ext = pathinfo($value['name'], PATHINFO_EXTENSION);

				                $filenm = time() .'_workflow.'.$ext;
				                $documents = str_replace(' ', '-', $filenm);
				                $uploadfile = $uploaddir .'/'. $documents;

				                move_uploaded_file($value['tmp_name'], $uploadfile);

				                $dataImage = array(
									'workflow_id' => $insertId,
									'documents' => $documents,	 
								);
								
								$db = \Config\Database::connect(); 
						    	$db->table('workflow_documents')->insert($dataImage);
		                    }            
		                }
		            }

					$session->setFlashdata('session', "Successfully added new workflow Documents");
					return redirect()->to('workflow');
				}
				else{
					$session->setFlashdata('session',"Workflow document not added Successfully");
					return redirect()->to('workflow');
					}
		}

        $users_type = new User_typesModel;
        $this->data['users_type'] = $users_type->findall();

        $category = new CategoryModel;
        $this->data['category'] = $category->where('is_deleted',0)->findall();

        $subCategory = new SubCategoryModel;
        $this->data['subCategory'] = $subCategory->where('is_deleted',0)->findall();


		$this->data['page_title'] = 'Workflow';
		$this->render_template('workflow/add',$this->data);
	}

	

	public function fetch_workflow(){

		$db = \Config\Database::connect();		
  	 	$global_tblWorkflow = 'document_workfolw';
 	  	$global_tblusers_types = 'UserTypes';
	  	$global_tblcategory = 'category';
	  	$global_tblsubcategory = 'SubCategory';

        // equal condition
	  	 $whereEqual=array();
        // not equal condition
        $whereNotEqual = array();

        $notIn = array();     

        // select data
        $selectColumn[$global_tblWorkflow.'.*'] = $global_tblWorkflow.'.*';
        $selectColumn[$global_tblusers_types.'.userTypeName'] =  $global_tblusers_types.'.userTypeName';
        $selectColumn[$global_tblcategory.'.categoryName'] =  $global_tblcategory.'.categoryName';
        $selectColumn[$global_tblsubcategory.'.SubCatName'] =  $global_tblsubcategory.'.SubCatName';
      	
        // order column
        $orderColumn = array('', $global_tblWorkflow.".document_name", $global_tblusers_types.".userTypeName", $global_tblcategory.".categoryName", $global_tblsubcategory.".SubCatName", $global_tblWorkflow.".document_files");

        // search column
        $searchColumn = array($global_tblWorkflow.".document_name",$global_tblusers_types.".userTypeName",$global_tblcategory.".categoryName",$global_tblsubcategory.".SubCatName",$global_tblWorkflow.".document_files");

        // order by
        $orderBy = array($global_tblWorkflow.'.id' => "DESC");

        // join table
        $joinTableArray = array();
       	$joinTableArray = array(array("joinTable"=>$global_tblusers_types, "joinField"=>"id", "relatedJoinTable"=>$global_tblWorkflow, "relatedJoinField"=>"usertype_id","type"=>"left"),
       		array("joinTable"=>$global_tblcategory, "joinField"=>"id", "relatedJoinTable"=>$global_tblWorkflow, "relatedJoinField"=>"category_id","type"=>"left"),

       		array("joinTable"=>$global_tblsubcategory, "joinField"=>"id", "relatedJoinTable"=>$global_tblWorkflow, "relatedJoinField"=>"subcategory_id","type"=>"left")

       );


     	$model_user= new WorkflowModel;
        $fetch_data = $model_user->make_datatables( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);
      
     	
        $data = array();
        
        foreach ($fetch_data as $key => $row) {
            $sub_array = array(); 
            
            $imgSrc = base_url('assets/images/download1.png');
              $sub_array[] = '<a href = "' . base_url( '/uploads/workflow/'.$row['document_files']). '" target="_blank"><img src="'.$imgSrc.'"></a>';
            $sub_array[] = $row['document_name'];
            $sub_array[] = $row['userTypeName']; 
            $sub_array[] = $row['categoryName']; 
			$sub_array[] = $row['SubCatName']; 
			//$sub_array[] = $row['document_files'];
          

			$sub_array[] = $row['comments']; 

		 	

		    
        	//$sub_array[] = $row['dateAdded'];
         	//$actionLink = $model_user->getActionLink('',$row['id'],'Workflow','',$row['userTypeID']); 
         	
            $actionLink = $model_user->getActionLink('',$row['id'],'','Workflow','');
            
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
		$model_workflow= new WorkflowModel;
    	$model_workflow->where('id', $id);
		$temp =  $model_workflow->delete();
		if($temp){ 
       		$session->setFlashdata("success", "Workflow Document deleted Successfully.");
        	return redirect()->to('workflow');
       } else {
        	$session->setFlashdata("error", "Workflow Document not deleted Successfully.");
            return redirect()->to('workflow');  
        }  
        	 
	}

	public function edit($id=''){
		
	$model_workflow = new WorkflowModel;
		if($_POST){

			$request = service('request');
			$session = session();
			
			
			// $document_files = '';
	  //       if ($_FILES['document_files']['size']>0) {

	  //           $uploaddir = 'uploads/workflow/';

	  //           $ext = pathinfo($_FILES['document_files']['name'], PATHINFO_EXTENSION);

	  //           $filenm = time().'_profile.'.$ext;
	  //           $document_files = str_replace(' ', '-', $filenm);
	  //           $uploadfile = $uploaddir .'/'. $document_files;

	  //           move_uploaded_file($_FILES['document_files']['tmp_name'], $uploadfile);

	  //       }
	        //  else {
	        // 	$document_files = $request->getPost('hidden_profilePic');
	        // }

			$document_name = $request->getPost('document_name');
			$usertype_id = $request->getPost('usertype_id');
			$category_id = $request->getPost('category_id'); 
			$subcategory_id = $request->getPost('subcategory_id');
			//$document_files = $request->getPost('document_files');
			$comments = $request->getPost('comments');

			$data = array(
				'document_name' =>$document_name,
				'usertype_id' => $usertype_id, 
				'category_id' => $category_id, 
				'subcategory_id' => $subcategory_id,
				//'document_files' => $document_files,
				'comments' => $comments,
				);
			$model_workflow->set($data);
	    	$model_workflow->where('id', $id);
	    	$result =  $model_workflow->update();
	    	
	    	if($result){ 

	    		$additional_img_array = array();
		            foreach ($_FILES['file']['name'] as $num_key => $dummy) {
		                foreach ($_FILES['file'] as $txt_key => $dummy) {
		                    $additional_img_array[$num_key][$txt_key] = $_FILES['file'][$txt_key][$num_key];
		                }
		            }


		            if(!empty($additional_img_array)){

		                foreach ($additional_img_array as $key => $value) {

		                    $filename = "";
		                    if(!empty($value['name'])) {
		                           
		                       	$uploaddir = 'uploads/workflow/';

				                $ext = pathinfo($value['name'], PATHINFO_EXTENSION);

				                $filenm = time() .'_workflow.'.$ext;
				                $documents = str_replace(' ', '-', $filenm);
				                $uploadfile = $uploaddir .'/'. $documents;

				                move_uploaded_file($value['tmp_name'], $uploadfile);

				                $dataImage = array(
									'workflow_id' => $id,
									'documents' => $documents,	 
								);
								
								$db = \Config\Database::connect(); 
						    	$db->table('workflow_documents')->insert($dataImage);
		                    }            
		                }
		            }
	            $session->setFlashdata("success", "Workflow Document updated Successfully.");
	            return redirect()->to('workflow');
	       	} else {
	        	$session->setFlashdata("error", "Workflow Document not updated Successfully.");
	            return redirect()->to('workflow');  
	        }     
		}

		$this->data['page_title'] = "Document Edit";

		$users_type = new User_typesModel;
        $this->data['users_type'] = $users_type->findall();

        $category = new CategoryModel;
        $this->data['category'] = $category->where('is_deleted',0)->findall();

        $subCategory = new SubCategoryModel;
        $this->data['subCategory'] = $subCategory->where('is_deleted',0)->findall();

        $db = \Config\Database::connect(); 

    	$builder = $db->table('workflow_documents');
    	$builder1 = $builder->where('workflow_id',$id);
    	$query = $builder1->get();
    	$datadoc = $query->getResultArray();
    	$this->data['documents'] = $datadoc;

	    $this->data['docData'] = $model_workflow->where('id',$id)->first();

		$this->render_template('workflow/edit',$this->data);
	}

  	public function deleteImg(){
  	$session = session();
		$model_workflow= new WorkflowModel;
    	
    	$updateData = array(					
			'docFile' => '',
		);
		$model_workflow->set($updateData);
    	$model_workflow->where('id', $user_id);
    	$result =  $model_workflow->update();

    	unlink('uploads/workflow/'.$image_name);

		if($result){ 
       		$session->setFlashdata("success", "Document  deleted Successfully.");
        	return redirect()->to('workflow/edit/'.$user_id);
       	} else {
        	$session->setFlashdata("error", "Document Image not deleted Successfully.");
            return redirect()->to('workflow/edit/'.$user_id);  
        }  	 
  	}

  	public function getSubCat(){
	  	$id = $_POST['dataid'];

	  	$model_subCat = new SubCategoryModel;
		$subCat = $model_subCat->where('CategoryId',$id)->findall();
		echo json_encode($subCat);
  	}

	public function deleteAdditionalProductImg($doc_name, $doc_id, $workflow_id) {		

		$session = session();
		$db = \Config\Database::connect(); 

    	$builder = $db->table('workflow_documents');
    	$builder1 = $builder->where('id',$doc_id);
    	$query = $builder1->get();
    	$existData = $query->getResult();
		 if(count($existData)>0){
		 	$temp = $builder->delete(['id' => $doc_id]);
		 }

		// $model_images->where('id', $doc_id);
		// $temp =  $model_images->delete();

    	@unlink('uploads/workflow/'.$doc_name);

		if($temp){ 
       		$session->setFlashdata("success", "Additional Document deleted Successfully.");
        	return redirect()->to($_SERVER['HTTP_REFERER']);
       	} else {
        	$session->setFlashdata("error", "Additional Document not deleted Successfully.");
            return redirect()->to($_SERVER['HTTP_REFERER']);  
        }  	 
	}
}
?>
