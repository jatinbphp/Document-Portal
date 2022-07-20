<style type="text/css">
    .mb-0>a {
        display: block;
        position: relative;
    }

    .mb-0>a:after {
        content: "\f078";
        /* fa-chevron-down */
        font-family: 'FontAwesome';
        position: absolute;
        right: 0;
    }

    .mb-0>a[aria-expanded="true"]:after {
        content: "\f077";
        /* fa-chevron-up */
    }
</style>
<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <h3>Compliance Report</h3>
            <div class="item-wrap item-list-table">
                
                
				<!--accordion begin-->
				<div class="accordion" id="accordionExample">
				  <!--start card-->
				  <?php foreach($company as $key => $compValue): ?>
				  <div class="card">
					<div class="card-header" id="headingOne">
					  <h5 class="mb-0">
						<a href="" role="button" data-toggle="collapse" data-target="#collapseOne-<?php echo $compValue['id'] ?>" aria-expanded="true" aria-controls="collapseOne"><?php echo $compValue['companyName'] ?></a>
						<!--button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><?php echo $compValue['companyName'] ?></button-->
					  </h5>
					</div>
					<div id="collapseOne-<?php echo $compValue['id'] ?>" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
					  <div class="card-body">
						<!--table-->
						<table id="" class="table table-bordered" cellspacing="0" width="100%">
						  <thead>
							<tr>
							  <th style='width: 50%'>Document Name</th>
							  <th style='width: 40%'>Expire Date </th>
							  <th style='width: 10%'>Status </th>
							</tr>
						  </thead>
						  <tbody>
						  	
								<?php if(count($Documentfiles)>0){
									foreach($Documentfiles as $key => $docValue){
										if($docValue['company_id'] == $compValue['id']){ 
											if($docValue['is_active'] == 1 || $docValue['is_active'] == 3 || $docValue['is_active'] == 4 ){
											?>

											<tr>
											  <td><?php echo $docValue['document_name'] ?></td>
											  <td><?php echo $docValue['expire_date'] ?></td>
											  <td>
													<?php
													 if($docValue['is_active'] == 1){
									                echo '<span class="badge badge-success">APPROVED</span>';
									            }elseif($docValue['is_active'] == 3){
									            	echo '<span class="badge badge-danger">EXPIRED</span>';
									            }
									            elseif($docValue['is_active'] == 4){
									            	echo '<span class="badge badge-danger">REJECTED</span>';
									            }
									            
									            
														
													  
													  ?>
											  	</td>

											</tr>
										<?php } ?>

									<?php	}
									}
								}else { ?>

									<!--tr> <td><?php echo "No Found Data";?></td></tr-->
									<tr> <td colspan = "3" style="text-align: center;"><?php echo "No data available";?></td></tr>
								<?php }?>
						  </tbody>
						</table>
						<!--end table-->
					  </div>
					</div>
				  </div>
				  <?php endforeach ?>
				  <!--end card-->      
				</div>
				<!--end of accordion-->
                
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    // $(".manageDocuments-Menu .inner").addClass("show");
    // $(".manageDocuments-Menu .toggle").addClass("activAcc");
    // $(".manageDocuments-Menu .inner").css("display", "block")
    $('.Reporting-Menu').addClass('active');
</script>
<script src="<?php echo base_url('assets/js/usersTable.js') ?>"></script>
