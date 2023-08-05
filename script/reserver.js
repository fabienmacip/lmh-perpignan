function displayBigImg(adresse,idimgorigine){
  
  let myimg = `<img src="${adresse}" alt="bureau" id="div-bigimg-img" style="max-width:96%; width: 100%;" class=brad-5>`

  let f = document.createElement('div')
  f.setAttribute('id','div-bigimg')
  f.style.zIndex = 2000
  f.style.display = 'flex'
  f.style.flexFlow = 'row'
  f.style.justifyContent = 'center'
  f.style.position = "absolute"  
  f.style.top = 0
  f.style.left = 0
  f.style.backgroundColor = "rgba(240,240,240,0.95)"
  f.style.height = "100%"
  f.style.width = "100%"
  f.style.padding = "1rem"
  f.innerHTML = myimg
  window.scrollTo(0,0)
  document.body.appendChild(f)
  
  let fimg = document.getElementById('div-bigimg-img')
  fimg.style.width = "auto"
  fimg.style.height = "auto"
  
  $('#div-bigimg').on("click",function() {
    $('#div-bigimg').remove()
    window.scrollTo(0,$('#'+idimgorigine).offset().top-100)
  })

}

function setHeuresRestantesOnClick(heuresRestantes) {
    // Remplacer HeuresRestantes dans toutes les cases cliquables
    //heure-libre heure-modifiable
    let heuresLibres = document.getElementsByClassName('heure-libre')
    let heuresModifiables = document.getElementsByClassName('heure-modifiable')

    for(i = 0 ; i < heuresLibres.length ; i++) {
      let x = heuresLibres[i].getAttribute("onclick")
      let indexEnd = x.length
      let index = x.lastIndexOf(',')
      let newClick = x.substring(0,index) + ",'" + heuresRestantes + "')"
      heuresLibres[i].setAttribute("onclick",newClick)
    }

    for(i = 0 ; i < heuresModifiables.length ; i++) {
      let x = heuresModifiables[i].getAttribute("onclick")
      let indexEnd = x.length
      let index = x.lastIndexOf(',')
      let newClick = x.substring(0,index) + ",'" + heuresRestantes + "')"
      heuresModifiables[i].setAttribute("onclick",newClick)
    }

}

function toggleHeureCalendar(heure,jour,idBureau,idPartenaire,action,heuresRestantes) {
  
  //console.info(heuresRestantes)

  let now = new Date()
  let dateToToggle = new Date(jour+" "+heure)

  if(now > dateToToggle) {
    alert('Ce créneau n\'est plus modifiable.')
    return true
  }

  heuresRestantes = parseInt(heuresRestantes)
  if(heuresRestantes <= 0 && action === 'add') {
    alert('Il vous reste 0 heures pour cette semaine.\n'+
           'Vous devez, pour pouvoir réserver ce créneau horaire, soit :\n'+
           '- Supprimer un créneau horaire,\n'+
           '- Nous contacter pour demander un supplément d\'heures.')
    return true
  }

  let message = ''
  if(action == 'add') {
    message = 'Etes-vous sûr de vouloir réserver ce créneau ?'
  } else if(action == 'remove') {
    message = 'Etes-vous sûr de vouloir libérer ce créneau ?'
  }

  if(!confirm(message)){
    return true
  }
  

  let datasObj = {}

  datasObj.heure = heure
  datasObj.jour = jour
  datasObj.bureauId = idBureau
  datasObj.partenaireId = idPartenaire
  datasObj.action = action // add ou remove

  let data = new FormData();
  for (const key in datasObj) {
    data.append(key, datasObj[key])
  }
  var req = new XMLHttpRequest();
  req.responseType = 'json';
  req.open('POST', 'controleurs/bureauCalendar.php');
  //req.open('POST', PHP_AJAX_VISITEUR);

  // SPINNER
  req.onloadstart = function() {}
  
  req.onprogress = function() {}

  req.onload = function() {}
  
  // Requête terminée, résultat
  req.onloadend = function () {
    
    let procedureOK = req.response["requeteok"]

    if(action === 'add') {
      if(procedureOK){
        let monElement = 'heure-'+heure.substring(0,5)
        let creneauToUpdate = document.getElementById(monElement)

        let heuresRestantes = document.getElementById('heures-restantes-semaine')
        heuresRestantesInt = parseInt(req.response["heures-restantes"])
        heuresRestantes.innerText = req.response["heures-restantes"]

        creneauToUpdate.classList.remove('heure-libre')
        creneauToUpdate.classList.add('heure-modifiable', 'heure-partenaire')
        creneauToUpdate.innerText = 'réservé pour vous'
        //creneauToUpdate.removeAttribute('onclick')
        creneauToUpdate.setAttribute('onclick','toggleHeureCalendar(\''+heure+'\',\''+jour+'\',\''+idBureau+'\',\''+idPartenaire+'\',\'remove\',\''+heuresRestantesInt+'\')')
        
        setHeuresRestantesOnClick(heuresRestantesInt)

        localStorage.setItem('laref-reload-remaining-hours','true')
        localStorage.setItem('laref-reload-remaining-hours-in-week',jour)

        //alert(`Votre créneau horaire a bien été réservé.`)
      } else {
        alert('Erreur lors de la réservation de ce créneau horaire. Si cette erreur persiste, vous pouvez nous contacter directement, nous réserverons ce créneau pour vous.')
      }
    }
    
    if(action === 'remove') {
      if(procedureOK){
        let monElement = 'heure-'+heure.substring(0,5)
        let creneauToUpdate = document.getElementById(monElement)

        let heuresRestantes = document.getElementById('heures-restantes-semaine')
        heuresRestantesInt = parseInt(req.response["heures-restantes"])
        heuresRestantes.innerText = req.response["heures-restantes"]

        creneauToUpdate.classList.remove('heure-modifiable', 'heure-partenaire')
        creneauToUpdate.classList.add('heure-libre')
        creneauToUpdate.innerText = 'disponible'
        creneauToUpdate.setAttribute('onclick','toggleHeureCalendar(\''+heure+'\',\''+jour+'\',\''+idBureau+'\',\''+idPartenaire+'\',\'add\',\''+heuresRestantesInt+'\')')

        setHeuresRestantesOnClick(heuresRestantesInt)

        localStorage.setItem('laref-reload-remaining-hours','true')
        localStorage.setItem('laref-reload-remaining-hours-in-week',jour)

        //alert(`Votre créneau horaire a bien été réservé.`)
      } else {
        alert('Erreur lors de la suppression de ce créneau horaire. Si cette erreur persiste, vous pouvez nous contacter directement, nous supprimerons ce créneau pour vous.')
      }
    }

  }
  // Envoie requête
  req.send(data);
}

