<?php

function hashPassword(string $password): string {
    $salt = "f#@V)Hu^%Hgfds";
    return sha1($salt . $password);
}