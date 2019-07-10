<?php
$this->load->view('admin/components/header');
?>
<style>
        .pac-container {
            z-index: 99999;
        }
    </style>
<body id="page-top">
    <!-- Sidebar -->
    <?php
    $this->load->view('admin/components/sidebar');
    ?>
    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo base_url()?>admin/user/index?page=index">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Add Events</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            New Event</div>
          <div class="card-body">
          <?php if (validation_errors()): ?>
<div class="alert alert-danger">
<button type="button" class="close" data-dismiss="alert">×</button>
<?php echo validation_errors();?>
</div>
<?php endif; ?>

<?php if(isset($_SESSION['msg_error'])){ ?>
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <?php echo display_error(); ?>
</div>
<?php } ?>

<?php if(isset($_SESSION['msg_success'])){ ?>
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <?php echo display_success_message(); ?>
</div>
<?php } ?>
          <form  action="<?php echo base_url(); ?>admin/event/insert" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <input type="hidden" name="longitude" id="longitude"/>
                <input type="hidden" name="latitude" id="latitude"/>
                  <input type="text" name="event_name" id="firstname" class="form-control" placeholder="Event name" required="required" autofocus="autofocus">
              </div>
              <div class="col-md-6">
                  <input type="text" name="datetime" class="form-control" placeholder="Select Date and Time" >
              </div>
                         </div>
          </div> 
        
          <div class="form-group">
            <div class="form-row">
          <div class="col-md-6">
                     <input type="text" name="event_address" id="event_address" class="form-control" data-target="#us6-dialog" data-toggle="modal" placeholder="Event address" required="required">
           </div>

          <div class="col-md-6">
              <select id="inputState" name="event_type_id" class="form-control">
              <?php $event_types = $this->event_model->get_events_type();
                                          foreach($event_types->result() as $event_type){ 
                                    ?>
                                    <option value="<?php echo $event_type->id; ?>" ><?php echo $event_type->name; ?></option>
                                    <?php } ?>
              </select>
          </div>
          </div>
          </div> 
        
          <div class="form-group">
            <div class="form-row">
             <div class="col-md-6">
                     <textarea rows="12" name="description" class="form-control">Event Description</textarea>
                  </div>
                  <?php $image = base_url().'images/download.png';
                  ?>
                  <div class="col-md-6">
                    <img onclick="document.getElementById('image').click();" class="img-preview"  id="upload_preview" style="cursor:pointer;" src="<?php echo $image; ?>" width="300px" height="300px">
							      <input onChange="readURL(this, 'upload_preview');" style="display:none;" type="file" name="image" size='20' id="image" />
                  </div>   

            </div>
        </div>
          <button type="submit" class="btn btn-primary btn-block" >Add New Event</button>
        </form>
        </div>

      </div>
      <!-- /.container-fluid -->
   
      <?php
$this->load->view('admin/components/footer');

$this->load->view('admin/components/scripts');

?>
<div id="us6-dialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content" style="
    width: 589px;
">
                <div class="modal-header">
                <h4 class="modal-title">Address</h4>   
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                   
                </div>
                <div class="modal-body">
                    <div class="form-horizontal" style="width: 550px">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Location:</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="us3-address" />
                            </div>
                        </div>
                    
                        <div id="us3" style="width: 100%; height: 400px;"></div>
                        <div class="clearfix">&nbsp;</div>
                        <div class="m-t-small" style="display:none">
                            <label class="p-r-small col-sm-1 control-label">Lat.:</label>

                            <div class="col-sm-3">
                                <input type="hidden" name="lat" class="form-control" style="width: 110px" id="us3-lat" />
                            </div>
                            <label class="p-r-small col-sm-2 control-label">Long.:</label>

                            <div class="col-sm-3">
                                <input type="hidden" name="long" class="form-control" style="width: 110px" id="us3-lon" />
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <script>
                            $('#us3').locationpicker({
                                location: {
                                    latitude: 46.15242437752303,
                                    longitude: 2.7470703125
                                },
                                radius: 10,
                                inputBinding: {
                                    latitudeInput: $('#us3-lat'),
                                    longitudeInput: $('#us3-lon'),
                                    radiusInput: $('#us3-radius'),
                                    locationNameInput: $('#us3-address')
                                },
                                enableAutocomplete: true,
                                markerIcon: 'http://www.iconsdb.com/icons/preview/tropical-blue/map-marker-2-xl.png'
                            });
                            $('#us6-dialog').on('shown.bs.modal', function () {
                                $('#us3').locationpicker('autosize');
                            });
                        </script>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="close" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="save" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<script>
  $(document).ready(function(){

    $('#save').click(function () {
      $('#close').trigger('click');
      var address = $('#us3-address').val();
      var long = $('#us3-lon').val();
      var lat = $('#us3-lat').val();
      $('#longitude').val(long);
      $('#latitude').val(lat);
        $('#event_address').val(address); //Its showing
    })
  });

$(function() {
  $('input[name="datetime"]').daterangepicker({
    timePicker: true,
    startDate: moment().startOf('hour'),
    endDate: moment().startOf('hour').add(32, 'hour'),
    locale: {
      format: 'YYYY/MM/DD HH:mm:ss'
    }
  });
});
function readURL(input,id) 
{	
	if (input.files && input.files[0]) {
		
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#'+id).attr('src', e.target.result);
		}
		
		reader.readAsDataURL(input.files[0]);
	}
}
</script>

</body>
</html>
