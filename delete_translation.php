<?php
$cookie = 'cookie!';
\session_start();
if ($_COOKIE['token'] !== $cookie) {
    header("HTTP/1.1 401 Unauthorized");
    echo json_encode(["error" => 'Unauthorized access!']);
    exit(0);
}
echo "I'm in";

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    exit(0);
}

if (!isset($_GET["word"])) {
    echo json_encode(["error" => 'Provide word to delete!']);
    exit(0);
}

