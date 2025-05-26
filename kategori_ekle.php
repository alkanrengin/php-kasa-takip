<?php
require_once 'header.php';
require_once 'navbar.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cat_name =strtoupper($_POST["kat_name"]);
    if (empty($cat_name) ) {
        $msg = 'Kategori adı girin.';
        $status = 'alert-danger';
    } else {

        $ayni_cat_varmi = $db->prepare("SELECT * FROM kategoriler WHERE kategori_adi = ?");
        $ayni_cat_varmi->execute([$cat_name]);
        if ($ayni_cat_varmi->rowCount()) {
            $msg = 'Bu kategori mevcut.';
            $status = 'alert-danger';
        }
        else{
            $cat_ekle = $db->prepare("INSERT INTO kategoriler (kategori_adi) VALUES (?)");
            $cat_ekle->execute([$cat_name]);
            if ($cat_ekle) {
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
    <h1 class="text-center mt-5">Kategori Ekle</h1>
    <form method="post" action="">
        <div class="form-group">
            <label for="cat">Kategori Adı</label>
            <input type="text" class="form-control" id="cat"  name="kat_name" aria-describedby="emailHelp" placeholder="Kategori Adı">
        </div>

        <?php
        if (isset($msg)) { ?>
            <div class="alert mt-3 <?php echo $status; ?>" role="alert">
                <?php echo $msg; ?>
            </div>
        <?php } ?>

        <button type="submit" class="btn btn-primary mt-3 w-100" >Ürün Ekle </button>
    </form>


</div>


<?php require_once 'footer.php';
?>