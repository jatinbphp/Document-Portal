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

            <h3>Category <!--a class="btn btn-info" style="float: right;" href="<?php echo base_url(''); ?>">Add Category</a--></h3>

            <div class="item-wrap item-list-table">
                <table id="repCatTable" class="table table-bordered" cellspacing="0" width="100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <!--th style="width: 15%">Action</th-->
                        </tr>
                    </thead>
                    <tbody> 
                    
						
						<tr>
							<td>Category 1</td>
								<td> 
									<table class="table table-bordered" cellspacing="0" width="100%">
										<tr><td>SubCategory 1</td></tr> 
										<tr><td>SubCategory 2</td></tr>
									</table>
								</td>
						</tr>
        
                         
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".Category-Menu .inner").addClass("show");
    $(".Category-Menu .toggle").addClass("activAcc");
    $(".Category-Menu .inner").css("display", "block")
    $('.Category-Menu .Category-Menu').addClass('active');
</script>
<script src="<?php echo base_url('assets/js/usersTable.js') ?>"></script>
