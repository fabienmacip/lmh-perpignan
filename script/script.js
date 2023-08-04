//  ##############  MISSION - 1 ###################

// ########################            CHARGEMENT PAGE OK              #############################

// Fin du chargement de la page.
$(document).ready(() => {
  //$('.hide-partenaires').hide()
let pageMission ='';
/*   if (pageMission = document.getElementById('form-create-mission'))  {
      // ########### PLANQUES ##############
      // On affecte la liste des planques dans une variable en JS
      let listePlanques = [];
      $('#listePlanques div input[type=checkbox]').each(function(){
        listePlanques.push(this.value);
      });

      // ########### AGENTS #############

      // On affecte la liste des agents dans une variable en JS
      let listeAgents = [];
8      // On les trie selon la spécialité, afin d'obliger à choisir au moins un agent de la même
      // spécialité que la mission
      let listeSpecialitesDesAgents = [];
      $('#listeAgents div input[type=checkbox]').each(function(){
        // Génération de la liste des agents
        listeAgents.push([this.value,$('#paysAgent'+this.value).val()]);
        // Génération de liste des spécialités de chaque agent
        listeSpecialitesDesAgents.push([this.value,$('#specialitesAgent'+this.value).val()]);
      });

      majSpecialiteMission($('#form-create-mission div #specialite').val(),listeSpecialitesDesAgents);

      // ############# SPECIALITES #############
      $('#form-create-mission div #specialite').on('change', function() {
        majSpecialiteMission(this.value, listeSpecialitesDesAgents);
      });


      // ########### CIBLES ##############
      // On affecte la liste des cibles dans une variable en JS
      let listeCibles = [];
      $('#listeCibles div input[type=checkbox]').each(function(){
        listeCibles.push(this.value);
      });  

      // ########### CONTACTS ##############
      // On affecte la liste des cibles dans une variable en JS
      let listeContacts = [];
      $('#listeContacts div input[type=checkbox]').each(function(){
        listeContacts.push(this.value);
      });  

      // ####### PLANQUES et CONTACTS ##########
      // Masquer toutes les planques et tous les contacts qui ne sont pas du pays.
      majListePlanquesContacts($('#form-create-mission div #pays').val(), listePlanques, listeContacts);

      // A chaque changement de sélection du pays, masquer toutes les "planques et contacts" qui ne sont pas du pays.
      $('#form-create-mission div #pays').on('change', function() {
        majListePlanquesContacts(this.value, listePlanques, listeContacts);
      });

      // La liste d'agents contient des tableaux : id_agent et id_pays_de_l_agent
      $('#form-create-mission #listeCibles div input[type=checkbox]').on('click', function() {
        //majListeAgents($('#cible'+this.value).val(),$('#paysCible'+this.value).val(), listeAgents);
        majListeAgents(listeCibles, listeAgents);
      });

      // Activer le bouton de validation du formulaire de création d'agent quand on a choisi au moins
      // un agent de la bonne spécialité
      $('#form-create-mission #listeAgents div input[type=checkbox]').on('click', function() {
        verifAuMoinsUnAgentSpe();
      });
      
      
    } */ // FIN du IF pageMission

/*     $('#form-create-devenir-partenaire').on('submit',function(e) {
      e.preventDefault();
    })
 */ if($('#toaster-partenaire-create-msg').length){
      alert($('#toaster-partenaire-create-msg').text())
    }

    // Si on n'est pas ADMIN connecté, alors on n'accède pas aux formulaires de CRUD.
    if($('#isAdmin').val() != 1) {
      $('form').hide(); 
      $('#form-create-devenir-partenaire').show();
      /* $('button').hide(); */
      $('button').prop('disabled',true);
      $('button').addClass('inactif');

      $('.slider-btn-button').removeClass('inactif');
      $('.slider-btn-button').prop('disabled',false);

      $('.btn-toujours-affiche').removeClass('inactif');
      $('.btn-toujours-affiche').prop('disabled', false);

      $('#form-connexion').show();
      /* $('.btn-connexion').show(); */
      $('.btn-connexion').prop('disabled',false);
      $('.btn-connexion').removeClass('inactif');
      /* $('#navbarDropdown').prop('disabled',false); */

      $('.add-link').hide();

      $('.confidentiel').show();

      $('#form-create-devenir-partenaire').show();
      $('#form-create-devenir-partenaire [type=reset]').prop('disabled',false).removeClass('inactif');
      $('#form-create-devenir-partenaire [type=submit]').prop('disabled',false).removeClass('inactif');

      $('.link-hide-partenaire-detail').hide()

      $('.btn-next-month').prop('disabled',false).removeClass('inactif')
      $('.btn-last-month').prop('disabled',false).removeClass('inactif')

      // Si un VISITEUR n'a pas encore donné ses : nom, prénom, mail et téléphone, il n'accède pas aux données des partenaires.
      if($('#isVisiteurRegistered').val() != '') {
        datas = $('#isVisiteurRegistered').val()
        datas = datas.split(',')
        console.log(datas)
        
        setLocalLarefUser(datas[0],datas[1],datas[2],datas[3],datas[4],datas[5]);
        //function setLocalLarefUser(id,nom,prenom,mail,tel,date)

      }


      if(localStorage.getItem('laref-nom') && localStorage.getItem('laref-nom') !== '') {
        //alert('OK\n'+localStorage.getItem('laref-user'));
        //$('.inaccessible').removeClass('inaccessible');
      } else {
        //alert('NOK');
        //localStorage.setItem('laref-user','Pedro');
      }

    } else {

      // Voir les données d'un PARTENAIRE en tant que VISITEUR
      $('.inaccessible').removeClass('inaccessible');

      $('form').show();
      
      $('.confidentiel').hide();

      /* $('button').show(); */
      $('button').prop('disabled',false);
      $('.inactif-force').prop('disabled',true);
      $('#les-admins #tr1 [type=button]').prop('disabled',true).css('background-color','grey').css('border-color','grey');

      
    }

    // MAIS, si on est partenaire, on doit pouvoir modifier ses données de connexion.
    if($('#isPartenaire').val() == 1) {
      //console.log("isPartenaire---");
      

      $('#form-modif-admin-partenaire').show();
      //$('#form-modif-admin-partenaire [type=button]').prop('disabled',false).removeClass('inactif');
      $('#form-modif-admin-partenaire-btn button').removeClass('inactif').prop('disabled',false);
    }


}) // FIN DU document.READY

