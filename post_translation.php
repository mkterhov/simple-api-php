<?php
require __DIR__ . '/vendor/autoload.php';

use App\Config;
use App\Request;
use App\TokenGenerator;

$token = TokenGenerator::generateToken();

\session_start();
if ($_COOKIE['token'] !== $token) {
    header("HTTP/1.1 401 Unauthorized");
    echo json_encode(["error" => 'Unauthorized access!']);
    exit(0);
}
if ($_SERVER['REQUEST_METHOD'] !== Request::POST) {
    header("HTTP/1.1 405 Method Not Allowed");
    exit(0);
}


if (!(isset($_POST["elvish"]) && isset($_POST["english"]))) {
    header("HTTP/1.1 400 Bad Method");
    echo json_encode(["error" => 'Provide inputs!']);
    exit(0);
}


$english = $_POST["english"];
$elvish = $_POST["elvish"];
$records = json_decode(file_get_contents(Config::STORAGE_JSON), true);
$data = $records['data'];

if (key_exists($elvish, $data)) {
    echo json_encode(["error" => 'There is already a translation for that word!']);
    exit(0);
}
$records['data'][$elvish] = $english;
file_put_contents(Config::STORAGE_JSON, json_encode($records));
error_log('SAVING ITEM ' . [$elvish => $english]);

header("HTTP/1.1 201 OK");
echo json_encode(["result" => [$elvish => $english]]);
