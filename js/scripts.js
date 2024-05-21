document.addEventListener('DOMContentLoaded', function() {

    ////////////////////////  Code pour le hover de la miniature ////////////////////// 
    const previousArrow = document.querySelector('.arrow_left');
    const nextArrow = document.querySelector('.arrow_right');
    const previousThumbnail = document.querySelector('.previous-thumbnail');
    const nextThumbnail = document.querySelector('.next-thumbnail');

    if (previousArrow && previousThumbnail) {
        previousArrow.addEventListener('mouseover', function() {
            previousThumbnail.classList.remove('hidden-thumbnail');
        });

        previousArrow.addEventListener('mouseout', function() {
            previousThumbnail.classList.add('hidden-thumbnail');
        });
    }

    if (nextArrow && nextThumbnail) {
        nextArrow.addEventListener('mouseover', function() {
            nextThumbnail.classList.remove('hidden-thumbnail');
        });

        nextArrow.addEventListener('mouseout', function() {
            nextThumbnail.classList.add('hidden-thumbnail');
        });
    }


    ////////////////////////  Code pour la référence dans la modal contact ////////////////////// 

    jQuery(document).ready(function($) {
        var refPhotoValue = $('.refPhotoValue').val();
        if (refPhotoValue && $('.refPhoto').length) {
            $('.refPhoto').val(refPhotoValue);
        }
    });


    ////////////////////////  Code pour le menu hamburger ////////////////////// 
    const burgerIcon = document.getElementById('burger-icon');
    const sideNav = document.getElementById('mySidenav');

    function toggleSideNav() {
        if (burgerIcon && sideNav) {
            burgerIcon.classList.toggle('active');
            if (sideNav.classList.contains('active')) {
                sideNav.classList.remove('active');
                setTimeout(() => {
                    sideNav.classList.add('hidden');
                }, 500);
            } else {
                sideNav.classList.remove('hidden');
                setTimeout(() => {
                    sideNav.classList.add('active');
                }, 10);
            }
        }
    }

    if (burgerIcon) {
        burgerIcon.addEventListener('click', function(event) {
            event.stopPropagation();
            toggleSideNav();
        });
    }

    if (sideNav) {
        sideNav.addEventListener('click', function(event) {
            if (event.target.tagName === 'A') {
                toggleSideNav();
            }
        });
    }


    ////////////////////////  Code pour la requête AJAX des menus déroulant et du bouton charger plus ////////////////////// 
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

    
    ////////////////////////  Code pour la modal contact ////////////////////// 
    var modal = document.getElementById('myModal');
    var spans = document.getElementsByClassName("close");

    function setupModal(btnId) {
        var btn = document.getElementById(btnId);
        if (btn) {
            btn.onclick = function() {
                if (modal) {
                    modal.style.display = "block";
                }
            }
        }
    }

    setupModal("myBtn");
    setupModal("myBtn2");
    setupModal("myBtn3");

    if (spans.length > 0) {
        for (var i = 0; i < spans.length; i++) {
            spans[i].onclick = function() {
                if (modal) {
                    modal.style.display = "none";
                }
            }
        }
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});
