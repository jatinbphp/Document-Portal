<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends Admin_Controller  {
 
 	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in(); 
		$this->data['page_title'] = 'Admin Dashboard';
		$this->global_tblusers = 'MaleCandidates';
		$this->global_tblfemaleusers = 'FemaleCandidates';
		$this->global_tblconsultants = 'Consultants';
		$this->load->model('model_search'); 
		$this->load->model('model_common'); 
		$this->load->helper('date');
		$this->data['view_path'] = 'admin/search';
	}

	public function index()
	{ 
	  	$conwhereEqual = array('status'=>1,'deleted'=>0);          
		$conselectColumn['*'] = '*';  
		$conorder['firstName'] = 'ASC'; 
		$this->data['consultants'] = $this->model_common->getMultipleDataByField('Consultants',$conselectColumn,$conwhereEqual,$conorder);

        $this->data['country'] = $this->model_common->get_all_records('Country');

        $cwhereEqual = array('isActive'=>1);        
        $cselectColumn['*'] = '*'; 
        $this->data['CitizenshipStatus'] = $this->model_common->getMultipleDataByField('CitizenshipStatus',$cselectColumn,$cwhereEqual);

        $dwhereEqual = array('isActive'=>1);        
        $dselectColumn['*'] = '*'; 
        $this->data['DurationOfStay'] = $this->model_common->getMultipleDataByField('DurationOfStay',$dselectColumn,$dwhereEqual);

        $etwhereEqual = array('isActive'=>1);        
        $etselectColumn['*'] = '*'; 
        $etorder['ethnicityName'] = 'ASC'; 
        $this->data['Ethnicity'] = $this->model_common->getMultipleDataByField('Ethnicity',$etselectColumn,$etwhereEqual,$etorder);

        $hiwhereEqual = array('gender'=>'M');        
        $hiselectColumn['*'] = '*';  
        $hiorder['hijabPreferenceName'] = 'ASC'; 
        $this->data['HijabPreference'] = $this->model_common->getMultipleDataByField('HijabPreference',$hiselectColumn,$hiwhereEqual,$hiorder);

        $hiwhereEqual = array('gender'=>'F');        
        $hiselectColumn['*'] = '*';  
        $hiorder['hijabPreferenceName'] = 'ASC'; 
        $this->data['HijabPreferenceF'] = $this->model_common->getMultipleDataByField('HijabPreference',$hiselectColumn,$hiwhereEqual,$hiorder);

        $EdwhereEqual = array('isActive'=>1);          
        $EdselectColumn['*'] = '*';  
        $Edorder['educationLevelName'] = 'ASC'; 
        $this->data['EducationLevels'] = $this->model_common->getMultipleDataByField('EducationLevels',$EdselectColumn,$EdwhereEqual,$Edorder);

        $MawhereEqual = array('isActive'=>1);          
        $MaselectColumn['*'] = '*';  
        $Maorder['maritalStatusName'] = 'ASC'; 
        $this->data['MaritalStatus'] = $this->model_common->getMultipleDataByField('MaritalStatus',$MaselectColumn,$MawhereEqual,$Maorder);

        $LiwhereEqual = array('isActive'=>1,'gender'=>'M');          
        $LiselectColumn['*'] = '*';  
        $Liorder['id'] = 'DESC'; 
        $this->data['LivingArrangements'] = $this->model_common->getMultipleDataByField('LivingArrangements',$LiselectColumn,$LiwhereEqual,$Liorder);

        $agwhereEqual = array('isActive'=>1);          
        $agselectColumn['*'] = '*';  
        $agorder['id'] = 'DESC'; 
        $this->data['AgeRange'] = $this->model_common->getMultipleDataByField('AgeRange',$agselectColumn,$agwhereEqual,$agorder);

        $MowhereEqual = array('isActive'=>1);          
        $MoselectColumn['*'] = '*';  
        $Moorder['id'] = 'DESC'; 
        $this->data['MosqueVisits'] = $this->model_common->getMultipleDataByField('MosqueVisits',$MoselectColumn,$MowhereEqual,$Moorder);
      
        $IhwhereEqual = array('isActive'=>1);          
        $IhselectColumn['*'] = '*';  
        $Ihorder['id'] = 'DESC'; 
        $this->data['InterestsHobbies'] = $this->model_common->getMultipleDataByField('InterestsHobbies',$IhselectColumn,$IhwhereEqual,$Ihorder);

        $cwhereEqual = array('deleted'=>0);        
        $cselectColumn['*'] = '*'; 
        $this->data['pdfFiles'] = $this->model_common->getMultipleDataByField('pdfForms',$cselectColumn,$cwhereEqual);

	 	$this->render_admin_layouts('admin/search/index', $this->data);
	 	
 	} 

 

    public function fetch_male_candidates(){

        // equal condition
        $whereEqual = array();
        $orwhere = array();
 
	    $start_date = $this->input->post('start_date'); 
	    $end_date = $this->input->post('end_date'); 
	   	 
	       
 		if((isset($start_date) && $start_date > 0) && isset($end_date) && $end_date > 0 ){
 			$whereEqual  = array($this->global_tblusers.'.registrationDate >= ' => date('Y-m-d',strtotime($start_date)), $this->global_tblusers.'.registrationDate <= '=> date('Y-m-d',strtotime($end_date) )); 
 			  
 		}


		$countryOfResidence = $this->input->post('countryOfResidence');
		$personalEthnicityID = $this->input->post('personalEthnicityID');
		$ageRange = $this->input->post('ageRange');
		$citizenshipStatusID = $this->input->post('citizenshipStatusID');
		$durationOfStayID = $this->input->post('durationOfStayID');
		$highestEducationLevelID = $this->input->post('highestEducationLevelID');
		$willingToRelocate = $this->input->post('willingToRelocate');
		$maritalStatusID = $this->input->post('maritalStatusID'); 
		$hijabPreferenceID = $this->input->post('hijabPreferenceID');
        $status = $this->input->post('status');

     	$from_height = $this->input->post('from_height');
		$to_height = $this->input->post('to_height');

      	$from_age = $this->input->post('from_age');
      	$to_age = $this->input->post('to_age');

      	$reason = $this->input->post('reason');

		$this->global_tblusers = 'MaleCandidates';
		$this->global_tblfemaleusers = 'FemaleCandidates';
		$this->global_tblconsultants = 'Consultants';


		 if($from_age > 0 && $to_age > 0 ) {

			$frombirthdate = '';
			$tobirthdate = '';
			if(isset($from_age) && $from_age > 0 ){
			$frombirthdate =   date('Y-01-01', strtotime('-'.$from_age.' years'));
			}  

			if(isset($to_age) && $to_age > 0 ){
				$tobirthdate = date('Y-01-01', strtotime('-'.$to_age.' years')); 

			}  

	 		$whereEqual  = array($this->global_tblusers.'.birthdate <= ' => $frombirthdate, $this->global_tblusers.'.birthdate >= '=> $tobirthdate ); 
	 	} 

	 	/*if(isset($hijabPreferenceID) && $hijabPreferenceID > 0 ){
 			 $whereEqual[$this->global_tblusers.'.hijabPreferenceID'] = $hijabPreferenceID;
 		}*/

 		if(isset($heightCM) && $heightCM > 0 ){
 			 $whereEqual[$this->global_tblusers.'.heightCM'] = $heightCM;
 		}

 		if(isset($reason) && $reason  != '' ){
 			 $whereEqual[$this->global_tblusers.'.delete_reason'] = $reason;
 		}
		 
        if(!empty($hijabPreferenceID)){
            $orwhere['hijabPreferenceID'] = implode(",", $hijabPreferenceID);
        }

        if(!empty($countryOfResidence)){
            $countryOfResidenceArray = explode(",", $countryOfResidence);

            $countryOfResidenceArrayvar = array();
            foreach ($countryOfResidenceArray as $key => $value) {
                if(!empty($value)){
                    $countryOfResidenceArrayvar[] = $value;
                }
                
            }

            if(!empty($countryOfResidenceArrayvar)){
                $orwhere['countryOfResidence'] = implode(",", $countryOfResidenceArrayvar);
            }

        }

        if(!empty($personalEthnicityID)){
            $personalEthnicityIDArray = explode(",", $personalEthnicityID);

            $personalEthnicityIDArrayvar = array();
            foreach ($personalEthnicityIDArray as $key => $value) {
                if(!empty($value)){
                    $personalEthnicityIDArrayvar[] = $value;
                }
                
            }

            if(!empty($personalEthnicityIDArrayvar)){
                $orwhere['personalEthnicityID'] = implode(",", $personalEthnicityIDArrayvar);
            }

        }
 		
 		/*if(isset($countryOfResidence) && $countryOfResidence > 0 ){
		 	$whereEqual[$this->global_tblusers.'.countryOfResidence'] = $countryOfResidence;
 		}*/

 		/*if(isset($personalEthnicityID) && $personalEthnicityID > 0 ){
 			$whereEqual[$this->global_tblusers.'.personalEthnicityID'] = $personalEthnicityID;
 		}*/

 		/*if(isset($ageRange) && $ageRange > 0 ){
 			$whereEqual['MC_AgeRanges.ageRangeID'] = $ageRange;
 		}*/

        if(!empty($citizenshipStatusID)){
            $orwhere['citizenshipStatusID'] = implode(",", $citizenshipStatusID);
        }
		/*if(isset($citizenshipStatusID) && $citizenshipStatusID > 0 ){
 			$whereEqual[$this->global_tblusers.'.citizenshipStatusID'] = $citizenshipStatusID;
 		} */

		if(isset($durationOfStayID) && $durationOfStayID > 0 ){
 			$whereEqual[$this->global_tblusers.'.durationOfStayID'] = $durationOfStayID;
 		} 

		if(isset($highestEducationLevelID) && $highestEducationLevelID > 0 ){
 			$whereEqual[$this->global_tblusers.'.highestEducationLevelID'] = $highestEducationLevelID;
 		} 

 		if(isset($willingToRelocate) && $willingToRelocate !='' ){
 			$whereEqual[$this->global_tblusers.'.willingToRelocate'] = $willingToRelocate;
 		} 

		if(isset($maritalStatusID) && $maritalStatusID !='' ){
 			$whereEqual[$this->global_tblusers.'.maritalStatusID'] = $maritalStatusID;
 		} 

        if(isset($status) && $status !='' ){
            $whereEqual[$this->global_tblusers.'.status'] = $status;
        } 

 		if($from_height > 0 && $to_height > 0 ) {

		    $fheight = '';
		    $theight = '';
		    if(isset($from_height) && $from_height > 0 ){
		        $fheight =   $from_height;
		    }  

		    if(isset($to_height) && $to_height > 0 ){
		        $theight = $to_height;
		    }  

		    $whereEqual  = array($this->global_tblusers.'.heightCM >= ' => $fheight, $this->global_tblusers.'.heightCM <= '=> $theight ); 
		} 



        // not equal condition
        $whereNotEqual = array();

        $notIn = array();     

        // select data
        $selectColumn[$this->global_tblusers.'.*'] = $this->global_tblusers.'.*';
        $selectColumn['Consultants.firstName'] =  'Consultants.firstName as cfname';
        $selectColumn['Consultants.lastName'] =  'Consultants.lastName as clname';
        $selectColumn['Consultants.type'] =  'Consultants.type as consultants_type';

        // order column
        $orderColumn = array("", "", $this->global_tblusers.".id", $this->global_tblusers.".registrationDate", $this->global_tblusers.".firstName", $this->global_tblusers.".lastName", "", "", $this->global_tblusers.".last_login");

        // search column
        $searchColumn = array($this->global_tblusers.".id", $this->global_tblusers.".registrationDate", $this->global_tblusers.".firstName", $this->global_tblusers.".lastName");

        // order by
        /*$orderBy = array($this->global_tblusers.'.registrationDate' => "DESC");
        $orderBy = array($this->global_tblusers.'.status' =>  "DESC");*/

        // join table
        $joinTableArray = array();
        /*$joinTableArray = array(array("joinTable"=>'Consultants', "joinField"=>"id", "relatedJoinTable"=>$this->global_tblusers, "relatedJoinField"=>"consultant_id","type"=>"left"), 
        array("joinTable"=>'MC_AgeRanges', "joinField"=>"mcid", "relatedJoinTable"=>$this->global_tblusers, "relatedJoinField"=>"id","type"=>"left"));*/

        $joinTableArray = array(array("joinTable"=>'Consultants', "joinField"=>"id", "relatedJoinTable"=>$this->global_tblusers, "relatedJoinField"=>"consultant_id","type"=>"left"));

        $fetch_data = $this->model_common->make_datatables($this->global_tblusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$orwhere);
    	 
    	 // echo "<pre>";print_r($fetch_data);
    	 // exit();
     
        $data = array();
        $countryliving = '';
        foreach ($fetch_data as $row) {
            $sub_array = array();

            $sub_array[] =  '<td><label class="form-controlNew"><input type="checkbox" class="checkSingle" name="custom_check[]" id="custom_check_'.$row->id.'" value="'.$row->id.'"/></label>';

            if($row->primimage && file_exists( 'uploads/male/'.$row->primimage) ){
                $sub_array[] =  '<img class="myImg" onclick="myFunction('.$row->id.');" id="myImg'.$row->id.'" height="50" src="'.base_url('uploads/male/'.$row->primimage).'">';
            } else {
                $sub_array[] =  '<img height="50" src="'.base_url('assets/images/male.jpeg').'">';
            }

            $sub_array[] = $row->id;
            
            if($row->deleted == 1){
            	$sub_array[] = '<del class="text-danger">'.$this->model_common->dateFormat($row->registrationDate).'</del>';
	            $sub_array[] = '<del class="text-danger">'.$row->firstName.'</del>';
	            $sub_array[] = '<del class="text-danger">'.$row->lastName.'</del><br> <span class="text-muted">Reason : '.$row->delete_reason.'</span>';
        	} else {
            	$sub_array[] = $this->model_common->dateFormat($row->registrationDate);
	    		$sub_array[] = $row->firstName;
	        	$sub_array[] = $row->lastName;
        	}
            
            if($row->consultants_type==0){
                $cat_type = "G";
            } else if($row->consultants_type==1){
                $cat_type = "T";
            } else {
                $cat_type = "G & T";
            }
            
            //$cat_type = ($row->consultant_cat_id==1) ? "G" : "T";
            if (!empty($row->cfname) && !empty($row->clname)) {
                $sub_array[] = $cat_type." : ".$row->cfname .' '.$row->clname; 
            }else{
                $sub_array[] = '';
            }

            $changeStatusLink = $this->model_common->getChangeStatusLink($this->global_tblusers,$row->id,$row->status);
            $sub_array[] = $changeStatusLink;
            $sub_array[] =  isset($row->last_login) ? date('M, d, Y h:i a',strtotime($row->last_login)) : '';

             	$cwhereEqual['id'] = $row->countryOfResidence ;          
                $cselectColumn['countryName'] = 'countryName';   
                $countryliving = $this->model_common->getSingleDataByField('Country',$cselectColumn,$cwhereEqual ); 

                 $cwhereEqual['id'] = $row->citizenshipStatusID;        
                $celectColumn['statusName'] = 'statusName'; 
                $CitizenshipStatus = $this->model_common->getSingleDataByField('CitizenshipStatus',$celectColumn,$cwhereEqual);

                 $dwhereEqual['id'] = $row->durationOfStayID;         
                $dselectColumn['desc'] = 'desc'; 
                $DurationOfStay = $this->model_common->getSingleDataByField('DurationOfStay',$dselectColumn,$dwhereEqual);

                $Ethnicity = '-';
                if(!empty($row->personalEthnicityID)){
                    $EthnicityArray = $this->model_common->getEthnicityCommon($row->personalEthnicityID);

                    $Ethnicity = implode(", ", $EthnicityArray);
                }

                /*$etwhereEqual['id'] = $row->personalEthnicityID;        
                $etselectColumn['*'] = '*'; 
                $etorder['ethnicityName'] = 'ASC'; 
                $Ethnicity = $this->model_common->getSingleDataByField('Ethnicity',$etselectColumn,$etwhereEqual,$etorder);*/

                 $EdwhereEqual['id'] = $row->highestEducationLevelID;         
                $EdselectColumn['educationLevelName'] = 'educationLevelName';  
                $Edorder['educationLevelName'] = 'ASC'; 
                $EducationLevels = $this->model_common->getSingleDataByField('EducationLevels',$EdselectColumn,$EdwhereEqual,$Edorder);

                 $MawhereEqual['id'] = $row->maritalStatusID;          
                $MaselectColumn['maritalStatusName'] = 'maritalStatusName';  
                $Maorder['maritalStatusName'] = 'ASC'; 
                $MaritalStatus= $this->model_common->getSingleDataByField('MaritalStatus',$MaselectColumn,$MawhereEqual,$Maorder);

                $sEthnicity = '-';
                if(!empty($row->spouseEthnicityID)){
                    $sEthnicityArray = $this->model_common->getEthnicityCommon($row->spouseEthnicityID);

                    $sEthnicity = implode(", ", $sEthnicityArray);
                }

                /*  $setwhereEqual['id'] = $row->spouseEthnicityID;        
                $setselectColumn['ethnicityName'] = 'ethnicityName';  
                $sEthnicity = $this->model_common->getSingleDataByField('Ethnicity',$setselectColumn,$setwhereEqual );*/

                   $hiwhereEqual['gender'] = 'M';        
                   $hiwhereEqual['id'] = $row->hijabPreferenceID;        
                $hiselectColumn['hijabPreferenceName'] = 'hijabPreferenceName';   
                $HijabPreference = $this->model_common->getSingleDataByField('HijabPreference',$hiselectColumn,$hiwhereEqual );

				$alorder = array();
	        	$lselectColumn['LivingArrangements.desc'] = ' LivingArrangements.desc  as description';
	        	$afwhereEqual['MC_AfterMarriageLiving.mcid'] = $row->id;
	        	$afwhereEqual['LivingArrangements.isActive'] = 1;
	        	$afjoinTableArray = array(array("joinTable"=>'LivingArrangements', "joinField"=>"id", "relatedJoinTable"=>'MC_AfterMarriageLiving', "relatedJoinField"=>"livingArrangementsID","type"=>"left"));
			 	$LivingArrangements = $this->model_common->get_table_records('MC_AfterMarriageLiving',$lselectColumn,$afwhereEqual,$afjoinTableArray,$alorder);   


			 	$alsorder = array();
	        	$afsselectColumn['AfterMarriagePreferenceMale.desc'] = ' AfterMarriagePreferenceMale.desc  as description';
	        	$afswhereEqual['MC_AfterSpousePrefer.mcid'] = $row->id;
	        	$afswhereEqual['AfterMarriagePreferenceMale.isActive'] = 1;
	        	$afsjoinTableArray = array(array("joinTable"=>'AfterMarriagePreferenceMale', "joinField"=>"id", "relatedJoinTable"=>'MC_AfterSpousePrefer', "relatedJoinField"=>"afterMarriagePreferenceMaleID","type"=>"left"));
			 	$AfterSpousePrefer = $this->model_common->get_table_records('MC_AfterSpousePrefer',$afsselectColumn,$afswhereEqual,$afsjoinTableArray,$alsorder); 

			 	$agsorder = array();
	        	$agsselectColumn['AgeRange.desc'] = ' AgeRange.desc  as description';
	        	$agswhereEqual['MC_AgeRanges.mcid'] = $row->id;
	        	$agswhereEqual['AgeRange.isActive'] = 1;
	        	$agsjoinTableArray = array(array("joinTable"=>'AgeRange', "joinField"=>"id", "relatedJoinTable"=>'MC_AgeRanges', "relatedJoinField"=>"ageRangeID","type"=>"left"));
			 	$AgeRanges = $this->model_common->get_table_records('MC_AgeRanges',$agsselectColumn,$agswhereEqual,$agsjoinTableArray,$agsorder);   
        			
			  	$mvsorder = array();
	        	$mvsselectColumn['MosqueVisits.desc'] = ' MosqueVisits.desc  as description';
	        	$mvswhereEqual['MC_MosqueVisits.mcid'] = $row->id;
	        	$mvswhereEqual['MosqueVisits.isActive'] = 1;
	        	$mvsjoinTableArray = array(array("joinTable"=>'MosqueVisits', "joinField"=>"id", "relatedJoinTable"=>'MC_MosqueVisits', "relatedJoinField"=>"mosqueVisitID","type"=>"left"));
			 	$MosqueVisits = $this->model_common->get_table_records('MC_MosqueVisits',$mvsselectColumn,$mvswhereEqual,$mvsjoinTableArray,$mvsorder);


			 	$ihorder = array();
	        	$ihselectColumn['InterestsHobbies.desc'] = ' InterestsHobbies.interestsHobbiesName  as description';
	        	$ihwhereEqual['MC_InterestHobbies.mcid'] = $row->id;
	        	$ihwhereEqual['InterestsHobbies.isActive'] = 1;
	        	$ihjoinTableArray = array(array("joinTable"=>'InterestsHobbies', "joinField"=>"id", "relatedJoinTable"=>'MC_InterestHobbies', "relatedJoinField"=>"hobbiesID","type"=>"left"));
			 	$InterestHobbies = $this->model_common->get_table_records('MC_InterestHobbies',$ihselectColumn,$ihwhereEqual,$ihjoinTableArray,$ihorder);
			
			$userdelete = ''; 
           	if($row->deleted == 1){
           		$userdelete = 2;
           	} else {
           		$userdelete = 1;
           	}
            $actionLink = $this->model_common->getActionLink('users/edit/',$row->id,'male',1,$userdelete);

            $actionLink .='<div id="userdelete_'.$row->id.'" class="modal fade " role="dialog">
						<div class="modal-dialog modal-lg"> 
							<div class="modal-content"> 
						
								<div class="modal-header"> 
									<h4 class="modal-title">Delete Reason</h4>
								</div>
								<div class="modal-body"> 
								<form id="deleteuser" class="deleteuser" method="post">
									<input type="hidden" name="delete_user_id" id="delete_user_id" value="'.$row->id.'">
							                  <div class="form-check">
				                      <label class="form-check-label">
				                        <input type="radio" class="form-check-input" name="reason" value="Married/engaged through SC">Married/engaged through SC
				                      </label>
				                    </div>

				                        <div class="form-check">
				                      <label class="form-check-label">
				                        <input type="radio" class="form-check-input" name="reason" value="Married/engaged outside SC">Married/engaged outside SC
				                      </label>
				                    </div>

				                      <div class="form-check">
				                      <label class="form-check-label">
				                        <input type="radio" class="form-check-input" name="reason" value="AWOL - not responding">AWOL - not responding
				                      </label>
				                    </div>
 

				                     <div class="form-check">
				                      <label class="form-check-label">
				                        <input type="radio" class="form-check-input" name="reason" value="Removed from the system">Removed from the system
				                      </label>
				                    </div>

				                     <div class="form-check">
				                      <label class="form-check-label">
				                        <input type="radio" class="form-check-input" name="reason" value="Inactive">Inactive
				                      </label>
				                    </div>

				                    <div class="form-check">
				                      <label class="form-check-label">
				                        <input type="radio" class="form-check-input" name="reason" value="Holding Zone">Holding Zone
				                      </label>
				                    </div>
			                     <button  type="button" id="submitreason" data-uid="'.$row->id.'" class="btn btn-success">Remove User</button>
			                 </form>
								<div>
								    </div>
										<div class="modal-footer">
										  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div></div></div></div>';

			  $actionLink .='<div id="changepassword_'.$row->id.'" class="modal fade " role="dialog">
						<div class="modal-dialog modal-lg"> 
							<div class="modal-content"> 
						
								<div class="modal-header"> 
									<h4 class="modal-title">Reset Password</h4>
								</div>
								<div class="modal-body"> 
								<form name="resetpassform" id="resetpassword_'.$row->id.'" class="resetpassword" method="post">

								<div class="form-group">
							    <label for="exampleInputPassword1">Password</label>
							    <input type="text" id="password" required name="password" >
							    <br><br><lable>try auto generated password : '.get_random_code().'</label>
							  </div> 
								<br>
			                     <button  type="button" id="submitpassword" data-utype="male" data-uid="'.$row->id.'" class="btn btn-success submitpassword">Change Password</button>
			                 </form>
								<div>
								    </div>
										<div class="modal-footer">
										  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div></div></div></div>';
								
            $actionLink .='<div id="view_users_detail_'.$row->id.'" class="modal fade " role="dialog">
						<div class="modal-dialog modal-lg">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header"> 
									<h4 class="modal-title">Male Candidate Details</h4>
								</div>
								<div class="modal-body"> 
								<div class="table-responsive">
								    <table class="table  table-condensed"><tr> '; 
											$firstName = $row->firstName ? : "-";
											$actionLink .= '<td>First Name : </td><td>'.$firstName.'</td>'; 

											$lastName = $row->lastName ? : "-";
											$actionLink .= '<tr><td>Last Name :  </td><td>'.$lastName.'</td></tr>'; 

											$email = $row->email ? : "-";
											$actionLink .= '<tr><td>Email :  </td><td>'.$email.'</td></tr>';

											$birthdate = $row->birthdate ? date('d-m-Y',strtotime($row->birthdate)) : "-";
											$actionLink .= '<tr><td>Birthdate :  </td><td>'. $birthdate .'</td></tr>'; 

											 $fathersName = $row->fathersName ? : "-";
											$actionLink .= '<tr><td>Fathers Name :  </td><td>'.$fathersName.'</td></tr>'; 

											 $mothersName = $row->mothersName ? : "-";
											$actionLink .= '<tr><td>Mothers Name :  </td><td>'.$mothersName.'</td></tr>'; 

											 $cityOfResidence = $row->cityOfResidence ? : "-";
											$actionLink .= '<tr><td>City of Residence :  </td><td>'.$cityOfResidence.'</td></tr>'; 

											 $phone = $row->phone ? : "-";
											$actionLink .= '<tr><td>Phone :  </td><td>'.$phone.'</td></tr>'; 

											 @$countryOfResidence = $countryliving['countryName']   ?  $countryliving['countryName'] : "-";
											$actionLink .= '<tr><td>Country :  </td><td>'.$countryOfResidence.'</td></tr>'; 

											 @$heightCM = $row->heightCM ? : "-";
											$actionLink .= '<tr><td>Height Inches :  </td><td>'.$heightCM.'</td></tr>'; 

											@$citizenshipStatusID = $CitizenshipStatus['statusName'] ? : "-";
											$actionLink .= '<tr><td>Citizenship Status  :  </td><td>'.$citizenshipStatusID.'</td></tr>'; 

											@$durationOfStayID = $DurationOfStay['desc'] ? : "-";
											$actionLink .= '<tr><td>Duration of Stay :  </td><td>'.$durationOfStayID.'</td></tr>'; 

											//@$Ethnicity = $Ethnicity['ethnicityName'] ? : "-";
											$actionLink .= '<tr><td>Ethnicity  :  </td><td>'.$Ethnicity.'</td></tr>'; 	


											@$cityOfBirth = $row->cityOfBirth ? : "-";
											$actionLink .= '<tr><td>City of Birth :  </td><td>'.$cityOfBirth.'</td></tr>'; 


											@$areaOfStudy = $row->areaOfStudy ? : "-";
											$actionLink .= '<tr><td>Area of Study :  </td><td>'.$areaOfStudy.'</td></tr>'; 

											@$EducationLevels = $EducationLevels['educationLevelName'] ? : "-";
											$actionLink .= '<tr><td>Education Level   :  </td><td>'.$EducationLevels.'</td></tr>'; 	

											@$currentOccupation = $row->currentOccupation ? : "-";
											$actionLink .= '<tr><td>Current Occupation :  </td><td>'.$currentOccupation.'</td></tr>'; 

											@$MaritalStatus = $MaritalStatus['maritalStatusName'] ? : "-";
											$actionLink .= '<tr><td>Marital Status :  </td><td>'.$MaritalStatus.'</td></tr>'; 	

											

											@$willingToRelocate = $row->willingToRelocate ? : "-";
											$actionLink .= '<tr><td>Willing to Relocate :  </td><td>'.$willingToRelocate.'</td></tr>'; 
 
									 

											//@$sEthnicity = $sEthnicity['ethnicityName'] ? : "-";
											$actionLink .= '<tr><td>Spouse Ethnicity   :  </td><td>'.$sEthnicity.'</td></tr>'; 

											@$HijabPreference = $HijabPreference['hijabPreferenceName'] ? : "-";
											$actionLink .= '<tr><td>Hijab Preference     :  </td><td>'.$HijabPreference.'</td></tr>'; 

											@$hijabPreferenceAdditional = $row->hijabPreferenceAdditional ? : "-";
											$actionLink .= '<tr><td>Hijab Preference Additional :  </td><td>'.$hijabPreferenceAdditional.'</td></tr>';
 
											@$considerDivorcee = $row->considerDivorcee ? : "-";
											$actionLink .= '<tr><td>Consider Divorcee   :  </td><td>'.$considerDivorcee.'</td></tr>';

											@$mosqueVisitOther = $row->mosqueVisitOther ? : "-";
											$actionLink .= '<tr><td>Mosque Visit Other   :  </td><td>'.$mosqueVisitOther.'</td></tr>';

											@$myCharacteristics1 = $row->myCharacteristics1 ? : "-";
											$actionLink .= '<tr><td>My Characteristics 1   :  </td><td>'.$myCharacteristics1.'</td></tr>';

											@$myCharacteristics2 = $row->myCharacteristics2 ? : "-";
											$actionLink .= '<tr><td>My Characteristics 2   :  </td><td>'.$myCharacteristics2.'</td></tr>';

											@$myCharacteristics3 = $row->myCharacteristics3 ? : "-";
											$actionLink .= '<tr><td>My Characteristics 3   :  </td><td>'.$myCharacteristics3.'</td></tr>';

											@$preferences = $row->preferences ? : "-";
											$actionLink .= '<tr><td>Preferences   :  </td><td>'.$preferences.'</td></tr>';

											@$aboutMe = $row->aboutMe ? : "-";
											$actionLink .= '<tr><td>About Me   :  </td><td>'.$aboutMe.'</td></tr>'; 

											@$otherDetails = $row->otherDetails ? : "-";
											$actionLink .= '<tr><td>Other Details   :  </td><td>'.$otherDetails.'</td></tr>';


											if(!empty($LivingArrangements)){
		        		 	 
												$actionLink .= '<tr><td>Living Arrangements   : </td>';
												$afmvalues =array();
												foreach ($LivingArrangements as $key => $value) { 
												if($value > 0){
												 $actionLink .= ' <td>'. $value['description'].'</td> ';

													}
												}
												$actionLink .= '</tr>'; 
		        		 
		        							}

		        							if(!empty($AfterSpousePrefer)){
		        		 	 
												$actionLink .= '<tr><td>Living Style   : </td>';
												$afmvalues =array();
												foreach ($AfterSpousePrefer as $key => $value) { 
												if($value > 0){
												 $actionLink .= ' <td>'. $value['description'].'</td> ';

													}
												}
												$actionLink .= '</tr>'; 
		        		 
		        							}

		        							if(!empty($AgeRanges)){
		        		 	 
												$actionLink .= '<tr><td>Age Range : </td>';
												$afmvalues =array();
												foreach ($AgeRanges as $key => $value) { 
												if($value > 0){
												 $actionLink .= ' <td>'. $value['description'].'</td> ';

													}
												}
												$actionLink .= '</tr>'; 
		        		 
		        							}
 

		        						 	if(!empty($MosqueVisits)){
		        		 	 
												$actionLink .= '<tr><td>Mosque Visits : </td>';
												$afmvalues =array();
												foreach ($MosqueVisits as $key => $value) { 
													if($value > 0){
												 		$actionLink .= ' <td>'. $value['description'].'</td> '; 
													}
												}
												$actionLink .= '</tr>'; 
		        							}

		        							if(!empty($InterestHobbies)){
		        		 	 
												$actionLink .= '<tr><td>Interest Hobbies : </td>';
												$afmvalues =array();
												foreach ($InterestHobbies as $key => $value) { 
													if($value > 0){
												 		$actionLink .= ' <td>'. $value['description'].'</td> '; 
													}
												}
												$actionLink .= '</tr>'; 
		        							}
 

		        						  $interestsHobbiesOther = $row->interestsHobbiesOther ? : "-";
											$actionLink .= '<tr><td>Interests Hobbies Other   :  </td><td>'.$interestsHobbiesOther.'</td></tr>'; 
 

										 
											$actionLink .='</tr> 
										</table></div>
										<div class="modal-footer">
										  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>';


            	

            
            $sub_array[] = $actionLink;
            $data[] = $sub_array;
        }

        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->model_common->get_all_data($this->global_tblusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$orwhere),
            "recordsFiltered" => $this->model_common->get_filtered_data($this->global_tblusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$orwhere),
            "data" => $data,
        );
        echo json_encode($output);
        
    }


    public function female() {	
	 	 
	  
	 	$conwhereEqual = array('status'=>1,'deleted'=>0);          
		$conselectColumn['*'] = '*';  
		$conorder['firstName'] = 'ASC'; 
		$this->data['consultants'] = $this->model_common->getMultipleDataByField('Consultants',$conselectColumn,$conwhereEqual,$conorder);


         $this->data['country'] = $this->model_common->get_all_records('Country');


        $cwhereEqual = array('isActive'=>1);        
        $cselectColumn['*'] = '*'; 
        $this->data['CitizenshipStatus'] = $this->model_common->getMultipleDataByField('CitizenshipStatus',$cselectColumn,$cwhereEqual);

        $dwhereEqual = array('isActive'=>1);        
        $dselectColumn['*'] = '*'; 
        $this->data['DurationOfStay'] = $this->model_common->getMultipleDataByField('DurationOfStay',$dselectColumn,$dwhereEqual);

        $etwhereEqual = array('isActive'=>1);        
        $etselectColumn['*'] = '*'; 
        $etorder['ethnicityName'] = 'ASC'; 
        $this->data['Ethnicity'] = $this->model_common->getMultipleDataByField('Ethnicity',$etselectColumn,$etwhereEqual,$etorder);

        $hiwhereEqual = array('gender'=>'F');        
        $hiselectColumn['*'] = '*';  
        $hiorder['hijabPreferenceName'] = 'ASC'; 
        $this->data['HijabPreference'] = $this->model_common->getMultipleDataByField('HijabPreference',$hiselectColumn,$hiwhereEqual,$hiorder);

        $EdwhereEqual = array('isActive'=>1);          
        $EdselectColumn['*'] = '*';  
        $Edorder['educationLevelName'] = 'ASC'; 
        $this->data['EducationLevels'] = $this->model_common->getMultipleDataByField('EducationLevels',$EdselectColumn,$EdwhereEqual,$Edorder);

        $MawhereEqual = array('isActive'=>1);          
        $MaselectColumn['*'] = '*';  
        $Maorder['maritalStatusName'] = 'ASC'; 
        $this->data['MaritalStatus'] = $this->model_common->getMultipleDataByField('MaritalStatus',$MaselectColumn,$MawhereEqual,$Maorder);

        $LiwhereEqual = array('isActive'=>1,'gender'=>'F');          
        $LiselectColumn['*'] = '*';  
        $Liorder['id'] = 'DESC'; 
        $this->data['LivingArrangements'] = $this->model_common->getMultipleDataByField('LivingArrangements',$LiselectColumn,$LiwhereEqual,$Liorder);

        $agwhereEqual = array('isActive'=>1);          
        $agselectColumn['*'] = '*';  
        $agorder['id'] = 'DESC'; 
        $this->data['AgeRange'] = $this->model_common->getMultipleDataByField('AgeRange',$agselectColumn,$agwhereEqual,$agorder);

        $MowhereEqual = array('isActive'=>1);          
        $MoselectColumn['*'] = '*';  
        $Moorder['id'] = 'DESC'; 
        $this->data['MosqueVisits'] = $this->model_common->getMultipleDataByField('MosqueVisits',$MoselectColumn,$MowhereEqual,$Moorder);

	 	$this->render_admin_layouts('admin/female/index', $this->data);
	 	
 	} 

 
 

    public function fetch_female_candidates(){

        // equal condition
        $whereEqual = array( ); 
 		 $newuser = $this->input->post('newuser'); 

        // if($newuser == 1){
        // 	$date = date('Y-m-d', strtotime('-7 days')); 	
        // 	$whereEqual  = array($this->global_tblfemaleusers.'.deleted'=>'0', $this->global_tblfemaleusers.'.registrationDate   >= '=> $date );
        // }
   
 		if((isset($start_date) && $start_date > 0) && isset($end_date) && $end_date > 0 ){
 			$whereEqual  = array($this->global_tblfemaleusers.'.registrationDate >= ' => date('Y-m-d',strtotime($start_date)), $this->global_tblfemaleusers.'.registrationDate <= '=> date('Y-m-d',strtotime($end_date) )); 
 			  
 		}


	      $countryOfResidence = $this->input->post('countryOfResidence');
	      $personalEthnicityID = $this->input->post('personalEthnicityID');
	      $ageRange = $this->input->post('ageRange');
	      $citizenshipStatusID = $this->input->post('citizenshipStatusID');
	      $durationOfStayID = $this->input->post('durationOfStayID');
	      $highestEducationLevelID = $this->input->post('highestEducationLevelID');
	      $willingToRelocate = $this->input->post('willingToRelocate');
	      $maritalStatusID = $this->input->post('maritalStatusID');
	      $hijabPreferenceID = $this->input->post('hijabPreferenceID');
          $status = $this->input->post('status');
	       
	       $from_height = $this->input->post('from_height');
			$to_height = $this->input->post('to_height');

	      $from_age = $this->input->post('from_age');
	      $to_age = $this->input->post('to_age');

	      $reason = $this->input->post('reason');

	      if($from_age > 0 && $to_age > 0 ) {

			$frombirthdate = '';
			$tobirthdate = '';
			if(isset($from_age) && $from_age > 0 ){
			$frombirthdate =   date('Y-01-01', strtotime('-'.$from_age.' years'));
			}  

			if(isset($to_age) && $to_age > 0 ){
				$tobirthdate = date('Y-01-01', strtotime('-'.$to_age.' years')); 

			}  

	 		$whereEqual  = array($this->global_tblfemaleusers.'.birthdate <= ' => $frombirthdate, $this->global_tblfemaleusers.'.birthdate >= '=> $tobirthdate ); 
	 	}

	 	if($from_height > 0 && $to_height > 0 ) {

		    $fheight = '';
		    $theight = '';
		    if(isset($from_height) && $from_height > 0 ){
		        $fheight =   $from_height;
		    }  

		    if(isset($to_height) && $to_height > 0 ){
		        $theight = $to_height;
		    }  

		    $whereEqual  = array($this->global_tblfemaleusers.'.heightCM >= ' => $fheight, $this->global_tblfemaleusers.'.heightCM <= '=> $theight ); 
		} 

	 	/*if(isset($hijabPreferenceID) && $hijabPreferenceID > 0 ){
 			 $whereEqual[$this->global_tblfemaleusers.'.hijabPreferenceID'] = $hijabPreferenceID;
 		}*/

 		if(isset($heightCM) && $heightCM > 0 ){
 			 $whereEqual[$this->global_tblfemaleusers.'.heightCM'] = $heightCM;
 		}

 		if(isset($reason) && $reason  !='' ){
 			 $whereEqual[$this->global_tblfemaleusers.'.delete_reason'] = $reason;
 		}


        if(!empty($hijabPreferenceID)){
            $orwhere['hijabPreferenceID'] = implode(",", $hijabPreferenceID);
        }

        if(!empty($countryOfResidence)){
            $countryOfResidenceArray = explode(",", $countryOfResidence);

            $countryOfResidenceArrayvar = array();
            foreach ($countryOfResidenceArray as $key => $value) {
                if(!empty($value)){
                    $countryOfResidenceArrayvar[] = $value;
                }
                
            }

            if(!empty($countryOfResidenceArrayvar)){
                $orwhere['countryOfResidence'] = implode(",", $countryOfResidenceArrayvar);
            }

        }

        if(!empty($personalEthnicityID)){
            $personalEthnicityIDArray = explode(",", $personalEthnicityID);

            $personalEthnicityIDArrayvar = array();
            foreach ($personalEthnicityIDArray as $key => $value) {
                if(!empty($value)){
                    $personalEthnicityIDArrayvar[] = $value;
                }
                
            }

            if(!empty($personalEthnicityIDArrayvar)){
                $orwhere['personalEthnicityID'] = implode(",", $personalEthnicityIDArrayvar);
            }

        }

 		
 		/*if(isset($countryOfResidence) && $countryOfResidence > 0 ){
 			 $whereEqual[$this->global_tblfemaleusers.'.countryOfResidence'] = $countryOfResidence;
 		}

 		if(isset($personalEthnicityID) && $personalEthnicityID > 0 ){
 			$whereEqual[$this->global_tblfemaleusers.'.personalEthnicityID'] = $personalEthnicityID;
 		}*/

 		/*if(isset($ageRange) && $ageRange > 0 ){
 			$whereEqual['FC_AgeRanges.ageRangeID'] = $ageRange;
 		}*/

        if(!empty($citizenshipStatusID)){
            $orwhere['citizenshipStatusID'] = implode(",", $citizenshipStatusID);
        }

		/*if(isset($citizenshipStatusID) && $citizenshipStatusID > 0 ){
 			$whereEqual[$this->global_tblfemaleusers.'.citizenshipStatusID'] = $citizenshipStatusID;
 		}*/ 

		if(isset($durationOfStayID) && $durationOfStayID > 0 ){
 			$whereEqual[$this->global_tblfemaleusers.'.durationOfStayID'] = $durationOfStayID;
 		} 

		if(isset($highestEducationLevelID) && $highestEducationLevelID > 0 ){
 			$whereEqual[$this->global_tblfemaleusers.'.highestEducationLevelID'] = $highestEducationLevelID;
 		} 

 		if(isset($willingToRelocate) && $willingToRelocate !='' ){
 			$whereEqual[$this->global_tblfemaleusers.'.willingToRelocate'] = $willingToRelocate;
 		} 
 		
 		if(isset($countryOfResidence) && $countryOfResidence > 0 ){
 			 $whereEqual[$this->global_tblfemaleusers.'.countryOfResidence'] = $countryOfResidence;
 		}

 		if(isset($personalEthnicityID) && $personalEthnicityID > 0 ){
 			$whereEqual[$this->global_tblfemaleusers.'.personalEthnicityID'] = $personalEthnicityID;
 		}

 		if(isset($maritalStatusID) && $maritalStatusID !='' ){
 			$whereEqual[$this->global_tblusers.'.maritalStatusID'] = $maritalStatusID;
 		} 

 		if(isset($ageRange) && $ageRange > 0 ){
 			$whereEqual['FC_AgeRanges.ageRangeID'] = $ageRange;
 		}
    
        if(isset($status) && $status !='' ){
            $whereEqual[$this->global_tblfemaleusers.'.status'] = $status;
        }

 
        // not equal condition
        $whereNotEqual = array();

        $notIn = array();     


        // select data
        $selectColumn[$this->global_tblfemaleusers.'.*'] = $this->global_tblfemaleusers.'.*';
         $selectColumn['Consultants.firstName'] =  'Consultants.firstName as cfname';
        $selectColumn['Consultants.lastName'] =  'Consultants.lastName as clname';
        $selectColumn['Consultants.type'] =  'Consultants.type as consultants_type';

        // order column
        $orderColumn = array("", "", $this->global_tblfemaleusers.".id", $this->global_tblfemaleusers.".registrationDate", $this->global_tblfemaleusers.".firstName", $this->global_tblfemaleusers.".lastName", "", "", $this->global_tblfemaleusers.".last_login");

        // search column
        $searchColumn = array($this->global_tblfemaleusers.".cityOfResidence", $this->global_tblfemaleusers.".firstName", $this->global_tblfemaleusers.".email", $this->global_tblfemaleusers.".lastName","Consultants.firstName","Consultants.lastName");

        // order by
        $orderBy = array($this->global_tblfemaleusers.'.registrationDate' => "DESC");
        $orderBy = array($this->global_tblfemaleusers.'.status' => "DESC");

        // join table
        //$joinTableArray = array(array("joinTable"=>'Consultants', "joinField"=>"id", "relatedJoinTable"=>$this->global_tblfemaleusers, "relatedJoinField"=>"consultant_id","type"=>"left"), array("joinTable"=>'FC_AgeRanges', "joinField"=>"fcid", "relatedJoinTable"=>$this->global_tblfemaleusers, "relatedJoinField"=>"id","type"=>"left") );

        $joinTableArray = array(array("joinTable"=>'Consultants', "joinField"=>"id", "relatedJoinTable"=>$this->global_tblfemaleusers, "relatedJoinField"=>"consultant_id","type"=>"left"));

        $fetch_data = $this->model_common->make_datatables($this->global_tblfemaleusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$orwhere);

        $data = array();
        foreach ($fetch_data as $row) {
            $sub_array = array();

            $sub_array[] =  '<td><label class="form-controlNew"><input type="checkbox" class="checkSingle2" name="custom_check[]" id="custom_check_'.$row->id.'" value="'.$row->id.'"/></label>';

            if($row->primimage && file_exists( 'uploads/female/'.$row->primimage) ){
                $sub_array[] =  '<img class="myImg" onclick="myFunction('.$row->id.');" id="myImg'.$row->id.'" height="50" src="'.base_url('uploads/female/'.$row->primimage).'">';
            } else {
                $sub_array[] =  '<img height="50" src="'.base_url('assets/images/female.jpeg').'">';
            }
          
            $sub_array[] = $row->id;

            if($row->deleted == 1){
            	$sub_array[] = '<del class="text-danger">'.$this->model_common->dateFormat($row->registrationDate).'</del>';
	            $sub_array[] = '<del class="text-danger">'.$row->firstName.'</del>';
	            $sub_array[] = '<del class="text-danger">'.$row->lastName.'</del><br> <span class="text-muted">Reason : '.$row->delete_reason.'</span>';
        	} else {
            	$sub_array[] = $this->model_common->dateFormat($row->registrationDate);
	    		$sub_array[] = $row->firstName;
	        	$sub_array[] = $row->lastName;
        	}
            
            if($row->consultants_type==0){
                $cat_type = "G";
            } else if($row->consultants_type==1){
                $cat_type = "T";
            } else {
                $cat_type = "G & T";
            }
            
            //$cat_type = ($row->consultant_cat_id==1) ? "G" : "T";
            if (!empty($row->cfname) && !empty($row->clname)) {
                $sub_array[] = $cat_type." : ".$row->cfname .' '.$row->clname; 
            }else{
                $sub_array[] = '';
            }
             
            $changeStatusLink = $this->model_common->getChangeStatusLink($this->global_tblfemaleusers,$row->id,$row->status);
             $sub_array[] = $changeStatusLink;
            $sub_array[] =  isset($row->last_login) ? date('M, d, Y h:i a',strtotime($row->last_login)) : '';

             $cwhereEqual['id'] = $row->countryOfResidence ;          
                $cselectColumn['countryName'] = 'countryName';   
                $countryliving = $this->model_common->getSingleDataByField('Country',$cselectColumn,$cwhereEqual ); 

                 $cwhereEqual['id'] = $row->citizenshipStatusID;        
                $celectColumn['statusName'] = 'statusName'; 
                $CitizenshipStatus = $this->model_common->getSingleDataByField('CitizenshipStatus',$celectColumn,$cwhereEqual);

                 $dwhereEqual['id'] = $row->durationOfStayID;         
                $dselectColumn['desc'] = 'desc'; 
                $DurationOfStay = $this->model_common->getSingleDataByField('DurationOfStay',$dselectColumn,$dwhereEqual);

                $Ethnicity = '-';
                if(!empty($row->personalEthnicityID)){
                    $EthnicityArray = $this->model_common->getEthnicityCommon($row->personalEthnicityID);

                    $Ethnicity = implode(", ", $EthnicityArray);
                }

                /*$etwhereEqual['id'] = $row->personalEthnicityID;        
                $etselectColumn['*'] = '*'; 
                $etorder['ethnicityName'] = 'ASC'; 
                $Ethnicity = $this->model_common->getSingleDataByField('Ethnicity',$etselectColumn,$etwhereEqual,$etorder);*/

                 $EdwhereEqual['id'] = $row->highestEducationLevelID;         
                $EdselectColumn['educationLevelName'] = 'educationLevelName';  
                $Edorder['educationLevelName'] = 'ASC'; 
                $EducationLevels = $this->model_common->getSingleDataByField('EducationLevels',$EdselectColumn,$EdwhereEqual,$Edorder);

                 $MawhereEqual['id'] = $row->maritalStatusID;          
                $MaselectColumn['maritalStatusName'] = 'maritalStatusName';  
                $Maorder['maritalStatusName'] = 'ASC'; 
                $MaritalStatus= $this->model_common->getSingleDataByField('MaritalStatus',$MaselectColumn,$MawhereEqual,$Maorder);

                $sEthnicity = '-';
                if(!empty($row->spouseEthnicityID)){
                    $sEthnicityArray = $this->model_common->getEthnicityCommon($row->spouseEthnicityID);

                    $sEthnicity = implode(", ", $sEthnicityArray);
                }

                 /* $setwhereEqual['id'] = $row->spouseEthnicityID;        
                $setselectColumn['ethnicityName'] = 'ethnicityName';  
                $sEthnicity = $this->model_common->getSingleDataByField('Ethnicity',$setselectColumn,$setwhereEqual );*/

                   $hiwhereEqual['gender'] = 'F';        
                   $hiwhereEqual['id'] = $row->hijabPreferenceID;        
                $hiselectColumn['hijabPreferenceName'] = 'hijabPreferenceName';   
                $HijabPreference = $this->model_common->getSingleDataByField('HijabPreference',$hiselectColumn,$hiwhereEqual );

				$alorder = array();
	        	$lselectColumn['LivingArrangements.desc'] = ' LivingArrangements.desc  as description';
	        	$afwhereEqual['FC_AfterMarriageLiving.fcid'] = $row->id;
	        	$afwhereEqual['LivingArrangements.isActive'] = 1;
	        	$afjoinTableArray = array(array("joinTable"=>'LivingArrangements', "joinField"=>"id", "relatedJoinTable"=>'FC_AfterMarriageLiving', "relatedJoinField"=>"livingArrangementsID","type"=>"left"));
			 	$LivingArrangements = $this->model_common->get_table_records('FC_AfterMarriageLiving',$lselectColumn,$afwhereEqual,$afjoinTableArray,$alorder);   


			 	$alsorder = array();
	        	$afsselectColumn['AfterMarriagePreferenceMale.desc'] = ' AfterMarriagePreferenceMale.desc  as description';
	        	$afswhereEqual['FC_AfterSpousePrefer.fcid'] = $row->id;
	        	$afswhereEqual['AfterMarriagePreferenceMale.isActive'] = 1;
	        	$afsjoinTableArray = array(array("joinTable"=>'AfterMarriagePreferenceMale', "joinField"=>"id", "relatedJoinTable"=>'FC_AfterSpousePrefer', "relatedJoinField"=>"afterMarriagePreferenceMaleID","type"=>"left"));
			 	$AfterSpousePrefer = $this->model_common->get_table_records('FC_AfterSpousePrefer',$afsselectColumn,$afswhereEqual,$afsjoinTableArray,$alsorder); 

			 	$agsorder = array();
	        	$agsselectColumn['AgeRange.desc'] = ' AgeRange.desc  as description';
	        	$agswhereEqual['FC_AgeRanges.fcid'] = $row->id;
	        	$agswhereEqual['AgeRange.isActive'] = 1;
	        	$agsjoinTableArray = array(array("joinTable"=>'AgeRange', "joinField"=>"id", "relatedJoinTable"=>'FC_AgeRanges', "relatedJoinField"=>"ageRangeID","type"=>"left"));
			 	$AgeRanges = $this->model_common->get_table_records('FC_AgeRanges',$agsselectColumn,$agswhereEqual,$agsjoinTableArray,$agsorder);   
        			
			  	$mvsorder = array();
	        	$mvsselectColumn['MosqueVisits.desc'] = ' MosqueVisits.desc  as description';
	        	$mvswhereEqual['FC_MosqueVisits.fcid'] = $row->id;
	        	$mvswhereEqual['MosqueVisits.isActive'] = 1;
	        	$mvsjoinTableArray = array(array("joinTable"=>'MosqueVisits', "joinField"=>"id", "relatedJoinTable"=>'FC_MosqueVisits', "relatedJoinField"=>"mosqueVisitID","type"=>"left"));
			 	$MosqueVisits = $this->model_common->get_table_records('FC_MosqueVisits',$mvsselectColumn,$mvswhereEqual,$mvsjoinTableArray,$mvsorder);

			 	$ihorder = array();
	        	$ihselectColumn['InterestsHobbies.desc'] = ' InterestsHobbies.interestsHobbiesName  as description';
	        	$ihwhereEqual['FC_InterestHobbies.fcid'] = $row->id;
	        	$ihwhereEqual['InterestsHobbies.isActive'] = 1;
	        	$ihjoinTableArray = array(array("joinTable"=>'InterestsHobbies', "joinField"=>"id", "relatedJoinTable"=>'FC_InterestHobbies', "relatedJoinField"=>"hobbiesID","type"=>"left"));
			 	$InterestHobbies = $this->model_common->get_table_records('FC_InterestHobbies',$ihselectColumn,$ihwhereEqual,$ihjoinTableArray,$ihorder);
            
            $actionLink = $this->model_common->getActionLink('users/female_edit/',$row->id,'female',1,1);

             $actionLink .='<div id="userdelete_'.$row->id.'" class="modal fade " role="dialog">
						<div class="modal-dialog modal-lg"> 
							<div class="modal-content"> 
							<input type="hidden" name="delete_user_id" id="delete_user_id" value="'.$row->id.'">
								<div class="modal-header"> 
									<h4 class="modal-title">Delete Reason</h4>
								</div>
								<div class="modal-body"> 
								<form id="deleteuser" class="deleteuser" method="post">
							               <div class="form-check">
				                      <label class="form-check-label">
				                        <input type="radio" class="form-check-input" name="reason" value="Married/engaged through SC">Married/engaged through SC
				                      </label>
				                    </div>

				                        <div class="form-check">
				                      <label class="form-check-label">
				                        <input type="radio" class="form-check-input" name="reason" value="Married/engaged outside SC">Married/engaged outside SC
				                      </label>
				                    </div>

				                      <div class="form-check">
				                      <label class="form-check-label">
				                        <input type="radio" class="form-check-input" name="reason" value="AWOL - not responding">AWOL - not responding
				                      </label>
				                    </div>
 

				                     <div class="form-check">
				                      <label class="form-check-label">
				                        <input type="radio" class="form-check-input" name="reason" value="Removed from the system">Removed from the system
				                      </label>
				                    </div>

				                     <div class="form-check">
				                      <label class="form-check-label">
				                        <input type="radio" class="form-check-input" name="reason" value="Inactive">Inactive
				                      </label>
				                    </div>

				                    <div class="form-check">
				                      <label class="form-check-label">
				                        <input type="radio" class="form-check-input" name="reason" value="Holding Zone">Holding Zone
				                      </label>
				                    </div>
			                     <button  type="button" id="submitreason_female" data-uid="'.$row->id.'" class="btn btn-success">Remove User</button>
			                 </form>
								<div>
								    </div>
										<div class="modal-footer">
										  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div></div></div></div>';

			$actionLink .='<div id="changepassword_'.$row->id.'" class="modal fade " role="dialog">
						<div class="modal-dialog modal-lg"> 
							<div class="modal-content"> 
						
								<div class="modal-header"> 
									<h4 class="modal-title">Reset Password</h4>
								</div>
								<div class="modal-body"> 
								<form id="resetpassword_'.$row->id.'" class="resetpassword" method="post">

								<div class="form-group">
							    <label for="exampleInputPassword1">Password</label>
							    <input type="text" id="password"  onblur="onBlur(this)" onfocus="onFocus(this)" required name="password"   >
							    <br><br><lable>try auto generated password : '.get_random_code().'</label>
							  </div> 
								<br>
			                     <button  type="button" id="submitpassword" data-utype="male" data-uid="'.$row->id.'" class="btn btn-success submitpassword">Change Password</button>
			                 </form>
								<div>
								    </div>
										<div class="modal-footer">
										  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div></div></div></div>';

            $actionLink .='<div id="view_users_detail_'.$row->id.'" class="modal fade " role="dialog">
						<div class="modal-dialog modal-lg">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header"> 
									<h4 class="modal-title">Female Candidate Details</h4>
								</div>
								<div class="modal-body"> 
								<div class="table-responsive">
								    <table class="table  table-condensed"><tr> '; 
											$firstName = $row->firstName ? : "-";
											$actionLink .= '<td>First Name : </td><td>'.$firstName.'</td>'; 

											$lastName = $row->lastName ? : "-";
											$actionLink .= '<tr><td>Last Name :  </td><td>'.$lastName.'</td></tr>'; 

											$email = $row->email ? : "-";
											$actionLink .= '<td>Email : </td><td>'.$email.'</td>'; 

											$birthdate = $row->birthdate ? date('d-m-Y',strtotime($row->birthdate)) : "-";
											$actionLink .= '<tr><td>Birthdate :  </td><td>'. $birthdate .'</td></tr>'; 

											 $fathersName = $row->fathersName ? : "-";
											$actionLink .= '<tr><td>Fathers Name :  </td><td>'.$fathersName.'</td></tr>'; 

											 $mothersName = $row->mothersName ? : "-";
											$actionLink .= '<tr><td>Mothers Name :  </td><td>'.$mothersName.'</td></tr>'; 

											 $cityOfResidence = $row->cityOfResidence ? : "-";
											$actionLink .= '<tr><td>City of Residence :  </td><td>'.$cityOfResidence.'</td></tr>'; 

											 $phone = $row->phone ? : "-";
											$actionLink .= '<tr><td>Phone :  </td><td>'.$phone.'</td></tr>'; 

											@$countryOfResidence = $countryliving['countryName']   ?  $countryliving['countryName'] : "-";
											$actionLink .= '<tr><td>Country :  </td><td>'.$countryOfResidence.'</td></tr>'; 

											@$heightCM = $row->heightCM ? : "-";
											$actionLink .= '<tr><td>Height Inches :  </td><td>'.$heightCM.'</td></tr>'; 

											@$citizenshipStatusID = $CitizenshipStatus['statusName'] ? : "-";
											$actionLink .= '<tr><td>Citizenship Status  :  </td><td>'.$citizenshipStatusID.'</td></tr>'; 

											@$durationOfStayID = $DurationOfStay['desc'] ? : "-";
											$actionLink .= '<tr><td>Duration of Stay :  </td><td>'.$durationOfStayID.'</td></tr>'; 

											//@$Ethnicity = $Ethnicity['ethnicityName'] ? : "-";
											$actionLink .= '<tr><td>Ethnicity Name  :  </td><td>'.$Ethnicity.'</td></tr>'; 	


											@$cityOfBirth = $row->cityOfBirth ? : "-";
											$actionLink .= '<tr><td>City of Birth :  </td><td>'.$cityOfBirth.'</td></tr>'; 


											@$areaOfStudy = $row->areaOfStudy ? : "-";
											$actionLink .= '<tr><td>Area of Study :  </td><td>'.$areaOfStudy.'</td></tr>'; 

											@$EducationLevels = $EducationLevels['educationLevelName'] ? : "-";
											$actionLink .= '<tr><td>Education Level   :  </td><td>'.$EducationLevels.'</td></tr>'; 	

											@$currentOccupation = $row->currentOccupation ? : "-";
											$actionLink .= '<tr><td>Current Occupation :  </td><td>'.$currentOccupation.'</td></tr>'; 

											@$MaritalStatus = $MaritalStatus['maritalStatusName'] ? : "-";
											$actionLink .= '<tr><td>Marital Status    :  </td><td>'.$MaritalStatus.'</td></tr>'; 	

											

											@$willingToRelocate = $row->willingToRelocate ? : "-";
											$actionLink .= '<tr><td>Willing to Relocate :  </td><td>'.$willingToRelocate.'</td></tr>'; 


											@$afterMarriageLivingOther = $row->afterMarriageLivingOther ? : "-";
											$actionLink .= '<tr><td>After Marriage Living Other :  </td><td>'.$afterMarriageLivingOther.'</td></tr>';


									 

											//@$sEthnicity = $sEthnicity['ethnicityName'] ? : "-";
											$actionLink .= '<tr><td>Spouse Ethnicity   :  </td><td>'.$sEthnicity.'</td></tr>'; 

											@$HijabPreference = $HijabPreference['hijabPreferenceName'] ? : "-";
											$actionLink .= '<tr><td>Hijab Preference :  </td><td>'.$HijabPreference.'</td></tr>'; 

											@$hijabPreferenceAdditional = $row->hijabPreferenceAdditional ? : "-";
											$actionLink .= '<tr><td>Hijab Preference Additional :  </td><td>'.$hijabPreferenceAdditional.'</td></tr>';
 
											@$considerDivorcee = $row->considerDivorcee ? : "-";
											$actionLink .= '<tr><td>Consider Divorcee   :  </td><td>'.$considerDivorcee.'</td></tr>';

											 @$mosqueVisitOther = $row->mosqueVisitOther ? : "-";
											$actionLink .= '<tr><td>Mosque Visit Other :  </td><td>'.$mosqueVisitOther.'</td></tr>';

											@$myCharacteristics1 = $row->myCharacteristics1 ? : "-";
											$actionLink .= '<tr><td>My Characteristics 1 :  </td><td>'.$myCharacteristics1.'</td></tr>';

											 @$myCharacteristics2 = $row->myCharacteristics2 ? : "-";
											$actionLink .= '<tr><td>My Characteristics 2 :  </td><td>'.$myCharacteristics2.'</td></tr>';

											 @$myCharacteristics3 = $row->myCharacteristics3 ? : "-";
											$actionLink .= '<tr><td>My Characteristics 3 :  </td><td>'.$myCharacteristics3.'</td></tr>';

											@$preferences = $row->preferences ? : "-";
											$actionLink .= '<tr><td>Preferences :  </td><td>'.$preferences.'</td></tr>';

											@$aboutMe = $row->aboutMe ? : "-";
											$actionLink .= '<tr><td>About Me :  </td><td>'.$aboutMe.'</td></tr>'; 

											@$otherDetails = $row->otherDetails ? : "-";
											$actionLink .= '<tr><td>Other Details :  </td><td>'.$otherDetails.'</td></tr>';


											if(!empty($LivingArrangements)){
		        		 	 
												$actionLink .= '<tr><td>Living Arrangements   : </td>';
												$afmvalues =array();
												foreach ($LivingArrangements as $key => $value) { 
												if($value > 0){
												 $actionLink .= ' <td>'. $value['description'].'</td> ';

													}
												}
												$actionLink .= '</tr>'; 
		        		 
		        							}

		        							if(!empty($AfterSpousePrefer)){
		        		 	 
												$actionLink .= '<tr><td>Living Style   : </td>';
												$afmvalues =array();
												foreach ($AfterSpousePrefer as $key => $value) { 
												if($value > 0){
												 $actionLink .= ' <td>'. $value['description'].'</td> ';

													}
												}
												$actionLink .= '</tr>'; 
		        		 
		        							}

		        							if(!empty($AgeRanges)){
		        		 	 
												$actionLink .= '<tr><td>Age Range : </td>';
												$afmvalues =array();
												foreach ($AgeRanges as $key => $value) { 
												if($value > 0){
												 $actionLink .= ' <td>'. $value['description'].'</td> ';

													}
												}
												$actionLink .= '</tr>'; 
		        		 
		        							}
 

		        						 	if(!empty($MosqueVisits)){
		        		 	 
												$actionLink .= '<tr><td>Mosque Visits : </td>';
												$afmvalues =array();
												foreach ($MosqueVisits as $key => $value) { 
													if($value > 0){
												 		$actionLink .= ' <td>'. $value['description'].'</td> '; 
													}
												}
												$actionLink .= '</tr>'; 
		        							}


		        							if(!empty($InterestHobbies)){
		        		 	 
												$actionLink .= '<tr><td>Interest Hobbies : </td>';
												$afmvalues =array();
												foreach ($InterestHobbies as $key => $value) { 
													if($value > 0){
												 		$actionLink .= ' <td>'. $value['description'].'</td> '; 
													}
												}
												$actionLink .= '</tr>'; 
		        							} 

		        						  $interestsHobbiesOther = $row->interestsHobbiesOther ? : "-";
											$actionLink .= '<tr><td>Interests Hobbies Other   :  </td><td>'.$interestsHobbiesOther.'</td></tr>'; 
  

											$actionLink .='</tr> 
										</table></div>
										<div class="modal-footer">
										  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>';


            

            
            $sub_array[] = $actionLink;
            $data[] = $sub_array;
        }

        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->model_common->get_all_data($this->global_tblfemaleusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$orwhere),
            "recordsFiltered" => $this->model_common->get_filtered_data($this->global_tblfemaleusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$orwhere),
            "data" => $data,
        );
        echo json_encode($output);
        
    }


	public function female_consultants()
	 {
	 	$this->data['country'] = $this->model_common->get_all_records('Country');
	 	$this->render_admin_layouts('admin/female_consultants/index', $this->data);
	 	
	 }  
	 
	 public function get_active_count($con_id,$type)
	{	

		if($type == 'm_active'){
			$this->db->select('id');
			$this->db->from('MaleCandidates');
			$this->db->where('consultant_id', $con_id); 
			$this->db->where('deleted', 0); 
			$activem = $this->db->get()->result(); 
	  		return count($activem ); 

  		} else if($type == 'f_active'){
  			$this->db->select('id');
			$this->db->from('FemaleCandidates');
			$this->db->where('consultant_id', $con_id); 
			$this->db->where('deleted', 0); 
			$activef = $this->db->get()->result(); 

			return count($activef ); 
  		} else if($type == 'm_inactive'){
  			$this->db->select('id');
			$this->db->from('MaleCandidates');
			$this->db->where('consultant_id', $con_id); 
			$this->db->where('deleted', 1); 
			$minactivem = $this->db->get()->result(); 
	  		return count($minactivem ); 
  		} else if($type == 'f_inactive'){
  			$this->db->select('id');
			$this->db->from('FemaleCandidates');
			$this->db->where('consultant_id', $con_id); 
			$this->db->where('deleted', 1); 
			$minactivef = $this->db->get()->result(); 
	  		return count($minactivef ); 
  		}

	}

    public function fetch_female_consultants(){

        // equal condition
        $whereEqual = array($this->global_tblconsultants.'.gender'=>1);

        $status = $this->input->post('status');

        $countryOfResidence = $this->input->post('country');
        if(isset($countryOfResidence) && $countryOfResidence > 0 ){
 			 $whereEqual[$this->global_tblconsultants.'.country'] = $countryOfResidence;
 		}

        if(isset($status) && $status !='' ){
            $whereEqual[$this->global_tblconsultants.'.status'] = $status;
        }
 
        // not equal condition
        $whereNotEqual = array();

        $notIn = array();     


        // select data
        $selectColumn[$this->global_tblconsultants.'.*'] = $this->global_tblconsultants.'.*';
        $selectColumn['Country.countryName'] =  'Country.countryName';
        // order column
        $orderColumn = array("", $this->global_tblconsultants.".firstName", $this->global_tblconsultants.".lastName", "", $this->global_tblconsultants.".phone", $this->global_tblconsultants.".email", "", "", $this->global_tblconsultants.".last_login");

        // search column
        $searchColumn = array($this->global_tblconsultants.".city", $this->global_tblconsultants.".firstName", $this->global_tblconsultants.".email", $this->global_tblconsultants.".lastName");

        // order by
        $orderBy = array($this->global_tblconsultants.'.status' => "DESC");
        
        // join table
        $joinTableArray = array(array("joinTable"=>'Country', "joinField"=>"id", "relatedJoinTable"=>$this->global_tblconsultants, "relatedJoinField"=>"country","type"=>"left"));


        $fetch_data = $this->model_common->make_datatables($this->global_tblconsultants,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);

        $data = array();
        foreach ($fetch_data as $row) {
            $sub_array = array();

            $sub_array[] =  '<td><label class="form-controlNew"><input type="checkbox" class="checkSingle1" name="custom_check_c[]" id="custom_check_'.$row->id.'" value="'.$row->id.'"/></label>';
            
            $activem = $this->get_active_count($row->id, 'm_active');
            $inactivem = $this->get_active_count($row->id, 'm_inactive');

             
            if($row->deleted == 1){
            	 
	            $sub_array[] = '<del class="text-danger">'.$row->firstName.'</del>';
	            $sub_array[] = '<del class="text-danger">'.$row->lastName.'</del><br> <span class="text-muted">Reason : '.$row->delete_reason.'</span>';
        	} else {
            
	    		$sub_array[] = $row->firstName;
	        	$sub_array[] = $row->lastName;
        	}
            $sub_array[] = $row->countryName; 
            $sub_array[] = $row->phone; 
            $sub_array[] = $row->email; 
            $sub_array[] = $activem; 
            $sub_array[] = $inactivem;
            $sub_array[] =  isset($row->last_login) ? date('M, d, Y h:i a',strtotime($row->last_login)) : '';
            $changeStatusLink = $this->model_common->getChangeStatusLink($this->global_tblconsultants,$row->id,$row->status);


            $sub_array[] = $changeStatusLink;

            $actionLink = $this->model_common->getActionLink('users/female_consultants_edit/',$row->id,'malecon',1,1);

            $actionLink .='<div id="changepassword_'.$row->id.'" class="modal fade " role="dialog">
						<div class="modal-dialog modal-lg"> 
							<div class="modal-content"> 
						
								<div class="modal-header"> 
									<h4 class="modal-title">Reset Password</h4>
								</div>
								<div class="modal-body"> 
								<form id="resetpassword_'.$row->id.'" class="resetpassword" method="post">

								<div class="form-group">
							    <label for="exampleInputPassword1">Password</label>
							    <input type="text" id="password"  onblur="onBlur(this)" onfocus="onFocus(this)" required name="password"   >
							    <br><br><lable>try auto generated password : '.get_random_code().'</label>
							  </div> 
								<br>
			                     <button  type="button" id="submitpassword" data-utype="male" data-uid="'.$row->id.'" class="btn btn-success submitpassword">Change Password</button>
			                 </form>
								<div>
								    </div>
										<div class="modal-footer">
										  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div></div></div></div>';

             $actionLink .='<div id="userdelete_'.$row->id.'" class="modal fade " role="dialog">
						<div class="modal-dialog modal-lg"> 
							<div class="modal-content"> 
							<input type="hidden" name="delete_user_id" id="delete_user_id" value="'.$row->id.'">
								<div class="modal-header"> 
									<h4 class="modal-title">Delete Reason</h4>
								</div>
								<div class="modal-body"> 
								<form id="deleteuser" class="deleteuser" method="post">
							                 <div class="form-check">
				                      <label class="form-check-label">
				                        <input type="radio" class="form-check-input" name="reason" value="Married/engaged through SC">Married/engaged through SC
				                      </label>
				                    </div>

				                        <div class="form-check">
				                      <label class="form-check-label">
				                        <input type="radio" class="form-check-input" name="reason" value="Married/engaged outside SC">Married/engaged outside SC
				                      </label>
				                    </div>

				                      <div class="form-check">
				                      <label class="form-check-label">
				                        <input type="radio" class="form-check-input" name="reason" value="AWOL - not responding">AWOL - not responding
				                      </label>
				                    </div>
 

				                     <div class="form-check">
				                      <label class="form-check-label">
				                        <input type="radio" class="form-check-input" name="reason" value="Removed from the system">Removed from the system
				                      </label>
				                    </div>

				                     <div class="form-check">
				                      <label class="form-check-label">
				                        <input type="radio" class="form-check-input" name="reason" value="Inactive">Inactive
				                      </label>
				                    </div>

				                    <div class="form-check">
				                      <label class="form-check-label">
				                        <input type="radio" class="form-check-input" name="reason" value="Holding Zone">Holding Zone
				                      </label>
				                    </div>
			                     <button  type="button" id="submitreason_femalecon" data-uid="'.$row->id.'" class="btn btn-success">Remove User</button>
			                 </form>
								<div>
								    </div>
										<div class="modal-footer">
										  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div></div></div></div>';

				$actionLink .='<div id="view_users_detail_'.$row->id.'" class="modal fade " role="dialog">
									<div class="modal-dialog modal-lg">
										<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header"> 
												<h4 class="modal-title">Male Candidate Details</h4>
											</div>
											<div class="modal-body"> 
												<div class="table-responsive">
												    <table class="table  table-condensed"><tr> '; 
															$firstName = $row->firstName ? : "-";
															$actionLink .= '<td>FirstName : </td><td>'.$firstName.'</td>'; 

															$lastName = $row->lastName ? : "-";
															$actionLink .= '<tr><td>LastName :  </td><td>'.$lastName.'</td></tr>'; 

															$email = $row->email ? : "-";
															$actionLink .= '<tr><td>Email :  </td><td>'.$email.'</td></tr>';

															 $city = $row->city ? : "-";
															$actionLink .= '<tr><td>City :  </td><td>'.$city.'</td></tr>'; 

															 $phone = $row->phone ? : "-";
															$actionLink .= '<tr><td>Phone :  </td><td>'.$phone.'</td></tr>'; 

															 $countryOfResidence = $row->countryName   ?  $row->countryName : "-";
															$actionLink .= '<tr><td>Country :  </td><td>'.$countryOfResidence.'</td></tr>'; 

																$bio = $row->bio ? : "-";
															$actionLink .= '<tr><td>Bio   :  </td><td>'.$bio.'</td></tr>'; 

															$actionLink .='</tr> 
													</table>
												</div>
												<div class="modal-footer">
												  	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>
								</div>';

            $sub_array[] = $actionLink;
            $data[] = $sub_array;
        }

        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->model_common->get_all_data($this->global_tblconsultants,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "recordsFiltered" => $this->model_common->get_filtered_data($this->global_tblconsultants,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "data" => $data,
        );
        echo json_encode($output);
        
    }


	public function male_consultants()
	 {
	 	$this->data['country'] = $this->model_common->get_all_records('Country');
	 	$this->render_admin_layouts('admin/male_consultants/index', $this->data);
	 	
	 } 


	 public function male_consultants_create()
	{	
		if(($this->input->post('firstName')!='') && ($this->input->post('lastName')!='') && ($this->input->post('phone')!='') && ($this->input->post('email')!='')  && ($this->input->post('pwd')!='')){

            // true case
            $password = md5($this->input->post('pwd')); 
        	$data = array(  	
        		'email' => $this->input->post('email'),
        		'firstName' => $this->input->post('firstName'),
        		'lastName' => $this->input->post('lastName'),
        		'city' => $this->input->post('city'),
        		'country' => $this->input->post('country'),
                'pwd' => $password,   
                'gender' =>0,
                'recommendedBy' => $this->input->post('recommendedBy'),
				'bio' => $this->input->post('bio'),
        		'phone' => $this->input->post('phone'),
                 
        	);

        	$create = $this->model_common->insertTableData($data, $this->global_tblconsultants);
        	if($create>0) {  
        		$this->session->set_flashdata('success', 'The male consultants was created successfully.');
        		redirect('users/male_consultants', 'refresh');
        	} else {
        		$this->session->set_flashdata('error', 'Error occurred!!');
        		redirect('users/male_consultants_create', 'refresh');
        	}

        } else {
            // false case
              $this->data['country'] = $this->model_common->get_all_records('Country');
            $this->render_admin_layouts('admin/male_consultants/create', $this->data);
        }		
	}

	 

    public function fetch_male_consultants(){

        // equal condition
        $whereEqual = array( $this->global_tblconsultants.'.gender'=>0); 


	   	$country = $this->input->post('country');
	   $status = $this->input->post('status');
 		
 		if(isset($country) && $country > 0 ){
 			 $whereEqual[$this->global_tblconsultants.'.country'] = $country;
 		}

        if(isset($status) && $status !='' ){
            $whereEqual[$this->global_tblconsultants.'.status'] = $status;
        }
      
        // not equal condition
        $whereNotEqual = array();

        $notIn = array();     


        // select data
        $selectColumn[$this->global_tblconsultants.'.*'] = $this->global_tblconsultants.'.*';
        $selectColumn['Country.countryName'] =  'Country.countryName';
        // order column
        $orderColumn = array("",$this->global_tblconsultants.".firstName", $this->global_tblconsultants.".lastName", "", $this->global_tblconsultants.".phone", $this->global_tblconsultants.".email", "", "", $this->global_tblconsultants.".last_login");

        // search column
        $searchColumn = array($this->global_tblconsultants.".city", $this->global_tblconsultants.".firstName", $this->global_tblconsultants.".email", $this->global_tblconsultants.".lastName");

        // order by
        $orderBy = array($this->global_tblconsultants.'.status' => "DESC");

        // join table
        $joinTableArray = array(array("joinTable"=>'Country', "joinField"=>"id", "relatedJoinTable"=>$this->global_tblconsultants, "relatedJoinField"=>"country","type"=>"left"));


        $fetch_data = $this->model_common->make_datatables($this->global_tblconsultants,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);

        $data = array();
        foreach ($fetch_data as $row) {
            $sub_array = array(); 

            $sub_array[] =  '<td><label class="form-controlNew"><input type="checkbox" class="checkSingle1" name="custom_check_c[]" id="custom_check_'.$row->id.'" value="'.$row->id.'"/></label>';

            $activef = $this->get_active_count($row->id, 'f_active');
            $inactivef = $this->get_active_count($row->id, 'f_inactive');


             
         if($row->deleted == 1){
            	 
	            $sub_array[] = '<del class="text-danger">'.$row->firstName.'</del>';
	            $sub_array[] = '<del class="text-danger">'.$row->lastName.'</del><br> <span class="text-muted">Reason : '.$row->delete_reason.'</span>';
        	} else {
            
	    		$sub_array[] = $row->firstName;
	        	$sub_array[] = $row->lastName;
        	}
            $sub_array[] = $row->countryName; 
            $sub_array[] = $row->phone; 
            $sub_array[] = $row->email; 
            $sub_array[] = $activef; 
            $sub_array[] = $inactivef;
             $sub_array[] =  isset($row->last_login) ? date('M, d, Y h:i a',strtotime($row->last_login)) : '';
            $changeStatusLink = $this->model_common->getChangeStatusLink($this->global_tblconsultants,$row->id,$row->status);

            $sub_array[] = $changeStatusLink;

            $actionLink = $this->model_common->getActionLink('users/male_consultants_edit/',$row->id,'femalecon',1,1);

            $actionLink .='<div id="changepassword_'.$row->id.'" class="modal fade " role="dialog">
						<div class="modal-dialog modal-lg"> 
							<div class="modal-content"> 
						
								<div class="modal-header"> 
									<h4 class="modal-title">Reset Password</h4>
								</div>
								<div class="modal-body"> 
								<form id="resetpassword_'.$row->id.'" class="resetpassword" method="post">

								<div class="form-group">
							    <label for="exampleInputPassword1">Password</label>
							    <input type="text" id="password"  onblur="onBlur(this)" onfocus="onFocus(this)" required name="password"  >
							    <br><br><lable>try auto generated password : '.get_random_code().'</label>
							  </div> 
								<br>
			                     <button  type="button" id="submitpassword" data-utype="male" data-uid="'.$row->id.'" class="btn btn-success submitpassword">Change Password</button>
			                 </form>
								<div>
								    </div>
										<div class="modal-footer">
										  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div></div></div></div>';

             $actionLink .='<div id="userdelete_'.$row->id.'" class="modal fade " role="dialog">
						<div class="modal-dialog modal-lg"> 
							<div class="modal-content"> 
							<input type="hidden" name="delete_user_id" id="delete_user_id" value="'.$row->id.'">
								<div class="modal-header"> 
									<h4 class="modal-title">Delete Reason</h4>
								</div>
								<div class="modal-body"> 
								<form id="deleteuser" class="deleteuser" method="post">
							                  <div class="form-check">
				                      <label class="form-check-label">
				                        <input type="radio" class="form-check-input"   name="reason" value="Engaged with SC">Engaged with SC
				                      </label>
				                    </div>

				                      <div class="form-check">
				                      <label class="form-check-label">
				                        <input type="radio" class="form-check-input" name="reason" value="Engaged outside of SC">Engaged outside of SC
				                      </label>
				                    </div>

				                     <div class="form-check">
				                      <label class="form-check-label">
				                        <input type="radio" class="form-check-input" name="reason" value="Taking a break">Taking a break
				                      </label>
				                    </div>  

				                     <div class="form-check">
				                      <label class="form-check-label">
				                        <input type="radio" class="form-check-input" name="reason" value="AWOL">AWOL
				                      </label>
				                    </div>
			                     <button  type="button" id="submitreason_malecon" data-uid="'.$row->id.'" class="btn btn-success">Remove User</button>
			                 </form>
								<div>
								    </div>
										<div class="modal-footer">
										  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div></div></div></div>';

				$actionLink .='<div id="view_users_detail_'.$row->id.'" class="modal fade " role="dialog">
									<div class="modal-dialog modal-lg">
										<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header"> 
												<h4 class="modal-title">Male Candidate Details</h4>
											</div>
											<div class="modal-body"> 
												<div class="table-responsive">
												    <table class="table  table-condensed"><tr> '; 
															$firstName = $row->firstName ? : "-";
															$actionLink .= '<td>FirstName : </td><td>'.$firstName.'</td>'; 

															$lastName = $row->lastName ? : "-";
															$actionLink .= '<tr><td>LastName :  </td><td>'.$lastName.'</td></tr>'; 

															$email = $row->email ? : "-";
															$actionLink .= '<tr><td>Email :  </td><td>'.$email.'</td></tr>';

															 $city = $row->city ? : "-";
															$actionLink .= '<tr><td>City :  </td><td>'.$city.'</td></tr>'; 

															 $phone = $row->phone ? : "-";
															$actionLink .= '<tr><td>Phone :  </td><td>'.$phone.'</td></tr>'; 

															 $countryOfResidence = $row->countryName   ?  $row->countryName : "-";
															$actionLink .= '<tr><td>Country :  </td><td>'.$countryOfResidence.'</td></tr>'; 

																$bio = $row->bio ? : "-";
															$actionLink .= '<tr><td>Bio   :  </td><td>'.$bio.'</td></tr>'; 

															$actionLink .='</tr> 
													</table>
												</div>
												<div class="modal-footer">
												  	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>
								</div>';


            $sub_array[] = $actionLink;
            $data[] = $sub_array;
        }

        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->model_common->get_all_data($this->global_tblconsultants,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "recordsFiltered" => $this->model_common->get_filtered_data($this->global_tblconsultants,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "data" => $data,
        );
        echo json_encode($output);
        
    }
	 

	  public function new_male()
	 { 
	 	$this->render_admin_layouts('admin/new_male/index', $this->data);
	 	
	 } 

	  public function new_female()
	 { 
	 	$this->render_admin_layouts('admin/new_female/index', $this->data);
	 	
	 } 

	 

	public function users_reactive()
	{

		$id = $this->input->post('id');
        if($id) {
        	$user_type =  $this->input->post('type'); 
        	$table = '';
        	if($user_type == 'male'){
        		$table = $this->global_tblusers;
        	} else if($user_type == 'female'){ 
        		$table = $this->global_tblfemaleusers;  
        	} else if($user_type == 'malecon'){
        		$table = $this->global_tblconsultants;

        	} else if($user_type == 'femalecon'){
        		$table = $this->global_tblconsultants;
        	}

        	if($table !=''){ 
 
	            $whereEquals = array('id'=>$id);        
	            $selectColumn['*'] = '*';
	            $this->data['user_data'] = $this->model_common->getSingleDataByField($table,$selectColumn,$whereEquals);

	            $updateData['deleted'] = 0;
	            $updateData['delete_reason'] = ''; 
	            $whereEqual['id'] = $id; 
	            $update = $this->model_common->updateTableData($updateData,$table,$whereEqual);

	            if($update == true) {
	                $res['msg'] =  'The user has been successfully reactive.';
	                $res['id'] =   $id;
	                $res['success'] =  1;
	                echo json_encode($res);
	            }
	            else { 
	                 $res['msg'] = 'Error occurred!!';
	                $res['id'] =   $id;
	                 $res['success'] = 0;
	                echo json_encode($res);
	            }

	        }

        }
		
	}

 

	public function send_email($update,$email,$password)
	{		
		 
        if($update == true && $password != '') {
        		 				 
            $message='';
            $this->data['poname']  = 'Shia Connections';
            $fromEmail = $this->config->item('admin_email');
            $toEmail =  $email;  // trim($this->input->post('email'));
            $subject = "Update Password";
            $this->data['message']  = ' <div style="width: 100%;background-color: #fff;margin: 20px 0px;padding: 20px 0px;word-break: break-word;">
                    <h6 style="width: 92%;margin: 0px auto 14px;font-size: 15px;line-height: normal;font-weight: normal;">Salaam Alaikum,</h6>
                    <h6 style="width: 92%;margin: 0px auto 14px;font-size: 15px;line-height: normal;font-weight: normal;">The password for your Shia Connections account has been changed for user <strong>'.$email.'</strong></h6>
                    <h6 style="width: 92%;margin: 0px auto 14px;font-size: 15px;line-height: normal;font-weight: normal;">New password : '.$password.'</h6>
                    <h6 style="width: 92%;margin: 0px auto;font-size: 15px;line-height: normal;font-weight: normal;">If you did not make this change, please contact us immediately.</h6>
                </div>';
            $message = $this->load->view('templates/email/email_template',$this->data,true);    
            $result = $this->model_common->sendEmail($fromEmail,$toEmail,$subject,$message);
        		
            if(!$result){  
                return false; 
            } else {        
                return true;

            }
        } else {    
            return false;
            
        }
	}

    public function sendMessage(){

        if((!empty($this->input->post('receiverId')!='')) && (!empty($this->input->post('subjectText')!='')) && (!empty($this->input->post('messageText')!=''))){

            $fileURL = '';

            $userType = $this->input->post('userType');

            if(!empty($this->input->post('pdfType'))){
                if($this->input->post('pdfType')==1){

                    if(($_FILES['pdfFile']['size']>0) && ($this->input->post('subjectText')!='')) {

                        $pdfFile = '';
                        if ($_FILES['pdfFile']['size']>0) {

                            $uploaddir = FCPATH.'uploads/pdfFile/';
                            @chmod($uploaddir, 0777);
                            $ext = pathinfo($_FILES['pdfFile']['name'], PATHINFO_EXTENSION);

                            $filenm = time() .'_PDF.'.$ext;
                            $pdfFile = str_replace(' ', '-', $filenm);
                            $uploadfile = $uploaddir . $pdfFile;

                            move_uploaded_file($_FILES['pdfFile']['tmp_name'], $uploadfile);

                            $fileURL = base_url('uploads/pdfFile/'.$filenm);
                        } 

                        // true case
                        $subjectText = $this->input->post('subjectText'); 
                        $dataPdf = array(   
                            'pdfFile' => $pdfFile,
                            'titleName' => $subjectText
                        );

                        $createpdf = $this->model_common->insertTableData($dataPdf, 'pdfForms');
                    }

                }
            }

            $receiverId = explode(",", $this->input->post('receiverId'));

            if(!empty($receiverId)){

                foreach ($receiverId as $key => $value) {

                    if(!empty($this->input->post('pdfType'))){

                        if($this->input->post('pdfType')==2){
                            $createpdf = $this->input->post('pdfID');

                            $whereEqual = array('id'=>$createpdf);        
                            $selectColumn['*'] = '*';
                            $pdf_data = $this->model_common->getSingleDataByField('pdfForms',$selectColumn,$whereEqual);

                            $fileURL = base_url('uploads/pdfFile/'.$pdf_data['pdfFile']);
                        }
                    }
                    
                    if(!empty($value)){

                        $userPostType = $this->input->post('userPostType');
                        $userType = $this->input->post('userType');

                        if($userPostType==1){

                            $user_data = array();
                            if($userType==1){

                                $whereEqual = array('id'=>$value);        
                                $selectColumn['*'] = 'id, firstName, lastName, email';
                                $user_data = $this->model_common->getSingleDataByField('MaleCandidates',$selectColumn,$whereEqual);

                                $title_text = 'Male Candidates';

                                $receiverId = $value;

                                $userTypeId = 1;

                            } else if($userType==2){

                                $whereEqual = array('id'=>$value);        
                                $selectColumn['*'] ='id, firstName, lastName, email';
                                $user_data = $this->model_common->getSingleDataByField('FemaleCandidates',$selectColumn,$whereEqual);

                                $title_text = 'Female Candidates';

                                $receiverId = $value;

                                $userTypeId = 2;

                            }

                            // true case
                            $data = array(      
                                'senderId' => $_SESSION['id'],
                                'receiverId' => $receiverId,
                                'userType' => $userTypeId,
                                'subjectText' => $this->input->post('subjectText'),
                                'messageText' => $this->input->post('messageText'),
                                'addedByAdmin' => 1,
                            );

                            if(!empty($user_data)){
                                $data['receiverFirstname'] = $user_data['firstName'];
                                $data['receiverLastname'] = $user_data['lastName'];
                                $data['receiverEmail'] = $user_data['email'];
                            }


                            $create = $this->model_common->insertTableData($data, 'messages');


                            $datap = array(     
                                'pdfID' => $createpdf,
                                'consultantID' => $value,
                                'userTypeID' => $userTypeId,
                            );

                            $createp = $this->model_common->insertTableData($datap, 'pdfSentToConsultants');

                            $message='';
                            $this->data['poname']  = 'Shia Connections';
                            $fromEmail = $this->config->item('admin_email');
                            $toEmail =  $user_data['email'];
                            $subject = $this->input->post('subjectText');
                            $this->data['message']  = $this->input->post('messageText');

                            $message = $this->load->view('templates/email/email_template',$this->data,true);    
                            $result = $this->model_common->sendEmailPdf($fromEmail,$toEmail,$subject,$message,$fileURL);

                        } else {

                            $datap = array(     
                                'pdfID' => $createpdf,
                                'consultantID' => $value
                            );

                            $createp = $this->model_common->insertTableData($datap, 'pdfSentToConsultants');

                            $user_data = array();
                            if($userType==1){

                                $whereEqual = array('id'=>$value);        
                                $selectColumn['*'] = 'id, firstName, lastName, email';
                                $user_data = $this->model_common->getSingleDataByField('Consultants',$selectColumn,$whereEqual);

                                $title_text = 'Male Consultants';

                                $receiverId = $value;

                                $userTypeId = 3;

                            } else if($userType==2){

                                $whereEqual = array('id'=>$value);        
                                $selectColumn['*'] ='id, firstName, lastName, email';
                                $user_data = $this->model_common->getSingleDataByField('Consultants',$selectColumn,$whereEqual);

                                $title_text = 'Female Consultants';

                                $receiverId = $value;

                                $userTypeId = 4;

                            }

                            // true case
                            $data = array(      
                                'senderId' => $_SESSION['id'],
                                'receiverId' => $receiverId,
                                'userType' => $userTypeId,
                                'subjectText' => $this->input->post('subjectText'),
                                'messageText' => $this->input->post('messageText'),
                                'addedByAdmin' => 1,
                            );

                            if(!empty($user_data)){
                                $data['receiverFirstname'] = $user_data['firstName'];
                                $data['receiverLastname'] = $user_data['lastName'];
                                $data['receiverEmail'] = $user_data['email'];
                            }


                            $create = $this->model_common->insertTableData($data, 'messages');

                            $message='';
                            $this->data['poname']  = 'Shia Connections';
                            $fromEmail = $this->config->item('admin_email');
                            $toEmail =  $user_data['email'];
                            $subject = $this->input->post('subjectText');
                            $this->data['message']  = $this->input->post('messageText');

                            $message = $this->load->view('templates/email/email_template',$this->data,true);    
                            $result = $this->model_common->sendEmailPdf($fromEmail,$toEmail,$subject,$message,$fileURL);
                        }
                    
                    }
                }
            }
            
            if($create>0) {  
                $this->session->set_flashdata('success', 'Message successfully sent to the '.$title_text.'.');
                redirect('search', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Error occurred!!');
                redirect('search', 'refresh');
            }

        }       
    }
}
