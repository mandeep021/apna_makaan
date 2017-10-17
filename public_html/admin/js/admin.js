base_url = window.location.protocol + "//" + window.location.host + '/apna_makaan/cradmin/';
function ajax_disabled_btn(id){
  $("#"+id).html("Please wait..");
  $("#"+id).prop("disabled",true);
}
function ajax_enabled_btn(id,msg){
  $("#"+id).html(msg);
  $("#"+id).prop("disabled",false);
}
function alert_msg_display(div,type,msg){
  if(type == 'danger'){
    $("#"+div).addClass("alert-danger");
    $("#"+div).removeClass("alert-success");
  }
  else{
    $("#"+div).removeClass("alert-danger");
    $("#"+div).addClass("alert-success");
  }
  $("#"+div).html(msg);
  $("#"+div).slideDown();
   setTimeout(function () {
      $("#"+div).slideUp();
    },3000);
}
function redirect(path){
  window.location.href = path;
}
function make_ajax_call(frm,path,btn,alert_msg){
  btn_msg = $("#"+btn).html();
  ajax_disabled_btn(btn);
  var form1 = new FormData($("#"+frm)[0]);
  $.ajax({
    url: path,
    data:form1,
        type: "POST",
        dataType:'json',
        contentType: false,
        cache: false,
        processData:false,
        success: function(data) {
            if(data["status"]){
              alert_msg_display(alert_msg,"success",data["msg"]);
              if(data["redirect"] != ''){
                redirect(data["redirect"]);  
              }
            }
            else{
              alert_msg_display(alert_msg,"danger",data["msg"]);
            }
            ajax_enabled_btn(btn,btn_msg);
        }
  });
}
$(document).ready(function(){
  if($(".session_msg").length > 0){
    setTimeout(function () {
      $(".session_msg").slideUp();
    },3000);
  }
});
$(document).on("click","#login_submit",function(e){
  e.preventDefault();
  ajax_disabled_btn("login_submit");
  if(!validate("loginform")){
    alert_msg_display("alert_msg","danger","Please fill all the details");
    ajax_enabled_btn("login_submit","Login");
    return false;
  }
  path = base_url+"make_login";
  var form1 = new FormData($("#loginform")[0]);
  $.ajax({
    url: path,
    data:form1,
        type: "POST",
        dataType:'json',
        contentType: false,
        cache: false,
        processData:false,
        success: function(data) {
            if(data["status"]){
              alert_msg_display("alert_msg","success","Authenticate");
              window.setTimeout(function() {
                window.location.href = data["redirect"];
              }, 3000);
            }
            else{
              alert_msg_display("alert_msg","danger",data["msg"]);
            }
            ajax_enabled_btn("login_submit","Login");
        }
  });
});
$(document).on("click","#save_admin_action_info",function(e){
    btn_msg = $("#save_admin_action_info").html();
    ajax_disabled_btn("save_admin_action_info");
    e.preventDefault();
    if(!validate('save_admin_action_info_frm')){
      alert_msg_display("alert_msg","danger","Please fill all the details");
      ajax_enabled_btn('save_admin_action_info',btn_msg);
      return false;
    }
    path = base_url+"save_admin_info";
    make_ajax_call("save_admin_action_info_frm",path,'save_admin_action_info','alert_msg'); 
});
