  <main class="male-condidates">
       <?php include("arrays.php"); ?>
    <style>
        .deleteuser {
            max-width: 200px;
            width: 100%;
            margin: 0px auto;
            text-align: left;
            padding-bottom: 20px;
        }
        .deleteuser .form-check {
            text-align: left;
        }
        .deleteuser .form-check:nth-last-child(2) {
            margin-bottom: 20px;
        }
        .deleteuser button {
            margin-left: 0;
            margin-right: auto;
        }
    </style>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
            <!-- left column -->
                
                <div class="col-md-12">
                <!-- general form elements --> 

                    <div class="d-flex align-items-center flex-wrap mb-20">
                        <?php if($this->session->userdata('femaleconscandidatelogged')){  ?>
                            <h1 class="page-title mb-0">LIST OF FEMALE CANDIDATES</h1> 
                        <?php } else { ?>
                            <h1 class="page-title mb-0">LIST OF MALE CANDIDATES</h1> 
                        <?php } ?>
                    </div>
                    <div class="card">
                         <div class="row p-3">
                             <div class="col-sm-3">
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#cansearchdata" aria-expanded="false" aria-controls="cansearchdata"> Advance Search  </button></div></div>
                        <div class="collapse" id="cansearchdata">
                    <div class="card card-body">
                        <form name="confemalesearch" id="confesearch" class="m-2">
                         <div class="row pt-3">
                             <div class="col-sm-3">
                                   <select name="countryOfResidence[]" id="countryOfResidence" class="w-100" multiple style="height: auto;">
                                    <option value='0'>Country of Residence</option>
                                    <?php
 
                                    foreach ($country as $GetRec)
                                    {
                                        $slct=""; 
                                    
                                        echo "<option value='".$GetRec["id"]."' >".$GetRec["countryName"]."</option>";
                                    }
                                    ?>
                                </select>
                             </div>
                             <div class="col-sm-3">

                              <select name="personalEthnicityID[]" id="personalEthnicityID" class="w-100" multiple style="height: auto;">
                                    <option value='0'>Ethnicity</option>
                                    <?php
 
                                    foreach ($Ethnicity as $GetRec)
                                    {
                                        $slct=""; 
                                    
                                        echo "<option value='".$GetRec["id"]."' >".$GetRec["ethnicityName"]."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                             

                         </div>
                          <hr>
                              <div class="row pt-1 pb-3">
                                 <label class="fieldlabel">Age</label>
                             <div class="col-sm-3">
                                 <input type="number" min="20" max="100" class="form-control  " placeholder="From"   name="from_age" id="from_age">
                             </div>
                             <div class="col-sm-3">
                                 <input type="number" class="form-control  " min="20" max="100" placeholder="To" name="to_age" id="to_age">
                             </div>
                             </div>
                            <div class="row pt-2">
                            
                             <div class="col-sm-8">
                                                <label class="fieldlabel">What is your status  in the current country you are residing in?</label>
                                                <div class="radio-group mt-4">
                                                    <?php
                                                    
                                                    foreach ($CitizenshipStatus as $GetRec)
                                                    { ?>
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="radio" id="citizenshipStatusID" name="citizenshipStatusID" value="<?php echo $GetRec["id"];?>"  >
                                                            <?php echo $GetRec["statusName"];?>
                                                        </label>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    
                                                </div>
                                            </div>
                                            <hr>
                                  <div class="col-sm-8">
                                                <label class="fieldlabel">How long have you lived in North America/Europe/Australia?</label>
                                                <div class="radio-group mt-4">
                                                    <?php
                                                    
                                                    foreach ($DurationOfStay as $GetRec)
                                                    { 
                                                    ?>
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="radio" name="durationOfStayID" value="<?php echo $GetRec["id"];?>"  >
                                                            <?php echo $GetRec["desc"];?>
                                                        </label>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <hr>
                                             <div class="col-sm-8">
                                                <label class="fieldlabel">Highest level of education obtained</label>
                                                <div class="radio-group mt-4">
                                                    <?php
                                                    
                                                    foreach ($EducationLevels as $GetRec)
                                                    {  ?>
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="radio" name="highestEducationLevelID" value="<?php echo $GetRec["id"];?>"  >
                                                            <?php echo $GetRec["educationLevelName"];?>
                                                        </label>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="col-sm-8"> 
                                                <label class="fieldlabel">Would you be willing to relocate?</label>
                                                <br><?php $relocatearray=array("No","Yes","Undecided");
                                                 foreach($relocatearray as $key=>$value)
                                                {   ?>
                                                <input type="radio" name="willingToRelocate" id="WillingToTelocate_<?php echo $key;?>" value="<?php echo $value;?>"  > <?php echo $value;?><br>  
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <hr>
                                            <div class="col-sm-12">
                                                    <label class="fieldlabel">Marital Status</label>
                                                    <div class="radio-group mt-4">
                                                        <?php
                                                        $GetRecQ=$this->db->query("select * from MaritalStatus where isActive=1 order by maritalStatusName");
                                                        foreach ($MaritalStatus as $GetRec)
                                                        {  ?>
                                                        <div class="form-check form-check-inline">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" type="radio" name="maritalStatusID" value="<?php echo $GetRec["id"];?>" >
                                                                <?php echo $GetRec["maritalStatusName"];?>
                                                            </label>
                                                        </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                            </div>

                                              <div class="row"> 

                                        <div class="col-sm-4 ">
                                           <label for="from_height">From Height : </label>
                                            <div class="select-wrapper w-100">
                                                <select name="from_height" id="from_height" class="select-lg w-100">
                                                    <option value="">Height </option>
                                                    <?php
                                                    foreach($Height_array as $key=>$value)
                                                    { 
                                                     
                                                    $heightincms=$key;
                                                    if($heightincms==0)
                                                    {
                                                    $heightincms="&lt;137";
                                                    }
                                                    else if($heightincms==500)
                                                    {
                                                    $heightincms="&gt;211";
                                                    }
                                                    echo "<option value=".$key."  >".$value." - (".$heightincms."cm)</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-4 mb-4">
                                           <label for="to_height">To Height : </label>
                                            <div class="select-wrapper w-100">
                                                <select name="to_height" id="to_height" class="select-lg w-100">
                                                    <option value="">Height </option>
                                                    <?php
                                                    foreach($Height_array as $key=>$value)
                                                    { 
                                                     
                                                    $heightincms=$key;
                                                    if($heightincms==0)
                                                    {
                                                    $heightincms="&lt;137";
                                                    }
                                                    else if($heightincms==500)
                                                    {
                                                    $heightincms="&gt;211";
                                                    }
                                                    echo "<option value=".$key."  >".$value." - (".$heightincms."cm)</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                         </div>

                         <div class="col-sm-12"> 
                            <div class="col-sm-10">
                                <button type="button" class="btn btn-primary clear_can_filter">Filter</button>
                                <button type="reset" class="btn btn-warning" id="can_clear_filter">Clear Filters</button>
                            </div>
                         </div>

                         </form>
                       </div></div>
                          <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="candidatelistTable" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th style="width: 10%">Image</th>  
                                        <th style="width: 10%">Country</th>
                                        <th>Town</th>
                                        <th style="width: 10%">Age</th>  
                                        <th style="width: 10%">Ethinicity</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>                        
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
 

<!-- /.content-wrapper -->
</main>
<script type="text/javascript">
$(document).ready(function() {
    $("#candidatelist").addClass('active');
});


</script>
 