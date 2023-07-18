<?php

class QueryBuilder {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function store(string $table, array $data): void {
        $keys = array_keys($data);
        $stringOfKeys = implode(', ', $keys);
        $placeholders = ':' . implode(', :', $keys);
        $sql = "INSERT INTO $table($stringOfKeys) VALUES($placeholders);";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
    }

    public function getUserFromUsers(User $user): ?array {
        $sql = "SELECT * FROM users WHERE name=:name AND surname=:surname";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $user->name,
            'surname' => $user->surname
        ]);
        $result = $statement->fetch();
        return $result ?: null;
    }

    public function isUserInUsers(User $user): bool {
        $sql = "SELECT * FROM users WHERE name=:name AND surname=:surname";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $user->name,
            'surname' => $user->surname
        ]);
        $result = $statement->fetch();
        return $result !== false;
    }
}