<style type="text/css">
	.media-body.company {
    padding-left: 10px;
    color: white;
}
img.company {
    padding-left: 90px;
}
img.user {
    padding-left: 73px;
}
 table tbody td .commentAdd {
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
    table tbody td, table tbody td .commentAdd {
        transition: all .4s ease-in-out;
    }
</style>

<?php
if($_SESSION['user_type'] == 3){ ?>
	<div class="wrapper">
		<div class="row stats mb-5">
			
			<div class="col-md-6 col-lg-3 col-xl-3">
				<div class="box coleql_height">
					<div class="media">
						<a href="<?php echo base_url('/subadminworkflow');?>">
						<div class="media-body company">
							<h3><?php echo $compTotal; ?></h3>
							<?php echo strtoupper('Company'); ?>
						</div>
						<div class="icon"><a href="<?php echo base_url('/subadminworkflow');?>"><img  class ="company"src="<?php echo base_url('assets/images/company.png'); ?>" alt=""></a></div>
					</div>
				</a>
				</div>
			</div>
			
			
		<!--/div-->
	<!--/div-->
	
	
			<!-- <div class="col-md-6 col-lg-3 col-xl-3">
				<div class="box coleql_height">
					<div class="media">
						<div class="media-body">
							<h3><?php echo $workflowTotal; ?></h3>
							<?php echo strtoupper('Workflow'); ?>
						</div>
						<div class="icon"><a href="<?php echo base_url('/userDocuments');?>"><img src="<?php echo base_url('assets/images/document.png'); ?>" alt=""></a></div>
					</div>
				</div>
			</div> -->
			
		</div>
		<!--  <div class="item-wrap item-list-table companyTable">
                <table id="subadminCompanyTable" class="table table-bordered" cellspacing="0" width="100%" >
                    <thead class="thead-dark">
                        <tr>
                            <th style="width: 50%">Company</th>
                        </tr>
                         
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div> -->

	<table class="table mb-0">
		<thead class="thead-dark">
			<tr>

			<th scope="col">Company</th>
			</tr>
		</thead>
			<tbody>


				<tr>
				<?php foreach($totalcompany as $value){ ?>
				<td><b><?php echo $value['companyName']?></b></td></tr>

				<?php   $db = \Config\Database::connect(); 
				$array = array('company_id' => $value['company_id'], 'is_active' => 3);
				$builder = $db->table('document_workfolw');
				$buildersql1 =$builder->select('document_workfolw.*, Company.companyName as companyName,category.categoryName as categoryName,SubCategory.SubCatName as SubCatName,UserTypes.userTypeName as userTypeName');
				$buildersql2 = $buildersql1->join('Company', 'document_workfolw.company_id = Company.id');
				$buildersql2 = $buildersql1->join('category', 'document_workfolw.category_id = category.id');
				$buildersql2 = $buildersql1->join('SubCategory', 'document_workfolw.subcategory_id = SubCategory.id');
				$buildersql2 = $buildersql1->join('UserTypes', 'document_workfolw.usertype_id = UserTypes.id');
				$builder3 = $buildersql2->where($array);
				$data_documents = $builder3->get()->getResultArray(); ?>
				<?php if(count($data_documents)>0){ ?>

				
				<table class="table table-bordered">
					<thead class="thead-light" >
						<tr>
							<th>Document Name</th>
							<th>User Type</th>
							<th>Category</th>
							<th>Sub Category</th>
							<th>Company</th>
							<th>Comments</th>
							<th>Expire Date</th>
							<th>Status</th>
							<th> files</th>
						<!-- </tr> -->
						</thead>
					<tbody>
						<tr>
						<?php foreach ($data_documents as $val) { ?>
						<tr><td> <?php echo $val['document_name'];?></td>
						<td> <?php echo $val['userTypeName'];?></td>
						<td> <?php echo $val['categoryName'];?></td>
						<td> <?php echo $val['SubCatName'];?></td>
						<td> <?php echo $val['companyName'];?></td>
						<td> <span class="commentAdd tip" tabindex="0" data-toggle="tooltip" data-placement="top" title="<?php echo $val['comments']; ?>"><?php echo $val['comments']; ?></span></td>
						<td> <?php echo $val['expire_date'];?></td>
						<td>
						<?php if($val['is_active'] == 1){
						echo '<span class="badge badge-success">APPROVED</span>';
						}elseif($val['is_active'] == 2){
						echo '<span class="badge badge-primary">SUBMITED</span>';
						}elseif($val['is_active'] == 3){
						echo '<span class="badge badge-danger">EXPIRED</span>';
						}
						?>

						</td>
						<td> <?php echo'<a href = "' . base_url( '/workflow/download_documents/'.$val['id']). '" class="btn btn-primary" style="margin: 0px 5px 5px 0px;padding: 4px 9px;font-size: 14px;" target="_blank"><i class="fa fa-file"></i></a>'; ?></td>

						<?php   }?>
						</tr>

				</tbody>
			</table>
		<?php } ?>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>

	
	
<?php }else{ ?>
		<div class="wrapper">
		<div class="row stats">
			
			<div class="col-md-6 col-lg-3 col-xl-3">
				<div class="box coleql_height">
					<div class="media">
						<a href="<?php echo base_url('/userDocuments');?>">
						<div class="media-body company">
							<h3><?php echo $tatalDoc; ?></h3>
							<?php echo strtoupper('Documents'); ?>
						</div>
						<div class="icon"><a href="<?php echo base_url('/userDocuments');?>"><img class ="user" src="<?php echo base_url('assets/images/document.png'); ?>" alt=""></a></div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>

<script src="<?php echo base_url('assets/js/usersDataTable.js') ?>"></script>
<script>
	$('.Dashboard-Menu').addClass('active');
	 $(document).ready(function () {
        new bootstrap.Tooltip(document.body, {
            selector: '.tip'
        });
    });

</script>