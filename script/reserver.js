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