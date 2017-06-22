<header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="<?php echo $index?>" class="logo"><b>JMB Online</b></a>
            <!--logo end-->
            
            <?php 
            $results_note = $connection->query("SELECT * from notifications WHERE TO_USER = '$username' AND STATUS = '0' ORDER BY TIMEPOST");
            $notifications = $results_note ->num_rows;
            ?>

    <div class="nav notify-row" id="top_menu">
        <!--  notification start -->
            <?php if ($userType == "JOBSEEKER" || $userType == "EMPLOYER"){}else{ ?>
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="<?php echo $index?>">
                            <i class="fa fa-tasks"></i>
                            <?php if($notifications > 0){?>
                            <span class="badge bg-theme">
                                <?php echo $notifications; ?>
                            </span>
                            
                            <?php }?>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <li>
                                <p class="green text-center">You have <?php echo $notifications; ?> new notifications</p>
                            </li>
                            <?php 
                              foreach($results_note as $items){ ?>
                            <li class="hvr-grow">
                                <a href="notifications.php?page_id=<?php echo md5($username) ?>">
                                    <div class="task-info text-center">
                                        <div class="desc"><?php echo $items['MESSAGE']; ?></div>
                                    </div>
                                </a>
                            </li>
                            <?php }
                            ?>
                            <li class="external text-center hvr-grow">
                                <a href="notifications.php?page_id=<?php echo md5($username) ?>">See All</a>
                            </li>
                        </ul>
                    </li>
                    <!-- settings end -->
                    <!-- inbox dropdown start-->
                    <li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="inbox.php?page_id=<?php echo md5($username) ?>">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge bg-theme">3</span>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <li>
                                <p class="green text-center">You have 5 new messages</p>
                            </li>
                            <li>
                                <a href="inbox.php?page_id=<?php echo md5($username) ?>">
                                    <span class="photo"><img alt="avatar" src="files/imgs/default.png"></span>
                                    <span class="subject">
                                    <span class="from">Master</span>
                                    <span class="time">Just now</span>
                                    </span>
                                    <span class="message">
                                        We're almost there.
                                    </span>
                                </a>
                            </li>
                           
                            <li class="text-center">
                                <a href="inbox.php?page_id=<?php echo md5($username) ?>">See all</a>
                            </li>
                        </ul>
                    </li>
                    <!-- inbox dropdown end -->
                </ul>
            <?php }?>
                <!--  notification end -->
            </div>
            		
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="<?php echo $logout_path ?>">Logout</a></li>
            	</ul>
            </div>			
        </header>