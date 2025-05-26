<?php
include "connect.php";
require_once 'header.php';
if (!$_SESSION['login']) {
    header('Location:login.php');
}

$kullanici_getir = $db->prepare("SELECT * FROM uyeler WHERE uye_id = ?");
$kullanici_getir->execute(array($_SESSION['uye_id']));
if ($kullanici_getir->rowCount() > 0) {
    $row = $kullanici_getir->fetch(PDO::FETCH_OBJ);

}
require_once 'navbar.php';

?>


<?php require_once 'footer.php';?>
