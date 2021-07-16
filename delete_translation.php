<?php
require __DIR__ . '/vendor/autoload.php';

use App\Config;
use App\Request;
use App\TokenGenerator;

\session_start();
$token = TokenGenerator::generateToken();
if ($_COOKIE['token'] !== $token) {
    header("HTTP/1.1 401 Unauthorized");
    echo json_encode(["error" => 'Unauthorized access!']);
    exit(0);
}

if ($_SERVER['REQUEST_METHOD'] !== Request::DELETE) {
    header("HTTP/1.1 405 Method Not Allowed");
    exit(0);
}

if (!isset($_GET["elvish"])) {
    header("HTTP/1.1 400 Bad Method");
    echo json_encode(["error" => 'Provide inputs!']);
    exit(0);
}

$deleteWord = $_GET["elvish"];
$records = json_decode(file_get_contents(Config::STORAGE_JSON), true);

if (!key_exists($deleteWord, $records['data'])) {
    header("HTTP/1.1 404 Not Found");
    echo json_encode(["error" => 'Could not find the record!']);
    exit(0);
}

$records['data'] = array_filter($records['data'], function ($key) use ($deleteWord) {
    return $deleteWord !== $key;
}, ARRAY_FILTER_USE_KEY);

file_put_contents(Config::STORAGE_JSON, json_encode($records));
error_log('DELETING ITEM ' . $deleteWord);
header("HTTP/1.1 200 OK");
echo json_encode(["deleted" => $deleteWord]);
