     <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button><?php 
                        if (isset($_SESSION['user_firstname']))
                        {
                            $user_role = $_SESSION['user_role'];
                            
                                echo "<a class='navbar-brand' href='index.php'>CMS ".$user_role."</a>";
                            
                            
                        }
                ?>
                
                
                
               
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
               <li><a href="">Users Online = <?php echo users_online(); ?></a></li>
                <li><a href="../"><strong>Home Page</strong></a> </li>
                <li class="dropdown">
                   <?php 
                        if (isset($_SESSION['username']))
                        {
                            $user_firstname = $_SESSION['username'];
                            
                        }
                    ?>
                   
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo "$user_firstname "; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                     <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#post"><i class="fa fa-fw fa-arrows-v"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="post" class="collapse">
                            <li>
                                <a href="./posts.php">View all Posts</a>
                            </li>
                            <li>
                                <a href="posts.php?source=add_post">Add a Post</a>
                            </li>
                        </ul>
                    </li>
                     <?php 
                    if ($_SESSION['user_role']=='admin')
                    {
                     
                   
                    ?>
                    <li>
                        <a href="./categories.php"><i class="fa fa-fw fa-wrench"></i> Categories</a>
                    </li>
                    <li class="">
                        <a href="comments.php"><i class="fa fa-fw fa-file"></i> Comment</a>
                    </li>
                  
                   
                    <li>
                        <a href="javascript:" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="users.php">View All Users</a>
                            </li>
                            <li>
                                <a href="users.php?source=add_user">Add User </a>
                            </li>
                        </ul>
                    </li>
                     
                     
                     <?php 
                    
                    }
    
                    ?>
                      <li>
                        <a href="profile.php"><i class="fa fa-fw fa-dashboard"></i> Profile </a>
                    </li>
                </ul>
            </div>
        </nav>