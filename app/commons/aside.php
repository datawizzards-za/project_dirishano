<div id="sidebar"  class="nav-collapse ">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu" id="nav-accordion">              	  	

        <p class="centered">
            <?php if($userType == 'client'){?> 
            <a class="logout" href="../profile_cl.php?page_id=<?php echo $pageID ?>"> <?php }
            elseif($userType == 'service'){ ?> <a class="logout" href="../sp/"><?php }
            else{?> 
                <a class="logout" href="../profile_sup.php?page_id=<?php echo $pageID ?>"> <?php } ?>
                    <img src="<?php echo $userAvatar; ?>" class="img-circle" width="60">
            </a>
        </p>
        <h5 class="centered"><?php echo $CompName ?></h5>           

        <li class="mt hvr-grow">
            <a href="<?php echo $index?>">
                <i class="fa fa-dashboard"></i>
                <span>DASHBOARD</span>
            </a>
        </li>

        <?php

        if($userType == 'client' ){ ?>
        <li class='mt hvr-grow'>
            <a href='../bids.php?page_id=<?php echo $pageID; ?>'>
                <i class='fa fa-tasks'></i> <span>BIDS</span>
            </a>
        </li>
        <?php }elseif($userType == 'service' ){ ?>
        <li class='mt hvr-grow'>
            <a href='../jobs/'>
                <i class='fa fa-book'></i> <span>JOBS</span>
            </a>
        </li>
        <li class='mt hvr-grow'>
            <a href='../portfolio/'>
                <i class='fa fa-archive'></i><span>PORTFOLIO</span>
            </a>
        </li>
        <?php }else{ ?>
        <li class='mt hvr-grow'>
            <a href="./catalogue/?a=<?php echo md5('1000')?>&x=<?php echo $pageID ?>">
                <i class='fa fa-archive'></i><span class='text-uppercase'>My Catalogue</span>
            </a>
        </li>
        <?php } ?>

        <li class="mt hvr-grow">
            <a href="../newsletters/">
                <i class="fa fa-envelope-o"></i>
                <span>NEWSLETTERS</span>
            </a>
        </li>

        <li class="mt hvr-grow">
            <?php
            if($userType == 'client'){ ?>
            <a href='../profile_cl.php?page_id=<?php echo $pageID?>'>
            <?php } elseif($userType == 'service'){ ?>
            <a href='../sp/'> 
            <?php } elseif($userType == 'supplier'){ ?> 
                <a href="../profile_sup.php?page_id=<?php echo $pageID?>"> <?php } ?>
                <i class="fa fa-user"></i>
                <span>PROFILE</span>
            </a>
        </li>

    </ul>
    <!-- sidebar menu end-->
</div>