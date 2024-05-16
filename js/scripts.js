////////////////////////// code pour le hover de la miniature //////////////////////////

document.addEventListener('DOMContentLoaded', function() {
    const previousArrow = document.querySelector('.arrow_left');
    const nextArrow = document.querySelector('.arrow_right');
    const previousThumbnail = document.querySelector('.previous-thumbnail');
    const nextThumbnail = document.querySelector('.next-thumbnail');

    previousArrow.addEventListener('mouseover', function() {
        previousThumbnail.classList.remove('hidden-thumbnail');
    });

    previousArrow.addEventListener('mouseout', function() {
        previousThumbnail.classList.add('hidden-thumbnail');
    });

    nextArrow.addEventListener('mouseover', function() {
        nextThumbnail.classList.remove('hidden-thumbnail');
    });

    nextArrow.addEventListener('mouseout', function() {
        nextThumbnail.classList.add('hidden-thumbnail');
    });
});

////////////////////////// code pour la référence dans la modal contact //////////////////////////

jQuery(document).ready(function($) {
    // Récupération de la valeur de l'ACF "reference" depuis le champ caché
    var refPhotoValue = $('.refPhotoValue').val();
    // Vérification si la valeur existe et si le champ REF.PHOTO existe dans le formulaire
    if (refPhotoValue && $('.refPhoto').length) {
        // Pré-remplissage du champ REF.PHOTO avec la valeur de l'ACF
        $('.refPhoto').val(refPhotoValue);
    }
});

////////////////////////// code pour le menu hamburger //////////////////////////

document.addEventListener('DOMContentLoaded', function () {
    const burgerIcon = document.getElementById('burger-icon');
    const sideNav = document.getElementById('mySidenav');


    function toggleSideNav() {
        burgerIcon.classList.toggle('active');
        if (sideNav.classList.contains('active')) {
            sideNav.classList.remove('active');
            setTimeout(() => {
                sideNav.classList.add('hidden');
            }, 500); 
        } else {
            // Ouvrir le menu
            sideNav.classList.remove('hidden');
            setTimeout(() => {
                sideNav.classList.add('active');
            }, 10); 
        }
    }

    burgerIcon.addEventListener('click', function (event) {
        event.stopPropagation(); 
        toggleSideNav();
    });

    sideNav.addEventListener('click', function (event) {
        if (event.target.tagName === 'A') {
            toggleSideNav();
        }
    });
});

////////////////////////// code pour la requete ajax des menus déroulant et du bouton charger plus//////////////////////////

jQuery(document).ready(function($) {
    // Fonction pour fermer tous les menus déroulants
    function closeDropdowns() {
        $('.custom-dropdown').removeClass('open');
    }

    // Gérer les clics sur les éléments de menu déroulant
    $('.custom-dropdown .dropdown-placeholder').click(function() {
        var $dropdown = $(this).parent('.custom-dropdown');
        if ($dropdown.hasClass('open')) {
            closeDropdowns();
        } else {
            closeDropdowns();
            $dropdown.addClass('open');
        }
    });

    $('.custom-dropdown .dropdown-list li').click(function() {
        var selectedValue = $(this).attr('data-value');
        var selectedText = $(this).text();
        var $dropdown = $(this).closest('.custom-dropdown');

        $dropdown.find('.dropdown-placeholder').text(selectedText);
        $dropdown.find('input[type="hidden"]').val(selectedValue);
        $dropdown.removeClass('open');

        // Effectuer la requête AJAX
        var formData = $('#filter-form').serialize();
        $.ajax({
            type: 'GET',
            url: ajaxurl,
            data: formData + '&action=custom_filter_photos&nonce=' + nonce,
            success: function(response) {
                $('#results-container').html(response);
            }
        });
    });

    // Gérer les clics en dehors des menus déroulants
    $(document).click(function(event) {
        if (!$(event.target).closest('.custom-dropdown').length) {
            closeDropdowns();
        }
    });

    // Empêcher la propagation des clics à partir des menus déroulants
    $('.custom-dropdown').click(function(event) {
        event.stopPropagation();
    });

    $('#load-more').click(function() {
        var formData = $('#filter-form').serialize();

        $.ajax({
            type: 'GET',
            url: ajaxurl,
            data: formData + '&action=custom_filter_photos&all_photos=true&nonce=' + nonce,
            success: function(response) {
                $('#results-container').html(response);
            }
        });
    });
});


////////////////////////// code pour la modal contact //////////////////////////
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn3");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn2");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}