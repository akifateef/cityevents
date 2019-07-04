<?php include 'header.php'; ?>
<br><br><br>

     
<div class="wrap-content container" id="container">
<br><br><br>
        <div class="row">
        
                     <?php  
                 if($events != NULL){
                     if(@$events->num_rows())
                        { ?>
                           
                            <?php foreach($events->result() as $event)
                                { ?>
						        <div class="col-md-3">

									<div class="panel panel-white no-radius text-center">
										<div class="panel-body">
                                            <img src="<?php echo base_url().'images/download.png';?>" >
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-tasks fa-stack-1x fa-inverse"></i> </span>
											<h3 class="StepTitle"><?php echo $event->name; ?></h3>
										<!-- <p>
										<span class="badge fa-2x">2</span>
										</p> -->
											<p class="links">
												<button class="btn btn-primary btn-o cl-effect-7">
												<a href="<?php echo base_url()?>event/details?id=<?php echo $event->id; ?>">
													<font color="black">View Details</font>
												</a>
												</button>
											</p>
                                        </div>
                                    </div>
                                </div>
                 <?php } 
?>
                 </div>             
<?php } 
  }
else {?>
No Event found
<?php
} ?>
	</div>
<!-- start: FOOTER -->
<br>
<br>
<br>
<br>
<?php include 'footer.php'; ?>