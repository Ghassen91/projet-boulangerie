// Je sélectionne les éléments du HTML
const burgerMenu = document.querySelector('.burger-menu');
let menu = document.querySelector('.menu');

// Fonction pour gérer le clic sur l'icone du menu burger
const handleBurgerMenuClick = () => {
  if (menu.style.right == "0px") {
  menu.style.right = "-240px";
  } else {
  menu.style.right = "0px";
  }
};
  
// // J'ajoute un evenement 'click' sur l'icone du menu burger
burgerMenu.addEventListener('click', () => {
  handleBurgerMenuClick();
})


// // J'ajoute un evenement 'click' sur l'icone du menu burger
// burgerMenu.addEventListener('click', () => {
//     if(menu.style.right == "0px"){
//         menu.style.right = "-320px";
//         menu.style.position = "fixed"

//     }else{
//         menu.style.right = "0px";
//         menu.style.position = "absolute"
//     }

// })