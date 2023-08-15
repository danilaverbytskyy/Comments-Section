<?php

namespace app\models;

class Auth {
    private QueryBuilder $queryBuilder;

    public function __construct(QueryBuilder $db) {
        $this->queryBuilder = $db;
    }
    public function redirect(string $path) : void {
        header("Location: $path");
    }

    public function register(string $table, array $data): bool {
        $data = $this->secureInput($data);
        if ($this->isIncludeInvalidSymbols($data)) {
            return false;
        }
        $data = $this->queryBuilder->convertToDatabaseFormat($data);
        if ($this->isInTable($table, $data)) {
            return false;
        }
        $this->queryBuilder->storeOne($table, $data);
        return true;
    }

    public function isInTable(string $table, array $data) : bool {
        return $this->queryBuilder->isInTable($table, $data);
    }

    public function login(string $table, array $data) : bool {
        $data = $this->secureInput($data);
        if ($this->isIncludeInvalidSymbols($data)) {
            return false;
        }
        $data = $this->queryBuilder->convertToDatabaseFormat($data);
        return $this->isInTable($table, $data);
    }

    public function logout() : void {
        if(isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
    }

    public function check() {

    }

    public function ban() {

    }

    public function unban() {

    }

    public function isBanned() {

    }

    public function getFullName($data) : ?array {
        if(isset($data['name']) && isset($data['surname'])) {
            return [
                'name' => $data['name'],
                'surname' => $data['surname']
            ];
        }
        return null;
    }

    public function uploadAvatar() {

    }

    private function secureInput(array $data): array {
        foreach ($data as $element) {
            $element = trim(htmlspecialchars($element));
        }
        return $data;
    }

    private function isIncludeInvalidSymbols(array $data): bool {
        $invalidSymbols = "?#<>%^/@ ";
        foreach ($data as $element) {
            if (strpbrk($element, $invalidSymbols) !== false) {
                return true;
            }
        }
        return false;
    }
}