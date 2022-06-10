<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">

            <?php if(session()->has('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo session()->getFlashdata('success'); ?>
            </div>
            <?php elseif(session()->has('error')): ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo session()->getFlashdata('error'); ?>
            </div>
            <?php endif; ?>

            <h3>Add Documents</h3>

            <div class="item-wrap item-list-table">

                <div class="card">
                    <div class="card-body">
                        <form id="documentFormAddEdit" method="post" action="<?php echo base_url('userDocuments/add'); ?>" enctype="multipart/form-data">
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                         <label class="lableTitle"for="docName">Name :<span class="asterisk-sign">*</span></label>
                                         <input type="text" name="docName" class="form-control" id="docName" placeholder="Name">
                                        
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="lableTitle"for="userID">Users:<span class="asterisk-sign">*</span></label>
                                        <select name="userID" id="userID" class="form-control" REQUIRED>
                                            <option value="">-- Select Users --</option>
                                            <?php 
                                            if(count($users)>0){
                                                foreach ($users as $key => $value) { ?>
                                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['firstName'].' ' .$value['lastName'] ; ?></option>
                                                <?php
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                </div> -->
<!-- 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="lableTitle"for="companyID">Company:<span class="asterisk-sign">*</span></label>
                                        <select name="companyID" id="companyID" class="form-control" REQUIRED>
                                            <option value="">-- Select Company --</option>
                                            <?php 
                                            if(count($company)>0){
                                                foreach ($company as $key => $value) { ?>
                                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['companyName']; ?></option>
                                                <?php
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                </div> -->
                            
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="lableTitle"for="firstName">Category :<span class="asterisk-sign">*</span></label>
                                        <select name="categoryID" id="categoryID" class="form-control" REQUIRED>
                                            <option value="">-- Select Category --</option>
                                            <?php 
                                            if(count($category)>0){
                                                foreach ($category as $key => $value) { ?>
                                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['categoryName']; ?></option>
                                                <?php
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="lableTitle"for="lastName">Sub Category :<span class="asterisk-sign">*</span></label>
                                        <select name="subCategoryID" id="subCategoryID" class="form-control" REQUIRED>
                                            <option value="">-- Select Sub Category --</option>
                                            <?php 
                                            if(count($subCategory)>0){
                                                foreach ($subCategory as $key => $value) { ?>
                                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['SubCatName']; ?></option>
                                                <?php
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="lableTitle"for="profilePic">Documents : </label>
                                       <!--  <span>(We accept .JPG / .PNG / .GIF / .JPEG)</span> -->
                                        <div class="kv-avatar">
                                            <div class="file-loading">
                                                <input id="docFile" name="docFile" type="file">
                                            </div>
                                            </br>
                                           <!--  <?php
                                            $img_thumnail = '';
                                            $img_thumnail = base_url('assets/images/default.png'); ?>

                                            <img style="border: 1px solid #eee; padding: 5px;" id="thumbnail_img" width="100" height="100" src="<?php echo $img_thumnail; ?>"> -->
                                        </div>
                                        <label class="lableTitle"id="image-error" class="error" for="Document"></label>
                                    </div>
                                </div>
                                
                                
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="lableTitle"for="companyId ">Company :<span class="asterisk-sign">*</span></label>
											<select name="companyID" id="companyID" class="form-control" REQUIRED>
                                         <!--select name="companyId" id="companyId" class="form-control" REQUIRED-->
                                         <!--select id="companyId" class="js-states form-control" name="companyId[]" multiple-->
													<option value="">-- Select Company --</option>
														<?php if(count($company ) > 0): ?>
															<?php foreach($company as $key => $value): ?>
																<option value="<?php echo $value['id'] ?>"><?php echo $value['companyName'] ?></option>
															<?php endforeach; ?>
														<?php endif; ?>
												</select>
											</div>
										</div>
                            
                                

                                <!--  <div class="col-md-3">
                                    <label class="lableTitle"for="expireDate">Expire Date :</label>
                                    <div class="form-group form-check">
                                        <input type="date" name="expireDate" class="form-check-input" id="expireDate">
                                        
                                    </div>
                                </div> -->    
                                <!-- <div class="col-md-3">
                                    <label class="lableTitle"for="isActive">Active/InActive :</label>
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="isActive" class="form-check-input" id="isActive">
                                        <label class="form-check-label" for="isActive">is Active</label>
                                    </div>
                                </div> -->                     
                            </div>                                
                            
                            <button type="submit" class="btn btn-info">Submit</button>
                            <a href="<?php echo base_url('userDocuments'); ?>" type="button" class="btn btn-warning">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    // $(".manageDocuments-Menu .inner").addClass("show");
    // $(".manageDocuments-Menu .toggle").addClass("activAcc");
    // $(".manageDocuments-Menu .inner").css("display", "block")
    $('.Document-Menu').addClass('active');
</script>
<script src="<?php echo base_url('assets/js/usersFormValidation.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
     $(document).ready(function() {
        $('#categoryID').on("change",function(){
        var dataid = $("#categoryID").val();
        var url = '<?php echo base_url('/userDocuments/getSubCat');?>';
            $.ajax({ 
                type: "POST",
                url: url,
                data: { dataid: dataid},
                success: function(data){
                    const subcat = JSON.parse(data);
                    $('select[name="subCategoryID"]').empty();
                        $.each(subcat, function(key, value){
                        $('select[name="subCategoryID"]').append('<option  value="'+ value.id +'">'+ value.SubCatName +'</option>');
                        });
                }
            });
    });
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
	$("#companyId").select2({
			  placeholder: "-- Select Company --",
			  allowClear: true		  
	});	  
</script>

