<!-- Fonction qui permet de déterminer si un nombre est un multiple d’un autre.-->

<?php

// Fonction pour déterminer si un nombre est un multiple d'un autre
function my_is_multiple(int $divider, int $multiple) : bool 
{
    // Si le reste de la division de $multiple par $divider est 0, alors $multiple est un multiple de $divider
    return $multiple % $divider == 0;
}

// Test de la fonction
$divider = 3;
$multiple = 9;

if (my_is_multiple($divider, $multiple)) 
{
    echo "$multiple est un multiple de $divider.";
} 
else 
{
    echo "$multiple n'est pas un multiple de $divider.";
}

?>