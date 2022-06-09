<?php 
namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $DBGroup              = 'default';
	protected $table                = 'Users';
	protected $primaryKey           = 'userID';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true; 
 
	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;
	protected $allowedFields = [  'email', 'pwd', 'userTypeID', 'companyId','firstName', 'isActive', 'lastName', 'profilePic',  'lastLogin',  'dateAdded'];


	public function get_all_data($selectFields,$whereData,$whereNotData,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$group_by)
    {   
        $this->make_query($selectFields,$whereData,$whereNotData,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$group_by);

        return $this->countAllResults();
    }


    public function getActionLink($path,$id,$type,$view=null,$userdelete=null){

         $actionLinkVar = '';  

        $actionLinkVar .= '<a title="Edit Customer" href="' . base_url( 'users/edit/'.$id). '" class="btn btn-warning" style="margin: 0px 5px 5px 0px;padding: 4px 9px;font-size: 14px;"><i class="fa fa-edit"></i></a>';

        if($userdelete!=1){
            $actionLinkVar .= '<a href="' . base_url( 'users/delete/'.$id). '" title="Delete User" class="btn btn-danger deleteData deleteUsers" style="margin: 0px 5px 5px 0px;padding: 4px 9px;font-size: 14px;" data-id="' . $id . '"><i class="fa fa-trash"></i></a>';
        }
 
        return $actionLinkVar;

    }

 	public function get_filtered_data($selectFields,$whereData,$whereNotData,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$group_by)
    {
        $this->make_query($selectFields,$whereData,$whereNotData,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$group_by);
        return $this->countAllResults();
        //return $query->countResultAll();
    }

    public function make_datatables($selectFields,$whereData,$whereNotData,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$group_by=null,$orwhere=null)
    {
         $this->make_query($selectFields,$whereData,$whereNotData,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$group_by,$orwhere);

        $result = $this->findAll($_POST['length'], $_POST['start']);
        return  $result ;
        
    }

    public function make_query($selectFields,$whereData,$whereNotData,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$group_by=null,$orwhere=null)
    {   
       
        //table 

        //join table
        if(!empty($joinTableArray)){            
            foreach ($joinTableArray as $joinKey => $joinValue) {
                $this->join($joinValue['joinTable'],$joinValue['joinTable'].".".$joinValue['joinField']." = ".$joinValue['relatedJoinTable'].".".$joinValue['relatedJoinField'],$joinValue['type']);  
            } 
        }        
        
         // select data
        foreach ($selectFields as $selectName) {
            $this->select($selectName);
        }

        
        //equal data condition
        if(!empty($whereData)){            
            foreach ($whereData as $fieldName => $fieldValue) {
                $this->where($fieldName,$fieldValue);             
            } 
        }

        //or equal data condition
        if(!empty($orwhere)){            
            foreach ($orwhere as $fieldName => $fieldValue) {
                $this->orWhere($fieldName,$fieldValue);             
            } 
        }

        //not equal data condition
        if(!empty($whereNotData)){            
            foreach ($whereNotData as $fieldName => $fieldValue) {
                $this->where($fieldName.' !=', $fieldValue);           
            } 
        }

        //not in data condition
        if(!empty($notIn)){            
            foreach ($notIn as $notName => $notValue) {

                foreach ($notValue as $notValue) {

                    $this->where($notName.' !=', $notValue);
                }
            } 
        }

        //search
        if((isset($_POST["search"]["value"])) && ($_POST["search"]["value"] != '')) {

            $searchString = $_POST["search"]["value"];

            $searchArray = array();
            if(!empty($searchColumn)){            
                foreach ($searchColumn as $searchKey => $searchValue) {

                    $searchArray[] = $searchValue." LIKE '%".$searchString."%'";    
                } 

                if(!empty($searchArray)){
                    $searchQueryString = implode(" OR ", $searchArray);

                    $this->where("(".$searchQueryString.")", NULL, FALSE);
                }
            }
        }

          if(!empty($group_by)){            
            foreach ($group_by as $fieldName => $fieldValue) {
                $this->groupBy($fieldName,$fieldValue);             
            } 
        }
        //order by
        if (isset($_POST['order'][0]['column'])) {
            $this->orderBy($orderColumn[$_POST['order'][0]['column']], $_POST['order']['0']['dir']);
        } else {
            if($orderBy != ''){            
                foreach ($orderBy as $orderFieldName => $orderFieldType) {
                     $this->orderBy($orderFieldName,$orderFieldType);             
                } 
            }
        }        

        // $sql = $this->getCompiledSelect(); 
        // echo $sql;
        // exit;

    }
}
 
