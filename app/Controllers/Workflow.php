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
use App\Models\ClientsModel;
use ZipArchive;
class Workflow extends BaseController{

	public function index(){

		$company = new CompanyModel;
		$this->data['company'] = $company->findall();
         
         $client_model = new ClientsModel;
         $this->data['clients'] = $client_model->findall();

		$model_comments = new WorkflowModel;
		$this->data['comments'] = $model_comments->select('comments')->findAll();
		if($_SESSION['user_type'] == 3){
			$this->data['page_title'] = 'Workflow';
			$this->render_user_template('workflow/index',$this->data);
		}else{
			$this->data['page_title'] = 'Workflow';
			$this->render_template('workflow/index',$this->data);
		}
	}

    public function ajaxpopup(){
		$company = new CompanyModel;
		$this->data['company'] = $company->findall();
		$model_comments = new WorkflowModel;
		$this->data['comments'] = $model_comments->select('comments')->findAll();
		$this->data['page_title'] = 'Workflow';
			
		$id = $_POST['docValue'];
		$db = \Config\Database::connect(); 
		$builder = $db->table('workflow_documents');
		$builder1 = $builder->where('workflow_id',$id);
		$query = $builder1->get();
		$datadoc = $query->getResultArray();

		$counter = 0;

		$response = "<table class='table'>";
		$response .= " <thead class='thead-dark'>";
		$response .= "<tr>";
		$response .= "<th scope='col' style='width: 10%'>#</th>";
		$response .= "<th scope='col' style='width: 70%'>Document Name</th>";
		$response .= "<th scope='col' style='width: 20%'>Action</th>";
		$response .= "</tr>";
		$response .= "</thead>";
		$response .= "<tbody>";
		
		
		
		
		foreach($datadoc as $value){
			$response .= "<tr>";
			$response .= "<td>".$counter = $counter + '1'."</td>";
			$response .= "<td>".$value['documents']."</td>";
			$response .= "<td><a href = ".base_url( '/uploads/workflow/'.$value['documents'])." class='btn btn-primary' style='margin: 0px 5px 5px 0px;padding: 4px 9px;font-size: 14px;' target='_blank'><i class='fa fa-file'></i></a></td>";
			$response .= "</tr>";
		}

		$response .= "</tbody>";
		$response .= "</table>";

		echo $response;

		
	}
	public function add(){
		$workflow = new WorkflowModel;


		$data = $workflow->orderBy('update_seq','DESC')->first();
		$seq_id = $data['update_seq']+1;

		$data1 = $workflow->orderBy('order_update','DESC')->first();
		$seq_order_id = $data1['order_update']+1;

		if($_POST){
			
			$request = service('request');
			$session = session();

			$document_name = $request->getPost('document_name');
			$usertype_id = $request->getPost('usertype_id');
			$category_id = $request->getPost('category_id'); 
			$subcategory_id = $request->getPost('subcategory_id');
			$company_id = $request->getPost('company_id');
			$document_files = $request->getPost('document_files');
			$comments = $request->getPost('comments');
			$start_date = $request->getPost('start_date');
			$expire_date = $request->getPost('expire_date');
			$is_active = $request->getPost('is_active');
			$current_date = date('Y-m-d');
			$expire_date = date('0000-00-00');
			$technician_id = $request->getPost('technician_id');
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
				'update_seq'=>$seq_id,
				'document_name' =>$document_name,
				'usertype_id' => $usertype_id, 
				'category_id' => $category_id, 
				'subcategory_id' => $subcategory_id,
				'company_id' => $company_id,
				//'document_files' => $document_files,
				'comments' => $comments, 
				'start_date' => isset($start_date) ? $start_date : $current_date, 
				'expire_date' => isset($expire_date) ? $expire_date : $expire_date, 
				'is_active' => isset($is_active) ? 1 : 0,
				'order_update'=>$seq_order_id,
				'technician_id' => $technician_id,

				);
				$insertId = $workflow->insert($data);

				if($insertId > 0){
					if(count($_FILES)>0){

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
						$session->setFlashdata('session', "Successfully added new workflow Documents");
						return redirect()->to('workflow');
					}
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

        $db = \Config\Database::connect(); 
		$builder = $db->table('Technicians');
		$query = $builder->get();
		$technician_data = $query->getResultArray();
        $this->data['technician'] = $technician_data;

        $company = new CompanyModel;
        $this->data['company'] = $company->findall();

        if($_SESSION['user_type'] == 3){
			$this->data['page_title'] = 'Workflow';
			$this->render_user_template('workflow/add',$this->data);
		}else{
			$this->data['page_title'] = 'Workflow';
			$this->render_template('workflow/add',$this->data);
		}

		// $this->data['page_title'] = 'Workflow';
		// $this->render_template('workflow/add',$this->data);
	}

	

	public function fetch_workflow(){
		$model_user= new WorkflowModel;
		// if(isset($_GET['sort'])){
		// 	$IdArr= $_GET['sort'];

  //   		$str = $IdArr;
		// 	$array = explode(",",$str);
		// 	$firstarr = $array;
		// 	arsort($array, SORT_NUMERIC);
		// 	$latest_array = array_count_values($array);
		// 	$array_combine = array_combine($array, $firstarr);
		// 	$db = \Config\Database::connect();
			
		// 	//~ print_r($array_combine);
			
		// 	$newidarr = array();
		// 	foreach($array_combine as $key=>$value){
				
		// 		$data = $model_user->select('id')->where('update_seq',$value)->first();
		// 	 	$ids = $data['id'];
		// 	 	$newidarr[$ids] = $key;
				
		// 	}

		// 	//print_r($newidarr);
		// 	foreach($newidarr as $key11=>$value11){
		// 		// $data = $model_user->select('id')->where('update_seq',$key)->first();
		// 		// 	$id= $data['id'];
		// 			//~ echo "<br>".$key11."(".$value11.")";
		// 			//echo "</br>"; 

		// 		$builder = $db->table('document_workfolw');
		// 		$builder->set('update_seq', $value11);
		// 		$builder->where('id',$key11);
		//      	$result1 =  $builder->update();
		     	
		     	
		//      	//~ if($result1){
		//      	//~ $page = $_SERVER['PHP_SELF'];
		// 		 //~ $sec = "10";
		// 		 //~ header("Refresh: $sec; url=$page");	
		//      	//~ }
		     	
		        
				
			
		// 	}
			
			
  //   	}

		$db = \Config\Database::connect();		
  	 	$global_tblWorkflow = 'document_workfolw';
 	  	$global_tblusers_types = 'UserTypes';
	  	$global_tblcategory = 'category';
	  	$global_tblsubcategory = 'SubCategory';
	  	$global_tblcompany = 'Company';
	  	$global_tbluser_company = 'user_company';
	  	
	  	$global_tblworkflow_documents = 'workflow_documents';
	  	

        // equal condition
	  	 $whereEqual=array();
	  	 $whereUser = array();
	  	 $is_deleted = 0;
         $whereEqual=array($global_tblWorkflow.'.is_deleted'=>$is_deleted);
         if(isset($_POST['company_id']) && $_POST['company_id'] != '' ){
			
 			  $whereEqual[$global_tblWorkflow.'.company_id']= trim($_POST['company_id']);
 		}

 		 if(isset($_POST['client_id']) && $_POST['client_id'] != '' ){
 		 	$client_comp = array();
 		 	$db      = \Config\Database::connect();
			$builder = $db->table('Company');
			$builder->select('id');
			$builder->where('client_id', $_POST['client_id']);
			$queryResult = $builder->get()->getResult('array');
			foreach($queryResult as $Queryval){
				$comp[] = $Queryval['id'];
			}
			$Comp_id = implode(",",$comp);
			$client_comp[] = $Comp_id;
			// echo "<pre>";print_r($client_comp);exit;
 			  $whereUser[$global_tblWorkflow.'.company_id']= $client_comp;
 		}
        // not equal condition
        $whereNotEqual = array();

        $notIn = array();     

        // select data
        $selectColumn[$global_tblWorkflow.'.*'] = $global_tblWorkflow.'.*';
        $selectColumn[$global_tblusers_types.'.userTypeName'] =  $global_tblusers_types.'.userTypeName';
        $selectColumn[$global_tblcategory.'.categoryName'] =  $global_tblcategory.'.categoryName';
        $selectColumn[$global_tblsubcategory.'.SubCatName'] =  $global_tblsubcategory.'.SubCatName';
        $selectColumn[$global_tblcompany.'.companyName'] =  $global_tblcompany.'.companyName';
        
        //$selectColumn[$global_tblworkflow_documents.'.documents'] =  $global_tblworkflow_documents.'.documents';
        
       // $selectColumn[$global_tbluser_company.'.comName'] =  $global_tbluser_company.'.comName';
      	
        // order column
        $orderColumn = array('', $global_tblWorkflow.".document_name", $global_tblusers_types.".userTypeName", $global_tblcategory.".categoryName", $global_tblsubcategory.".SubCatName", $global_tblcompany.".companyName",$global_tblWorkflow.".comments",$global_tblWorkflow.".start_date",$global_tblWorkflow.".expire_date",$global_tblWorkflow.".is_active",'','');

        // search column
        $searchColumn = array($global_tblWorkflow.".document_name",$global_tblusers_types.".userTypeName",$global_tblcategory.".categoryName",$global_tblsubcategory.".SubCatName",$global_tblWorkflow.".document_files",$global_tblcompany.".companyName");

        // order by
         $orderBy = array();
        $orderBy = array($global_tblWorkflow.'.id' => "DESC");

        // join table
        $joinTableArray = array();
       	$joinTableArray = array(array("joinTable"=>$global_tblusers_types, "joinField"=>"id", "relatedJoinTable"=>$global_tblWorkflow, "relatedJoinField"=>"usertype_id","type"=>"left"),
       		array("joinTable"=>$global_tblcategory, "joinField"=>"id", "relatedJoinTable"=>$global_tblWorkflow, "relatedJoinField"=>"category_id","type"=>"left"),

       		array("joinTable"=>$global_tblsubcategory, "joinField"=>"id", "relatedJoinTable"=>$global_tblWorkflow, "relatedJoinField"=>"subcategory_id","type"=>"left"),
       		
       		array("joinTable"=>$global_tblcompany, "joinField"=>"id", "relatedJoinTable"=>$global_tblWorkflow, "relatedJoinField"=>"company_id","type"=>"left"),
       );


     	$model_user= new WorkflowModel;
        $fetch_data = $model_user->make_datatables( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$whereUser);
      
     	
        $data = array();
        
        foreach ($fetch_data as $key => $row) {
			$db      = \Config\Database::connect();
			$builder = $db->table('workflow_documents');
			$builder->select('documents');
			$builder->where('workflow_id', $row['id']);
			$queryResult = $builder->get()->getResult('array');
			
			
            $sub_array = array(); 
            
            if($_SESSION['user_type'] == 3){
            
            $sub_array[] = $row['document_name'];
            $sub_array[] = $row['userTypeName']; 
            $sub_array[] = $row['categoryName']; 
			$sub_array[] = $row['SubCatName']; 
			//$actionLinkCompany  = $model_user->getActionLinkComapany('',$row['id'],'','Workflow','');
			$sub_array[] = $row['companyName'];

			//$sub_array[] = $row['document_files'];
          

			$sub_array[] = $row['comments']; 
			$sub_array[] = $row['start_date']; 
			$sub_array[] = $row['expire_date']; 


		 	

		    
        	//$sub_array[] = $row['dateAdded'];
         	//$actionLink = $model_user->getActionLink('',$row['id'],'Workflow','',$row['userTypeID']); 
         	
         	//link
            //$actionLink = $model_user->getActionLinkData('',$row['id'],'','Workflow','');
            
            $sub_array[] = $actionLink;
            $data[] = $sub_array;	
            }
            else{
            	
             //$imgSrc = base_url('assets/images/download1.png');
              // $sub_array[] = '<a href = "' . base_url( '/workflow/view_documents/'.$row['id']). '" target="_blank"><button class = "btn btn-primary">View</button></a>';
             $actionLinkSeq = $model_user->actionLinkSeq('',$row['id'],'',$row['update_seq'],''); 
            
             $sub_array[] = $row['document_name'];
            
            $sub_array[] = $row['userTypeName']; 
            $sub_array[] = $row['categoryName']; 
			$sub_array[] = $row['SubCatName']; 
			//$actionLinkCompany  = $model_user->getActionLinkComapany('',$row['id'],'','Workflow','');
			$sub_array[] = $row['companyName'];

			//$sub_array[] = $row['document_files'];
			
          
			$actionLinkComment = $model_user->actionLinkComment('',$row['id'],'',$row['comments'],'');
			$sub_array[] = $actionLinkComment;

			
			$sub_array[] = $row['start_date'];
			$sub_array[] = $row['expire_date'];

			if($row['is_active'] == 1){
                $sub_array[] = '<span class="badge badge-success">APPROVED</span>';
            }elseif($row['is_active'] == 2){
            	$sub_array[] = '<span class="badge badge-primary">SUBMITED</span>';
            }elseif($row['is_active'] == 3){
            	$sub_array[] = '<span class="badge badge-danger">EXPIRED</span>';
            }
            elseif($row['is_active'] == 4){
            	$sub_array[] = '<span class="badge badge-danger">REJECTED</span>';
            }
            
            else{
                $sub_array[] = '<span class="badge badge-danger">OUTSTANDING</span>';
            } 
		 
		 $actionLinkCommentbyceo = $model_user->actionLinkCommentCeo('',$row['id'],'',$row['ceo_comments'],'');
            $sub_array[] =  $actionLinkCommentbyceo;

		    if($row['sec_approval_status'] == 1){
                $sub_array[] = '<span class="badge badge-success">APPROVED</span>';
            }elseif($row['sec_approval_status'] == 2){
            	$sub_array[] = '<span class="badge badge-danger">REJECTED</span>';
            }else{
            	$sub_array[] = '-';
            }
         	//$actionLink = $model_user->getActionLink('',$row['id'],'Workflow','',$row['userTypeID']); 
         	
            $actionLink = $model_user->getActionLink('',$row['id'],'','Workflow','');
            
            $sub_array[] = $actionLink;
            $actionLinkFile = '-';


            if(($row['is_update'] == 1) && (count($queryResult)) > 0){
            //$actionLinkFile = $model_user->getActionLinkFile('',$row['id'],'','Workflow','',$row['document_files']);
        	//$sub_array[] = $actionLinkFile;
        	
        	//$sub_array[] = '<a href = "' . base_url( '/uploads/workflow/'.$row['documents']). '" class="btn btn-primary" style="margin: 0px 5px 5px 0px;padding: 4px 9px;font-size: 14px;" target="_blank"><i class="fa fa-file"></i></a>';  // for document name
        	
        	$sub_array[] = '<a href = "' . base_url( '/workflow/download_documents/'.$row['id']). '" class="btn btn-primary" style="margin: 0px 5px 5px 0px;padding: 4px 9px;font-size: 14px;" target="_blank"><i class="fa fa-file"></i></a>	
        	        	
        	<a href = "#" onclick="return false" class="btn btn-primary modalButton" data-custom-value="'.$row['id'].'" style="margin: 0px 5px 5px 0px;padding: 4px 9px;font-size: 14px;" ><i class="fa fa-eye"></i></a>';
        	
        	//$sub_array[] = '<a href = "' . base_url( '/workflow/download_documents/'.$row['id']). '" class="btn btn-primary" style="margin: 0px 5px 5px 0px;padding: 4px 9px;font-size: 14px;" target="_self"><i class="fa fa-file"></i></a>';	//for workflow id
        		
            }elseif(($row['is_active'] == 1) && (empty($queryResult))){
            	$sub_array[] = '<div> <i class="fa fa-file" style="color: grey;font-size:28px;"></i></div>';
            }else{
            	$sub_array[] = $actionLinkFile;
            }

          
         //     $actionLinkFile = $model_user->getActionLinkFileWait('',$row['id'],'','Workflow','',$row['document_files']);
        	// $sub_array[] = $actionLinkFile;
            //
            //$sub_array[] = $row['update_seq'];
            //$actionLinkFile = $model_user->getActionLinkFile('',$row['id'],'','Workflow','');
        	
            $data[] = $sub_array;
        }


        } 
        $output = array(
            "draw" =>  $_POST["draw"] ,
            "recordsTotal" => $model_user->get_all_data( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$whereUser),
            "recordsFiltered" => $model_user->get_filtered_data( $selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$whereUser),
            "data" => $data,
        );

        echo json_encode($output);
        
    }

    public function fetch_workflow_id(){
    		$model_user= new WorkflowModel;
    	if(isset($_GET['sort'])){
			$IdArr= $_GET['sort'];

    		$str = $IdArr;
			$array = explode(",",$str);
			$firstarr = $array;
			arsort($array, SORT_NUMERIC);
			$latest_array = array_count_values($array);
			$array_combine = array_combine($array, $firstarr);
			$db = \Config\Database::connect();

			$newidarr = array();
			foreach($array_combine as $key=>$value){
				
				$data = $model_user->select('id')->where('update_seq',$key)->first();
			 	$ids = $data['id'];
			 	$newidarr[$ids] = $value;
				
			}

			//print_r($newidarr);
			foreach($newidarr as $key=>$value){
				// $data = $model_user->select('id')->where('update_seq',$key)->first();
				// 	$id= $data['id'];
					echo $key."(".$value.")";
					echo "</br>"; 

				$builder = $db->table('document_workfolw');
				$builder->set('update_seq', $value);
				$builder->where('id',$key);
		     	$result1 =  $builder->update();
		     	

				
		    }
		     	
		        
			// 	if($result1){
		 //     	//echo $page = $_SERVER['HTTP_REFERER'];

			// 	 //$sec = "10";
			// 	$url1=$_SERVER['REQUEST_URI'];
   //  			$data = header("Refresh: 5; URL=$url1");
   //  			//echo $data;exit;
			// 	 //header("Refresh: $sec; url='".$page."'");
				
			// }
			
			
    	}
    }
    public function delete($id) {		

		$session = session();
		$model_workflow= new WorkflowModel;
		if($_SESSION['user_type'] == 3){
			$data =array(
				'is_deleted' => 1,
			);
			$model_workflow->set($data);
			$model_workflow->where('id', $id);
			$temp =  $model_workflow->update();

		}else{
			$model_workflow->where('id', $id);
			$temp =  $model_workflow->delete();
		}
		
    	
		if($temp){ 
			if($_SESSION['user_type'] == 3){
				$session->setFlashdata("success", "Document deleted Successfully.");
        		return redirect()->to($_SERVER['HTTP_REFERER']);
			}else{
				$session->setFlashdata("success", "Workflow Document deleted Successfully.");
        		return redirect()->to('workflow');
			}
       		
       } else {
        	$session->setFlashdata("error", "Workflow Document not deleted Successfully.");
            return redirect()->to('workflow');  
        }  
        	 
	}

	public function edit($id=''){
		
	
	//$model_workflow = new WorkflowModel;
	$model_workflow = new WorkflowModel;
	$flowData = $model_workflow->Where('id',$id)->first();
	$flowdocument_name = $flowData['document_name'];
	$flowusertype_id = $flowData['usertype_id'];
	$flowcategory_id = $flowData['category_id'];
	$flowsubcategory_id = $flowData['subcategory_id'];
	$flowcompany_id = $flowData['company_id'];
	$flowcomments = $flowData['comments'];
	$flowstart_date = $flowData['start_date'];
	$flowexpire_date = $flowData['expire_date'];
	//$flowis_active = $flowData['is_active'];
		if($_POST){
			
			if(!isset($_POST['is_active'])){
				$is_update = $flowData['is_update'];
				if($is_update == 0){
				 $flowis_activeData = 0;	
				}else{
					$flowis_activeData = 4;
				}
				
			}
			else if($_POST['is_active'] == 'on'){

				$flowis_activeData = 1;
			}
			else{
				$flowis_activeData = 1;
			}
			//echo "<pre>";print_r($_POST);exit;
			$request = service('request');
			$session = session();
			
			

			
				$document_name = $request->getPost('document_name');
				$usertype_id = $request->getPost('usertype_id');
				$category_id = $request->getPost('category_id'); 
				$subcategory_id = $request->getPost('subcategory_id');
				$company_id = $request->getPost('company_id');
				//$document_files = $request->getPost('document_files');
				$comments = $request->getPost('comments');
				//$is_activedata = $request->getPost('is_active');
				
				if($_SESSION['user_type'] == 3){
				$start_date = $request->getPost('start_date');
				//$start_date =   date($start_date1.' H:m:s');
				$expire_date = $request->getPost('expire_date');
				//$expire_date = date($expire_date1.' H:m:s');
				}
				else{
				$start_date = $request->getPost('start_date');
				//$start_date =   date($start_date1.' H:m:s');

				$expire_date = $request->getPost('expire_date');
					// if($expire_date1 == ''){
					// 	$expire_date = $expire_date1;
					// }else{
					// 	$expire_date = date($expire_date1.' H:m:s');
					// }	
				}
				
				//$is_active = $request->getPost('is_active');

				 $currentDate = date('Y-m-d');
				//echo $expire_date;exit;
				if($expire_date == ''){
					$expiretime = $expire_date;
				}
				else{
					 //$expiretime = date("Y-m-d",strtotime($expire_date));
					 $expiretime = $expire_date;
				}
				
				
				//$flowis_active1 = '';
				if($expiretime == ''){
					if($flowis_activeData == 1){

					 	$flowis_activeData= 1;
					}
					
				}else{
					if($expiretime == $currentDate || $expiretime <($currentDate) ){
							
							$flowis_activeData = 3;
						}
					elseif($flowis_activeData == 0 && $expiretime >($currentDate) ){
						
						$flowis_activeData= 1;
						}	
					elseif($flowis_activeData == 1){

					 	$flowis_activeData= 1;
					}
			    }
				


				$data = array(
					'document_name' =>isset($document_name)?$document_name :$flowdocument_name,
					'usertype_id' => isset($usertype_id)?$usertype_id:$flowusertype_id, 
					'category_id' => isset($category_id)?$category_id:$flowcategory_id, 
					'subcategory_id' => isset($subcategory_id)?$subcategory_id:$flowsubcategory_id,
					'company_id' => isset($company_id)?$company_id:$flowcompany_id,
					//'document_files' => $document_files,
					'comments' => isset($comments)?$comments:$flowcomments,
					'start_date' => isset($start_date)?$start_date:$flowstart_date,
					'expire_date' => isset($expire_date)?$expire_date:$flowexpire_date,
					'is_active' => $flowis_activeData, 
				);
				if($_SESSION['user_type'] != 3){
					$status = $data['is_active'];
				$this->send_mail($flowcomments, $flowdocument_name, $status, $flowcompany_id, $flowusertype_id);
				}
				
				
				$model_workflow->set($data);
		    	$model_workflow->where('id', $id);
		    	$result =  $model_workflow->update();
		    	
	    	
	    	if($result){ 
	    		
		    		$additional_img_array = array();
		    		
		    		if(count($_FILES)>0){

			            foreach ($_FILES['file']['name'] as $num_key => $dummy) {
			                foreach ($_FILES['file'] as $txt_key => $dummy) {
			                    $additional_img_array[$num_key][$txt_key] = $_FILES['file'][$txt_key][$num_key];
			                }
			            }
						
			           	$i = 0;
			            if(!empty($additional_img_array)){
			                foreach ($additional_img_array as $key => $value) {

			                	$i++;
			                	if($value['size'] > 20000000){
			                		$session->setFlashdata("error", "Maximum file size to upload is 20 MB");
	            					return redirect()->to($_SERVER['HTTP_REFERER']);
			                	}else{
			                	$filename = "";
			                	
			                    if(!empty($value['name'])) {
			                           
			                       	$uploaddir = 'uploads/workflow/';

					                $ext = pathinfo($value['name'], PATHINFO_EXTENSION);
					                $ext1 =strtolower($ext);
					                //echo $ext1;exit;
					                if(($ext1 == 'xlsx') || ($ext1 == 'pdf') || ($ext1 == 'docx') || ($ext1 == 'csv') || ($ext1 == 'xls') || ($ext1 == 'doc')){

					                $x = substr($value['name'], 0, strrpos($value['name'], '.'));
					                $filenm = $x.'_'.time().$i.'.'.$ext;
					                
					               // $filenm = time().rand(10,100).'_workflow_'.$i.'.'.$ext;
					                $documents = str_replace(' ', '_', $filenm);
					                $uploadfile = $uploaddir .'/'. $documents;

					                move_uploaded_file($value['tmp_name'], $uploadfile);

					                $dataImage = array(
										'workflow_id' => $id,
										'documents' => $documents,	 
									);
									$db = \Config\Database::connect(); 
							    	$insertd = $db->table('workflow_documents')->insert($dataImage);
					                }
					                else{
					                	$session->setFlashdata("error", "Document accept only .xlsx /.csv /.pdf /.docx /.xls /.doc files");
	            					return redirect()->to($_SERVER['HTTP_REFERER']);
					                }
					                


			                    } 	
			                	}
			                               
			                }
			            }

		            	if($_SESSION['user_type'] == 3){

		            		$model_workflow= new WorkflowModel;
		            		$db = \Config\Database::connect(); 
		            		$builder = $db->table('workflow_documents');
					    	$builder1 = $builder->where('workflow_id',$id);
					    	$query = $builder1->get();
					    	$datadoc = $query->getResultArray();
					    	if(count($datadoc)>0){
						    	$upData = array(
			            			'is_update' => 1,
			            			'is_active' => 2,
		            			);	
					    	}
					    	else{
					    		$upData = array(
			            			'is_update' => 0,
			            			'is_active' => 0,
		            			);
					    	}
		            		
		            		$status = $upData['is_active'];
							$this->send_mail($flowcomments, $flowdocument_name, $status, $flowcompany_id, $flowusertype_id);
		            		$model_workflow->set($upData);
		    				$model_workflow->where('id', $id);
		    				$result =  $model_workflow->update();
		    				$com_id = $_SESSION['company_id'];
		    				$url = base_url('SubadminWorkflowView/index/'.$com_id);

		            		$session->setFlashdata("success", "Workflow Document updated Successfully.");
	            			return redirect()->to($url);
		            	}else{
		            		$session->setFlashdata("success", "Workflow Document updated Successfully.");
		            		return redirect()->to('workflow');
		            	}

			           		
		            
		       		}else{
	       				if($_SESSION['user_type'] == 3){
	       					$com_id = $_SESSION['company_id'];
		    				$url = base_url('SubadminWorkflowView/index/'.$com_id);
		            		$session->setFlashdata("success", "Workflow Document updated Successfully.");
	            			return redirect()->to($url);
		            	}else{
		            		$session->setFlashdata("success", "Workflow Document updated Successfully.");
		            		return redirect()->to('workflow');
		            	}
	       			}

       			}else {

       				if($_SESSION['user_type'] == 3){
		            		$session->setFlashdata("error", "Workflow Document not updated Successfully.");
	            			return redirect()->to($_SERVER['HTTP_REFERER']);
		            	}else{
		            		$session->setFlashdata("error", "Workflow Document not updated Successfully.");
		            		return redirect()->to('workflow');
		            	}
	        }     
		}

		

		$users_type = new User_typesModel;
        $this->data['users_type'] = $users_type->findall();

        $category = new CategoryModel;
        $this->data['category'] = $category->where('is_deleted',0)->findall();

        $subCategory = new SubCategoryModel;
        $this->data['subCategory'] = $subCategory->where('is_deleted',0)->findall();

        $company = new CompanyModel;
        $this->data['company'] = $company->findall();

        $db = \Config\Database::connect(); 

    	$builder = $db->table('workflow_documents');
    	$builder1 = $builder->where('workflow_id',$id);
    	$query = $builder1->get();
    	$datadoc = $query->getResultArray();
    	$this->data['documents'] = $datadoc;

	    $this->data['docData'] = $model_workflow->where('id',$id)->first();


        if($_SESSION['user_type'] == 3){
			$this->data['page_title'] = 'Workflow';
			$this->render_user_template('workflow/edit',$this->data);
		}else{
			$this->data['page_title'] = 'Workflow';
			$this->render_template('workflow/edit',$this->data);
		}
		//$this->render_template('workflow/edit',$this->data);
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
	
	public function view_documents($id = ''){
		$model_workflow = new WorkflowModel;
        $name = $model_workflow->select('document_name')->where('id',$id)->first();
        $this->data['name'] = $name['document_name'];
        

		$db = \Config\Database::connect(); 

    	$builder = $db->table('workflow_documents');
    	$builder1 = $builder->where('workflow_id',$id);
    	$query = $builder1->get();
    	$datadoc = $query->getResultArray();
    	$this->data['documents'] = $datadoc;

    	 if($_SESSION['user_type'] == 3){
			$this->data['page_title'] = 'Workflow';
			$this->render_user_template('workflow/views',$this->data);
		}else{
			$this->data['page_title'] = 'Workflow';
			$this->render_template('workflow/views',$this->data);
		}

    	//$this->render_template('workflow/views',$this->data);
    	//return view('workflow/views',$this->data);
	} 
	
	
	/*
	public function download_documents($id = ''){
			$db      = \Config\Database::connect();
			$builder = $db->table('workflow_documents');
			$builder->select('documents');
			$builder->where('workflow_id', $id);
			$queryResult = $builder->get()->getResult('array');
			//print_r($queryResult);
			//exit;
			//$dir_to_save = "Downloads/";
			$dir_to_save = "/var/www/html/Document-Portal/writable/";
			
			//$dir_to_save = "/home/";
			
			//if (!is_dir($dir_to_save)) {
			  //mkdir($dir_to_save);
			//}
			foreach($queryResult as $value){
				$url = base_url('/uploads/workflow/'.$value['documents']);
				set_time_limit(0); 
				$file = file_get_contents($url);
				file_put_contents($dir_to_save.$value['documents'], $file);
		}
	}*/


	public function download_documents($id = ''){
			$db      = \Config\Database::connect();
			$builder = $db->table('workflow_documents');
			$builder->select('documents');
			$builder->where('workflow_id', $id);
			$queryResult = $builder->get()->getResult('array');

			
			$model_workflow= new WorkflowModel;
			$model_workflow->select('document_name');
			$model_workflow->where('id', $id);
			$query = $model_workflow->get();
			$result = $query->getRow();
			$workflow = $result->document_name;
				
			$zip = new ZipArchive;
			$zipname = $workflow.'_'.time().'.zip';
			//$zipname = 'workflow.zip';
			$zip->open($zipname, ZipArchive::CREATE);
			foreach($queryResult as $value){
				$url = base_url('/uploads/workflow/'.$value['documents']);	
				$zip->addFromString(basename($url),  file_get_contents($url));				
			}
			$zip->close();
			header('Content-Type: application/zip');
			header('Content-disposition: attachment; filename='.$zipname);
			header('Content-Length: ' . filesize($zipname));
			$downloadFile = readfile($zipname);
			//delete the zipped file from server after download
			if($downloadFile){
				if(file_exists($zipname)){
					unlink($zipname);
				}
			}		
		}
		
		public function send_mail($flowcomments, $flowdocument_name, $flowis_activeData, $flowcompany_id, $flowusertype_id){
				
				$company_model = new CompanyModel;
				$company_model->select('companyName');
				$company_model->where('id', $flowcompany_id);
				$query = $company_model->get();
				$queryResult = $query->getRow();
				$companyName = $queryResult->companyName;
				
				$userType_model = new User_typesModel;
				$userType_model->select('userTypeName');
				$userType_model->where('id', $flowusertype_id);
				$query = $userType_model->get();
				$queryResult = $query->getRow();
				$userType = $queryResult->userTypeName;
			$db = \Config\Database::connect(); 

			$buildersql = $db->table('user_company');
            $buildersql1 =$buildersql->select('user_company.*, Users.email as email');
            $buildersql2 = $buildersql1->join('Users', 'user_company.user_id = Users.id');
            $buildersql3 =$buildersql2->where('company_id',$flowcompany_id);
            $buildersql3 =$buildersql2->where('Users.userTypeID',3);
            $result = $buildersql3->get()->getResultArray();

            foreach($result as $emailval){
            	$emailval1[] = $emailval['email'];
            }
            $to = implode(",",$emailval1);
           
          
				
				if($flowis_activeData == 1){
					$status = 'APPROVED';
				}elseif($flowis_activeData == 2){
					$status = 'SUBMITED';
				}elseif($flowis_activeData == 3){
					$status = 'EXPIRED';
				}elseif($flowis_activeData == 4){
					$status = 'REJECTED';
				}else{
					$status = 'OUTSTANDING';
				}
				
				$message = '<b>Client:</b> '.$companyName.'<br>'.
				'<b>STATUS:</b> '.$status.'<br>'.
				'<b>'.$companyName.' - </b>'.$flowdocument_name.' has been '.$status.' by '.$userType.'<br>'.
				'<b>Comments:</b> '.$flowcomments.'<br>'.
				'Kind regards';

				$headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= '<noreply@hseqss.co.za>';
                
                $to = $to;
               
                $subject = $companyName;

                mail($to,$subject,$message,$headers);
					
				// $email = \Config\Services::email();
				// $email->setFrom('gert@gsdm.co.za', 'HSEQ User');
				// $email->setTo($to);
				// $email->setSubject($companyName);
				// $email->setMessage($message);
				// $email->send();
				
				//  if ($email->send()){
				// 	echo 'Email successfully sent';
				// } 
				// else {
				// 	$data = $email->printDebugger(['headers']);
				// 	print_r($data);
				// }
				
		}	


	public function wait_approval(){

		$model_company = new CompanyModel;
		$company = $model_company->findAll();
		//$this->data['id'] = $id;
		$this->data['company'] = $company;
		$this->data['title'] = 'Approval';
		$this->render_template('workflow/approval',$this->data);

		
	}

	public function approve_company(){
		
		$model_workflow = new WorkflowModel;
		$request = service('request');
		$session = session();
		$company = $request->getPost('company_id');
		
		// $data = array(
		// 	'approve_company' => $company,
		// );

		// $model_workflow->set($data);
  //   	$model_workflow->where('id', $id);
  //   	$result =  $model_workflow->update();

    	if($company ){ 
	            //$session->setFlashdata("success", "User updated Successfully.");
	            return redirect()->to('workflow/approve_ceo/'.$company);
           	} else {
	        	$session->setFlashdata("error", "Something went wrong.");
	            return redirect()->to($_SERVER['HTTP_REFERER']);  
	        }  

	}

	public function approve_ceo($id= ''){
		
		$request = service('request');
		$session = session();
		
		 
		$comp_id = $id;

		$workflow_model = new WorkflowModel;
	 	// $company_user_id = $workflow_model->select('id')->where('company_id',$comp_id)->where('awating_user_id','> 0')->findAll();
	 	// 
	 	// 
	 	$db = \Config\Database::connect(); 
		            		$builder = $db->table('document_workfolw');
					    	$builder1 = $builder->where('company_id',$comp_id);
					    	$builder1 = $builder->where('awating_user_id != ',0);
					    	$query = $builder1->get();
					    	$company_user_id = $query->getResultArray();
					    	

	 	if(count($company_user_id)>0){
	 		$this->data['iidd'] = 1;
	 	}

		$model_user = new UsersModel;
		

			$db = \Config\Database::connect();  
 			$buildersql = $db->table('Users');
            $buildersql1 =$buildersql->select('Users.*, user_company.company_id as company_id');
            $buildersql2 = $buildersql1->join('user_company', 'user_company.user_id = Users.id');
            $buildersql3 =$buildersql2->where('user_company.company_id',$comp_id);
            $buildersql3 =$buildersql2->where('Users.userTypeID',1);
            $result = $buildersql3->get()->getResultArray();
            // echo $query = $db->getLastQuery();exit;

			$this->data['users'] = $result;
			$this->data['id'] = $id;

		
		if($_POST){
			$id = $_POST['usertype_id'];


			$workflow_model = new WorkflowModel;
			$users = $model_user->where('id',$id)->first();

			 $company_user_id = $workflow_model->select('id')->where('company_id',$comp_id)->findAll();
			 foreach($company_user_id as $val){

			 	$uid= $val['id'];
			 	$data = array(
					'awating_user_id' => $id,
				);

				$workflow_model->set($data);
		    	$workflow_model->where('id', $uid);
		    	$result =  $workflow_model->update();
	    	}
		  	
             $to = $users['email'] ;
            $url = base_url();
           $message = ' <b> Hello!  <br> <br>
           '.$users['firstName'].'  '.$users['lastName'].' </b>
            <br><br>Please login to this site :<a href = "'.$url.'"> '.$url.'</a> and  varify the documents.';
			
			 $email = \Config\Services::email();
                        $email->setFrom('gert@gsdm.co.za', 'HSEQ User');
                         $email->setTo($to);
                        $email->setSubject('HSEQ Document');
                        $email->setMessage($message);
                         if ($email->send()) 
                        {
                            echo 'Email successfully sent';
                            $session->setFlashdata("Success", "Email successfully sent");
                            return redirect()->to('workflow');

                        } 
                        else 
                        {
                            $data = $email->printDebugger(['headers']);
                            print_r($data);
                        }

                        return redirect()->to('workflow');
		}




		$this->data['title'] = 'Approval';
		$this->render_template('workflow/approval_by _ceo',$this->data);

	}

	public function drag_drop(){
		//echo "<pre>";print_r($_FILES);exit;
		$session = session();
		$url = explode("/",$_SERVER['HTTP_REFERER']);
		 $id = end($url);
		$imageData = '';

		if (isset($_FILES['file']['name'][0])) {
			
			$i = 0;
			
			// if($_FILES['file']['size'][0] > 211600){
			// 	echo "Maximum file size to upload is 20 MB";exit;

			// }
			// else{

		  foreach ($_FILES['file']['name'] as $keys => $values) {
		  	$i++;

		  	$ext = pathinfo($values, PATHINFO_EXTENSION);
		  	$extconvert= strtolower($ext);
		  	if(($extconvert == 'xlsx') || ($extconvert == 'pdf') || ($extconvert == 'docx') || ($extconvert == 'csv') || ($extconvert == 'xls') || ($extconvert == 'doc')){
		  	$x = substr($values, 0, strrpos($values, '.'));
            $filenm = $x.'_'.time().$i.'.'.$ext;
            $documents = str_replace(' ', '_', $filenm);
		   
		    if (move_uploaded_file($_FILES['file']['tmp_name'][$keys], 'uploads/workflow/' . $documents)) {
		    	$imageData .= '<span class="thumbnail">'.$documents.'</span>';

		    	 $dataImage = array(
										'workflow_id' => $id,
										'documents' => $documents,	 
									);
									$db = \Config\Database::connect(); 
							    	$insertd = $db->table('workflow_documents')->insert($dataImage);
					                

		     $imageData .= '<img src="uploads/workflow/' . $fileName . '" class="thumbnail" />';
		    }
		}
		else{
			echo "extension error ";exit;
			

		}
		   
		  }
		//}
		  
		}
		echo $imageData;

		

	}

	public function drag_drop_validation(){
		//echo "<pre>";print_r($_FILES);exit;
		$session = session();
		$url = explode("/",$_SERVER['HTTP_REFERER']);
		 $id = end($url);
		$imageData = '';
		
		if (isset($_FILES['images']['name'][0])) {
			
			$i = 0;
			
			// if($_FILES['file']['size'][0] > 211600){
			// 	echo "Maximum file size to upload is 20 MB";exit;

			// }
			// else{

		  foreach ($_FILES['images']['name'] as $keys => $values) {
		  	$i++;

		  	$ext = pathinfo($values, PATHINFO_EXTENSION);
		  	$extconvert= strtolower($ext);
		  	if(($extconvert == 'xlsx') || ($extconvert == 'pdf') || ($extconvert == 'docx') || ($extconvert == 'csv') || ($extconvert == 'xls') || ($extconvert == 'doc')){
		  	$x = substr($values, 0, strrpos($values, '.'));
            $filenm = $x.'_'.time().$i.'.'.$ext;
            $documents = str_replace(' ', '_', $filenm);
		   	
		    if (move_uploaded_file($_FILES['images']['tmp_name'][$keys], 'uploads/workflow/' . $documents)) {
		    	$imageData .= '<span class="thumbnail">'.$documents.'</span>';

		    	 $dataImage = array(
										'workflow_id' => $id,
										'documents' => $documents,	 
									);
									$db = \Config\Database::connect(); 
							    	$insertd = $db->table('workflow_documents')->insert($dataImage);
					                

		     // $imageData .= '<img src="uploads/workflow/' . $fileName . '" class="thumbnail" />';
		    }
		}
		else{
			echo "extension error ";exit;
			

		}
		   
		  }
		//}
		  
		}
		echo $imageData;

		

	}	
}
?>
