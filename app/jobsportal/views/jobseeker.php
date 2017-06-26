
<div class="col-lg-9 hvr-shrink">
    <div class="col-lg-12 ds" style="background-color: #428bca; color: white">
      <h1 class="text-center">
          Hi <?php echo $CompName?>, <br /> Welcome to JMB Jobs Portal 
      </h1>
    </div>
    <hr /><hr />

    <div class="row mtbox">
        <div class="clearfix hvr-grow">
                    
            <div class="panel-body fadeInDown animated">    
                    <table class="table" id="table_vivio">
                        <thead>

                        <?php 

                            //$bidJobs = $connection->query("SELECT * FROM bids WHERE EMAILADDRESS=$username");

                            $allJobAds = $connection->query("SELECT * FROM jobadverts ORDER BY DATEPOSTED DESC LIMIT 5");

                            if($allJobAds-> num_rows == 0 ){?>
                                <tr><td>
                                        <h4 class="panel-title text-center text-uppercase">
                                            <strong>nothing to show here.</strong>
                                        </h4>
                                 </td></tr>
                             <?php } else { 

                                            //$thisJobs = $connection->query("SELECT * FROM jobs INNER JOIN bids ON jobs.JOB_ID=bids.JOB_ID WHERE bids.BIDDER='$username'");

                                            ?>

                            <tr>
                                <td class="text-center">
                                    <strong>JOB TITLE</strong>
                                </td>
                                <td class="text-center">
                                    <strong>SKILLS REQUIRED</strong>
                                </td>
                                <td class="text-center">
                                    <strong>LOCATION</strong>
                                </td>
                                <td class="text-center" id="search_id">

                                </td>
                            </tr>
                        </thead>
                        <tbody>     

                        <?php
                        foreach ($allJobAds as  $value_jobs) {

                                        $sessionJob = $value_jobs['ID'];
                            ?>

                            <tr class="alert alert-info text-uppercase text-center hvr-grow" style="margin: 10px">
                                <td class="col-md-4">
                                    <div>
                                        <strong><?php echo $value_jobs['TITLE'];?></strong>
                                    </div>
                                </td>
                                <td class="col-md-4">
                                    <div>
                                        <strong><?php echo $value_jobs['LOCATION'];?></strong>
                                    </div>
                                </td>
                                <td class="col-md-3">
                                    <div>
                                        <strong><?php echo $value_jobs['LOCATION'];?></strong>
                                    </div>
                                </td>
                                <td class="col-md-1">
                                    <div>
                                        <a data-toggle="modal" data-target="#job_full" href="modal_ad.php?id=<?php echo $sessionJob?>" class="list-group-item active">VIEW</a>
                                    </div>

                                </td>
                            </tr>

                            <?php } } ?>
                        </tbody>
                    </table>                                                       
            </div>                    
              <!-- #end todo-list -->
          </div>        
    </div><!-- /row mt -->	
    
</div><!-- /col-lg-9 END SECTION MIDDLE -->


<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="job_full" class="modal fade">    
    <div class="modal-dialog animated bounceIn" role="document">
        <div class="modal-content" >
        </div>
    </div>
</div>
