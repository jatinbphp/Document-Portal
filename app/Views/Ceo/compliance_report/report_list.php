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
    th.mainrow {
    	text-align: center;
	}
	
</style>
<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <h3>Compliance Report</h3>
            <div class="item-wrap item-list-table">
                <?php 
                 $sesVal =  $_SERVER['REQUEST_URI'];
	            $ses_id = explode("/",$sesVal);

	            $user_id = end($ses_id);

	            $fragments = array_filter($ses_id);

				$compa_id =$ses_id[count($ses_id)-2];

				

	            $db      = \Config\Database::connect();
	            $builder = $db->table('Users');
	            $builder->select('firstName');
	            $builder->select('lastName');
	            $builder->where('id', $user_id);
	            $queryResult = $builder->get()->getResult('array');
	            $user_fname = $queryResult[0]['firstName'];
	            $user_lname = $queryResult[0]['lastName'];
	          	$user_name = $user_fname .' '. $user_lname;

	          	$db      = \Config\Database::connect();
				$builder = $db->table('Company');
				$builder->select('companyName');
				$builder->where('id', $compa_id);
				$queryResult = $builder->get()->getResult('array');
				$company_name = $queryResult[0]['companyName'];
				

				$db      = \Config\Database::connect();
				$builder = $db->table('document_workfolw');
				$builder->select('id');
				$builder->where('company_id', $compa_id);
				$builder->where('technician_id',$user_id);
				$queryResult = $builder->get()->getResult('array');
				$total = count($queryResult);
				

				// $db      = \Config\Database::connect();
				// $builder = $db->table('document_workfolw');
				// $builder->select('id');
				// $builder->where('company_id', $compa_id);
				// $builder->where('technician_id',$user_id);
				// $builder->where('is_active',$docValue['is_active']);
				// $queryResult = $builder->get()->getResult('array');
				// $activeTotal = count($queryResult);
				// //echo "activeTotal".$activeTotal; echo "<br>";
				// $complianceScore1 = (($activeTotal/$total) *100);
				// $complianceScore = number_format($complianceScore1, 0);


				$db      = \Config\Database::connect();
									$builder = $db->table('document_workfolw');
									$builder->select('id');
									$builder->select('is_active');
									$builder->where('company_id', $compa_id);
									$builder->where('technician_id',$user_id);
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
									$builder->where('company_id', $compa_id);
									$builder->where('technician_id',$user_id);
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
									$builder->where('company_id', $compa_id);
									$builder->where('technician_id',$user_id);
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
									$builder->where('company_id', $compa_id);
									$builder->where('technician_id',$user_id);
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
									$builder->where('company_id', $compa_id);
									$builder->where('technician_id',$user_id);
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

                <table class=" table table-bordered">
								  <thead class="thead-dark">
								  	<tr><th>Name</th>
								  	<th>Company</th>
								  	 <th colspan="5" class = "mainrow">compliance score%</th></tr>
								    <tr>
								    	<th colspan=""></th>
								    	<th colspan=""></th>
								      <th colspan="">APPROVED</th>
								      <th colspan="">SUBMITED</th>
								      <th colspan="">REJECTED</th>
								      <th colspan="">EXPIRED</th>
								      <th colspan="">OUTSTANDING</th>
								      
								    </tr>
								  </thead>
								  <tbody>
								   <tr>
								  
							   		<td style = "background: #dee2e6"><?php echo $user_name; ?></td>
						   			<td style = "background: #dee2e6"><?php echo $company_name ?></td>
								   	<td style = "background: #dee2e6"><?php echo $complianceScoreActive; ?>%</td>
								   	<td style = "background: #dee2e6"><?php echo $complianceScoreSubmited; ?>%</td>
							   		<td style = "background: #dee2e6"><?php echo $complianceScoreRejected; ?>%</td>
							   		<td style = "background: #dee2e6"><?php echo $complianceScoreExpired; ?>%</td>
								   <td style = "background: #dee2e6"><?php echo $complianceScoreOutstanding; ?>%</td>
								   </tr>
								   	
								</table>
                
				<!--accordion begin-->
				<div class="accordion" id="accordionExample">
				  <!--start card-->

				  <?php foreach($company as $key => $compValue): ?>
				  <div class="card">
					<!-- <div class="card-header" id="headingOne"> -->
					  <!-- <h5 class="mb-0"> -->
						<!-- <a href="" role="button" data-toggle="collapse" data-target="#collapseOne-<?php echo $compValue['id'] ?>" aria-expanded="true" aria-controls="collapseOne"><?php echo $compValue['companyName'] ?></a> -->
						<!--button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><?php echo $compValue['companyName'] ?></button-->
					 <!--  </h5> -->
					<!-- </div> -->
					<div id="collapseOne-<?php echo $compValue['id'] ?>" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
					  <div class="card-body">
						<!--table-->
						<table id="" class="table table-bordered" cellspacing="0" width="100%">
						  <thead class="thead-dark">
							<tr>
							  <th style='width: 20%'>Document Name</th>
							  <!-- <th style='width: 20%'>client Name</th> -->
							  <!-- <th style='width: 20%'>Company</th> -->
							  <th style='width: 20%'>Expire Date </th>
							  <th style='width: 10%'>Status </th>
							 <!--  <th style='width: 10%'>Compliance Score </th> -->
							</tr>
						  </thead>
						  <tbody>
						  
								<?php if(count($Documentfiles)>0){
									foreach($Documentfiles as $key => $docValue){
										if($docValue['company_id'] == $compValue['id']){ 

											

											// if($docValue['is_active'] == 1 || $docValue['is_active'] == 3 || $docValue['is_active'] == 4 ){

											?>

											<tr>
											  <td><?php echo $docValue['document_name'] ?></td>
											  
											 <!--  <td><?php echo $user_name; ?></td> -->
											  <!-- <td><?php echo $compValue['companyName']; ?></td> -->
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

									<tr> <td><?php echo "No data available in table";?></td></tr>
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
    $('.ComplianceReport-Menu').addClass('active');
</script>
<script src="<?php echo base_url('assets/js/usersTable.js') ?>"></script>
