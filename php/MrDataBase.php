<?php

class MrDataBase {
    public PDO $pdo;

    public function __construct(string $host, string $dbname, string $user, string $password){
        $this->pdo = new PDO("mysql:host=$host; dbname=$dbname", "$user", $password);
    }

    public function addUserToUsers(User $user) : void{
        if(!$this->isUserInUsers($user)) {
            $sql = "INSERT INTO users(name, surname, password) 
            VALUES('$user->name', '$user->surname', '$user->password');";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        }
    }

    private function isUserInUsers(User $user) : bool {
        $sql = "SELECT * FROM users WHERE 'name'=$user->name AND 'surname'=$user->surname";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->rowCount() > 0;
    }

    public function getUserHashedPassword(User $user) : ?string {
        $sql = "SELECT password FROM users WHERE name=:name AND surname=:surname";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $user->name,
            'surname' => $user->surname
        ]);
        $result = $statement->fetch();
        return $result ? $result['password'] : null;
    }
}