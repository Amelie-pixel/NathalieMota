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

    var refPhotoValue = $('.refPhotoValue').val();
    if (refPhotoValue && $('.refPhoto').length) {
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

    function closeDropdowns() {
        $('.custom-dropdown').removeClass('open');
    }

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

    $(document).click(function(event) {
        if (!$(event.target).closest('.custom-dropdown').length) {
            closeDropdowns();
        }
    });

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

///////////// la modal contact du menu déroulant header /////////////

var modal = document.getElementById('myModal');
var btn = document.getElementById("myBtn3");
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


///////////// la modal contact du menu header /////////////

var modal = document.getElementById('myModal');
var btn = document.getElementById("myBtn");
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


///////////// la modal contact de la page info des photos /////////////

var modal = document.getElementById('myModal');
var btn = document.getElementById("myBtn2");
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