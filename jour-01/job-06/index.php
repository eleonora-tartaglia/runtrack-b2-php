<!-- Fonction qui permet de trier un tableau. Ce tri doit être possible dans l’ordre croissant ou décroissant. -->

<?php
// Déclaration de la fonction my_array_sort
function my_array_sort(array $arrayToSort, string $order) : array {
    $n = count($arrayToSort);  // Nombre d'éléments dans le tableau

    // Pour chaque élément du tableau
    for ($i = 0; $i < $n; $i++) {
        for ($j = 0; $j < $n - $i - 1; $j++) {
            // Comparaison des éléments adjacents
            if (($order == "ASC" && $arrayToSort[$j] > $arrayToSort[$j+1]) ||
                ($order == "DESC" && $arrayToSort[$j] < $arrayToSort[$j+1])) {
                // Échange des éléments s'ils sont dans le mauvais ordre
                $temp = $arrayToSort[$j];
                $arrayToSort[$j] = $arrayToSort[$j+1];
                $arrayToSort[$j+1] = $temp;
            }
        }
    }

    // Retourne le tableau trié
    return $arrayToSort;
}

// Test de la fonction
$array = [64, 34, 25, 12, 22, 11, 90];
$sortedArrayAsc = my_array_sort($array, "ASC");
echo "Trié par ordre croissant : ";
foreach ($sortedArrayAsc as $value) {
    echo $value . " ";
}

echo "<br>";

$sortedArrayDesc = my_array_sort($array, "DESC");
echo "Trié par ordre décroissant : ";
foreach ($sortedArrayDesc as $value) {
    echo $value . " ";
}
?>