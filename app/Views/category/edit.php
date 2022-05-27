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

            <h3>Add Category</h3>

            <div class="item-wrap item-list-table">

                <div class="card">
                    <div class="card-body">
                        <form id="categoryFormAddEdit" method="post" action="<?php echo base_url('category/edit/'.$category['id']); ?>" enctype="multipart/form-data">
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="lableTitle"for="categoryName">Category Name :<span class="asterisk-sign">*</span></label>
                                        <input type="text" name="categoryName" class="form-control" id="categoryName" value="<?php echo $category['categoryName'] ?>" placeholder="Category Name">
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
      // $(".Category-Menu .inner").addClass("show");
    // $(".Category-Menu .toggle").addClass("activAcc");
    // $(".Category-Menu .inner").css("display", "block")
    $('.Category-Menu').addClass('active');
</script>
<script src="<?php echo base_url('assets/js/usersFormValidation.js') ?>"></script>
