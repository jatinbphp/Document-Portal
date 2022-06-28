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
use CodeIgniter\Files\File;
use App\Models\UserDocumentsModel;
class UserDocs extends BaseController{

	public function index(){

		$company = new CompanyModel;
		$this->data['company'] = $company->findall();
		$users = new UsersModel;
		$this->data['users'] = $users->findall();

		$this->data['page_title'] = 'UserDocuments';
		$this->render_user_template('User/documents/index',$this->data);
	}
	public function fetch_documents(){
		$db = \Config\Database::connect();		
  	 	$global_tblDocuments = 'DocumentsManage';
 	  	$global_tblusers = 'Users';
	  	$global_tblcategory = 'category';
	  	$global_tblsubcategory = 'SubCategory';
	  	$global_tblcompany = 'Company';

        $doc_model = new DocumentsModel;
        $existuser = $doc_model->where('userID',$_SESSION['id'])->findall();

        $com_model = new UserCompanyModel;
        $ComapanyId = $com_model->where('user_id',$_SESSION['id'])->findAll();

        foreach($ComapanyId as $CompValue){
            $CompArr[] = $CompValue['company_id'];
        }

        $ComID = implode(",",$CompArr );
        $ComID1 = ''.$ComID.',0';
       $CompArr1[] = $ComID1;

       $IdArr = array($_SESSION['id'],0);
       $userID = implode(",",$IdArr);
       $userID1 = ''.$userID.'';
       $userIDArr1[] = $userID1;
       

        
        // equal condition
	  	 $whereEqual=array();
          $whereIn = array(); 
         $orwhere=array();
         $whereUser = array();
         if(count($existuser)>0){
           $whereEqual =array();
           $whereUser[$global_tblDocuments.'.userID'] = $userIDArr1;
            
           //$orwhere[$global_tblDocuments.'.userID']= 0;
         }
         else{
           $whereEqual[$global_tblDocuments.'.userID']= 0;
         }
	  


        // not equal condition
        $whereNotEqual = array();
        $whereNotEqual[$global_tblDocuments.'.isActive']= 0;
        $notIn = array();   
       
        $whereIn[$global_tblDocuments.'.companyID'] = $CompArr1;   

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
        //echo "<pre>";print_r($fetch_data);exit;
        foreach ($fetch_data as $key => $row) {
            $sub_array = array(); 
            
            //$imgSrc = base_url('assets/images/download1.png');
            $id = $row['id'];
            
            $sub_array[] = '<a href = "' . base_url( '/uploads/documents/'.$row['categoryID'].'/'.$row['subCategoryID'].'/'.$row['docFile']). '" target="_blank"><i class="fa fa-file" style="font-size:36px;"></i></a>';
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

            // $actionLink = $model_user->getActionLink('',$row['id'],'','Documents','');
            // $sub_array[] = $actionLink;
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

    public function add(){
        $documents = new UserDocumentsModel;

        //$company_get = new UsersModel;
        //$companyId = $company_get->where('id',$_SESSION['id'])->first();
        //$comId = $companyId['companyId'];
        
        

        if($_POST){
            
            $request = service('request');
            $session = session();
            
            
                
            
            //$companyId = $request->getPost('companyId');
            //$companyId =  (int) implode($companyId);
            //echo getType($companyId);
            //exit;
            //echo $companyId;
            //print_r($companyId);
            //exit;

            $docName = $request->getPost('docName');
            $categoryID = $request->getPost('categoryID');
            $subCategoryID = $request->getPost('subCategoryID'); 
            $isActive = $request->getPost('isActive');
            $userID = $_SESSION['id'];
            //$companyID = $comId;
            $companyID = $request->getPost('companyID');
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

            $data1 = array(

                'docName' =>$docName,
                'categoryID' => $categoryID,
                'subCategoryID' => $subCategoryID, 
                'userID' => $userID, 
                'companyID' => $companyID,
                //'companyID' => 0,
                'companyID' => $companyID,
                'docFile' => $docFile,
                //'expireDate' => $expireDate,
                'expireDate' => '0000-00-00',
                'is_user' => isset($userID) ? 1 : 0,
                'isActive' => 0, 
                );
                
                //echo "<pre>";
                //print_r($data1);
                //exit;
                
            $insertId = $documents->insert($data1);
            
            // $firstName = $companyId['firstName'];
            // $lastName = $companyId['lastName'];

            // $company_model = new CompanyModel;
            // $companyName = $company_model->where('id',$comId)->first();
            // $company =$companyName['companyName'];
            // $url = base_url('userDocuments/edit/'.$insertId);
            // $message = 'Hello <br> <br>

            // One document uploaded by '.$firstName.' '.$lastName.'

            // <br><br>User Name: '.$firstName.''.$lastName.'
            // <br>Compony:'.$firstName.'

            // <br><br>Please active this document by this link:<a href = "'.$url.'"> Click Here</a';
            
            //send mail code here
            
            
            // $email = \Config\Services::email();
            // $email->setFrom('jayashree.s.php@gmail.com', 'your Title Here');
            // $email->setTo('amit.kk.php@gmail.com');
            // $email->setSubject('Confirmation ');
            // $email->setMessage($message);
            // $email->send();
            
                $users = new UsersModel;
                $users->select('firstName,lastName');
                $users->where('id', $_SESSION['id']);
                $queryResult = $users->get()->getResult();
                foreach($queryResult as $value){
                    $userFirstName = $value->firstName;
                    $userLastName = $value->lastName;
                }
                
                $company = new CompanyModel;
                $company->select('companyName');
                $company->where('id', $companyID);
                $queryResult = $company->get()->getResult();
                foreach($queryResult as $value){
                    $userCompanyName = $value->companyName;
                }
                

                $url = base_url('documents/edit/'.$insertId);
                //$message = "Please activate the account ".$url;
                
                $message = 'Hello! <br> <br>
                Document uploaded by '.$userFirstName.' '.$userLastName.'
                <br><br>Document Name: '.$docName.'
                <br>Company Name: '.$userCompanyName.'
                <br><br>Please active this document by this link:<a href = "'.$url.'"> Click Here</a>';
                
                $email = \Config\Services::email();
                $email->setFrom('gert@gsdm.co.za', 'HSEQ User');
                // $email->setTo('gert@gsdm.co.za');
                 $email->setTo('gert@gsdm.co.za.com');
                $email->setSubject('HSEQ Document');
                $email->setMessage($message);
                // $email->send();

                 if ($email->send()) 
                {
                    echo 'Email successfully sent';
                    //return redirect()->to('userdocs');
                } 
                else 
                {
                    $data = $email->printDebugger(['headers']);
                    print_r($data);
                }

            
            if($insertId > 0){
                $session->setFlashdata('session', "Successfully added new Document");
                return redirect()->to('userdocs');
            }
            else{
                $session->setFlashdata('session',"document not added Successfully");
                return redirect()->to('userdocs');
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
        $this->render_user_template('User/documents/add',$this->data);
    }

    public function getCompany(){
        $id = $_POST['id'];

        //$model_comp = new UserCompanyModel;
        //$comid = $model_comp->where('company_id',$id)->findall();
        $db = \Config\Database::connect();
        $builder = $db->table('user_company');
        $builder->select('*','Company. companyName as companyName');
        $builder->join('Company','Company.id = user_company.company_id','left');
        $builder->where('user_id',$id);
        $query = $builder->get();
        $result = $query->getResultArray();
        echo json_encode($result);
    }
}
?>