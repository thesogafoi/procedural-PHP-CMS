<?php 
    include "includes/admin_header.php";
?>
    <div id="wrapper">

        <!-- Navigation -->
   <?php  include "includes/admin_nav.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome To Admin 
                            <small>Author</small>
                        </h1>
   

   <?php
       if (isset($_GET['id']))
        {
            
        $id = $_GET['id'];
           
if (isset($_POST['apply1']))
{
    

    if (isset($_POST['checkboxarray1']))
    {
        foreach ($_POST['checkboxarray1'] as $valueid)
        {
               $bulk_option1 = $_POST['bulk_option1'];
                switch ($bulk_option1)
                {
                    case 'unapprove':
                        $query = "UPDATE comments SET comment_status='$bulk_option1' WHERE comment_id='{$valueid}'";
                        $update_to_unapprove_post = mysqli_query($connection,$query);
                        
                        break;
                    case 'approve':
                        $query = "UPDATE comments SET comment_status='$bulk_option1' WHERE comment_id='{$valueid}'";
                        $update_to_approve_post = mysqli_query($connection,$query);
                        break;
                    case 'delete':
                        $query = "DELETE FROM comments WHERE comment_id = '{$valueid}'";
                        $delete_post = mysqli_query($connection,$query);
                        break;
                    
                    default:
                        break;
                }
        }       
    }
    }

?>
  
  
  <form action="post_comments.php?id=<?php echo $id?>" method="post">
   <table class="table table-striped table-bordered" >
  <div class="row">
   <div id="bulkOptionContainer" class="col-xs-4">
      <select name="bulk_option1" id="" class="form-control" style="cursor:pointer" >
          <option value="">Select Option</option>
          <option value="approve">approve</option>
          <option value="unapprove">unapprove</option>
          <option value="delete">Delete</option>
      </select>
       
   </div>
   <div class="col-xs-2">
       <input type="submit" name="apply1" class="btn btn-success" value="Apply">
       </div>
       
       </div>
   <br>
   <hr><hr>

   <table class="table table-striped table-bordered">
    <thead>
        <tr>
           <th><input type="checkbox" id="selectallcheckboxes"></th>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
       
        <?php    
        
   
        
        
        $query = "SELECT * FROM comments WHERE comment_post_id = $id";
        $show_all_comments = mysqli_query($connection ,$query );
        while($row = mysqli_fetch_assoc($show_all_comments)){
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_email = $row['comment_email'];
            $comment_content = $row['comment_content'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];
            echo '<tr>';
            ?>
                <th><input type="checkbox" class="checkboxes" name="checkboxarray1[]" value="<?php echo $comment_id; ?>"></th>
            <?php
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
            echo "<td><a href='post_comments.php?id=$id&approve=$comment_id'>Approve</a></td>";
            echo "<td><a href='post_comments.php?id=$id&unapprove=$comment_id'>Unapprove</a></td>";
            echo "<td><a href='post_comments.php?id=$id&delete=$comment_id'>delete</a></td>";
            
            echo '</tr>';
                 if (isset($_GET['approve']))
        {   
            $comment_approve_id = $_GET['approve'];
            $query = "UPDATE comments SET comment_status='approve' WHERE comment_id=$comment_approve_id";
            $approve = mysqli_query($connection ,$query );
                     header("location: post_comments.php?id=$id");
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
                           header("location: post_comments.php?id=$id");
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
                header("location: post_comments.php?id=$id");
            if (!$delete_comment_id)
            {
                die("QUERY FAILED".mysqli_error($connection));
            }
               
        }
        }
            }
                               ?>
                               
                               
    </tbody>
</table>



  </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include "includes/admin_footer.php"; ?>