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

            <h3>
                <div class="row">
                    <div class="col-sm-8">Import Customers</div> 
                    <div class="col-sm-4 text-right">
                        <a class="btn btn-info"  href="<?php echo base_url('assets/excelSample/import-customers.xlsx'); ?>">Sample Excel File</a>
                    </div>
                </div>
            </h3>


             <div class="item-wrap item-list-table">

                <div class="card">
                    <div class="card-body">
                        <form id="importFile" method="POST" action="<?php echo base_url('Customers/filedataAdd'); ?>" enctype="multipart/form-data">
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="hidden" name="import_file" value="1">
                                        <label class="lableTitle" for="fileimport">Upload Excel File : </label>
                                        <input id="customerFile" class="" name="customerFile" type="file" required="">
                                    </div>
                                </div>     
                            </div> 

                            <button type="submit" name="submit" class="btn btn-info">Submit</button>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".manageCustomers-Menu .inner").addClass("show");
    $(".manageCustomers-Menu .toggle").addClass("activAcc");
    $(".manageCustomers-Menu .inner").css("display", "block")
    $('.manageCustomers-Menu .Customers-Menu').addClass('active');
</script>
<script src="<?php echo base_url('assets/js/adminTables.js') ?>"></script>
