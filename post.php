<?php 
include "includes/header.php";
?>
    <?php 
include "includes/db.php";
?>
        <?php 
include "includes/nav.php";
?>
            <!-- Page Content -->
            <div class="container">

                <div class="row">

                    <!-- Blog Entries Column -->
                    <div class="col-md-8">
                        <?php 
                        if (isset($_GET['p_id']))
                        {
                     $the_post_id = $_GET['p_id'];
                            
                            
                     $query = "SELECT * FROM posts WHERE post_id= {$the_post_id}";
                     $select_id_post = mysqli_query($connection,$query);
                     while($row = mysqli_fetch_assoc($select_id_post)){
                     $post_title = $row['post_title'];
                     $post_id= $row['post_id'];
                     $post_author = $row['post_author'];
                     $post_date = $row['post_date'];
                     $post_image = $row['post_image'];
                     $post_content = $row['post_content'];
                     $post_views_count = $row['post_views_count'];
                            $query = "UPDATE posts SET post_views_count = $post_views_count + 1 WHERE post_id = {$the_post_id}";
                            $send_query = mysqli_query($connection ,$query );
                            if (!$send_query)
                            {
                              die("Query failed".mysqli_error($connection));
                            }
                   
                        }
                          
                        
                 ?>

                            <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                            <!-- First Blog Post -->
                            <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                            <p class="lead">
                                by <a href="author_posts.php?author=<?php echo $post_author; ?>"><?php echo $post_author; ?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span>
                                <?php echo $post_date; ?>
                            </p>
                            <img class="img-responsive" src="admin/images/<?php echo $post_image; ?>" alt="">
                            <p>
                                <?php echo $post_content; ?>
                            </p>

                            <hr>

                            <?php 
                    }else{
                            
                        }
               ?>

                                <!-- Comments Form -->
                                <?php 
                        if (isset($_POST['creat_comment']))
                        {
                        $the_post_id =  $_GET['p_id'];
                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];
                            if ($comment_author!="" && $comment_email!=""&&$comment_content!="")
                            {
                                $query = "INSERT INTO comments (comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date) VALUES($the_post_id,'{$comment_author}','{$comment_email}','{$comment_content}','unapprove',now())";
                            $creat_comment_query = mysqli_query($connection ,$query );
                            if (!$creat_comment_query)
                            {
                                die("Query failed".mysqli_error($connection));
                            }
//                            
//                            $query = "UPDATE posts SET post_comment_count= post_comment_count + 1 ";
//                            $query .=" WHERE post_id= $the_post_id";
//                            $update_comment_count = mysqli_query($connection,$query );
                                
                                echo "<div class='alert alert-success'>Comment has been sent</div>";
                            }else{
                                    echo "<div class='alert alert-danger'>Fileds Cannot be Empty</div>";
                            
                            }
                            
                            
                            
                          }
                        ?>
                                    <div class="well">
                                        <h4>Leave a Comment:</h4>
                                        <form role="form" action="" method="post">
                                            <div class="form-group">
                                                <label for="author">Author</label>
                                                <input type="text" class="form-control" name="comment_author">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" name="comment_email">
                                            </div>
                                            <div class="form-group">
                                                <label for="comment">Your Comment</label>
                                                <textarea name="comment_content" class="form-control" rows="3"></textarea>
                                            </div>
                                            <button type="submit" name="creat_comment" class="btn btn-primary">Creat Comment</button>
                                        </form>
                                    </div>

                                    <hr>

                         <h3>Comments :</h3><br>
                                    <!-- Posted Comments -->

                                    <!-- Comment -->
                                    
                                    
                <?php   
                         $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} AND comment_status = 'approve' ";
                         $query .= "ORDER BY comment_id DESC";
                         $select_comment_query = mysqli_query($connection,$query);
                        if (!$select_comment_query)
                        {
                            die("QUERY FAILED ".mysqli_error($connection));
                            
                        }
                        while($row = mysqli_fetch_array($select_comment_query)){
                            $comment_author = $row['comment_author'];
                            $comment_date = $row['comment_date'];
                            $comment_content = $row['comment_content'];
                        ?>
                          <hr>
                          <div class="media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4> <?php echo $comment_content; ?>
                                        </div>
                                    </div>
                          <hr>
                          
                           <?php
                            
                        }
                        
                        
                        
                ?>
                                    

                    </div>

                    <hr>
                    <?php 
        include "includes/sidebar.php";
        ?>

                </div>
                <!-- /.row -->

                <hr>
                <?php 
        include "includes/footer.php";
        ?>