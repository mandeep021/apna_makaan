/*
********************Code By MANDEEP****************
********************Do not edit below code0*********
*/

function validate(form){
  $.each($('.validate'), function(index, value) {
    if($("."+form+" #"+$(value).attr("id")).data('validate') == 'require'){
      if($("."+form+" #"+$(value).attr("id")).val()==''){
        $("."+form+" #"+$(value).attr("id")).addClass('error');
		    /*$("."+form+" #"+$(value).attr("id")).tooltip({placement: 'top',trigger: 'manual'}).tooltip('show');*/
      }
      else {
        if($("."+form+" #"+$(value).attr("id")).data('max') != ''){
            var max = $("."+form+" #"+$(value).attr("id")).data('max');

            if(val > max){
              $("."+form+" #"+$(value).attr("id")).addClass('error');
            }
            else{
              $("."+form+" #"+$(value).attr("id")).removeClass('error');  
            }
          }
          else if($("."+form+" #"+$(value).attr("id")).data('min') != ''){
            var min = $("."+form+" #"+$(value).attr("id")).data('min');
            if(val < min){
              $("."+form+" #"+$(value).attr("id")).addClass('error');
            }
            else{
              $("."+form+" #"+$(value).attr("id")).removeClass('error');  
            } 
          }
          else{
            $("."+form+" #"+$(value).attr("id")).removeClass('error');
          }
		/*$("."+form+" #"+$(value).attr("id")).tooltip({placement: 'top',trigger: 'manual'}).tooltip('hide');*/
      }
    }
    else if ($("."+form+" #"+$(value).attr("id")).data('validate') == 'alphabate') {
      var val=$("."+form+" #"+$(value).attr("id")).val();
      var regex = /^[a-zA-Z\s]+$/;
        if(!regex.test(val)){
          $("."+form+" #"+$(value).attr("id")).addClass('error');
      /*$("."+form+" #"+$(value).attr("id")).tooltip({placement: 'top',trigger: 'manual'}).tooltip('show');*/
        }
        else{
          if($("."+form+" #"+$(value).attr("id")).data('max') != ''){
            var max = $("."+form+" #"+$(value).attr("id")).data('max');

            if(val > max){
              $("."+form+" #"+$(value).attr("id")).addClass('error');
            }
            else{
              $("."+form+" #"+$(value).attr("id")).removeClass('error');  
            }
          }
          else if($("."+form+" #"+$(value).attr("id")).data('min') != ''){
            var min = $("."+form+" #"+$(value).attr("id")).data('min');
            if(val < min){
              $("."+form+" #"+$(value).attr("id")).addClass('error');
            }
            else{
              $("."+form+" #"+$(value).attr("id")).removeClass('error');  
            } 
          }
          else{
            $("."+form+" #"+$(value).attr("id")).removeClass('error');
          }
      /*$("."+form+" #"+$(value).attr("id")).tooltip({placement: 'top',trigger: 'manual'}).tooltip('hide');*/
        }
      }
    else if ($("."+form+" #"+$(value).attr("id")).data('validate') == 'email') {
      var val=$("."+form+" #"+$(value).attr("id")).val();
      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(val)){
          $("."+form+" #"+$(value).attr("id")).addClass('error');
		  /*$("."+form+" #"+$(value).attr("id")).tooltip({placement: 'top',trigger: 'manual'}).tooltip('show');*/
        }
        else{
          $("."+form+" #"+$(value).attr("id")).removeClass('error');
		  /*$("."+form+" #"+$(value).attr("id")).tooltip({placement: 'top',trigger: 'manual'}).tooltip('hide');*/
        }
      }
      else if($("."+form+" #"+$(value).attr("id")).data('validate') == 'Password'){
        var val=$("."+form+" #"+$(value).attr("id")).val();
        var regex =/.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[@#$%^_&+=]).*$/;
        if(!regex.test(val)){
          $("."+form+" #"+$(value).attr("id")).addClass('error');
		  /*$("."+form+" #"+$(value).attr("id")).tooltip({placement: 'top',trigger: 'manual'}).tooltip('show');*/
        }
        else{
          $("."+form+" #"+$(value).attr("id")).removeClass('error');
		  /*$("."+form+" #"+$(value).attr("id")).tooltip({placement: 'top',trigger: 'manual'}).tooltip('hide');*/
        }
      }
      else if($("."+form+" #"+$(value).attr("id")).data('validate') == 'number'){
        var val=$("."+form+" #"+$(value).attr("id")).val();
        var regex =/^[0-9]+$/;
        if(!regex.test(val)){
          $("."+form+" #"+$(value).attr("id")).addClass('error');
		      /*$("."+form+" #"+$(value).attr("id")).tooltip({placement: 'top',trigger: 'manual'}).tooltip('show');*/
        }
        else{
          if($("."+form+" #"+$(value).attr("id")).data('max') != ''){
            var max = $("."+form+" #"+$(value).attr("id")).data('max');

            if(val > max){
              $("."+form+" #"+$(value).attr("id")).addClass('error');
            }
            else{
              $("."+form+" #"+$(value).attr("id")).removeClass('error');  
            }
          }
          else if($("."+form+" #"+$(value).attr("id")).data('min') != ''){
            var min = $("."+form+" #"+$(value).attr("id")).data('min');
            if(val < min){
              $("."+form+" #"+$(value).attr("id")).addClass('error');
            }
            else{
              $("."+form+" #"+$(value).attr("id")).removeClass('error');  
            } 
          }
          else{
            $("."+form+" #"+$(value).attr("id")).removeClass('error');
            /*$("."+form+" #"+$(value).attr("id")).tooltip({placement: 'top',trigger: 'manual'}).tooltip('hide');*/
          }
        }

      }
  });
  
    var numItems=$('.'+form).find('.error').length;
    //var numItems = $('form.'+form+'>'+'.error').length;
    if(numItems>0){
      return 0;
    }
    else{
      return 1;
    }
}
function on_load_validate(){
	$(".validate").blur(function(e){
	id = $(this).attr('id');
	
	if($("#"+id).data('validate') == 'require'){
      if($("#"+id).val()==''){
		/*$("#"+id).tooltip({placement: 'top',trigger: 'manual'}).tooltip('show');*/
        $("#"+id).addClass('error');
      }
      else {
        $("#"+id).removeClass('error');
		/*$("#"+id).tooltip({placement: 'top',trigger: 'manual'}).tooltip('hide');*/
      }
    }
    else if ($("#"+id).data('validate') == 'alphabate') {
      var val=$("#"+id).val();
      var regex = /^[a-zA-Z\s]+$/;
        if(!regex.test(val)){
    /*$("#"+id).tooltip({placement: 'top',trigger: 'manual'}).tooltip('show');*/
          $("#"+id).addClass('error');
        }
        else{
          $("#"+id).removeClass('error');
      /*$("#"+id).tooltip({placement: 'top',trigger: 'manual'}).tooltip('hide');*/
        }
      }
    else if ($("#"+id).data('validate') == 'email') {
      var val=$("#"+id).val();
      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(val)){
		/*$("#"+id).tooltip({placement: 'top',trigger: 'manual'}).tooltip('show');*/
          $("#"+id).addClass('error');
        }
        else{
          $("#"+id).removeClass('error');
		  /*$("#"+id).tooltip({placement: 'top',trigger: 'manual'}).tooltip('hide');*/
        }
      }
      else if($("#"+id).data('validate') == 'number'){
        var val=$("#"+id).val();
        var regex =/^[0-9]+$/;
        if(!regex.test(val)){
		      /*$("#"+id).tooltip({placement: 'top',trigger: 'manual'}).tooltip('show');*/
          $("#"+id).addClass('error');
        }
        else{
          if($("#"+id).attr('data-max')){
            var max = $("#"+id).data('max');
            if(val > max){
              $("#"+id).addClass('error');
            }
            else{
              $("#"+id).removeClass('error');  
            }
          }
          else if($("#"+id).attr('data-min')){
            var min = $("#"+id).data('min');
            if(val < min){
             $("#"+id).addClass('error');
            }
            else{
              $("#"+id).removeClass('error');
            } 
          }
          else if($("#"+id).attr('data-minlenght') || $("#"+id).attr('data-maxlenght')){
            var lmax = $("#"+id).data('maxlenght');
            var lmin = $("#"+id).data('minlenght');
            if(lmax != undefined && lmin != undefined){
              if(val.length > lmax || val.length < lmin){
                $("#"+id).addClass('error');
              }
              else{
                $("#"+id).removeClass('error');  
              }  
            }
            else if(lmin != undefined){
              if(val.length < lmin){
                $("#"+id).addClass('error');
              }
              else{
                $("#"+id).removeClass('error');
              }
            }
            else if(lmax != undefined){
              if(val.length < lmin){
                $("#"+id).addClass('error');
              }
              else{
                $("#"+id).removeClass('error');
              } 
            }
          }
          else{
            
            $("#"+id).removeClass('error');
          /*$("#"+id).tooltip({placement: 'top',trigger: 'manual'}).tooltip('hide');*/
          }
        
		}
	}
      
  });
  $('input[type="file"]').change(function(e){
		if ($(this).data('validate') == 'file'){
		var ext = $(this).val().split('.').pop().toLowerCase();
		if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
			$(this).val("");
			$(this).next("label").tooltip({placement: 'top',trigger: 'manual'}).tooltip('show');
			$(this).next("label").html( '<span>Choose File</span>' );
			$(this).next("label").addClass('error');
		}
		else{
		$(this).next("label").tooltip({placement: 'top',trigger: 'manual'}).tooltip('hide');
			$(this).next("label").removeClass('error');
		}
	  }
  });
}
