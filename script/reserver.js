function displayBigImg(adresse,idimgorigine){
  
  let myimg = `<img src="${adresse}" alt="bureau" style="max-width:96%; width: 100%;" class=brad-5>`

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
  $('#div-bigimg').on("click",function() {
    $('#div-bigimg').remove()
    window.scrollTo(0,$('#'+idimgorigine).offset().top-100)
  })

}

function toggleHeureCalendar(heure,jour,idBureau,idPartenaire,action) {
  
  let now = new Date()
  let dateToToggle = new Date(jour+" "+heure)

  if(now > dateToToggle) {
    alert('Ce créneau n\'est plus modifiable.')
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
        creneauToUpdate.classList.remove('heure-libre')
        creneauToUpdate.classList.add('heure-modifiable', 'heure-partenaire')
        creneauToUpdate.innerText = 'réservé pour vous'
        //creneauToUpdate.removeAttribute('onclick')
        creneauToUpdate.setAttribute('onclick','toggleHeureCalendar(\''+heure+'\',\''+jour+'\',\''+idBureau+'\',\''+idPartenaire+'\',\'remove\')')
        
        localStorage.setItem('laref-reload-remaining-hours','true')
        //alert(`Votre créneau horaire a bien été réservé.`)
      } else {
        alert('Erreur lors de la réservation de ce créneau horaire. Si cette erreur persiste, vous pouvez nous contacter directement, nous réserverons ce créneau pour vous.')
      }
    }
    
    if(action === 'remove') {
      if(procedureOK){
        let monElement = 'heure-'+heure.substring(0,5)
        let creneauToUpdate = document.getElementById(monElement)
        creneauToUpdate.classList.remove('heure-modifiable', 'heure-partenaire')
        creneauToUpdate.classList.add('heure-libre')
        creneauToUpdate.innerText = 'disponible'
        creneauToUpdate.setAttribute('onclick','toggleHeureCalendar(\''+heure+'\',\''+jour+'\',\''+idBureau+'\',\''+idPartenaire+'\',\'add\')')

        localStorage.setItem('laref-reload-remaining-hours','true')
        //alert(`Votre créneau horaire a bien été réservé.`)
      } else {
        alert('Erreur lors de la suppression de ce créneau horaire. Si cette erreur persiste, vous pouvez nous contacter directement, nous supprimerons ce créneau pour vous.')
      }
    }

  }
  // Envoie requête
  req.send(data);
}

function displayCalendarBureauDay(dateSQL, idBureau, idPartenaire,heuresParLePartenaire,heuresParUnAutrePartenaire) {
  /* console.log(dateSQL)
  console.log(idBureau)
  console.log(idPartenaire)
  console.log(heuresParLePartenaire)
  console.log(heuresParUnAutrePartenaire) */

  dateFormatOK = dateSQL.substring(8,10)+"/"+dateSQL.substring(5,7)+"/"+dateSQL.substring(0,4)
  
  let mainReservations = $('#reservation-main');
  mainReservations.html();
  let leJour = `<div id="leJour">
                <div id="closeLeJour" onclick='displayAnewReservationMain(${idPartenaire})' class="pointer"> X </div>
                <h2>${dateFormatOK}</h2>
                <p>Les cr&eacute;neaux se r&eacute;servent par demi-heure. Le dernier cr&eacute;neau commence à 19h30 et se termine donc à 20h00.</p>`

  heuresPartenaire = heuresParLePartenaire.split('/')
  heuresAutrePartenaire = heuresParUnAutrePartenaire.split('and')
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
  //mainReservations.hide();
  //document.body.appendChild

}

function displayAnewReservationMain(partenaireId = 2, partenaireDate = '2023-04-03'){
  let leJour = $('#leJour')
  leJour.remove();
  let mainReservations = $('#reservation-main')
  mainReservations.show()

  if(localStorage.getItem('laref-reload-remaining-hours') && localStorage.getItem('laref-reload-remaining-hours') === 'true') {
    let datasObj = {}
  
    datasObj.partenaireId = partenaireId
    datasObj.action = 'reloadRemaningHours'
  
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
        $('#span-remaining-hours').html(req.response["remainingHours"])
        localStorage.setItem('laref-reload-remaining-hours','false')
        //alert(`Votre créneau horaire a bien été réservé.`)
      } else {
        alert('Erreur lors de la réservation de ce créneau horaire. Si cette erreur persiste, vous pouvez nous contacter directement, nous réserverons ce créneau pour vous.')
      }
    }
   
    // Envoie requête
    req.send(data);
     
  } 
  
}