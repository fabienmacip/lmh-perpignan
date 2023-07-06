// ####################  PARTENAIRE - Mise en relation d'un visiteur ####################

function createCookie(name,value,duration = 7776000000) {
  let date = new Date(Date.now() + duration); // 1 jour en millisecondes
  date.toUTCString();
  document.cookie = name+'='+value+'; expires='+duration;
  alert(document.cookie);
}

function deleteCookie(name) {
  document.cookie = name+'=; expires=Thu, 01 Jan 1970 00:00:00 UTC';
  alert(document.cookie);
}

function sendDemandeRelation() {
  alert('Fonction pour envoie de mail de mise en relation.\n--- BIENTOT disponible ---');
  /* visiteur : nom, prenom, mail, tel
  partenaire : nom, mail */
}



/* ------------------------- Mini formulaire contact direct depuis annonce ------------------------------ */

function displayShortMessageBox(titre, couleur = '', km = '', prix = '', alma = ''){
    
  if(titre === "mustang"){
      rappelDonnees = "LOCATION MUSTANG - Demande d'informations";
  } 
  else {
      if(couleur === '' && km === '' && prix === ''){
          rappelDonnees = titre;
      } else {
          rappelDonnees = titre + " " + "(" + couleur + ") - " + km + " km - " + prix + " €";
      }
  }

  if(alma === 'alma'){
      rappelDonnees = 'ALMA / SANTANDER - paiement en plusieurs fois<br>' + rappelDonnees;
  }
  
{/* <div id="rappelDonneesMoto">${titre} (${couleur}) - ${km} km - ${prix} €</div> */}

  let form = `<div id="content-short-mail-box">
                  <div id="croixCloseFSM" onclick="closeFormShortMail()" style="padding:1rem">X</div>
                  
                  <div id="confirmShortMailSent"></div><!-- messages d'erreur -->
                  <div id="rappelDonneesMoto">${rappelDonnees}</div>

                  <form id="formShortMail" method='post' action="app/controllers/sendShortMail.php">
                      <div id="fsm-contact-donnees">
                          <div id="fsm-contact-coordonnees">
                                  <div>
                                      <label for="fsm-mail">Mail <span class="asterisque">(mail ou tél. obligatoire)</span><br>
                                      <input type="email" id="fsm-mail" name="fsm-mail" maxlength=50 placeholder="votre mail" tabindex="1">
                                  </label>
                                  </div>
                                  <div>
                                      <label for="fsm-tel">T&eacute;l&eacute;phone <span class="asterisque">(mail ou tél obligatoire)</span><br>
                                      <input type="text" id="fsm-tel" name="fsm-tel"  maxlength=10 placeholder="num&eacute;ro &agrave; 10 chiffres ET sans espaces" tabindex="2">
                                  </label><br>
                                  </div>
                          </div>
                          <div id="fsm-contact-message">
                              <div>
                                  <label for="fsm-message">Votre message <span class="asterisque">(obligatoire)</span><br>
                                  <textarea id="fsm-message" name="fsm-message" maxlength=500 rows=8 placeholder="votre message" tabindex="3"></textarea></label><br>
                              </div>
                              <div>
                                  <input type="hidden" id="fsm-titre" name="fsm-titre" value="${titre}"/>
                                  <input type="hidden" id="fsm-couleur" name="fsm-couleur" value="${couleur}"/>
                                  <input type="hidden" id="fsm-km" name="fsm-km" value="${km}"/>
                                  <input type="hidden" id="fsm-prix" name="fsm-prix" value="${prix}"/>
                                  <input type="hidden" id="fsm-alma" name="fsm-alma" value="${alma}"/>
                              </div>
                          </div>

                          <div id="short-contact-btn">
                              <div class="button CTAButton shortMailButton" id="btn-annuler-short-mail" name="btn-annuler-short-mail" value="ANNULER" tabindex="4" onClick="closeFormShortMail()">Annuler</div><br/>
                              <div class="button CTAButton shortMailButton" id="btn-envoyer-short-mail" name="btn-envoyer-short-mail" value="ENVOYER" tabindex="5" onClick="confirmSendShortMail()">Envoyer</div>
                          </div>	
                      </div>
                  </form>
              </div>`;

  let f = document.createElement('div');
  f.setAttribute('id','div-fsm');
  f.style.zIndex = 100;
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
