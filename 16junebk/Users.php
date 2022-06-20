<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller  {
 
	 	public function __construct()
	{
		parent::__construct();

		 $this->not_logged_in();
		  
		$this->data['page_title'] = 'Admin Dashboard';
		$this->global_tblusers = 'MaleCandidates';
		$this->global_messages = 'messages';
		$this->global_tblfemaleusers = 'FemaleCandidates';
		$this->global_tblconsultants = 'Consultants';
		$this->load->model('model_users'); 
		$this->load->model('model_common'); 
		$this->load->helper('date');
		$this->data['view_path'] = 'admin/users';
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
                // $this->data['Ethnicity'] = $this->model_common->getMultipleDataByField('Ethnicity',$etselectColumn,$etwhereEqual,$etorder);
                $this->data['Ethnicity'] = $this->model_common->get_all_records('Ethnicity');

                $hiwhereEqual = array('gender'=>'M');        
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

                $MawhereEqual = array('isActive'=>1, 'deleted'=>0);          
                $MaselectColumn['*'] = '*';  
                $Maorder = array();
                $Maorder['userMarriedStatusName'] = 'ASC'; 
                $this->data['MarriedStatus'] = $this->model_common->getMultipleDataByField('userMarriedStatus',$MaselectColumn,$MawhereEqual,$Maorder);

	 	$this->render_admin_layouts('admin/users/index', $this->data);
	 	
	 } 


	 public function create()
	{	
		if(($this->input->post('firstName')!='') && ($this->input->post('lastName')!='') && ($this->input->post('phone')!='') && ($this->input->post('email')!='')  && ($this->input->post('pwd')!='')){

			if($this->input->post('type')==0){
				$consultants = $this->input->post('g_consultants');
			} else if($this->input->post('type')==1){
				$consultants = $this->input->post('t_consultants');
			} else if($this->input->post('type')==2){
				$consultants = $this->input->post('consultants');
			}
            // true case
            $password = md5($this->input->post('pwd')); 
        	$data = array(  	
        		'email' => $this->input->post('email'),
        		'consultant_id' => $consultants,
        		'firstName' => $this->input->post('firstName'),
        		'lastName' => $this->input->post('lastName'),
                'pwd' => $password,
        		'phone' => $this->input->post('phone'),
        		'consultant_cat_id' => $this->input->post('type'),
                'registrationDate' => date("Y-m-d H:i:s"),
                'marriedStatus' => $this->input->post('marriedStatus'),
        	);

        	$create = $this->model_common->insertTableData($data, $this->global_tblusers);
        	if($create>0) {  
        		$this->session->set_flashdata('success', 'The user was created successfully.');
        		redirect('users', 'refresh');
        	} else {
        		$this->session->set_flashdata('error', 'Error occurred!!');
        		redirect('users/create', 'refresh');
        	}

        } else {
            // false case
         	
         	$conwhereEqual = array('status'=>1,'deleted'=>0,'gender'=>0,'type'=>2);          
			$conselectColumn['*'] = '*';  
			$conorder['firstName'] = 'ASC'; 
			$consultants = $this->model_common->getMultipleDataByField('Consultants',$conselectColumn,$conwhereEqual,$conorder);

         	$conwhereEqual = array('status'=>1,'deleted'=>0,'gender'=>0,'type'=>0);          
			$conselectColumn['*'] = '*';  
			$conorder['firstName'] = 'ASC'; 
			$guiding_consultants = $this->model_common->getMultipleDataByField('Consultants',$conselectColumn,$conwhereEqual,$conorder);

			$conwhereEqual = array('status'=>1,'deleted'=>0,'gender'=>0,'type'=>1);          
			$conselectColumn['*'] = '*';  
			$conorder['firstName'] = 'ASC'; 
			$transactional_consultants = $this->model_common->getMultipleDataByField('Consultants',$conselectColumn,$conwhereEqual,$conorder);

			$this->data['guiding_consultants'] = array_merge($guiding_consultants,$consultants);

			$this->data['transactional_consultants'] = array_merge($transactional_consultants,$consultants);

			$conwhereEqual = array('status'=>1,'deleted'=>0,'gender'=>0);          
			$conselectColumn['*'] = '*';  
			$conorder['firstName'] = 'ASC'; 
			$this->data['consultants'] = $this->model_common->getMultipleDataByField('Consultants',$conselectColumn,$conwhereEqual,$conorder);

			$MawhereEqual = array('isActive'=>1, 'deleted'=>0);          
            $MaselectColumn['*'] = '*';  
            $Maorder = array();
            $Maorder['userMarriedStatusName'] = 'ASC'; 
            $this->data['MarriedStatus'] = $this->model_common->getMultipleDataByField('userMarriedStatus',$MaselectColumn,$MawhereEqual,$Maorder);

            $this->render_admin_layouts($this->data['view_path'].'/create', $this->data);
        }		
	}

	public function edit($id = null)
	{
		if($id) { 
			
			if(($this->input->post('firstName')!='') && ($this->input->post('lastName')!='') && ($this->input->post('phone')!='') && ($this->input->post('email')!='') ){

            //    	$mainimage = '';
	           //  if ($_FILES['primimage']['size']>0) {

	           //      $uploaddir = FCPATH.'/uploads/users/';
	           //      @chmod($uploaddir, 0777);
	           //      $ext = pathinfo($_FILES['primimage']['name'], PATHINFO_EXTENSION);
	           //      if($ext == 'png'){
	           //      	$filenm = $id .'_prim.'.$ext;
	           //      $mainimage = str_replace(' ', '-', $filenm);
	           //      $uploadfile = $uploaddir . $mainimage;

	           //      move_uploaded_file($_FILES['primimage']['tmp_name'], $uploadfile);
	           //      }
	           //      else{
	           //      	$this->session->set_flashdata('error', 'Error occurred!!');
		        		// redirect('users/edit/'.$id, 'refresh');
	           //      }
	                

	           //  } else{
	           //  	 $mainimage = $this->input->post('hidden_primimage');
	           //  }

	            // $image2 = '';
	            // if ($_FILES['image1']['size']>0) {

	            //     $uploaddir = FCPATH.'/uploads/users/';
	            //     @chmod($uploaddir, 0777);
	            //     $ext = pathinfo($_FILES['image1']['name'], PATHINFO_EXTENSION);

	            //     $filenm = $id .'_next.'.$ext;
	            //     $image2 = str_replace(' ', '-', $filenm);
	            //     $uploadfile = $uploaddir . $image2;

	            //     move_uploaded_file($_FILES['image1']['tmp_name'], $uploadfile);


	            // }  else{
	            // 	$image2 = $this->input->post('hidden_image1');
	            // }
				// true case

				if($this->input->post('consultant_cat_id')==0){
					$consultants = $this->input->post('g_consultants');
				} else if($this->input->post('consultant_cat_id')==1){
					$consultants = $this->input->post('t_consultants');
				} else if($this->input->post('consultant_cat_id')==2){
					$consultants = $this->input->post('consultants');
				}

				$marriedStatus = 0;
				if($this->input->post('status')==1){
					$marriedStatus = $this->input->post('marriedStatus_active');
				} else if($this->input->post('type')==0){
					$marriedStatus = $this->input->post('marriedStatus_inactive');
				}

		        if(empty($this->input->post('pwd')) && empty($this->input->post('cpassword'))) {
 					
 					$personalEthnicityID = '';
		            if(!empty($this->input->post('personalEthnicityID'))){
		            	$personalEthnicityID = implode(",", $this->input->post('personalEthnicityID'));
		            }

		            $spouseEthnicityID = '';
		            if(!empty($this->input->post('spouseEthnicityID'))){
		            	$spouseEthnicityID = implode(",", $this->input->post('spouseEthnicityID'));
		            }

		        	$updateData = array( 
		        		'email' => $this->input->post('email'),
		        		'consultant_id' => $consultants,
		        		'firstName' => $this->input->post('firstName'),
		        		'lastName' => $this->input->post('lastName'),
		        		'phone' => $this->input->post('phone'),
		        		'birthdate' => date('Y-m-d',strtotime($this->input->post('birthdate'))),
		        		'fathersName' => $this->input->post('fathersName'),
		        		'mothersName' => $this->input->post('mothersName'),
		        		'cityOfResidence' => $this->input->post('cityOfResidence'), 
		        		'countryOfResidence' => $this->input->post('countryOfResidence'),
		        		'heightCM' => $this->input->post('heightCM'),
		        		'citizenshipStatusID' => $this->input->post('citizenshipStatusID'),
		        		'durationOfStayID' => $this->input->post('durationOfStayID'),  
		        		'personalEthnicityID' => $personalEthnicityID,  
		        		'personalEthnicityOther' => $this->input->post('personalEthnicityOther'),  
		        		'cityOfBirth' => $this->input->post('cityOfBirth'),  
		        		'areaOfStudy' => $this->input->post('areaOfStudy'),  
		        		'highestEducationLevelID' => $this->input->post('highestEducationLevelID'),  
		        		'currentOccupation' => $this->input->post('currentOccupation'),  
		        		'maritalStatusID' => $this->input->post('maritalStatusID'),  
		        		'willingToRelocate' => $this->input->post('willingToRelocate'),  
		        		'afterMarriageLivingOther' => $this->input->post('LivingStyle_OTHER'),  
		        		'spouseEthnicityID' => $spouseEthnicityID, 
		        		'spouseEthnicityOther' => $this->input->post('spouseEthnicityOther'),  
		        		'hijabPreferenceID' => $this->input->post('hijabPreferenceID'),  
		        		'hijabPreferenceAdditional' => $this->input->post('hijabPreferenceAdditional'), 
		        		'considerDivorcee' => $this->input->post('considerDivorcee'),  
		        		'mosqueVisitOther' => $this->input->post('MosqueFrequency_OTHER'),  
		        		'myCharacteristics1' => $this->input->post('myCharacteristics1'),  
		        		'myCharacteristics2' => $this->input->post('myCharacteristics2'),  
		        		'myCharacteristics3' => $this->input->post('myCharacteristics3'),  
		        		'preferences' => $this->input->post('preferences'),  
		        		'aboutMe' => $this->input->post('aboutMe'),  
		        		'otherDetails' => $this->input->post('otherDetails'),   
		        		'interestsHobbiesOther' => $this->input->post('interestsHobbiesOther'),   
                        'registrationDate' => date("Y-m-d H:i:s"),
            //             'primimage' => $mainimage,  
		        		// 'image' => $image2, 
		        		'consultant_cat_id' => $this->input->post('consultant_cat_id'),
		        		'marriedStatus' => $marriedStatus,
		        		'status' => $this->input->post('status'),
		        	);

                    $whereEqual = array('id'=>$id);
                    $update = $this->model_common->updateTableData($updateData,$this->global_tblusers,$whereEqual);

                    $mainimage = '';
	            if ($_FILES['primimage']['size']>0) {

	                $uploaddir = FCPATH.'/uploads/users/';
	                @chmod($uploaddir, 0777);
	                $ext = pathinfo($_FILES['primimage']['name'], PATHINFO_EXTENSION);
	                $extconvert = strtolower($ext);
	                if(($extconvert == 'jpg') || ($extconvert == 'png')){
		                $filenm = $id .'_prim.'.$ext;
		                $mainimage = str_replace(' ', '-', $filenm);
		                $uploadfile = $uploaddir . $mainimage;

		                move_uploaded_file($_FILES['primimage']['tmp_name'], $uploadfile);
	                }else{
	                	$this->session->set_flashdata('error', 'We accept only .jpg and .png image');
		        		redirect('users/edit/'.$id, 'refresh');
	            	}
	            } else{
	            	 $mainimage = $this->input->post('hidden_primimage');
	            }

	            	$updateData1 = array(   
		        		'primimage' => $mainimage,  
		        	);
  
                    $whereEqual = array('id'=>$id);
                    $update = $this->model_common->updateTableData($updateData1,$this->global_tblusers,$whereEqual); 

	            $image2 = '';
	            if ($_FILES['image1']['size']>0) {

	                $uploaddir = FCPATH.'/uploads/users/';
	                @chmod($uploaddir, 0777);
	                $ext = pathinfo($_FILES['image1']['name'], PATHINFO_EXTENSION);
	                $extconvert2 = strtolower($ext);
	                if(($extconvert2 == 'jpg') || ($extconvert2 == 'png')){

		                $filenm = $id .'_next.'.$ext;
		                $image2 = str_replace(' ', '-', $filenm);
		                $uploadfile = $uploaddir . $image2;

		                move_uploaded_file($_FILES['image1']['tmp_name'], $uploadfile);
		            }else{
		            	$this->session->set_flashdata('error', 'We accept only .jpg and .png image');
		        		redirect('users/edit/'.$id, 'refresh');
		            }
	            }  else{
	            	$image2 = $this->input->post('hidden_image1');
	            }

	            $updateData2 = array(   
		        		'image' => $image2,  
		        	);
  
                    $whereEqual = array('id'=>$id);
                    $update = $this->model_common->updateTableData($updateData2,$this->global_tblusers,$whereEqual); 

                     $LivingArrangements = $this->input->post('LivingArrangements');

		        	if(!empty($LivingArrangements)){
		        		$afmwhere['mcid'] = $id;  
		        		$this->model_common->deleteTableData('MC_AfterMarriageLiving',$afmwhere);
		        			$afmvalues =array();
		        		foreach ($LivingArrangements as $key => $value) {
		        			$afmvalues['mcid'] =  $id;
		        			if($value > 0){
			        			$afmvalues['livingArrangementsID'] =$value;
			        			$this->model_common->insertTableData($afmvalues,'MC_AfterMarriageLiving'); 		        				
		        			}
		        		}
		        	}

		        	$AfterSpousePrefer = $this->input->post('LivingStyle');

		        	if(!empty($AfterSpousePrefer)){
		        		$afmpwhere['mcid'] = $id;  
		        		$this->model_common->deleteTableData('MC_AfterSpousePrefer',$afmpwhere);
		        			$afmpvalues =array();
		        		foreach ($AfterSpousePrefer as $key => $value) {
		        			$afmpvalues['mcid'] =  $id;
		        			if($value > 0){
		        				$afmpvalues['afterMarriagePreferenceMaleID'] =$value;
		        				$this->model_common->insertTableData($afmpvalues,'MC_AfterSpousePrefer'); 
		        			}
		        		}
		        	}

		        	
		        	$AgePreference = $this->input->post('AgePreference');
		        	if(!empty($AgePreference)){
		        		$agmwhere['mcid'] = $id;  
		        		$this->model_common->deleteTableData('MC_AgeRanges',$agmwhere);
		        			$agmvalues =array();
		        		foreach ($AgePreference as $key => $value) {
		        			$agmvalues['mcid'] = $id;
		        			if($value > 0){
		        				$agmvalues['ageRangeID'] =$value;
		        				$this->model_common->insertTableData($agmvalues,'MC_AgeRanges'); 
		        			}
		        		}
		        	}

		        	$MosqueFrequency = $this->input->post('MosqueFrequency');
		        	if(!empty($MosqueFrequency)){
		        		$momwhere['mcid'] = $id;  
		        		$this->model_common->deleteTableData('MC_MosqueVisits',$momwhere);
		        			$agmvalues =array();
		        		foreach ($MosqueFrequency as $key => $value) {
		        			$agmvalues['mcid'] = $id;
		        			if($value > 0){
		        				$agmvalues['mosqueVisitID'] =$value;
		        				$this->model_common->insertTableData($agmvalues,'MC_MosqueVisits'); 
		        			}
		        		}
		        	}


		        	$InterestHobbies = $this->input->post('InterestHobbies');
		        	if(!empty($InterestHobbies)){
		        		$momwhere['mcid'] = $id;  
		        		$this->model_common->deleteTableData('MC_InterestHobbies',$momwhere);
		        			$agmvalues =array();
		        		foreach ($InterestHobbies as $key => $value) {
		        			$agmvalues['mcid'] = $id;
		        			if($value > 0){
		        				$agmvalues['hobbiesID'] =$value;
		        				$this->model_common->insertTableData($agmvalues,'MC_InterestHobbies'); 
		        			}
		        		}
		        	}

		        	if($update == true) {
		        		$this->session->set_flashdata('success', 'The user has been successfully updated.');
		        		redirect('users', 'refresh');
		        	} else {
		        		$this->session->set_flashdata('error', 'Error occurred!!');
		        		redirect('users/edit/'.$id, 'refresh');
		        	}
		        } else {
		        	
					$password = md5($this->input->post('pwd'));

					$personalEthnicityID = '';
		            if(!empty($this->input->post('personalEthnicityID'))){
		            	$personalEthnicityID = implode(",", $this->input->post('personalEthnicityID'));
		            }

		            $spouseEthnicityID = '';
		            if(!empty($this->input->post('spouseEthnicityID'))){
		            	$spouseEthnicityID = implode(",", $this->input->post('spouseEthnicityID'));
		            }

					$updateData = array(
                       	'pwd' => $password,
		        		'consultant_id' => $consultants,
		        		'email' => $this->input->post('email'),
		        		'firstName' => $this->input->post('firstName'),
		        		'lastName' => $this->input->post('lastName'),
		        		'phone' => $this->input->post('phone'),
		        		'birthdate' => date('Y-m-d',strtotime($this->input->post('birthdate'))),
		        		'fathersName' => $this->input->post('fathersName'),
		        		'mothersName' => $this->input->post('mothersName'),
		        		'cityOfResidence' => $this->input->post('cityOfResidence'), 
		        		'countryOfResidence' => $this->input->post('countryOfResidence'),
		        		'heightCM' => $this->input->post('heightCM'),
		        		'citizenshipStatusID' => $this->input->post('citizenshipStatusID'),
		        		'durationOfStayID' => $this->input->post('durationOfStayID'),  
		        		'personalEthnicityID' => $personalEthnicityID,  
		        		'personalEthnicityOther' => $this->input->post('personalEthnicityOther'),  
		        		'cityOfBirth' => $this->input->post('cityOfBirth'),  
		        		'areaOfStudy' => $this->input->post('areaOfStudy'),  
		        		'highestEducationLevelID' => $this->input->post('highestEducationLevelID'),  
		        		'currentOccupation' => $this->input->post('currentOccupation'),  
		        		'maritalStatusID' => $this->input->post('maritalStatusID'),  
		        		'willingToRelocate' => $this->input->post('willingToRelocate'),  
		        		'afterMarriageLivingOther' => $this->input->post('LivingStyle_OTHER'),  
		        		'spouseEthnicityID' => $spouseEthnicityID,  
		        		'spouseEthnicityOther' => $this->input->post('spouseEthnicityOther'), 
		        		'hijabPreferenceID' => $this->input->post('hijabPreferenceID'),  
		        		'hijabPreferenceAdditional' => $this->input->post('hijabPreferenceAdditional'), 
		        		'considerDivorcee' => $this->input->post('considerDivorcee'),  
		        		'mosqueVisitOther' => $this->input->post('MosqueFrequency_OTHER'),  
		        		'myCharacteristics1' => $this->input->post('myCharacteristics1'),  
		        		'myCharacteristics2' => $this->input->post('myCharacteristics2'),  
		        		'myCharacteristics3' => $this->input->post('myCharacteristics3'),  
		        		'preferences' => $this->input->post('preferences'),  
		        		'aboutMe' => $this->input->post('aboutMe'),  
		        		'otherDetails' => $this->input->post('otherDetails'),  
		        		'interestsHobbiesOther' => $this->input->post('interestsHobbiesOther'),  
                        'registrationDate' => date("Y-m-d H:i:s"),
            //              'primimage' => $mainimage,  
		        		// 'image' => $image2, 
		        		'marriedStatus' => $marriedStatus,
		        		'status' => $this->input->post('status'),
		        	);

                    $whereEqual = array('id'=>$id); 
                    $update = $this->model_common->updateTableData($updateData,$this->global_tblusers,$whereEqual);

                     $mainimage = '';
	            if ($_FILES['primimage']['size']>0) {

	                $uploaddir = FCPATH.'/uploads/users/';
	                @chmod($uploaddir, 0777);
	                $ext = pathinfo($_FILES['primimage']['name'], PATHINFO_EXTENSION);
	                $extconvert = strtolower($ext);
	                if(($extconvert == 'jpg') || ($extconvert == 'png')){
		                $filenm = $id .'_prim.'.$ext;
		                $mainimage = str_replace(' ', '-', $filenm);
		                $uploadfile = $uploaddir . $mainimage;

		                move_uploaded_file($_FILES['primimage']['tmp_name'], $uploadfile);
	                }else{
	                	$this->session->set_flashdata('error', 'We accept only .jpg and .png image');
		        		redirect('users/edit/'.$id, 'refresh');
	            	}
	            } else{
	            	 $mainimage = $this->input->post('hidden_primimage');
	            }

	            	$updateData1 = array(   
		        		'primimage' => $mainimage,  
		        	);
  
                    $whereEqual = array('id'=>$id);
                    $update = $this->model_common->updateTableData($updateData1,$this->global_tblusers,$whereEqual); 

	            $image2 = '';
	            if ($_FILES['image1']['size']>0) {

	                $uploaddir = FCPATH.'/uploads/users/';
	                @chmod($uploaddir, 0777);
	                $ext = pathinfo($_FILES['image1']['name'], PATHINFO_EXTENSION);
	                $extconvert2 = strtolower($ext);
	                if(($extconvert2 == 'jpg') || ($extconvert2 == 'png')){

		                $filenm = $id .'_next.'.$ext;
		                $image2 = str_replace(' ', '-', $filenm);
		                $uploadfile = $uploaddir . $image2;

		                move_uploaded_file($_FILES['image1']['tmp_name'], $uploadfile);
		            }else{
		            	$this->session->set_flashdata('error', 'We accept only .jpg and .png image');
		        		redirect('users/edit/'.$id, 'refresh');
		            }
	            }  else{
	            	$image2 = $this->input->post('hidden_image1');
	            }

	            $updateData2 = array(   
		        		'image' => $image2,  
		        	);
  
                    $whereEqual = array('id'=>$id);
                    $update = $this->model_common->updateTableData($updateData2,$this->global_tblusers,$whereEqual); 

                     $LivingArrangements = $this->input->post('LivingArrangements');

		        	if(!empty($LivingArrangements)){
		        		$afmwhere['mcid'] = $id;  
		        		$this->model_common->deleteTableData('MC_AfterMarriageLiving',$afmwhere);
		        			$afmvalues =array();
		        		foreach ($LivingArrangements as $key => $value) {
		        			$afmvalues['mcid'] =  $id;
		        			if($value > 0){
			        			$afmvalues['livingArrangementsID'] =$value;
			        			$this->model_common->insertTableData($afmvalues,'MC_AfterMarriageLiving'); 		        				
		        			}
		        		}
		        	}

		        	$AfterSpousePrefer = $this->input->post('LivingStyle');

		        	if(!empty($AfterSpousePrefer)){
		        		$afmpwhere['mcid'] = $id;  
		        		$this->model_common->deleteTableData('MC_AfterSpousePrefer',$afmpwhere);
		        			$afmpvalues =array();
		        		foreach ($AfterSpousePrefer as $key => $value) {
		        			$afmpvalues['mcid'] =  $id;
		        			if($value > 0){
		        				$afmpvalues['afterMarriagePreferenceMaleID'] =$value;
		        				$this->model_common->insertTableData($afmpvalues,'MC_AfterSpousePrefer'); 
		        			}
		        		}
		        	}

		        	
		        	$AgePreference = $this->input->post('AgePreference');
		        	if(!empty($AgePreference)){
		        		$agmwhere['mcid'] = $id;  
		        		$this->model_common->deleteTableData('MC_AgeRanges',$agmwhere);
		        			$agmvalues =array();
		        		foreach ($AgePreference as $key => $value) {
		        			$agmvalues['mcid'] = $id;
		        			if($value > 0){
		        				$agmvalues['ageRangeID'] =$value;
		        				$this->model_common->insertTableData($agmvalues,'MC_AgeRanges'); 
		        			}
		        		}
		        	}

		        	$MosqueFrequency = $this->input->post('MosqueFrequency');
		        	if(!empty($MosqueFrequency)){
		        		$momwhere['mcid'] = $id;  
		        		$this->model_common->deleteTableData('MC_MosqueVisits',$momwhere);
		        			$agmvalues =array();
		        		foreach ($MosqueFrequency as $key => $value) {
		        			$agmvalues['mcid'] = $id;
		        			if($value > 0){
		        				$agmvalues['mosqueVisitID'] =$value;
		        				$this->model_common->insertTableData($agmvalues,'MC_MosqueVisits'); 
		        			}
		        		}
		        	}

		        	$InterestHobbies = $this->input->post('InterestHobbies');
		        	if(!empty($InterestHobbies)){
		        		$momwhere['mcid'] = $id;  
		        		$this->model_common->deleteTableData('MC_InterestHobbies',$momwhere);
		        			$agmvalues =array();
		        		foreach ($InterestHobbies as $key => $value) {
		        			$agmvalues['mcid'] = $id;
		        			if($value > 0){
		        				$agmvalues['hobbiesID'] =$value;
		        				$this->model_common->insertTableData($agmvalues,'MC_InterestHobbies'); 
		        			}
		        		}
		        	}

		        	if($update == true) {
		        		$this->session->set_flashdata('success', 'The user has been successfully updated.');
		        		redirect('users', 'refresh');
		        	} else {
		        		$this->session->set_flashdata('error', 'Error occurred!!');
		        		redirect('users/edit/'.$id, 'refresh');
		        	}
		        }

	        } else {
	            // false case
                $whereEqual = array('id'=>$id);        
                $selectColumn['*'] = '*';
                $this->data['user_data'] = $this->model_common->getSingleDataByField($this->global_tblusers,$selectColumn,$whereEqual);

                $conwhereEqual = array('status'=>1,'deleted'=>0,'gender'=>0,'type'=>2);          
				$conselectColumn['*'] = '*';  
				$conorder['firstName'] = 'ASC'; 
				$consultants = $this->model_common->getMultipleDataByField('Consultants',$conselectColumn,$conwhereEqual,$conorder);

	         	$conwhereEqual = array('status'=>1,'deleted'=>0,'gender'=>0,'type'=>0);          
				$conselectColumn['*'] = '*';  
				$conorder['firstName'] = 'ASC'; 
				$guiding_consultants = $this->model_common->getMultipleDataByField('Consultants',$conselectColumn,$conwhereEqual,$conorder);

				$conwhereEqual = array('status'=>1,'deleted'=>0,'gender'=>0,'type'=>1);          
				$conselectColumn['*'] = '*';  
				$conorder['firstName'] = 'ASC'; 
				$transactional_consultants = $this->model_common->getMultipleDataByField('Consultants',$conselectColumn,$conwhereEqual,$conorder);

				$this->data['guiding_consultants'] = array_merge($guiding_consultants,$consultants);

				$this->data['transactional_consultants'] = array_merge($transactional_consultants,$consultants);

				$conwhereEqual = array('status'=>1,'deleted'=>0,'gender'=>0);          
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

                $MawhereEqual = array('isActive'=>1, 'deleted'=>0);          
                $MaselectColumn['*'] = '*';  
                $Maorder = array();
                $Maorder['userMarriedStatusName'] = 'ASC'; 
                $this->data['MarriedStatus'] = $this->model_common->getMultipleDataByField('userMarriedStatus',$MaselectColumn,$MawhereEqual,$Maorder);

				$this->render_admin_layouts($this->data['view_path'].'/edit', $this->data);	
	        }	
		}	
	}

	public function delete($id)
	{

        if($id) {

            $whereEqual = array('id'=>$id);        
            $selectColumn['*'] = '*';
            $this->data['user_data'] = $this->model_common->getSingleDataByField($this->global_tblusers,$selectColumn,$whereEqual);

            $updateData['deleted'] = 1;
            $whereEqual = array('id'=>$id); 
            $update = $this->model_common->updateTableData($updateData,$this->global_tblusers,$whereEqual);

            if($update == true) {
                $this->session->set_flashdata('success', 'The user has been successfully deleted.');
                redirect('users', 'refresh');
            }
            else {
                $this->session->set_flashdata('error', 'Error occurred!!');
                redirect('users', 'refresh');
            }

        }
	}

    public function fetch_users(){

        // equal condition
        $whereEqual = array();
 		$orwhere = array( ); 

	    $start_date = $this->input->post('start_date'); 
	    $end_date = $this->input->post('end_date'); 
	   	 
	       
 		if((isset($start_date) && $start_date > 0) && isset($end_date) && $end_date > 0 ){
 			$whereEqual  = array($this->global_tblusers.'.registrationDate >= ' => date('Y-m-d',strtotime($start_date)), $this->global_tblusers.'.registrationDate <= '=> date('Y-m-d',strtotime($end_date) )); 
 			  
 		}

 		$MawhereEqual = array('isActive'=>1);          
            $MaselectColumn['*'] = '*';  
            $Maorder = array();
            $Maorder['userMarriedStatusName'] = 'ASC'; 
            $allMarriedStatus = $this->model_common->getMultipleDataByField('userMarriedStatus',$MaselectColumn,$MawhereEqual,$Maorder);


	      $consultants = $this->input->post('consultants');
	      $countryOfResidence = $this->input->post('countryOfResidence');
	      $personalEthnicityID = $this->input->post('personalEthnicityID');
	      $ageRange = $this->input->post('ageRange');
	      $citizenshipStatusID = $this->input->post('citizenshipStatusID');
	      $durationOfStayID = $this->input->post('durationOfStayID');
	      $highestEducationLevelID = $this->input->post('highestEducationLevelID');
	      $willingToRelocate = $this->input->post('willingToRelocate');
	      $maritalStatusID = $this->input->post('maritalStatusID');
	      $hijabPreferenceID = $this->input->post('hijabPreferenceID');
	      $from_height = $this->input->post('from_height');
		  $to_height = $this->input->post('to_height');
	      $from_age = $this->input->post('from_age');
	      $to_age = $this->input->post('to_age');
	      $status = $this->input->post('status');
 		

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

 		if(isset($consultants) && $consultants > 0 ){
 			 $whereEqual[$this->global_tblusers.'.consultant_id'] = $consultants;
 		}
		/*if(isset($countryOfResidence) && $countryOfResidence > 0 ){
 			 $whereEqual[$this->global_tblusers.'.countryOfResidence'] = $countryOfResidence;
 		}

 		if(isset($personalEthnicityID) && $personalEthnicityID > 0 ){
 			$whereEqual[$this->global_tblusers.'.personalEthnicityID'] = $personalEthnicityID;
 		}

 		if(isset($hijabPreferenceID) && $hijabPreferenceID > 0 ){
 			$whereEqual[$this->global_tblusers.'.hijabPreferenceID'] = $hijabPreferenceID;
 		}*/

 		if(isset($heightCM) && $heightCM > 0 ){
 			$whereEqual[$this->global_tblusers.'.heightCM'] = $heightCM;
 		}


 		/*if(isset($ageRange) && $ageRange > 0 ){
 			$whereEqual['MC_AgeRanges.ageRangeID'] = $ageRange;
 		}*/


		if(isset($citizenshipStatusID) && $citizenshipStatusID > 0 ){
 			$whereEqual[$this->global_tblusers.'.citizenshipStatusID'] = $citizenshipStatusID;
 		} 

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

 		//$whereEqual[$this->global_tblusers.'.consultant_cat_id'] = 1;
 	 
		$uorder = array();
    	$uselectColumn['birthdate'] = 'birthdate'; 
    	$uwhereEqual['status'] = 1;
    	$afjoinTableArray = array();
	 	$MaleCandidatesList = $this->model_common->get_table_records('MaleCandidates',$uselectColumn,$uwhereEqual,$afjoinTableArray,$uorder);   
 		
 		
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
        $orderColumn = array("", "", $this->global_tblusers.".id", $this->global_tblusers.".registrationDate", $this->global_tblusers.".firstName", $this->global_tblusers.".lastName", "", "", "", $this->global_tblusers.".last_login");

        // search column
        $searchColumn = array($this->global_tblusers.".cityOfResidence", $this->global_tblusers.".firstName", $this->global_tblusers.".email", $this->global_tblusers.".lastName","Consultants.firstName","Consultants.lastName");

        // order by
        $orderBy = array($this->global_tblusers.'.status' => "DESC");
       // $orderBy = array($this->global_tblusers.'.registrationDate' => "DESC");

        // join table
        $joinTableArray = array();
        /*$joinTableArray = array(array("joinTable"=>'Consultants', "joinField"=>"id", "relatedJoinTable"=>$this->global_tblusers, "relatedJoinField"=>"consultant_id","type"=>"left"), 
        array("joinTable"=>'MC_AgeRanges', "joinField"=>"mcid", "relatedJoinTable"=>$this->global_tblusers, "relatedJoinField"=>"id","type"=>"left"));*/

        $joinTableArray = array(array("joinTable"=>'Consultants', "joinField"=>"id", "relatedJoinTable"=>$this->global_tblusers, "relatedJoinField"=>"consultant_id","type"=>"left"));
 

        $fetch_data = $this->model_common->make_datatables($this->global_tblusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$orwhere);
    	 
     
        $data = array();
        $countryliving = '';
        foreach ($fetch_data as $row) {
            $sub_array = array();

            $sub_array[] =  '<td><label class="form-controlNew"><input type="checkbox" class="checkSingle" name="custom_check[]" id="custom_check_'.$row->id.'" value="'.$row->id.'"/></label>';

            if($row->primimage && file_exists( 'uploads/users/'.$row->primimage) ){
                $sub_array[] =  '<img class="myImg" onclick="myFunction('.$row->id.');" id="myImg'.$row->id.'" height="50" src="'.base_url('uploads/users/'.$row->primimage).'">';
            } else {
                $sub_array[] =  '<img height="50" src="'.base_url('assets/images/male.jpeg').'">';
            }
 
            if($row->deleted == 1){
            	$sub_array[] = '<del class="text-danger">'.$row->id.'</del>';
            	$sub_array[] = '<del class="text-danger">'.$this->model_common->dateFormat($row->registrationDate).'</del>';
	            $sub_array[] = '<del class="text-danger">'.$row->firstName.'</del>';
	            $sub_array[] = '<del class="text-danger">'.$row->lastName.'</del><br> <span class="text-muted">Reason : '.$row->delete_reason.'</span>';
        	} else {
	    		$sub_array[] = $row->id;
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

            $cwhereEqual1['id'] = $row->marriedStatus;          
             $cselectColumn1 = array();
            $cselectColumn1['userMarriedStatusName'] = 'userMarriedStatusName';   
            $userMarriedStatusName = $this->model_common->getSingleDataByField('userMarriedStatus',$cselectColumn1,$cwhereEqual1 );

            $candidatestausLink = '';

            //if($row->marriedStatus!=0){
            	$candidatestausLink .=  '<a style="display:none" class="btn btn-info candidatestatus_' . $row->id .'" href="javascript:void(0)" data-toggle="modal" data-target="#candidatestatus_' . $row->id .'" data-id="' . $row->id . '">'.$userMarriedStatusName['userMarriedStatusName'].'</a>';
            /*} else {
            	$candidatestausLink .=  '<a class="btn btn-info" href="javascript:void(0)" data-toggle="modal" data-target="#candidatestatus_' . $row->id .'" data-id="' . $row->id . '">Not Defined</a>';
            } */

            

            $candidatestausLink .='<div id="candidatestatus_'.$row->id.'" class="modal fade " role="dialog">
						<div class="modal-dialog modal-lg"> 
							<div class="modal-content"> 
						
								<div class="modal-header"> 
									<h4 class="modal-title">Inactive Reason</h4>
								</div>
								<div class="modal-body"> 
								<form id="deleteuser" class="deleteuser" method="post">
									<input type="hidden" name="delete_user_id" id="delete_user_id" value="'.$row->id.'">';
							                  
							         if(!empty($allMarriedStatus)){
							         	foreach ($allMarriedStatus as $key => $value) {
							         			
							         			$candidatestausLink .='<div class="form-check">
								                      <label class="form-check-label">
								                        <input type="radio" class="form-check-input" name="reason" value="'.$value['id'].'">'.$value['userMarriedStatusName'].'
								                      </label>
								                    </div>';

							         	}
							         }

            

			                     $candidatestausLink .='<button  type="button" id="submitreasoncandidate" data-uid="'.$row->id.'" class="btn btn-success">Update Status</button>
			                 </form>
								<div>
								    </div>
										<div class="modal-footer">
										  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div></div></div></div>';

			if($row->status==0){
				$candidatestausLink .= $userMarriedStatusName['userMarriedStatusName'];
			}

			$sub_array[] =  $candidatestausLink;

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

                  /*$setwhereEqual['id'] = $row->spouseEthnicityID;        
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
									<h4 class="modal-title">Inactive Reason</h4>
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

											 $heightCM = $row->heightCM ? : "&lt;137";
											$actionLink .= '<tr><td>Height Inches:  </td><td>'.$heightCM.'</td></tr>'; 

											 @$citizenshipStatusID = $CitizenshipStatus['statusName'] ? : "-";
											$actionLink .= '<tr><td>Citizenship Status :  </td><td>'.$citizenshipStatusID.'</td></tr>'; 

											 @$durationOfStayID = $DurationOfStay['desc'] ? : "-";
											$actionLink .= '<tr><td>Duration of Stay  :  </td><td>'.$durationOfStayID.'</td></tr>'; 

											 //@$Ethnicity = $Ethnicity['ethnicityName'] ? : "-";
											$actionLink .= '<tr><td>Ethnicity :  </td><td>'.$Ethnicity.'</td></tr>'; 	


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
 

											//@$sEthnicity = $sEthnicity['ethnicityName'] ? : "-";
											$actionLink .= '<tr><td>Spouse Ethnicity :  </td><td>'.$sEthnicity.'</td></tr>'; 

											@$HijabPreference = $HijabPreference['hijabPreferenceName'] ? : "-";
											$actionLink .= '<tr><td>Hijab Preference :  </td><td>'.$HijabPreference.'</td></tr>'; 

											@$hijabPreferenceAdditional = $row->hijabPreferenceAdditional ? : "-";
											$actionLink .= '<tr><td>Hijab Preference Additional :  </td><td>'.$hijabPreferenceAdditional.'</td></tr>';
 
											@$considerDivorcee = $row->considerDivorcee ? : "-";
											$actionLink .= '<tr><td>Consider Divorcee :  </td><td>'.$considerDivorcee.'</td></tr>';

											@$mosqueVisitOther = $row->mosqueVisitOther ? : "-";
											$actionLink .= '<tr><td>Mosque Visit:  </td><td>'.$mosqueVisitOther.'</td></tr>';

											@$myCharacteristics1 = $row->myCharacteristics1 ? : "-";
											$actionLink .= '<tr><td>My Characteristics 1 :  </td><td>'.$myCharacteristics1.'</td></tr>';

											@$myCharacteristics2 = $row->myCharacteristics2 ? : "-";
											$actionLink .= '<tr><td>My Characteristics 2 :  </td><td>'.$myCharacteristics2.'</td></tr>';

											@$myCharacteristics3 = $row->myCharacteristics3 ? : "-";
											$actionLink .= '<tr><td>My Characteristics 3 :  </td><td>'.$myCharacteristics3.'</td></tr>';

											@$preferences = $row->preferences ? : "-";
											$actionLink .= '<tr><td>Preferences :  </td><td>'.$preferences.'</td></tr>';

											@$aboutMe = $row->aboutMe ? : "-";
											$actionLink .= '<tr><td>About Me   :  </td><td>'.$aboutMe.'</td></tr>'; 

											@$otherDetails = $row->otherDetails ? : "-";
											$actionLink .= '<tr><td>Other Details :  </td><td>'.$otherDetails.'</td></tr>';


											if(!empty($LivingArrangements)){
		        		 	 
												$actionLink .= '<tr><td>Living Arrangements : </td>';
												$afmvalues =array();
												foreach ($LivingArrangements as $key => $value) { 
												if($value > 0){
												 $actionLink .= ' <td>'. $value['description'].'</td> ';

													}
												}
												$actionLink .= '</tr>'; 
		        		 
		        							}

		        							if(!empty($AfterSpousePrefer)){
		        		 	 
												$actionLink .= '<tr><td>Living Style : </td>';
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
											$actionLink .= '<tr><td>Interests Hobbies Other :  </td><td>'.$interestsHobbiesOther.'</td></tr>'; 
 

										 
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
            "recordsTotal" => $this->model_common->get_all_data($this->global_tblusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "recordsFiltered" => $this->model_common->get_filtered_data($this->global_tblusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "data" => $data,
        );
        echo json_encode($output);
        
    }


    public function fetch_users_consultant(){


        // equal condition
        $whereEqual = array();
 	
 		$MawhereEqual = array('isActive'=>1);          
            $MaselectColumn['*'] = '*';  
            $Maorder = array();
            $Maorder['userMarriedStatusName'] = 'ASC'; 
            $allMarriedStatus = $this->model_common->getMultipleDataByField('userMarriedStatus',$MaselectColumn,$MawhereEqual,$Maorder);

	    $consultants = $this->input->post('consultants');
	    
 		if(isset($consultants) && $consultants > 0 ){
 			 $whereEqual[$this->global_tblusers.'.consultant_id'] = $consultants;
 		}

 		//$whereEqual[$this->global_tblusers.'.consultant_cat_id'] = 1;
 	 
		$uorder = array();
    	$uselectColumn['birthdate'] = 'birthdate'; 
    	$uwhereEqual['status'] = 1;
    	$afjoinTableArray = array();
	 	$MaleCandidatesList = $this->model_common->get_table_records('MaleCandidates',$uselectColumn,$uwhereEqual,$afjoinTableArray,$uorder);   
 		
        // not equal condition
        $whereNotEqual = array();

        $notIn = array();     

        // select data
        $selectColumn[$this->global_tblusers.'.*'] = $this->global_tblusers.'.*';
        $selectColumn['Consultants.firstName'] =  'Consultants.firstName as cfname';
        $selectColumn['Consultants.lastName'] =  'Consultants.lastName as clname';
        $selectColumn['Consultants.type'] =  'Consultants.type as consultants_type';

        // order column
        $orderColumn = array($this->global_tblusers.".id", $this->global_tblusers.".registrationDate", $this->global_tblusers.".firstName", $this->global_tblusers.".lastName", $this->global_tblusers.".last_login");

        // search column
        $searchColumn = array($this->global_tblusers.".cityOfResidence", $this->global_tblusers.".firstName", $this->global_tblusers.".email", $this->global_tblusers.".lastName","Consultants.firstName","Consultants.lastName");

        // order by
        $orderBy = array($this->global_tblusers.'.status' => "DESC");
       // $orderBy = array($this->global_tblusers.'.registrationDate' => "DESC");

        // join table
        $joinTableArray = array();
        $joinTableArray = array(array("joinTable"=>'Consultants', "joinField"=>"id", "relatedJoinTable"=>$this->global_tblusers, "relatedJoinField"=>"consultant_id","type"=>"left"), 
        /*array("joinTable"=>'MC_AgeRanges', "joinField"=>"mcid", "relatedJoinTable"=>$this->global_tblusers, "relatedJoinField"=>"id","type"=>"left")*/);
 

        $fetch_data = $this->model_common->make_datatables($this->global_tblusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);
    	 
     
        $data = array();
        $countryliving = '';
        foreach ($fetch_data as $row) {
            $sub_array = array();

            if($row->primimage && file_exists( 'uploads/users/'.$row->primimage) ){
                $sub_array[] =  '<img class="myImg" onclick="myFunction('.$row->id.');" id="myImg'.$row->id.'" height="50" src="'.base_url('uploads/users/'.$row->primimage).'">';
            } else {
                $sub_array[] =  '<img height="50" src="'.base_url('assets/images/male.jpeg').'">';
            }
 
            if($row->deleted == 1){
            	$sub_array[] = '<del class="text-danger">'.$row->id.'</del>';
            	$sub_array[] = '<del class="text-danger">'.$this->model_common->dateFormat($row->registrationDate).'</del>';
	            $sub_array[] = '<del class="text-danger">'.$row->firstName.'</del>';
	            $sub_array[] = '<del class="text-danger">'.$row->lastName.'</del><br> <span class="text-muted">Reason : '.$row->delete_reason.'</span>';
        	} else {
            	$sub_array[] = $row->id;
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


            $cwhereEqual1['id'] = $row->marriedStatus;          
             $cselectColumn1 = array();
            $cselectColumn1['userMarriedStatusName'] = 'userMarriedStatusName';   
            $userMarriedStatusName = $this->model_common->getSingleDataByField('userMarriedStatus',$cselectColumn1,$cwhereEqual1 );

            $candidatestausLink = '';

            //if($row->marriedStatus!=0){
            	$candidatestausLink .=  '<a style="display:none"class="btn btn-info candidatestatus_' . $row->id .'" href="javascript:void(0)" data-toggle="modal" data-target="#candidatestatus_' . $row->id .'" data-id="' . $row->id . '">'.$userMarriedStatusName['userMarriedStatusName'].'</a>';
            /*} else {
            	$candidatestausLink .=  '<a class="btn btn-info" href="javascript:void(0)" data-toggle="modal" data-target="#candidatestatus_' . $row->id .'" data-id="' . $row->id . '">Not Defined</a>';
            }*/

            

            $candidatestausLink .='<div id="candidatestatus_'.$row->id.'" class="modal fade " role="dialog">
						<div class="modal-dialog modal-lg"> 
							<div class="modal-content"> 
						
								<div class="modal-header"> 
									<h4 class="modal-title">Inactive Reason</h4>
								</div>
								<div class="modal-body"> 
								<form id="deleteuser" class="deleteuser" method="post">
									<input type="hidden" name="delete_user_id" id="delete_user_id" value="'.$row->id.'">';
							                  
							         if(!empty($allMarriedStatus)){
							         	foreach ($allMarriedStatus as $key => $value) {
							         			
							         			$candidatestausLink .='<div class="form-check">
								                      <label class="form-check-label">
								                        <input type="radio" class="form-check-input" name="reason" value="'.$value['id'].'">'.$value['userMarriedStatusName'].'
								                      </label>
								                    </div>';

							         	}
							         }

            

			                     $candidatestausLink .='<button  type="button" id="submitreasoncandidate" data-uid="'.$row->id.'" class="btn btn-success">Update Status</button>
			                 </form>
								<div>
								    </div>
										<div class="modal-footer">
										  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div></div></div></div>';

			if($row->status==0){
				$candidatestausLink .= $userMarriedStatusName['userMarriedStatusName'];
			}

			$sub_array[] =  $candidatestausLink;

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

                  /*$setwhereEqual['id'] = $row->spouseEthnicityID;        
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
									<h4 class="modal-title">Inactive Reason</h4>
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

											 $heightCM = $row->heightCM ? : "&lt;137";
											$actionLink .= '<tr><td>Height Inches:  </td><td>'.$heightCM.'</td></tr>'; 

											 @$citizenshipStatusID = $CitizenshipStatus['statusName'] ? : "-";
											$actionLink .= '<tr><td>Citizenship Status :  </td><td>'.$citizenshipStatusID.'</td></tr>'; 

											 @$durationOfStayID = $DurationOfStay['desc'] ? : "-";
											$actionLink .= '<tr><td>Duration of Stay  :  </td><td>'.$durationOfStayID.'</td></tr>'; 

											 //@$Ethnicity = $Ethnicity['ethnicityName'] ? : "-";
											$actionLink .= '<tr><td>Ethnicity :  </td><td>'.$Ethnicity.'</td></tr>'; 	


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
 

											//@$sEthnicity = $sEthnicity['ethnicityName'] ? : "-";
											$actionLink .= '<tr><td>Spouse Ethnicity :  </td><td>'.$sEthnicity.'</td></tr>'; 

											@$HijabPreference = $HijabPreference['hijabPreferenceName'] ? : "-";
											$actionLink .= '<tr><td>Hijab Preference :  </td><td>'.$HijabPreference.'</td></tr>'; 

											@$hijabPreferenceAdditional = $row->hijabPreferenceAdditional ? : "-";
											$actionLink .= '<tr><td>Hijab Preference Additional :  </td><td>'.$hijabPreferenceAdditional.'</td></tr>';
 
											@$considerDivorcee = $row->considerDivorcee ? : "-";
											$actionLink .= '<tr><td>Consider Divorcee :  </td><td>'.$considerDivorcee.'</td></tr>';

											@$mosqueVisitOther = $row->mosqueVisitOther ? : "-";
											$actionLink .= '<tr><td>Mosque Visit:  </td><td>'.$mosqueVisitOther.'</td></tr>';

											@$myCharacteristics1 = $row->myCharacteristics1 ? : "-";
											$actionLink .= '<tr><td>My Characteristics 1 :  </td><td>'.$myCharacteristics1.'</td></tr>';

											@$myCharacteristics2 = $row->myCharacteristics2 ? : "-";
											$actionLink .= '<tr><td>My Characteristics 2 :  </td><td>'.$myCharacteristics2.'</td></tr>';

											@$myCharacteristics3 = $row->myCharacteristics3 ? : "-";
											$actionLink .= '<tr><td>My Characteristics 3 :  </td><td>'.$myCharacteristics3.'</td></tr>';

											@$preferences = $row->preferences ? : "-";
											$actionLink .= '<tr><td>Preferences :  </td><td>'.$preferences.'</td></tr>';

											@$aboutMe = $row->aboutMe ? : "-";
											$actionLink .= '<tr><td>About Me   :  </td><td>'.$aboutMe.'</td></tr>'; 

											@$otherDetails = $row->otherDetails ? : "-";
											$actionLink .= '<tr><td>Other Details :  </td><td>'.$otherDetails.'</td></tr>';


											if(!empty($LivingArrangements)){
		        		 	 
												$actionLink .= '<tr><td>Living Arrangements : </td>';
												$afmvalues =array();
												foreach ($LivingArrangements as $key => $value) { 
												if($value > 0){
												 $actionLink .= ' <td>'. $value['description'].'</td> ';

													}
												}
												$actionLink .= '</tr>'; 
		        		 
		        							}

		        							if(!empty($AfterSpousePrefer)){
		        		 	 
												$actionLink .= '<tr><td>Living Style : </td>';
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
											$actionLink .= '<tr><td>Interests Hobbies Other :  </td><td>'.$interestsHobbiesOther.'</td></tr>'; 
 

										 
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
            "recordsTotal" => $this->model_common->get_all_data($this->global_tblusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "recordsFiltered" => $this->model_common->get_filtered_data($this->global_tblusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "data" => $data,
        );
        echo json_encode($output);
        
    }

    public function fetch_users_consultant_female(){

        // equal condition
        $whereEqual = array();
 	
 		$MawhereEqual = array('isActive'=>1);          
            $MaselectColumn['*'] = '*';  
            $Maorder = array();
            $Maorder['userMarriedStatusName'] = 'ASC'; 
            $allMarriedStatus = $this->model_common->getMultipleDataByField('userMarriedStatus',$MaselectColumn,$MawhereEqual,$Maorder);




	    $consultants = $this->input->post('consultants');
	    
 		if(isset($consultants) && $consultants > 0 ){
 			 $whereEqual[$this->global_tblfemaleusers.'.consultant_id'] = $consultants;
 		}

 		//$whereEqual[$this->global_tblfemaleusers.'.consultant_cat_id'] = 1;
 	 
		$uorder = array();
    	$uselectColumn['birthdate'] = 'birthdate'; 
    	$uwhereEqual['status'] = 1;
    	$afjoinTableArray = array();
	 	$MaleCandidatesList = $this->model_common->get_table_records('FemaleCandidates',$uselectColumn,$uwhereEqual,$afjoinTableArray,$uorder);   
 		
        // not equal condition
        $whereNotEqual = array();

        $notIn = array();     

        // select data
        $selectColumn[$this->global_tblfemaleusers.'.*'] = $this->global_tblfemaleusers.'.*';
        $selectColumn['Consultants.firstName'] =  'Consultants.firstName as cfname';
        $selectColumn['Consultants.lastName'] =  'Consultants.lastName as clname';
        $selectColumn['Consultants.type'] =  'Consultants.type as consultants_type';

        // order column
        $orderColumn = array($this->global_tblfemaleusers.".id", $this->global_tblfemaleusers.".registrationDate", $this->global_tblfemaleusers.".firstName", $this->global_tblfemaleusers.".lastName", $this->global_tblfemaleusers.".last_login");

        // search column
        $searchColumn = array($this->global_tblfemaleusers.".cityOfResidence", $this->global_tblfemaleusers.".firstName", $this->global_tblfemaleusers.".email", $this->global_tblfemaleusers.".lastName","Consultants.firstName","Consultants.lastName");

        // order by
        $orderBy = array($this->global_tblfemaleusers.'.status' => "DESC");
       // $orderBy = array($this->global_tblfemaleusers.'.registrationDate' => "DESC");

        // join table
        $joinTableArray = array();
        $joinTableArray = array(array("joinTable"=>'Consultants', "joinField"=>"id", "relatedJoinTable"=>$this->global_tblfemaleusers, "relatedJoinField"=>"consultant_id","type"=>"left"), 
        /*array("joinTable"=>'MC_AgeRanges', "joinField"=>"mcid", "relatedJoinTable"=>$this->global_tblfemaleusers, "relatedJoinField"=>"id","type"=>"left")*/);
 

        $fetch_data = $this->model_common->make_datatables($this->global_tblfemaleusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);
    	 
     
        $data = array();
        $countryliving = '';
        foreach ($fetch_data as $row) {
            $sub_array = array();

            if($row->primimage && file_exists( 'uploads/users/'.$row->primimage) ){
                $sub_array[] =  '<img class="myImg" onclick="myFunction('.$row->id.');" id="myImg'.$row->id.'" height="50" src="'.base_url('uploads/users/'.$row->primimage).'">';
            } else {
                $sub_array[] =  '<img height="50" src="'.base_url('assets/images/male.jpeg').'">';
            }
 
            if($row->deleted == 1){
            	$sub_array[] = '<del class="text-danger">'.$row->id.'</del>';
            	$sub_array[] = '<del class="text-danger">'.$this->model_common->dateFormat($row->registrationDate).'</del>';
	            $sub_array[] = '<del class="text-danger">'.$row->firstName.'</del>';
	            $sub_array[] = '<del class="text-danger">'.$row->lastName.'</del><br> <span class="text-muted">Reason : '.$row->delete_reason.'</span>';
        	} else {
            	$sub_array[] = $row->id;
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

             $cwhereEqual1['id'] = $row->marriedStatus;          
             $cselectColumn1 = array();
            $cselectColumn1['userMarriedStatusName'] = 'userMarriedStatusName';   
            $userMarriedStatusName = $this->model_common->getSingleDataByField('userMarriedStatus',$cselectColumn1,$cwhereEqual1 );

            $candidatestausLink = '';

            //if($row->marriedStatus!=0){
            	$candidatestausLink .=  '<a style="display:none"class="btn btn-info candidatestatus_' . $row->id .'" href="javascript:void(0)" data-toggle="modal" data-target="#candidatestatus_' . $row->id .'" data-id="' . $row->id . '">'.$userMarriedStatusName['userMarriedStatusName'].'</a>';
            /*} else {
            	$candidatestausLink .=  '<a class="btn btn-info" href="javascript:void(0)" data-toggle="modal" data-target="#candidatestatus_' . $row->id .'" data-id="' . $row->id . '">Not Defined</a>';
            }*/

            

            $candidatestausLink .='<div id="candidatestatus_'.$row->id.'" class="modal fade " role="dialog">
						<div class="modal-dialog modal-lg"> 
							<div class="modal-content"> 
						
								<div class="modal-header"> 
									<h4 class="modal-title">Inactive Reason</h4>
								</div>
								<div class="modal-body"> 
								<form id="deleteuser" class="deleteuser" method="post">
									<input type="hidden" name="delete_user_id" id="delete_user_id" value="'.$row->id.'">';
							                  
							         if(!empty($allMarriedStatus)){
							         	foreach ($allMarriedStatus as $key => $value) {
							         			
							         			$candidatestausLink .='<div class="form-check">
								                      <label class="form-check-label">
								                        <input type="radio" class="form-check-input" name="reason" value="'.$value['id'].'">'.$value['userMarriedStatusName'].'
								                      </label>
								                    </div>';

							         	}
							         }

            

			                     $candidatestausLink .='<button  type="button" id="submitreasoncandidatef" data-uid="'.$row->id.'" class="btn btn-success">Update Status</button>
			                 </form>
								<div>
								    </div>
										<div class="modal-footer">
										  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div></div></div></div>';

			if($row->status==0){
				$candidatestausLink .= $userMarriedStatusName['userMarriedStatusName'];
			}

			$sub_array[] =  $candidatestausLink;

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

                  /*$setwhereEqual['id'] = $row->spouseEthnicityID;        
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
									<h4 class="modal-title">Inactive Reason</h4>
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

											 $heightCM = $row->heightCM ? : "&lt;137";
											$actionLink .= '<tr><td>Height Inches:  </td><td>'.$heightCM.'</td></tr>'; 

											 @$citizenshipStatusID = $CitizenshipStatus['statusName'] ? : "-";
											$actionLink .= '<tr><td>Citizenship Status :  </td><td>'.$citizenshipStatusID.'</td></tr>'; 

											 @$durationOfStayID = $DurationOfStay['desc'] ? : "-";
											$actionLink .= '<tr><td>Duration of Stay  :  </td><td>'.$durationOfStayID.'</td></tr>'; 

											// @$Ethnicity = $Ethnicity['ethnicityName'] ? : "-";
											$actionLink .= '<tr><td>Ethnicity :  </td><td>'.$Ethnicity.'</td></tr>'; 	


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
 

											//@$sEthnicity = $sEthnicity['ethnicityName'] ? : "-";
											$actionLink .= '<tr><td>Spouse Ethnicity :  </td><td>'.$sEthnicity.'</td></tr>'; 

											@$HijabPreference = $HijabPreference['hijabPreferenceName'] ? : "-";
											$actionLink .= '<tr><td>Hijab Preference :  </td><td>'.$HijabPreference.'</td></tr>'; 

											@$hijabPreferenceAdditional = $row->hijabPreferenceAdditional ? : "-";
											$actionLink .= '<tr><td>Hijab Preference Additional :  </td><td>'.$hijabPreferenceAdditional.'</td></tr>';
 
											@$considerDivorcee = $row->considerDivorcee ? : "-";
											$actionLink .= '<tr><td>Consider Divorcee :  </td><td>'.$considerDivorcee.'</td></tr>';

											@$mosqueVisitOther = $row->mosqueVisitOther ? : "-";
											$actionLink .= '<tr><td>Mosque Visit:  </td><td>'.$mosqueVisitOther.'</td></tr>';

											@$myCharacteristics1 = $row->myCharacteristics1 ? : "-";
											$actionLink .= '<tr><td>My Characteristics 1 :  </td><td>'.$myCharacteristics1.'</td></tr>';

											@$myCharacteristics2 = $row->myCharacteristics2 ? : "-";
											$actionLink .= '<tr><td>My Characteristics 2 :  </td><td>'.$myCharacteristics2.'</td></tr>';

											@$myCharacteristics3 = $row->myCharacteristics3 ? : "-";
											$actionLink .= '<tr><td>My Characteristics 3 :  </td><td>'.$myCharacteristics3.'</td></tr>';

											@$preferences = $row->preferences ? : "-";
											$actionLink .= '<tr><td>Preferences :  </td><td>'.$preferences.'</td></tr>';

											@$aboutMe = $row->aboutMe ? : "-";
											$actionLink .= '<tr><td>About Me   :  </td><td>'.$aboutMe.'</td></tr>'; 

											@$otherDetails = $row->otherDetails ? : "-";
											$actionLink .= '<tr><td>Other Details :  </td><td>'.$otherDetails.'</td></tr>';


											if(!empty($LivingArrangements)){
		        		 	 
												$actionLink .= '<tr><td>Living Arrangements : </td>';
												$afmvalues =array();
												foreach ($LivingArrangements as $key => $value) { 
												if($value > 0){
												 $actionLink .= ' <td>'. $value['description'].'</td> ';

													}
												}
												$actionLink .= '</tr>'; 
		        		 
		        							}

		        							if(!empty($AfterSpousePrefer)){
		        		 	 
												$actionLink .= '<tr><td>Living Style : </td>';
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
											$actionLink .= '<tr><td>Interests Hobbies Other :  </td><td>'.$interestsHobbiesOther.'</td></tr>'; 
 

										 
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
            "recordsTotal" => $this->model_common->get_all_data($this->global_tblfemaleusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "recordsFiltered" => $this->model_common->get_filtered_data($this->global_tblfemaleusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "data" => $data,
        );
        echo json_encode($output);
        
    }

    public function female()
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

                $MawhereEqual = array('isActive'=>1, 'deleted'=>0);          
                $MaselectColumn['*'] = '*';  
                $Maorder = array();
                $Maorder['userMarriedStatusName'] = 'ASC'; 
                $this->data['MarriedStatus'] = $this->model_common->getMultipleDataByField('userMarriedStatus',$MaselectColumn,$MawhereEqual,$Maorder);

	 	$this->render_admin_layouts('admin/female/index', $this->data);
	 	
	 } 


	 public function female_create()
	{	
		if(($this->input->post('firstName')!='') && ($this->input->post('lastName')!='') && ($this->input->post('phone')!='') && ($this->input->post('email')!='')  && ($this->input->post('pwd')!='')){

            // true case

            if($this->input->post('type')==0){
				$consultants = $this->input->post('g_consultants');
			} else if($this->input->post('type')==1){
				$consultants = $this->input->post('t_consultants');
			} else if($this->input->post('type')==2){
				$consultants = $this->input->post('consultants');
			}

            $password = md5($this->input->post('pwd')); 
        	$data = array(  	
        		'email' => $this->input->post('email'),
        		'consultant_id' => $consultants,
        		'firstName' => $this->input->post('firstName'),
        		'lastName' => $this->input->post('lastName'),
                'pwd' => $password,
        		'phone' => $this->input->post('phone'),
        		'consultant_cat_id' => $this->input->post('type'),
                'registrationDate' => date("Y-m-d H:i:s"),
                'marriedStatus' => $this->input->post('marriedStatus'),
        	);

        	$create = $this->model_common->insertTableData($data, $this->global_tblfemaleusers);
        	if($create>0) {  
        		$this->session->set_flashdata('success', 'The user was created successfully.');
        		redirect('users/female', 'refresh');
        	} else {
        		$this->session->set_flashdata('error', 'Error occurred!!');
        		redirect('users/create', 'refresh');
        	}

        } else {
            // false case

            $conwhereEqual = array('status'=>1,'deleted'=>0,'gender'=>1,'type'=>2);          
			$conselectColumn['*'] = '*';  
			$conorder['firstName'] = 'ASC'; 
			$consultants = $this->model_common->getMultipleDataByField('Consultants',$conselectColumn,$conwhereEqual,$conorder);

         	$conwhereEqual = array('status'=>1,'deleted'=>0,'gender'=>1,'type'=>0);          
			$conselectColumn['*'] = '*';  
			$conorder['firstName'] = 'ASC'; 
			$guiding_consultants = $this->model_common->getMultipleDataByField('Consultants',$conselectColumn,$conwhereEqual,$conorder);

			$conwhereEqual = array('status'=>1,'deleted'=>0,'gender'=>1,'type'=>1);          
			$conselectColumn['*'] = '*';  
			$conorder['firstName'] = 'ASC'; 
			$transactional_consultants = $this->model_common->getMultipleDataByField('Consultants',$conselectColumn,$conwhereEqual,$conorder);

			$this->data['guiding_consultants'] = array_merge($guiding_consultants,$consultants);

			$this->data['transactional_consultants'] = array_merge($transactional_consultants,$consultants);

			$conwhereEqual = array('status'=>1,'deleted'=>0,'gender'=>1);          
			$conselectColumn['*'] = '*';  
			$conorder['firstName'] = 'ASC'; 
			$this->data['consultants'] = $this->model_common->getMultipleDataByField('Consultants',$conselectColumn,$conwhereEqual,$conorder);

			$MawhereEqual = array('isActive'=>1, 'deleted'=>0);          
            $MaselectColumn['*'] = '*';  
            $Maorder = array();
            $Maorder['userMarriedStatusName'] = 'ASC'; 
            $this->data['MarriedStatus'] = $this->model_common->getMultipleDataByField('userMarriedStatus',$MaselectColumn,$MawhereEqual,$Maorder);
            
            $this->render_admin_layouts('admin/female/create', $this->data);
        }		
	}

	public function female_edit($id = null)
	{

		if($id) {
			
			if(($this->input->post('firstName')!='') && ($this->input->post('lastName')!='') && ($this->input->post('phone')!='') && ($this->input->post('email')!='') ){
				
				// $mainimage = '';	
	   //          if ($_FILES['primimage']['size']>0) {

	   //              $uploaddir = FCPATH.'/uploads/female/';
	   //               @chmod($uploaddir, 0777);
	   //              $ext = pathinfo($_FILES['primimage']['name'], PATHINFO_EXTENSION);

	   //              $filenm = $id .'_prim.'.$ext;
	   //              $mainimage = str_replace(' ', '-', $filenm);
	   //              $uploadfile = $uploaddir . $mainimage;

	   //              move_uploaded_file($_FILES['primimage']['tmp_name'], $uploadfile);

	   //          } else{
	   //          	 $mainimage = $this->input->post('hidden_primimage');
	   //          }

	   //          $image2 = '';
	   //          if ($_FILES['image1']['size']>0) {

	   //              $uploaddir = FCPATH.'/uploads/female/';
	   //               @chmod($uploaddir, 0777);
	   //              $ext = pathinfo($_FILES['image1']['name'], PATHINFO_EXTENSION);

	   //              $filenm = $id .'_next.'.$ext;
	   //              $image2 = str_replace(' ', '-', $filenm);
	   //              $uploadfile = $uploaddir . $image2;

	   //              move_uploaded_file($_FILES['image1']['tmp_name'], $uploadfile);


	   //          }  else{
	   //          	$image2 = $this->input->post('hidden_image1');
	   //          }

	            if($this->input->post('consultant_cat_id')==0){
					$consultants = $this->input->post('g_consultants');
				} else if($this->input->post('consultant_cat_id')==1){
					$consultants = $this->input->post('t_consultants');
				} else if($this->input->post('consultant_cat_id')==2){
					$consultants = $this->input->post('consultants');
				}

				$marriedStatus = 0;
				if($this->input->post('status')==1){
					$marriedStatus = $this->input->post('marriedStatus_active');
				} else if($this->input->post('type')==0){
					$marriedStatus = $this->input->post('marriedStatus_inactive');
				}
				
				// true case
		        if(empty($this->input->post('pwd')) && empty($this->input->post('cpassword'))) {

		        	$personalEthnicityID = '';
		            if(!empty($this->input->post('personalEthnicityID'))){
		            	$personalEthnicityID = implode(",", $this->input->post('personalEthnicityID'));
		            }

		            $spouseEthnicityID = '';
		            if(!empty($this->input->post('spouseEthnicityID'))){
		            	$spouseEthnicityID = implode(",", $this->input->post('spouseEthnicityID'));
		            }

		        	$updateData = array( 
		        		'email' => $this->input->post('email'),
		        		'consultant_id' => $consultants,
		        		'firstName' => $this->input->post('firstName'),
		        		'lastName' => $this->input->post('lastName'),
		        		'phone' => $this->input->post('phone'),
		        		'birthdate' => date('Y-m-d',strtotime($this->input->post('birthdate'))),
		        		'fathersName' => $this->input->post('fathersName'),
		        		'mothersName' => $this->input->post('mothersName'),
		        		'cityOfResidence' => $this->input->post('cityOfResidence'), 
		        		'countryOfResidence' => $this->input->post('countryOfResidence'),
		        		'heightCM' => $this->input->post('heightCM'),
		        		'citizenshipStatusID' => $this->input->post('citizenshipStatusID'),
		        		'durationOfStayID' => $this->input->post('durationOfStayID'),  
		        		'personalEthnicityID' => $personalEthnicityID,  
		        		'personalEthnicityOther' => $this->input->post('personalEthnicityOther'),  
		        		'cityOfBirth' => $this->input->post('cityOfBirth'),  
		        		'areaOfStudy' => $this->input->post('areaOfStudy'),  
		        		'highestEducationLevelID' => $this->input->post('highestEducationLevelID'),  
		        		'currentOccupation' => $this->input->post('currentOccupation'),  
		        		'maritalStatusID' => $this->input->post('maritalStatusID'),  
		        		'willingToRelocate' => $this->input->post('willingToRelocate'),  
		        		'afterMarriageLivingOther' => $this->input->post('LivingStyle_OTHER'),  
		        		'spouseEthnicityID' => $spouseEthnicityID,
		        		'spouseEthnicityOther' => $this->input->post('spouseEthnicityOther'),   
		        		'hijabPreferenceID' => $this->input->post('hijabPreferenceID'),  
		        		'hijabPreferenceAdditional' => $this->input->post('hijabPreferenceAdditional'), 
		        		'considerDivorcee' => $this->input->post('considerDivorcee'),  
		        		'mosqueVisitOther' => $this->input->post('MosqueFrequency_OTHER'),  
		        		'myCharacteristics1' => $this->input->post('myCharacteristics1'),  
		        		'myCharacteristics2' => $this->input->post('myCharacteristics2'),  
		        		'myCharacteristics3' => $this->input->post('myCharacteristics3'),  
		        		'preferences' => $this->input->post('preferences'),  
		        		'aboutMe' => $this->input->post('aboutMe'),  
		        		'otherDetails' => $this->input->post('otherDetails'),  		        		 
		        		'interestsHobbiesOther' => $this->input->post('interestsHobbiesOther'),		        		 
                        'registrationDate' => date("Y-m-d H:i:s"),
            //             'primimage' => $mainimage,  
		        		// 'image' => $image2,
		        		'consultant_cat_id' => $this->input->post('consultant_cat_id'),
		        		'marriedStatus' => $marriedStatus,
		        		'status' => $this->input->post('status'),
		        	);

                    $whereEqual = array('id'=>$id);
                    $update = $this->model_common->updateTableData($updateData,$this->global_tblfemaleusers,$whereEqual);

                    $mainimage = '';	
	            if ($_FILES['primimage']['size']>0) {

	                $uploaddir = FCPATH.'/uploads/female/';
	                 @chmod($uploaddir, 0777);
	                $ext = pathinfo($_FILES['primimage']['name'], PATHINFO_EXTENSION);
	                $extFemale  = strtolower($ext);
	                if(($extFemale == 'png') || ($extFemale == 'jpg')){
		                $filenm = $id .'_prim.'.$ext;
		                $mainimage = str_replace(' ', '-', $filenm);
		                $uploadfile = $uploaddir . $mainimage;

		                move_uploaded_file($_FILES['primimage']['tmp_name'], $uploadfile);
		            }else{
		            	$this->session->set_flashdata('error', 'We accept only .jpg and .png image');
		        		redirect('users/female_edit/'.$id, 'refresh');
		            }

	            } else{
	            	 $mainimage = $this->input->post('hidden_primimage');
	            }
	            $updateData3 = array(   
		        		'primimage' => $mainimage,  
		        	);
  

                    
                   $whereEqual = array('id'=>$id);
                    $update = $this->model_common->updateTableData($updateData3,$this->global_tblfemaleusers,$whereEqual);; 

	            $image2 = '';
	            if ($_FILES['image1']['size']>0) {

	                $uploaddir = FCPATH.'/uploads/female/';
	                 @chmod($uploaddir, 0777);
	                $ext = pathinfo($_FILES['image1']['name'], PATHINFO_EXTENSION);
	                $extFemale2 = strtolower($ext);
		            if(($extFemale2 == 'png') || ($extFemale2 == 'jpg')){
		                $filenm = $id .'_next.'.$ext;
		                $image2 = str_replace(' ', '-', $filenm);
		                $uploadfile = $uploaddir . $image2;

		                move_uploaded_file($_FILES['image1']['tmp_name'], $uploadfile);
		            }else{
		            	$this->session->set_flashdata('error', 'We accept only .jpg and .png image');
		        		redirect('users/female_edit/'.$id, 'refresh');
		            }

	            }  else{
	            	$image2 = $this->input->post('hidden_image1');
	            }
	            $updateData4 = array(   
		        		'image' => $image2,  
		        	);
  
                    $whereEqual = array('id'=>$id);
                   
                    $update = $this->model_common->updateTableData($updateData4,$this->global_tblfemaleusers,$whereEqual);

                     $LivingArrangements = $this->input->post('LivingArrangements');

		        	if(!empty($LivingArrangements)){
		        		$afmwhere['mcid'] = $id;  
		        		$this->model_common->deleteTableData('MC_AfterMarriageLiving',$afmwhere);
		        			$afmvalues =array();
		        		foreach ($LivingArrangements as $key => $value) {
		        			$afmvalues['mcid'] =  $id;
		        			if($value > 0){
			        			$afmvalues['livingArrangementsID'] =$value;
			        			$this->model_common->insertTableData($afmvalues,'MC_AfterMarriageLiving'); 		        				
		        			}
		        		}
		        	}

		        	$AfterSpousePrefer = $this->input->post('LivingStyle');

		        	if(!empty($AfterSpousePrefer)){
		        		$afmpwhere['mcid'] = $id;  
		        		$this->model_common->deleteTableData('MC_AfterSpousePrefer',$afmpwhere);
		        			$afmpvalues =array();
		        		foreach ($AfterSpousePrefer as $key => $value) {
		        			$afmpvalues['mcid'] =  $id;
		        			if($value > 0){
		        				$afmpvalues['afterMarriagePreferenceMaleID'] =$value;
		        				$this->model_common->insertTableData($afmpvalues,'MC_AfterSpousePrefer'); 
		        			}
		        		}
		        	}

		        	
		        	$AgePreference = $this->input->post('AgePreference');
		        	if(!empty($AgePreference)){
		        		$agmwhere['mcid'] = $id;  
		        		$this->model_common->deleteTableData('MC_AgeRanges',$agmwhere);
		        			$agmvalues =array();
		        		foreach ($AgePreference as $key => $value) {
		        			$agmvalues['mcid'] = $id;
		        			if($value > 0){
		        				$agmvalues['ageRangeID'] =$value;
		        				$this->model_common->insertTableData($agmvalues,'MC_AgeRanges'); 
		        			}
		        		}
		        	}

		        	$MosqueFrequency = $this->input->post('MosqueFrequency');
		        	if(!empty($MosqueFrequency)){
		        		$momwhere['mcid'] = $id;  
		        		$this->model_common->deleteTableData('MC_MosqueVisits',$momwhere);
		        			$agmvalues =array();
		        		foreach ($MosqueFrequency as $key => $value) {
		        			$agmvalues['mcid'] = $id;
		        			if($value > 0){
		        				$agmvalues['mosqueVisitID'] =$value;
		        				$this->model_common->insertTableData($agmvalues,'MC_MosqueVisits'); 
		        			}
		        		}
		        	}

		        	$InterestHobbies = $this->input->post('InterestHobbies');
		        	if(!empty($InterestHobbies)){
		        		$momwhere['fcid'] = $id;  
		        		$this->model_common->deleteTableData('FC_InterestHobbies',$momwhere);
		        			$agmvalues =array();
		        		foreach ($InterestHobbies as $key => $value) {
		        			$agmvalues['fcid'] = $id;
		        			if($value > 0){
		        				$agmvalues['hobbiesID'] =$value;
		        				$this->model_common->insertTableData($agmvalues,'FC_InterestHobbies'); 
		        			}
		        		}
		        	}

		        	

		        	if($update == true) {
		        		$this->session->set_flashdata('success', 'The user has been successfully updated.');
		        		redirect('users/female', 'refresh');
		        	} else {
		        		$this->session->set_flashdata('error', 'Error occurred!!');
		        		redirect('users/female_edit/'.$id, 'refresh');
		        	}
		        } else {
		        	
					$password = md5($this->input->post('pwd'));

					$personalEthnicityID = '';
		            if(!empty($this->input->post('personalEthnicityID'))){
		            	$personalEthnicityID = implode(",", $this->input->post('personalEthnicityID'));
		            }

		            $spouseEthnicityID = '';
		            if(!empty($this->input->post('spouseEthnicityID'))){
		            	$spouseEthnicityID = implode(",", $this->input->post('spouseEthnicityID'));
		            }

					$updateData = array( 		        		
		        		'pwd' => $password,
		        		'email' => $this->input->post('email'),
		        		'consultant_id' => $consultants,
		        		'firstName' => $this->input->post('firstName'),
		        		'lastName' => $this->input->post('lastName'),
		        		'phone' => $this->input->post('phone'),
		        		'birthdate' => date('Y-m-d',strtotime($this->input->post('birthdate'))),
		        		'fathersName' => $this->input->post('fathersName'),
		        		'mothersName' => $this->input->post('mothersName'),
		        		'cityOfResidence' => $this->input->post('cityOfResidence'), 
		        		'countryOfResidence' => $this->input->post('countryOfResidence'),
		        		'heightCM' => $this->input->post('heightCM'),
		        		'citizenshipStatusID' => $this->input->post('citizenshipStatusID'),
		        		'durationOfStayID' => $this->input->post('durationOfStayID'),  
		        		'personalEthnicityID' => $personalEthnicityID,  
		        		'personalEthnicityOther' => $this->input->post('personalEthnicityOther'),  
		        		'cityOfBirth' => $this->input->post('cityOfBirth'),  
		        		'areaOfStudy' => $this->input->post('areaOfStudy'),  
		        		'highestEducationLevelID' => $this->input->post('highestEducationLevelID'),  
		        		'currentOccupation' => $this->input->post('currentOccupation'),  
		        		'maritalStatusID' => $this->input->post('maritalStatusID'),  
		        		'willingToRelocate' => $this->input->post('willingToRelocate'),  
		        		'afterMarriageLivingOther' => $this->input->post('LivingStyle_OTHER'),  
		        		'spouseEthnicityID' => $spouseEthnicityID, 
		        		'spouseEthnicityOther' => $this->input->post('spouseEthnicityOther'),  
		        		'hijabPreferenceID' => $this->input->post('hijabPreferenceID'),  
		        		'hijabPreferenceAdditional' => $this->input->post('hijabPreferenceAdditional'), 
		        		'considerDivorcee' => $this->input->post('considerDivorcee'),  
		        		'mosqueVisitOther' => $this->input->post('MosqueFrequency_OTHER'),  
		        		'myCharacteristics1' => $this->input->post('myCharacteristics1'),  
		        		'myCharacteristics2' => $this->input->post('myCharacteristics2'),  
		        		'myCharacteristics3' => $this->input->post('myCharacteristics3'),  
		        		'preferences' => $this->input->post('preferences'),  
		        		'aboutMe' => $this->input->post('aboutMe'),  
		        		'otherDetails' => $this->input->post('otherDetails'),  		        		 
		        		'interestsHobbiesOther' => $this->input->post('interestsHobbiesOther'),	        	 
                        'registrationDate' => date("Y-m-d H:i:s"),
            //             'primimage' => $mainimage,  
		        		// 'image' => $image2,
		        		'marriedStatus' => $marriedStatus,
		        		'status' => $this->input->post('status'),
		        	);

                    $whereEqual = array('id'=>$id); 
                    $update = $this->model_common->updateTableData($updateData,$this->global_tblfemaleusers,$whereEqual);
                    $mainimage = '';	
	            if ($_FILES['primimage']['size']>0) {

	                $uploaddir = FCPATH.'/uploads/female/';
	                 @chmod($uploaddir, 0777);
	                $ext = pathinfo($_FILES['primimage']['name'], PATHINFO_EXTENSION);
	                $extFemale  = strtolower($ext);
	                if(($extFemale == 'png') || ($extFemale == 'jpg')){
		                $filenm = $id .'_prim.'.$ext;
		                $mainimage = str_replace(' ', '-', $filenm);
		                $uploadfile = $uploaddir . $mainimage;

		                move_uploaded_file($_FILES['primimage']['tmp_name'], $uploadfile);
		            }else{
		            	$this->session->set_flashdata('error', 'We accept only .jpg and .png image');
		        		redirect('users/female_edit/'.$id, 'refresh');
		            }

	            } else{
	            	 $mainimage = $this->input->post('hidden_primimage');
	            }
	            $updateData3 = array(   
		        		'primimage' => $mainimage,  
		        	);
  
                    $whereEqual = array('id'=>$id);
                   
                    $update = $this->model_common->updateTableData($updateData3,$this->global_tblfemaleusers,$whereEqual);

	            $image2 = '';
	            if ($_FILES['image1']['size']>0) {

	                $uploaddir = FCPATH.'/uploads/female/';
	                 @chmod($uploaddir, 0777);
	                $ext = pathinfo($_FILES['image1']['name'], PATHINFO_EXTENSION);
	                $extFemale2 = strtolower($ext);
		            if(($extFemale2 == 'png') || ($extFemale2 == 'jpg')){
		                $filenm = $id .'_next.'.$ext;
		                $image2 = str_replace(' ', '-', $filenm);
		                $uploadfile = $uploaddir . $image2;

		                move_uploaded_file($_FILES['image1']['tmp_name'], $uploadfile);
		            }else{
		            	$this->session->set_flashdata('error', 'We accept only .jpg and .png image');
		        		redirect('users/female_edit/'.$id, 'refresh');
		            }

	            }  else{
	            	$image2 = $this->input->post('hidden_image1');
	            }
	            $updateData4 = array(   
		        		'image' => $image2,  
		        	);
  
                   
                   $whereEqual = array('id'=>$id);
                    $update = $this->model_common->updateTableData($updateData4,$this->global_tblfemaleusers,$whereEqual);

                     $LivingArrangements = $this->input->post('LivingArrangements');

		        	if(!empty($LivingArrangements)){
		        		$afmwhere['mcid'] = $id;  
		        		$this->model_common->deleteTableData('MC_AfterMarriageLiving',$afmwhere);
		        			$afmvalues =array();
		        		foreach ($LivingArrangements as $key => $value) {
		        			$afmvalues['mcid'] =  $id;
		        			if($value > 0){
			        			$afmvalues['livingArrangementsID'] =$value;
			        			$this->model_common->insertTableData($afmvalues,'MC_AfterMarriageLiving'); 		        				
		        			}
		        		}
		        	}

		        	$AfterSpousePrefer = $this->input->post('LivingStyle');

		        	if(!empty($AfterSpousePrefer)){
		        		$afmpwhere['mcid'] = $id;  
		        		$this->model_common->deleteTableData('MC_AfterSpousePrefer',$afmpwhere);
		        			$afmpvalues =array();
		        		foreach ($AfterSpousePrefer as $key => $value) {
		        			$afmpvalues['mcid'] =  $id;
		        			if($value > 0){
		        				$afmpvalues['afterMarriagePreferenceMaleID'] =$value;
		        				$this->model_common->insertTableData($afmpvalues,'MC_AfterSpousePrefer'); 
		        			}
		        		}
		        	}

		        	
		        	$AgePreference = $this->input->post('AgePreference');
		        	if(!empty($AgePreference)){
		        		$agmwhere['mcid'] = $id;  
		        		$this->model_common->deleteTableData('MC_AgeRanges',$agmwhere);
		        			$agmvalues =array();
		        		foreach ($AgePreference as $key => $value) {
		        			$agmvalues['mcid'] = $id;
		        			if($value > 0){
		        				$agmvalues['ageRangeID'] =$value;
		        				$this->model_common->insertTableData($agmvalues,'MC_AgeRanges'); 
		        			}
		        		}
		        	}

		        	$MosqueFrequency = $this->input->post('MosqueFrequency');
		        	if(!empty($MosqueFrequency)){
		        		$momwhere['mcid'] = $id;  
		        		$this->model_common->deleteTableData('MC_MosqueVisits',$momwhere);
		        			$agmvalues =array();
		        		foreach ($MosqueFrequency as $key => $value) {
		        			$agmvalues['mcid'] = $id;
		        			if($value > 0){
		        				$agmvalues['mosqueVisitID'] =$value;
		        				$this->model_common->insertTableData($agmvalues,'MC_MosqueVisits'); 
		        			}
		        		}
		        	}

		        	$InterestHobbies = $this->input->post('InterestHobbies');
		        	if(!empty($InterestHobbies)){
		        		$momwhere['fcid'] = $id;  
		        		$this->model_common->deleteTableData('FC_InterestHobbies',$momwhere);
		        			$agmvalues =array();
		        		foreach ($InterestHobbies as $key => $value) {
		        			$agmvalues['fcid'] = $id;
		        			if($value > 0){
		        				$agmvalues['hobbiesID'] =$value;
		        				$this->model_common->insertTableData($agmvalues,'FC_InterestHobbies'); 
		        			}
		        		}
		        	}

		        	if($update == true) {
		        		$this->session->set_flashdata('success', 'The user has been successfully updated.');
		        		redirect('users/female', 'refresh');
		        	} else {
		        		$this->session->set_flashdata('error', 'Error occurred!!');
		        		redirect('users/female_edit/'.$id, 'refresh');
		        	}
		        }

	        } else {
	            // false case
                $whereEqual = array('id'=>$id);        
                $selectColumn['*'] = '*';
                $this->data['user_data'] = $this->model_common->getSingleDataByField($this->global_tblfemaleusers,$selectColumn,$whereEqual);

                $conwhereEqual = array('status'=>1,'deleted'=>0,'gender'=>1,'type'=>2);          
				$conselectColumn['*'] = '*';  
				$conorder['firstName'] = 'ASC'; 
				$consultants = $this->model_common->getMultipleDataByField('Consultants',$conselectColumn,$conwhereEqual,$conorder);

	         	$conwhereEqual = array('status'=>1,'deleted'=>0,'gender'=>1,'type'=>0);          
				$conselectColumn['*'] = '*';  
				$conorder['firstName'] = 'ASC'; 
				$guiding_consultants = $this->model_common->getMultipleDataByField('Consultants',$conselectColumn,$conwhereEqual,$conorder);

				$conwhereEqual = array('status'=>1,'deleted'=>0,'gender'=>1,'type'=>1);          
				$conselectColumn['*'] = '*';  
				$conorder['firstName'] = 'ASC'; 
				$transactional_consultants = $this->model_common->getMultipleDataByField('Consultants',$conselectColumn,$conwhereEqual,$conorder);

				$this->data['guiding_consultants'] = array_merge($guiding_consultants,$consultants);

				$this->data['transactional_consultants'] = array_merge($transactional_consultants,$consultants);

				$conwhereEqual = array('status'=>1,'deleted'=>0,'gender'=>1);          
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


                $ihwhereEqual = array('isActive'=>1);          
                $ihselectColumn['*'] = '*';  
                $ihorder['id'] = 'DESC'; 
                $this->data['InterestsHobbies'] = $this->model_common->getMultipleDataByField('InterestsHobbies',$ihselectColumn,$ihwhereEqual,$ihorder);

                $MawhereEqual = array('isActive'=>1, 'deleted'=>0);          
                $MaselectColumn['*'] = '*';  
                $Maorder = array();
                $Maorder['userMarriedStatusName'] = 'ASC'; 
                $this->data['MarriedStatus'] = $this->model_common->getMultipleDataByField('userMarriedStatus',$MaselectColumn,$MawhereEqual,$Maorder);

				$this->render_admin_layouts('admin/female/edit', $this->data);	
	        }	
		}	
	}

	public function female_delete($id)
	{

        if($id) {

            $whereEqual = array('id'=>$id);        
            $selectColumn['*'] = '*';
            $this->data['user_data'] = $this->model_common->getSingleDataByField($this->global_tblfemaleusers,$selectColumn,$whereEqual);

            $updateData['deleted'] = 1;
            $whereEqual = array('id'=>$id); 
            $update = $this->model_common->updateTableData($updateData,$this->global_tblfemaleusers,$whereEqual);

            if($update == true) {
                $this->session->set_flashdata('success', 'The Female Candidate has been successfully deleted.');
                redirect('users/female', 'refresh');
            }
            else {
                $this->session->set_flashdata('error', 'Error occurred!!');
                redirect('users/female', 'refresh');
            }

        }
	}

    public function female_fetch_users(){

        // equal condition
        $whereEqual = array( ); 
        $orwhere = array( ); 
 		 $newuser = $this->input->post('newuser'); 

        // if($newuser == 1){
        // 	$date = date('Y-m-d', strtotime('-7 days')); 	
        // 	$whereEqual  = array($this->global_tblfemaleusers.'.deleted'=>'0', $this->global_tblfemaleusers.'.registrationDate   >= '=> $date );
        // }
   
 		if((isset($start_date) && $start_date > 0) && isset($end_date) && $end_date > 0 ){
 			$whereEqual  = array($this->global_tblfemaleusers.'.registrationDate >= ' => date('Y-m-d',strtotime($start_date)), $this->global_tblfemaleusers.'.registrationDate <= '=> date('Y-m-d',strtotime($end_date) )); 
 			  
 		}

 		$MawhereEqual = array('isActive'=>1);          
            $MaselectColumn['*'] = '*';  
            $Maorder = array();
            $Maorder['userMarriedStatusName'] = 'ASC'; 
            $allMarriedStatus = $this->model_common->getMultipleDataByField('userMarriedStatus',$MaselectColumn,$MawhereEqual,$Maorder);



	      $consultants = $this->input->post('consultants');
	      $countryOfResidence = $this->input->post('countryOfResidence');
	      $personalEthnicityID = $this->input->post('personalEthnicityID');
	      $ageRange = $this->input->post('ageRange');
	      $citizenshipStatusID = $this->input->post('citizenshipStatusID');
	      $durationOfStayID = $this->input->post('durationOfStayID');
	      $highestEducationLevelID = $this->input->post('highestEducationLevelID');
	      $willingToRelocate = $this->input->post('willingToRelocate');
	      $maritalStatusID = $this->input->post('maritalStatusID');
	      $hijabPreferenceID = $this->input->post('hijabPreferenceID');
	      
	      $from_age = $this->input->post('from_age');
	      $to_age = $this->input->post('to_age');
	      $status = $this->input->post('status');

	      $from_height = $this->input->post('from_height');
	      $to_height = $this->input->post('to_height');


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
 		}*/

 		if(isset($consultants) && $consultants > 0 ){
 			 $whereEqual[$this->global_tblfemaleusers.'.consultant_id'] = $consultants;
 		}

 		/*if(isset($hijabPreferenceID) && $hijabPreferenceID > 0 ){
 			 $whereEqual[$this->global_tblfemaleusers.'.hijabPreferenceID'] = $hijabPreferenceID;
 		}*/

 	 

 		/*if(isset($personalEthnicityID) && $personalEthnicityID > 0 ){
 			$whereEqual[$this->global_tblfemaleusers.'.personalEthnicityID'] = $personalEthnicityID;
 		}*/

 		/*if(isset($ageRange) && $ageRange > 0 ){
 			$whereEqual['FC_AgeRanges.ageRangeID'] = $ageRange;
 		}*/


		if(isset($citizenshipStatusID) && $citizenshipStatusID > 0 ){
 			$whereEqual[$this->global_tblfemaleusers.'.citizenshipStatusID'] = $citizenshipStatusID;
 		} 

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
 			$whereEqual[$this->global_tblfemaleusers.'.maritalStatusID'] = $maritalStatusID;
 		} 

 		if(isset($status) && $status !='' ){
 			$whereEqual[$this->global_tblfemaleusers.'.status'] = $status;
 		}

 		//$whereEqual[$this->global_tblfemaleusers.'.consultant_cat_id'] = 1;

 		if(isset($ageRange) && $ageRange > 0 ){
 			$whereEqual['FC_AgeRanges.ageRangeID'] = $ageRange;
 		}
 		

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
 	


        // not equal condition
        $whereNotEqual = array();

        $notIn = array();     


        // select data
        $selectColumn[$this->global_tblfemaleusers.'.*'] = $this->global_tblfemaleusers.'.*';
         $selectColumn['Consultants.firstName'] =  'Consultants.firstName as cfname';
        $selectColumn['Consultants.lastName'] =  'Consultants.lastName as clname';
        $selectColumn['Consultants.type'] =  'Consultants.type as consultants_type';

        // order column
        $orderColumn = array("", "", $this->global_tblfemaleusers.".id", $this->global_tblfemaleusers.".registrationDate", $this->global_tblfemaleusers.".firstName", $this->global_tblfemaleusers.".lastName", "", "", "", $this->global_tblfemaleusers.".last_login");

        // search column
        $searchColumn = array($this->global_tblfemaleusers.".id", $this->global_tblfemaleusers.".firstName", $this->global_tblfemaleusers.".lastName","Consultants.firstName","Consultants.lastName");

        // order by
        $orderBy = array($this->global_tblfemaleusers.'.status' => "DESC");
        

        // join table
        /*$joinTableArray = array(array("joinTable"=>'Consultants', "joinField"=>"id", "relatedJoinTable"=>$this->global_tblfemaleusers, "relatedJoinField"=>"consultant_id","type"=>"left"), array("joinTable"=>'FC_AgeRanges', "joinField"=>"fcid", "relatedJoinTable"=>$this->global_tblfemaleusers, "relatedJoinField"=>"id","type"=>"left") );*/

        $joinTableArray = array(array("joinTable"=>'Consultants', "joinField"=>"id", "relatedJoinTable"=>$this->global_tblfemaleusers, "relatedJoinField"=>"consultant_id","type"=>"left"));

        $fetch_data = $this->model_common->make_datatables($this->global_tblfemaleusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn,$orwhere);

        $data = array();
        foreach ($fetch_data as $row) {
            $sub_array = array();

            $sub_array[] =  '<td><label class="form-controlNew"><input type="checkbox" class="checkSingle" name="custom_check[]" id="custom_check_'.$row->id.'" value="'.$row->id.'"/></label>';

            if($row->primimage && file_exists( 'uploads/female/'.$row->primimage) ){
                $sub_array[] =  '<img class="myImg" onclick="myFunction('.$row->id.');" id="myImg'.$row->id.'" height="50" src="'.base_url('uploads/female/'.$row->primimage).'">';
            } else {
                $sub_array[] =  '<img height="50" src="'.base_url('assets/images/female.jpeg').'">';
            }
              
            if($row->deleted == 1){
            	$sub_array[] = '<del class="text-danger">'.$row->id.'</del>';
            	$sub_array[] = '<del class="text-danger">'.$this->model_common->dateFormat($row->registrationDate).'</del>';
	            $sub_array[] = '<del class="text-danger">'.$row->firstName.'</del>';
	            $sub_array[] = '<del class="text-danger">'.$row->lastName.'</del><br> <span class="text-muted">Reason : '.$row->delete_reason.'</span>';
        	} else {
            	$sub_array[] = $row->id;
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
            // $sub_array[] = $row->cfname .' '.$row->clname; 
            $changeStatusLink = $this->model_common->getChangeStatusLink($this->global_tblfemaleusers,$row->id,$row->status);
             $sub_array[] = $changeStatusLink;

             $cwhereEqual1['id'] = $row->marriedStatus;          
             $cselectColumn1 = array();
            $cselectColumn1['userMarriedStatusName'] = 'userMarriedStatusName';   
            $userMarriedStatusName = $this->model_common->getSingleDataByField('userMarriedStatus',$cselectColumn1,$cwhereEqual1 );

            $candidatestausLink = '';

            //if($row->marriedStatus!=0){
            	$candidatestausLink .=  '<a style="display:none" class="btn btn-info candidatestatus_' . $row->id .'" href="javascript:void(0)" data-toggle="modal" data-target="#candidatestatus_' . $row->id .'" data-id="' . $row->id . '">'.$userMarriedStatusName['userMarriedStatusName'].'</a>';
            /*} else {
            	$candidatestausLink .=  '<a class="btn btn-info" href="javascript:void(0)" data-toggle="modal" data-target="#candidatestatus_' . $row->id .'" data-id="' . $row->id . '">Not Defined</a>';
            }*/

            

            $candidatestausLink .='<div id="candidatestatus_'.$row->id.'" class="modal fade " role="dialog">
						<div class="modal-dialog modal-lg"> 
							<div class="modal-content"> 
						
								<div class="modal-header"> 
									<h4 class="modal-title">Inactive Reason</h4>
								</div>
								<div class="modal-body"> 
								<form id="deleteuser" class="deleteuser" method="post">
									<input type="hidden" name="delete_user_id" id="delete_user_id" value="'.$row->id.'">';
							                  
							         if(!empty($allMarriedStatus)){
							         	foreach ($allMarriedStatus as $key => $value) {
							         			
							         			$candidatestausLink .='<div class="form-check">
								                      <label class="form-check-label">
								                        <input type="radio" class="form-check-input" name="reason" value="'.$value['id'].'">'.$value['userMarriedStatusName'].'
								                      </label>
								                    </div>';

							         	}
							         }

            

			                     $candidatestausLink .='<button  type="button" id="submitreasoncandidatef" data-uid="'.$row->id.'" class="btn btn-success">Update Status</button>
			                 </form>
								<div>
								    </div>
										<div class="modal-footer">
										  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div></div></div></div>';

			if($row->status==0){
				$candidatestausLink .= $userMarriedStatusName['userMarriedStatusName'];
			}

			$sub_array[] =  $candidatestausLink;
		

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

                  /*$setwhereEqual['id'] = $row->spouseEthnicityID;        
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
									<h4 class="modal-title">Inactive Reason</h4>
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
			                     <button  type="button" id="submitpassword" data-utype="female" data-uid="'.$row->id.'" class="btn btn-success submitpassword">Change Password</button>
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
											$actionLink .= '<tr><td>Ethnicity :  </td><td>'.$Ethnicity.'</td></tr>'; 	


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

 

											//@$sEthnicity = $sEthnicity['ethnicityName'] ? : "-";
											$actionLink .= '<tr><td>Spouse Ethnicity   :  </td><td>'.$sEthnicity.'</td></tr>'; 

											@$HijabPreference = $HijabPreference['hijabPreferenceName'] ? : "-";
											$actionLink .= '<tr><td>Hijab Preference     :  </td><td>'.$HijabPreference.'</td></tr>'; 

											@$hijabPreferenceAdditional = $row->hijabPreferenceAdditional ? : "-";
											$actionLink .= '<tr><td>Hijab Preference Additional :  </td><td>'.$hijabPreferenceAdditional.'</td></tr>';
 
											@$considerDivorcee = $row->considerDivorcee ? : "-";
											$actionLink .= '<tr><td>Consider Divorcee   :  </td><td>'.$considerDivorcee.'</td></tr>';

											@$mosqueVisitOther = $row->mosqueVisitOther ? : "-";
											$actionLink .= '<tr><td> Mosque Visit :  </td><td>'.$mosqueVisitOther.'</td></tr>';

											@$myCharacteristics1 = $row->myCharacteristics1 ? : "-";
											$actionLink .= '<tr><td>My Characteristics 1 :  </td><td>'.$myCharacteristics1.'</td></tr>';

											@$myCharacteristics2 = $row->myCharacteristics2 ? : "-";
											$actionLink .= '<tr><td>My Characteristics 2 :  </td><td>'.$myCharacteristics2.'</td></tr>';

											@$myCharacteristics3 = $row->myCharacteristics3 ? : "-";
											$actionLink .= '<tr><td>My Characteristics 3   :  </td><td>'.$myCharacteristics3.'</td></tr>';

											@$preferences = $row->preferences ? : "-";
											$actionLink .= '<tr><td>Preferences :  </td><td>'.$preferences.'</td></tr>';

											@$aboutMe = $row->aboutMe ? : "-";
											$actionLink .= '<tr><td>About Me :  </td><td>'.$aboutMe.'</td></tr>'; 

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
											$actionLink .= '<tr><td>Interests Hobbies Other :  </td><td>'.$interestsHobbiesOther.'</td></tr>'; 
  

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
            "recordsTotal" => $this->model_common->get_all_data($this->global_tblfemaleusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "recordsFiltered" => $this->model_common->get_filtered_data($this->global_tblfemaleusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "data" => $data,
        );
        echo json_encode($output);
        
    }


	public function female_consultants()
	 {
	 	$this->data['consultants'] = $this->model_common->get_all_records('Consultants');
	 	$this->render_admin_layouts('admin/female_consultants/index', $this->data);
	 	
	 } 


	 public function female_consultants_create()
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
                'gender' =>1,
        		'phone' => $this->input->post('phone'),
        		'type' => $this->input->post('type'),
        		 'recommendedBy' => $this->input->post('recommendedBy'),
                'bio' => $this->input->post('bio'),
                 
        	);

        	$create = $this->model_common->insertTableData($data, $this->global_tblconsultants);
        	if($create>0) {  
        		$this->session->set_flashdata('success', 'The female consultants was created successfully.');
        		redirect('users/female_consultants', 'refresh');
        	} else {
        		$this->session->set_flashdata('error', 'Error occurred!!');
        		redirect('users/female_consultants_create', 'refresh');
        	}

        } else {
            // false case
              $this->data['country'] = $this->model_common->get_all_records('Country');
            $this->render_admin_layouts('admin/female_consultants/create', $this->data);
        }		
	}

	public function female_consultants_edit($id = null)
	{
		if($id) {
			
			if(($this->input->post('firstName')!='') && ($this->input->post('lastName')!='') && ($this->input->post('phone')!='') && ($this->input->post('email')!='') ){

                
				// true case
		        if(empty($this->input->post('pwd')) && empty($this->input->post('cpassword'))) {

		        	$updateData = array( 
		        		'email' => $this->input->post('email'),
		        		'firstName' => $this->input->post('firstName'),
		        		'lastName' => $this->input->post('lastName'),
		        		'city' => $this->input->post('city'),
        				'country' => $this->input->post('country'),
		        		'phone' => $this->input->post('phone'),
		        		'type' => $this->input->post('type'),
		        		'gender' =>1,
		        		'recommendedBy' => $this->input->post('recommendedBy'),
                        'bio' => $this->input->post('bio'),
                        'max_candidates' => $this->input->post('max_candidates'),
                         
		        	);

                    $whereEqual = array('id'=>$id);
                    $update = $this->model_common->updateTableData($updateData,$this->global_tblconsultants,$whereEqual);

		        	if($update == true) {
		        		$this->session->set_flashdata('success', 'The female consultants has been successfully updated.');
		        		redirect('users/female_consultants', 'refresh');
		        	} else {
		        		$this->session->set_flashdata('error', 'Error occurred!!');
		        		redirect('users/female_consultants_edit/'.$id, 'refresh');
		        	}
		        } else {
		        	
					$password = md5($this->input->post('pwd'));

					$updateData = array( 
		        		'pwd' => $password,
		        		'email' => $this->input->post('email'),
		        		'firstName' => $this->input->post('firstName'),
		        		'lastName' => $this->input->post('lastName'),
		        		'phone' => $this->input->post('phone'),
		        		'city' => $this->input->post('city'),
		        		'type' => $this->input->post('type'),
        				'country' => $this->input->post('country'),
		        		'gender' =>1, 
		        		'max_candidates' => $this->input->post('max_candidates'),
		        	);

                    $whereEqual = array('id'=>$id); 
                    $update = $this->model_common->updateTableData($updateData,$this->global_tblconsultants,$whereEqual);
		        	if($update == true) {
		        		$this->session->set_flashdata('success', 'The female consultants has been successfully updated.');
		        		redirect('users/female_consultants', 'refresh');
		        	} else {
		        		$this->session->set_flashdata('error', 'Error occurred!!');
		        		redirect('users/female_consultants_edit/'.$id, 'refresh');
		        	}
		        }

	        } else {
	            // false case
                $whereEqual = array('id'=>$id);        
                $selectColumn['*'] = '*';
                $this->data['user_data'] = $this->model_common->getSingleDataByField($this->global_tblconsultants,$selectColumn,$whereEqual);
                  $this->data['country'] = $this->model_common->get_all_records('Country');
				$this->render_admin_layouts('admin/female_consultants/edit', $this->data);	
	        }	
		}	
	}

	public function female_consultants_delete($id)
	{

        if($id) {

            $whereEqual = array('id'=>$id);        
            $selectColumn['*'] = '*';
            $this->data['user_data'] = $this->model_common->getSingleDataByField($this->global_tblconsultants,$selectColumn,$whereEqual);

            $updateData['deleted'] = 1;
            $whereEqual = array('id'=>$id); 
            $update = $this->model_common->updateTableData($updateData,$this->global_tblconsultants,$whereEqual);

            if($update == true) {
                $this->session->set_flashdata('success', 'The Female consultants has been successfully deleted.');
                redirect('users/female_consultants', 'refresh');
            }
            else {
                $this->session->set_flashdata('error', 'Error occurred!!');
                redirect('users/female_consultants', 'refresh');
            }

        }
	}

    public function female_consultants_fetch_users(){

        // equal condition
        $whereEqual = array($this->global_tblconsultants.'.gender'=>1);

        $consultants = $this->input->post('consultants');
        $status = $this->input->post('status');

        if(isset($consultants) && $consultants > 0 ){
 			 $whereEqual[$this->global_tblconsultants.'.id'] = $consultants;
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
        /*$orderColumn = array($this->global_tblconsultants.".city", $this->global_tblconsultants.".firstName", $this->global_tblconsultants.".email", $this->global_tblconsultants.".created", $this->global_tblconsultants.".status");*/

        $orderColumn = array($this->global_tblconsultants.".type" ,$this->global_tblconsultants.".firstName", $this->global_tblconsultants.".lastName",   'Country.countryName', $this->global_tblconsultants.".phone", $this->global_tblconsultants.".email" , "", "", $this->global_tblconsultants.".last_login");

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
             $type= '';
              if($row->type == 1){
                     $type= 'Transactional';
              } else { 

                     $type= 'Guiding';
              }
 
            $sub_array[] = $type;

            $activem = $this->get_active_count($row->id, 'f_active');
            $inactivem = $this->get_active_count($row->id, 'f_inactive');

            if($row->deleted == 1){
            	 
	            $sub_array[] = '<del class="text-danger">'.$row->firstName.'</del>';
	            //$sub_array[] = '<del class="text-danger">'.$row->lastName.'</del><br> <span class="text-muted">Reason : '.$row->delete_reason.'</span>';
	            $sub_array[] = '<del class="text-danger">'.$row->lastName.'</del>';
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

            $userdelete = ''; 
           	if($row->deleted == 1){
           		$userdelete = 2;
           	} else {
           		$userdelete = 1;
           	}

            $actionLink = $this->model_common->getActionLinkConsultant('users/female_consultants_edit/',$row->id,'malecon','',$userdelete);

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
			                     <button  type="button" id="submitpasswordFemale" data-utype="con" data-uid="'.$row->id.'" class="btn btn-success submitpasswordFemale">Change Password</button>
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
									<h4 class="modal-title">Inactive Reason</h4>
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
	 	$this->data['Consultants'] = $this->model_common->get_all_records('Consultants');
	 	$this->render_admin_layouts('admin/male_consultants/index', $this->data);
	 	
	 } 

	public function inactive_consultants()
	 {
	 	$this->data['Consultants'] = $this->model_common->get_all_records('Consultants');
	 	$this->render_admin_layouts('admin/male_consultants/inactive_index', $this->data);
	 	
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
                'type' => $this->input->post('type'),
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

	public function male_consultants_edit($id = null)
	{
		if($id) {
			
			if(($this->input->post('firstName')!='') && ($this->input->post('lastName')!='') && ($this->input->post('phone')!='') && ($this->input->post('email')!='') ){

                
				// true case
		        if(empty($this->input->post('pwd')) && empty($this->input->post('cpassword'))) {

		        	$updateData = array( 
		        		'email' => $this->input->post('email'),
		        		'firstName' => $this->input->post('firstName'),
		        		'lastName' => $this->input->post('lastName'),
		        		'city' => $this->input->post('city'),
        				'country' => $this->input->post('country'),
		        		'phone' => $this->input->post('phone'),
		        		'type' => $this->input->post('type'),
		        		'recommendedBy' => $this->input->post('recommendedBy'),
                        'bio' => $this->input->post('bio'),
		        		'gender' =>0,
		        		'max_candidates' => $this->input->post('max_candidates'),
                         
		        	);

                    $whereEqual = array('id'=>$id);
                    $update = $this->model_common->updateTableData($updateData,$this->global_tblconsultants,$whereEqual);

		        	if($update == true) {
		        		$this->session->set_flashdata('success', 'The male consultants has been successfully updated.');
		        		redirect('users/male_consultants', 'refresh');
		        	} else {
		        		$this->session->set_flashdata('error', 'Error occurred!!');
		        		redirect('users/male_consultants_edit/'.$id, 'refresh');
		        	}
		        } else {
		        	
					$password = md5($this->input->post('pwd'));

					$updateData = array( 
		        		'pwd' => $password,
		        		'email' => $this->input->post('email'),
		        		'firstName' => $this->input->post('firstName'),
		        		'lastName' => $this->input->post('lastName'),
		        		'phone' => $this->input->post('phone'),
		        		'city' => $this->input->post('city'),
        				'country' => $this->input->post('country'),
        				'recommendedBy' => $this->input->post('recommendedBy'),
                        'bio' => $this->input->post('bio'),
		        		'gender' =>0, 
		        		'max_candidates' => $this->input->post('max_candidates'),
		        	);

                    $whereEqual = array('id'=>$id); 
                    $update = $this->model_common->updateTableData($updateData,$this->global_tblconsultants,$whereEqual);
		        	if($update == true) {
		        		$this->session->set_flashdata('success', 'The male consultants has been successfully updated.');
		        		redirect('users/male_consultants', 'refresh');
		        	} else {
		        		$this->session->set_flashdata('error', 'Error occurred!!');
		        		redirect('users/male_consultants_edit/'.$id, 'refresh');
		        	}
		        }

	        } else {
	            // false case
                $whereEqual = array('id'=>$id);        
                $selectColumn['*'] = '*';
                $this->data['user_data'] = $this->model_common->getSingleDataByField($this->global_tblconsultants,$selectColumn,$whereEqual);
                  $this->data['country'] = $this->model_common->get_all_records('Country');
				$this->render_admin_layouts('admin/male_consultants/edit', $this->data);	
	        }	
		}	
	}

	public function male_consultants_delete($id)
	{

        if($id) {

            $whereEqual = array('id'=>$id);        
            $selectColumn['*'] = '*';
            $this->data['user_data'] = $this->model_common->getSingleDataByField($this->global_tblconsultants,$selectColumn,$whereEqual);

            $updateData['deleted'] = 1;
            $whereEqual = array('id'=>$id); 
            $update = $this->model_common->updateTableData($updateData,$this->global_tblconsultants,$whereEqual);

            if($update == true) {
                $this->session->set_flashdata('success', 'The Female consultants has been successfully deleted.');
                redirect('users/male_consultants', 'refresh');
            }
            else {
                $this->session->set_flashdata('error', 'Error occurred!!');
                redirect('users/male_consultants', 'refresh');
            }

        }
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

    public function male_consultants_fetch_users(){

        // equal condition
        $whereEqual = array( $this->global_tblconsultants.'.gender'=>0); 


	   	$consultants = $this->input->post('consultants');
	   	$status = $this->input->post('status');
	     
 		
 		if(isset($consultants) && $consultants > 0 ){
 			 $whereEqual[$this->global_tblconsultants.'.id'] = $consultants;
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
        $orderColumn = array($this->global_tblconsultants.".type" ,$this->global_tblconsultants.".firstName", $this->global_tblconsultants.".lastName",   'Country.countryName', $this->global_tblconsultants.".phone", $this->global_tblconsultants.".email" , "", "", $this->global_tblconsultants.".last_login");

        // search column
        $searchColumn = array($this->global_tblconsultants.".city", $this->global_tblconsultants.".firstName", $this->global_tblconsultants.".email", $this->global_tblconsultants.".lastName");

        // order by
        $orderBy = array($this->global_tblconsultants.'.status' => "DESC");

        // join table
        $joinTableArray = array(array("joinTable"=>'Country', "joinField"=>"id", "relatedJoinTable"=>$this->global_tblconsultants, "relatedJoinField"=>"country","type"=>"left"));


        $fetch_data = $this->model_common->make_datatables($this->global_tblconsultants,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);

        $data = array();
        foreach ($fetch_data as $row) {

        	$type= '';
        	if($row->type == 1){
        		$type= 'Transactional';
        	} else { 

        		$type= 'Guiding';
        	}

            $sub_array = array();  
            $sub_array[] = $type;

            $activem = $this->get_active_count($row->id, 'm_active');
            $inactivem = $this->get_active_count($row->id, 'm_inactive');
         	
         	if($row->deleted == 1){
            	 
	            $sub_array[] = '<del class="text-danger">'.$row->firstName.'</del>';
	            //$sub_array[] = '<del class="text-danger">'.$row->lastName.'</del><br> <span class="text-muted">Reason : '.$row->delete_reason.'</span>';

	            $sub_array[] = '<del class="text-danger">'.$row->lastName.'</del>';
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

            $userdelete = ''; 
           	if($row->deleted == 1){
           		$userdelete = 2;
           	} else {
           		$userdelete = 1;
           	}

            $actionLink = $this->model_common->getActionLinkConsultant('users/male_consultants_edit/',$row->id,'femalecon','',$userdelete);

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
			                     <button  type="button" id="submitpassword" data-utype="con" data-uid="'.$row->id.'" class="btn btn-success submitpassword">Change Password</button>
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
									<h4 class="modal-title">Inactive Reason</h4>
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
			                     <button  type="button" id="submitreason_malecon" data-uid="'.$row->id.'" class="btn btn-success">Remove User</button>
			                 </form>
								<div>
								    </div>
										<div class="modal-footer">
										  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div></div></div></div>';

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

	 	$MawhereEqual = array('isActive'=>1, 'deleted'=>0);          
        $MaselectColumn['*'] = '*';  
        $Maorder = array();
        $Maorder['userMarriedStatusName'] = 'ASC'; 
        $this->data['MarriedStatus'] = $this->model_common->getMultipleDataByField('userMarriedStatus',$MaselectColumn,$MawhereEqual,$Maorder);

	 	$this->render_admin_layouts('admin/new_male/index', $this->data);
	 	
	 } 

	  public function new_female()
	 { 

	 	$MawhereEqual = array('isActive'=>1, 'deleted'=>0);          
        $MaselectColumn['*'] = '*';  
        $Maorder = array();
        $Maorder['userMarriedStatusName'] = 'ASC'; 
        $this->data['MarriedStatus'] = $this->model_common->getMultipleDataByField('userMarriedStatus',$MaselectColumn,$MawhereEqual,$Maorder);

	 	$this->render_admin_layouts('admin/new_female/index', $this->data);
	 	
	 } 

	 public function user_delete()
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

	        	$reason = $this->input->post('reason'); 
	            $whereEquals = array('id'=>$id);        
	            $selectColumn['*'] = '*';
	            $this->data['user_data'] = $this->model_common->getSingleDataByField($table,$selectColumn,$whereEquals);

	            $updateData['deleted'] = 1;
	            $updateData['delete_reason'] = $reason; 
	            $whereEqual['id'] = $id; 
	            $update = $this->model_common->updateTableData($updateData,$table,$whereEqual);

	            if($update == true) {
	                $res['msg'] =  'The user has been successfully deleted.';
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

	public function user_candidate_status()
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

	        	$reason = $this->input->post('reason'); 
	            $whereEquals = array('id'=>$id);        
	            $selectColumn['*'] = '*';
	            $this->data['user_data'] = $this->model_common->getSingleDataByField($table,$selectColumn,$whereEquals);

	            $updateData['marriedStatus'] = $reason; 
	            $whereEqual['id'] = $id; 
	            $update = $this->model_common->updateTableData($updateData,$table,$whereEqual);

	            if($update == true) {
	                $res['msg'] =  'The user has been successfully deleted.';
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


	public function user_changepassword()
	{

		$id = $this->input->post('id');
		$password = $this->input->post('password');

        if($id) {
        	$user_type =  $this->input->post('type'); 
        	$table = '';
        	if($user_type == 'male'){
        		$table = $this->global_tblusers;
        	} else if($user_type == 'female'){ 
        		$table = $this->global_tblfemaleusers;  
        	} else if($user_type == 'con'){
        		$table = $this->global_tblconsultants; 
        	}

        	if($table !=''){ 
 
	            $whereEquals = array('id'=>$id);        
	            $selectColumn['*'] = '*';
	            $this->data['user_data'] = $this->model_common->getSingleDataByField($table,$selectColumn,$whereEquals); 
	            

	            $updateData['pwd'] = md5($password); 
	            $whereEqual['id'] = $id; 
	            $update = $this->model_common->updateTableData($updateData,$table,$whereEqual);
	            $uemail =  $this->data['user_data']['email'];
	            $this->send_email($update,$uemail,$password);
	            if($update == true) {
	                $res['msg'] =  'The user reset password has been send successfully.';
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

	public function sendMessage($userType){

		if((!empty($this->input->post('receiverId')!='')) && (!empty($this->input->post('subjectText')!='')) && (!empty($this->input->post('messageText')!=''))){

			$fileURL = '';

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



			foreach ($this->input->post('receiverId') as $key => $value) {

				if(!empty($this->input->post('pdfType'))){

					if($this->input->post('pdfType')==2){
						$createpdf = $this->input->post('pdfID');

						$whereEqual = array('id'=>$createpdf);        
		                $selectColumn['*'] = '*';
		                $pdf_data = $this->model_common->getSingleDataByField('pdfForms',$selectColumn,$whereEqual);

						$fileURL = base_url('uploads/pdfFile/'.$pdf_data['pdfFile']);
					}

					if(!empty($createpdf)){

						$datap = array(  	
			        		'pdfID' => $createpdf,
			                'consultantID' => $value
			        	);

			        	$createp = $this->model_common->insertTableData($datap, 'pdfSentToConsultants');
			        }
				}
				
				if(!empty($value)){

					$userType = $this->input->post('userType');
					$user_data = array();
					if($userType==1){

						$whereEqual = array('id'=>$value);        
		                $selectColumn['*'] = 'id, firstName, lastName, email';
		                $user_data = $this->model_common->getSingleDataByField('MaleCandidates',$selectColumn,$whereEqual);

						$title_text = 'Male Candidates';

						$receiverId = $value;

		            } else if($userType==2){

		            	$whereEqual = array('id'=>$value);        
		                $selectColumn['*'] = 'id, firstName, lastName, email';
		                $user_data = $this->model_common->getSingleDataByField('FemaleCandidates',$selectColumn,$whereEqual);

					    $title_text = 'Female Candidates';

					    $receiverId = $value;

		        	} else if($userType==3){

		            	$whereEqual = array('id'=>$value);        
		                $selectColumn['*'] = 'id, firstName, lastName, email';
		                $user_data = $this->model_common->getSingleDataByField('Consultants',$selectColumn,$whereEqual);

						$title_text = 'Male Consultants';

						$receiverId = $value;

		    		} else if($userType==4){

		            	$whereEqual = array('id'=>$value);        
		                $selectColumn['*'] ='id, firstName, lastName, email';
		                $user_data = $this->model_common->getSingleDataByField('Consultants',$selectColumn,$whereEqual);

						$title_text = 'Female Consultants';

						$receiverId = $value;

		    		} else if($userType==5){

		    			if(strpos($value, '-Female') !== false){

		    				$receiverId = str_replace("-Female","",$value);

		    				$whereEqual = array('id'=>$receiverId);        
			                $selectColumn['*'] = 'id, firstName, lastName, email';
			                $user_data = $this->model_common->getSingleDataByField('FemaleCandidates',$selectColumn,$whereEqual);

			                $genderValue = 1;
						    
						} else{

							$receiverId = str_replace("-Male","",$value);
						    
						    $whereEqual = array('id'=>$receiverId);        
			                $selectColumn['*'] = 'id, firstName, lastName, email';
			                $user_data = $this->model_common->getSingleDataByField('MaleCandidates',$selectColumn,$whereEqual);

			                $genderValue = 0;
						}

						$title_text = 'Male & Female Candidates waiting to activated ';

		    		} else if($userType==6){


		    			if(strpos($value, '-Female') !== false){
		    				$receiverId = str_replace("-Female","",$value);
			                $genderValue = 1;						    
						} else{
							$receiverId = str_replace("-Male","",$value);
			                $genderValue = 0;
						}

		            	$whereEqual = array('id'=>$receiverId);        
		                $selectColumn['*'] ='id, firstName, lastName, email';
		                $user_data = $this->model_common->getSingleDataByField('Consultants',$selectColumn,$whereEqual);

						$title_text = 'Male & Female Consultants waiting to activated';

						$receiverId = $value;

		    		}

					// true case
		        	$data = array(  	
		        		'senderId' => $_SESSION['id'],
		        		'receiverId' => $receiverId,
		        		'receiverFirstname' => $receiverFirstname,
		        		'receiverLastname' => $receiverLastname,
		        		'receiverEmail' => $receiverEmail,
		        		'userType' => $this->input->post('userType'),
		        		'subjectText' => $this->input->post('subjectText'),
		        		'messageText' => $this->input->post('messageText'),
		                'addedByAdmin' => 1,
		        	);

		        	if(!empty($user_data)){
		        		$data['receiverFirstname'] = $user_data['firstName'];
		        		$data['receiverLastname'] = $user_data['lastName'];
		        		$data['receiverEmail'] = $user_data['email'];
		        	}

		        	if(($userType==5) || ($userType==6)){
		        		$data['gender'] = $genderValue;
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
            
            if($create>0) {  
        		$this->session->set_flashdata('success', 'Message successfully sent to the '.$title_text.'.');
        		redirect('users/messages/'.$userType, 'refresh');
        	} else {
        		$this->session->set_flashdata('error', 'Error occurred!!');
        		redirect('users/sendMessage', 'refresh');
        	}

        } else {
            // false case

            if($userType==1){

            	$mlwhereEqual = array('deleted'=>0, 'status'=>1);          
				$mlselectColumn['id'] = 'id, firstName, lastName, email';  
				$mlorder['id'] = 'DESC'; 
				$this->data['users'] = $this->model_common->getMultipleDataByField('MaleCandidates',$mlselectColumn,$mlwhereEqual,$mlorder);

				$this->data['title_text'] = 'Male Candidates';

            } else if($userType==2){

            	$femlwhereEqual = array('deleted'=>0, 'status'=>1);          
			    $femlselectColumn['id'] = 'id, firstName, lastName, email';  
			    $femlorder['id'] = 'DESC'; 
			    $this->data['users'] = $this->model_common->getMultipleDataByField('FemaleCandidates',$femlselectColumn,$femlwhereEqual,$femlorder);

			    $this->data['title_text'] = 'Female Candidates';

        	} else if($userType==3){

        		$mlconwhereEqual = array('deleted'=>0,'gender'=>'0', 'status'=>1);          
				$mlconselectColumn['id'] = 'id, firstName, lastName, email';  
				$mlconorder['id'] = 'DESC'; 
				$this->data['users'] = $this->model_common->getMultipleDataByField('Consultants',$mlconselectColumn,$mlconwhereEqual,$mlconorder);

				$this->data['title_text'] = 'Male Consultants';

    		} else if($userType==4){

    			$femlconwhereEqual = array('deleted'=>0,'gender'=>'1', 'status'=>1);          
				$femlconselectColumn['id'] = 'id, firstName, lastName, email';  
				$femlconorder['id'] = 'DESC'; 
				$this->data['users'] = $this->model_common->getMultipleDataByField('Consultants',$femlconselectColumn,$femlconwhereEqual,$femlconorder);

				$this->data['title_text'] = 'Female Consultants';

    		} else if($userType==5){

    			$mlwhereEqual = array('deleted'=>0, 'status'=>0);          
				$mlselectColumn['id'] = 'id, firstName, lastName, email, registrationDate';  
				$mlorder['id'] = 'DESC'; 
				$maleUsers = $this->model_common->getMultipleDataByField('MaleCandidates',$mlselectColumn,$mlwhereEqual,$mlorder);

				$keyStart = 0;
				$usersArray = array();
				if (!empty($maleUsers)) {
					foreach ($maleUsers as $key => $value) {

						$date48hours = date('Y-m-d H:i:s', strtotime($value['registrationDate']. ' + 2 days')); 
							
						if(date('Y-m-d H:i:s')>$date48hours){
							$usersArray[$keyStart] = $value;
							$usersArray[$keyStart]['gender'] = 0;
							$keyStart++;	
						}
					}
				}

				$femlwhereEqual = array('deleted'=>0, 'status'=>0);          
			    $femlselectColumn['id'] = 'id, firstName, lastName, email, registrationDate';  
			    $femlorder['id'] = 'DESC'; 
			    $femaleUsers = $this->model_common->getMultipleDataByField('FemaleCandidates',$femlselectColumn,$femlwhereEqual,$femlorder);

				if (!empty($femaleUsers)) {
					foreach ($femaleUsers as $key => $value) {

						if(date('Y-m-d H:i:s')>$date48hours){
							$usersArray[$keyStart] = $value;	
							$usersArray[$keyStart]['gender'] = 1;
							$keyStart++;
						}
					}
				}

				$this->data['users'] = $usersArray;

				$this->data['title_text'] = 'Male & Female Candidates waiting to activated';

    		} else if($userType==6){

    			$femlconwhereEqual = array('deleted'=>0, 'status'=>0);          
				$femlconselectColumn['id'] = 'id, firstName, lastName, email, created';  
				$femlconorder['id'] = 'DESC'; 
				$users = $this->model_common->getMultipleDataByField('Consultants',$femlconselectColumn,$femlconwhereEqual,$femlconorder);

				$usersArray = array();
				if (!empty($users)) {
					foreach ($users as $key => $value) {

						$date48hours = date('Y-m-d H:i:s', strtotime($value['created']. ' + 2 days')); 
							
						if(date('Y-m-d H:i:s')>$date48hours){
							$usersArray[] = $value;	
						}
					}
				}
				$this->data['users'] = $usersArray;

				$this->data['title_text'] = 'Male & Female Consultants waiting to activated';

    		}

    		$cwhereEqual = array('deleted'=>0);        
            $cselectColumn['*'] = '*'; 
            $this->data['pdfFiles'] = $this->model_common->getMultipleDataByField('pdfForms',$cselectColumn,$cwhereEqual);

    		$this->data['userType'] = $userType;

            $this->render_admin_layouts($this->data['view_path'].'/sendMessage', $this->data);
        }		
	}

	public function messages($userType){

		$this->data['userType'] = $userType;

		if($userType==1){

			$this->data['title_text'] = 'Male Candidates';

        } else if($userType==2){

		    $this->data['title_text'] = 'Female Candidates';

    	} else if($userType==3){

			$this->data['title_text'] = 'Male Consultants';

		} else if($userType==4){

			$this->data['title_text'] = 'Female Consultants';

		} else if($userType==5){

			$this->data['title_text'] = 'Male & Female Candidates waiting to activated';

		} else if($userType==6){

			$this->data['title_text'] = 'Male & Female Consultants waiting to activated';

		}

	 	$this->render_admin_layouts('admin/users/messages', $this->data);
	}

	public function fetch_messages(){

        // equal condition
        $whereEqual = array();
 
	    $userType = $this->input->post('userType'); 
 		
 		if(isset($userType) && $userType !='' ){
 			$whereEqual[$this->global_messages.'.userType'] = $userType;
 		}

        // not equal condition
        $whereNotEqual = array();

        $notIn = array();     

        // select data
        $selectColumn[$this->global_messages.'.*'] = $this->global_messages.'.*';

        /*$selectColumn['Consultants.firstName'] =  'Consultants.firstName as cfname';
        $selectColumn['Consultants.lastName'] =  'Consultants.lastName as clname';*/

        // order column
        $orderColumn = array($this->global_messages.".dateAdded");

        // search column
        $searchColumn = array($this->global_messages.".receiverFirstname", $this->global_messages.".receiverLastname", $this->global_messages.".receiverEmail", $this->global_messages.".subjectText", $this->global_messages.".messageText");

        // order by
        $orderBy = array($this->global_messages.'.dateAdded' => "DESC");
       // $orderBy = array($this->global_tblusers.'.registrationDate' => "DESC");

        // join table
        $joinTableArray = array();
        /*$joinTableArray = array(array("joinTable"=>'Consultants', "joinField"=>"id", "relatedJoinTable"=>$this->global_tblusers, "relatedJoinField"=>"consultant_id","type"=>"left"), array("joinTable"=>'MC_AgeRanges', "joinField"=>"mcid", "relatedJoinTable"=>$this->global_tblusers, "relatedJoinField"=>"id","type"=>"left"));*/
 
        $fetch_data = $this->model_common->make_datatables($this->global_messages,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);
    	 	
     
        $data = array();
        $countryliving = '';
        foreach ($fetch_data as $row) {
            $sub_array = array();

			$sub_array[] = $this->model_common->dateFormat($row->dateAdded);
			$sub_array[] = $row->receiverFirstname;
			$lastname = $row->receiverLastname;

			if($row->userType==5){
				if($row->gender==1){
					$lastname.= ' (Female)';
				} else {
					$lastname.= ' (Male)';
				}
			} else if($row->userType==6){
				if($row->gender==1){
					$lastname.= ' (Female)';
				} else {
					$lastname.= ' (Male)';
				}
			}

			$sub_array[] = $lastname;

			$sub_array[] = $row->receiverEmail;
			$sub_array[] = $row->subjectText;
			$sub_array[] = $row->messageText;

            $data[] = $sub_array;
        }

        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->model_common->get_all_data($this->global_messages,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "recordsFiltered" => $this->model_common->get_filtered_data($this->global_messages,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "data" => $data,
        );
        echo json_encode($output);
        
    }

    public function male_consultants_dashboard_fetch_users(){

        // equal condition
        $whereEqual = array( $this->global_tblconsultants.'.gender'=>0);

	   	$status = $this->input->post('status');
 		
 		if(isset($consultants) && $consultants > 0 ){
 			 $whereEqual[$this->global_tblconsultants.'.id'] = $consultants;
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
        $orderColumn = array($this->global_tblconsultants.".type" ,$this->global_tblconsultants.".firstName", $this->global_tblconsultants.".lastName",   'Country.countryName', $this->global_tblconsultants.".phone", $this->global_tblconsultants.".email" , "", "", $this->global_tblconsultants.".last_login");

        // search column
        $searchColumn = array($this->global_tblconsultants.".firstName", $this->global_tblconsultants.".email", $this->global_tblconsultants.".lastName");

        // order by
        $orderBy = array($this->global_tblconsultants.'.status' => "DESC");

        // join table
        $joinTableArray = array(array("joinTable"=>'Country', "joinField"=>"id", "relatedJoinTable"=>$this->global_tblconsultants, "relatedJoinField"=>"country","type"=>"left"));


        $fetch_data = $this->model_common->make_datatables($this->global_tblconsultants,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);

        $data = array();
        foreach ($fetch_data as $row) {

        	$type= '';
        	if($row->type == 1){
        		$type= 'Transactional';
        	} else { 

        		$type= 'Guiding';
        	}

            $sub_array = array();  
            $sub_array[] = $type;

            $activem = $this->get_active_count($row->id, 'f_active');
            $inactivem = $this->get_active_count($row->id, 'f_inactive');
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

            $actionLink = $this->model_common->getActionLink('users/male_consultants_edit/',$row->id,'femalecon','',1);

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
			                     <button  type="button" id="submitpassword" data-utype="con" data-uid="'.$row->id.'" class="btn btn-success submitpassword">Change Password</button>
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
									<h4 class="modal-title">Inactive Reason</h4>
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
			                     <button  type="button" id="submitreason_malecon" data-uid="'.$row->id.'" class="btn btn-success">Remove User</button>
			                 </form>
								<div>
								    </div>
										<div class="modal-footer">
										  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div></div></div></div>';

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

    public function female_consultants_dashboard_fetch_users(){

        // equal condition
        $whereEqual = array( $this->global_tblconsultants.'.gender'=>1);


	   	$consultants = $this->input->post('consultants');
	   	$status = $this->input->post('status');
	     
 		
 		if(isset($consultants) && $consultants > 0 ){
 			 $whereEqual[$this->global_tblconsultants.'.id'] = $consultants;
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
        $orderColumn = array($this->global_tblconsultants.".type" ,$this->global_tblconsultants.".firstName", $this->global_tblconsultants.".lastName",   'Country.countryName', $this->global_tblconsultants.".phone", $this->global_tblconsultants.".email" , "", "", $this->global_tblconsultants.".last_login");

        // search column
        $searchColumn = array($this->global_tblconsultants.".firstName", $this->global_tblconsultants.".email", $this->global_tblconsultants.".lastName");

        // order by
        $orderBy = array($this->global_tblconsultants.'.status' => "DESC");

        // join table
        $joinTableArray = array(array("joinTable"=>'Country', "joinField"=>"id", "relatedJoinTable"=>$this->global_tblconsultants, "relatedJoinField"=>"country","type"=>"left"));


        $fetch_data = $this->model_common->make_datatables($this->global_tblconsultants,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);

        $data = array();
        foreach ($fetch_data as $row) {

        	$type= '';
        	if($row->type == 1){
        		$type= 'Transactional';
        	} else { 

        		$type= 'Guiding';
        	}

            $sub_array = array();  
            $sub_array[] = $type;

            $activem = $this->get_active_count($row->id, 'f_active');
            $inactivem = $this->get_active_count($row->id, 'f_inactive');
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

            $actionLink = $this->model_common->getActionLink('users/male_consultants_edit/',$row->id,'femalecon','',1);

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
			                     <button  type="button" id="submitpassword" data-utype="con" data-uid="'.$row->id.'" class="btn btn-success submitpassword">Change Password</button>
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
									<h4 class="modal-title">Inactive Reason</h4>
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
			                     <button  type="button" id="submitreason_malecon" data-uid="'.$row->id.'" class="btn btn-success">Remove User</button>
			                 </form>
								<div>
								    </div>
										<div class="modal-footer">
										  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div></div></div></div>';

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

    public function fetch_candidates_dashboard(){

        // equal condition
        $whereEqual = array();
 
	    $start_date = $this->input->post('start_date'); 
	    $end_date = $this->input->post('end_date'); 
	   	 
	       
 		if((isset($start_date) && $start_date > 0) && isset($end_date) && $end_date > 0 ){
 			$whereEqual  = array($this->global_tblusers.'.registrationDate >= ' => date('Y-m-d',strtotime($start_date)), $this->global_tblusers.'.registrationDate <= '=> date('Y-m-d',strtotime($end_date) )); 
 			  
 		}


	      $consultants = $this->input->post('consultants');
	      $countryOfResidence = $this->input->post('countryOfResidence');
	      $personalEthnicityID = $this->input->post('personalEthnicityID');
	      $ageRange = $this->input->post('ageRange');
	      $citizenshipStatusID = $this->input->post('citizenshipStatusID');
	      $durationOfStayID = $this->input->post('durationOfStayID');
	      $highestEducationLevelID = $this->input->post('highestEducationLevelID');
	      $willingToRelocate = $this->input->post('willingToRelocate');
	      $maritalStatusID = $this->input->post('maritalStatusID');
	      $hijabPreferenceID = $this->input->post('hijabPreferenceID');
	      $from_height = $this->input->post('from_height');
		  $to_height = $this->input->post('to_height');
	      $from_age = $this->input->post('from_age');
	      $to_age = $this->input->post('to_age');
	      $status = $this->input->post('status');
 		
 		if(isset($consultants) && $consultants > 0 ){
 			 $whereEqual[$this->global_tblusers.'.consultant_id'] = $consultants;
 		}
		if(isset($countryOfResidence) && $countryOfResidence > 0 ){
 			 $whereEqual[$this->global_tblusers.'.countryOfResidence'] = $countryOfResidence;
 		}

 		if(isset($personalEthnicityID) && $personalEthnicityID > 0 ){
 			$whereEqual[$this->global_tblusers.'.personalEthnicityID'] = $personalEthnicityID;
 		}

 		if(isset($hijabPreferenceID) && $hijabPreferenceID > 0 ){
 			$whereEqual[$this->global_tblusers.'.hijabPreferenceID'] = $hijabPreferenceID;
 		}

 		if(isset($heightCM) && $heightCM > 0 ){
 			$whereEqual[$this->global_tblusers.'.heightCM'] = $heightCM;
 		}


 		if(isset($ageRange) && $ageRange > 0 ){
 			$whereEqual['MC_AgeRanges.ageRangeID'] = $ageRange;
 		}


		if(isset($citizenshipStatusID) && $citizenshipStatusID > 0 ){
 			$whereEqual[$this->global_tblusers.'.citizenshipStatusID'] = $citizenshipStatusID;
 		} 

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

 		//$whereEqual[$this->global_tblusers.'.consultant_cat_id'] = 1;
 	 
		$uorder = array();
    	$uselectColumn['birthdate'] = 'birthdate'; 
    	$uwhereEqual['status'] = 1;
    	$afjoinTableArray = array();
	 	$MaleCandidatesList = $this->model_common->get_table_records('MaleCandidates',$uselectColumn,$uwhereEqual,$afjoinTableArray,$uorder);   
 		
 		
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
        $orderColumn = array("", $this->global_tblusers.".id", $this->global_tblusers.".registrationDate", $this->global_tblusers.".firstName", $this->global_tblusers.".lastName");

        // search column
        $searchColumn = array($this->global_tblusers.".firstName", $this->global_tblusers.".email", $this->global_tblusers.".lastName");

        // order by
        $orderBy = array($this->global_tblusers.'.status' => "DESC");
       // $orderBy = array($this->global_tblusers.'.registrationDate' => "DESC");

        // join table
        $joinTableArray = array();
        $joinTableArray = array(array("joinTable"=>'Consultants', "joinField"=>"id", "relatedJoinTable"=>$this->global_tblusers, "relatedJoinField"=>"consultant_id","type"=>"left"), 
        array("joinTable"=>'MC_AgeRanges', "joinField"=>"mcid", "relatedJoinTable"=>$this->global_tblusers, "relatedJoinField"=>"id","type"=>"left"));
 

        $fetch_data = $this->model_common->make_datatables($this->global_tblusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);
    	 
     
        $data = array();
        $countryliving = '';
        foreach ($fetch_data as $row) {
            $sub_array = array();

            if($row->primimage && file_exists( 'uploads/users/'.$row->primimage) ){
                $sub_array[] =  '<img class="myImg" onclick="myFunction('.$row->id.');" id="myImg'.$row->id.'" height="50" src="'.base_url('uploads/users/'.$row->primimage).'">';
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

                  /*$setwhereEqual['id'] = $row->spouseEthnicityID;        
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
									<h4 class="modal-title">Inactive Reason</h4>
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

											 $heightCM = $row->heightCM ? : "&lt;137";
											$actionLink .= '<tr><td>Height Inches:  </td><td>'.$heightCM.'</td></tr>'; 

											 @$citizenshipStatusID = $CitizenshipStatus['statusName'] ? : "-";
											$actionLink .= '<tr><td>Citizenship Status :  </td><td>'.$citizenshipStatusID.'</td></tr>'; 

											 @$durationOfStayID = $DurationOfStay['desc'] ? : "-";
											$actionLink .= '<tr><td>Duration of Stay  :  </td><td>'.$durationOfStayID.'</td></tr>'; 

											// @$Ethnicity = $Ethnicity['ethnicityName'] ? : "-";
											$actionLink .= '<tr><td>Ethnicity :  </td><td>'.$Ethnicity.'</td></tr>'; 	


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
 

											//@$sEthnicity = $sEthnicity['ethnicityName'] ? : "-";
											$actionLink .= '<tr><td>Spouse Ethnicity :  </td><td>'.$sEthnicity.'</td></tr>'; 

											@$HijabPreference = $HijabPreference['hijabPreferenceName'] ? : "-";
											$actionLink .= '<tr><td>Hijab Preference :  </td><td>'.$HijabPreference.'</td></tr>'; 

											@$hijabPreferenceAdditional = $row->hijabPreferenceAdditional ? : "-";
											$actionLink .= '<tr><td>Hijab Preference Additional :  </td><td>'.$hijabPreferenceAdditional.'</td></tr>';
 
											@$considerDivorcee = $row->considerDivorcee ? : "-";
											$actionLink .= '<tr><td>Consider Divorcee :  </td><td>'.$considerDivorcee.'</td></tr>';

											@$mosqueVisitOther = $row->mosqueVisitOther ? : "-";
											$actionLink .= '<tr><td>Mosque Visit:  </td><td>'.$mosqueVisitOther.'</td></tr>';

											@$myCharacteristics1 = $row->myCharacteristics1 ? : "-";
											$actionLink .= '<tr><td>My Characteristics 1 :  </td><td>'.$myCharacteristics1.'</td></tr>';

											@$myCharacteristics2 = $row->myCharacteristics2 ? : "-";
											$actionLink .= '<tr><td>My Characteristics 2 :  </td><td>'.$myCharacteristics2.'</td></tr>';

											@$myCharacteristics3 = $row->myCharacteristics3 ? : "-";
											$actionLink .= '<tr><td>My Characteristics 3 :  </td><td>'.$myCharacteristics3.'</td></tr>';

											@$preferences = $row->preferences ? : "-";
											$actionLink .= '<tr><td>Preferences :  </td><td>'.$preferences.'</td></tr>';

											@$aboutMe = $row->aboutMe ? : "-";
											$actionLink .= '<tr><td>About Me   :  </td><td>'.$aboutMe.'</td></tr>'; 

											@$otherDetails = $row->otherDetails ? : "-";
											$actionLink .= '<tr><td>Other Details :  </td><td>'.$otherDetails.'</td></tr>';


											if(!empty($LivingArrangements)){
		        		 	 
												$actionLink .= '<tr><td>Living Arrangements : </td>';
												$afmvalues =array();
												foreach ($LivingArrangements as $key => $value) { 
												if($value > 0){
												 $actionLink .= ' <td>'. $value['description'].'</td> ';

													}
												}
												$actionLink .= '</tr>'; 
		        		 
		        							}

		        							if(!empty($AfterSpousePrefer)){
		        		 	 
												$actionLink .= '<tr><td>Living Style : </td>';
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
											$actionLink .= '<tr><td>Interests Hobbies Other :  </td><td>'.$interestsHobbiesOther.'</td></tr>'; 
 

										 
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
            "recordsTotal" => $this->model_common->get_all_data($this->global_tblusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "recordsFiltered" => $this->model_common->get_filtered_data($this->global_tblusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "data" => $data,
        );
        echo json_encode($output);
        
    }

    public function fetch_candidates_dashboardf(){

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


	      $consultants = $this->input->post('consultants');
	      $countryOfResidence = $this->input->post('countryOfResidence');
	      $personalEthnicityID = $this->input->post('personalEthnicityID');
	      $ageRange = $this->input->post('ageRange');
	      $citizenshipStatusID = $this->input->post('citizenshipStatusID');
	      $durationOfStayID = $this->input->post('durationOfStayID');
	      $highestEducationLevelID = $this->input->post('highestEducationLevelID');
	      $willingToRelocate = $this->input->post('willingToRelocate');
	      $maritalStatusID = $this->input->post('maritalStatusID');
	      $hijabPreferenceID = $this->input->post('hijabPreferenceID');
	      
	      $from_age = $this->input->post('from_age');
	      $to_age = $this->input->post('to_age');
	      $status = $this->input->post('status');

	      $from_height = $this->input->post('from_height');
	      $to_height = $this->input->post('to_height');
 		
 		if(isset($countryOfResidence) && $countryOfResidence > 0 ){
 			 $whereEqual[$this->global_tblfemaleusers.'.countryOfResidence'] = $countryOfResidence;
 		}

 		if(isset($consultants) && $consultants > 0 ){
 			 $whereEqual[$this->global_tblfemaleusers.'.consultant_id'] = $consultants;
 		}

 		if(isset($hijabPreferenceID) && $hijabPreferenceID > 0 ){
 			 $whereEqual[$this->global_tblfemaleusers.'.hijabPreferenceID'] = $hijabPreferenceID;
 		}

 	 

 		if(isset($personalEthnicityID) && $personalEthnicityID > 0 ){
 			$whereEqual[$this->global_tblfemaleusers.'.personalEthnicityID'] = $personalEthnicityID;
 		}

 		if(isset($ageRange) && $ageRange > 0 ){
 			$whereEqual['FC_AgeRanges.ageRangeID'] = $ageRange;
 		}


		if(isset($citizenshipStatusID) && $citizenshipStatusID > 0 ){
 			$whereEqual[$this->global_tblfemaleusers.'.citizenshipStatusID'] = $citizenshipStatusID;
 		} 

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
 			$whereEqual[$this->global_tblfemaleusers.'.maritalStatusID'] = $maritalStatusID;
 		} 

 		if(isset($status) && $status !='' ){
 			$whereEqual[$this->global_tblfemaleusers.'.status'] = $status;
 		}

 		//$whereEqual[$this->global_tblfemaleusers.'.consultant_cat_id'] = 1;

 		if(isset($ageRange) && $ageRange > 0 ){
 			$whereEqual['FC_AgeRanges.ageRangeID'] = $ageRange;
 		}
 		

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
 	


        // not equal condition
        $whereNotEqual = array();

        $notIn = array();     


        // select data
        $selectColumn[$this->global_tblfemaleusers.'.*'] = $this->global_tblfemaleusers.'.*';
         $selectColumn['Consultants.firstName'] =  'Consultants.firstName as cfname';
        $selectColumn['Consultants.lastName'] =  'Consultants.lastName as clname';
        $selectColumn['Consultants.type'] =  'Consultants.type as consultants_type';

        // order column
        $orderColumn = array("", $this->global_tblusers.".id", $this->global_tblusers.".registrationDate", $this->global_tblusers.".firstName", $this->global_tblusers.".lastName");

        // search column
        $searchColumn = array($this->global_tblfemaleusers.".firstName", $this->global_tblfemaleusers.".email", $this->global_tblfemaleusers.".lastName");

        // order by
        $orderBy = array($this->global_tblfemaleusers.'.status' => "DESC");
        

        // join table
        $joinTableArray = array(array("joinTable"=>'Consultants', "joinField"=>"id", "relatedJoinTable"=>$this->global_tblfemaleusers, "relatedJoinField"=>"consultant_id","type"=>"left"), array("joinTable"=>'FC_AgeRanges', "joinField"=>"fcid", "relatedJoinTable"=>$this->global_tblfemaleusers, "relatedJoinField"=>"id","type"=>"left") );

        $fetch_data = $this->model_common->make_datatables($this->global_tblfemaleusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);

        $data = array();
        foreach ($fetch_data as $row) {
            $sub_array = array();
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
            // $sub_array[] = $row->cfname .' '.$row->clname; 
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

                  /*$setwhereEqual['id'] = $row->spouseEthnicityID;        
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
									<h4 class="modal-title">Inactive Reason</h4>
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
			                     <button  type="button" id="submitpassword" data-utype="female" data-uid="'.$row->id.'" class="btn btn-success submitpassword">Change Password</button>
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
											$actionLink .= '<tr><td>Ethnicity :  </td><td>'.$Ethnicity.'</td></tr>'; 	


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

 

											//@$sEthnicity = $sEthnicity['ethnicityName'] ? : "-";
											$actionLink .= '<tr><td>Spouse Ethnicity   :  </td><td>'.$sEthnicity.'</td></tr>'; 

											@$HijabPreference = $HijabPreference['hijabPreferenceName'] ? : "-";
											$actionLink .= '<tr><td>Hijab Preference     :  </td><td>'.$HijabPreference.'</td></tr>'; 

											@$hijabPreferenceAdditional = $row->hijabPreferenceAdditional ? : "-";
											$actionLink .= '<tr><td>Hijab Preference Additional :  </td><td>'.$hijabPreferenceAdditional.'</td></tr>';
 
											@$considerDivorcee = $row->considerDivorcee ? : "-";
											$actionLink .= '<tr><td>Consider Divorcee   :  </td><td>'.$considerDivorcee.'</td></tr>';

											@$mosqueVisitOther = $row->mosqueVisitOther ? : "-";
											$actionLink .= '<tr><td> Mosque Visit :  </td><td>'.$mosqueVisitOther.'</td></tr>';

											@$myCharacteristics1 = $row->myCharacteristics1 ? : "-";
											$actionLink .= '<tr><td>My Characteristics 1 :  </td><td>'.$myCharacteristics1.'</td></tr>';

											@$myCharacteristics2 = $row->myCharacteristics2 ? : "-";
											$actionLink .= '<tr><td>My Characteristics 2 :  </td><td>'.$myCharacteristics2.'</td></tr>';

											@$myCharacteristics3 = $row->myCharacteristics3 ? : "-";
											$actionLink .= '<tr><td>My Characteristics 3   :  </td><td>'.$myCharacteristics3.'</td></tr>';

											@$preferences = $row->preferences ? : "-";
											$actionLink .= '<tr><td>Preferences :  </td><td>'.$preferences.'</td></tr>';

											@$aboutMe = $row->aboutMe ? : "-";
											$actionLink .= '<tr><td>About Me :  </td><td>'.$aboutMe.'</td></tr>'; 

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
											$actionLink .= '<tr><td>Interests Hobbies Other :  </td><td>'.$interestsHobbiesOther.'</td></tr>'; 
  

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
            "recordsTotal" => $this->model_common->get_all_data($this->global_tblfemaleusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "recordsFiltered" => $this->model_common->get_filtered_data($this->global_tblfemaleusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "data" => $data,
        );
        echo json_encode($output);
        
    }

    public function updates_candidate_status()
	{

       	$filterCandidateStatus = $this->input->post('filterCandidateStatus');
       	$type = $this->input->post('type');
       	$ids = $this->input->post('ids');

        if(!empty($ids)) {

        	$user_type =  $this->input->post('type'); 

        	$table = '';
        	if($user_type == 'male'){
        		$table = $this->global_tblusers;
        	} else if($user_type == 'female'){ 
        		$table = $this->global_tblfemaleusers;  
        	} 

        	if($table !=''){ 

        		$update = '';
        		foreach ($ids as $key => $value) {
		            $updateData['marriedStatus'] = $filterCandidateStatus; 
		            $whereEqual['id'] = $value; 
		            $update = $this->model_common->updateTableData($updateData,$table,$whereEqual);		            
        		}

	        	if($update == true) {
	                $res['msg'] =  'The candidates status has been successfully updated.';
	                $res['success'] =  1;
	                echo json_encode($res);
	            } else { 
	                $res['msg'] = 'Error occurred!!';
	                $res['success'] = 0;
	                echo json_encode($res);
	            }

	        }

        }
	}

	public function updates_profile_status()
	{

       	$filterStatus = $this->input->post('filterStatus');
       	$type = $this->input->post('type');
       	$ids = $this->input->post('ids');

        if(!empty($ids)) {

        	$user_type =  $this->input->post('type'); 

        	$table = '';
        	if($user_type == 'male'){
        		$table = $this->global_tblusers;
        	} else if($user_type == 'female'){ 
        		$table = $this->global_tblfemaleusers;  
        	} 

        	if($table !=''){ 

        		$update = '';
        		foreach ($ids as $key => $value) {
		            $updateData['status'] = $filterStatus; 
		            $whereEqual['id'] = $value; 
		            $update = $this->model_common->updateTableData($updateData,$table,$whereEqual);		            
        		}

	        	if($update == true) {
	                $res['msg'] =  'The candidates status has been successfully updated.';
	                $res['success'] =  1;
	                echo json_encode($res);
	            } else { 
	                $res['msg'] = 'Error occurred!!';
	                $res['success'] = 0;
	                echo json_encode($res);
	            }

	        }

        }
	}

	public function inative_male_consultants_fetch_users(){

        // equal condition
        $whereEqual = array(); 


	   	$consultants = $this->input->post('consultants');
	   	$status = $this->input->post('status');
	     
 		
 		if(isset($consultants) && $consultants > 0 ){
 			 $whereEqual[$this->global_tblconsultants.'.id'] = $consultants;
 		}

 		$status = 0;
 		$whereEqual[$this->global_tblconsultants.'.status'] = $status;
      
        // not equal condition
        $whereNotEqual = array();

        $notIn = array();     


        // select data
        $selectColumn[$this->global_tblconsultants.'.*'] = $this->global_tblconsultants.'.*';
        $selectColumn['Country.countryName'] =  'Country.countryName';
        // order column
        $orderColumn = array($this->global_tblconsultants.".type" ,$this->global_tblconsultants.".firstName", $this->global_tblconsultants.".lastName",   'Country.countryName', $this->global_tblconsultants.".phone", $this->global_tblconsultants.".email" , "", "", $this->global_tblconsultants.".last_login");

        // search column
        $searchColumn = array($this->global_tblconsultants.".city", $this->global_tblconsultants.".firstName", $this->global_tblconsultants.".email", $this->global_tblconsultants.".lastName");

        // order by
        $orderBy = array($this->global_tblconsultants.'.status' => "DESC");

        // join table
        $joinTableArray = array(array("joinTable"=>'Country', "joinField"=>"id", "relatedJoinTable"=>$this->global_tblconsultants, "relatedJoinField"=>"country","type"=>"left"));


        $fetch_data = $this->model_common->make_datatables($this->global_tblconsultants,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);

        $data = array();
        foreach ($fetch_data as $row) {

        	$type= '';
        	if($row->type == 1){
        		$type= 'Transactional';
        	} else { 

        		$type= 'Guiding';
        	}

            $sub_array = array();  
            $sub_array[] = $type;

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

            $actionLink = $this->model_common->getActionLink('users/male_consultants_edit/',$row->id,'femalecon','',1);

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
			                     <button  type="button" id="submitpassword" data-utype="con" data-uid="'.$row->id.'" class="btn btn-success submitpassword">Change Password</button>
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
									<h4 class="modal-title">Inactive Reason</h4>
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
			                     <button  type="button" id="submitreason_malecon" data-uid="'.$row->id.'" class="btn btn-success">Remove User</button>
			                 </form>
								<div>
								    </div>
										<div class="modal-footer">
										  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div></div></div></div>';

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

    public function inactive_male_candidates(){ 
		  
	 	$this->render_admin_layouts('admin/users/inactive_male_candidates', $this->data);
	 	
	 } 

	 public function fetch_inactive_users(){

        // equal condition
        $whereEqual = array();
 
	    $start_date = $this->input->post('start_date'); 
	    $end_date = $this->input->post('end_date'); 
	   	 
	       
 		if((isset($start_date) && $start_date > 0) && isset($end_date) && $end_date > 0 ){
 			$whereEqual  = array($this->global_tblusers.'.registrationDate >= ' => date('Y-m-d',strtotime($start_date)), $this->global_tblusers.'.registrationDate <= '=> date('Y-m-d',strtotime($end_date) )); 
 			  
 		}

 		$MawhereEqual = array('isActive'=>1);          
            $MaselectColumn['*'] = '*';  
            $Maorder = array();
            $Maorder['userMarriedStatusName'] = 'ASC'; 
            $allMarriedStatus = $this->model_common->getMultipleDataByField('userMarriedStatus',$MaselectColumn,$MawhereEqual,$Maorder);


	      $consultants = $this->input->post('consultants');
	      $countryOfResidence = $this->input->post('countryOfResidence');
	      $personalEthnicityID = $this->input->post('personalEthnicityID');
	      $ageRange = $this->input->post('ageRange');
	      $citizenshipStatusID = $this->input->post('citizenshipStatusID');
	      $durationOfStayID = $this->input->post('durationOfStayID');
	      $highestEducationLevelID = $this->input->post('highestEducationLevelID');
	      $willingToRelocate = $this->input->post('willingToRelocate');
	      $maritalStatusID = $this->input->post('maritalStatusID');
	      $hijabPreferenceID = $this->input->post('hijabPreferenceID');
	      $from_height = $this->input->post('from_height');
		  $to_height = $this->input->post('to_height');
	      $from_age = $this->input->post('from_age');
	      $to_age = $this->input->post('to_age');
	      $status = $this->input->post('status');
 		
 		if(isset($consultants) && $consultants > 0 ){
 			 $whereEqual[$this->global_tblusers.'.consultant_id'] = $consultants;
 		}
		if(isset($countryOfResidence) && $countryOfResidence > 0 ){
 			 $whereEqual[$this->global_tblusers.'.countryOfResidence'] = $countryOfResidence;
 		}

 		if(isset($personalEthnicityID) && $personalEthnicityID > 0 ){
 			$whereEqual[$this->global_tblusers.'.personalEthnicityID'] = $personalEthnicityID;
 		}

 		if(isset($hijabPreferenceID) && $hijabPreferenceID > 0 ){
 			$whereEqual[$this->global_tblusers.'.hijabPreferenceID'] = $hijabPreferenceID;
 		}

 		if(isset($heightCM) && $heightCM > 0 ){
 			$whereEqual[$this->global_tblusers.'.heightCM'] = $heightCM;
 		}


 		if(isset($ageRange) && $ageRange > 0 ){
 			$whereEqual['MC_AgeRanges.ageRangeID'] = $ageRange;
 		}


		if(isset($citizenshipStatusID) && $citizenshipStatusID > 0 ){
 			$whereEqual[$this->global_tblusers.'.citizenshipStatusID'] = $citizenshipStatusID;
 		} 

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

 		$whereEqual[$this->global_tblusers.'.status'] = 0;

 		//$whereEqual[$this->global_tblusers.'.consultant_cat_id'] = 1;
 	 
		$uorder = array();
    	$uselectColumn['birthdate'] = 'birthdate'; 
    	$uwhereEqual['status'] = 1;
    	$afjoinTableArray = array();
	 	$MaleCandidatesList = $this->model_common->get_table_records('MaleCandidates',$uselectColumn,$uwhereEqual,$afjoinTableArray,$uorder);   
 		
 		
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
        $orderColumn = array("", "", $this->global_tblusers.".id", $this->global_tblusers.".registrationDate", $this->global_tblusers.".firstName", $this->global_tblusers.".lastName", "", "", "", $this->global_tblusers.".last_login");

        // search column
        $searchColumn = array($this->global_tblusers.".cityOfResidence", $this->global_tblusers.".firstName", $this->global_tblusers.".email", $this->global_tblusers.".lastName","Consultants.firstName","Consultants.lastName");

        // order by
        $orderBy = array($this->global_tblusers.'.status' => "DESC");
       // $orderBy = array($this->global_tblusers.'.registrationDate' => "DESC");

        // join table
        $joinTableArray = array();
        $joinTableArray = array(array("joinTable"=>'Consultants', "joinField"=>"id", "relatedJoinTable"=>$this->global_tblusers, "relatedJoinField"=>"consultant_id","type"=>"left"), 
        array("joinTable"=>'MC_AgeRanges', "joinField"=>"mcid", "relatedJoinTable"=>$this->global_tblusers, "relatedJoinField"=>"id","type"=>"left"));
 

        $fetch_data = $this->model_common->make_datatables($this->global_tblusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);
    	 
     
        $data = array();
        $countryliving = '';
        foreach ($fetch_data as $row) {
            $sub_array = array();

            $sub_array[] =  '<td><label class="form-controlNew"><input type="checkbox" class="checkSingle" name="custom_check[]" id="custom_check_'.$row->id.'" value="'.$row->id.'"/></label>';

            if($row->primimage && file_exists( 'uploads/users/'.$row->primimage) ){
                $sub_array[] =  '<img class="myImg" onclick="myFunction('.$row->id.');" id="myImg'.$row->id.'" height="50" src="'.base_url('uploads/users/'.$row->primimage).'">';
            } else {
                $sub_array[] =  '<img height="50" src="'.base_url('assets/images/male.jpeg').'">';
            }
 
            if($row->deleted == 1){
            	$sub_array[] = '<del class="text-danger">'.$row->id.'</del>';
            	$sub_array[] = '<del class="text-danger">'.$this->model_common->dateFormat($row->registrationDate).'</del>';
	            $sub_array[] = '<del class="text-danger">'.$row->firstName.'</del>';
	            $sub_array[] = '<del class="text-danger">'.$row->lastName.'</del><br> <span class="text-muted">Reason : '.$row->delete_reason.'</span>';
        	} else {
	    		$sub_array[] = $row->id;
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

            $cwhereEqual1['id'] = $row->marriedStatus;          
             $cselectColumn1 = array();
            $cselectColumn1['userMarriedStatusName'] = 'userMarriedStatusName';   
            $userMarriedStatusName = $this->model_common->getSingleDataByField('userMarriedStatus',$cselectColumn1,$cwhereEqual1 );

            $candidatestausLink = '';

            /*if($row->marriedStatus!=0){
            	$candidatestausLink .=  '<a class="btn btn-info" href="javascript:void(0)" data-toggle="modal" data-target="#candidatestatus_' . $row->id .'" data-id="' . $row->id . '">'.$userMarriedStatusName['userMarriedStatusName'].'</a>';
            } else {
            	$candidatestausLink .=  '<a class="btn btn-info" href="javascript:void(0)" data-toggle="modal" data-target="#candidatestatus_' . $row->id .'" data-id="' . $row->id . '">Not Defined</a>';
            }

            

            $candidatestausLink .='<div id="candidatestatus_'.$row->id.'" class="modal fade " role="dialog">
						<div class="modal-dialog modal-lg"> 
							<div class="modal-content"> 
						
								<div class="modal-header"> 
									<h4 class="modal-title">Inactive Reason</h4>
								</div>
								<div class="modal-body"> 
								<form id="deleteuser" class="deleteuser" method="post">
									<input type="hidden" name="delete_user_id" id="delete_user_id" value="'.$row->id.'">';
							                  
							         if(!empty($allMarriedStatus)){
							         	foreach ($allMarriedStatus as $key => $value) {
							         			
							         			$candidatestausLink .='<div class="form-check">
								                      <label class="form-check-label">
								                        <input type="radio" class="form-check-input" name="reason" value="'.$value['id'].'">'.$value['userMarriedStatusName'].'
								                      </label>
								                    </div>';

							         	}
							         }

            

			                     $candidatestausLink .='<button  type="button" id="submitreasoncandidate" data-uid="'.$row->id.'" class="btn btn-success">Update Status</button>
			                 </form>
								<div>
								    </div>
										<div class="modal-footer">
										  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div></div></div></div>';*/

			$sub_array[] =  $candidatestausLink;

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

                  /*$setwhereEqual['id'] = $row->spouseEthnicityID;        
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
									<h4 class="modal-title">Inactive Reason</h4>
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

											 $heightCM = $row->heightCM ? : "&lt;137";
											$actionLink .= '<tr><td>Height Inches:  </td><td>'.$heightCM.'</td></tr>'; 

											 @$citizenshipStatusID = $CitizenshipStatus['statusName'] ? : "-";
											$actionLink .= '<tr><td>Citizenship Status :  </td><td>'.$citizenshipStatusID.'</td></tr>'; 

											 @$durationOfStayID = $DurationOfStay['desc'] ? : "-";
											$actionLink .= '<tr><td>Duration of Stay  :  </td><td>'.$durationOfStayID.'</td></tr>'; 

											 //@$Ethnicity = $Ethnicity['ethnicityName'] ? : "-";
											$actionLink .= '<tr><td>Ethnicity :  </td><td>'.$Ethnicity.'</td></tr>'; 	


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
 

											//@$sEthnicity = $sEthnicity['ethnicityName'] ? : "-";
											$actionLink .= '<tr><td>Spouse Ethnicity :  </td><td>'.$sEthnicity.'</td></tr>'; 

											@$HijabPreference = $HijabPreference['hijabPreferenceName'] ? : "-";
											$actionLink .= '<tr><td>Hijab Preference :  </td><td>'.$HijabPreference.'</td></tr>'; 

											@$hijabPreferenceAdditional = $row->hijabPreferenceAdditional ? : "-";
											$actionLink .= '<tr><td>Hijab Preference Additional :  </td><td>'.$hijabPreferenceAdditional.'</td></tr>';
 
											@$considerDivorcee = $row->considerDivorcee ? : "-";
											$actionLink .= '<tr><td>Consider Divorcee :  </td><td>'.$considerDivorcee.'</td></tr>';

											@$mosqueVisitOther = $row->mosqueVisitOther ? : "-";
											$actionLink .= '<tr><td>Mosque Visit:  </td><td>'.$mosqueVisitOther.'</td></tr>';

											@$myCharacteristics1 = $row->myCharacteristics1 ? : "-";
											$actionLink .= '<tr><td>My Characteristics 1 :  </td><td>'.$myCharacteristics1.'</td></tr>';

											@$myCharacteristics2 = $row->myCharacteristics2 ? : "-";
											$actionLink .= '<tr><td>My Characteristics 2 :  </td><td>'.$myCharacteristics2.'</td></tr>';

											@$myCharacteristics3 = $row->myCharacteristics3 ? : "-";
											$actionLink .= '<tr><td>My Characteristics 3 :  </td><td>'.$myCharacteristics3.'</td></tr>';

											@$preferences = $row->preferences ? : "-";
											$actionLink .= '<tr><td>Preferences :  </td><td>'.$preferences.'</td></tr>';

											@$aboutMe = $row->aboutMe ? : "-";
											$actionLink .= '<tr><td>About Me   :  </td><td>'.$aboutMe.'</td></tr>'; 

											@$otherDetails = $row->otherDetails ? : "-";
											$actionLink .= '<tr><td>Other Details :  </td><td>'.$otherDetails.'</td></tr>';


											if(!empty($LivingArrangements)){
		        		 	 
												$actionLink .= '<tr><td>Living Arrangements : </td>';
												$afmvalues =array();
												foreach ($LivingArrangements as $key => $value) { 
												if($value > 0){
												 $actionLink .= ' <td>'. $value['description'].'</td> ';

													}
												}
												$actionLink .= '</tr>'; 
		        		 
		        							}

		        							if(!empty($AfterSpousePrefer)){
		        		 	 
												$actionLink .= '<tr><td>Living Style : </td>';
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
											$actionLink .= '<tr><td>Interests Hobbies Other :  </td><td>'.$interestsHobbiesOther.'</td></tr>'; 
 

										 
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
            "recordsTotal" => $this->model_common->get_all_data($this->global_tblusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "recordsFiltered" => $this->model_common->get_filtered_data($this->global_tblusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "data" => $data,
        );
        echo json_encode($output);
        
    }

    public function inactive_female(){	
	 	 
	 	$this->render_admin_layouts('admin/female/inactive_female_candidates', $this->data);
	 	
	} 

	public function inactive_female_fetch_users(){

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

 		$MawhereEqual = array('isActive'=>1);          
            $MaselectColumn['*'] = '*';  
            $Maorder = array();
            $Maorder['userMarriedStatusName'] = 'ASC'; 
            $allMarriedStatus = $this->model_common->getMultipleDataByField('userMarriedStatus',$MaselectColumn,$MawhereEqual,$Maorder);



	      $consultants = $this->input->post('consultants');
	      $countryOfResidence = $this->input->post('countryOfResidence');
	      $personalEthnicityID = $this->input->post('personalEthnicityID');
	      $ageRange = $this->input->post('ageRange');
	      $citizenshipStatusID = $this->input->post('citizenshipStatusID');
	      $durationOfStayID = $this->input->post('durationOfStayID');
	      $highestEducationLevelID = $this->input->post('highestEducationLevelID');
	      $willingToRelocate = $this->input->post('willingToRelocate');
	      $maritalStatusID = $this->input->post('maritalStatusID');
	      $hijabPreferenceID = $this->input->post('hijabPreferenceID');
	      
	      $from_age = $this->input->post('from_age');
	      $to_age = $this->input->post('to_age');
	      $status = $this->input->post('status');

	      $from_height = $this->input->post('from_height');
	      $to_height = $this->input->post('to_height');
 		
 		if(isset($countryOfResidence) && $countryOfResidence > 0 ){
 			 $whereEqual[$this->global_tblfemaleusers.'.countryOfResidence'] = $countryOfResidence;
 		}

 		if(isset($consultants) && $consultants > 0 ){
 			 $whereEqual[$this->global_tblfemaleusers.'.consultant_id'] = $consultants;
 		}

 		if(isset($hijabPreferenceID) && $hijabPreferenceID > 0 ){
 			 $whereEqual[$this->global_tblfemaleusers.'.hijabPreferenceID'] = $hijabPreferenceID;
 		}

 	 

 		if(isset($personalEthnicityID) && $personalEthnicityID > 0 ){
 			$whereEqual[$this->global_tblfemaleusers.'.personalEthnicityID'] = $personalEthnicityID;
 		}

 		if(isset($ageRange) && $ageRange > 0 ){
 			$whereEqual['FC_AgeRanges.ageRangeID'] = $ageRange;
 		}


		if(isset($citizenshipStatusID) && $citizenshipStatusID > 0 ){
 			$whereEqual[$this->global_tblfemaleusers.'.citizenshipStatusID'] = $citizenshipStatusID;
 		} 

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
 			$whereEqual[$this->global_tblfemaleusers.'.maritalStatusID'] = $maritalStatusID;
 		} 

 		if(isset($status) && $status !='' ){
 			$whereEqual[$this->global_tblfemaleusers.'.status'] = $status;
 		}

 		$whereEqual[$this->global_tblfemaleusers.'.status'] = 0;

 		//$whereEqual[$this->global_tblfemaleusers.'.consultant_cat_id'] = 1;

 		if(isset($ageRange) && $ageRange > 0 ){
 			$whereEqual['FC_AgeRanges.ageRangeID'] = $ageRange;
 		}
 		

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
 	


        // not equal condition
        $whereNotEqual = array();

        $notIn = array();     


        // select data
        $selectColumn[$this->global_tblfemaleusers.'.*'] = $this->global_tblfemaleusers.'.*';
         $selectColumn['Consultants.firstName'] =  'Consultants.firstName as cfname';
        $selectColumn['Consultants.lastName'] =  'Consultants.lastName as clname';
        $selectColumn['Consultants.type'] =  'Consultants.type as consultants_type';

        // order column
        $orderColumn = array("", "", $this->global_tblfemaleusers.".id", $this->global_tblfemaleusers.".registrationDate", $this->global_tblfemaleusers.".firstName", $this->global_tblfemaleusers.".lastName", "", "", "", $this->global_tblfemaleusers.".last_login");

        // search column
        $searchColumn = array($this->global_tblfemaleusers.".id", $this->global_tblfemaleusers.".firstName", $this->global_tblfemaleusers.".lastName","Consultants.firstName","Consultants.lastName");

        // order by
        $orderBy = array($this->global_tblfemaleusers.'.status' => "DESC");
        

        // join table
        $joinTableArray = array(array("joinTable"=>'Consultants', "joinField"=>"id", "relatedJoinTable"=>$this->global_tblfemaleusers, "relatedJoinField"=>"consultant_id","type"=>"left"), array("joinTable"=>'FC_AgeRanges', "joinField"=>"fcid", "relatedJoinTable"=>$this->global_tblfemaleusers, "relatedJoinField"=>"id","type"=>"left") );

        $fetch_data = $this->model_common->make_datatables($this->global_tblfemaleusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn);

        $data = array();
        foreach ($fetch_data as $row) {
            $sub_array = array();

            $sub_array[] =  '<td><label class="form-controlNew"><input type="checkbox" class="checkSingle" name="custom_check[]" id="custom_check_'.$row->id.'" value="'.$row->id.'"/></label>';

            if($row->primimage && file_exists( 'uploads/female/'.$row->primimage) ){
                $sub_array[] =  '<img class="myImg" onclick="myFunction('.$row->id.');" id="myImg'.$row->id.'" height="50" src="'.base_url('uploads/female/'.$row->primimage).'">';
            } else {
                $sub_array[] =  '<img height="50" src="'.base_url('assets/images/female.jpeg').'">';
            }
              
            if($row->deleted == 1){
            	$sub_array[] = '<del class="text-danger">'.$row->id.'</del>';
            	$sub_array[] = '<del class="text-danger">'.$this->model_common->dateFormat($row->registrationDate).'</del>';
	            $sub_array[] = '<del class="text-danger">'.$row->firstName.'</del>';
	            $sub_array[] = '<del class="text-danger">'.$row->lastName.'</del><br> <span class="text-muted">Reason : '.$row->delete_reason.'</span>';
        	} else {
            	$sub_array[] = $row->id;
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
            // $sub_array[] = $row->cfname .' '.$row->clname; 
            $changeStatusLink = $this->model_common->getChangeStatusLink($this->global_tblfemaleusers,$row->id,$row->status);
             $sub_array[] = $changeStatusLink;

             $cwhereEqual1['id'] = $row->marriedStatus;          
             $cselectColumn1 = array();
            $cselectColumn1['userMarriedStatusName'] = 'userMarriedStatusName';   
            $userMarriedStatusName = $this->model_common->getSingleDataByField('userMarriedStatus',$cselectColumn1,$cwhereEqual1 );

            $candidatestausLink = '';

            /*if($row->marriedStatus!=0){
            	$candidatestausLink .=  '<a class="btn btn-info" href="javascript:void(0)" data-toggle="modal" data-target="#candidatestatus_' . $row->id .'" data-id="' . $row->id . '">'.$userMarriedStatusName['userMarriedStatusName'].'</a>';
            } else {
            	$candidatestausLink .=  '<a class="btn btn-info" href="javascript:void(0)" data-toggle="modal" data-target="#candidatestatus_' . $row->id .'" data-id="' . $row->id . '">Not Defined</a>';
            }

            

            $candidatestausLink .='<div id="candidatestatus_'.$row->id.'" class="modal fade " role="dialog">
						<div class="modal-dialog modal-lg"> 
							<div class="modal-content"> 
						
								<div class="modal-header"> 
									<h4 class="modal-title">Inactive Reason</h4>
								</div>
								<div class="modal-body"> 
								<form id="deleteuser" class="deleteuser" method="post">
									<input type="hidden" name="delete_user_id" id="delete_user_id" value="'.$row->id.'">';
							                  
							         if(!empty($allMarriedStatus)){
							         	foreach ($allMarriedStatus as $key => $value) {
							         			
							         			$candidatestausLink .='<div class="form-check">
								                      <label class="form-check-label">
								                        <input type="radio" class="form-check-input" name="reason" value="'.$value['id'].'">'.$value['userMarriedStatusName'].'
								                      </label>
								                    </div>';

							         	}
							         }

            

			                     $candidatestausLink .='<button  type="button" id="submitreasoncandidatef" data-uid="'.$row->id.'" class="btn btn-success">Update Status</button>
			                 </form>
								<div>
								    </div>
										<div class="modal-footer">
										  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div></div></div></div>';*/

			$sub_array[] =  $candidatestausLink;
		

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
									<h4 class="modal-title">Inactive Reason</h4>
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
			                     <button  type="button" id="submitpassword" data-utype="female" data-uid="'.$row->id.'" class="btn btn-success submitpassword">Change Password</button>
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
											$actionLink .= '<tr><td>Ethnicity :  </td><td>'.$Ethnicity.'</td></tr>'; 	


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

 

											//@$sEthnicity = $sEthnicity['ethnicityName'] ? : "-";
											$actionLink .= '<tr><td>Spouse Ethnicity   :  </td><td>'.$sEthnicity.'</td></tr>'; 

											@$HijabPreference = $HijabPreference['hijabPreferenceName'] ? : "-";
											$actionLink .= '<tr><td>Hijab Preference     :  </td><td>'.$HijabPreference.'</td></tr>'; 

											@$hijabPreferenceAdditional = $row->hijabPreferenceAdditional ? : "-";
											$actionLink .= '<tr><td>Hijab Preference Additional :  </td><td>'.$hijabPreferenceAdditional.'</td></tr>';
 
											@$considerDivorcee = $row->considerDivorcee ? : "-";
											$actionLink .= '<tr><td>Consider Divorcee   :  </td><td>'.$considerDivorcee.'</td></tr>';

											@$mosqueVisitOther = $row->mosqueVisitOther ? : "-";
											$actionLink .= '<tr><td> Mosque Visit :  </td><td>'.$mosqueVisitOther.'</td></tr>';

											@$myCharacteristics1 = $row->myCharacteristics1 ? : "-";
											$actionLink .= '<tr><td>My Characteristics 1 :  </td><td>'.$myCharacteristics1.'</td></tr>';

											@$myCharacteristics2 = $row->myCharacteristics2 ? : "-";
											$actionLink .= '<tr><td>My Characteristics 2 :  </td><td>'.$myCharacteristics2.'</td></tr>';

											@$myCharacteristics3 = $row->myCharacteristics3 ? : "-";
											$actionLink .= '<tr><td>My Characteristics 3   :  </td><td>'.$myCharacteristics3.'</td></tr>';

											@$preferences = $row->preferences ? : "-";
											$actionLink .= '<tr><td>Preferences :  </td><td>'.$preferences.'</td></tr>';

											@$aboutMe = $row->aboutMe ? : "-";
											$actionLink .= '<tr><td>About Me :  </td><td>'.$aboutMe.'</td></tr>'; 

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
											$actionLink .= '<tr><td>Interests Hobbies Other :  </td><td>'.$interestsHobbiesOther.'</td></tr>'; 
  

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
            "recordsTotal" => $this->model_common->get_all_data($this->global_tblfemaleusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "recordsFiltered" => $this->model_common->get_filtered_data($this->global_tblfemaleusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "data" => $data,
        );
        echo json_encode($output);
        
    }


}
