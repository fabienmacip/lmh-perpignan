function updateCalendarAdmin() {
  
  let values=$("#select-abonne-for-calendar option:selected");
  let partenaireId = values.val()
  let partenaireName = values.text()
  
  reloadCalendarsAdmin(partenaireId,partenaireName)
}

function reloadCalendarsAdmin(partenaireId,partenaireName) {
  
/*   let datasObj = {}

  let data = new FormData();
  for (const key in datasObj) {
    data.append(key, datasObj[key])
  } */
  var req = new XMLHttpRequest();
  req.responseType = 'text';

  req.open('GET', 'controleurs/bureauCalendar.php?page=reserveradmin&idpartenaire=' + partenaireId + '&namepartenaire=' + partenaireName);

  let newHTML = '';

  req.onloadstart = function() {}
  req.onprogress = function() {}
  req.onload = function() {}

  req.onloadend = function() {

    newHTML = this.responseText;
    parentElement = document.getElementById('liste-calendriers-admin')
    parentElement.innerHTML = newHTML
      
  }

    req.send();

}

function displayCalendarBureauDayAdmin(dateSQL, idBureau, idPartenaire,heuresParLePartenaire,heuresPourLePartenaire,heuresParUnAutrePartenaire, heuresRestantes) {
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

// *********************** AFFICHAGE NEXT MONTH et LAST MONTH ***************************************

function loadOneBureauCalendarMonthAdmin(moisan, id) {
  
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


function bureauNextMonthAdmin(mois = '07', an = '2023', id = '1') {

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

  loadOneBureauCalendarMonthAdmin(moisan,id);
}

function bureauLastMonthAdmin(mois = '07', an = '2023', id = '1') {

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

  loadOneBureauCalendarMonthAdmin(moisan,id);
}
