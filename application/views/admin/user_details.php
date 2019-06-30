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
          <li class="breadcrumb-item active">User Details</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-user"></i>
         <b>Username :</b>  <?php echo $update_data->user_name; ?></div>
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

          <form  action="<?php echo base_url(); ?>admin/user/update/?id=<?php echo $update_data->id; ?>" method="post">
          <input type="hidden" value="<?php echo $update_data->id; ?>" name="user_id"/>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                  <input type="text" name="f_name" id="firstname" class="form-control" value="<?php echo $update_data->f_name; ?>" placeholder="First Name" required="required" autofocus="autofocus">
                
              </div>
              <div class="col-md-6">
                 <input type="text" name="l_name" class="form-control" placeholder="Last Name" value="<?php echo $update_data->l_name; ?>" required="required">
                </div>
            </div>
          </div>
          <div class="form-row">
              <div class="col-md-6">
              <input type="email" id="inputEmail" name="email" class="form-control" value="<?php echo $update_data->email; ?>" placeholder="Email address" required="required">
     
              </div>
              <div class="col-md-6">
                 <input type="text" name="contact_no" class="form-control" placeholder="Contact No." value="<?php echo $update_data->contact_no; ?>" required="required">
                </div>
            </div>
          </div>
          
          <button class="btn btn-primary btn-block" name="submit">Update Details</button>
        </form>
        </div>

      </div>
      <!-- /.container-fluid -->
      <?php
$this->load->view('admin/components/footer');

$this->load->view('admin/components/scripts');

?>
</body>
</html>
