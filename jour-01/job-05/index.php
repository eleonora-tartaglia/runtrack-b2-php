<!-- Fonction qui permet de déterminer si un nombre est premier. -->

<?php
// Déclaration de la fonction my_is_prime
function my_is_prime(int $number) : bool {
    // Si le nombre est inférieur à 2, il n'est pas premier
    if ($number < 2) {
        return false;
    }

    // Si le nombre est 2, il est premier
    if ($number == 2) {
        return true;
    }

    // Si le nombre est pair et différent de 2, il n'est pas premier
    if ($number % 2 == 0) {
        return false;
    }

    // Boucle pour vérifier la divisibilité par d'autres nombres
    // Nous vérifions jusqu'à la racine carrée du nombre pour optimiser le processus
    $sqrtNumber = sqrt($number);
    for ($i = 3; $i <= $sqrtNumber; $i+=2) {
        if ($number % $i == 0) {
            // Si le nombre est divisible par $i, il n'est pas premier
            return false;
        }
    }

    // Si nous sommes arrivés jusqu'ici, le nombre est premier
    return true;
}

// Test de la fonction
$testNumber = 17;
if (my_is_prime($testNumber)) {
    echo $testNumber . " est un nombre premier.<br>";
} else {
    echo $testNumber . " n'est pas un nombre premier.<br>";
}
?>