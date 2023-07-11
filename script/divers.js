function closePopMentionsLegales(popup){
    document.body.removeChild(popup);
    document.body.style.overflow = "scroll";
}

function popMentionsLegales(){

  let popup = document.createElement('div');
  popup.classList.add("popup");

  popup.innerHTML = $('#mentions-legales-div')[0].innerHTML;
  /* popup.style.visibility = "visible"; */
  popup.style.display = "flex";
  document.body.appendChild(popup);
  document.body.style.overflow = "hidden";
  popup.onclick = function() {closePopMentionsLegales(popup)};
  popup.style.overflow = "scroll";
}

