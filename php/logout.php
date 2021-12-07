<?php
session_start();
$_SESSION = array();
http_response_code(301);
header("Location: ./index.php");
exit;
?>