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
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Users</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Users List</div>
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
            <div class="table-responsive">
            <?php
if($users->num_rows())
{ ?>
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>User Type</th>
                    <th>User Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>User Type</th>
                    <th>User Name</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                
                <tbody>
                <?php foreach($users->result() as $user)
                 { ?>
                  <tr>
                    <td><?php echo $user->f_name.' '.$user->l_name; ?></td>
                    <td><?php echo $user->email; ?></td>
                    <td><?php echo $user->contact_no; ?></td>
                    <td><?php
                    $user_type = $this->user_model->get_user_type($user->user_type_id);
                    echo $user_type->type;
                    ?>
                    </td>
                    <td><?php echo $user->user_name; ?></td>
                    <td><a href="<?php echo base_url(); ?>admin/user/update/?id=<?php echo  $user->id; ?>" class="btn btn-info"><i class="glyphicon glyphicon-pencil"></i>Update</a>
                   <button id="<?php echo $user->id; ?>" class="btn btn-danger delete_button" data-toggle="modal" data-target="#DeleteModal" ><i class="glyphicon glyphicon-remove"></i> Delete</button>
                      
                  </td>
                  </tr>
                <?php }?>
                </tbody>
              </table>
              <?php } else { echo "No Record Found "; }?>
            </div>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
  <div class="modal fade" id="DeleteModal"  ng-controller="ExpenditureController">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="<?php echo base_url(); ?>admin/user/delete" method="get" name="delete_model_form" class="form-horizontal" id="delete_model_form" role="form">
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
