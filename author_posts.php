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
                        if (isset($_GET['author']))
                        {
                     $the_author = $_GET['author'];
                     $query = "SELECT * FROM posts WHERE post_author= '{$the_author}'";
                     $select_post = mysqli_query($connection,$query);
                     while($row = mysqli_fetch_assoc($select_post)){
                     $post_title = $row['post_title'];
                     $post_id= $row['post_id'];
                     $post_author = $row['post_author'];
                     $post_date = $row['post_date'];
                     $post_image = $row['post_image'];
                         $post_content = substr($row['post_content'],0 , 80)."...";
                   
                        
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
                               All Posts by
                                
                                    <?php echo $post_author; ?>
                                
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span>
                                <?php echo $post_date; ?>
                            </p>
                            <img class="img-responsive" src="admin/images/<?php echo $post_image; ?>" alt="">
                            <p>
                                <?php echo $post_content; ?>
                            </p>
<a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                            <hr>

                            <?php 
                    }}
               ?>

                    </div>

                    <?php 
        include "includes/sidebar.php";
        ?>

                </div>
                <!-- /.row -->

                <hr>
                <?php 
        include "includes/footer.php";
        ?>