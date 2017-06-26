<div id="sidebar"  class="nav-collapse" style="background: #ffffff">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu jp hvr-shrink" id="nav-accordion">              	  	

        <p class="centered ">
            <a class="logout" href="profile.php">
                <img src="<?php echo $userAvatar; ?>" class="img-circle" width="60">
            </a>
        </p>
        <h5 class="centered" style="color: black"><?php echo $CompName ?></h5>           

        <li class="mt hvr-grow">
            <a href="../jobsportal/">
                <i class="fa fa-dashboard"></i>
                <span>DASHBOARD</span>
            </a>
        </li>

<?php
    if($userType == 'JOBSEEKER' ){
        echo "<li class='mt hvr-grow'><a href='./cv/'><i class='fa fa-tasks'></i><span>MY CV</span></a></li>";
    }elseif($userType == 'EMPLOYER' ){
        echo "<li class='mt hvr-grow'><a href='myjob.php'><i class='fa fa-book'></i><span>MY JOBS</span></a></li>";
    }
?>

    <li class="mt hvr-grow">
        <a href="./profile/">
            <i class="fa fa-user"></i>
            <span>PROFILE</span>
        </a>
    </li>

    </ul>
    <!-- sidebar menu end-->
</div>