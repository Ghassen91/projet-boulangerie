// Je selectionne les éléments de mon HTML
const lightbox = document.querySelector('.lightbox');
const lightboxContainer = document.querySelector('.lightbox_container')
const images = document.querySelectorAll('.bakery-img');
console.log(images)

// Je boucle sur les images et j'ajoute un évènement 'click' sur l'élément image pour ajouter dans le style css de la lightbox "display: block" pour afficher la lightbox car elle est mise en "none", je crée un élément img pour accueillir l'image dans la div de la lightbox qui est vide et la placer dedans
for(const image of images) {
    image.addEventListener('click', () => {
        lightbox.style.display = "flex";
        const img = document.createElement('img')
        img.src = image.src
        console.log(img);
        // lightboxContainer.innerHTML = '';
        lightboxContainer.appendChild(img);
    })


    // Ici j'ajoute un évènement 'click' pour sortir de la lighbix et revenir a l'état de départ en "display: none" et on vide bien entendu le container ou il y a l'image pour ne pas avoir deux images au moment du clique sur une autre image plus tard
    lightbox.addEventListener('click', () => {
        lightbox.style.display = "none"
        lightboxContainer.innerHTML = "";
        // lightbox.classList.toggle('lightboxOut')
    })

}

