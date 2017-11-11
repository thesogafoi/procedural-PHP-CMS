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
                        
                        if (isset($_POST['submit']))
                        {
                            $search = $_POST['search'];
                            $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
                            $search_posts = mysqli_query($connection,$query);
                            if (!$search_posts)
                            {
                                die("Query FAILED".mysqli_error($connection));
                                
                            }else{
                                $rows = mysqli_num_rows($search_posts);
                                if ($rows == 0)
                                {
                                    echo '<h1> NO Result </h1>';
                                }else{
                                
                     while($row = mysqli_fetch_assoc($search_posts)){
                     $post_title = $row['post_title'];
                     $post_author = $row['post_author'];
                     $post_date = $row['post_date'];
                     $post_image = $row['post_image'];
                     $post_content = $row['post_content'];
                        ?> 
                        
                            <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                            <!-- First Blog Post -->
                            <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                            <p class="lead">
                                by <a href="index.php"><?php echo $post_author; ?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                            <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                            <p><?php echo $post_content; ?></p>
                            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                            <hr> <?php 
                            }
                        }
                 }
              }
               ?>
                        

                            <!-- Pager -->
                            <ul class="pager">
                                <li class="previous">
                                    <a href="#">&larr; Older</a>
                                </li>
                                <li class="next">
                                    <a href="#">Newer &rarr;</a>
                                </li>
                            </ul>

                    </div>

                    <!-- Blog Sidebar Widgets Column -->
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