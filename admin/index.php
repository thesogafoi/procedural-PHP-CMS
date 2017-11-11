<?php 
    include "includes/admin_header.php";
?>
    <div id="wrapper">
<?php 
            
        ?>
       
       
       
       
       
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
                       
                    </div>
                </div>
                
                    <div class="row">
                          <div class="col-lg-3 col-md-6">
                           <div class="panel panel-primary">
                               <div class="panel-heading">
                                   <div class="row">
                                       <div class="col-xs-3">
                                           <i class="fa fa-file-text fa-5x"></i>
                                       </div>
                                       <div class="col-xs-9 text-right">
                                          <?php 
                                            $query = "SELECT * FROM posts";
                                            $view_posts = mysqli_query($connection,$query);
                                            $post_counts = mysqli_num_rows($view_posts);
                                           echo "<div class='huge'>$post_counts</div>";
                                           ?>
                                          
                                          
                                           
                                           <div>Posts</div>
                                       </div>
                                   </div>
                               </div>
                               <a href="posts.php">
                               <div class="panel-footer">
                                    <span class="pull-left">Details...</span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                               </div>
                               </a>
                           </div>
                       </div>
                         <div class="col-lg-3 col-md-6">
                           <div class="panel panel-green">
                               <div class="panel-heading">
                                   <div class="row">
                                       <div class="col-xs-3">
                                           <i class="fa fa-comments fa-5x"></i>
                                       </div>
                                       <div class="col-xs-9 text-right">
                                           <?php 
                                            $query = "SELECT * FROM comments";
                                            $view_comments = mysqli_query($connection,$query);
                                            $comment_counts = mysqli_num_rows($view_comments);
                                           echo "<div class='huge'>$comment_counts</div>";
                                           ?>
                                           <div>Comments</div>
                                       </div>
                                   </div>
                               </div>
                               <a href="comments.php">
                               <div class="panel-footer">
                                    <span class="pull-left">Details...</span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                               </div>
                               </a>
                           </div>
                       </div>
                         <div class="col-lg-3 col-md-6">
                           <div class="panel panel-yellow">
                               <div class="panel-heading">
                                   <div class="row">
                                       <div class="col-xs-3">
                                           <i class="fa fa-users fa-5x"></i>
                                       </div>
                                       <div class="col-xs-9 text-right">
                                           <?php 
                                            $query = "SELECT * FROM users";
                                            $view_users = mysqli_query($connection,$query);
                                            $user_counts = mysqli_num_rows($view_users);
                                           echo "<div class='huge'>$user_counts</div>";
                                           ?>
                                           <div>Users</div>
                                       </div>
                                   </div>
                               </div>
                               <a href="users.php">
                               <div class="panel-footer">
                                    <span class="pull-left">Details...</span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                               </div>
                               </a>
                           </div>
                       </div>
                         <div class="col-lg-3 col-md-6">
                           <div class="panel panel-red">
                               <div class="panel-heading">
                                   <div class="row">
                                       <div class="col-xs-3">
                                           <i class="fa fa-database fa-5x"></i>
                                       </div>
                                       <div class="col-xs-9 text-right">
                                           <?php 
                                            $query = "SELECT * FROM categories";
                                            $view_categories = mysqli_query($connection,$query);
                                            $category_counts = mysqli_num_rows($view_categories);
                                           echo "<div class='huge'>$category_counts</div>";
                                           ?>
                                           <div>Categories</div>
                                       </div>
                                   </div>
                               </div>
                               <a href="categories.php">
                               <div class="panel-footer">
                                    <span class="pull-left">Details...</span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                               </div>
                               </a>
                           </div>
                       </div>
                    </div>
                
                <!-- /.row -->
                    
                <?php 
                 $query = "SELECT * FROM posts WHERE post_status = 'published'";
                                            $view_published_post = mysqli_query($connection,$query);
                                            $published_post_counts = mysqli_num_rows($view_published_post);
                
                $query = "SELECT * FROM posts ";
                                            $all_post = mysqli_query($connection,$query);
                                            $all_posts_counts = mysqli_num_rows($all_post);
                $query = "SELECT * FROM posts WHERE post_status = 'draft'";
                                            $view_draft_post = mysqli_query($connection,$query);
                                            $draft_post_counts = mysqli_num_rows($view_draft_post);
                $query = "SELECT * FROM comments WHERE comment_status = 'unapprove'";
                                            $unaproved_comments_query = mysqli_query($connection,$query);
                                            $unaproved_comments_counts = mysqli_num_rows($unaproved_comments_query);
                
                $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
                                            $view_all_subscribers = mysqli_query($connection,$query);
                                            $subscriber_counts = mysqli_num_rows($view_all_subscribers);
                
                
                ?>
                    
                    
                   <div class="row">
                         <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],
            <?php 
                $element_text = ['All Posts','Active Posts','Draft Posts','Comments','Pending Comments','Users','Subscribers','Categories'];
                $element_count = [$all_posts_counts,$published_post_counts,$draft_post_counts,$comment_counts ,$unaproved_comments_counts, $user_counts,$subscriber_counts,$category_counts];
                for ($i = 0; $i < 8 ; $i++)
                {
                    echo "['{$element_text[$i]}'".","."{$element_count[$i]}],";
                }
            
            ?>
            
            
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, options);
      }
    </script>
<div id="columnchart_material" style="'auto'; height: 500px;"></div>


                       
                   </div>
                    
                    
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include "includes/admin_footer.php"; ?>