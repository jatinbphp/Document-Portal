<!DOCTYPE html>
<html>

<head>
  <title></title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
   <style> .container {
      max-width: 500px;
    }

    .error {
      display: block;
      padding-top: 5px;
      font-size: 14px;
      color: red;
    }
  </style>
</head>

<body>
  <div class="container mt-5">

  <h1>Update Data</h1>

  
      <form method="post" id="update_user" name="update_user" 
    action="<?php echo base_url('updateuser/'.$user_obj['id']);?>">
        
         
      <div class="form-group">
        <label>First Name</label>
        <input type="text" name="fname" class="form-control" value="<?php echo $user_obj['fname']; ?>">
      </div>
      <div class="form-group">
        <label>Last Name</label>
        <input type="text" name="lname" class="form-control" value="<?php echo $user_obj['lname']; ?>">
      </div>

      <div class="form-group">
        <label>Email</label>
        <input type="text" name="email" class="form-control" value="<?php echo $user_obj['email']; ?>">
      </div>
     
      <div class="form-group">
        <button type="submit" class="btn btn-warning">Edit Data</button>
      </div>
     
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
  <script>
    if ($("#update_user").length > 0) {
      $("#update_user").validate({
        rules: {
          fname: {
            required: true,
          },
          lname: {
            required: true,
          },
          email: {
            required: true,
            maxlength: 60,
            email: true,
          },
        },
        messages: {
          fname: {
            required: "First Name is required.",
          },
          lname: {
            required: "Last Name is required.",
          },
          email: {
            required: "Email is required.",
            email: "It does not seem to be a valid email.",
            maxlength: "The email should be or equal to 60 chars.",
          },
        },
      })
    }
  </script>
</body>

</html>