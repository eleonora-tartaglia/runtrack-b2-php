<?php

require_once 'class/Student.php';
require_once 'class/Grade.php';
require_once 'class/Floor.php';
require_once 'class/Room.php';

// Informations de connexion à la base de données
$host = "localhost";
$dbname = "lp_official";
$user = "hayley";
$pass = "monarque";
$charset = "utf8mb4";

// Établissement de la connexion à la base de données
try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
    $conn = new PDO($dsn, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

function findOneStudent(int $id): ?Student {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM student WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        return new Student($data['id'], $data['grade_id'], $data['email'], $data['fullname'], new DateTime($data['birthdate']), $data['gender']);
    }
    return null;
}

function findOneGrade(int $id): ?Grade {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM grade WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        return new Grade($data['id'], $data['room_id'], $data['name'], new DateTime($data['year']));
    }
    return null;
}

function findOneFloor(int $id): ?Floor {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM floor WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        return new Floor($data['id'], $data['name'], $data['level']);
    }
    return null;
}

function findOneRoom(int $id): ?Room {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM room WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        return new Room($data['id'], $data['floor_id'], $data['name'], $data['capacity']);
    }
    return null;
}

?>
