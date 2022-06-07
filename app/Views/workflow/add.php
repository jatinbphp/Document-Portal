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

            <h3>Add Workflow</h3>

            <div class="item-wrap item-list-table">

                <div class="card">
                    <div class="card-body">
                        <form id="documentFormAddEdit" method="post" action="<?php echo base_url('workflow/add'); ?>" enctype="multipart/form-data">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label class="lableTitle"for="document_name">Document Name :<span class="asterisk-sign">*</span></label>
                                         <input type="text" name="document_name" class="form-control" id="document_name" placeholder="Name">
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="lableTitle"for="usertype_id">Users type:<span class="asterisk-sign">*</span></label>
                                        <select name="usertype_id" id="usertype_id" class="form-control" REQUIRED>
                                            <option value="">-- Select Users --</option>
                                            <?php 
                                            if(count($users_type)>0){
                                                foreach ($users_type as $key => $value) { ?>
                                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['userTypeName']; ?></option>
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
                                        <label class="lableTitle"for="category_id">Category :<span class="asterisk-sign">*</span></label>
                                        <select name="category_id" id="category_id" class="form-control" REQUIRED>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="lableTitle"for="subcategory_id">Sub Category :<span class="asterisk-sign">*</span></label>
                                        <select name="subcategory_id" id="subcategory_id" class="form-control" REQUIRED>
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
                                    <!-- <div class="form-group">
                                        <label class="lableTitle"for="document_files">Documents : </label>
                                       
                                        <div class="kv-avatar">
                                            <div class="file-loading">
                                                <input id="document_files" name="document_files" type="file">
                                            </div>
                                            </br>
                                           
                                        </div>
                                        <label class="lableTitle"id="image-error" class="error" for="Document"></label>
                                    </div> -->
 
                                     <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row additionalImageClass">
                                        <div class="col-lg-12 mb-2">
                                            <h5><u>Add Additional Documents</u></h5>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                            <div class="boxImage imgUp">
                                                <div class="loader-contetn loader1">
                                                    <div class="loader-01"> </div>
                                                </div>
                                                <div class="imagePreview"></div>
                                                <label class="btn btn-primary">
                                                    Upload<input type="file" name="file[]" class="uploadFile img" id="file-1" value="Upload" style="width: 0px;height: 0px;overflow: hidden;" data-overwrite-initial="false" data-min-file-count="1">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 imgAdd">
                                            <div class="imagePreviewPlus imgUp"><i class="fa fa-plus fa-4x"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                </div>

                                 <div class="col-md-6">
                                    <div class="form-group">
                                         <label class="lableTitle"for="comments">Comments:<span class="asterisk-sign">*</span></label>
                                         <textarea name="comments" id ="comments" ></textarea>
                                        
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
        $(this).closest(".row").find('.imgAdd').before('<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" id="imgBox_'+i+'"><div class="boxImage imgUp"><div class="loader-contetn loader'+i+'"><div class="loader-01"> </div></div><div class="imagePreview"><div class="text-right" style="position: absolute;"><button class="btn btn-danger deleteReferenceImagesNew" data-id="'+i+'"><i class="fa fa-trash" aria-hidden="true"></i></button>'+'</div></div><label class="btn btn-primary">Upload<input type="file" id="file-'+i+'" class="uploadFile img" name="file[]" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;" data-overwrite-initial="false" data-min-file-count="1"></label></div></div>');

        i++;
    });

    $(document).on("click", ".deleteReferenceImagesNew" , function() {
        var id = $(this).data('id');
        $(document).find('#imgBox_'+id).remove(); 
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
</script>