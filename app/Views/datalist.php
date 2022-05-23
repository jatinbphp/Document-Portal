<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>List</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<div class="container mt-4">

<h1>List Data</h1>

    <div class="d-flex justify-content-end">
        <a href="<?php echo site_url('/adduser') ?>" class="btn btn-primary">Add</a>
   </div>


    <!-- <?php
     if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
      }
     ?> -->
  <div class="mt-3">
     <table class="table table-bordered" id="users-list">
       <thead>
          <tr>
             <th>User Id</th>
             <th>Name</th>
             <th>Email</th>
             <th>Action</th>

          </tr>
       </thead>
       <tbody>
         
           <?php if($ListData): ?>
          <?php foreach($ListData as $user): 
            ?>
          <tr>
             <td><?php echo $user['id']; ?></td>
             <td><?php echo $user['fname']; ?></td>
             <td><?php echo $user['lname']; ?></td>
              <td><?php echo $user['email']; ?></td>
             <td>
              <a href="<?php echo base_url('edituser/'.$user['id']);?>" class="btn btn-warning">Edit</a>
              <a href="<?php echo base_url('delete/'.$user['id']);?>" class="btn btn-danger">Delete</a>
              </td>
          </tr>
          <?php endforeach; ?>
         <?php endif; ?> 
       </tbody>
     </table>
  </div>
</div>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
      $('#users-list').DataTable();
  } );
</script> -->
</body>
</html>