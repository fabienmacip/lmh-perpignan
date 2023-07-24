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

function annulerHeureCalendar(heure,jour,idBureau,idPartenaire) {
  alert("Annuler ?\n"+heure+" - "+jour+" - "+idBureau+" - "+idPartenaire)
}

function reserverHeureCalendar(heure,jour,idBureau,idPartenaire) {
  alert("Reserver ?\n"+heure+" - "+jour+" - "+idBureau+" - "+idPartenaire)
}

function displayCalendarBureauDay(dateSQL, idBureau, idPartenaire,heuresParLePartenaire,heuresParUnAutrePartenaire) {
  console.log(dateSQL)
  console.log(idBureau)
  console.log(idPartenaire)
  console.log(heuresParLePartenaire)
  console.log(heuresParUnAutrePartenaire)

  dateFormatOK = dateSQL.substring(8,10)+"/"+dateSQL.substring(5,7)+"/"+dateSQL.substring(0,4)
  
  let mainReservations = $('#reservation-main');
  mainReservations.html();
  let leJour = `<div id="leJour">
                <div id="closeLeJour" onclick='displayAnewReservationMain()' class="pointer"> X </div>
                <h2>${dateFormatOK}</h2>
                <p>Les cr&eacute;neaux se r&eacute;servent par demi-heure. Le dernier cr&eacute;neau commence à 19h30 et se termine donc à 20h00.</p>`

  heuresPartenaire = heuresParLePartenaire.split('and')
  heuresAutrePartenaire = heuresParUnAutrePartenaire.split('and')
  console.log(heuresPartenaire)
  console.log(heuresAutrePartenaire)

  // Génération des plages horaires par 30mn - De 08h à 20h
  for(i = 8 ; i<20 ; i++) {
    j = i < 10 ? "0"+i : i

    reserve = heuresPartenaire.includes(j+":00:00") ? 'heure-modifiable heurepartenaire pointer' : heuresAutrePartenaire.includes(j+":00:00") ? 'heure-non-modifiable' : 'heure-libre pointer'
    reserve30 = heuresPartenaire.includes(j+":30:00") ? 'heure-modifiable heurepartenaire pointer' : heuresAutrePartenaire.includes(j+":30:00") ? 'heure-non-modifiable' : 'heure-libre pointer'

    reserveText = heuresPartenaire.includes(j+":00:00") ? 'r&eacute;serv&eacute; pour vous' : heuresAutrePartenaire.includes(j+":00:00") ? 'non-disponible' : 'disponible'
    reserveText30 = heuresPartenaire.includes(j+":30:00") ? 'r&eacute;serv&eacute; pour vous' : heuresAutrePartenaire.includes(j+":30:00") ? 'non-disponible' : 'disponible'

    reserveClic = heuresPartenaire.includes(j+":00:00") ? `onclick="annulerHeureCalendar(\'${j}:00:00\',\'${dateSQL}\',\'${idBureau}\',\'${idPartenaire}\')"` : heuresAutrePartenaire.includes(j+":00:00") ? '' : `onclick="reserverHeureCalendar(\'${j}:00:00\',\'${dateSQL}\',\'${idBureau}\',\'${idPartenaire}\')"`
    reserveClic30 = heuresPartenaire.includes(j+":30:00") ? `onclick="annulerHeureCalendar(\'${j}:30:00\',\'${dateSQL}\',\'${idBureau}\',\'${idPartenaire}\')"` : heuresAutrePartenaire.includes(j+":30:00") ? '' : `onclick="reserverHeureCalendar(\'${j}:30:00\',\'${dateSQL}\',\'${idBureau}\',\'${idPartenaire}\')"`

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

function displayAnewReservationMain(codeHTML){
  let leJour = $('#leJour')
  leJour.remove();
  let mainReservations = $('#reservation-main')
  mainReservations.show()
  
}