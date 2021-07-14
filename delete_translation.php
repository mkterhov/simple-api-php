<?php

$cookie = 'token';
\session_start();

if ($_GET['token'] !== $cookie) {
    header("HTTP/1.1 401 Unauthorized");
    echo json_encode(["error" => 'Unauthorized access!']);
    exit(0);
}

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    exit(0);
}

if (!isset($_GET["elvish"])) {
    var_dump($_GET);
    echo json_encode(["error" => 'Provide inputs!']);
    exit(0);
}
$translationsFile = './public/translations/translations.json';

$deleteWord = $_GET["elvish"];
$records = json_decode(file_get_contents($translationsFile), true);

if (!key_exists($deleteWord, $records['data'])) {
    echo json_encode(["error" => 'Could not find the record!']);
    exit(0);
}

$records['data'] = array_filter($records['data'], function ($key) use ($deleteWord) {
    return $deleteWord !== $key;
}, ARRAY_FILTER_USE_KEY);

file_put_contents($translationsFile, json_encode($records));
error_log('DELETING ITEM ' . $deleteWord);
echo json_encode(["deleted" => $deleteWord]);
