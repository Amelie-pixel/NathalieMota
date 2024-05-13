// Variables globales pour stocker les URL des images, leurs références et leurs catégories
var imageUrls = []; // Tableau pour stocker les URL des images
var imageReferences = []; // Tableau pour stocker les références des images
var imageCategories = []; // Tableau pour stocker les catégories des images
var currentImageIndex = 0; // Index de l'image actuellement affichée dans la lightbox

// Fonction pour ouvrir la lightbox et afficher une image spécifique
function openLightbox(imageUrl, reference, categorie) {
    // Mettre à jour l'image dans la lightbox avec l'URL spécifié
    document.getElementById('lightboxImg').src = imageUrl;
    // Mettre à jour la référence dans la lightbox
    document.querySelector('.lightbox-reference').textContent = reference;
    // Mettre à jour la catégorie dans la lightbox
    document.querySelector('.lightbox-categorie').textContent = categorie;
    // Afficher la lightbox
    document.getElementById('lightbox').style.display = "block";

    // Remplir les tableaux d'URL d'image, de référence et de catégorie
    imageUrls = []; // Réinitialiser le tableau des URL d'image
    imageReferences = []; // Réinitialiser le tableau des références d'image
    imageCategories = []; // Réinitialiser le tableau des catégories d'image
    var images = document.querySelectorAll('.photo-block__picture__img'); // Sélectionner toutes les images
    images.forEach(function(image) {
        imageUrls.push(image.src); // Ajouter l'URL de chaque image au tableau
        imageReferences.push(image.nextElementSibling.querySelector('.photo_reference_hover').textContent); // Ajouter la référence de chaque image au tableau
        imageCategories.push(image.nextElementSibling.querySelector('.photo_categorie_hover').textContent); // Ajouter la catégorie de chaque image au tableau
    });

    // Trouver l'index de l'image actuellement affichée dans la lightbox
    currentImageIndex = imageUrls.indexOf(imageUrl);

    // Ajouter des gestionnaires d'événements aux flèches précédentes et suivantes
    document.getElementById('prevButton').addEventListener('click', showPreviousImage);
    document.getElementById('nextButton').addEventListener('click', showNextImage);
}

// Fonction pour fermer la lightbox
function closeLightbox() {
    document.getElementById('lightbox').style.display = "none";
}

// Fonction pour afficher l'image précédente
function showPreviousImage(event) {
    event.stopPropagation(); // Empêcher la propagation de l'événement à l'élément parent (la lightbox)
    if (currentImageIndex > 0) {
        currentImageIndex--; // Décrémenter l'index de l'image actuelle
        document.getElementById('lightboxImg').src = imageUrls[currentImageIndex]; // Mettre à jour l'image dans la lightbox
        document.querySelector('.lightbox-reference').textContent = imageReferences[currentImageIndex]; // Mettre à jour la référence dans la lightbox
        document.querySelector('.lightbox-categorie').textContent = imageCategories[currentImageIndex]; // Mettre à jour la catégorie dans la lightbox
    }
}

// Fonction pour afficher l'image suivante
function showNextImage(event) {
    event.stopPropagation(); // Empêcher la propagation de l'événement à l'élément parent (la lightbox)
    if (currentImageIndex < imageUrls.length - 1) {
        currentImageIndex++; // Incrémenter l'index de l'image actuelle
        document.getElementById('lightboxImg').src = imageUrls[currentImageIndex]; // Mettre à jour l'image dans la lightbox
        document.querySelector('.lightbox-reference').textContent = imageReferences[currentImageIndex]; // Mettre à jour la référence dans la lightbox
        document.querySelector('.lightbox-categorie').textContent = imageCategories[currentImageIndex]; // Mettre à jour la catégorie dans la lightbox
    }
}
