<?php

\session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    exit(0);
}


if (!isset($_GET["word"])) {
    echo json_encode(["error" => 'Cant find the word!']);
    exit(0);
}
$word = htmlspecialchars($_GET["word"]);
$records = json_decode(file_get_contents('translations.json'), true);
$item = array_values(array_filter($records['data'], function ($item) use ($word) {
    return $item['english'] == $word;
}));
error_log('GETTING ITEM ' . $item['english']);
echo json_encode(["result" => $item]);


//if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//    $json = json_decode(file_get_contents('translations.json'),true);
//    echo $json['data'][0]['english'];
//}