window.addEventListener('load', function() {

    let collectionBtnNouvelle = document.querySelectorAll('.btnNouvelle');
    let collectionNouvelle = document.querySelectorAll('.contentNouvelle');
    let contenuHtmlNouvelles = new Array();
    console.log(collectionBtnNouvelle.length);
    
    if (collectionBtnNouvelle)
    {
        for (let btn of collectionBtnNouvelle){
                console.log(btn.id)
                btn.addEventListener('click',Ajax)
        }

        for (let i=0; i< collectionNouvelle.length; i++){
            contenuHtmlNouvelles[i] = collectionNouvelle[i].innerHTML;
    }
    }
    
    });
    
    function Ajax(evt) {
        
        //  instructions ici
        console.log('HELLO THERE');
        let maRequete = new XMLHttpRequest();
        let btnId = evt.target.id;
        console.log(maRequete)
        maRequete.open('GET', 'https://e1736918.webdev.cmaisonneuve.qc.ca/tp2_veille/wp-json/wp/v2/posts/' + btnId); // modifier ici
        maRequete.onload = function () {
            console.log(maRequete)
            if (maRequete.status >= 200 && maRequete.status < 400) {
                let data = JSON.parse(maRequete.responseText);
                console.log(evt.target.dataset.checked)
                // instructions ici
                creationHTML(data, btnId);  // paramètres à ajouter
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
    
    function creationHTML(postsData, idClick){
        contenuNouvelle = document.querySelector("#event-" + idClick);
        let monHtmlString = '';
        monHtmlString += '<h2> <a href='+postsData.slug+'>' + postsData.title.rendered + ' </a></h2>';
        monHtmlString += postsData.content.rendered;
        contenuNouvelle.innerHTML = monHtmlString; 
    }    