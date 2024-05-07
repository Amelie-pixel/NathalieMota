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
