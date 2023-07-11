var PHP_AJAX_VISITEUR = "http://pcf-lcf.fr/lmh-perpignan/controleurs/createProspectFromPublic.php"


// ####################  PARTENAIRE - Mise en relation d'un visiteur ####################
function checkVisiteurRegistered(id){
  
  // Si c'est déjà ouvert, alors on ferme les DIVS
  if(!$('.univers-enfant-to-display-'+id).hasClass('inaccessible')) {
    $('#down-arrow-univers-enfant-'+id).css({'transform' : 'rotate('+ 0 +'deg)'})
    $('.univers-enfant-to-display-'+id).addClass('inaccessible')
  } else {
    // Si c'est fermé, alors avant, on vérifie si le visiteur est enregistré
    if(localStorage.getItem('laref-nom') && localStorage.getItem('laref-nom') !== '') {
      //alert('OK\n'+localStorage.getItem('laref-user'));
      $('.univers-enfant-to-display-'+id).removeClass('inaccessible')
      $('#down-arrow-univers-enfant-'+id).css({'transform' : 'rotate('+ 180 +'deg)'})
    } else {
      displayShortMessageBox("Enregistrez-vous pour pouvoir accéder à nos références", couleur = '', km = '', prix = '', alma = '')
      
      //displayShortMessageBox(titre, couleur = '', km = '', prix = '', alma = '')
      //localStorage.setItem('laref-user','Pedro');
    }
  }
  
}


function sendDemandeRelation() {

  id = localStorage.getItem('laref-id') ?? ''
  nom = localStorage.getItem('laref-nom') ?? ''

  plus = ''
  if(id !== '' && nom != ''){
    plus = 'Votre nom est enregistré : ' + nom + '.\nAinsi que votre identifiant : ' + id
  }

  alert('Fonction pour envoie de mail de mise en relation.\n--- BIENTOT disponible ---\n\n'+plus);
  /* visiteur : nom, prenom, mail, tel
  partenaire : nom, mail */
  
  //alert(getCookie('user'));
}


/* --------------------------------------------------------------------------------------------------------------------------------------- */

function createVisiteur(nom, prenom, mail, telephone) {

  let datasObj = {};
  
  datasObj.nom = nom;
  datasObj.prenom = prenom;
  datasObj.mail = mail;
  datasObj.telephone = telephone;

  let data = new FormData();
  for (const key in datasObj) {
    data.append(key, datasObj[key])
  }
  var req = new XMLHttpRequest();
  req.responseType = 'json';
  req.open('POST', 'controleurs/createProspectFromPublic.php');
  //req.open('POST', PHP_AJAX_VISITEUR);

  // SPINNER
  req.onloadstart = function() {
    
  }
  
  req.onprogress = function() {
    
  }

  req.onload = function() {
    
  }
  
  // Requête terminée, résultat
  req.onloadend = function () {
    
    let procedureOK = req.response["prospectok"]

    if(procedureOK) {

      id = req.response["id"]
      nom = req.response["nom"]
      prenom = req.response["prenom"]
      mail = req.response["mail"]
      tel = req.response["telephone"]
      date = req.response["date"]

      setLocalLarefUser(id,nom,prenom,mail,tel,date)

      alert('Vous avez bien été enregistré, vous pouvez désormais prendre contact avec nos références.')
    } else {
      alert('Erreur lors de votre enregistrement.\nVous pouvez ré-essayer ou nous contacter directement par mail afin que nous puissions vous inscrire.')
    }

  }
  
  // Envoie requête
  req.send(data);

}






// AUTORISER ou PAS le VISITEUR à lire les infos des PARTENAIRES
function setLocalLarefUser(id,nom,prenom,mail,tel,date) {
  
 // ajouter un if DATE pas trop vieille...

  if(id !== '') {
    localStorage.setItem('laref-id',id);
  }
  if(nom !== '') {
    localStorage.setItem('laref-nom',nom);
  }
  if(prenom !== '') {
    localStorage.setItem('laref-prenom',prenom);
  }
  if(mail !== '') {
    localStorage.setItem('laref-mail',mail);
  }
  if(tel !== '') {
    localStorage.setItem('laref-tel',tel);
  }
  if(date !== '') {
    localStorage.setItem('laref-date',date);
  }
}



