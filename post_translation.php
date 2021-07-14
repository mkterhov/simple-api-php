<?php
$cookie = 'token';
\session_start();
if ($_GET['token'] !== $cookie) {
    header("HTTP/1.1 401 Unauthorized");
    echo json_encode(["error" => 'Unauthorized access!']);
    exit(0);
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
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
$translationsFile = './public/translations/translations.json';
$records = json_decode(file_get_contents($translationsFile), true);
$data = $records['data'];

if (key_exists($elvish, $data)) {
    echo json_encode(["error" => 'There is already a translation for that word!']);
    exit(0);
}
$records['data'][$elvish]=  $english;
file_put_contents($translationsFile, json_encode($records));
error_log('SAVING ITEM ' . [$elvish => $english]);

header("HTTP/1.1 201 OK");
echo json_encode(["result" => [$elvish => $english]]);
