document.addEventListener('DOMContentLoaded', function () {
    const burgerIcon = document.getElementById('burger-icon');  //récupère toute les informations
    const sideNav = document.getElementById('mySidenav');
    const sideNavImages = sideNav.querySelectorAll('img');  

    // Fonction pour ouvrir/fermer la navigation
    function toggleSideNav() {
        burgerIcon.classList.toggle('active');
        sideNav.classList.toggle('active');
        sideNav.classList.remove('hidden'); // Retire la classe 'hidden'
        
        sideNavImages.forEach(image => {  // Ajouter ou supprimer la classe 'active' pour chaque image dans le menu
            image.classList.toggle('active');
        });
        if (!sideNav.classList.contains('active')) { // il se déplace vers le haut à la fin de l'animation de fermeture afin de ne plus être visible
            setTimeout(() => {
              sideNav.classList.add('moved');
            }, 2000);
          } else {
            sideNav.classList.remove('moved');
          }
    }

    // Empêche d'autres actions indésirables ailleurs sur la page, mais se concentrera uniquement sur l'ouverture ou la fermeture de la barre de navigation.
    burgerIcon.addEventListener('click', function (event) {
        event.stopPropagation(); 
        toggleSideNav();
    });

    // Fermer la navigation lorsqu'un lien à l'intérieur est cliqué
    sideNav.addEventListener('click', function (event) {
        if (event.target.tagName === 'A') {  // Vérifie si c'est un élément A qui a été cliqué
            toggleSideNav();
        }
    });

});


jQuery(document).ready(function($) {
    $('#filter-form select').change(function() {
        var formData = $('#filter-form').serialize(); // Récupérer les données du formulaire

        // Effectuer une requête Ajax vers l'API de WordPress
        $.ajax({
            type: 'GET',
            url: ajaxurl, // Utilisation de la variable ajaxurl définie dans index.php
            data: formData + '&action=custom_filter_photos', // Changer l'action en fonction de votre fonction PHP
            success: function(response) {
                $('#results-container').html(response); // Afficher les résultats dans le conteneur
            }
        });
    });
});

jQuery(document).ready(function($) {
    $('#load-more').click(function() {
        var formData = $('#filter-form').serialize(); // Récupérer les données du formulaire

        // Effectuer une requête Ajax vers l'API de WordPress
        $.ajax({
            type: 'GET',
            url: ajaxurl, // Utilisation de la variable ajaxurl définie dans index.php
            data: formData + '&action=custom_filter_photos&all_photos=true', // Ajout du paramètre pour récupérer toutes les photos
            success: function(response) {
                $('#results-container').html(response); // Afficher les résultats dans le conteneur
            }
        });
    });
});

function setupModal(buttonId) {
    var modal = document.getElementById('myModal');
    var btn = document.getElementById(buttonId);
    var span = document.getElementsByClassName("close")[0];

    btn.onclick = function() {
        modal.style.display = "block";
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}

// Setup modal for header button
setupModal("myBtn");

// Setup modal for image description button
setupModal("myBtn2");
