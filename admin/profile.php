<?php 
    include "includes/admin_header.php";
?>
   
   
   <?php
            if (isset($_SESSION['username']))
            {
                $username = $_SESSION['username'];
                $query = "SELECT * FROM users WHERE username = '{$username}'";
                $select_user_profile_query = mysqli_query($connection ,$query );
                if ($row = mysqli_fetch_array($select_user_profile_query))
                {
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

    //in k to stringe baraye adresyie k z user migre va mige koja up konam
             $query = "UPDATE users SET ";
             $query .= "user_firstname = '{$user_firstname}', ";
             $query .= "user_lastname = '{$user_lastname}', ";
             $query .= "user_role = '{$user_role}', ";
             $query .= "username = '{$username}', ";  
             $query .= "user_email = '{$user_email}', ";  
             $query .= "user_password = '{$user_password}' "; 
             $query .= "WHERE username = '{$username}' ";
             $edit_user_query = mysqli_query( $connection ,$query );
             confirmcreatpost($edit_user_query);
            }

}



?>
    <div id="wrapper">

        <!-- Navigation -->
   <?php  include "includes/admin_nav.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome To Admin 
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                        
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
            <select name="user_role" id="" class="form-control" style="cursor:pointer">


                <option value="subscriber" >
                    <?php echo $user_role; ?>
                </option>
                <?php 
                    if ($user_role == 'admin')
                    {
                        echo '<option value="subscriber" style="cursor:pointer">subscriber</option>';
                        
                    }else{
                        echo '<option value="admin" style="cursor:pointer">Admin</option>';
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
            <input type="password" class="form-control" name="user_password" value ="<?php echo $user_password; ?>" >
        </div>
        <hr>
        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-block" name="edit_user" value="Update profile">
        </div>

    </form>
                    
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include "includes/admin_footer.php"; ?>