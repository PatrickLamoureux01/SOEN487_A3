/******
 *
 * Functions used to Validate EEMS Forms
 *
******/

function validateEmpty(fld) {
  var error = "";
  if(fld.val().length == 0){  
    fld.addClass("err");  
    error = "      -"+ $('label[for='+fld.attr('id')+']').html() + " can not be empty\n";  
  }else{  
    fld.removeClass("err");  
    error = "";
  }
  return error;
}


function validateEmail(fld) {
  var error="";
}

