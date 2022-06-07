<style type="text/css">

.imagePreview {
    width: 100%;
    height: 180px;
    background-position: center center;
    background: url(http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg);
    background-color: #fff; 
    background-size: cover; 
    background-repeat: no-repeat; 
    display: inline-block; 
    box-shadow: 0 -3px 6px 2px rgb(0 0 0 / 20%); 
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

            <div class="item-wrap item-list-table">

                <div class="card">
                    <div class="card-body">
                        <form id="workflowFormAddEdit" method="post" action="<?php echo base_url('workflow/edit/'.$docData['id']); ?>" enctype="multipart/form-data">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label class="lableTitle"for="document_name"> Document Name :<span class="asterisk-sign">*</span></label>
                                         <input type="text" name="document_name" class="form-control" id="document_name" placeholder="Name" value="<?php echo $docData['document_name'];?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                              
                            </div>

                            <div class="row">
                                <div class="col-md-6">
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
                                <div class="col-md-6">
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
                                
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row additionalImageClass">
                                        <div class="col-lg-12 mb-2">
                                        <div class="col-md-6"><u><h5>Add Additional Documents</h5></u></div>
                                    </div> 

                                <?php 
                                if (!empty($documents)) {
                                    foreach ($documents as $key => $value) { ?>
                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                            <div class="imagePreviewPlus">
                                                <div class="text-right">
                                                    <button type="button" class="btn btn-danger removeImage" onclick="removeAdditionalProductImg('<?php echo $value['documents']; ?>','<?php echo $value['id']; ?>','<?php echo $value['workflow_id']; ?>');"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                </div>
                                                <div><?php echo base_url('uploads/workflow/'.$value['documents']); ?></div>
                                                <!-- <img style="width: inherit; height: inherit;" src="<?php echo base_url('uploads/workflow/'.$value['documents']); ?>" alt=""> -->
                                            </div>
                                        </div>
                                    <?php 
                                    }
                                } ?>

                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <div class="boxImage imgUp">
                                        <div class="loader-contetn loader1">
                                            <div class="loader-01"> </div>
                                        </div>
                                        <div class="imagePreview"></div>
                                        <label class="btn btn-info">
                                            Upload<input type="file" name="file[]" class="uploadFile img" id="file-1" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;" data-overwrite-initial="false" data-min-file-count="1">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 imgAdd">
                                    <div class="imagePreviewPlus"><i class="fa fa-plus fa-4x"></i></div>
                                </div>
                            </div>
                        </div></div></div></div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label class="lableTitle"for="comments"> Comments :<span class="asterisk-sign">*</span></label>
                                         <input type="text" name="comments" class="form-control" id="comments" placeholder="Name" value="<?php echo $docData['comments'];?>">
                                    </div>
                                </div>
                                                
                            </div>                                
                            
                            <button type="submit" class="btn btn-info">Submit</button>
                            <a href="<?php echo base_url('workflow'); ?>" type="button" class="btn btn-warning">Back</a>
                        </form>
                    </div>
                </div>
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
      $(this).closest(".row").find('.imgAdd').before('<div class="col-md-3"><div class="boxImage imgUp"><div class="loader-contetn loader'+i+'"><div class="loader-01"> </div></div><div class="imagePreview"></div><label class="btn btn-primary">Upload<input type="file" id="file-'+i+'" class="uploadFile img" name="file[]" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;" data-overwrite-initial="false" data-min-file-count="1"></label></div></div>');

      i++;
    });
    $(document).on("click", "i.del" , function() {
        $(this).parent().remove();
    });

    $(function() {
        $(document).on("change",".uploadFile", function()
        {
                var uploadFile = $(this);
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
     
            if (/^image/.test( files[0].type)){ // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file
     
                reader.onloadend = function(){ // set image data as background of div
                    //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                    uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url("+this.result+")");
                }
            }
          
        });
    });
});

    function removeAdditionalProductImg(doc_name, doc_id, workflow_id)
    {
      
        swal({
                title: "Are you sure?",
                text: "Delete Addition Product Image",
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
