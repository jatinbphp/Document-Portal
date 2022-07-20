<style>

       .loader-main {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
        display: none;
    }
    .loader-inner {
        width: 5rem;
        height: 5rem;
        display: inline-block;
        padding: 0px;
        border-radius: 100%;
        border: 10px solid;
        border-top-color: rgba(15, 148, 245, 1);
        border-bottom-color: #f3f3f7;
        border-left-color: rgba(15, 148, 245, 1);
        border-right-color: #f3f3f7;
        -webkit-animation: loader 1s ease-in-out infinite;
        animation: loader 1s ease-in-out infinite;
    }
    @keyframes loader {
        from {transform: rotate(0deg);}
        to {transform: rotate(360deg);}
    }
    @-webkit-keyframes loader {
        from {-webkit-transform: rotate(0deg);}
        to {-webkit-transform: rotate(360deg);}
    }
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
    #drag_drop{
    background-color : #f9f9f9;
    border : #ccc 4px dashed;
    line-height : 250px;
    padding : 12px;
    font-size : 24px;
    text-align : center;
}
 /*   #ddArea {
        height: 200px;
        border: 2px dashed #ccc;
        line-height: 200px;
        text-align: center;
        font-size: 20px;
        background: #f9f9f9;
        margin-bottom: 15px;
      }

      .drag_over {
        color: #000;
        border-color: #000;
      }

      .thumbnail {
        width: 100px;
        height: 100px;
        padding: 2px;
        margin: 2px;
        border: 2px solid lightgray;
        border-radius: 3px;
        float: left;
      }

      .d-none {
        display: none;
      }*/
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
                                <?php }
                                     } ?> 
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="lableTitle"for="comments"> Comments :<span class="asterisk-sign">*</span></label>
                                        <!-- <input type="text" name="comments" class="form-control" id="comments" placeholder="Name" value="<?php echo $docData['comments'];?>"> -->
                                        <textarea name="comments" id ="comments" ><?php echo $docData['comments'];?></textarea>
                                        <?php if($_SESSION['user_type'] == 3){ ?>
                                        <span class="error comments-error" style="display: none;">Please Enter Comments.</span>
                                      <?php   }?> 
                                    </div>
                                </div>
                                 <?php if($_SESSION['user_type'] == 3){ ?>
                                    <div class="row">
                                         <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="lableTitle"for="start_date">Start Date:<span class="asterisk-sign">*</span></label>
                                       <input type="date" name="start_date" class="form-control" id="start_date" placeholder="Start Date" value ="<?php echo date('Y-m-d',strtotime($docData['start_date'])); ?>">
                                       <?php if($_SESSION['user_type'] == 3){ ?>
                                        <span class="error substart_date-error" style="display: none;">Please select start date.</span>
                                     <?php   }?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="lableTitle"for="expire_date">Expire Date:<span class="asterisk-sign">*</span></label>
                                       <input type="date" name="expire_date" class="form-control" id="expire_date" placeholder="Expire Date" value="<?php echo date('Y-m-d',strtotime($docData['expire_date'])); ?>" >

                                       <span class="error expire_date-error" style="display: none;">Please select expire date.</span>
                                     <?php if($_SESSION['user_type'] == 3){ ?>
                                        <span class="error subexpire_date-error" style="display: none;">Please select expire date.</span>
                                      <?php   }?>  
                                    </div>
                                </div>
                                    </div>
                               <?php  }else{ ?>
                                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="lableTitle"for="start_date">Start Date:<span class="asterisk-sign11"></span></label>
                                       <input type="date" name="start_date" class="form-control" id="start_date" placeholder="Start Date" value ="<?php echo date('Y-m-d',strtotime($docData['start_date'])); ?>">
                                       <?php if($_SESSION['user_type'] == 3){ ?>
                                        <span class="error substart_date-error" style="display: none;">Please select start date.</span>
                                     <?php   }?>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="lableTitle"for="expire_date">Expire Date:<span class="asterisk-sign11"></span></label>
                                       <input type="date" name="expire_date" class="form-control" id="expire_date" placeholder="Expire Date" value="<?php echo date('Y-m-d',strtotime($docData['expire_date'])); ?>" >

                                       <span class="error expire_date-error" style="display: none;">Please select expire date.</span>
                                     <?php if($_SESSION['user_type'] == 3){ ?>
                                        <span class="error subexpire_date-error" style="display: none;">Please select expire date.</span>
                                      <?php   }?>  
                                    </div>
                                </div>
                                <?php }?>
                                  <?php   if($_SESSION['logged_in'] == 1){ 
                if($_SESSION['user_type'] == 0|| $_SESSION['user_type'] == 2){ ?>
                                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="lableTitle"for="is_active">Approve/Disapprove :<span class="asterisk-sign11"></span></label>
                                      <div class="form-group form-check">
                                        <input type="checkbox" name="is_active" class="form-check-input" id="is_active" <?php echo ($docData['is_active'] == 1)?"checked":""; ?>>
                                        <label class="form-check-label" for="is_active">is Approve</label>
                                    </div>
                                    </div>
                                </div>
                                
                                <!--start table-->
                               
                                <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <table class="table">
										  <thead class="thead-dark">
											<tr>
											  <th scope="col" style="width: 10%">#<?php $counter = 1 ?></th>
											  <th scope="col" style="width: 70%">File Name</th>
											  <th scope="col" style="width: 20%">Action</th>
											</tr>
										  </thead>
										  <tbody>
											  <?php if(!empty($documents)): ?> 
												<?php foreach($documents as $value): ?>
													<tr>
														<td scope="row"><?php echo $counter++ ?></td>
														<td><?php echo $value['documents'] ?></td>
														<td><a href = "<?php echo base_url( '/uploads/workflow/'.$value['documents']) ?>" class="btn btn-primary" style="margin: 0px 5px 5px 0px;padding: 4px 9px;font-size: 14px;" target="_blank"><i class="fa fa-file"></i></a></td>
													</tr>
													<?php endforeach ?>
												<?php endif ?>
												
												<?php if(empty($documents)): ?> 
													<tr><td colspan = "3" style="text-align: center;">No data available<td></tr>
												<?php endif ?>
												
												</tbody>
										  
										</table>  
                                    </div>
                                </div>
                              <!--end table-->  
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
                                        <div class="imagePreview" id="imagePreview-1"></div>
                                        <label class="w-100 btn btn-info">
                                        Upload<input type="file" name="file[]" multiple="multiple" class="uploadFile img" id="file-1" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;" data-overwrite-initial="false" data-min-file-count="1">
                                        </label>
                                         <p class='error elements' id="element-1"></p>
                                         <span class="error uploadImg-error" style="display: none;">Please select expire date.</span>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12 imgAdd">
                                    <div class="imagePreviewPlus"><i class="fa fa-plus fa-3x"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                   <!--  <div id="ddArea">
    Drag and Drop Files Here -->
   <!--  <a class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
        Select File(s)
    </a> -->
<!-- </div>
<div id="showThumb"></div> -->

<div class="container">
           <!--  <h1 class="mt-5 mb-5 text-center text-primary"><b>Drag & Drop Upload Multiple File with Progress Bar using JavaScript in PHP</b></h1> -->

            <div class="card">
                <div class="card-header">Drag & Drop File Here</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">&nbsp;</div>
                        <div class="col-md-6">
                            <div id="drag_drop">Drag & Drop File Here</div>
                        </div>
                        <div class="col-md-3">&nbsp;</div>
                    </div>
                </div>
            </div>
            <br />
            <div class="progress" id="progress_bar" style="display:none; height:50px;">
                <div class="progress-bar bg-success" id="progress_bar_process" role="progressbar" style="width:0%; height:50px;">0%

                </div>
            </div>
            <div id="uploaded_image" class="row mt-5"></div>
        </div>
<input type="file" class="d-none" id="selectfile" multiple />

                <?php } ?>
                    <hr>
                    <?php if($_SESSION['user_type'] == 3){ ?>
                         <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-info mr-2 savebtn">Submit</button>
                        <a href="<?php echo base_url('workflow'); ?>" type="button" class="btn btn-warning">Back</a>
                    </div>
                  <?php  } else{ ?>
                        <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-info mr-2">Submit</button>
                        <a href="<?php echo base_url('workflow'); ?>" type="button" class="btn btn-warning">Back</a>
                    </div>
                <?php   }?>
                   
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

 <script>
    $(document).ready(function() {
        $('button.savebtn').on("click",function() {
           // $('.loader-main').css('display','flex');
        });
    });
</script> 
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
     $(this).closest(".row").find('.imgAdd').before('<div class="col-lg-2 col-md-3 col-sm-6 col-xs-12"><div class="boxImage imgUp"><div class="loader-contetn loader'+i+'"><div class="loader-01"> </div></div><div class="imagePreview" id="imagePreview-'+i+'"></div><label class="w-100 btn btn-primary">Upload<input type="file" id="file-'+i+'" class="uploadFile img" name="file[]" multiple="multiple"  value="Upload Photo" style="width:0px;height:0px;overflow:hidden;" data-overwrite-initial="false" data-min-file-count="1"></label><p class="error elements" id="element-'+i+'"></p></div></div>');
    
     i++;
    });
    $(document).on("click", "i.del" , function() {
       $(this).parent().remove();
    });
    
    $(function() {
       $(document).on("change",".uploadFile", function(e)
       {

            /*$.each('.elements', function() { 
               alert($(this).attr('id'))
            });*/
            //alert($(this).attr('id'));
            var fileid = $(this).attr('id');
            var items = fileid.split('-');

            var geekss = e.target.files[0].name;
            //alert(geekss);
            $('#imagePreview-'+items[1]).text(geekss);

            var imageSizeArr = 0;
            var imageSize = document.getElementById(fileid);
            var imageCount = imageSize.files.length;
            for (var i = 0; i < imageSize.files.length; i++)
            {
                var imageSize = imageSize.files[i].size;
                    if (imageSize > 20000000) {
                        var imageSizeArr = 1;
                    }
                if (imageSizeArr == 1)
                {
                   $('#element-'+items[1]).text('Maximum file size to upload is 20MB');
                   $(".savebtn").attr('disabled','disabled');
                   
                }
                else if (imageSizeArr == 0)
                {
                     $('#element-'+items[1]).text('');
                   $('.savebtn').removeAttr('disabled');
                }
            }
         
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
            var expire_date = $("#expire_date").val();
            if(expire_date == ''){
                $("#expire_date").focus();
                $(".subexpire_date-error").css("display", "");
                return false;
            }
            else{
                 $(".subexpire_date-error").css("display", "none");
            }
        }); 

        //  var expire_dateset1 = $("#expire_date").val();
        // if(expire_dateset1 != ''){
        //     $('#is_active').prop('checked', true);
        // }
        // else{
        //    $('#is_active').prop('checked', false);  
        // }
        // 
        // 
        



      /*  $(document).on("change",".uploadFile", function(e)
        {

            var ids = $(this).attr('id');

            var fileid = $(this).attr('id');
            var items = fileid.split('-');

            alert(items[1]);
             
            var imageSizeArr = 0;
            var imageSize = document.getElementById(ids);
            var imageCount = imageSize.files.length;
            for (var i = 0; i < imageSize.files.length; i++)
            {
                var imageSize = imageSize.files[i].size;
                    if (imageSize > 20000000) {
                        var imageSizeArr = 1;
                    }
                if (imageSizeArr == 1)
                {
                   $('#element-'+items[1]).text('Maximum file size to upload is 20MB');
                   $(".savebtn").attr('disabled','disabled');
                   
                }
                else if (imageSizeArr == 0)
                {
                     $('#element-'+items[1]).text('');
                   $('.savebtn').removeAttr('disabled');
                }
            }
         }); */
    });  

    $('#start_date').on("change",function(){
       
         var start_date = $("#start_date").val();
        if(start_date == ''){
            $("#start_date").focus();
            $(".substart_date-error").css("display", "");
            return false;
        }
        else{
             $(".substart_date-error").css("display", "none");
        }
    });

    $('.savebtn').click(function(){
        var start_date = $("#start_date").val();
        if(start_date == ''){
            $("#start_date").focus();
            $(".substart_date-error").css("display", "");
            
            return false;
        }
        else{
             $(".substart_date-error").css("display", "none");
             var dt1 = 1;
        }

         var expire_date = $("#expire_date").val();
            if(expire_date == ''){
                $("#expire_date").focus();
                $(".subexpire_date-error").css("display", "");
               
                return false;
            }
            else{
                 $(".subexpire_date-error").css("display", "none");
                  var dt2 = 1;
            }

            var comment = $("#comments").val();
            if(comment == ''){
                $("#comments").focus();
                $(".comments-error").css("display", "");
                
                return false;
            }
            else{
                 $(".comments-error").css("display", "none");
                 var dt3 =1;
            }
            if(dt1 == 1 && dt2 == 1 && dt3 == 1){
                $('.loader-main').css('display','flex');
            }



    });

 
 $(document).ready(function() {
        // $("#ddArea").on("dragover", function() {
        //   $(this).addClass("drag_over");
        //   return false;
        // });

        // $("#ddArea").on("dragleave", function() {
        //   $(this).removeClass("drag_over");
        //   return false;
        // });

        // // $("#ddArea").on("click", function(e) {
        // //   file_explorer();
        // // });

        // $("#ddArea").on("drop", function(e) {
        //   e.preventDefault();
        //   $(this).removeClass("drag_over");
        //   var formData = new FormData();
        //   var files = e.originalEvent.dataTransfer.files;
          
        //   for (var i = 0; i < files.length; i++) {
        //     formData.append("file[]", files[i]);
        //   }
        
        //   uploadFormData(formData);
        // });

        // function file_explorer() {
        //   document.getElementById("selectfile").click();
        //   document.getElementById("selectfile").onchange = function() {
        //     files = document.getElementById("selectfile").files;
        //     var formData = new FormData();

        //     for (var i = 0; i < files.length; i++) {
        //       formData.append("file[]", files[i]);
        //     }
        //     uploadFormData(formData);
        //   };
        // }

        // function uploadFormData(form_data) {
        //   $(".loading")
        //     .removeClass("d-none")
        //     .addClass("d-block");
        //   $.ajax({
        //     url: baseurl+"/workflow/drag_drop",
        //     //url: " ",
        //     method: "POST",
        //     data: form_data,
        //     contentType: false,
        //     cache: false,
        //     processData: false,
        //     success: function(data) {
        //       $(".loading")
        //         .removeClass("d-block")
        //         .addClass("d-none");
        //       $("#showThumb").append(data);
        //     }
        //   });
        // }
// $('#ddArea').on('dragenter', function (e) {
//     alert("Fdsfsf");
//     var files = e.originalEvent.dataTransfer.files;
          
//           for (var i = 0; i < files.length; i++) {


//             console.log(e.originalEvent.dataTransfer.files[i]);
//           }
    
//     // var file1 = e.originalEvent.dataTransfer.files;
//     // console.log(file1);exit;

//     e.preventDefault();
//     e.stopPropagation();
// });
      });


