<?php

class Auth {
    public function redirect(string $path) : void {
        header("Location: $path");
    }

    public function register(array $data): bool {
        $data = $this->secureInput($data);
        if ($this->isIncludeInvalidSymbols($data)) {
            return false;
        }
        $db = new QueryBuilder(new PDO("mysql:host=localhost; dbname=Comments Section", "root", ""));
        if ($this->isUserInTable("users", $data)) {
            return false;
        }
        $db->storeOne("users", $data);
        return true;
    }

    public function isUserInTable(string $table, array $data) : bool {
        $db = new QueryBuilder(new PDO("mysql:host=localhost; dbname=Comments Section", "root", ""));
        $db->convertToDatabaseFormat($data);
        return $db->isInTable("users", $data);
    }

    public function login() {

    }

    public function logout() {

    }

    public function currentUser() {

    }

    public function check() {

    }

    public function ban() {

    }

    public function unban() {

    }

    public function getUserStatus() {

    }

    public function isBanned() {

    }

    public function getFullName() {

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