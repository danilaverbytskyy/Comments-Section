<?php

class QueryBuilder {
    public PDO $pdo;

    public function __construct(string $host, string $dbname, string $user, string $password) {
        $this->pdo = new PDO("mysql:host=$host; dbname=$dbname", "$user", $password);
    }

    public function addUserToUsers(User $user): void {
        $sql = "INSERT INTO users(name, surname, password) 
            VALUES(:name, :surname, :password);";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $user->name,
            'surname' => $user->surname,
            'password' => $user->password
        ]);
    }

    public function getUserFromUsers(User $user): ?array {
        $sql = "SELECT * FROM users WHERE name=:name AND surname=:surname";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $user->name,
            'surname' => $user->surname
        ]);
        $result = $statement->fetch();
        return $result ? $result : null;
    }

    public function isUserInUsers(User $user): bool {
        $sql = "SELECT * FROM users WHERE name=:name AND surname=:surname";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $user->name,
            'surname' => $user->surname
        ]);
        $result = $statement->fetch();
        return $result !== null;
    }
}