function displayCalendarBureauDay(dateSQL, idBureau, idPartenaire,heuresParLePartenaire,heuresPourLePartenaire,heuresParUnAutrePartenaire, heuresRestantes) {
  /* console.log(dateSQL)
  console.log(idBureau)
  console.log(idPartenaire)
  console.log(heuresParLePartenaire)
  console.log(heuresParUnAutrePartenaire) */

  dateFormatOK = dateSQL.substring(8,10)+"/"+dateSQL.substring(5,7)+"/"+dateSQL.substring(0,4)
  
  let options = { weekday: "long" }
  datePourJour = new Intl.DateTimeFormat("fr-FR", options).format(new Date(dateSQL))
  datePourJour = datePourJour.charAt(0).toUpperCase() + datePourJour.slice(1)

  let mainReservations = $('#reservation-main');
  mainReservations.html();

  let heightToGoBack = $('#bureau-'+idBureau).offset().top

  let leJour = `<div id="leJour">
                <input type="hidden" name="dateSQL" id="dateSQL" value="${dateSQL}">
                <input type="hidden" name="bureauId" id="bureauId" value="${idBureau}">
                <div id="closeLeJour" onclick='displayAnewReservationMain(${idPartenaire},${heightToGoBack})' class="pointer"> X </div>
                <h2>${datePourJour} ${dateFormatOK}</h2>
                <h3>Bureau n°${idBureau}</h3>
                <p>Les cr&eacute;neaux se r&eacute;servent par demi-heure. Le dernier cr&eacute;neau commence à 19h30 et se termine donc à 20h00.</p>
                <p>Pour cette semaine, il vous reste <span id="heures-restantes-semaine">${heuresRestantes}</span> heure(s).`

  heuresPartenaire = heuresParLePartenaire.split('/')
  heuresPartenaireSup = heuresPourLePartenaire.split('/')
  heuresAutrePartenaire = heuresParUnAutrePartenaire.split('/')

  // Génération des plages horaires par 60mn - De 08h à 20h
  for(i = 8 ; i<20 ; i++) {
    j = i < 10 ? "0"+i : i

    reserve = heuresPartenaire.includes(j+":00:00") ? 'heure-modifiable heure-partenaire pointer' : 
              heuresPartenaireSup.includes(j+":00:00") ? 'heure-partenaire-sup' :
              heuresAutrePartenaire.includes(j+":00:00") ? 'heure-non-modifiable' : 'heure-libre pointer'
    //reserve30 = heuresPartenaire.includes(j+":30:00") ? 'heure-modifiable heure-partenaire pointer' : heuresAutrePartenaire.includes(j+":30:00") ? 'heure-non-modifiable' : 'heure-libre pointer'

    reserveText = heuresPartenaire.includes(j+":00:00") ? 'r&eacute;serv&eacute; par vous' : 
                  heuresPartenaireSup.includes(j+":00:00") ? 'r&eacute;serv&eacute; pour vous<br><span>(heure en suppl&eacute;ment)</span>' :
                  heuresAutrePartenaire.includes(j+":00:00") ? 'non-disponible' : 'disponible'
    //reserveText30 = heuresPartenaire.includes(j+":30:00") ? 'r&eacute;serv&eacute; pour vous' : heuresAutrePartenaire.includes(j+":30:00") ? 'non-disponible' : 'disponible'

    reserveClic = heuresPartenaire.includes(j+":00:00") ? 
                  `onclick="toggleHeureCalendar(\'${j}:00:00\',\'${dateSQL}\',\'${idBureau}\',\'${idPartenaire}\',\'remove\',\'${heuresRestantes}\')"` : 
                  (heuresAutrePartenaire.includes(j+":00:00") || heuresPartenaireSup.includes(j+":00:00")) ? '' :
                  `onclick="toggleHeureCalendar(\'${j}:00:00\',\'${dateSQL}\',\'${idBureau}\',\'${idPartenaire}\',\'add\',\'${heuresRestantes}\')"`
    //reserveClic30 = heuresPartenaire.includes(j+":30:00") ? `onclick="toggleHeureCalendar(\'${j}:30:00\',\'${dateSQL}\',\'${idBureau}\',\'${idPartenaire}\',\'remove\')"` : heuresAutrePartenaire.includes(j+":30:00") ? '' : `onclick="toggleHeureCalendar(\'${j}:30:00\',\'${dateSQL}\',\'${idBureau}\',\'${idPartenaire}\',\'add\')"`

    leJour += `<div class="flex flew-row jcc aic heure-line"><div class="heure-digitale">${j}:00</div><div id='heure-${j}:00' ${reserveClic} class='heure-contenu tc ${reserve}'>${reserveText}</div></div>`
    //leJour += `<div class="flex flex-row jcc aic heure-line"><div class="heure-digitale">${j}:30</div><div id='heure-${j}:30' ${reserveClic30} class='heure-contenu tc ${reserve30}'>${reserveText30}</div></div>`
  }

  leJour += `</div>`;
  mainReservations.hide();
  let reservationsH1 = $('#reservations-h1')
  reservationsH1.after(leJour)

  let yToScroll = reservationsH1.offset().top - 120
  window.scrollTo(0,yToScroll);
  //mainReservations.hide();
  //document.body.appendChild

}

