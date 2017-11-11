
   <?php 
    if (isset($_POST['creat_post']))
    {
        $post_title = $_POST['post_title'];
        $post_author = $_SESSION['username'];
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST['post_status'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
//        ----------------------------------------------------------------------------------
        $post_image = $_FILES['image']['name']; //image hamun image k payin tarif karde name 
        $post_image_temp = $_FILES['image']['tmp_name'];
//        ----------------------------------------------------------------------------------
        $post_date = date('d-m-y');
        move_uploaded_file($post_image_temp, "images/$post_image");

    //in k to stringe baraye adresyie k z user migre va mige koja up konam
        
      $query = "INSERT INTO  posts (post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status) "; 
         $query .= " VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}') ";
        //INSERT INTO 'table' (ur column) VALUES('ur values')
        $creat_post_category = mysqli_query($connection,$query);
      
    if (!$creat_post_category)
    {
        die("QUERY FAILED".mysqli_error($connection));
    }
        
        echo "
        <div class='row'>
  <div class='alert alert-success push-center' style='font-size:1.5em;text-align:center;' > Post Created </div>    
            </div>";
    }
?>


    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Post title</label>
            <input type="text" class="form-control" name="post_title">
        </div>
        <hr>
           <div class="form-group">
           <div class="row">
           <div class="<col-md-2></col-md-2>">
          <label for="post_category" class="lead">Categories</label>
          <div class = "row">
          <div class="col-md-2">
           <select name="post_category" id="" class="form-control" style="cursor:pointer">
 >
              <?php 
                $query = "SELECT * FROM categories";
                $show_all_categories = mysqli_query($connection,$query );   
                while($row = mysqli_fetch_assoc($show_all_categories)){
                    $the_cat_title = $row['cat_title'];
                    $cat_id  = $row['cat_id'];
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
         <div class="row">
           <div class="col-md-2">
          <label for="post_status" class="lead"> Status  </label>
           <select name="post_status" id="" class="form-control" style="cursor:pointer">
             
             
             <option value="draft">Draft</option> 
             <option value="published">Published</option> 
             
              
               
           </select>
             </div>
             </div>
        </div>
        <hr>
        <div class="form-group">
            <label for="image">Post Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <hr>
        <div class="form-group">
            <label for="post_tags">Post Tags</label>
            <input type="text" class="form-control" name="post_tags">
        </div>
        <hr>
        <div class="form-group">
            <label for="post_content">Post Content</label>
            <textarea name="post_content" class="form-control" id="" cols="30" rows="10"></textarea>
        </div>
        <hr>
        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-block" name="creat_post" value="Creat Post">
        </div>
               </div>
        </div>
    </form>