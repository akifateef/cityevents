<?php
$this->load->view('admin/components/header');
?>
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
          <li class="breadcrumb-item active">Events</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Events List</div>
            
          <div class="card-body">
          <div align="center">
            <a href="<?php echo base_url()?>admin/event/insert" class="btn btn-primary"><i class="glyphicon glyphicon-add"></i> Add Event</a>
                  
              
          </div>
            <div class="table-responsive">
            <?php
if($events->num_rows())
{ ?>
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                  <th>Name</th>
                    <th>Location</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                
                <tbody>
                <?php foreach($events->result() as $event)
                 { ?>
                  <tr>
                    <td><?php echo $event->name; ?></td>
                    <td><?php echo $event->location_name; ?></td>
                    <td><a href="<?php echo base_url(); ?>admin/event/update/?id=<?php echo  $event->id; ?>" class="btn btn-info"><i class="glyphicon glyphicon-pencil"></i>Update Event</a>
                   <button id="<?php echo $event->id; ?>" class="btn btn-danger delete_button" data-toggle="modal" data-target="#DeleteModal" ><i class="glyphicon glyphicon-remove"></i> Delete</button>
                  
                  </tr>
                <?php }?>
                </tbody>
              </table>
          <?php } ?>
            </div>
          </div>


      </div>
          <!-- /.container-fluid -->
  <div class="modal fade" id="DeleteModal"  ng-controller="ExpenditureController">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="<?php echo base_url(); ?>admin/event/delete" method="get" name="delete_model_form" class="form-horizontal" id="delete_model_form" role="form">
      <div class="modal-header">
      <h4 class="modal-title">Confirmation</h4>  
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger" >Delete</button>
      </div>
      <input type="hidden" name="delete_id" id="delete_id" value="0" >
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
      <!-- /.container-fluid -->
      <?php
$this->load->view('admin/components/footer');

$this->load->view('admin/components/scripts');

?>
<script>
$(document).ready(function(){
	
	$('.delete_button').click(function(e) {
		$("#delete_id").val(this.id);
    });
	});
</script>
</body>
</html>
