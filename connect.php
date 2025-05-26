
<?php
error_reporting(0);
session_start();
## Bağlantı Değişkenleri ##
$hostname = "localhost";
$username = "u1514538_rengin";
$pass = "udeVugHqQJ6xsp3";
$database = "u1514538_ascbil";
## Mysql Bağlantı ##
try {
    $db = new PDO("mysql:host=" . $hostname . "; dbname=" . $database . "; charset=utf8", "$username", "$pass");
} catch (PDOException $error) {
    print $error->getMessage();
    exit();
}
