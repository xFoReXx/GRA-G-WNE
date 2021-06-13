<?php
class DB
{
    private $conn; //connection to db server
    public function __construct()
    {
        $this->conn = new mysqli('localhost', 'root', '', 'lepmionatebu');
    }
    public function registerPlayer(string $login, string $password) : bool
    {
        $passwordHash = password_hash($password, PASSWORD_ARGON2I);
        $query = $this->conn->prepare("INSERT INTO player (id, login, password) 
                                        VALUES (NULL, ?, ?)");
        $query->bind_param("ss", $login, $passwordHash);
        $result = $query->execute();
        if($result) {
            $this->newVillage($query->insert_id);
        }
        return $result;
    }
    public function loginPlayer(string $login, string $password) : bool 
    {
        $query = $this->conn->prepare("SELECT id, password FROM player WHERE login=? LIMIT 1");
        $query->bind_param("s", $login);
        $query->execute();
        $result = $query->get_result();
        if($result->num_rows == 0)
            return false;
        $player = $result->fetch_assoc();
        if(password_verify($password, $player['password']))
        {
            $_SESSION['player_id'] = $player['id'];
            $_SESSION['player_login'] = $login;
            return true;
        }
        else
            return false;
    }
    public function newVillage(int $player_id) {
        $query = $this->conn->prepare("INSERT INTO village (id, player_id, townHall, woodcutter, ironMine, farm)
                                VALUES (NULL, ?, 1, 1, 0, 0)");
        $query->bind_param('i', $player_id,);
        $query->execute();
    }

    public function saveVillage(Village $v) {
        $buildings = $v->buildingLevelList();
        $query = $this->conn->prepare("UPDATE");
    }
}
?>