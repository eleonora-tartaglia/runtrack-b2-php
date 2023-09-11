<!-- JOB 02 : Création de la class Room -->

<?php

class Room {
    private $id;
    private $floor_id;
    private $name;
    private $capacity;

    public function __construct(?int $id = null, ?int $floor_id = null, ?string $name = null, ?int $capacity = null) {
        $this->id = $id;
        $this->floor_id = $floor_id;
        $this->name = $name;
        $this->capacity = $capacity;
    }

    public function __toString() {
        return "Room ID: " . $this->id . "<br>" .
               "Floor ID: " . $this->floor_id . "<br>" .
               "Name: " . $this->name . "<br>" .
               "Capacity: " . $this->capacity . "<br>" .
               "<br>";
    }

    // Getters
    public function getId(): ?int {
        return $this->id;
    }

    public function getFloorId(): ?int {
        return $this->floor_id;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function getCapacity(): ?int {
        return $this->capacity;
    }

    // Setters
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setFloorId(int $floor_id): void {
        $this->floor_id = $floor_id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setCapacity(int $capacity): void {
        $this->capacity = $capacity;
    }

    // Cette fonction retournera toutes les promotions (Grade) associées à une salle spécifique (Room). 
    // La liaison sera établie sur la base de la colonne room_id de la table grade.
    public function getGrades(): array {
        global $conn; 
    
        $grades = []; 
    
        // Requête pour récupérer toutes les promotions associées à cette salle
        $query = $conn->prepare("SELECT * FROM grade WHERE room_id = ?");
        $query->execute([$this->id]);
    
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($results as $row) {
            $year = new DateTime($row['year']);
            $grades[] = new Grade($row['id'], $row['room_id'], $row['name'], $year);
        }
    
        return $grades;
    }
    
}

?>