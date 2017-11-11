<?php 
function users_online(){
    global $connection;
    $session = session_id();
            $time = time();
            $time_out_in_secounds = 10;
            $time_out = $time - $time_out_in_secounds;
            $query = "SELECT * FROM users_online WHERE session = '$session'";
            $send_query = mysqli_query($connection ,$query );
            $count = mysqli_num_rows($send_query);
        if ($count == null)
        {
            mysqli_query($connection ,"INSERT INTO users_online (session,time) VALUES('$session','$time')" );
            
        }else{
            mysqli_query($connection,"UPDATE users_online SET time = '$time' WHERE session='{$session}'");
        }   
        $users_online_query = mysqli_query($connection,"SELECT * FROM users_online WHERE time > '$time_out'");
        if (!$users_online_query)
        {
            die("QUERY FAILED".mysqli_error($connection));
            
        }
        return mysqli_num_rows($users_online_query);
}





function insert_categories(){
     if (isset($_POST['submitaddcategory']))
                            {
                                global $connection;
                                $cat_title = $_POST['cat_title'];
                                if ($cat_title == "" || empty($cat_title))
                                {
                                    echo '<div class="alert alert-danger">This field should not be empty</div>';
                                }else{
                                    $query = "INSERT INTO categories (cat_title) VALUES('{$cat_title}')";
                                    $creat_category = mysqli_query($connection,$query);
                                    if (!$creat_category    )
                                    {
                                        die("QUERY FAILED".mysqli_error($connection));
                                    }else{
                                        echo '<div class="alert alert-success">Category Added</div>';
                                }
                            }
}
}

function showallcategories(){
        global $connection;
                                    $query = "SELECT * FROM categories";
                                    $show_all_categories = mysqli_query($connection,$query);
                                    while($row = mysqli_fetch_assoc($show_all_categories)){
                                        $cat_id = $row['cat_id'];
                                        $cat_title = $row['cat_title'];
                                        echo '<tr>';
                                        echo "<td>{$cat_id}</td>";
                                        echo "<td>{$cat_title}</td>";
                                        echo "<td><a href='categories.php?delete=".$cat_id."'>Delete</a></td>";
                                        echo "<td><a href='categories.php?edit=".$cat_id."'>Edit</a></td>";
                                        
                                        
                                    }
}

function deletecategories(){
    global $connection;
                                    if (isset($_GET['delete']))
                                    {
                                    $delete_id = $_GET['delete'];
                                    $query = "DELETE FROM categories WHERE cat_id = {$delete_id}";
                                    $delete_query = mysqli_query($connection,$query);
                                    header("location:categories.php");
                                    }

}




?>





