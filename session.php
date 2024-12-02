<?php
session_start();

$_SESSION["name"]="yamazaki";
$_SESSION["age"] = 20;

echo session_id();
echo $_SESSION["name"];
echo $_SESSION["name"];
?>