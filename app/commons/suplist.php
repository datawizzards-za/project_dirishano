<h3>TOP 10 SUPPLIERS</h3>                      
<?php 

$suppliers = $connection->query("SELECT * FROM supplier LIMIT 10");

foreach ($suppliers as $supplier){
    $supName = $supplier['COMPANYNAME'];
    $supCatalogue = $supplier['WEBADDRESS'];
    $supEmail = $supplier['EMAILADDRESS'];
    $supAvatar = getDIRAvatar($connection, $supEmail);
    if($supEmail != $username){
?>
<!-- Third Member -->
<div class="desc hvr-grow">
    <a href="../catalogue/?a=<?php echo hashPass("1000")?>&x=<?php echo md5($supEmail) ?>&b=<?php echo hashPass("1000") ?>">
    <div class="thumb">
        <img class="img-circle" src="<?php echo $supAvatar ?>" width="35px" height="35px" align="">
    </div>
    <div class="details">
        <p>
            <?php echo $supName ?><br />
            <muted><?php echo $supCatalogue ?></muted>
        </p>
    </div>
    </a>
</div>                      
<?php }}