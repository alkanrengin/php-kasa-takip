<?php
require_once 'header.php';
require_once 'navbar.php';
if (isset($_POST["dene"])) {
    
    $kod =$_POST["urun_kodu"];
        $urun_sil = $db->prepare("DELETE FROM urunler   WHERE kod = ?");
        $urun_sil->execute([$kod]);
        if ($urun_sil) {
            $msg = 'Silme işlemi tamamlandı.';
            $status = 'alert-success';
            header('Location:urun-listesi.php');
            exit;
        }
        else {
            $msg = 'Üye kaydı başarısız. Bir sorun oluştu.';
            $status = 'alert-danger';
        }


}
?>
<div class="container" >
    <h1 class="text-center mt-5">Ürün Sil</h1>
    <form method="post" action="">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $buttonValue = $_POST["sil"];
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
                <label for="model">Model</label>
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
                <label for="fiyat">Fiyat</label>
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
        <button type="submit" class="btn btn-primary mt-3 w-100 " name="dene" >Ürün Sil </button>
    </form>
    <a  class="btn btn-primary mt-3 w-100 " href="urun-listesi.php" >Geri Dön </a>


</div>

<?php
require_once 'footer.php';

?>
