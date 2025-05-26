<?php
require_once 'header.php';
require_once 'navbar.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cat_name =$_POST["kat"];
    $kod =$_POST["urun_kodu"];
    $marka =$_POST["marka"];
    $model =$_POST["model"];
    $isim =$_POST["isim"];
    $adet =$_POST["adet"];
    $fiyat=$_POST["fiyat"];
    if (empty($cat_name) ||empty($marka) ||empty($model) ||empty($isim) ||empty($fiyat) ||empty($adet) ||empty($kod)  ) {
        $msg = 'Alanları doldurun.';
        $status = 'alert-danger';
    } else {

        $ayni_urun_varmi = $db->prepare("SELECT * FROM urunler WHERE kod = ?");
        $ayni_urun_varmi->execute([$kod]);
        if ($ayni_urun_varmi->rowCount()) {
            $msg = 'Bu ürün mevcut.';
            $status = 'alert-danger';
        }
        else{
            $urun_ekle = $db->prepare("INSERT INTO urunler (kod,marka,model,isim,adet,fiyat,kategori) VALUES (?,?,?,?,?,?,?)");
            $urun_ekle->execute(array($kod,$marka,$model,$isim,$adet,$fiyat,$cat_name));
            if ($urun_ekle) {
                $msg = 'Kayıt işlemi tamamlandı.';
                $status = 'alert-success';
            }
            else {
                $msg = 'Üye kaydı başarısız. Bir sorun oluştu.';
                $status = 'alert-danger';
            }
        }


    }

}
?>
<div class="container" >
    <h1 class="text-center mt-5">Ürün Ekle</h1>
    <form method="post" action="">
        <?php

        ?>
        <div class="form-group">
            <label for="urun_kodu">Ürün Kodu</label>
            <input type="text" class="form-control" name="urun_kodu" aria-describedby="emailHelp" placeholder="Ürün Kodu">
        </div>

        <div class="form-group">
            <label for="marka">Marka</label>
            <input type="text" class="form-control" name="marka" aria-describedby="emailHelp" placeholder="Marka">
        </div>
        <div class="form-group">
            <label for="model">Model</label>
            <input type="text" class="form-control" name="model" aria-describedby="emailHelp" placeholder="Model">
        </div>
        <div class="form-group">
            <label for="isim">İsim</label>
            <input type="text" class="form-control" name="isim" aria-describedby="emailHelp" placeholder="İsim">
        </div>
        <div class="form-group">
            <label for="adet">Adet</label>
            <input type="text" class="form-control" name="adet" aria-describedby="emailHelp" placeholder="Adet">
        </div>
        <div class="form-group">
            <label for="fiyat">Fiyat</label>
            <input type="text" class="form-control" name="fiyat" aria-describedby="emailHelp" placeholder="Fiyat">
        </div>
        <div class="form-group">
            <label for="fiyat">Kategori</label>
            <input type="text" class="form-control" name="kat" aria-describedby="emailHelp" placeholder="Fiyat">
        </div>
        <?php
        if (isset($msg)) { ?>
            <div class="alert mt-3 <?php echo $status; ?>" role="alert">
                <?php echo $msg; ?>
            </div>
        <?php } ?>
        <button type="submit" class="btn btn-primary mt-3 w-100" >Ürün Güncelle </button>
    </form>


</div>

<?php
require_once 'footer.php';

?>
