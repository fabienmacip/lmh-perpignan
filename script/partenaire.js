function checkFormDevenirPartenaire() {
  
  const regexEmail = /^([0-9a-zA-Z].*?@([0-9a-zA-Z].*\.\w{2,4}))$/;
  /* var regexPhone = /^(0|\+33)[1-9](\d{2}){4}$/; */
  const regexPhone = /^(0)[1-9](\d{2}){4}$/;
  
  let formOK = true;

  if($('#fdp-nom').val().length < 2){
    formOK = false;
  }

  if($('#fdp-mail').val().length == 0 || ($('#fdp-mail').val().length > 0 && !regexEmail.test($('#fdp-mail').val()))){
    formOK = false;
  } 
  
  if($('#fdp-tel').val().length > 0 && !regexPhone.test($('#fdp-tel').val())){
    formOK = false;
  }

  if(!($('#fsm-conditions').is(":checked"))){
    formOK = false;
  } 

  if((($('#fdp-captcha').val().length < 1)) || (($('#fdp-captcha').val().length > 0) && (myMd5($('#fdp-captcha').val())) != ($('#fdp-vcaptcha').val()))) {
    formOK = false;
  }

  if(formOK){
    $('#fdb-submit').addClass('btn-active');
    $('#fdb-submit').removeClass('btn-inactive');
    $('#fdb-submit').prop('disabled', false);
  } else {
    $('#fdb-submit').removeClass('btn-active');
    $('#fdb-submit').addClass('btn-inactive');
    $('#fdb-submit').prop('disabled', true);
  }
  
  return formOK













  $('#fdp-nom')
  $('#fdp-mail')
  $('#fdp-tel')
  $('#fdp-submit')
  
  
  
  

}