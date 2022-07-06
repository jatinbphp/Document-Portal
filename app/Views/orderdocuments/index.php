<style>
    table.dataTable tbody td .commentAdd {
        width: 100%;
        max-width: 100px;
        min-width: 100px;
        display: block;
        white-space: nowrap;
        line-clamp: 3;
        -webkit-line-clamp: 3;
        -moz-line-clamp: 3;
        -ms-line-clamp: 3;
        -o-line-clamp: 3;
        overflow: hidden;
        text-overflow: ellipsis;
        margin: 0px;
    }
    table.dataTable tbody td, table.dataTable tbody td .commentAdd {
        transition: all .4s ease-in-out;
    }
    /*table.dataTable tbody td.sorting_1:hover {
        white-space: unset;
    }*/

    tr.dt-rowReorder-moving {
    outline: 2px solid #555;
    outline-offset: -2px;
    }
</style>
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" />
       <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css" />
       <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css" />
       <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css" />
       <link rel="stylesheet" type="text/css" href="../../extensions/Editor/css/editor.dataTables.min.css"> -->
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
           
             <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <div class="category-filter">
                                <select id="companyOrderDocument" class="form-control" name="companySearch">
                                    <option value="">Select Company</option>
                                        <?php if(count($company) > 0): ?>
                                            <?php foreach($company as $key => $value): ?>
                                                <option value="<?php //echo $value['companyName'] ?> <?php echo $value['id'] ?>"><?php echo $value['companyName'] ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>                  
                                 </select>

                            </div>

                        </div>
                    
                    </div>
            <form name="frm-example" id="frm-example">        
            <div class="item-wrap item-list-table table-responsive orderTable">
                <table id="orderDocumentsTable" class="table table-bordered display responsive nowrap" cellspacing="0" width="100%" >
                    <div><button type="submit" class="btn-primary" id="Savebtn">Save Order</button></div>
                   
                   
                     <thead class="thead-dark">
                        <tr>
                            <th style = "width:8%">Document Name</th>

                            <th style = "width:5%">User Type</th>
                            <th style = "width:8%">Category</th>
                            <th style = "width:8%">Sub Category</th>
                            <th style = "width:8%">Company</th>
                            <th style = "width:4%">Comments</th>
                            <th style = "width:8%">Start Date</th>
                            <th style = "width:8%">Expire Date</th>
                            <th style = "width:8%">Status</th>
                            <th style = "width:8%">Action</th>
                             <th style = "width:5%">File</th>
                             <th style = "width:5%">Input</th>
                             
                            <!-- <th style = "width:8%">Order(Desc)</th> -->
                            <!--  <th>Document file</th> -->
                        </tr>
                    </thead>
               
                   
                    <tbody>
                    </tbody>
                </table>
            </div>
        </form>

        </div>
    </div>
</div>

<script type="text/javascript">
  // $(".manageDocuments-Menu .inner").addClass("show");
    // $(".manageDocuments-Menu .toggle").addClass("activAcc");
    // $(".manageDocuments-Menu .inner").css("display", "block")
    $('.OrderWorkflow-Menu').addClass('active');

     // Tooltips
    $(document).ready(function () {
        new bootstrap.Tooltip(document.body, {
            selector: '.tip'
        });

        $(".orderTable").hide();
    });
</script>

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">



<script src="<?php echo base_url('assets/js/usersTable.js') ?>"></script>