<?php 

    function updatecategory(){
        global $connection;
?>
 <form action="" method="post">
                                    
                                            
                                            
                                            
                                            
                                            
                                            <?php 
                                            if (isset($_GET['edit']))
                                                 {   $cat_id = $_GET['edit'];
                                                  $query = "SELECT * FROM categories WHERE cat_id ={$cat_id} ";
                                                $select_categories_id = mysqli_query($connection,$query);
                                                while($row = mysqli_fetch_assoc($select_categories_id)){
                                                $cat_title = $row['cat_title'];
                                                $cat_id = $row['cat_id'];?>
                                                <div class="form-group">
                                                      <label for="cat_title" class="lead">Edit a Category</label>
                                                       <input type="text" name="cat_title" class="form-control" value="<?php if (isset($cat_title)){ echo $cat_title; } ?>">    
                                                </div>
                                                                      <div class="form-group"> <input type="submit" name="submitupdatecategory" class="btn btn-primary" value="update a category"></div>
                                          <?php  }
                                                 
                                                  if (isset($_POST['submitupdatecategory'])){
                                                      
                                                      $cat_id = $_GET['edit'];
                                                      $the_cat_title = $_POST['cat_title'];
                                                      $query = "UPDATE categories SET cat_title ='{$the_cat_title}' WHERE cat_id = {$cat_id} ";
                                                      $update_query = mysqli_query($connection,$query);
                                                      header("location: categories.php");
                                                      if (!$update_query)
                                                      {
                                                          die("QUERY FAILED".mysqli_error($connection));
                                                      }
                                                  }}  ?>
                                               
                                              
                                                
                                        
           </form>
                    


<?php } ?>
<?php
    function showallposts(){
        global $connection;
        $query = "SELECT * FROM posts";
        $posts_query = mysqli_query($connection ,$query );
        $post_count = mysqli_num_rows($posts_query);
        $post_count = ceil($post_count/15);;
        if (isset($_GET['page_admin']))
        {
            $page = $_GET['page_admin'];
        }else{
            $page="";
        }if ($page==""||$page==1)
        {
            $page_1=0;
        }else{
            $page_1=($page*15)-15;
        }
        $query = "SELECT * FROM posts ORDER BY post_id DESC LIMIT $page_1,15";
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
            $post_views_count = $row['post_views_count'];
            
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
            
            $query = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
            $do_query_comment = mysqli_query($connection,$query);
            $row = mysqli_fetch_assoc($do_query_comment);
            $comments_id = $row['comment_id'];
            
            $comment_count = mysqli_num_rows($do_query_comment);
            
            echo "<td><a href='post_comments.php?id=$post_id'>$comment_count</a></td>";
            
            
            
            
            echo "<td>$post_date</td>";
            echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>edit</a></td>";
            //dar inja  ebteda varede page edit mishim ba id ie an chizi k rush click shode
            // yani dota source darim
            echo "<td><a href='../virtual_view.php?virtual_id={$post_id}'>Virtual View This Post</a></td>";
            echo "<td><a href='posts.php?delete={$post_id}'>delete</a></td>";
            echo "<td><a href='posts.php?reset={$post_id}'>$post_views_count</a></td>";
            
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
                
            
        }  if (isset($_GET['reset']))
        {   
            $post_views_id = $_GET['reset'];
                $query ="UPDATE posts SET post_views_count='' WHERE post_id={$post_views_id}" ;
                 $reset_post = mysqli_query($connection ,$query );
                if (!$reset_post)
                {
                    die("QUERY FAILED".mysqli_error($connection));
                }
                header("location: posts.php");
                
        }
        }
        ?>
         
                            <?php 
        
    }

function confirmcreatpost($result){
global $connection;
    if (!$result)
    {
        die("QUERY FAILED".mysqli_error($connection));
    }
    
    
}
function showallcomments(){
        global $connection;
        $query = "SELECT * FROM comments";
        $show_all_comments = mysqli_query($connection ,$query );
        while($row = mysqli_fetch_assoc($show_all_comments)){
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_email = $row['comment_email'];
            $comment_content = substr($row['comment_content'],0 , 50)."...";
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];
            echo '<tr>';
            echo "<td>$comment_id</td>";
            echo "<td>$comment_author</td>";
            echo "<td>$comment_content</td>";
//            
//            $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
//            $select_category = mysqli_query($connection ,$query );
//            confirmcreatpost($select_category);
//            while($row = mysqli_fetch_assoc($select_category)){
//                $the_category_title = $row['cat_title'];
//                echo "<td>$the_category_title</td>";
//            }  
            echo "<td>$comment_email</td>";
            echo "<td>$comment_status</td>";
            
            $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
            $select_post_id_quey = mysqli_query($connection ,$query);
            while($row = mysqli_fetch_assoc($select_post_id_quey))
            {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                
            echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                
            }
            echo "<td>$comment_date</td>";
            echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
            echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
            echo "<td><a href='comments.php?delete=$comment_id'>delete</a></td>";
            
            echo '</tr>';
                 if (isset($_GET['approve']))
        {   
            $comment_approve_id = $_GET['approve'];
            $query = "UPDATE comments SET comment_status='approve' WHERE comment_id=$comment_approve_id";
            $approve = mysqli_query($connection ,$query );
                header("location: comments.php");
            if (!$delete_post_id)
            {
                die("QUERY FAILED".mysqli_error($connection));
            }
                     
                     
                
            
        }
                       if (isset($_GET['unapprove']))
        {   
            $comment_approve_id = $_GET['unapprove'];
            $query = "UPDATE comments SET comment_status='unapprove' WHERE comment_id=$comment_approve_id";
            $unapprove = mysqli_query($connection ,$query );
                header("location: comments.php");
            if (!$delete_post_id)
            {
                die("QUERY FAILED".mysqli_error($connection));
            }
                
            
        }
            if (isset($_GET['delete']))
        {   
                 $comment_delete_id = $_GET['delete'];
//                
//                 $query = "SELECT * FROM comments WHERE comment_id = {$comment_delete_id} ";
//                $select_comment = mysqli_query($connection ,$query );
//                while ($row = mysqli_fetch_assoc($select_comment)){
//                    $id_of_post = $row['comment_post_id'];
//                 $query = "UPDATE posts SET post_comment_count= post_comment_count - 1  WHERE post_id = {$id_of_post} ";
//                 $decreas_comment_count = mysqli_query($connection,$query);
//                if (!$decreas_comment_count)
//                {
//                  die("QUERY FAILED".mysqli_error($connection));  
//                }
//                }
            $query = "DELETE FROM comments WHERE comment_id = {$comment_delete_id}";
            $delete_comment_id = mysqli_query($connection ,$query );
            if (!$delete_comment_id)
            {
                die("QUERY FAILED".mysqli_error($connection));
            }
                header("location: comments.php"); 
               
        }
        }
        
    }