// day au format : YYYY-MM-DD
function findDimanche(day) {
  day = new Date(day)
  nextDimanche = new Date(day)
  nbToAdd = 7 - day.getDay()
  nextDimanche.setDate(day.getDate() + nbToAdd)
  jour = nextDimanche.getDate() < 10 ? "0"+nextDimanche.getDate() : nextDimanche.getDate()
  mois = nextDimanche.getMonth() + 1
  mois = mois < 10 ? "0"+mois : mois
  return nextDimanche.getFullYear()+"-"+mois+"-"+jour
}

//function displayAnewReservationMain(partenaireId = 2, partenaireDate = '2023-04-03', top = 0){
  function displayAnewReservationMain(partenaireId = 2, top = 0){
  
  let dateSQL = $('#dateSQL').val() // Pour reload calendrier du bureau concerné
  let bureauId = $('#bureauId').val() // Pour reload calendrier du bureau concerné

  // Pour se repositionner (à la fin de cette fonction), sur le calendrier du bureau en cours
  let yToGo = top - 70
  let leJour = $('#leJour')
  leJour.remove();
  let mainReservations = $('#reservation-main')
  mainReservations.show()

  if(localStorage.getItem('laref-reload-remaining-hours') && localStorage.getItem('laref-reload-remaining-hours') === 'true') {
    let datasObj = {}
  
    datasObj.partenaireId = partenaireId
    datasObj.action = 'reloadRemaningHours'
    datasObj.day = localStorage.getItem('laref-reload-remaining-hours-in-week')
  
    let data = new FormData();
    for (const key in datasObj) {
      data.append(key, datasObj[key])
    }
    var req = new XMLHttpRequest();
    req.responseType = 'json';
    req.open('POST', 'controleurs/bureauCalendar.php');
    //req.open('POST', PHP_AJAX_VISITEUR);
  
    // SPINNER
    req.onloadstart = function() {}
    req.onprogress = function() {}
    req.onload = function() {}
    
    // Requête terminée, résultat
    req.onloadend = function () {
      
      let procedureOK = req.response["requeteok"]
  
      if(procedureOK) {
        //let creneauToUpdate = document.getElementById(monElement)
        //$('#span-remaining-hours').html(req.response["remainingHours"])

        // On récupère le dimanche
        let jourModifie = localStorage.getItem('laref-reload-remaining-hours-in-week')
        
        let dimanche = findDimanche(jourModifie)
        
        let remainingHoursToUpdate = document.getElementsByClassName('bureau-heures-restantes-'+dimanche)
        
        for (i = 0; i < remainingHoursToUpdate.length ; i++) {
          remainingHoursToUpdate[i].innerText = req.response["remainingHours"]
        }

        localStorage.setItem('laref-reload-remaining-hours','false')
        //localStorage.removeItem('laref-reload-remaining-hours-in-week')
        //alert(`Votre créneau horaire a bien été réservé.`)
      } else {
        alert('Erreur lors de la réservation de ce créneau horaire. Si cette erreur persiste, vous pouvez nous contacter directement, nous réserverons ce créneau pour vous.')
      }
    }
   
    // Envoie requête
    req.send(data);
     
  } 
  
  let an = dateSQL.substring(0,4)
  let mois = dateSQL.substring(5,7)
  bureauReloadMonth(mois, an, bureauId)

  // On se repositionne sur le calendrier modifié
  window.scrollTo({
    top: yToGo,
    left: 0,
    behavior: 'smooth'
  })


}

