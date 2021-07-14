<?php
$host = $_SERVER['HTTP_HOST'];
var_dump($host);
$routeLink = '<p>Route %s <a href="%s">host/</a> </p>';
echo "<h1>SERVER</h1>";
echo sprintf($routeLink, "GET", '../../get_translation.php');
echo sprintf($routeLink, "POST",  '../../post_translation.php');
echo sprintf($routeLink, "DELETE",  '../../delete_translation.php');
echo sprintf($routeLink, "Login", '../../authorize.php');
