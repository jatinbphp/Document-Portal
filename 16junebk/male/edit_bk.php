<!-- Content Wrapper. Contains page content -->
   <main class="male-condidates">
    <link rel="stylesheet" type="text/css" href="https://t00rk.github.io/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css">
<script type="text/javascript" src="https://momentjs.com/downloads/moment-with-locales.js"></script>
<script type="text/javascript" src="https://t00rk.github.io/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 <style type="text/css">
    .dtp-buttons > button.btn {
             border: none;
             border-radius: 2px;
             position: relative;
             box-shadow: none;
             color: rgba(0,0,0, 0.87);
             padding: 5px 16px;
             font-size: 12px;
             margin: 10px 1px;
             font-weight: 500;
             text-transform: uppercase;
             letter-spacing: 0;
             will-change: box-shadow, transform;
             transition: box-shadow 0.2s cubic-bezier(0.4, 0, 1, 1), background-color 0.2s cubic-bezier(0.4, 0, 0.2, 1), color 0.2s cubic-bezier(0.4, 0, 0.2, 1);
             outline: 0;
             cursor: pointer;
             text-decoration: none;
             background: transparent;
         }
        .dtp-buttons > button.btn:hover,
        .dtp-buttons > button.btn:focus {
            background-color: rgba(153, 153, 153, 0.2);
        }
