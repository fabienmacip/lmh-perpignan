function getTree(data, url) {

  const options = {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify({data})
}

/*   const options = {
      method: 'POST',
      headers: {
          'X-Requested-With': 'xmlhttprequest'
      },
      body: JSON.stringify(data)
  }
 */
  fetch(url, options)
      .then(response => {
          console.log(response);
          console.log('la reponse est : ' + response.ok)
          console.log('le status est : ' + response.status)
          console.log('le statusText est : ' + response.statusText)
          console.log('le Text est : ' + response.responseText)
          if (response.ok) {
              console.log('Tout ce passe bien')
              return response.json()
          } else {
              console.log('Erreur : ' + response.statusText)
          }
          return response.json()
      })
      .then(json => {
          if (json.success === true) {
              console.log('les json est : ', json.success);
          } else {
              console.log('le json est ', json.message);
          }
      })
      .catch(error => console.log('erreur de fetch', error))
      .catch(error => console.log('erreur de json', error))
}


function testAjax() {
    const data = `{
      "rep": "planes",
      "nbCard": "2",
      "action": "getTree"
    }`
    
    getTree(data, 'http://localhost:8080/lmh-perpignan/script/ajax.php')

}