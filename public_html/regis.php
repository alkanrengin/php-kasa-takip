<?php

require_once 'header.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uye_kadi = trim($_POST["uye_kadi"]);
    $uye_sifre = trim($_POST["uye_sifre"]);
    $uye_sifre_tekrar = trim($_POST["uye_sifre_tekrar"]);
    $uye_eposta = trim($_POST["uye_eposta"]);
    $statu="2";

    if (empty($uye_kadi) || empty($uye_sifre) || empty($uye_eposta)) {
        $msg = 'Yıldızlı alanlar boş bırakılamaz.';
        $status = 'alert-danger';
    } else {

        $ayni_uye_varmi = $db->prepare("SELECT * FROM uyeler WHERE uye_kadi = ?");
        $ayni_uye_varmi->execute(array($uye_kadi));
        if ($ayni_uye_varmi->rowCount()) {
            $msg = 'Bu kullanıcı adı zaten kullanılıyor. Farklı bir kullanıcı adı deneyin.';
            $status = 'alert-danger';
        } else {
            if ($uye_sifre == $uye_sifre_tekrar) {
                $uye_ekle = $db->prepare("INSERT INTO uyeler (uye_kadi,statu, uye_sifre, uye_eposta) VALUES (?,?,?)");
                $uye_ekle->execute(array($uye_kadi,$statu, $uye_sifre, $uye_eposta));
                if ($uye_ekle) {
                    $msg = 'Kayıt işlemi tamamlandı.';
                    $status = 'alert-success';
                } else {
                    $msg = 'Üye kaydı başarısız. Bir sorun oluştu.';
                    $status = 'alert-danger';
                }
            } else {
                $msg = 'Şifreler uyuşmuyor kontrol ediniz!';
                $status = 'alert-danger';
            }
        }
    }
}
?>

<div class="container-fluid">
    <div class="row m-5 justify-content-center">
        <div class="col-3">
            <h1>ASC BİLGİSAYAR</h1>

            <form action="" method="post">
                <legend class="text-center">Kayıt Formu</legend>
                <div class="mb-3">
                    <label for="" class="form-label">Eposta:</label>
                    <input type="email" class="form-control" id="" name="uye_eposta" required>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Kullanıcı Adı:</label>
                    <input type="text" class="form-control" id="" name="uye_kadi" required>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Şifre:</label>
                    <input type="password" class="form-control" id="" name="uye_sifre" required>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Şifre Tekrar:</label>
                    <input type="password" class="form-control" id="" name="uye_sifre_tekrar" required>
                </div>
                <?php
                if (isset($msg)) { ?>
                    <div class="alert <?php echo $status; ?>" role="alert">
                        <?php echo $msg; ?>
                    </div>
                <?php } ?>
                <button class="btn btn-primary" type="submit">Kayıt Ol</button>
                <a  class="btn btn-success" href="login.php" >Giriş Yap</a>

            </form>
        </div>
    </div>
</div>
<?php  require_once 'footer.php';?>
