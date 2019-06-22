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
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>User Type</th>
                    <th>User Name</th>
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
                  </tr>
                <?php }?>
                </tbody>
              </table>
              <?php }?>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

        <p class="small text-center text-muted my-5">
          <em>More table examples coming soon...</em>
        </p>

      </div>
      <!-- /.container-fluid -->
      <?php
$this->load->view('admin/components/footer');

$this->load->view('admin/components/scripts');

?>
</body>
</html>
