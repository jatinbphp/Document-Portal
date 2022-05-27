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

            <h3>Add Sub-Category</h3>

            <div class="item-wrap item-list-table">

                <div class="card">
                    <div class="card-body">
                        <form id="subcatFormAddEdit" method="POST" action="<?php echo base_url('subcategory/add') ?>" enctype="multipart/form-data">
                         
                            <div class="row">
                                <div class="col-md-12">
									
                                    <div class="form-group">
                                        <label class="lableTitle"for="">Category :<span class="asterisk-sign">*</span></label>
                                        <select name="subCategory" id="" class="form-control" REQUIRED>
											<option value="">-- Select Category --</option>
												<?php if(count($subcategory) > 0): ?>
													<?php foreach($subcategory as $key => $value): ?>
														<option value="<?php echo $value['id'] ?>"><?php echo $value['categoryName'] ?></option>
													<?php endforeach; ?>
												<?php endif; ?>
                                        </select>                                    
                                    </div>
                                    
                                    <div class="form-group">
										<label class="lableTitle"for="">Sub Category :<span class="asterisk-sign">*</span></label>                                     
                                        <input type="text" name="SubCatName" class="form-control" id="SubCatName" placeholder="Sub-Category Name">
                                    </div>
                                    
                                </div>
                            </div>
                            
                            
                            <button type="submit" class="btn btn-info">Submit</button>
                            <a href="<?php echo base_url('category'); ?>" type="button" class="btn btn-warning">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    // $(".SubCategory-Menu .inner").addClass("show");
    // $(".SubCategory-Menu .toggle").addClass("activAcc");
    // $(".SubCategory-Menu .inner").css("display", "block")
    $('.SubCategory-Menu').addClass('active');
</script>
<script src="<?php echo base_url('assets/js/usersFormValidation.js') ?>"></script>
