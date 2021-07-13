<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit(0);
}


if (!isset($_POST["elvish"]) && !isset($_POST["english"])) {
    var_dump($_POST);
    echo json_encode(["error" => 'Provide inputs!']);
    exit(0);
}


var_dump($_POST);
$english = htmlspecialchars($_GET["english"]);
$elvish = htmlspecialchars($_GET["elvish"]);
$records = json_decode(file_get_contents('translations.json'), true);
$item = ["english" => $_POST['english'], 'elvish' => $_POST['elvish']];
array_push($records['data'], ["english" => $_POST['english'], 'elvish' => $_POST['elvish']]);
file_put_contents('translations.json', json_encode($records));
error_log('SAVING ITEM ' . $item);
echo json_encode(["result" => $item]);