function checkVisiteurFormField(field) {
  
  let error = false;
  
  if(field == 'fsm-tel') {

    const regexPhone = /^(0)[1-9](\d{2}){4}$/;
    //error = ($('#telephone').val().length > 0 && !regexPhone.test($('#telephone').val()));    
    error = (($('#fsm-tel').val().length > 0 && !regexPhone.test($('#fsm-tel').val())) || $('#fsm-tel').val().trim().length < 1);    

  } else if (field == 'fsm-mail') {
    
    const regexEmail = /^([0-9a-zA-Z].*?@([0-9a-zA-Z].*\.\w{2,4}))$/;
    error = (($('#fsm-mail').val().length > 0 && !regexEmail.test($('#fsm-mail').val())) || $('#fsm-mail').val().trim().length < 1);

  } else if (field =='fsm-conditions') {
    
  } else if (field == 'fsm-captcha') {
    error = (($('#fsm-captcha').val().length < 1)) || (($('#fsm-captcha').val().length > 0) && (myMd5($('#fsm-captcha').val())) != ($('#fsm-vcaptcha').val()))
  } else {
    
    error = ($('#'+field).val().trim().length < 2);

  }
  
  //error = ($('#email').val() === '' && $('#telephone').val() === '');

  if(error) {
    $('#error-'+field).show();
  } else {
    $('#error-'+field).hide();
  }
  
  validFormVisiteur();

}


function validFormVisiteur() {
  
    const regexEmail = /^([0-9a-zA-Z].*?@([0-9a-zA-Z].*\.\w{2,4}))$/;
    /* var regexPhone = /^(0|\+33)[1-9](\d{2}){4}$/; */
    const regexPhone = /^(0)[1-9](\d{2}){4}$/;
    
    let formOK = true;
  
    if($('#fsm-nom').val().length < 2){
      formOK = false;
      
      //renderErrorFormContact($('#fm-nom').parentNode, "Le nom doit comporter au moins 2 caractères.");
    }
  
    if($('#fsm-prenom').val().length < 2){
      formOK = false;
      //renderErrorFormContact($('#fm-prenom').parentNode, "Le prénom doit comporter au moins 2 caractères.");
      
    }
  
    if($('#fsm-mail').val().length == 0 || ($('#fsm-mail').val().length > 0 && !regexEmail.test($('#fsm-mail').val()))){
      formOK = false;
      
      //renderErrorFormContact($('#fm-mail').parentNode, "Merci d'entrer une adresse mail valide.");
    } 
    
    if($('#fsm-tel').val().length > 0 && !regexPhone.test($('#fsm-tel').val())){
      formOK = false;
      
      //renderErrorFormContact($('#fm-tel').parentNode, "Le téléphone doit comporter 10 chiffres.");
    }
  
    if(!($('#fsm-conditions').is(":checked"))){
      formOK = false;

      
      //renderErrorFormContact($('#fm-consentement').parentNode, "Avez-vous lu et accepté les conditions générales ?");
    } else {
      
    }
 
    if((($('#fsm-captcha').val().length < 1)) || (($('#fsm-captcha').val().length > 0) && (myMd5($('#fsm-captcha').val())) != ($('#fsm-vcaptcha').val()))) {
      formOK = false;
    }

    if(formOK){
      $('#btn-envoyer-visiteur').addClass('btn-active');
      $('#btn-envoyer-visiteur').removeClass('btn-inactive');
      $('#btn-envoyer-visiteur').prop('disabled', false);
    } else {
      $('#btn-envoyer-visiteur').removeClass('btn-active');
      $('#btn-envoyer-visiteur').addClass('btn-inactive');
      $('#btn-envoyer-visiteur').prop('disabled', true);
    }
    
    return formOK

}

function replaceNumberAsString(thechar) {
  switch(thechar) {
    case "0":
      return "3"
      break;
    case "1":
      return "5"
      break;
    case "2":
      return "7"
      break;
    case "3":
      return "9"
      break;
    case "4":
      return "0"
      break;
    case "5":
      return "8"
      break;   
    case "6":
      return "4"
      break;
    case "7":
      return "6"
      break;    
    case "8":
      return "2"
      break;
    case "9":
      return "1"
      break;
    default:
      return ""
  }

}

