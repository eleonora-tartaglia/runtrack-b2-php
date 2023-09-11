<!-- JOB 02 : Création de la class Floor -->

<?php

class Floor {
    private $id;
    private $name;
    private $level;

    public function __construct(?int $id = null, ?string $name = null, ?int $level = null) {
        $this->id = $id;
        $this->name = $name;
        $this->level = $level;
    }

    public function __toString() {
        return "Floor ID: " . $this->id . "<br>" .
               "Name: " . $this->name . "<br>" .
               "Level: " . $this->level . "<br>" . 
               "<br>";
    }

    // Getters
    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function getLevel(): ?int {
        return $this->level;
    }

    // Setters
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setLevel(int $level): void {
        $this->level = $level;
    }

    // Cette fonction retournera toutes les salles (Room) situées sur un étage spécifique (Floor). 
    // La liaison sera établie sur la base de la colonne floor_id de la table room.
    public function getRooms(): array {
        global $conn;
    
        $rooms = [];
    
        // Requête pour récupérer toutes les salles situées sur cet étage
        $query = $conn->prepare("SELECT * FROM room WHERE floor_id = ?");
        $query->execute([$this->id]);
    
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($results as $row) {
            $rooms[] = new Room($row['id'], $row['floor_id'], $row['name'], $row['capacity']);
        }
    
        return $rooms;
    }
    
}

?>