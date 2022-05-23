
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

            <h3>Manage Users <a class="btn btn-info" style="float: right;" href="<?php echo base_url('users/add'); ?>">Add Users</a></h3>

            <div class="item-wrap item-list-table">
                <table id="usersTable" class="table table-bordered" cellspacing="0" width="100%" >
                    <thead class="thead-dark">
                        <tr>
                            <th>Photo</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Company</th>
                            <th>Date</th>
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
    $(".manageUsers-Menu .inner").addClass("show");
    $(".manageUsers-Menu .toggle").addClass("activAcc");
    $(".manageUsers-Menu .inner").css("display", "block")
    $('.manageUsers-Menu .Users-Menu').addClass('active');
</script>
<script src="<?php echo base_url('assets/js/usersTable.js') ?>"></script>

