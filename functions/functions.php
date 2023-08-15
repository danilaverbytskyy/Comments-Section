<?php

function hashPassword(string $password): string {
    $salt = "f#@V)Hu^%Hgfds";
    return sha1($salt . $password);
}

function dd($data) : void {
    var_dump($data);
    exit;
}