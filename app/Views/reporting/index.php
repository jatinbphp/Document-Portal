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

            <h3>General Report<a class="btn btn-info" style="float: right;" href="<?php echo base_url('reporting/export'); ?>">Export Data</a></h3>

            <div class="item-wrap item-list-table">
				

                <table id="reportingTable" class="table table-bordered" cellspacing="0" width="100%" >
					
					
					<div class="row">
						<div class="col-sm-12 col-md-4">
							<div class="category-filter">
								<select id="categoryFilter" class="form-control" name="companySearch">
									<option value="">Show All</option>
									<?php if(count($company) > 0): ?>
										<?php foreach($company as $key => $value): ?>
											<option value="<?php echo $value['id'] ?>"><?php echo $value['companyName'] ?></option>
										<?php endforeach; ?>
									<?php endif; ?>
									
								 </select>
							</div>
						</div>
					</div>
    
					
                    <thead class="thead-dark">
						
						
                        <tr>
                            <th>Photo</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Company</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
	
	/*
	$('select').on('change', function() {
		//alert( this.value );
		companyName = this.value
		//alert(companyName);
		$.ajax({
			url:"'<?php echo base_url('reporting/getData'); ?>"
			data: { companyName : 'companyName' },
			type: 'POST',
			cache: false,
			success: function (data) {
				//alert('true');
				console.log('success');
			},
			error: function (data`) {
				//alert('fail');
				console.log('fail');
			}
    });
		
*/



//$("select").click(function(){
	//$.post("<?php echo base_url('reporting/getData'); ?>",   // url
       //{ myData: companyName = this.value }, // data to be submit
			//function(data, status, jqXHR) {// success callback
                //$('p').append('status: ' + status + ', data: ' + data);
                //alert("true");
        //});
  //});



/*$("select").click(function(){
	$.post("<?php echo base_url('reporting/getData'); ?>",   // url
       { myData: 'This is my data.' }, // data to be submit
			function(data, status, jqXHR) {// success callback
                //$('p').append('status: ' + status + ', data: ' + data);
                //alert("true");
        });
  });*/



/*

$("select").click(function(){
  $.post("<?php echo base_url('reporting/getData'); ?>",
  {
    name: "Donald Duck",
    city: "Duckburg"
  },
  function(data, status){
    alert("Data: " + data + "\nStatus: " + status);
  });
});
*/


	/*
	$('#categoryFilter').click(function () {
    //var comments = $('#txtComments').val();
    var selectedId = $('#categoryFilter').val();

    $.ajax({
        url: "<?php echo base_url('reporting/getData'); ?>"
        data: { 'companyName' : selectedId },
        type: "POST",
        cache: false,
        success: function (data) {
			alert("true");
            //console.log('success');
        },
        error: function (data`) {
			alert("fail");
            //console.log('fail');
        }
    });
});*/

</script>
  

<script type="text/javascript">
    // $(".manageUsers-Menu .inner").addClass("show");
    // $(".manageUsers-Menu .toggle").addClass("activAcc");
    // $(".manageUsers-Menu .inner").css("display", "block")
    $('.Reporting-Menu').addClass('active');
    
    
    
</script>
<script src="<?php echo base_url('assets/js/usersTable.js') ?>"></script>

