<?php
require_once 'header.php';
require_once 'navbar.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $calisan =strtoupper($_POST["calisan"]);
     $maas =strtoupper($_POST["maas"]);
    if (empty($calisan) ) {
        $msg = 'Çalışan adı girin.';
        $status = 'alert-danger';
    } else {

        $ayni_cat_varmi = $db->prepare("SELECT * FROM calisanlar WHERE calisan = ?");
        $ayni_cat_varmi->execute([$calisan]);
        if ($ayni_cat_varmi->rowCount()) {
            $msg = 'Bu çalışan var.';
            $status = 'alert-danger';
        }
        else{
            $calisan_ekle = $db->prepare("INSERT INTO calisanlar (calisan, maas) VALUES (?,?)");
            $calisan_ekle->execute(array($calisan,$maas));
            if ($calisan_ekle) {
                $msg = 'Kayıt işlemi tamamlandı.';
                $status = 'alert-success';
            }
            else {
                $msg = ' Bir sorun oluştu.';
                $status = 'alert-danger';
            }
        }


    }

}


?>
<div class="container" >
    <h1 class="text-center mt-5">Çalışan Ekle</h1>
    <form method="post" action="">
        <div class="form-group">
            <label for="cat">Çalışan Adı Soyadı</label>
            <input type="text" class="form-control" id="cat"  name="calisan" aria-describedby="emailHelp" placeholder="Çalışan">
        </div>
             <div class="form-group">
            <label for="cat">Maaş</label>
            <input type="text" class="form-control" id="cat"  name="maas" aria-describedby="emailHelp" placeholder="Maaş">
        </div>

        <?php
        if (isset($msg)) { ?>
            <div class="alert mt-3 <?php echo $status; ?>" role="alert">
                <?php echo $msg; ?>
            </div>
        <?php } ?>

        <button type="submit" class="btn btn-primary mt-3 w-100" >Çalışan Ekle </button>
    </form>


</div>


<?php require_once 'footer.php';
?>