function displayErrorMsgForm(error, field) {
 
 
  if(error) {
    $('.error-'+field).show();
  } else {
    $('.error-'+field).hide();
  }
}

function checkFormFieldDevenirPartenaire(myField) {
  
  const regexEmail = /^([0-9a-zA-Z].*?@([0-9a-zA-Z].*\.\w{2,4}))$/;
  /* var regexPhone = /^(0|\+33)[1-9](\d{2}){4}$/; */
  const regexPhone = /^(0)[1-9](\d{2}){4}$/;
  
  let error = false;

  if(myField == 'fdp-nom' && $('#fdp-nom').val().length < 2){
    error = true
    displayErrorMsgForm(error, myField)
  } else if (myField == 'fdp-nom'){
    displayErrorMsgForm(error, myField)
  }

  if(myField == 'fdp-nom-contact' && $('#fdp-nom-contact').val().length < 2){
    error = true
    displayErrorMsgForm(error, myField)
  } else if (myField == 'fdp-nom-contact'){
    displayErrorMsgForm(error, myField)
  }

  if(myField == 'fdp-activite-entreprise' && $('#fdp-activite-entreprise').val().length < 2){
    error = true
    displayErrorMsgForm(error, myField)
  } else if (myField == 'fdp-activite-entreprise'){
    displayErrorMsgForm(error, myField)
  }

  if((myField == 'fdp-mail') &&($('#fdp-mail').val().length == 0 || ($('#fdp-mail').val().length > 0 && !regexEmail.test($('#fdp-mail').val())))){
    error = true
    displayErrorMsgForm(error, myField)
  } else if (myField == 'fdp-mail') {
    displayErrorMsgForm(error, myField)
  }
  
  if((myField == 'fdp-tel') && ($('#fdp-tel').val().length > 0 && !regexPhone.test($('#fdp-tel').val()))){
    error = true
    displayErrorMsgForm(error, myField)
  } else if (myField == 'fdp-tel'){
    displayErrorMsgForm(error, myField)
  }

  if(myField == 'fdp-conditions' && !($('#fdp-conditions').is(":checked"))){
    error = true;
  } 

  if((myField == 'fdp-captcha') && ((($('#fdp-captcha').val().length < 1)) || (($('#fdp-captcha').val().length > 0) && (myMd5($('#fdp-captcha').val())) != ($('#fdp-vcaptcha').val())))) {
    error = true;
  }

  validFormDevenirPartenaire()
  
}

function validFormDevenirPartenaire() {
  const regexEmail = /^([0-9a-zA-Z].*?@([0-9a-zA-Z].*\.\w{2,4}))$/;
  /* var regexPhone = /^(0|\+33)[1-9](\d{2}){4}$/; */
  const regexPhone = /^(0)[1-9](\d{2}){4}$/;
  
  let formOK = true;

  if($('#fdp-nom-contact').val().length < 2){
    formOK = false;
  }

  if($('#fdp-activite-entreprise').val().length < 2){
    formOK = false;
  }

  if($('#fdp-nom').val().length < 2){
    formOK = false;
  }

  if($('#fdp-mail').val().length == 0 || ($('#fdp-mail').val().length > 0 && !regexEmail.test($('#fdp-mail').val()))){
    formOK = false;
  } 
  
  if($('#fdp-tel').val().length > 0 && !regexPhone.test($('#fdp-tel').val())){
    formOK = false;
  }

  if(!($('#fdp-conditions').is(":checked"))){
    formOK = false;
  } 

  if((($('#fdp-captcha').val().length < 1)) || (($('#fdp-captcha').val().length > 0) && (myMd5($('#fdp-captcha').val())) != ($('#fdp-vcaptcha').val()))) {
    formOK = false;
  }

  if(formOK){
    $('#fdp-submit').addClass('btn-active');
    $('#fdp-submit').removeClass('btn-inactive');
    $('#fdp-submit').prop('disabled', false);
  } else {
    $('#fdp-submit').removeClass('btn-active');
    $('#fdp-submit').addClass('btn-inactive');
    $('#fdp-submit').prop('disabled', true);
  }

  // Soumission du formulaire
  /* if(myField == 'fdp-submit') {
    console.info("SUBMIT")
  } */
  
  return formOK

}