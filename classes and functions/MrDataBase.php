<?php

class MrDataBase {
    public PDO $pdo;

    public function __construct(string $host, string $dbname, string $user, string $password) {
        $this->pdo = new PDO("mysql:host=$host; dbname=$dbname", "$user", $password);
    }

    public function addUserToUsers(User $user): void {
        $sql = "INSERT INTO users(name, surname, password) 
            VALUES(:name, :surname, :password);";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':name', $user->name);
        $statement->bindParam(':surname', $user->surname);
        $statement->bindParam(':password', $user->password);
        $statement->execute();
    }

    public function isUserInUsers(User $user): bool {
        $sql = "SELECT * FROM users WHERE name=:name AND surname=:surname";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $user->name,
            'surname' => $user->surname
        ]);
        return $statement->fetch() !== false;
    }

    public function getUserHashedPassword(User $user): ?string {
        $sql = "SELECT password FROM users WHERE name=:name AND surname=:surname";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $user->name,
            'surname' => $user->surname
        ]);
        $result = $statement->fetch();
        return $result ? $result['password'] : null;
    }

    public function getUserId(User $user): ?int {
        $sql = "SELECT user_id FROM users WHERE name=:name AND surname=:surname";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $user->name,
            'surname' => $user->surname
        ]);
        $result = $statement->fetch();
        return $result ? $result['user_id'] : null;
    }
}