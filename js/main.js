window.addEventListener('load', () => {

    console.log("ok");
    let collectionBtnNouvelle = document.querySelectorAll('button');
    console.log(collectionBtnNouvelle.length);
    
    if (collectionBtnNouvelle)
    {
        for (let btn of collectionBtnNouvelle){
                console.log(btn.id)
                btn.addEventListener('click',Ajax)
        }
    }
    
    });
    
    function Ajax(evt) {
        
        //  instructions ici
        console.log('HELLO THERE');
        let maRequete = new XMLHttpRequest();
        console.log(maRequete)
        maRequete.open('GET', 'http://e1736918.webdev.cmaisonneuve.qc.ca/tp2_veille/wp-json/wp/v2/posts/' + evt.target.getAttribute("id")); // modifier ici
        maRequete.onload = function () {
            console.log(maRequete)
            if (maRequete.status >= 200 && maRequete.status < 400) {
                let data = JSON.parse(maRequete.responseText);
                console.log(evt.target.dataset.checked)
                // instructions ici
                creationHTML(data);  // paramètres à ajouter
            } else {
                console.log('La connexion est faite mais il y a une erreur')
            }
        }
        maRequete.onerror = function () {
            console.log("erreur de connexion");
        }
        maRequete.send()
        }
    
        // instructions à ajouter
    
    ///////////////////////////////////////////////////////
    
    function creationHTML(postsData){
        let monHtmlString = '';
        let contenuNouvelle = document.getElementById('nouvelleBtn');
        for (elm of postsData) {
            monHtmlString += '<h2>' + elm.title.rendered + '</h2>'
            monHtmlString += elm.content.rendered;
        }
        contenuNouvelle.innerHTML = monHtmlString; 
    }    