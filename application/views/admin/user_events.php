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
         
            <div class="table-responsive">
            <?php
if($events->num_rows())
{ ?>
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Location</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                  <th>Name</th>
                    <th>Location</th>
                  </tr>
                </tfoot>
                
                <tbody>
                <?php foreach($events->result() as $event)
                 { ?>
                  <tr>
                    <td><?php echo $event->name; ?></td>
                    <td><?php echo $event->location_id; ?></td>
                  </tr>
                <?php }?>
                </tbody>
              </table>
          <?php } ?>
            </div>
          </div>


      </div>
      <!-- /.container-fluid -->
      <?php
$this->load->view('admin/components/footer');

$this->load->view('admin/components/scripts');

?>
</body>
</html>
