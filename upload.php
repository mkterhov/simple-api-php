<?php
require __DIR__ . '/vendor/autoload.php';

use App\Config;
use App\Request;


if ($_SERVER['REQUEST_METHOD'] !== Request::POST) {
    exit(0);
}
$fileInput = $_POST["file_input"];
if (!isset($_POST["text_input"]) && !isset($fileInput)) {
    echo \json_encode(["error" => 'Provide inputs!']);
    exit(0);
}

if (isset($_POST['submit'])) {
    echo \json_encode(["error" => 'Error!!']);
    exit(0);
}

$uploadDir = Config::UPLOADS_DIR;

$fileName = $uploadDir . $fileInput['name'];

if (move_uploaded_file($fileInput['tmp_name'], $fileName)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
    echo "Possible file upload attack!\n";
}
echo $fileName;