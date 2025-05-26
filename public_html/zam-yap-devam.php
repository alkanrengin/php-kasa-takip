<?php
require_once 'header.php';
require_once 'navbar.php';

    if (isset($_POST["dene"])) {
        $kod=$_POST["kod"];
        $zamturu=$_POST["zam"];
        $zamoran=$_POST["zam_oran"];
        $sonfiyat=0;

        if ($zamturu=="yuzde")
        {
            if (empty($zamoran) ||empty($zamturu) ) {
                $msg = 'Alanları doldurun.';
                $status = 'alert-danger';
            }
            else{
                $urun_getir = $db->prepare("SELECT * FROM urunler WHERE kod = ?");
                $urun_getir->execute([$kod]);
                $satir = $urun_getir->fetch(PDO::FETCH_ASSOC);
                if ($satir) {
                    $sonfiyat=((intval($satir["fiyat"])*intval($zamoran))/100)+intval($satir["fiyat"]);
                }

                $urun_gun = $db->prepare("UPDATE urunler SET fiyat=? WHERE kod = ?");
                $urun_gun->execute([$sonfiyat,$kod]);
                if ($urun_gun->rowCount()>0) {
                    $msg = 'Güncellleme işlemi tamamlandı.';
                    $status = 'alert-success';
                }
                else {
                    $msg = 'Üye kaydı başarısız. Bir sorun oluştu.';
                    $status = 'alert-danger';
                }

            }

        }
        else
        {
            if (empty($zamoran) ||empty($zamturu) ) {
                $msg = 'Alanları doldurun.';
                $status = 'alert-danger';
            }
            else{
                $urun_getir = $db->prepare("SELECT * FROM urunler WHERE kod = ?");
                $urun_getir->execute([$kod]);
                $satir = $urun_getir->fetch(PDO::FETCH_ASSOC);
                if ($satir) {

                    $sonfiyat=intval($satir["fiyat"])+intval($zamoran);
                }

                $urun_gun = $db->prepare("UPDATE urunler SET fiyat=? WHERE kod = ?");
                $urun_gun->execute([$sonfiyat,$kod]);
                if ($urun_gun->rowCount()>0) {
                    $msg = 'Güncellleme işlemi tamamlandı.';
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
    <h1 class="text-center mt-5">Zam Yap</h1>
    <form method="post" action="">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $kod=$_POST["zam"];

        ?>
        <div class="form-group" style="display:none;">
            <label for="urun_kodu">Zam Miktari</label>
            <input type="text" class="form-control" value="<?php echo $kod?>"  name="kod" aria-describedby="emailHelp" placeholder="Zam Miktarı">
        </div> <?php }?>
        <div class="mt-5" style="display:flex;justify-content:space-around" >
            <div class="form-check">
                <input class="form-check-input" type="radio" name="zam" value="yuzde" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                    Yüzde İle Zam Yap
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="zam" value="tl" id="flexRadioDefault2" >
                <label class="form-check-label" for="flexRadioDefault2">
                    Tl İle Zam Yap
                </label>
            </div>
        </div>

            <div class="form-group">
                <label for="urun_kodu">Zam Miktari</label>
                <input type="text" class="form-control"  name="zam_oran" aria-describedby="emailHelp" placeholder="Zam Miktarı">
            </div>


        <button type="submit" class="btn btn-primary mt-3 w-100 " name="dene" >Zam Yap </button>
    </form>


</div>

<?php
require_once 'footer.php';

?>
