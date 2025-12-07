console.log('Script chargé');

document.addEventListener('DOMContentLoaded', () => {
    const previewImages = document.querySelectorAll('.preview');
    const overlay = document.getElementById('zoomOverlay');
    const overImage = document.getElementById('overImage');
    const overCaption = document.getElementById('overCaption');
    const closeBtn = document.querySelector('.close-btn');


    const openOverlay = (event) => {
        // La cible est l'image survolée
        const image = event.currentTarget; 
        
        const fullSrc = image.getAttribute('data-full-src');
        overImage.src = fullSrc;
        overlay.classList.add('active');
    };


    const closeOverlay = () => {
        overlay.classList.remove('active');
    };


    previewImages.forEach(img => {
        img.addEventListener('click', openOverlay);
    });


    closeBtn.addEventListener('click', closeOverlay);


    overlay.addEventListener('click', (event) => {
        if (event.target === overlay) {
            closeOverlay();
        }
    });
});