<?php 
namespace App\Models;

use CodeIgniter\Model;

class WorkflowModel extends Model
{
    protected $DBGroup              = 'default';
	protected $table                = 'document_workfolw';
	protected $primaryKey           = 'id';
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
	protected $allowedFields = ['document_name', 'usertype_id', 'category_id', 'subcategory_id','document_files', 'comments','company_id','start_date','expire_date','is_update','is_active','is_deleted'];


	public function get_all_data($selectFields,$whereData,$whereNotData,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn)
    {   
        $this->make_query($selectFields,$whereData,$whereNotData,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);

        return $this->countAllResults();
    }


    public function getActionLink($path,$id,$type,$view=null,$userdelete=null){

         $actionLinkVar = '';  

        $actionLinkVar .= '<a title="Edit Workflow" href="' . base_url( 'workflow/edit/'.$id). '" class="btn btn-warning" style="margin: 0px 5px 5px 0px;padding: 4px 9px;font-size: 14px;"><i class="fa fa-edit"></i></a>';

        if($userdelete!=1){
            $actionLinkVar .= '<a href="' . base_url( 'workflow/delete/'.$id). '" title="Delete Document" class="btn btn-danger deleteData workflowDelete" style="margin: 0px 5px 5px 0px;padding: 4px 9px;font-size: 14px;" data-id="' . $id . '"><i class="fa fa-trash"></i></a>';
        }
 
        return $actionLinkVar;

    }
     public function getActionLinkData($path,$id,$type,$view=null,$userdelete=null){

         $actionLinkVar = '';  

        $actionLinkVar .= '<a title="Edit Workflow" href="' . base_url( 'workflow/edit/'.$id). '" class="btn btn-warning" style="margin: 0px 5px 5px 0px;padding: 4px 9px;font-size: 14px;"><i class="fa fa-edit"></i></a>';

        if($userdelete!=1){
            $actionLinkVar .= '<a href = "' . base_url( '/workflow/view_documents/'.$id). '" class="btn btn-primary" style="margin: 0px 5px 5px 0px;padding: 4px 9px;font-size: 14px;" target="_blank"><i class="fa fa-file"></i></a>';
        }
 
        return $actionLinkVar;

    }

    public function getActionLinkFile($path,$id,$type,$view=null,$userdelete=null){

         $actionLinkVar = ''; 
        
            $actionLinkVar .= '<a href = "' . base_url( '/workflow/view_documents/'.$id). '" class="btn btn-primary" style="margin: 0px 5px 5px 0px;padding: 4px 9px;font-size: 14px;" target="_blank"><i class="fa fa-file"></i></a>';
        
 
        return $actionLinkVar;

    }

    public function getActionLinkNew($path,$id,$type,$view=null,$userdelete=null){

         $actionLinkVar = '';  

        // $actionLinkVar .= '<a title="Edit Workflow" href="' . base_url( 'workflow/edit/'.$id). '" class="" style="margin: 0px 5px 5px 0px;padding: 4px 9px;font-size: 12px;"><i class="fa-solid fa-upload"></i></a>';
         $actionLinkVar .= '<a href = "' . base_url( 'workflow/edit/'.$id). '" class="btn btn-warning" style="margin: 0px 5px 5px 0px;padding: 4px 9px;font-size: 10px;" target="_blank"><i class="fa fa-upload"></i></a>';

       
        $actionLinkVar .= '<a href = "' . base_url( '/workflow/view_documents/'.$id). '" class="btn btn-primary" style="margin: 0px 5px 5px 0px;padding: 4px 9px;font-size: 10px;" target="_blank"><i class="fa fa-file"></i></a>';

        $actionLinkVar .= '<a href="' . base_url( 'workflow/delete/'.$id). '" title="Delete Document" class="btn btn-danger deleteData workflowDelete" style="margin: 0px 5px 5px 0px;padding: 4px 9px;font-size: 10px;" data-id="' . $id . '"><i class="fa fa-trash"></i></a>';
        
 
        return $actionLinkVar;

    }

 	public function get_filtered_data($selectFields,$whereData,$whereNotData,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn)
    {
        $this->make_query($selectFields,$whereData,$whereNotData,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);
        return $this->countAllResults();
        //return $query->countResultAll();
    }

    public function make_datatables($selectFields,$whereData,$whereNotData,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$orwhere=null)
    {
         $this->make_query($selectFields,$whereData,$whereNotData,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$orwhere);

        $result = $this->findAll($_POST['length'], $_POST['start']);
        return  $result ;
        
    }

    public function make_query($selectFields,$whereData,$whereNotData,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$orwhere=null)
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
 
