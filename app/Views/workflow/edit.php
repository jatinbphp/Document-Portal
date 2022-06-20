<style>
    .imagePreview {
        width: 100%;
        /*height: 180px;*/
        height: 120px;
        background-position: center center;
        background: url();
        background-color: #fff; 
        background-size: cover; 
        background-repeat: no-repeat; 
        display: inline-block; 
        box-shadow: 0 -3px 6px 2px rgb(0 0 0 / 20%); 
    }
    .imagePreviewPlus{width:100%;/*height:230px;*/height:164px;background-position:center center;background-color:#fff;background-size:cover;background-repeat:no-repeat;display:inline-block;box-shadow:0 -3px 6px 2px rgba(0,0,0,0.2);display:flex;align-content:center;justify-content:center;align-items:center}
    .imgUp{margin-bottom:15px}
    .del{position:absolute;top:0;right:15px;width:30px;height:30px;text-align:center;line-height:30px;background-color:rgba(255,255,255,0.6);cursor:pointer}
    .additionalImageClass input[type=file]{display: contents;}
    .removeImage {position: absolute; top: 0; right: 0; margin-right: 15px;}
    .additionalImageClass .col-md-3{margin-bottom: 20px;}
    .form-boxes-design form .card {height: 100%;}
    /*.form-boxes-design form .row .col-lg-6:last-child {padding-left: 8px;}
    .form-boxes-design form .row .col-lg-6:first-child {padding-right: 8px;}*/
    .form-boxes-design form .row .col-lg-6 .row .col-lg-6 {padding: 0px 15px;}
    a.icon-btn, button.icon-btn {
        padding: 0px;
        width: 30px;
        height: 30px;
        line-height: 30px;
        font-size: 15px;
        color: #fff;
        margin: 0px !important;
    }
    .form-boxes-design button.deleteReferenceImagesNew, .form-boxes-design button.removeImage {
        border-color: transparent;
        background-color: transparent;
        color: #dc3545;
    }
    .imagePreviewPlus i {
        cursor: pointer;
    }
    @media screen and (max-width: 767px) {
        /*.form-boxes-design form .row .col-lg-6:first-child {padding-right: 15px;}
        .form-boxes-design form .row .col-lg-6:last-child {padding-left: 15px;}*/
        .productsAttributes {width: 100%;}
        .col {min-width: 100%;}
        .variationCounter .add_more_variation {margin: 15px 0px;}
    }
</style>
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
            <h3>Edit Workflow</h3>
            <div class="item-wrap item-list-table form-boxes-design">
                <form id="workflowFormAddEdit" method="post" action="<?php echo base_url('workflow/edit/'.$docData['id']); ?>" enctype="multipart/form-data">

    <?php   if($_SESSION['logged_in'] == 1){ 
                if($_SESSION['user_type'] == 0|| $_SESSION['user_type'] == 2){ ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="lableTitle"for="document_name"> Document Name :<span class="asterisk-sign">*</span></label>
                                        <input type="text" name="document_name" class="form-control" id="document_name" placeholder="Name" value="<?php echo $docData['document_name'];?>">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="lableTitle"for="email">Users Type:<span class="asterisk-sign">*</span></label>
                                        <select name="usertype_id" id="usertype_id" class="form-control" REQUIRED>
                                            <option value="">-- Select Users Type --</option>
                                            <?php 
                                                if(count($users_type)>0){
                                                    foreach ($users_type as $key => $value) { ?>
                                            <option value="<?php echo $value['id']; ?>"<?php if($docData['usertype_id']==$value['id']){ echo "selected";} ?>><?php echo $value['userTypeName'] ; ?></option>
                                            <?php
                                                }
                                                } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="lableTitle"for="firstName">Category :<span class="asterisk-sign">*</span></label>
                                        <select name="category_id" id="category_id" class="form-control" REQUIRED>
                                            <option value="">-- Select Category --</option>
                                            <?php 
                                                if(count($category)>0){
                                                    foreach ($category as $key => $value) { ?>
                                            <option value="<?php echo $value['id']; ?>" <?php if($docData['category_id']==$value['id']){ echo "selected";} ?>><?php echo $value['categoryName']; ?></option>
                                            <?php
                                                }
                                                } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="lableTitle"for="lastName">Sub Category :<span class="asterisk-sign">*</span></label>
                                        <select name="subcategory_id" id="subcategory_id" class="form-control" REQUIRED>
                                            <option value="">-- Select Sub Category --</option>
                                            <?php 
                                                if(count($subCategory)>0){
                                                    foreach ($subCategory as $key => $value) { ?>
                                            <option value="<?php echo $value['id']; ?>"  <?php if($docData['subcategory_id']==$value['id']){ echo "selected";} ?>><?php echo $value['SubCatName']; ?></option>
                                            <?php
                                                }
                                                } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="lableTitle"for="lastName">Company :<span class="asterisk-sign">*</span></label>
                                        <select name="company_id" id="company_id" class="form-control" REQUIRED>
                                            <option value="">-- Select Company --</option>
                                            <?php 
                                                if(count($company)>0){
                                                    foreach ($company as $key => $value) { ?>
                                            <option value="<?php echo $value['id']; ?>"  <?php if($docData['company_id']==$value['id']){ echo "selected";} ?>><?php echo $value['companyName']; ?></option>
                                            <?php
                                                }
                                                } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="lableTitle"for="comments"> Comments :<span class="asterisk-sign">*</span></label>
                                        <!-- <input type="text" name="comments" class="form-control" id="comments" placeholder="Name" value="<?php echo $docData['comments'];?>"> -->
                                        <textarea name="comments" id ="comments" ><?php echo $docData['comments'];?></textarea>
                                    </div>
                                </div>
                                <?php }
                                     } ?>  
                                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="lableTitle"for="start_date">Start Date:<span class="asterisk-sign">*</span></label>
                                       <input type="date" name="start_date" class="form-control" id="start_date" placeholder="Start Date" value ="<?php echo date('Y-m-d',strtotime($docData['start_date'])); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="lableTitle"for="expire_date">Expire Date:<span class="asterisk-sign">*</span></label>
                                       <input type="date" name="expire_date" class="form-control" id="expire_date" placeholder="Expire Date" value="<?php echo date('Y-m-d',strtotime($docData['expire_date'])); ?>" >

                                       <span class="error expire_date-error" style="display: none;">Please select expire date.</span>
                                    </div>
                                </div>

                                  <?php   if($_SESSION['logged_in'] == 1){ 
                if($_SESSION['user_type'] == 0|| $_SESSION['user_type'] == 2){ ?>
                                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="lableTitle"for="is_active">Approve/Disapprove :<span class="asterisk-sign">*</span></label>
                                      <div class="form-group form-check">
                                        <input type="checkbox" name="is_active" class="form-check-input" id="is_active" <?php echo ($docData['is_active'] == 1)?"checked":""; ?>>
                                        <label class="form-check-label" for="is_active">is Approve</label>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

          <?php }
            } ?>   

                <?php if($_SESSION['user_type'] == 3){?>
                    Document Name: <input type="text" name="document_name" class="form-control" id="document_name" placeholder="Name" value="<?php echo $docData['document_name'];?>" readonly= "readonly">
                                 <br> 
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row additionalImageClass">
                                <div class="col-lg-12 mb-2">
                                    <u>
                                        <h5>Add Additional Documents</h5>
                                    </u>
                                </div>

                                <?php 
                                    if (!empty($documents)) {
                                        foreach ($documents as $key => $value) { ?>
                                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                                    <div class="imagePreviewPlus">
                                        <div class="text-right">
                                            <button type="button" class="btn btn-danger removeImage" onclick="removeAdditionalProductImg('<?php echo $value['documents']; ?>','<?php echo $value['id']; ?>','<?php echo $value['workflow_id']; ?>');"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        </div>
                                        <div class="w-100 p-2"><p style="word-break: break-word;"><?php echo $value['documents']; ?></p></div>
                                        <!-- <img style="width: inherit; height: inherit;" src="<?php echo base_url('uploads/workflow/'.$value['documents']); ?>" alt=""> -->
                                    </div>
                                </div>
                                <?php 
                                    }
                                    } ?>
                                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                                    <div class="boxImage imgUp">
                                        <div class="loader-contetn loader1">
                                            <div class="loader-01"> </div>
                                        </div>
                                        <div class="imagePreview"></div>
                                        <label class="w-100 btn btn-info">
                                        Upload<input type="file" name="file[]" class="uploadFile img" id="file-1" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;" data-overwrite-initial="false" data-min-file-count="1">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12 imgAdd">
                                    <div class="imagePreviewPlus"><i class="fa fa-plus fa-3x"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                    <hr>
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-info mr-2">Submit</button>
                        <a href="<?php echo base_url('workflow'); ?>" type="button" class="btn btn-warning">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    // $(".manageWorkflow-Menu .inner").addClass("show");
    // $(".manageWorkflow-Menu .toggle").addClass("activAcc");
    // $(".manageWorkflow-Menu .inner").css("display", "block")
    $('.Workflow-Menu').addClass('active');
</script>
<script src="<?php echo base_url('assets/js/usersFormValidation.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('#category_id').on("change",function(){
       var dataid = $("#category_id").val();
       var url = '<?php echo base_url('/workflow/getSubCat');?>';
           $.ajax({ 
               type: "POST",
               url: url,
               data: { dataid: dataid},
               success: function(data){
                   const subcat = JSON.parse(data);
                   $('select[name="subcategory_id"]').empty();
                       $.each(subcat, function(key, value){
                       $('select[name="subcategory_id"]').append('<option  value="'+ value.id +'">'+ value.SubCatName +'</option>');
                       });
               }
           });
    });
    
        var i = 2;
    $(".imgAdd").click(function(){
     $(this).closest(".row").find('.imgAdd').before('<div class="col-lg-2 col-md-3 col-sm-6 col-xs-12"><div class="boxImage imgUp"><div class="loader-contetn loader'+i+'"><div class="loader-01"> </div></div><div class="imagePreview"></div><label class="w-100 btn btn-primary">Upload<input type="file" id="file-'+i+'" class="uploadFile img" name="file[]" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;" data-overwrite-initial="false" data-min-file-count="1"></label></div></div>');
    
     i++;
    });
    $(document).on("click", "i.del" , function() {
       $(this).parent().remove();
    });
    
    $(function() {
       $(document).on("change",".uploadFile", function(e)
       {
               var geekss = e.target.files[0].name;
            $('.imagePreview').text(geekss);
         
       });
    });
    });
    
    function removeAdditionalProductImg(doc_name, doc_id, workflow_id)
    {
     
       swal({
               title: "Are you sure?",
               text: "Delete Addition Documents",
               type: "warning",
               showCancelButton: true,
               confirmButtonColor: '#DD6B55',
               confirmButtonText: 'Yes, Delete',
               cancelButtonText: "No, cancel",
               closeOnConfirm: false,
               closeOnCancel: false
           },
       function(isConfirm) {
           if (isConfirm) {
               window.location.href = '<?php echo base_url("workflow/deleteAdditionalProductImg"); ?>'+'/'+doc_name+'/'+doc_id+'/'+workflow_id;
           } else {
               swal("Cancelled", "Your data safe!", "error");
           }
       });
    }
    
</script>
<script type="text/javascript">
    $(document).ready(function() {
        
        $('#is_active').click(function(){
            var approve = $('input:checkbox[name=is_active]').is(':checked');
            if(approve == true){
               var expire_date = $("#expire_date").val();
                if(expire_date == ''){
                    $("#expire_date").focus();
                    $(".expire_date-error").css("display", "");
                    return false;
                } else {
                    $(".expire_date-error").css("display", "none");
                   // $(".is_active-error").css("display", "none");
                   // $('#is_active').is(":checked");
                }
            }
            else{
               $('#expire_date').val('');
            }
            

        });   

         $('#expire_date').on("change",function(){
            var isapprove = $('input:checkbox[name=is_active]').is(':checked');
            if(isapprove == false){
                var expire_dateset = $("#expire_date").val();
                if(expire_dateset != ''){
                    $('#is_active').prop('checked', true);
                }
               
                $(".expire_date-error").css("display", "none");
            }
         }); 

        //  var expire_dateset1 = $("#expire_date").val();
        // if(expire_dateset1 != ''){
        //     $('#is_active').prop('checked', true);
        // }
        // else{
        //    $('#is_active').prop('checked', false);  
        // }
    });  
</script>