//  ##############  Impression étiquettes  ###################
/* window.addEventListener('beforeprint', (event) => {
  let body = document.getElementById("body");
  let savebody = document.getElementById("body").innerHTML;
  let tableau = document.getElementById("tableEtiquettes");
  body.replaceChildren(tableau);
  window.addEventListener('afterprint', (event) => {
    body.innerHTML = savebody;
   
  });
}); */

function seepass() {
  if($('#password').prop("type") == "text"){
    $('#password').attr("type", "password"); 
    $('#seepass').removeClass('fa-eye-slash');
    $('#seepass').addClass('fa-eye');
  } else {
    $('#password').attr("type", "text");
    $('#seepass').addClass('fa-eye-slash');
    $('#seepass').removeClass('fa-eye');

  }
}


function handleClickPrint(){
  return window.print();
}



// ##############  UNIVERS  ###################

function showUnivers(universId) {
  window.location.href='index.php?page=univers&univid='+universId
}

function switchUnivers(num){
  $('.univers-to-switch').toggle()
  $('#univers-'+num).toggle()
  $('.show-partenaires-'+num).toggle()
}


// Affiche le formulaire de modification de l'univers
function displayUpdateUnivers(id, nom, surnom){

  let updateForm8 = '<form method="post" action="index.php">' + 
                '<div class="form-group row my-3">' +
                '<div class="col-12 col-lg-6 mb-3 mb-lg-0 d-flex align-items-start">' +
                '<label for="nom"></label><input type="text" maxlength="40" name="nom" value="'+ nom + '" id="nom" placeholder="'+ nom + '" class="form-control">' +
                '</div>' +
                '<div class="col-12 col-lg-6 mb-3 mb-lg-0 d-flex align-items-start">' +
                '<label for="surnom"></label><input type="text" maxlength="40" name="surnom" value="'+ surnom + '" id="surnom" placeholder="'+ surnom + '" class="form-control">' +
                '</div>' +
                '<div class="col-12 col-lg-6 d-flex justify-content-around align-items-start mt-2"><input type="hidden" name="idUniversToUpdate" id="idUniversToUpdate" value="' + id + '">' +
                '<input type="hidden" name="action" id="action" value="updateUnivers">' +
                '<input type="hidden" name="page" id="page" value="universs">' +
                '<button type="reset" class="btn btn-primary">Reset</button>' +
                '<button type="button" id="annuler" class="btn btn-primary">Annuler</button>' +
                '<button type="submit" class="btn btn-primary">Envoyer</button></div></div>' +
                '</form>';

  //let codeAConserver = $(`#tr${id}`);
  let codeAConserver = $('#tr'+id);
  $('#tr'+id).replaceWith("<tr id='tr"+id+"'><td colspan='5'>" + updateForm + "</td></tr>");

  // On frise tous les autres boutons "Modifier"
  $('.updateUnivers').prop('disabled',true);


  // Si on clique sur ANNULER, on ré-affiche la ligne normale -> codeAConserver
  $( "#annuler" ).click(function() {
    $('#tr'+id).replaceWith(codeAConserver);
    $('.updateUnivers').prop('disabled',false);
  });
}

