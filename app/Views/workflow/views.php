<style>
	.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 20px;
    margin-top: 50px;
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

           

            <div class="item-wrap item-list-table">
                <table id="workflowTable" class="table table-bordered" cellspacing="0" width="100%" >

                   
                <thead>
			    <tr>
			      <th scope="col">Download Documents</th>
			      <th scope="col">Document Name</th>
			      <th scope="col">Document File</th>
			    </tr>
			  </thead>
			  <tbody>
  	
				  	<?php 

				  	if(count($documents)>0){

					  	foreach ($documents as $value) { ?>
					  		<?php $url = base_url('/uploads/workflow/'.$value['documents']);?>
					  	
					  		<?php $imgsrc = base_url('assets/images/download1.png');?>
					  	<tr>
					      <td><?php echo "<a href = '".$url ."'  target='_blank'><img src='".$imgsrc."' style='width: 40px; height: 40px'></a>" ?></td>
					      <td><?php echo $name; ?></td>
					      <td><?php echo $value['documents']; ?></td>
					    </tr><?php 

						}
					}else{?>
						<tr><td>No Data Found..</td></tr>
				<?php	}?>
				   
    
  					</tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Download Documents</th>
      <th scope="col">Document Name</th>
      <th scope="col">Document File</th>
    </tr>
  </thead>
  <tbody>
  	
  	<?php 

  	if(count($documents)>0){

	  	foreach ($documents as $value) { ?>
	  		<?php $url = base_url('/uploads/workflow/'.$value['documents']);?>
	  	
	  		<?php $imgsrc = base_url('assets/images/download1.png');?>
	  	<tr>
	      <td><?php echo "<a href = '".$url ."'  target='_blank'><img src='".$imgsrc."' style='width: 40px; height: 40px'></a>" ?></td>
	      <td><?php echo $name; ?></td>
	      <td><?php echo $value['documents']; ?></td>
	    </tr><?php 

		}
	}else{?>
		<tr><td>No Data Found..</td></tr>
<?php	}?>
   
    
  </tbody>
</table> -->