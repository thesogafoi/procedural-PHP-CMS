<?php 
include "includes/header.php";
?>
    <?php 
include "includes/db.php";
?>
        <?php 
include "includes/nav.php";
?>
           
           
    <?php 

           if (isset($_POST['submit']))
           {
               
               $username = $_POST['username'];
               $password = $_POST['password'];
               $re_password = $_POST['re_password'];
               $email = $_POST['email'];
               if ($username != "" && $password != "" && $email != "" )
               {
                         
               $username = mysqli_real_escape_string($connection,$username);
               $password = mysqli_real_escape_string($connection,$password);
               $re_password = mysqli_real_escape_string($connection,$re_password);
               $email = mysqli_real_escape_string($connection,$email);
            
                   if ($re_password == $password)
                   { 
                $password = password_hash($password,PASSWORD_BCRYPT,array('cost' => 12)); ;  
               $query = "INSERT INTO users (user_role,username,user_email,user_password) "; 
         $query .= "                                                                                  VALUES('subscriber','{$username}','{$email}','{$password}') ";
               
               
             $register_user_query = mysqli_query($connection ,$query );
               if (!$register_user_query)
               {
                   die("QUERY FAILED".mysqli_error($connection));
               }
                   $error = "<div class='alert alert-success' style='text-align:center'>Register Completed</div>";
                   
               }else{
                   $error = "<div class='alert alert-danger' style='text-align:center'>PLease Enter Corrent Password</div>";
               } 
                   }else{
                   $error = "<div class='alert alert-danger' style='text-align:center'>Fields Cannot Be Empty</div>";
               }      
               
           }
            


?>
            <!-- Page Content -->
            <section id="login">
                <div class="container">
                    <div class="row">

                        <div class="col-xs-6 col-xs-offset-3">
                            <div class="form-wrap">
                                <h1>Register</h1>
                                
                            <?php if (isset($error))
                            {
                                echo $error;
                            } ?>
                                <form action="registration.php" method="post" id="login-form" autocomplete="off">
                                    <div class="form-group">
                                        <lable for="username" class="sr-only">Username</lable>
                                        <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <lable for="email" class="sr-only">Email</lable>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Somebody@Example.com">
                                    </div>
                                    <div class="form-group">
                                        <lable for="password" class="sr-only">Password</lable>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <lable for="re_password" class="sr-only">Re_Password</lable>
                                        <input type="password" name="re_password" id="re_password" class="form-control" placeholder="Re_Password">
                                    </div>

                                    <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </section>
            <hr>
            <?php 
        include "includes/footer.php";
        ?>