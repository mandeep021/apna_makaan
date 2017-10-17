<?php include_once('includes/header.php'); ?>
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="javascript:void(0)" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Dashboard</a> <a href="#" class="tip-bottom">Admin</a> <a href="#" class="current">Admin Action</a> </div>
  <h1>Admin Action</h1>
</div>
<div class="container-fluid">
  <div class="alert alert-success" id="alert_msg" style="display: none;"></div>
  <hr>
  <div class="row-fluid">
    <div class="span6">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Personal-info</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="#" method="get" id="save_admin_action_info_frm" class="form-horizontal save_admin_action_info_frm">
            <input type="hidden" id="csrf_val" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <input type="hidden" name="admin_id" id="admin_id" value="<?= isset($admin)?$admin[0]["_id"]:'';?>">
            <div class="control-group">
              <label class="control-label">User Name :</label>
              <div class="controls">
                <input type="text" class="span11 validate" value="<?= isset($admin)?$admin[0]["username"]:''; ?>" data-validate="alphabate" id="username" name="username" placeholder="Enter User Name" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Email Id :</label>
              <div class="controls">
                <input type="text" class="span11 validate" data-validate="require" value="<?= isset($admin)?$admin[0]["email_id"]:''; ?>" name="email_id" id="email_id" placeholder="Enter Email Id" />
              </div>
            </div>
            <?php 
              if(!isset($admin)){
            ?>
            <div class="control-group" style="">
              <label class="control-label">Password</label>
              <div class="controls">
                <input type="password" class="span11 validate" data-validate="require" id="password" name="password" placeholder="Enter Password"  />
              </div>
            </div>
            <?php }  ?>
            <div class="control-group">
              <label class="control-label">Contact No</label>
              <div class="controls">
                <input type="number"  class="span11 validate" data-validate="number" value="<?= isset($admin)?$admin[0]["contact_no"]:''; ?>" id="contact_no" name="contact_no" placeholder="Enter Contact Number"  />
              </div>
            </div>
            <div class="form-actions">
              <button type="submit" class="btn btn-success" id="save_admin_action_info">Save</button>
            </div>
          </form>
        </div>
      </div>
      

    </div>
  </div>
</div></div>
<script type="text/javascript">
  $(document).ready(function(){
    on_load_validate();
  });
</script>
<?php include_once('includes/footer.php'); ?>