// *********************** AFFICHAGE NEXT MONTH et LAST MONTH ***************************************

function loadOneBureauCalendarMonth(moisan, id) {
  
  let datasObj = {}

/*   datasObj.mois = moisan
  datasObj.bureauId = id
  datasObj.action = 'display-next-month'
 */
  let data = new FormData();
  for (const key in datasObj) {
    data.append(key, datasObj[key])
  }
  var req = new XMLHttpRequest();
  req.responseType = 'text';

  req.open('GET', 'controleurs/bureauCalendar.php?moisan=' + moisan + '&id=' + id + '&action=display-bureau-next-month');

  let lemois = '';

  req.onloadstart = function() {}
  req.onprogress = function() {}
  req.onload = function() {}

  req.onloadend = function() {

    lemois = this.responseText;
    bureau = document.getElementById('bureau-corps-'+id)
    bureau.innerHTML = lemois
      
    }
  req.send();
  
}

function bureauReloadMonth(mois = '07', an = '2023', id = '1') {

  mois = parseInt(mois);
  an = parseInt(an);
  
  if(mois < 10){
    mois = "0"+mois;
  }

  let moisan = an.toString()+mois;

  loadOneBureauCalendarMonth(moisan,id);
}


function bureauNextMonth(mois = '07', an = '2023', id = '1') {

  mois = parseInt(mois);
  mois = ((mois + 1) % 12);
  if(mois === 0) { mois = 12; }

  if (mois === 1){
    an = parseInt(an) + 1;
  }
  nextMonth = an+'-'+mois+'-01';
  newMonth = new Date(nextMonth);

  mois = newMonth.getMonth() + 1;
  if(mois < 10){
    mois = "0"+mois;
  }
  an = newMonth.getFullYear();

  let moisan = an.toString()+mois.toString();

  loadOneBureauCalendarMonth(moisan,id);
}

function bureauLastMonth(mois = '07', an = '2023', id = '1') {

  mois = parseInt(mois);
  mois = ((mois - 1) % 12);
  if(mois === 0) { mois = 12; }

  if (mois === 12){
    an = parseInt(an) - 1;
  }
  lastMonth = an+'-'+mois+'-01';
  newMonth = new Date(lastMonth);

  mois = newMonth.getMonth() + 1;
  if(mois < 10){
    mois = "0"+mois;
  }
  an = newMonth.getFullYear();

  let moisan = an.toString()+mois.toString();

  loadOneBureauCalendarMonth(moisan,id);
}



// *********************** FIN AFFICHAGE NEXT MONTH et LAST MONTH ***************************************











































/* ********************** ANCIENNE FONCTIONS *************************** */