function myMd5(chaine) {
  chaine = chaine.toString()
  chaine2 = ''

  for(j = 0 ; j < chaine.length ; j++) {
    chaine2 += replaceNumberAsString(chaine.charAt(j))
  }
  
  return chaine2

}

/* ------------------------- Mini formulaire contact direct depuis annonce ------------------------------ */

function displayShortMessageBox(titre, couleur = '', km = '', prix = '', alma = ''){
    
  if(titre === "mustang"){
      rappelDonnees = "";
  } 
  else {
      if(couleur === '' && km === '' && prix === ''){
          rappelDonnees = titre;
      } else {
          rappelDonnees = titre + " " + "(" + couleur + ") - " + km + " km - " + prix + " €";
      }
  }

  /* CAPTCHA */
  let nb1 = Math.floor(Math.random() * 5) + 1
  let nb2 = Math.floor(Math.random() * 5) + 1
  let somme = nb1 + nb2

  let captchaCrypted = myMd5(somme)

  /* FIN CAPTCHA */

  let form = `<div id="content-short-mail-box">
                  <div id="croixCloseFormVisiteur" onclick="closeFormVisiteur()">X</div>
                  
                  <div id="confirmShortMailSent"></div><!-- messages d'erreur -->
                  <div id="rappelDonneesMoto" class="mb-2">${rappelDonnees}<br><br>RICHARD ! Je sais, pour le moment c'est moche... D'abord les fonctionnalités, ensuite la déco ;-)</div>

                  <form id="formShortMail" method='post' action="">
                      <div id="fsm-contact-donnees">
                        <div id="fsm-contact-coordonnees">
                          <div>
                            <label for="fsm-nom">Nom <span class="asterisque"></span><br>
                            <input type="text" id="fsm-nom" name="fsm-nom" maxlength=50 placeholder="votre nom" tabindex="1" oninput="checkVisiteurFormField('fsm-nom')"
                            onblur="checkVisiteurFormField('fsm-nom')">
                            </label><br>
                            <div id="error-fsm-nom" class="visiteur-form-error">Nom : minimum 2 caract&egrave;res</div>
                          </div>
                        <div>
                          <label for="fsm-prenom">Pr&eacute;nom <span class="asterisque"></span><br>
                          <input type="text" id="fsm-prenom" name="fsm-prenom"  maxlength=10 placeholder="votre pr&eacute;nom" tabindex="2" oninput="checkVisiteurFormField('fsm-prenom')"
                          onblur="checkVisiteurFormField('fsm-prenom')">
                          </label><br>
                          <div id="error-fsm-prenom" class="visiteur-form-error">Pr&eacute;nom : minimum 2 caract&egrave;res</div>
                        </div>
                        <div>
                          <label for="fsm-mail">Mail <span class="asterisque"></span><br>
                          <input type="email" id="fsm-mail" name="fsm-mail" maxlength=50 placeholder="votre mail" tabindex="3" oninput="checkVisiteurFormField('fsm-mail')"
                          onblur="checkVisiteurFormField('fsm-mail')">
                          </label><br>
                          <div id="error-fsm-mail" class="visiteur-form-error">Email invalide ou vide</div>
                        </div>
                        <div>
                          <label for="fsm-tel">T&eacute;l&eacute;phone <span class="asterisque"></span><br>
                          <input type="text" id="fsm-tel" name="fsm-tel"  maxlength=10 placeholder="num&eacute;ro &agrave; 10 chiffres ET sans espaces" tabindex="4" oninput="checkVisiteurFormField('fsm-tel')"
                          onblur="checkVisiteurFormField('fsm-tel')">
                          </label><br>
                          <div id="error-fsm-tel" class="visiteur-form-error">T&eacute;l&eacute;phone invalide ou vide</div>
                        </div>
                        <div id="div-conditions-visiteur" class="flex flex-row">
                          <div class="mr-5">
                            <input type="checkbox" name="fsm-conditions" id="fsm-conditions" onclick="checkVisiteurFormField('fsm-conditions')" tabindex="5">
                          </div>  
                          <div>
                            J'ai lu et j'accepte les conditions g&eacute;n&eacute;rales d'utilisation des donn&eacute;es.<br>
                            Consultez notre <a style="color:red;" class="link" onclick="popMentionsLegales()" tabindex="6">mentions légales</a>
                            pour en savoir plus sur l'utilisation de vos donn&eacute;es ou pour exercer vos droits et notamment votre droit d'opposition.
                          </div>	
                        </div>
                      </div>

                      <div>
                        <input type="hidden" id="fsm-vcaptcha" name="fsm-vcaptcha" value="${captchaCrypted}">
                        <input class="input" type="text" style="width:12rem; margin-top:1rem; margin-bottom:0;" maxlength="3" id="fsm-captcha" name="fsm-captcha" tabindex="7" placeholder="Combien font ${nb1} + ${nb2} ?"
                        oninput="checkVisiteurFormField('fsm-captcha')" onblur="checkVisiteurFormField('fsm-captcha')"><br>
                        <small><i>
                          (Vérification anti-robots)
                        </i></small>
                      </div>

                      <div id="short-contact-btn" class="mt-2 flex gap-10">
                        <button class="button CTAButton shortMailButton" id="btn-annuler-visiteur" name="btn-annuler-visiteur" value="ANNULER" tabindex="8" onClick="closeFormVisiteur()">Annuler</button><br/>
                        <button class="button CTAButton shortMailButton btn-inactive" disabled id="btn-envoyer-visiteur" name="btn-envoyer-visiteur" value="ENVOYER" tabindex="9" onClick="registerVisiteur()">Envoyer</button>
                      </div>	
                  </form>
              </div>`;
{/* <a class="doc-link" href="assets/doc/Lettre-RGPD-LCF.pdf" target="_blank">Politique données personnelles</a> */}
  let f = document.createElement('div');
  f.setAttribute('id','div-fsm');
  f.style.zIndex = 1000;
  f.style.display = 'flex';
  f.style.flexFlow = 'row';
  f.style.justifyContent = 'center';
  f.style.position = "absolute";
  f.style.top = 0;
  f.style.left = 0;
  f.style.backgroundColor = "rgba(240,240,240,0.95)";
  f.style.height = "100%";
  f.style.width = "100%";
  f.style.padding = "1rem";
  f.innerHTML = form;
  window.scrollTo(0,0);
  document.body.appendChild(f);

}

