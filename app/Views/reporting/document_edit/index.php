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

            <h3>Edited Document log <!--a class="btn btn-info" style="float: right;" href="<?php echo base_url('documents/add'); ?>">Upload Documents</a--></h3>
				<div class="item-wrap item-list-table">
					<table id="editedDocument" class="table table-bordered" cellspacing="0" width="100%" >
						<thead class="thead-dark">
							<tr>
								<th>Download File</th>
								<th>Document Name</th>
								<th>Edited By</th>
								<th>Edited Date</th>
							</tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  // $(".manageDocuments-Menu .inner").addClass("show");
    // $(".manageDocuments-Menu .toggle").addClass("activAcc");
    // $(".manageDocuments-Menu .inner").css("display", "block")
    //$('.Reporting-Menu').addClass('active');
    
    $("#drpdwn").addClass('active'); 
	$("#innerUl").addClass('show'); 
	$("#innerUl").css("display", "block");
	$("#editReport").addClass('active'); 
	$(".Reporting-Menu").addClass('active');
</script>
<script src="<?php echo base_url('assets/js/usersTable.js') ?>"></script>
<!--script src="<?php //echo base_url('assets/js/tables.js') ?>"></script-->





