<?php
require_once 'header.php';
require_once 'navbar.php';
if (isset($_POST["dene"])) {
    $cat_name =$_POST["kat"];
    $kod =$_POST["urun_kodu"];
    $marka =$_POST["marka"];
    $model =$_POST["model"];
    $isim =$_POST["isim"];
    $adet =$_POST["adet"];
    $bayi=$_POST["bayi_fiyat"];
    $gelis=$_POST["gelis_fiyat"];
    $fiyat=$_POST["fiyat"];
    if (empty($cat_name) ||empty($marka) ||empty($model) ||empty($isim) ||empty($fiyat) ||empty($adet) ||empty($kod)  ) {
        $msg = 'Alanları doldurun.';
        $status = 'alert-danger';
    } else {
        $urun_gun = $db->prepare("UPDATE urunler SET kod=?, marka=?, model=?, isim=?, adet=?,gelis_fiyat=?,bayi_fiyat=?, fiyat=?, kategori=? WHERE kod = ?");
        $urun_gun->execute([$kod, $marka, $model, $isim, $adet,$gelis,$bayi, $fiyat, $cat_name, $kod]);
            if ($urun_gun) {
                $msg = 'Güncellleme işlemi tamamlandı.';
                $status = 'alert-success';
                sleep(3);
                header('Location:urun-listesi.php');
            }
            else {
                $msg = 'Üye kaydı başarısız. Bir sorun oluştu.';
                $status = 'alert-danger';
            }
        }



}
?>
<div class="container" >
    <h1 class="text-center mt-5">Ürün Güncelle</h1>
    <form method="post" action="">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $buttonValue = $_POST["guncel"];
            $urun_getir = $db->prepare("SELECT * FROM urunler WHERE kod = ?");
            $urun_getir ->execute([$buttonValue]);
            $sorgu = $urun_getir ->fetch(PDO::FETCH_ASSOC)
            ?>

        <div class="form-group">
            <label for="urun_kodu">Ürün Kodu</label>
            <input type="text" class="form-control" value="<?php echo $sorgu["kod"]?>" name="urun_kodu" aria-describedby="emailHelp" placeholder="Ürün Kodu">
        </div>

        <div class="form-group">
            <label for="marka">Marka</label>
            <input type="text" class="form-control" value="<?php echo $sorgu["marka"]?> " name="marka" aria-describedby="emailHelp" placeholder="Marka">
        </div>
        <div class="form-group">
            <label for="model">Açıklama</label>
            <input type="text" class="form-control" name="model" value="<?php echo $sorgu["model"]?>" aria-describedby="emailHelp" placeholder="Model">
        </div>
        <div class="form-group">
            <label for="isim">İsim</label>
            <input type="text" class="form-control" name="isim" value="<?php echo $sorgu["isim"]?>" aria-describedby="emailHelp" placeholder="İsim">
        </div>

        <div class="form-group">
            <label for="adet">Adet</label>
            <input type="text" class="form-control" name="adet" value="<?php echo $sorgu["adet"]?>" aria-describedby="emailHelp" placeholder="Adet">
        </div>
        <div class="form-group">
            <label for="fiyat"> Geliş Fiyatı</label>
            <input type="text" class="form-control"value="<?php echo $sorgu["gelis_fiyat"]?>" name="gelis_fiyat" aria-describedby="emailHelp" placeholder="Fiyat">
        </div>
        <div class="form-group">
            <label for="fiyat"> Bayi Fiyatı</label>
            <input type="text" class="form-control" value="<?php echo $sorgu["bayi_fiyat"]?>"name="bayi_fiyat" aria-describedby="emailHelp" placeholder="Fiyat">
        </div>


        <div class="form-group">
            <label for="fiyat">Kullanıcı Satış Fiyat</label>
            <input type="text" class="form-control" value="<?php echo $sorgu["fiyat"]?>" name="fiyat" aria-describedby="emailHelp" placeholder="Fiyat">
        </div>
        <div class="form-group">
            <label for="fiyat">Kategori</label>
            <input type="text" class="form-control" name="kat" value="<?php echo $sorgu["kategori"]?>" aria-describedby="emailHelp" placeholder="Fiyat">
        </div>
            <?php
        }

        ?>

        <?php
        if (isset($msg)) { ?>
            <div class="alert mt-3 <?php echo $status; ?>" role="alert">
                <?php echo $msg; ?>
            </div>
        <?php } ?>
        <button type="submit" class="btn btn-primary mt-3 w-100 " name="dene" >Ürün Güncelle </button>
    </form>


</div>

<?php
require_once 'footer.php';

?>
