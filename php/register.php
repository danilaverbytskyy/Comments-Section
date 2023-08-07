<?php
declare(strict_types=1);

require '../vendor/autoload.php';

use Delight\Auth\Auth;

$db = new PDO("mysql:host=localhost; dbname=Comments Section", "root", "");
$auth = new Auth($db);

try {
    $userId = $auth->register($_POST['email'], $_POST['password'], $_POST['username'], function ($selector, $token) {
        echo 'Send ' . $selector . ' and ' . $token . ' to the user (e.g. via email)';
        echo '  For emails, consider using the mail(...) function, Symfony Mailer, Swiftmailer, PHPMailer, etc.';
        echo '  For SMS, consider using a third-party service and a compatible SDK';
    });

    echo 'We have signed up a new user with the ID ' . $userId;
}
catch (\Delight\Auth\InvalidEmailException $e) {
    echo 'Invalid email address';
}
catch (\Delight\Auth\InvalidPasswordException $e) {
    echo 'Invalid password';
}
catch (\Delight\Auth\UserAlreadyExistsException $e) {
    echo 'User already exists';
}
catch (\Delight\Auth\TooManyRequestsException $e) {
    echo 'Too many requests';
}
exit;