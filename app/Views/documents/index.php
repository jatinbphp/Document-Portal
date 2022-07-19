<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">

	<!--input type="hidden" id="hdnSession" data-value="@Request.RequestContext.HttpContext.Session['success']" /-->

            <?php if(session()->has('success')): ?>
				<?php
					//if(!empty(session()->getFlashdata('success'))){
							//set sessionStatus to true on update successfully
							//$sessionStatus = TRUE;
							//$companyIdSession = session()->get('companyIdSession'); 
					//}//	
				?>
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

            <h3>Manage Documments <a class="btn btn-info" style="float: right;" href="<?php echo base_url('documents/add'); ?>">Upload Documents</a></h3>
				
				
				
				
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
                    
                        <div class="col-sm-12 col-md-4" id="userFilter">
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
				
				
				
            <div class="item-wrap item-list-table docTable">
                <table id="documentsTable" class="table table-bordered" cellspacing="0" width="100%" >

                    <!--div class="row">
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
                    </div--> 
                    <thead class="thead-dark">
                        <tr>
                            <th>Download File</th>
                            <th>Document Name</th>
                            <th>User Name</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Company</th>
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
  // $(".manageDocuments-Menu .inner").addClass("show");
    // $(".manageDocuments-Menu .toggle").addClass("activAcc");
    // $(".manageDocuments-Menu .inner").css("display", "block")
    $('.Document-Menu').addClass('active');
    //Hide all documents UNTIL a company is selected
     $(".docTable").hide();
     $("#userFilter").hide();
</script>
<script src="<?php echo base_url('assets/js/usersTable.js') ?>"></script>
<script>
    function myFunction(){
        alert("Your Document Not added.Please update your document")
    }
</script>

<script>
    
    $('#companySearch').on("change",function(){
            var compid = $('#companySearch').val();
            var url = '<?php echo base_url('/documents/getUser');?>';

            $.ajax({ 
                type: "POST",
                url: url,
                data: { compid: compid},
                success: function(data){

                const user = JSON.parse(data);
                 $('select[name="userSearch"]').empty();
                  $('select[name="userSearch"]').prepend("<option value=' '>-- Select Users --</option>");
                $.each(user, function(key, value){

                        $('select[name="userSearch"]').append('<option  value="'+ value.id +'">'+ value.firstName + ' '+value.lastName+ '</option>');
                        });
                    
                }
            });
        });
</script>

<script>
	$(window).on("load", function () {
		//var sessionStatus = '<?php echo $sessionStatus; ?>';
		//check if data has be updated successfully
		//if(sessionStatus == 1){
		var sessionStatus = "<?php echo $_SESSION['success'] ?>";
		if(sessionStatus){
			//alert(sessionStatus);
			$(".docTable").show();
			$("#userFilter").show();
			$("#documentsTable, #uploadedDocuments").dataTable().fnDestroy();
			
			$('#documentsTable').DataTable({
			"processing": true,
			"serverSide": true,
			"responsive": true,
			"order": [],
			"ajax": {
				url: "documents/fetch_documents",
				type: "POST",
				data: {
					//'company_id': '<?php echo $companyIdSession; ?>'
					'company_id': "<?php echo $_SESSION['companyIdSession'] ?>"
				}
			},
			"columnDefs": [{
				"orderable": false,
				"targets": -1
			}, {
				"orderable": false,
				"targets": 0
			}, {
				"orderable": false,
				"targets": 5
			}, {
				"width": "10%",
				"targets": 0
			}, {
				"width": "15%",
				"targets": 1
			}, {
				"width": "10%",
				"targets": 2
			}]
		});
	}	
});	
</script>

<script>
//var sessionValue= $("#hdnSession").data('value');
//alert(sessionValue);
 //var userName = "<?php echo $_SESSION['success'] ?>";
 //if(userName){
	 //alert(userName);
//}//
 
</script>




<!--script>
	//var conceptName = $('#companySearch').find(":selected").text();
	//alert(conceptName);
	//$(window).on("load", function () {
		//$("#companySearch").val('nxol').change();
		//$('#companySearch option[value="TATA"]');
		//$("#country option[value='AO']").prop('selected',true);
		//$("#companySearch option[value = 6]").prop('selected',true);
		//$('#country').val(“AO”).trigger(‘change’);
	//});	
	
	$('#companySearch').on('change', function() {
		//alert( this.value );
		//var selectedVal = $("#companySearch").val();
		//$("#companySearch").val(selectedVal);
		var selectedCompany = $(this).children("option:selected").val();
		//alert(selectedCompanys);
	});
	
	
</script-->


<!--script>
	
	
		
		$( document ).ready(function() {
			var company_id;
			$('#companySearch').on('change', function() {
		//alert( this.value );
		
			var company_id = $( "#companySearch" ).val();
			myFunc(company_id);
			
			//company_id = $( "#companySearch" ).val();
			//alert(company_id);
		});
				
					$(window).on("load", function () {
							//alert("true");
							//alert(data);
							//$("select").val('6');
							var selectedVal = $("#companySearch").val();
								//alert(selectedVal);
							});
						
				
				
					function myFunc(data){
						$(window).on("load", function () {
							alert("true");
							//alert(data);
						});
						
						
						//alert(data)
						//var url = '<?php //echo base_url('Documents/fetch_documents');?>';
						//alert(company_id);
						//var docValue = $(this).data("custom-value");
						//alert(docValue);
					
					
					/*
					$.ajax({ 
							type: "POST",
							url: url,
							data: { company_id: company_id},
							success: function(response){
								//$(".docTable").show();
								//$('.modal-body').html(response);
								//$('#workflowModal').modal('show'); 
								
							}
					}); */ 
				}		
		});
		
</script-->
<script>
	//var sess = <?php echo $_SESSION['companyIdSession'] ?>;
	//alert(sess);
</script>


