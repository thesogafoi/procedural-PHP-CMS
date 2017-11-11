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
                      