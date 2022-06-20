<!-- Content Wrapper. Contains page content -->
<main class="male-condidates">

     <?php include("arrays.php");
    $Your_gender = 'F';
    $relatedtablename=array();
    $relatedtablename[1]=$Your_gender."C_AgeRanges";
    $relatedtablename[2]=$Your_gender."C_MosqueVisits";
    $relatedtablename[3]=$Your_gender."C_AfterMarriageLiving";
    $relatedtablename[4]=$Your_gender."C_AfterSpousePrefer";
    $relatedtablename[5]=$Your_gender."C_Characteristics";
    $relatedtablename[6]=$Your_gender."C_InterestHobbies";
    $whereq="where id=".$user_data['id'];
    $Relatedwhereq="where ".strtolower($Your_gender)."cid=".$user_data['id'];
    $formactionqs="?id=".$user_data['id'];
    $i=1;
    $sql="select * from ".$relatedtablename[$i]." ".$Relatedwhereq;
    $checkrelatedtableQ=$this->db->query($sql);
    $checkrelatedtable1=$checkrelatedtableQ->row_array();
    
    $i++;
    $sql="select * from ".$relatedtablename[$i]." ".$Relatedwhereq;
    $checkrelatedtableQ=$this->db->query($sql);
    $checkrelatedtable2=$checkrelatedtableQ->row_array();
    
    $i++;
    $sql="select * from ".$relatedtablename[$i]." ".$Relatedwhereq;
    $checkrelatedtableQ=$this->db->query($sql);
    $checkrelatedtable3=$checkrelatedtableQ->row_array();
    
    $i++;
    $sql="select * from ".$relatedtablename[$i]." ".$Relatedwhereq;
    $checkrelatedtableQ=$this->db->query($sql);
    $checkrelatedtable4=$checkrelatedtableQ->row_array();
    
    $i++;
    $sql="select * from ".$relatedtablename[$i]." ".$Relatedwhereq;
    $checkrelatedtableQ=$this->db->query($sql);
    $checkrelatedtable5=$checkrelatedtableQ->row_array();
    
    $i++;
    $sql="select * from ".$relatedtablename[$i]." ".$Relatedwhereq;
    $checkrelatedtableQ=$this->db->query($sql);
    $checkrelatedtable6=$checkrelatedtableQ->row_array();
    ?>
    <style type="text/css">
        #output1, #output2 {border: 1px solid #eee;margin-bottom: 15px;}
    </style>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <?php if($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                    <?php elseif($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                    <?php endif; ?>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Female Candidate</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="<?php echo base_url('users/female_edit/'.$user_data['id']) ?>" method="post"  id="admin_user_female_edit_form" enctype="multipart/form-data">
                            
                            <div class="card-body">
                                <input type="hidden" id="id" name="id" value="<?php echo $user_data['id'] ?>">

                                <input type="hidden" id="superadminuserid" name="superadminuserid" value="<?php echo $_SESSION['id'] ?>">

                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label>Consultant Type :</label><br>
                                             <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="radio" name="consultant_cat_id" id="consultant_cat_id1" checked value="0" <?php echo ($user_data['consultant_cat_id']==0) ? 'checked':''; ?> onchange="selectedValues(0)">
                                          <label class="form-check-label" for="type1">Guiding</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="radio" name="consultant_cat_id" id="consultant_cat_id2" value="1" <?php echo ($user_data['consultant_cat_id']==1) ? 'checked':''; ?> onchange="selectedValues(1)">
                                          <label class="form-check-label" for="type2">Transactional</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="radio" name="consultant_cat_id" id="consultant_cat_id3" value="2" <?php echo ($user_data['consultant_cat_id']==2) ? 'checked':''; ?> onchange="selectedValues(2)">
                                          <label class="form-check-label" for="type2">Both</label>
                                        </div>
                                    </div>
                                

                                    <script type="text/javascript">
                                        $( document ).ready(function() {
                                            selectedValues(<?php echo $user_data['consultant_cat_id']; ?>);
                                        });

                                        function selectedValues(type){
                                            if(type==0){
                                                $("#consultants").css("display", "none");
                                                $("#g_consultants").css("display", "");
                                                $("#t_consultants").css("display", "none");
                                            } else if(type==1){
                                                $("#consultants").css("display", "none");
                                                $("#g_consultants").css("display", "none");
                                                $("#t_consultants").css("display", "");
                                            } else if(type==2){
                                                $("#consultants").css("display", "");
                                                $("#g_consultants").css("display", "none");
                                                $("#t_consultants").css("display", "none");
                                            }
                                        }
                                    </script>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="Consultants">Consultants :</label>
                                            <select name="consultants" tabindex="3" id="consultants" class="form-control span12">
                                                <option value="0">Select Consultant</option>
                                                <?php
                                                foreach ($consultants as $row)
                                                {
                                                $slct="";
                                                if($row["id"]==$user_data['consultant_id'])
                                                {
                                                $slct="selected";
                                                }
                                                echo "<option value='".$row["id"]."' ".$slct." >".$row["firstName"].' '.$row["lastName"]."</option>";
                                                }
                                                ?>
                                            </select>

                                            <select name="g_consultants" tabindex="3" id="g_consultants"  class="form-control span12">
                                                <option value="0">Select Guiding Consultant</option>
                                                <?php
                                                foreach ($guiding_consultants as $row)
                                                {
                                                $slct="";
                                                if($row["id"]==$user_data['consultant_id'])
                                                {
                                                $slct="selected";
                                                }
                                                echo "<option value='".$row["id"]."' ".$slct." >".$row["firstName"].' '.$row["lastName"]."</option>";
                                                }
                                                ?>
                                            </select>

                                            <select name="t_consultants" tabindex="3" id="t_consultants"  class="form-control span12">
                                                <option value="0">Select Transactional Consultant</option>
                                                <?php
                                                foreach ($transactional_consultants as $row)
                                                {
                                                $slct="";
                                                if($row["id"]==$user_data['consultant_id'])
                                                {
                                                $slct="selected";
                                                }
                                                echo "<option value='".$row["id"]."' ".$slct." >".$row["firstName"].' '.$row["lastName"]."</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Consultants">Select Status :<span class="asterisk-sign">*</span></label>
                                            <select name="status" tabindex="3" id="status" class="form-control span12" onchange="candidateStatusFunction(this.value)">
                                                <option value="1" <?php if($user_data['status']==1){ echo "selected"; } ?>>Active</option>
                                                <option value="0" <?php if($user_data['status']==0){ echo "selected"; } ?>>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Consultants">Candidate Status :<span class="asterisk-sign">*</span></label>
                                            <select name="marriedStatus_active" tabindex="3" id="marriedStatus_active" class="form-control span12">
                                                <option value="">Select Candidate Status</option>
                                                <option value="0" selected>Active</option>
                                            </select>

                                            <select name="marriedStatus_inactive" tabindex="3" id="marriedStatus_inactive" class="form-control span12">
                                                <option value="">Select Candidate Status</option>
                                                <?php
                                                foreach ($MarriedStatus as $row){
                                                    $slct="";
                                                    if($row["id"]==$user_data['marriedStatus']) {
                                                        $slct="selected";
                                                    }
                                                    echo "<option value='".$row["id"]."' ".$slct." >".$row["userMarriedStatusName"]."</option>";
                                                } ?>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <script type="text/javascript">
                                    
                                    $( document ).ready(function() {
                                        candidateStatusFunction(<?php echo $user_data['status']; ?>);
                                    });  
                                    function candidateStatusFunction(type){
                                        if(type==1){
                                            $("#marriedStatus_active").css("display", "");
                                            $("#marriedStatus_inactive").css("display", "none");
                                        } else {
                                            $("#marriedStatus_active").css("display", "none");
                                            $("#marriedStatus_inactive").css("display", "");
                                        }
                                    }
                                </script>
                                
                                <div class="row pt-2">

                                      <div class="col-md-6">

                                        <?php if($user_data['image'] != ''){ ?>
                                            <img id="output1" class="myImg" onclick="myFunction1(1);" height="100" src="<?php echo base_url('uploads/female/'.$user_data['primimage']); ?>" /> 
                                        <?php }else{ ?>
                                            <img id="output1" height="100" src="<?php echo base_url('assets/images/female.jpeg'); ?>" />
                                        <?php }  ?> 
                                           
                                        <label class="btn btn-dark">
                                         Primary image<input type="file" name="primimage" class="uploadFile img" value="Upload Primary" onchange="loadFile(event)" style="width: 0px;height: 0px;overflow: hidden;">
                                        </label>
                                       
                                            </div>
 
                                        <input type="hidden" id="hidden_primimage" name="hidden_primimage" value="<?php if(isset($user_data['primimage'])){ echo $user_data['primimage']; } ?>">

                                         <div class="col-md-6">

                                            <?php if($user_data['image'] != ''){ ?>
                                                <img id="output2" class="myImg" onclick="myFunction1(2);" height="100" src="<?php echo base_url('uploads/female/'.$user_data['image']); ?>" /> 
                                            <?php }else{ ?>
                                                <img id="output2" height="100" src="<?php echo base_url('assets/images/female.jpeg'); ?>" />
                                            <?php }  ?>

                                            
                                            <label class="btn btn-dark">
                                               image<input type="file" name="image1" class="uploadFile img" value="Upload Image" onchange="loadFile1(event)" style="width: 0px;height: 0px;overflow: hidden;">
                                            </label>
                                        </div>

                                        
 
                                    <input type="hidden" id="hidden_image1" name="hidden_image1" value="<?php if(isset($user_data['image'])){ echo $user_data['image']; } ?>">

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname">First Name :<span class="asterisk-sign">*</span></label>
                                            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" autocomplete="off" REQUIRED value="<?php echo $user_data['firstName'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="lastname">Last Name :<span class="asterisk-sign">*</span></label>
                                            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" autocomplete="off" REQUIRED value="<?php echo $user_data['lastName'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Phone :<span class="asterisk-sign">*</span></label>
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="phone" autocomplete="off" REQUIRED value="<?php echo $user_data['phone'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email :<span class="asterisk-sign">*</span></label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" autocomplete="off" REQUIRED value="<?php echo $user_data['email'] ?>">
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <h4 class="pt-2">Personal Information</h4>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="mb-3 d-flex flex-wrap">
                                                <label for="birthdate">Birth Date :<span class="asterisk-sign">*</span></label>
                                                <input type='text'  name="birthdate" id="birthdate" value="<?php echo isset($user_data['birthdate']) ? date('d-m-Y',strtotime($user_data['birthdate'])) :  ''; ?>" placeholder="Birth Date" class="form-control" />  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="mb-4 d-flex flex-wrap">
                                                <label for="heightCM">Height :<span class="asterisk-sign">*</span></label>
                                                <div class="select-wrapper w-100">
                                                    <select name="heightCM" id="heightCM" class="select-lg w-100">
                                                        <option value="">Height  </option>
                                                        <?php
                                                        foreach($Height_array as $key=>$value)
                                                        {
                                                        $slct="";
                                                        if(isset($user_data['heightCM']) && $user_data['heightCM']==$key)
                                                        {
                                                        $slct="Selected";
                                                        }
                                                        $heightincms=$key;
                                                        if($heightincms==0)
                                                        {
                                                        $heightincms="&lt;137";
                                                        }
                                                        else if($heightincms==500)
                                                        {
                                                        $heightincms="&gt;211";
                                                        }
                                                        echo "<option value=".$key." ".$slct.">".$value." - (".$heightincms."cm)</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="mb-3 d-flex flex-wrap">
                                                <label for="fathersName">Father's Name :<span class="asterisk-sign">*</span></label>
                                                <input type='text' name="fathersName" id="fathersName" value="<?php echo $user_data['fathersName']; ?>" placeholder="Father's Name" class="form-control" /> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="mb-3 d-flex flex-wrap">
                                                <label for="mothersName">Mother's Name :<span class="asterisk-sign">*</span></label>
                                                <input type='text' name="mothersName" id="mothersName" value="<?php echo $user_data['mothersName']; ?>" placeholder="Mother's Name" class="form-control" /> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="mb-3 d-flex flex-wrap">
                                                <label for="cityOfResidence">City of Residence :<span class="asterisk-sign">*</span></label>
                                                <input type="text" name="cityOfResidence" id="cityOfResidence" value="<?php echo $user_data['cityOfResidence']; ?>" placeholder="City of Residence" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="mb-3 d-flex flex-wrap">
                                                <label for="countryOfResidence">Country of Residence :<span class="asterisk-sign">*</span></label>
                                                <div class="select-wrapper w-100">
                                                    <select name="countryOfResidence" id="countryOfResidence" class="select-lg w-100">
                                                        <option value="">Country of Residence</option>
                                                        <?php
                                                        $GetRecQ=$this->db->query("select * from Country where isActive=1 order by countryName");
                                                        foreach ($country as $GetRec)
                                                        {
                                                        $slct="";
                                                        if($GetRec["id"]==(int)$user_data['countryOfResidence'])
                                                        {
                                                        $slct="selected";
                                                        }
                                                        
                                                        echo "<option value='".$GetRec["id"]."' ".$slct.">".$GetRec["countryName"]."</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>    
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-5">
                                            <label class="fieldlabel">What is your status  in the current country you are residing in?</label>
                                            <div class="radio-group mt-4">
                                                <?php
                                                
                                                foreach ($CitizenshipStatus as $GetRec)
                                                {
                                                $slct="";
                                                if((int)$user_data['citizenshipStatusID']==$GetRec["id"])
                                                {
                                                $slct="checked";
                                                }
                                                ?>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" id="citizenshipStatusID" name="citizenshipStatusID" value="<?php echo $GetRec["id"];?>" <?php echo $slct;?>>
                                                        <?php echo $GetRec["statusName"];?>
                                                    </label>
                                                </div>
                                                <?php
                                                }
                                                ?>
                                                
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="fieldlabel">How long have you lived in North America/Europe/Australia?</label>
                                            <div class="radio-group mt-4">
                                                <?php
                                                
                                                foreach ($DurationOfStay as $GetRec)
                                                {
                                                $slct="";
                                                if((int)$user_data['durationOfStayID']==$GetRec["id"])
                                                {
                                                $slct="checked";
                                                }
                                                ?>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="durationOfStayID" value="<?php echo $GetRec["id"];?>" <?php echo $slct;?>>
                                                        <?php echo $GetRec["desc"];?>
                                                    </label>
                                                </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="fieldlabel">Ethnicity - Which Ethnicity would you like your spouse to be?</label>
                                            <div class="radio-group mt-4">
                                                <?php
                                                
                                                foreach ($Ethnicity as $GetRec)
                                                {
                                                    $slct="";
                                                    if(!empty($user_data['personalEthnicityID'])){
                                                        $personalEthnicityIDVar = explode(",", $user_data['personalEthnicityID']);

                                                        if(in_array($GetRec["id"], $personalEthnicityIDVar)){
                                                            $slct="checked";
                                                        }
                                                    } ?>

                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="checkbox" name="personalEthnicityID[]" value="<?php echo $GetRec["id"];?>" <?php echo $slct;?> id="personalEthnicityIDCheckBox<?php echo $GetRec["id"];?>" onchange="checkFunction();">
                                                            <?php echo $GetRec["ethnicityName"];?>
                                                        </label>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <script type="text/javascript">   
                                                function checkFunction(){
                                                    if($('#personalEthnicityIDCheckBox10').is(":checked")){
                                                        $("#personalEthnicityOther").removeAttr("disabled");
                                                    } else {
                                                        $("#personalEthnicityOther").val(""); 
                                                        $("#personalEthnicityOther").attr("disabled", "disabled"); 
                                                    }
                                                }
                                            </script>

                                            <?php 
                                            $disabled = '';
                                            if(!empty($user_data['personalEthnicityID'])){
                                                $personalEthnicityIDVar1 = explode(",", $user_data['personalEthnicityID']);

                                                if(!in_array(10, $personalEthnicityIDVar1)){
                                                    $disabled = 'disabled';
                                                }
                                            } ?>
                                            
                                            <input type="text" name="personalEthnicityOther" id="personalEthnicityOther" placeholder="Please specify" value="<?php echo $user_data['personalEthnicityOther']; ?>" class="form-control" <?php echo $disabled; ?>> 
                                        </div>
                                        <?php
                                        
                                        if($Your_gender=="F")
                                        {
                                        ?>
                                        <div class="mb-3">
                                            <label class="fieldlabel">Hijab Preference</label> <label for="cityOfResidence"><span class="asterisk-sign">*</span></label>
                                            <div class="radio-group mt-4">
                                                <?php
                                                
                                                foreach ($HijabPreference as $GetRec)
                                                {
                                                $slct="";
                                                if((int)$user_data['hijabPreferenceID']==$GetRec["id"])
                                                {
                                                $slct="checked";
                                                }
                                                ?>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input one_required" type="radio" name="hijabPreferenceID" value="<?php echo $GetRec["id"];?>" <?php echo $slct;?>>
                                                        <?php echo $GetRec["hijabPreferenceName"];?>
                                                    </label>
                                                </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        <div class="mb-3">
                                            <label class="fieldlabel">Any additional hijab details you would like to include</label> 
                                            <textarea name="hijabPreferenceAdditional" id="hijabPreferenceAdditional" placeholder="" class="form-control"><?php echo $user_data['hijabPreferenceAdditional']; ?></textarea>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="mb-3">
                                            <label class="fieldlabel">Where were you born ?</label>
                                            <input type="text" name="cityOfBirth" id="cityOfBirth" value="<?php echo $user_data['cityOfBirth']; ?>" placeholder="Where were you born, city, country?" class="form-control">
                                        </div>
                                        <!---->
                                    </div>
                                </div>
                                <hr class="mt-4">
                                <h4 class="pt-2"> Professional & Educational Details</h4>
                                <div class="row  ">
                                    <div class="col-12 ">
                                        <div class="mb-3 d-flex flex-wrap">
                                            <label for="areaOfStudy">Area of study :<span class="asterisk-sign">*</span></label>
                                            <textarea name="areaOfStudy" id="areaOfStudy" placeholder="Area of study" class="form-control span12"><?php echo $user_data['areaOfStudy']; ?></textarea> 
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="fieldlabel">Highest level of education obtained</label><label for="cityOfResidence"><span class="asterisk-sign">*</span></label>
                                            <div class="radio-group mt-4">
                                                <?php
                                                
                                                foreach ($EducationLevels as $GetRec)
                                                {
                                                $slct="";
                                                if((int)$user_data['highestEducationLevelID']==$GetRec["id"])
                                                {
                                                $slct="checked";
                                                }
                                                ?>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input one_required" type="radio" name="highestEducationLevelID" value="<?php echo $GetRec["id"];?>" <?php echo $slct;?>>
                                                        <?php echo $GetRec["educationLevelName"];?>
                                                    </label>
                                                </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="mb-3 d-flex flex-wrap">
                                            <label for="currentOccupation">Current occupation :<span class="asterisk-sign">*</span></label>
                                            <input type="text" name="currentOccupation" id="currentOccupation" value="<?php echo $user_data["currentOccupation"];?>" placeholder="Current occupation" class="form-control span12"> 
                                        </div>
                                        <!---->
                                    </div>
                                </div>
                                <hr class="mt-4">
                                <h4 class="pt-2">  Marital Details <label for="cityOfResidence"><span class="asterisk-sign">*</span></label></h4>   

                                <div class="row ">
                                    <div class="col-12  ">
                                        <!---->
                                        <div class="mb-3">
                                            <div class="radio-group">
                                                <?php
                                                $GetRecQ=$this->db->query("select * from MaritalStatus where isActive=1 order by maritalStatusName");
                                                foreach ($MaritalStatus as $GetRec)
                                                {
                                                $slct="";
                                                if((int)$user_data["maritalStatusID"]==$GetRec["id"])
                                                {
                                                $slct="checked";
                                                }
                                                ?>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input one_required" type="radio" name="maritalStatusID" value="<?php echo $GetRec["id"];?>" <?php echo $slct;?>>
                                                        <?php echo $GetRec["maritalStatusName"];?>
                                                    </label>
                                                </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            
                                            <label class="fieldlabel">Would you be willing to relocate?</label> <label for="cityOfResidence"><span class="asterisk-sign">*</span></label>
                                            <br><?php foreach($relocatearray as $key=>$value)
                                            {
                                            $slct="";
                                            if($value==$user_data["willingToRelocate"])
                                            {
                                            $slct="checked";
                                            }
                                            ?>
                                            <input type="radio" class="one_required" name="willingToRelocate" id="WillingToTelocate_<?php echo $key;?>" value="<?php echo $value;?>" <?php echo $slct;?>> <?php echo $value;?><br>
                                            
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="mb-3">
                                            <label class="fieldlabel">After marriage, I will likely have the following living arrangements</label> <label for="cityOfResidence"><span class="asterisk-sign">*</span></label>
                                            <?php
                                            foreach ($LivingArrangements as $GetRec) {
                                                $dwhereEqual = array('fcid'=>$user_data["id"]);
                                                $dselectColumn['*'] = '*';
                                                $AfterMarriageLiving = $this->model_common->getMultipleDataByField('FC_AfterMarriageLiving',$dselectColumn,$dwhereEqual);
                                                $slct="";
                                                if(!empty($AfterMarriageLiving)){
                                                    foreach ($AfterMarriageLiving as $key => $value) {
                                                        if($GetRec["id"]==(int)$value["livingArrangementsID"]) {
                                                            $slct="checked";
                                                        }
                                                    }
                                                }
                                                
                                                echo '<br><input type="checkbox" name="LivingArrangements[]" class="one_required" value="'.$GetRec["id"].'" '.$slct.' > <span class="checkbox_lable">'.$GetRec["desc"].'</span>';
                                            }
                                            ?>
                                            <br><input type="text" disabled="disabled" name="LivingArrangements_OTHER" id="LivingArrangements_OTHER" value="" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label class="fieldlabel">After marriage, I would prefer</label> <label for="cityOfResidence"><span class="asterisk-sign">*</span></label>
                                            <?php
                                            if($Your_gender=="M")
                                            {
                                            $tvalue="AfterMarriagePreferenceMale";
                                            }
                                            else
                                            {
                                            $tvalue="AfterMarriagePreferenceFemale";
                                            }
                                            
                                            $GetRecQ=$this->db->query("select * from ".$tvalue." where isActive=1 order by id");
                                            foreach ($GetRecQ->result_array() as $GetRec)
                                            {
                                            $dwhereEqual = array('fcid'=>$user_data["id"]);
                                            $dselectColumn['*'] = '*';
                                            $AfterSpousePrefer = $this->model_common->getMultipleDataByField('FC_AfterSpousePrefer',$dselectColumn,$dwhereEqual);
                                            $slct="";
                                            if($AfterSpousePrefer){
                                            foreach ($AfterSpousePrefer as $key => $value) {
                                            if($GetRec["id"]==(int)$value["afterMarriagePreferenceMaleID"])
                                            {
                                            $slct="checked";
                                            }
                                            
                                            }
                                            }
                                            
                                            echo '<br><input type="checkbox" class="one_required" name="LivingStyle[]" value="'.$GetRec["id"].'" '.$slct.'> '.$GetRec["desc"];
                                            }
                                            ?>
                                            <br> <input type="text" name="LivingStyle_OTHER" id="LivingStyle_OTHER" disabled="disabled" value="" class="form-control">
                                        </div>
                                        
                                        <!---->
                                    </div>
                                </div>
                                <hr class="mt-4">
                                <h4 class="pt-2"> Spouse Preferences <label for="cityOfResidence"><span class="asterisk-sign">*</span></label></h4>
                                <div class="row justify-content-left">
                                    <div class="col-12 col-md-10">
                                        <!---->
                                        
                                        <div class="mb-3">
                                            <label class="fieldlabel"> What best describes your ethnicity?</label> <label for="cityOfResidence"><span class="asterisk-sign">*</span></label>
                                                <div class="radio-group mt-4">
                                                    <?php
                                                    
                                                    foreach ($Ethnicity as $GetRec)
                                                    {
                                                        $slct="";
                                                       
                                                        if(!empty($user_data['spouseEthnicityID'])){
                                                            $spouseEthnicityIDVar = explode(",", $user_data['spouseEthnicityID']);

                                                            if(in_array($GetRec["id"], $spouseEthnicityIDVar)){
                                                                $slct="checked";
                                                            }
                                                        }
                                                    ?>
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input one_required" type="checkbox" name="spouseEthnicityID[]" value="<?php echo $GetRec["id"];?>" <?php echo $slct;?> id="spouseEthnicityIDCheckBox<?php echo $GetRec["id"];?>" onchange="checkFunction1();">
                                                            <?php echo $GetRec["ethnicityName"];?>
                                                        </label>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>

                                                <script type="text/javascript">   
                                                    function checkFunction1(){
                                                        if($('#spouseEthnicityIDCheckBox10').is(":checked")){
                                                            $("#spouseEthnicityOther").removeAttr("disabled");
                                                        } else {
                                                            $("#spouseEthnicityOther").val(""); 
                                                            $("#spouseEthnicityOther").attr("disabled", "disabled"); 
                                                        }
                                                    }
                                                </script>

                                                <?php 
                                                $disabled = '';
                                                if(!empty($user_data['spouseEthnicityID'])){
                                                    $spouseEthnicityIDVar1 = explode(",", $user_data['spouseEthnicityID']);

                                                    if(!in_array(10, $spouseEthnicityIDVar1)){
                                                        $disabled = 'disabled';
                                                    }
                                                } ?>
                                                
                                                  <input type="text" name="spouseEthnicityOther" id="spouseEthnicityOther" placeholder="Please specify" value="<?php echo $user_data['spouseEthnicityOther']; ?>" class="form-control" <?php echo $disabled; ?>>
                                        </div>
                                        <?php
                                        if($Your_gender=="M")
                                        {
                                        ?>
                                        <div class="mb-3">
                                            <label class="fieldlabel">Hijab Preference</label> <label for="cityOfResidence"><span class="asterisk-sign">*</span></label>
                                            <div class="radio-group mt-4">
                                                <?php
                                                
                                                foreach ($HijabPreference as $GetRec)
                                                {
                                                $slct="";
                                                if((int)$user_data["hijabPreferenceID"]==$GetRec["id"])
                                                {
                                                $slct="checked";
                                                }
                                                ?>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="hijabPreferenceID" value="<?php echo $GetRec["id"];?>" <?php echo $slct;?>>
                                                        <?php echo $GetRec["hijabPreferenceName"];?>
                                                    </label>
                                                </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="fieldlabel">Any additional hijab details you would like to include</label> </label>
                                            <textarea name="hijabPreferenceAdditional" id="hijabPreferenceAdditional" placeholder="" class="form-control"></textarea>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="mb-3">
                                            <label class="fieldlabel">Please specify which age range you would prefer to be matched with?</label> <label for="cityOfResidence"><span class="asterisk-sign">*</span></label>
                                            <?php
                                            
                                            foreach ($AgeRange as $GetRec)
                                            {
                                            $dwhereEqual = array('fcid'=>$user_data["id"]);
                                            $agselectColumn['*'] = '*';
                                            $AgeRanges = $this->model_common->getMultipleDataByField('FC_AgeRanges',$agselectColumn,$dwhereEqual);
                                            $slct="";
                                            if(!empty($AgeRanges)){
                                            foreach ($AgeRanges as $key => $value) {
                                            if($GetRec["id"]==(int)$value["ageRangeID"])
                                            {
                                            $slct="checked";
                                            }
                                            
                                            }
                                            }
                                            
                                            echo '<br><input type="checkbox" class="one_required" name="AgePreference[]" value="'.$GetRec["id"].'" '.$slct.'> '.$GetRec["desc"];
                                            }
                                            ?>
                                        </div>
                                        <div class="mb-3">
                                            <label class="fieldlabel">Would you consider a divorcee with/without children?</label> <label for="cityOfResidence"><span class="asterisk-sign">*</span></label>
                                            <br>
                                            <?php foreach($consideradivorcee as $key=>$value)
                                            {
                                            $slct="";
                                            if($value==$user_data["considerDivorcee"] )
                                            {
                                            $slct="checked";
                                            }
                                            ?>
                                            <input type="radio" class="one_required" name="considerDivorcee" id="consideradivorcee_<?php echo $key;?>" value="<?php echo $value;?>" <?php echo $slct;?>> <?php echo $value;?><br>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <!---->
                                    </div>
                                </div>
                                <hr class="mt-4">
                                <h4 class="pt-2"> About Me <label for="cityOfResidence"><span class="asterisk-sign">*</span></label></h4>
                                <div class="row justify-content-left">
                                    <div class="col-12 col-md-10">
                                        <!---->
                                        
                                        <div class="mb-3">
                                            <label class="fieldlabel">How often do you come to the mosque?</label> <label for="cityOfResidence"><span class="asterisk-sign">*</span></label>
                                            <?php
                                            
                                            foreach ($MosqueVisits as $GetRec)
                                            {
                                            $slct="";
                                             $mshereEqual = array('fcid'=>$user_data["id"]);        
                                                $msselectColumn['*'] = '*'; 
                                                $MosqueVisits = $this->model_common->getMultipleDataByField('FC_MosqueVisits',$msselectColumn,$mshereEqual);
                                            $slct="";
                                            if(!empty($MosqueVisits)){
                                                foreach ($MosqueVisits as $key => $value) {
                                                    if($GetRec["id"]==(int)$value["mosqueVisitID"])
                                                    {
                                                        $slct="checked";
                                                    }
                                                    
                                                }

                                            }  
                                            
                                            echo '<br><input type="checkbox" class="one_required" name="MosqueFrequency[]" value="'.$GetRec["id"].'" '.$slct.'> '.$GetRec["desc"];
                                            }
                                            ?>
                                            <br><input type="checkbox" name="MosqueFrequency[]" value="-1"> Other&nbsp;<input type="text" disabled="disabled" name="mosqueVisitOther" id="mosqueVisitOther" value="" class="form-control">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="fieldlabel">If you had to describe yourself with only 3 characteristics, what would they be?</label> <label for="cityOfResidence"><span class="asterisk-sign">*</span></label>
                                            <br><input type="text" name="myCharacteristics1" id="myCharacteristics1" value="<?php echo $user_data["myCharacteristics1"]; ?>" placeholder="Your Characteristics 1" class="form-control">
                                            <br><input type="text" name="myCharacteristics2" id="myCharacteristics2" value="<?php echo $user_data["myCharacteristics2"];?>" placeholder="Your Characteristics 2" class="form-control">
                                            <br><input type="text" name="myCharacteristics3" id="myCharacteristics3" value="<?php echo  $user_data["myCharacteristics3"]; ?>" placeholder="Your Characteristics 3" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label class="fieldlabel">Preferences you are seeking</label> <label for="cityOfResidence"><span class="asterisk-sign">*</span></label>
                                            <textarea name="preferences" id="preferences" placeholder="please elaborate and express yourself" class="form-control"><?php echo $user_data["preferences"];?></textarea>
                                        </div>
                                        
                                        <div class="mb-3">
                                                    <label class="fieldlabel">Bio</label> <label for="cityOfResidence"><span class="asterisk-sign">*</span></label> 
                                                       <textarea name="interestsHobbiesOther"  placeholder="This is the section that most candidates use to decide on a potential spouse.  Have your personality shine through in your bio.  Why do you want to get married, what are you looking for, what will your future life be like with your spouse?  Describe your interests, lifestyle, and aspirations.  Include fun facts about yourself." id="interestsHobbiesOther"  rows="6" class="form-control"><?php echo $user_data["interestsHobbiesOther"];?></textarea>
                                                </div> 

                                               
 
                                        <div class="mb-3">
                                            <label class="fieldlabel">Other Details</label> <label for="cityOfResidence"><span class="asterisk-sign">*</span></label>
                                            <textarea name="otherDetails" id="otherDetails" placeholder="" class="form-control"><?php echo $user_data["otherDetails"];?></textarea>
                                        </div>
                                        <!---->
                                    </div>
                                </div>
                                
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer mb-5">
                                <button type="submit" class="btn btn-primary">save</button>
                                <a href="<?php echo base_url('users/female') ?>" class="btn btn-danger">cancel</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
</main>
<!-- /.content-wrapper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#femalecandidate").addClass('activAcc');
    $("#guiding_female").children('a').addClass('active');
    $('#female').addClass('show');
    $('#female').css('display','block');
});
$('#birthdate').datepicker({
clearBtn: true,
format: "dd-mm-yyyy"
});


 var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output1');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };

   var loadFile1 = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output2');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };

$('input[name="LivingArrangements[]"]').on('change', function() {
    if ($(this).val() == 11 && $(this).is(':checked')) {
        $('#LivingArrangements_OTHER').prop('disabled', false);
    } else {
        $('#LivingArrangements_OTHER').prop('disabled', true);
        $('#LivingArrangements_OTHER').val('');
    }
});

$('input[name="LivingStyle[]"]').on('change', function() {
    if ($(this).val() == 5 && $(this).is(':checked')) {
        $('#LivingStyle_OTHER').prop('disabled', false);
    } else {
        $('#LivingStyle_OTHER').prop('disabled', true);
        $('#LivingStyle_OTHER').val('');
    }
});

$('input[name="MosqueFrequency[]"]').on('change', function() {
    if ($(this).val() == -1 && $(this).is(':checked')) {
        $('#mosqueVisitOther').prop('disabled', false);
    } else {
        $('#mosqueVisitOther').prop('disabled', true);
        $('#mosqueVisitOther').val('');
    }
});
</script>