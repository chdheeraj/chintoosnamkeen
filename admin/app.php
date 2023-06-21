<?php
$app_name = "Chintoos";
$website_url = "https://www.chintoosnamkeen.com/";
$website_admin_url = "https://www.chintoosnamkeen.com/admin";

$host = "localhost";
$username = "root";
$pwd = "";
$dbname = "chintoosnamkeen";
try{
    $pdo = new PDO('mysql:host=' . $host . ';dbname=' . $dbname,
    $username, $pwd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (Exception $e)
{
   echo $e->message; die();
}
?>