</style>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <style type="text/css">
                .px-2{
                    color: red;
                }
            </style>
            <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="btn close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php elseif($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="btn close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
            </div>
            <?php endif; ?>

            <div class="row">
            <!-- left column -->
            <?php include("arrays.php");


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
                <div class="col-md-12">
                <!-- general form elements -->

                     

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit My Profile</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        
                        <form id="profile_form" action="<?php echo base_url('dashboard/male_edit_profile') ?>" method="post" enctype="multipart/form-data">
            <div class="row justify-content-center">
                <div class="col-md-9 pt-4">
                    <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Login details
                              </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                              <div class="accordion-body">
                                <div class="card border-0">
                                    <div class="card-body text-left">
                                        <div class="row justify-content-left">
                                            <div class="col-12 d-flex flex-wrap">
                                            <!---->
                                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3 plr-8 d-flex flex-wrap">
                                            
                                            <label class="fieldlabelfirst">Email Address</label>
                                            <input type="text" disabled name="email" id="email" value="<?php echo $user_data['email'] ?>" placeholder="Email Address" class="form-control" />  
                                            </div>
                                            
                                            <!---->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                Personal Information<div class="px-2"> *</div>
                            </button>
                          </h2>
                          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="card border-0">
                                    <div class="card-body text-left">
                                        <div class="row justify-content-center">
                                            <div class="col-12 d-flex flex-wrap">

                                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3 plr-8 d-flex flex-wrap imgUp">

                                        <?php if($user_data['image'] != ''){ ?>
                                            <img id="output1" height="100" src="<?php echo base_url('uploads/users/'.$user_data['primimage']); ?>" /> 
                                        <?php }else{ ?>
                                            <img id="output1" height="100" src="<?php echo base_url('assets/images/male.jpeg'); ?>" />
                                        <?php }  ?> 
                                           
                                        <label class="btn btn-dark">
                                         Primary image<input type="file" name="primimage" class="uploadFile img" value="Upload Primary" onchange="loadFile(event)" style="width: 0px;height: 0px;overflow: hidden;">
                                        </label>
                                       
                                            </div>
 
                                        <input type="hidden" id="hidden_primimage" name="hidden_primimage" value="<?php if(isset($user_data['primimage'])){ echo $user_data['primimage']; } ?>">

                                         <div class="col-lg-6 col-md-6 col-sm-12 mb-3 plr-8 d-flex flex-wrap imgUp">

                                            <?php if($user_data['image'] != ''){ ?>
                                                <img id="output2" height="100" src="<?php echo base_url('uploads/users/'.$user_data['image']); ?>" /> 
                                            <?php }else{ ?>
                                                <img id="output2" height="100" src="<?php echo base_url('assets/images/male.jpeg'); ?>" />
                                            <?php }  ?>

                                            
                                            <label class="btn btn-dark">
                                               image<input type="file" name="image1" class="uploadFile img" value="Upload Image" onchange="loadFile1(event)" style="width: 0px;height: 0px;overflow: hidden;">
                                            </label>
                                        </div>

                                        
 
                                    <input type="hidden" id="hidden_image1" name="hidden_image1" value="<?php if(isset($user_data['image'])){ echo $user_data['image']; } ?>">

                                                <div class="col-lg-6 col-md-6 col-sm-12 mb-3 plr-8 d-flex flex-wrap">
                                                    <input type='text' name="firstName" id="firstName" value="<?php echo $user_data['firstName'] ?>" placeholder="First Name" class="form-control" /> <div class="px-2"> *</div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 mb-3 plr-8 d-flex flex-wrap">
                                                    <input type='text' name="lastName" id="lastName" placeholder="Last Name" value="<?php echo $user_data['lastName'] ?>" class="form-control" /> <div class="px-2"> *</div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 mb-3 plr-8 d-flex flex-wrap">
                                                    <input type='text' name="phone" id="phone" value="<?php echo $user_data['phone']; ?>" placeholder="Contact Number" class="form-control" /> <div class="px-2"> *</div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 mb-3 plr-8 d-flex flex-wrap">

                                                     <input type='text'  name="birthdate" id="birthdate" value="<?php echo isset($user_data['birthdate']) ? date('d-m-Y',strtotime($user_data['birthdate'])) :  ''; ?>" placeholder="Birth Date" class="form-control" />  
                                                     
                                                 <div class="px-2"> *</div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 mb-3 plr-8 d-flex flex-wrap">
                                                    <input type='text' name="fathersName" id="fathersName" value="<?php echo $user_data['fathersName']; ?>" placeholder="Father's Name" class="form-control" /> <div class="px-2"> *</div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 mb-3 plr-8 d-flex flex-wrap">
                                                    <input type='text' name="mothersName" id="mothersName" value="<?php echo $user_data['mothersName']; ?>" placeholder="Mother's Name" class="form-control" /> <div class="px-2"> *</div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 mb-3 plr-8 d-flex flex-wrap">
                                                    <input type="text" name="cityOfResidence" id="cityOfResidence" value="<?php echo $user_data['cityOfResidence']; ?>" placeholder="City of Residence" class="form-control"><div class="px-2"> *</div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 mb-3 plr-8 d-flex flex-wrap">
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
                                                    <div class="px-2"> *</div>
                                                </div>
                                                
                                                <div class="col-lg-6 col-md-6 col-sm-12 plr-8 mb-4 d-flex flex-wrap">
                                                    <div class="select-wrapper w-100">
                                                        <select name="heightCM" id="heightCM" class="select-lg w-100">
                                                            <option value="">Height</option>
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
                                                    <div class="px-2"> *</div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 plr-8 mb-4 d-flex flex-wrap"></div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 plr-8 mb-5">
                                                    <label class="fieldlabel">What is your status  in the current country you are residing in?</label>
                                                    <div class="radio-group mt-1">
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

                                                    <label class="fieldlabel">Where were you born ?</label>
                                                    <input type="text" name="cityOfBirth" id="cityOfBirth" value="<?php echo $user_data['cityOfBirth']; ?>" placeholder="Where were you born, city, country?" class="form-control">
                                                
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 plr-8 mb-3">
                                                    <label class="fieldlabel">How long have you lived in North America/Europe/Australia?</label>
                                                    <div class="radio-group mt-1">
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
                                                <div class="col-lg-6 col-md-6 col-sm-12 plr-8 mb-3">
                                                    <label class="fieldlabel">Ethnicity -  What best describes your ethnicity?</label>
                                                    <div class="radio-group mt-1">
                                                        <?php
                                                        
                                                        foreach ($Ethnicity as $GetRec)
                                                        {
                                                            $slct="";
                                                            if((int)$user_data['personalEthnicityID']==$GetRec["id"])
                                                            {
                                                                $slct="checked";
                                                            }
                                                        ?>
                                                        <div class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" type="radio" name="personalEthnicityID" value="<?php echo $GetRec["id"];?>" <?php echo $slct;?>>
                                                                <?php echo $GetRec["ethnicityName"];?>
                                                            </label>
                                                        </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <script type="text/javascript">
                                                        
                                                        $('input[type=radio][name=personalEthnicityID]').change(function() {
                                                            if (this.value == 10) {
                                                                $("#personalEthnicityOther").removeAttr("disabled");  
                                                            } else {
                                                                $("#personalEthnicityOther").val(""); 
                                                                $("#personalEthnicityOther").attr("disabled", "disabled"); 
                                                            }
                                                        });
                                                    </script>
                                                    <input type="text" name="personalEthnicityOther" id="personalEthnicityOther" placeholder="Please specify your Ethnicity" value="<?php echo $user_data['personalEthnicityOther']; ?>" class="form-control" <?php if((int)$user_data['personalEthnicityID']!=9){ echo "disabled"; } ?>> 
                                                </div>
                                                
                                               
                                                
                                                <!---->
                                            </div>

                                             <div class="row">
                                                    <div class="col-sm-12 text-center">
                                                         <br>
                                                          <input type="hidden" id="Your_gender" value="<?=$Your_gender;?>">

                                                            <input type="hidden" name="insertform" id="insertform" value=1>

                                                            <input type="hidden" name="submitform" value=1>
                                                          <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Professional & Educational Details<div class="px-2"> *</div>
                            </button>
                          </h2>
                          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                            <div class="card border-0">
                                    <div class="card-body text-left">
                                        <div class="row justify-content-left">
                                            <div class="col-12 d-flex flex-wrap">
                                                <div class="col-lg-6 col-md-6 col-sm-12 mb-3 plr-8 d-flex flex-wrap">
                                                    <textarea name="areaOfStudy" id="areaOfStudy" placeholder="Area of study" class="form-control span12"><?php echo $user_data['areaOfStudy']; ?></textarea> <div class="px-2"> *</div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 mb-3 plr-8 d-flex flex-wrap">
                                                    <input type="text" name="currentOccupation" id="currentOccupation" value="<?php echo $user_data["currentOccupation"];?>" placeholder="Current occupation" class="form-control span12"> <div class="px-2"> *</div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 plr-8 mb-3">
                                                    <label class="fieldlabel with-star-label">Highest level of education obtained<div class="px-2"> *</div></label>
                                                    <div class="radio-group mt-1">
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
                                                                <input class="form-check-input" required type="radio" name="highestEducationLevelID" value="<?php echo $GetRec["id"];?>" <?php echo $slct;?>>
                                                                <?php echo $GetRec["educationLevelName"];?>
                                                            </label>
                                                        </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <!---->
                                            </div>
                                        </div>
                                    </div>  


                            </div>     
                             <div class="row">
                                <div class="col-sm-12 text-center"> 
                                      <input type="hidden" id="Your_gender" value="<?=$Your_gender;?>">

                                        <input type="hidden" name="insertform" id="insertform" value=1>

                                        <input type="hidden" name="submitform" value=1>
                                      <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div> 
                            </div>
                            
                          </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Marital Details<div class="px-2"> *</div>
                              </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                              <div class="accordion-body">
                                <div class="card border-0">
                                    <div class="card-body text-left">
                                        <div class="row justify-content-left">
                                            <div class="col-12 d-flex flex-wrap">
                                            <!---->
                                            <div class="col-lg-6 col-md-6 col-sm-12 plr-8 mb-3">
                                                    <label class="fieldlabel with-star-label">Marital Status <div class="px-2"> *</div></label>
                                                    <div class="radio-group mt-1">
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
                                                                <input class="form-check-input" type="radio" name="maritalStatusID" value="<?php echo $GetRec["id"];?>" <?php echo $slct;?>>
                                                                <?php echo $GetRec["maritalStatusName"];?>
                                                            </label>
                                                        </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 plr-8 mb-3">
                                            
                                            <label class="fieldlabel with-star-label">Would you be willing to relocate? <div class="px-2"> *</div></label>
                <br><?php foreach($relocatearray as $key=>$value)
                {
                    $slct="";
                    if($value==$user_data["willingToRelocate"])
                    {
                        $slct="checked";
                    }
                ?>  
                 <div class="form-check form-check-inline">
                                                            <label class="form-check-label">
                <input type="radio" name="willingToRelocate" id="WillingToTelocate_<?php echo $key;?>" value="<?php echo $value;?>" <?php echo $slct;?>> <?php echo $value;?></label></div>
                
                <?php
                }
                ?>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 plr-8 mb-3">
                                            <label class="fieldlabel with-star-label">After marriage, I will likely have the following living arrangements <div class="px-2"> *</div></label>
                <?php
                 
                foreach ($LivingArrangements as $GetRec)
                {   

                     $dwhereEqual = array('mcid'=>$user_data["id"]);        
                $dselectColumn['*'] = '*'; 
                $AfterMarriageLiving = $this->model_common->getMultipleDataByField('MC_AfterMarriageLiving',$dselectColumn,$dwhereEqual);
                    $slct="";
                    if(!empty($AfterMarriageLiving)){
                        foreach ($AfterMarriageLiving as $key => $value) {
                            if($GetRec["id"]==(int)$value["livingArrangementsID"])
                            {
                                $slct="checked";
                            }
                            
                        }

                    }
                
                    echo '<br><input type="checkbox" name="LivingArrangements[]" value="'.$GetRec["id"].'" '.$slct.' > '.$GetRec["desc"];
                }
                ?>

                <br><input type="text" name="LivingArrangements_OTHER" id="LivingArrangements_OTHER" value="" class="form-control">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 plr-8 mb-3">
                                            <label class="fieldlabel with-star-label">After marriage, I would prefer <div class="px-2"> *</div></label>
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

                $dwhereEqual = array('mcid'=>$user_data["id"]);        
                $dselectColumn['*'] = '*'; 
                $AfterSpousePrefer = $this->model_common->getMultipleDataByField('MC_AfterSpousePrefer',$dselectColumn,$dwhereEqual);
                    $slct="";
                    if($AfterSpousePrefer){
                        foreach ($AfterSpousePrefer as $key => $value) {
                            if($GetRec["id"]==(int)$value["afterMarriagePreferenceMaleID"])
                            {
                                $slct="checked";
                            }
                            
                        }

                    }
                
                    echo '<br><input type="checkbox" name="LivingStyle[]" value="'.$GetRec["id"].'" '.$slct.'> '.$GetRec["desc"];
                }
                ?>
                <br><input type="text" name="LivingStyle_OTHER" id="LivingStyle_OTHER" value="" class="form-control">
                                            </div>
                                            
                                            <!---->
                                            </div>

                                            <div class="row">
                                <div class="col-sm-12 text-center"> 
                                      <input type="hidden" id="Your_gender" value="<?=$Your_gender;?>">

                                        <input type="hidden" name="insertform" id="insertform" value=1>

                                        <input type="hidden" name="submitform" value=1>
                                      <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                                        </div>
                                    </div>
                                </div>  
                              </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                Spouse Preferences <div class="px-2"> *</div>
                            </button>
                          </h2>
                          <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="card border-0">
                                    <div class="card-body text-left">
                                        <div class="row justify-content-left">
                                            <div class="col-12 d-flex flex-wrap">
                                            <!---->
                                            
                                                <div class="col-lg-6 col-md-6 col-sm-12 plr-8 mb-3">
                                                    <label class="fieldlabel with-star-label">Which Ethnicity would you like your spouse to be?<div class="px-2"> *</div></label>
                                                    <div class="radio-group mt-4">
                                                        <?php
                                                        
                                                        foreach ($Ethnicity as $GetRec)
                                                        {
                                                            $slct="";
                                                            if((int)$user_data["spouseEthnicityID"] ==$GetRec["id"])
                                                            {
                                                                $slct="checked";
                                                            }
                                                        ?>
                                                        <div class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" required type="radio" name="spouseEthnicityID" value="<?php echo $GetRec["id"];?>" <?php echo $slct;?>>
                                                                <?php echo $GetRec["ethnicityName"];?>
                                                            </label>
                                                        </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>

                                                    <script type="text/javascript">
                                                        
                                                        $('input[type=radio][name=spouseEthnicityID]').change(function() {
                                                            if (this.value == 9) {
                                                                $("#spouseEthnicityOther").removeAttr("disabled");  
                                                                $("#spouseEthnicityOther").removeAttr("required");  
                                                            } else {
                                                                $("#spouseEthnicityOther").val("");
                                                                $("#spouseEthnicityOther").attr("disabled", "disabled"); 
                                                                $("#spouseEthnicityOther").attr("required", "required"); 
                                                            }
                                                        });
                                                    </script>

                                                    

                                                    <input type="text" name="spouseEthnicityOther" id="spouseEthnicityOther" placeholder="Please specify your spouse Ethnicity" value="<?php echo $user_data['spouseEthnicityOther']; ?>" class="form-control" <?php if((int)$user_data['spouseEthnicityID']!=9){ echo "disabled"; } ?>> 
                                                </div>
                                                <?php
                                                if($Your_gender=="M")
                                                {
                                                ?>
                                                <div class="col-lg-6 col-md-6 col-sm-12 plr-8 mb-3">
                                                    <label class="fieldlabel with-star-label">Hijab Preference <div class="px-2"> *</div></label>
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
                                                    </div><br>
                                                     <label class="with-star-label">Any additional hijab details you would like to include</label>
                                                    <textarea name="hijabPreferenceAdditional" id="hijabPreferenceAdditional" placeholder="" class="form-control"><?php echo $user_data['hijabPreferenceAdditional']; ?></textarea>
                                                </div>
                                                
                                                <?php
                                                }
                                                ?>
                                                <div class="col-lg-6 col-md-6 col-sm-12 plr-8 mb-3">
                                                    <label class="fieldlabel with-star-label">Please specify which age range you would prefer to be matched with? <div class="px-2"> *</div></label>
                                                    <?php
                 
                foreach ($AgeRange as $GetRec)
                {

                      $dwhereEqual = array('mcid'=>$user_data["id"]);        
                $agselectColumn['*'] = '*'; 
                $AgeRanges = $this->model_common->getMultipleDataByField('MC_AgeRanges',$agselectColumn,$dwhereEqual);
                    $slct="";
                    if(!empty($AgeRanges)){
                        foreach ($AgeRanges as $key => $value) {
                            if($GetRec["id"]==(int)$value["ageRangeID"])
                            {
                                $slct="checked";
                            }
                            
                        }

                    } 
                
                    echo '<br><input type="checkbox" name="AgePreference[]" value="'.$GetRec["id"].'" '.$slct.'> '.$GetRec["desc"];
                }
                ?>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 plr-8 mb-3">
                                                    <label class="fieldlabel">Would you consider a divorcee with/without children?</label>
                                                    <br>
                                                    <?php foreach($consideradivorcee as $key=>$value)
                                                    {
                                                        $slct="";

                                                        if($value==$user_data["considerDivorcee"] )
                                                        {
                                                            $slct="checked";
                                                        }
                                                    ?>
                                                    <input type="radio" name="considerDivorcee" id="consideradivorcee_<?php echo $key;?>" value="<?php echo $value;?>" <?php echo $slct;?>> <?php echo $value;?><br>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>


                                            <!---->
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 text-center">
                                                    <input type="hidden" id="Your_gender" value="<?=$Your_gender;?>">
                                                    <input type="hidden" name="insertform" id="insertform" value=1>
                                                    <input type="hidden" name="submitform" value=1>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>      
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="headingSix">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                About Me <div class="px-2"> *</div>
                            </button>
                          </h2>
                          <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="card border-0">
                                    <div class="card-body text-left">
                                        <div class="row justify-content-left">
                                            <div class="col-12 d-flex flex-wrap">
                                            <!---->
                                            
                                                <div class="col-lg-6 col-md-6 col-sm-12 plr-8 mb-3">
                                                    <label class="fieldlabel">How often do you come to the mosque? <div class="px-2"> *</div></label> 
                                                    <?php
                
                foreach ($MosqueVisits as $GetRec)
                {   

                 $mshereEqual = array('mcid'=>$user_data["id"]);        
                $msselectColumn['*'] = '*'; 
                $MosqueVisits = $this->model_common->getMultipleDataByField('MC_MosqueVisits',$msselectColumn,$mshereEqual);
                    $slct="";
                    if(!empty($MosqueVisits)){
                        foreach ($MosqueVisits as $key => $value) {
                            if($GetRec["id"]==(int)$value["mosqueVisitID"])
                            {
                                $slct="checked";
                            }
                            
                        }

                    }  
                
                    echo '<br><input type="checkbox" name="MosqueFrequency[]" value="'.$GetRec["id"].'" '.$slct.'> '.$GetRec["desc"];
                }
                ?>
                <br><input type="checkbox" name="MosqueFrequency[]" value="-1"> Other&nbsp;<input type="text" name="mosqueVisitOther" id="mosqueVisitOther" value="" class="form-control">
                                                </div>
                                                
                                                <div class="col-lg-6 col-md-6 col-sm-12 plr-8 mb-3">
                                                    <label class="fieldlabel">If you had to describe yourself with only 3 characteristics, what would they be? <div class="px-2"> *</div></label>
                                                    <br><input type="text" name="myCharacteristics1" id="myCharacteristics1" value="<?php echo $user_data["myCharacteristics1"]; ?>" placeholder="Your Characteristics 1" class="form-control">
                <br><input type="text" name="myCharacteristics2" id="myCharacteristics2" value="<?php echo $user_data["myCharacteristics2"];?>" placeholder="Your Characteristics 2" class="form-control">
                <br><input type="text" name="myCharacteristics3" id="myCharacteristics3" value="<?php echo  $user_data["myCharacteristics3"]; ?>" placeholder="Your Characteristics 3" class="form-control">
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 plr-8 mb-3">
                                                    <label class="fieldlabel">Preferences you are seeking <div class="px-2"> *</div></label>
                                                    <textarea name="preferences" id="preferences" placeholder="please elaborate and express yourself" class="form-control"><?php echo $user_data["preferences"];?></textarea>
                                                </div>  

                                                 <div class="col-lg-6 col-md-6 col-sm-12 plr-8 mb-3">
                                                    <label class="fieldlabel">Other Details <div class="px-2"> *</div></label>
                                                    <textarea name="otherDetails" id="otherDetails" placeholder="" class="form-control"><?php echo $user_data["otherDetails"];?></textarea>
                                                </div>

                                                
                                                <div class="col-lg-12 col-md-12 col-sm-12 plr-8 mb-3">
                                                    <label class="fieldlabel">Bio <div class="px-2"> *</div></label>  
                 
                <textarea name="interestsHobbiesOther" id="interestsHobbiesOther" placeholder="This is the section that most candidates use to decide on a potential spouse.  Have your personality shine through in your bio.  Why do you want to get married, what are you looking for, what will your future life be like with your spouse?  Describe your interests, lifestyle, and aspirations.  Include fun facts about yourself." id="interestsHobbiesOther"  rows="6" class="form-control"><?php echo $user_data["interestsHobbiesOther"];?></textarea>
                                                </div> 
 
                                                  <div class="col-md-12 text-center">
             
            
              <input type="hidden" id="Your_gender" value="<?=$Your_gender;?>">

                <input type="hidden" name="insertform" id="insertform" value=1>

                <input type="hidden" name="submitform" value=1>
              <button type="submit" class="btn btn-primary">Submit</button>
        </div>     

                                            <!---->
                                            </div>
                                        </div>
                                    </div>
                                </div>      
                            </div>
                          </div>
                        </div>
                        
                    </div>
                </div>
                <!---->
        <div class="row">
        
      
        </div>
                
                
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
<script type="text/javascript">
$(document).ready(function() {
   $("#malecandidate").addClass('active');
});
</script>
   <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>


<script>  
  
     

  jQuery.validator.addMethod("noSpace", function(value, element) { 
    return value.indexOf(" ") < 0 && value != ""; 
  }, "No space please and don't leave it empty");

  jQuery.validator.addMethod("pwcheck", function(value, element) { 
   return /[\@\#\$\%\^\&\*\(\)\_\+\!]/.test(value) && /[a-z]/.test(value) || /[0-9]/.test(value) || /[A-Z]/.test(value);
  }, "at least One Spacial characters or Number or Capital letter");

 
    $("#profile_form").validate({
        
        errorClass: "signupError",
        errorElement: "span", 
        rules: {       
            
            firstName:{
                required: true,
                 minlength: 3, 
            },    
            lastName:{
                required: true,
                 minlength: 3, 
            },
            mothersName:{
                required: true,
                 minlength: 3, 
            },    
            fathersName:{
                required: true,
                 minlength: 3, 
            },
            birthdate:{
                required: true 
            },
            cityOfResidence:{
                required: true 
            }, 
            heightCM:{
                required: true 
            },
            areaOfStudy:{
                required: true 
            }, 
             highestEducationLevelID:{
                required: true 
            },  
            maritalStatusID:{
                required: true 
            },  
            "LivingArrangements[]":{
                required: true 
            },  
            willingToRelocate:{
                required: true 
            }, 
            "LivingStyle[]":{
                required: true 
            }, 
            currentOccupation:{
                required: true 
            },
            countryOfResidence:{
                required: true 
            },  
            spouseEthnicityID:{
                required: true 
            }, 
            mosqueVisitOther:{
                required: function () {
                if($('input[name="spouseEthnicityID"]:checked').val()==9){
                  return true;
                }
                else
                {
                  return false;
                }
              },
            },
            hijabPreferenceID:{
                required: true 
            }, 
            "AgePreference[]":{
                required: true 
            },
             phone:{
                required: true 
            },
            pwd: {
                required: true,
                minlength: 6,
                noSpace: true,
                pwcheck:true
            },
            "MosqueFrequency[]":{
                required: true 
            },  
            "myCharacteristics1":{
                required: true 
            },
            "myCharacteristics2":{
                required: true 
            },
            "myCharacteristics3":{
                required: true 
            },
            "otherDetails":{
                required: true 
            },
            "preferences":{
                required: true 
            },
            interestsHobbiesOther:
            {
                required: true,
                 minlength: 50,
            },
        },

        // Specify the validation error messages
        messages: {

           firstName:{ 
                required:  "Please Enter First Name", 
                minlength: "Please enter at least 3 characters",
            },                      
            lastName:{ 
                required:  "Please Enter Last Name", 
                minlength: "Please enter at least 3 characters",
            } ,
             fathersName:{ 
                required:  "Please Enter Father Name", 
                minlength: "Please enter at least 3 characters",
            },                      
            mothersName:{ 
                required:  "Please Enter Mother Name", 
                minlength: "Please enter at least 3 characters",
            } ,
            birthdate: "Please Enter Birthdate", 
            cityOfResidence: "Please Enter city Of Residence", 
            heightCM: "Please Select height", 
            areaOfStudy: "Please Enter area Of Study", 
            currentOccupation: "Please Enter Current Occupation", 
            highestEducationLevelID: "Please Select highest Education Level", 
            maritalStatusID: "Please select marital Status", 
            willingToRelocate: "Please select willing To Relocate", 
            "LivingArrangements[]": "Please select Living Arrangements", 
            "LivingStyle[]": "Please select Living Style", 
            spouseEthnicityID: "Please Select Spouse Ethnicity", 
            spouseEthnicityOther: "Please Enter Other Spouse Ethnicity", 
            hijabPreferenceID: "Please Select Hijab Preference",  
            "AgePreference[]": "Please Enter Age Preference", 
            phone: "Please Enter Contact Number", 
            countryOfResidence: "Please select country", 
            email: {
                required:"Please Enter Email",
                email: "Email Address Not Valid!",
                remote: "This email address already exist"
            },
            interestsHobbiesOther:{ 
                minlength: "Please enter at least 50 characters",
            } ,
        }, 
        highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
        },
        submitHandler: function (form){
             
           form.submit();
            return false;
 
        }
    });

    $('#birthdate').bootstrapMaterialDatePicker({
    format: 'DD-MM-YYYY',
    shortTime: false,
    date: true,
    time: false,
    monthPicker: false,
    year: false,
    switchOnClick: true,
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
    

</script>