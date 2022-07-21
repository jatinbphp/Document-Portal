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
                <?php 
                 $sesVal =  $_SERVER['REQUEST_URI'];
	            $ses_id = explode("/",$sesVal);

	            $user_id = end($ses_id);

	            $db      = \Config\Database::connect();
	            $builder = $db->table('Users');
	            $builder->select('firstName');
	            $builder->select('lastName');
	            $builder->where('id', $user_id);
	            $queryResult = $builder->get()->getResult('array');
	            $user_fname = $queryResult[0]['firstName'];
	            $user_lname = $queryResult[0]['lastName'];
	          	$user_name = $user_fname .' '. $user_lname;

                ?>
                
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
							  <th style='width: 20%'>client Name</th>
							  <th style='width: 20%'>Company</th>
							  <th style='width: 20%'>Expire Date </th>
							  <th style='width: 10%'>Status </th>
							  <th style='width: 10%'>Compliance Score </th>
							</tr>
						  </thead>
						  <tbody>
						  
								<?php if(count($Documentfiles)>0){
									foreach($Documentfiles as $key => $docValue){
										if($docValue['company_id'] == $compValue['id']){ 

											$db      = \Config\Database::connect();
											$builder = $db->table('document_workfolw');
											$builder->select('id');
											$builder->where('company_id', $compValue['id']);
											$builder->where('technician_id',$user_id);
											$queryResult = $builder->get()->getResult('array');
											$total = count($queryResult);
											

											$db      = \Config\Database::connect();
											$builder = $db->table('document_workfolw');
											$builder->select('id');
											$builder->where('company_id', $compValue['id']);
											$builder->where('technician_id',$user_id);
											$builder->where('is_active',$docValue['is_active']);
											$queryResult = $builder->get()->getResult('array');
											$activeTotal = count($queryResult);
											//echo "activeTotal".$activeTotal; echo "<br>";
											$complianceScore1 = (($activeTotal/$total) *100);
											$complianceScore = number_format($complianceScore1, 0);

											if($docValue['is_active'] == 1 || $docValue['is_active'] == 3 || $docValue['is_active'] == 4 ){

											?>

											<tr>
											  <td><?php echo $docValue['document_name'] ?></td>
											  
											  <td><?php echo $user_name; ?></td>
											  <td><?php echo $compValue['companyName']; ?></td>
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
											  	<td><?php echo $complianceScore;?>%</td>
											</tr>
											<?php } ?>

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
