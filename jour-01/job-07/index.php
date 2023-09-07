<!-- Cette fonction doit permettre de récupérer le nombre le plus proche de 0 parmi une liste de nombre. -->

<?php
// Déclaration de la fonction my_closest_to_zero
function my_closest_to_zero(array $array) : int {
    // Vérifie si le tableau est vide
    if (count($array) == 0) {
        return 0; // Si le tableau est vide, retourne 0
    }

    $closest = $array[0];  // Prend le premier élément comme référence

    // Pour chaque élément du tableau
    foreach ($array as $num) {
        // Si cet élément est plus proche de 0 que le précédent plus proche
        if (abs($num) < abs($closest) || (abs($num) == abs($closest) && $num > 0)) {
            $closest = $num;  // Met à jour l'élément le plus proche
        }
    }

    // Retourne l'élément le plus proche de 0
    return $closest;
}

// Test de la fonction
$array = [64, -34, 25, 12, -22, 11, -90, 90, -3];
$closest = my_closest_to_zero($array);
echo "Le nombre le plus proche de zéro dans le tableau est : " . $closest;
?>