// Confirme suppression d'un Univers
function confirmeSuppressionUnivers(id,nom){
  
  let lien = "index.php?page=universs&action=delete&id=" + id + "&nom="+ nom;

  if(confirm("Supprimer " + nom + " ?")){
    window.location.href = lien;
      
  } 
}

// ##############  PARTENAIRE  ###################

// Affiche le formulaire de modification du partenaire
function displayUpdatePartenaire(id, nom, mail = '', telephone = '', univers){

  let updateForm = '<form method="post" action="index.php">' + 
                '<div class="form-group row my-3">' +
                '<div class="col-12 col-lg-6 mb-3 mb-lg-0 d-flex align-items-start">' +
                '<label for="nom"></label><input type="text" maxlength="40" name="nom" value="'+ nom + '" id="nom" placeholder="'+ nom + '" class="form-control">' +
                '</div>' +
                '<div class="col-12 col-lg-6 mb-3 mb-lg-0 d-flex align-items-start">' +
                '<label for="mail"></label><input type="mail" maxlength="40" name="mail" value="'+ mail + '" id="mail" placeholder="'+ mail + '" class="form-control">' +
                '</div>' +
                '<div class="col-12 col-lg-6 mb-3 mb-lg-0 d-flex align-items-start">' +
                '<label for="telephone"></label><input type="text" maxlength="15" name="telephone" value="'+ telephone + '" id="telephone" placeholder="'+ telephone + '" class="form-control">' +
                '</div>' +
                '<div class="col-12 col-lg-6 mb-3 mb-lg-0 d-flex align-items-start">' +
                '<label for="univers"></label><input type="text" maxlength="20" name="univers" value="'+ univers + '" id="univers" placeholder="'+ univers + '" class="form-control">' +
                '</div>' +
                '<div class="col-12 col-lg-6 d-flex justify-content-around align-items-start mt-2"><input type="hidden" name="idPartenaireToUpdate" id="idPartenaireToUpdate" value="' + id + '">' +
                '<input type="hidden" name="action" id="action" value="updatePartenaire">' +
                '<input type="hidden" name="page" id="page" value="partenaires">' +
                '<button type="reset" class="btn btn-primary">Reset</button>' +
                '<button type="button" id="annuler" class="btn btn-primary">Annuler</button>' +
                '<button type="submit" class="btn btn-primary">Envoyer</button></div></div>' +
                '</form>';

  //let codeAConserver = $(`#tr${id}`);
  let codeAConserver = $('#tr'+id);
  $('#tr'+id).replaceWith("<tr id='tr"+id+"'><td colspan='6'>" + updateForm + "</td></tr>");

  // On frise tous les autres boutons "Modifier"
  $('.updatePartenaire').prop('disabled',true);


  // Si on clique sur ANNULER, on ré-affiche la ligne normale -> codeAConserver
  $( "#annuler" ).click(function() {
    $('#tr'+id).replaceWith(codeAConserver);
    $('.updatePartenaire').prop('disabled',false);
  });
}

// Confirme suppression d'un PARTENAIRE
function confirmeSuppressionPartenaire(id,nom){
  
  let lien = "index.php?page=partenaires&action=delete&id=" + id + "&nom="+ nom;

  if(confirm("Supprimer " + nom + " ?")){
    window.location.href = lien;
      
  } 
}

function confirmeTogglePartenaire(id, nom, actif){
  let lien = "index.php?page=partenaires&actif="+actif+"&action=toggleactif&id=" + id + "&nom="+ nom + "&activation=" + actif;

  let libelleActif = actif == 0 ? 'Activer' : 'Désactiver'

  if(confirm(libelleActif + " " + nom + " ?")){
    window.location.href = lien;
      
  } 

}

function showPartenaireDetail(id) {
  $('#partenaire-detail-'+id).show()
  $('#link-hide-partenaire-detail-'+id).show()
  $('#link-show-partenaire-detail-'+id).hide()
}

function hidePartenaireDetail(id) {
  $('#partenaire-detail-'+id).hide()
  $('#link-hide-partenaire-detail-'+id).hide()
  $('#link-show-partenaire-detail-'+id).show()
}



function displayPartenaireDetail(detail){
  $('#partenaire-detail').show()
  $('#partenaire-detail-texte').html("coucou")
  console.log($('#partenaire-detail').html())

}

function closePartenaireDetail(){
  $('#partenaire-detail').hide()
}

function closeToaster(id) {
  $('#'+id).hide()
}
// ##############  DATE  ###################

