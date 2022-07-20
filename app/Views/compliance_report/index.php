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
										if($docValue['company_id'] == $compValue['id']){ ?>

											<tr>
											  <td><?php echo $docValue['document_name'] ?></td>
											  <td><?php echo $docValue['expire_date'] ?></td>
											  <td>
													<?php
													  if($docValue['is_active'] == 1 && $docValue['expire_date'] > date('Y-m-d')){
													  echo '<span class="badge badge-success">Active</span>';            
													  }
													  elseif($docValue['is_active'] == 1 && $docValue['expire_date'] < date('Y-m-d')){
													  echo '<span class="badge badge-danger">Expired</span>';
													  }
													  elseif($docValue['is_active'] != 1 && $docValue['expire_date'] == '0000-00-00'){
													  echo '<span class="badge badge-dark">InActive</span>';
													  }
													  elseif($docValue['is_active'] != 1 && $docValue['expire_date'] < date('Y-m-d')){
													  echo '<span class="badge badge-danger">Expired</span>';
													  }
													  elseif($docValue['is_active'] == 1 && $docValue['expire_date'] ==  date('Y-m-d')){
														 echo '<span class="badge badge-success">Active</span>';
													  }	
													  else{
													  echo '<span class="badge badge-dark">InActive</span>';
													  }
													  ?>
											  	</td>
											</tr>

									<?php	}
									}
								}else { ?>

									<tr> <td><?php echo "No Found Data";?></td></tr>
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
