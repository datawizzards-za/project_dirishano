<div id="sidebar"  class="nav-collapse ">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu" id="nav-accordion">              	  	

        <p class="centered">
            <?php if($userType == 'client'){?> <a class="logout" href="profile_cl.php?page_id=<?php echo $pageID ?>"> <?php }
                     elseif($userType == 'service'){ ?> <a class="logout" href="sp/"><?php }
                     else{?> <a class="logout" href="profile_sup.php?page_id=<?php echo $pageID ?>"> <?php } ?>                                 

                <img src="<?php echo $userAvatar; ?>" class="img-circle" width="60">
            </a>
        </p>
        <h5 class="centered"><?php echo $CompName ?></h5>           

        <li class="mt hvr-grow">
            <a class="active" href="<?php echo $index?>">
                <i class="fa fa-dashboard"></i>
                <span>DASHBOARD</span>
            </a>
        </li>

        <?php

        if($userType == 'client' ){
                echo "<li class='mt hvr-grow'><a href='bids.php?page_id=$pageID'><i class='fa fa-tasks'></i><span>BIDS</span></a></li>";
              }elseif($userType == 'service' ){
                echo "<li class='mt hvr-grow'><a href='./jobs/'><i class='fa fa-book'></i><span>JOBS</span></a></li>";
                echo "<li class='mt hvr-grow'><a href='./portfolio/'><i class='fa fa-archive'></i><span>PORTFOLIO</span></a></li>";
              }else{
                  echo "<li class='mt hvr-grow'><a href='./catalogue/?a=".md5("1000")."&x=$pageID'><i class='fa fa-archive'></i><span class='text-uppercase'>My Catalogue</span></a></li>";
              }                        
        ?>

        <li class="mt hvr-grow">
            <a href="./newsletters/">
                <i class="fa fa-envelope-o"></i>
                <span>NEWSLETTERS</span>
            </a>
        </li>

        <li class="mt hvr-grow">
            <?php
                if($userType == 'client'){ echo "<a href='profile_cl.php?page_id=$pageID'>";}
                  elseif($userType == 'service'){ echo "<a href='sp/'>";}
                  elseif($userType == 'supplier'){ echo "<a href='profile_sup.php?page_id=$pageID'>";}
            ?>
                <i class="fa fa-user"></i>
                <span>PROFILE</span>
            </a>
        </li>

    </ul>
    <!-- sidebar menu end-->
</div>