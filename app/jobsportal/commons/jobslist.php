<h3>OUR TOP JOBS</h3>                      
<?php 

$jobs = $connection->query("SELECT * FROM  `jobadverts`");

foreach ($jobs as $job){
    $jobTitle = $job['TITLE'];
    $employer = $job['EMAIL'];
    $jobLocation = $job['LOCATION'];
    $jobID = $job['ID'];
    $deadline = $job['CLOSINGDATE'];
    
    #$closing = new DateTime($deadline);
    #$today = new DateTime(date('Y-m-d'));
    
    #$daysRemaining = $today->diff($closing)->format('%m');
    
    $employerAvatar = getDIRSAvatar($connection, $employer);
    
    ?>

<!-- Third Member -->
<div class="desc hvr-grow">
    <a data-toggle="modal" data-target="#job_full" href="modal_ad.php?id=<?php echo $jobID?>">
    <div class="thumb">
        <img class="img-circle" src="<?php echo $employerAvatar ?>" width="35px" height="35px" align="">
    </div>
    <div class="details">
        <p>
            <?php echo strtoupper($jobTitle) ?><br />
            <muted>
                Location: <?php echo $jobLocation ?> <br />Closing <?php echo $deadline ?>.
            </muted>
        </p>
    </div>
    </a>
</div>                      
<?php }