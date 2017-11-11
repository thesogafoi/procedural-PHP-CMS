
   <?php 
    if (isset($_POST['creat_user']))
    {
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
//        ----------------------------------------------------------------------------------
//        $post_image = $_FILES['image']['name']; //image hamun image k payin tarif karde name 
//        $post_image_temp = $_FILES['image']['tmp_name'];
//        ----------------------------------------------------------------------------------
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        $user_password = password_hash($user_password,PASSWORD_BCRYPT,array('cost' => 12));
//        move_uploaded_file($post_image_temp, "images/$post_image");

    //in k to stringe baraye adresyie k z user migre va mige koja up konam
        
      $query = "INSERT INTO users(user_firstname,user_lastname,user_role,username,user_email,user_password) "; 
         $query .= " VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}','{$user_password}') ";
        //INSERT INTO 'table' (ur column) VALUES('ur values')
        $creat_user_query = mysqli_query($connection,$query);
      
    if (!$creat_user_query)
    {
        die("QUERY FAILED".mysqli_error($connection));
    }
        
        echo "
        <div class='row'>
  <div class='alert alert-success push-center' style='font-size:1.5em;text-align:center;' > Users Created </div>    
            </div>";
    }
?>


    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Firstname</label>
            <input type="text" class="form-control" name="user_firstname">
        </div>
        <hr>
              <div class="form-group">
            <label for="title">Lastname</label>
            <input type="text" class="form-control" name="user_lastname">
        </div>
        <hr>
           <div class="form-group">
          <label for="post_category" class="lead"> role:  </label>
          <div class="row">
          <div class="col-md-2">
           <select name="user_role" id="" class="form-control" style="cursor:pointer">
             
             
             <option value="subscriber">Select Option</option> 
             <option value="subscriber">subscriber</option> 
             <option value="admin">Admin</option> 
             
              
               
           </select>
              </div>
               </div>
        </div>
        <hr>
      <!--  <div class="form-group">
            <label for="image">Post Image</label>
            <input type="file" name="image" class="form-control">
        </div>
      -->
        <div class="form-group">
            <label for="post_tags">Username</label>
            <input type="text" class="form-control" name="username">
        </div>
        <hr>
        <div class="form-group">
            <label for="post_content">Email</label>
              <input type="email" class="form-control" name="user_email">
        </div>
        <hr>
        <div class="form-group">
            <label for="post_content">Password</label>
              <input type="password" class="form-control" name="user_password">
        </div>
        <hr>
        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-block" name="creat_user" value="Creat User">
        </div>
    
    </form>
    
   
  
 