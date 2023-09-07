<!-- Fonction find_ordered_students() qui devra retourner un tableau avec les noms des promotions et tous les étudiants 
    associés avec toutes leurs informations, les promotions triées par taille d’étudiants. -->

<?php

$host = 'localhost';
$db   = 'lp_official';
$user = 'hayley';
$pass = 'monarque';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

function find_ordered_students($pdo) {
    $stmt = $pdo->query("
        SELECT g.name AS grade_name, s.*
        FROM student s
        JOIN grade g ON s.grade_id = g.id
        ORDER BY g.id, s.fullname
    ");

    $students = [];
    while ($row = $stmt->fetch()) {
        $students[$row['grade_name']][] = $row;
    }

    // Trier par la taille de la promotion
    uasort($students, function($a, $b) {
        return count($b) - count($a);
    });

    return $students;
}

$ordered_students = find_ordered_students($pdo);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ordered Students</title>
</head>
<body>
    <?php foreach ($ordered_students as $grade_name => $students) : ?>
        <h2><?= htmlspecialchars($grade_name) ?> (<?= count($students) ?> étudiants)</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Nom complet</th>
                    <th>Date de naissance</th>
                    <th>Genre</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student) : ?>
                    <tr>
                        <td><?= htmlspecialchars($student['email']) ?></td>
                        <td><?= htmlspecialchars($student['fullname']) ?></td>
                        <td><?= htmlspecialchars($student['birthdate']) ?></td>
                        <td><?= htmlspecialchars($student['gender']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endforeach; ?>
</body>
</html>
