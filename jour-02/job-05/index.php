<!-- Fonction find_full_rooms() qui devra retourner les noms et la capacité des salles. Ajoutez une colonne pour indiquer 
    si une salle est pleine avec les étudiants présents dedans.-->


<?php

// Informations de connexion à la base de données
$host = "localhost";
$dbname = "lp_official";
$user = "hayley";
$pass = "monarque";
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// Fonction pour récupérer les salles et leur capacité
function find_full_rooms() {
    global $dsn, $user, $pass, $options;

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);

        // Requête pour récupérer les salles, leur capacité et le nombre d'étudiants dans chaque salle
        $stmt = $pdo->prepare(
            "SELECT room.id, room.name, room.capacity, COUNT(student.id) as student_count 
            FROM room 
            LEFT JOIN grade ON room.id = grade.room_id 
            LEFT JOIN student ON grade.id = student.grade_id
            GROUP BY room.id"
        );
        $stmt->execute();
        
        $rooms = $stmt->fetchAll();
        
        foreach ($rooms as &$room) {
            $room['is_full'] = ($room['capacity'] <= $room['student_count']) ? "Yes" : "No";
        }

        return $rooms;
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}


$rooms = find_full_rooms();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students & Grades</title>
</head>
<body>

<table border="1">
    <thead>
        <tr>
            <th>Room Name</th>
            <th>Capacity</th>
            <th>Number of Students</th>
            <th>Is Full?</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rooms as $room): ?>
        <tr>
            <td><?= $room['name'] ?></td>
            <td><?= $room['capacity'] ?></td>
            <td><?= $room['student_count'] ?></td>
            <td><?= $room['is_full'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>