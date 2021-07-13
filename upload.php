<?php


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit(0);
}
if (!isset($_POST["text_input"]) && !isset($_POST["file_input"])) {
    echo json_encode(["error" => 'Provide inputs!']);
    exit(0);
}

if (isset($_POST['submit'])) {
    echo json_encode(["error" => 'Error!!']);
    exit(0);
}

$uploadDir = '/home/michael/PhpstormProjects/mkterhov-api/public/images/';

$fileName = $uploadDir . $_FILES['file_input']['name'];

if (move_uploaded_file($_FILES['file_input']['tmp_name'], $fileName)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
    echo "Possible file upload attack!\n";
}
echo $fileName;