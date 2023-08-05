function updateCalendarAdmin() {
  
  let values=$("#select-abonne-for-calendar option:selected");
  let partenaireId = values.val()
  let partenaireName = values.text()
  
  reloadCalendarAdmin(partenaireId,partenaireName)
}

function reloadCalendarAdmin(partenaireId,partenaireName) {
  
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

