<?php include 'header.php'; ?>
    <br>
    <br>
<br>
<br>
<br>

<form name="" action="<?php echo base_url()?>event/search" method="get" >           
<div class="form-group" style="margin-top:140px">
            <div class="form-row">
            <div class="col-md-1">
          
</div>
              <div class="col-md-5">
                <label><b>Search Name</b></label>
                  <input type="text" style="background:black;" name="event_name" id="firstname" class="form-control" placeholder="Event name" required="required" autofocus="autofocus">
              </div>
          
              <div class="col-md-3">
              <label><b>Select Type</b></label>
              <select id="inputState" style="background:white; color:black !important;" name="event_type" class="form-control">
              
              <option value="0" >All</option>
                                    
              <?php $event_types = $this->event_model->get_events_type();
                                          foreach($event_types->result() as $event_type){ 
                                    ?>
                                    <option value="<?php echo $event_type->name; ?>" ><?php echo $event_type->name; ?></option>
                                    <?php } ?>
              </select>
          </div>
          <div class="col-md-1">
          <button type="submit" class="btn btn-primary btn-block" style="
    margin-top: 36px;
    padding: 8px;
">Search</button>
</div>
            </div>
          </div> 

          </form>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br><br>
<br>
<?php include 'footer.php'; ?>