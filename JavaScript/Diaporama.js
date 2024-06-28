let NumImage = 0; // index de l'image Diapo qui est affichée au debut

function AfficherDiapo() { // la fonction qui affiche diaporama
    let i;
    let images = document.getElementsByClassName("diaporama-image");

    // Masquer toutes les diapositives
    for (i = 0; i < images.length; i++) { // boucle (pour toutes les images qui existent)
        images[i].style.display = "none"; // masquer
    }

    NumImage++;

    // Si l'index dépasse le nombre total des images qu'on a, back to la première image de la diapo
    if (NumImage > images.length) {
        NumImage = 1;
    }

    // Afficher l'image de la diapo (actuelle)
    images[NumImage - 1].style.display = "block";
    // Pour la specifier la durée de 5s (pour chaque image de vehicule) -> appeler la fonction AfficherDiapo chaque 5 secondes -> afficher chaque image pendant 5s
    setTimeout(AfficherDiapo, 5000); 
}

// Appeler AfficherDiapo lors du chargement de la page
window.onload = function () {
    AfficherDiapo();
};

