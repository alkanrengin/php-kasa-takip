<?php
require_once 'header.php';
require_once 'navbar.php';
if (isset($_POST["dene"]))
    $toplam=0;
    $dfiyat=$_POST["diger-fiyat"];
    $t2=date('Y-m-d');
    $tur=($_POST["satis-turu"]);
    $o_tur=($_POST["odeme-turu"]);
    $tarih=date('Y-m-d H:i:s');
    $cat_name =$_POST["kat"];
    $satici=strtoupper($_POST["satici"]);
    $kod =$_POST["urun_kodu"];
    $marka =$_POST["marka"];
    $model =$_POST["model"];
    $isim =$_POST["isim"];
    $adet =$_POST["adet"];
    $bayi=$_POST["bayi_fiyat"];
    $gelis=$_POST["gelis_fiyat"];
    $ufiyat=$_POST["fiyat"];
    $fiyat=$_POST["fiyat"];

    if($tur=="1"){
        $toplam=intval($adet)* intval($fiyat);
        $tur="KULLANICI SATIŞI";

    }
    else if($tur=="2") {
        $toplam=intval($adet)* intval($bayi);
        $tur="BAYİ SATIŞI";
        $fiyat=$bayi;
    }
    else {
        $toplam=intval($adet)* intval($dfiyat);
        $tur="ÖZEL SATIŞ";
        $fiyat=$dfiyat;
    }
    $sonadet=0;
    if (empty($adet) ||empty($satici)  ) {
        $msg = 'Alanları doldurun.';
        $status = 'alert-danger';
    } else {
        $satis_ekle = $db->prepare("INSERT INTO satislar (tarih,t2,kod,satici,marka,model,isim,adet,Kategori,tur,odeme,gelis_fiyat,bayi_fiyat,fiyat,toplam_fiyat) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $satis_ekle->execute(array($tarih,$t2,$kod,$satici,$marka,$model,$isim,$adet,$cat_name,$tur,$o_tur,$gelis,$bayi,$fiyat,$toplam));
        $urun_getir = $db->prepare("SELECT * FROM urunler WHERE kod = ?");
        $urun_getir->execute([$kod]);
        $satir = $urun_getir->fetch(PDO::FETCH_ASSOC);
        if ($satir) {
        $sonadet=intval($satir["adet"])-intval($adet);
        }
        $urun_gun = $db->prepare("UPDATE urunler SET kod=?, marka=?, model=?, isim=?, adet=?,gelis_fiyat=?,bayi_fiyat=?, fiyat=?, kategori=? WHERE kod = ?");
        $urun_gun->execute([$kod, $marka, $model, $isim, $sonadet,$gelis,$bayi, $ufiyat, $cat_name, $kod]);
        if ($urun_gun->rowCount()>0) {
            $msg = 'Güncellleme işlemi tamamlandı.';
            $status = 'alert-success';
        }
        else {
            $msg = 'Üye kaydı başarısız. Bir sorun oluştu.';
            $status = 'alert-danger';
        }


}
?>
<div class="container" >
    <h1 class="text-center mt-5">Satış Yap</h1>
    <form method="post" action="">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo $_SESSION['uye_kadi'];
            $buttonValue = $_POST["satis"];
            $urun_getir = $db->prepare("SELECT * FROM urunler WHERE kod = ?");
            $urun_getir ->execute([$buttonValue]);
            $sorgu = $urun_getir ->fetch(PDO::FETCH_ASSOC);
            ?>
            <div class="form-group">
                <label for="satici">Satış Yapan</label>
                <input type="text" class="form-control"   name="satici" aria-describedby="emailHelp" placeholder="Satıcı">
            </div>
            <div class="form-group">
                <label for="urun_kodu">Ürün Kodu</label>
                <input type="text" class="form-control" readonly value="<?php echo $sorgu["kod"]?>" name="urun_kodu" aria-describedby="emailHelp" placeholder="Ürün Kodu">
            </div>

            <div class="form-group">
                <label for="marka">Marka</label>
                <input type="text" class="form-control" readonly value="<?php echo $sorgu["marka"]?>" name="marka" aria-describedby="emailHelp" placeholder="Marka">
            </div>

            <div class="form-group">
                <label for="isim">İsim</label>
                <input type="text" class="form-control" readonly name="isim" value="<?php echo $sorgu["isim"]?>" aria-describedby="emailHelp" placeholder="İsim">
            </div>
            <div class="form-group">
                <label for="adet">Adet</label>
                <input type="text" class="form-control"  name="adet" value="<?php echo $sorgu["adet"]?>" aria-describedby="emailHelp" placeholder="Adet">
            </div>
            <div class="form-group">
                <label for="fiyat"> Geliş Fiyatı</label>
                <input type="text" class="form-control" readonly value="<?php echo $sorgu["gelis_fiyat"]?>" name="gelis_fiyat" aria-describedby="emailHelp" placeholder="Fiyat">
            </div>
            <div class="form-group">
                <label for="fiyat"> Bayi Fiyatı</label>
                <input type="text" class="form-control" readonly value="<?php echo $sorgu["bayi_fiyat"]?>"name="bayi_fiyat" aria-describedby="emailHelp" placeholder="Fiyat">
            </div>
            <div class="form-group">
                <label for="fiyat">Kullanıcı Satış Fiyat</label>
                <input type="text" class="form-control" readonly value="<?php echo $sorgu["fiyat"]?>" name="fiyat" aria-describedby="emailHelp" placeholder="Fiyat">
            </div>
            <div class="form-group">
                <label for="fiyat">Kategori</label>
                <input type="text" class="form-control" readonly name="kat" value="<?php echo $sorgu["kategori"]?>" aria-describedby="emailHelp" placeholder="Kategori">
            </div>
            <div class="form-group">
                <label for="model">Satış Açıklaması </label>
                <input type="text" class="form-control"  name="model" aria-describedby="emailHelp" placeholder="Açıklama">
            </div>
            <div class="form-group">
                <label for="fiyat">Ödeme Türü</label>
                <select class="form-select form-select-lg mb-3" id=" " name="odeme-turu" aria-label=".form-select-lg example">
                    <option value="NAKİT">Nakit</option>
                    <option value="KART">Kart</option>
                    <option value="HAVALE/EFT"> Havale</option>
                </select>
            </div>
             <div class="form-group">
                <label for="fiyat">Satış Türü</label>
                <select class="form-select form-select-lg mb-3" id="satis-turu" name="satis-turu" aria-label=".form-select-lg example">
                    <option value="1">Kullanıcı Satış Fiyatı</option>
                    <option value="2">Bayi Satış Fiyatı</option>
                    <option value="3"> Diğer</option>
                </select>
             </div>

            <div class="form-group diger" style="display: none">
                <label for="">Kategori</label>
                <input type="text" class="form-control"  name="diger-fiyat"  aria-describedby="emailHelp" placeholder="Özel Fiyat">
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
        <button type="submit" class="btn btn-primary mt-3 w-100 " name="dene" >Satış Yap </button>
    </form>


</div>


<?php
require_once 'footer.php';

?>
<script>
    $("#satis-turu").change(function(){

        var deger = $(this).val();
        console.log(deger);
        if(deger=="3"){
            $(".diger").show();
        }
        else{
            $(".diger").hide();
        }
    });
</script>
