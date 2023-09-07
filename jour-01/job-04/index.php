<!-- Fonction qui retournera un tableau de la longueur entrée en paramètre, avec une structure donnée. -->

<?php
// Déclaration de la fonction my_fizz_buzz
function my_fizz_buzz(int $length) : array {
    // Initialisation du tableau vide pour stocker le résultat
    $result = [];
    
    // Boucle for qui s'exécute depuis 1 jusqu'à la valeur de $length
    for ($i = 1; $i <= $length; $i++) {
        // Vérifie si $i est un multiple de 3 et 5
        if ($i % 3 == 0 && $i % 5 == 0) {
            // Ajoute "FizzBuzz" au tableau $result
            $result[] = "FizzBuzz";
        }
        // Sinon, vérifie si $i est un multiple de 3
        elseif ($i % 3 == 0) {
            // Ajoute "Fizz" au tableau $result
            $result[] = "Fizz";
        }
        // Sinon, vérifie si $i est un multiple de 5
        elseif ($i % 5 == 0) {
            // Ajoute "Buzz" au tableau $result
            $result[] = "Buzz";
        }
        // Si $i n'est pas un multiple de 3 ou 5
        else {
            // Ajoute la valeur de $i au tableau $result
            $result[] = $i;
        }
    }
    
    // Retourne le tableau résultant
    return $result;
}

// Test de la fonction en utilisant echo
$fizzBuzzResults = my_fizz_buzz(15);
foreach ($fizzBuzzResults as $value) {
    echo $value . "<br>"; // Affiche chaque élément sur une nouvelle ligne
}
?>