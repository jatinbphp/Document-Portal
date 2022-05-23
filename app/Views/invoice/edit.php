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

            <h3>Add Order</h3>

            <div class="item-wrap item-list-table">

                <div class="card">
                    <div class="card-body">
                        <form id="userFormAdd orderItem" method="post" action="<?php echo base_url('invoice/edit'); ?>" enctype="multipart/form-data">
                            <table class="table  table-hover" id="orderItem"> 
                            <div class="row">
                               
                                <div class="col-md-3">
                                    <div class="form-group">

                                        <label class="lableTitle"for="firstName">Items<span class="asterisk-sign">*</span></label>

                                       <select name="items[]" id="items_1" class="form-control">
                      
                      
                                          <option value="">--Select--</option>
                                         <?php   foreach($ItemData as $Itemval){ ?>
                                          <option value="<?php echo $Itemval['id'];?>"><?php echo $Itemval['name'];?></option>              
                                       <?php } ?> 
                                      
                                         </select>
                      
                      
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="lableTitle"for="firstName">Price<span class="asterisk-sign">*</span></label>
                                        <input type="number" name="price[]" class="form-control" id="price_1" placeholder="Price">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="lableTitle"for="lastName">Quantity<span class="asterisk-sign">*</span></label>
                                        <input type="number" name="quantity[]" class="form-control" id="quantity_1" placeholder="Quantity">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="lableTitle"for="lastName">Total<span class="asterisk-sign">*</span></label>
                                        <input type="number" name="total[]" class="form-control" id="total_1" placeholder="Total">
                                    </div>
                                </div>
                                <input type="hidden" name="itemIds[]" id="itemIds_1" class="form-control" >
                            </div>
                            </table>
                <div class="row">               
                &nbsp;<button class="btn btn-danger delete" id="removeRows" type="button">- Delete</button>
                <button class="btn btn-success itemRow" id="addRows" type="button">+ Add More</button>                
              </div>
              <br><div><br></div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="lableTitle"for="pwd">SubTotal:<span class="asterisk-sign">*</span></label>
                                        <input type="number" name="subTotal" class="form-control" id="subTotal" placeholder="SubTotal">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="lableTitle"for="conpassword">CGST Rate :<span class="asterisk-sign">*</span></label>
                                        <input type="number" name="taxRate1" class="form-control" id="taxRate1" placeholder="CGST Rate">
                                        <div class="input-group-addon">%</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="lableTitle"for="conpassword">sGST Rate :<span class="asterisk-sign">*</span></label>
                                        <input type="number" name="taxRate2" class="form-control" id="taxRate2" placeholder="SGST Rate">
                                        <div class="input-group-addon">%</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="lableTitle"for="pwd">Tax Amount:<span class="asterisk-sign">*</span></label>
                                        <input type="number" name="taxAmount" class="form-control" id="taxAmount" placeholder="Tax Amount">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="lableTitle"for="conpassword">Net Amount :<span class="asterisk-sign">*</span></label>
                                        <input type="number" name="totalAftertax" class="form-control" id="totalAftertax" placeholder="Net Amount">
                                    </div>
                                </div>
                                
                            </div>                                
                            
                            <button type="submit" class="btn btn-info">Submit</button>
                            <a href="<?php echo base_url('invoice'); ?>" type="button" class="btn btn-warning">Back</a>
                        </form>
                    </div>
                </div>
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