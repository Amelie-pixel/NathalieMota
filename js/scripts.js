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
