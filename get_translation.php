<?php

\session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header("HTTP/1.1 405 Method Not Allowed");
    exit(0);
}

if (!isset($_GET["word"])) {
    header("HTTP/1.1 404 Not Found");
    echo json_encode(["error" => 'Cant find the word!']);
    exit(0);
}
$word = htmlspecialchars($_GET["word"]);
$translationsFile = './public/translations/translations.json';
$json = json_decode(file_get_contents($translationsFile), true);

$data = $json['data'];
if (!key_exists($word, $data)) {
    echo json_encode(["error" => 'Could not find the translation!']);
    exit(0);
}

error_log('GETTING ITEM ' . sprintf('%s => %s',$word,$data[$word]));

header("HTTP/1.1 200 OK");
echo json_encode([
    "result" => [
        $word => $data[$word]
    ]
]);


//if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//    $json = json_decode(file_get_contents('translations.json'),true);
//    echo $json['data'][0]['english'];
//}