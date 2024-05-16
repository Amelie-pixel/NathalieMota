var imageUrls = []; 
var imageReferences = []; 
var imageCategories = []; 
var currentImageIndex = 0; 

function openLightbox(imageUrl, reference, categorie) {
    document.getElementById('lightboxImg').src = imageUrl;
    document.querySelector('.lightbox-reference').textContent = reference;
    document.querySelector('.lightbox-categorie').textContent = categorie;
    document.getElementById('lightbox').style.display = "block";

    imageUrls = [];
    imageReferences = []; 
    imageCategories = []; 
    var images = document.querySelectorAll('.photo-block__picture__img'); 
    images.forEach(function(image) {
        imageUrls.push(image.src); 
        imageReferences.push(image.nextElementSibling.querySelector('.photo_reference_hover').textContent); 
        imageCategories.push(image.nextElementSibling.querySelector('.photo_categorie_hover').textContent); 
    });


    currentImageIndex = imageUrls.indexOf(imageUrl);


    document.getElementById('prevButton').addEventListener('click', showPreviousImage);
    document.getElementById('nextButton').addEventListener('click', showNextImage);
}

function closeLightbox() {
    document.getElementById('lightbox').style.display = "none";
}

function showPreviousImage(event) {
    event.stopPropagation(); 
    if (currentImageIndex > 0) {
        currentImageIndex--; 
        document.getElementById('lightboxImg').src = imageUrls[currentImageIndex]; 
        document.querySelector('.lightbox-reference').textContent = imageReferences[currentImageIndex]; 
        document.querySelector('.lightbox-categorie').textContent = imageCategories[currentImageIndex]; 
    }
}

function showNextImage(event) {
    event.stopPropagation(); 
    if (currentImageIndex < imageUrls.length - 1) {
        currentImageIndex++;
        document.getElementById('lightboxImg').src = imageUrls[currentImageIndex]; 
        document.querySelector('.lightbox-reference').textContent = imageReferences[currentImageIndex]; 
        document.querySelector('.lightbox-categorie').textContent = imageCategories[currentImageIndex]; 
    }
}
