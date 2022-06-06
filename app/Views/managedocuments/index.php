<style type="text/css">
    .mb-0 > a {
    display: block;
    position: relative;
    }
    .mb-0 > a:after {
    content: "\f078"; /* fa-chevron-down */
    font-family: 'FontAwesome';
    position: absolute;
    right: 0;
    }
    .mb-0 > a[aria-expanded="true"]:after {
    content: "\f077"; /* fa-chevron-up */
    }
</style>
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
            <h3>
                Manage Documents
                <!--  <a class="btn btn-info" style="float: right;" href="<?php echo base_url('docs/add'); ?>">Upload Documents</a> -->
            </h3>
            <div class="item-wrap item-list-table">
                <!--table id="" class="table table-bordered" cellspacing="0" width="100%"-->
                    <iv id="accordion">
                    <?php foreach($category as $key=>$value){ ?>
                    <div class="card">
                        <div class="card-header" id="heading-1">
                            <h5 class="mb-0">
                                <a role="button" data-toggle="collapse" href="#collapse-<?php echo $value['id']; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $value['id']; ?>">
                                <?php echo $value['categoryName']; ?>
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-<?php echo $value['id']; ?>" class="collapse show" data-parent="#accordion" aria-labelledby="heading-1">
                            <div class="card-body">
                                <div id="accordion-1">
                                    <div class="card">
                                        <?php foreach ($subCategory as $key=>$subcatvalue) { 
                                            if($value['id'] == $subcatvalue['CategoryId']){ ?>
                                        <div class="card-header" id="heading-1-1">
                                            <h5 class="mb-0">
                                                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-1-<?php echo $subcatvalue['id']; ?>" aria-expanded="false" aria-controls="collapse-1-<?php echo $subcatvalue['id']; ?>">
                                                <?php  echo $subcatvalue['SubCatName']; ?>
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapse-1-<?php echo $subcatvalue['id'] ?>" class="collapse" data-parent="#accordion-1" aria-labelledby="heading-1-1">
                                            <div class="card-body">
												<table id="" class="table table-bordered" cellspacing="0" width="100%">
													<thead>
														<tr>
															<td>Download File </td>
															<td>Doc Name</td>
															<td>Doc File </td>
															
															<td>Expire Date </td>
															<td>Status </td>
															 
														</tr>
													</thead>
													<tbody>
														
                                                <?php foreach ($Documentfiles as $key=>$docvalue) { 
                                                    if($docvalue['categoryID'] ==$value['id'] && $docvalue['subCategoryID'] == $subcatvalue['id']  ){?>
                                                <div id="accordion-1-1">
													
																
													
                                                    <div class="card">

                                                           
																
																<?php $url = base_url('/uploads/documents/'.$docvalue['categoryID'].'/'.$subcatvalue['id'].'/'.$docvalue['docFile']);?>
																	<tr>
																			<td><?php echo "<a href = '".$url ."'  target='_blank'><img src='assets/images/download1.png' style='width: 40px; height: 40px'></a>" ?></td>
																			<td><?php echo $docvalue['docName'] ?></td>
																			<td><?php echo $docvalue['docFile'] ?></td>
																			<td><?php echo $docvalue['expireDate'] ?></td>
																			<td>
																					<?php 
																					if($docvalue['isActive'] == 1){
																							echo "<span class='badge badge-success'>Active</span>";
																						}
																						else{
																							echo "<span class='badge badge-danger'>InActive</span>";
																							}
																					
																					?>
																			</td>
																	</tr>
																
																
																
                                                                
                                                                
                                                                
                                                           

                                                    </div>
                                                </div>
                                                <?php }}?>
                                                </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <?php  }}?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php  }?>
            </div>
            <!--tbody>
            </tbody-->
            <!--/table-->
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    // $(".manageDocuments-Menu .inner").addClass("show");
      // $(".manageDocuments-Menu .toggle").addClass("activAcc");
      // $(".manageDocuments-Menu .inner").css("display", "block")
      $('.AllDocument-Menu').addClass('active');
</script>
<script src="<?php echo base_url('assets/js/usersTable.js') ?>"></script>
