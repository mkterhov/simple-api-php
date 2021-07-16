<?php
require __DIR__ . '/vendor/autoload.php';

use App\TokenGenerator;

$token = TokenGenerator::generateToken();
setcookie('token', $token);