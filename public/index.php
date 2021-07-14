<?php

$routeLink = '<p>Route %s <a href="%s">/%s</a> </p>';
echo "<h1>SERVER</h1>";
echo sprintf($routeLink, "GET", '../../get_translation.php', 'get_translation.php');
echo sprintf($routeLink, "POST", '../../post_translation.php', 'post_translation.php');
echo sprintf($routeLink, "DELETE", '../../delete_translation.php', 'delete_translation.php');
echo sprintf($routeLink, "Login", '../../authorize.php', 'authorize.php');