function _(element)
{
    return document.getElementById(element);
}

_('drag_drop').ondragover = function(event)
{
    this.style.borderColor = '#333';
    return false;
}

_('drag_drop').ondragleave = function(event)
{
    this.style.borderColor = '#ccc';
    return false;
}


_('drag_drop').ondrop = function(event)
{
    event.preventDefault();

    var form_data  = new FormData();

    var image_number = 1;

    var error = '';

    var drop_files = event.dataTransfer.files;


    for(var count = 0; count < drop_files.length; count++)
    {
        console.log(drop_files[count].type);
       
        if(['image/jpeg', 'image/png','image/jpg','image/gif','image/svg', 'text/html', 'application/x-php','text/javascript','text/css','video/mp4'].includes(drop_files[count].type))
        {
            error += '<div class="alert alert-danger"><b>'+image_number+'</b> Selected File must be .pdf or .xlsx or .csv or .xlsx or .xls or .doc or .docx Only</div>';
           $(".savebtn").attr('disabled','disabled');

        }else if(drop_files[count].type == ''){
            error += '<div class="alert alert-danger"><b>'+image_number+'</b> Selected File must be .pdf or .xlsx or .csv or .xlsx or .xls or .doc or .docx Only</div>';
           $(".savebtn").attr('disabled','disabled');

        }else if(drop_files[count].size > 20000000){
            error += '<div class="alert alert-danger"><b>'+image_number+'</b> Maximum file size to upload is 20 MB</div>';
           $(".savebtn").attr('disabled','disabled');
        }else
        {
            form_data.append("images[]", drop_files[count]);
        }

        image_number++;
    }

    if(error != '')
    {
        _('uploaded_image').innerHTML = error;
        _('drag_drop').style.borderColor = '#ccc';
    }
    else
    {
        _('progress_bar').style.display = 'block';

        var ajax_request = new XMLHttpRequest();
        var url1 = window.location.href;
       var parts = url1.split('/');
        var lastSegment = parts.pop() || parts.pop();  // handle potential trailing slash

        
         $url =  baseurl+"/workflow/drag_drop_validation";
        ajax_request.open("post", $url);

        ajax_request.upload.addEventListener('progress', function(event){

            var percent_completed = Math.round((event.loaded / event.total) * 100);

            _('progress_bar_process').style.width = percent_completed + '%';

            _('progress_bar_process').innerHTML = percent_completed + '% completed';

        });

        ajax_request.addEventListener('load', function(event){

            _('uploaded_image').innerHTML = '<div class="alert alert-success">Files Uploaded Successfully</div>';

            _('drag_drop').style.borderColor = '#ccc';

            $('.savebtn').removeAttr('disabled');

        });

        ajax_request.send(form_data);
    }
}
</script>
