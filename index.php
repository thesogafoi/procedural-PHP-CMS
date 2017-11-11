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
                        $query = "SELECT * FROM posts WHERE post_status='published'";
                        $select_count_post = mysqli_query($connection,$query);
                        if (!$select_count_post)
                        {
                            die("QUERY FAILED".mysqli_error($connection));
                        }
                        $count = mysqli_num_rows($select_count_post);
                         if (isset($_GET['page']))
                        {
                            $page = $_GET['page'];
                        }else{
                            $page="";
                        }
                        if ($page==""||$page==1)
                        {
                            $page_1 = 0;
                        }else{
                            $page_1 = ($page*5)-5;
                        }
                       $count = ceil($count/5);
                     $query = "SELECT * FROM posts WHERE post_status='published' ORDER BY post_id DESC LIMIT $page_1 ,5 ";
                     $select_all_post = mysqli_query($connection,$query);
                     while($row = mysqli_fetch_assoc($select_all_post)){
                     $post_title = $row['post_title'];
                     $post_id= $row['post_id'];
                     $post_author = $row['post_author'];
                     $post_date = $row['post_date'];
                     $post_image = $row['post_image'];
                     $post_content = substr($row['post_content'],0 , 100)."...";
                     $post_status= $row['post_status'];
                         
                         if ($post_status == 'published')
                         {
                            
                             
                         
                        
              
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
                            <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                            <a href="post.php?p_id=<?php echo $post_id;?>"> <img class="img-responsive" src="admin/images/<?php echo $post_image; ?>" alt=""></a>
                            <p><?php echo $post_content; ?></p>
                            <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                            <hr>

<?php 
                    } }?>
                            <!-- Pager --> 
                            <ul class="pager">
                            <?php 
                                for ($i = 1; $i <= $count; $i++)
                                {
                                    if ($i == $page)
                                    {
                                        echo "<li><a class='active_link' href='index.php?page={$i}'>$i</a></li>";
                                    }else{
                                        echo "<li><a href='index.php?page={$i}'>$i</a></li>";
                                    }
                                }
                                
                                ?>
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