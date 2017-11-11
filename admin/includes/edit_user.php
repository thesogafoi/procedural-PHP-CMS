<?php 

if (isset($_GET['edit_user']))
        {
          $the_user_id = $_GET['edit_user'];
          $query = "SELECT * FROM users WHERE user_id = {$the_user_id}";
          $show_all_users = mysqli_query($connection ,$query );
           while($row = mysqli_fetch_assoc($show_all_users)){
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
    
}


    if (isset($_POST['edit_user']))
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
//        move_uploaded_file($post_image_temp, "images/$post_image");

       $user_password_hashed = password_hash($user_password,PASSWORD_BCRYPT,array('cost' => 12));
        
        
        
        
    //in k to stringe baraye adresyie k z user migre va mige koja up konam
             $query = "UPDATE users SET ";
             $query .= "user_firstname = '{$user_firstname}', ";
             $query .= "user_lastname = '{$user_lastname}', ";
             $query .= "user_role = '{$user_role}', ";
             $query .= "username = '{$username}', ";  
             $query .= "user_email = '{$user_email}', ";  
             $query .= "user_password = '{$user_password_hashed}' "; 
             $query .= "WHERE user_id = {$the_user_id} ";
             $edit_user_query = mysqli_query( $connection ,$query );
             confirmcreatpost($edit_user_query);
         echo "
        <div class='row'>
  <div class='alert alert-success push-center' style='font-size:1.5em;text-align:center;' > User Updated </div>    
            </div>";
       
        
  }
}
     
?>


    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Firstname</label>
            <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
        </div>
        <hr>
        <div class="form-group">
            <label for="title">Lastname</label>
            <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
        </div>
        <hr>
        <div class="form-group">
            <label for="post_category" class="lead"> role: </label>
            <div class="row">
            <div class="col-md-2">
            <select name="user_role" id="" style="cursor:pointer" class="form-control">


                <option value="subscriber">
                    <?php echo $user_role; ?>
                </option>
                <?php 
                    if ($user_role == 'admin')
                    {
                        echo '<option value="subscriber">subscriber</option>';
                        
                    }else{
                        echo '<option value="admin">Admin</option>';
                    }
                ?>






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
            <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
        </div>
        <hr>
        <div class="form-group">
            <label for="post_content">Email</label>
            <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
        </div>
        <hr>
        <div class="form-group">
            <label for="post_content">Password</label>
            <input type="password" class="form-control" name="user_password" value ="<?php echo $user_password; ?>">
        </div>
        <hr>
        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-block" name="edit_user" value="Update User">
        </div>

    </form>