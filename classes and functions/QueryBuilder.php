<?php
declare(strict_types=1);
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

    public function getOne(string $table, array $data): ?array {
        $keys = array_keys($data);
        $condition="";
        foreach ($keys as $key) {
            $condition .= "$key=:$key AND ";
        }
        $condition = rtrim($condition, " AND");
        $sql = "SELECT * FROM $table WHERE $condition";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
        $result = $statement->fetch();
        return $result ?: null;
    }

    public function isInTable(string $table, array $data): bool {
        $result = $this->getOne($table, $data);
        return $result !== false;
    }
}