<?php 
    if (isset($_GET['p_id']))
    {
        $the_post_id = $_GET['p_id'];
        
         $query = "SELECT * FROM posts WHERE post_id={$the_post_id}";
        $show_post_by_id = mysqli_query($connection ,$query );
        while($row = mysqli_fetch_assoc($show_post_by_id)){
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_content = $row['post_content'];
    }
         if (isset($_POST['update_post']))
    {       
            $post_title = $_POST['post_title'];
            $post_author = $_SESSION['username'];
            $post_category_id = $_POST['post_category'];
            $post_status = $_POST['post_status'];
            $post_tags = $_POST['post_tags'];
            $post_content = $_POST['post_content'];
            $post_image = $_FILES['post_image']['name']; 
             $post_image_temp = $_FILES['post_image']['tmp_name'];
             move_uploaded_file($post_image_temp, "images/$post_image");
             //UPDATE urtablename SET urcolumnname = 'post_title , post_id' WHERE id=''
               if (!$post_image)
             {
                 $query = "SELECT * FROM posts WHERE post_id ={$the_post_id} ";
                 $select_image = mysqli_query($connection ,$query );
                 while($row = mysqli_fetch_assoc($select_image)){
                     $post_image = $row['post_image'];//temp b manaye movaghat hast 
                     }
             }
             
             $query = "UPDATE posts SET ";
             $query .= "post_title = '{$post_title}', ";
             $query .= "post_category_id = '{$post_category_id}', ";
             $query .= "post_author= '{$post_author}', ";
             $query .= "post_status= '{$post_status}', ";  
             $query .= "post_image = '{$post_image}', ";  
             $query .= "post_tags = '{$post_tags}', ";  
             $query .= "post_content = '{$post_content}', ";  
             $query .= "post_date = now() "; 
             $query .= "WHERE post_id = {$the_post_id} ";
             $update_post = mysqli_query($connection,$query);
             confirmcreatpost($update_post);
             
             echo "
        <div class='row'>
  <div class='alert alert-success push-center' style='font-size:1.5em;text-align:center;' > Post Updated </div>    
            </div>";
             
             
    } 
    }
   
    
?>
   
       
       <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Post title</label>
            <input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>">
        </div>
        <hr>
        <div class="form-group">
          <label for="post_category" class="lead"> Categories  </label>
           <div class="row">
           <div class = "col-md-2">
           <select name="post_category" id="" class="form-control" style="cursor:pointer">
              <?php 
                $query = "SELECT * FROM categories";
                $show_all_categories = mysqli_query($connection,$query );   
                while($row = mysqli_fetch_assoc($show_all_categories)){
                    $the_cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];
                    echo "<option value='{$cat_id}'>{$the_cat_title}</option>";
                }
                
               ?>
              
               
           </select>
           </div>
           </div>
        </div>
        <hr>
       <div class="form-group">
            <h4>Post Author:</h4>
            <h5>   <?php 
                $username = $_SESSION['username'];
                $query = "SELECT * FROM users WHERE username ='{$username}'";
                $select_user = mysqli_query($connection,$query);
                $row = mysqli_fetch_assoc($select_user);
                echo $row['username'];
                ?></h5>
        </div>
        <hr>
        <div class="form-group">
            <label for="post_status" class="lead"> Status </label>
            <div class="row">
           <div class = "col-md-2">
           <select name="post_status" id="" class="form-control" style="cursor:pointer">
             
             <?php 
               if ($post_status=='draft')
               {
                   echo '<option value="draft">Draft</option> ';
                   echo '<option value="published">Published</option>';
               }else{
                   echo '<option value="published">Published</option>';
                   echo '<option value="draft">Draft</option> ';
               }
               
               
               ?>
             
           </select>
                </div>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <label for="image">Post Image</label>
            <input type="file" name="post_image" class="form-control" >
            <img src="images/<?php echo $post_image; ?>" width="100" alt="">
        </div>
        <hr>
        <div class="form-group">
            <label for="post_tags">Post Tags</label>
            <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
        </div>
        <hr>
        <div class="form-group">
            <label for="post_content">Post Content</label>
            <textarea name="post_content" class="form-control" id="" cols="30" rows="10"><?php echo $post_content; ?></textarea>
        </div>
        <hr>
        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-block" name="update_post" value="Update Post">
        </div>

    </form>