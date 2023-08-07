<?php

namespace App;

use PDO;

class QueryBuilder {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function storeOne(string $table, array $data): void {
        $keys = array_keys($data);
        $stringOfKeys = implode(', ', $keys);
        $placeholders = ':' . implode(', :', $keys);
        $sql = "INSERT INTO $table($stringOfKeys) VALUES($placeholders)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
    }

    public function deleteById(string $table, int $id): void {
        $table_id = substr($table, 0, strlen($table)-1);
        $table_id .= '_id';
        $sql = "DELETE FROM $table WHERE $table_id=:id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'id' => $id
        ]);
    }

    public function getOneById(string $table, int $id): ?array {
        $table_id = substr($table, 0, strlen($table)-1);
        $table_id .= '_id';
        $sql = "SELECT * FROM $table WHERE $table_id=:id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'id' => $id
        ]);
        $result = $statement->fetch();
        return $result ?: null;
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
        $data = $this->convertToDatabaseFormat($data);
        $result = $this->getOne($table, $data);
        return $result !== null;
    }

    public function convertToDatabaseFormat(array $data) : array {
        foreach ($data as $key => $value) {
            if($key === 'password') {
                $value = hashPassword($value);
            }
            else {
                $value = mb_strtoupper($value);
            }
        }
        return $data;
    }
}