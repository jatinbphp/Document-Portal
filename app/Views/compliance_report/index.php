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

element.style {
}
.table-bordered {
    border: 1px solid #dee2e6;
    font-size: 11px;
}
th.mainrow {
    text-align: center;
}
.card-header table {
    margin-left: auto;
}
.card-header table tr th, .card-header table tr td {
    padding: 6px;
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

							<?php 

									$db= \Config\Database::connect();
									$builder = $db->table('document_workfolw');
									$builder->select('id');
									$builder->where('company_id', $compValue['id']);
									$builder->where('technician_id',$_SESSION['id']);
									$queryResult = $builder->get()->getResult('array');


									$total = count($queryResult);
									

									$db      = \Config\Database::connect();
									$builder = $db->table('document_workfolw');
									$builder->select('id');
									$builder->select('is_active');
									$builder->where('company_id', $compValue['id']);
									$builder->where('technician_id',$_SESSION['id']);
									$where =  "(is_active = 1)";
									$builder->where($where);
									$queryResult1 = $builder->get()->getResult('array');
									
									$activeTotal = count($queryResult1);
									//echo "activeTotal".$activeTotal; echo "<br>";
									if($total > 0){

										$complianceScore1 = (($activeTotal/$total) *100);
									$complianceScoreActive = number_format($complianceScore1, 0);
								}
								else{
									$complianceScoreActive = 0;
								}

								$db      = \Config\Database::connect();
									$builder = $db->table('document_workfolw');
									$builder->select('id');
									$builder->select('is_active');
									$builder->where('company_id', $compValue['id']);
									$builder->where('technician_id',$_SESSION['id']);
									$where =  "(is_active = 2)";
									$builder->where($where);
									$queryResult2 = $builder->get()->getResult('array');
									
									$activeTotal = count($queryResult2);
									//echo "activeTotal".$activeTotal; echo "<br>";
									if($total > 0){

										$complianceScore2 = (($activeTotal/$total) *100);
									$complianceScoreSubmited = number_format($complianceScore2, 0);
								}
								else{
									$complianceScoreSubmited = 0;
								}

								$db      = \Config\Database::connect();
									$builder = $db->table('document_workfolw');
									$builder->select('id');
									$builder->select('is_active');
									$builder->where('company_id', $compValue['id']);
									$builder->where('technician_id',$_SESSION['id']);
									$where =  "(is_active = 3)";
									$builder->where($where);
									$queryResult3 = $builder->get()->getResult('array');
									
									$activeTotal = count($queryResult3);
									//echo "activeTotal".$activeTotal; echo "<br>";
									if($total > 0){

										$complianceScore3 = (($activeTotal/$total) *100);
									$complianceScoreExpired = number_format($complianceScore3, 0);
								}
								else{
									$complianceScoreExpired = 0;
								}

								$db      = \Config\Database::connect();
									$builder = $db->table('document_workfolw');
									$builder->select('id');
									$builder->select('is_active');
									$builder->where('company_id', $compValue['id']);
									$builder->where('technician_id',$_SESSION['id']);
									$where =  "(is_active = 4)";
									$builder->where($where);
									$queryResult4 = $builder->get()->getResult('array');
									
									$activeTotal = count($queryResult4);
									//echo "activeTotal".$activeTotal; echo "<br>";
									if($total > 0){

										$complianceScore4 = (($activeTotal/$total) *100);
									$complianceScoreRejected = number_format($complianceScore4, 0);
								}
								else{
									$complianceScoreRejected = 0;
								}

								$db      = \Config\Database::connect();
									$builder = $db->table('document_workfolw');
									$builder->select('id');
									$builder->select('is_active');
									$builder->where('company_id', $compValue['id']);
									$builder->where('technician_id',$_SESSION['id']);
									$where =  "(is_active = 0)";
									$builder->where($where);
									$queryResult5 = $builder->get()->getResult('array');
									
									$activeTotal = count($queryResult5);
									//echo "activeTotal".$activeTotal; echo "<br>";
									if($total > 0){

										$complianceScore5 = (($activeTotal/$total) *100);
									$complianceScoreOutstanding = number_format($complianceScore5, 0);
								}
								else{
									$complianceScoreOutstanding = 0;
								}


									
							?>

								<table class="table col-6 col-sm-3  table-bordered">
								  <thead class="thead-dark">
								  	<tr> <th colspan="5" class = "mainrow">compliance score%</th></tr>
								    <tr>
								      <th colspan="">APPROVED</th>
								      <th colspan="">SUBMITED</th>
								      <th colspan="">REJECTED</th>
								      <th colspan="">EXPIRED</th>
								      <th colspan="">OUTSTANDING</th>
								      
								    </tr>
								  </thead>
								  <tbody>
								   <tr>
								   

								   	<td style = "background: #dee2e6"><?php echo $complianceScoreActive; ?>%</td>
								   	<td style = "background: #dee2e6"><?php echo $complianceScoreSubmited; ?>%</td>
							   		<td style = "background: #dee2e6"><?php echo $complianceScoreRejected; ?>%</td>
							   		<td style = "background: #dee2e6"><?php echo $complianceScoreExpired; ?>%</td>
								   <td style = "background: #dee2e6"><?php echo $complianceScoreOutstanding; ?>%</td>
								   </tr>
								   	
								</table>
														
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
							 <!--  <th style='width: 10%'>Compliance Score </th> -->
							</tr>
						  </thead>
						  <tbody>
						  		
								<?php if(count($Documentfiles)>0){
									foreach($Documentfiles as $key => $docValue){
										if($docValue['company_id'] == $compValue['id']){ 

											
											
											// if($docValue['is_active'] == 1 || $docValue['is_active'] == 3 || $docValue['is_active'] == 4 || $docValue['is_active'] == 2 || $docValue['is_active'] == 0 ){
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
									            elseif($docValue['is_active'] == 0){
									            	echo '<span class="badge badge-danger">OUTSTANDING</span>';
									            }
									            elseif($docValue['is_active'] == 2){
									            	echo '<span class="badge badge-primary">SUBMITED</span>';
									            }
									            
									            
														
													  
													  ?>
											  	</td>
											  	
											</tr>
										<?php //} ?>

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
