<div class="col-md-4">


    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control" list="search">
                <datalist id="search">
                    <?php 
                    $query = "SELECT post_tags FROM posts";
                    $do_query = mysqli_query($connection,$query);
                    $row =mysqli_fetch_assoc($do_query);
                    $tags = $row['post_tags'];
                    echo "<option>$tags</option>";
                    ?>
                </datalist>
                <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>
    
     <!-- login Well -->
    <div class="well">
        <h4>Login</h4>
        <form action="includes/login.php" method="post">
            <div class="form-group">
                <input name="username" type="text" class="form-control" placeholder="Enter username">
            </div>
            <div class="form-group">
                <input name="password" type="password" class="form-control" placeholder="Enter password">
            </div>
             <div class="form-group">
                <span class="input-group-btn">
                    <button class="btn btn-primary" name="login" type="submit">Login</button>
                </span>
                </div>
            
            
            
        </form>
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <?php 
                     $query = "SELECT * FROM categories LIMIT 3" ;
                        $select_all_categories = mysqli_query($connection,$query);
                        while ($row = mysqli_fetch_assoc($select_all_categories))
                        {
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];
                            echo "<li><a href='category.php?category={$cat_id}'>".$cat_title."</a></li>";
                        }
                                ?>
                        
                </ul>
            </div>
        
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
  <?php include "widget.php"; ?>

</div>