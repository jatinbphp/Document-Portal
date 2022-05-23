
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

            <h3>Manage Invoice<a class="btn btn-info" style="float: right;" href="<?php echo base_url('invoice/add'); ?>">Add Invoice</a></h3>

            <div class="item-wrap item-list-table">
                <table id="invoiceTable" class="table table-bordered" cellspacing="0" width="100%" >
                    <thead class="thead-dark">
                        <tr>
                            
                            <th>Invoice Number</th>
                            <th>Gross Amount</th>
                            <th>Tax Amomunt</th>
                            <th> Net amount</th>
                            <th>User</th>
                            <th>Date Time</th>
                            <th style="width: 15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".manageInvoice-Menu .inner").addClass("show");
    $(".manageInvoice-Menu .toggle").addClass("activAcc");
    $(".manageInvoice-Menu .inner").css("display", "block")
    $('.manageInvoice-Menu .Users-Menu').addClass('active');
</script>
<script src="<?php echo base_url('assets/js/usersTable.js') ?>"></script>

