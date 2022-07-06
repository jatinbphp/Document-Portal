<style type="text/css">
    #image-error{color: red;}
</style>

<div class="loader-main">
    <div class="loader-inner"></div>
</div>
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

            <h3>Edit Documents</h3>

            <div class="item-wrap item-list-table">

                <div class="card">
                    <div class="card-body">
                        <form id="documentFormEdit" method="post" action="<?php echo base_url('documents/edit/'.$docData['id']); ?>" enctype="multipart/form-data">
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                         <label class="lableTitle"for="docName">Name :<span class="asterisk-sign">*</span></label>
                                         <input type="text" name="docName" class="form-control" id="docName" placeholder="Name" value="<?php echo $docData['docName'];?>">
                                        
                                    </div>
                                </div>

                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="lableTitle"for="email">Company:<span class="asterisk-sign"></span></label>
                                        <select name="companyID" id="companyID" class="form-control">
                                            <option value="">-- Select Company --</option>
                                            <?php 
                                            if(count($company)>0){
                                                foreach ($company as $key => $value) { ?>
                                                    <option value="<?php echo $value['id']; ?>"<?php if($docData['companyID']==$value['id']){ echo "selected";} ?>><?php echo $value['companyName'] ; ?></option>
                                                <?php
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="lableTitle"for="email">Users:<span class="asterisk-sign"></span></label>
                                        <select name="userID" id="userID" class="form-control">
                                            <option value="">-- Select Users --</option>
                                            <?php 
                                            if(count($users)>0){
                                                foreach ($users as $key => $value) { ?>
                                                    <option value="<?php echo $value['id']; ?>"<?php if($docData['userID']==$value['id']){ echo "selected";} ?>><?php echo $value['firstName'].' ' .$value['lastName'] ; ?></option>
                                                <?php
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                </div> 
                               
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="lableTitle"for="firstName">Category :<span class="asterisk-sign">*</span></label>
                                        <select name="categoryID" id="categoryID" class="form-control" REQUIRED>
                                            <option value="">-- Select Category --</option>
                                            <?php 
                                            if(count($category)>0){
                                                foreach ($category as $key => $value) { ?>
                                                    <option value="<?php echo $value['id']; ?>" <?php if($docData['categoryID']==$value['id']){ echo "selected";} ?>><?php echo $value['categoryName']; ?></option>
                                                <?php
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="lableTitle"for="lastName">Sub Category :<span class="asterisk-sign">*</span></label>
                                        <select name="subCategoryID" id="subCategoryID" class="form-control" REQUIRED>
                                            <option value="">-- Select Sub Category --</option>
                                            <?php 
                                            if(count($subCategory)>0){
                                                foreach ($subCategory as $key => $value) { ?>
                                                    <option value="<?php echo $value['id']; ?>"  <?php if($docData['subCategoryID']==$value['id']){ echo "selected";} ?>><?php echo $value['SubCatName']; ?></option>
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
                                                <input id="docFile" name="docFile" type="file" value="<?php if (!empty($docData['docFile'])){ echo $docData['docFile']; } ?>">
                                            </div>
                                            <div><?php echo $docData['docFile']; ?></div>
                                            </br>
                                            <!-- <?php
                                            $img_thumnail = '';
                                            $img_thumnail = base_url('assets/images/default.png'); ?>

                                            <img style="border: 1px solid #eee; padding: 5px;" id="thumbnail_img" width="100" height="100" src="<?php echo $img_thumnail; ?>"> -->
                                        </div>
                                        <label class="lableTitle"id="image-error" class="error" for="Document"></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="lableTitle"for="expireDate">Expire Date :</label>
                                    <div class="form-group form-check">
                                       <input type="date" name="expireDate" class="form-check-input" id="expireDate" value="<?php echo date('Y-m-d',strtotime($docData['expireDate'])); ?>">
                                        
                                    </div>
                                </div> 
                                <div class="col-md-3">
                                    <label class="lableTitle"for="isActive">Active/InActive :</label>
                                    <div class="form-group form-check">
                                         <input type="checkbox" name="isActive" class="form-check-input" id="isActive" <?php echo ($docData['isActive'] == 1)?"checked":""; ?>>
                                        <label class="form-check-label" for="isActive">is Active</label>
                                    </div>
                                </div>                     
                            </div>                                
                            
                            <button type="submit" class="btn btn-info savebtn">Submit</button>
                            <a href="<?php echo base_url('documents'); ?>" type="button" class="btn btn-warning">Back</a>
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
        var url = '<?php echo base_url('/documents/getSubCat');?>';
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

    $('#companyID').on("change",function(){
        var compid = $('#companyID').val();
        var url = '<?php echo base_url('/documents/getUser');?>';

        $.ajax({ 
            type: "POST",
            url: url,
            data: { compid: compid},
            success: function(data){

            const user = JSON.parse(data);
             $('select[name="userID"]').empty();
              $('select[name="userID"]').prepend("<option value=' '>-- Select Users --</option>");
            $.each(user, function(key, value){

                    $('select[name="userID"]').append('<option  value="'+ value.id +'">'+ value.firstName + ' '+value.lastName+ '</option>');
                    });
                
            }
        });
    });

     $("input[type='file']").on("change", function () {
        var imageSizeArr = 0;
         if(this.files[0].size > 20000000) {
            var imageSizeArr = 1;
         }
         if (imageSizeArr == 1)
            {
               $('#image-error').text('Maximum file size to upload is 20MB');
               $(".savebtn").attr('disabled','disabled');
               
            }
            else if (imageSizeArr == 0)
            {
                 $('#image-error').text('');
               $('.savebtn').removeAttr('disabled');
            }
    });

     $('button.savebtn').on("click",function() {
           // $('.loader-main').css('display','flex');
             var docName = $("#docName").val();
            if(docName != ''){
                var dt1 =1;
            }
             var categoryID = $("#categoryID").val();
            if(categoryID != ''){
                var dt2 =1;
            }
             var subCategoryID = $("#subCategoryID").val();  
            if(subCategoryID != ''){
                var dt3 =1;
            }
            var docFile = $("#docFile").val();  
            if(docFile != ''){
                var dt4 =1;
            }
            
            if(dt1 == 1 && dt2 == 1 && dt3 == 1 && dt4 ==1) {
                $('.loader-main').css('display','flex');
            }
        });
});
</script>
