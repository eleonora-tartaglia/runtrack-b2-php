<!-- Fonction qui permet d’inverser l’ordre des lettres d’une chaîne de caractères. -->

<?php

// Fonction pour déterminer la longueur d'une chaîne
function my_strlen(string $str) : int
{
    $length = 0; // Initialisation de la longueur à zéro

    // Parcourir chaque caractère de la chaîne jusqu'à ce que l'on trouve la fin de la chaîne
    while (isset($str[$length])) 
    {
        $length++;
    }

    return $length;
}

// Fonction pour inverser l'ordre des lettres d'une chaîne
function my_str_reverse(string $string) : string 
{
    $reversed = '';  // Initialisation de la chaîne inversée

    // Parcourir chaque caractère de la chaîne en partant de la fin
    for ($i = my_strlen($string) - 1; $i >= 0; $i--) 
    {
        // Ajouter chaque caractère à la chaîne inversée
        $reversed .= $string[$i];
    }

    // Retourner la chaîne inversée
    return $reversed;
}

// Test de la fonction
$string = 'eleonora';
echo "Le mot '" . $string . "' inversé donne : '" . my_str_reverse($string) . "'.";

?>
