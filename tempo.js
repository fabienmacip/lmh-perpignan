function loadOneMustangCalendarMonth(id) {
  
  var req = new XMLHttpRequest();

  req.open('GET', 'app/controllers/getMustangCalendarMonth.php?id=' + id);

  let lemois = '';

  req.onload = function() {

      //let kerox = JSON.parse(this.responseText);
      //let lemois = JSON.parse(this.responseText);
      lemois = this.responseText;
      //console.log("response : "+lemois.toString());
      
      renderMustangCalendarMonth(id, lemois);
      
      
    }
  req.send();
  
  
}


function mustangNextMonth(mois='01',an='2022'){
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
  
  id = an.toString()+mois.toString();
  loadOneMustangCalendarMonth(id);
  //renderMustangCalendarMonth(id);
}


