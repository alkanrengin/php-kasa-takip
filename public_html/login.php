<?php
include 'connect.php';
require_once 'header.php';
if ($_SESSION['login']){
    header('Location:index.php');
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kullanici_adi = trim($_POST['uye_kadi']);
    $sifre = trim($_POST['uye_sifre']);

    if (empty($kullanici_adi) || empty($sifre)) {
        $msg = 'Kullanıcı adı veya şifre boş bırakılamaz!';
        $status = 'alert-danger';
    } else {
        $kullanici_kontrol = $db->prepare("SELECT uye_id,uye_kadi, uye_sifre FROM uyeler WHERE uye_kadi = ? AND uye_sifre = ?");
        $kullanici_kontrol->execute(array($kullanici_adi, $sifre));
        if ($kullanici_kontrol->rowCount() > 0) {
            $row = $kullanici_kontrol->fetch(PDO::FETCH_OBJ);
            $_SESSION['login'] = true;
            $_SESSION['uye_id'] = $row->uye_id;
            header("Location:index.php");
        } else {
            $msg = 'Sisteme kayıtlı kullanıcı bulunmadı!';
            $status = 'alert-danger';
        }
    }
}
?>

<div class="container-fluid">
    <div class="row m-5 justify-content-center">
        <div class="col-3">
            <h1>ASC BİLGİSAYAR</h1>
            <?php echo $_SESSION['uye_id']; ?>
            <form action="" method="post">
                <legend class="text-center">Giriş</legend>
                <div class="mb-3">
                    <label for="" class="form-label">Kullanıcı Adı:</label>
                    <input type="text" class="form-control" id="" name="uye_kadi" required>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Şifre:</label>
                    <input type="password" class="form-control" id="" name="uye_sifre" required>
                </div>
                <?php
                if (isset($msg)) { ?>
                    <div class="alert <?php echo $status; ?>" role="alert">
                        <?php echo $msg; ?>
                    </div>
                <?php } ?>
                <button class="btn btn-success" type="submit">Giriş Yap</button>
                <a  class="btn btn-success" href="regis.php" >Kayıt Ol</a>

            </form>
        </div>
    </div>
</div>
<?php require_once 'footer.php'; ?>