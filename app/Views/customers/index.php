
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
           
            <!-- <h3>Manage Customers <a class="btn btn-info" style="float: right;" href="<?php echo base_url('customers/add'); ?>">Add Customers</a>
                <a class="btn btn-info" style="float: right;margin-right: 5px;" href="<?php echo base_url('customers/importdata'); ?>">Import Customer</a>

            </h3> -->
             <h3>
                <div class="row">
                <div class="col-sm-7">Manage Customers</div> 
                <div class="col-sm-5 text-right">
                    <a class="btn btn-info"  href="<?php echo base_url('customers/add'); ?>">Add Customers</a>
                    <a class="btn btn-info"  href="javascript:void()" id="exportToExcelBtn">Export Customer</a>
                    <a class="btn btn-info"  href="<?php echo base_url('customers/importdata'); ?>">Import Customer</a>
                </div>
                </div>
            </h3>

            <div class="item-wrap item-list-table ">
                <table id="customersTable" class="table table-bordered display nowrap" cellspacing="0" width="100%" >
                    <thead class="thead-dark">
                        <tr>
                            
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Birth Date</th>
                            <th>Billing Address</th>
                            <th>Shipping Address</th>
                            <th>Last Order</th>
                            <th>Total Spent</th>
                            <th>Ave. Value</th>
                             <th>Action</th>
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
    $(".manageCustomers-Menu .inner").addClass("show");
    $(".manageCustomers-Menu .toggle").addClass("activAcc");
    $(".manageCustomers-Menu .inner").css("display", "block")
    $('.manageCustomers-Menu .Customers-Menu').addClass('active');

     $(document).on('click','#exportToExcelBtn',function(){
        
        var pathurl = "<?php echo base_url('Customers/exportCustomers'); ?>";
    
        $.ajax({
            url:pathurl,
            type:"POST",
            // data:{'daterange':daterange,'influ_id':influ_id},
            success: function(res){
                // console.log(res);
                window.open("<?php echo base_url(); ?>"+res,'_blank');
            }
        });
    });
</script>
<script src="<?php echo base_url('assets/js/adminTables.js') ?>"></script>



