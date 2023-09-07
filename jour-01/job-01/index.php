<!-- Fonction qui permet de compter le nombre d’occurrences d’une lettre dans une chaîne de caractères -->

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

// Fonction pour compter le nombre d'occurrences d'une lettre dans une chaîne
function my_str_search(string $needle, string $haystack) : int 
{
    $count = 0;  // Initialisation du compteur à zéro

    // Parcourir chaque caractère de la chaîne
    for ($i = 0; $i < my_strlen($haystack); $i++) 
    {
        // Si le caractère actuel est égal à la lettre recherchée, augmenter le compteur
        if ($haystack[$i] == $needle) 
        {
            $count++;
        }
    }

    // Retourner la valeur du compteur
    return $count;
}

// Test de la fonction
$letter = 'a';
$string = 'banana';
echo "La lettre '" . $letter . "' apparaît " . my_str_search($letter, $string) . " fois dans le mot '" . $string . "'.";

?>
