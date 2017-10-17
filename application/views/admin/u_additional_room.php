<?php include_once 'includes/header.php'; ?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Dashboard</a> <a href="#" class="current">Additional Rooms</a> </div>
    <h1>Additional Room</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="alert alert-success" id="alert_msg" style="display: none;"></div>
    <?php 
      if($this->session->flashdata('error_msg')){
        echo '<div class="alert alert-danger session_msg">'.$this->session->flashdata('error_msg').'</div>';
      }
      else if($this->session->flashdata('success_msg')){
        echo '<div class="alert alert-success session_msg">'.$this->session->flashdata('success_msg').'</div>';
      }
    ?>
    <div class="row-fluid">
      <div class="span12">
        <div class="text-right">
            <button class="btn btn-success" onclick="redirect('<?= ADMIN_URL.'new_admin'; ?>');">Add New</button>
        </div>
        <div class="widget-box">
          <div class="widget-title"> 
            <h5>Additional Rooms</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered table-striped with-check">
              <thead>
                <tr>
                  <th><i class="icon-resize-vertical"></i></th>
                  <th>Room Name</th>
                  <th>Image</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  foreach ($additional_room as $key => $value) {
                    echo '<tr>
                            <td><input type="checkbox" /></td>
                            <td>'.$value["name"].'</td>
                            <td></td>
                            <td>'.get_status($value["status"]).'</td>
                            <td class="center">
                              <a href="'.ADMIN_URL.'edit_admin/'.$value["_id"].'">Edit</a> | <a href="'.ADMIN_URL.'delete_admin/'.$value["_id"].'/'.($value["status"] == 2?1:2).'">Delete</a>
                            </td>
                          </tr>';
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<?php include_once 'includes/footer.php'; ?>