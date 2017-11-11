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
        </tr>
    </thead>
    <tbody>

        <?php 
        
        
        
         global $connection;
        $query = "SELECT * FROM posts WHERE post_status = 'draft'";
        $show_all_posts = mysqli_query($connection ,$query );
        while($row = mysqli_fetch_assoc($show_all_posts)){
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_date = $row['post_date'];
            
            echo '<tr>';
            ?>
                <th><input type="checkbox" class="checkboxes" name="checkboxarray[]" value="<?php echo "$post_id"; ?>"></th>
            <?php
            echo "<td>$post_id</td>";
            echo "<td>$post_author</td>";
            echo "<td>$post_title</td>";
            
            $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
            $select_category = mysqli_query($connection ,$query );
            confirmcreatpost($select_category); // functioni h as baraye gereftane error
            while($row = mysqli_fetch_assoc($select_category)){
                $the_category_title = $row['cat_title'];
                echo "<td>$the_category_title</td>";
            }
            
            
            
            echo "<td>$post_status</td>";
            echo "<td><img width='100' class='img-responsive'  src='images/$post_image' alt=''></td>";
            echo "<td>$post_tags</td>";
            echo "<td>$post_comment_count</td>";
            echo "<td>$post_date</td>";
            echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>edit</a></td>";
            //dar inja  ebteda varede page edit mishim ba id ie an chizi k rush click shode
            // yani dota source darim
            echo "<td><a href='../virtual_view.php?virtual_id={$post_id}'>Virtual View This Post</a></td>";
            echo "<td><a href='posts.php?delete={$post_id}'>delete</a></td>";
            
            echo '</tr>';
            if (isset($_GET['delete']))
        {   
            $post_delete_id = $_GET['delete'];
                $query ="DELETE FROM comments WHERE comment_post_id = {$post_delete_id} " ;
                 $delete_comments = mysqli_query($connection ,$query );
                if (!$delete_comments)
                {
                    die("QUERY FAILED".mysqli_error($connection));
                }
                
                // inja ma ba hzzfe post tamame commenthaye marbut b an ham hazf mishavad 
                
            $query = "DELETE FROM posts WHERE post_id = {$post_delete_id}";
            $delete_post_id = mysqli_query($connection ,$query );
                header("location: posts.php");
            if (!$delete_post_id)
            {
                die("QUERY FAILED".mysqli_error($connection));
            }
                
            
        }
        }
                               ?>
                               
                               
    </tbody>
</table>




