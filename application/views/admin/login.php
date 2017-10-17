<!DOCTYPE html>
<html lang="en">
    
<head>
        <title>Matrix Admin</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="<?= ADMIN_HTML; ?>css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?= ADMIN_HTML; ?>css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="<?= ADMIN_HTML; ?>css/matrix-login.css" />
        <link href="<?= ADMIN_HTML; ?>font-awesome/css/font-awesome.css" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
        <link href="<?= PUBLIC_HTML; ?>validation/validation.css" rel="stylesheet" />
    </head>
    <body>
        <div id="loginbox">           
            <div class="alert alert-success" id="alert_msg" style="display: none;"></div>
            <form id="loginform" class="form-vertical loginform">
                <input type="hidden" id="csrf_val" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				 <div class="control-group normal_text"> <h3><img src="<?= ADMIN_HTML; ?>img/logo.png" alt="Logo" /></h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span>
                            <input type="text" name="email_id" id="email_id" class="validate" data-validate="email" placeholder="Email Id" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span>
                            <input type="password" name="password" id="password" placeholder="Password" class="validate" data-validate="require" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <!-- <span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Lost password?</a></span> -->
                    <span class="pull-right">
                        <button class="btn btn-success" id="login_submit">Login</button>
                    </span>
                </div>
            </form>
        </div>
        <script src="<?= ADMIN_HTML; ?>js/jquery.min.js"></script>  
        <script src="<?= ADMIN_HTML; ?>js/admin.js"></script>  
        <script src="<?= ADMIN_HTML; ?>js/matrix.login.js"></script> 
        <script src="<?= PUBLIC_HTML; ?>validation/validation.js"></script> 
        <script type="text/javascript">
            $(document).ready(function(){
                on_load_validate();
            });
        </script>
    </body>

</html>
