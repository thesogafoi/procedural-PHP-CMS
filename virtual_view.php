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
                        
                        
                        if (isset($_GET['virtual_id']))
                        {
                            
                        if (isset($_GET['virtual_id']))
                        {
                     $the_post_id = $_GET['virtual_id'];
                     $query = "SELECT * FROM posts WHERE post_id= {$the_post_id}";
                     $select_id_post = mysqli_query($connection,$query);
                     while($row = mysqli_fetch_assoc($select_id_post)){
                     $post_title = $row['post_title'];
                     $post_id= $row['post_id'];
                     $post_author = $row['post_author'];
                     $post_date = $row['post_date'];
                     $post_image = $row['post_image'];
                     $post_content = $row['post_content'];
                   
                        }
                          
                        
                 ?>

                            <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                            <!-- First Blog Post -->
                            <h2>
                    <a href=""><?php echo $post_title; ?></a>
                </h2>
                            <p class="lead">
                                by
                                <a href="">
                                    <?php echo $post_author; ?>
                                </a>
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