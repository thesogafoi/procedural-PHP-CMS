<?php 
    include "includes/admin_header.php";
?>
    <div id="wrapper">

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
                            <div class="col-xs-6">
                                <?php 
                              insert_categories();
                            ?>
                                    <form action="categories.php" method="post">
                                        <div class="form-group">
                                            <label for="cat_title" class="lead">Add a Category</label>
                                            <input type="text" name="cat_title" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="submitaddcategory" class="btn btn-primary" value="Add a category">
                                        </div>
                                    </form>
                                    <hr>
                                    <br>
                                    <?php 
                                       
                                updatecategory();
                                       
                                ?>

                            </div>
                            <div class="col-xs-6">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Categories id</th>
                                            <th>Categories title</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                showallcategories(); ?>
                                  <?php 
                                        
                                         deletecategories();
                                        ?>
                                   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php include "includes/admin_footer.php"; ?>