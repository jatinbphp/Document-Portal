
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

            <h3>Manage Documents <a class="btn btn-info" style="float: right;" href="<?php echo base_url('documents/add'); ?>">Add Documents</a></h3>

            <div class="item-wrap item-list-table">
                <table id="documentsTable" class="table table-bordered" cellspacing="0" width="100%" >

                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <div class="category-filter">
                                <select id="companySearch" class="form-control" name="companySearch">
                                    <option value="">Select Company</option>
                                    <?php if(count($company) > 0): ?>
                                        <?php foreach($company as $key => $value): ?>
                                            <option value="<?php //echo $value['companyName'] ?> <?php echo $value['id'] ?>"><?php echo $value['companyName'] ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    
                                 </select>
                            </div>
                        </div>
                    
                        <div class="col-sm-12 col-md-4">
                            <div class="category-filter">
                                <select id="userSearch" class="form-control" name="userSearch">
                                    <option value="">Select User</option>
                                   
                                    <?php if(count($users) > 0): ?>
                                        <?php foreach($users as $key => $value): ?>
                                            <option value="<?php //echo $value['companyName'] ?> <?php echo $value['id'] ?>"><?php echo $value['firstName']." ".$value['lastName'] ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    
                                 </select>
                            </div>
                        </div>
                    </div>
                    <thead class="thead-dark">
                        <tr>
                            <th>Download File</th>
                            <th>Document Name</th>
                            <th>User Name</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Expire Date</th>
                            <th>Status</th>
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
    $(".manageDocuments-Menu .inner").addClass("show");
    $(".manageDocuments-Menu .toggle").addClass("activAcc");
    $(".manageDocuments-Menu .inner").css("display", "block")
    $('.manageDocuments-Menu .Documents-Menu').addClass('active');
</script>
<script src="<?php echo base_url('assets/js/usersTable.js') ?>"></script>


<script>
   display_documentTable();
        $('#companySearch').on('change', function(event) {
            $("#documentsTable").dataTable().fnDestroy();
              display_documentTable();
        });

        function display_documentTable(){
            var companyId = $("#companySearch option").filter(":selected").val();
            alert(companyId);
          var url =  '<?php echo base_url('documents/fetch_documents'); ?>' ;

        $('#documentsTable').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "ajax": {
            url: url,
            type: "POST",
            data:{'companyId':companyId},
               
        },
        "columnDefs": [{
            "orderable": false,
            "targets": -1
        }, {
            "orderable": false,
            "targets": 0
        }, {
            "orderable": false,
            "targets": 6
        }, {
            "width": "10%",
            "targets": 0
        }, {
            "width": "15%",
            "targets": 1
        }, {
            "width": "10%",
            "targets": 2
        }, {
            "width": "10%",
            "targets": 3
        }, ]
    });
              
        }
</script>

