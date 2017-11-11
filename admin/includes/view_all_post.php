<?php
if (isset($_POST['apply']))
{
    

    if (isset($_POST['checkboxarray']))
    {
        foreach ($_POST['checkboxarray'] as $valueid)
        {
               $bulk_option = $_POST['bulk_option'];
                switch ($bulk_option)
                {
                    case 'published':
                        $query = "UPDATE posts SET post_status='$bulk_option' WHERE post_id='{$valueid}'";
                        $update_to_publish_post = mysqli_query($connection,$query);
                        
                        break;
                    case 'draft':
                        $query = "UPDATE posts SET post_status='$bulk_option' WHERE post_id='{$valueid}'";
                        $update_to_draft_post = mysqli_query($connection,$query);
                        break;
                    case 'delete':
                        $query = "DELETE FROM posts WHERE post_id = '{$valueid}'";
                        $delete_post = mysqli_query($connection,$query);
                        break;
                    case 'clone':
                        $query = "select * FROM posts WHERE post_id = '{$valueid}'";
                        $select_post_query = mysqli_query($connection,$query);
                        while($row = mysqli_fetch_assoc($select_post_query)){

                                $post_title = $row['post_title'];
                                $post_author = $row['post_author'];
                                $post_category_id = $row['post_category_id'];
                                $post_status = $row['post_status'];
                                $post_image = $row['post_image'];
                                $post_tags = $row['post_tags'];
                                $post_comment_count = $row['post_comment_count'];
                                $post_content = $row['post_content'];
                                
                        }

                          $query = "INSERT INTO  posts  (post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status) "; 
         $query .= " VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}') ";
                            $copy_query= mysqli_query($connection,$query);

                        if (!$copy_query)
                        {
                            die("QUERY FAILED".mysqli_error($connection));
                        }
                        
                        break;
                    default:
                        break;
                }
        }       
    }
    }

?>
  
  
  <form action="" method="post">
   <table class="table table-striped table-bordered" >
  <div class="row">
   <div id="bulkOptionContainer" class="col-xs-4">
      <select name="bulk_option" id="" class="form-control" style="cursor:pointer" >
          <option value="">Select Option</option>
          <option value="published">Publish</option>
          <option value="draft">Draft</option>
          <option value="delete">Delete</option>
          <option value="clone">Clone</option>
      </select>
       
   </div>
   <div class="col-xs-2">
       <input type="submit" name="apply" class="btn btn-success" value="Apply">
       </div>
       <div class="col-xs-6">
       <a href="posts.php?source=published_posts" class="btn btn-warning">View all Published post</a>
   <a href="posts.php?source=draft_posts" class="btn btn-danger">View all draft post</a>
   <a href="posts.php?" class="btn btn-primary">View all post</a>
      </div>
       </div>
   <br>
   <hr><hr>
    <thead>
        <tr>
           <th><input type="checkbox" id="selectallcheckboxes"></th>
            <th>id</th>
            <th>Author</th>
            <th>title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Edit</th>
            <th>Virtual View</th>
            <th>Delete</th>
            <th>Views Count</th>
        </tr>
    </thead>
    <tbody>

        <?php showallposts();
                               ?>
                               
                               
    </tbody>
</table>

<?php   $query = "SELECT * FROM posts";
        $posts_query = mysqli_query($connection ,$query );
        $post_count = mysqli_num_rows($posts_query);
        $post_count = ceil($post_count/15); ?>
<ul class="pagination pagination-sm">
                           <?php 
        
                                for ($i = 1; $i <= $post_count; $i++)
                                {
                                    if (isset($_GET['page_admin']))
                                    {
                                        
                                        $page = $_GET['page_admin'];
                                        
                                     if ($i == $page)
                                    {
                                        echo "<li><a style=' background: #FFFE18 !important;' href='posts.php?page_admin={$i}'>$i</a></li>";
                                         
                                    }
                                     else{
                                            
                                        echo "<li><a href='posts.php?page_admin={$i}'>$i</a></li>";
                                    }
                                        
                                    }
                                     else{
                                         
                                       echo "<li><a href='posts.php?page_admin={$i}'>$i</a></li>";
                                    }
                                    
                                        
                                }
                                
                                ?>
                            </ul>



