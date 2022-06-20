<?php 
error_reporting(0);
class Dashboard extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		 $this->not_logged_in_male();
		  
		$this->data['page_title'] = 'Dashboard';
		
		$this->load->model('model_users'); 
		$this->load->model('model_common'); 
		$this->global_tblusers = 'MaleCandidates';
		$this->global_tblfusers = 'FemaleCandidates';
		$this->data['view_path'] = 'users/';
		 
	}

	public function index()
	{ 		 
		$this->render_template('dashboard', $this->data);
	}
 
 
	public function male_edit_profile(){
		$this->not_logged_in_males();
		$id = $this->session->userdata('id');
		if($id) {

			
		 	 
			if(($this->input->post('firstName')!='') && ($this->input->post('lastName')!='') && ($this->input->post('phone')!='')  ){
               
				// true case
		        if(!empty($this->input->post('firstName'))) {

		      //   	$mainimage = '';
		      //       if ($_FILES['primimage']['size']>0) {

		      //           $uploaddir = FCPATH.'/uploads/users/';
		      //           @chmod($uploaddir, 0777);
		      //           $ext = pathinfo($_FILES['primimage']['name'], PATHINFO_EXTENSION);

		      //           $filenm = $id .'_prim.'.$ext;
		      //           $mainimage = str_replace(' ', '-', $filenm);
		      //           $uploadfile = $uploaddir . $mainimage;

		      //           move_uploaded_file($_FILES['primimage']['tmp_name'], $uploadfile);
 					 	// $this->session->set_userdata('profileimg', base_url('uploads/users/'.$mainimage));
		      //       } else{
		      //       	 $mainimage = $this->input->post('hidden_primimage');
		      //       }

		     //        $image2 = '';
		     //        if ($_FILES['image1']['size']>0) {

		     //            $uploaddir = FCPATH.'/uploads/users/';
		     //          	@chmod($uploaddir, 0777);
		     //            $ext = pathinfo($_FILES['image1']['name'], PATHINFO_EXTENSION);

		     //            $filenm = $id .'_next.'.$ext;
		     //            $image2 = str_replace(' ', '-', $filenm);
		     //            $uploadfile = $uploaddir . $image2;

		     //            move_uploaded_file($_FILES['image1']['tmp_name'], $uploadfile);
 						
		     //             $profdata= base_url('uploads/users/'.$mainimage);
 						// $this->session->set_userdata('profileimg', $profdata );
 						
		     //        }  else{
		     //        	$image2 = $this->input->post('hidden_image1');
		     //        }

		            $personalEthnicityID = '';
		            if(!empty($this->input->post('personalEthnicityID'))){
		            	$personalEthnicityID = implode(",", $this->input->post('personalEthnicityID'));
		            }

		            $spouseEthnicityID = '';
		            if(!empty($this->input->post('spouseEthnicityID'))){
		            	$spouseEthnicityID = implode(",", $this->input->post('spouseEthnicityID'));
		            }
		            
		         	 
		        	$updateData = array(   
		        		'firstName' => $this->input->post('firstName'),
		        		'lastName' => $this->input->post('lastName'),
		        		'birthdate' => date('Y-m-d',strtotime($this->input->post('birthdate'))),
		        		'fathersName' => $this->input->post('fathersName'),
		        		'mothersName' => $this->input->post('mothersName'),
		        		'cityOfResidence' => $this->input->post('cityOfResidence'),
		        		'phone' => $this->input->post('phone'),
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
		        		// 'primimage' => $mainimage,  
		        		// 'image' => $image2,  
		        		'consultant_id' => $this->input->post('consultant_id'), 
		        		'consultant_cat_id' => $this->input->post('consultant_cat_id'), 
		        	);

		        	$mainimage = '';
		            if ($_FILES['primimage']['size']>0) {

		                $uploaddir = FCPATH.'/uploads/users/';
		                @chmod($uploaddir, 0777);
		                $ext = pathinfo($_FILES['primimage']['name'], PATHINFO_EXTENSION);
		                $extconvert = strtolower($ext);
		                if(($extconvert == 'png') || ($extconvert == 'jpg')){

			                $filenm = $id .'_prim.'.$ext;
			                $mainimage = str_replace(' ', '-', $filenm);
			                $uploadfile = $uploaddir . $mainimage;

			                move_uploaded_file($_FILES['primimage']['tmp_name'], $uploadfile);
	 					 	$this->session->set_userdata('profileimg', base_url('uploads/users/'.$mainimage));
 					 	}
 					 	else{

 					 		$this->session->set_flashdata('error', 'We accept only .png and .jpg image');
		        				redirect('edit_profile', 'refresh');
 					 	}

		            } else{
		            	 $mainimage = $this->input->post('hidden_primimage');
		            }
		            $updateData['primimage'] = $mainimage;

		              $image2 = '';
		            if ($_FILES['image1']['size']>0) {

		                $uploaddir = FCPATH.'/uploads/users/';
		              	@chmod($uploaddir, 0777);
		                $ext = pathinfo($_FILES['image1']['name'], PATHINFO_EXTENSION);
		                $extCont = strtolower($ext);
		                 if(($extCont == 'png') || ($extCont == 'jpg')){
			                $filenm = $id .'_next.'.$ext;
			                $image2 = str_replace(' ', '-', $filenm);
			                $uploadfile = $uploaddir . $image2;

			                move_uploaded_file($_FILES['image1']['tmp_name'], $uploadfile);
	 						
			                 $profdata= base_url('uploads/users/'.$mainimage);
	 						$this->session->set_userdata('profileimg', $profdata );
	 					}else{
	 						$this->session->set_flashdata('error', 'We accept only .png and .jpg image');
		        			redirect('edit_profile', 'refresh');
 						}
		            }  else{
		            	$image2 = $this->input->post('hidden_image1');
		            }

		            $updateData['image'] = $image2;
                    $whereEqual = array('id'=>$id);
                    $update = $this->model_common->updateTableData($updateData,$this->global_tblusers,$whereEqual); 


                    $LivingArrangements = $this->input->post('LivingArrangements');

		        	if(!empty($LivingArrangements)){
		        		$afmwhere['mcid'] = $this->session->userdata('id');  
		        		$this->model_common->deleteTableData('MC_AfterMarriageLiving',$afmwhere);
		        			$afmvalues =array();
		        		foreach ($LivingArrangements as $key => $value) {
		        			$afmvalues['mcid'] =  $this->session->userdata('id');
		        			if($value > 0){
			        			$afmvalues['livingArrangementsID'] =$value;
			        			$this->model_common->insertTableData($afmvalues,'MC_AfterMarriageLiving'); 		        				
		        			}
		        		}
		        	}

		        	$AfterSpousePrefer = $this->input->post('LivingStyle');

		        	if(!empty($AfterSpousePrefer)){
		        		$afmpwhere['mcid'] = $this->session->userdata('id');  
		        		$this->model_common->deleteTableData('MC_AfterSpousePrefer',$afmpwhere);
		        			$afmpvalues =array();
		        		foreach ($AfterSpousePrefer as $key => $value) {
		        			$afmpvalues['mcid'] =  $this->session->userdata('id');
		        			if($value > 0){
		        				$afmpvalues['afterMarriagePreferenceMaleID'] =$value;
		        				$this->model_common->insertTableData($afmpvalues,'MC_AfterSpousePrefer'); 
		        			}
		        		}
		        	}

		        	
		        	$AgePreference = $this->input->post('AgePreference');
		        	if(!empty($AgePreference)){
		        		$agmwhere['mcid'] = $this->session->userdata('id');  
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
		        		$momwhere['mcid'] = $this->session->userdata('id');  
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
		        		if(!empty($this->input->post('save_button'))){
			        		$this->session->set_flashdata('success', 'Your Profile has been successfully updated.');
			        		redirect('edit_profile', 'refresh');
			        	} else {
			        		$this->session->set_flashdata('success', 'Your Profile has been successfully updated.');
		        			redirect('dashboard', 'refresh');
			        	}
		        	} else {
		        		$this->session->set_flashdata('error', 'Error occurred!!');
		        		redirect('edit_profile', 'refresh');
		        	}
		        } else {
		        	$this->session->set_flashdata('error', 'Error occurred!!');
		        		redirect('edit_profile', 'refresh');
					 
		        }

	        } else {
	            // false case
                $whereEqual = array('id'=>$id);  
                $selectColumn['*'] = '*';
                $gender =  $this->session->userdata('candidategender'); 
                if($gender =='male'){
                	$this->data['Your_gender'] = 'M';
                	$this->data['user_data'] = $this->model_common->getSingleDataByField($this->global_tblusers,$selectColumn,$whereEqual);

                } else {
                	$this->data['Your_gender'] = 'F';
                	$this->data['user_data'] = $this->model_common->getSingleDataByField($this->global_tblfusers,$selectColumn,$whereEqual);
                }    


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

                $conwhereEqual = array('status'=>1,'deleted'=>0,'gender'=>0);          
        		$conselectColumn['*'] = '*';  
        		$conorder['firstName'] = 'ASC'; 
        		$consultantsArray = $this->model_common->getMultipleDataByField('Consultants',$conselectColumn,$conwhereEqual,$conorder);
 		
				$this->data['consultants'] = '';
				$consultantsArrayNew = array();
 				if(!empty($consultantsArray)){

 					foreach ($consultantsArray as $key => $value) {
 						$conwhereEqual = array('status'=>1,'deleted'=>0, 'consultant_id'=>$value['id']);          
						$conselectColumn['*'] = '*';  
						$conorder['firstName'] = 'ASC'; 
						$MaleCandidates = $this->model_common->getMultipleDataByField('MaleCandidates',$conselectColumn,$conwhereEqual,$conorder);

						$totalCandidates = count($MaleCandidates);
						
						if($value['max_candidates']>$totalCandidates){
							$consultantsArrayNew[$key] = $value;
						}

 					}
 				}

 				$this->data['consultants'] = $consultantsArrayNew;

				$this->render_detail_page_template($this->data['view_path'].'male/edit', $this->data);
				//$this->load->view('edit_profile');	
	        }	
		}	
	}

	public function female_edit_profile(){

	 	$this->not_logged_in_female();
		$id = $this->session->userdata('id');
		if($id) {
		 
			if(($this->input->post('firstName')!='') && ($this->input->post('lastName')!='') && ($this->input->post('phone')!='')  ){
               
				// true case
		        if(!empty($this->input->post('firstName'))) {
		        	
		     //    		$mainimage = '';
		     //        if ($_FILES['primimage']['size']>0) {

		     //            $uploaddir = FCPATH.'/uploads/female/';
		     //            @chmod($uploaddir, 0777);
		     //            $ext = pathinfo($_FILES['primimage']['name'], PATHINFO_EXTENSION);

		     //            $filenm = $id .'_prim.'.$ext;
		     //            $mainimage = str_replace(' ', '-', $filenm);
		     //            $uploadfile = $uploaddir . $mainimage;

		     //            move_uploaded_file($_FILES['primimage']['tmp_name'], $uploadfile);

		     //            $profdata= base_url('uploads/female/'.$mainimage);
 						// $this->session->set_userdata('profileimg', $profdata );

		     //        } else{
		     //        	 $mainimage = $this->input->post('hidden_primimage');
		     //        }

		     //        $image2 = '';
		     //        if ($_FILES['image1']['size']>0) {

		     //            $uploaddir = FCPATH.'/uploads/female/';
		     //             @chmod($uploaddir, 0777);
		     //            $ext = pathinfo($_FILES['image1']['name'], PATHINFO_EXTENSION);

		     //            $filenm = $id .'_next.'.$ext;
		     //            $image2 = str_replace(' ', '-', $filenm);
		     //            $uploadfile = $uploaddir . $image2;

		     //            move_uploaded_file($_FILES['image1']['tmp_name'], $uploadfile);
 

		     //        }  else{
		     //        	$image2 = $this->input->post('hidden_image1');
		     //        }
		         	 
	         	 	$personalEthnicityID = '';
		            if(!empty($this->input->post('personalEthnicityID'))){
		            	$personalEthnicityID = implode(",", $this->input->post('personalEthnicityID'));
		            }
		         	 
	         	 	$spouseEthnicityID = '';
		            if(!empty($this->input->post('spouseEthnicityID'))){
		            	$spouseEthnicityID = implode(",", $this->input->post('spouseEthnicityID'));
		            }

		        	$updateData = array(   
		        		'firstName' => $this->input->post('firstName'),
		        		'lastName' => $this->input->post('lastName'),
		        		'birthdate' => date('Y-m-d',strtotime($this->input->post('birthdate'))),
		        		'fathersName' => $this->input->post('fathersName'),
		        		'mothersName' => $this->input->post('mothersName'),
		        		'cityOfResidence' => $this->input->post('cityOfResidence'),
		        		'phone' => $this->input->post('phone'),
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
		        		'mosqueVisitOther' => $this->input->post('mosqueVisitOther'),  
		        		'myCharacteristics1' => $this->input->post('myCharacteristics1'),  
		        		'myCharacteristics2' => $this->input->post('myCharacteristics2'),  
		        		'myCharacteristics3' => $this->input->post('myCharacteristics3'),  
		        		'preferences' => $this->input->post('preferences'),  
		        		'aboutMe' => $this->input->post('aboutMe'),  
		        		'otherDetails' => $this->input->post('otherDetails'),   
		        		'interestsHobbiesOther' => $this->input->post('interestsHobbiesOther'),  
		        		// 'primimage' => $mainimage,  
		        		// 'image' => $image2,  
		        		'consultant_id' => $this->input->post('consultant_id'), 
		        		'consultant_cat_id' => $this->input->post('consultant_cat_id'),
		        	);

		        	$mainimage = '';
		            if ($_FILES['primimage']['size']>0) {

		                $uploaddir = FCPATH.'/uploads/female/';
		                @chmod($uploaddir, 0777);
		                $ext = pathinfo($_FILES['primimage']['name'], PATHINFO_EXTENSION);
		                $extFemale = strtolower($ext);
		                if(($extFemale == 'png') || ($extFemale == 'jpg')){
			                $filenm = $id .'_prim.'.$ext;
			                $mainimage = str_replace(' ', '-', $filenm);
			                $uploadfile = $uploaddir . $mainimage;

			                move_uploaded_file($_FILES['primimage']['tmp_name'], $uploadfile);

			                $profdata= base_url('uploads/female/'.$mainimage);
	 						$this->session->set_userdata('profileimg', $profdata );
	 					}else{
	 						$this->session->set_flashdata('error', 'We accept only .jpg and .png image');
			        		redirect('my_profile', 'refresh');
	 					}
		            } else{
		            	 $mainimage = $this->input->post('hidden_primimage');
		            }
		            $updateData['primimage'] = $mainimage;

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
		        			redirect('my_profile', 'refresh');
 						}
		            }  else{
		            	$image2 = $this->input->post('hidden_image1');
		            }

		            $updateData['image'] = $image2;

  
                    $whereEqual = array('id'=>$id);
                    $update = $this->model_common->updateTableData($updateData,$this->global_tblfusers,$whereEqual); 

                    $LivingArrangements = $this->input->post('LivingArrangements');

		        	if(!empty($LivingArrangements)){
		        		$afmwhere['fcid'] = $this->session->userdata('id');  
		        		$this->model_common->deleteTableData('FC_AfterMarriageLiving',$afmwhere);
		        			$afmvalues =array();
		        		foreach ($LivingArrangements as $key => $value) {
		        			$afmvalues['fcid'] =  $this->session->userdata('id');
		        			if($value > 0){
			        			$afmvalues['livingArrangementsID'] =$value;
			        			$this->model_common->insertTableData($afmvalues,'FC_AfterMarriageLiving'); 		        				
		        			}
		        		}
		        	}

		        	$AfterSpousePrefer = $this->input->post('LivingStyle');

		        	if(!empty($AfterSpousePrefer)){
		        		$afmpwhere['fcid'] = $this->session->userdata('id');  
		        		$this->model_common->deleteTableData('FC_AfterSpousePrefer',$afmpwhere);
		        			$afmpvalues =array();
		        		foreach ($AfterSpousePrefer as $key => $value) {
		        			$afmpvalues['fcid'] =  $this->session->userdata('id');
		        			if($value > 0){
		        				$afmpvalues['afterMarriagePreferenceMaleID'] =$value;
		        				$this->model_common->insertTableData($afmpvalues,'FC_AfterSpousePrefer'); 
		        			}
		        		}
		        	}

		        	
		        	$AgePreference = $this->input->post('AgePreference');
		        	if(!empty($AgePreference)){
		        		$agmwhere['fcid'] = $this->session->userdata('id');  
		        		$this->model_common->deleteTableData('FC_AgeRanges',$agmwhere);
		        			$agmvalues =array();
		        		foreach ($AgePreference as $key => $value) {
		        			$agmvalues['fcid'] = $id;
		        			if($value > 0){
		        				$agmvalues['ageRangeID'] =$value;
		        				$this->model_common->insertTableData($agmvalues,'FC_AgeRanges'); 
		        			}
		        		}
		        	}

		        	$MosqueFrequency = $this->input->post('MosqueFrequency');
		        	if(!empty($MosqueFrequency)){
		        		$momwhere['fcid'] = $this->session->userdata('id');  
		        		$this->model_common->deleteTableData('FC_MosqueVisits',$momwhere);
		        			$agmvalues =array();
		        		foreach ($MosqueFrequency as $key => $value) {
		        			$agmvalues['fcid'] = $id;
		        			if($value > 0){
		        				$agmvalues['mosqueVisitID'] =$value;
		        				$this->model_common->insertTableData($agmvalues,'FC_MosqueVisits'); 
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

		        		if(!empty($this->input->post('save_button'))){
			        		$this->session->set_flashdata('success', 'Your Profile has been successfully updated.');
			        		redirect('my_profile', 'refresh');
			        	} else {
			        		$this->session->set_flashdata('success', 'Your Profile has been successfully updated.');
		        			redirect('dashboard', 'refresh');
			        	}
		        	} else {
		        		$this->session->set_flashdata('error', 'Error occurred!!');
		        		redirect('my_profile', 'refresh');
		        	}
		        } else {
		        	$this->session->set_flashdata('error', 'Error occurred!!');
		        		redirect('my_profile', 'refresh');
					 
		        }

	        } else {
	            // false case
                $whereEqual = array('id'=>$id);  
                $selectColumn['*'] = '*';
                $gender =  $this->session->userdata('candidategender');  
            	$this->data['Your_gender'] = 'F';
            	$this->data['user_data'] = $this->model_common->getSingleDataByField($this->global_tblfusers,$selectColumn,$whereEqual); 
            	 

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

                $conwhereEqual = array('status'=>1,'deleted'=>0,'gender'=>1);          
                $conselectColumn['*'] = '*';  
                $conorder['firstName'] = 'ASC'; 
 				
 				$consultantsArray = $this->model_common->getMultipleDataByField('Consultants',$conselectColumn,$conwhereEqual,$conorder);
 		
				$this->data['consultants'] = '';
				$consultantsArrayNew = array();
 				if(!empty($consultantsArray)){

 					foreach ($consultantsArray as $key => $value) {

						$conwhereEqual = array('status'=>1,'deleted'=>0, 'consultant_id'=>$value['id']);          
						$conselectColumn['*'] = '*';  
						$conorder['firstName'] = 'ASC'; 
						$FemaleCandidates = $this->model_common->getMultipleDataByField('FemaleCandidates',$conselectColumn,$conwhereEqual,$conorder);

						$totalCandidates = count($FemaleCandidates);
						
						if($value['max_candidates']>$totalCandidates){
							$consultantsArrayNew[$key] = $value;
						}

 					}
 				}

 				$this->data['consultants'] = $consultantsArrayNew;

				$this->render_detail_page_template($this->data['view_path'].'female/edit', $this->data);
				 
	        }	
		}	
	}


	public function candidates(){


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
                 $femalecan = $this->session->userdata('candidategender');
                 if($femalecan == 'female'){
					$this->render_detail_page_template($this->data['view_path'].'female/index', $this->data);
				 }else {
				 	$this->render_detail_page_template($this->data['view_path'].'male/index', $this->data);
				 }
	}

	 
   public function fetch_users(){
 
        // equal condition
        $whereEqual = array();
        $orwhere = array();
         
	     $femalecan = $this->session->userdata('candidategender');

	     if($femalecan == 'female'){
			$this->global_tblusers = 'MaleCandidates';
			$this->global_type = 'MC';
			$this->global_gender = 'M';
			$this->global_id = 'mcid';
		 } else{ 
	     	$this->global_tblusers = 'FemaleCandidates';
	     	$this->global_type = 'FC';
			$this->global_gender = 'F';
			$this->global_id = 'fcid';
		 }

	      $countryOfResidence = $this->input->post('countryOfResidence');
	      $personalEthnicityID = $this->input->post('personalEthnicityID');
	       
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

	  //     $conid = $this->session->userdata('id');
 			
 		// if(isset($conid) && $conid > 0 ){
 		// 	 $whereEqual[$this->global_tblusers.'.consultant_id'] =  $conid ;
 		// }

	      $whereEqual[$this->global_tblusers.'.deleted'] = 0;

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
			/*

 		if(isset($countryOfResidence) && $countryOfResidence > 0 ){
 			 $whereEqual[$this->global_tblusers.'.countryOfResidence'] = $countryOfResidence;
 		}

 		if(isset($personalEthnicityID) && $personalEthnicityID > 0 ){
 			$whereEqual[$this->global_tblusers.'.personalEthnicityID'] = $personalEthnicityID;
 		} */

		if(isset($citizenshipStatusID) && $citizenshipStatusID > 0 ){
 			$whereEqual[$this->global_tblusers.'.citizenshipStatusID'] = $citizenshipStatusID;
 		} 

		if(isset($durationOfStayID) && $durationOfStayID > 0 ){
 			$whereEqual[$this->global_tblusers.'.durationOfStayID'] = $durationOfStayID;
 		} 

		if(isset($highestEducationLevelID) && $highestEducationLevelID > 0 ){
 			$whereEqual[$this->global_tblusers.'.highestEducationLevelID'] = $highestEducationLevelID;
 		} 
 
 		if(isset($ageRange) && $ageRange > 0 ){
 			
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
 
 		if(isset($willingToRelocate) && $willingToRelocate !='' ){
 			$whereEqual[$this->global_tblusers.'.willingToRelocate'] = $willingToRelocate;
 		} 

		if(isset($maritalStatusID) && $maritalStatusID !='' ){
 			$whereEqual[$this->global_tblusers.'.maritalStatusID'] = $maritalStatusID;
 		} 

        // not equal condition
        $whereNotEqual = array();

        $notIn = array();     

        // select data
        $selectColumn[$this->global_tblusers.'.*'] = $this->global_tblusers.'.*';
         
        // order column
        $orderColumn = array($this->global_tblusers.".cityOfResidence", $this->global_tblusers.".firstName", $this->global_tblusers.".email", $this->global_tblusers.".registrationDate", $this->global_tblusers.".status");

        // search column
        $searchColumn = array($this->global_tblusers.".cityOfResidence", $this->global_tblusers.".firstName", $this->global_tblusers.".email", $this->global_tblusers.".lastName");

        // order by
        $orderBy = array($this->global_tblusers.'.status' => "DESC");

        // join table
        $joinTableArray = array();
        /*if($femalecan == 'female'){ 
        	 $joinTableArray = array( array("joinTable"=>'MC_AgeRanges', "joinField"=>"mcid", "relatedJoinTable"=>$this->global_tblusers, "relatedJoinField"=>"id","type"=>"left"));
			
		 } else{  
		 	$joinTableArray = array( array("joinTable"=>'FC_AgeRanges', "joinField"=>"fcid", "relatedJoinTable"=>$this->global_tblfusers, "relatedJoinField"=>"id","type"=>"left"));  
	     	 
		 } */
       	
		 
        $fetch_data = $this->model_common->make_datatables($this->global_tblusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn, $orwhere);
    	 
     
        $data = array();
        $countryliving = '';
        foreach ($fetch_data as $row) {
            $sub_array = array(); 

                $cwhereEqual['id'] = $row->countryOfResidence ;          
                $cselectColumn['countryName'] = 'countryName';   
                $countryliving = $this->model_common->getSingleDataByField('Country',$cselectColumn,$cwhereEqual ); 


               	$etwhereEqual['id'] = $row->personalEthnicityID;        
                $etselectColumn['*'] = '*'; 
                $etorder['ethnicityName'] = 'ASC'; 
                $Ethnicity = $this->model_common->getSingleDataByField('Ethnicity',$etselectColumn,$etwhereEqual,$etorder);
 
            if($femalecan == 'female'){

	            if($row->primimage && file_exists( 'uploads/users/'.$row->primimage) ){
	                $sub_array[] =  '<img height="50" src="'.base_url('uploads/users/'.$row->primimage).'">';
	            } else {
	                $sub_array[] =  '<img height="50" src="'.base_url('assets/images/male.jpeg').'">';
	            }

	        } else{
        		if($row->primimage && file_exists( 'uploads/female/'.$row->primimage) ){
                $sub_array[] =  '<img height="50" src="'.base_url('uploads/female/'.$row->primimage).'">';
	            } else {
	                $sub_array[] =  '<img height="50" src="'.base_url('assets/images/female.jpeg').'">';
	            }
	        }

	        	$diff = '';

            	$dob=date('Y-m-d',strtotime($row->birthdate));
			    $diff = (date('Y') - date('Y',strtotime($dob)));
			    
	    		 
	        	$sub_array[] = isset($countryliving['countryName']) ? $countryliving['countryName'] : '';
            	$sub_array[] = isset($row->cityOfResidence) ? $row->cityOfResidence : '';
            	$sub_array[] = $diff;
            	$sub_array[] = isset($Ethnicity['ethnicityName']) ? $Ethnicity['ethnicityName'] : '';
        	
                 $cwhereEqual['id'] = $row->citizenshipStatusID;        
                $celectColumn['statusName'] = 'statusName'; 
                $CitizenshipStatus = $this->model_common->getSingleDataByField('CitizenshipStatus',$celectColumn,$cwhereEqual);

                 $dwhereEqual['id'] = $row->durationOfStayID;         
                $dselectColumn['desc'] = 'desc'; 
                $DurationOfStay = $this->model_common->getSingleDataByField('DurationOfStay',$dselectColumn,$dwhereEqual);

             
                 $EdwhereEqual['id'] = $row->highestEducationLevelID;         
                $EdselectColumn['educationLevelName'] = 'educationLevelName';  
                $Edorder['educationLevelName'] = 'ASC'; 
                $EducationLevels = $this->model_common->getSingleDataByField('EducationLevels',$EdselectColumn,$EdwhereEqual,$Edorder);

                 $MawhereEqual['id'] = $row->maritalStatusID;          
                $MaselectColumn['maritalStatusName'] = 'maritalStatusName';  
                $Maorder['maritalStatusName'] = 'ASC'; 
                $MaritalStatus= $this->model_common->getSingleDataByField('MaritalStatus',$MaselectColumn,$MawhereEqual,$Maorder);

                 $setwhereEqual['id'] = $row->spouseEthnicityID;        
                $setselectColumn['ethnicityName'] = 'ethnicityName';  
                $sEthnicity = $this->model_common->getSingleDataByField('Ethnicity',$setselectColumn,$setwhereEqual );
                

                $hiwhereEqual['gender'] = $this->global_gender;        
                $hiwhereEqual['id'] = $row->hijabPreferenceID;        
                $hiselectColumn['hijabPreferenceName'] = 'hijabPreferenceName';   
                $HijabPreference = $this->model_common->getSingleDataByField('HijabPreference',$hiselectColumn,$hiwhereEqual );

				$alorder = array();
	        	$lselectColumn['LivingArrangements.desc'] = ' LivingArrangements.desc  as description';
	        	$afwhereEqual[$this->global_type.'_AfterMarriageLiving.'.$this->global_id] = $row->id;
	        	$afwhereEqual['LivingArrangements.isActive'] = 1;
	        	$afjoinTableArray = array(array("joinTable"=>'LivingArrangements', "joinField"=>"id", "relatedJoinTable"=>$this->global_type.'_AfterMarriageLiving', "relatedJoinField"=>"livingArrangementsID","type"=>"left"));
			 	$LivingArrangements = $this->model_common->get_table_records($this->global_type.'_AfterMarriageLiving',$lselectColumn,$afwhereEqual,$afjoinTableArray,$alorder);   


			 	$alsorder = array();
	        	$afsselectColumn['AfterMarriagePreferenceMale.desc'] = ' AfterMarriagePreferenceMale.desc  as description';
	        	$afswhereEqual[$this->global_type.'_AfterSpousePrefer.'.$this->global_id] = $row->id;
	        	$afswhereEqual['AfterMarriagePreferenceMale.isActive'] = 1;
	        	$afsjoinTableArray = array(array("joinTable"=>'AfterMarriagePreferenceMale', "joinField"=>"id", "relatedJoinTable"=>$this->global_type.'_AfterSpousePrefer', "relatedJoinField"=>"afterMarriagePreferenceMaleID","type"=>"left"));
			 	$AfterSpousePrefer = $this->model_common->get_table_records($this->global_type.'_AfterSpousePrefer',$afsselectColumn,$afswhereEqual,$afsjoinTableArray,$alsorder); 

			 	$agsorder = array();
	        	$agsselectColumn['AgeRange.desc'] = ' AgeRange.desc  as description';
	        	$agswhereEqual[$this->global_type.'_AgeRanges.'.$this->global_id] = $row->id;
	        	$agswhereEqual['AgeRange.isActive'] = 1;
	        	$agsjoinTableArray = array(array("joinTable"=>'AgeRange', "joinField"=>"id", "relatedJoinTable"=>$this->global_type.'_AgeRanges', "relatedJoinField"=>"ageRangeID","type"=>"left"));
			 	$AgeRanges = $this->model_common->get_table_records($this->global_type.'_AgeRanges',$agsselectColumn,$agswhereEqual,$agsjoinTableArray,$agsorder);   
        			
			  	$mvsorder = array();
	        	$mvsselectColumn['MosqueVisits.desc'] = ' MosqueVisits.desc  as description';
	        	$mvswhereEqual[$this->global_type.'_MosqueVisits.'.$this->global_id] = $row->id;
	        	$mvswhereEqual['MosqueVisits.isActive'] = 1;
	        	$mvsjoinTableArray = array(array("joinTable"=>'MosqueVisits', "joinField"=>"id", "relatedJoinTable"=>$this->global_type.'_MosqueVisits', "relatedJoinField"=>"mosqueVisitID","type"=>"left"));
			 	$MosqueVisits = $this->model_common->get_table_records($this->global_type.'_MosqueVisits',$mvsselectColumn,$mvswhereEqual,$mvsjoinTableArray,$mvsorder);


			 	$ihorder = array();
	        	$ihselectColumn['InterestsHobbies.desc'] = ' InterestsHobbies.interestsHobbiesName  as description';
	        	$ihwhereEqual[$this->global_type.'_InterestHobbies.'.$this->global_id] = $row->id;
	        	$ihwhereEqual['InterestsHobbies.isActive'] = 1;
	        	$ihjoinTableArray = array(array("joinTable"=>'InterestsHobbies', "joinField"=>"id", "relatedJoinTable"=>$this->global_type.'_InterestHobbies', "relatedJoinField"=>"hobbiesID","type"=>"left"));
			 	$InterestHobbies = $this->model_common->get_table_records($this->global_type.'_InterestHobbies',$ihselectColumn,$ihwhereEqual,$ihjoinTableArray,$ihorder);
			
			$userdelete = ''; 
           	if($row->deleted == 1){
           		$userdelete = 2;
           	} else {
           		$userdelete = 1;
           	}
            $actionLink =   '<a   data-toggle="modal" title="View Profile Details"  data-target="#view_users_detail_'.$row->id.'" style="margin-right:5px;"  ><img src="'.base_url('assets/images/view.png').'"></i></a>';  

            $wheres['gender'] = isset($femalecan) ? '1' : '0';
        $wheres['candidate_id'] = $row->id;
        $wheres['user_id'] = $this->session->userdata('id');
        $select['*'] = '*';
        $single = $this->model_common->getSingleDataByField('Bookmark',$select,$wheres);

        	$bookmark ='';
        	if($single && $single['status'] == 1){
        		$bookmark = 'filter: invert(48%) sepia(79%) saturate(2476%) hue-rotate(86deg) brightness(118%) contrast(119%);';
        	}
            				
             $actionLink .='<a title="Bookmark Profile" class="user_bookmark"  data-id="'.$row->id.'" data-types="'.$femalecan.'" style="margin-right:5px;"><img style="'.$bookmark.'" data-id="'.$row->id.'" src="'.base_url('assets/images/fav_icon.svg').'"></a>';
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
											 
											 $cityOfResidence = $row->cityOfResidence ? : "-";
											$actionLink .= '<tr><td>City of Residences :  </td><td>'.$cityOfResidence.'</td></tr>';  

											 @$countryOfResidence = $countryliving['countryName']   ?  $countryliving['countryName'] : "-";
											$actionLink .= '<tr><td>Country :  </td><td>'.$countryOfResidence.'</td></tr>'; 

											 $heightCM = $row->heightCM ? : "-";
											$actionLink .= '<tr><td>Height Inches :  </td><td>'.$heightCM.'</td></tr>'; 

											 @$citizenshipStatusID = $CitizenshipStatus['statusName'] ? : "-";
											$actionLink .= '<tr><td>Citizenship Status :  </td><td>'.$citizenshipStatusID.'</td></tr>'; 

											 @$durationOfStayID = $DurationOfStay['desc'] ? : "-";
											$actionLink .= '<tr><td>Duration of Stay  :  </td><td>'.$durationOfStayID.'</td></tr>'; 

											 @$Ethnicity = $Ethnicity['ethnicityName'] ? : "-";
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
											$actionLink .= '<tr><td>Marital Status :  </td><td>'.$MaritalStatus.'</td></tr>'; 	

											

											@$willingToRelocate = $row->willingToRelocate ? : "-";
											$actionLink .= '<tr><td>Willing to Relocate :  </td><td>'.$willingToRelocate.'</td></tr>'; 


											@$afterMarriageLivingOther = $row->afterMarriageLivingOther ? : "-";
											$actionLink .= '<tr><td>After Marriage Living Other :  </td><td>'.$afterMarriageLivingOther.'</td></tr>';

 

											@$sEthnicity = $sEthnicity['ethnicityName'] ? : "-";
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
											$actionLink .= '<tr><td>otherDetails   :  </td><td>'.$otherDetails.'</td></tr>';


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
            "recordsTotal" => $this->model_common->get_all_data($this->global_tblusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "recordsFiltered" => $this->model_common->get_filtered_data($this->global_tblusers,$selectColumn,$whereEqual,$whereNotEqual,$orderColumn,$orderBy,$searchColumn,$joinTableArray,$notIn),
            "data" => $data,
        );
        echo json_encode($output);
        
    }

    public function user_bookmark(){

        $data['candidate_id'] = $this->input->post('id');
        $data['user_id'] = $this->session->userdata('id');
        $userstype = $this->input->post('userstype');

        if($userstype =='male'){
        	 $data['gender'] = 0;
        } else {
        	 $data['gender'] = 1;
        }

        $wheres['gender'] = $data['gender'];
        $wheres['candidate_id'] = $this->input->post('id');
        $wheres['user_id'] = $this->session->userdata('id');
        $select['*'] = '*';
        $single = $this->model_common->getSingleDataByField('Bookmark',$select,$wheres);
        
        if(isset($single) && $single['status'] == 1){

            $data['status'] =  0;
            $info = $this->model_common->updateTableData($data,'Bookmark',$wheres);
            $val = 0;
        } elseif(isset($single) && $single['status'] == 0){ 
            $data['status'] = 1;
            $info = $this->model_common->updateTableData($data,'Bookmark',$wheres);
            $val = 1;
        } else{
             $data['status'] = 1;
            $info = $this->model_common->insertTableData( $data,'Bookmark');
            $val = 1;
        }

        echo json_encode($val);
    }

}
 