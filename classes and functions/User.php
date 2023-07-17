<?php

class User
{
    public string $name;
    public string $surname;
    public string $password;

    public int $user_id;

    public function __construct(string $name, string $surname, string $password) {
        $this->name=$name;
        $this->surname=$surname;
        $this->password=$password;
    }
}