// Affiche le formulaire de modification de la date
function displayUpdateDate(id, date){

  let updateForm = '<form method="post" action="index.php">' + 
                '<div class="form-group row my-3">' +
                '<div class="col-12 col-lg-6 mb-3 mb-lg-0 d-flex align-items-start">' +
                '<label for="date"></label><input type="date" maxlength="50" name="date" value="'+ date + '" id="date" min="2023-01-01" max="2050-12-31" placeholder="'+ date + '" class="form-control">' +
                '</div>' +
                '<div class="col-12 col-lg-6 d-flex justify-content-around align-items-start mt-2"><input type="hidden" name="idDateToUpdate" id="idDateToUpdate" value="' + id + '">' +
                '<input type="hidden" name="action" id="action" value="updateDate">' +
                '<input type="hidden" name="page" id="page" value="dates">' +
                '<button type="reset" class="btn btn-primary">Reset</button>' +
                '<button type="button" id="annuler" class="btn btn-primary">Annuler</button>' +
                '<button type="submit" class="btn btn-primary">Envoyer</button></div></div>' +
                '</form>';

  //let codeAConserver = $(`#tr${id}`);
  let codeAConserver = $('#tr'+id);
  $('#tr'+id).replaceWith("<tr id='tr"+id+"'><td colspan='4'>" + updateForm + "</td></tr>");

  // On frise tous les autres boutons "Modifier"
  $('.updateDate').prop('disabled',true);


  // Si on clique sur ANNULER, on ré-affiche la ligne normale -> codeAConserver
  $( "#annuler" ).click(function() {
    $('#tr'+id).replaceWith(codeAConserver);
    $('.updateDate').prop('disabled',false);
  });
}

// Confirme suppression d'une Date
function confirmeSuppressionDate(id,date){
  
  let lien = "index.php?page=dates&action=delete&id=" + id + "&date="+ date;

  if(confirm("Supprimer " + date + " ?")){
    window.location.href = lien;
      
  } 
}


// ####################  ADMINISTRATEUR ####################

// Affiche le formulaire de modification d'un administrateur
function displayUpdateAdministrateur(id, nom, prenom, mail){

  let updateForm = '<form method="post" action="index.php">' + 
                '<div class="form-group row my-3">' +
                '<div class="col-7 col-lg-3 form-floating"><input type="text" maxlength="40" name="nom" value="'+ nom + '" id="nom" placeholder="'+ nom + ' " class="form-control"><label for="nom">Nom</label></div>' +
                '<div class="col-7 col-lg-3 form-floating"><input type="text" name="prenom" value="'+ prenom + '" maxlength="30" id="prenom" placeholder="' + prenom + '" class="form-control"><label for="prenom">Pr&eacute;nom</label></div>' +
                '<div class="col-7 col-lg-3 form-floating"><input type="mail" name="mail" value="' + mail + '" maxlength="50" id="mail" placeholder="' + mail + '" class="form-control"><label for="mail">Mail</label></div>' +
                '<div class="col-7 col-lg-3 form-floating"><input type="text" name="mot_de_passe" value="" minlength="8" maxlength="40" id="mot_de_passe" placeholder="" class="form-control"><label for="mot_de_passe">Mot de passe</label><span style="font-size: 0.7rem;">(laisser vide si vous ne souhaitez pas modifier)</span></div></div>' +               
                '<div class="row text-center"><div class="col-0 col-lg-3"><input type="hidden" name="idAdministrateurToUpdate" id="idAdministrateurToUpdate" value="' + id + '">' +
                '<input type="hidden" name="action" id="action" value="update">' +
                '<input type="hidden" name="page" id="page" value="administrateurs"></div>' +
                '<div class="col-7 col-lg-6 d-flex justify-content-around"><button type="reset" class="btn btn-primary">Reset</button>' +
                '<button type="button" id="annuler" class="btn btn-primary">Annuler</button>' +
                '<button type="submit" class="btn btn-primary">Envoyer</button></div><div class="col-0 col-lg-3"></div></div>' +
                '</form>';

  let codeAConserver = $('#tr'+id);
  $('#tr'+id).replaceWith("<tr id='tr"+id+"'><td colspan='7'>" + updateForm + "</td></tr>");

  // On frise tous les autres boutons "Modifier"
  $('.updateAdministrateur').prop('disabled',true);


  // Si on clique sur ANNULER, on ré-affiche la ligne normale -> codeAConserver
  $( "#annuler" ).click(function() {
    $('#tr'+id).replaceWith(codeAConserver);
    $('.updateAdministrateur').prop('disabled',false);
  });
}

// Confirme suppression d'un administrateur
function confirmeSuppressionAdministrateur(id, nom, prenom){
  
  let lien = "index.php?page=administrateurs&action=delete&id=" + id + "&nom="+ nom + "&prenom="+ prenom;

  if(confirm("Supprimer " + nom + " " + prenom + " ?")){
    // Supprimer la ligne dans la BDD
    window.location.href = lien;
  }
}



function alertMe() {
  alert("Cliqué ! ");
}




