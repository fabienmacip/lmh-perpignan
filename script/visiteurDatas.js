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
  alert('Fonction pour envoie de mail de mise en relation.\n--- BIENTOT disponible ---');
  /* visiteur : nom, prenom, mail, tel
  partenaire : nom, mail */
  
  //alert(getCookie('user'));
}


/* --------------------------------------------------------------------------------------------------------------------------------------- */

function testCreationProspect() {

  let datasObj = {};
  
  datasObj.nom = "Dupond";
  datasObj.prenom = "Charly";
  datasObj.mail = "lui@gmail.com";
  datasObj.telephone = "06 33 44 55 66";

  //createProspectFromPublic($nom, $prenom, $mail, $telephone)

  let data = new FormData();
  for (const key in datasObj) {
    data.append(key, datasObj[key])
  }
  var req = new XMLHttpRequest();
  req.responseType = 'json';
  req.open('POST', 'controleurs/createProspectFromPublic.php');

  // SPINNER


  req.onloadstart = function() {
    $('#testCreateProspect').css('background-color','green')
  }
  
  req.onprogress = function() {
    $('#testCreateProspect').css('background-color','purple')
  }

  req.onload = function() {
    $('#testCreateProspect').css('background-color','orange')
  }
  
  req.onloadend = function () {
    $('#testCreateProspect').css('background-color','red')
    let procedureOK = req.response["prospectok"]
    //console.log(req.response["prospectok"])

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

  let form = `<div id="content-short-mail-box">
                  <div id="croixCloseFSM" onclick="closeFormShortMail()" style="padding:1rem">X</div>
                  
                  <div id="confirmShortMailSent"></div><!-- messages d'erreur -->
                  <div id="rappelDonneesMoto" class="mb-2">${rappelDonnees}<br><br>RICHARD ! Je sais, pour le moment c'est moche... D'abord les fonnctionnalités, ensuite la déco ;-)</div>

                  <form id="formShortMail" method='post' action="app/controllers/sendShortMail.php">
                      <div id="fsm-contact-donnees">
                        <div id="fsm-contact-coordonnees">
                          <div>
                            <label for="fsm-nom">Nom <span class="asterisque"></span><br>
                            <input type="text" id="fsm-nom" name="fsm-nom" maxlength=50 placeholder="votre nom" tabindex="1">
                            </label>
                          </div>
                        <div>
                          <label for="fsm-prenom">Pr&eacute;nom <span class="asterisque"></span><br>
                          <input type="text" id="fsm-prenom" name="fsm-prenom"  maxlength=10 placeholder="votre pr&eacute;nom" tabindex="2">
                          </label><br>
                        </div>
                        <div>
                          <label for="fsm-mail">Mail <span class="asterisque"></span><br>
                          <input type="email" id="fsm-mail" name="fsm-mail" maxlength=50 placeholder="votre mail" tabindex="3">
                          </label>
                        </div>
                        <div>
                          <label for="fsm-tel">T&eacute;l&eacute;phone <span class="asterisque"></span><br>
                          <input type="text" id="fsm-tel" name="fsm-tel"  maxlength=10 placeholder="num&eacute;ro &agrave; 10 chiffres ET sans espaces" tabindex="4">
                          </label><br>
                        </div>
                      </div>

                      <div id="short-contact-btn" class="mt-2 flex gap-10">
                        <div class="button CTAButton shortMailButton" id="btn-annuler-short-mail" name="btn-annuler-short-mail" value="ANNULER" tabindex="5" onClick="closeFormShortMail()">Annuler</div><br/>
                        <div class="button CTAButton shortMailButton" id="btn-envoyer-short-mail" name="btn-envoyer-short-mail" value="ENVOYER" tabindex="6" onClick="confirmSendShortMail()">Envoyer</div>
                      </div>	
                  </form>
              </div>`;

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

  let c = $('#croixCloseFSM');
  c.style.backgroundColor = 'rgba(0,0,0,0.1)';
  c.style.width = '4rem';
  c.style.textAlign = 'center';
  c.style.marginBottom = '1rem';
  c.style.cursor = 'pointer';
  c.classList.add('hoverCroix');

              

}

function closeFormShortMail(){
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

function confirmSendShortMail() {

  

  let formOK = true;

  if(formOK) {
    alert('Validation bientôt développée...')
  } else {
    // Contenu initial

    if($('#fsm-mail').value.length > 0 && !regexEmailShort.test($('#fsm-mail').value)){
      formOK = false;
      renderErrorFormContact($('#fsm-mail').parentNode, "Merci d'entrer une adresse mail valide.");
    } 
    
    if($('#fsm-tel').value.length > 0 && !regexPhoneShort.test($('#fsm-tel').value)){
      formOK = false;
      renderErrorFormContact($('#fsm-tel').parentNode, "Le téléphone doit comporter 10 chiffres.");
    }
    
    if($('#fsm-mail').value === '' && $('#fsm-tel').value === ''){
      formOK = false;
      renderErrorFormContact($('#fsm-tel').parentNode, "Merci d'indiquer une adresse mail OU une numéro de téléphone.");
      renderErrorFormContact($('#fsm-mail').parentNode, "Merci d'indiquer une adresse mail OU une numéro de téléphone.");
    }
  
    if($('#fsm-message').value.trim().length === 0){
      formOK = false;
      renderErrorFormContact($('#fsm-message').parentNode, "Avez-vous écrit un message ?");
    }
  
    if(formOK){
      if (confirm("Confirmer l'envoi de ce message ?")) { 
  
        let keroxObj = {};
  
        keroxObj.titre = $('#fsm-titre').value;
        keroxObj.couleur = $('#fsm-couleur').value;
        keroxObj.km = $('#fsm-km').value;
        keroxObj.prix = $('#fsm-prix').value;
        keroxObj.alma = $('#fsm-alma').value;
  
        keroxObj.mail = $('#fsm-mail').value;
        keroxObj.tel = $('#fsm-tel').value;
        keroxObj.message = $('#fsm-message').value;
    
        //enableButtonLoadingState($('#btn-envoyer-mail'));
        sendShortMail(keroxObj);
       } 
    }

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
