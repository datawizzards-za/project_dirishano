<h3>JOBS</h3>                      
<?php 

$suppliers = $connection->query("SELECT * FROM  `jobadverts`");

foreach ($suppliers as $supplier){
    $jobTitle = $supplier['TITLE'];
    $supCatalogue = $supplier['WEBADDRESS'];
    $supEmail = $supplier['EMAILADDRESS'];
    $supAvatar = getAvatar($connection, $supEmail);?>

<!-- Third Member -->
<div class="desc hvr-grow">
    <a href="catalogue.php?page_id=<?php echo md5($supEmail)?>">
    <div class="thumb">
        <img class="img-circle" src="<?php echo $supAvatar ?>" width="35px" height="35px" align="">
    </div>
    <div class="details">
        <p>
            <?php echo $jobTitle ?><br />
            <muted><?php echo $supCatalogue ?></muted>
        </p>
    </div>
    </a>
</div>                      
<?php }