function displayCalendarBureauDayBy30Mn(dateSQL, idBureau, idPartenaire,heuresParLePartenaire,heuresParUnAutrePartenaire) {
  /* console.log(dateSQL)
  console.log(idBureau)
  console.log(idPartenaire)
  console.log(heuresParLePartenaire)
  console.log(heuresParUnAutrePartenaire) */

  dateFormatOK = dateSQL.substring(8,10)+"/"+dateSQL.substring(5,7)+"/"+dateSQL.substring(0,4)
  
  let options = { weekday: "long" }
  datePourJour = new Intl.DateTimeFormat("fr-FR", options).format(new Date(dateSQL))
  datePourJour = datePourJour.charAt(0).toUpperCase() + datePourJour.slice(1)

  let mainReservations = $('#reservation-main');
  mainReservations.html();

  let heightToGoBack = $('#bureau-'+idBureau).offset().top

  let leJour = `<div id="leJour">
                <input type="hidden" name="dateSQL" id="dateSQL" value="${dateSQL}">
                <input type="hidden" name="bureauId" id="bureauId" value="${idBureau}">
                <div id="closeLeJour" onclick='displayAnewReservationMain(${idPartenaire},${heightToGoBack})' class="pointer"> X </div>
                <h2>${datePourJour} ${dateFormatOK}</h2>
                <h3>Bureau n°${idBureau}</h3>
                <p>Les cr&eacute;neaux se r&eacute;servent par demi-heure. Le dernier cr&eacute;neau commence à 19h30 et se termine donc à 20h00.</p>`

  heuresPartenaire = heuresParLePartenaire.split('/')
  heuresAutrePartenaire = heuresParUnAutrePartenaire.split('/')
  /* console.log(heuresPartenaire)
  console.log(heuresAutrePartenaire)
 */
  // Génération des plages horaires par 30mn - De 08h à 20h
  for(i = 8 ; i<20 ; i++) {
    j = i < 10 ? "0"+i : i

    reserve = heuresPartenaire.includes(j+":00:00") ? 'heure-modifiable heure-partenaire pointer' : heuresAutrePartenaire.includes(j+":00:00") ? 'heure-non-modifiable' : 'heure-libre pointer'
    reserve30 = heuresPartenaire.includes(j+":30:00") ? 'heure-modifiable heure-partenaire pointer' : heuresAutrePartenaire.includes(j+":30:00") ? 'heure-non-modifiable' : 'heure-libre pointer'

    reserveText = heuresPartenaire.includes(j+":00:00") ? 'r&eacute;serv&eacute; pour vous' : heuresAutrePartenaire.includes(j+":00:00") ? 'non-disponible' : 'disponible'
    reserveText30 = heuresPartenaire.includes(j+":30:00") ? 'r&eacute;serv&eacute; pour vous' : heuresAutrePartenaire.includes(j+":30:00") ? 'non-disponible' : 'disponible'

    reserveClic = heuresPartenaire.includes(j+":00:00") ? `onclick="toggleHeureCalendar(\'${j}:00:00\',\'${dateSQL}\',\'${idBureau}\',\'${idPartenaire}\',\'remove\')"` : heuresAutrePartenaire.includes(j+":00:00") ? '' : `onclick="toggleHeureCalendar(\'${j}:00:00\',\'${dateSQL}\',\'${idBureau}\',\'${idPartenaire}\',\'add\')"`
    reserveClic30 = heuresPartenaire.includes(j+":30:00") ? `onclick="toggleHeureCalendar(\'${j}:30:00\',\'${dateSQL}\',\'${idBureau}\',\'${idPartenaire}\',\'remove\')"` : heuresAutrePartenaire.includes(j+":30:00") ? '' : `onclick="toggleHeureCalendar(\'${j}:30:00\',\'${dateSQL}\',\'${idBureau}\',\'${idPartenaire}\',\'add\')"`

    leJour += `<div class="flex flew-row jcc aic heure-line"><div class="heure-digitale">${j}:00</div><div id='heure-${j}:00' ${reserveClic} class='heure-contenu tc ${reserve}'>${reserveText}</div></div>`
    leJour += `<div class="flex flex-row jcc aic heure-line"><div class="heure-digitale">${j}:30</div><div id='heure-${j}:30' ${reserveClic30} class='heure-contenu tc ${reserve30}'>${reserveText30}</div></div>`
  }

  leJour += `</div>`;
  mainReservations.hide();
  let reservationsH1 = $('#reservations-h1')
  reservationsH1.after(leJour)

  let yToScroll = reservationsH1.offset().top - 120
  window.scrollTo(0,yToScroll);
  //mainReservations.hide();
  //document.body.appendChild

}