function closeFormVisiteur(){
  $('#div-fsm').remove();
}




function manageFormShortContact(e){
  e.preventDefault();
  alert("coucou");
  console.log(e);
}

var regexEmailShort = /^([0-9a-zA-Z].*?@([0-9a-zA-Z].*\.\w{2,4}))$/;
/* var regexPhone = /^(0|\+33)[1-9](\d{2}){4}$/; */
var regexPhoneShort = /^(0)[1-9](\d{2}){4}$/;



function registerVisiteur() {
  if(validFormVisiteur()) {
    
    nom = $('#fsm-nom').val();
    prenom = $('#fsm-prenom').val();
    mail = $('#fsm-mail').val();
    telephone = $('#fsm-tel').val();

    createVisiteur(nom, prenom, mail, telephone)


  }
}

function sendShortMail(keroxObj) {

    let data = new FormData();
    for (const key in keroxObj) {
      data.append(key, keroxObj[key])
    }
    var req = new XMLHttpRequest();

/*       console.log(keroxObj);
    debugger;
*/
    req.open('POST', 'app/controllers/sendShortMail.php');

    

    req.onload = function() {

     
      $('#confirmShortMailSent').innerHTML = "Message envoyé avec succ&egrave;s.";
      setTimeout(function() {
          alert('Votre message a été envoyé par mail. Nous vous recontactons dès que possible.');

      }, 1000);
      setTimeout(function() {
          $('#confirmShortMailSent').innerHTML = '';
          resetShortContactFormScreen();
          $('#div-fsm').remove();
      }, 2000); 
    }
    req.send(data);
}

function resetShortContactFormScreen(){
  $("#fsm-titre").value = "";
  $("#fsm-couleur").value = "";
  $("#fsm-km").value = "";
  $("#fsm-prix").value = "";
  $("#fsm-mail").value = "";
  $("#fsm-tel").value = "";
  $("#fsm-message").value = "";
}