function showallusers(){
    
        global $connection;
        $query = "SELECT * FROM users";
        $show_all_users = mysqli_query($connection ,$query );
        while($row = mysqli_fetch_assoc($show_all_users)){
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
            echo '<tr>';
            echo "<td>$user_id</td>";
            echo "<td>$username</td>";
            echo "<td>$user_firstname</td>";
//            
//            $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
//            $select_category = mysqli_query($connection ,$query );
//            confirmcreatpost($select_category);
//            while($row = mysqli_fetch_assoc($select_category)){
//                $the_category_title = $row['cat_title'];
//                echo "<td>$the_category_title</td>";
//            }  
            echo "<td>$user_lastname</td>";
            echo "<td>$user_email</td>";
           
            
            echo "<td>$user_role</td>";
            echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
            echo "<td><a href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>";
            echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
            echo "<td><a href='users.php?delete={$user_id}'>delete</a></td>";
            
            
            echo '</tr>';
                 if (isset($_GET['change_to_sub']))
        {   
            $the_user_id = $_GET['change_to_sub'];
            $query = "UPDATE users SET user_role='subscriber' WHERE user_id= $the_user_id";
            $change_to_sub_query = mysqli_query($connection ,$query);
            header("location: users.php");      
            if (!$change_to_sub_query)
            {
                die("QUERY FAILED".mysqli_error($connection));
            }
                     
                     
                
            
        }
                       if (isset($_GET['change_to_admin']))
        {   
            $the_user_id = $_GET['change_to_admin'];
            $query = "UPDATE users SET user_role='admin' WHERE user_id= $the_user_id";
            $change_to_admin_query = mysqli_query($connection ,$query);
            header("location: users.php");  
            if (!$change_to_admin_query)
            {
                die("QUERY FAILED".mysqli_error($connection));
            }
                
            
        }
            if (isset($_GET['delete']))
        {   
                
                    
                
                 $the_user_id = $_GET['delete'];
                 $query="SELECT * FROM users WHERE user_id = {$the_user_id}";
                $select_query_id= mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($select_query_id)){
                    $username = $row['username'];
                
                if ($_SESSION['username'] == $username)
                {
                    $_SESSION['username']=null;
                    $_SESSION['user_firstname']=null;
                    $_SESSION['user_lastname']=null;
                    $_SESSION['user_role']=null;
                    $query = "DELETE FROM users WHERE user_id = {$the_user_id}";
            $delete_user_query = mysqli_query($connection ,$query );
            if (!$delete_user_query)
            {
                die("QUERY FAILED".mysqli_error($connection));
            }
                    header("location: ../");
                }else{
                    $query = "DELETE FROM users WHERE user_id = {$the_user_id}";
            $delete_user_query = mysqli_query($connection ,$query );
            if (!$delete_user_query)
            {
                die("QUERY FAILED".mysqli_error($connection));
            }
                }
                    header("location: users.php");
                    }
                    }
        }
        
    }



?>
